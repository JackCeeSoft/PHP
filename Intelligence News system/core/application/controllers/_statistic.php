<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include(APPPATH . "/core/base_e_army.php");

class Statistic extends Base_e_army {
    
    public $news_images_path;
    public $paragraph_images_path;
    public $paragraph_file_path;
    public $unit_images_path;
    public $user_id;
    public $group_id;
    public $u_unitid;
    public $s_unitsubid;
    public $isadmin;
    public $canread;
    public $canadd;
    public $canedit;
    public $candelete;
    public $cancomment;
    public $cansearch;
    public $u_code;
    public $unit_table;
    public $full_name;


    public function __construct() {
        parent::__construct();
        
        $this->load->model('m_statistic');
        //load our new PHPExcel library
        $this->load->library('excel');
        $this->data['title_section'] = 'แสดงผลการค้นหา';
        
        $this->data['script'] = array(
            'assets/js/bootstrap-datetimepicker.min.js', 
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.js', 
            'assets/js/jsapi.js'
        );
        $this->data['style'] = array(
            'assets/css/bootstrap-combined.min.css', 
            'assets/css/bootstrap-datetimepicker.min.css', 
            'assets/css/editable/DT_bootstrap.css',
            'assets/css/editable/select2_metro.css',
            'assets/bootstrap-duallistbox/bootstrap-duallistbox.css', 
        );
        
        $sesstion = $this->getSesstion();
        $this->user_id = $sesstion['user_id'];
        $this->group_id = $sesstion['groupid'];
        $this->u_unitid = $sesstion['unitid'];
        $this->s_unitsubid = $sesstion['subunitid'];
        $this->isadmin = $sesstion['isadmin'];
        $this->canread = $sesstion['canread'];
        $this->canadd = $sesstion['canadd'];
        $this->canedit = $sesstion['canedit'];
        $this->candelete = $sesstion['candelete'];
        $this->cancomment = $sesstion['cancomment'];
        $this->cansearch = $sesstion['cansearch'];
        $this->u_code = (isset($sesstion['u_code']) and $sesstion['u_code']) ? $sesstion['u_code'] : '01';
        $this->full_name = $sesstion['firstname'] . ' ' . $sesstion['lastname'];
        $this->unit_table = 5;
    }
    public function detail($offset=0) {
        $this->data['breadcrumb'] = array(array('name' => 'หน้าแรก', 'link' => site_url('')), array('name' => 'สถิติ'));
        $where = $like = $order_by = NULL;
        $limit = 10;
            $array_abc = array();
            $array_abc[1] = 'A';           $array_abc[32] = 'AF';          $array_abc[63] = 'BK';           $array_abc[94] = 'CP';
            $array_abc[2] = 'B';           $array_abc[33] = 'AG';          $array_abc[64] = 'BL';           $array_abc[95] = 'CQ';
            $array_abc[3] = 'C';           $array_abc[34] = 'AH';          $array_abc[65] = 'BM';           $array_abc[96] = 'CR';
            $array_abc[4] = 'D';           $array_abc[35] = 'AI';          $array_abc[66] = 'BN';           $array_abc[97] = 'CS';
            $array_abc[5] = 'E';           $array_abc[36] = 'AJ';          $array_abc[67] = 'BO';           $array_abc[98] = 'CT';
            $array_abc[6] = 'F';           $array_abc[37] = 'AK';          $array_abc[68] = 'BP';           $array_abc[99] = 'CU';
            $array_abc[7] = 'G';           $array_abc[38] = 'AL';          $array_abc[69] = 'BQ';           $array_abc[100] = 'CV';
            $array_abc[8] = 'H';           $array_abc[39] = 'AM';          $array_abc[70] = 'BR';           $array_abc[101] = 'CW';
            $array_abc[9] = 'I';           $array_abc[40] = 'AN';          $array_abc[71] = 'BS';           $array_abc[102] = 'CX';
            $array_abc[10] = 'J';          $array_abc[41] = 'AO';          $array_abc[72] = 'BT';           $array_abc[103] = 'CY';
            $array_abc[11] = 'K';          $array_abc[42] = 'AP';          $array_abc[73] = 'BU';           $array_abc[104] = 'CZ';
            $array_abc[12] = 'L';          $array_abc[43] = 'AQ';          $array_abc[74] = 'BV';           $array_abc[105] = 'DA';
            $array_abc[13] = 'M';          $array_abc[44] = 'AR';          $array_abc[75] = 'BW';           $array_abc[106] = 'DB';
            $array_abc[14] = 'N';          $array_abc[45] = 'AS';          $array_abc[76] = 'BX';           $array_abc[107] = 'DC';
            $array_abc[15] = 'O';          $array_abc[46] = 'AT';          $array_abc[77] = 'BY';           $array_abc[108] = 'DE';
            $array_abc[16] = 'P';          $array_abc[47] = 'AU';          $array_abc[78] = 'BZ';           $array_abc[109] = 'DF';
            $array_abc[17] = 'Q';          $array_abc[48] = 'AV';          $array_abc[79] = 'CA';           $array_abc[110] = 'DG';
            $array_abc[18] = 'R';          $array_abc[49] = 'AW';          $array_abc[80] = 'CB';           $array_abc[111] = 'DH';
            $array_abc[19] = 'S';          $array_abc[50] = 'AX';          $array_abc[81] = 'CC';           $array_abc[112] = 'DI';
            $array_abc[20] = 'T';          $array_abc[51] = 'AY';          $array_abc[82] = 'CD';           $array_abc[113] = 'DJ';
            $array_abc[21] = 'U';          $array_abc[52] = 'AZ';          $array_abc[83] = 'CE';           $array_abc[114] = 'DK';
            $array_abc[22] = 'V';          $array_abc[53] = 'BA';          $array_abc[84] = 'CF';           $array_abc[115] = 'DL';
            $array_abc[23] = 'W';          $array_abc[54] = 'BB';          $array_abc[85] = 'CG';           $array_abc[116] = 'DM';
            $array_abc[24] = 'X';          $array_abc[55] = 'BC';          $array_abc[86] = 'CH';           $array_abc[117] = 'DN';
            $array_abc[25] = 'Y';          $array_abc[56] = 'BD';          $array_abc[87] = 'CI';           $array_abc[118] = 'DO';
            $array_abc[26] = 'Z';          $array_abc[57] = 'BE';          $array_abc[88] = 'CJ';           $array_abc[119] = 'DP';
            $array_abc[27] = 'AA';         $array_abc[58] = 'BF';          $array_abc[89] = 'CK';           $array_abc[120] = 'DQ';
            $array_abc[28] = 'AB';         $array_abc[59] = 'BG';          $array_abc[90] = 'CL';           $array_abc[121] = 'DR';
            $array_abc[29] = 'AC';         $array_abc[60] = 'BH';          $array_abc[91] = 'CM';           $array_abc[122] = 'DS';
            $array_abc[30] = 'AD';         $array_abc[61] = 'BI';          $array_abc[92] = 'CN';           $array_abc[123] = 'DT';
            $array_abc[31] = 'AE';         $array_abc[62] = 'BJ';          $array_abc[93] = 'CO';           $array_abc[124] = 'DU';
            
        /* ---------- Load data type 1 ---------- */
        $this->data['news_cause']       = $this->m_statistic->getAll('news_cause' . $this->unit_table, array('nc_harry' => '0', 'nc_execution' => '0'));
        $this->data['news_harry']       = $this->m_statistic->getAll('news_harry' . $this->unit_table);
        $this->data['news_execution']   = $this->m_statistic->getAll('news_execution' . $this->unit_table);
        /* ---------- Load data type 1 ---------- */
        
        /* ---------- Load data type 7 ---------- */
        $this->data['operate_bomb']     = array( '1' => 'ระเบิดทำงาน', '2' => 'เก็บกู้' );
        $this->data['dynamite_type']    = $this->m_statistic->getAll('dynamite_type' . $this->unit_table, NULL, NULL, 'dt_dynamitetypeid asc');
        $this->data['ignition_type']    = $this->m_statistic->getAll('ignition_type' . $this->unit_table, NULL, NULL, 'it_ignitiontypeid asc');
        /* ---------- Load data type 7 ---------- */
        
        if (isset($_GET['stat_type']) and $_GET['stat_type']) {
            $this->data['stat_type']        = isset( $_GET['stat_type'] ) ? $_GET['stat_type'] : '';
            $this->data['graph_ui']         = isset( $_GET['graph_ui'] ) ? $_GET['graph_ui'] : '';
            
            $between = null;
            if ((isset($_GET['start']) and $_GET['start']) and (isset($_GET['end']) and $_GET['end'])) {
                 $between['start'] = $_GET['start'];
                 $between['end'] = $_GET['end'];
                 $this->data['filter']['start'] = $_GET['start'];
                 $this->data['filter']['end'] = $_GET['end'];
            }
            
            if($_GET['stat_type'] == '1'){
                $this->data['group_event']      = isset( $_GET['group_event'] ) ? $_GET['group_event'] : 0;
                $this->data['event']            = isset( $_GET['group_event'] ) && isset( $_GET['event'.$_GET['group_event']] ) ? $_GET['event'.$_GET['group_event']] : '';
                $this->data['province']         = $this->m_statistic->getAll('province', array('province_show' => 'Y'));
                if(isset($this->data['province']) && $this->data['province']) {
                    foreach ($this->data['province'] as $k_province => $v_province) {
                        $this->data['amphur'][$v_province['province_id']] = $this->m_statistic->getAll('amphur', array('province_id' => $v_province['province_id']));
                    }
                }
                
                $where['n.rt_reporttypeid'] = 5;
                $where['n.u_unitid'] = $this->u_unitid;
                $this->data['result'] = $this->m_statistic->getAll_report1($where, $between);
                if(isset($_GET['export'])){
                    
            $total_column = 1;
            
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('จชต');
                    
            //##################### Title #####################
            $this->excel->getActiveSheet()->setCellValue('A1', 'พื้นที่');
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
            $this->excel->getActiveSheet()->mergeCells('A1:A2');
            
            $this->excel->getActiveSheet()->setCellValue('B1', 'เหตุการณ์');
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
            
            if(isset($this->data['news_cause']) && $this->data['news_cause']) {
                
                $news_cause = count($this->data['news_cause'])+2;
                $this->excel->getActiveSheet()->mergeCells('B1:'.$array_abc[$news_cause].'1');
                $total_column = $total_column + count($news_cause);
                
                $count_news_cause = $news_cause+1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_cause].'1', 'สูญเสีย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setBold(TRUE);
                
                $this->excel->getActiveSheet()->mergeCells($array_abc[$count_news_cause].'1:'.$array_abc[$count_news_cause+1].'1');
                $total_column = $total_column + $count_news_cause;
                $total_column -= 1;
            }
            
            //เหตึการณ์ 2
            $count_news_cause = $count_news_cause+2;
            $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_cause].'1', 'เหตุการณ์');
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setBold(TRUE);
            
            if(isset($this->data['news_harry']) && $this->data['news_harry']) {
                
                $count_harry = count($this->data['news_harry']);
                $this->excel->getActiveSheet()->mergeCells($array_abc[$count_news_cause].'1:'.$array_abc[$count_news_cause+$count_harry].'1');
                
                $count_news_cause = ($count_news_cause+ $count_harry)+1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_cause].'1', 'สูญเสีย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setBold(TRUE);
                $this->excel->getActiveSheet()->mergeCells($array_abc[$count_news_cause].'1:'.$array_abc[$count_news_cause+1].'1');
                $total_column = ($total_column + $count_harry)+3;
                
            }
            
