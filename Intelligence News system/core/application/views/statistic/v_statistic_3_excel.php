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
                <h4 class="blue">อาวุธปืนที่ถูกกลุ่มผู้ก่อเหตุรุนแรงยึดไป</h4>
            </div>
        </div>

         <div class="form-group">
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
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                        ?>
                               <th class="tg-iwwn"><?=$v_ne5['ne_name'];?></th> 
                        <?php    }
                        ?>
                        <th class="tg-a1rn">รวม</th>
                    </tr>
                    <tr>
                        <td class="tg-031e" style="text-align: left;">นราธิวาส</td>
                        <?php
                        $sum_x1 = 0;
                        $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count){
                                foreach($all_data_count as $k_adc => $v_adc){ 
                                    if($v_adc['np_newsprovinceid'] == 76){
                                          if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']){ 
                                              $sum_x1 += $v_adc['ne_newsexecution_total']; 
                                              if(isset($data_y[$v_ne5['ne_newsexecutionid']])){
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              }else{
                                                  $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              } $check_print = 1;
                        ?>
                                              <td class="tg-031e" style="text-align:right"><?= $v_adc['ne_newsexecution_total'];?></td>    
                        <?php   }?>
                                     
                        <?php         
                             }
                        ?>
                                    
                        <?php  } 
                                if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                               }else{
                                   echo '<td class="tg-031e" style="text-align:right">0</td>';
                               }     
                             
                             }?>
                        
                        <td class="tg-031e"><?= $sum_x1;?></td>
                        
                    </tr>
                    <tr>
                       <td class="tg-031e" style="text-align: left;">ยะลา</td>
                        <?php
                        $sum_x2 = 0;
                        $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count){
                                foreach($all_data_count as $k_adc => $v_adc){ 
                                    if($v_adc['np_newsprovinceid'] == 75){
                                          if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']){ 
                                              $sum_x2 += $v_adc['ne_newsexecution_total'];
                                              if(isset($data_y[$v_ne5['ne_newsexecutionid']])){
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              }else{
                                                  $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              } $check_print = 1;?>
                                              <td class="tg-031e" style="text-align:right"><?= $v_adc['ne_newsexecution_total'];?></td>
                                              
                        <?php        } ?>
                        <?php       
                             }
                        ?>
                                    
                        <?php  } 
                        
                                if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                }else{
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                        }?>
                        <td class="tg-031e"><?= $sum_x2;?></td>
                    </tr>
                    <tr>
                         <td class="tg-031e" style="text-align: left;">ปัตตานี</td>
                        
                        <?php 
                            $sum_x3 = 0;
                            $check_print = 0;
                            foreach($news_execution5 as $k_ne5 => $v_ne5){
                                $check_print = 0;
                                if(isset($all_data_count) && $all_data_count){
                                foreach($all_data_count as $k_adc => $v_adc){ 
                                    if($v_adc['np_newsprovinceid'] == 74){
                                          if($v_adc['ne_newsexecutionid'] == $v_ne5['ne_newsexecutionid']){ 
                                          $sum_x3 += $v_adc['ne_newsexecution_total'];
                                          if(isset($data_y[$v_ne5['ne_newsexecutionid']])){
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              }else{
                                                  $data_y[$v_ne5['ne_newsexecutionid']] = 0;
                                                  $data_y[$v_ne5['ne_newsexecutionid']] += $v_adc['ne_newsexecution_total'];
                                              } $check_print = 1;
                        ?>
                                              <td class="tg-031e" style="text-align:right"><?= $v_adc['ne_newsexecution_total'];?></td>
                        <?php               }?>
                        <?php     }?>
                                    
                        <?php  }
                            if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                }else{
                                    echo '<td class="tg-031e" style="text-align:right">0</td>';
                                }
                        }?>
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
                                              } $check_print = 1;
                                             
                        ?>
                                              <td class="tg-031e" style="text-align:right"><?= $v_adc['ne_newsexecution_total'];?></td>
                        <?php        } ?>
                        <?php        
                                        
                             }
                        ?>
                                    
                        <?php  }
                                if($check_print == 0){
                                        echo '<td class="tg-031e" style="text-align:right">0</td>';
                                        $check_print = 1;
                                    }
                                 }else{
                                     echo '<td class="tg-031e" style="text-align:right">0</td>';
                                 }
                        }?>
                        <td class="tg-031e"><?= $sum_x4;?></td>
                    </tr>
                    <tr>
                      <td class="tg-a1rn" style="text-align: left;">รวม</td>
                            <?php 
                                //ksort($data_y);  
                                //ksort($news_execution5);
//                                print_r($data_y);
//                                print_r($news_execution5);
                                
                                foreach ($news_execution5 as $k_ne5 => $v_ne5){
                                    if(isset($data_y)){
                                        if(isset($data_y[$v_ne5['ne_newsexecutionid']]) && $data_y[$v_ne5['ne_newsexecutionid']]) {
                                            echo '<td class="tg-a1rn">'.$data_y[$v_ne5['ne_newsexecutionid']].'</td>';
                                        } else {
                                            echo '<td class="tg-a1rn">0</td>';
                                        }
                                    }else{
                                        echo '<td class="tg-a1rn">0</td>';
                                    }
                                }
                            ?>
                      <td class="tg-a1rn" style="text-align:right"><?= $sum_x1+$sum_x2+$sum_x3+$sum_x4;?></td>
                    </tr>
                </table>
                <br>
             </div>        
        </div>
    </div>
         <br><br><br>
    </div>
    
</div>
