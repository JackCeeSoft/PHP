<?php
include(APPPATH . "/core/base_e_army_login.php");

class Check_login extends Base_e_army_login {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
             $this->load->model('m_check_login');
            
        }
	public function index() {
            
            if(isset($_POST['ua_username']) && $_POST['ua_username'] != "" && $_POST['ua_password'] != ""){
                
                $data_check['ua_username'] = $_POST['ua_username'];
                $data_check['ua_password'] = $_POST['ua_password'];
                
                $data = $this->m_check_login->getAll('user_account',$data_check);
                
                if(empty($data)){
                    $return['data'] = "F";
                    $this->view('check_login/v_login',$return);
                }
                else {
                    //print_r($_POST);
                    if (isset($_POST['rememberme'])) {
                        /* Set cookie to last 1 year */
                        setcookie('username', $_POST['ua_username'], time()+60*60*24*365, '/', base_url());
                        setcookie('password', $_POST['ua_password'], time()+60*60*24*365, '/', base_url());
        
                    } else {
                        /* Cookie expires when browser closes */
                        setcookie('username', $_POST['ua_username'], false, '/', base_url());
                        setcookie('password', $_POST['ua_password'], false, '/', base_url());
                    }
                    
                    
                    //if login pass
                    $data_query['ug_groupid'] = $data[0]['ug_groupid'];
                    $data_user_group = $this->m_check_login->getAll('user_group',$data_query);
                    //print_r($data_user_group);
                    //exit();
                    $newdata = array(
                        'ua_userid' => $data[0]['ua_userid'],
                        'ua_firstname'  => $data[0]['ua_firstname'],
                        'ua_lastname'     => $data[0]['ua_lastname'],
                        'u_unitid' => $data[0]['u_unitid'],
                        'ug_isadmin' => $data_user_group[0]['ug_isadmin'],
                        'ug_groupid' => $data[0]['ug_groupid'],
                        's_unitsub_id' => $data[0]['s_unitsub_id'],
                        'ug_canread' => $data_user_group[0]['ug_canread'],
                        'ug_canadd' => $data_user_group[0]['ug_canadd'],
                        'ug_canedit' => $data_user_group[0]['ug_canedit'],
                        'ug_candelete' => $data_user_group[0]['ug_candelete'],
                        'ug_cancomment' => $data_user_group[0]['ug_cancomment'],
                        'ug_cansearch' => $data_user_group[0]['ug_cansearch'],
                        'u_code' => "01"
                    );
                    $this->session->set_userdata($newdata);
                    $data_session  = $this->session->all_userdata();
                    //print_r($data_session);
                    if(isset($data_session) && $data_session['u_unitid'] == ""){
                        redirect('check_login');
                    }else{
                         redirect('mainpage');
                    }
                    //end login pass
                }
            }else{          
                if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
                    
                    $data_check['ua_username'] = $_COOKIE['username'];
                    $data_check['ua_password'] = $_COOKIE['password'];
                
                    $data = $this->m_check_login->getAll('user_account',$data_check);
                    
                    if(empty($data)){
                        $return['data'] = "F";
                        $this->view('check_login/v_login',$return);
                    }
                    else {
                        //if login pass
                        $data_query['ug_groupid'] = $data[0]['ug_groupid'];
                        $data_user_group = $this->m_check_login->getAll('user_group',$data_query);
                        //print_r($data_user_group);
                        //exit();
                        $newdata = array(
                            'ua_userid' => $data[0]['ua_userid'],
                            'ua_firstname'  => $data[0]['ua_firstname'],
                            'ua_lastname'     => $data[0]['ua_lastname'],
                            'u_unitid' => $data[0]['u_unitid'],
                            'ug_isadmin' => $data_user_group[0]['ug_isadmin'],
                            'ug_groupid' => $data[0]['ug_groupid'],
                            's_unitsub_id' => $data[0]['s_unitsub_id'],
                            'ug_canread' => $data_user_group[0]['ug_canread'],
                            'ug_canadd' => $data_user_group[0]['ug_canadd'],
                            'ug_canedit' => $data_user_group[0]['ug_canedit'],
                            'ug_candelete' => $data_user_group[0]['ug_candelete'],
                            'ug_cancomment' => $data_user_group[0]['ug_cancomment'],
                            'ug_cansearch' => $data_user_group[0]['ug_cansearch'],
                            'u_code' => "01"
                        );
                        $this->session->set_userdata($newdata);
                        $data_session  = $this->session->all_userdata();
                        //print_r($data_session);
                        if(isset($data_session) && $data_session['u_unitid'] == ""){
                            redirect('check_login');
                        }else{
                             redirect('mainpage');
                        }
                        //end login pass
                    }
                } else {
                   $this->view('check_login/v_login');
                }
            }
	}
        public function log_out(){
            $data_session  = $this->session->all_userdata();
            //print_r($data_session);exit;
            $where['ua_userid'] = $data_session['ua_userid'];
            $this->action_log($this->m_check_login,'check_login->log_out','Log Out',$data_session['ua_userid']);
            $edit_date['ua_ip_adress'] = null;
            $this->m_check_login->edit('user_account',$where,$edit_date);
            
            $this->session->sess_destroy();
            header("Location: ".URL_BASE_UNIT."");
        }
        public function day_night(){
            //
            if($_POST['d_n'] == "day"){
                    $d_n = array('d_n' => "day");
                    $this->session->set_userdata($d_n);
            }else{
                    $d_n = array('d_n' => "night");
                    $this->session->set_userdata($d_n);
            }
            //sleep(2);
            echo $_POST['d_n'];
        }
}
