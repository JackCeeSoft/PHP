<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="user/edit/<?php echo $detail['ua_userid'];?>" method="POST">
                <fieldset>
                <p>
                </p>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ไอดี : </label>
                    </div>
                    <div class="col-lg-5">
                        
                        <input type="text" class="form-control" id="dp" name="" value="<?php echo $detail['ua_userid']; ?>" disabled/>
                        <input type="hidden" class="form-control" id="dp" name="ua_userid" value="<?php echo $detail['ua_userid']; ?>" disabled/>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_username" value="<?php echo $detail['ua_username']; ?>" disabled/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> พาสเวิร์ด : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="password" class="form-control"id="dp" name="ua_password" value="<?php echo $detail['ua_password']; ?>"disabled/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อ : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_firstname" value="<?php echo $detail['ua_firstname']; ?>" disabled />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> นามสกุล : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_lastname" value="<?php echo $detail['ua_lastname']; ?>" disabled/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> อี-เมล์ (E-mail) :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_email" value="<?php echo $detail['ua_email']; ?>"disabled />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> รหัสบัตรประจำตัวราชการ (10 หลัก)
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_description" value="<?php echo $detail['ua_description']; ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กลุ่มผู้ใช้งาน : </label>
                    </div>
                    <?php //print_r($detail);?>
                    <div class="col-lg-4">
                        <select class="form-control" name="ug_groupid" disabled>
                            <?php 
                            foreach ($user_group as $values){
                                if($values['ug_groupid'] == $detail['ug_groupid']){
                                    $select_group_t = "selected";
                                }else{
                                    $select_group_t = "";
                                }
                                ?>
                            <option value="<?php echo $values['ug_groupid'];?>" <?php echo $select_group_t; ?> ><?php echo $values['ug_groupname'];?></option>
                            <?php
                            }
                            ?>
                      
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ระบบผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" id="u_unitid" name="u_unitid" disabled>
                            <option value="0"> ทุกระบบงาน </option>
                            <?php 
                            foreach ($unit as $values){
                                if($values['u_unitid'] == $detail['u_unitid']){
                                    $select_unit_t = "selected";
                                }else{
                                    $select_unit_t = "";
                                }
                             ?>
                            <option value="<?php echo $values['u_unitid'];?>"<?php echo $select_unit_t; ?> ><?php echo $values['u_name'];?></option>
                            <?php
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ระบบย่อยผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" id="u_unitid" name="s_unitsub_id" disabled>
                            <option value="0"> ทุกระบบงาน </option>
                            <?php 
                            foreach ($unit as $values){
                                if($values['s_unitsub_id'] == $detail['s_unitsub_id']){
                                    $select_unit_t = "selected";
                                }else{
                                    $select_unit_t = "";
                                }
                             ?>
                            <option value="<?php echo $values['s_unitsub_id'];?>"<?php echo $select_unit_t; ?> ><?php echo $values['s_unitsub_name'];?></option>
                            <?php
                            }
                            
                            ?>
                        </select>
                    </div>
                </div> 
               
                </form>
                
    		</div>
            
        </div>
    </div>
</div>
