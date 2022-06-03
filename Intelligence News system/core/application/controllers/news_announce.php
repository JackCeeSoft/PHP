<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_announce extends Base_e_army {
    public $announce_file_path;
   // public $db_model ;
    
    public function __construct() {
        parent::__construct();
        //$this->load->model('m_dashbord');
        //$this->db_model = 'm_dashbord';
        $this->load->model('m_dashbord');
        $this->data['title_section'] = 'ประกาศข่าวสาร';
        $this->announce_file_path = $this->config->item('root_upload').$this->config->item('file_path_announce_file');
        $this->load->library('custom_upload');
        $this->data['script'] = array('assets/js/ckeditor/ckeditor.js', 'assets/js/bootstrap-datetimepicker.min.js');
                
        $this->data['style'] = array(
            'assets/css/bootstrap-combined.min.css', 
            //'assets/bootstrap3-datetimepicker/css/bootstrap-datetimepicker.min.css', 
            'assets/css/bootstrap-datetimepicker.min.css', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.css', 
            'assets/css/pages/bootstrap.min_metro.css', 
            'assets/css/pages/bootstrap-responsive.min_metro.css', 
            //'assets/css/pages/style-metro.css', 
            'assets/css/timeline.css',
            'assets/css/pages/timeline.css'
        );
    }
    
    public function del_pic(){
            if(empty($_POST['path']) || empty($_POST['id'])){
                echo '0';
            }else{
                $where['oi_path'] = $_POST['path'];
                $where['d_announceid'] = $_POST['id'];
                
                $data_result = $this->m_dashbord->delete('dashbord_imageattach',$where);
                
                echo $data_result;
            }
    }
    
    public function check_name(){
            //print_r($_POST['username']);
            //$sesstion = $this->getSesstion();
            $data['d_fullnameth'] = $_POST['username'];
            //$data['d_unit'] = $sesstion['unitid'];
            $data_result = $this->m_dashbord->getDetail('news_announce',$data);
            
            if($data_result == ""){
                echo '1';
            }else{
                echo '0';
            }
    }
        
    public function lists($offset = 0,$id = null) {
        $sesstion = $this->getSesstion();
        
        $this->action_log($this->m_dashbord,'Dashbord->lists','View',$sesstion['user_id']);
        
        $this->data['unit_edit'] = $sesstion['unitid'];
        $where_report_rows = $where = NULL;
        $like = NULL;
        $this->data['unit'] = $this->m_dashbord->getAll('unit',null,null,'u_code asc',null,null);
        $limit = 10;
       
            if($sesstion['base_u_unitid'] == 0){
                 $where_report_rows = $where = NULL;
                 $this->data['base_unitid'] = 0;
            }else{
                $this->data['unit'] = $this->m_dashbord->getAll('unit',array('u_unitid'=>1),null,'u_code asc',null,null);
                 //$this->data['d_unit'] = $where_report_rows['d_unit'] = $where['d_unit'] = "1";
            }
        
            
            //$this->debug($this->data['count_news_user']);
        if(isset($_GET['d_search']) && $_GET['d_search']){
            //$array_keyword = explode(' ', trim($_GET['keyword']));
            $like_array = explode(' ', trim($_GET['d_search']));
            
            foreach ($like_array as $key => $values){
                $like[$key]['d_fullnameth'] = $values;
            }
            
            $this->data['d_search'] = $_GET['d_search'];
            $this->data['lists'] = $this->m_dashbord->getAll('news_announce', $where, $like, 'd_announceid DESC', $limit, $offset);
            $config['total_rows'] = $this->data['total_rows'] = $this->m_dashbord->getCountAll('news_announce', $where, $like);
            $this->data['total_report_type_rows'] = $this->m_dashbord->getCountAll('news_announce', $where, $like);
        }else{
            $this->data['lists'] = $this->m_dashbord->getAll('news_announce', $where, $like, 'd_announceid DESC', $limit, $offset);
            $config['total_rows'] = $this->data['total_rows'] = $this->m_dashbord->getCountAll('news_announce', $where, $like);
            $this->data['total_report_type_rows'] = $this->m_dashbord->getCountAll('news_announce', $where_report_rows);
        }

        $config['base_url'] = base_url() . 'news_announce/lists';
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
        
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'รายการประกาศข่าวสาร';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร'));
        
        if($id != NULL){
            $this->data['Error_delete'] = "ERROR";
        }
        
        //$this->debug($this->data);
        $this->view('news_announce/v_lists', $this->data);
    }
    
    public function insert() {
        
        if(isset($_POST) && $_POST){
            $this->debug($_POST);
            $this->debug($_FILES);
            //exit();
        }
        
        $sesstion = $this->getSesstion();
        //print_r($sesstion);
         $this->action_log($this->m_dashbord,'News_dashbord->insert','Add',$sesstion['user_id']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_announce/v_form_1', $this->data);
            } else {
                foreach ($_POST as $key => $values){
                        if(!empty($values) && $key != 'editor1'){
                            $insert[$key] = $values;
                        }
                    }
                $insert['d_createdby']         = $sesstion['user_id'];
                $insert['d_createddate']       = date('Y-m-d H:i:s');
                $insert['d_updatedby']         = $sesstion['user_id'];
                $insert['d_updateddate']       = date('Y-m-d H:i:s');
                $insert['d_unit'] = $sesstion['unitid'];
                $insert['d_movement']          = $_POST['editor1'];
                
                $news_announce_id = $this->m_dashbord->add('news_announce', $insert);
                
                $insert_noti['d_announceid']=$news_announce_id;
                $insert_noti['ua_userid'] = $sesstion['user_id'];
                $news_noti = $this->m_dashbord->add('news_link_usernoti',$insert_noti);
                $this->action_log($this->m_dashbord,'News_dashbord->insert','Add(Success)',$news_announce_id);
                
                //print_r($report_type_id);
/*------------------------------------ start insert attach_file --------------------------------------*/
        $announce_file_path = $this->announce_file_path.$news_announce_id;
        //echo 'path = '.$announce_file_path;
        if (!file_exists($announce_file_path.'/')) {
            mkdir($announce_file_path, 0775);
        }
        if (isset($_FILES['attach_file'])) {
            $this->custom_upload->setConfig(array('upload_path' => $announce_file_path.'/'));
            foreach ($_FILES['attach_file']['name'] as $k_attach => $v_attach) {
                if(isset($_FILES['attach_file']['name'][$k_attach]) and $_FILES['attach_file']['name'][$k_attach]) {
                    $_FILES['file']['name']     = $_FILES['attach_file']['name'][$k_attach];
                    $_FILES['file']['type']     = $_FILES['attach_file']['type'][$k_attach];
                    $_FILES['file']['tmp_name'] = $_FILES['attach_file']['tmp_name'][$k_attach];
                    $_FILES['file']['error']    = $_FILES['attach_file']['error'][$k_attach];
                    $_FILES['file']['size']     = $_FILES['attach_file']['size'][$k_attach];

                    $uploafile_data = $this->custom_upload->uploadFile('file', uniqid());
                    if(empty($uploafile_data['file_name'])) {
                        echo 'file : ';
                        $this->debug($uploafile_data[0]); exit;
                    }
                    $raw_name = $uploafile_data['raw_name'];
                    $uploafile_data = $uploafile_data['orig_name'];

                    $this->m_dashbord->add('announce_fileattach', array(
                        'd_announceid' => $news_announce_id,
                        'df_path' => $uploafile_data,
                        'df_createdby' => $sesstion['unitid'],
                        'df_updatedby' => $sesstion['unitid']
                    ));
                }
            }
        }
        /*------------------------------------- end insert attach_file ---------------------------------------*/                
               // redirect(site_url('news_announce/updateTap1/'.$news_announce_id));
        
        
               
                redirect(site_url('news_announce/lists'));
            }
        } else {
            $this->action_log($this->m_dashbord,'News_dashbord->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['title_section'] = 'เพิ่มข่าวสาร';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/lists')), array('name' => 'เพิ่มข่าวสาร'));
            $this->data['filter']['d_startdate'] =  date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            $this->data['filter']['d_enddate'] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d")+1, date("Y")));
            
            $this->view('news_announce/v_form_1', $this->data);
        }
    }
    
    public function updateTap1($id = '',$offset_ch = null) {
         $data_session  = $this->session->all_userdata();
         $this->action_log($this->m_dashbord,'News_dashbord->updateTap1','Edit',$id);
        if($offset_ch == null){
            if(isset($data_session['nd_search_test']) || isset($data_session['offset_ck'])){
                redirect('news_announce/updateTap1/'.$id."/0");
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
        $this->data['result'] = $this->m_dashbord->getDetail('news_announce', array('d_announceid' => $id));
        $this->data['file'] = $this->m_dashbord->getAll('announce_fileattach', array('d_announceid' => $id));
        
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_announce/v_form_all', $this->data);
            } else {
                foreach ($_POST as $key => $values){
                        if(!empty($values) && $key != 'editor1'){
                            $insert_data[$key] = $values;
                        }
                    }

                $insert_data['d_updatedby']         = $sesstion['user_id'];
                $insert_data['d_updateddate']       = date('Y-m-d H:i:s');
                $insert_data['d_unit']              = $sesstion['unitid'];
                $insert_data['d_movement']          = $_POST['editor1'];
                
                $result = $this->m_dashbord->edit('news_announce', array('d_announceid' => $id), $insert_data);
                
                $this->action_log($this->m_dashbord,'News_dashbord->updateTap1','Edit(Success)',$id);
                
                /*------------------------------------ start insert attach_file --------------------------------------*/
        $announce_file_path = $this->announce_file_path.$id;
        if (!file_exists($announce_file_path.'/')) {
            mkdir($announce_file_path, 0775);
        }
        if (isset($_FILES['attach_file'])) {
            $this->custom_upload->setConfig(array('upload_path' => $announce_file_path.'/'));
            foreach ($_FILES['attach_file']['name'] as $k_attach => $v_attach) {
                if(isset($_FILES['attach_file']['name'][$k_attach]) and $_FILES['attach_file']['name'][$k_attach]) {
                    $_FILES['file']['name']     = $_FILES['attach_file']['name'][$k_attach];
                    $_FILES['file']['type']     = $_FILES['attach_file']['type'][$k_attach];
                    $_FILES['file']['tmp_name'] = $_FILES['attach_file']['tmp_name'][$k_attach];
                    $_FILES['file']['error']    = $_FILES['attach_file']['error'][$k_attach];
                    $_FILES['file']['size']     = $_FILES['attach_file']['size'][$k_attach];

                    $uploafile_data = $this->custom_upload->uploadFile('file', uniqid());
                    if(empty($uploafile_data['file_name'])) {
                        echo 'file : ';
                        $this->debug($uploafile_data[0]); exit;
                    }
                    $raw_name = $uploafile_data['raw_name'];
                    $uploafile_data = $uploafile_data['orig_name'];

                    $this->m_dashbord->add('announce_fileattach', array(
                        'd_announceid' => $id,
                        'df_path' => $uploafile_data,
                        'df_createdby' => $sesstion['unitid'],
                        'cf_updatedby' => $sesstion['unitid']
                    ));
                }
            }
        }
        /*------------------------------------- end insert attach_file ---------------------------------------*/
                
                $this->data['attach'] =  $this->m_dashbord->getAll('announce_fileattach', array('d_announceid' => $id));
                $this->data['result'] = $this->m_dashbord->getDetail('news_announce', array('d_announceid' => $id));
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/search_org_news')), array('name' => 'เพิ่มข่าวสาร'));
                //print_r($_POST);

                if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] === "click_last"){
                    redirect(site_url('news_announce/lists'));
                }
                if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                    $this->data['check_tap'] = $_POST['submit_tap'];
                }
                
                $this->view('news_announce/v_form_tap_1', $this->data);
                //redirect(site_url('news_announce/lists'));  //if need go to list
            }
        } else {
            $this->action_log($this->m_dashbord,'News_dashbord->updateTap1','Edit(UnSuccess)',$id);
            $this->data['attach'] =  $this->m_dashbord->getAll('announce_fileattach', array('d_announceid' => $id));
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/search_org_news')), array('name' => 'เพิ่มข่าวสาร'));
            if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
           }else{
                $this->data['check_tap'] = "submit_tap1";
           }
           if(isset($_GET['del_pic']) && $_GET['del_pic']){
                    $this->data['check_tap'] = "submit_tap3";
            }
            //$this->debug($this->data);
            $this->view('news_announce/v_form_tap_1', $this->data);
        }
    }

    public function look_dashbord($id = '',$offset_ch = null) {
         $this->action_log($this->m_dashbord,'News_dashbord->look_newsDashbord','View',$id);
         $data_session  = $this->session->all_userdata();
         $sesstion = $this->getSesstion();
         $insert_noti['d_announceid']=$id;
         $insert_noti['ua_userid'] = $sesstion['user_id'];
         $check_news_noti = $this->m_dashbord->getDetail('news_link_usernoti',$insert_noti);
         if(isset($check_news_noti) && $check_news_noti){
             
         }else{
             $this->m_dashbord->add('news_link_usernoti',$insert_noti);
         }
        if($offset_ch == null){
            if(isset($data_session['nd_search_test']) || isset($data_session['offset_ck'])){
                redirect('news_announce/look_dashbord/'.$id."/0");
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
        //$sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_dashbord->getDetail('news_announce', array('d_announceid' => $id));
        $this->data['attach'] =  $this->m_dashbord->getAll('announce_fileattach', array('d_announceid' => $id));
        
                if(!isset($data['count_news'])){
                    $data['count_news'] = 0;
                }
                $config['base_url'] = base_url() . '/news_announce/look_dashbord/'.$id;
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
                $this->view('news_announce/v_form_all', $this->data);
            } else {
               $insert['d_fullnameth']         = $_POST['d_fullnameth'];
                $insert['d_fullnameth']       = $_POST['d_fullnameth'];
                $insert['d_fullnameen']         = $_POST['d_fullnameen'];
                $insert['d_shortnameen']       = $_POST['d_shortnameen'];
                $insert['d_updatedby']         = $sesstion['user_id'];
                $insert['d_updateddate']       = date('Y-m-d H:i:s');
                $insert['d_movement']          = $_POST['editor1'];
                $result = $this->m_dashbord->edit('news_announce', array('d_announceid' => $id), $insert);
                  
                /*---------------------------------------- start insert img ------------------------------------------*/
                $announce_file_path = $this->images_path.$id;

                if (!file_exists($announce_file_path.'/')) {
                    mkdir($announce_file_path, 0775);
                }
                
                if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
                    $this->custom_upload->setConfig(array('upload_path' => $announce_file_path.'/'));
                    //$upload_data = $this->custom_upload->uploadImage('image_file', true, uniqid(), true, 157, 88);
                    $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
                    if(empty($upload_data['file_name'])) {
                        $this->debug($upload_data[0]); exit;
                    }
                    if (isset($upload_data) and $upload_data and $this->data['result']['o_mainimage']) {
                        delete_file($announce_file_path . '/' . $this->data['result']['o_mainimage']);
                    }
                    $imgupload['o_mainimage'] = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
                    $this->m_dashbord->edit('news_announce', array('d_announceid' => $id), array('o_mainimage' => $imgupload['o_mainimage']));
                } 

                /*----------------------------------------- end insert img -------------------------------------------*/ 
                $this->data['result'] = $this->m_dashbord->getDetail('news_announce', array('d_announceid' => $id));
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/lists')), array('name' => 'อ่านข่าวสาร'));
                //print_r($_POST);

                if(isset($_POST['last_page_submit']) && $_POST['last_page_submit'] === "click_last"){
                    redirect(site_url('news_announce/lists'));
                }
                if(isset($_POST['submit_tap']) && $_POST['submit_tap'] != ""){
                    $this->data['check_tap'] = $_POST['submit_tap'];
                }
                $this->view('news_announce/v_detail', $this->data);
            }
        } else {
            
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/lists')), array('name' => 'อ่านข่าวสาร'));
            if($offset_ch != null){
                        $this->data['check_tap'] = "submit_tap2";
           }else{
                $this->data['check_tap'] = "submit_tap1";
           }
//           $this->debug($this->data);
            $this->view('news_announce/v_detail', $this->data);
        }
    }

    public function no_insert(){
        $sesstion = $this->getSesstion();
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_announce/v_form_on_insert', $this->data);
            } else {
//                $insert['o_image']              = $_POST['nc_name'];
//                $insert['o_mainimage']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
//                $insert['d_movement']              = $_POST['nc_name'];
                 
                $insert['d_fullnameth']        = $_POST['d_fullnameth'];
                $insert['d_fullnameth']       = $_POST['d_fullnameth'];
                $insert['d_fullnameen']        = $_POST['d_fullnameen'];
                $insert['d_shortnameen']       = $_POST['d_shortnameen'];
                
                $insert['d_createdby']         = $sesstion['user_id'];
                $insert['d_createddate']       = date('Y-m-d H:i:s');
                $insert['d_updatedby']         = $sesstion['user_id'];
                $insert['d_updateddate']       = date('Y-m-d H:i:s');
                $report_type_id = $this->m_dashbord->add('news_announce', $insert);	
                
                redirect(site_url('news_announce/lists'));
                //print_r($report_type_id);
                //redirect(site_url('news_announce/v_form_on_insert'));
            }
        } else {
            $this->data['title_section'] = 'เพิ่มข่าวสาร';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการประกาศข่าวสาร', 'link' => site_url('news_announce/lists')), array('name' => 'เพิ่มข่าวสาร'));
            $this->view('news_announce/v_form_on_insert', $this->data);
        }
    }

    public function delete($id = '') {
        $this->action_log($this->m_dashbord,'News_dashbord->delete','Delete',$id);
        $this->data['result'] = $this->m_dashbord->delete('news_announce', array('d_announceid' => $id));
        
        $this->debug($this->data);
        //exit();
//        $count_nlo = $this->m_dashbord->getAll('news_link_organization',array('d_announceid' => $id));
//        if($count_nlo >= 1){
//            //echo 'test';
//            $this->action_log($this->m_dashbord,'News_dashbord->delete','Delete(UnSuccess)',$id);
//            redirect(site_url('news_announce/lists/0/'.$id));
//        }else{
//            if (!empty($id) && $this->data['result']){
//                $data = '';
//                $data['d_announceid'] = $id;
//                $this->action_log($this->m_dashbord,'News_dashbord->delete','Delete(Success)',$id);
//                $this->m_dashbord->delete('news_announce',$data);
//                redirect(site_url('news_announce/lists'));
//            }
//        }
        redirect(site_url('news_announce/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('d_fullnameth', 'หัวข้อข่าวสาร', 'required');
    }
    public function search_org_news(){
        //$data_session  = $this->session->all_userdata();
        $this->session->unset_userdata('nd_search_test');
        $this->session->unset_userdata('offset_ck');
        //$data_session  = $this->session->all_userdata();
        //print_r($data_session);
        redirect('news_announce/lists');
    }
}