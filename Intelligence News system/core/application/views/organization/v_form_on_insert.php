<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="panel col-lg-12 center">
            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } ?>
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i> กรอกข้อมูลองค์กร</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <fieldset>
                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade active in" id="menu1">
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อองค์กร :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_fullnameth" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาไทย :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameth" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อภาษาอังกฤษ :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_fullnameen" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาอังกฤษ :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameen" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-success">บันทึก <i class="fa fa-arrow-right"></i></button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>

                                    <!-- profile3 -->


                                    <!-- profile1 -->


                                    <!-- profile2 -->

                                      
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>