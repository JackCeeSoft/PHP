<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="unit/edit/<?php echo $detail['u_unitid']; ?>" method="POST">
                <fieldset>
                <p>
                </p>
 
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อระบบงาน : </label>
                    </div>
                    <div class="col-lg-5">
                         <input type="hidden" class="form-control"id="dp" name="u_unitid" value="<?php echo $detail['u_unitid']; ?>" />
                         <input type="hidden" class="form-control"id="dp" name="u_name" value="<?php echo $detail['u_name']; ?>" />
                         <input type="text" disabled class="form-control"id="dp" name="u_name" value="<?php echo $detail['u_name']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_description" value="<?php echo $detail['u_description']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> โค้ดในการอนุมัติ *:
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_approvecode" value="<?php echo $detail['u_approvecode']; ?>" required/>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กดปุ่มเพื่อบันทึก : </label>
                    </div>
                    <div class="col-lg-5">
                                <?php 
                                     $data_session  = $this->session->all_userdata();
                                     if (isset($data_session['u_unitid']) && isset($data_session['ua_firstname'])){
                                         $ua_firstname = $data_session['ua_firstname']; 
                                         $u_unitid = $data_session['u_unitid'];
                                         $ua_lastname =  $data_session['ua_lastname'];
                                     }
                                ?>
                        
                        <input type="hidden" class="form-control"id="dp" name="u_createddate" value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                        <input type="hidden" class="form-control"id="dp" name="u_updateddate" value="<?php echo date('Y-m-d H:i:s'); ?>"/>
                        <input type="hidden" class="form-control"id="dp" name="u_createdby" value="1"/>
                        <input type="hidden" class="form-control"id="dp" name="u_updatedby" value="1"/>
                        
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
                </form>
                
    		</div>

        </div>
    </div>
</div>
