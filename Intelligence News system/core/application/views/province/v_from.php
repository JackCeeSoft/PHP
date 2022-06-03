<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        
        <div class="panel panel-default col-lg-12 center">
           
<div class="col-lg-12">
                <form class="form-horizontal" action="projecttype/add" method="POST">
                <fieldset>
                <p>
                </p>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อจังหวัด * : </label>
                    </div>
                    <div class="col-lg-5">
                        
                            <input type="text" class="form-control" name="pt_name" <?= (isset($result['pt_name']) and $result['pt_name']) ? 'value="'.$result['pt_name'].'"' : ''; ?> required />
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Category Name *  : </label>
                    </div>
                    <div class="col-lg-5">
                        <select class="form-control" name="ct_province_id">
<!--                            <option value="0">== เลือกทั้งหมด ==</option>-->
                            <?php 
                            foreach ($province as $v_pt){
                                ?>
                            <option value="<?= $v_pt['ct_province_id']; ?>" <?= (isset($result['ct_province_id']) and $result['ct_province_id'] == $v_pt['ct_province_id']) ? 'selected' : ''; ?>><?= $v_pt['ct_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> Description : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="pt_description" <?= (isset($result['pt_description']) and $result['pt_description']) ? 'value="'.$result['pt_description'].'"' : ''; ?>/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">  </label>
                    </div>
                    <div class="col-lg-5">
                        <input type='submit' id='check_username_availability' class="btn btn-primary" value='Submit'>
                        <a href="<?= site_url('projecttype/lists'); ?>" class="btn btn-default">ยกเลิก</a>
                      
                    </div>
                </div>
                </form>
    </div>
       </div>
    </div>
    </div>