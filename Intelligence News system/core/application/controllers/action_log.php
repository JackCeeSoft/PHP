<?php
include(APPPATH . "/core/base_e_army.php");
class Action_log extends Base_e_army {
        public function __construct() {
            // Call the Model constructor
            parent::__construct();
            $this->load->model('m_db');
            $this->load->library('excel');
            $this->data['title_section'] = 'Action Logs';
            $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'ราย Logs'));
            //$this->load->libraries('excel');
        }
        public function lists($offset=0,$ua_username = NULL) {
            $sesstion = $this->getSesstion();
            $this->data['unit'] = $this->m_db->getAll('unit', NULL, NULL, 'u_unitid asc');
            $this->data['user_account'] = $this->m_db->getAll('user_account', NULL, NULL, 'ua_userid asc');
            $this->action_log($this->m_db,'Action_log->lists','View',$sesstion['user_id']);
            $where = $like = null;
            $limit = 10;
            
            if(isset($_GET['u_unitid']) || isset($_GET['g_search'])){
                $this->action_log($this->m_db,'Action_log->lists','Search',$sesstion['user_id']);
                
                if(isset($_GET['u_unitid']) && $_GET['u_unitid']){
                    $where['al_unit'] = $_GET['u_unitid'];
                    $this->data['u_unitid'] =  $_GET['u_unitid'];
                }
                if(isset($_GET['g_search']) && $_GET['g_search']){
                    $g_search = trim($_GET['g_search']);
                    $this->data['keyword'] = $g_search;
                    if($g_search != ""){
                        $word = explode(' ', $g_search);
                        foreach ($word as $key => $values){
                            $like[$key]['al_method'] =  $values;
                            $like[$key]['al_ip_address'] =  $values;
                            $like[$key]['al_user_agent'] =  $values;
                            $like[$key]['al_action'] =  $values;
                        }
                    }
                }
            }else{
                if($sesstion['base_u_unitid'] == 0){
                    $where_news_rows = $where = NULL;
                    $this->data['base_unitid'] = 0;
                }else{
                    $where['al_unit'] = '5'; 
                }
            }
            
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'action_log/lists';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] = $this->m_db->getCountAll('action_log', $where, $like);
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);   
                $this->data['total_news_rows'] = $this->m_db->getCountAll('action_log',$where);
                $this->data['lists'] = $this->m_db->getAll('action_log', $where, $like, 'al_createddate desc', $limit, $offset );

                    //$this->debug($this->data['lists']);
                    //exit();

                $this->view('action_log/v_action', $this->data);
	}
        public function lists_excel($offset = null) {
            $sesstion = $this->getSesstion();
            $like = null;
            $where = NULL;
            // #############################  COnfig ############################
            $filename= date('Ymd').'_action_logs.xls';
            $limit = 2000;
            $line = 1;
            
            if($sesstion['base_u_unitid'] == 0){
                $where = NULL;
                $this->data['base_unitid'] = 0;
            }else{
                $where['al_unit'] = '5'; 
            }
            if(isset($_GET['u_unitid']) && $_GET['u_unitid'] && $_GET['u_unitid'] != 0){
                $where['al_unit'] = $_GET['u_unitid'];
                $this->data['u_unitid'] =  $_GET['u_unitid'];
            }
            if(isset($_GET['g_search']) && $_GET['g_search']){
                $g_search = trim($_GET['g_search']);
                $this->data['keyword'] = $g_search;
                if($g_search != ""){
                    $word = explode(' ', $g_search);
                    foreach ($word as $key => $values){
                        $like[$key]['al_method'] =  $values;
                        $like[$key]['al_ip_address'] =  $values;
                        $like[$key]['al_user_agent'] =  $values;
                        $like[$key]['al_action'] =  $values;
                    }
                }
            }
            if(isset($_GET['al_action']) && $_GET['al_action']){
                $where['al_action'] = $_GET['al_action'];
                $this->data['al_action'] = $_GET['al_action'];
            }
            $cell_color = "A6A6A6";
            
            // #############################  COnfig ############################
            
            $this->action_log($this->m_db,'Action_log->lists_excel','Export Excel',$sesstion['user_id']);
            
            $unit = $this->m_db->getAll('unit', NULL, NULL, 'u_unitid asc');
            $user_account = $this->m_db->getAll('user_account', NULL, NULL, 'ua_userid asc');
            $this->data['lists'] = $this->m_db->getAll('action_log', $where, NULL, 'al_createddate desc',$limit, $offset );
            
            foreach ($this->data['lists'] as $k_list => $v_list){
                foreach ($user_account as $k_ua => $v_ua){
                    if($v_ua['ua_userid'] == $v_list['al_ua_userid']){
                        $this->data['lists'][$k_list]['ua_username'] = $v_ua['ua_username'];
                    }
                }
                foreach ($unit as $values){
                    if($values['u_unitid'] == $v_list['al_unit']){
                        $this->data['lists'][$k_list]['u_name'] = $values['u_name'];
                    }
                }
            }

            //$this->debug($this->data);
            //echo 'Export';
            
            //###### Start Export Excel ######
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('Report Logs');
            
            $this->excel->getActiveSheet()->setCellValue('A1', 'No.');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            
            $this->excel->getActiveSheet()->setCellValue('B1', 'ผู้ใช้งาน');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            
            $this->excel->getActiveSheet()->setCellValue('C1', 'หน่วยงาน');
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            
            
            $this->excel->getActiveSheet()->setCellValue('D1', 'IP Address');
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            
                       
            $this->excel->getActiveSheet()->setCellValue('E1', 'Action');
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            
            $this->excel->getActiveSheet()->setCellValue('F1', 'Time');
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            
            $this->excel->getActiveSheet()->setCellValue('G1', 'Method');
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            
        $this->cellBorder('A1:G1');
        $this->cellColor('A1:G1', $cell_color);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        //## Add Data to Excel ##
        
        //$this->debug($this->data['lists']);
        //exit();
        
        foreach ($this->data['lists'] as $k_excel => $v_excel){
            
            $line += 1;
            $this->cellBorder_THIN('A'.$line.':G'.$line);
            
            $this->excel->getActiveSheet()->setCellValue('A'.$line, $k_excel+1);
            $this->excel->getActiveSheet()->getStyle('A'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('A'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['ua_username'])) $v_excel['ua_username'] = "";
            $this->excel->getActiveSheet()->setCellValue('B'.$line, $v_excel['ua_username']);
            $this->excel->getActiveSheet()->getStyle('B'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('B'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['u_name'])) $v_excel['u_name'] = "";
            $this->excel->getActiveSheet()->setCellValue('C'.$line, $v_excel['u_name']);
            $this->excel->getActiveSheet()->getStyle('C'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('C'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['al_ip_address'])) $v_excel['al_ip_address'] = "";
            $this->excel->getActiveSheet()->setCellValue('D'.$line, $v_excel['al_ip_address']);
            $this->excel->getActiveSheet()->getStyle('D'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('D'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['al_action'])) $v_excel['al_action'] = "";
            $this->excel->getActiveSheet()->setCellValue('E'.$line, $v_excel['al_action']);
            $this->excel->getActiveSheet()->getStyle('E'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('E'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['al_createddate'])) $v_excel['al_createddate'] = "";
            $this->excel->getActiveSheet()->setCellValue('F'.$line, $v_excel['al_createddate']);
            $this->excel->getActiveSheet()->getStyle('F'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('F'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            if(!isset($v_excel['al_method'])) $v_excel['al_method'] = "";
            $this->excel->getActiveSheet()->setCellValue('G'.$line, $v_excel['al_method']);
            $this->excel->getActiveSheet()->getStyle('G'.$line)->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle('G'.$line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        }

        //## End Add Data to Excel ##
        
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
        
        //###### End Export Excel ######
	}
        
    function cellColor($cells,$color){
        $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                 'rgb' => $color
            )
        ));
    }
    function cellBorder($cells){
        $BStyle = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THICK
              )
            )
          );
        $this->excel->getActiveSheet()->getStyle($cells)->applyFromArray($BStyle);
    }
    function cellBorder_THIN($cells){
        $BStyle = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
              )
            )
          );
        $this->excel->getActiveSheet()->getStyle($cells)->applyFromArray($BStyle);
    }
    function cellBorder_HAIR($cells){
        $BStyle = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_HAIR
              )
            )
          );
        $this->excel->getActiveSheet()->getStyle($cells)->applyFromArray($BStyle);
    }
    function cellBorder_MEDIUM($cells){
        $BStyle = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM
              )
            )
          );
        $this->excel->getActiveSheet()->getStyle($cells)->applyFromArray($BStyle);
    }
    function cellBorder_SLANTDASHDOT($cells){
        $BStyle = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_SLANTDASHDOT
              )
            )
          );
        $this->excel->getActiveSheet()->getStyle($cells)->applyFromArray($BStyle);
    }
}
