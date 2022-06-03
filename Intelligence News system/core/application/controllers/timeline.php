<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Timeline extends Base_e_army {
    
    public $news_images_path;
    public $paragraph_images_path;
    public $user_id;
    public $u_unitid;
    public $s_unitsubid;
    public $unit_table;


    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_news');
        $this->news_images_path = $this->config->item('root_upload').$this->config->item('images_path_news');
        $this->paragraph_images_path = $this->config->item('root_upload').$this->config->item('images_path_paragraph');
        
        $this->data['script'] = array(
            //'assets/bootstrap3-datetimepicker/js/moment.js', 
            //'assets/bootstrap3-datetimepicker/js/bootstrap-datetimepicker.min.js', 
            'assets/js/bootstrap-datetimepicker.min.js', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.js', 
        );
        $this->data['style'] = array(
            'assets/css/bootstrap-combined.min.css', 
            //'assets/bootstrap3-datetimepicker/css/bootstrap-datetimepicker.min.css', 
            'assets/css/bootstrap-datetimepicker.min.css', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.css', 
            'assets/css/pages/bootstrap.min_metro.css', 
            'assets/css/pages/bootstrap-responsive.min_metro.css', 
            //'assets/css/pages/style-metro.css', 
            'assets/css/timeline.css',
            'assets/css/pages/timeline.css'
        );
        
        $this->data['title_section'] = 'ปฎิทินความเคลื่อนไหว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ปฎิทินความเคลื่อนไหว'));
        
        $sesstion = $this->getSesstion();
        $this->user_id = $sesstion['user_id'];
        $this->u_unitid = $sesstion['unitid'];
        $this->s_unitsubid = $sesstion['subunitid'];
        $this->unit_table = 5;
    }
    
    public function index() {
        $this->data['report_type'] = $this->m_news->getAll('report_type' . $this->unit_table, NULL, NULL, 'rt_reporttypeid asc');
        //$this->data['report_unit'] = $this->m_news->getAll('report_unit', NULL, NULL, 'ru_reportunitid asc');
        //$this->data['news_movement'] = $this->m_news->getAll('news_movement', NULL, NULL, 'nm_newsmovementid asc');
        //$this->data['news_department'] = $this->m_news->getAll('news_department', NULL, NULL, 'nd_newsdepartmentid asc');
        //$this->data['news_type'] = $this->m_news->getAll('news_type', NULL, NULL, 'nt_newstypeid asc');
        
        //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $or_where = NULL;
            $where['n_active'] = 'Y';
            
            if(isset($this->u_unitid) and $this->u_unitid)
            $where['u_unitid'] = $this->u_unitid;
        
            if(isset($this->s_unitsubid) and $this->s_unitsubid)
                $where['s_unitsub_id'] = $this->s_unitsubid;
            
            if (isset($_POST['rt_reporttypeid']) and $_POST['rt_reporttypeid'])
                $this->data['filter']['rt_reporttypeid'] = $where['rt_reporttypeid'] = $_POST['rt_reporttypeid'];
            else
                $this->data['filter']['rt_reporttypeid'] = $where['rt_reporttypeid'] = 1;
            
            if (isset($_POST['ru_reportunitid']) and $_POST['ru_reportunitid'])
                $this->data['filter']['ru_reportunitid'] = $where['ru_reportunitid'] = $_POST['ru_reportunitid'];
            
            if (isset($_POST['nd_newsdepartmentid']) and $_POST['nd_newsdepartmentid'])
                $this->data['filter']['nd_newsdepartmentid'] = $where['news_paragraph.nd_newsdepartmentid'] = $_POST['nd_newsdepartmentid'];
            
            if (isset($_POST['nt_newstypeid']) and $_POST['nt_newstypeid'])
                $this->data['filter']['nt_newstypeid'] = $where['news_paragraph.nt_newstypeid'] = $_POST['nt_newstypeid'];
            
            if ((isset($_POST['start']) and $_POST['start']) and (isset($_POST['end']) and $_POST['end'])) {
                $this->data['filter']['start'] = $between['start'] = $_POST['start'];
                $this->data['filter']['end'] = $between['end'] = $_POST['end'];
            } else {
                $this->data['filter']['start'] = $between['start'] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
                $this->data['filter']['end'] = $between['end'] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
            }
            
            if (isset($_POST['view']) and $_POST['view'])
                $this->data['filter']['view'] = $_POST['view'];
            else
                $this->data['filter']['view'] = 'subject';
            
            if (isset($_POST['movement']) and $_POST['movement']) {
                $or_where = '(';
                foreach ($_POST['movement'] as $v_movement) {
                    $or_where .= '"nm_newsmovementid" = \'' . $v_movement . '\' OR ';
                }
                $or_where .= ' 1 = 1)';
                $this->data['movemented'] = $_POST['movement'];
            }
            
            $this->data['result'] = $this->m_news->getSearchTimeline($where, $or_where, $between);
            //$this->debug($this->data['result']); //exit;
            
        //}
        
        $this->view('timeline/v_index', $this->data);
    }
    
}