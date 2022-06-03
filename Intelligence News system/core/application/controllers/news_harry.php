<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class News_harry extends Base_e_army {
    
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
        $this->data['title_section'] = 'ก่อกวน';
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
        $this->data['lists'] = $this->m_db->getAll('news_harry5', $where, $like, 'nh_newsharryid DESC', $limit, $offset);
        $config['base_url'] = base_url() . 'news_harry/lists';
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('news_harry5', $where, $like);
        $config['per_page'] = $limit;
        $config['cur_page'] = $this->data['offset'] = $offset + 1;
        $this->pagination->initialize($config);
        
        
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ก่อกวน'));
        $this->data['total_news_harry_rows'] = $this->m_db->getCountAll('news_harry5', $where_report_rows);
        $this->view('news_harry/v_lists', $this->data);
    }
    
    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_harry/v_form', $this->data);
            } else {
                $insert['nh_name']              = $_POST['nh_name'];
                $insert['nh_description']       = (isset($_POST['nh_description']) and $_POST['nh_description']) ? $_POST['nh_description'] : NULL;
                $insert['nh_createdby']         = $this->user_id;
                $insert['nh_updatedby']         = $this->user_id;
                $news_harry_id = $this->m_db->add('news_harry5', $insert);
                
                redirect(site_url('news_harry/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ก่อกวน', 'link' => site_url('news_harry/lists')), array('name' => 'เพิ่มก่อกวน'));
            $this->view('news_harry/v_form', $this->data);
        }
    }
    
    public function update($id = '') {
        $this->data['result'] = $this->m_db->getDetail('news_harry5', array('nh_newsharryid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setFormValidation();
            if ($this->form_validation->run() == FALSE) {
                $this->data['result'] = $_POST;
                $this->view('news_harry/v_form', $this->data);
            } else {
                $insert['nh_name']              = $_POST['nh_name'];
                $insert['nh_description']       = (isset($_POST['nh_description']) and $_POST['nh_description']) ? $_POST['nh_description'] : NULL;
                $insert['nh_updatedby']         = $this->user_id;
                $insert['nh_updateddate']       = date('Y-m-d H:i:s');
                
                $result = $this->m_db->edit('news_harry5', array('nh_newsharryid' => $id), $insert);
                redirect(site_url('news_harry/lists'));
            }
        } else {
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'สถานะข่าว', 'link' => site_url('news_harry/lists')), array('name' => 'เพิ่มสถานะข่าว'));
            $this->view('news_harry/v_form', $this->data);
        }
    }
    
    public function delete($id = '') {
        $sesstion = $this->getSesstion();
        //$sesstion['unitid'];
        $this->data['result'] = $this->m_db->getDetail('news_harry5', array('nh_newsharryid' => $id));

        if (empty($id) or !$this->data['result'])
            redirect(site_url(''));
        
        if($this->m_db->delete('news_harry5', array('nh_newsharryid' => $id))) {
            //$this->m_db->edit('news', array('nh_newsharryid' => $id,'u_unitid' => $sesstion['unitid']), array('rt_reporttypeid' => 0));
            //$this->m_db->edit('news', array('rt_reporttypeid' => $id), array('rt_reporttypeid' => 0, 'sl_secretid' => 0, 'hl_hastelevelid' => 0, 'ru_reportunitid' => 0));
        }
        
        redirect(site_url('news_harry/lists'));
    }
    
    private function setFormValidation() {
        $this->form_validation->set_rules('nh_name', 'ชื่อก่อกวน*', 'required');
    }
}