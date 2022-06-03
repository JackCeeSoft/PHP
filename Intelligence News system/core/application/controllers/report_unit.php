<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Report_unit extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
        $this->data['title_section'] = 'ระบบรายงาน';
    }

    public function lists($offset = 0) {
        $where_reporu_rows = $where = NULL;
        $like = NULL;
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Report_unit->lists','View',$sesstion['user_id']);
        
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('report_unit', $where, $like, 'ru_reportunitid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'report_unit/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('report_unit', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ระบบรายงาน';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ระบบรายงาน'));
        $this->data['total_report_unit_rows'] = $this->m_db->getCountAll('report_unit', $where_reporu_rows);
        $this->view('report_unit/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Report_unit->lists','Add',$sesstion['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('report_unit/v_form', $this->data);
            } else {
                $insert['ru_name']              = $_POST['ru_name'];
                $insert['ru_description']       = (isset($_POST['ru_description']) and $_POST['ru_description']) ? $_POST['ru_description'] : NULL;
                $insert['ru_createdby']         = $user_id = 1;
                $insert['ru_updatedby']         = $user_id = 1;
                $report_unit_id = $this->m_db->add('report_unit', $insert);
                $this->action_log($this->m_db,'Report_unit->lists','Add(Success)',$report_unit_id);
                
                redirect(site_url('report_unit/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Report_unit->lists','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ระบบรายงาน', 'link' => site_url('report_unit/lists')), array('name' => 'เพิ่มระบบรายงาน'));
            $this->view('report_unit/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->action_log($this->m_db,'Report_unit->update','Edit',$id);
        $this->data['result'] = $this->m_db->getDetail('report_unit', array('ru_reportunitid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('report_unit/v_form', $this->data);
            } else {
                $insert['ru_name']              = $_POST['ru_name'];
                $insert['ru_description']       = (isset($_POST['ru_description']) and $_POST['ru_description']) ? $_POST['ru_description'] : NULL;
                $insert['ru_createdby']         = $user_id = 1;
                $insert['ru_updatedby']         = $user_id = 1;
                $insert['ru_updateddate']       = date('Y-m-d H:i:s');
                $this->action_log($this->m_db,'Report_unit->update','Edit(Success)',$id);
                $result = $this->m_db->edit('report_unit', array('ru_reportunitid' => $id), $insert);
                redirect(site_url('report_unit/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Report_unit->update','Edit(UnSuccess)',$id);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ระบบรายงาน', 'link' => site_url('report_unit/lists')), array('name' => 'แก้ไขระบบรายงาน'));
            $this->view('report_unit/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $this->data['result'] = $this->m_db->getDetail('report_unit', array('ru_reportunitid' => $id));
        $this->action_log($this->m_db,'Report_unit->delete','Delete',$id);
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('report_unit', array('ru_reportunitid' => $id))) {
            $this->action_log($this->m_db,'Report_unit->delete','Delete(Success)',$id);
            $this->m_db->edit('news', array('ru_reportunitid' => $id), array('ru_reportunitid' => 0));
        }else{
            $this->action_log($this->m_db,'Report_unit->delete','Delete(UnSuccess)',$id);
        }
        
        redirect(site_url('report_unit/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('ru_name', 'ชื่อระบบรายงาน*', 'required');
    }
}