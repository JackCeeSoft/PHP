<?php
include(APPPATH . "/core/base_e_army.php");
class Unit_sub extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_db');
            $this->data['title_section'] = 'หน่วยงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'หน่วยงาน'));
            
        }
	public function lists($offset = 0,$unit_name = NULL) {
            //print_r($_POST);
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Unit_sub->lists','View',$sesstion['user_id']);
        
        $where_news_rows['u_unitid'] = $where['u_unitid'] = $sesstion['user_id'];
        
        $where = NULL;
        $like = NULL;
        
        $limit = 10;
        $this->data['unit'] = $this->m_db->getAll('unit');
        $this->data['us_search'] = "";
        $u_unitid_check = "";
        
//        if(isset($_GET['u_unitid']) && $_GET['u_unitid'] != 0){
//            $where['u_unitid'] = $_GET['u_unitid'];
//            $u_unitid_check = "get";
//            $this->data['u_unitid'] = $_GET['u_unitid'];
//        }
        
        if(isset($_GET['u_unitid'])){
            $u_unitid_check = "get";
            if($_GET['u_unitid'] == 0){
                 $where_news_rows = $where = NULL;
             }else{
                 $where_report_rows['u_unitid'] = $where['u_unitid'] = $_GET['u_unitid'];
                 $this->data['u_unitid'] = $_GET['u_unitid'];
             }
        }else{
            if($sesstion['base_u_unitid'] == 0){
                 $where_report_rows = $where = NULL;
            }else{
                 $this->data['u_unitid'] = $where_report_rows['u_unitid'] = $where['u_unitid'] = "5";
            }
        }
        
        if(isset($_GET['us_search']) || $u_unitid_check == "get"){
            $us_search = trim($_GET['us_search']);
            if($us_search != ""){
                $word = explode(' ', $us_search);
                
                foreach ($word as $key => $values){
                    $like[$key]['s_name'] =  $values;
                }
                //print_r($like);
                $this->data['us_search'] = $us_search;
                $this->data['lists'] = $this->m_db->getAll('unit_sub', $where, $like, 's_seq', $limit, $offset);
                $this->data['total_rows'] = $this->m_db->getCountAll('unit_sub', $where, $like);
            }else{
                $this->data['lists'] = $this->m_db->getAll('unit_sub', $where, $like, 's_seq', $limit, $offset);
                $this->data['total_rows'] = $this->m_db->getCountAll('unit_sub', $where, $like);
            }
        }else{
            $this->data['lists'] = $this->m_db->getAll('unit_sub', $where, $like, 's_seq', $limit, $offset);
            $this->data['total_rows'] = $this->m_db->getCountAll('unit_sub', $where, $like);
        }
        
            $this->data['lists'] = $this->m_db->getAll('unit_sub', $where, $like, 's_seq', $limit, $offset);
            $this->data['offest'] = $offset;
            $config['base_url'] = base_url() . 'unit_sub/lists';
            $config['uri_segment'] = 4;
            $config['num_links'] = 5;
            $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('unit_sub', $where, $like);
            $config['per_page'] = $limit;
            $config['cur_page'] = $this->data['offset'] = $offset + 1;
            $this->pagination->initialize($config);   
            $this->data['total_news_rows'] = $this->m_db->getCountAll('unit_sub', $where_news_rows);    
            $this->data['username_already_exsit'] = $unit_name;
            $this->view('unit_sub/v_unit', $this->data);
	}
        public function add(){
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Unit_sub->add','Add',$sesstion['user_id']);
            
            $this->data['title_section'] = 'หน่วยงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อหน่วยงาน', 'link' => site_url('unit_sub/lists')), array('name' => 'เพิ่มหน่วยงาน'));
            $this->data['unit'] = $this->m_db->getAll('unit');
            //print_r($this->data['unit']);
            if(!empty($_POST)){
                //$check = 0;
                $_POST['s_createddate'] = date('Y-m-d H:i:s');
                $_POST['s_updateddate'] = date('Y-m-d H:i:s');
                $_POST['s_createdby'] = $sesstion['user_id'];
                $_POST['s_updatedby'] = $sesstion['user_id'];
                
                $where['u_unitid'] = $sesstion['unitid'];
                $data_unit = $this->m_db->getAll('unit_sub',$where);
                foreach ($data_unit as $valuse){
                    if($valuse['s_name'] == $_POST['s_name']){
                        $check = 1;
                    }
                }
                if(isset($check) || $check === 1){
                    redirect('unit_sub/lists/0/'.$_POST['s_name']);
                }else{
                    $_POST['s_name'] = trim($_POST['s_name']);
                    foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                    $id_unit_sub = $this->m_db->add('unit_sub',$insert_data);
                    $this->action_log($this->m_db,'Unit_sub->add','Add(Success)',$id_unit_sub);
                   redirect('unit_sub/lists');
                }
            }else{
                $this->action_log($this->m_db,'Unit_sub->add','Add(UnSuccess)',$sesstion['user_id']);
                $this->view('unit_sub/v_unit_add', $this->data);
            }
                
        }
        public function edit($id = null){
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Unit_sub->edit','Edit',$id);
            $this->data['title_section'] = 'หน่วยงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อหน่วยงาน', 'link' => site_url('unit_sub/lists')), array('name' => 'แก้ไขหน่วยงาน'));
            $this->data['unit'] = $this->m_db->getAll('unit');
            
            if(isset($_POST['s_unitsub_id'])){
                $_POST['s_createddate'] = date('Y-m-d H:i:s');
                $_POST['s_updateddate'] = date('Y-m-d H:i:s');
                $_POST['s_createdby'] = $sesstion['user_id'];
                $_POST['s_updatedby'] = $sesstion['user_id'];
                
                 $data['s_unitsub_id'] = $_POST['s_unitsub_id'];
                 
                 foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                 
                 
                 $this->data['detail'] = $this->m_db->edit('unit_sub',$data,$insert_data);
                 $this->action_log($this->m_db,'Unit_sub->edit','Edit(Success)',$id);
                 //print_r($this->data);
                 //exit();
                 redirect('unit_sub/lists');
             }else{
                 if($id != null){
                    $data['s_unitsub_id'] = $id;
                    $this->data['detail'] = $this->m_db->getDetail('unit_sub',$data);
                    $this->view('unit_sub/v_unit_edit', $this->data);
                }else{
                    $this->action_log($this->m_db,'Unit_sub->edit','Edit(UnSuccess)',$id);
                    redirect('unit_sub/lists');
                }
                
             }
        }
        public function detail($id = null){
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Unit_sub->detail','View',$id);
            
            $this->data['title_section'] = 'หน่วยงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อหน่วยงาน', 'link' => site_url('unit_sub/lists')), array('name' => 'รายละเอียดหน่วยงาน'));
            $this->data['unit'] = $this->m_db->getAll('unit');
            if($id != null){
                 $data['s_unitsub_id'] = $id;
                 $this->data['detail'] = $this->m_db->getDetail('unit_sub',$data);
             }
             $this->view('unit_sub/v_unit_detail', $this->data);
        }
        public function delete($id = NULL){
            $this->action_log($this->m_db,'Unit_sub->delete','Delete',$id);
             if($id != null){
                 $data['s_unitsub_id'] = $id;
                 $this->m_db->delete('unit_sub',$data);
                 $this->action_log($this->m_db,'Unit_sub->delete','Delete(Success)',$id);
             }else{
                 $this->action_log($this->m_db,'Unit_sub->delete','Delete(UnSuccess)',$id);
             }
             redirect('unit_sub/lists');
        }  
}
