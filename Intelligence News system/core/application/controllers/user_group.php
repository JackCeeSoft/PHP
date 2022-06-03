<?php
include(APPPATH . "/core/base_e_army.php");
class User_group extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_user_group');
            $this->data['title_section'] = 'กลุ่มผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'เพิ่มกลุ่มผู้ใช้งาน'));
        }
	public function lists($offset=0,$user_group = NULL) {
        $sesstion = $this->getSesstion();
        $where_news_rows['ug_groupid'] = $where['ug_groupid'] = 1;
        $where = NULL;
        $like = NULL;
        $this->action_log($this->m_user_group,'User_group->lists','View',$sesstion['user_id']); 
        
        $limit = 10;
        $this->data['lists'] = $this->m_user_group->getAll('user_group', $where, $like, 'ug_updateddate desc', $limit, $offset);
        $this->data['offest'] = $offset;
        $config['base_url'] = base_url() . 'user_group/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_user_group->getCountAll('user_group', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);   
        $this->data['username_already_exsit'] = $user_group;
        $this->data['total_news_rows'] = $this->m_user_group->getCountAll('user_group');  
            
           $this->view('user_group/v_user_group', $this->data);
	}
        public function add(){
            $this->data['title_section'] = 'กลุ่มผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อกลุ่มผู้ใช้งาน', 'link' => site_url('user_group/lists')), array('name' => 'เพิ่มกลุ่มผู้ใช้งาน'));
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_user_group,'User_group->add','Add',$sesstion['user_id']);
            
			if(!empty($_POST)){
				$check = 0;
                $data_user_group = $this->m_user_group->getAll('user_group');
                foreach ($data_user_group as $valuse){
                    if($valuse['ug_groupname'] == $_POST['ug_groupname']){
                        $check = 1;
                    }
                }
                if($check == 1){
                    redirect('user_group/lists/0/'.$_POST['ug_groupname']);
                }else{
                    $_POST['ug_groupname'] = trim($_POST['ug_groupname']);
                    foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                    $id_user = $this->m_user_group->add('user_group',$insert_data);
                    $this->action_log($this->m_user_group,'User_group->add','Add(Success)',$id_user);
                   redirect('user_group/lists');
                }
            }else{
                $this->action_log($this->m_user_group,'User_group->add','Add(UnSuccess)',$sesstion['user_id']);
                $this->view('user_group/v_user_group_add', $this->data);
            }
        }
        public function edit($id = null){
            $this->data['title_section'] = 'กลุ่มผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อกลุ่มผู้ใช้งาน', 'link' => site_url('user_group/lists')), array('name' => 'แก้ไขรายชื่อกลุ่มผู้ใช้งาน'));
            $this->action_log($this->m_user_group,'User_group->edit','Edit',$id);
            
            if($id != null && isset($_POST['ug_groupid']) && $_POST['ug_groupid'] == $id){
                 $data['ug_groupid'] = $id;
                 
                 foreach ($_POST as $key => $values){
                        if(!empty($values)){
                            $insert_data[$key] = $values;
                        }
                    }
                 $this->data['detail'] = $this->m_user_group->edit('user_group',$data,$insert_data);
                 $this->action_log($this->m_user_group,'User_group->edit','Edit(Success)',$id);
                 redirect('user_group/lists');
             }else{
                 if($id != null){
                    $data['ug_groupid'] = $id;
                    $this->data['detail'] = $this->m_user_group->getDetail('user_group',$data);
                }else{
                    $this->action_log($this->m_user_group,'User_group->edit','Edit(UnSuccess)',null);
                }
                $this->view('user_group/v_user_group_edit', $this->data);
             }
        }
        public function detail($id = null){
            $this->data['title_section'] = 'กลุ่มผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อกลุ่มผู้ใช้งาน', 'link' => site_url('user_group/lists')), array('name' => 'รายละเอียดกลุ่มผู้ใช้งาน'));
            $this->action_log($this->m_user_group,'User_group->detail','View',$id);
            
            if($id != null){
                 $data['ug_groupid'] = $id;
                 $this->data['detail'] = $this->m_user_group->getDetail('user_group',$data);
                 
                 $where_created['ua_userid'] = $this->data['detail']['ug_createdby'];
                 $where_updated['ua_userid'] = $this->data['detail']['ug_updatedby'];
                 
                 $user_created = $this->m_user_group->getDetail('user_account',$where_created);
                 $user_updated = $this->m_user_group->getDetail('user_account',$where_updated);
                 
                    if(isset($user_created['ua_username']) && $user_created['ua_username'] != ""){
                        $this->data['detail']['ug_createdby'] = $user_created['ua_username'];
                    }else{
                        $this->data['detail']['ug_createdby'] = "ไม่มี User นี้ในระบบ";
                    }
                    if(isset($user_updated['ua_username']) && $user_updated['ua_username'] != ""){
                        $this->data['detail']['ug_updatedby'] = $user_updated['ua_username'];
                    }else{
                        $this->data['detail']['ug_updatedby'] = "ไม่มี User นี้ในระบบ";
                    }
             }
             $this->view('user_group/v_user_group_detail', $this->data);
        }
        public function delete($id = NULL){
            $this->action_log($this->m_user_group,'User_group->delete','Delete',$id);
             if($id != null){
                 $data['ug_groupid'] = $id;
                 $this->m_user_group->delete('user_group',$data);
                 $this->action_log($this->m_user_group,'User_group->delete','Delete(Success)',$id);
             }else{
                 $this->action_log($this->m_user_group,'User_group->delete','Delete(UnSuccess)',$id);
             }
             redirect('user_group/lists');
        }  
}
