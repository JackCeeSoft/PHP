<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="col-lg-12 center">
            <ul class="nav nav-tabs">
                <li>
                    <a data-toggle="tab" data-tabid="1" href="#subject">หัวเรื่อง</a>
                </li>
                <?php if(isset($result) and $result) { ?>
                    <li>
                        <a data-toggle="tab" data-tabid="2" href="#description">รายละเอียดข่าว</a>
                    </li>
                <?php } ?>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade in" id="subject">
                    <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bars"></i> หัวเรื่อง</h3>
                        </div>
                        <form action="" id="subject" class="form-horizontal section" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="section" value="subject">
                            <fieldset>
                                <br>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">   </label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="radio" name="type_news" value="N" checked <?= (isset($result['type_news']) and trim($result['type_news']) == 'N') ? 'checked' : '';?>>
                                            <label class="control-label"> รายงานห้วง ระยะเวลา </label>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <input type="radio" name="type_news" value="W" <?= (isset($result['type_news']) and trim($result['type_news']) == 'W') ? 'checked' : '';?>>
                                            <label class="control-label"> รายงานแจ้งเตือน </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="radio" name="type_news" value="D"  <?= (isset($result['type_news']) and trim($result['type_news']) == 'D') ? 'checked' : '';?>>
                                            <label class="control-label"> รายงานด่วน </label>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label class="control-label right">ประเภทรายงาน : *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            
                                            <select class="form-control required" id="rt_reporttypeid" name="rt_reporttypeid" required>
                                                
                                                <?php foreach ($report_type as $v_rt) { ?>
                                                    <?php 
                                                        if($v_rt['rt_reporttypeid'] == 5){?>
                                                            <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                                    <?php   }
                                                    ?>
                                                <?php } ?>
                                                
                                                
                                                <?php foreach ($report_type as $v_rt) { ?>
                                                    <?php 
                                                        if($v_rt['rt_reporttypeid'] != 5){?>
                                                            <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                                    <?php   }
                                                    ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group type type-2">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> ส่วนราชการ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_government" <?= (isset($result['n_government']) and $result['n_government']) ? 'value="'.$result['n_government'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type type-3">
                                        <div class="col-lg-3">
                                            <label class="control-label right">ความเร่งด่วน :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control required" name="hl_hastelevelid" required>
                                                <?php foreach ($haste_level as $v_hl) { ?>
                                                    <option value="<?= $v_hl['hl_hastelevelid']; ?>" <?= (isset($result['hl_hastelevelid']) and $result['hl_hastelevelid'] == $v_hl['hl_hastelevelid']) ? 'selected' : ''; ?>><?= $v_hl['hl_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right">ชั้นความลับ :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control required" name="sl_secretid" required>
                                                <?php foreach ($secret_level as $v_sl) { ?>
                                                    <?php if(isset($result['sl_secretid']) and $result['sl_secretid']) { ?>
                                                        <option value="<?= $v_sl['sl_secretid']; ?>" <?= ($result['sl_secretid'] == $v_sl['sl_secretid']) ? 'selected' : ''; ?>><?= $v_sl['sl_name']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $v_sl['sl_secretid']; ?>" <?= ($v_sl['sl_secretid'] == 2) ? 'selected' : ''; ?>><?= $v_sl['sl_name']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> ที่ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_place" <?= (isset($result['n_place']) and $result['n_place']) ? 'value="'.$result['n_place'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right">วันที่ :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-append date required" id="datetimepicker1">
                                                <input data-format="yyyy-MM-dd" type="text" name="n_date" required <?= (isset($result['n_date']) and $result['n_date']) ? 'value="'.$result['n_date'].'"' : ''; ?>>
                                                <span class="add-on">
                                                    <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right">เวลา :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-append date required" id="datetimepicker2">
                                                <input data-format="hh:mm" type="text" name="n_time" required <?= (isset($result['n_time']) and $result['n_time']) ? 'value="'.substr($result['n_time'],0,-3).'"' : ''; ?>>
                                                <span class="add-on">
                                                    <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-time">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right">เรื่อง :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input maxlength="100" class="form-control required" name="n_subject" required <?= (isset($result['n_subject']) and $result['n_subject']) ? 'value="'.$result['n_subject'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> เรียน : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_to" <?= (isset($result['n_to']) and $result['n_to']) ? 'value="'.$result['n_to'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type type-3">
                                        <div class="col-lg-3">
                                            <label class="control-label right">ผู้รับทราบ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="n_aware"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type"><!-- ชื่อผู้เขียนข่าว -->
                                        <div class="col-lg-3">
                                            <label class="control-label right">ผู้รวบรวมและรายงานข่าว <b class="red">*</b> : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control required" name="n_writer" readonly required value="<?= $firstname." ".$lastname ?>">
                                        </div>
                                    </div>
                                    
<!--                                    <div class="form-group type type-2 type-3">
                                        <div class="col-lg-3">
                                            <label class="control-label right">ชื่อผู้อนุมัติข่าว :  </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_approver" id="n_approver" <?= (isset($result['n_approver']) and $result['n_approver']) ? 'value="'.$result['n_approver'].'"' : ''; ?>>
                                        </div>
                                    </div>-->

                                    <div class="form-group type type-2">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> สิ่งที่แนบมาด้วย : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="n_attachdetail"><?= (isset($result['n_attachdetail']) and $result['n_attachdetail']) ? $result['n_attachdetail'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type type-2">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> รายละเอียดสรุปข่าว : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="n_detailconclusion"><?= (isset($result['n_detailconclusion']) and $result['n_detailconclusion']) ? $result['n_detailconclusion'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type type-2">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> อ้างถึง : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_reference" <?= (isset($result['n_reference']) and $result['n_reference']) ? 'value="'.$result['n_reference'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-3">
                                            <label class="control-label right">รหัสยืนยันข่าว :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control required" name="n_approvercode" id="n_approvercode" required autocomplete="off" <?= (isset($result['n_approvercode']) and $result['n_approvercode']) ? 'value="'.$result['n_approvercode'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="col-lg-10 col-lg-offset-2">
                                        <?php if(isset($result['n_newsid']) and $result['n_newsid']) { ?>
                                            <a href="<?= site_url('news/detail_pdf/'.$result['n_newsid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด PDF</a> 
                                            <a href="<?= site_url('news/detail_word/'.$result['n_newsid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด Word</a> 
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success">ถัดไป <i class="fa fa-arrow-right"></i></button>
                                        <a href="<?= site_url('news/lists'); ?>" class="btn btn-default">กลับไปหน้ารายการข่าว</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="description">
                    <br>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bars"></i> รายละเอียด</h3>
                        </div>

                        <form action="" id="paragraph" class="form-horizontal section" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="section" value="paragraph">
                            <?php if(isset($result['n_newsid']) and $result['n_newsid']) { ?>
                                <input type="hidden" name="n_newsid" value="<?= $result['n_newsid']; ?>">
                            <?php } ?>
                            <fieldset>
                                <br>
                                <div class="panel-body">
                                    
                                    <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 5)) { ?>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">หัวข้อข่าว : </label><!-- เรื่อง -->
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="np_topicforindex" <?= (isset($result_paragraph['np_topicforindex']) and $result_paragraph['np_topicforindex']) ? 'value="'.$result_paragraph['np_topicforindex'].'"' : ''; ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ลักษณะการก่อเหตุ : *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="nc_newscauseid" id="nc_newscauseid" required>
                                                    <option value="0">กรุณาเลือกลักษณะการก่อเหตุ</option>
                                                    <?php foreach ($news_cause as $v_nc) { ?>
                                                        <option value="<?= $v_nc['nc_newscauseid']; ?>" data-harry="<?= $v_nc['nc_harry']; ?>" data-execution="<?= $v_nc['nc_execution']; ?>" <?= (isset($result_paragraph['nc_newscauseid']) and $result_paragraph['nc_newscauseid'] == $v_nc['nc_newscauseid']) ? 'selected' : ''; ?>><?= $v_nc['nc_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group hide" id="newsharry">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ก่อกวน : *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="nh_newsharryid" id="nh_newsharryid" required>
                                                    <option value="0">กรุณาเลือกลักษณะการก่อกวน</option>
                                                    <?php foreach ($news_harry as $v_nh) { ?>
                                                        <option value="<?= $v_nh['nh_newsharryid']; ?>" <?= (isset($result_paragraph['nh_newsharryid']) and $result_paragraph['nh_newsharryid'] == $v_nh['nh_newsharryid']) ? 'selected' : ''; ?>><?= $v_nh['nh_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group hide" id="newsexecution">
                                            <div class="col-lg-3">
                                                <label class="control-label right">การปฏิบัติของฝ่ายเรา : *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="ne_newsexecutionid" id="ne_newsexecutionid" required>
                                                    <option value="0">กรุณาเลือกลักษณะการปฏิบัติของฝ่ายเรา</option>
                                                    <?php foreach ($news_execution as $v_ne) { ?>
                                                        <option value="<?= $v_ne['ne_newsexecutionid']; ?>" <?= (isset($result_paragraph['ne_newsexecutionid']) and $result_paragraph['ne_newsexecutionid'] == $v_ne['ne_newsexecutionid']) ? 'selected' : ''; ?>><?= $v_ne['ne_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">จังหวัด : *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="province_id" id="province_id" required>
                                                    <option value="0">กรุณาเลือกจังหวัด</option>
                                                    <?php foreach ($province as $v_p) { ?>
                                                        <option value="<?= $v_p['province_id']; ?>" <?= (isset($result_paragraph['np_newsprovinceid']) and $result_paragraph['np_newsprovinceid'] == $v_p['province_id']) ? 'selected' : ''; ?>><?= $v_p['province_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">อำเภอ : *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="amphur_id" id="amphur_id" required>
                                                    <option value="0">กรุณาเลือกอำเภอ</option>
                                                    <?php /*foreach ($amphur as $v_a) { ?>
                                                        <option data-province="<?= $v_a['province_id']; ?>" value="<?= $v_a['amphur_id']; ?>" <?= (isset($result_paragraph['amphur_id']) and $result_paragraph['amphur_id'] == $v_a['amphur_id']) ? 'selected' : ''; ?>><?= $v_a['amphur_name']; ?></option>
                                                    <?php }*/ ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ตำบล : </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="district_id" id="district_id">
                                                    <option value="0">กรุณาเลือกตำบล</option>
                                                    <?php /*foreach ($district as $v_d) { ?>
                                                        <option data-amphur="<?= $v_d['amphur_id']; ?>" value="<?= $v_d['district_id']; ?>" <?= (isset($result_paragraph['district_id']) and $result_paragraph['district_id'] == $v_d['district_id']) ? 'selected' : ''; ?>><?= $v_d['district_name']; ?></option>
                                                    <?php }*/ ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="form-group type mb-5">
                                        <label class="col-lg-2"></label>
                                        <div class="form-group mb-0">
                                            <div class="col-lg-5">
                                                <?= (isset($result_paragraph['np_mainimage']) and $result_paragraph['np_mainimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->paragraph_images_path . $result_paragraph['np_paragraph_id'] . '/' . $result_paragraph['np_mainimage']) . '" /><a class="btn btn-danger" title="ลบ" id="del_img"><i class="fa fa-trash-o"></i> Delete</a></div><input id="del" type="hidden" name="del" value="0" />' : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label class="control-label right"> รูปภาพเพื่อแสดงเป็นภาพ Preview : </label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-5">
                                                <input class="form-control" type="file" id="image_file" name="image_file">
                                                <span class="form-comment">กว้าง 700 px * สูง 380 px นามสกุลไฟล์ jpg/png/gif</span>
                                            </div>
                                            <div class="col-lg-1">
                                                <button class="btn btn-default" type="reset">ล้างค่า</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type mb-5">
                                        <label class="col-lg-3"></label>
                                        <div class="form-group mb-0">
                                            <div class="col-lg-5">
                                                <?php if(isset($attach) and $attach) { ?>
                                                    <table class="table table-attach mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>ชื่อไฟล์</th>
                                                                <th class="text-center">ลบ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($attach as $k_attach => $v_attach) { ?>
                                                                <tr>
                                                                    <th scope="row"><?= ($k_attach + 1); ?>.</th>
                                                                    <td><?= $v_attach['nf_path']; ?></td>
                                                                    <td class="text-center">
                                                                        <input type="checkbox" name="del_attach[]" value="<?= $v_attach['nf_fileattachid']; ?>">
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label class="control-label right">เอกสารแนบ : </label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-10 group-attach-file">
                                                        <input class="form-control attach_file" type="file" name="attach_file[]">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button class="btn btn-success mt--25" id="add_more_file">เพิ่มไฟล์</button>
                                                    </div>
                                                </div>
                                                <span class="form-comment">นามสกุลไฟล์ doc/docx/dot/dotx/xls/xlsx/pdf/ppt/rar/zip</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label class="control-label right">รายละเอียดข่าว :  *</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <textarea class="ckeditor" name="np_paragraph" required><?= (isset($result_paragraph['np_paragraph']) and $result_paragraph['np_paragraph']) ? $result_paragraph['np_paragraph'] : ''; ?></textarea>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal05" style="position: relative; top: -23px; left: 5px;"><i class="fa fa-image"></i> ใส่ภาพ</button>
                                            <div id="myModal05" class="modal fade paragraph-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <iframe src="<?= site_url('news/manageGallery/'.$result['n_newsid'].'?popup=1'); ?>"  width="100%" height="90%" frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

<!--                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label class="control-label right">คีย์เวิร์ด : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_keyword" id="n_keyword" placeholder="คีย์เวิร์ด" <?= (isset($result['n_keyword']) and $result['n_keyword']) ? 'value="'.$result['n_keyword'].'"' : ''; ?>>
                                        </div>
                                    </div>-->
                                    
                                    <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 5)) { ?>
                                        <!------------------------- news person5 ------------------------->
                                        <?php if(isset($news_person) && $news_person) { ?>
                                            <div class="form-group">
                                                <div class="col-lg-1">
                                                    <h3 class="blue">บุคคล </h3>
                                                </div>
                                                <div class="col-lg-5">
                                                <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td class="col-lg-2 blue">ลำดับ</td>
                                                        <td class="col-lg-4 blue">บุคคล</td>
                                                        <td class="col-lg-1 blue">สูญเสีย</td>
                                                        <td class="col-lg-1 blue">บาดเจ็บ</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($relate_person) && $relate_person) { ?>
                                                        <?php foreach ($relate_person as $k_rp => $v_rp) { ?>
                                                            <?php $new_relate_person[$v_rp['np_newspersonid']] = $v_rp; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php foreach ($news_person as $k_ps => $v_ps) { ?>
                                                        <tr>
                                                            <td><?= $k_ps + 1; ?></td>
                                                            <td><?= $v_ps['np_person']; ?></td>
                                                            <?php $nr_injuries = (isset($new_relate_person[$v_ps['np_newspersonid']]['nr_injuries']) && $new_relate_person[$v_ps['np_newspersonid']]['nr_injuries']) ? 'value="' . $new_relate_person[$v_ps['np_newspersonid']]['nr_injuries'] . '"' : 'value="0"'; ?>
                                                            <td><input onkeypress="inputOnlyNumber(event);" <?= $nr_injuries; ?> name="relate_person[<?= $v_ps['np_newspersonid']; ?>][nr_injuries]"  class="form-control"></td>
                                                            <?php $nr_lose = (isset($new_relate_person[$v_ps['np_newspersonid']]['nr_lose']) && $new_relate_person[$v_ps['np_newspersonid']]['nr_lose']) ? 'value="' . $new_relate_person[$v_ps['np_newspersonid']]['nr_lose'] . '"' : 'value="0"'; ?>
                                                            <td><input onkeypress="inputOnlyNumber(event);" <?= $nr_lose; ?> name="relate_person[<?= $v_ps['np_newspersonid']; ?>][nr_lose]" class="form-control"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        <?php } ?>
                                        <!------------------------- news person5 ------------------------->
                                        
                                        <!-------------------------- news gun5 --------------------------->
                                        <?php if(isset($news_gun) && $news_gun) { ?>
                                        
                                                <div class="col-lg-1">
                                                    <h3 class="blue">ปืน </h3>
                                                </div>
                                                <div class="col-lg-5">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td class="col-lg-2 blue">ลำดับ</td>
                                                        <td class="col-lg-4 blue">ปืน</td>
                                                        <td class="col-lg-1 blue">ยึดคืน</td>
                                                        <td class="col-lg-1 blue">ยึดไป</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($relate_gun) && $relate_gun) { ?>
                                                        <?php foreach ($relate_gun as $k_rg => $v_rg) { ?>
                                                            <?php $new_relate_gun[$v_rg['ng_newsgunid']] = $v_rg; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php foreach ($news_gun as $k_g => $v_g) { ?>
                                                        <tr>
                                                            <td><?= $k_g + 1; ?></td>
                                                            <td><?= $v_g['ng_gun']; ?></td>
                                                            <?php $nr_holdreturn = (isset($new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn']) && $new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn']) ? 'value="' . $new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn'] . '"' : 'value="0"'; ?>
                                                            <td><input onkeypress="inputOnlyNumber(event);" <?= $nr_holdreturn; ?> name="relate_gun[<?= $v_g['ng_newsgunid']; ?>][nr_holdreturn]" class="form-control"></td>
                                                            <?php $nr_hold = (isset($new_relate_gun[$v_g['ng_newsgunid']]['nr_hold']) && $new_relate_gun[$v_g['ng_newsgunid']]['nr_hold']) ? 'value="' . $new_relate_gun[$v_g['ng_newsgunid']]['nr_hold'] . '"' : 'value="0"'; ?>
                                                            <td><input onkeypress="inputOnlyNumber(event);" <?= $nr_hold; ?> name="relate_gun[<?= $v_g['ng_newsgunid']; ?>][nr_hold]" class="form-control"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-------------------------- news gun5 --------------------------->
                                        
                                        <!------------------------ news practice5 ------------------------>
                                        <?php if(isset($news_practice) && $news_practice) { ?>
                                        <div class="form-group">   
                                        <div class="col-lg-1">
                                            <h3 class="blue">ปฏิบัติ </h3>
                                        </div>
                                        <div class="col-lg-5">  
                                        <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td class="col-lg-2 blue">ลำดับ</td>
                                                        <td class="col-lg-5 blue">การปฏิบัติ</td>
                                                        <td class="col-lg-1 blue">จำนวน</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($relate_practice) && $relate_practice) { ?>
                                                        <?php foreach ($relate_practice as $k_rpa => $v_rpa) { ?>
                                                            <?php $new_relate_practice[$v_rpa['np_newspracticeid']] = $v_rpa; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php foreach ($news_practice as $k_pt => $v_pt) { ?>
                                                        <tr>
                                                            <td><?= $k_pt + 1; ?></td>
                                                            <td><?= $v_pt['np_practice']; ?></td>
                                                            <?php $nr_amount = (isset($new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount']) && $new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount']) ? 'value="' . $new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount'] . '"' : 'value="0"'; ?>
                                                            <td><input onkeypress="inputOnlyNumber(event);" <?= $nr_amount; ?> name="relate_practice[<?= $v_pt['np_newspracticeid']; ?>][nr_amount]" class="form-control"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                        <?php } ?>
                                        <!------------------------ news practice5 ------------------------>
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <h3 class="blue">ระเบิด </h3>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ระเบิดที่ทำงานสมบูรณ์ :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input onkeypress="inputOnlyNumber(event);" class="form-control" name="n_dynamitecomplete" <?= (isset($result['n_dynamitecomplete']) and $result['n_dynamitecomplete']) ? 'value="'.$result['n_dynamitecomplete'].'"' : ''; ?>>
                                            </div>
                                            <div class="col-lg-1">ลูกแท่ง</div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ระเบิดที่เจ้าหน้าที่สามารถเก็บกู้ได้ :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input onkeypress="inputOnlyNumber(event);" class="form-control" name="n_dynamitestop" <?= (isset($result['n_dynamitestop']) and $result['n_dynamitestop']) ? 'value="'.$result['n_dynamitestop'].'"' : ''; ?>>
                                            </div>
                                            <div class="col-lg-1">ลูกแท่ง</div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">หน่วย :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="n_unit" <?= (isset($result['n_unit']) and $result['n_unit']) ? 'value="'.$result['n_unit'].'"' : ''; ?>>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">ผบ.หน่วย :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="n_headunit" <?= (isset($result['n_headunit']) and $result['n_headunit']) ? 'value="'.$result['n_headunit'].'"' : ''; ?>>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">หมายเหตุ :</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="n_remark" <?= (isset($result['n_remark']) and $result['n_remark']) ? 'value="'.$result['n_remark'].'"' : ''; ?>>
                                            </div>
                                        </div>

                                        <br><br>
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="col-lg-3">
                                                    <label class="control-label right">ประเภทระเบิดและการจุดระเบิด :</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control" id="dt_dynamitetypeid">
                                                        <option value="" >กรุณาเลือกประเภทระเบิด</option>
                                                        <?php $new_dynamite_type = array(); ?>
                                                        <?php if(isset($dynamite_type) && $dynamite_type) { ?>
                                                            <?php foreach ($dynamite_type as $v_dt) { ?>
                                                                <option value="<?= $v_dt['dt_dynamitetypeid']; ?>" ><?= $v_dt['dt_name']; ?></option>
                                                                <?php $new_dynamite_type[$v_dt['dt_dynamitetypeid']] = $v_dt; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control" id="it_ignitiontypeid">
                                                        <option value="" >กรุณาเลือกการจุดระเบิด</option>
                                                        <?php $new_ignition_type = array(); ?>
                                                        <?php if(isset($ignition_type) && $ignition_type) { ?>
                                                            <?php foreach ($ignition_type as $v_it) { ?>
                                                                <option value="<?= $v_it['it_ignitiontypeid']; ?>" ><?= $v_it['it_name']; ?></option>
                                                                <?php $new_ignition_type[$v_it['it_ignitiontypeid']] = $v_it; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button type="button" class="btn btn-success" id="add_more_dynamitetable">เพิ่ม</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-7">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>ประเภทระเบิด</th>
                                                                <th>การจุดระเบิด</th>
                                                                <th style="text-align: center;">ลบ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="dynamitetable">
                                                            <?php if(isset($dynamitetable) && $dynamitetable) { ?>
                                                                <?php foreach ($dynamitetable as $k_dynamitetable => $v_dynamitetable) { ?>
                                                                    <tr>
                                                                        <td><?= $new_dynamite_type[$v_dynamitetable['dt_dynamitetypeid']]['dt_name']; ?></td>
                                                                        <td><?= $new_ignition_type[$v_dynamitetable['it_ignitiontypeid']]['it_name']; ?></td>
                                                                        <td class="text-center">
                                                                            <input type="checkbox" name="del_dynamitetable[]" value="<?= $v_dynamitetable['nd_dynamitetable_id']; ?>">
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </fieldset>
                                    <?php } ?>

                                    <?php if(isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] != 5) { ?>
                                        <div class="form-group">
                                            <div class="col-lg-3">
                                                <label class="control-label right">เพิ่มความเคลื่อนไหวข่าว : </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <a style="cursor: pointer;"><i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModal03"> ความเคลื่อนไหวข่าว</i></a>
                                                <br>
                                                <span class="selected-movement"></span>
                                            </div>

                                            <div id="myModal03" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class=" col-lg-7">
                                                                    <div class="row">
                                                                        <div class=" col-lg-12">
                                                                            <input type="text" class="form-control" id="movement_name" placeholder="ความเคลื่อนไหว"> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-lg-5">
                                                                    <button type="button" class="btn btn-primary add-movement">เพิ่มความเคลื่อนไหว <i class="fa fa-plus-circle"></i></button>
                                                                    <button type="button" class="btn btn-success close-modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                            <select multiple="multiple" size="10" id="movement" name="movement[]">
                                                                <?php if(isset($news_movement) and $news_movement) {?>
                                                                    <?php foreach ($news_movement as $v_movement) { ?>
                                                                        <?php if(isset($movemented) and $movemented) {?>
                                                                            <option value="<?= $v_movement['nm_newsmovementid']; ?>" <?= (array_search($v_movement['nm_newsmovementid'], $movemented) !== false) ? 'selected' : ''; ?>><?= $v_movement['nm_name']; ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="<?= $v_movement['nm_newsmovementid']; ?>" ><?= $v_movement['nm_name']; ?></option>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="col-lg-10 col-lg-offset-3">
                                        <?php if(isset($result_paragraph) and $result_paragraph) {?>
                                            <input type="hidden" name="paragraph_id" value="<?= $result_paragraph['np_paragraph_id']; ?>">
                                            <button type="submit" class="btn btn-primary paragraph-edit">แก้ไข</button>
                                            <a href="<?= site_url('news/update/'.$result['n_newsid'].'?tab=2'); ?>" class="btn btn-default">ยกเลิก</a>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-primary paragraph-save">บันทึก</button>
                                        <?php } ?>
                                        <a href="<?= site_url('news/lists'); ?>" class="btn btn-default">กลับไปหน้ารายการข่าว</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="col-lg-10 col-lg-offset-2">
                        <!--<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> ดูและพิมพ์</button>-->
                        <!--<button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด</button>-->
                        <!--<button type="submit" class="btn btn-primary">สิ้นสุดรายงาน</button>-->
                    </div>

                    <div style="clear:both;"></div>

                    <br>

                    <?php if(isset($paragraph) and $paragraph) { ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bars"></i> รายการข่าวย่อย</h3>
                            </div>

                            <div class="padding20px">
                                <fieldset>
                                    <div class="panel-body float_right">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="button" class="btn btn-primary paragraph-preview" data-toggle="modal" data-target="#myModal04">แสดงตัวอย่าง</button>
                                            <div id="myModal04" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn btn-success float_right close-modal">ปิด <i class="fa fa-plus-circle"></i></button>
                                                            <div class="clear"></div>
                                                            <iframe id="paragraph-preview" src=""  width="100%" height="90%" frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="clear"></div>-->

                                    <h2><a href="<?= site_url('news/detail/'.$result['n_newsid']); ?>"><?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : ''; ?></a></h2>
                                    <div class="border_box">
                                        <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 1 or $result['rt_reporttypeid'] == 5)) { ?>
                                            <div class="float_left padding_left_10px">
                                                <span>ประเภทรายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="float_left padding_left_10px">
                                                <span>ชั้นความลับ :
                                                </span>
                                                <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>ระบบ :
                                                </span>
                                                <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ที่ :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ชื่อผู้อนุมัติข่าว :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>เรียน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>วันที่รายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>เวลารายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                                                </span>
                                            </div>
                                        <?php } ?>

                                        <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] >= 2 and $result['rt_reporttypeid'] <= 4)) { ?>
                                            <div class="float_left padding_left_10px">
                                                <span>ประเภทรายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="float_left padding_left_10px">
                                                <span>ชั้นความลับ :
                                                </span>
                                                <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>ระบบ :
                                                </span>
                                                <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ที่ :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ชื่อผู้อนุมัติข่าว :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ผู้รวบรวมและรายงานข่าว :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_writer']) and $result['n_writer']) ? $result['n_writer'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>สิ่งที่แนบมาด้วย :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_attachdetail']) and $result['n_attachdetail']) ? $result['n_attachdetail'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>เรียน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>วันที่รายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>เวลารายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                                                </span>
                                            </div>
                                        <?php } ?>

                                        <?php if(isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == 6) { ?>
                                            <div class="float_left padding_left_10px">
                                                <span>ประเภทรายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="float_left padding_left_10px">
                                                <span>ชั้นความลับ :
                                                </span>
                                                <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="float_left padding_left_10px">
                                                <span>ความเร่งด่วน :
                                                </span>
                                                <span class="blue"><?= (isset($result['hl_name']) and $result['hl_name']) ? $result['hl_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>ระบบ :
                                                </span>
                                                <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>เรื่อง :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="float_left padding_left_10px">
                                                <span>เรียน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ที่ :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ผู้รับทราบ :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ชื่อผู้อนุมัติข่าว :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>ผู้รวบรวมและรายงานข่าว :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_writer']) and $result['n_writer']) ? $result['n_writer'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>วันที่รายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="padding_left_10px">
                                                <span>เวลารายงาน :
                                                </span>
                                                <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <br>

                                    <?php foreach ($paragraph as $v_p) { ?>
                                        <div class="span13 blog-article float_left">
                                            <?//= stripHTMLTags($v_p['np_paragraph']); ?>
                                            <div><?= $v_p['np_paragraph']; ?></div>
                                        </div>
                                        <div class="span2 blog-article float_right">
                                            <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] != 5)) { ?>
<!--                                                <a class="blue" href="<?= site_url('news/update/'.$result['n_newsid'].'/'.$v_p['np_paragraph_id'].'?tab=2'); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="blue del-paragraph del" href="<?= site_url('news/deleteParagraph/'.$result['n_newsid'].'/'.$v_p['np_paragraph_id']); ?>"><i class="fa fa-trash"></i></a>-->
                                            <?php } ?>
                                        </div>
                                        <div class="clear"></div>
                                        <hr>
                                    <?php } ?>

                                </fieldset>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>    
        </div>
    </div>
</div>
<script>
    $(function() {
        //CKEDITOR.instances.np_paragraph.insertText('some text here');
        //CKEDITOR.on( 'instanceReady', function( ev ) {
            //ev.editor.setData('<span style="font-family:Arial, Verdana, sans-serif;">&shy;</span>');
        //});
        chkReporttype();
        getSelectedNewscause();
        <?php if(empty($result)) { ?>
            setTimeout(function(){
                $("input#n_approvercode").attr("type","password");
            },500);
        <?php } else { ?>
            setTimeout(function(){
                $("input#n_approvercode").attr("type","password");
            },10);
        <?php } ?>
        <?php if(isset($result_paragraph) and $result_paragraph) { ?>
            getSelected();
        <?php } ?>
        $('#rt_reporttypeid').change(function() {
            chkReporttype();
        });
        
        <?php if(isset($result) and $result) { ?>
            $('a[data-tabid="2"]').click(function(){
                updateReportType(<?= $result['n_newsid']; ?>, function() {
                    window.location.href = '<?= base_url('news/update/' . $result['n_newsid'] . '?tab=2'); ?>';
                });
            });
        <?php } ?>
        $('#subject').submit(function() {
            var chk = false;
            $.ajax({
                method: "POST",
                url: "<?= site_url('news/checkApproveCode'); ?>",
                data: { n_approvercode: $('#n_approvercode').val() },
                async: false,
                success : function( data ) {
                    if(data != 'true') {
                        alert('รหัสยืนยันข่าวไม่ถูกต้อง กรุณาตรวจสอบ');
                        chk = false;
                    } else 
                        chk = true;
                }
            });
            if(chk != true)
                return false;
        });
//        $('#paragraph').submit(function() {
//            editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getText();
//            if($.trim(editor_val) == '') {
//                alert('กรุณาใส่รายละเอียดข่าว');
//                return false;
//            }
//        });
        $('a#del_img').click(function() {
            var c = confirm('ลบรูปภาพ!?');
            if (c) {
                $('div#thumb').hide();
                $('input#del').val(1);
            } else
                return false;
        });
        $('#add_more_file').click(function() {
            $('.group-attach-file').append('<input class="form-control attach_file" type="file" name="attach_file[]">');
            return false;
        });
        var key_dynamitetable = 0;
        $('#add_more_dynamitetable').click(function() {
            if($('#dt_dynamitetypeid option:selected').val() == '' || $('#it_ignitiontypeid option:selected').val() == '') {
                alert('กรุณา เลือกประเภทระเบิด หรือ การจุดระเบิด');
            } else {
                var html = ''
                + '<tr>'
                + '<td>' + $('#dt_dynamitetypeid option:selected').html() + '<input type="hidden" name="dynamitetable['+key_dynamitetable+'][dt_dynamitetypeid]" value="' + $('#dt_dynamitetypeid option:selected').val() + '" /></td>'
                + '<td>' + $('#it_ignitiontypeid option:selected').html() + '<input type="hidden" name="dynamitetable['+key_dynamitetable+'][it_ignitiontypeid]" value="' + $('#it_ignitiontypeid option:selected').val() + '" /></td>'
                + '<td style="text-align: center;"><a href="#" class="cancel_dynamitetable">ยกเลิก</a></td>'
                + '</tr>'
                $('tbody.dynamitetable').append(html);
                key_dynamitetable++;
                $('a.cancel_dynamitetable').click(function(){
                    $(this).parent().parent().remove();
                    return false;
                });
            }
            return false;
        });
        
        /*------------------------ datetimepicker ------------------------*/
        $('#datetimepicker1').datetimepicker({
            language: 'th',
            endDate: new Date('<?= date('Y-m-d'); ?>')
        });
        $('#datetimepicker2').datetimepicker({
            pickDate: false,
            pickSeconds: false,
        });
        /*------------------------ datetimepicker ------------------------*/
        
        /*------------------------- modal control ------------------------*/
        $('.close-modal').click(function(){
            $('.modal').modal('hide');
        });
        $('.modal').on('hidden.bs.modal', function (e) {
            getSelected();
        });
        /*------------------------- modal control ------------------------*/
        
        /*----------------------- manage paragraph -----------------------*/
        $('button.paragraph-save').click(function(){
            var flag_attach_file = 0;
            $( ".attach_file" ).each(function( index ) {
                var attach_file = $( this ).val();
                if(attach_file != '') {
                    var attach_file_ext = attach_file.split('.').pop();
                    if(!(attach_file_ext == 'doc' || attach_file_ext == 'docx' || attach_file_ext == 'dot'|| attach_file_ext == 'dotx' || attach_file_ext == 'xls' || attach_file_ext == 'xlsx' || attach_file_ext == 'pdf' || attach_file_ext == 'ppt' || attach_file_ext == 'rar' || attach_file_ext == 'zip')) {
                        flag_attach_file = 1;
                    }
                }
            });
            if(flag_attach_file == 1) {
                alert('นามสกุลไฟล์ "เอกสารแนบ" ไม่ถูกต้อง');
                return false;
            }
            
            <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 5)) { ?>
                if(!$('#nc_newscauseid option:selected').val() || $('#nc_newscauseid option:selected').val() == 0) {
                    alert('กรุณาเลือกลักษณะการก่อเหตุ');
                    return false;
                }
                
                if(!$('#newsharry').hasClass('hide') && (!$('#nh_newsharryid option:selected').val() || $('#nh_newsharryid option:selected').val() == 0)) {
                    alert('กรุณาเลือกการก่อกวน');
                    return false;
                }
                
                if(!$('#newsexecution').hasClass('hide') && (!$('#ne_newsexecutionid option:selected').val() || $('#ne_newsexecutionid option:selected').val() == 0)) {
                    alert('กรุณาเลือกการปฏิบัติของฝ่ายเรา');
                    return false;
                }
                
                if(!$('#province_id option:selected').val() || $('#province_id option:selected').val() == 0) {
                    alert('กรุณาเลือกจังหวัด');
                    return false;
                }
                
                if(!$('#amphur_id option:selected').val() || $('#amphur_id option:selected').val() == 0) {
                    alert('กรุณาเลือกตำบล');
                    return false;
                }
            <?php } ?>
            
            editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getText();
            if($.trim(editor_val) == '') {
//                alert('กรุณาใส่รายละเอียดข่าว');
//                return false;
            }
            
            $('form#paragraph').attr('action', '<?= site_url('news/insertParagraph'); ?>');
            //$('form#paragraph').submit();
        });
        <?php if(isset($result) and $result and isset($result_paragraph) and $result_paragraph){ ?>
            $('button.paragraph-edit').click(function(){
                var flag_attach_file = 0;
                $( ".attach_file" ).each(function( index ) {
                    var attach_file = $( this ).val();
                    if(attach_file != '') {
                        var attach_file_ext = attach_file.split('.').pop();
                        if(!(attach_file_ext == 'doc' || attach_file_ext == 'docx' || attach_file_ext == 'dot'|| attach_file_ext == 'dotx' || attach_file_ext == 'xls' || attach_file_ext == 'xlsx' || attach_file_ext == 'pdf' || attach_file_ext == 'ppt' || attach_file_ext == 'rar' || attach_file_ext == 'zip')) {
                            flag_attach_file = 1;
                        }
                    }
                });
                if(flag_attach_file == 1) {
                    alert('นามสกุลไฟล์ "เอกสารแนบ" ไม่ถูกต้อง');
                    return false;
                }
                
                <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 5)) { ?>
                    if(!$('#nc_newscauseid option:selected').val() || $('#nc_newscauseid option:selected').val() == 0) {
                        alert('กรุณาเลือกลักษณะการก่อเหตุ');
                        return false;
                    }

                    if(!$('#newsharry').hasClass('hide') && (!$('#nh_newsharryid option:selected').val() || $('#nh_newsharryid option:selected').val() == 0)) {
                        alert('กรุณาเลือกการก่อกวน');
                        return false;
                    }

                    if(!$('#newsexecution').hasClass('hide') && (!$('#ne_newsexecutionid option:selected').val() || $('#ne_newsexecutionid option:selected').val() == 0)) {
                        alert('กรุณาเลือกการปฏิบัติของฝ่ายเรา');
                        return false;
                    }

                    if(!$('#province_id option:selected').val() || $('#province_id option:selected').val() == 0) {
                        alert('กรุณาเลือกจังหวัด');
                        return false;
                    }

                    if(!$('#amphur_id option:selected').val() || $('#amphur_id option:selected').val() == 0) {
                        alert('กรุณาเลือกตำบล');
                        return false;
                    }
                <?php } ?>
                
                editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getText();
                if($.trim(editor_val) == '') {
                    alert('กรุณาใส่รายละเอียดข่าว');
                    return false;
                }
                
                $('form#paragraph').attr('action', '<?= site_url('news/updateParagraph'); ?>');
                //$('form#paragraph').submit();
            });
        <?php } ?>
        <?php if(isset($result) and $result) { ?>
            $('button.paragraph-preview').click(function(){
                editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getHtml();
                //console.log(editor_val);
                $.post('<?= site_url('news/detail/'.$result['n_newsid']); ?>?popup=1', { paragraph_preview: editor_val }, function(data) {
                    var theHtmlString = escapeHtml($(data).filter('#page-wrapper').html());
                    //console.log(theHtmlString);
                    $('iframe#paragraph-preview').contents().find('html').html(data);
                });
            });
        <?php } ?>
        $('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
                $.post($(this).attr('href'), function(data){
                    if(data == 'true') {
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด');
                    }
                });
            }
            return false;
        });
        /*----------------------- manage paragraph -----------------------*/
        
        <?php if(isset($_GET['tab']) and $_GET['tab']) { ?>
            $("ul.nav-tabs li:nth-child(<?= $_GET['tab']; ?>) a").tab('show');
        <?php } else {?>
            $("ul.nav-tabs li:nth-child(1) a").tab('show');
        <?php } ?>
            
        /*---------------------- textext Tag plugin ----------------------*/
        $('#n_keyword').textext({
            plugins : 'tags autocomplete',
            <?php if(isset($tag) and $tag) { ?>
                tagsItems: <?= json_encode($tag); ?>,
            <?php } ?>
        }).bind('getSuggestions', function(e, data){
            var list = [],
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || '';
            if(data.query.length > 2) {
                $.ajax({
                    url : '<?= site_url('news/searchTags'); ?>',
                    data : { q : $('#n_keyword').val() },
                    async : false,
                    method : "POST",
                    dataType : "json",
                    success : function(data) {
                        list = data;
                    }
                });
            }
            $(this).trigger(
                'setSuggestions',
                { result : textext.itemManager().filter(list, query) }
            );
        }).bind('isTagAllowed', function(e, data){
            var formData = $(e.target).textext()[0].tags()._formData,
                list = eval(formData);

            // duplicate checking
            if (formData.length && list.indexOf(data.tag) >= 0) {
                   var message = [ data.tag, 'is already listed.' ].join(' ');
                   alert(message);
                   data.result = false;
            }
        });
        /*---------------------- textext Tag plugin ----------------------*/
        
        /*---------------------- DualListbox plugin ----------------------*/
        var dualListbox = $('select[name="movement[]"]').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา', selectorMinimalHeight: 300});
        $('.refresh').click(function(){
            dualListbox.bootstrapDualListbox('refresh');
        });
        $('.add-movement').click(function(){
            if($('#movement_name').val() == '') {
                alert('กรุณากรอก "ความเคลื่อนไหว" ให้ครบถ้วน');
            } else {
                $.post('<?= site_url('news/ajaxInsert').'?type=movement'; ?>', { nm_name : $('#movement_name').val() }, function(data){
                    if(data.succress == 'true') {
                        $('#movement').append('<option value="'+data.value+'">'+data.text+'</option>');
                        dualListbox.bootstrapDualListbox('refresh');
                    }
                    $('#movement_name').val('');
                },'json');
            }
        });
        /*---------------------- DualListbox plugin ----------------------*/
        
        /*-------------- Filter Province, Amphur, District ---------------*/
        <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 1 or $result['rt_reporttypeid'] == 5)) { ?>
            filterAmphur( function(){ filterDistrict(); });
            $('#province_id').change(function(){
                filterAmphur();
            });
            $('#amphur_id').change(function(){
                filterDistrict();
            });
            function filterAmphur( callback ) {
                console.log(1);
                var province_id = $('#province_id option:selected').val();
                if(province_id != 0) {
                    console.log(2);
                    $.post('<?= site_url('news/ajaxAmphur'); ?>', { province_id : province_id }, function(data) {
                        $('#amphur_id').html(data);
                        <?php if(isset($result_paragraph['na_newsamphorid']) and $result_paragraph['na_newsamphorid']) { ?>
                            console.log(<?= $result_paragraph['na_newsamphorid']; ?>);
                            $('#amphur_id option[value="<?= $result_paragraph['na_newsamphorid']; ?>"]').prop("selected", true);
                        <?php } ?>
                        
                        if( callback ) {
                            callback();
                        }
                    });
                }
            }
            function filterDistrict( callback ) {
                console.log(1);
                var amphur_id = $('#amphur_id option:selected').val();
                if(amphur_id != 0) {
                    console.log(2);
                    $.post('<?= site_url('news/ajaxDistrict'); ?>', { amphur_id : amphur_id }, function(data) {
                        $('#district_id').html(data);
                        <?php if(isset($result_paragraph['nt_newstambonid']) and $result_paragraph['nt_newstambonid']) { ?>
                            console.log(<?= $result_paragraph['nt_newstambonid']; ?>);
                            $('#district_id option[value="<?= $result_paragraph['nt_newstambonid']; ?>"]').prop("selected", true);
                        <?php } ?>
                            
                        if( callback ) {
                            callback();
                        }
                    });
                }
            }
        <?php } ?>
        /*-------------- Filter Province, Amphur, District ---------------*/
        
        $('#nc_newscauseid').change(function(){
            getSelectedNewscause();
        });
    });
    function updateReportType(n_newsid, callback) {
        var rt_reporttypeid = $('select#rt_reporttypeid option:selected').val();
        $.post('<?= site_url('news/updateReportType'); ?>', { n_newsid: n_newsid, rt_reporttypeid : rt_reporttypeid }, function(data) {
            if(data == 'true') {
                callback();
            }
        });
    }
    function chkReporttype() {
        var selected = $('select#rt_reporttypeid option:selected').val();
        if (selected == 1 || selected == 5) {
            $('.type').show();
            $('.type-2, .type-3').hide();
            $('.type-2 .required, .type-3 .required').removeAttr('required');
            $('.type-1').show();
            $('.type-1 .required').attr('required', 'required');
        } else if (selected == 2 || selected == 3 || selected == 4) {
            $('.type').show();
            $('.type-1, .type-3').hide();
            $('.type-1 .required, .type-3 .required').removeAttr('required');
            $('.type-2').show();
            $('.type-2 .required').attr('required', 'required');
        } else if (selected == 6) {
            $('.type').show();
            $('.type-1, .type-2').hide();
            $('.type-1 .required, .type-2 .required').removeAttr('required');
            $('.type-3').show();
            $('.type-3 .required').attr('required', 'required');
        } else {
            $('.type').hide();
        }
    }
    function getSelected() {
        var arr_id = ["movement"];
        var arr_url = ["news_movement/update/"];
        $.each( arr_id, function( key, value ) {
            var str = '';
            $('.selected-'+value).html('');
            $( "select#"+value+" option:selected" ).each(function() {
                str += "<a href='<?= base_url(); ?>" + arr_url[key] + $( this ).val() + "' target='_blank'>" + $( this ).text() + "</a>, ";
            });
            $('.selected-'+value).html(str.substring(0, str.length - 2));
        });
    }
    function getSelectedNewscause() {
        $('#newsharry, #newsexecution').removeClass('hide').addClass('hide');
            
        if( $('#nc_newscauseid option:selected').data('harry') == 1 ){
            $('#newsharry').removeClass('hide');
        }

        if( $('#nc_newscauseid option:selected').data('execution') == 1 ){
            $('#newsexecution').removeClass('hide');
        }
    }
    function deleteImg(name) {
        var c = confirm('ลบรูปภาพ!?');
        if (c) {
            $('div#thumb_' + name).hide();
            $('input#del_' + name).val(1);
        } else
            return false;
    }
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
    function inputOnlyNumber(evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode( key );
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
</script>
<style>
    #myModal04 .modal-dialog, #myModal05 .modal-dialog {
        width: 90%;
        height: 100%;
    }
    #myModal04 .modal-body, #myModal05 .modal-body {
        height: 100%;
    }
    #myModal04 .modal-dialog, #myModal05 modal-dialog, #myModal04 .modal-content, #myModal05 .modal-content {
        height: 90%;
    }
    .text-wrap {
        width: 100%!important;
    }
    .text-core .text-wrap textarea, .text-core .text-wrap input.form-control {
        display: block;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%!important;
    }
    .text-core .text-wrap .text-tags {
        z-index: 2;
    }
</style>