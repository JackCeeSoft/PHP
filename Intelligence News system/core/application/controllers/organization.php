<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Organization extends Base_e_army {
    public $images_path;

    public function __construct() {
        parent::__construct();
        //$this->load->model('m_organization');
        $this->load->model('m_organization');
        $this->data['title_section'] = 'รายการองค์กร';
        $this->images_path = $this->config->item('root_upload').$this->config->item('images_path_organization');
        $this->load->library('custom_upload');
        $this->data['script'] = array('assets/js/ckeditor/ckeditor.js', 'assets/js/bootstrap-datetimepicker.min.js');
    }
    
    public function del_pic(){
            if(empty($_POST['path']) || empty($_POST['id'])){
                echo '0';
            }else{
                $where['oi_path'] = $_POST['path'];
                $where['o_organizationid'] = $_POST['id'];
                
                $data_result = $this->m_organization->delete('organization_imageattach',$where);
                
                echo $data_result;
            }
    }
    
    public function check_name(){
            //print_r($_POST['username']);
            //$sesstion = $this->getSesstion();
            $data['o_fullnameth'] = $_POST['username'];
            //$data['o_unit'] = $sesstion['unitid'];
            $data_result = $this->m_organization->getDetail('organization',$data);
            
            if($data_result == ""){
                echo '1';
            }else{
                echo '0';
            }
    }
        
    public function lists($offset = 0,$id = null) {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_organization,'Organization->lists','View',$sesstion['user_id']);
        
        $this->data['unit_edit'] = $sesstion['unitid'];
        $where_report_rows = $where = NULL;
        $like = NULL;
        $this->data['unit'] = $this->m_organization->getAll('unit');
        //$sesstion = $this->getSesstion();
        //$where_report_rows['o_unit'] = $where['o_unit'] = $sesstion['unitid'];
        //print_r($sesstion);
        //$limit = $this->pagination_limit;
        $limit = 10;
        
        if(isset($_GET['o_unit'])){
            if($_GET['o_unit'] == 0){
                 $where_news_rows = $where = NULL;
             }else{
                 $where_report_rows['o_unit'] = $where['o_unit'] = $_GET['o_unit'];
                 $this->data['o_unit'] = $_GET['o_unit'];
             }
        }else{
            if($sesstion['base_u_unitid'] == 0){
                 $where_report_rows = $where = NULL;
            }else{
                 $this->data['o_unit'] = $where_report_rows['o_unit'] = $where['o_unit'] = "5";
            }
        }
        
        if(isset($_GET['o_search']) && $_GET['o_search']){
            //$array_keyword = explode(' ', trim($_GET['keyword']));
            $like_array = explode(' ', trim($_GET['o_search']));
            
            foreach ($like_array as $key => $values){
                $like[$key]['o_fullnameth'] = $values;
            }
            
            $this->data['o_search'] = $_GET['o_search'];
            $this->data['lists'] = $this->m_organization->getAll('organization', $where, $like, 'o_organizationid DESC', $limit, $offset);
            $config['total_rows'] = $this->data['total_rows'] = $this->m_organization->getCountAll('organization', $where, $like);
            $this->data['total_report_type_rows'] = $this->m_organization->getCountAll('organization', $where, $like);
        }else{
            $this->data['lists'] = $this->m_organization->getAll('organization', $where, $like, 'o_organizationid DESC', $limit, $offset);
            
            
            $config['total_rows'] = $this->data['total_rows'] = $this->m_organization->getCountAll('organization', $where, $like);
            $this->data['total_report_type_rows'] = $this->m_organization->getCountAll('organization', $where_report_rows);
        }

        $config['base_url'] = base_url() . 'organization/lists';
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
        
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'รายการองค์กร';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร'));
        
        if($id != NULL){
            $this->data['Error_delete'] = "ERROR";
        }
        
        //print_r($this->data);
        $this->view('organization/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_organization,'Organization->insert','Add',$sesstion['user_id']);
        
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_1', $this->data);
            } else {

                foreach ($_POST as $key => $values){
                        if(!empty($values) && $key != 'editor1'){
                            $insert[$key] = $values;
                        }
                    }
                
                $insert['o_createdby']         = $sesstion['user_id'];
                $insert['o_createddate']       = date('Y-m-d H:i:s');
                $insert['o_updatedby']         = $sesstion['user_id'];
                $insert['o_updateddate']       = date('Y-m-d H:i:s');
                $insert['o_unit'] = $sesstion['unitid'];
                $insert['o_movement']          = $_POST['editor1'];
                
                $organization_type_id = $this->m_organization->add('organization', $insert);	
                $this->action_log($this->m_organization,'Organization->insert','Add(Success)',$organization_type_id);
                
                /*---------------------------------------- start insert img ------------------------------------------*/
                $organization_id_path = $this->images_path.$organization_type_id;

                if (!file_exists($organization_id_path.'/')) {
                    mkdir($organization_id_path, 0775);
                }
                
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $organization_id_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        echo 'img : ';
                        $this->debug($upload_data[0]); exit;
                    }
                    $imgupload['o_mainimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_organization->edit('organization', array('o_organizationid' => $organization_type_id), array('o_mainimage' => $imgupload['o_mainimage']));
                }
                /*----------------------------------------- end insert img -------------------------------------------*/ 

                //print_r($report_type_id);
                
                redirect(site_url('organization/updateTap1/'.$organization_type_id));
            }
        } else {
            $this->action_log($this->m_organization,'Organization->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['title_section'] = 'เพิ่มองค์กร';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/lists')), array('name' => 'เพิ่มองค์กร'));
            $this->view('organization/v_form_1', $this->data);
        }
    }
    
     public function updateTap1($id = '',$offset_ch = null) {
         $data_session  = $this->session->all_userdata();
         $this->action_log($this->m_organization,'Organization->updateTap1','Edit',$id);
        if($offset_ch == null){
            if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('organization/updateTap1/'.$id."/0");
            }else{
                $offset = 0;
            }
        }else{
            $offset = $offset_ch;
            $offset_ck = array(
                'offset_ck' => $offset
            );
            $this->session->set_userdata($offset_ck);
        }
        //echo $offset;
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
        $this->data['image'] = $this->m_organization->getAll('organization_imageattach', array('o_organizationid' => $id));
        $count_nlo = $this->m_organization->getAll('news_link_organization',array('o_organizationid' => $id));
        if($count_nlo >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){ //มีการส่งค่า Search เข้ามา
                $_POST['no_search_text'] = trim($_POST['no_search_text']);
                $data = $this->m_organization->get_news($id,$_POST['no_search_text'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                    $this->data['news_all'] = $data['news_all'] ;
                    $this->data['no_search_test'] = $_POST['no_search_text'];
                    $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
            }else{
                
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != ""){ // มีการกดค่าค้นหาจาก Session
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $this->data['check_tap'] = "submit_tap2";
                    $data = $this->m_organization->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }else{
                   $data = $this->m_organization->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }
                //print_r($data['count_news']);
                if(!isset($data['count_news'])){
                    $data['count_news'] = 0;
                }
                $config['base_url'] = base_url() . '/organization/updateTap1/'.$id;
                //$config['page_query_string'] = TRUE;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $data['count_news'] ;
                //echo $data['count_news'];
                //$config['total_rows'] = $this->data['total_rows'] = $this->m_search->getCountAll('news', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
        //print_r($_POST);
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_all', $this->data);
            } else {
               $insert['o_fullnameth']         = $_POST['o_fullnameth'];
                $insert['o_shortnameth']       = $_POST['o_shortnameth'];
                $insert['o_fullnameen']         = $_POST['o_fullnameen'];
                $insert['o_shortnameen']       = $_POST['o_shortnameen'];
                $insert['o_updatedby']         = $sesstion['user_id'];
                $insert['o_updateddate']       = date('Y-m-d H:i:s');
                $insert['o_movement']          = $_POST['editor1'];
                
                foreach ($insert as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                
                $result = $this->m_organization->edit('organization', array('o_organizationid' => $id), $insert_data);
                $this->action_log($this->m_organization,'Organization->updateTap1','Edit(Success)',$id);
                
                /*---------------------------------------- start insert img ------------------------------------------*/
                $organization_id_path = $this->images_path.$id;
                if (!file_exists($organization_id_path.'/')) {
                    mkdir($organization_id_path, 0775);
                }
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $organization_id_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        $this->debug($upload_data[0]); exit;
                    }
                    if (isset($upload_data) and $upload_data and $this->data['result']['o_mainimage']) {
                        delete_file($organization_id_path . '/' . $this->data['result']['o_mainimage']);
                    }
                    $imgupload['o_mainimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_organization->edit('organization', array('o_organizationid' => $id), array('o_mainimage' => $imgupload['o_mainimage']));
                }
                /*----------------------------------------- end insert img -------------------------------------------*/ 
                $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/search_org_news')), array('name' => 'เพิ่มองค์กร'));
                //print_r($_POST);

                if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] === "click_last"){
                    redirect(site_url('organization/lists'));
                }
                if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                    $this->data['check_tap'] = $_POST['submit_tap'];
                }
                
                $this->view('organization/v_form_tap_1', $this->data);
            }
        } else {
            $this->action_log($this->m_organization,'Organization->updateTap1','Edit(UnSuccess)',$id);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/search_org_news')), array('name' => 'เพิ่มองค์กร'));
            if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
           }else{
                $this->data['check_tap'] = "submit_tap1";
           }
           if(isset($_GET['del_pic']) && $_GET['del_pic']){
                    $this->data['check_tap'] = "submit_tap3";
            }
            $this->view('organization/v_form_tap_1', $this->data);
        }
    }

     public function look_organize($id = '',$offset_ch = null) {
         $this->action_log($this->m_organization,'Organization->look_organize','View',$id);
         $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
            if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('organization/look_organize/'.$id."/0");
            }else{
                $offset = 0;
            }
            
        }else{
            $offset = $offset_ch;
            $offset_ck = array(
                'offset_ck' => $offset
            );
            $this->session->set_userdata($offset_ck);
        }
        //echo $offset;
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
        $this->data['image'] = $this->m_organization->getAll('organization_imageattach', array('o_organizationid' => $id));
        $count_nlo = $this->m_organization->getAll('news_link_organization',array('o_organizationid' => $id));
        if($count_nlo >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_organization->get_news($id,$_POST['no_search_text'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                $this->data['no_search_test'] = $_POST['no_search_text'];
                
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
            }else{
                
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != ""){
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $this->data['check_tap'] = "submit_tap2";
                    $data = $this->m_organization->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }else{
                   $data = $this->m_organization->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
                   }else{
                        $this->data['check_tap'] = "submit_tap1";
                   }
                        $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }
                if(!isset($data['count_news'])){
                    $data['count_news'] = 0;
                }
                $config['base_url'] = base_url() . '/organization/look_organize/'.$id;
                //$config['page_query_string'] = TRUE;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
                //echo $data['count_news'];
                //$config['total_rows'] = $this->data['total_rows'] = $this->m_search->getCountAll('news', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
        //print_r($_POST);
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_all', $this->data);
            } else {
               $insert['o_fullnameth']         = $_POST['o_fullnameth'];
                $insert['o_shortnameth']       = $_POST['o_shortnameth'];
                $insert['o_fullnameen']         = $_POST['o_fullnameen'];
                $insert['o_shortnameen']       = $_POST['o_shortnameen'];
                $insert['o_updatedby']         = $sesstion['user_id'];
                $insert['o_updateddate']       = date('Y-m-d H:i:s');
                $insert['o_movement']          = $_POST['editor1'];
                $result = $this->m_organization->edit('organization', array('o_organizationid' => $id), $insert);
                  
                /*---------------------------------------- start insert img ------------------------------------------*/
                $organization_id_path = $this->images_path.$id;

                if (!file_exists($organization_id_path.'/')) {
                    mkdir($organization_id_path, 0775);
                }
                
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $organization_id_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        $this->debug($upload_data[0]); exit;
                    }
                    if (isset($upload_data) and $upload_data and $this->data['result']['o_mainimage']) {
                        delete_file($organization_id_path . '/' . $this->data['result']['o_mainimage']);
                    }
                    $imgupload['o_mainimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_organization->edit('organization', array('o_organizationid' => $id), array('o_mainimage' => $imgupload['o_mainimage']));
                } 

                /*----------------------------------------- end insert img -------------------------------------------*/ 
                $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/search_org_news')), array('name' => 'เพิ่มองค์กร'));
                //print_r($_POST);

                if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] === "click_last"){
                    redirect(site_url('organization/lists'));
                }
                if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                    $this->data['check_tap'] = $_POST['submit_tap'];
                }
                $this->view('organization/v_look_organize', $this->data);
            }
        } else {
            
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/search_org_news')), array('name' => 'เพิ่มองค์กร'));
            if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
           }else{
                $this->data['check_tap'] = "submit_tap1";
           }
            $this->view('organization/v_look_organize', $this->data);
           //print_r($this->data);
        }
    }
    
    public function pdf_organize($id = '',$offset_ch = null) {
        $this->action_log($this->m_organization,'Organization->pdf_organize','PDF',$id);
         $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
            if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('organization/look_organize/'.$id."/0");
            }else{
                $offset = 0;
            }
            
        }else{
            $offset = $offset_ch;
            $offset_ck = array(
                'offset_ck' => $offset
            );
            $this->session->set_userdata($offset_ck);
        }
        //echo $offset;
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
        $this->data['image'] = $this->m_organization->getAll('organization_imageattach', array('o_organizationid' => $id));
        $count_nlo = $this->m_organization->getAll('news_link_organization',array('o_organizationid' => $id));
        if($count_nlo >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_organization->get_news($id,$_POST['no_search_text'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                $this->data['no_search_test'] = $_POST['no_search_text'];
                
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
            }else{
                
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != ""){
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $this->data['check_tap'] = "submit_tap2";
                    $data = $this->m_organization->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }else{
                   $data = $this->m_organization->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
                   }else{
                        $this->data['check_tap'] = "submit_tap1";
                   }
                        $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }
            $pdf_name = $this->data['result']['o_fullnameth'];

            //$this->view('organization/v_pdf_organize', $this->data);
        
            $header[] = '<style>'.file_get_contents(base_url().'assets/my_fonts/fonts.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/css/custom.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/bootstrap-image-gallery.min.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/jquery.fileupload-ui.css').'</style>';
            
            //$header = NULL;
            $this->data['none_symbol'] = true;
            $html = $this->view_pdf('organization/v_pdf_organize', $this->data, $header, true); 
        
            //$html = $this->view_pdf('organization/v_pdf_organize', $this->data);
            //var_dump($html);
            $arr_replace = array('font-family:');
            $html = str_replace($arr_replace, "", $html);
            //echo $html;
            //exit();

            $pdfFilePath = "$pdf_name.pdf";

            $this->load->library('m_pdf');
            $mpdf = $this->m_pdf->load();
            $mpdf->debug = true;
            $mpdf->WriteHTML($html);
            //$mpdf->Output($pdfFilePath, "D");
            $mpdf->Output();

    }
    public function word_organize($id = '',$offset_ch = null) {
        $this->action_log($this->m_organization,'Organization->word_organize','Word',$id);
         $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
            if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('organization/look_organize/'.$id."/0");
            }else{
                $offset = 0;
            }
            
        }else{
            $offset = $offset_ch;
            $offset_ck = array(
                'offset_ck' => $offset
            );
            $this->session->set_userdata($offset_ck);
        }
        //echo $offset;
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
        $this->data['image'] = $this->m_organization->getAll('organization_imageattach', array('o_organizationid' => $id));
        $count_nlo = $this->m_organization->getAll('news_link_organization',array('o_organizationid' => $id));
        if($count_nlo >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_organization->get_news($id,$_POST['no_search_text'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                $this->data['no_search_test'] = $_POST['no_search_text'];
                
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
            }else{
                
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != ""){
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $this->data['check_tap'] = "submit_tap2";
                    $data = $this->m_organization->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }else{
                   $data = $this->m_organization->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
                   }else{
                        $this->data['check_tap'] = "submit_tap1";
                   }
                        $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }
            //$result['o_fullnameth']
            $doc_name = $this->data['result']['o_fullnameth'];
            header("Content-type: application/vnd.ms-word");
            header('Content-Disposition: attachment;Filename='.$doc_name.'.doc');

            $this->view('organization/v_word_organize', $this->data);
        
//            $header[] = '<style>'.file_get_contents(base_url().'assets/my_fonts/fonts.css').'</style>';
//            $header[] = '<style>'.file_get_contents(base_url().'assets/css/custom.css').'</style>';
//            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/bootstrap-image-gallery.min.css').'</style>';
//            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/jquery.fileupload-ui.css').'</style>';
//            
//            //$header = NULL;
//            $this->data['none_symbol'] = true;
//            $html = $this->view_pdf('organization/v_pdf_organize', $this->data, $header, true); 
//        
//            //$html = $this->view_pdf('organization/v_pdf_organize', $this->data);
//            //var_dump($html);
//            $arr_replace = array('font-family:');
//            $html = str_replace($arr_replace, "", $html);
//            //echo $html;
//            //exit();
//
//            $pdfFilePath = "Organization_pdf_name.pdf";
//
//            $this->load->library('m_pdf');
//            $mpdf = $this->m_pdf->load();
//            $mpdf->debug = true;
//            $mpdf->WriteHTML($html);
//            //$mpdf->Output($pdfFilePath, "D");
//            $mpdf->Output();

    }
    
    public function updateTap2($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_all', $this->data);
            } else {
                $insert['nc_name']              = $_POST['nc_name'];
                $insert['nc_description']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
                $insert['nc_updatedby']         = $sesstion['user_id'];
                $insert['nc_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_organization->edit('news_country', array('nc_newscountryid' => $id), $insert);
                redirect(site_url('organization/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/lists')), array('name' => 'เพิ่มองค์กร'));
            $this->view('organization/v_form_tap_2', $this->data);
        }
    }
    
        public function updateTap3($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_all', $this->data);
            } else {
                $insert['nc_name']              = $_POST['nc_name'];
                $insert['nc_description']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
                $insert['nc_updatedby']         = $sesstion['user_id'];
                $insert['nc_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_organization->edit('news_country', array('nc_newscountryid' => $id), $insert);
                redirect(site_url('organization/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/lists')), array('name' => 'เพิ่มองค์กร'));
            $this->view('organization/v_form_tap_2', $this->data);
        }
    }
    
    public function no_insert(){
        $sesstion = $this->getSesstion();
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('organization/v_form_on_insert', $this->data);
            } else {
//                $insert['o_image']              = $_POST['nc_name'];
//                $insert['o_mainimage']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
//                $insert['o_movement']              = $_POST['nc_name'];
                 
                $insert['o_fullnameth']        = $_POST['o_fullnameth'];
                $insert['o_shortnameth']       = $_POST['o_shortnameth'];
                $insert['o_fullnameen']        = $_POST['o_fullnameen'];
                $insert['o_shortnameen']       = $_POST['o_shortnameen'];
                
                $insert['o_createdby']         = $sesstion['user_id'];
                $insert['o_createddate']       = date('Y-m-d H:i:s');
                $insert['o_updatedby']         = $sesstion['user_id'];
                $insert['o_updateddate']       = date('Y-m-d H:i:s');
                $report_type_id = $this->m_organization->add('organization', $insert);	
                
                redirect(site_url('organization/lists'));
                //print_r($report_type_id);
                //redirect(site_url('organization/v_form_on_insert'));
            }
        } else {
            $this->data['title_section'] = 'เพิ่มองค์กร';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการองค์กร', 'link' => site_url('organization/lists')), array('name' => 'เพิ่มองค์กร'));
            $this->view('organization/v_form_on_insert', $this->data);
        }
    }

    public function delete($id = '') {
        $this->data['result'] = $this->m_organization->getDetail('organization', array('o_organizationid' => $id));
        $count_nlo = $this->m_organization->getAll('news_link_organization',array('o_organizationid' => $id));
        if($count_nlo >= 1){
            //echo 'test';
            redirect(site_url('organization/lists/0/'.$id));
        }else{
            if (!empty($id) && $this->data['result']){
                $data = '';
                $data['o_organizationid'] = $id;
                $this->m_organization->delete('organization',$data);
                redirect(site_url('organization/lists'));
            }
        }
        //redirect(site_url('organization/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('o_fullnameth', 'ชื่อองค์กร', 'required');
    }
    public function search_org_news(){
        //$data_session  = $this->session->all_userdata();
        $this->session->unset_userdata('no_search_test');
        $this->session->unset_userdata('offset_ck');
        //$data_session  = $this->session->all_userdata();
        //print_r($data_session);
        redirect('organization/lists');
    }
}