<?php
include(APPPATH . "/core/base_e_army.php");
class User extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_user');
            $this->data['title_section'] = 'ผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อผู้ใช้งาน'));
            
        }
	public function lists($offset=0,$ua_username = NULL) {
            $sesstion = $this->getSesstion();
            //print_r($sesstion);
            $this->action_log($this->m_user,'User->lists','View',$sesstion['user_id']);
            $this->data['unit'] = $this->m_user->getAll('unit', NULL, NULL, 'u_unitid asc');
            $this->data['unit_sub'] = $this->m_user->getAll('unit_sub', NULL, NULL, 's_unitsub_id asc');
            $this->data['user_group'] = $this->m_user->getAll('user_group', NULL, NULL, 'ug_groupid asc');
        
        //$where_news_rows['ua_userid'] = $where['ua_userid'] = 1;

         if($sesstion['base_u_unitid'] == 0){
             $where_news_rows = $where = NULL;
             $this->data['base_unitid'] = 0;
        }else{
             $where_news_rows['u_unitid'] = $where['u_unitid'] = 5;
             $this->data['unit'] = $this->m_user->getAll('unit', $where, NULL, 'u_unitid asc');
             $this->data['unit_sub'] = $this->m_user->getAll('unit_sub', $where, NULL, 's_unitsub_id asc');
             $this->data['user_group'] = $this->m_user->getAll('user_group', NULL, NULL, 'ug_groupid asc');
        }
        //$where = NULL;
        $like = NULL;
 
        $limit = 10;
        if(isset($_GET['u_unitid']) && $_GET['u_unitid']){
                    $where['u_unitid'] = $_GET['u_unitid'];
                    $this->data['u_unitid'] =  $_GET['u_unitid'];
                }
                
        if(isset($_GET['s_unitsub_id']) && $_GET['s_unitsub_id']){
                    $where['s_unitsub_id'] = $_GET['s_unitsub_id'];
                    $this->data['s_unitsub_id'] =  $_GET['s_unitsub_id'];
                }
                
        $this->data['g_search'] = "";
        if(isset($_GET['g_search'])){
            $this->action_log($this->m_user,'User->lists','Search',$sesstion['user_id']);
            $g_search = trim($_GET['g_search']);
            $this->data['keyword'] = $g_search;
            if($g_search != ""){
                $word = explode(' ', $g_search);
                foreach ($word as $key => $values){
                    $like[$key]['ua_username'] =  $values;
                    $like[$key]['ua_firstname'] =  $values;
                    $like[$key]['ua_lastname'] =  $values;
                }
                $this->data['g_search'] = $g_search;
                $this->data['lists'] = $this->m_user->getAll('user_account', $where, $like, 'ua_updateddate desc', $limit, $offset);
            }else{
                $this->data['lists'] = $this->m_user->getAll('user_account', $where, $like, 'ua_updateddate desc', $limit, $offset);
            }
        }else{
            $this->data['lists'] = $this->m_user->getAll('user_account', $where, $like, 'ua_updateddate desc', $limit, $offset);
        }
        $this->data['offest'] = $offset;
        $config['base_url'] = base_url() . 'user/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_user->getCountAll('user_account', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);   
        $this->data['total_news_rows'] = $this->m_user->getCountAll('user_account');  
        
        $this->data['username_already_exsit'] = $ua_username;
        $this->view('user/v_user', $this->data);
	}
        public function add(){
            $where = $like = null;
            $this->data['title_section'] = 'ผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อผู้ใช้งาน', 'link' => site_url('user/lists')), array('name' => 'เพิ่มผู้ใช้งาน'));
            $unit_count = $this->m_user->getCountAll('unit');
            $unit_sub_count = $this->m_user->getCountAll('unit_sub', $where, $like, 's_seq');
            $group_count = $this->m_user->getCountAll('user_group');
            
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_user,'User->add','Add',$sesstion['user_id']);
                if($sesstion['base_u_unitid'] == 0){
                     $where_news_rows = $where = NULL;
                }else{
                     $where_news_rows['u_unitid'] = $where['u_unitid'] = 5;
                }
            
            if($unit_count <= 0 && $group_count <= 0){
                redirect('user/lists');
            }else{
                $this->data['unit'] = $this->m_user->getAll('unit', $where, NULL, 'u_unitid asc');
                //$this->data['unit'] = $this->m_user->getAll('unit');
                $this->data['unit_sub'] = $this->m_user->getAll('unit_sub', $where, NULL, 's_unitsub_id asc');
                $this->data['user_group'] = $this->m_user->getAll('user_group', NULL, NULL, 'ug_groupid asc');
            }
            
		if(!empty($_POST)){
		$check = 0;
                $data_user = $this->m_user->getAll('user_account');
                //print_r($data_user);
                //print_r($_POST);
                foreach ($data_user as $valuse){
                    if($valuse['ua_username'] == $_POST['ua_username']){
                        $check = 1;
                    }
                }
				
                if($check == 1){
                    redirect('user/lists/0/'.$_POST['ua_username']);
                }else{
                    $_POST['ua_username'] = trim($_POST['ua_username']);
                    //$_POST['ua_dbusername'] = strtoupper($_POST['ua_username']);
                    //$_POST['ua_approver'] = "1";
                    //$_POST['ua_approvercode'] = "1234";
                
                    foreach ($_POST as $key => $values){
                        if($values != ''){
                            $insert_data[$key] = $values;
                        }
                    }
                    $id_user = $this->m_user->add('user_account',$insert_data);
                    $this->action_log($this->m_user,'User->add','Add(Success)',$id_user);
                    
                    redirect('user/lists');
                }
            }else{
                $this->action_log($this->m_user,'User->add','Add(UnSuccess)',$sesstion['user_id']);
                $this->view('user/v_user_add', $this->data);
            }
        }
        public function edit($id = null){
            $this->data['title_section'] = 'ผู้ใช้งาน';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อผู้ใช้งาน', 'link' => site_url('user/lists')), array('name' => 'แก้ไขข้อมูลผู้ใช้งาน'));
            
                $this->data['unit'] = $this->m_user->getAll('unit');
                $this->data['user_group'] = $this->m_user->getAll('user_group');
            $this->action_log($this->m_user,'User->edit','Edit',$id);
            
            if(!isset($_POST['ua_userid']) && empty($_POST['ua_userid'])){
                if($id == null){
                    $this->action_log($this->m_user,'User->edit','Edit(UnSuccess)',$id);
                    redirect('user/lists');
                }
                $data['ua_userid'] = $id;
                
                
                $this->data['detail'] = $this->m_user->getDetail('user_account',$data);
                $this->view('user/v_user_edit', $this->data);
            }else{
                 $data['ua_userid'] = $id;
                 
                 foreach ($_POST as $key => $values){
                        if($values != ''){
                            $insert_data[$key] = $values;
                        }
                    }
                 
                 $this->data['detail'] = $this->m_user->edit('user_account',$data,$insert_data);
                 $this->action_log($this->m_user,'User->edit','Edit(Success)',$id);
                 redirect('user/lists');
            }
        }
        public function detail($id = null){
            $this->data['title_section'] = 'ผู้ใช้งาน';
            $this->action_log($this->m_user,'User->detail','View',$id);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'รายชื่อผู้ใช้งาน', 'link' => site_url('user/lists')), array('name' => 'รายละเอียดผู้ใช้งาน'));
            
                $this->data['unit'] = $this->m_user->getAll('unit');
                $this->data['user_group'] = $this->m_user->getAll('user_group');
                
            if($id != null){
                 $data['ua_userid'] = $id;
                 $this->data['detail'] = $this->m_user->getDetail('user_account',$data);
             }
             $this->view('user/v_user_detail', $this->data);
        }
        public function Edit_profile($id = null){
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_user,'User->Edit_profile','Edit',$id);
            $this->data['title_section'] = 'ข้อมูลส่วนบุคคล';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'แก้ไขข้อมูลส่วนบุคคล'));
            
                $this->data['unit'] = $this->m_user->getAll('unit', NULL, NULL, 'u_unitid asc');
                $this->data['unit_sub'] = $this->m_user->getAll('unit_sub', NULL, NULL, 's_unitsub_id asc');
                $this->data['user_group'] = $this->m_user->getAll('user_group');
                
                //print_r($sesstion);
                if($id != $sesstion['user_id']){
                    $this->action_log($this->m_user,'User->Edit_profile','Edit(UnSuccess)',$id);
                    redirect('mainpage');
                }else{
                    
                }
            
            if(!isset($_POST['ua_userid']) && empty($_POST['ua_userid'])){
                if($id == null){
                    $this->action_log($this->m_user,'User->Edit_profile','Edit(UnSuccess)',$id);
                    redirect('mainpage');
                }
                $data['ua_userid'] = $id;
                $this->data['detail'] = $this->m_user->getDetail('user_account',$data);
                $this->data['detail']['u_unitid'] = '5';
                $this->view('user/v_user_edit_profile', $this->data);
            }else{
                 $data['ua_userid'] = $id;
                 $this->data['detail'] = $this->m_user->edit('user_account',$data,$_POST);
                 $this->action_log($this->m_user,'User->Edit_profile','Edit(Success)',$id);
                 redirect('mainpage');
            }
        }
        public function check_user(){
            //print_r($_POST['username']);
            $data['ua_username'] = $_POST['username'];
            $data_result = $this->m_user->getDetail('user_account',$data);
            
            if($data_result == ""){
                echo '1';
            }else{
                echo '0';
            }
        }

        public function first_unitid_all(){
            
            //print_r($_POST);
            $sesstion = $this->getSesstion();
            //$s_unitsub_id = $_POST['s_unitsub_id'];
            $s_unitsub_id = 0;
            $u_unitid = $_POST['u_unitid'];
            $data['u_unitid'] = $u_unitid;
            $data_result = $this->m_user->getAll('unit_sub',$data);
            //$data_all = $this->m_user->getAll('unit_sub');
            //print_r($data_all);
            //print_r($data_result);
            
            if($data_result != ""){
                if($sesstion['isadmin'] != "Y"){
                    echo '<option value="0"> ทุกหน่วยงาน </option>';
                    foreach ($data_result as $key=>$values){
                       if($values['s_unitsub_id'] == 0 &&  $values['s_unitsub_id'] != $s_unitsub_id){
                           
                       }else{
                           
                           echo '<option value="'.$values['s_unitsub_id'].'"';
                           if($values['s_unitsub_id'] == $s_unitsub_id){
                               echo "selected";
                           }else{
                               echo "";
                           }
                           echo '>'.$values['s_name'].'</option>';
                       }
                    }
                }else{
                    echo '<option value="0"> ทุกหน่วยงาน </option>';
                    foreach ($data_result as $key=>$values){
                       echo '<option value="'.$values['s_unitsub_id'].'"';
                       if($values['s_unitsub_id'] == $s_unitsub_id){
                           echo "selected";
                       }else{
                           echo "";
                       }
                       echo '>'.$values['s_name'].'</option>';
                    }
                }
            }else{
                echo '';
            }
        }
        public function first_unitid(){
            
            //print_r($_POST);
            $sesstion = $this->getSesstion();
            $s_unitsub_id = $_POST['s_unitsub_id'];
            //$s_unitsub_id = 32;
            $u_unitid = $_POST['u_unitid'];
            $data['u_unitid'] = $u_unitid;
            $data_result = $this->m_user->getAll('unit_sub',$data);
            //$data_all = $this->m_user->getAll('unit_sub');
            //print_r($data_all);
            //print_r($data_result);
            
            if($data_result != ""){
            if($sesstion['isadmin'] != "Y"){
                    foreach ($data_result as $key=>$values){
                       if($values['s_unitsub_id'] != $s_unitsub_id){
                           
                       }else{
                           echo '<option value="'.$values['s_unitsub_id'].'"';
                           if($values['s_unitsub_id'] == $s_unitsub_id){
                               echo "selected";
                           }else{
                               echo "";
                           }
                           echo '>'.$values['s_name'].'</option>';
                       }
                    }
                }else{
                    echo '<option value="0"> ทุกหน่วยงาน </option>';
                    foreach ($data_result as $key=>$values){
                       echo '<option value="'.$values['s_unitsub_id'].'"';
                       if($values['s_unitsub_id'] == $s_unitsub_id){
                           echo "selected";
                       }else{
                           echo "";
                       }
                       echo '>'.$values['s_name'].'</option>';
                    }
                } 
            }else{
                echo '<option value="0"> ทุกหน่วยงาน </option>';
            }
        }
