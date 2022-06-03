<?php
include(APPPATH . "/core/base_e_army.php");

class Mainpage extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct(); 
            $this->load->model('m_db');
        }
        public function notification($newsid=null){
            $data_session  = $this->session->all_userdata();
            $where = array();
            if(isset($newsid) && $newsid){
                $where['nc_newsid'] = $newsid;
                $comment_data = $this->m_db->getAll('news_comment',$where);
            }
            
                if(isset($comment_data) && $comment_data){
                    //$this->debug($comment_data);
                    $comment_id = "?commentid=";
                    foreach ($comment_data as $k_cd => $v_cd){
                        $comment_id .= $v_cd['nc_commentid']."_";
                        $where_update['nc_commentid'] = $v_cd['nc_commentid'];
                        $data['nc_read'] = 'Y';
                        $this->m_db->edit('news_comment',$where_update,$data);
                    }
                }
                
                if(isset($comment_id) && $comment_id){
                    $comment_id = substr($comment_id, 0,-1);
                    //$this->debug($comment_id);
                    header("Location: ".URL_BASE_UNIT."unit05/news/detail/".$newsid.$comment_id);
                }else{
                    header("Location: ".URL_BASE_UNIT."");
                }
        }
	public function index() {
            $data_session  = $this->session->all_userdata();
            $type_news = "N";
            $news_d = "desc";
            $news_w = "desc";
            $news_n = "desc";
            //print_r($data_session);

                //$sesstion = $this->getSesstion();
                //print_r($sesstion);
            if(isset($_GET)){
                //$this->debug($_GET);
                if(isset($_GET['news_d']) && $_GET['news_d']){
                    $news_d = $_GET['news_d'];
                }
            }
            if(isset($_GET)){
                //$this->debug($_GET);
                if(isset($_GET['news_w']) && $_GET['news_w']){
                    $news_w = $_GET['news_w'];
                }
            }
            if(isset($_GET)){
                //$this->debug($_GET);
                if(isset($_GET['news_n']) && $_GET['news_n']){
                    $news_n = $_GET['news_n'];
                }
            }
//            exit();
            if(isset($data_session['ug_isadmin']) && $data_session['ug_isadmin'] == 'Y'){
                $data_session['s_unitsub_id'] = '0';
            }
            
            $count_type_news = $this->getCount_type_news($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid'],$news_d,$news_w,$news_n);
            $data_org = $this->get_organize($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid']);
            $data_person = $this->get_person($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid']);
            $data_news24hr = $this->get_news24hr($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid']);
            $data_newsdashbord = $this->get_newsdashbord($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid']);
            
            if(isset($_GET)){
                if(isset($_GET['type_new']) && $_GET['type_new']){
                    $type_news = $_GET['type_new'];
                }
            }
            
            $static_news = $this->getCount_static_news($data_session['u_unitid'],$data_session['s_unitsub_id'],$data_session['base_u_unitid'],$type_news);
            
            
            $data_session['bg_color'] = $static_news['bg_color'];
            $data_session['points_color'] = $static_news['points_color'];
            $data_session['lines_color'] = $static_news['lines_color'];
            $data_session['title'] = $static_news['title'];
            $data_session['type_news1'] = $type_news;
            $data_session['type_news2'] = $type_news;
            $data_session['news_d'] = $news_d;
            $data_session['news_w'] = $news_w;
            $data_session['news_n'] = $news_n;
            
            unset($static_news['bg_color']);
            unset($static_news['points_color']);
            unset($static_news['lines_color']);
            unset($static_news['title']);
            
            foreach ($static_news as $k_f_sn => $v_f_sn){
                foreach ($v_f_sn as $k_s_sn => $v_s_sn){
                    //echo $v_s_sn;
                    if($k_s_sn == 1){
                        $return_static_news[$k_f_sn.$k_s_sn] = "JAN:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 2){
                        $return_static_news[$k_f_sn.$k_s_sn] = "FEB:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 3){
                        $return_static_news[$k_f_sn.$k_s_sn] = "MAR:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 4){
                        $return_static_news[$k_f_sn.$k_s_sn] = "APR:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 5){
                        $return_static_news[$k_f_sn.$k_s_sn] = "MAY:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 6){
                        $return_static_news[$k_f_sn.$k_s_sn] = "JUN:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 7){
                        $return_static_news[$k_f_sn.$k_s_sn] = "JUL:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 8){
                        $return_static_news[$k_f_sn.$k_s_sn] = "AUG:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 9){
                        $return_static_news[$k_f_sn.$k_s_sn] = "SEP:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 10){
                        $return_static_news[$k_f_sn.$k_s_sn] = "OCT:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 11){
                        $return_static_news[$k_f_sn.$k_s_sn] = "NOV:".$k_f_sn.",".$v_s_sn."";
                    }
                    if($k_s_sn == 12){
                        $return_static_news[$k_f_sn.$k_s_sn] = "DEC:".$k_f_sn.",".$v_s_sn."";
                    }
                    //break;
                }
                //break;
            }
            
            foreach ($static_news as $k_f_c3 => $v_f_c3){
                foreach ($v_f_c3 as $k_s_c3 => $v_s_c3){
                    if($k_s_c3 == 1){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ม.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 2){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ก.พ. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 3){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."มี.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 4){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."เม.ย. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 5){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."พ.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 6){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."มิ.ย. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 7){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ก.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 8){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ส.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 9){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ก.ย. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 10){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ต.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 11){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."พ.ย. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                    if($k_s_c3 == 12){
                        $text_y = substr($k_f_c3, -2)+43;
                        $return_dashboard_amchart_3[$k_f_c3.$k_s_c3] = ',{"'."year".'": '."'"."ธ.ค. ".$text_y."'".",".'"'."income".'": '.$v_s_c3.",".'"'."expenses".'": '.$v_s_c3."}";
                    }
                }
            }
            
            if(isset($return_dashboard_amchart_3) && $return_dashboard_amchart_3){
                foreach ($return_dashboard_amchart_3 as $k_rda => $v_rda){
                    $return_dashboard_amchart_3[$k_rda] = substr($v_rda, 1);
                    break;
                }
            }else{
                $return_dashboard_amchart_3 = array();
                $return_dashboard_amchart_3[0] = '{"'."year".'": '."'"."ม.ค."."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[1] = ',{"'."year".'": '."'"."ก.พ.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[2] = ',{"'."year".'": '."'"."มี.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[3] = ',{"'."year".'": '."'"."เม.ย.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[4] = ',{"'."year".'": '."'"."พ.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[5] = ',{"'."year".'": '."'"."มิ.ย.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[6] = ',{"'."year".'": '."'"."ก.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[7] = ',{"'."year".'": '."'"."ส.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[8] = ',{"'."year".'": '."'"."ก.ย.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[9] = ',{"'."year".'": '."'"."ต.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[10] = ',{"'."year".'": '."'"."พ.ย.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
                $return_dashboard_amchart_3[11] = ',{"'."year".'": '."'"."ธ.ค.".""."'".",".'"'."income".'": '."0".",".'"'."expenses".'": '."0"."}";
            }

            $data_session['return_dashboard_amchart_3'] = $return_dashboard_amchart_3;
            $data_session['result_type_news'] = $count_type_news;
            $data_session['data_org'] = $data_org;
            $data_session['data_person'] = $data_person;
            $data_session['data_news24hr'] = $data_news24hr;
            $data_session['data_newsdashbord'] = $data_newsdashbord;
            
            if(isset($return_static_news) && $return_static_news){
                
            }else{
                $return_static_news = "";
            }
            $data_session['static_news'] = $return_static_news;

            //$this->debug($data_session);
           // exit();
            
            if($data_session['u_unitid'] == 0){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 1){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 2){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 3){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 4){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 5){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 6){
                $this->view('mainpage/v_mainpage',$data_session);
            }
            if($data_session['u_unitid'] == 7){
                $this->view('mainpage/v_mainpage',$data_session);
            }
	}
        public function getCount_type_news($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null,$news_d,$news_w,$news_n){
            
            $return = array();
            $limit = 5;
//            Set where defult
            if($u_unitid != 0){
                $where['u_unitid'] = $u_unitid;
            }
            if($s_unitsub_id != 0){
                $where['s_unitsub_id'] = $s_unitsub_id;
            }
            $order_by = 'n_datetime desc';
            
            $where['n_active'] = 'Y';
            
            $order_by = 'n_datetime '.$news_n;
            $where['type_news'] = 'N';
            $return['N'] = $this->m_db->getCountAll('news',$where);
            $return['data_N'] = $this->m_db->getAll('news',$where,null,$order_by,$limit);
            
            $order_by = 'n_datetime '.$news_w;
            $where['type_news'] = 'W';
            $return['W'] = $this->m_db->getCountAll('news',$where);
            $return['data_W'] = $this->m_db->getAll('news',$where,null,$order_by,$limit);
            
            $order_by = 'n_datetime '.$news_d;
            $where['type_news'] = 'D';
            $return['D'] = $this->m_db->getCountAll('news',$where);
            $return['data_D'] = $this->m_db->getAll('news',$where,null,$order_by,$limit);
            
            return $return;
        }
        public function getCount_static_news($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null,$type_news = "N"){
            $return = array();
            $limit = null;
//            Set where defult
            
            $select = "count(*) count_news,n_active";
            if($u_unitid != 0){
                $where['u_unitid'] = $u_unitid;
            }
            if($s_unitsub_id != 0){
                $where['s_unitsub_id'] = $s_unitsub_id;
            }
            $order_by = 'n_date asc';
            $where['n_date >='] = date('Y-m-d', mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 365, date("Y")));
            $where['n_date <='] = date('Y-m-d', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            
            $where['type_news'] = $type_news;
            
            if($type_news == "N"){
                $bg_color = "#1bd2c5";
                $points_color = "#1bd2c5";
                $lines_color = "#1bd2c5";
                $title = "รายงานห้วง ระยะเวลา";
            }elseif($type_news == "W"){
                $bg_color = "#1880da";
                $points_color = "#1880da";
                $lines_color = "#1880da";
                $title = "รายงานแจ้งเตือน";
            }elseif($type_news == "D"){
                $bg_color = "#e01919";
                $points_color = "#e03434";
                $lines_color = "#af1717";
                $title = "รายงานด่วน";
            }
            $return['bg_color'] = $bg_color;
            $return['points_color'] = $points_color;
            $return['lines_color'] = $lines_color;
            $return['title'] = $title;
            
            $where['n_active'] = 'Y';
            $group_by = "n_date";

            $data_static = $this->m_db->getAll_groupBy('news',$where,null,$order_by,$limit,null,$group_by);
            
            if(isset($data_static) && $data_static){
                
                $count_base = 0;
                
                foreach ($data_static as $k_data_static => $v_data_static){
                    $year = substr($v_data_static['n_date'], 0,4);
                    $month = substr($v_data_static['n_date'], 5,2);
                    $count = $v_data_static['count'];
                    
                    //$return[$year][$month] = $count;
                    
                    if(isset($return[$year][$month]) && $return[$year][$month] == $return[$year][$month]){
                        $count_base += $count;
                        $return[$year][$month] = $count_base;
                    }else{
                        $count_base = 0;
                        $count_base += $count;
                        $return[$year][$month] = $count_base;
                    }

                }
            }
            
            return $return;
        }
        public function get_organize($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null){
            $return = array();
            $limit = 30;
            $where = null;
            if($u_unitid != 0){
                $where['o_unit'] = $u_unitid;
            }
            
            $order_by = 'o_updateddate desc';
            
            $return  = $this->m_db->getAll('organization',$where,null,$order_by,$limit);
            
            return $return;
        }
        public function get_person($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null){
            $return = array();
            $limit = 30;
            $where = null;
            if($u_unitid != 0){
                $where['p_unit'] = $u_unitid;
            }
            
            $order_by = 'p_updateddate desc';
            
            $return = $this->m_db->getAll('person',$where,null,$order_by,$limit);
            
            return $return;
        }
        public function get_news24hr($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null){
            $return = array();
            $limit = 50;
            $order_by = 'n_datetime desc';
            $where['n_datetime >='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
            $where['n_datetime <='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            if($u_unitid != 0){
                $where['u_unitid'] = $u_unitid;
            }
            if($s_unitsub_id != 0){
                $where['s_unitsub_id'] = $s_unitsub_id;
            }

            $return = $this->m_db->getAll('news',$where,null,$order_by,$limit);
            
            return $return;
        }
        public function get_newsdashbord($u_unitid = 0, $s_unitsub_id = 0, $base_u_unitid = null){
            $return = array();
            $limit = 50;
            $like = null;
            $order_by = 'd_updateddate desc';
            $where['d_isactive'] = 'Y';
            //$where['d_updateddate >='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")-2));
            //$where['d_updateddate <='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            
            $where['d_startdate <='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            $where['d_enddate >=']   = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            
            if($u_unitid != 0){
                $where['d_unit'] = $u_unitid;
            }

            $return = $this->m_db->getAll('news_announce', $where, $like, $order_by, $limit);

            return $return;
        }
}
