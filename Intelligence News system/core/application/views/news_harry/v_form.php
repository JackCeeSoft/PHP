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
                                <label class="control-label right"> ชื่อก่อกวน* : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="nh_name" <?= (isset($result['nh_name']) and $result['nh_name']) ? 'value="'.$result['nh_name'].'"' : ''; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำอธิบายเพิ่มเติม : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="nh_description" <?= (isset($result['nh_description']) and $result['nh_description']) ? 'value="'.$result['nh_description'].'"' : ''; ?>>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="<?= site_url('news_harry/lists'); ?>" class="btn btn-default">ยกเลิก</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>