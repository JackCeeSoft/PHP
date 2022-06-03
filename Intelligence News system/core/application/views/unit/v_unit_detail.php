<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">

                <fieldset>
                <p>
                </p>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ไอดี : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" id="dp" name="" value="<?php echo $detail['u_unitid']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อระบบงาน : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_name" value="<?php echo $detail['u_name']; ?>" disabled />
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_description" value="<?php echo $detail['u_description']; ?>" disabled/>
                    </div>
                </div>
                <br><p></p><br>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> โค้ดในการอนุมัติ : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_name" value="<?php echo $detail['u_approvecode']; ?>" disabled />
                    </div>
                </div>
               
    		</div>

        </div>
    </div>
</div>
