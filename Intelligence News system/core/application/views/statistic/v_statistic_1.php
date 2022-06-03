<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;
          /*padding:0px 20px;*/
          padding:0px 0px;
          border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-huad{background-color:#ffccc9;text-align: right;}
    .tg .tg-a1rn{background-color:#ffffc7;text-align: right;}
    .tg .tg-radx{background-color:#bed7ff}
    .tg .tg-huh2{font-size:14px;text-align:center}
    .tg .tg-031e{text-align: right;}
 @media (min-width: 1200px) {
  .container {
    /*margin-left: 4%;*/
    width: 84%;
/*    padding-left:0px;
    padding-right:0px;*/
  }
}
</style>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="container">
        <h3 class="" page-header="">สถิติ</h3>   
        <br>
        <?php $this->load->view('statistic/_form_search'); ?>

        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">เหตุการณ์และภาพรวมสถานการณ์ใน จชต.</h4>
            </div>
            <div style="text-align:right;">
                <?php 
                $start = '';
                $end   = '';
                if(isset($filter['start']))
                    $start = $filter['start'];
                    //echo $filter['start'];
                if(isset($filter['end']))
                    $end = $filter['end'];
                    //echo $filter['end'];
                ?>
                <a href="statistic/detail?stat_type=1&graph_ui=table&core_type=1&group_event=0&province=76&person=1&group_bomb=0&start=<?= $start;?>&end=<?= $end;?>&full_screen_1=" target="_blank" class="btn btn-default">แสดงเต็มจอ</a>
            </div>
        </div>
        <?php if( $graph_ui == 'table' ) { ?>
            <div class="col-lg-12" style="height: 650px; overflow: scroll;">
                <?php $total_column = 1; ?>
                <table class="tg">
                    <tr>
                        <th class="tg-s6z2" rowspan="2">พื้นที่</th>
                        <?php if(isset($news_cause) && $news_cause) { ?>
                            <th class="tg-huh2" colspan="<?= count($news_cause) + 1; ?>">เหตุการณ์</th>
                            <th class="tg-s6z2" colspan="2">สูญเสีย</th>
                            <?php $total_column = $total_column + count($news_cause) + 3; ?>
                        <?php } ?>

                        <?php if(isset($news_harry) && $news_harry) { ?>
                            <th class="tg-huh2" colspan="<?= count($news_harry) + 1; ?>">เหตุการณ์</th>
                            <th class="tg-s6z2" colspan="2">สูญเสีย</th>
                            <?php $total_column = $total_column + count($news_harry) + 3; ?>
                        <?php } ?>

                        <?php if(isset($news_execution) && $news_execution) { ?>
                            <th class="tg-huh2" colspan="<?= count($news_execution) + 1; ?>">เหตุการณ์</th>
                            <th class="tg-s6z2" colspan="2">สูญเสีย</th>
                            <?php $total_column = $total_column + count($news_execution) + 3; ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php if(isset($news_cause) && $news_cause) { ?>
                            <?php foreach($news_cause as $k_news_cause => $v_news_cause) { ?>
                                <td class="tg-s6z2"><?= $v_news_cause['nc_name']; ?></td>
                            <?php } ?>
                            <td class="tg-s6z2">รวม</td>
                            <td class="tg-s6z2">เจ็บ</td>
                            <td class="tg-s6z2">ตาย</td>
                        <?php } ?>

                        <?php if(isset($news_harry) && $news_harry) { ?>
                            <?php foreach($news_harry as $k_news_harry => $v_news_harry) { ?>
                                <td class="tg-s6z2"><?= $v_news_harry['nh_name']; ?></td>
                            <?php } ?>
                            <td class="tg-s6z2">รวม</td>
                            <td class="tg-s6z2">เจ็บ</td>
                            <td class="tg-s6z2">ตาย</td>
                        <?php } ?>

                        <?php if(isset($news_execution) && $news_execution) { ?>
                            <?php foreach($news_execution as $k_news_execution => $v_news_execution) { ?>
                                <td class="tg-s6z2"><?= $v_news_execution['ne_name']; ?></td>
                            <?php } ?>
                            <td class="tg-s6z2">รวม</td>
                            <td class="tg-s6z2">เจ็บ</td>
                            <td class="tg-s6z2">ตาย</td>
                        <?php } ?>
                    </tr>
                    <?php foreach ($province as $k_province => $v_province) { ?>
                        <?php $sumProvince[$v_province['province_id']] = array(); ?>
                        <tr>
                            <td class="tg-radx" colspan="<?= $total_column; ?>"><?= $v_province['province_name']; ?></td>
                        </tr>
                        <?php foreach ($amphur[$v_province['province_id']] as $k_amphur => $v_amphur) { ?>
                            <tr>
                                <td class="tg-031e"><?= $v_amphur['amphur_name']; ?></td>
                                <?php if(isset($news_cause) && $news_cause) { ?>
                                    <?php $sumInjuriesCause = 0; ?>
                                    <?php $sumLoseCause = 0; ?>
                                    <?php $sumAmphurCause = 0; ?>
                                    <?php foreach($news_cause as $k_news_cause => $v_news_cause) { ?>
                                        <?php if(empty($sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']])) { ?>
                                            <?php $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] = 0; ?>
                                        <?php } ?>

                                        <?php $totalAmphurCause = 0; ?>
                                        <?php if(isset($result) && $result) { ?>
                                            <?php foreach($result as $k_result => $v_result) { ?>
                                                <?php if($v_result['nc_newscauseid'] == $v_news_cause['nc_newscauseid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) { ?>
                                                    <?php $totalAmphurCause++; ?>

                                                    <?php if(isset($v_result['injuries']) && $v_result['injuries']) { ?>
                                                        <?php $sumInjuriesCause = $sumInjuriesCause + $v_result['injuries']; ?>
                                                    <?php } ?>

                                                    <?php if(isset($v_result['lose']) && $v_result['lose']) { ?>
                                                        <?php $sumLoseCause = $sumLoseCause + $v_result['lose']; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <td class="tg-031e"><?= $totalAmphurCause; ?></td>
                                        <?php $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] = $sumProvince[$v_province['province_id']]['cause_' . $v_news_cause['nc_newscauseid']] + $totalAmphurCause; ?>
                                        <?php $sumAmphurCause = $sumAmphurCause + $totalAmphurCause; ?>
                                    <?php } ?>

                                    <?php if(empty($sumProvince[$v_province['province_id']]['cause_sum'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_sum'] = $sumAmphurCause; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_sum'] = $sumProvince[$v_province['province_id']]['cause_sum'] + $sumAmphurCause; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['cause_injuries'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_injuries'] = $sumInjuriesCause; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_injuries'] = $sumProvince[$v_province['province_id']]['cause_injuries'] + $sumInjuriesCause; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['cause_lose'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_lose'] = $sumLoseCause; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['cause_lose'] = $sumProvince[$v_province['province_id']]['cause_lose'] + $sumLoseCause; ?>
                                    <?php } ?>

                                    <td class="tg-a1rn"><?= $sumAmphurCause; ?></td>
                                    <td class="tg-huad"><?= $sumInjuriesCause; ?></td><!--เจ็บ-->
                                    <td class="tg-huad"><?= $sumLoseCause; ?></td><!--ตาย-->
                                <?php } ?>

                                <?php if(isset($news_harry) && $news_harry) { ?>
                                    <?php $sumInjuriesHarry = 0; ?>
                                    <?php $sumLoseHarry = 0; ?>
                                    <?php $sumAmphurHarry = 0; ?>
                                    <?php foreach($news_harry as $k_news_harry => $v_news_harry) { ?>
                                        <?php if(empty($sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']])) { ?>
                                            <?php $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] = 0; ?>
                                        <?php } ?>

                                        <?php $totalAmphurHarry = 0; ?>
                                        <?php if(isset($result) && $result) { ?>
                                            <?php foreach($result as $k_result => $v_result) { ?>
                                                <?php if($v_result['nh_newsharryid'] == $v_news_harry['nh_newsharryid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) { ?>
                                                    <?php $totalAmphurHarry++; ?>

                                                    <?php if(isset($v_result['injuries']) && $v_result['injuries']) { ?>
                                                        <?php $sumInjuriesHarry = $sumInjuriesHarry + $v_result['injuries']; ?>
                                                    <?php } ?>

                                                    <?php if(isset($v_result['lose']) && $v_result['lose']) { ?>
                                                        <?php $sumLoseHarry = $sumLoseHarry + $v_result['lose']; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <td class="tg-031e"><?= $totalAmphurHarry; ?></td>
                                        <?php $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] = $sumProvince[$v_province['province_id']]['harry_' . $v_news_harry['nh_newsharryid']] + $totalAmphurHarry; ?>
                                        <?php $sumAmphurHarry = $sumAmphurHarry + $totalAmphurHarry; ?>
                                    <?php } ?>

                                    <?php if(empty($sumProvince[$v_province['province_id']]['harry_sum'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_sum'] = $sumAmphurHarry; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_sum'] = $sumProvince[$v_province['province_id']]['harry_sum'] + $sumAmphurHarry; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['harry_injuries'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_injuries'] = $sumInjuriesHarry; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_injuries'] = $sumProvince[$v_province['province_id']]['harry_injuries'] + $sumInjuriesHarry; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['harry_lose'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_lose'] = $sumLoseHarry; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['harry_lose'] = $sumProvince[$v_province['province_id']]['harry_lose'] + $sumLoseHarry; ?>
                                    <?php } ?>

                                    <td class="tg-a1rn"><?= $sumAmphurHarry; ?></td>
                                    <td class="tg-huad"><?= $sumInjuriesHarry; ?></td><!--เจ็บ-->
                                    <td class="tg-huad"><?= $sumLoseHarry; ?></td><!--ตาย-->
                                <?php } ?>

                                <?php if(isset($news_execution) && $news_execution) { ?>
                                    <?php $sumInjuriesExecution = 0; ?>
                                    <?php $sumLoseExecution = 0; ?>
                                    <?php $sumAmphurExecution = 0; ?>
                                    <?php foreach($news_execution as $k_news_execution => $v_news_execution) { ?>
                                        <?php if(empty($sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']])) { ?>
                                            <?php $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] = 0; ?>
                                        <?php } ?>

                                        <?php $totalAmphurExecution = 0; ?>
                                        <?php if(isset($result) && $result) { ?>
                                            <?php foreach($result as $k_result => $v_result) { ?>
                                                <?php if($v_result['ne_newsexecutionid'] == $v_news_execution['ne_newsexecutionid'] && $v_result['na_newsamphorid'] == $v_amphur['amphur_id']) { ?>
                                                    <?php $totalAmphurExecution++; ?>

                                                    <?php if(isset($v_result['injuries']) && $v_result['injuries']) { ?>
                                                        <?php $sumInjuriesExecution = $sumInjuriesExecution + $v_result['injuries']; ?>
                                                    <?php } ?>

                                                    <?php if(isset($v_result['lose']) && $v_result['lose']) { ?>
                                                        <?php $sumLoseExecution = $sumLoseExecution + $v_result['lose']; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <td class="tg-031e">
                                            <?php $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] = $sumProvince[$v_province['province_id']]['execution_' . $v_news_execution['ne_newsexecutionid']] + $totalAmphurExecution; ?>
                                            <?= $totalAmphurExecution; ?>
                                        </td>
                                        <?php $sumAmphurExecution = $sumAmphurExecution + $totalAmphurExecution; ?>
                                    <?php } ?>

                                    <?php if(empty($sumProvince[$v_province['province_id']]['execution_sum'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_sum'] = $sumAmphurExecution; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_sum'] = $sumProvince[$v_province['province_id']]['execution_sum'] + $sumAmphurExecution; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['execution_injuries'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_injuries'] = $sumInjuriesExecution; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_injuries'] = $sumProvince[$v_province['province_id']]['execution_injuries'] + $sumInjuriesExecution; ?>
                                    <?php } ?>
                                    <?php if(empty($sumProvince[$v_province['province_id']]['execution_lose'])) { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_lose'] = $sumLoseExecution; ?>
                                    <?php } else { ?>
                                        <?php $sumProvince[$v_province['province_id']]['execution_lose'] = $sumProvince[$v_province['province_id']]['execution_lose'] + $sumLoseExecution; ?>
                                    <?php } ?>

                                    <td class="tg-a1rn"><?= $sumAmphurExecution; ?></td>
                                    <td class="tg-huad"><?= $sumInjuriesExecution; ?></td><!--เจ็บ-->
                                    <td class="tg-huad"><?= $sumLoseExecution; ?></td><!--ตาย-->
                                <?php } ?>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="tg-a1rn">รวม</td>
                            <?php foreach($sumProvince[$v_province['province_id']] as $k_sumProvince => $v_sumProvince) { ?>
                                <td class="tg-a1rn"><?= $v_sumProvince; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
        
        <?php if( $graph_ui == 'pie' ) { ?>
            <?php $arrGrahp = array(); ?>
            <?php if( $group_event == 1 && isset( $event ) && $event ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_amphur['amphur_name'].'"],';
                            foreach($news_cause as $k_news_cause => $val_news_cause) {
                                if( array_search($val_news_cause['nc_newscauseid'], $event) !== false ) {
                                    $totalNewsCause = $sumInjuriesCause = $sumLoseCause = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nc_newscauseid'] == $val_news_cause['nc_newscauseid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsCause++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesCause += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseCause += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_news_cause['nc_name'].'", '.$totalNewsCause.'],';
                                    $hasData += $totalNewsCause;
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_amphur['amphur_id']]['name'] = $val_amphur['amphur_name'];
                            $arrGrahp[$val_amphur['amphur_id']]['data'] = $grahpData;
                            $arrGrahp[$val_amphur['amphur_id']]['hasData'] = $hasData;
                        }
                    }
                } else {
                    foreach($news_cause as $k_news_cause => $val_news_cause) {
                        if( array_search($val_news_cause['nc_newscauseid'], $event) !== false ) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_news_cause['nc_name'].'"],';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalAmphurCause = $sumInjuriesCause = $sumLoseCause = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nc_newscauseid'] == $val_news_cause['nc_newscauseid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurCause++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesCause += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseCause += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_amphur['amphur_name'].'", '.$totalAmphurCause.'],';
                                    $hasData += $totalAmphurCause;
                                }
                                //$grahpData .= '["เจ็บ", '.$sumInjuriesCause.'],';//เจ็บ
                                //$grahpData .= '["ตาย", '.$sumLoseCause.'],';//ตาย
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_news_cause['nc_newscauseid']]['name'] = $val_news_cause['nc_name'];
                            $arrGrahp[$val_news_cause['nc_newscauseid']]['data'] = $grahpData;
                            $arrGrahp[$val_news_cause['nc_newscauseid']]['hasData'] = $hasData;
                        }
                    }
                }
            } ?>
            <?php if( $group_event == 2 && isset( $event ) && $event ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_amphur['amphur_name'].'"],';
                            foreach($news_harry as $k_news_harry => $val_news_harry) {
                                if( array_search($val_news_harry['nh_newsharryid'], $event) !== false ) {
                                    $totalNewsHarry = $sumInjuriesHarry = $sumLoseHarry = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nh_newsharryid'] == $val_news_harry['nh_newsharryid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsHarry++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesHarry += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseHarry += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_news_harry['nh_name'].'", '.$totalNewsHarry.'],';
                                    $hasData += $totalNewsHarry;
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_amphur['amphur_id']]['name'] = $val_amphur['amphur_name'];
                            $arrGrahp[$val_amphur['amphur_id']]['data'] = $grahpData;
                            $arrGrahp[$val_amphur['amphur_id']]['hasData'] = $hasData;
                        }
                    }
                } else {
                    foreach($news_harry as $k_news_harry => $val_news_harry) {
                        if( array_search($val_news_harry['nh_newsharryid'], $event) !== false ) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_news_harry['nh_name'].'"],';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalAmphurHarry = $sumInjuriesHarry = $sumLoseHarry = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nh_newsharryid'] == $val_news_harry['nh_newsharryid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurHarry++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesHarry += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseHarry += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_amphur['amphur_name'].'", '.$totalAmphurHarry.'],';
                                    $hasData += $totalAmphurHarry;
                                }
                                //$grahpData .= '["เจ็บ", '.$sumInjuriesHarry.'],';//เจ็บ
                                //$grahpData .= '["ตาย", '.$sumLoseHarry.'],';//ตาย
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_news_harry['nh_newsharryid']]['name'] = $val_news_harry['nh_name'];
                            $arrGrahp[$val_news_harry['nh_newsharryid']]['data'] = $grahpData;
                            $arrGrahp[$val_news_harry['nh_newsharryid']]['hasData'] = $hasData;
                        }
                    }
                }
            } ?>
            <?php if( $group_event == 3 && isset( $event ) && $event ) {
                if( isset( $core_type ) && $core_type == 2 ) {
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_amphur['amphur_name'].'"],';
                            foreach($news_execution as $k_news_execution => $val_news_execution) {
                                if( array_search($val_news_execution['ne_newsexecutionid'], $event) !== false ) {
                                    $totalNewsExecution = $sumInjuriesExecution = $sumLoseExecution = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['ne_newsexecutionid'] == $val_news_execution['ne_newsexecutionid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsExecution++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesExecution += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseExecution += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_news_execution['ne_name'].'", '.$totalNewsExecution.'],';
                                    $hasData += $totalNewsExecution;
                                }
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_amphur['amphur_id']]['name'] = $val_amphur['amphur_name'];
                            $arrGrahp[$val_amphur['amphur_id']]['data'] = $grahpData;
                            $arrGrahp[$val_amphur['amphur_id']]['hasData'] = $hasData;
                        }
                    }
                } else {
                    foreach($news_execution as $k_news_execution => $val_news_execution) {
                        if( array_search($val_news_execution['ne_newsexecutionid'], $event) !== false ) {
                            $hasData = 0;
                            $grahpData = '[';
                            $grahpData .= '["title", "'.$val_news_execution['ne_name'].'"],';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalAmphurExecution = $sumInjuriesExecution = $sumLoseExecution = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['ne_newsexecutionid'] == $val_news_execution['ne_newsexecutionid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurExecution++;
                                            }
                                            if(isset($v_result['injuries']) && $v_result['injuries']) {
                                                $sumInjuriesExecution += $v_result['injuries'];
                                            }
                                            if(isset($v_result['lose']) && $v_result['lose']) {
                                                $sumLoseExecution += $v_result['lose'];
                                            }
                                        }
                                    }
                                    $grahpData .= '["'.$val_amphur['amphur_name'].'", '.$totalAmphurExecution.'],';
                                    $hasData += $totalAmphurExecution;
                                }
                                //$grahpData .= '["เจ็บ", '.$sumInjuriesExecution.'],';//เจ็บ
                                //$grahpData .= '["ตาย", '.$sumLoseExecution.'],';//ตาย
                            }
                            $grahpData .= ']';
                            $arrGrahp[$val_news_execution['ne_newsexecutionid']]['name'] = $val_news_execution['ne_name'];
                            $arrGrahp[$val_news_execution['ne_newsexecutionid']]['data'] = $grahpData;
                            $arrGrahp[$val_news_execution['ne_newsexecutionid']]['hasData'] = $hasData;
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
            <?php if( $group_event == 1 && isset( $event ) && $event ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '"'.$val_amphur['amphur_name'].'", ';
                            $plot_height = $plot_height + 30; 
                        }
                    }
                    $grahpData .= '],';
                    foreach($news_cause as $k_news_cause => $val_news_cause) {
                        if( array_search($val_news_cause['nc_newscauseid'], $event) !== false ) {
                            $grahpData .= '["'.$val_news_cause['nc_name'].'", ';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalNewsCause = $sumInjuriesCause = $sumLoseCause = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nc_newscauseid'] == $val_news_cause['nc_newscauseid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsCause++;
                                            }
                                        }
                                        $grahpData .= $totalNewsCause.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach($news_cause as $k_news_cause => $val_news_cause) {
                        if( array_search($val_news_cause['nc_newscauseid'], $event) !== false ) {
                            $grahpData .= '"'.$val_news_cause['nc_name'].'", ';
                        }
                    }
                    $grahpData .= '],';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '["'.$val_amphur['amphur_name'].'", ';
                            foreach($news_cause as $k_news_cause => $val_news_cause) {
                                if( array_search($val_news_cause['nc_newscauseid'], $event) !== false ) {
                                    $totalAmphurCause = $sumInjuriesCause = $sumLoseCause = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nc_newscauseid'] == $val_news_cause['nc_newscauseid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurCause++;
                                            }
                                        }
                                        $grahpData .= $totalAmphurCause.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                            $plot_height = $plot_height + 30; 
                        }
                    }
                    $grahpData .= ']';
                }
            } ?>
        
            <?php if( $group_event == 2 && isset( $event ) && $event ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '"'.$val_amphur['amphur_name'].'", ';
                            $plot_height = $plot_height + 30; 
                        }
                    }
                    $grahpData .= '],';
                    foreach($news_harry as $k_news_harry => $val_news_harry) {
                        if( array_search($val_news_harry['nh_newsharryid'], $event) !== false ) {
                            $grahpData .= '["'.$val_news_harry['nh_name'].'", ';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalNewsHarry = $sumInjuriesHarry = $sumLoseHarry = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nh_newsharryid'] == $val_news_harry['nh_newsharryid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsHarry++;
                                            }
                                        }
                                        $grahpData .= $totalNewsHarry.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach($news_harry as $k_news_harry => $val_news_harry) {
                        if( array_search($val_news_harry['nh_newsharryid'], $event) !== false ) {
                            $grahpData .= '"'.$val_news_harry['nh_name'].'", ';
                        }
                    }
                    $grahpData .= '],';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '["'.$val_amphur['amphur_name'].'", ';
                            foreach($news_harry as $k_news_harry => $val_news_harry) {
                                if( array_search($val_news_harry['nh_newsharryid'], $event) !== false ) {
                                    $totalAmphurHarry = $sumInjuriesHarry = $sumLoseHarry = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['nh_newsharryid'] == $val_news_harry['nh_newsharryid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurHarry++;
                                            }
                                        }
                                        $grahpData .= $totalAmphurHarry.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                            $plot_height = $plot_height + 30; 
                        }
                    }
                    $grahpData .= ']';
                }
            } ?>
        
            <?php if( $group_event == 3 && isset( $event ) && $event ) {
                $plot_height = 0;
                if( isset( $core_type ) && $core_type == 2 ) {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '"'.$val_amphur['amphur_name'].'", ';
                            $plot_height = $plot_height + 30; 
                        }
                    }
                    $grahpData .= '],';
                    foreach($news_execution as $k_news_execution => $val_news_execution) {
                        if( array_search($val_news_execution['ne_newsexecutionid'], $event) !== false ) {
                            $grahpData .= '["'.$val_news_execution['ne_name'].'", ';
                            foreach ( $amphur as $val_amphurs ) {
                                foreach( $val_amphurs as $val_amphur) {
                                    $totalNewsExecution = $sumInjuriesExecution = $sumLoseExecution = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['ne_newsexecutionid'] == $val_news_execution['ne_newsexecutionid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalNewsExecution++;
                                            }
                                        }
                                        $grahpData .= $totalNewsExecution.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                        }
                    }
                    $grahpData .= ']';
                } else {
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach($news_execution as $k_news_execution => $val_news_execution) {
                        if( array_search($val_news_execution['ne_newsexecutionid'], $event) !== false ) {
                            $grahpData .= '"'.$val_news_execution['ne_name'].'", ';
                        }
                    }
                    $grahpData .= '],';
                    foreach ( $amphur as $val_amphurs ) {
                        foreach( $val_amphurs as $val_amphur) {
                            $grahpData .= '["'.$val_amphur['amphur_name'].'", ';
                            foreach($news_execution as $k_news_execution => $val_news_execution) {
                                if( array_search($val_news_execution['ne_newsexecutionid'], $event) !== false ) {
                                    $totalAmphurExecution = $sumInjuriesExecution = $sumLoseExecution = 0;
                                    if( isset($result) && $result ) {
                                        foreach( $result as $k_result => $val_result ) {
                                            if( $val_result['ne_newsexecutionid'] == $val_news_execution['ne_newsexecutionid'] && $val_result['na_newsamphorid'] == $val_amphur['amphur_id']) {
                                                $totalAmphurExecution++;
                                            }
                                        }
                                        $grahpData .= $totalAmphurExecution.', ';
                                    }
                                }
                            }
                            $grahpData .= '],';
                            $plot_height = $plot_height + 30; 
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