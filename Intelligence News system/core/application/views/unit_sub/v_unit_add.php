<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
<div class="col-lg-12">
                <form class="form-horizontal" action="unit_sub/add" method="POST">
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
                            if(!isset($u_unitid)){
                                        $u_unitid = 5;
                            }
                            foreach ($unit as $values){
                                        ?>
                                    <option value="<?= $values['u_unitid']; ?>" <?= (isset($u_unitid) and $u_unitid == $values['u_unitid']) ? 'selected' : ''; ?>><?= $values['u_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">หน่วยงาน *: </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="s_name" value="" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ลำดับแสดงผล (3 หลัก): </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="s_seq" value="" maxlength="3" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="s_description" value=""/>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กดปุ่มเพื่อบันทึก : </label>
                    </div>
        <?php 
             $data_session  = $this->session->all_userdata();
             if (isset($data_session['s_unitid']) && isset($data_session['ua_firstname'])){
                 $ua_firstname = $data_session['ua_firstname']; 
                 $s_unitid = $data_session['s_unitid'];
                 $ua_lastname =  $data_session['ua_lastname'];
             }
        ?>
                    <div class="col-lg-5">
                         <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
                </form>
</div>
</div>
</div>         
 </div>