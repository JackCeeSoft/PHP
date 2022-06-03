<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;text-align: right;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-iwwn{background-color:#bed7ff;text-align:center}
    .tg .tg-a1rn{background-color:#ffffc7}
    .tg .tg-76{background-color:blue}
    .tg .tg-74{background-color:yellow}
    .tg .tg-75{background-color:orange}
    .tg .tg-70{background-color:graytext}
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
            <div class="col-lg-6">
                <h4 class="blue">อาวุธปืนที่ถูกกลุ่มผู้ก่อเหตุรุนแรงยึดไป</h4>
            </div>
        </div>

        <?php if( $graph_ui == 'table' ) { ?>
            <div class="col-lg-12">
                <table class="tg">
                    <tr>
                        <th class="tg-iwwn">จังหวัด</th>
                        <?php
                            $loop_table_province = 0;
                            $show_data = array();
                            $data_y = array();
                            $sum_x1 = 0;
                            $sum_x2 = 0;
                            $sum_x3 = 0;
                            $sum_x4 = 0;
                        ?>
                        <?php foreach($news_execution5 as $k_ne5 => $v_ne5){ ?>
                            <th class="tg-iwwn"><?=$v_ne5['ne_name'];?></th> 
                        <?php } ?>
                        <th class="tg-a1rn">รวม</th>
                    </tr>
                    <tr>
                        <td class="tg-031e" style="text-align: left;">นราธิวาส</td>
                        <?php
                            $sum_x1 = 0;
                            $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5) {
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count) {
                                    foreach($all_data_count as $k_adc => $v_adc) { 
                                        if($v_adc['np_newsprovinceid'] == 76) {
                                            if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                                $sum_x1 += $v_adc['ne_newsexecution_total']; 
                                                if (isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                } else {
                                                    $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                } 
                                                $check_print = 1;
                                                echo '<td class="tg-031e" style="text-align:right">' . $v_adc['ne_newsexecution_total'] . '</td>';
                                            }
                                        }
                                    }
                                    if($check_print == 0) {
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    } 
                                } else {
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                            }
                        ?>
                        <td class="tg-031e"><?= $sum_x1;?></td>
                    </tr>
                    <tr>
                       <td class="tg-031e" style="text-align: left;">ยะลา</td>
                        <?php
                            $sum_x2 = 0;
                            $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5) {
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count){
                                    foreach($all_data_count as $k_adc => $v_adc) { 
                                        if($v_adc['np_newsprovinceid'] == 75){
                                            if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                                $sum_x2 += $v_adc['ne_newsexecution_total'];
                                                if(isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                }else{
                                                    $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                } 
                                                $check_print = 1;
                                                echo '<td class="tg-031e" style="text-align:right">' . $v_adc['ne_newsexecution_total'] . '</td>';
                                            }
                                        }
                                    }
                                    if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                } else {
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                            }
                        ?>
                        <td class="tg-031e"><?= $sum_x2;?></td>
                    </tr>
                    <tr>
                        <td class="tg-031e" style="text-align: left;">ปัตตานี</td>
                        <?php 
                            $sum_x3 = 0;
                            $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count) {
                                    foreach($all_data_count as $k_adc => $v_adc) { 
                                        if($v_adc['np_newsprovinceid'] == 74){
                                            if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                                $sum_x3 += $v_adc['ne_newsexecution_total'];
                                                if(isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                }else{
                                                    $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                }
                                                $check_print = 1;
                                                echo '<td class="tg-031e" style="text-align:right">' . $v_adc['ne_newsexecution_total'] . '</td>';
                                            }
                                        }
                                    }
                                    if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                } else {
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                            }
                        ?>
                        <td class="tg-031e"><?= $sum_x3;?></td>
                    </tr>
                    <tr>
                        <td class="tg-031e" style="text-align: left;">สงขลา</td>
                        <?php 
                            $sum_x4 = 0;
                            $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count){
                                    foreach($all_data_count as $k_adc => $v_adc){ 
                                        if($v_adc['np_newsprovinceid'] == 70){
                                            if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']){ 
                                                $sum_x4 += $v_adc['ne_newsexecution_total'];
                                                if(isset($data_y[$v_ne5['ne_newsexecutionid']])){
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                }else{
                                                    $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                    $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                                }
                                                $check_print = 1;
                                                echo '<td class="tg-031e" style="text-align:right">' . $v_adc['ne_newsexecution_total'] . '</td>';
                                            }
                                        }
                                    }
                                    if($check_print == 0) {
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                } else {
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                            }
                        ?>
                        <td class="tg-031e"><?= $sum_x4;?></td>
                    </tr>
                    <tr>
                      <td class="tg-a1rn" style="text-align: left;">รวม</td>
                            <?php 
                                foreach ($news_execution5 as $k_ne5 => $v_ne5){
                                    if(isset($data_y)){
                                        if(isset($data_y[$v_ne5['ne_newsexecutionid']]) && $data_y[$v_ne5['ne_newsexecutionid']]) {
                                            echo '<td class="tg-a1rn">' . $data_y[$v_ne5['ne_newsexecutionid']] . '</td>';
                                        } else {
                                            echo '<td class="tg-a1rn">0</td>';
                                        }
                                    }else{
                                        echo '<td class="tg-a1rn">0</td>';
                                    }
                                }
                            ?>
                      <td class="tg-a1rn" style="text-align:right"><?= $sum_x1 + $sum_x2 + $sum_x3 + $sum_x4; ?></td>
                    </tr>
                </table>
                <br>
            </div>
        <?php } ?>

        <?php $provinceArr = array(76 => 'นราธิวาส', 75 => 'ยะลา', 74 => 'ปัตตานี', 70 => 'สงขลา', ); ?>
        <?php if( $graph_ui == 'pie' ) { ?>
            <?php 
                $arrGrahp = array();
                if( isset( $core_type ) && $core_type == 2 ) {
                    foreach($news_execution5 as $k_ne5 => $v_ne5) {
                        $hasData = 0;
                        $grahpData = '[';
                        $grahpData .= '["title", "' . $v_ne5['ne_name'] . '"],';
                        foreach ($provinceArr as $key_province => $val_province) {
                            $grahpData .= '["' . $val_province . '", ';
                            $check_print = 0;
                            if(isset($all_data_count) && $all_data_count) {
                                foreach($all_data_count as $k_adc => $v_adc) { 
                                    if($v_adc['np_newsprovinceid'] == $key_province) {
                                        if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                            if (isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } else {
                                                $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } 
                                            $check_print = 1;
                                            $grahpData .= $v_adc['ne_newsexecution_total'];
                                            $hasData += $v_adc['ne_newsexecution_total'];
                                        }
                                    }
                                }
                                if($check_print == 0) {
                                    $grahpData .= '0';
                                    $check_print = 1;
                                } 
                            } else {
                                $grahpData .= '0';
                            }
                            $grahpData .= '],';
                        }
                        $grahpData .= ']';
                        $arrGrahp[$k_ne5]['name'] = $v_ne5['ne_name'];
                        $arrGrahp[$k_ne5]['data'] = $grahpData;
                        $arrGrahp[$k_ne5]['hasData'] = $hasData;
                    }
                } else {
                    foreach ($provinceArr as $key_province => $val_province) {
                        $hasData = 0;
                        $grahpData = '[';
                        $grahpData .= '["title", "' . $val_province . '"],';
                        foreach($news_execution5 as $k_ne5 => $v_ne5) {
                            $grahpData .= '["' . $v_ne5['ne_name'] . '", ';
                            $check_print = 0;
                            if(isset($all_data_count) && $all_data_count) {
                                foreach($all_data_count as $k_adc => $v_adc) { 
                                    if($v_adc['np_newsprovinceid'] == $key_province) {
                                        if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                            if (isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } else {
                                                $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } 
                                            $check_print = 1;
                                            $grahpData .= $v_adc['ne_newsexecution_total'];
                                            $hasData += $v_adc['ne_newsexecution_total'];
                                        }
                                    }
                                }
                                if($check_print == 0) {
                                    $grahpData .= '0';
                                    $check_print = 1;
                                } 
                            } else {
                                $grahpData .= '0';
                            }
                            $grahpData .= '],';
                        }
                        $grahpData .= ']';
                        $arrGrahp[$key_province]['name'] = $val_province;
                        $arrGrahp[$key_province]['data'] = $grahpData;
                        $arrGrahp[$key_province]['hasData'] = $hasData;
                    }
                }
            ?>
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
            <?php
                if( isset( $core_type ) && $core_type == 2 ) {
                    $plot_height = 0;
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach($news_execution5 as $k_ne5 => $v_ne5) {
                        $grahpData .= '"' . $v_ne5['ne_name'] . '", ';
                    }
                    $grahpData .= '],';
                    foreach ($provinceArr as $key_province => $val_province) {
                        $grahpData .= '["' . $val_province . '", ';
                        if(isset($all_data_count) && $all_data_count) {
                            foreach($news_execution5 as $k_ne5 => $v_ne5) {
                                $check_print = 0;
                                foreach($all_data_count as $k_adc => $v_adc) { 
                                    if($v_adc['np_newsprovinceid'] == $key_province) {
                                        if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                            if (isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } else {
                                                $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } 
                                            $check_print = 1;
                                            $grahpData .= $v_adc['ne_newsexecution_total'].', ';
                                        }
                                    }
                                }
                                if($check_print == 0) {
                                    $grahpData .= '0, ';
                                } 
                                $plot_height = $plot_height + 30; 
                            }
                        }
                        $grahpData .= '],';
                    }
                    $grahpData .= ']';
                } else {
                    $plot_height = 0;
                    $grahpData = '[';
                    $grahpData .= '["title", ';
                    foreach ($provinceArr as $key_province => $val_province) {
                        $grahpData .= '"' . $val_province . '", ';
                    }
                    $grahpData .= '],';
                    foreach($news_execution5 as $k_ne5 => $v_ne5) {
                        $grahpData .= '["' . $v_ne5['ne_name'] . '", ';
                        if(isset($all_data_count) && $all_data_count) {
                            foreach ($provinceArr as $key_province => $val_province) {
                                $check_print = 0;
                                foreach($all_data_count as $k_adc => $v_adc) { 
                                    if($v_adc['np_newsprovinceid'] == $key_province) {
                                        if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']) { 
                                            if (isset($data_y[$v_ne5['ne_newsexecutionid']])) {
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } else {
                                                $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                            } 
                                            $check_print = 1;
                                            $grahpData .= $v_adc['ne_newsexecution_total'].', ';
                                        }
                                    }
                                }
                                if($check_print == 0) {
                                    $grahpData .= '0, ';
                                } 
                                $plot_height = $plot_height + 30; 
                            }
                        }
                        $grahpData .= '],';
                    }
                    $grahpData .= ']';
                }
            ?>

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

<!--        <div class="form-group">
            <div class="col-lg-12">
                <h4 class="blue">รายละเอียดเหตุการณ์</h4>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12">
                <table class="tg">
                    <?php if(isset($data_text) && $data_text) { ?>
                        <?php foreach($data_text as $k_dt=>$v_dt){ ?>
                            <tr>
                                <th class="tg-s6z2" style="vertical-align: top;"><?= $k_dt+1;?></th>
                                <th class="tg-031e" style="width: 920px;">วันที่รายงาน : <?= substr($v_dt['np_time'],0,-16).'<br> เวลา : '.substr($v_dt['np_time'],11,-7).'<br><br>'.$v_dt['np_paragraph']?></th>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </table>
            </div>     
        </div>
        
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
        </div>-->
    </div>
</div>
<br><br><br>
<script type="text/javascript">
    $('.datetimepicker').datetimepicker({
        language: 'th'
    });
</script>