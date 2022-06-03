<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_country extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_db');
        $this->data['title_section'] = 'ประเทศ';
    }

    public function lists($offset = 0) {
        $where_report_rows = $where = NULL;
        $like = NULL;
        //$sesstion = $this->getSesstion();
        //print_r($sesstion);
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('news_country', $where, $like, 'nc_newscountryid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'news_country/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('news_country', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ประเทศ';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อประเทศ'));
        $this->data['total_report_type_rows'] = $this->m_db->getCountAll('news_country', $where_report_rows);
        $this->view('news_country/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_country/v_form', $this->data);
            } else {
                $insert['nc_name']              = $_POST['nc_name'];
                $insert['nc_description']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
                $insert['nc_createdby']         = $sesstion['user_id'];
                $insert['nc_createddate']       = date('Y-m-d H:i:s');
                $insert['nc_updatedby']         = $sesstion['user_id'];
                $insert['nc_updateddate']       = date('Y-m-d H:i:s');
                $report_type_id = $this->m_db->add('news_country', $insert);	
                redirect(site_url('news_country/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อประเภทข่าวกรอง', 'link' => site_url('news_country/lists')), array('name' => 'เพิ่มประเภทข่าวกรอง'));
            $this->view('news_country/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('news_country', array('nc_newscountryid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_country/v_form', $this->data);
            } else {
                $insert['nc_name']              = $_POST['nc_name'];
                $insert['nc_description']       = (isset($_POST['nc_description']) and $_POST['nc_description']) ? $_POST['nc_description'] : NULL;
                $insert['nc_updatedby']         = $sesstion['user_id'];
                $insert['nc_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('news_country', array('nc_newscountryid' => $id), $insert);
                redirect(site_url('news_country/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อประเทศ', 'link' => site_url('news_country/lists')), array('name' => 'แก้ไขประเทศ'));
            $this->view('news_country/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $this->data['result'] = $this->m_db->getDetail('news_country', array('nc_newscountryid' => $id));
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('news_country', array('nc_newscountryid' => $id))) {
            //$this->m_db->edit('news', array('nd_newsdepartmentid' => $id), array('nd_newsdepartmentid' => 0));
            //$this->m_db->edit('news', array('rt_reporttypeid' => $id), array('rt_reporttypeid' => 0, 'sl_secretid' => 0, 'hl_hastelevelid' => 0, 'ru_reportunitid' => 0));
        }
        
        redirect(site_url('news_country/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('nc_name', 'ชื่อประเทศ*', 'required');
    }
}