            //เหตึการณ์ 3
            $count_news_cause = $count_news_cause+2;
            $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_cause].'1', 'เหตุการณ์');
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setBold(TRUE);
            
            if(isset($this->data['news_execution']) && $this->data['news_execution']) {
                
                $news_execution = count($this->data['news_execution']);
                $this->excel->getActiveSheet()->mergeCells($array_abc[$count_news_cause].'1:'.$array_abc[$count_news_cause+$news_execution].'1');
                
                $count_news_cause = ($count_news_cause+ $news_execution)+1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_cause].'1', 'สูญเสีย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_cause].'1')->getFont()->setBold(TRUE);
                $this->excel->getActiveSheet()->mergeCells($array_abc[$count_news_cause].'1:'.$array_abc[$count_news_cause+1].'1');
                $total_column = ($total_column + $news_execution)+3;
            }
            
            $count_news_title = 1;
            
            //รายละเอียด เหตุการณ์ 1 
            if(isset($this->data['news_cause']) && $this->data['news_cause']) {
                $news_cause = $this->data['news_cause'];
                //$this->debug($news_cause);
                foreach ($news_cause as $k_nc => $v_nc) {
                    $count_news_title = $count_news_title + 1;
                    //echo $count_news_title;
                    $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', $v_nc['nc_name']);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                }
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'รวม');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'เจ็บ');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'ตาย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
            }

            //รายละเอียด เหตุการณ์ 2
            if(isset($this->data['news_harry']) && $this->data['news_harry']) {
                $news_harry = $this->data['news_harry'];
                //$this->debug($news_cause);
                foreach ($news_harry as $k_nh => $v_nh) {
                    $count_news_title = $count_news_title + 1;
                    //echo $count_news_title;
                    $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', $v_nh['nh_name']);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                }
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'รวม');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'เจ็บ');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'ตาย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
            }

            //รายละเอียด เหตุการณ์ 3
            if(isset($this->data['news_execution']) && $this->data['news_execution']) {
                $news_execution = $this->data['news_execution'];
                //$this->debug($news_cause);
                foreach ($news_execution as $k_ne => $v_ne) {
                    $count_news_title = $count_news_title + 1;
                    //echo $count_news_title;
                    $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', $v_ne['ne_name']);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                }
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'รวม');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'เจ็บ');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
                
                $count_news_title += 1;
                $this->excel->getActiveSheet()->setCellValue($array_abc[$count_news_title].'2', 'ตาย');
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle($array_abc[$count_news_title].'2')->getFont()->setBold(TRUE);
            }
           
            
        //##################### End Title #####################
        
            
        //===================== Title province ==========================    
            
            $province = $this->data['province'];
            $amphur   = $this->data['amphur'];
            $news_cause = $this->data['news_cause'];
            $result     = $this->data['result'];
            $k_p = 2;
            foreach ($province as $k_province => $v_province) {
                $sumProvince[$v_province['province_id']] = array();
                $k_p += 1;
                $this->excel->getActiveSheet()->setCellValue('A'.$k_p, $v_province['province_name']);
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setSize(11);
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setBold(TRUE);
                $this->excel->getActiveSheet()->mergeCells('A'.$k_p.':'.$array_abc[$total_column].$k_p);
                $this->cellColor('A'.$k_p, 'bed7ff');
                
                foreach ($amphur[$v_province['province_id']] as $k_amphur => $v_amphur) {
                    $k_p += 1;
                    $this->excel->getActiveSheet()->setCellValue('A'.$k_p, ' '.$v_amphur['amphur_name']);
                    $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setBold(TRUE);
                    
                    //เหตุการณ์ 1 Data
                    if(isset($news_cause) && $news_cause) {
                        $sumInjuriesCause = 0;
                        $sumLoseCause = 0;
                        $sumAmphurCause = 0;
                        foreach($news_cause as $k_news_cause => $v_news_cause) {
                            if(empty($sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']])) {
                                $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] = 0;
                            }
                            $totalAmphurCause = 0;
                            if(isset($result) && $result) {
                                foreach($result as $k_result => $v_result) {
                                    if($v_result['nc_newscauseid'] == $v_news_cause['nc_newscauseid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) {
                                        $totalAmphurCause++;
                                        if(isset($v_result['injuries']) && $v_result['injuries']) {
                                            $sumInjuriesCause = $sumInjuriesCause + $v_result['injuries'];
                                        }
                                        if(isset($v_result['lose']) && $v_result['lose']) {
                                            $sumLoseCause = $sumLoseCause + $v_result['lose'];
                                        }
                                    }
                                }
                            }   // End IF $result
                            
                            $this->excel->getActiveSheet()->setCellValue($array_abc[$k_news_cause+2].$k_p, $totalAmphurCause);
                            $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+2].$k_p)->getFont()->setSize(9);
                            $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+2].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+2].$k_p)->getFont()->setBold(TRUE);
                            
                            $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] = $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] + $totalAmphurCause;
                            $sumAmphurCause = $sumAmphurCause + $totalAmphurCause;
                        }
                        if(empty($sumProvince[$v_province['province_id']]['cause_sum'])) {
                            $sumProvince[$v_province['province_id']]['cause_sum'] = $sumAmphurCause;
                        }else {
                            $sumProvince[$v_province['province_id']]['cause_sum'] = $sumProvince[$v_province['province_id']]['cause_sum'] + $sumAmphurCause;
                        }
                        if(empty($sumProvince[$v_province['province_id']]['cause_injuries'])) {
                            $sumProvince[$v_province['province_id']]['cause_injuries'] = $sumInjuriesCause;
                        }else{
                            $sumProvince[$v_province['province_id']]['cause_injuries'] = $sumProvince[$v_province['province_id']]['cause_injuries'] + $sumInjuriesCause;
                        }
                        if(empty($sumProvince[$v_province['province_id']]['cause_lose'])) {
                            $sumProvince[$v_province['province_id']]['cause_lose'] = $sumLoseCause;
                        }else{
                            $sumProvince[$v_province['province_id']]['cause_lose'] = $sumProvince[$v_province['province_id']]['cause_lose'] + $sumLoseCause;
                        }
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[$k_news_cause+3].$k_p, $sumAmphurCause);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+3].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+3].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+3].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[$k_news_cause+3].$k_p, 'ffffc7');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[$k_news_cause+4].$k_p, $sumInjuriesCause);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+4].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+4].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+4].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[$k_news_cause+4].$k_p, 'ffccc9');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[$k_news_cause+5].$k_p, $sumLoseCause);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+5].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+5].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[$k_news_cause+5].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[$k_news_cause+5].$k_p, 'ffccc9');
                        $key_arr_abc = $k_news_cause + 5;
                    }
                    //End เหตุการณ์ 1 Data
                    
                    //เหตุการณ์ 2 Data
                        if(isset($news_harry) && $news_harry) { 
                            $sumInjuriesHarry = 0;
                            $sumLoseHarry = 0;
                            $sumAmphurHarry = 0;
                            foreach($news_harry as $k_news_harry => $v_news_harry) {
                                if(empty($sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']])) {
                                    $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] = 0;
                                }
                                $totalAmphurHarry = 0;
                                if(isset($result) && $result) {
                                    foreach($result as $k_result => $v_result) {
                                        if($v_result['nh_newsharryid'] == $v_news_harry['nh_newsharryid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) { 
                                            $totalAmphurHarry++;
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesHarry = $sumInjuriesHarry + $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseHarry = $sumLoseHarry + $v_result['lose'];
                                            }
                                        }
                                    }
                                } // End IF $result
                                
                            $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_harry+$key_arr_abc)+1].$k_p, $totalAmphurHarry);
                            $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+1].$k_p)->getFont()->setSize(9);
                            $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+1].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+1].$k_p)->getFont()->setBold(TRUE);
                               
                            $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] = $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] + $totalAmphurHarry;
                            $sumAmphurHarry = $sumAmphurHarry + $totalAmphurHarry;
                                
                            } // End Foreach
                            if(empty($sumProvince[$v_province['province_id']]['harry_sum'])) {
                                $sumProvince[$v_province['province_id']]['harry_sum'] = $sumAmphurHarry;
                            }else{
                                $sumProvince[$v_province['province_id']]['harry_sum'] = $sumProvince[$v_province['province_id']]['harry_sum'] + $sumAmphurHarry;
                            }
                            if(empty($sumProvince[$v_province['province_id']]['harry_injuries'])) {
                                $sumProvince[$v_province['province_id']]['harry_injuries'] = $sumInjuriesHarry;
                            }else{
                                $sumProvince[$v_province['province_id']]['harry_injuries'] = $sumProvince[$v_province['province_id']]['harry_injuries'] + $sumInjuriesHarry;
                            }
                            if(empty($sumProvince[$v_province['province_id']]['harry_lose'])) {
                                $sumProvince[$v_province['province_id']]['harry_lose'] = $sumLoseHarry;
                            }else{
                                $sumProvince[$v_province['province_id']]['harry_lose'] = $sumProvince[$v_province['province_id']]['harry_lose'] + $sumLoseHarry;
                            }
                            
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_harry+$key_arr_abc)+2].$k_p, $sumAmphurHarry);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+2].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+2].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+2].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_harry+$key_arr_abc)+2].$k_p, 'ffffc7');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_harry+$key_arr_abc)+3].$k_p, $sumInjuriesHarry);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+3].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+3].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+3].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_harry+$key_arr_abc)+3].$k_p, 'ffccc9');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_harry+$key_arr_abc)+4].$k_p, $sumLoseHarry);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+4].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+4].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_harry+$key_arr_abc)+4].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_harry+$key_arr_abc)+4].$k_p, 'ffccc9');
                        
                        $key_arr_abc = ($k_news_harry+$key_arr_abc)+4;  
                            
                        } //End IF $news_harry
                    //End เหตุการณ์ 2 Data
                        
                    //เหตุการณ์ 3 Data
                        if(isset($news_execution) && $news_execution) {
                            $sumInjuriesExecution = 0;
                            $sumLoseExecution = 0;
                            $sumAmphurExecution = 0;
                            foreach($news_execution as $k_news_execution => $v_news_execution) {
                                if(empty($sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']])) {
                                    $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] = 0;
                                }
                                $totalAmphurExecution = 0;
                                if(isset($result) && $result) {
                                    foreach($result as $k_result => $v_result) {
                                        if($v_result['ne_newsexecutionid'] == $v_news_execution['ne_newsexecutionid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) {
                                            $totalAmphurExecution++;
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesExecution = $sumInjuriesExecution + $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseExecution = $sumLoseExecution + $v_result['lose'];
                                            }
                                        }
                                    }// End foreach $result
                                }// End IF $result
                                $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] = $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] + $totalAmphurExecution;
                                
                                $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_execution+$key_arr_abc)+1].$k_p, $totalAmphurExecution);
                                $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+1].$k_p)->getFont()->setSize(9);
                                $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+1].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+1].$k_p)->getFont()->setBold(TRUE);
                                
                                $sumAmphurExecution = $sumAmphurExecution + $totalAmphurExecution;
                                
                            } // End foreach $news_execution
                            
                            if(empty($sumProvince[$v_province['province_id']]['execution_sum'])) {
                                $sumProvince[$v_province['province_id']]['execution_sum'] = $sumAmphurExecution;
                            }else{
                                $sumProvince[$v_province['province_id']]['execution_sum'] = $sumProvince[$v_province['province_id']]['execution_sum'] + $sumAmphurExecution;
                            }
                            if(empty($sumProvince[$v_province['province_id']]['execution_injuries'])) {
                                $sumProvince[$v_province['province_id']]['execution_injuries'] = $sumInjuriesExecution;
                            }else{
                                $sumProvince[$v_province['province_id']]['execution_injuries'] = $sumProvince[$v_province['province_id']]['execution_injuries'] + $sumInjuriesExecution;
                            }
                            if(empty($sumProvince[$v_province['province_id']]['execution_lose'])) {
                                $sumProvince[$v_province['province_id']]['execution_lose'] = $sumLoseExecution;
                            }else{
                                $sumProvince[$v_province['province_id']]['execution_lose'] = $sumProvince[$v_province['province_id']]['execution_lose'] + $sumLoseExecution;
                            }
                            
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_execution+$key_arr_abc)+2].$k_p, $sumAmphurExecution);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+2].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+2].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+2].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_execution+$key_arr_abc)+2].$k_p, 'ffffc7');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_execution+$key_arr_abc)+3].$k_p, $sumInjuriesExecution);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+3].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+3].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+3].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_execution+$key_arr_abc)+3].$k_p, 'ffccc9');
                        
                        $this->excel->getActiveSheet()->setCellValue($array_abc[($k_news_execution+$key_arr_abc)+4].$k_p, $sumLoseExecution);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+4].$k_p)->getFont()->setSize(9);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+4].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle($array_abc[($k_news_execution+$key_arr_abc)+4].$k_p)->getFont()->setBold(TRUE);
                        $this->cellColor($array_abc[($k_news_execution+$key_arr_abc)+4].$k_p, 'ffccc9');
                            
                            
                        }//End if $news_execution
                    //End เหตุการณ์ 3 Data
                        
                        
                        
                        
                }
                $k_p += 1;
                $this->excel->getActiveSheet()->setCellValue('A'.$k_p, 'รวม');
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $this->excel->getActiveSheet()->getStyle('A'.$k_p)->getFont()->setBold(TRUE);
                $this->cellColor('A'.$k_p, 'ffffc7');
                //$this->debug($sumProvince);
                $total_province = 1;
                foreach($sumProvince[$v_province['province_id']] as $k_sumProvince => $v_sumProvince) {
                    $total_province += 1;
                    $this->excel->getActiveSheet()->setCellValue($array_abc[$total_province].$k_p, $v_sumProvince);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$total_province].$k_p)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$total_province].$k_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle($array_abc[$total_province].$k_p)->getFont()->setBold(TRUE);
                    $this->cellColor($array_abc[$total_province].$k_p, 'ffffc7');
                    $set_cell = $array_abc[$total_province].$k_p;
                }
                 
            }
        //===================== End Title province ==========================        
            
            
        //##################### Set Auto Cell #####################   
        foreach ($array_abc as $key => $v_arr_abc) {
            $this->excel->getActiveSheet()->getColumnDimension($v_arr_abc)->setAutoSize(true);
        }
        $this->cellBorder_THIN('A1:'.$set_cell);
        $this->excel->getActiveSheet()->getStyle('A1:'.$set_cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        //##################### End Set Auto Cell #####################  

            $filename= date('Ymd').'_เหตุการณ์และภาพรวมสถานการณ์ใน จชต.xls'; //save our workbook as this file name
    
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache

            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
        
                }else{
                    $this->view('statistic/v_statistic_1', $this->data); 
                }
                
            }   
            if($_GET['stat_type'] == '2'){
                $this->data['province']      = isset( $_GET['province'] ) ? $_GET['province'] : 0;
                $all_data_count = $this->m_statistic->getAll_report2($between);
                $this->data['data_text'] = $this->m_statistic->getAll_report2_text($between,$limit,$offset);
                $person5 = $this->data['news_person5'] = $this->m_statistic->getAll('news_person5',NULL,NULL,'np_seq asc');
                $this->data['data_text_count'] = $this->m_statistic->getAll_report2_text($between,99999,$offset);
                
                if(isset($this->data['data_text_count']) && $this->data['data_text_count']){
                    $this->data['total_rows'] = count($this->data['data_text_count']);
                }else{
                    $this->data['total_rows'] = 0;
                }
                $province_76 = 0;
                $province_75 = 0;
                $province_74 = 0;
                $province_70 = 0;
                
                if(isset($all_data_count) && $all_data_count){
                        foreach($all_data_count as $k_adc => $v_adc){
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 76){
                                $province_76 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 75){
                                $province_75 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 74){
                                $province_74 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 70){
                                $province_70 = 1;
                            }
                        }
                        if(isset($province_76) && $province_76 != 1){
                            foreach ($person5 as $k_g => $v_g) {
                                    $data['nr_injuries_total'] = 0;
                                    $data['nr_lose_total'] = 0;
                                    $data['np_person'] = $v_g['np_person'];
                                    $data['np_newspersonid'] = $v_g['np_newspersonid'];
                                    $data['province_id'] = 76;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_75) && $province_75 != 1){
                            foreach ($person5 as $k_g => $v_g) {
                                    $data['nr_injuries_total'] = 0;
                                    $data['nr_lose_total'] = 0;
                                    $data['np_person'] = $v_g['np_person'];
                                    $data['np_newspersonid'] = $v_g['np_newspersonid'];
                                    $data['province_id'] = 75;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_74) && $province_74 != 1){
                            foreach ($person5 as $k_g => $v_g) {
                                    $data['nr_injuries_total'] = 0;
                                    $data['nr_lose_total'] = 0;
                                    $data['np_person'] = $v_g['np_person'];
                                    $data['np_newspersonid'] = $v_g['np_newspersonid'];
                                    $data['province_id'] = 74;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_70) && $province_70 != 1){
                            foreach ($person5 as $k_g => $v_g) {
                                    $data['nr_injuries_total'] = 0;
                                    $data['nr_lose_total'] = 0;
                                    $data['np_person'] = $v_g['np_person'];
                                    $data['np_newspersonid'] = $v_g['np_newspersonid'];
                                    $data['province_id'] = 70;
                                    $all_data_count[]=$data;
                            }
                        }
                        $data_use_count = array();
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 76){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 75){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 74){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 70){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                }else{
                    $data_use_count = NULL;
                }
                $this->data['all_data_count'] = $data_use_count;
                
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'statistic/detail';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] ;
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);  
                //$this->data['total_news_rows'] = $this->m_unit->getCountAll('unit', $where_news_rows);
                //$this->debug($this->data['all_data_count']);
                //exit();
                if(isset($_GET['export'])){
//                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
//                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
//                    header("Expires: 0");
//                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//                    header("Cache-Control: private",false);
//                    $this->view('statistic/v_statistic_2_excel', $this->data);
                    $total_column = 1;
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle('จำนวนผู้เสียชีวิตและบาดเจ็บ');
                    
                    // ########## Set Title ##################
                    $this->excel->getActiveSheet()->setCellValue('A1', 'ประเภทสูญเสีย');
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
                    $this->excel->getActiveSheet()->mergeCells('A1:A2');
                    
                    $this->excel->getActiveSheet()->setCellValue('B1', 'จังหวัดนราธิวาส');
                    $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
                    $this->excel->getActiveSheet()->mergeCells('B1:C1');
                    
                    $this->excel->getActiveSheet()->setCellValue('B2', 'ตาย');
                    $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('C2', 'เจ็บ');
                    $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C2')->getFont()->setBold(TRUE);
                    
                    
                    $this->excel->getActiveSheet()->setCellValue('D1', 'จังหวัดยะลา');
                    $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(TRUE);
                    $this->excel->getActiveSheet()->mergeCells('D1:E1');
                    
                    $this->excel->getActiveSheet()->setCellValue('D2', 'ตาย');
                    $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('E2', 'เจ็บ');
                    $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('F1', 'จังหวัดปัตตานี');
                    $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(TRUE);
                    $this->excel->getActiveSheet()->mergeCells('F1:G1');
                    
                    $this->excel->getActiveSheet()->setCellValue('F2', 'ตาย');
                    $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('F2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('G2', 'เจ็บ');
                    $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('H1', 'จังหวัดสงขลา');
                    $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(TRUE);
                    $this->excel->getActiveSheet()->mergeCells('H1:I1');
                    
                    $this->excel->getActiveSheet()->setCellValue('H2', 'ตาย');
                    $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('H2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('I2', 'เจ็บ');
                    $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(TRUE);
                    
                    $this->excel->getActiveSheet()->setCellValue('J1', 'รวม');
                    $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(TRUE);
                    $this->cellColor('J1', 'ffccc9');
                    $this->excel->getActiveSheet()->mergeCells('J1:K1');
                    
                    $this->excel->getActiveSheet()->setCellValue('J2', 'ตาย');
                    $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(TRUE);
                    $this->cellColor('J2', 'ffccc9');
                    
                    $this->excel->getActiveSheet()->setCellValue('K2', 'เจ็บ');
                    $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setBold(TRUE);
                    $this->cellColor('K2', 'ffccc9');
                    
                    $count_x_injuries = 0;
                    $count_x_lose = 0;
                    
                    $count_y1_lose= 0;
                    $count_y1_injuries= 0;
                    
                    $count_y2_lose = 0;
                    $count_y2_injuries = 0;
                    
                    $count_y3_lose = 0;
                    $count_y3_injuries = 0;
                    
                    $count_y4_lose = 0;
                    $count_y4_injuries = 0;
                    
                    $all_data_count = $this->data['all_data_count'];
                    $news_person5   = $this->data['news_person5'];
                    
                    $line_person5 = 2;
                    if($all_data_count){
                        foreach ($news_person5 as $k_np5 => $v_np5) { 
                            $count_x_injuries = 0;
                            $count_x_lose = 0; 
                            $line_person5 += 1;
                            $this->excel->getActiveSheet()->setCellValue('A'.$line_person5, $v_np5['np_person']);
                            $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getFont()->setSize(11);
                            $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                            $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getFont()->setBold(TRUE);
                            
                            foreach ($all_data_count as $k_adc => $v_adc) {
                                //76
                                if($v_adc['province_id'] == 76){
                                    if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                        $count_x_injuries += $v_adc['nr_injuries_total'];
                                        $count_x_lose += $v_adc['nr_lose_total'];
                                                
                                        $count_y1_lose += $v_adc['nr_lose_total'];
                                        $count_y1_injuries += $v_adc['nr_injuries_total'];
                                        
                                        $this->excel->getActiveSheet()->setCellValue('B'.$line_person5, $v_adc['nr_lose_total']);
                                        $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getFont()->setBold(TRUE);
                                        
                                        $this->excel->getActiveSheet()->setCellValue('C'.$line_person5, $v_adc['nr_injuries_total']);
                                        $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getFont()->setBold(TRUE);
                                    }
                                }
                                
                                //75
                                if($v_adc['province_id'] == 75){
                                    if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                        $count_y2_lose += $v_adc['nr_lose_total'];
                                        $count_y2_injuries += $v_adc['nr_injuries_total'];
                                                
                                        $count_x_injuries += $v_adc['nr_injuries_total'];
                                        $count_x_lose += $v_adc['nr_lose_total'];
                                        
                                        $this->excel->getActiveSheet()->setCellValue('D'.$line_person5, $v_adc['nr_lose_total']);
                                        $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getFont()->setBold(TRUE);
                                        
                                        $this->excel->getActiveSheet()->setCellValue('E'.$line_person5, $v_adc['nr_injuries_total']);
                                        $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getFont()->setBold(TRUE);
                                    }
                                }
                                
                                //74
                                if($v_adc['province_id'] == 74){
                                    if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                        $count_y3_lose += $v_adc['nr_lose_total'];
                                        $count_y3_injuries += $v_adc['nr_injuries_total'];

                                        $count_x_injuries += $v_adc['nr_injuries_total'];
                                        $count_x_lose += $v_adc['nr_lose_total'];
                                        
                                        $this->excel->getActiveSheet()->setCellValue('F'.$line_person5, $v_adc['nr_lose_total']);
                                        $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getFont()->setBold(TRUE);
                                        
                                        $this->excel->getActiveSheet()->setCellValue('G'.$line_person5, $v_adc['nr_injuries_total']);
                                        $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getFont()->setBold(TRUE);
                                    }
                                }
                                
                                //70
                                if($v_adc['province_id'] == 70){
                                    if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                        $count_y4_lose += $v_adc['nr_lose_total'];
                                        $count_y4_injuries += $v_adc['nr_injuries_total'];
                                                
                                        $count_x_injuries += $v_adc['nr_injuries_total'];
                                        $count_x_lose += $v_adc['nr_lose_total'];
                                        
                                        $this->excel->getActiveSheet()->setCellValue('H'.$line_person5, $v_adc['nr_lose_total']);
                                        $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getFont()->setBold(TRUE);
                                        
                                        $this->excel->getActiveSheet()->setCellValue('I'.$line_person5, $v_adc['nr_injuries_total']);
                                        $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getFont()->setSize(9);
                                        $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getFont()->setBold(TRUE);
                                    }
                                }
                                //รวม เจ็บ ตาย
                                $this->excel->getActiveSheet()->setCellValue('J'.$line_person5, $count_x_lose);
                                $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getFont()->setSize(9);
                                $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getFont()->setBold(TRUE);
                                $this->cellColor('J'.$line_person5, 'ffccc9');
                                
                                $this->excel->getActiveSheet()->setCellValue('K'.$line_person5, $count_x_injuries);
                                $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getFont()->setSize(9);
                                $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getFont()->setBold(TRUE);
                                $this->cellColor('K'.$line_person5, 'ffccc9');
                                
                            } //End Foreach
                            
                            
                            
                        }
                    }// End IF All_data
                    
                    $line_person5 += 1;
                    $this->excel->getActiveSheet()->setCellValue('A'.$line_person5, 'รวม');
                    $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getFont()->setSize(11);
                    $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $this->excel->getActiveSheet()->getStyle('A'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('A'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('B'.$line_person5, $count_y1_lose);
                    $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('B'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('B'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('C'.$line_person5, $count_y1_injuries);
                    $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('C'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('D'.$line_person5, $count_y2_lose);
                    $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('D'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('D'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('E'.$line_person5, $count_y2_injuries);
                    $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('E'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('E'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('F'.$line_person5, $count_y3_lose);
                    $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('F'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('F'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('G'.$line_person5, $count_y3_injuries);
                    $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('G'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('G'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('H'.$line_person5, $count_y4_lose);
                    $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('H'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('H'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('I'.$line_person5, $count_y4_injuries);
                    $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('I'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('I'.$line_person5, 'ffffc7');
                    
                    $this->excel->getActiveSheet()->setCellValue('J'.$line_person5, $count_y1_lose+$count_y2_lose+$count_y3_lose+$count_y4_lose);
                    $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('J'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('J'.$line_person5, 'ffccc9');
                    
                    $this->excel->getActiveSheet()->setCellValue('K'.$line_person5, $count_y1_injuries+$count_y2_injuries+$count_y3_injuries+$count_y4_injuries);
                    $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getFont()->setSize(9);
                    $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('K'.$line_person5)->getFont()->setBold(TRUE);
                    $this->cellColor('K'.$line_person5, 'ffccc9');
                    
                    
                    
        //##################### Set Auto Cell #####################
            $set_cell = 'K'.$line_person5;
//            foreach ($array_abc as $key => $v_arr_abc) {
//                $this->excel->getActiveSheet()->getColumnDimension($v_arr_abc)->setAutoSize(true);
//            }
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->cellBorder_THIN('A1:'.$set_cell);
            $this->excel->getActiveSheet()->getStyle('A1:'.$set_cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //##################### End Set Auto Cell #####################  

            $filename= date('Ymd').'_จำนวนผู้เสียชีวิตและบาดเจ็บ.xls'; //save our workbook as this file name
    
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache

            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
                    
                }else{
                    $this->view('statistic/v_statistic_2', $this->data);
                }
                
            }
            if($_GET['stat_type'] == '3'){
                $this->data['all_data_count'] = $this->m_statistic->getAll_report3($between);
                $this->data['data_text'] = $this->m_statistic->getAll_report3_text($between,$limit,$offset);
                $this->data['news_execution5'] = $this->m_statistic->getAll('news_execution5',NULL,NULL,'ne_newsexecutionid asc');
                $this->data['data_text_count'] = $this->m_statistic->getAll_report3_text($between,99999,$offset);
                
                if(isset($this->data['data_text_count']) && $this->data['data_text_count']){
                    $this->data['total_rows'] = count($this->data['data_text_count']);
                }else{
                    $this->data['total_rows'] = 0;
                }
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'statistic/detail';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] ;
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
                
                //$this->debug($config);
                //exit();
                //$this->data['all_data_count'] = $result;
                if(isset($_GET['export'])){
                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    $this->view('statistic/v_statistic_3_excel', $this->data);
                }else{
                    $this->view('statistic/v_statistic_3', $this->data);
                }
                
            }
            if($_GET['stat_type'] == '4'){
                $this->data['all_data_count'] = $this->m_statistic->getAll_report4($between);
                $this->data['data_text'] = $this->m_statistic->getAll_report4_text($between);
                $this->data['news_harry5'] = $this->m_statistic->getAll('news_harry5',NULL,NULL,'nh_newsharryid asc');
                //$this->debug($this->data['all_data_count']);
                //
                //exit();
                
                $this->data['data_text_count'] = $this->m_statistic->getAll_report4_text($between,99999,$offset);
                
                if(isset($this->data['data_text_count']) && $this->data['data_text_count']){
                    $this->data['total_rows'] = count($this->data['data_text_count']);
                }else{
                    $this->data['total_rows'] = 0;
                }
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'statistic/detail';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] ;
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);
                if(isset($_GET['export'])){
                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    $this->view('statistic/v_statistic_4_excel', $this->data);
                }else{
                    $this->view('statistic/v_statistic_4', $this->data);
                }
                
            }
            if($_GET['stat_type'] == '5'){
                $all_data_count = $this->m_statistic->getAll_report5($between);
                $gun = $this->data['gun'] = $this->m_statistic->getAll('news_gun5',NULL,NULL,'ng_seq asc');
                $this->data['data_text'] = $this->m_statistic->getAll_report5_text($between);
                
                $this->data['data_text_count'] = $this->m_statistic->getAll_report5_text($between,99999,$offset);
                
                if(isset($this->data['data_text_count']) && $this->data['data_text_count']){
                    $this->data['total_rows'] = count($this->data['data_text_count']);
                }else{
                    $this->data['total_rows'] = 0;
                }
                $province_76 = 0;
                $province_75 = 0;
                $province_74 = 0;
                $province_70 = 0;
                if(isset($all_data_count) && $all_data_count){
                        foreach($all_data_count as $k_adc => $v_adc){
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 76){
                                $province_76 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 75){
                                $province_75 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 74){
                                $province_74 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 70){
                                $province_70 = 1;
                            }
                        }
                        if(isset($province_76) && $province_76 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_hold_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 76;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_75) && $province_75 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_hold_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 75;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_74) && $province_74 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_hold_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 74;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_70) && $province_70 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_hold_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 70;
                                    $all_data_count[]=$data;
                            }
                        }
                        $data_use_count = array();
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 76){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 75){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 74){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 70){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                }else{
                    $data_use_count = NULL;
                }
                
                $this->data['all_data_count'] = $data_use_count;
                
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'statistic/detail';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] ;
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);  
                //$this->debug($this->data['all_data_count']);
                if(isset($_GET['export'])){
                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    $this->view('statistic/v_statistic_5_excel', $this->data);
                }else{
                    $this->view('statistic/v_statistic_5', $this->data);
                }
                
            }
            if($_GET['stat_type'] == '6'){
                $all_data_count = $this->m_statistic->getAll_report6($between);
                $gun = $this->data['gun'] = $this->m_statistic->getAll('news_gun5',NULL,NULL,'ng_seq asc');
                $this->data['data_text'] = $this->m_statistic->getAll_report6_text($between);
                
                
                $this->data['data_text_count'] = $this->m_statistic->getAll_report6_text($between,99999,$offset);
                
                if(isset($this->data['data_text_count']) && $this->data['data_text_count']){
                    $this->data['total_rows'] = count($this->data['data_text_count']);
                }else{
                    $this->data['total_rows'] = 0;
                }
                
                $province_76 = 0;
                $province_75 = 0;
                $province_74 = 0;
                $province_70 = 0;
                if(isset($all_data_count) && $all_data_count){
                        foreach($all_data_count as $k_adc => $v_adc){
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 76){
                                $province_76 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 75){
                                $province_75 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 74){
                                $province_74 = 1;
                            }
                            if(isset($v_adc['province_id']) && $v_adc['province_id'] == 70){
                                $province_70 = 1;
                            }
                        }
                        if(isset($province_76) && $province_76 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_holdreturn_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 76;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_75) && $province_75 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_holdreturn_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 75;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_74) && $province_74 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_holdreturn_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 74;
                                    $all_data_count[]=$data;
                            }
                        }
                        if(isset($province_70) && $province_70 != 1){
                            foreach ($gun as $k_g => $v_g) {
                                    $data['nr_holdreturn_total'] = 0;
                                    $data['ng_gun'] = $v_g['ng_gun'];
                                    $data['ng_newsgunid'] = $v_g['ng_newsgunid'];
                                    $data['province_id'] = 70;
                                    $all_data_count[]=$data;
                            }
                        }
                        $data_use_count = array();
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 76){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 75){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 74){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                        foreach($all_data_count as $k_adc2 => $v_adc2){
                                if($v_adc2['province_id'] == 70){
                                    $data_use_count[] = $v_adc2;
                                }
                        }
                }else{
                    $data_use_count = NULL;
                }
                $this->data['all_data_count'] = $data_use_count;
                
                
                $this->data['offest'] = $offset;
                $config['base_url'] = base_url() . 'statistic/detail';
                $config['uri_segment'] = 4;
                $config['num_links'] = 5;
                $config['total_rows'] = $this->data['total_rows'] ;
                $config['per_page'] = $limit;
                $config['cur_page'] = $this->data['offset'] = $offset + 1;
                $this->pagination->initialize($config);  
                
                //$this->debug($config);
                if(isset($_GET['export'])){
                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    $this->view('statistic/v_statistic_6_excel', $this->data);
                }else{
                    $this->view('statistic/v_statistic_6', $this->data);
                }
                
            }         
            if($_GET['stat_type'] == '7'){
                $this->data['group_bomb']       = isset( $_GET['group_bomb'] ) ? $_GET['group_bomb'] : 0;
                $this->data['bomb']             = isset( $_GET['group_bomb'] ) && isset( $_GET['bomb'.$_GET['group_bomb']] ) ? $_GET['bomb'.$_GET['group_bomb']] : '';
                $this->data['province']         = $this->m_statistic->getAll('province', array('province_show' => 'Y'));
                
                $where['n.rt_reporttypeid'] = 5;
                $where['n.u_unitid'] = $this->u_unitid;
                $this->data['result_news'] = $this->m_statistic->getAll_report7News($where, $between);
                
                $dynamite_where = $where;
                //$dynamite_where['nd.dt_dynamitetypeid !='] = '';
                $this->data['result_dynamite'] = $this->m_statistic->getAll_report7Dynamite($dynamite_where, $between);
                
                $ignition_where = $where;
                //$ignition_where['nd.it_ignitiontypeid !='] = '';
                $this->data['result_ignition'] = $this->m_statistic->getAll_report7Ignition($ignition_where, $between);
                if(isset($_GET['export'])){
                    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                    header("Content-Disposition: attachment; filename=".date('Ymd Him').".xls");  //File name extension was wrong
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    $this->view('statistic/v_statistic_7_excel', $this->data); 
                }else{
                    $this->view('statistic/v_statistic_7', $this->data); 
                }
                
            }
            
        }else{
            $this->view('statistic/v_statistic', $this->data); 
        } 
    }
    
    
    // For Excel
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
