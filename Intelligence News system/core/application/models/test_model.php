<?php
class Test_model extends CI_Model {
    
    var $table   = 'user_account';
    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function insert() {
        $data = array(
            //'ua_userid' => 1,
            'ua_username' => 'user1',
            'ua_password' => 'password',
            'ua_firstname' => 'lorem',
            'ua_lastname' => 'ipsum',
            'ua_description' => 'lorem ipsum',
            //'ua_createddate' => '',
            'ua_createdby' => 1,
            //'ua_updateddate' => '',
            'ua_updatedby' => 1,
        );
        $this->db->insert($this->table, $data);
        return 'insert';
    }
    
    function select() {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
                return $query->result_array();
        else
                return false;
    }
    
}
