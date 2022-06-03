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
                                <label class="control-label right"> ชื่อความเคลื่อนไหวของข่าว* : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="ru_name" <?= (isset($result['nm_name']) and $result['nm_name']) ? 'value="'.$result['nm_name'].'"' : ''; ?> <?= (isset($look) and $look) ? 'disabled' : ''; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำอธิบายเพิ่มเติม : </label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" name="ru_description" <?= (isset($result['nm_description']) and $result['nm_description']) ? 'value="'.$result['nm_description'].'"' : ''; ?> <?= (isset($look) and $look) ? 'disabled' : ''; ?>>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="<?= site_url('news_movement/lists'); ?>" class="btn btn-default">ยกเลิก</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>