<?php
include(APPPATH . "/core/base_e_army.php");
class Unit extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_unit');
            $this->data['title_section'] = 'ระบบงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อระบบงาน'));
            
        }
	public function lists($offset = 0,$unit_name = NULL) {
            //print_r($_POST);
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_unit,'Unit->lists','View',$sesstion['user_id']);   
        
        $where_news_rows['u_unitid'] = $where['u_unitid'] = 1;
        $where = NULL;
        $like = NULL;
        $limit = 10;
        $this->data['g_search'] = "";
        if(isset($_GET['g_search'])){
            $g_search = trim($_GET['g_search']);
            if($g_search != ""){
                $word = explode(' ', $g_search);
                
                foreach ($word as $key => $values){
                    $like[$key]['u_name'] =  $values;
                }
                //print_r($like);
                $this->data['g_search'] = $g_search;
                $this->data['lists'] = $this->m_unit->getAll('unit', $where, $like, 'u_updateddate desc', $limit, $offset);
                $this->data['total_rows'] = $this->m_unit->getCountAll('unit', $where, $like);
            }else{
                $this->data['lists'] = $this->m_unit->getAll('unit', $where, $like, 'u_updateddate desc', $limit, $offset);
                $this->data['total_rows'] = $this->m_unit->getCountAll('unit', $where, $like);
            }
        }else{
            $this->data['lists'] = $this->m_unit->getAll('unit', $where, $like, 'u_updateddate desc', $limit, $offset);
            $this->data['total_rows'] = $this->m_unit->getCountAll('unit', $where, $like);
        }
 
        
        
        $this->data['offest'] = $offset;
        $config['base_url'] = base_url() . 'unit/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] ;
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);   
        $this->data['total_news_rows'] = $this->m_unit->getCountAll('unit', $where_news_rows);  
        
        $this->data['username_already_exsit'] = $unit_name;
        $this->view('unit/v_unit', $this->data);
	}
        public function add(){
            $this->data['title_section'] = 'ระบบงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อระบบงาน', 'link' => site_url('unit/lists')), array('name' => 'เพื่อระบบงาน'));
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_unit,'Unit->lists','Add',$sesstion['user_id']);
            
            if(!empty($_POST)){
               
                $_POST['u_updateddate'] = date('Y-m-d H:i:s');
                $_POST['u_createdby'] = $sesstion['user_id'];
                $_POST['u_updatedby'] = $sesstion['user_id'];
                $data_unit = $this->m_unit->getAll('unit');
                
                
                foreach ($data_unit as $valuse){
                    if($valuse['u_name'] == $_POST['u_name']){
                        $check = 1;
                    }
                }
                if(isset($check) || $check === 1){
                    redirect('unit/lists/0/'.$_POST['u_name']);
                }else{
                    $_POST['u_name'] = trim($_POST['u_name']);
                    
                    foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                    $id_unit = $this->m_unit->add('unit',$insert_data);
                    $this->action_log($this->m_unit,'Unit->lists','Add(Success)',$id_unit);
                   redirect('unit/lists');
                }
            }else{
                $this->action_log($this->m_unit,'Unit->lists','Add(UnSuccess)',$sesstion['user_id']);
                $this->view('unit/v_unit_add', $this->data);
            }
                
        }
        public function edit($id = null){
            $this->data['title_section'] = 'ระบบงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อระบบงาน', 'link' => site_url('unit/lists')), array('name' => 'แก้ไขระบบงาน'));
            $sesstion = $this->getSesstion();
            if($id != null && isset($_POST['u_unitid']) && $_POST['u_unitid'] == $id){
                 $data['u_unitid'] = $id;
                $_POST['u_updateddate'] = date('Y-m-d H:i:s');
                $_POST['u_updatedby'] = $sesstion['user_id'];
                
                foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                
                 $this->data['detail'] = $this->m_unit->edit('unit',$data,$insert_data);
                 redirect('unit/lists');
             }else{
                 if($id != null){
                    $data['u_unitid'] = $id;
                    $this->data['detail'] = $this->m_unit->getDetail('unit',$data);
                }
                $this->view('unit/v_unit_edit', $this->data);
             }
        }
        public function detail($id = null){
            $this->data['title_section'] = 'ระบบงาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อระบบงาน', 'link' => site_url('unit/lists')), array('name' => 'รายละเอียดระบบงาน'));
           
            if($id != null){
                 $data['u_unitid'] = $id;
                 $this->data['detail'] = $this->m_unit->getDetail('unit',$data);
             }
             $this->view('unit/v_unit_detail', $this->data);
        }
        public function delete($id = NULL){
             if($id != null){
                 $data['u_unitid'] = $id;
                 $this->m_unit->delete('unit',$data);
             }
             redirect('unit/lists');
        }  
}
