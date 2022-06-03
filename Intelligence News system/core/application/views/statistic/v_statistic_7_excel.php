<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 6px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-fqpo{background-color:#cbcefb}
    .tg .tg-uhkr{background-color:#ffce93}
    .tg .tg-a1rn{background-color:#ffffc7}
    .tg .tg-qptv{background-color:#ffce93;text-align:center}
    .tg .tg-lfnm{background-color:#cbcefb;text-align:center}
</style>
<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="container">
        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">เหตุระเบิดในพื้นที่ จชต.</h4>
            </div>
        </div>
         
        <div class="form-group">
            <div class="col-lg-12">
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
                <br>
                <br>
            </div>
        </div>
    </div>
</div>