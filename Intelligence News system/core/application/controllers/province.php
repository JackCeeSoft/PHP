<?php
include(APPPATH . "/core/base_e_army.php");
class Province extends Base_e_army {
    public $createdby;
    public $ug_isadmin;
    public $province_data;
    public $geo_data;


    public function __construct() {
            
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_db');
            $this->get_paramiter();
            $this->data['title_section'] = 'จังหวัด';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการจังหวัด'));
            
        }
        public function get_paramiter(){
            $data_session  = $this->session->all_userdata();
            //print_r($data_session);
            $this->createdby = $data_session['ua_userid'];
            $this->ug_isadmin = $data_session['ug_isadmin'];
            
            $this->province_data = $this->m_db->getAll('province');
            $this->geo_data      = $this->m_db->getAll('geography');
            
        }
        public function changeStatus() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['id']) and $_POST['id']) {
                $result = $this->m_db->getDetail('province', array('province_id' => $_POST['id']));
                
                    if(isset($result['province_show']) and $result['province_show'] == 'Y') {
                        $status = 'N';
                    } else {
                        $status = 'Y';
                    }
                    $this->m_db->edit('province', array('province_id' => $_POST['id']),  array('province_show' => $status));
            } else {
                $status = 'false';
            }
            echo $status;
        }
	public function lists($offset=0,$ua_username = NULL) {
            $where_news_rows = $where = NULL;
            $keyword = '';
            $this->data['lists'] = array();
            $like = NULL;
            $limit = 10;
            
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Province->lists','View',$sesstion['user_id']);
            //print_r($_GET);
            
            if(isset($_GET['g_search'])){
                $keyword = trim($_GET['g_search']);
            }
                if($keyword != ""){
                    $this->data['keyword'] = $keyword;
                    $like['province_name'] = $keyword;
                }
                if(isset($_GET['geo_id']) && $_GET['geo_id'] != "" && $_GET['geo_id'] != 0){
                    $this->data['geo_id'] = $_GET['geo_id'];
                    $where['geo_id'] = $_GET['geo_id'];
                }
                if(isset($_GET['province_show']) &&$_GET['province_show'] != "" && $_GET['province_show'] != 0){
                    $this->data['province_show'] = $_GET['province_show'];
                    $where['province_show'] = $_GET['province_show'];
                }  
            
            
            $this->data['province'] = $this->province_data;
            $this->data['geo_data'] = $this->geo_data;
            $this->data['lists'] = $this->m_db->getAll('province', $where, $like, 'province_show desc', $limit, $offset);
        //}
            $this->data['offest'] = $offset;
            $config['base_url'] = base_url() . 'province/lists';
            $config['uri_segment'] = 4;
            $config['num_links'] = 5;
            $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('province', $where, $like);
            $config['per_page'] = $limit;
            $config['cur_page'] = $this->data['offset'] = $offset + 1;
            $this->pagination->initialize($config);   
            $this->data['total_news_rows'] = $this->m_db->getCountAll('province');  
            
            $this->view('province/v_lists', $this->data);
	}
        public function add(){
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Province->add','Add',$sesstion['user_id']);
            $this->data['title_section'] = 'จังหวัด';
            $this->data['breadcrumb'] = array(array('name' => 'Main', 'link' => site_url('')),array('name' => 'รายชื่อจังหวัด', 'link' => site_url('province/lists')), array('name' => 'เพิ่มจังหวัด'));
            $this->data['province'] = $this->province_data;
		if(!empty($_POST)){
		$check = 0;

                    $_POST['pt_createdby'] = $this->createdby;
                    $_POST['pt_updatedby'] = $this->createdby;
                    foreach ($_POST as $key => $values){
                        if($values != ''){
                            $insert_data[$key] = $values;
                        }
                    }
                    $id_pro =  $this->m_db->add('province',$insert_data);
                    $this->action_log($this->m_db,'Province->add','Add(Success)',$id_pro);
                    
                    redirect('province/lists');
            }else{
                $this->action_log($this->m_db,'Province->add','Add(UnSuccess)',$sesstion['user_id']);
                $this->view('province/v_from', $this->data);
            }
        }
        public function edit($id = null){
            $this->data['title_section'] = 'จังหวัด';
            $this->action_log($this->m_db,'Province->edit','Edit',$id);
            $this->data['breadcrumb'] = array(array('name' => 'Main', 'link' => site_url('')),array('name' => 'รายการจังหวัด', 'link' => site_url('province/lists')), array('name' => 'Edit จังหวัด'));
            $this->data['province'] = $this->province_data;
            if(!isset($_POST['pt_name'])){
                if($id == null){
                    $this->action_log($this->m_db,'Province->edit','Edit(UnSuccess)',$id);
                    redirect('province/lists');
                }
                $data['pt_province_id'] = $id;
                $this->data['result'] = $this->m_db->getDetail('province',$data);
                
                $this->view('province/v_from', $this->data);
            }else{
                 $data['pt_province_id'] = $id;
                 $_POST['at_updatedby'] = $this->createdby;
                 $_POST['at_updateddate'] = date('Y-m-d H:i:s');
                 
                 foreach ($_POST as $key => $values){
                        if($values != ''){
                            $insert_data[$key] = $values;
                        }
                    }
                 
                 $this->data['detail'] = $this->m_db->edit('province',$data,$insert_data);
                 $this->action_log($this->m_db,'Province->edit','Edit(Success)',$id);
                 redirect('province/lists');
            }
        }
        public function delete($id = NULL){
             $this->action_log($this->m_db,'Province->delete','Delete',$id);
             if($id != null){
                 $data['pt_province_id'] = $id;
                 $this->m_db->delete('province',$data);
                 $this->action_log($this->m_db,'Province->delete','Delete(Success)',$id);
             }else{
                 $this->action_log($this->m_db,'Province->delete','Delete(UnSuccess)',$id);
             }
             redirect('province/lists');
        }  
}
