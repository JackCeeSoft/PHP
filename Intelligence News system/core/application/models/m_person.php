<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_person extends Base_e_army_model {
    
    var $maintable   = 'm_organization';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    public function getAll_news($np_paragraph_id = NULL, $limit = NULL , $offset = NULL){
        //select * from news_link_organization nlo, news_paragraph np where nlo.np_paragraph_id = np.np_paragraph_id;
        if($np_paragraph_id != NULL){
            
            $cmd_count_new = "SELECT count(distinct(n.n_newsid)) FROM news_link_person nlp, news_paragraph np , news n "
                    . "where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." "
                    . "and n.n_newsid = np.n_newsid";
      
            $query_cmd_cout = $this->db->query($cmd_count_new);
            $count_news_person_s = $query_cmd_cout->result_array();
            $array_data['count_news'] = $count_news_person_s[0]['count'];
            
            //********************************************************************************************************************
            
            $cmd_get_id = "SELECT distinct(np.n_newsid) FROM news_link_person nlp, news_paragraph np , news n "
            . "where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." "
            . "and n.n_newsid = np.n_newsid order by np.n_newsid desc limit ".$limit." offset ".$offset;

            
            $query_cmd_id = $this->db->query($cmd_get_id);
            $query_cmd_id_result = $query_cmd_id->result_array();
            
            //print_r($query_cmd_id_result);
            
            
            //********************************************************************************************************************
            
            $cmd = "SELECT * FROM news_link_person nlp, news_paragraph np , news n "
                    . "where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." and n.n_newsid = np.n_newsid and (";
            
            foreach ($query_cmd_id_result as $values){
                $cmd .= "n.n_newsid = ".$values['n_newsid']." or ";
                $check_substr = 1;
            }
            if(isset($check_substr)){
                $cmd = substr($cmd, 0,-3);
                $cmd .= ") ";
            }else{
                $cmd = substr($cmd, 0,-5);
                $cmd .= " ";
            }
            $cmd .= "order by np.n_newsid desc";
            $query = $this->db->query($cmd);
            $array_data['news_all'] = $query->result_array();
            
            return $array_data;
        }else{
            return FALSE;
        }
    }
        public function get_news($np_paragraph_id = NULL, $words = NULL, $limit = NULL, $offset = NULL){
        //select * from news_link_organization nlo, news_paragraph np where nlo.np_paragraph_id = np.np_paragraph_id;
        if($np_paragraph_id != NULL){
            
            $cmd_count_new = "SELECT count(distinct(n.n_newsid)) FROM news_link_person nlp, news_paragraph np , news n "
            . "where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." "
            . "and n.n_newsid = np.n_newsid and (";
            
            $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    
                }else{
                    $cmd_count_new .= "np.np_paragraph like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
                }
                
            }
            $cmd_count_new = substr($cmd_count_new, 0,-3);
            $cmd_count_new .= ")";
            
            $query_cmd_cout = $this->db->query($cmd_count_new);
            $count_news_person_s = $query_cmd_cout->result_array();
            $array_data['count_news'] = $count_news_person_s[0]['count'];
            
             //********************************************************************************************************************
            
            $cmd_get_id = "SELECT distinct(np.n_newsid) FROM news_link_person nlp, news_paragraph np , news n "
            . "where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." "
            . "and n.n_newsid = np.n_newsid and (";
               
            $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    
                }else{
                    $cmd_get_id .= "np.np_paragraph like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
                }
                
            }
            $cmd_get_id = substr($cmd_get_id, 0,-3);
            $cmd_get_id .= ")";
            $cmd_get_id .= "order by np.n_newsid desc limit ".$limit." offset ".$offset;
            $query_cmd_id = $this->db->query($cmd_get_id);
            $query_cmd_id_result = $query_cmd_id->result_array();
            

             //********************************************************************************************************************
            
            $cmd = "SELECT * FROM news_link_person nlp, news_paragraph np , news n where nlp.np_paragraph_id = np.np_paragraph_id and nlp.p_personid = ".$np_paragraph_id." and n.n_newsid = np.n_newsid and (";
            
            
            foreach ($query_cmd_id_result as $values){
                $cmd .= "n.n_newsid = ".$values['n_newsid']." or ";
                $check_substr = 1;
            }
            if(isset($check_substr)){
                $cmd = substr($cmd, 0,-3);
                $cmd .= ") and (";
            }else{
                $cmd = substr($cmd, 0,-5);
                $cmd .= " and (";
            }

            $word = explode(' ', $words);
            //print_r($word);
            foreach ($word as $key_word){
                if($key_word == ""){
                    
                }else{
                    $cmd .= "np.np_paragraph like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or ";
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
