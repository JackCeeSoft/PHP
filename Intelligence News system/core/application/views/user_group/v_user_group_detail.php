<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-9">
                <fieldset>
                <p>
                </p>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ไอดี : </label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="dp" name="ug_groupid" value="<?php echo $detail['ug_groupid']; ?>" disabled/>
                    
                    </div>
                    
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อกลุ่มผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_groupname" value="<?php echo $detail['ug_groupname']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_description" value="<?php echo $detail['ug_description']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ผู้ดูแลระบบ (Admin) : </label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control" name="ug_isadmin" disabled>
                            <option  value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการอ่านข้อมูล : </label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control" name="ug_canread" disabled>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการสร้างข้อมูล : </label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control" name="ug_canadd" disabled>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการแก้ไขข้อมูล : </label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control" name="ug_canedit" disabled>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> สิทธิในการลบข้อมูล : </label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control" name="ug_candelete" disabled>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
               
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Createddate :
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_createddate" value="<?php echo $detail['ug_createddate']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Createdby :
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_createdby" value="<?php echo $detail['ug_createdby']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Updateddate :
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_updateddate" value="<?php echo $detail['ug_updateddate']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Updatedby :
                    </div>
                    <div class="col-lg-10">
                        <input type="text" class="form-control"id="dp" name="ug_updatedby" value="<?php echo $detail['ug_updatedby']; ?>" disabled/>
                    </div>
                </div>
                
                <br><p></p><br>
                <?php //print_r($detail); ?>
            </div>

        </div>
    </div>
</div>
