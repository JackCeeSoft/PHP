<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_department extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_db');
        $this->data['title_section'] = 'แผนกด้าน';
    }

    public function lists($offset = 0) {
        $where_report_rows = $where = NULL;
        $like = NULL;
        //$sesstion = $this->getSesstion();
        //print_r($sesstion);
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('news_department', $where, $like, 'nd_newsdepartmentid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'news_department/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('news_department', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'แผนกด้าน';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อแผนกด้าน'));
        $this->data['total_report_type_rows'] = $this->m_db->getCountAll('news_department', $where_report_rows);
        $this->view('news_department/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        //print_r($sesstion);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_department/v_form', $this->data);
            } else {
                $insert['nd_name']              = $_POST['nd_name'];
                $insert['nd_description']       = (isset($_POST['nd_description']) and $_POST['nd_description']) ? $_POST['nd_description'] : NULL;
                $insert['nd_createdby']         = $sesstion['user_id'];
                $insert['nd_createddate']       = date('Y-m-d H:i:s');
                $insert['nd_updatedby']         = $sesstion['user_id'];
                $insert['nd_updateddate']       = date('Y-m-d H:i:s');
                $report_type_id = $this->m_db->add('news_department', $insert);	
                redirect(site_url('news_department/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อแผนกด้าน', 'link' => site_url('news_department/lists')), array('name' => 'เพิ่มแผนกด้าน'));
            $this->view('news_department/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('news_department', array('nd_newsdepartmentid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_department/v_form', $this->data);
            } else {
                $insert['nd_name']              = $_POST['nd_name'];
                $insert['nd_description']       = (isset($_POST['nd_description']) and $_POST['nd_description']) ? $_POST['nd_description'] : NULL;
                $insert['nd_updatedby']         = $sesstion['user_id'];
                $insert['nd_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('news_department', array('nd_newsdepartmentid' => $id), $insert);
                redirect(site_url('news_department/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'รายชื่อแผนกด้าน', 'link' => site_url('news_department/lists')), array('name' => 'แก้ไขแผนกด้าน'));
            $this->view('news_department/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('news_department', array('nd_newsdepartmentid' => $id));
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('news_department', array('nd_newsdepartmentid' => $id))) {
            $this->m_db->edit('news', array('nd_newsdepartmentid' => $id,'u_unitid' => $sesstion['unitid']), array('nd_newsdepartmentid' => 0));
            //$this->m_db->edit('news', array('rt_reporttypeid' => $id), array('rt_reporttypeid' => 0, 'sl_secretid' => 0, 'hl_hastelevelid' => 0, 'ru_reportunitid' => 0));
        }
        
        redirect(site_url('news_department/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('nd_name', 'ชื่อแผนก*', 'required');
    }
}