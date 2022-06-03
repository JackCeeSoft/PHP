<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Report_type extends Base_e_army {
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
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
        $this->data['title_section'] = 'ประเภทรายงาน';
        $this->get_startparamiter();
    }
    public function get_startparamiter(){
        $sesstion = $this->getSesstion();
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
        $this->u_code = (isset($sesstion['u_code']) and $sesstion['u_code']) ? $sesstion['u_code'] : '01';
    }
    
    public function lists($offset = 0) {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Report_type->lists','View',$sesstion['user_id']);
        
        $where_report_rows = $where = NULL;
        $like = NULL;
        
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('report_type5', $where, $like, 'rt_reporttypeid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'report_type/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('report_type5', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ประเภทรายงาน';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ประเภทรายงาน'));
        $this->data['total_report_type_rows'] = $this->m_db->getCountAll('report_type5', $where_report_rows);
        $this->view('report_type/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Report_type->insert','Add',$sesstion['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('report_type/v_form', $this->data);
            } else {
                $insert['rt_name']              = $_POST['rt_name'];
                $insert['rt_description']       = (isset($_POST['rt_description']) and $_POST['rt_description']) ? $_POST['rt_description'] : NULL;
                $insert['rt_createdby']         = $this->user_id;
                $insert['rt_updatedby']         = $this->user_id;
                $report_type_id = $this->m_db->add('report_type5', $insert);
                $this->action_log($this->m_db,'Report_type->insert','Add(Success)',$report_type_id);
                
                redirect(site_url('report_type/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Report_type->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ประเภทรายงาน', 'link' => site_url('report_type/lists')), array('name' => 'เพิ่มประเภทรายงาน'));
            $this->view('report_type/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('report_type5', array('rt_reporttypeid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('report_type/v_form', $this->data);
            } else {
                $insert['rt_name']              = $_POST['rt_name'];
                $insert['rt_description']       = (isset($_POST['rt_description']) and $_POST['rt_description']) ? $_POST['rt_description'] : NULL;
                $insert['rt_createdby']         = $this->user_id;
                $insert['rt_updatedby']         = $this->user_id;
                $insert['rt_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('report_type5', array('rt_reporttypeid' => $id), $insert);
                redirect(site_url('report_type/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ประเภทรายงาน', 'link' => site_url('report_type/lists')), array('name' => 'แก้ไขประเภทรายงาน'));
            $this->view('report_type/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('report_type5', array('rt_reporttypeid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('report_type5', array('rt_reporttypeid' => $id))) {
            $this->m_db->edit('news', array('rt_reporttypeid' => $id,'u_unitid' => $sesstion['unitid']), array('rt_reporttypeid' => 0));
            //$this->m_db->edit('news', array('rt_reporttypeid' => $id), array('rt_reporttypeid' => 0, 'sl_secretid' => 0, 'hl_hastelevelid' => 0, 'ru_reportunitid' => 0));
        }
        
        redirect(site_url('report_type/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('rt_name', 'ชื่อประเภทข่าวสาร*', 'required');
    }
}