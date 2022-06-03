<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_movement extends Base_e_army {
    
    public $user_id;
    public $u_unitid;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
        $this->data['title_section'] = 'ความเคลื่อนไหวของข่าว';
        
        $sesstion = $this->getSesstion();
        $this->user_id = $sesstion['user_id'];
        $this->u_unitid = $sesstion['unitid'];
    }

    public function lists($offset = 0) {
        $where_movement_rows = $where = NULL;
        $like = NULL;
        
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('news_movement', $where, $like, 'nm_createddate DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'news_movement/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('news_movement', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ความเคลื่อนไหวของข่าว';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเคลื่อนไหวของข่าว'));
        $this->data['total_news_movement_rows'] = $this->m_db->getCountAll('news_movement', $where_movement_rows);
        $this->view('news_movement/v_lists', $this->data);
    }
    
    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_movement/v_form', $this->data);
            } else {
                $insert['nm_name']              = $_POST['nm_name'];
                $insert['nm_description']       = (isset($_POST['nm_description']) and $_POST['nm_description']) ? $_POST['nm_description'] : NULL;
                $insert['nm_createdby']         = $user_id = 1;
                $insert['nm_updatedby']         = $user_id = 1;
                $news_movement_id = $this->m_db->add('news_movement', $insert);
                
                redirect(site_url('news_movement/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเคลื่อนไหวของข่าว', 'link' => site_url('news_movement/lists')), array('name' => 'เพิ่มความเคลื่อนไหวของข่าว'));
            $this->view('news_movement/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('news_movement', array('nm_newsmovementid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_movement/v_form', $this->data);
            } else {
                $insert['nm_name']              = $_POST['nm_name'];
                $insert['nm_description']       = (isset($_POST['nm_description']) and $_POST['nm_description']) ? $_POST['nm_description'] : NULL;
                $insert['nm_createdby']         = $user_id = $this->user_id;
                $insert['nm_updatedby']         = $user_id = $this->user_id;
                $insert['nm_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('news_movement', array('nm_newsmovementid' => $id), $insert);
                redirect(site_url('news_movement/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเคลื่อนไหวของข่าว', 'link' => site_url('news_movement/lists')), array('name' => 'แก้ไขความเคลื่อนไหวของข่าว'));
            $this->view('news_movement/v_form', $this->data);
        }
    }
    
    public function look($id = '') {
        $this->data['result'] = $this->m_db->getDetail('news_movement', array('nm_newsmovementid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเคลื่อนไหวของข่าว', 'link' => site_url('news_movement/lists')), array('name' => 'แก้ไขความเคลื่อนไหวของข่าว'));
        $this->data['look'] = true;
        $this->view('news_movement/v_form', $this->data);
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('news_movement', array('nm_newsmovementid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('news_movement', array('nm_newsmovementid' => $id))) {
            $this->m_db->edit('news', array('nm_newsmovementid' => $id,'u_unitid' => $sesstion['unitid']), array('nm_newsmovementid' => 0));
        }
        
        redirect(site_url('news_movement/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('nm_name', 'ชื่อความเคลื่อนไหวของข่าว*', 'required');
    }
}