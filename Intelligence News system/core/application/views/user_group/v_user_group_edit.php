<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="user_group/edit/<?php echo $detail['ug_groupid'];?>" method="POST">
                <fieldset>
                <p>
                </p>

                <div class="form-group">
                    <div class="col-lg-5">
                        <input type="hidden" class="form-control" id="dp" name="ug_groupid" value="<?php echo $detail['ug_groupid']; ?>"/>
                      
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อกลุ่มผู้ใช้งาน * : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="hidden" class="form-control"id="dp" name="ug_groupname" value="<?php echo $detail['ug_groupname']; ?>" />
                        <input type="text" disabled class="form-control"id="dp" name="ug_groupname" value="<?php echo $detail['ug_groupname']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ug_description" value="<?php echo $detail['ug_description']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิผู้ดูแลระบบ (Admin) : </label>
                    </div>
                    <div class="col-lg-4">
                        <?php if($detail['ug_isadmin']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_isadmin" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_isadmin" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                </div>
                
               <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการอ่านข้อมูล : </label>
                    </div>
                    <div class="col-lg-4">
                        <?php if($detail['ug_canread']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_canread" id="optionsRadios1" value="Y"<?php echo $check_t;?> > ให้สิทธิ</label>
                        <label><input type="radio" name="ug_canread" id="optionsRadios1" value="N" <?php echo $check_f;?> > ไม่ให้สิทธิ</label>
                    </div>
                    	
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการสร้างข้อมูล : </label>
                    </div>
                    <div class="col-lg-4">
                        <?php if($detail['ug_canadd']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_canadd" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_canadd" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการแก้ไขข้อมูล : </label>
                    </div>
                  <div class="col-lg-4">
                        <?php if($detail['ug_canadd']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_canedit" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_canedit" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการลบข้อมูล : </label>
                    </div>
                     <div class="col-lg-4">
                        <?php if($detail['ug_candelete']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_candelete" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_candelete" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                    </div>
               
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการคอมเม้น : </label>
                    </div>
                    <div class="col-lg-4">
                        <?php if($detail['ug_cancomment']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_cancomment" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_cancomment" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการค้นหาข้อมูล : </label>
                    </div>
                    <div class="col-lg-4">
                        <?php if($detail['ug_cansearch']=="Y"){
                            $check_t = "checked";
                            $check_f = "";
                        }else {$check_f = "checked";
                                $check_t = "";
                        }
                        ?>
                        <label><input type="radio" name="ug_cansearch" id="optionsRadios1" value="Y" <?php echo $check_t;?>> ให้สิทธิ</label>
                        <label><input type="radio" name="ug_cansearch" id="optionsRadios1" value="N" <?php echo $check_f;?>> ไม่ให้สิทธิ</label>
                    </div>
                </div>
        <?php 
             $data_session  = $this->session->all_userdata();
             if (isset($data_session['u_unitid']) && isset($data_session['ua_firstname'])){
                 $ua_firstname = $data_session['ua_firstname']; 
                 $u_unitid = $data_session['u_unitid'];
                 $ua_lastname =  $data_session['ua_lastname'];
                 $ua_userid = $data_session['ua_userid'];
             }
        ?>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กดปุ่มเพื่อบันทึก : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="hidden" class="form-control"id="dp" name="ug_updateddate" value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                        <input type="hidden" class="form-control"id="dp" name="ug_updatedby" value="<?php echo $ua_userid; ?>"/>
                        
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="<?= site_url('user_group/lists'); ?>" class="btn btn-default" >ยกเลิก</a>
                    </div>
                </div>
                
                </form>
                <?php //print_r($detail); ?>
    		</div>

        </div>
    </div>
</div>
