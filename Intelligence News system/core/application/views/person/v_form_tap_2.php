<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
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
                        <form class="form-horizontal" action="" method="POST">
                            <fieldset>
                                <br>

                                <ul class="nav nav-tabs margin0px">
                                    <li><a href="person/updateTap1/<?= $result['p_personid'];?>">ข้อมูลองค์กร</a></li>
                                    <li class="active"><a href="#profile3" data-toggle="tab" aria-expanded="true">ลำดับความเคลื่อนไหว</a></li>
                                    <li><a href="#profile1" data-toggle="tab" aria-expanded="false">รูปภาพ</a></li>
                                    <li><a href="#profile2" data-toggle="tab" aria-expanded="false">ความเคลื่อนไหว</a></li>
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade" id="menu1">
                                        <br>

                                        <div class="form-group">
                                            <div class="col-lg-12 blog-tag-data-inner">
                                                <img src="assets/img/mockup/no-image.gif" alt="">
                                            </div>
                                            <div class="col-lg-2 margin-top20px">
                                                <label class="control-label right">แนบรูปภาพ : </label>
                                            </div>
                                            <div class="col-lg-6 margin-top20px">
                                                <input class="form-control" type="file">
                                                <small>หมายเหตุ : รูปภาพที่ต้องการแนนต้องมีขนาดไม่เกิน 500 kb</small>
                                            </div>
                                        </div>

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
                                                <input class="form-control" name="o_shortnameen" value="" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-success">ถัดไป <i class="fa fa-arrow-right"></i></button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>

                                    <!-- profile3 -->
                                    <div class="tab-pane fade active in" id="profile3"> 
                                        <div class="panel col-lg-12">
                                            <div class="jumbotron"> 
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="ค้นหาลำดับความเคลื่อนไหว">
                                                        <span class="input-group-btn">
                                                        <br>
                                                        <button class="btn btn-default" type="button">ค้นหา</button>
                                                        </span>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="col-lg-10 col-lg-offset-2">
                                                <button type="submit" class="btn btn-success">ถัดไป <i class="fa fa-arrow-right"></i></button>
                                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                                            </div>
                                       </div>
                                    </div>

                                    <!-- profile1 -->
                                    <div class="tab-pane fade" id="profile1"> 
                                        <div class="panel col-lg-12">
                                            <div class="jumbotron text_align_center">
                                                <div class="form-group blog-tag-data-inner"> 
                                                    <img src="assets/img/mockup/7.jpg" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <label class="control-label right"> แนบรูปภาพ : </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-7">
                                                         <input class="form-control" type="file">
                                                         <small>หมายเหตุ : รูปภาพที่ต้องการแนนต้องมีขนาดไม่เกิน 500 kb</small>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <button type="submit" class="btn btn-success">ถัดไป <i class="fa fa-arrow-right"></i></button>
                                                    <button type="reset" class="btn btn-default">ยกเลิก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- profile2 -->
                                    <div class="tab-pane fade" id="profile2">
                                        <br>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดความเคลื่อนไหว  : </label>
                                            </div>
                                            
                                            <div class="col-lg-9">
                                            <textarea class="ckeditor" name="editor1"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>
                                      
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>