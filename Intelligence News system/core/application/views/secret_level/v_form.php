<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                    <fieldset>
                        <p>
                        </p>
                        
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ชื่อชั้นความลับ* : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="sl_name" <?= (isset($result['sl_name']) and $result['sl_name']) ? 'value="'.$result['sl_name'].'"' : ''; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำอธิบายเพิ่มเติม : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="sl_description" <?= (isset($result['sl_description']) and $result['sl_description']) ? 'value="'.$result['sl_description'].'"' : ''; ?>>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="<?= site_url('secret_level/lists'); ?>" class="btn btn-default">ยกเลิก</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>