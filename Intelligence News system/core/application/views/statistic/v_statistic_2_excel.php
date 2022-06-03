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
    </style>
<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="container">
 
        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">จำนวนผู้เสียชีวิตและบาดเจ็บ ยอดรวม</h4>
            </div>
        </div>

         <div class="form-group">
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
                                
                            ?>
                                
                            <tr>
                                <td class="tg-031e" style="text-align:left;"><?= $v_np5['np_person']?></td>
                                <?php 
                                    foreach ($all_data_count as $k_adc => $v_adc) {
                                        if($v_adc['province_id'] == 76){
                                            if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                                //echo '<br>'.$v_adc['np_newspersonid']." = ".$v_np5['np_newspersonid'].'<br>';
                                                //echo $v_adc['nr_injuries_total'];
                                                echo '<td class="tg-031e">'.$v_adc['nr_lose_total'].'</td>'; //ตาย
                                                echo '<td class="tg-031e">'.$v_adc['nr_injuries_total'].'</td>'; //เจ็บ
                                                $count_x_injuries += $v_adc['nr_injuries_total'];
                                                $count_x_lose += $v_adc['nr_lose_total'];
                                                
                                                $count_y1_lose += $v_adc['nr_lose_total'];
                                                $count_y1_injuries += $v_adc['nr_injuries_total'];
                                                
                                                //echo " Province ".$v_adc['province_id']." nr_injuries_total ".$v_adc['nr_injuries_total']." SUM = ".$count_y1_injuries."<br>";
                                            }
                                        }
                                        
                                        if($v_adc['province_id'] == 75){
                                            if($v_adc['np_newspersonid'] == $v_np5['np_newspersonid']){
                                                //echo $v_adc['nr_injuries_total'];
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
                                                //echo $v_adc['nr_injuries_total'];
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
                                                
                                                 //echo $k_adc."e += $v_adc['nr_lose_total']; Province ".$v_adc['province_id']." nr_injuries_total ".$v_adc['nr_injuries_total']." SUM = ".$count_y4_injuries."<br>";
                                            }
                                        }
                                        
                                        ?>
                            <?php  } // END Foreach $all_data_count 
                            ?>  
                                <td class="tg-2mjt" style="text-align:right"><?= $count_x_lose;?></td>
                                <td class="tg-2mjt" style="text-align:right"><?= $count_x_injuries;?></td>
                            </tr>
                    <?php    
                    } // END  Foreach   $news_person5
                        }else{ 
                            foreach ($news_person5 as $k_np5 => $v_np5) { ?>
                                <tr>
                                <td class="tg-031e" style="text-align:left;"><?= $v_np5['np_person']?></td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-031e">0</td>
                                <td class="tg-2mjt">0</td>
                                <td class="tg-2mjt">0</td>
                                </tr>
                        <?php    }
                            ?>
                    <?php    } ?>  
                      
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
        </div>
    </div>
    </div>
</div>