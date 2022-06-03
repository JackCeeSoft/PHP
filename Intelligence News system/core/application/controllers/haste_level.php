<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Haste_level extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
        $this->data['title_section'] = 'ความเร่งด่วน';
    }

    public function lists($offset = 0) {
        $where_repohl_rows = $where = NULL;
        $like = NULL;
        
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Haste_level->lists','View',$sesstion['user_id']);
        
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('haste_level', $where, $like, 'hl_hastelevelid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'haste_level/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('haste_level', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ความเร่งด่วน';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเร่งด่วน'));
        $this->data['total_haste_level_rows'] = $this->m_db->getCountAll('haste_level', $where_repohl_rows);
        $this->view('haste_level/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Haste_level->insert','Add',$sesstion['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('haste_level/v_form', $this->data);
            } else {
                $insert['hl_name']              = $_POST['hl_name'];
                $insert['hl_description']       = (isset($_POST['hl_description']) and $_POST['hl_description']) ? $_POST['hl_description'] : NULL;
                $insert['hl_createdby']         = $user_id = 1;
                $insert['hl_updatedby']         = $user_id = 1;
                $haste_level_id = $this->m_db->add('haste_level', $insert);
                $this->action_log($this->m_db,'Haste_level->insert','Add(Success)',$haste_level_id);
                
                redirect(site_url('haste_level/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Haste_level->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเร่งด่วน', 'link' => site_url('haste_level/lists')), array('name' => 'เพิ่มความเร่งด่วน'));
            $this->view('haste_level/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('haste_level', array('hl_hastelevelid' => $id));
        $this->action_log($this->m_db,'Haste_level->update','Edit',$id);
        
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('haste_level/v_form', $this->data);
            } else {
                $insert['hl_name']              = $_POST['hl_name'];
                $insert['hl_description']       = (isset($_POST['hl_description']) and $_POST['hl_description']) ? $_POST['hl_description'] : NULL;
                $insert['hl_createdby']         = $user_id = 1;
                $insert['hl_updatedby']         = $user_id = 1;
                $insert['hl_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('haste_level', array('hl_hastelevelid' => $id), $insert);
                $this->action_log($this->m_db,'Haste_level->update','Edit(Success)',$id);
                redirect(site_url('haste_level/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Haste_level->update','Edit(UnSuccess)',$id);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ความเร่งด่วน', 'link' => site_url('haste_level/lists')), array('name' => 'แก้ไขความเร่งด่วน'));
            $this->view('haste_level/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Haste_level->update','Delete',$id);
        
        $this->data['result'] = $this->m_db->getDetail('haste_level', array('hl_hastelevelid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('haste_level', array('hl_hastelevelid' => $id))) {
             $this->action_log($this->m_db,'Haste_level->update','Delete(Success)',$id);
            $this->m_db->edit('news', array('hl_hastelevelid' => $id,'u_unitid' => $sesstion['unitid']), array('hl_hastelevelid' => 0));
        }else{
            $this->action_log($this->m_db,'Haste_level->update','Delete(UnSuccess)',$id);
        }
        
        redirect(site_url('haste_level/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('hl_name', 'ชื่อความเร่งด่วน*', 'required');
    }
}