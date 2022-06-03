<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_statistic extends Base_e_army_model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAll_report1($where = null, $between = NULL) {
            $this->db->select('n.n_newsid, np.na_newsamphorid, np.nc_newscauseid, np.nh_newsharryid, np.ne_newsexecutionid, SUM(nrp.nr_injuries) AS injuries, SUM(nrp.nr_lose) AS lose');

            $this->db->from('news n');
            $this->db->join('news_paragraph np', 'np.n_newsid = n.n_newsid', 'left');
            $this->db->join('news_relate_person5 nrp', 'nrp.n_newsid = n.n_newsid', 'left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('n.n_datetime >=', $between['start']);
                $this->db->where('n.n_datetime <=', $between['end']);
            }
            
            if(!is_null($where)) {
                $this->db->where($where);
            }
            
            
            $this->db->group_by('n.n_newsid, np.na_newsamphorid, np.nc_newscauseid, np.nh_newsharryid, np.ne_newsexecutionid');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
    }
    
    function getAll_report2($between = NULL) {
            $this->db->select('SUM("nrp5"."nr_injuries") AS nr_injuries_total, '
                    . 'SUM("nrp5"."nr_lose") AS nr_lose_total, '
                    . '"news_person5"."np_person" AS np_person, '
                    . '"news_person5"."np_newspersonid" AS np_newspersonid, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_person5 nrp5');
            $this->db->join('news_person5', 'nrp5.np_newspersonid = news_person5.np_newspersonid', 'left');
            $this->db->join('news', 'nrp5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrp5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('np.np_newsprovinceid !=',0);
            $this->db->group_by('"news_person5"."np_person", "province"."province_id", "news_person5"."np_newspersonid"');
            $this->db->order_by('province"."province_id" desc');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
    function getAll_report2_text($between = NULL,$limit = 10 , $offset = 0) {
            $this->db->select('np.np_paragraph_id AS np_paragraph_id, '
                    . 'np.np_paragraph AS np_paragraph, '
                    . 'np.np_createddate AS np_time, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_person5 nrp5');
            $this->db->join('news_person5', 'nrp5.np_newspersonid = news_person5.np_newspersonid', 'left');
            $this->db->join('news', 'nrp5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrp5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('np.np_newsprovinceid !=',0);
            $this->db->group_by('"np"."np_paragraph_id", "province"."province_id"');
            $this->db->order_by('province"."province_id" desc');
            $this->db->limit($limit, $offset);
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
    function getAll_report3($between = NULL) {
            $this->db->select('COUNT("np"."ne_newsexecutionid") AS ne_newsexecution_total, '
                    . '"news_execution5"."ne_name" AS ne_name, '
                    . '"news_execution5"."ne_newsexecutionid" AS ne_newsexecutionid, '
                    . '"np"."np_newsprovinceid" AS np_newsprovinceid');

            $this->db->from('news_paragraph np');
            $this->db->join('news_execution5', 'np.ne_newsexecutionid = news_execution5.ne_newsexecutionid', 'left');
            $this->db->join('news', 'np.n_newsid = news.n_newsid', 'left');
            
            $this->db->where('np.ne_newsexecutionid !=', 0);
            $this->db->where('np.np_newsprovinceid !=', 0);
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }

            $this->db->group_by('"news_execution5"."ne_newsexecutionid", "news_execution5"."ne_name", "np"."np_newsprovinceid"');
            $this->db->order_by('np"."np_newsprovinceid" desc');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
       function getAll_report3_text($between = NULL) {
            $this->db->select('np.np_paragraph_id AS np_paragraph_id, '
                    . 'np.np_paragraph AS np_paragraph, '
                    . 'np.np_createddate AS np_time');

            $this->db->from('news_paragraph np');
            $this->db->join('news_execution5', 'np.ne_newsexecutionid = news_execution5.ne_newsexecutionid', 'left');
            $this->db->join('news', 'np.n_newsid = news.n_newsid', 'left');
            
            $this->db->where('np.ne_newsexecutionid !=', 0);
            $this->db->where('np.np_newsprovinceid !=', 0);
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }

            $this->db->group_by('np.np_paragraph_id, "np"."np_newsprovinceid"');
            $this->db->order_by('np"."np_newsprovinceid" desc');
            $this->db->limit(10, 0);
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
    
   function getAll_report4($between = NULL) {
            $this->db->select('COUNT("np"."nh_newsharryid") AS nh_newsharry_total, '
                    . '"news_harry5"."nh_name" AS nh_name, '
                    . '"news_harry5"."nh_newsharryid" AS nh_newsharryid, '
                    . '"np"."np_newsprovinceid" AS np_newsprovinceid');

            $this->db->from('news_paragraph np');
            $this->db->join('news_harry5', 'np.nh_newsharryid = news_harry5.nh_newsharryid', 'left');
            $this->db->join('news', 'np.n_newsid = news.n_newsid', 'left');
            
            $this->db->where('np.nh_newsharryid !=', 0);
            $this->db->where('np.np_newsprovinceid !=', 0);
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }

            $this->db->group_by('"news_harry5"."nh_newsharryid", "news_harry5"."nh_name", "np"."np_newsprovinceid"');
            $this->db->order_by('np"."np_newsprovinceid" desc');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
   function getAll_report4_text($between = NULL) {
            $this->db->select('np.np_paragraph_id AS np_paragraph_id, '
                    . 'np.np_paragraph AS np_paragraph, '
                    . 'np.np_createddate AS np_time');

            $this->db->from('news_paragraph np');
            $this->db->join('news_harry5', 'np.nh_newsharryid = news_harry5.nh_newsharryid', 'left');
            $this->db->join('news', 'np.n_newsid = news.n_newsid', 'left');
            
            $this->db->where('np.nh_newsharryid !=', 0);
            $this->db->where('np.np_newsprovinceid !=', 0);
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }

            $this->db->group_by('np.np_paragraph_id, "np"."np_newsprovinceid"');
            $this->db->order_by('np"."np_newsprovinceid" desc');
            $this->db->limit(10, 0);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
   function getAll_report5_text($between = NULL){
            $this->db->select('np.np_paragraph_id AS np_paragraph_id, '
                    . 'np.np_paragraph AS np_paragraph, '
                    . 'np.np_createddate AS np_time, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_gun5 nrg5');
            $this->db->join('news_gun5', 'nrg5.ng_newsgunid = news_gun5.ng_newsgunid', 'left');
            $this->db->join('news', 'nrg5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrg5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('province.province_id !=', 0);
            $this->db->group_by('np.np_paragraph_id, "province"."province_id"');
            $this->db->order_by('np"."np_createddate" asc');
            $this->db->limit(10, 0);
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
    function getAll_report5($between = NULL) {
            $this->db->select('SUM("nrg5"."nr_hold") AS nr_hold_total, '
                    . '"news_gun5"."ng_gun" AS ng_gun, '
                    . '"news_gun5"."ng_newsgunid" AS ng_newsgunid, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_gun5 nrg5');
            $this->db->join('news_gun5', 'nrg5.ng_newsgunid = news_gun5.ng_newsgunid', 'left');
            $this->db->join('news', 'nrg5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrg5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('province.province_id !=', 0);
            $this->db->group_by('"news_gun5"."ng_newsgunid", "province"."province_id"');
            $this->db->order_by('province"."province_id" desc');

            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
   function getAll_report6_text($between = NULL) {
            $this->db->select('np.np_paragraph_id AS np_paragraph_id, '
                    . 'np.np_paragraph AS np_paragraph, '
                    . 'np.np_createddate AS np_time, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_gun5 nrg5');
            $this->db->join('news_gun5', 'nrg5.ng_newsgunid = news_gun5.ng_newsgunid', 'left');
            $this->db->join('news', 'nrg5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrg5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('province.province_id !=', 0);
            $this->db->group_by('np.np_paragraph_id, "province"."province_id"');
            $this->db->order_by('np"."np_createddate" asc');
            $this->db->limit(10, 0);
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
   function getAll_report6($between = NULL) {
            $this->db->select('SUM("nrg5"."nr_holdreturn") AS nr_holdreturn_total, '
                    . '"news_gun5"."ng_gun" AS ng_gun, '
                    . '"news_gun5"."ng_newsgunid" AS ng_newsgunid, '
                    . '"province"."province_id" AS province_id');

            $this->db->from('news_relate_gun5 nrg5');
            $this->db->join('news_gun5', 'nrg5.ng_newsgunid = news_gun5.ng_newsgunid', 'left');
            $this->db->join('news', 'nrg5.n_newsid = news.n_newsid', 'left');
            $this->db->join('news_paragraph np', 'nrg5.n_newsid = np.n_newsid', 'left');
            $this->db->join('province','np.np_newsprovinceid= province.province_id','left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('news.n_datetime >=', $between['start']);
                $this->db->where('news.n_datetime <=', $between['end']);
            }
            $this->db->where('province.province_id !=', 0);
            $this->db->group_by('"news_gun5"."ng_newsgunid", "province"."province_id"');
            $this->db->order_by('province"."province_id" desc');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
   }
   function getAll_report7News($where = null, $between = NULL) {
            $this->db->select('n.n_newsid, n.n_dynamitecomplete, n.n_dynamitestop, np.np_newsprovinceid');

            $this->db->from('news n');
            $this->db->join('news_paragraph np', 'np.n_newsid = n.n_newsid', 'left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('n.n_datetime >=', $between['start']);
                $this->db->where('n.n_datetime <=', $between['end']);
            }
            
            if(!is_null($where)) {
                $this->db->where($where);
            }
            
            
            $this->db->group_by('n.n_newsid, n.n_dynamitecomplete, n.n_dynamitestop, np.np_newsprovinceid');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
    }
    
    function getAll_report7Dynamite($where = null, $between = NULL) {
            $this->db->select('n.n_newsid, np.np_newsprovinceid, nd.dt_dynamitetypeid, COUNT(nd.dt_dynamitetypeid) AS dynamitetype');

            $this->db->from('news n');
            $this->db->join('news_paragraph np', 'np.n_newsid = n.n_newsid', 'left');
            $this->db->join('news_dynamitetable5 nd', 'nd.n_newsid = n.n_newsid', 'left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('n.n_datetime >=', $between['start']);
                $this->db->where('n.n_datetime <=', $between['end']);
            }
            
            if(!is_null($where)) {
                $this->db->where($where);
            }
            
            
            $this->db->group_by('n.n_newsid, np.np_newsprovinceid, nd.dt_dynamitetypeid');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
    }
    
    function getAll_report7Ignition($where = null, $between = NULL) {
            $this->db->select('n.n_newsid, np.np_newsprovinceid, nd.it_ignitiontypeid, COUNT(nd.it_ignitiontypeid) AS ignitiontype');

            $this->db->from('news n');
            $this->db->join('news_paragraph np', 'np.n_newsid = n.n_newsid', 'left');
            $this->db->join('news_dynamitetable5 nd', 'nd.n_newsid = n.n_newsid', 'left');
            
            if (isset($between) and is_array($between)) {
                $this->db->where('n.n_datetime >=', $between['start']);
                $this->db->where('n.n_datetime <=', $between['end']);
            }
            
            if(!is_null($where)) {
                $this->db->where($where);
            }
            
            
            $this->db->group_by('n.n_newsid, np.np_newsprovinceid, nd.it_ignitiontypeid');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
               $result = $query->result_array();
                    return $result;
            } else 
                return false;
    }  
}
