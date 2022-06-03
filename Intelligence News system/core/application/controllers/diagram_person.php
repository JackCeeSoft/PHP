<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Diagram_person extends Base_e_army {
    public $images_path;
   // public $db_model ;
    
    public function __construct() {
        parent::__construct();
        //$this->db_model = 'm_person';
        $this->load->model('m_diagram_person');
        $this->data['title_section'] = 'รายการบุคคล เชื่อมโยง ข่าวสาร';
        $this->images_path = $this->config->item('root_upload').$this->config->item('images_path_person');
    }


    public function detail_person($person_id = null){
        $sesstion = $this->getSesstion();
        $all_data = array();
        $this->action_log($this->m_diagram_person,'Diagram_person->detail','View',$sesstion['user_id']);
        if($person_id != null){
            
            $where['p_personid'] = $person_id;
            
            
            $all_newsid = $this->m_diagram_person->getAll('news_link_person', $where, null, 'np_paragraph_id DESC');
            $result_0 = $this->m_diagram_person->getDetail('person', $where);
            
            if(isset($all_newsid) && $all_newsid){
                foreach ($all_newsid as $k_anid => $v_anid){
                    $where_np['np_paragraph_id'] = $v_anid['np_paragraph_id'];
                    $all_data[$k_anid]['news_paragraph'] = $this->m_diagram_person->getDetail('news_paragraph', $where_np);

                    $where_p['p_personid'] = $v_anid['p_personid'];
                    $all_data[$k_anid]['person'] = $this->m_diagram_person->getDetail('person', $where_p);

                    if(!empty($all_data[$k_anid]['news_paragraph']) && !empty($all_data[$k_anid]['person'])){
                        $result_1[$k_anid] = array_merge($all_data[$k_anid]['news_paragraph'],$all_data[$k_anid]['person']);
                    }
                }
            }
            
            if(isset($result_1) && $result_1){
                foreach ($result_1 as $k_r_1 => $v_r_1){
//                np_paragraph_id
                    $where_1['np_paragraph_id'] = $v_r_1['np_paragraph_id'];
                    $all_newsid_1 = $this->m_diagram_person->getAll('news_link_person', $where_1, null, 'p_personid DESC');

                        if(isset($all_newsid_1) && $all_newsid_1){
                            foreach ($all_newsid_1 as $k_anid_1 => $v_ani_1){
                                if($v_ani_1['p_personid'] != $person_id){
                                    $where_np_1['np_paragraph_id'] = $v_ani_1['np_paragraph_id'];
                                    $all_paragrap_id[$k_anid_1] = $v_ani_1['np_paragraph_id'];
                                    $all_data_2[$k_anid_1]['news_paragraph'] = $this->m_diagram_person->getDetail('news_paragraph', $where_np_1);

                                    $where_p_1['p_personid'] = $v_ani_1['p_personid'];
                                    $all_data_2[$k_anid_1]['person'] = $this->m_diagram_person->getDetail('person', $where_p_1);

                                    $result_2[$k_anid_1] = array_merge($all_data_2[$k_anid_1]['news_paragraph'],$all_data_2[$k_anid_1]['person']);
                                }else{
                                    //echo "Jack".$person_id;
                                }
                            }
                        }
                }
            }
            
            if(isset($result_2) && $result_2){
                foreach($result_2 as $k_r_2 => $v_r_2){
                    $where_2['p_personid'] = $v_r_2['p_personid'];
                    $all_newsid_2 = $this->m_diagram_person->getAll('news_link_person', $where_2, null, 'np_paragraph_id DESC');
                    
                    if(isset($all_newsid_2) && $all_newsid_2){
                        foreach ($all_newsid_2 as $k_anid_2 => $v_ani_2){
                            if(!in_array($v_ani_2['np_paragraph_id'], $all_paragrap_id)){
                                $where_np_2['np_paragraph_id'] = $v_ani_2['np_paragraph_id'];
                                $all_data_3[$k_anid_2]['news_paragraph'] = $this->m_diagram_person->getDetail('news_paragraph', $where_np_2);

                                $where_p_2['p_personid'] = $v_ani_2['p_personid'];
                                $all_data_3[$k_anid_2]['person'] = $this->m_diagram_person->getDetail('person', $where_p_2);

                                $result_3[$k_anid_2] = array_merge($all_data_3[$k_anid_2]['news_paragraph'],$all_data_3[$k_anid_2]['person']);
                            }else{
                                //echo "Jack".$v_ani_2['np_paragraph_id'];
                            }
                        }
                    }
                    
                    
                }
            }

            //$this->debug($all_newsid_2);
            if(isset($result_0) && $result_0){
                //$this->debug($result_0); //get person Start
                $this->data['result_0'] = $result_0;
            }
            
            if(isset($result_1) && $result_1){
                //$this->debug($result_1); //get All np_paragraph  in $person_id
                $this->data['result_1'] = $result_1;
            }
            
            if(isset($result_2) && $result_2){
                //$this->debug($result_2); //get All np_paragraph  in $person_id
                $this->data['result_2'] = $result_2;
            }
            
            if(isset($result_3) && $result_3){
                //$this->debug($result_3); //get All np_paragraph  in $person_id
                $this->data['result_3'] = $result_3;
            }
    
            $this->view('diagram_person/v_diagram_person', $this->data);
            
        }else{
            header("Location: ".URL_BASE_UNIT."");
        }
    }
}