//        public function check_unitid(){
//            //print_r($_POST['username']);
//            $like = null;
//            $data['u_unitid'] = $_POST['u_unitid'];
//            $data_result = $this->m_user->getAll('unit_sub',$data,$like,'s_seq');
//            //print_r($data_result);
//            if($data_result != ""){
//                   echo '<option value="0"> ทุกหน่วยงาน </option>';
//                foreach ($data_result as $key=>$values){
//                   echo '<option value="'.$values['s_unitsub_id'].'">'.$values['s_name'].'</option>';
//                }
//            }else{
//                echo '';
//            }
//        }
        public function check_unitid(){
            //print_r($_POST);
            //u_unitid
            //s_unitsub_id
            $like = null;
            $data['u_unitid'] = $_POST['u_unitid'];
            $data_result = $this->m_user->getAll('unit_sub',$data,$like,'s_seq');
            //print_r($data_result);
            if($data_result != ""){
                   echo '<option value="0"> สังกัดทุกหน่วยงาน </option>';
                foreach ($data_result as $key=>$values){
                   $select = "";
                    if(isset($_POST['s_unitsub_id']) and $_POST['s_unitsub_id']){
                        if($_POST['s_unitsub_id'] == $values['s_unitsub_id']){
                            $select = "selected";
                        }
                    }
                
                    echo '<option value="'.$values['s_unitsub_id'].'"'.$select.' >'.$values['s_name'].'</option>';
                }
            }else{
                echo '';
            }
        }
        public function delete($id = NULL){
            $this->action_log($this->m_user,'User->delete','Delete',$id);
             if($id != null){
                 $data['ua_userid'] = $id;
                 $this->action_log($this->m_user,'User->delete','Delete(Success)',$id);
                 $this->m_user->delete('user_account',$data);
             }else{
                 $this->action_log($this->m_user,'User->delete','Delete(UnSuccess)',$id);
             }
             redirect('user/lists');
        }  
}
