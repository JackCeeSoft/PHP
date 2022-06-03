<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Search extends Base_e_army {
    
    public $paragraph_images_path;
    public $paragraph_file_path;
    public $news_image;
    
    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model('m_search');
        $this->paragraph_images_path = $this->config->item('root_upload').$this->config->item('images_path_paragraph');
        $this->paragraph_file_path = $this->config->item('root_upload').$this->config->item('file_path_paragraph');
        $this->news_image = $this->config->item('root_upload').$this->config->item('images_path_news');
        
        $this->data['script'] = array('assets/js/bootstrap-datetimepicker.min.js');
        $this->data['style'] = array('assets/css/bootstrap-combined.min.css','assets/css/bootstrap-datetimepicker.min.css');
        
        $this->data['title_section'] = 'ค้นหา';
    }
    
    public function news($offset = 0) {
        $sesstion = $this->getSesstion();
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ค้นหา'));
        $this->data['report_type'] = $this->m_search->getAll('report_type5', NULL, NULL, 'rt_reporttypeid asc');
        $this->data['news_department'] = $this->m_search->getAll('news_department', NULL, NULL, 'nd_newsdepartmentid asc');
        $this->data['news_type'] = $this->m_search->getAll('news_type', NULL, NULL, 'nt_newstypeid asc');
        $where = NULL;
        //print_r($_GET);
        if(isset($_GET['rt_reporttypeid']) && $_GET['rt_reporttypeid'] != ""){
            $where['rt_reporttypeid'] = $_GET['rt_reporttypeid'];
            $this->data['rt_reporttypeid'] = $_GET['rt_reporttypeid'];
        }
        
        if(isset($_GET['nd_newsdepartmentid']) && $_GET['nd_newsdepartmentid'] != ""){
            $where['nd_newsdepartmentid'] = $_GET['nd_newsdepartmentid'];
            $this->data['nd_newsdepartmentid'] = $_GET['nd_newsdepartmentid'];
        }
        
        if(isset($_GET['nt_newstypeid']) && $_GET['nt_newstypeid'] != ""){
            $where['nt_newstypeid'] = $_GET['nt_newstypeid'];
            $this->data['nt_newstypeid'] = $_GET['nt_newstypeid'];
        }
        
        if(isset($_GET['keyword'])){
            $check_keyword_trim = trim($_GET['keyword']);
        }
            if($sesstion['unitid'] != "0"){
                $where['u_unitid'] = $sesstion['unitid'];
            }
            
            if($sesstion['canread'] != 'Y'){
                $where['s_unitsub_id'] = $sesstion['subunitid'];
            }
            //print_r($where);
        if($sesstion['cansearch'] != "Y"){
            $this->view('search/v_cannotsearch', $this->data);
        }else{
            if (isset($_GET['rt_reporttypeid'])) {
                $where['n_active'] = 'Y';
                $this->data['keyword'] = $_GET['keyword'];

                if($check_keyword_trim != ""){
                    $check_keyword_first = substr($check_keyword_trim,0,1);
                    $check_keyword_last = substr($check_keyword_trim,-1);
                    //echo $check_keyword_first.$check_keyword_trim.$check_keyword_last;
                    //exit();
                    

                    
                    if($check_keyword_first == '"' && $check_keyword_last == '"'){
                        $check_keyword_trim = substr($check_keyword_trim,1);
                        $check_keyword_trim = substr($check_keyword_trim,0,-1);
                        $array_keyword = explode('bv28/2kabcdefa', $check_keyword_trim);
                        $this->data['keyword'] = $check_keyword_trim;
                        $this->data['check_speword'] = "true";
                        //$this->data['keyword'] = $check_keyword_trim;
                        //$array_keyword = explode('"', $check_keyword_trim);
                        
                        //print_r($array_keyword);
                    }else{
                        if($check_keyword_first == '"'){
                            $_GET['keyword'] = substr($check_keyword_trim,1);
                        }
                        if($check_keyword_last == '"'){
                            $_GET['keyword'] = substr($check_keyword_trim,0,-1);
                        }
                        
                        $_GET['keyword'] = str_replace("'", "''", $_GET['keyword']);
                        $array_keyword = explode(' ', trim($_GET['keyword']));
                        
                        //echo $check_keyword_trim;
                        
                        $this->data['keyword'] = $_GET['keyword'];
                        
                        foreach ($array_keyword as $k_keyword => $v_keyword) {
                            $like[]['n_subject'] = $v_keyword;
                        }
                    }
                }else{
                    $array_keyword = "";
                }

                $limit = 5;

                $data = $this->m_search->search_news($array_keyword,$where,$limit,$offset);
                $this->data['result'] = $data['all_news'];

                //$this->data['result'] = $this->m_search->getSearch($where, $like, 'n_date DESC, n_time DESC', $limit, $offset);
                //$this->data['result'] = $this->m_search->getAll('news', $where, $like, 'n_date DESC, n_time DESC', $limit, $offset);
                $config['base_url'] = base_url() . 'search/news';
                //$config['page_query_string'] = TRUE;
                $config['uri_segment'] = 3;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
                //echo $data['count_news'];
                //$config['total_rows'] = $this->data['total_rows'] = $this->m_search->getCountAll('news', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
                //echo '<pre>';
                //var_dump($config);
                $check_news_id = 0;
                if(!empty($this->data['result'])){
                    
                    foreach($this->data['result'] as $key=>$values){
                        
                        if($values['n_newsid'] != $check_news_id){
                            $news[$values['n_newsid']] = $values['np_paragraph_id'];
                            $check_news_id = $values['n_newsid'];
                            
                            $where_image_news_id['n_newsid'] = $check_news_id;
                            $data_image_ga = $this->m_search->getAll('news_imageattach',$where_image_news_id);
                            if(!empty($data_image_ga)){
                                foreach($data_image_ga as $key_img => $values_img){
                                    $this->data['result'][$key]['image_ga'][0] = $data_image_ga;
                                }
                            }
                        }else{
                             $news[$values['n_newsid']] .= "_".$values['np_paragraph_id'];
                        }
                    }

                    foreach ($news as $key_news=>$values_news){
                        foreach ($this->data['result'] as $key => $values){
                            if($values['n_newsid'] == $key_news){
                                $this->data['result'][$key]['np_hl'] = $values_news;
                            }
                        }
                    }
                }
                
                //echo '</pre>';
                
                $this->view('search/v_news_result', $this->data);
            } else {
    //            /print_r($_GET);
                $this->view('search/v_news', $this->data);
            }
        }
    }
    
    public function newsAdvance($offset = 0) {
        $this->data['report_type'] = $this->m_search->getAll('report_type5', NULL, NULL, 'rt_reporttypeid asc');
        $this->data['secret_level'] = $this->m_search->getAll('secret_level', NULL, NULL, 'sl_secretid asc');
        $this->data['haste_level'] = $this->m_search->getAll('haste_level', NULL, NULL, 'hl_hastelevelid asc');
        $this->data['report_unit'] = $this->m_search->getAll('report_unit', NULL, NULL, 'ru_reportunitid asc');
        $this->data['news_department'] = $this->m_search->getAll('news_department', NULL, NULL, 'nd_newsdepartmentid asc');
        $this->data['news_type'] = $this->m_search->getAll('news_type', NULL, NULL, 'nt_newstypeid asc');
        
        $array_secc = array();
        $sesstion = $this->getSesstion();
        //print_r($_POST);
        
            if($sesstion['unitid'] != "0"){
                $unit_where['u_unitid'] = $sesstion['unitid'];
            }else{
                $unit_where = NULL;
            }
            
            if($sesstion['canread'] != 'Y'){
                $where['s_unitsub_id'] = $sesstion['subunitid'];
            }else{
                $unit_where = NULL;
            }
        
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $where = NULL;
            $like = NULL;
            $array_keyword = NULL;
            

            
            if (isset($_POST['keyword']) and $_POST['keyword']) {
                
                $this->data['keyword'] = trim($_POST['keyword']);
                
                $this->data['advance_search'] = "Yes";
                
                    $check_keyword_trim = trim($_POST['keyword']);
                    $check_keyword_first = substr($check_keyword_trim,0,1);
                    $check_keyword_last = substr($check_keyword_trim,-1);
                    //echo $check_keyword_first.$check_keyword_trim.$check_keyword_last;
                    //exit();
                    if($check_keyword_first == '"' && $check_keyword_last == '"'){
                        $check_keyword_trim = substr($check_keyword_trim,1);
                        $check_keyword_trim = substr($check_keyword_trim,0,-1);
                                                
                        $array_keyword = explode('bv28/2kabcdefa', $check_keyword_trim);
                        $this->data['keyword'] = $check_keyword_trim;
                        $this->data['check_speword'] = "true";
                        //$this->data['keyword'] = $check_keyword_trim;
                        //$array_keyword = explode('"', $check_keyword_trim);
                        
                        //print_r($array_keyword);
                    }else{
                        if($check_keyword_first == '"'){
                            $_POST['keyword'] = substr($check_keyword_trim,1);
                        }
                        if($check_keyword_last == '"'){
                            $_POST['keyword'] = substr($check_keyword_trim,0,-1);
                        }
                        
                        $_POST['keyword'] = str_replace("'", "''", $_POST['keyword']);
                        
                        $array_keyword = explode(' ', trim($_POST['keyword']));
                        $array_secc['array_keyword'] = $array_keyword;
                        //print_r($array_keyword);
                        $this->data['keyword'] = $_POST['keyword'];
                        
                        foreach ($array_keyword as $k_keyword => $v_keyword) {
                            $like[]['n_subject'] = $v_keyword;
                            //$like[]['n_description'] = $v_keyword;
                            //$like[]['np_paragraph'] = $v_keyword;
                        }
                    }
            }

            $where['n_active'] = 'Y';
            $array_secc['news_search']['n_active'] = "Y";
            //print_r($_POST);
            if(isset($_POST['rt_reporttypeid']) and $_POST['rt_reporttypeid']){
                $where['rt_reporttypeid'] = $_POST['rt_reporttypeid'];
                $array_secc['news_search']['rt_reporttypeid'] = $_POST['rt_reporttypeid'];
            }
            if(isset($_POST['nd_newsdepartmentid']) and $_POST['nd_newsdepartmentid']){
                $where['nd_newsdepartmentid'] = $_POST['nd_newsdepartmentid'];
                $array_secc['news_search']['nd_newsdepartmentid'] = $_POST['nd_newsdepartmentid'];
            }
            if(isset($_POST['nt_newstypeid']) and $_POST['nt_newstypeid']){
                $where['nt_newstypeid'] = $_POST['nt_newstypeid'];
                $array_secc['news_search']['nt_newstypeid'] = $_POST['nt_newstypeid'];
            }
            if(isset($_POST['sl_secretid']) and $_POST['sl_secretid']){
                $where['sl_secretid'] = $_POST['sl_secretid'];
                $array_secc['news_search']['sl_secretid'] = $_POST['sl_secretid'];
            }
            if(isset($_POST['hl_hastelevelid']) and $_POST['hl_hastelevelid']){
                $where['hl_hastelevelid'] = $_POST['hl_hastelevelid'];
                $array_secc['news_search']['hl_hastelevelid'] = $_POST['hl_hastelevelid'];
            }
            if(isset($_POST['n_from']) and $_POST['n_from']){
                $where['n_from'] = explode(' ', trim($_POST['n_from']));
                $array_secc['news_search']['n_from'] = explode(' ', trim($_POST['n_from']));
                //$array_secc['news_search']['n_from'] = $_POST['n_from'];
            }
            if(isset($_POST['n_source']) and $_POST['n_source']){
                $where['n_source'] = explode(' ', trim($_POST['n_source']));
                $array_secc['news_search']['n_source'] = explode(' ', trim($_POST['n_source']));
            }
            if(isset($_POST['ru_reportunitid']) and $_POST['ru_reportunitid']){
                $where['ru_reportunitid'] = explode(' ', trim($_POST['ru_reportunitid']));
                $array_secc['news_search']['ru_reportunitid'] = explode(' ', trim($_POST['ru_reportunitid']));
            }
            if(isset($_POST['n_perform']) and $_POST['n_perform']){
                $where['n_perform'] = explode(' ', trim($_POST['n_perform']));
                $array_secc['news_search']['n_perform'] = explode(' ', trim($_POST['n_perform']));
            }
            if(isset($_POST['n_aware']) and $_POST['n_aware']){
                $where['n_aware'] = explode(' ', trim($_POST['n_aware']));
                $array_secc['news_search']['n_aware'] = explode(' ', trim($_POST['n_aware']));
            }
            if(isset($_POST['n_government']) and $_POST['n_government']){
                $where['n_government'] = explode(' ', trim($_POST['n_government']));
                $array_secc['news_search']['n_government'] = explode(' ', trim($_POST['n_government']));
            }
            if(isset($_POST['n_place']) and $_POST['n_place']){
                $where['n_place'] = explode(' ', trim($_POST['n_place']));
                $array_secc['news_search']['n_place'] = explode(' ', trim($_POST['n_place']));
            }
            if(isset($_POST['n_to']) and $_POST['n_to']){
                $where['n_to'] = explode(' ', trim($_POST['n_to']));
                $array_secc['news_search']['n_to'] = explode(' ', trim($_POST['n_to']));
            }
            if(isset($_POST['n_attachdetail']) and $_POST['n_attachdetail']){
                $where['n_attachdetail'] = explode(' ', trim($_POST['n_attachdetail']));
                $array_secc['news_search']['n_attachdetail'] = explode(' ', trim($_POST['n_attachdetail']));
            }
            if(isset($_POST['n_subject']) and $_POST['n_subject']){
                $where['n_subject'] = explode(' ', trim($_POST['n_subject']));
                $array_secc['news_search']['n_subject'] = explode(' ', trim($_POST['n_subject']));
            }
            if(isset($_POST['n_date']) and $_POST['n_date']){
                $where['n_date'] = $_POST['n_date'];
                $array_secc['news_search']['n_date'] = $_POST['n_date'];
            }
            if(isset($_POST['n_time']) and $_POST['n_time']){
                $where['n_time'] = $_POST['n_time'];
                $array_secc['news_search']['n_time'] = $_POST['n_time'];
            }
            if(isset($_POST['n_writer']) and $_POST['n_writer']){
                $where['n_writer'] = explode(' ', trim($_POST['n_writer']));
                $array_secc['news_search']['n_writer'] = explode(' ', trim($_POST['n_writer']));
            }
            if(isset($_POST['n_approver']) and $_POST['n_approver']){
                $where['n_approver'] = explode(' ', trim($_POST['n_approver']));
                $array_secc['news_search']['n_approver'] = explode(' ', trim($_POST['n_approver']));
            }
            if(isset($_POST['n_datetime_s']) and $_POST['n_datetime_s']){
                $where['n_datetime_s'] = $_POST['n_datetime_s'];
                $array_secc['news_search']['n_datetime_s'] = $_POST['n_datetime_s'];
            }
            if(isset($_POST['n_datetime_e']) and $_POST['n_datetime_e']){
                $where['n_datetime_e'] = $_POST['n_datetime_e'];
                $array_secc['news_search']['n_datetime_e'] = $_POST['n_datetime_e'];
            }
            
            $this->session->set_userdata($array_secc);
            
            $limit = 5;
            //print_r($where);
            //print_r($_POST);
            $data = $this->m_search->search_news_advance($where, $array_keyword, $limit, $offset, $unit_where);
            //print_r($all_news);
            //exit();
            //$this->debug($this->data['result']); exit;
            $this->data['result'] = $data['all_news'];
            
            $config['base_url'] = base_url() . 'search/newsAdvance';
            $config['uri_segment'] = 3;
            $config['num_links'] = 5;
            $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
            //echo $data['count_news'];
            $config['per_page'] = $limit;
            $config['cur_page'] = $this->data['offset'] = $offset + 1;
            $this->pagination->initialize($config);
            
            $this->data['data_back'] = $_POST;
            //print_r($_POST);
            
            $this->data['title_section'] = 'ค้นหาแบบละเอียด';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ค้นหาแบบละเอียด' , 'link' => site_url('search/search_advance_news')), array('name' => 'ผลลัพธ์ค้นหาแบบละเอียด') );
            //print_r($this->data);
            $check_news_id = 0;
                foreach($this->data['result'] as $key=>$values){
                    if($values['n_newsid'] != $check_news_id){
                        $news[$values['n_newsid']] = $values['np_paragraph_id'];
                        $check_news_id = $values['n_newsid'];
                        
                        $where_image_news_id['n_newsid'] = $check_news_id;
                            $data_image_ga = $this->m_search->getAll('news_imageattach',$where_image_news_id);
                            if(!empty($data_image_ga)){
                                foreach($data_image_ga as $key_img => $values_img){
                                    $this->data['result'][$key]['image_ga'][0] = $data_image_ga;
                                }
                            }
                            
                    }else{
                         $news[$values['n_newsid']] .= "_".$values['np_paragraph_id'];
                    }
                }
                if(isset($news)){
                    
                foreach ($news as $key_news=>$values_news){
                    foreach ($this->data['result'] as $key => $values){
                        if($values['n_newsid'] == $key_news){
                            $this->data['result'][$key]['np_hl'] = $values_news;
                        }
                    }
                }
                }
                
            $this->view('search/v_news_result_advance', $this->data);
        } else {
            $data_session  = $this->session->all_userdata();
            //print_r($data_session);
            if(isset($data_session['news_search']['n_active'])){
                if(isset($data_session['array_keyword'])){
                    $array_keyword = $data_session['array_keyword'];
                    $keyword_text = "";
                    foreach($array_keyword as $key => $values){
                        $keyword_text .= $values." ";
                    }
                    $this->data['keyword'] = $keyword_text;
                    
                }else{
                    $array_keyword = NULL;
                }
                    
                    $this->data['advance_search'] = "Yes";
                    $where = $data_session['news_search'];
                    
                    $limit = 5;
                    $data = $this->m_search->search_news_advance($where, $array_keyword, $limit, $offset, $unit_where);
                    $this->data['result'] = $data['all_news'];
                    //print_r($data_session);
                    $this->data['data_back'] = $data_session['news_search'];
                    $config['base_url'] = base_url() . 'search/newsAdvance';
                    $config['uri_segment'] = 3;
                    $config['num_links'] = 5;
                    $config['total_rows'] = $this->data['total_rows'] = $data['count_news'];
                    $config['per_page'] = $limit;
                    $config['cur_page'] = $this->data['offset'] = $offset + 1;
                    $this->pagination->initialize($config);

                    //print_r($this->data);
                    $this->data['title_section'] = 'ค้นหาแบบละเอียด';
                    $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ค้นหาแบบละเอียด' , 'link' => site_url('search/search_advance_news')), array('name' => 'ผลลัพธ์ค้นหาแบบละเอียด') );
                    
                $check_news_id = 0;
                foreach($this->data['result'] as $key=>$values){
                    if($values['n_newsid'] != $check_news_id){
                        $news[$values['n_newsid']] = $values['np_paragraph_id'];
                        $check_news_id = $values['n_newsid'];
                        
                        $where_image_news_id['n_newsid'] = $check_news_id;
                            $data_image_ga = $this->m_search->getAll('news_imageattach',$where_image_news_id);
                            if(!empty($data_image_ga)){
                                foreach($data_image_ga as $key_img => $values_img){
                                    $this->data['result'][$key]['image_ga'][0] = $data_image_ga;
                                }
                            }
                            
                    }else{
                         $news[$values['n_newsid']] .= "_".$values['np_paragraph_id'];
                    }
                }

                foreach ($news as $key_news=>$values_news){
                    foreach ($this->data['result'] as $key => $values){
                        if($values['n_newsid'] == $key_news){
                            $this->data['result'][$key]['np_hl'] = $values_news;
                        }
                    }
                }
                    
                    $this->view('search/v_news_result_advance', $this->data);
            }else{
                $this->data['title_section'] = 'ค้นหาแบบละเอียด';
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ค้นหาแบบละเอียด'));
                $this->view('search/v_news_advance', $this->data);
            }
        }
    }
    public function search_advance_news(){
        $data_session  = $this->session->all_userdata();
        $this->session->unset_userdata('news_search');
        $this->session->unset_userdata('array_keyword');
        $data_session  = $this->session->all_userdata();
        //print_r($data_session);
        redirect('search/newsAdvance');
    }
}
