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
</style>
<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="container">
        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">อาวุธปืนที่จนท.ได้กลับคืน</h4>
            </div>
        </div>

         <div class="form-group">
             <div class="col-lg-12">
                <table class="tg">
                    <tr>
                        <th class="tg-iwwn">ปืน</th>
                        <th class="tg-iwwn">จังหวัดนราธิวาส</th>
                        <th class="tg-iwwn">จังหวัดปัตตานี</th>
                        <th class="tg-iwwn">จังหวัดยะลา</th>
                        <th class="tg-iwwn">จังหวัดสงขลา</th>
                        <th class="tg-iwwn">รวม</th>
                    </tr>
                    <?php 
                    $count_x = 0;
                    
                    $count_y1 = 0;
                    $count_y2 = 0;
                    $count_y3 = 0;
                    $count_y4 = 0;
                    
                    if($all_data_count){  
                        
                    foreach($gun as $k_g => $v_g){ 
                     $count_x = 0;

                    ?>
                    
                    <tr>
                        <td class="tg-031e" style="text-align:left;"><?= $v_g['ng_gun']?></td>
                        <?php foreach($all_data_count as $k_adc => $v_adc){
                            if($v_adc['province_id'] == 76){
                                if($v_adc['ng_newsgunid'] == $v_g['ng_newsgunid']){
                                    echo '<td class="tg-031e">'.$v_adc['nr_holdreturn_total'].'</td>';
                                     $count_x += $v_adc['nr_holdreturn_total'];
                                     $count_y1 += $v_adc['nr_holdreturn_total'];
                                }
                            }
                            if($v_adc['province_id'] == 75){
                                if($v_adc['ng_newsgunid'] == $v_g['ng_newsgunid']){
                                    echo '<td class="tg-031e">'.$v_adc['nr_holdreturn_total'].'</td>';
                                    $count_x += $v_adc['nr_holdreturn_total'];
                                    $count_y2 += $v_adc['nr_holdreturn_total'];
                                }
                            }
                            if($v_adc['province_id'] == 74){
                                if($v_adc['ng_newsgunid'] == $v_g['ng_newsgunid']){
                                    echo '<td class="tg-031e">'.$v_adc['nr_holdreturn_total'].'</td>';
                                    $count_x += $v_adc['nr_holdreturn_total'];
                                    $count_y3 += $v_adc['nr_holdreturn_total'];
                                }
                            }
                            
                            if($v_adc['province_id'] == 70){
                                if($v_adc['ng_newsgunid'] == $v_g['ng_newsgunid']){
                                    echo '<td class="tg-031e">'.$v_adc['nr_holdreturn_total'].'</td>';
                                    $count_x += $v_adc['nr_holdreturn_total'];
                                    $count_y4 += $v_adc['nr_holdreturn_total'];
                                }
                            }
                        } 
                        ?>
                        <td class="tg-031e"><?= $count_x;?></td>
                    </tr>    
                    <?php }?>
                    <?php  }else{ ?>
                       <?php foreach($gun as $k_g => $v_g){ ?>
                                <tr>
                                    <td class="tg-031e" style="text-align:left;"><?= $v_g['ng_gun']?></td>
                                    <td class="tg-031e">0</td>
                                    <td class="tg-031e">0</td>
                                    <td class="tg-031e">0</td>
                                    <td class="tg-031e">0</td>
                                    <td class="tg-031e">0</td>
                                </tr>
                    <?php }} ?>
                    <tr>
                      <td class="tg-a1rn" style="text-align:left;">รวม</td>
                      <td class="tg-a1rn"><?= $count_y1;?></td>
                      <td class="tg-a1rn"><?= $count_y2;?></td>
                      <td class="tg-a1rn"><?= $count_y3;?></td>
                      <td class="tg-a1rn"><?= $count_y4;?></td>
                      <td class="tg-a1rn" style="text-align:right"><?= $count_y1+$count_y2+$count_y3+$count_y4?></td>
                    </tr>
                </table>
                 <br>
             </div>
        </div>

    </div>
        
    </div>
    
</div>
