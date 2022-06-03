<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel  col-lg-12 center">
      <div class="col-lg-12">
          <?php 
                if(isset($keyword) and $keyword){
                    
                }else{
                    $keyword = "";
                }
          ?>
                <form class="form-horizontal" action="action_log/lists">
                        
                    <?php 
                        $sesstion = $this->session->all_userdata();
                        //print_r($sesstion);
                            if($sesstion['base_u_unitid'] == 0){ ?>
                              <div class="form-group">
                                    <div class="col-lg-2">
                                        <label class="control-label right">ระบบงาน : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" id="u_unitid" name="u_unitid">
                                            <?php 
                                            echo '<option value="0">เลือกทุกระบบงาน</option>';
                                            foreach ($unit as $v_u){
                                                ?>
                                                <option value="<?= $v_u['u_unitid']; ?>" <?= (isset($u_unitid) and $u_unitid == $v_u['u_unitid']) ? 'selected' : ''; ?>><?= $v_u['u_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php }else{ ?>

                    <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำค้นหา (Keyword) : </label>
                            </div>
                            <div class="col-lg-6 margin-top10px">
                                <input type="text" class="form-control" name="g_search" value="<?php if(isset($keyword) and $keyword) echo $keyword; ?>">
                            </div>
                            <p></p>
                            <br><br><br>
                            <div class="col-lg-11">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="action_log/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
                                
                            </div>
                            <?php 
                                if(!isset($u_unitid)){
                                    $u_unitid = "";
                                }
                                if(!isset($al_action)){
                                    $al_action = "";
                                }
                                if(!isset($keyword)){
                                    $keyword = "";
                                }
                                if((isset($filter['start']) and $filter['start'])){
                                    
                                }else{
                                    $filter['start'] = "";
                                }
                                if((isset($filter['end']) and $filter['end'])){
                                    
                                }else{
                                    $filter['end'] = "";
                                }
                                
                            ?>
                            <div class="col-lg-1">
                                    <a href="action_log/lists_excel?u_unitid=<?=$u_unitid;?>&al_action=<?=$al_action;?>&start=<?=$filter['start'];?>&end=<?=$filter['end'];?>&g_search=<?=$keyword;?>" class="btn btn-info">Excel</a>
                            </div>
                        </div>
                            
                            <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">จำนวนรายการ : </label>
                            </div>
                            <div class="col-lg-5">
                                <label class="control-label left"><?php echo $total_rows;?> รายการ</label>
                            </div>
                            </div>
                </form>
            </div>
        <div class="col-lg-12 center">
            
            <div class="table-responsive">
                    <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                        <thead> 
                            <tr>
                                <th width="30">ลำดับ</th>
                                <th width="50">ผู้ใช้งาน</th>
                                <th width="100">IP Address</th>
                                <th width="100">Method</th>
                                <th width="100">Action</th>
                                <th width="100">Time</th>
                                <th width="100">หน่วยงาน</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php if(isset($lists) and $lists) { ?>
                                        <tbody>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                                <tr>
                                                    <th><?= ($k_lists + 1 + $offest); ?></th>
                                                    <th>
                                                    <?php 
                                                        if(isset($user_account) && $user_account){
                                                            foreach ($user_account as $k_ua => $v_ua){
                                                                if($v_ua['ua_userid'] == $v_lists['al_ua_userid']){
                                                                    echo $v_ua['ua_username'];
                                                                }
                                                            }
                                                        }
                                                    
                                                    ?>
                                                    </th>
                                                    <td><?= highlightWords($v_lists['al_ip_address'],$keyword); ?></td>
                                                    <td><?= highlightWords($v_lists['al_method'],$keyword); ?></td>
                                                    <td><?= highlightWords($v_lists['al_action'],$keyword); ?></td>
                                                    <td><?= $v_lists['al_createddate']; ?></td>

                                                    <td><?php
                                                    if($v_lists['al_unit'] == 0){
                                                            echo 'สังกัดทุกระบบ';
                                                    }
                                                        foreach ($unit as $values){
                                                            if($values['u_unitid'] == $v_lists['al_unit']){
                                                                echo $values['u_name'];
                                                            }
                                                        }
                                                    ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
        </div>
        </div>
  
</div>