<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_person5 extends Base_e_army {
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
        
        $this->data['title_section'] = 'บุคคล,สูญเสีย,บาดเจ็บ';
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
        $where_report_rows = $where = NULL;
        $like = NULL;
        
        //$limit = $this->pagination_limit;
        $limit = 10;
        $this->data['lists'] = $this->m_db->getAll('news_person5', $where, $like, 'np_seq', $limit, $offset);
        $config['base_url'] = base_url() . 'news_person5/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('news_person5', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        $this->data['title_section'] = 'บุคคล,สูญเสีย,บาดเจ็บ';
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'บุคคล,สูญเสีย,บาดเจ็บ'));
        $this->data['total_news_person5_rows'] = $this->m_db->getCountAll('news_person5', $where_report_rows);
        $this->view('news_person5/v_lists', $this->data);
    }
    
    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_person5/v_form', $this->data);
            } else {
                $insert['np_seq']               = $_POST['np_seq'];
                $insert['np_person']            = $_POST['np_person'];
                $insert['np_description']       = (isset($_POST['np_description']) and $_POST['np_description']) ? $_POST['np_description'] : NULL;
                $insert['np_createdby']         = $this->user_id;
                $insert['np_updatedby']         = $this->user_id;
                $news_person5_id = $this->m_db->add('news_person5', $insert);
                
                redirect(site_url('news_person5/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'บุคคล,สูญเสีย,บาดเจ็บ', 'link' => site_url('news_person5/lists')), array('name' => 'เพิ่มบุคคล,สูญเสีย,บาดเจ็บ'));
            $this->view('news_person5/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('news_person5', array('np_newspersonid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_person5/v_form', $this->data);
            } else {
                $insert['np_seq']               = $_POST['np_seq'];
                $insert['np_person']              = $_POST['np_person'];
                $insert['np_description']       = (isset($_POST['np_description']) and $_POST['np_description']) ? $_POST['np_description'] : NULL;
                $insert['np_createdby']         = $this->user_id;
                $insert['np_updatedby']         = $this->user_id;
                $insert['np_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('news_person5', array('np_newspersonid' => $id), $insert);
                redirect(site_url('news_person5/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'บุคคล,สูญเสีย,บาดเจ็บ', 'link' => site_url('news_person5/lists')), array('name' => 'แก้ไขบุคคล,สูญเสีย,บาดเจ็บ'));
            $this->view('news_person5/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        $this->data['result'] = $this->m_db->getDetail('news_person5', array('np_newspersonid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('news_person5', array('np_newspersonid' => $id))) {
//            $this->m_db->edit('news', array('np_newspersonid' => $id,'u_unitid' => $sesstion['unitid']), array('np_newspersonid' => 0));
            //$this->m_db->edit('news', array('np_newspersonid' => $id), array('np_newspersonid' => 0, 'sl_secretid' => 0, 'hl_hastelevelid' => 0, 'ru_reportunitid' => 0));
        }
        
        redirect(site_url('news_person5/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('np_person', 'ชื่อบุคคล*', 'required');
    }
}