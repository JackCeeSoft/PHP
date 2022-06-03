<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_dashbord extends Base_e_army_model {
    
    var $maintable   = 'm_dashbord';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getAll_news($np_paragraph_id = NULL ,$limit = NULL ,$offset = NULL){
        //select * from news_link_organization nlo, news_paragraph np where nlo.np_paragraph_id = np.np_paragraph_id;
        $array_data = array();
        if($np_paragraph_id != NULL){
            
            $cmd_count = "SELECT count(distinct(n.n_newsid)) FROM news_link_organization nlo, news_paragraph np , news n "
                    . "where nlo.np_paragraph_id = np.np_paragraph_id and nlo.o_organizationid = ".$np_paragraph_id." "
                    . "and n.n_newsid = np.n_newsid";
            
            $query_cmd_cout = $this->db->query($cmd_count);
            $count_news_organize_s = $query_cmd_cout->result_array();
            $count_news_organize = count($count_news_organize_s);
            $array_data['count_news'] = $count_news_organize_s[0]['count'];
            
            
            $cmd_get_id = "SELECT n.n_newsid FROM news_link_organization nlo, news_paragraph np , news n "
                    . "where nlo.np_paragraph_id = np.np_paragraph_id and nlo.o_organizationid = ".$np_paragraph_id." "
                    . "and n.n_newsid = np.n_newsid group by n.n_newsid limit ".$limit." offset ".$offset;
            $query_cmd_id = $this->db->query($cmd_get_id);
            $query_cmd_id_result = $query_cmd_id->result_array();
            
            
            $cmd = "SELECT * FROM news_link_organization nlo, news_paragraph np , news n "
                    . "where nlo.np_paragraph_id = np.np_paragraph_id and (";
            
            //print_r($query_cmd_id_result);
            
            foreach ($query_cmd_id_result as $values){
                $cmd .= "n.n_newsid = ".$values['n_newsid']." or ";
                $check_substr = 1;
            }
            if(isset($check_substr)){
                $cmd = substr($cmd, 0,-3);
                $cmd .= ") and ";
            }else{
                $cmd = substr($cmd, 0,-5);
                $cmd .= "and ";
            }

            $cmd .= " nlo.o_organizationid = ".$np_paragraph_id." "
                    . "and n.n_newsid = np.n_newsid order by np.n_newsid desc";
            $query = $this->db->query($cmd);
            $array_data['news_all'] = $query->result_array();
            
            return $array_data;
        }else{
            return FALSE;
        }
    }
    public function get_news($np_paragraph_id = NULL, $words = NULL ,$limit = NULL ,$offset = NULL){
        //select * from news_link_organization nlo, news_paragraph np where nlo.np_paragraph_id = np.np_paragraph_id;
        if($np_paragraph_id != NULL){
        $cmd_count = "SELECT count(distinct(n.n_newsid)) FROM news_link_organization nlo, news_paragraph np , news n "
        . "where nlo.np_paragraph_id = np.np_paragraph_id and nlo.o_organizationid = ".$np_paragraph_id." "
        . "and n.n_newsid = np.n_newsid and (";
        
         $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    
                }else{
                    $cmd_count .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
                }
            }
            $cmd_count = substr($cmd_count, 0,-3);
            $cmd_count .= ")";
            $query_cmd_cout = $this->db->query($cmd_count);
            $count_news_organize_s = $query_cmd_cout->result_array();
            $count_news_organize = count($count_news_organize_s);
            $array_data['count_news'] = $count_news_organize_s[0]['count']; 
            
            //*********************************************************************************************************
            
            
            $cmd_get_id = "SELECT n.n_newsid FROM news_link_organization nlo, news_paragraph np , news n "
                    . "where nlo.np_paragraph_id = np.np_paragraph_id and nlo.o_organizationid = ".$np_paragraph_id." "
                    . "and n.n_newsid = np.n_newsid and (";

            $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    $check = 0;
                }else{
                    $cmd_get_id .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
                    $check = 1;
                }
            }
            //echo $check;
            if($check == 0){
                $cmd_get_id = substr($cmd_get_id, 0,-5);
            }else{
                $cmd_get_id = substr($cmd_get_id, 0,-3);
                $cmd_get_id .= ")";
            }
            
            $cmd_get_id .= "group by n.n_newsid limit ".$limit." offset ".$offset;
            
            
            
            $query_cmd_id = $this->db->query($cmd_get_id);
            $query_cmd_id_result = $query_cmd_id->result_array();
            
            //print_r($query_cmd_id_result);
            //*********************************************************************************************************

            $cmd = "SELECT * FROM news_link_organization nlo, news_paragraph np , news n where nlo.np_paragraph_id = np.np_paragraph_id and nlo.o_organizationid = ".$np_paragraph_id." and n.n_newsid = np.n_newsid and (";
            
            foreach ($query_cmd_id_result as $values){
                $cmd .= "n.n_newsid = ".$values['n_newsid']." or ";
                $check_substr = 1;
            }
            if(isset($check_substr)){
                $cmd = substr($cmd, 0,-3);
                $cmd .= ") and (";
            }else{
                $cmd = substr($cmd, 0,-5);
                $cmd .= "and (";
            }

            $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    
                }else{
                    $cmd .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
                }
                
            }
            $cmd = substr($cmd, 0,-3);
            $cmd .= ") order by np.n_newsid desc";
            $query = $this->db->query($cmd);
            $array_data['news_all'] = $query->result_array();
            
            return $array_data;
            //return $query->result_array();
        }else{
            return FALSE;
        }
    }
}
