<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
<div class="col-lg-12">
                <form class="form-horizontal" action="unit/add" method="POST">
                <fieldset>
                <p>
                </p>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อระบบงาน *: </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_name" value="" required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> คำอธิบาย :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_description" value=""/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> โค้ดในการอนุมัติ *:
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="u_approvecode" value="" required/>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กดปุ่มเพื่อบันทึก : </label>
                    </div>
        <?php 
             $data_session  = $this->session->all_userdata();
             if (isset($data_session['u_unitid']) && isset($data_session['ua_firstname'])){
                 $ua_firstname = $data_session['ua_firstname']; 
                 $u_unitid = $data_session['u_unitid'];
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