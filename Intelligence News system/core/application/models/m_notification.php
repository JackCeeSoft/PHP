<?php
//include(APPPATH . "/core/base_e_army_model.php");

class M_Notification extends Base_e_army_model {
    
    var $maintable   = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_new_announce($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL){
        
        $this->db->select('news_announce.*, news_announce.d_announceid as d_announceid_main , news_link_usernoti.*');
        $this->db->from('news_announce');
        $this->db->join('news_link_usernoti', 'news_announce.d_announceid = news_link_usernoti.d_announceid', 'left');
        if (!is_null($where)) {
                    $this->db->where($where);
            }
        $query = $this->db->get();

            if ($query->num_rows() > 0)
                    return $query->result_array();
            else
                    return false;
    }
    


    public function get_news_noti($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL){
            $this->db->select('*');

            $this->db->from('news_comment');

            $this->db->join('news', 'news.n_newsid = news_comment.nc_newsid', 'left');
            
            $this->db->join('user_account', 'user_account.ua_userid = news_comment.o_createdby', 'left');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (isset($like) and is_array($like)) {
                foreach ($like as $v_like) {
                    foreach ($v_like as $kk_like => $vv_like) {
                        $this->db->or_like($kk_like, $vv_like);
                    }
                }
            } else if (!is_null($like)) {
                    $this->db->or_like($like);
            }
            if (!is_null($order_by)) {
                    $this->db->order_by($order_by);
            }
            if (!is_null($limit)) {
                    $this->db->limit($limit, $offset);
            }
            
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                    return $query->result_array();
            else
                    return false;
    }
    public function get_chat_noti($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL){
            $this->db->select('count(*)');

            $this->db->from('chat_message');

            //$this->db->join('news', 'news.n_newsid = news_comment.nc_newsid', 'left');
            
            //$this->db->join('user_account', 'user_account.ua_userid = news_comment.o_createdby', 'left');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (isset($like) and is_array($like)) {
                foreach ($like as $v_like) {
                    foreach ($v_like as $kk_like => $vv_like) {
                        $this->db->or_like($kk_like, $vv_like);
                    }
                }
            } else if (!is_null($like)) {
                    $this->db->or_like($like);
            }
            if (!is_null($order_by)) {
                    $this->db->order_by($order_by);
            }
            if (!is_null($limit)) {
                    $this->db->limit($limit, $offset);
            }
            
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                    return $query->result_array();
            else
                    return false;
    }
    
    
}
