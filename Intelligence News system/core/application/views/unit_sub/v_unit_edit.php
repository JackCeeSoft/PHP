<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="unit_sub/edit/" method="POST">
                <fieldset>
                <p>
                </p>
 
                 <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">เลือกระบบงาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" name="u_unitid">
<!--                            <option value="0">== เลือกทั้งหมด ==</option>-->
                            <?php 
                            foreach ($unit as $values){
                                ?>
                            <option value="<?php echo $values['u_unitid'];?>"><?php echo $values['u_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">หน่วยงาน : </label>
                    </div>
                    <div class="col-lg-5">
                         <input type="hidden" class="form-control"id="dp" name="s_unitsub_id" value="<?php echo $detail['s_unitsub_id']; ?>" />
                         <input type="hidden" class="form-control"id="dp" name="s_name" value="<?php echo $detail['s_name']; ?>" />
                         <input type="text" disabled class="form-control"id="dp" name="s_name" value="<?php echo $detail['s_name']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ลำดับแสดงผล (3 หลัก): </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="s_seq" value="<?php echo $detail['s_seq']; ?>" maxlength="3" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="s_description" value="<?php echo $detail['s_description']; ?>" />
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กดปุ่มเพื่อบันทึก : </label>
                    </div>
                    <div class="col-lg-5">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
                </form>
                
    		</div>

        </div>
    </div>
</div>
