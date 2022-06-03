<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Secret_level extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
        $this->data['title_section'] = 'ชั้นความลับ';
    }

    public function lists($offset = 0) {
        $where_reposl_rows = $where = NULL;
        $like = NULL;
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Secret_level->lists','View',$sesstion['user_id']);
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('secret_level', $where, $like, 'sl_secretid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'secret_level/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('secret_level', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'ชั้นความลับ';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ชั้นความลับ'));
        $this->data['total_secret_level_rows'] = $this->m_db->getCountAll('secret_level', $where_reposl_rows);
        $this->view('secret_level/v_lists', $this->data);
    }
    
    public function insert() {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Secret_level->insert','Add',$sesstion['user_id']);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('secret_level/v_form', $this->data);
            } else {
                $insert['sl_name']              = $_POST['sl_name'];
                $insert['sl_description']       = (isset($_POST['sl_description']) and $_POST['sl_description']) ? $_POST['sl_description'] : NULL;
                $insert['sl_createdby']         = $user_id = 1;
                $insert['sl_updatedby']         = $user_id = 1;
                $secret_level_id = $this->m_db->add('secret_level', $insert);
                $this->action_log($this->m_db,'Secret_level->insert','Add(Success)',$secret_level_id);
                redirect(site_url('secret_level/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Secret_level->insert','Add(UnSuccess)',$sesstion['user_id']);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ชั้นความลับ', 'link' => site_url('secret_level/lists')), array('name' => 'เพิ่มชั้นความลับ'));
            $this->view('secret_level/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('secret_level', array('sl_secretid' => $id));
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Secret_level->update','Edit',$id);
        
        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('secret_level/v_form', $this->data);
            } else {
                $insert['sl_name']              = $_POST['sl_name'];
                $insert['sl_description']       = (isset($_POST['sl_description']) and $_POST['sl_description']) ? $_POST['sl_description'] : NULL;
                $insert['sl_createdby']         = $user_id = 1;
                $insert['sl_updatedby']         = $user_id = 1;
                $insert['sl_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('secret_level', array('sl_secretid' => $id), $insert);
                $this->action_log($this->m_db,'Secret_level->update','Edit(Success)',$id);
                
                redirect(site_url('secret_level/lists'));
            }
        } else {
            $this->action_log($this->m_db,'Secret_level->update','Edit(UnSuccess)',$id);
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ชั้นความลับ', 'link' => site_url('secret_level/lists')), array('name' => 'แก้ไขชั้นความลับ'));
            $this->view('secret_level/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Secret_level->delete','Delete',$id);
        $this->data['result'] = $this->m_db->getDetail('secret_level', array('sl_secretid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('secret_level', array('sl_secretid' => $id))) {
            $this->action_log($this->m_db,'Secret_level->delete','Delete(Success)',$id);
            $this->m_db->edit('news', array('sl_secretid' => $id,'u_unitid' => $sesstion['unitid']), array('sl_secretid' => 0));
        }else{
             $this->action_log($this->m_db,'Secret_level->delete','Delete(UnSuccess)',$id);
        }
        
        redirect(site_url('secret_level/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('sl_name', 'ชื่อชั้นความลับ*', 'required');
    }
}