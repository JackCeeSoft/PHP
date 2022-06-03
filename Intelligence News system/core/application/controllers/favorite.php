<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Favorite extends Base_e_army {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_db');
        
    }
    
    public function insert($news_id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Favorite->insert','Add',$sesstion['user_id']);
        
        if(isset($news_id) && $news_id != ''){
            $insert['n_newsid']            = $news_id;
            $insert['ua_userid']           = $sesstion['user_id'];
            $insert['f_description']       = "";
            $insert['f_createdby']         = $sesstion['user_id'];
            $insert['f_updatedby']         = $sesstion['user_id'];
            $this->m_db->add('favorite', $insert);
        }
        //echo $news_id;
        //exit();
        
        redirect(site_url('news/dashboard'));
        
    }
    public function delete($news_id = '') {
        $sesstion = $this->getSesstion();
        $this->action_log($this->m_db,'Favorite->delete','Delete',$sesstion['user_id']);
        
        if(isset($news_id) && $news_id != ''){
            $where['n_newsid']            = $news_id;
            $where['ua_userid']           = $sesstion['user_id'];
            $this->m_db->delete('favorite', $where);
        }
        
        redirect(site_url('news/dashboard'));
        
    }
}