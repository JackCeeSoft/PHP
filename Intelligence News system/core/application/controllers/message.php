<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");
class Message extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_db');
            //$this->load->model('m_notification');
        }
	public function index() {
            $lists = array();
            $where = null;
            $sesstion = $this->getSesstion();
            $this->action_log($this->m_db,'Message->lists','View',$sesstion['user_id']);
            $this->data['title_section'] = 'ส่งข้อความถึงผู้ดูแลระบบ';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการสนทนา'));
            
            $order_by = "ua_userid_ans,c_updateddate desc";
            if($sesstion['base_u_unitid'] == 0){
                
            }else{
                $where['u_unitid'] = $sesstion['unitid'];
            }
            $result_chat = $this->m_db->getAll('chat_message',$where,null,$order_by);
            
            $update_data = array();
            $update_data['c_noti'] = 'Y';
            $where_edit['c_updatedby'] = $sesstion['unitid'];
            $this->m_db->edit('chat_message',$where_edit,$update_data);
            //$ua_userid_ans = array_unique($result_chat);
            //$result_account = $this->m_db->getDetail('user_account',$where);
            if($result_chat){
                foreach ($result_chat as $k_rc => $v_rc){
                    $where['ua_userid'] = $v_rc['ua_userid_ans'];
                    $data = $this->m_db->getDetail('user_account',$where);
                    
                    //$where_count['ua_userid_ans'] = $v_rc['ua_userid_ans'];
                    $where_count['c_noti'] = 'N';
                    
                    //$message_count = $this->m_notification->get_chat_noti($where_count,null);
                    $message_data  = $this->m_db->getAll('chat_message',$where_count);

                    array_push($result_chat[$k_rc],$data['ua_firstname']." ".$data['ua_lastname']);
                }
                
                $defult_id = 0;
                foreach ($result_chat as $k_rc2 => $v_rc2){
                    $id = $v_rc2['ua_userid_ans'];
                    if($defult_id == $id){

                    }else{
                        $lists[] = $result_chat[$k_rc2];
                        $defult_id = $id;
                    }
                }
            }

            if(isset($message_data) && $message_data){
                $count_message = 0;
                foreach($message_data as $k_md => $v_md){
                    foreach ($lists as $k_l => $v_l){
                        if($v_md['ua_userid_ans'] == $v_l['ua_userid_ans']){
                            $count_message++; 
                            $lists[$k_l]['count_message'] = $count_message;
                        }
                    }
                }
            }
            
            
            $this->data['lists'] = $lists;
            
            $this->data['user_id'] = $sesstion['user_id'];
            //$this->debug($message_data);
            //$this->debug($lists);
            $this->view('message/v_lists', $this->data);
	}
        public function chat($room_id = null){
            $sesstion = $this->getSesstion();
            if(isset($room_id) && $room_id){
                $count = array(
                        'room_id' => $room_id
                    );
                $this->session->set_userdata($count);
                
                $update_data['c_noti'] = 'Y';
                $where_edit['c_updatedby'] = $room_id;
                
                $all_chat_message = $this->m_db->getAll('chat_message',$where_edit);
                
                if($all_chat_message){
                    $this->m_db->edit('chat_message',$where_edit,$update_data);
                }else{
                    //$this->debug($all_chat_message);
                }
            }
            $data_session  = $this->session->all_userdata();
            $this->action_log($this->m_db,'Message->insert','Add',$sesstion['user_id']);
            $this->data['title_section'] = 'ส่งข้อความถึงผู้ดูแลระบบ';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')),array('name' => 'เพิ่มบทสนทนา'));
            $this->data['sesstion'] = $sesstion;
            $this->data['data_session'] = $data_session;
            $update_data['c_noti'] = 'Y';
            $where_edit['c_updatedby !='] = $sesstion['unitid'];
            $this->m_db->edit('chat_message',$where_edit,$update_data);
            //$this->debug($data_session);
            $this->view('message/v_form', $this->data);
        }
        
        public function save_chat(){
            $return = "error";
            $_POST['text'] = trim($_POST['text']);
            if(isset($_POST['text']) && $_POST['text']){
                $sesstion = $this->getSesstion();
                $data_session  = $this->session->all_userdata();
                $where_userid['ua_userid'] = $sesstion['user_id'];
                $user_data = $this->m_db->getAll('user_account',$where_userid);
                //print_r($user_data);
                $data['c_message'] = $user_data[0]['ua_firstname']." : ".$_POST['text'];
                
                $data['ua_userid'] = $sesstion['user_id'];
                if(isset($data_session['room_id']) && $data_session['room_id']){
                    $data['ua_userid_ans'] = $data_session['room_id'];
                }else{
                    $data['ua_userid_ans'] = $sesstion['user_id'];
                }

                $data['u_unitid']   = $sesstion['unitid'];
                $data['c_createdby']   = $sesstion['user_id'];
                $data['c_updatedby']   = $sesstion['user_id'];
                $data['c_noti'] = 'N';
                $return = $this->m_db->add('chat_message',$data,$_POST);
                //echo "Save";
            }
            
            if($return == "error"){
                echo "Can't not Save";
            }else{
                echo $return;
            }
            
            
        }
        public function get_chat(){
            
            if(isset($_POST['id_rq']) && $_POST['id_rq']){
                
                $where['ua_userid_ans'] = $_POST['id_rq'];
                //sleep(0.5);
                $order_by = "ua_userid_ans,c_updateddate asc";
                $return = $this->m_db->getAll('chat_message',$where,null,$order_by);
                //$this->debug($return);
                //print_r($return);
                if($return){
                    foreach ($return as $k_re => $v_re){
                        if($v_re['ua_userid'] == $_POST['id_rq']){
                            echo ''
                            . '<li class="out">'
                                . '<div class="message">'
                                    . '<span class="arrow"> </span>'
                                    . '<p id="rq" class="">'.substr($v_re['c_createddate'], 0,-4).'</p>'
                                    . '<p id="rq" class="name">'.$v_re['c_message'].'</p>'
                                . '</div>'
                            . '</li>';
                        }else{
                            echo ''
                            . '<li class="in">'
                                . '<div class="message">'
                                    . '<span class="arrow"> </span>'
                                    . '<p id="rq" class="">'.substr($v_re['c_createddate'], 0,-4).'</p>'
                                    . '<p id="rq" class="name">'.$v_re['c_message'].'</p>'
                                . '</div>'
                            . '</li>';
                        }
                    }
                }else{
                    echo ''
                        . '<li class="out">'
                                . '<div class="message">'
                                    . '<span class="arrow"> </span>'
                                    . '<span id="rq" class="name">ไม่มีข้อมูล</span>'
                                . '</div>'
                        . '</li>'
                        . '<li class="in">'
                                . '<div class="message">'
                                    . '<span class="arrow"> </span>'
                                    . '<span id="res" class="name">ไม่มีข้อมูล</span>'
                                . '</div>'
                        . '</li>';
                }
            }else{
                echo "Can't get Save";
            }
                    
            
        }
}
