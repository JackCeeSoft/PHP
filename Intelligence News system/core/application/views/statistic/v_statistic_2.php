<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;text-align: right}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:right;}
    .tg .tg-76{background-color:blue}
    .tg .tg-74{background-color:yellow}
    .tg .tg-75{background-color:orange}
    .tg .tg-70{background-color:graytext}
    .tg .tg-huad{background-color:red; text-align:right}
    .tg .tg-a1rn{background-color:#ffffc7; text-align:right}
    .tg .tg-2mjt{background-color:#ffccc9;text-align:right}
    
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
                <h4 class="blue">จำนวนผู้เสียชีวิตและบาดเจ็บ ยอดรวม</h4>
            </div>
        </div>

        <?php if( $graph_ui == 'table' ) { ?>
            <div class="col-lg-12">
                <table class="tg">
                    <tr>
                        <th class="tg-s6z2" rowspan="2" style="text-align:left;">ประเภทสูญเสีย</th>
                        <th class="tg-s6z2" colspan="2">จังหวัดนราธิวาส</th>
                        <th class="tg-s6z2" colspan="2">จังหวัดยะลา</th>
                        <th class="tg-s6z2" colspan="2">จังหวัดปัตตานี</th>
                        <th class="tg-s6z2" colspan="2">จังหวัดสงขลา</th>
                        <th class="tg-2mjt" style="text-align:center" colspan="2">รวม</th>
                    </tr>
                    <tr>
                        <td class="tg-s6z2">ตาย</td>
                        <td class="tg-s6z2">เจ็บ</td>
                        <td class="tg-s6z2">ตาย</td>
                        <td class="tg-s6z2">เจ็บ</td>
                        <td class="tg-s6z2">ตาย</td>
                        <td class="tg-s6z2">เจ็บ</td>
                        <td class="tg-s6z2">ตาย</td>
                        <td class="tg-s6z2">เจ็บ</td>
                        <td class="tg-2mjt">ตาย</td>
                        <td class="tg-2mjt">เจ็บ</td>
                    </tr>
                      
                    <?php 
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
                    
                        if($all_data_count){
                            foreach ($news_person5 as $k_np5 => $v_np5) {
                                $count_x_injuries = 0;
                                $count_x_lose = 0; 
                                
                                echo '<tr>';
                                echo '<td class="tg-031e" style="text-align:left;">' . $v_np5['np_person'] . '</td>';
                                foreach ($all_data_count as $k_adc => $v_adc) {
                                    if($v_adc['province_id'] == 76){
                                        if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                            echo '<td class="tg-031e">'.$v_adc['nr_lose_total'].'</td>'; //ตาย
                                            echo '<td class="tg-031e">'.$v_adc['nr_injuries_total'].'</td>'; //เจ็บ
                                            $count_x_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_lose += $v_adc['nr_lose_total'];
                                            $count_y1_lose += $v_adc['nr_lose_total'];
                                            $count_y1_injuries += $v_adc['nr_injuries_total'];
                                        }
                                    }
                                        
                                    if($v_adc['province_id'] == 75){
                                        if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                            echo '<td class="tg-031e">'.$v_adc['nr_lose_total'].'</td>'; //ตาย
                                            echo '<td class="tg-031e">'.$v_adc['nr_injuries_total'].'</td>'; //เจ็บ
                                            $count_y2_lose += $v_adc['nr_lose_total'];
                                            $count_y2_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_lose += $v_adc['nr_lose_total'];
                                        }
                                    }
                                        
                                    if($v_adc['province_id'] == 74){
                                        if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                            echo '<td class="tg-031e">'.$v_adc['nr_lose_total'].'</td>'; //ตาย
                                            echo '<td class="tg-031e">'.$v_adc['nr_injuries_total'].'</td>'; //เจ็บ
                                            $count_y3_lose += $v_adc['nr_lose_total'];
                                            $count_y3_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_lose += $v_adc['nr_lose_total'];
                                        }
                                    }
                                        
                                    if($v_adc['province_id'] == 70){
                                        if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                            echo '<td class="tg-031e">'.$v_adc['nr_lose_total'].'</td>'; //ตาย
                                            echo '<td class="tg-031e">'.$v_adc['nr_injuries_total'].'</td>'; //เจ็บ
                                            $count_y4_lose += $v_adc['nr_lose_total'];
                                            $count_y4_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_injuries += $v_adc['nr_injuries_total'];
                                            $count_x_lose += $v_adc['nr_lose_total'];
                                        }
                                    }
                                }
                                echo '<td class="tg-2mjt" style="text-align:right">' . $count_x_lose . '</td>';
                                echo '<td class="tg-2mjt" style="text-align:right">' . $count_x_injuries . '</td>';
                                echo '</tr>';
                            }// END  Foreach   $news_person5
                        } else { 
                            foreach ($news_person5 as $k_np5 => $v_np5) {
                                echo '<tr>';
                                echo '<td class="tg-031e" style="text-align:left;">' . $v_np5['np_person'] . '</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-031e">0</td>';
                                echo '<td class="tg-2mjt">0</td>';
                                echo '<td class="tg-2mjt">0</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                    <tr>
                        <td class="tg-a1rn" style="text-align:left">รวม</td>
                        <td class="tg-a1rn"><?= $count_y1_lose;?></td>
                        <td class="tg-a1rn"><?= $count_y1_injuries;?></td>

                        <td class="tg-a1rn"><?= $count_y2_lose;?></td>
                        <td class="tg-a1rn"><?= $count_y2_injuries;?></td>

                        <td class="tg-a1rn"><?= $count_y3_lose;?></td>
                        <td class="tg-a1rn"><?= $count_y3_injuries;?></td>

                        <td class="tg-a1rn"><?= $count_y4_lose;?></td>
                        <td class="tg-a1rn"><?= $count_y4_injuries;?></td>

                        <td class="tg-2mjt"><?= $count_y1_lose+$count_y2_lose+$count_y3_lose+$count_y4_lose?></td>
                        <td class="tg-2mjt"><?= $count_y1_injuries+$count_y2_injuries+$count_y3_injuries+$count_y4_injuries?></td>
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
                    foreach ($provinceArr as $k_province => $v_province) {
                        $title = isset( $person_data ) && $person_data ? $person_data['np_person'] : '-';
                        $hasData = 0;
                        $grahpData = '[';
                        $grahpData .= '["title", "' . $title . '"],';
                        foreach ($all_data_count as $k_adc => $v_adc) {
                            if( $v_adc['province_id'] == $k_province ) {
                                if($v_adc['np_newspersonid'] == $person){
                                    $lose = isset( $v_adc['nr_lose_total'] ) && $v_adc['nr_lose_total'] ? $v_adc['nr_lose_total'] : 0;
                                    $grahpData .= '["ตาย", ' . $lose . '],';
                                    $injuries = isset( $v_adc['nr_injuries_total'] ) && $v_adc['nr_injuries_total'] ? $v_adc['nr_injuries_total'] : 0;
                                    $grahpData .= '["เจ็บ", ' . $injuries . '],';

                                    $hasData = ( $lose || $injuries ) ? 1 : 0;
                                }
                            }
                        }
                        $grahpData .= ']';
                        $arrGrahp[$k_province]['name'] = $v_province . ' / ' . $title;
                        $arrGrahp[$k_province]['data'] = $grahpData;
                        $arrGrahp[$k_province]['hasData'] = $hasData;
                    }
                } else {
                    foreach ($news_person5 as $k_np5 => $v_np5) {
                        $hasData = 0;
                        $grahpData = '[';
                        $grahpData .= '["title", "' . $v_np5['np_person'] . '"],';
                        foreach ($all_data_count as $k_adc => $v_adc) {
                            if( $v_adc['province_id'] == $province ) {
                                if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                    $lose = isset( $v_adc['nr_lose_total'] ) && $v_adc['nr_lose_total'] ? $v_adc['nr_lose_total'] : 0;
                                    $grahpData .= '["ตาย", ' . $lose . '],';
                                    $injuries = isset( $v_adc['nr_injuries_total'] ) && $v_adc['nr_injuries_total'] ? $v_adc['nr_injuries_total'] : 0;
                                    $grahpData .= '["เจ็บ", ' . $injuries . '],';

                                    $hasData = ( $lose || $injuries ) ? 1 : 0;
                                }
                            }
                        }
                        $grahpData .= ']';
                        $arrGrahp[$k_np5]['name'] = $v_np5['np_person'] . ' / ' . $provinceArr[$province];
                        $arrGrahp[$k_np5]['data'] = $grahpData;
                        $arrGrahp[$k_np5]['hasData'] = $hasData;
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
                    $grahpData .= '["title", "ตาย", "เจ็บ"],';
                    foreach ($provinceArr as $k_province => $v_province) {
                        $grahpData .= '["' . $v_province . '", ';
                        foreach ($all_data_count as $k_adc => $v_adc) {
                            if ($v_adc['province_id'] == $k_province) {
                                if($v_adc['np_newspersonid'] == $person) {
                                    $lose = isset( $v_adc['nr_lose_total'] ) && $v_adc['nr_lose_total'] ? $v_adc['nr_lose_total'] : 0;
                                    $grahpData .= $lose.', ';
                                    $injuries = isset( $v_adc['nr_injuries_total'] ) && $v_adc['nr_injuries_total'] ? $v_adc['nr_injuries_total'] : 0;
                                    $grahpData .= $injuries.',';

                                    $plot_height = $plot_height + 60; 
                                }
                            }
                        }
                        $grahpData .= '],';
                    }
                    $grahpData .= ']';
                    $title = isset( $person_data ) && $person_data ? $person_data['np_person'] : '-';
                } else {
                    $plot_height = 0;
                    $grahpData = '[';
                    $grahpData .= '["title", "ตาย", "เจ็บ"],';
                    foreach ($news_person5 as $k_np5 => $v_np5) {
                        $grahpData .= '["' . $v_np5['np_person'] . '", ';
                        foreach ($all_data_count as $k_adc => $v_adc) {
                            if ($v_adc['province_id'] == $province) {
                                if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']) {
                                    $lose = isset( $v_adc['nr_lose_total'] ) && $v_adc['nr_lose_total'] ? $v_adc['nr_lose_total'] : 0;
                                    $grahpData .= $lose.', ';
                                    $injuries = isset( $v_adc['nr_injuries_total'] ) && $v_adc['nr_injuries_total'] ? $v_adc['nr_injuries_total'] : 0;
                                    $grahpData .= $injuries.',';

                                    $plot_height = $plot_height + 60; 
                                }
                            }
                        }
                        $grahpData .= '],';
                    }
                    $grahpData .= ']';
                    $title = $provinceArr[$province];
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
                                bars: 'horizontal',
                                title: '<?= $title; ?>'
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
                                title: '<?= $title; ?>',
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
                    <?php if(isset($data_text) && $data_text){ ?>
                        <?php foreach($data_text as $k_dt=>$v_dt){ ?>
                            <tr>
                                <th class="tg-s6z2" style="vertical-align: top;"><?= $k_dt+1;?></th>
                                <th class="tg-031e">วันที่รายงาน : <?= substr($v_dt['np_time'],0,-16).'<br> เวลา : '.substr($v_dt['np_time'],11,-7).'<br><br>'.$v_dt['np_paragraph']?></th>
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