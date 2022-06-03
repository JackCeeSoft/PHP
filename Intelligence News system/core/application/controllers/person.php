<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Person extends Base_e_army {
    public $images_path;
     
    public function __construct() {
        parent::__construct();
        $this->load->model('m_person');
        $this->data['title_section'] = 'รายการบุคคล';
        $this->images_path = $this->config->item('root_upload').$this->config->item('images_path_person');
        $this->load->library('custom_upload');
        $this->data['script'] = array('assets/js/ckeditor/ckeditor.js', 'assets/js/bootstrap-datetimepicker.min.js');
        $this->data['style'] = array('assets/css/bootstrap-combined.min.css','assets/css/bootstrap-datetimepicker.min.css', 'assets/bootstrap-duallistbox/bootstrap-duallistbox.css');
    }
    public function del_pic(){
            if(empty($_POST['path']) || empty($_POST['id'])){
                echo '0';
            }else{
                $where['pi_path'] = $_POST['path'];
                $where['p_personid'] = $_POST['id'];
                
                $data_result = $this->m_person->delete('person_imageattach',$where);
                
                echo $data_result;
            }
            
    }

    public function check_name(){
            //$sesstion = $this->getSesstion();
            //$data['p_unit'] = $sesstion['unitid'];
            if(empty($_POST['p_firstname']) || empty($_POST['p_lastname'])){
                echo '0';
            }else{
                $data['p_firstname'] = $_POST['p_firstname'];
                $data['p_lastname'] = $_POST['p_lastname'];
                
                $data_result = $this->m_person->getDetail('person',$data);
                if($data_result == ""){
                    echo '1';
                }else{
                    echo '3';
                }
            }
            
    }
    
    public function lists($offset = 0) {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_person,'Person->lists','View',$sesstion['user_id']);
        $this->data['unit_edit'] = $sesstion['unitid'];
       // $sesstion = $this->getSesstion();
       // $where_report_rows['p_unit'] = $where['p_unit'] = $sesstion['unitid'];
        $this->data['unit'] = $this->m_person->getAll('unit');
        $where_report_rows = $where = null;
        $like = NULL;
        //$sesstion = $this->getSesstion();
        //print_r($sesstion);
        //$limit = $this->pagination_limit;
        $limit = 10;
         if(isset($_GET['p_unit'])){
            if($_GET['p_unit'] == 0){
                 $where_news_rows = $where = NULL;
             }else{
                 $where_report_rows['p_unit'] = $where['p_unit'] = $_GET['p_unit'];
                 $this->data['p_unit'] = $_GET['p_unit'];
             }
        }else{
            if($sesstion['base_u_unitid'] == 0){
                 $where_report_rows = $where = NULL;
            }else{
                 $this->data['p_unit'] = $where_report_rows['p_unit'] = $where['p_unit'] = "5";
            }
        }
        
        if(isset($_GET['p_search']) && $_GET['p_search']){
            
            $like_array = explode(' ', trim($_GET['p_search']));
            $num_count_like = count($like_array);
            foreach ($like_array as $key => $values){
                $like[$key]['p_firstname'] = $values;
                $like[$key+$num_count_like]['p_lastname'] = $values;
            }
//            $like['p_firstname'] = $_POST['p_search'];
//            $like['p_lastname'] = $_POST['p_search'];
            $this->data['p_search'] = $_GET['p_search'];
            $this->data['lists'] = $this->m_person->getAll('person', $where, $like, 'p_personid DESC', $limit, $offset);
            $this->data['total_report_type_rows'] = $this->m_person->getCountAll('person', $where_report_rows,$like);
            $config['total_rows'] = $this->data['total_rows'] = $this->m_person->getCountAll('person', $where, $like);
            
        }else{
            $this->data['lists'] = $this->m_person->getAll('person', $where, $like, 'p_personid DESC', $limit, $offset);
            $this->data['total_report_type_rows'] = $this->m_person->getCountAll('person', $where_report_rows);
            $config['total_rows'] = $this->data['total_rows'] = $this->m_person->getCountAll('person', $where, $like);
        }
        $config['base_url'] = base_url() . 'person/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'รายการบุคคล';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล'));
        
        //print_r($this->data);
        
        $this->view('person/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_person,'Person->insert','Add',$sesstion['user_id']);
        $insert = array();
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('person/v_form_add', $this->data);
            } else {
//                $insert['o_image']              = $_POST['nc_name'];
//                $insert['o_mainimage']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
//                $insert['o_movement']              = $_POST['nc_name'];
                foreach ($_POST as $key => $values) {
                    //echo $key;
                    //if($key == "p_idcard_1" || $key == "p_idcard_2" || $key == "p_idcard_3" || $key == "p_idcard_4" || $key == "p_idcard_5" || $key == "p_idcard_6" || $key == "p_idcard_7" || $key == "p_idcard_8" || $key == "p_idcard_9" || $key == "p_idcard_10" || $key == "p_idcard_11" || $key == "p_idcard_12" || $key == "p_idcard_13"){
                        
                    //}else{
                        if($_POST[$key] != ""){
                            $insert[$key] = $_POST[$key];
                        }
                    //}
                }
                //$insert['p_birthdate'] = date('Y-m-d H:i:s');
                //$insert['p_idcard'] = $_POST['p_idcard_1'].$_POST['p_idcard_2'].$_POST['p_idcard_3'].$_POST['p_idcard_4'].$_POST['p_idcard_5'].$_POST['p_idcard_6'].$_POST['p_idcard_7'].$_POST['p_idcard_8'].$_POST['p_idcard_9'].$_POST['p_idcard_10'].$_POST['p_idcard_11'].$_POST['p_idcard_12'].$_POST['p_idcard_13'];
                $insert['p_createdby']         = $sesstion['user_id'];
                //$insert['p_createddate']       = date('Y-m-d H:i:s');
                $insert['p_updatedby']         = $sesstion['user_id'];
                $insert['p_unit'] = $sesstion['unitid'];
                //$insert['p_updateddate']       = date('Y-m-d H:i:s');
                $person_type_id = $this->m_person->add('person', $insert);	
                $this->action_log($this->m_person,'Person->insert','Add(Success)',$person_type_id);
                //print_r($report_type_id);
                 /*---------------------------------------- start insert img ------------------------------------------*/
                $person_id_path = $this->images_path.$person_type_id;

                if (!file_exists($person_id_path.'/')) {
                    mkdir($person_id_path, 0775);
                }
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $person_id_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        echo 'img : ';
                        $this->debug($upload_data[0]); exit;
                    }
                    $imgupload['p_faceimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_person->edit('person', array('p_personid' => $person_type_id), array('p_faceimage' => $imgupload['p_faceimage']));
                }
                /*----------------------------------------- end insert img -------------------------------------------*/ 

                redirect(site_url('person/updateTap1/'.$person_type_id));
            }
        } else {
            $this->action_log($this->m_person,'Person->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['title_section'] = 'เพิ่มบุคคล';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/lists')), array('name' => 'เพิ่มบุคคล'));
            $this->view('person/v_form_add', $this->data);
        }
    }
    
    public function updateTap1($id = '',$offset_ch = null) {
        $data_session  = $this->session->all_userdata();
        $this->action_log($this->m_person,'Person->updateTap1','Edit',$id);
        if($offset_ch == null){
             if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('person/updateTap1/'.$id."/0");
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
        $limit = 5;
         
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
        $this->data['image'] = $this->m_person->getAll('person_imageattach', array('p_personid' => $id));
        $count_nlp = $this->m_person->getAll('news_link_person',array('p_personid' => $id));
        if (empty($id) or !$this->data['result']){
            redirect(site_url(''));
        }
        //print_r($count_nlp);
        if($count_nlp >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_person->get_news($id,$_POST['no_search_text'],$limit,$offset);
                //echo 'Jack test';
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
                $this->data['no_search_test'] = $_POST['no_search_text'];
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;

            }else{
                
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != "")
                {
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $data = $this->m_person->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                    
                }else{
                   $data = $this->m_person->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap1";
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
                $config['base_url'] = base_url() . '/person/updateTap1/'.$id;
                //$config['page_query_string'] = TRUE;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
                //echo $data['count_news'];
                //$config['total_rows'] = $this->data['total_rows'] = $this->m_search->getCountAll('news', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
                
       
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->setFormValidation();
                if ($this->form_validation->run() == FALSE) {
                    $this->data['result'] = $_POST;
                    $this->view('person/v_form_all', $this->data);
                } else {
                    
                    foreach ($_POST as $key => $values) {
                        //echo $key;
                        //if($key == "p_idcard_1" || $key == "p_idcard_2" || $key == "p_idcard_3" || $key == "p_idcard_4" || $key == "p_idcard_5" || $key == "p_idcard_6" || $key == "p_idcard_7" || $key == "p_idcard_8" || $key == "p_idcard_9" || $key == "p_idcard_10" || $key == "p_idcard_11" || $key == "p_idcard_12" || $key == "p_idcard_13"){
                        if($key == "editor1" || $key == "last_page_submit" ||$key == "submit_tap" || $key == "no_search_text"){   
                        }else{
                            //print_r($_POST);
                            if($_POST[$key] != ""){
                                $insert[$key] = $_POST[$key];
                            }
                        }
                    }
                    //print_r($insert);
                    $insert['p_updatedby']         = $sesstion['user_id'];
                    $insert['p_updateddate']       = date('Y-m-d H:i:s');
                    $insert['p_behavior']          = $_POST['editor1'];

                    //print_r($insert);

                    $result = $this->m_person->edit('person', array('p_personid' => $id), $insert);
                    $this->action_log($this->m_person,'Person->updateTap1','Edit(Success)',$id);
                    
                    /*---------------------------------------- start insert img ------------------------------------------*/
                    $person_id_path = $this->images_path.$id;

                    if (!file_exists($person_id_path.'/')) {
                        mkdir($person_id_path, 0775);
                    }

                    if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                        $this->custom_upload->setConfig(array('upload_path' => $person_id_path.'/'));
                        //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                        $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                        if(empty($upload_data['file_name'])) {
                            $this->debug($upload_data[0]); exit;
                        }
                        if (isset($upload_data) and $upload_data and $this->data['result']['p_faceimage']) {
                            delete_file($person_id_path . '/' . $this->data['result']['p_faceimage']);
                        }
                        $imgupload['p_faceimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                        $this->m_person->edit('person', array('p_personid' => $id), array('p_faceimage' => $imgupload['p_faceimage']));
                    } 
                    /*----------------------------------------- end insert img -------------------------------------------*/ 
                    if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                        $this->data['check_tap'] = $_POST['submit_tap'];
                    }

                    if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] == "click_last"){
                        redirect(site_url('person/lists'));
                    }
                    $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
                    $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/search_person_news')), array('name' => 'เพิ่มบุคคล'));

                    //print_r($this->data);

                    $this->view('person/v_form_tap_1', $this->data);
                    //redirect(site_url('person/updateTap1/'.$id));
                }
            } else {
                $this->action_log($this->m_person,'Person->updateTap1','Edit(UnSuccess)',$id);
                 if(isset($_GET['del_pic']) && $_GET['del_pic']){
                    $this->data['check_tap'] = "submit_tap3";
                        //print_r($this->data);
                    $this->view('person/v_form_tap_1', $this->data);
                    }else{
                        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/search_person_news')), array('name' => 'เพิ่มบุคคล'));
                        $this->data['check_tap'] = "submit_tap1";
                //print_r($this->data);
                        $this->view('person/v_form_tap_1', $this->data);
                    }
            }
        
    }
    
    public function look_person($id = '',$offset_ch = null) {  
        $this->action_log($this->m_person,'Person->look_person','View',$id);
        $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
             if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('person/look_person/'.$id."/0");
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
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
        $this->data['image'] = $this->m_person->getAll('person_imageattach', array('p_personid' => $id));
        $count_nlp = $this->m_person->getAll('news_link_person',array('p_personid' => $id));
        if (empty($id) or !$this->data['result']){
            redirect(site_url(''));
        }
        //print_r($count_nlp);
        if($count_nlp >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_person->get_news($id,$_POST['no_search_text'],$limit,$offset);
                //echo 'Jack test';
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
                $this->data['no_search_test'] = $_POST['no_search_text'];
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;

            }else{
                $data_session  = $this->session->all_userdata();
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != "")
                {
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $data = $this->m_person->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                    
                }else{
                   $data = $this->m_person->getAll_news($id,$limit,$offset);
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
                $config['base_url'] = base_url() . '/person/updateTap1/'.$id;
                //$config['page_query_string'] = TRUE;
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
                //echo $data['count_news'];
                //$config['total_rows'] = $this->data['total_rows'] = $this->m_search->getCountAll('news', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
                
                
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('person/v_form_all', $this->data);
            } else {
                foreach ($_POST as $key => $values) {
                    //echo $key;
                    //if($key == "p_idcard_1" || $key == "p_idcard_2" || $key == "p_idcard_3" || $key == "p_idcard_4" || $key == "p_idcard_5" || $key == "p_idcard_6" || $key == "p_idcard_7" || $key == "p_idcard_8" || $key == "p_idcard_9" || $key == "p_idcard_10" || $key == "p_idcard_11" || $key == "p_idcard_12" || $key == "p_idcard_13"){
                    if($key == "editor1" || $key == "last_page_submit" ||$key == "submit_tap" || $key == "no_search_text"){   
                    }else{
                        if($_POST[$key] != ""){
                            $insert[$key] = $_POST[$key];
                        }
                    }
                }
                $insert['p_updatedby']         = $sesstion['user_id'];
                $insert['p_updateddate']       = date('Y-m-d H:i:s');
                $insert['p_behavior']          = $_POST['editor1'];
                $result = $this->m_person->edit('person', array('p_personid' => $id), $insert);
                
                /*---------------------------------------- start insert img ------------------------------------------*/
                $person_id_path = $this->images_path.$id;

                if (!file_exists($person_id_path.'/')) {
                    mkdir($person_id_path, 0775);
                }
                
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $person_id_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        $this->debug($upload_data[0]); exit;
                    }
                    if (isset($upload_data) and $upload_data and $this->data['result']['p_faceimage']) {
                        delete_file($person_id_path . '/' . $this->data['result']['p_faceimage']);
                    }
                    $imgupload['p_faceimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_person->edit('person', array('p_personid' => $id), array('p_faceimage' => $imgupload['p_faceimage']));
                } 
                /*----------------------------------------- end insert img -------------------------------------------*/ 
                if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                    $this->data['check_tap'] = $_POST['submit_tap'];
                }
             
                if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] == "click_last"){
                    redirect(site_url('person/lists'));
                }
                $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/search_person_news')), array('name' => 'เพิ่มบุคคล'));
            
                //print_r($this->data);
            
                $this->view('person/v_look_person', $this->data);
                //redirect(site_url('person/updateTap1/'.$id));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/search_person_news')), array('name' => 'เพิ่มบุคคล'));
           if($offset_ch != null){
                $this->data['check_tap'] = "submit_tap2";
           }else{
                $this->data['check_tap'] = "submit_tap1";
           }
            $this->view('person/v_look_person', $this->data);
        }
    }
    
    public function pdf_person($id = '',$offset_ch = null) {     
        $this->action_log($this->m_person,'Person->pdf_person','PDF',$id);
        $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
             if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('person/look_person/'.$id."/0");
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
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
        $this->data['image'] = $this->m_person->getAll('person_imageattach', array('p_personid' => $id));
        $count_nlp = $this->m_person->getAll('news_link_person',array('p_personid' => $id));
        if (empty($id) or !$this->data['result']){
            redirect(site_url(''));
        }
        //print_r($count_nlp);
        if($count_nlp >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_person->get_news($id,$_POST['no_search_text'],$limit,$offset);
                //echo 'Jack test';
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
                $this->data['no_search_test'] = $_POST['no_search_text'];
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;

            }else{
                $data_session  = $this->session->all_userdata();
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != "")
                {
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $data = $this->m_person->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                    
                }else{
                   $data = $this->m_person->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }

                
            //$this->view('person/v_pdf_person', $this->data);
            
            $header[] = '<style>'.file_get_contents(base_url().'assets/my_fonts/fonts.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/css/custom.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/bootstrap-image-gallery.min.css').'</style>';
            $header[] = '<style>'.file_get_contents(base_url().'assets/fileupload/jquery.fileupload-ui.css').'</style>';
            
            //$header = NULL;
            $this->data['none_symbol'] = true;
            $html = $this->view_pdf('person/v_pdf_person', $this->data, $header, true); 
        
            //$html = $this->view_pdf('organization/v_pdf_organize', $this->data);
            //var_dump($html);
            $arr_replace = array('font-family:');
            $html = str_replace($arr_replace, "", $html);
            //echo $html;
            //exit();

            $pdfFilePath = "Organization_pdf_name.pdf";
            
            $this->load->library('m_pdf');
            $mpdf = $this->m_pdf->load();
            $mpdf->debug = true;
            $mpdf->WriteHTML($html);
            //$mpdf->Output($pdfFilePath, "D");
            $mpdf->Output(); 
        
    }
    
    public function word_person($id = '',$offset_ch = null) {     
        $this->action_log($this->m_person,'Person->word_person','Word',$id);
        $data_session  = $this->session->all_userdata();
        if($offset_ch == null){
             if(isset($data_session['no_search_test']) || isset($data_session['offset_ck'])){
                redirect('person/look_person/'.$id."/0");
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
        $limit = 5;
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
        $this->data['image'] = $this->m_person->getAll('person_imageattach', array('p_personid' => $id));
        $count_nlp = $this->m_person->getAll('news_link_person',array('p_personid' => $id));
        if (empty($id) or !$this->data['result']){
            redirect(site_url(''));
        }
        //print_r($count_nlp);
        if($count_nlp >= 1){
            //print_r($_POST);
            if(isset($_POST['no_search_text'])){
                $check_str = str_replace(" ", "", $_POST['no_search_text']);
            }
            
            if(isset($_POST['no_search_text']) && $_POST['no_search_text'] != "" && $check_str != ""){
                $data = $this->m_person->get_news($id,$_POST['no_search_text'],$limit,$offset);
                //echo 'Jack test';
                $no_search_test = array(
                        'no_search_test' => $_POST['no_search_text']
                    );
                    $this->session->set_userdata($no_search_test);
                $this->data['no_search_test'] = $_POST['no_search_text'];
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;

            }else{
                $data_session  = $this->session->all_userdata();
                //print_r($data_session['no_search_test']);
                if(isset($data_session['no_search_test']) && $data_session['no_search_test'] != "")
                {
                    $this->data['no_search_test'] = $data_session['no_search_test'];
                    $data = $this->m_person->get_news($id,$data_session['no_search_test'],$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                    
                }else{
                   $data = $this->m_person->getAll_news($id,$limit,$offset);
                   if($offset_ch != null){
                       $this->data['check_tap'] = "submit_tap2";
                   }else{
                       $this->data['check_tap'] = "submit_tap1";
                   }
                   $this->data['news_all'] = $data['news_all'] ;
                }
           }
        }

            $doc_name = $this->data['result']['p_firstname']." ".$this->data['result']['p_lastname'];
            header("Content-type: application/vnd.ms-word");
            header('Content-Disposition: attachment;Filename='.$doc_name.'.doc');

            
            $this->view('person/v_word_person', $this->data);
            
        
    }
    
    public function updateTap2($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));

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
                
                $result = $this->m_person->edit('news_country', array('nc_newscountryid' => $id), $insert);
                redirect(site_url('organization/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการบุคคล', 'link' => site_url('person/lists')), array('name' => 'เพิ่มบุคคล'));
            $this->view('person/v_form_tap_2', $this->data);
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
                 
                $insert['o_fullnameth']         = $_POST['o_fullnameth'];
                $insert['o_shortnameth']       = $_POST['o_shortnameth'];
                $insert['o_fullnameen']         = $_POST['o_fullnameen'];
                $insert['o_shortnameen']       = $_POST['o_shortnameen'];
                
                $insert['o_createdby']         = $sesstion['user_id'];
                $insert['o_createddate']       = date('Y-m-d H:i:s');
                $insert['o_updatedby']         = $sesstion['user_id'];
                $insert['o_updateddate']       = date('Y-m-d H:i:s');
                $report_type_id = $this->m_person->add('organization', $insert);	
                
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
        $this->action_log($this->m_person,'Person->delete','Delete',$id);
        $this->data['result'] = $this->m_person->getDetail('person', array('p_personid' => $id));
        $count_nlp = $this->m_person->getAll('news_link_person',array('p_personid' => $id));
        if($count_nlp >= 1){
            $this->lists(0,$id);
        }else{
            if (!empty($id) or !$this->data['result']){
                $data = '';
                $data['p_personid'] = $id;
                $this->action_log($this->m_person,'Person->delete','Delete(Success)',$id);
                $this->m_person->delete('person',$data);
                redirect(site_url('person/lists'));
            }else{
                $this->action_log($this->m_person,'Person->delete','Delete(UnSuccess)',$id);
                redirect(site_url(''));
            }
        }
    }
    public function ajaxImageList() {
        $html_gallery = '';
        if(isset($_POST['id']) and $_POST['id']) {
            $gallery = $this->m_news->getAll('news_imageattach', array('n_newsid' => $_POST['id']));
            if(isset($gallery) and $gallery) {
                foreach ($gallery as $k_gallery => $v_gallery) {
                    $html_gallery .= '<li>';
                    $html_gallery .= '<div>';
                    $html_gallery .= '<a class="gallery" href="'.getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'">';
                    $html_gallery .= '<img alt="" src="'.getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'" width="100" height="100">';
                    $html_gallery .= '</a>';
                    $html_gallery .= '</div>';
                    $html_gallery .= '<div>';
                    if(isset($_POST['action']) and $_POST['action'] == 'del') {
                        $html_gallery .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery['ni_imageattachid'].', \'news\');">ลบ</button>';
                    } else { 
                        $html_gallery .= '<button type="button" class="btn btn-primary btn-xs add" data-path="'.base_url().getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'">ใส่รูป</button>';
                    }
                    $html_gallery .= '</div>';
                    $html_gallery .= '</li>';
                }
            }
        }
        
        $html_unit = '';
        $gallery_unit = $this->m_news->getAll('unit_imageattach', array('u_code' => $this->u_code));
        if(isset($gallery_unit) and $gallery_unit) {
            foreach ($gallery_unit as $k_gallery_unit => $v_gallery_unit) {
                $html_unit .= '<li>';
                $html_unit .= '<div>';
                $html_unit .= '<a class="gallery" href="'.getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'">';
                $html_unit .= '<img alt="" src="'.getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'" width="100" height="100">';
                $html_unit .= '</a>';
                $html_unit .= '</div>';
                $html_unit .= '<div>';
                if(isset($_POST['action']) and $_POST['action'] == 'del') {
                    $html_unit .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery['ni_imageattachid'].', \'unit\');">ลบ</button>';
                } else { 
                    $html_unit .= '<button type="button" class="btn btn-primary btn-xs add" data-path="'.base_url().getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'">ใส่รูป</button>';
                }
                $html_unit .= '</div>';
                $html_unit .= '</li>';
            }
        } else {
            $html_unit .= '<p>ไม่พบรูปภาพในระบบ..</p>';
        }
        echo json_encode(array('gallery' => $html_gallery, 'gallery_unit' => $html_unit));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('p_firstname', 'ชื่อบุคคล *', 'required');
    }
    public function search_person_news(){
        //$data_session  = $this->session->all_userdata();
        $this->session->unset_userdata('no_search_test');
        $this->session->unset_userdata('offset_ck');
        //$data_session  = $this->session->all_userdata();
        //print_r($data_session);
        redirect('person/lists');
    }
}