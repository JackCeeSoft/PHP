<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-fqpo{background-color:#cbcefb;text-align: right;}
    .tg .tg-uhkr{background-color:#ffce93;text-align: right;}
    .tg .tg-a1rn{background-color:#ffffc7;text-align: right;}
    .tg .tg-qptv{background-color:#ffce93;text-align:center}
    .tg .tg-lfnm{background-color:#cbcefb;text-align:center}
    .tg .tg-031e{text-align: right;}
    
@media (min-width: 1200px) {
  .container {
    /*margin-left: 4%;*/
    width: 75%;
/*    padding-left:0px;
    padding-right:0px;*/
  }
}
</style>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <h3 class="" page-header="">สถิติ</h3>   
        <br>
        <?php $this->load->view('statistic/_form_search'); ?>
        
        <div class="form-group">
            <div class="col-lg-12">
                <h4 class="blue">เหตุระเบิดในพื้นที่ จชต.</h4>
            </div>
        </div>
         
        <?php if( $graph_ui == 'table' ) { ?>
            <div class="col-lg-12" style="overflow: scroll;">
                <?php $total_column = 1; ?>
                <table class="tg">
                    <tr>
                        <th class="tg-s6z2" rowspan="2">จังหวัด</th>
                        <th class="tg-s6z2" colspan="3">การทำงานของระเบิด</th>
                        <?php if(isset($dynamite_type) && $dynamite_type) { ?>
                            <th class="tg-qptv" colspan="<?= count($dynamite_type) + 1; ?>">ภาชนะบรรจุระเบิด</th>
                        <?php } ?>
                        <?php if(isset($ignition_type) && $ignition_type) { ?>
                            <th class="tg-lfnm" colspan="<?= count($ignition_type) + 1; ?>">วิธีการจุดระเบิด</th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="tg-s6z2">ระเบิดทำงาน</td>
                        <td class="tg-s6z2">เก็บกู้</td>
                        <td class="tg-s6z2">รวม</td>
                        <?php if(isset($dynamite_type) && $dynamite_type) { ?>
                            <?php foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) { ?>
                                <td class="tg-qptv"><?= $v_dynamite_type['dt_name']; ?></td>
                            <?php } ?>
                            <td class="tg-uhkr">รวม</td>
                        <?php } ?>
                        <?php if(isset($ignition_type) && $ignition_type) { ?>
                            <?php foreach($ignition_type as $k_ignition_type => $v_ignition_type) { ?>
                                <td class="tg-lfnm"><?= $v_ignition_type['it_name']; ?></td>
                            <?php } ?>
                            <td class="tg-fqpo">รวม</td>
                        <?php } ?>
                    </tr>
                    
                    <?php $sumProvince = array(); ?>
                    <?php foreach ($province as $k_province => $v_province) { ?>
                        <tr>
                            <td class="tg-031e"><?= $v_province['province_name']; ?></td>
                            <?php $totalComplete = 0; ?>
                            <?php $totalStop = 0; ?>
                            <?php if(isset($result_news) && $result_news) { ?>
                                <?php foreach($result_news as $k_result_news => $v_result_news) { ?>
                                    <?php if(isset($v_result_news['np_newsprovinceid']) && $v_result_news['np_newsprovinceid'] == $v_province['province_id']) { ?>
                                        <?php if(isset($v_result_news['n_dynamitecomplete']) && $v_result_news['n_dynamitecomplete']) { ?>
                                            <?php $totalComplete = $totalComplete + $v_result_news['n_dynamitecomplete']; ?>
                                        <?php } ?>
                            
                                        <?php if(isset($v_result_news['n_dynamitestop']) && $v_result_news['n_dynamitestop']) { ?>
                                            <?php $totalStop = $totalStop + $v_result_news['n_dynamitestop']; ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            
                            <td class="tg-031e"><?= $totalComplete; ?></td>
                            <td class="tg-031e"><?= $totalStop; ?></td>
                            <td class="tg-031e"><?= $totalComplete + $totalStop; ?></td>
                            
                            <?php if(empty($sumProvince['totalComplete'])) { ?>
                                <?php $sumProvince['totalComplete'] = $totalComplete; ?>
                            <?php } else { ?>
                                <?php $sumProvince['totalComplete'] = $sumProvince['totalComplete'] + $totalComplete; ?>
                            <?php } ?>
                            
                            <?php if(empty($sumProvince['totalStop'])) { ?>
                                <?php $sumProvince['totalStop'] = $totalStop; ?>
                            <?php } else { ?>
                                <?php $sumProvince['totalStop'] = $sumProvince['totalStop'] + $totalStop; ?>
                            <?php } ?>
                            
                            <?php if(empty($sumProvince['totalCompleteStop'])) { ?>
                                <?php $sumProvince['totalCompleteStop'] = ($totalComplete + $totalStop); ?>
                            <?php } else { ?>
                                <?php $sumProvince['totalCompleteStop'] = $sumProvince['totalCompleteStop'] + ($totalComplete + $totalStop); ?>
                            <?php } ?>
                            
                            <?php if(isset($dynamite_type) && $dynamite_type) { ?>
                                <?php $sumProvinceDynamite = 0; ?>
                                <?php foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) { ?>
                                    <?php if(empty($sumProvince['dynamite_' . $v_dynamite_type['dt_dynamitetypeid']])) { ?>
                                        <?php $sumProvince['dynamite_' . $v_dynamite_type['dt_dynamitetypeid']] = 0; ?>
                                    <?php } ?>
                            
                                    <?php $totalDynamite = 0; ?>
                                    <?php if(isset($result_dynamite) && $result_dynamite) { ?>
                                        <?php foreach($result_dynamite as $k_result_dynamite => $v_result_dynamite) { ?>
                                            <?php if(isset($v_result_dynamite['dt_dynamitetypeid']) && $v_result_dynamite['dt_dynamitetypeid'] == $v_dynamite_type['dt_dynamitetypeid'] && isset($v_result_dynamite['np_newsprovinceid']) && $v_result_dynamite['np_newsprovinceid'] == $v_province['province_id']) { ?>
                                                <?php $totalDynamite = $totalDynamite + $v_result_dynamite['dynamitetype']; ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <td class="tg-uhkr"><?= $totalDynamite; ?></td>
                                    <?php $sumProvince['dynamite_' . $v_dynamite_type['dt_dynamitetypeid']] = $sumProvince['dynamite_' . $v_dynamite_type['dt_dynamitetypeid']] + $totalDynamite; ?>
                                    <?php $sumProvinceDynamite = $sumProvinceDynamite + $totalDynamite; ?>
                                <?php } ?>
                                    
                                <?php if(empty($sumProvince['dynamite_sum'])) { ?>
                                    <?php $sumProvince['dynamite_sum'] = $sumProvinceDynamite; ?>
                                <?php } else { ?>
                                    <?php $sumProvince['dynamite_sum'] = $sumProvince['dynamite_sum'] + $sumProvinceDynamite; ?>
                                <?php } ?>
                                <td class="tg-uhkr"><?= $sumProvinceDynamite; ?></td>
                            <?php } ?>
                                
                            <?php if(isset($ignition_type) && $ignition_type) { ?>
                                <?php $sumProvinceIgnition = 0; ?>
                                <?php foreach($ignition_type as $k_ignition_type => $v_ignition_type) { ?>
                                    <?php if(empty($sumProvince['ignition_' . $v_ignition_type['it_ignitiontypeid']])) { ?>
                                        <?php $sumProvince['ignition_' . $v_ignition_type['it_ignitiontypeid']] = 0; ?>
                                    <?php } ?>
                                    
                                    <?php $totalIgnition = 0; ?>
                                    <?php if(isset($result_ignition) && $result_ignition) { ?>
                                        <?php foreach($result_ignition as $k_result_ignition => $v_result_ignition) { ?>
                                            <?php if(isset($v_result_ignition['it_ignitiontypeid']) && $v_result_ignition['it_ignitiontypeid'] == $v_ignition_type['it_ignitiontypeid'] && isset($v_result_ignition['np_newsprovinceid']) && $v_result_ignition['np_newsprovinceid'] == $v_province['province_id']) { ?>
                                                <?php $totalIgnition = $totalIgnition + $v_result_ignition['ignitiontype']; ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <td class="tg-fqpo"><?= $totalIgnition; ?></td>
                                    <?php $sumProvince['ignition_' . $v_ignition_type['it_ignitiontypeid']] = $sumProvince['ignition_' . $v_ignition_type['it_ignitiontypeid']] + $totalIgnition; ?>
                                    <?php $sumProvinceIgnition = $sumProvinceIgnition + $totalIgnition; ?>
                                <?php } ?>
                                    
                                <?php if(empty($sumProvince['ignition_sum'])) { ?>
                                    <?php $sumProvince['ignition_sum'] = $sumProvinceIgnition; ?>
                                <?php } else { ?>
                                    <?php $sumProvince['ignition_sum'] = $sumProvince['ignition_sum'] + $sumProvinceIgnition; ?>
                                <?php } ?>
                                <td class="tg-fqpo"><?= $sumProvinceIgnition; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="tg-a1rn">รวม</td>
                        <?php foreach($sumProvince as $k_sumProvince => $v_sumProvince) { ?>
                            <td class="tg-a1rn"><?= $v_sumProvince; ?></td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
        <?php } ?>
        
        <?php if( $graph_ui == 'pie' ) { ?>
            <?php $arrGrahp = array(); ?>
            <?php if( $group_bomb == 1 && isset( $bomb ) && $bomb ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    if(isset($operate_bomb) && $operate_bomb) {
                        foreach ($province as $k_province => $v_province) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$v_province['province_name'].'"],';
                            foreach($operate_bomb as $k_operate_bomb => $val_operate_bomb) {
                                if( array_search($k_operate_bomb, $bomb) !== false ) {
                                    $totalComplete = 0;
                                    $totalStop = 0;
                                    if(isset($result_news) && $result_news) {
                                        foreach($result_news as $k_result_news => $v_result_news) {
                                            if(isset($v_result_news['np_newsprovinceid']) && $v_result_news['np_newsprovinceid'] == $v_province['province_id']) {
                                                if(isset($v_result_news['n_dynamitecomplete']) && $v_result_news['n_dynamitecomplete']) {
                                                    $totalComplete = $totalComplete + $v_result_news['n_dynamitecomplete'];
                                                }
                                                if(isset($v_result_news['n_dynamitestop']) && $v_result_news['n_dynamitestop']) {
                                                    $totalStop = $totalStop + $v_result_news['n_dynamitestop'];
                                                }
                                            }
                                        }
                                    }
                                    if( $k_operate_bomb == 1 ) { //ระเบิดทำงาน
                                        $grahpData .= '["'.$val_operate_bomb.'", '.$totalComplete.'],';
                                        $hasData += $totalComplete;
                                    } else if( $k_operate_bomb == 2 ) { //เก็บกู้
                                        $grahpData .= '["'.$val_operate_bomb.'", '.$totalStop.'],';
                                        $hasData += $totalStop;
                                    }
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$k_province]['name'] = $v_province['province_name'];
                            $arrGrahp[$k_province]['data'] = $grahpData;
                            $arrGrahp[$k_province]['hasData'] = $hasData;
                        }
                    }
                } else {
                    if(isset($operate_bomb) && $operate_bomb) {
                        foreach($operate_bomb as $k_operate_bomb => $val_operate_bomb) {
                            if( array_search($k_operate_bomb, $bomb) !== false ) {
                                $hasData = 0;
                                $grahpData = '[';
                                $grahpData .= '["title", "'.$val_operate_bomb.'"],';
                                foreach ($province as $k_province => $v_province) {
                                    $totalComplete = 0;
                                    $totalStop = 0;
                                    if(isset($result_news) && $result_news) {
                                        foreach($result_news as $k_result_news => $v_result_news) {
                                            if(isset($v_result_news['np_newsprovinceid']) && $v_result_news['np_newsprovinceid'] == $v_province['province_id']) {
                                                if(isset($v_result_news['n_dynamitecomplete']) && $v_result_news['n_dynamitecomplete']) {
                                                    $totalComplete = $totalComplete + $v_result_news['n_dynamitecomplete'];
                                                }
                                                if(isset($v_result_news['n_dynamitestop']) && $v_result_news['n_dynamitestop']) {
                                                    $totalStop = $totalStop + $v_result_news['n_dynamitestop'];
                                                }
                                            }
                                        }
                                    }
                                    if( $k_operate_bomb == 1 ) { //ระเบิดทำงาน
                                        $grahpData .= '["'.$v_province['province_name'].'", '.$totalComplete.'],';
                                        $hasData += $totalComplete;
                                    } else if( $k_operate_bomb == 2 ) { //เก็บกู้
                                        $grahpData .= '["'.$v_province['province_name'].'", '.$totalStop.'],';
                                        $hasData += $totalStop;
                                    }
                                }
                                $grahpData .= ']';
                                $arrGrahp[$k_operate_bomb]['name'] = $val_operate_bomb;
                                $arrGrahp[$k_operate_bomb]['data'] = $grahpData;
                                $arrGrahp[$k_operate_bomb]['hasData'] = $hasData;
                            }
                        }
                    }
                }
            } ?>
        
            <?php if( $group_bomb == 2 && isset( $bomb ) && $bomb ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    if(isset($dynamite_type) && $dynamite_type) {
                         foreach ($province as $k_province => $v_province) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$v_province['province_name'].'"],';
                            foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) {
                                if( array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false ) {
                                    $totalDynamite = 0;
                                    if(isset($result_dynamite) && $result_dynamite) {
                                        foreach($result_dynamite as $k_result_dynamite => $v_result_dynamite) {
                                            if(isset($v_result_dynamite['dt_dynamitetypeid']) && $v_result_dynamite['dt_dynamitetypeid'] == $v_dynamite_type['dt_dynamitetypeid'] && isset($v_result_dynamite['np_newsprovinceid']) && $v_result_dynamite['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalDynamite = $totalDynamite + $v_result_dynamite['dynamitetype'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$v_dynamite_type['dt_name'].'", '.$totalDynamite.'],';
                                    $hasData += $totalDynamite;
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$k_province]['name'] = $v_province['province_name'];
                            $arrGrahp[$k_province]['data'] = $grahpData;
                            $arrGrahp[$k_province]['hasData'] = $hasData;
                         }
                    }
                } else {
                    if(isset($dynamite_type) && $dynamite_type) {
                        foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) {
                            if( array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false ) {
                                $hasData = 0;
                                $grahpData = '[';
                                $grahpData .= '["title", "'.$v_dynamite_type['dt_name'].'"],';
                                foreach ($province as $k_province => $v_province) {
                                    $totalDynamite = 0;
                                    if(isset($result_dynamite) && $result_dynamite) {
                                        foreach($result_dynamite as $k_result_dynamite => $v_result_dynamite) {
                                            if(isset($v_result_dynamite['dt_dynamitetypeid']) && $v_result_dynamite['dt_dynamitetypeid'] == $v_dynamite_type['dt_dynamitetypeid'] && isset($v_result_dynamite['np_newsprovinceid']) && $v_result_dynamite['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalDynamite = $totalDynamite + $v_result_dynamite['dynamitetype'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$v_province['province_name'].'", '.$totalDynamite.'],';
                                    $hasData += $totalDynamite;
                                }
                                $grahpData .= ']';
                                $arrGrahp[$v_dynamite_type['dt_dynamitetypeid']]['name'] = $v_dynamite_type['dt_name'];
                                $arrGrahp[$v_dynamite_type['dt_dynamitetypeid']]['data'] = $grahpData;
                                $arrGrahp[$v_dynamite_type['dt_dynamitetypeid']]['hasData'] = $hasData;
                            }
                        }
                    }
                }
            } ?>
        
            <?php if( $group_bomb == 3 && isset( $bomb ) && $bomb ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    if(isset($ignition_type) && $ignition_type) {
                        foreach ($province as $k_province => $v_province) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$v_province['province_name'].'"],';
                            foreach($ignition_type as $k_ignition_type => $v_ignition_type) {
                                if( array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false ) {
                                    $totalIgnition = 0;
                                    if(isset($result_ignition) && $result_ignition) {
                                        foreach($result_ignition as $k_result_ignition => $v_result_ignition) {
                                            if(isset($v_result_ignition['it_ignitiontypeid']) && $v_result_ignition['it_ignitiontypeid'] == $v_ignition_type['it_ignitiontypeid'] && isset($v_result_ignition['np_newsprovinceid']) && $v_result_ignition['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalIgnition = $totalIgnition + $v_result_ignition['ignitiontype'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$v_ignition_type['it_name'].'", '.$totalIgnition.'],';
                                    $hasData += $totalIgnition;
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$k_province]['name'] = $v_province['province_name'];
                            $arrGrahp[$k_province]['data'] = $grahpData;
                            $arrGrahp[$k_province]['hasData'] = $hasData;
                        }
                    }
                } else {
                    if(isset($ignition_type) && $ignition_type) {
                        foreach($ignition_type as $k_ignition_type => $v_ignition_type) {
                            if( array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false ) {
                                $hasData = 0;
                                $grahpData = '[';
                                $grahpData .= '["title", "'.$v_ignition_type['it_name'].'"],';
                                foreach ($province as $k_province => $v_province) {
                                    $totalIgnition = 0;
                                    if(isset($result_ignition) && $result_ignition) {
                                        foreach($result_ignition as $k_result_ignition => $v_result_ignition) {
                                            if(isset($v_result_ignition['it_ignitiontypeid']) && $v_result_ignition['it_ignitiontypeid'] == $v_ignition_type['it_ignitiontypeid'] && isset($v_result_ignition['np_newsprovinceid']) && $v_result_ignition['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalIgnition = $totalIgnition + $v_result_ignition['ignitiontype'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$v_province['province_name'].'", '.$totalIgnition.'],';
                                    $hasData += $totalIgnition;
                                }
                                $grahpData .= ']';
                                $arrGrahp[$v_ignition_type['it_ignitiontypeid']]['name'] = $v_ignition_type['it_name'];
                                $arrGrahp[$v_ignition_type['it_ignitiontypeid']]['data'] = $grahpData;
                                $arrGrahp[$v_ignition_type['it_ignitiontypeid']]['hasData'] = $hasData;
                            }
                        }
                    }
                }
            } ?>
        
            <?php if( isset( $arrGrahp ) && $arrGrahp ){ ?>
                <?php foreach ($arrGrahp as $k_resule => $v_resule) { ?>
                    <?php if( $v_resule['hasData'] ) { ?>
                        <div class="col-lg-12" style="padding-left: -15px; padding-right: -15px; ">
                            <script type="text/javascript">
                                google.load("visualization", "1", {packages:["corechart"]});
                                google.setOnLoadCallback(drawChart);
                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable(<?= $v_resule['data']; ?>);
                                    var options = {
                                        title: '<?= $v_resule['name']; ?>'
                                    };
                                    var chart = new google.visualization.PieChart(document.getElementById('piechart_<?= $k_resule; ?>'));
                                    chart.draw(data, options);
                                    $('#download_<?= $k_resule; ?>').attr('href', chart.getImageURI());
                                }
                              </script>
                              <div id="piechart_<?= $k_resule; ?>" style="width: 100%; min-height: 500px;"></div>
                              <div style="position: relative; text-align: center; margin-top: -60px; margin-bottom: 60px;">
                                  <a id="download_<?= $k_resule; ?>" href="" target="_blank"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                              </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        
        <?php if( $graph_ui == 'bar' || $graph_ui == 'line' ) { ?>
            <?php $arrGrahp = array(); ?>
            <?php $plot_height = 0; ?>
            <?php if( $group_bomb == 1 && isset( $bomb ) && $bomb ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    if(isset($operate_bomb) && $operate_bomb) {
                        $grahpData .= '["title", ';
                        foreach ($province as $k_province => $v_province) {
                            $grahpData .= '"'.$v_province['province_name'].'", ';
                        }
                        $grahpData .= '],';
                        $loop = 1;
                        foreach($operate_bomb as $k_operate_bomb => $val_operate_bomb) {
                            $grahpData .= '["'.$val_operate_bomb.'", ';
                            foreach ($province as $k_province => $v_province) {
                                $totalComplete = 0;
                                $totalStop = 0;
                                if(isset($result_news) && $result_news) {
                                    foreach($result_news as $k_result_news => $v_result_news) {
                                        if(isset($v_result_news['np_newsprovinceid']) && $v_result_news['np_newsprovinceid'] == $v_province['province_id']) {
                                            if(isset($v_result_news['n_dynamitecomplete']) && $v_result_news['n_dynamitecomplete']) {
                                                $totalComplete = $totalComplete + $v_result_news['n_dynamitecomplete'];
                                            }
                                            if(isset($v_result_news['n_dynamitestop']) && $v_result_news['n_dynamitestop']) {
                                                $totalStop = $totalStop + $v_result_news['n_dynamitestop'];
                                            }
                                        }
                                    }
                                }
                                if( $loop == 1 ) {
                                    $grahpData .= $totalComplete.', ';
                                } else if( $loop == 2 ) {
                                    $grahpData .= $totalStop.', ';
                                }
                                $plot_height = $plot_height + 30;
                            }
                            $grahpData .= '],'; 
                            $loop++;
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    if(isset($operate_bomb) && $operate_bomb) {
                        $grahpData .= '["title", ';
                        foreach($operate_bomb as $k_operate_bomb => $val_operate_bomb) {
                            if( array_search($k_operate_bomb, $bomb) !== false ) {
                                $grahpData .= '"'.$val_operate_bomb.'", ';
                            }
                        }
                        $grahpData .= '],';
                        foreach ($province as $k_province => $v_province) {
                            $totalComplete = 0;
                            $totalStop = 0;
                            $grahpData .= '["'.$v_province['province_name'].'", ';
                            foreach($operate_bomb as $k_operate_bomb => $val_operate_bomb) {
                                if( array_search($k_operate_bomb, $bomb) !== false ) {
                                    if(isset($result_news) && $result_news) {
                                        foreach($result_news as $k_result_news => $v_result_news) {
                                            if(isset($v_result_news['np_newsprovinceid']) && $v_result_news['np_newsprovinceid'] == $v_province['province_id']) {
                                                if(isset($v_result_news['n_dynamitecomplete']) && $v_result_news['n_dynamitecomplete'] && $k_operate_bomb == 1) {
                                                    $totalComplete = $totalComplete + $v_result_news['n_dynamitecomplete'];
                                                }
                                                if(isset($v_result_news['n_dynamitestop']) && $v_result_news['n_dynamitestop'] && $k_operate_bomb == 2) {
                                                    $totalStop = $totalStop + $v_result_news['n_dynamitestop'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            $grahpData .= $totalComplete.', '.$totalStop.'], ';
                            $plot_height = $plot_height + 60; 
                        }
                    }
                    $grahpData .= ']';
                }
            } ?>
        
            <?php if( $group_bomb == 2 && isset( $bomb ) && $bomb ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    if(isset($dynamite_type) && $dynamite_type) {
                        $grahpData .= '["title", ';
                        foreach ($province as $k_province => $v_province) {
                            $grahpData .= '"'.$v_province['province_name'].'", ';
                        }
                        $grahpData .= '],';
                        foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) {
                            if( array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false ) {
                                $grahpData .= '["'.$v_dynamite_type['dt_name'].'", ';
                                foreach ($province as $k_province => $v_province) {
                                    $totalDynamite = 0;
                                    if(isset($result_dynamite) && $result_dynamite) {
                                        foreach($result_dynamite as $k_result_dynamite => $v_result_dynamite) {
                                            if(isset($v_result_dynamite['dt_dynamitetypeid']) && $v_result_dynamite['dt_dynamitetypeid'] == $v_dynamite_type['dt_dynamitetypeid'] && isset($v_result_dynamite['np_newsprovinceid']) && $v_result_dynamite['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalDynamite = $totalDynamite + $v_result_dynamite['dynamitetype'];
                                            }
                                        }
                                    }
                                    $grahpData .= $totalDynamite.', ';
                                    $plot_height = $plot_height + 30;
                                }
                                $grahpData .= '],';
                            }
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    if(isset($dynamite_type) && $dynamite_type) {
                        $grahpData .= '["title", ';
                        foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) {
                            if( array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false ) {
                                $grahpData .= '"'.$v_dynamite_type['dt_name'].'", ';
                            }
                        }
                        $grahpData .= '],';
                        foreach ($province as $k_province => $v_province) {
                            $grahpData .= '["'.$v_province['province_name'].'", ';
                            foreach($dynamite_type as $k_dynamite_type => $v_dynamite_type) {
                                if( array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false ) {
                                    $totalDynamite = 0;
                                    if(isset($result_dynamite) && $result_dynamite) {
                                        foreach($result_dynamite as $k_result_dynamite => $v_result_dynamite) {
                                            if(isset($v_result_dynamite['dt_dynamitetypeid']) && $v_result_dynamite['dt_dynamitetypeid'] == $v_dynamite_type['dt_dynamitetypeid'] && isset($v_result_dynamite['np_newsprovinceid']) && $v_result_dynamite['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalDynamite = $totalDynamite + $v_result_dynamite['dynamitetype'];
                                            }
                                        }
                                    }
                                    $grahpData .= $totalDynamite.', ';
                                    $plot_height = $plot_height + 30;
                                }
                            }
                            $grahpData .= '],';
                        }
                    }
                    $grahpData .= ']';
                }
            } ?>
        
            <?php if( $group_bomb == 3 && isset( $bomb ) && $bomb ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    if(isset($ignition_type) && $ignition_type) {
                        $grahpData .= '["title", ';
                        foreach ($province as $k_province => $v_province) {
                            $grahpData .= '"'.$v_province['province_name'].'", ';
                        }
                        $grahpData .= '],';
                        foreach($ignition_type as $k_ignition_type => $v_ignition_type) {
                            if( array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false ) {
                                $grahpData .= '["'.$v_ignition_type['it_name'].'", ';
                                foreach ($province as $k_province => $v_province) {
                                    $totalIgnition = 0;
                                    if(isset($result_ignition) && $result_ignition) {
                                        foreach($result_ignition as $k_result_ignition => $v_result_ignition) { 
                                            if(isset($v_result_ignition['it_ignitiontypeid']) && $v_result_ignition['it_ignitiontypeid'] == $v_ignition_type['it_ignitiontypeid'] && isset($v_result_ignition['np_newsprovinceid']) && $v_result_ignition['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalIgnition = $totalIgnition + $v_result_ignition['ignitiontype'];
                                            }
                                        }
                                    }
                                    $grahpData .= $totalIgnition.', ';
                                    $plot_height = $plot_height + 30;
                                }
                                $grahpData .= '],';
                            }
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    if(isset($ignition_type) && $ignition_type) {
                        $grahpData .= '["title", ';
                        foreach($ignition_type as $k_ignition_type => $v_ignition_type) {
                            if( array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false ) {
                                $grahpData .= '"'.$v_ignition_type['it_name'].'", ';
                            }
                        }
                        $grahpData .= '],';
                        foreach ($province as $k_province => $v_province) {
                            $grahpData .= '["'.$v_province['province_name'].'", ';
                            foreach($ignition_type as $k_ignition_type => $v_ignition_type) {
                                if( array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false ) {
                                    $totalIgnition = 0;
                                    if(isset($result_ignition) && $result_ignition) {
                                        foreach($result_ignition as $k_result_ignition => $v_result_ignition) { 
                                            if(isset($v_result_ignition['it_ignitiontypeid']) && $v_result_ignition['it_ignitiontypeid'] == $v_ignition_type['it_ignitiontypeid'] && isset($v_result_ignition['np_newsprovinceid']) && $v_result_ignition['np_newsprovinceid'] == $v_province['province_id']) {
                                                $totalIgnition = $totalIgnition + $v_result_ignition['ignitiontype'];
                                            }
                                        }
                                    }
                                    $grahpData .= $totalIgnition.', ';
                                    $plot_height = $plot_height + 30;
                                }
                            }
                            $grahpData .= '],';
                        }
                    }
                    $grahpData .= ']';
                }
            } ?>
            
            <div class="col-lg-12" style="padding-left: -15px; padding-right: -15px; ">
                <?php if( $graph_ui == 'bar' ) { ?>
                    <script type="text/javascript">
                        google.load('visualization', '1', {packages: ['corechart', 'bar']});
                        google.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(<?= $grahpData; ?>);
                            var options = {
                              bars: 'horizontal'
                            };
                            var chart = new google.visualization.BarChart(document.getElementById('columnchart_material'));
                            chart.draw(data, options);
                            $('#download').attr('href', chart.getImageURI());
                        }
                      </script>
                      <div id="columnchart_material" style="width: 100%; height: <?= $plot_height; ?>px; padding: 30px 15px;"></div>
                      <div style="position: relative; text-align: center; margin-bottom: 60px;">
                          <a id="download" href="" target="_blank"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                      </div>
                <?php } ?>

                <?php if( $graph_ui == 'line' ) { ?>
                    <script type="text/javascript"
                        src="https://www.google.com/jsapi?autoload={
                          'modules':[{
                            'name':'visualization',
                            'version':'1',
                            'packages':['corechart']
                          }]
                        }">
                    </script>
                    <script type="text/javascript">
                        google.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(<?= $grahpData; ?>);
                            var options = {
                                //title: 'Company Performance',
                                curveType: 'function',
                                legend: { position: 'bottom' }
                            };
                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                            chart.draw(data, options);
                            $('#download').attr('href', chart.getImageURI());
                        }
                    </script>
                    <div id="curve_chart" style="width: 100%; min-height: 500px; padding: 30px 15px;"></div>
                    <div style="position: relative; text-align: center; margin-bottom: 60px;">
                        <a id="download" href="" target="_blank"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<br><br><br>
<script type="text/javascript">
    $('.datetimepicker').datetimepicker({
        language: 'th'
    });
</script>