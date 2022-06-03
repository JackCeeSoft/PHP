<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News extends Base_e_army {
    
    public $news_images_path;
    public $paragraph_images_path;
    public $paragraph_file_path;
    public $unit_images_path;
    public $user_id;
    public $group_id;
    public $u_unitid;
    public $s_unitsubid;
    public $isadmin;
    public $canread;
    public $canadd;
    public $canedit;
    public $candelete;
    public $cancomment;
    public $cansearch;
    public $u_code;
    public $unit_table;
    public $firstname;
    public $lastname;

    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_news');
        $this->news_images_path = $this->config->item('root_upload').$this->config->item('images_path_news');
        $this->paragraph_images_path = $this->config->item('root_upload').$this->config->item('images_path_paragraph');
        $this->paragraph_file_path = $this->config->item('root_upload').$this->config->item('file_path_paragraph');
        $this->unit_images_path = $this->config->item('root_upload').$this->config->item('images_path_unit');
        $this->load->library('custom_upload');
        
        //$this->data['script'] = array('assets/js/ckeditor/ckeditor.js', 'assets/js/bootstrap-datetimepicker.min.js', 'assets/bootstrap-duallistbox/bootstrap-duallistbox.js', 'assets/bootstrap-tagsinput/bootstrap-tagsinput.js');
        //$this->data['style'] = array('assets/css/bootstrap-combined.min.css','assets/css/bootstrap-datetimepicker.min.css', 'assets/bootstrap-duallistbox/bootstrap-duallistbox.css', 'assets/bootstrap-tagsinput/bootstrap-tagsinput.css');
        
        $this->data['script'] = array(
            'assets/js/ckeditor/ckeditor.js', 
            'assets/js/bootstrap-datetimepicker.min.js', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.js', 
            'assets/jquery-textext/js/textext.core.js', 
            'assets/jquery-textext/js/textext.plugin.tags.js', 
            'assets/jquery-textext/js/textext.plugin.autocomplete.js', 
            'assets/jquery-textext/js/textext.plugin.suggestions.js', 
            'assets/jquery-textext/js/textext.plugin.filter.js', 
            'assets/jquery-textext/js/textext.plugin.focus.js', 
            'assets/jquery-textext/js/textext.plugin.prompt.js', 
            'assets/jquery-textext/js/textext.plugin.ajax.js', 
            'assets/jquery-textext/js/textext.plugin.arrow.js', 
        );
        $this->data['style'] = array(
            'assets/css/bootstrap-combined.min.css', 
            'assets/css/bootstrap-datetimepicker.min.css', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.css', 
            'assets/jquery-textext/css/textext.core.css', 
            'assets/jquery-textext/css/textext.plugin.tags.css', 
            'assets/jquery-textext/css/textext.plugin.autocomplete.css', 
            'assets/jquery-textext/css/textext.plugin.focus.css', 
            'assets/jquery-textext/css/textext.plugin.prompt.css', 
            'assets/jquery-textext/css/textext.plugin.arrow.css', 
        );
        
        $this->data['title_section'] = 'สรุปรายงานข่าว';
        
        $sesstion = $this->getSesstion();
        //$this->debug($sesstion);
        $this->user_id = $sesstion['user_id'];
        $this->group_id = $sesstion['groupid'];
        $this->u_unitid = $sesstion['unitid'];
        $this->s_unitsubid = $sesstion['subunitid'];
        $this->isadmin = $sesstion['isadmin'];
        $this->canread = $sesstion['canread'];
        $this->canadd = $sesstion['canadd'];
        $this->canedit = $sesstion['canedit'];
        $this->candelete = $sesstion['candelete'];
        $this->cancomment = $sesstion['cancomment'];
        $this->cansearch = $sesstion['cansearch'];
        $this->firstname = $sesstion['firstname'];
        $this->lastname = $sesstion['lastname'];
        $this->u_code = (isset($sesstion['u_code']) and $sesstion['u_code']) ? $sesstion['u_code'] : '01';
        $this->unit_table = 5;
    }

    public function dashboard($offset = 0) {
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $this->user_id );
        
        $this->data['script'] = array('assets/js/holder.js', 
            'assets/js/bootstrap-datetimepicker.min.js'
        );
        $this->data['style'] = array(
            'assets/css/pages/bootstrap-responsive.min_metro.css',
            'assets/css/pages/style-metro.css',
            'assets/css/pages/blog.css',
            'assets/css/pages/style-metro-layout.css', 
            'assets/css/bootstrap-datetimepicker.min.css'
        );
        
        $this->data['unit'] = $this->m_news->getAll('unit', NULL, NULL, 'u_unitid asc');
        $this->data['unit_sub'] = $this->m_news->getAll('unit_sub', NULL, NULL, 's_unitsub_id asc');
        $this->data['secret_level'] = $this->m_news->getAll('secret_level' . $this->unit_table, NULL, NULL, 'sl_secretid asc');
        $this->data['haste_level'] = $this->m_news->getAll('haste_level' . $this->unit_table, NULL, NULL, 'hl_hastelevelid asc');
        $this->data['report_unit'] = $this->m_news->getAll('report_unit', NULL, NULL, 'ru_reportunitid asc');
        $this->data['favorite'] = $this->m_news->getAll('favorite', array("ua_userid"=>$this->user_id), NULL, 'n_newsid asc');
        $like = $likeParagraph = $inNewsId = NULL;
        
        $where['n_active'] = 'Y';
        
        if (isset($_GET['u_unitid']) and $_GET['u_unitid'] == 0)
            $this->data['u_unitid'] = trim ( $_GET['u_unitid'] );
        else if(isset($_GET['u_unitid']) and $_GET['u_unitid'] != 0)
            $this->data['u_unitid'] = $where['news.u_unitid'] = trim ( $_GET['u_unitid'] );
        else if(isset($this->u_unitid) and $this->u_unitid)
            $this->data['u_unitid'] = $where['news.u_unitid'] = $this->u_unitid;
        
        if($this->canread == 'N' and $this->isadmin == 'N') {
            $where['s_unitsub_id'] = $this->s_unitsubid;
        } else {
            if (isset($_GET['s_unitsub_id']) and $_GET['s_unitsub_id'] == 0)
                $this->data['s_unitsub_id'] = trim ( $_GET['s_unitsub_id'] );
            else if(isset($_GET['s_unitsub_id']) and $_GET['s_unitsub_id'] != 0)
                $this->data['s_unitsub_id'] = $where['news.s_unitsub_id'] = trim ( $_GET['s_unitsub_id'] );
            else if(isset($this->s_unitsubid) and $this->s_unitsubid)
                $this->data['s_unitsub_id'] = $where['news.s_unitsub_id'] = $this->s_unitsubid;
        }
        
        if (isset($_GET['n_date_start']) and $_GET['n_date_start'])
            $this->data['n_date_start'] = $where['n_date >='] = trim ( $_GET['n_date_start'] );
        
        if (isset($_GET['n_date_end']) and $_GET['n_date_end'])
            $this->data['n_date_end'] = $where['n_date <='] = trim ( $_GET['n_date_end'] );
        
        if(isset($_GET['hl_hastelevelid']) and $_GET['hl_hastelevelid'])
            $this->data['hl_hastelevelid'] = $where['news.hl_hastelevelid'] = trim ( $_GET['hl_hastelevelid'] );
        
        if(isset($_GET['sl_secretid']) and $_GET['sl_secretid'])
            $this->data['sl_secretid'] = $where['news.sl_secretid'] = trim ( $_GET['sl_secretid'] );
        
        if(isset($_GET['ru_reportunitid']) and $_GET['ru_reportunitid'])
            $this->data['ru_reportunitid'] = $where['news.ru_reportunitid'] = trim ( $_GET['ru_reportunitid'] );
        
        if(isset($_GET['keyword']) and $_GET['keyword']) {
            $this->data['keyword'] = $likeParagraph = trim ( $_GET['keyword'] );
            $inNewsId = $this->m_news->getNewsIdForLikeSearch( $this->data['keyword'] );
        }
        if (isset($_GET['type_news']) and $_GET['type_news'])
            $this->data['type_news'] = $where['type_news'] = trim ( $_GET['type_news'] );
        
        $limit = 5;
        if(isset($_GET['tag']) and $_GET['tag']) {
            $where['nt_tagid'] = $_GET['tag'];
            $this->data['result'] = $this->m_news->getNewsAllByTag($where, $like, 'n_date DESC, n_time DESC', $limit, $offset, $inNewsId, $likeParagraph);
            $this->data['total_rows'] = $this->m_news->getCountNewsAllByTag($where, $like, $inNewsId);
        } else {
            $this->data['result'] = $this->m_news->getNewsAll($where, $like, 'n_date DESC, n_time DESC', $limit, $offset, $inNewsId, $likeParagraph);
            $this->data['total_rows'] = $this->m_news->getCountNewsAll($where, $like, $inNewsId);
        }

        $config['base_url'] = base_url() . 'news/dashboard';
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'];
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'สรุปรายงานข่าว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'สรุปรายงานข่าว'));
        $this->view('news/v_dashboard', $this->data);
    }
    
    public function lists($offset = 0) {
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $this->user_id );
        
        $this->data['unit'] = $this->m_news->getAll('unit', NULL, NULL, 'u_unitid asc');
        $this->data['unit_sub'] = $this->m_news->getAll('unit_sub', NULL, NULL, 's_unitsub_id asc');
        $this->data['secret_level'] = $this->m_news->getAll('secret_level', NULL, NULL, 'sl_secretid asc');
        $this->data['haste_level'] = $this->m_news->getAll('haste_level', NULL, NULL, 'hl_hastelevelid asc');
        
        $where_news_rows = $where = NULL;
        
        if (isset($_GET['u_unitid']) and $_GET['u_unitid'] == 0)
            $this->data['filter']['u_unitid'] = $_GET['u_unitid'];
        else if(isset($_GET['u_unitid']) and $_GET['u_unitid'] != 0)
            $this->data['filter']['u_unitid'] = $where_news_rows['u_unitid'] = $where['u_unitid'] = $_GET['u_unitid'];
        else if(isset($this->u_unitid) and $this->u_unitid)
            $this->data['filter']['u_unitid'] = $where_news_rows['u_unitid'] = $where['u_unitid'] = $this->u_unitid;
        
        
        if($this->canread == 'N' and $this->isadmin == 'N') {
            $where['s_unitsub_id'] = $this->s_unitsubid;
        } else {
            if (isset($_GET['s_unitsub_id']) and $_GET['s_unitsub_id'] == 0)
                $this->data['filter']['s_unitsub_id'] = $_GET['s_unitsub_id'];
            else if(isset($_GET['s_unitsub_id']) and $_GET['s_unitsub_id'] != 0)
                $this->data['filter']['s_unitsub_id'] = $where_news_rows['s_unitsub_id'] = $where['s_unitsub_id'] = $_GET['s_unitsub_id'];
            else if(isset($this->s_unitsubid) and $this->s_unitsubid)
                $this->data['filter']['s_unitsub_id'] = $where_news_rows['s_unitsub_id'] = $where['s_unitsub_id'] = $this->s_unitsubid;
        }
        
        
        $array_keyword = $like = NULL;
        if (isset($_GET) and $_GET) {
            if (isset($_GET['n_date']) and $_GET['n_date'])
                $this->data['filter']['n_date'] = $where['n_date'] = $_GET['n_date'];
            
            if(isset($_GET['hl_hastelevelid']) and $_GET['hl_hastelevelid'])
                $this->data['filter']['hl_hastelevelid'] = $where['hl_hastelevelid'] = $_GET['hl_hastelevelid'];

            if(isset($_GET['sl_secretid']) and $_GET['sl_secretid'])
                $this->data['filter']['sl_secretid'] = $where['sl_secretid'] = $_GET['sl_secretid'];
            
            if(isset($_GET['keyword']) and $_GET['keyword']) {
                $this->data['filter']['keyword'] = $_GET['keyword'];
                $array_keyword = explode(' ', trim($_GET['keyword']));
            }
        }
        
        $limit = 10;
        $this->data['lists'] = $this->m_news->filterNews($array_keyword, $where, $like, 'n_date DESC, n_time DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'news/lists';
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_news->countFilterNews($array_keyword, $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'รายการข่าว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการข่าว'));
        $this->data['total_news_rows'] = $this->m_news->getCountAll('news', $where_news_rows);
        $this->view('news/v_lists', $this->data);
    }
    
    public function insert() {
        $this->data['report_type'] = $this->m_news->getAll('report_type' . $this->unit_table, NULL, NULL, 'rt_reporttypeid asc');
        $this->data['secret_level'] = $this->m_news->getAll('secret_level' . $this->unit_table, NULL, NULL, 'sl_secretid asc');
        $this->data['haste_level'] = $this->m_news->getAll('haste_level' . $this->unit_table, NULL, NULL, 'hl_hastelevelid asc');
        $this->data['firstname'] = $this->firstname;
        $this->data['lastname'] = $this->lastname;
        
        $sesstion = $this->getSesstion();
        
        if($sesstion['canadd'] != "Y"){
            $this->view('news/v_cannotadd', $this->data);
        }else{
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $insert['rt_reporttypeid']  = $_POST['rt_reporttypeid'];
                    $insert['n_subject']        = $_POST['n_subject'];
                    $insert['n_date']           = (isset($_POST['n_date']) and $_POST['n_date']) ? $_POST['n_date'] : '0000-00-00';
                    $insert['n_time']           = (isset($_POST['n_time']) and $_POST['n_time']) ? $_POST['n_time'].':00' : '00:00:00';
                    $insert['n_datetime']       = $insert['n_date'].' '.$insert['n_time'];
                    $insert['n_description']    = "";
                    $insert['n_keyword']        = "";
                    $insert['u_unitid']         = $this->u_unitid;
                    $insert['s_unitsub_id']     = $this->s_unitsubid;
                    $insert['n_active']         = 'Y';
                    $insert['n_createdby']      = $this->user_id;
                    $insert['n_updatedby']      = $this->user_id;
                    $insert['n_approvercode']   = $_POST['n_approvercode'];
                    $insert['sl_secretid']      = $_POST['sl_secretid'];
                    $insert['hl_hastelevelid']  = 0;
                    $insert['n_from']           = "";
                    $insert['n_source']         = "";
                    $insert['ru_reportunitid']  = 0;
                    $insert['n_perform']        = "";
                    $insert['n_aware']          = "";
                    $insert['n_writer']         = "";
                    $insert['n_approver']       = "";
                    $insert['n_place']          = $_POST['n_place'];
                    $insert['n_to']             = $_POST['n_to'];
                    $insert['n_government']     = "";
                    $insert['n_attachdetail']   = "";
                    $insert['n_reference']      = "";
                    $insert['n_detailconclusion']  = "";
                    $insert['type_news'] = $_POST['type_news'];
                    if(isset($_POST['rt_reporttypeid']) and ($_POST['rt_reporttypeid'] == 2 or $_POST['rt_reporttypeid'] == 3 or $_POST['rt_reporttypeid'] == 4)) {
                        $insert['n_government']        = $_POST['n_government'];
                        $insert['n_attachdetail']      = $_POST['n_attachdetail'];
                        $insert['n_reference']         = $_POST['n_reference'];
                        $insert['n_reference']         = $_POST['n_reference'];
                        $insert['n_detailconclusion']  = $_POST['n_detailconclusion'];
                    } else if( isset($_POST['rt_reporttypeid']) && $_POST['rt_reporttypeid'] == 6) {
                        $insert['hl_hastelevelid']     = $_POST['hl_hastelevelid'];
                        $insert['sl_secretid']         = $_POST['sl_secretid'];
                        $insert['n_aware']             = $_POST['n_aware'];
                        $insert['n_writer']            = $_POST['n_writer'];
                        $insert['n_approver']          = $_POST['n_approver'];
                    }

                    $news_id = $this->m_news->add('news', $insert);
                    
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Add(Success)', $news_id );

                    redirect(site_url('news/update/' . $news_id . '?tab=2'));
                //}
            } else {
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Add', $this->user_id );
                
                $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการข่าว', 'link' => site_url('news/lists')), array('name' => 'เพิ่มข่าว'));
                $this->view('news/v_form_u5', $this->data);
            }
        }
    }
    
    public function update($id = '', $paragraph_id = '') {
        $this->data['result'] = $this->m_news->getNewsDetail($id);
        $this->data['paragraph'] = $this->m_news->getAll('news_paragraph', array('n_newsid' => $id), NULL, 'np_paragraph_id ASC');
        $this->data['firstname'] = $this->firstname;
        $this->data['lastname'] = $this->lastname;
        
        if(isset($paragraph_id) and $paragraph_id) {
            $this->data['result_paragraph'] = $this->m_news->getDetail('news_paragraph', array('np_paragraph_id' => $paragraph_id));
            $this->data['attach'] = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $paragraph_id));
            $this->data['personed'] = $this->setNewArray($this->m_news->getAll('news_link_person', array('np_paragraph_id' => $paragraph_id)), 'p_personid');
            $this->data['organizationed'] = $this->setNewArray($this->m_news->getAll('news_link_organization', array('np_paragraph_id' => $paragraph_id)), 'o_organizationid');
            $this->data['movemented'] = $this->setNewArray($this->m_news->getAll('news_link_movement', array('np_paragraph_id' => $paragraph_id)), 'nm_newsmovementid');
            $this->data['tag'] = $this->setNewArray($this->m_news->getAllJoin('news_link_tag', array(array('table' => 'news_tag', 'condition' => 'news_tag.nt_tagid = news_link_tag.nt_tagid', 'type' => 'inner')), array('np_paragraph_id' => $paragraph_id)), 'nt_word');
        }
        
        if(isset($this->data['result']['rt_reporttypeid']) && $this->data['result']['rt_reporttypeid'] == 5 && isset($this->data['paragraph'][0])) {
            $paragraph_id = $this->data['paragraph'][0]['np_paragraph_id'];
            $this->data['result_paragraph'] = $this->m_news->getDetail('news_paragraph', array('np_paragraph_id' => $paragraph_id));
            $this->data['attach'] = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $paragraph_id));
            $this->data['personed'] = $this->setNewArray($this->m_news->getAll('news_link_person', array('np_paragraph_id' => $paragraph_id)), 'p_personid');
            $this->data['organizationed'] = $this->setNewArray($this->m_news->getAll('news_link_organization', array('np_paragraph_id' => $paragraph_id)), 'o_organizationid');
            $this->data['movemented'] = $this->setNewArray($this->m_news->getAll('news_link_movement', array('np_paragraph_id' => $paragraph_id)), 'nm_newsmovementid');
            $this->data['tag'] = $this->setNewArray($this->m_news->getAllJoin('news_link_tag', array(array('table' => 'news_tag', 'condition' => 'news_tag.nt_tagid = news_link_tag.nt_tagid', 'type' => 'inner')), array('np_paragraph_id' => $paragraph_id)), 'nt_word');
        }

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if ($this->data['result']['n_createdby'] != $this->user_id) {
            if (isset($this->isadmin) and $this->isadmin == 'N') {
                redirect(site_url(''));
            }
        }

        $this->data['report_type'] = $this->m_news->getAll('report_type' . $this->unit_table, NULL, NULL, 'rt_reporttypeid asc');
        $this->data['secret_level'] = $this->m_news->getAll('secret_level' . $this->unit_table, NULL, NULL, 'sl_secretid asc');
        $this->data['haste_level'] = $this->m_news->getAll('haste_level' . $this->unit_table, NULL, NULL, 'hl_hastelevelid asc');
        $this->data['news_cause'] = $this->m_news->getAll('news_cause' . $this->unit_table, NULL, NULL, 'nc_newscauseid asc');
        $this->data['news_harry'] = $this->m_news->getAll('news_harry' . $this->unit_table, NULL, NULL, 'nh_newsharryid asc');
        $this->data['news_execution'] = $this->m_news->getAll('news_execution' . $this->unit_table, NULL, NULL, 'ne_newsexecutionid asc');
        $this->data['province'] = $this->m_news->getAll('province', array('province_show' => 'Y'), NULL, 'province_name asc');
        $this->data['amphur'] = $this->m_news->getAll('amphur', NULL, NULL, 'amphur_name asc');
        $this->data['district'] = $this->m_news->getAll('district', NULL, NULL, 'district_name asc');
        $this->data['news_movement'] = $this->m_news->getAll('news_movement', NULL, NULL, 'nm_newsmovementid asc');
        $this->data['news_person'] = $this->m_news->getAll('news_person' . $this->unit_table, NULL, NULL, 'np_seq asc');
        $this->data['news_practice'] = $this->m_news->getAll('news_practice' . $this->unit_table, NULL, NULL, 'np_seq asc');
        $this->data['news_gun'] = $this->m_news->getAll('news_gun' . $this->unit_table, NULL, NULL, 'ng_seq asc');
        $this->data['dynamite_type'] = $this->m_news->getAll('dynamite_type' . $this->unit_table, NULL, NULL, 'dt_dynamitetypeid asc');
        $this->data['ignition_type'] = $this->m_news->getAll('ignition_type' . $this->unit_table, NULL, NULL, 'it_ignitiontypeid asc');
        
        $this->data['relate_person'] = $this->m_news->getAll('news_relate_person' . $this->unit_table, array('n_newsid' => $id), NULL, 'np_newspersonid asc');
        $this->data['relate_practice'] = $this->m_news->getAll('news_relate_practice' . $this->unit_table, array('n_newsid' => $id), NULL, 'np_newspracticeid asc');
        $this->data['relate_gun'] = $this->m_news->getAll('news_relate_gun' . $this->unit_table, array('n_newsid' => $id), NULL, 'ng_newsgunid asc');
        $this->data['dynamitetable'] = $this->m_news->getAll('news_dynamitetable' . $this->unit_table, array('n_newsid' => $id));
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $insert['rt_reporttypeid']  = $_POST['rt_reporttypeid'];
                $insert['n_subject']        = $_POST['n_subject'];
                $insert['n_date']           = (isset($_POST['n_date']) and $_POST['n_date']) ? $_POST['n_date'] : '0000-00-00';
                $insert['n_time']           = (isset($_POST['n_time']) and $_POST['n_time']) ? $_POST['n_time'].':00' : '00:00:00';
                $insert['n_datetime']       = $insert['n_date'].' '.$insert['n_time'];
                $insert['n_description']    = "";
                $insert['n_keyword']        = "";
                $insert['n_updatedby']      = $this->user_id;
                $insert['n_approvercode']   = $_POST['n_approvercode'];
                $insert['sl_secretid']      = $_POST['sl_secretid'];
                $insert['hl_hastelevelid']  = 0;
                $insert['n_from']           = "";
                $insert['n_source']         = "";
                $insert['ru_reportunitid']  = 0;
                $insert['n_perform']        = "";
                $insert['n_aware']          = "";
                $insert['n_writer']         = "";
                $insert['n_approver']       = "";
                $insert['n_place']          = $_POST['n_place'];
                $insert['n_to']             = $_POST['n_to'];
                $insert['n_government']     = "";
                $insert['n_attachdetail']   = "";
                $insert['n_reference']      = "";
                $insert['n_detailconclusion']  = "";
                $insert['type_news'] = $_POST['type_news'];
                if(isset($_POST['rt_reporttypeid']) and ($_POST['rt_reporttypeid'] == 2 or $_POST['rt_reporttypeid'] == 3 or $_POST['rt_reporttypeid'] == 4)) {
                    $insert['n_government']        = $_POST['n_government'];
                    $insert['n_attachdetail']      = $_POST['n_attachdetail'];
                    $insert['n_reference']         = $_POST['n_reference'];
                    $insert['n_detailconclusion']  = $_POST['n_detailconclusion'];
                } else if( isset($_POST['rt_reporttypeid']) && $_POST['rt_reporttypeid'] == 6) {
                    $insert['hl_hastelevelid']     = $_POST['hl_hastelevelid'];
                    $insert['n_aware']             = $_POST['n_aware'];
                    $insert['n_writer']            = $_POST['n_writer'];
                    $insert['n_approver']          = $_POST['n_approver'];
                }
                
                $result = $this->m_news->edit('news', array('n_newsid' => $id), $insert);
                
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(Success)', $id );
                
                $tab = (isset($_POST['tab']) and $_POST['tab']) ? $_POST['tab'] : 2;
                $param_paragraph = (isset($paragraph_id) and $paragraph_id) ? '/'.$paragraph_id : '';
                redirect(site_url('news/update/' . $id . $param_paragraph. '?tab=' . $tab));
        } else {
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit', $this->user_id );
            
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการข่าว', 'link' => site_url('news/lists')), array('name' => 'แก้ไขข่าว'));
            $this->view('news/v_form_u5', $this->data);
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['del_id'];
            $paragraph = $this->m_news->getAll('news_paragraph', array('n_newsid' => $id));
            if(isset($paragraph) and $paragraph) {
                foreach ($paragraph as $v_paragraph) {
                    
                    if(isset($v_paragraph['np_paragraph_id']) and $v_paragraph['np_paragraph_id']) {
                        $paragraph_id_path = $this->paragraph_images_path.$v_paragraph['np_paragraph_id'];
                        delete_file($paragraph_id_path . '/' . $v_paragraph['np_mainimage']);
                    }

                    $fileattach = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));
                    if(isset($fileattach) and $fileattach) {
                        $paragraph_id_path = $this->paragraph_file_path.$v_paragraph['np_paragraph_id'];
                        foreach ($fileattach as $v_fileattach) {
                            delete_file($paragraph_id_path . '/' . $v_fileattach['nf_path']);
                        }
                        $this->m_news->delete('news_fileattach', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));
                    }

                    $this->m_news->delete('news_link_person', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));

                    $this->m_news->delete('news_link_organization', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));

                    $this->m_news->delete('news_link_movement', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));

                    $this->m_news->delete('news_link_tag', array('np_paragraph_id' => $v_paragraph['np_paragraph_id']));

                }
                
                $this->m_news->delete('news_paragraph', array('n_newsid' => $id));
                
            }
            
            $newsimage = $this->m_news->getAll('news_imageattach', array('n_newsid' => $id));
            if(isset($newsimage) and $newsimage) {
                foreach ($newsimage as $v_newsimage) {
                    $newsimage_path = $this->news_images_path.$id;
                    delete_file($newsimage_path . '/' . $v_newsimage['ni_path']);
                }
                
                $this->m_news->delete('news_imageattach', array('n_newsid' => $id));
                
            }
            
            $this->m_news->delete('news_comment', array('nc_newsid' => $id));
            
            $this->m_news->delete('news', array('n_newsid' => $id));
            
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(Success)', $id );
            
        }
        if(isset($_GET['page']) and $_GET['page']) {
            redirect(site_url('news/'.$_GET['page']));
        } else {
            redirect(site_url('news/lists'));
        }
        
    }
    
    public function insertParagraph() {
        $paragraph_insert = array(
            'n_newsid' => $_POST['n_newsid'],
            'np_paragraph' => checkSpanTHsarabun($_POST['np_paragraph']),
            'nd_newsdepartmentid' => 0,
            'nt_newstypeid' => 0,
            'nc_newscountryid' => 0,
            'np_topicforindex' => $_POST['np_topicforindex'],
            'np_createdby' => $this->user_id,
            'np_updatedby' => $this->user_id
        );
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Add(Success)', $paragraph_id );
        
        if( isset($_POST['nc_newscauseid']) && $_POST['nc_newscauseid'] ){ $paragraph_insert['nc_newscauseid'] = $_POST['nc_newscauseid']; }
        if( isset($_POST['nh_newsharryid']) && $_POST['nh_newsharryid'] ){ $paragraph_insert['nh_newsharryid'] = $_POST['nh_newsharryid']; }
        if( isset($_POST['ne_newsexecutionid']) && $_POST['ne_newsexecutionid'] ){ $paragraph_insert['ne_newsexecutionid'] = $_POST['ne_newsexecutionid']; }
        if( isset($_POST['province_id']) && $_POST['province_id'] ){ $paragraph_insert['np_newsprovinceid'] = $_POST['province_id']; }
        if( isset($_POST['amphur_id']) && $_POST['amphur_id'] ){ $paragraph_insert['na_newsamphorid'] = $_POST['amphur_id']; }
        if( isset($_POST['district_id']) && $_POST['district_id'] ){ $paragraph_insert['nt_newstambonid'] = $_POST['district_id']; }
        
        $paragraph_id = $this->m_news->add('news_paragraph', $paragraph_insert);
        
        /*---------------------------------------- start insert img ------------------------------------------*/
        $paragraph_id_path = $this->paragraph_images_path.$paragraph_id;
        if (!file_exists($paragraph_id_path.'/')) {
            mkdir($paragraph_id_path, 0775);
        }
        if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
            $this->custom_upload->setConfig(array('upload_path' => $paragraph_id_path.'/'));
            $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
            if(empty($upload_data['file_name'])) {
                echo 'img : ';
                $this->debug($upload_data[0]); exit;
            }
            $np_mainimage = (isset($upload_data['orig_name']) and $upload_data['orig_name']) ? $upload_data['orig_name'] : NULL;
            $this->m_news->edit('news_paragraph', array('np_paragraph_id' => $paragraph_id), array('np_mainimage' => $np_mainimage));
        }
        /*----------------------------------------- end insert img -------------------------------------------*/

        /*------------------------------------ start insert attach_file --------------------------------------*/
        $paragraph_id_path = $this->paragraph_file_path.$paragraph_id;
        if (!file_exists($paragraph_id_path.'/')) {
            mkdir($paragraph_id_path, 0775);
        }
        if (isset($_FILES['attach_file'])) {
            $this->custom_upload->setConfig(array('upload_path' => $paragraph_id_path.'/'));
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

                    $this->m_news->add('news_fileattach', array(
                        'np_paragraph_id' => $paragraph_id,
                        'nf_path' => $uploafile_data,
                        'nf_createdby' => $this->user_id,
                        'nf_updatedby' => $this->user_id
                    ));
                }
            }
        }
        /*------------------------------------- end insert attach_file ---------------------------------------*/
        /*------------------------------------- start insert movement ----------------------------------------*/
        if (isset($_POST['movement']) and $_POST['movement']) {
            foreach ($_POST['movement'] as $v_movement) {
                $this->m_news->add('news_link_movement', array(
                    'np_paragraph_id' => $paragraph_id,
                    'nm_newsmovementid' => $v_movement
                ), false);
            }
        }
        /*-------------------------------------- end insert movement -----------------------------------------*/
        /*---------------------------------------- start insert tag ------------------------------------------*/
        if (isset($_POST['n_keyword']) and $_POST['n_keyword']) {
            foreach (json_decode($_POST['n_keyword']) as $v_keyword) {
                $tagid = $this->m_news->tagExists($v_keyword);
                if(!$tagid) {
                    $tagid['nt_tagid'] = $this->m_news->add('news_tag', array(
                        'nt_word' => trim($v_keyword),
                        'nt_createdby' => $this->user_id
                    ));
                }
                $this->m_news->add('news_link_tag', array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_paragraph_id' => $paragraph_id,
                    'nt_tagid' => $tagid['nt_tagid']
                ), false);
            }
        }
        /*----------------------------------------- end insert tag -------------------------------------------*/
        /*-------------------------------------- start insert person -----------------------------------------*/
        $this->m_news->delete('news_relate_person' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_person']) and $_POST['relate_person']) {
            foreach ($_POST['relate_person'] as $k_relate_person => $v_relate_person) {
                $this->m_news->add('news_relate_person' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_newspersonid' => $k_relate_person, 
                    'nr_injuries' => (isset($v_relate_person['nr_injuries']) && $v_relate_person['nr_injuries']) ? $v_relate_person['nr_injuries'] : 0, 
                    'nr_lose' => (isset($v_relate_person['nr_lose']) && $v_relate_person['nr_lose']) ? $v_relate_person['nr_lose'] : 0
                ), false);
            }
        }
        /*-------------------------------------- start insert person -----------------------------------------*/
        /*------------------------------------- start insert practice ----------------------------------------*/
        $this->m_news->delete('news_relate_practice' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_practice']) and $_POST['relate_practice']) {
            foreach ($_POST['relate_practice'] as $k_relate_practice => $v_relate_practice) {
                $this->m_news->add('news_relate_practice' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_newspracticeid' => $k_relate_practice, 
                    'nr_amount' => (isset($v_relate_practice['nr_amount']) && $v_relate_practice['nr_amount']) ? $v_relate_practice['nr_amount'] : 0
                ), false);
            }
        }
        /*------------------------------------- start insert practice ----------------------------------------*/
        /*--------------------------------------- start insert gun -------------------------------------------*/
        $this->m_news->delete('news_relate_gun' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_gun']) and $_POST['relate_gun']) {
            foreach ($_POST['relate_gun'] as $k_relate_gun => $v_relate_gun) {
                $this->m_news->add('news_relate_gun' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'ng_newsgunid' => $k_relate_gun, 
                    'nr_holdreturn' => (isset($v_relate_gun['nr_holdreturn']) && $v_relate_gun['nr_holdreturn']) ? $v_relate_gun['nr_holdreturn'] : 0, 
                    'nr_hold' => (isset($v_relate_gun['nr_hold']) && $v_relate_gun['nr_hold']) ? $v_relate_gun['nr_hold'] : 0
                ), false);
            }
        }
        /*--------------------------------------- start insert gun -------------------------------------------*/
        
        $insert_new = array(
            'n_dynamitecomplete' => (isset($_POST['n_dynamitecomplete']) && $_POST['n_dynamitecomplete']) ? $_POST['n_dynamitecomplete'] : 0,
            'n_dynamitestop' => (isset($_POST['n_dynamitestop']) && $_POST['n_dynamitestop']) ? $_POST['n_dynamitestop'] : 0,
            'n_unit' => (isset($_POST['n_unit']) && $_POST['n_unit']) ? $_POST['n_unit'] : 0,
            'n_headunit' => (isset($_POST['n_headunit']) && $_POST['n_headunit']) ? $_POST['n_headunit'] : 0,
            'n_remark' => (isset($_POST['n_remark']) && $_POST['n_remark']) ? $_POST['n_remark'] : 0
        );
        
        $this->m_news->edit('news', array('n_newsid' => $_POST['n_newsid']), $insert_new);
        
        /*----------------------------------- start insert dynamitetable --------------------------------------*/
        if (isset($_POST['dynamitetable']) and $_POST['dynamitetable']) {
            foreach ($_POST['dynamitetable'] as $k_dynamitetable => $v_dynamitetable) {
                $this->m_news->add('news_dynamitetable' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'dt_dynamitetypeid' => $v_dynamitetable['dt_dynamitetypeid'], 
                    'it_ignitiontypeid' => $v_dynamitetable['it_ignitiontypeid'], 
                    'ng_createdby' => $this->user_id,
                    'ng_updatedby' => $this->user_id
                ), false);
            }
        }
        /*----------------------------------- start insert dynamitetable --------------------------------------*/
        /*----------------------------------- start delete dynamitetable --------------------------------------*/
        if (isset($_POST['del_dynamitetable']) and $_POST['del_dynamitetable']) {
            foreach ($_POST['del_dynamitetable'] as $v_del_dynamitetable) {
                $this->m_news->delete('news_dynamitetable' . $this->unit_table, array('nd_dynamitetable_id' => $v_del_dynamitetable));
            }
        }
        /*------------------------------------ end delete dynamitetable ---------------------------------------*/

        $tab = (isset($_POST['tab']) and $_POST['tab']) ? $_POST['tab'] : 2;
        redirect(site_url('news/update/' . $_POST['n_newsid'] . '?tab=' . $tab));
        
    }
    
    public function updateParagraph() {
        $paragraph_id = $_POST['paragraph_id'];
        
        $paragraph = $this->m_news->getDetail('news_paragraph', array('np_paragraph_id' => $paragraph_id));
        /*----------------------------------------- start edit img -------------------------------------------*/
        $paragraph_id_path = $this->paragraph_images_path.$paragraph_id;
        if (!file_exists($paragraph_id_path.'/')) {
            mkdir($paragraph_id_path, 0775);
        }
        if (isset($_FILES['image_file']) and $_FILES['image_file']['error'] == 0) {
            $this->custom_upload->setConfig(array('upload_path' => $paragraph_id_path.'/'));
            $upload_data = $this->custom_upload->uploadImage('image_file', false, uniqid());
            if(empty($upload_data['file_name'])) {
                $this->debug($upload_data[0]); exit;
            }
            if (isset($upload_data) and $upload_data and $paragraph['np_mainimage']) {
                delete_file($paragraph_id_path . '/' . $paragraph['np_mainimage']);
            }
        } else if (isset($_POST['del']) and $_POST['del'] == 1 and $paragraph['np_mainimage']) {
            delete_file($paragraph_id_path . '/' . $paragraph['np_mainimage']);
            $paragraph['np_mainimage'] = NULL;
        }
        /*----------------------------------------- end edit img ---------------------------------------------*/
        /*------------------------------------ start insert attach_file --------------------------------------*/
        $paragraph_id_path = $this->paragraph_file_path.$paragraph_id;
        if (!file_exists($paragraph_id_path.'/')) {
            mkdir($paragraph_id_path, 0775);
        }
        if (isset($_FILES['attach_file'])) {
            $this->custom_upload->setConfig(array('upload_path' => $paragraph_id_path.'/'));
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

                    $this->m_news->add('news_fileattach', array(
                        'np_paragraph_id' => $paragraph_id,
                        'nf_path' => $uploafile_data,
                        'nf_createdby' => $this->user_id,
                        'nf_updatedby' => $this->user_id
                    ));
                }
            }
        }
        /*------------------------------------- end insert attach_file ---------------------------------------*/
        /*-------------------------------------- start delete attach -----------------------------------------*/
        if (isset($_POST['del_attach']) and $_POST['del_attach']) {
            $paragraph_id_path = $this->paragraph_file_path.$paragraph_id;
            foreach ($_POST['del_attach'] as $v_del_attach) {
                $del_attach = $this->m_news->getDetail('news_fileattach', array('nf_fileattachid' => $v_del_attach));
                delete_file($paragraph_id_path . '/' . $del_attach['nf_path']);
                $this->m_news->delete('news_fileattach', array('nf_fileattachid' => $v_del_attach));
            }
        }
        /*--------------------------------------- end delete attach ------------------------------------------*/
        /*------------------------------------- start insert movement ----------------------------------------*/
        $this->m_news->delete('news_link_movement', array('np_paragraph_id' => $paragraph_id));
        if (isset($_POST['movement']) and $_POST['movement']) {
            foreach ($_POST['movement'] as $v_movement) {
                $this->m_news->add('news_link_movement', array(
                    'np_paragraph_id' => $paragraph_id,
                    'nm_newsmovementid' => $v_movement
                ), false);
            }
        }
        /*-------------------------------------- end insert movement -----------------------------------------*/
        /*---------------------------------------- start insert tag ------------------------------------------*/
        $this->m_news->delete('news_link_tag', array('np_paragraph_id' => $paragraph_id));
        if (isset($_POST['n_keyword']) and $_POST['n_keyword']) {
            foreach (json_decode($_POST['n_keyword']) as $v_keyword) {
                $tagid = $this->m_news->tagExists($v_keyword);
                if(!$tagid) {
                    $tagid['nt_tagid'] = $this->m_news->add('news_tag', array(
                        'nt_word' => trim($v_keyword),
                        'nt_createdby' => $this->user_id
                    ));
                }
                $this->m_news->add('news_link_tag', array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_paragraph_id' => $paragraph_id,
                    'nt_tagid' => $tagid['nt_tagid']
                ), false);
            }
        }
        /*----------------------------------------- end insert tag -------------------------------------------*/
        /*-------------------------------------- start insert person -----------------------------------------*/
        $this->m_news->delete('news_relate_person' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_person']) and $_POST['relate_person']) {
            foreach ($_POST['relate_person'] as $k_relate_person => $v_relate_person) {
                $this->m_news->add('news_relate_person' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_newspersonid' => $k_relate_person, 
                    'nr_injuries' => (isset($v_relate_person['nr_injuries']) && $v_relate_person['nr_injuries']) ? $v_relate_person['nr_injuries'] : 0, 
                    'nr_lose' => (isset($v_relate_person['nr_lose']) && $v_relate_person['nr_lose']) ? $v_relate_person['nr_lose'] : 0
                ), false);
            }
        }
        /*-------------------------------------- start insert person -----------------------------------------*/
        /*------------------------------------- start insert practice ----------------------------------------*/
        $this->m_news->delete('news_relate_practice' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_practice']) and $_POST['relate_practice']) {
            foreach ($_POST['relate_practice'] as $k_relate_practice => $v_relate_practice) {
                $this->m_news->add('news_relate_practice' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'np_newspracticeid' => $k_relate_practice, 
                    'nr_amount' => (isset($v_relate_practice['nr_amount']) && $v_relate_practice['nr_amount']) ? $v_relate_practice['nr_amount'] : 0
                ), false);
            }
        }
        /*------------------------------------- start insert practice ----------------------------------------*/
        /*--------------------------------------- start insert gun -------------------------------------------*/
        $this->m_news->delete('news_relate_gun' . $this->unit_table, array('n_newsid' => $_POST['n_newsid']));
        if (isset($_POST['relate_gun']) and $_POST['relate_gun']) {
            foreach ($_POST['relate_gun'] as $k_relate_gun => $v_relate_gun) {
                $this->m_news->add('news_relate_gun' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'ng_newsgunid' => $k_relate_gun, 
                    'nr_holdreturn' => (isset($v_relate_gun['nr_holdreturn']) && $v_relate_gun['nr_holdreturn']) ? $v_relate_gun['nr_holdreturn'] : 0, 
                    'nr_hold' => (isset($v_relate_gun['nr_hold']) && $v_relate_gun['nr_hold']) ? $v_relate_gun['nr_hold'] : 0
                ), false);
            }
        }
        /*--------------------------------------- start insert gun -------------------------------------------*/
        
        $insert_new = array(
            'n_dynamitecomplete' => (isset($_POST['n_dynamitecomplete']) && $_POST['n_dynamitecomplete']) ? $_POST['n_dynamitecomplete'] : 0,
            'n_dynamitestop' => (isset($_POST['n_dynamitestop']) && $_POST['n_dynamitestop']) ? $_POST['n_dynamitestop'] : 0,
            'n_unit' => (isset($_POST['n_unit']) && $_POST['n_unit']) ? $_POST['n_unit'] : 0,
            'n_headunit' => (isset($_POST['n_headunit']) && $_POST['n_headunit']) ? $_POST['n_headunit'] : 0,
            'n_remark' => (isset($_POST['n_remark']) && $_POST['n_remark']) ? $_POST['n_remark'] : 0
        );
        
        $this->m_news->edit('news', array('n_newsid' => $_POST['n_newsid']), $insert_new);
        
        /*----------------------------------- start insert dynamitetable --------------------------------------*/
        if (isset($_POST['dynamitetable']) and $_POST['dynamitetable']) {
            foreach ($_POST['dynamitetable'] as $k_dynamitetable => $v_dynamitetable) {
                $this->m_news->add('news_dynamitetable' . $this->unit_table, array(
                    'n_newsid' => $_POST['n_newsid'],
                    'dt_dynamitetypeid' => $v_dynamitetable['dt_dynamitetypeid'], 
                    'it_ignitiontypeid' => $v_dynamitetable['it_ignitiontypeid'], 
                    'ng_createdby' => $this->user_id,
                    'ng_updatedby' => $this->user_id
                ), false);
            }
        }
        /*----------------------------------- start insert dynamitetable --------------------------------------*/
        /*----------------------------------- start delete dynamitetable --------------------------------------*/
        if (isset($_POST['del_dynamitetable']) and $_POST['del_dynamitetable']) {
            foreach ($_POST['del_dynamitetable'] as $v_del_dynamitetable) {
                $this->m_news->delete('news_dynamitetable' . $this->unit_table, array('nd_dynamitetable_id' => $v_del_dynamitetable));
            }
        }
        /*------------------------------------ end delete dynamitetable ---------------------------------------*/
        
        $paragraph_insert = array(
            'np_paragraph' => checkSpanTHsarabun($_POST['np_paragraph']),
            'nd_newsdepartmentid' => 0,
            'nt_newstypeid' => 0,
            'nc_newscountryid' => 0,
            'np_topicforindex' => $_POST['np_topicforindex'],
            'np_updatedby' => $this->user_id
        );
        
        if( isset($_POST['nc_newscauseid']) && $_POST['nc_newscauseid'] ){ $paragraph_insert['nc_newscauseid'] = $_POST['nc_newscauseid']; }
        if( isset($_POST['nh_newsharryid']) && $_POST['nh_newsharryid'] ){ $paragraph_insert['nh_newsharryid'] = $_POST['nh_newsharryid']; }
        if( isset($_POST['ne_newsexecutionid']) && $_POST['ne_newsexecutionid'] ){ $paragraph_insert['ne_newsexecutionid'] = $_POST['ne_newsexecutionid']; }
        if( isset($_POST['province_id']) && $_POST['province_id'] ){ $paragraph_insert['np_newsprovinceid'] = $_POST['province_id']; }
        if( isset($_POST['amphur_id']) && $_POST['amphur_id'] ){ $paragraph_insert['na_newsamphorid'] = $_POST['amphur_id']; }
        if( isset($_POST['district_id']) && $_POST['district_id'] ){ $paragraph_insert['nt_newstambonid'] = $_POST['district_id']; }
        
        $this->m_news->edit('news_paragraph', array('np_paragraph_id' => $paragraph_id), $paragraph_insert);
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(Success)', $paragraph_id );
        
        $tab = (isset($_POST['tab']) and $_POST['tab']) ? $_POST['tab'] : 2;
        redirect(site_url('news/update/' . $paragraph['n_newsid'] . '?tab=' . $tab));
        
    }
    
    public function deleteParagraph($news_id, $paragraph_id = 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paragraph = $this->m_news->getDetail('news_paragraph', array('np_paragraph_id' => $paragraph_id));
            if(isset($paragraph) and $paragraph) {
                $paragraph_id_path = $this->paragraph_images_path.$paragraph_id;
                delete_file($paragraph_id_path . '/' . $paragraph['np_mainimage']);
            }
            
            $fileattach = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $paragraph_id));
            if(isset($fileattach) and $fileattach) {
                $paragraph_id_path = $this->paragraph_file_path.$paragraph_id;
                foreach ($fileattach as $v_fileattach) {
                    delete_file($paragraph_id_path . '/' . $v_fileattach['nf_path']);
                }
                $this->m_news->delete('news_fileattach', array('np_paragraph_id' => $paragraph_id));
            }
            
            $this->m_news->delete('news_link_person', array('np_paragraph_id' => $paragraph_id));
            
            $this->m_news->delete('news_link_organization', array('np_paragraph_id' => $paragraph_id));
            
            $this->m_news->delete('news_link_movement', array('np_paragraph_id' => $paragraph_id));
            
            $this->m_news->delete('news_link_tag', array('np_paragraph_id' => $paragraph_id));
            
            if($this->m_news->delete('news_paragraph', array('n_newsid' => $news_id, 'np_paragraph_id' => $paragraph_id))){
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(Success)', $paragraph_id );
                echo 'true';
            } else {
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(UnSuccess)', $paragraph_id );
                echo 'false';
            }
        } else {
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(UnSuccess)', $this->user_id );
            echo 'false';
        }
    }
    
    public function deleteComment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['id']) {
            $session = $this->getSesstion();
            if(isset($session) and $session['isadmin'] == 'Y') { // หากเป็นadminสามารถลบดได้เลย
                if($this->m_news->delete('news_comment', array('nc_commentid' => $_POST['id']))) {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(Success)', $_POST['id'] );
                    echo 'true';
                } else {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(UnSuccess)', $_POST['id'] );
                    echo 'false';
                }
            } else { // หากเป็นไม่ใช่adminต้องเป็นคนสร้างcommentเท่านั้นถึงลบออกได้
                if($this->m_news->delete('news_comment', array('nc_commentid' => $_POST['id'], 'o_createdby' => $session['user_id']))) {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(Success)', $_POST['id'] );
                    echo 'true';
                } else {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(UnSuccess)', $_POST['id'] );
                    echo 'false';
                }
            }
        } else {
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Delete(UnSuccess)', $this->user_id );
            echo 'false';
        }
    }

    public function detail($id,$keyword=NULL) {
        $sesstion = $this->getSesstion();
        $this->data['sesstion'] = $sesstion;
        //$this->debug($sesstion);
        //exit;
        
        $this->data['cancomment'] = $sesstion['cancomment'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['comment']) and $_POST['comment'] and isset($_POST['nc_commentid']) and $_POST['nc_commentid']) {
                $insert['nc_comment'] = $_POST['comment'];
                $insert['o_updatedby'] = $this->user_id;
                $this->m_news->edit('news_comment', array('nc_commentid' => $_POST['nc_commentid']), $insert);
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->edit_comment", 'Edit(Success)', $_POST['nc_commentid'] );
            } else if(isset($_POST['comment']) and $_POST['comment']) {
                $where_newsid['n_newsid'] = $id; 
                $data_newsid = $this->m_news->getDetail('news',$where_newsid);
                //$this->debug($data_newsid['n_createdby']);
                //exit();
                $insert['nc_read'] = 'N';
                if(isset($data_newsid['n_createdby']) && $data_newsid['n_createdby']){
                    if($data_newsid['n_createdby'] == $this->user_id){
                        $insert['nc_read'] = 'S';
                    }
                }
                $insert['nc_newsid'] = $id;
                $insert['nc_comment'] = $_POST['comment'];
                $insert['nc_level'] = 0;
                $insert['o_createdby'] = $this->user_id;
                $insert['o_updatedby'] = $this->user_id;
                $insert['nc_parentid'] = (isset($_POST['nc_parentid']) and $_POST['nc_parentid']) ? $_POST['nc_parentid'] : 0;
                $commentid = $this->m_news->add('news_comment', $insert);
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->add_comment", 'Add(Success)', $commentid );
                redirect(site_url('news/detail/'.$id));
            }
        }
        $this->data['script'] = array('assets/js/holder.js');
        $this->data['style'] = array('assets/css/pages/bootstrap.min_metro.css','assets/css/pages/bootstrap-responsive.min_metro.css','assets/css/pages/style-metro.css','assets/css/pages/blog.css','assets/css/pages/style-metro-layout.css');
        $this->data['result'] = $this->m_news->getNewsDetail($id);
        
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        $this->data['gallery'] = $this->m_news->getAll('news_imageattach', array('n_newsid' => $id));
        $this->data['attach'] = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $id));
        $this->data['paragraph'] = $this->m_news->getParagraphByNewsID($id);//np_active
        $this->data['comment'] = $this->m_news->getCommentByNewID($id);
        $this->data['relate'] = $this->m_news->getRelateNews($id, $this->user_id);
        $this->data['keyword'] = $keyword;
        
        $this->data['relate_person'] = $this->m_news->getAll('news_relate_person' . $this->unit_table, array('n_newsid' => $id), NULL, 'np_newspersonid asc');
        $this->data['relate_practice'] = $this->m_news->getAll('news_relate_practice' . $this->unit_table, array('n_newsid' => $id), NULL, 'np_newspracticeid asc');
        $this->data['relate_gun'] = $this->m_news->getAll('news_relate_gun' . $this->unit_table, array('n_newsid' => $id), NULL, 'ng_newsgunid asc');
        $this->data['dynamitetable'] = $this->m_news->getAll('news_dynamitetable' . $this->unit_table, array('n_newsid' => $id));
        
        $this->data['news_person'] = $this->m_news->getAll('news_person' . $this->unit_table, NULL, NULL, 'np_seq asc');
        $this->data['news_practice'] = $this->m_news->getAll('news_practice' . $this->unit_table, NULL, NULL, 'np_seq asc');
        $this->data['news_gun'] = $this->m_news->getAll('news_gun' . $this->unit_table, NULL, NULL, 'ng_seq asc');
        $this->data['dynamite_type'] = $this->m_news->getAll('dynamite_type' . $this->unit_table, NULL, NULL, 'dt_dynamitetypeid asc');
        $this->data['ignition_type'] = $this->m_news->getAll('ignition_type' . $this->unit_table, NULL, NULL, 'it_ignitiontypeid asc');
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $id );
        
        $this->data['title_section'] = 'สรุปรายงานข่าว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'สรุปรายงานข่าว', 'link' => site_url('news/lists')), array('name' => 'ข่าว'));
        $this->view('news/v_detail', $this->data); 
    }
    
    public function detail_pdf($id) {
        $this->data['result'] = $this->m_news->getNewsDetail($id);
        
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $id );
        
        //$this->data['gallery'] = $this->m_news->getAll('news_imageattach', array('n_newsid' => $id));
        //$this->data['attach'] = $this->m_news->getAll('news_fileattach', array('np_paragraph_id' => $id));
        $this->data['paragraph'] = $this->m_news->getParagraphByNewsID($id);//np_active
        //$this->data['comment'] = $this->m_news->getCommentByNewID($id);
        //$this->data['relate'] = $this->m_news->getRelateNews($id, $this->user_id);
        
        
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/bootstrap.min_metro.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/font/css/font-awesome.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/style-responsive.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/style-default.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/bootstrap.min.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/bootstrap_for_pdf.min.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/bootstrap.min_metro.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/bootstrap-responsive.min_metro.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/style-metro.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/blog.css').'</style>';
        //$header[] = '<style>'.file_get_contents(base_url().'assets/css/pages/style-metro-layout.css').'</style>';
        $header[] = '<style>'.file_get_contents(base_url().'assets/css/custom.css').'</style>';
        //$header = NULL;
        $html = $this->view_pdf('news/v_detail_pdf', $this->data, $header, true); 
        
        $arr_replace = array('font-family:');
        $html = str_replace($arr_replace, "", $html);
        //echo $html;
        //exit;
        
        $pdfFilePath = "output_pdf_name.pdf";
        
        $this->load->library('m_pdf');
        $mpdf = $this->m_pdf->load();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html);
        //$mpdf->Output($pdfFilePath, "D");
        $mpdf->Output();
    }
    
    public function detail_word($id) {
        $this->data['result'] = $this->m_news->getNewsDetail($id);
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $id );
        
        $this->data['paragraph'] = $this->m_news->getParagraphByNewsID($id);
        
        $header[] = '<style>'.file_get_contents(base_url().'assets/css/custom.css').'</style>';
        $html = $this->view_pdf('news/v_detail_pdf', $this->data, $header, true); 
        //print_r($this->data);
        
        $arr_replace = array('font-family:thsarabun');
        $html = str_replace($arr_replace, "font-family:THSarabun", $html);
        
        $export_name = $this->data['result']['n_subject'];
        //echo $export_name;
        
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=".$export_name.".doc");
        echo $html;
    }
    
    public function manageGallery($id) {
        $this->data['result'] = $this->m_news->getDetail('news', array('n_newsid' => $id));
        $this->data['id'] = $id;

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $id );
        
        $this->data['title_section'] = 'รายการข่าว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายการข่าว', 'link' => site_url('news/lists')), array('name' => 'จัดการอัลบั้มภาพข่าว'));
        
        $this->data['gallery'] = $this->m_news->getAll('news_imageattach', array('n_newsid' => $id));
        $this->data['gallery_unit'] = $this->m_news->getAll('unit_imageattach', array('u_code' => $this->u_code));
        
        $this->view('news/v_manage_gallery', $this->data);
    }
    
    public function ajaxImageList() {
        $html_gallery = '';
        if(isset($_POST['id']) and $_POST['id']) {
            $gallery = $this->m_news->getAll('news_imageattach', array('n_newsid' => $_POST['id']));
            if(isset($gallery) and $gallery) {
                foreach ($gallery as $k_gallery => $v_gallery) {
                    $html_gallery .= '<li>';
                    $html_gallery .= '<div>';
                    $html_gallery .= '<a class="gallery" href="'.getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'">';
                    $html_gallery .= '<img alt="" src="'.getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'" width="100" height="100">';
                    $html_gallery .= '</a>';
                    $html_gallery .= '</div>';
                    $html_gallery .= '<div>';
                    if(isset($_POST['action']) and $_POST['action'] == 'del') {
                        $html_gallery .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery['ni_imageattachid'].', \'news\');">ลบ</button>';
                    } else { 
                        $html_gallery .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery['ni_imageattachid'].', \'news\');">ลบ</button> ';
                        $html_gallery .= '<button type="button" class="btn btn-primary btn-xs add" data-path="'.base_url().getImagePath($this->news_images_path . $_POST['id'] . '/' . $v_gallery['ni_path']).'">ใส่รูป</button>';
                    }
                    $html_gallery .= '</div>';
                    $html_gallery .= '</li>';
                }
            }
        }
        
        $html_unit = '';
        $gallery_unit = $this->m_news->getAll('unit_imageattach', array('u_code' => $this->u_code));
        if(isset($gallery_unit) and $gallery_unit) {
            foreach ($gallery_unit as $k_gallery_unit => $v_gallery_unit) {
                $html_unit .= '<li>';
                $html_unit .= '<div>';
                $html_unit .= '<a class="gallery" href="'.getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'">';
                $html_unit .= '<img alt="" src="'.getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'" width="100" height="100">';
                $html_unit .= '</a>';
                $html_unit .= '</div>';
                $html_unit .= '<div>';
                if(isset($_POST['action']) and $_POST['action'] == 'del') {
                    $html_unit .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery_unit['ui_imageattachid'].', \'unit\');">ลบ</button>';
                } else { 
                    $html_unit .= '<button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), '.$v_gallery_unit['ui_imageattachid'].', \'unit\');">ลบ</button> ';
                    $html_unit .= '<button type="button" class="btn btn-primary btn-xs add" data-path="'.base_url().getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']).'">ใส่รูป</button>';
                }
                $html_unit .= '</div>';
                $html_unit .= '</li>';
            }
        } else {
            $html_unit .= '<p>ไม่พบรูปภาพในระบบ..</p>';
        }
        echo json_encode(array('gallery' => $html_gallery, 'gallery_unit' => $html_unit));
    }
    
    public function checkApproveCode() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['n_approvercode']) and $_POST['n_approvercode'] and isset($this->u_unitid) and $this->u_unitid) {
            $result = $this->m_news->getDetail('unit', array('u_unitid' => $this->u_unitid));
            if(isset($result) and $result and $result['u_approvecode'] == $_POST['n_approvercode']) {
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }
    
    public function changeStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['id']) and $_POST['id']) {
            $result = $this->m_news->getDetail('news', array('n_newsid' => $_POST['id']));
            if((isset($this->user_id) and $this->user_id == $result['n_createdby']) or (isset($this->isadmin) and $this->isadmin == 'Y')){
                if(isset($result['n_active']) and $result['n_active'] == 'Y') {
                    $status = 'N';
                } else {
                    $status = 'Y';
                }
                $this->m_news->edit('news', array('n_newsid' => $_POST['id']),  array('n_active' => $status));
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(Success)', $_POST['id'] );
            } else {
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(UnSuccess)', $_POST['id'] );
                $status = 'false';
            }
        } else {
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(UnSuccess)', $this->user_id );
            $status = 'false';
        }
        echo $status;
    }
    
    public function searchTags() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['q']) and $_POST['q']) {
            $result = $this->m_news->searchTag(strtolower($_POST['q']));
            $arr = array();
            if(isset($result) and $result) {
                foreach ($result as $value) {
                    $arr[] = $value['nt_word'];
                }
            }
            echo json_encode($arr);
        }
    }
    
    public function ajaxInsert() {
        switch ($_GET['type']) {
            case 'person':
                $insert = array(
                    'p_firstname' => $_POST['p_firstname'],
                    'p_lastname' => $_POST['p_lastname'],
                    'p_title' => " ",
                    'p_gender' => " ",
                    'p_unit' => $this->u_unitid, 
                    'p_createdby' => $this->user_id,
                    'p_updatedby' => $this->user_id
                );
                $id = $this->m_news->add('person', $insert);
                if(isset($id) and $id) {
                    $arr_result['succress'] = 'true';
                    $arr_result['value'] = $id;
                    $arr_result['text'] = $_POST['p_firstname'].' '.$_POST['p_lastname'];
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->person", 'Add(Success)', $id );
                } else {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->person", 'Add(UnSuccess)', $this->user_id );
                    $arr_result['succress'] = 'false';
                }
            break;
            
            case 'organization':
                $insert = array(
                    'o_fullnameth' => $_POST['o_fullnameth'],
                    'o_unit' => $this->u_unitid, 
                    'o_createdby' => $this->user_id,
                    'o_updatedby' => $this->user_id
                );
                $id = $this->m_news->add('organization', $insert);
                if(isset($id) and $id) {
                    $arr_result['succress'] = 'true';
                    $arr_result['value'] = $id;
                    $arr_result['text'] = $_POST['o_fullnameth'];
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->organization", 'Add(Success)', $id );
                } else {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->organization", 'Add(UnSuccess)', $this->user_id );
                    $arr_result['succress'] = 'false';
                }
            break;
            
            case 'movement':
                $insert = array(
                    'nm_name' => $_POST['nm_name'],
                    'nm_createdby' => $this->user_id,
                    'nm_updatedby' => $this->user_id
                );
                $id = $this->m_news->add('news_movement', $insert);
                if(isset($id) and $id) {
                    $arr_result['succress'] = 'true';
                    $arr_result['value'] = $id;
                    $arr_result['text'] = $_POST['nm_name'];
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->movement", 'Add(Success)', $id );
                } else {
                    $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}->movement", 'Add(UnSuccess)', $this->user_id );
                    $arr_result['succress'] = 'false';
                }
            break;

            default:
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Add(UnSuccess)', $this->user_id );
                $arr_result['succress'] = 'false';
            break;
        }
        echo json_encode((object)$arr_result);
    }
    
    public function ajaxAmphur() {
        $html = '<option value="0">กรุณาเลือกอำเภอ</option>';
        if(isset($_POST['province_id']) and $_POST['province_id']) {
            $amphur = $this->m_news->getAll('amphur', array('province_id' => $_POST['province_id']));
            if(isset($amphur) and $amphur) {
                foreach ($amphur as $v_amphur) {
                    $html .= '<option value="'.$v_amphur['amphur_id'].'">'.$v_amphur['amphur_name'].'</option>';
                }
            }
        }
        echo $html;
    }
    
    public function ajaxDistrict() {
        $html = '<option value="0">กรุณาเลือกตำบล</option>';
        if(isset($_POST['amphur_id']) and $_POST['amphur_id']) {
            $district = $this->m_news->getAll('district', array('amphur_id' => $_POST['amphur_id']));
            if(isset($district) and $district) {
                foreach ($district as $v_district) {
                    $html .= '<option value="'.$v_district['district_id'].'">'.$v_district['district_name'].'</option>';
                }
            }
        }
        echo $html;
    }
    
    public function check_unitid(){
        $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'View', $this->user_id );
        $s_unitsub_id = (isset($_POST['s_unitsub_id']) and $_POST['s_unitsub_id']) ? $_POST['s_unitsub_id'] : '';
        if($this->canread == 'N' and $this->isadmin == 'N') {
            $data_result = $this->m_news->getDetail('unit_sub',array('s_unitsub_id' => $this->s_unitsubid));
            if($data_result != ""){
                echo '<option value="0"> ทุกหน่วยงาน </option>';
                if(isset($s_unitsub_id) and $s_unitsub_id == $data_result['s_unitsub_id']) {
                    echo '<option value="'.$data_result['s_unitsub_id'].'" selected>'.$data_result['s_name'].'</option>';
                } else {
                    echo '<option value="'.$data_result['s_unitsub_id'].'">'.$data_result['s_name'].'</option>';
                }
            }else{
                echo '';
            }
        } else {
            $data['u_unitid'] = $_POST['u_unitid'];
            $data_result = $this->m_news->getAll('unit_sub',$data);
            if($data_result != ""){
                   echo '<option value="0"> ทุกหน่วยงาน </option>';
                foreach ($data_result as $key=>$values){
                    if(isset($s_unitsub_id) and $s_unitsub_id == $values['s_unitsub_id']) {
                        echo '<option value="'.$values['s_unitsub_id'].'" selected>'.$values['s_name'].'</option>';
                    } else {
                        echo '<option value="'.$values['s_unitsub_id'].'">'.$values['s_name'].'</option>';
                    }
                }
            }else{
                echo '';
            }
        }
    }
    
    public function updateReportType() {
        if((isset($_POST['n_newsid']) && $_POST['n_newsid']) && (isset($_POST['rt_reporttypeid']) && $_POST['rt_reporttypeid'])) {
            if( $this->m_news->edit('news', array('n_newsid' => $_POST['n_newsid']),  array( 'rt_reporttypeid' => $_POST['rt_reporttypeid'] )) ) {
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(Success)', $_POST['n_newsid'] );
                echo 'true';
            } else {
                $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(UnSuccess)', $_POST['n_newsid'] );
                echo 'false';
            }
        } else {
            $this->action_log( $this->m_news,"{$this->router->fetch_class()}->{$this->router->fetch_method()}", 'Edit(Success)', $this->user_id );
            echo 'false';
        }
    }
    public function favorite_insert($news_id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_news,'Favorite->insert','Add',$sesstion['user_id']);
        
        if(isset($news_id) && $news_id != ''){
            $insert['n_newsid']            = $news_id;
            $insert['ua_userid']           = $sesstion['user_id'];
            $insert['f_description']       = "";
            $insert['f_createdby']         = $sesstion['user_id'];
            $insert['f_updatedby']         = $sesstion['user_id'];
            $this->m_news->add('favorite', $insert);
        }
        //echo $news_id;
        //exit();
        
        redirect(site_url('news/dashboard'));
        
    }
    public function favorite_delete($news_id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_news,'Favorite->delete','Delete',$sesstion['user_id']);
        
        if(isset($news_id) && $news_id != ''){
            $where['n_newsid']            = $news_id;
            $where['ua_userid']           = $sesstion['user_id'];
            $this->m_news->delete('favorite', $where);
        }
        
        redirect(site_url('news/dashboard'));
        
    }
    private function setFormValidation() {
        $this->form_validation->set_rules('rt_reporttypeid', 'ประเภทรายงาน*', 'required');
    }
    
    private function setNewArray($array = array(), $key = '') {
        $new_array = array();
        if(isset($array) and $array) {
            foreach ($array as $value) {
                $new_array[] = $value[$key];
            }
        }
        return $new_array;
    }
}