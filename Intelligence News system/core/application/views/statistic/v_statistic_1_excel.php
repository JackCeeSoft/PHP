<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-huad{background-color:#ffccc9}
    .tg .tg-a1rn{background-color:#ffffc7}
    .tg .tg-radx{background-color:#bed7ff}
    .tg .tg-huh2{font-size:14px;text-align:center}
</style>
<div id="page-wrapper" class="bg-fff">
    <div class="">
        <div class="">
        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">เหตุการณ์และภาพรวมสถานการณ์ใน จชต.</h4>
            </div>
        </div>
         
        <div class="form-group">
            <div class="col-lg-12" style="">
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
        </div>
    </div>
</div>