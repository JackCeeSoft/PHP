<?php
include(APPPATH . "/core/base_e_army_model.php");

class M_news extends Base_e_army_model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function getNewsIdForLikeSearch( $like = NULL ) {
        $mergeNewsId = array();
        
        $this->db->select('n_newsid');

        $this->db->from('news');
        
        if (!is_null($like)) {
            $this->db->like('n_subject', $like);
        }
        
        $query = $this->db->get();
        
        $resultNews = array();
        if ($query->num_rows() > 0) {
            $resultNews = $query->result_array();
            foreach ( $resultNews as $value) {
                $mergeNewsId[$value['n_newsid']] = $value['n_newsid'];
            }
        }
        
        
        $this->db->select('n_newsid');

        $this->db->from('news_paragraph');
        
        if (!is_null($like)) {
            $this->db->like('np_paragraph', $like);
        }
        
        $this->db->group_by('n_newsid');
        
        $query = $this->db->get();
        
        $resultParagraph = array();
        if ($query->num_rows() > 0) {
            $resultParagraph = $query->result_array();
            foreach ( $resultParagraph as $value) {
                $mergeNewsId[$value['n_newsid']] = $value['n_newsid'];
            }
        }
        
        if( isset( $mergeNewsId ) && $mergeNewsId ) {
            return $mergeNewsId;
        } else {
            return NULL;
        }
        
    }
    
    public function getNewsAll($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL, $inNewsId = NULL, $likeParagraph = NULL) {
            $this->db->select('*');

            $this->db->from('news');

            $this->db->join('report_type5 report_type', 'report_type.rt_reporttypeid = news.rt_reporttypeid', 'left');
            
            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            
            $this->db->join('unit', 'unit.u_unitid = news.u_unitid', 'left');
            
            $this->db->join('unit_sub', 'unit_sub.s_unitsub_id = news.s_unitsub_id', 'left');
            
            $this->db->join('secret_level5 secret_level', 'secret_level.sl_secretid = news.sl_secretid', 'left');
            
            $this->db->join('haste_level5 haste_level', 'haste_level.hl_hastelevelid = news.hl_hastelevelid', 'left');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (!is_null($inNewsId)) {
                    $this->db->where_in('n_newsid', $inNewsId);
            }
            if (!is_null($like)) {
                foreach ($like as $k_like => $v_like) {
                    if (isset($v_like) and is_array($v_like)) {
                        foreach ($v_like as $kk_like => $vv_like) {
                            $this->db->or_like($kk_like, $vv_like);
                        }
                    } else {
                        $this->db->or_like($k_like, $v_like);
                    }
                }
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
                        $this->db->select('nc_commentid');
                        $this->db->from('news_comment');
                        $this->db->where('nc_newsid', $value['n_newsid']);
                        $this->db->where('nc_parentid', 0);
                        
                        $query_comment = $this->db->get();
                        $result[$key]['total_comment'] = $query_comment->num_rows();
                        
                        $this->db->select('*');
                        $this->db->from('news_link_tag');
                        $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_tag = $this->db->get();
                        if ($query_tag->num_rows() > 0) {
                            $result[$key]['tag'] = $query_tag->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('news_paragraph');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        if (!is_null($likeParagraph)) {
                            $this->db->like('np_paragraph', $likeParagraph); 
                        }
                        $this->db->order_by('np_paragraph_id ASC');
                        //$this->db->where('np_active', 'Y');
                        
                        $query_paragraph = $this->db->get();
                        if ($query_paragraph->num_rows() > 0) {
                            $result[$key]['paragraph'] = $query_paragraph->result_array();
                        }
                    }
                    return $result;
            } else
                    return false;
    }
    
    public function getCountNewsAll($where = NULL, $like = NULL, $inNewsId = NULL) {
            $this->db->select('n_newsid');

            $this->db->from('news');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (!is_null($inNewsId)) {
                    $this->db->where_in('n_newsid', $inNewsId);
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
            
            $this->db->group_by('n_newsid');
            
            $query = $this->db->get();
            return $query->num_rows();
    }
    
    public function getNewsAllByTag($where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL, $inNewsId = NULL, $likeParagraph = NULL) {
            $this->db->select('news.n_newsid, news.rt_reporttypeid, news.sl_secretid, news.hl_hastelevelid, news.n_from, news.n_source, news.ru_reportunitid, news.n_perform, news.n_aware, news.n_subject, '
                    . 'news.n_date, news.n_time, news.n_writer, news.n_approver, news.n_approvercode, news.n_description, news.n_conclusion, news.n_showcalendar, news.n_keyword, news.u_unitid, '
                    . ', news.n_place, news.n_to, news.n_attachdetail, news.n_active, news.n_alfrescolink, news.n_mainimage, news.n_createddate, news.n_createdby, news.n_updateddate, news.n_updatedby, report_type.rt_name, unit_sub.s_name, secret_level.sl_name, haste_level.hl_name');

            $this->db->from('news');
            
            $this->db->join('report_type5 report_type', 'report_type.rt_reporttypeid = news.rt_reporttypeid', 'left');

            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            
            $this->db->join('unit', 'unit.u_unitid = news.u_unitid', 'left');
            
            $this->db->join('unit_sub', 'unit_sub.s_unitsub_id = news.s_unitsub_id', 'left');
            
            $this->db->join('news_link_tag', 'news_link_tag.n_newsid = news.n_newsid', 'inner');
            
            $this->db->join('secret_level5 secret_level', 'secret_level.sl_secretid = news.sl_secretid', 'left');
            
            $this->db->join('haste_level5 haste_level', 'haste_level.hl_hastelevelid = news.hl_hastelevelid', 'left');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (!is_null($inNewsId)) {
                    $this->db->where_in('news.n_newsid', $inNewsId);
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
            
            $this->db->group_by('news.n_newsid, news.rt_reporttypeid, news.sl_secretid, news.hl_hastelevelid, news.n_from, news.n_source, news.ru_reportunitid, news.n_perform, news.n_aware, news.n_subject, '
                    . 'news.n_date, news.n_time, news.n_writer, news.n_approver, news.n_approvercode, news.n_description, news.n_conclusion, news.n_showcalendar, news.n_keyword, news.u_unitid, '
                    . ', news.n_place, news.n_to, news.n_attachdetail, news.n_active, news.n_alfrescolink, news.n_mainimage, news.n_createddate, news.n_createdby, news.n_updateddate, news.n_updatedby, report_type.rt_name, unit_sub.s_name, secret_level.sl_name, haste_level.hl_name');
            
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
                        $this->db->select('nc_commentid');
                        $this->db->from('news_comment');
                        $this->db->where('nc_newsid', $value['n_newsid']);
                        $this->db->where('nc_parentid', 0);
                        
                        $query_comment = $this->db->get();
                        $result[$key]['total_comment'] = $query_comment->num_rows();
                        
                        $this->db->select('*');
                        $this->db->from('news_link_tag');
                        $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        
                        $query_tag = $this->db->get();
                        if ($query_tag->num_rows() > 0) {
                            $result[$key]['tag'] = $query_tag->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('news_paragraph');
                        $this->db->where('n_newsid', $value['n_newsid']);
                        if (!is_null($likeParagraph)) {
                            $this->db->like('np_paragraph', $likeParagraph); 
                        }
                        $this->db->order_by('np_paragraph_id ASC');
                        
                        $query_paragraph = $this->db->get();
                        if ($query_paragraph->num_rows() > 0) {
                            $result[$key]['paragraph'] = $query_paragraph->result_array();
                        }
                    }
                    return $result;
            } else
                    return false;
    }
    
     public function getCountNewsAllByTag($where = NULL, $like = NULL, $inNewsId = NULL) {
            $this->db->select('news.n_newsid');

            $this->db->from('news');

            $this->db->join('report_type5 report_type', 'report_type.rt_reporttypeid = news.rt_reporttypeid', 'left');

            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            
            $this->db->join('unit', 'unit.u_unitid = news.u_unitid', 'left');
            
            $this->db->join('unit_sub', 'unit_sub.s_unitsub_id = news.s_unitsub_id', 'left');
            
            $this->db->join('news_link_tag', 'news_link_tag.n_newsid = news.n_newsid', 'inner');
            
            $this->db->join('secret_level5 secret_level', 'secret_level.sl_secretid = news.sl_secretid', 'left');
            
            $this->db->join('haste_level5 haste_level', 'haste_level.hl_hastelevelid = news.hl_hastelevelid', 'left');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            if (!is_null($inNewsId)) {
                    $this->db->where_in('news.n_newsid', $inNewsId);
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
            
            $this->db->group_by('news.n_newsid');
            
            $query = $this->db->get();
            return $query->num_rows();
    }
    
    public function filterNews($keyword = NULL, $where = NULL, $like = NULL, $order_by = NULL, $limit = NULL, $offset = NULL) {
            $this->db->select('news.n_newsid, news.rt_reporttypeid, news.sl_secretid, news.hl_hastelevelid, news.n_from, news.n_source, news.ru_reportunitid, news.n_perform, news.n_aware, news.n_subject, '
                    . 'news.n_date, news.n_time, news.n_writer, news.n_approver, news.n_approvercode, news.n_description, news.n_conclusion, news.n_showcalendar, news.n_keyword, news.u_unitid, '
                    . ', news.n_place, news.n_to, news.n_attachdetail, news.n_active, news.n_alfrescolink, news.n_mainimage, news.n_createddate, news.n_createdby, news.n_updateddate, news.n_updatedby');

            $this->db->from('news');
            
            $this->db->join('news_paragraph', 'news_paragraph.n_newsid = news.n_newsid', 'left');

            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            if (!is_null($keyword)) {
                if (is_array($keyword)) {
                    $condition_where = "(";
                    foreach ($keyword as $v_keyword){
                        $condition_where .= "news.n_subject LIKE '%$v_keyword%' OR news_paragraph.np_paragraph LIKE '%$v_keyword%' OR ";
                    }
                    $condition_where = substr($condition_where, 0, -4);
                    $condition_where .= ")";
                    $this->db->where($condition_where);
                } else {
                    $this->db->where("(news.n_subject LIKE '%$v_keyword%' OR news_paragraph.np_paragraph LIKE '%$v_keyword%')");
                }
            }
            
            if (!is_null($like)) {
                foreach ($like as $k_like => $v_like) {
                    if (isset($v_like) and is_array($v_like)) {
                        foreach ($v_like as $kk_like => $vv_like) {
                            $this->db->or_like($kk_like, $vv_like);
                        }
                    } else {
                        $this->db->or_like($k_like, $v_like);
                    }
                }
            }
            
            $this->db->group_by('news.n_newsid, news.rt_reporttypeid, news.sl_secretid, news.hl_hastelevelid, news.n_from, news.n_source, news.ru_reportunitid, news.n_perform, news.n_aware, news.n_subject, '
                    . 'news.n_date, news.n_time, news.n_writer, news.n_approver, news.n_approvercode, news.n_description, news.n_conclusion, news.n_showcalendar, news.n_keyword, news.u_unitid, '
                    . ', news.n_place, news.n_to, news.n_attachdetail, news.n_active, news.n_alfrescolink, news.n_mainimage, news.n_createddate, news.n_createdby, news.n_updateddate, news.n_updatedby');
            
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
    
    public function countFilterNews($keyword = NULL, $where = NULL, $like = NULL) {
            $this->db->select('news.n_newsid');

            $this->db->from('news');
            
            $this->db->join('news_paragraph', 'news_paragraph.n_newsid = news.n_newsid', 'left');

            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            if (!is_null($keyword)) {
                if (is_array($keyword)) {
                    $condition_where = "(";
                    foreach ($keyword as $v_keyword){
                        $condition_where .= "news.n_subject LIKE '%$v_keyword%' OR news_paragraph.np_paragraph LIKE '%$v_keyword%' OR ";
                    }
                    $condition_where = substr($condition_where, 0, -4);
                    $condition_where .= ")";
                    $this->db->where($condition_where);
                } else {
                    $this->db->where("(news.n_subject LIKE '%$v_keyword%' OR news_paragraph.np_paragraph LIKE '%$v_keyword%')");
                }
            }
            
            if (!is_null($like)) {
                foreach ($like as $k_like => $v_like) {
                    if (isset($v_like) and is_array($v_like)) {
                        foreach ($v_like as $kk_like => $vv_like) {
                            $this->db->or_like($kk_like, $vv_like);
                        }
                    } else {
                        $this->db->or_like($k_like, $v_like);
                    }
                }
            }
            
            $this->db->group_by('news.n_newsid, news.rt_reporttypeid, news.sl_secretid, news.hl_hastelevelid, news.n_from, news.n_source, news.ru_reportunitid, news.n_perform, news.n_aware, news.n_subject, '
                    . 'news.n_date, news.n_time, news.n_writer, news.n_approver, news.n_approvercode, news.n_description, news.n_conclusion, news.n_showcalendar, news.n_keyword, news.u_unitid, '
                    . ', news.n_place, news.n_to, news.n_attachdetail, news.n_active, news.n_alfrescolink, news.n_mainimage, news.n_createddate, news.n_createdby, news.n_updateddate, news.n_updatedby');
            

            $query = $this->db->get();
            return $query->num_rows();
    }
    
    public function getNewsDetail($id = NULL, $where = NULL) {
            $this->db->select('*');

            $this->db->from('news');
            
            $this->db->join('report_type5 report_type', 'report_type.rt_reporttypeid = news.rt_reporttypeid', 'left');
            $this->db->join('secret_level5 secret_level', 'secret_level.sl_secretid = news.sl_secretid', 'left');
            $this->db->join('haste_level5 haste_level', 'haste_level.hl_hastelevelid = news.hl_hastelevelid', 'left');
            $this->db->join('report_unit', 'report_unit.ru_reportunitid = news.ru_reportunitid', 'left');
            $this->db->join('unit', 'unit.u_unitid = news.u_unitid', 'left');
            $this->db->join('unit_sub', 'unit_sub.s_unitsub_id = news.s_unitsub_id', 'left');

            $this->db->where('n_newsid', $id);
            //$this->db->where('n_active', 'Y');
            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    $result = $query->row_array();
                    
                    /*$this->db->select('news_tag.nt_tagid, news_tag.nt_word');
                    $this->db->from('news_link_tag');
                    $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid');
                    $this->db->where('n_newsid', $id);
                    $this->db->group_by('news_link_tag.n_newsid, news_tag.nt_tagid, news_tag.nt_word');
                    
                    $query_tag = $this->db->get();
                    if ($query_tag->num_rows() > 0) {
                        $result['tag'] = $query_tag->result_array();
                    }*/
                        
                    $this->db->select('nc_commentid');
                    $this->db->from('news_comment');
                    $this->db->where('nc_newsid', $id);
                    $this->db->where('nc_parentid', 0);

                    $query_comment = $this->db->get();
                    $result['total_comment'] = $query_comment->num_rows();
                    
                    return $result;
            } else
                    return false;
    }
    
    public function getParagraphByNewsID($id = NULL, $where = NULL) {
            $this->db->select('*');

            $this->db->from('news_paragraph');
            
            $this->db->join('news_cause5 news_cause', 'news_cause.nc_newscauseid = news_paragraph.nc_newscauseid', 'left');
            $this->db->join('news_harry5 news_harry', 'news_harry.nh_newsharryid = news_paragraph.nh_newsharryid', 'left');
            $this->db->join('news_execution5 news_execution', 'news_execution.ne_newsexecutionid = news_paragraph.ne_newsexecutionid', 'left');
            
            $this->db->join('province', 'province.province_id = news_paragraph.np_newsprovinceid', 'left');
            $this->db->join('amphur', 'amphur.amphur_id = news_paragraph.na_newsamphorid', 'left');
            $this->db->join('district', 'district.district_id = news_paragraph.nt_newstambonid', 'left');
            
            $this->db->where('n_newsid', $id);
                    
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            $this->db->order_by('np_paragraph_id ASC');
            
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
                        
                        $this->db->select('news_tag.nt_tagid AS nt_tagid, news_tag.nt_word AS nt_word');
                        $this->db->from('news_link_tag');
                        $this->db->join('news_tag', 'news_tag.nt_tagid = news_link_tag.nt_tagid', 'inner');
                        $this->db->where('np_paragraph_id', $value['np_paragraph_id']);
                        
                        $query_tag = $this->db->get();
                        if ($query_tag->num_rows() > 0) {
                            $result[$key]['tag'] = $query_tag->result_array();
                        }
                        
                        $this->db->select('person.p_personid AS p_personid, person.p_firstname AS p_firstname, person.p_lastname AS p_lastname');
                        $this->db->from('news_link_person');
                        $this->db->join('person', 'person.p_personid = news_link_person.p_personid', 'inner');
                        $this->db->where('np_paragraph_id', $value['np_paragraph_id']);
                        
                        $query_person = $this->db->get();
                        if ($query_person->num_rows() > 0) {
                            $result[$key]['person'] = $query_person->result_array();
                        }
                        
                        $this->db->select('organization.o_organizationid AS o_organizationid, organization.o_fullnameth AS o_fullnameth');
                        $this->db->from('news_link_organization');
                        $this->db->join('organization', 'organization.o_organizationid = news_link_organization.o_organizationid', 'inner');
                        $this->db->where('np_paragraph_id', $value['np_paragraph_id']);
                        
                        $query_organization = $this->db->get();
                        if ($query_organization->num_rows() > 0) {
                            $result[$key]['organization'] = $query_organization->result_array();
                        }
                        
                    }
                    
                    return $result;
            } else
                    return false;
            
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
            
            $this->db->join('news_link_movement', 'news_link_movement.np_paragraph_id = news_paragraph.np_paragraph_id', 'left');

            
            if (!is_null($where)) {
                    $this->db->where($where);
            }
            
            if (isset($between) and is_array($between)) {
                $this->db->where('n_datetime >=', $between['start']);
                $this->db->where('n_datetime <=', $between['end']);
            }
            
            if (!is_null($or_where)) {
                $this->db->where($or_where);
            }
            
            $this->db->group_by('news_paragraph.np_paragraph_id, news_paragraph.n_newsid, news.n_subject, news_paragraph.np_paragraph, news_paragraph.np_mainimage, news_paragraph.np_createddate');
            
            $this->db->order_by('np_createddate DESC');
            
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
    
    public function getCommentByNewID($newsid = NULL, $parentid = 0) {
            $this->db->select('*');
            
            $this->db->from('news_comment');
            
            $this->db->where('nc_newsid', $newsid); 
            
            $this->db->where('nc_parentid', $parentid); 
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    foreach ($result as $key => $value) {
                        $this->db->select('ua_userid, ua_username, ua_firstname, ua_lastname');
                        $this->db->from('user_account');
                        $this->db->where('ua_userid', $value['o_createdby']);
                        
                        $query_user = $this->db->get();
                        if ($query_user->num_rows() > 0) {
                            $result[$key]['user_account'] = $query_user->row_array();
                        }
                        
                        $result[$key]['children'] = $this->getCommentByNewID($newsid, $value['nc_commentid']);
                    }
                    return $result;
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
