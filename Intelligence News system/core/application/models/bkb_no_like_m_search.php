<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_search extends Base_e_army_model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getNewsAll($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL) {
            $this->db->select('*');

            $this->db->from('news');

            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            
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

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('*');
                        $this->db->from('news_paragraph');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_paragraph = $this->db->get();
                        if ($query_paragraph->num_rows() > 0) {
                            $result[$key]['paragraph'] = $query_paragraph->result_array();
                        }
                    }
                    return $result;
            } else
                    return false;
    }
    
    
    
    public function getNewsDetail($id = NULL, $where = NULL) {
            $this->db->select('*');

            $this->db->from('news');
            
            $this->db->join('report_type', 'report_type.rt_reporttypeid = news.rt_reporttypeid', 'left');
            $this->db->join('secret_level', 'secret_level.sl_secretid = news.sl_secretid', 'left');
            $this->db->join('haste_level', 'haste_level.hl_hastelevelid = news.hl_hastelevelid', 'left');
            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            $this->db->join('news_department', 'news_department.nd_newsdepartmentid = news.nd_newsdepartmentid', 'left');
            $this->db->join('news_type', 'news_type.nt_newstypeid = news.nt_newstypeid', 'left');
            $this->db->join('news_country', 'news_country.nc_newscountryid = news.nc_newscountryid', 'left');

            $this->db->where('n_newsid', $id);
            //$this->db->where('n_active', 'Y');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            $query = $this->db->get();

            if ($query->num_rows() > 0)
                    return $query->row_array();
            else
                    return false;
    }
    
    public function getParagraphByNewsID($id = NULL, $where = NULL) {
            $this->db->select('*');

            $this->db->from('news_paragraph');
            
            $this->db->where('n_newsid', $id);
                    
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('*');
                        $this->db->from('news_fileattach');
                        $this->db->where('np_paragraph_id', $value['np_paragraph_id']);
                        
                        $query_fileattach = $this->db->get();
                        if ($query_fileattach->num_rows() > 0) {
                            $result[$key]['fileattach'] = $query_fileattach->result_array();
                        }
                    }
                    
                    foreach ($result as $key => $value) {
                        $this->db->select('news_tag.nt_tagid AS nt_tagid, news_tag.nt_word AS nt_word');
                        $this->db->from('news_link_tag');
                        $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid', 'inner');
                        $this->db->where('np_paragraph_id', $value['np_paragraph_id']);
                        
                        $query_tag = $this->db->get();
                        if ($query_tag->num_rows() > 0) {
                            $result[$key]['tag'] = $query_tag->result_array();
                        }
                    }
                    return $result;
            } else
                    return false;
    }
    public function search_news($word = NULL, $where = NULL ,$limit = NULL, $offset = NULL){
            $array_data = array();
            $count_news = 0;
            $n_id = 0;
            // Query for limit news
            $cmd_count_news = "SELECT count(*) FROM news n,news_paragraph np where n.n_newsid = np.n_newsid and (";
            
            if($where != NULL && isset($where['rt_reporttypeid']) && $where['rt_reporttypeid'] != ""){
                $cmd_count_news .= "n.rt_reporttypeid = ".$where['rt_reporttypeid']." ) and (";
            }
            if($where != NULL && isset($where['nd_newsdepartmentid']) && $where['nd_newsdepartmentid'] != ""){
                $cmd_count_news .= "np.nd_newsdepartmentid = ".$where['nd_newsdepartmentid']." ) and (";
            }
            if($where != NULL && isset($where['nt_newstypeid']) && $where['nt_newstypeid'] != ""){
                $cmd_count_news .= "np.nt_newstypeid = ".$where['nt_newstypeid']." ) and (";
            }
            if($where != NULL && isset($where['u_unitid']) && $where['u_unitid'] != ""){
                $cmd_count_news .= "n.u_unitid = ".$where['u_unitid']." ) and (";
            }
            if($where != NULL && isset($where['s_unitsub_id']) && $where['s_unitsub_id'] != ""){
                $cmd_count_news .= "n.s_unitsub_id = ".$where['s_unitsub_id']." ) and (";
            }
            if($word != null){
                foreach ($word as $key_word){
                    if($key_word == ""){

                    }else{
                        $cmd_count_news .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                    }  
                }
                $cmd_count_news = substr($cmd_count_news, 0,-3);
                $cmd_count_news .= ") group by n.n_newsid";
            }else{
                $cmd_count_news = substr($cmd_count_news, 0,-6);
                $cmd_count_news .= " group by n.n_newsid";
            }
            
            $query_news_count = $this->db->query($cmd_count_news);
            //End Query for limit news
            $data_news_count = $query_news_count->result_array();
            $data_news_count = count($data_news_count);
            
            // Query for limit news
            //*************************************************************************************************************
            $cmd_limit_news = "SELECT n.n_newsid FROM news n,news_paragraph np where n.n_newsid = np.n_newsid and (";
            
            if($where != NULL && isset($where['rt_reporttypeid']) && $where['rt_reporttypeid'] != ""){
                $cmd_limit_news .= "n.rt_reporttypeid = ".$where['rt_reporttypeid']." ) and (";
            }
            if($where != NULL && isset($where['nd_newsdepartmentid']) && $where['nd_newsdepartmentid'] != ""){
                $cmd_limit_news .= "np.nd_newsdepartmentid = ".$where['nd_newsdepartmentid']." ) and (";
            }
            if($where != NULL && isset($where['nt_newstypeid']) && $where['nt_newstypeid'] != ""){
                $cmd_limit_news .= "np.nt_newstypeid = ".$where['nt_newstypeid']." ) and (";
            }
            if($where != NULL && isset($where['u_unitid']) && $where['u_unitid'] != ""){
                $cmd_limit_news .= "n.u_unitid = ".$where['u_unitid']." ) and (";
            }
            if($where != NULL && isset($where['s_unitsub_id']) && $where['s_unitsub_id'] != ""){
                $cmd_limit_news .= "n.s_unitsub_id = ".$where['s_unitsub_id']." ) and (";
            }
            if($word != null){
                foreach ($word as $key_word){
                    if($key_word == ""){

                    }else{
                        $cmd_limit_news .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                    }  
                }
                $cmd_limit_news = substr($cmd_limit_news, 0,-3);
                $cmd_limit_news .= ") group by n.n_newsid LIMIT ".$limit." OFFSET ".$offset."";
            }else{
                $cmd_limit_news = substr($cmd_limit_news, 0,-6);
                $cmd_limit_news .= " group by n.n_newsid LIMIT ".$limit." OFFSET ".$offset."";
            }
            
            
            $query_news_limit = $this->db->query($cmd_limit_news);
            //End Query for limit news
            $data_news_limit = $query_news_limit->result_array();
            //print_r($data_news_limit);
            
            //******* Query for news *********
            $cmd = "SELECT * FROM news n,news_paragraph np WHERE n.n_newsid = np.n_newsid  and (";
            
            if($where != NULL && isset($where['rt_reporttypeid']) && $where['rt_reporttypeid'] != ""){
                $cmd .= "n.rt_reporttypeid = ".$where['rt_reporttypeid']." ) and (";
            }
            if($where != NULL && isset($where['nd_newsdepartmentid']) && $where['nd_newsdepartmentid'] != ""){
                $cmd .= "np.nd_newsdepartmentid = ".$where['nd_newsdepartmentid']." ) and (";
            }
            if($where != NULL && isset($where['nt_newstypeid']) && $where['nt_newstypeid'] != ""){
                $cmd .= "np.nt_newstypeid = ".$where['nt_newstypeid']." ) and (";
            }
            if($where != NULL && isset($where['u_unitid']) && $where['u_unitid'] != ""){
                $cmd .= "n.u_unitid = ".$where['u_unitid']." ) and (";
            }
            if($where != NULL && isset($where['s_unitsub_id']) && $where['s_unitsub_id'] != ""){
                $cmd .= "n.s_unitsub_id = ".$where['s_unitsub_id']." ) and (";
            }
            
            foreach ($data_news_limit as $values){
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
            
            if($word != null){
                foreach ($word as $key_word){
                    if($key_word == ""){

                    }else{
                        $cmd .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                    }  
                }
                $cmd = substr($cmd, 0,-3);
            }else{
                $cmd = substr($cmd, 0,-7);
            }
            $cmd .= ") order by np.n_newsid desc";
            
            $query = $this->db->query($cmd);
            
            $all_news = $query->result_array();
            
            // ******* End Query for news *********

            //$count_news += 1;
            foreach ($all_news as $values){
                    if($values['n_newsid'] != $n_id){
                          $n_id = $values['n_newsid'];
                          $count_news += 1;
                    }
            }
            $array_data['all_news'] = $all_news;
            if(isset($data_news_count)){
            $array_data['count_news'] = $data_news_count;
            }else{
               $array_data['count_news'] = 0; 
            }
            
            return $array_data;
    }

    public function search_news_advance($word = NULL, $like = "", $limit = NULL, $offset = NULL, $unit_where = NULL){
            $array_data = array();
            $count_news = 0;
            $n_id = 0;
            $check_cmd_count_news = 0;
            $check_cmd_limit_news = 0;
            
            // Query for limit news
            $cmd_count_news = "SELECT count(*) FROM news n,news_paragraph np where n.n_newsid = np.n_newsid and (";
            
            if($unit_where != NULL && isset($unit_where['u_unitid']) && $unit_where['u_unitid'] != ""){
                $cmd_count_news .= "n.u_unitid = ".$unit_where['u_unitid']." ) and (";
            }
            if($unit_where != NULL && isset($unit_where['s_unitsub_id']) && $unit_where['s_unitsub_id'] != ""){
                $cmd_count_news .= "n.s_unitsub_id = ".$unit_where['s_unitsub_id']." ) and (";
            }
            
            foreach ($word as $key => $values){
                if(strpos($key,'n_datetime') !== false){
                    if($key == "n_datetime_s"){
                        $cmd_count_news .= "n.n_datetime >= '".$values."' and ";
                    }
                    if($key == "n_datetime_e"){
                        $cmd_count_news .= "n.n_datetime <= '".$values."' and ";
                    }
                }else{
					if ($key == "nd_newsdepartmentid") {
						$cmd_count_news .= "np.".$key." = '".$values."' and ";
					} else if ($key == "nt_newstypeid") {
						$cmd_count_news .= "np.".$key." = '".$values."' and ";
					} else{
						$cmd_count_news .= "n.".$key." = '".$values."' and ";
					}					
                }
                $check_cmd_count_news = 1;
            }
            if($check_cmd_count_news == 1){
                $cmd_count_news = substr($cmd_count_news, 0,-4);
                $check_cmd_count_news = 0;
                $cmd_count_news .= " ) and (";
            }
            
            

            if($like != "")
            {
                foreach ($like as $key_word){
                    if($key_word == ""){
                        $check_cmd_count_news = 0;
                    }else{
                        $cmd_count_news .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                         $check_cmd_count_news = 1;
                    }  
                }
            }
 
            if($check_cmd_count_news == 0){
                $cmd_count_news = substr($cmd_count_news, 0,-5);
                $cmd_count_news .= " group by n.n_newsid";
            }else{
                $cmd_count_news = substr($cmd_count_news, 0,-3);
                $cmd_count_news .= ") group by n.n_newsid";
            }
            //echo $check_cmd_count_news;
            $query_news_count = $this->db->query($cmd_count_news);
            //End Query for limit news
            $data_news_count = $query_news_count->result_array();
            $data_news_count = count($data_news_count);
            
            // Query for limit news
            //**************************************************************************************************************
            $cmd_limit_news = "SELECT n.n_newsid FROM news n,news_paragraph np where n.n_newsid = np.n_newsid and (";
            
            if($unit_where != NULL && isset($unit_where['u_unitid']) && $unit_where['u_unitid'] != ""){
                $cmd_limit_news .= "n.u_unitid = ".$unit_where['u_unitid']." ) and (";
            }
            if($unit_where != NULL && isset($unit_where['s_unitsub_id']) && $unit_where['s_unitsub_id'] != ""){
                $cmd_limit_news .= "n.s_unitsub_id = ".$unit_where['s_unitsub_id']." ) and (";
            }
            
            
            foreach ($word as $key => $values){     
                if(strpos($key,'n_datetime') !== false){
                    if($key == "n_datetime_s"){
                        $cmd_limit_news .= "n.n_datetime >= '".$values."' and ";
                    }
                    if($key == "n_datetime_e"){
                        $cmd_limit_news .= "n.n_datetime <= '".$values."' and ";
                    }				
                }else{
					if ($key == "nd_newsdepartmentid") {
						$cmd_limit_news .= "np.".$key." = '".$values."' and ";
					} else if ($key == "nt_newstypeid") {
						$cmd_limit_news .= "np.".$key." = '".$values."' and ";
					} else{
						$cmd_limit_news .= "n.".$key." = '".$values."' and ";
					}
                }
                $check_cmd_count_news = 1;
            }
            if($check_cmd_count_news == 1){
                $cmd_limit_news = substr($cmd_limit_news, 0,-4);
                $check_cmd_count_news = 0;
                $cmd_limit_news .= " ) and (";
            }
            
            
            if($like != ""){
                foreach ($like as $key_word){
                    if($key_word == ""){
                        $check_cmd_limit_news = 0;
                    }else{
                        $cmd_limit_news .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                        $check_cmd_limit_news = 1;
                    }  
                }
            }
            if($check_cmd_limit_news == 0){
                $cmd_limit_news = substr($cmd_limit_news, 0,-5);
                $cmd_limit_news .= " group by n.n_newsid LIMIT ".$limit." OFFSET ".$offset."";
            }else{
                $cmd_limit_news = substr($cmd_limit_news, 0,-3);
                $cmd_limit_news .= ") group by n.n_newsid LIMIT ".$limit." OFFSET ".$offset."";
            }
            
            $query_news_limit = $this->db->query($cmd_limit_news);
            //End Query for limit news
            $data_news_limit = $query_news_limit->result_array();
            
            //print_r($cmd_limit_news);
            //print_r($word);
            //print_r($like);
            //******* Query for news *********
             //**************************************************************************************************************
            $cmd = "SELECT * FROM news n,news_paragraph np WHERE n.n_newsid = np.n_newsid  and (";
            
            if($unit_where != NULL && isset($unit_where['u_unitid']) && $unit_where['u_unitid'] != ""){
                $cmd .= "n.u_unitid = ".$unit_where['u_unitid']." ) and (";
            }
            if($unit_where != NULL && isset($unit_where['s_unitsub_id']) && $unit_where['s_unitsub_id'] != ""){
                $cmd .= "n.s_unitsub_id = ".$unit_where['s_unitsub_id']." ) and (";
            }
            foreach ($data_news_limit as $values){
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
            
            foreach ($word as $key => $values){
                if(strpos($key,'n_datetime') !== false){
                    if($key == "n_datetime_s"){
                        $cmd .= "n.n_datetime >= '".$values."' and ";
                    }
                    if($key == "n_datetime_e"){
                        $cmd .= "n.n_datetime <= '".$values."' and ";
                    }
                }else{
					if ($key == "nd_newsdepartmentid") {
						$cmd .= "np.".$key." = ? and ";
					} else if ($key == "nt_newstypeid") {
						$cmd .= "np.".$key." = ? and ";
					} else{
						$cmd .= "n.".$key." = ? and ";
					}					
                }
            }
            $cmd = substr($cmd, 0,-4);

            if($like != ""){
                $cmd .= ") and (";
                 foreach ($like as $key => $key_word){
                     $cmd .= "n.n_writer like '%".$key_word."%' or n.n_subject like '%".$key_word."%' or np.np_paragraph like '%".$key_word."%' or ";
                }
                 $cmd = substr($cmd, 0,-3);
            }
            
            $cmd .= ") order by np.n_newsid desc";
            
            $query = $this->db->query($cmd,$word);
            
            $all_news = $query->result_array();
            
            // ******* End Query for news *********

            //$count_news += 1;
            foreach ($all_news as $values){
                    if($values['n_newsid'] != $n_id){
                          $n_id = $values['n_newsid'];
                          $count_news += 1;
                    }
            }
            $array_data['all_news'] = $all_news;
            
            if(isset($data_news_count)){
                $array_data['count_news'] = $data_news_count;
            }else{
               $array_data['count_news'] = 0; 
            }
            
            return $array_data;
    }

    public function getSearch($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL) {
            //$this->db->select('news.*, news_paragraph.np_paragraph, count(news_paragraph.n_newsid)');
        
            $this->db->select('*');
            
            $this->db->from('news');

            //$this->db->join('news_paragraph', 'news_paragraph.n_newsid = news.n_newsid', 'left');
            
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
            
            //$this->db->group_by('news.n_newsid'); 
            
            if (!is_null($order_by)) {
                    $this->db->order_by($order_by);
            }
            
            if (!is_null($limit)) {
                    $this->db->limit($limit, $offset);
            }

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('*');
                        $this->db->from('news_paragraph');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_paragraph = $this->db->get();
                        if ($query_paragraph->num_rows() > 0) {
                            $result[$key]['paragraph'] = $query_paragraph->result_array();
                        }
                    }
                    return $result;
            } else 
                    return false;
    }
    
    public function getCountSearch($where = NULL, $like = NULL) {
            $this->db->select('*');
            
            $this->db->from('news');

            //$this->db->join('news_paragraph', 'news_paragraph.n_newsid = news.n_newsid', 'left');
            
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
            
            //$this->db->group_by('n_newsid');

            $query = $this->db->get();
            return $query->num_rows();
    }
    
    public function getSearchAdvance($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL) {
            $this->db->select('*');
            
            $this->db->from('news');

            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (isset($like) and is_array($like)) {
                foreach ($like as $v_like) {
                    foreach ($v_like as $kk_like => $vv_like) {
                        $this->db->like($kk_like, $vv_like);
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

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('*');
                        $this->db->from('news_paragraph');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_paragraph = $this->db->get();
                        if ($query_paragraph->num_rows() > 0) {
                            $result[$key]['paragraph'] = $query_paragraph->result_array();
                        }
                    }
                    return $result;
            } else
                    return false;
    }
    
    public function getCountSearchAdvance($where = NULL, $like = NULL) {
            $this->db->select('*');
            
            $this->db->from('news');

            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (isset($like) and is_array($like)) {
                foreach ($like as $v_like) {
                    foreach ($v_like as $kk_like => $vv_like) {
                        $this->db->like($kk_like, $vv_like);
                    }
                }
            } else if (!is_null($like)) {
                    $this->db->or_like($like);
            }
            
            $query = $this->db->get();
            return $query->num_rows();
    }
    
    public function getSearchTimeline($where = NULL, $or_where = NULL, $between = NULL, $limit = NULL, $offset = NULL) {
            $this->db->select('news_paragraph.np_paragraph_id, news_paragraph.n_newsid, news.n_subject, news_paragraph.np_paragraph, news_paragraph.np_mainimage, news_paragraph.np_createddate');
            
            $this->db->from('news_paragraph');
            
            $this->db->join('news', 'news.n_newsid = news_paragraph.n_newsid', 'inner');
            
            $this->db->join('news_link_movement', 'news_link_movement.np_paragraph_id = news_paragraph.np_paragraph_id', 'inner');

            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            if (isset($between) and is_array($between)) {
                $this->db->where('np_createddate >=', $between['start']);
                $this->db->where('np_createddate <=', $between['end']);
            }
            
            if (!is_null($or_where)) {
                $this->db->where($or_where);
            }
            
            $this->db->group_by('news_paragraph.np_paragraph_id, news.n_subject, news_paragraph.np_paragraph, news_paragraph.np_mainimage, news_paragraph.np_createddate');
            
            $this->db->order_by('np_createddate ASC');
            
            if (!is_null($limit)) {
                    $this->db->limit($limit, $offset);
            }

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    return $query->result_array();
            } else
                    return false;
    }
    
    public function searchTag($q = NULL, $limit = 10) {
            $this->db->select('nt_word');
            
            $this->db->from('news_tag');

            if (!is_null($q)) {
                    $this->db->like('nt_word', $q, 'after'); 
            } else {
                return false;
            }
            
            $this->db->limit($limit);
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    return $query->result_array();
            } else {
                    return false;
            }
    }
    
    public function tagExists($word = NULL) {
            $this->db->select('nt_tagid');
            
            $this->db->from('news_tag');

            if (!is_null($word)) {
                    $this->db->where('nt_word', $word); 
            } else {
                return false;
            }
            
            $this->db->limit(1);
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    return $query->row_array();
            } else {
                    return false;
            }
    }
    
    public function getRelateNews($id = NULL, $unitid = NULL) {
            $sql = 'SELECT * 
                    FROM news 
                    WHERE n_newsid IN(
                        SELECT news_link_tag.n_newsid FROM news_link_tag 
                        JOIN news ON news.n_newsid = news_link_tag.n_newsid 
                        WHERE nt_tagid IN(
                            SELECT news_link_tag.nt_tagid
                            FROM news 
                            INNER JOIN news_link_tag ON news_link_tag.n_newsid = news.n_newsid 
                            WHERE news.n_newsid = '.$id.' 
                            GROUP BY news_link_tag.nt_tagid
                        )
                        AND news_link_tag.n_newsid  != '.$id.' 
                        AND news.u_unitid = '.$unitid.' 
                        GROUP BY news_link_tag.n_newsid 
                        ORDER BY COUNT(news_link_tag.np_paragraph_id) DESC 
                        LIMIT 5
                    )';
            
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('*');
                        $this->db->from('news_link_tag');
                        $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_tag = $this->db->get();
                        if ($query_tag->num_rows() > 0) {
                            $result[$key]['tag'] = $query_tag->result_array();
                        }
                    }
                    return $result;
            } else {
                    return false;
            }
    }
    
}
