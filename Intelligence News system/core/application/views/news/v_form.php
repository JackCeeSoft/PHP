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
                                            <label class="control-label right">ประเภทรายงาน : *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control required" id="rt_reporttypeid" name="rt_reporttypeid" required>
                                                
                                                <?php foreach ($report_type as $v_rt) { ?>
                                                    <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
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

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
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

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">จาก :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control required" name="n_from" required <?= (isset($result['n_from']) and $result['n_from']) ? 'value="'.$result['n_from'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ที่ของผู้ให้ข่าว : *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control required" name="n_source" required <?= (isset($result['n_source']) and $result['n_source']) ? 'value="'.$result['n_source'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <?php /*<div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ระบบรายงาน :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control required" name="ru_reportunitid" required>
                                                <option value="">กรุณาเลือกระบบรายงาน</option>
                                                <?php foreach ($report_unit as $v_ru) { ?>
                                                    <option value="<?= $v_ru['ru_reportunitid']; ?>" <?= (isset($result['ru_reportunitid']) and $result['ru_reportunitid'] == $v_ru['ru_reportunitid']) ? 'selected' : ''; ?>><?= $v_ru['ru_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>*/ ?>

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ผู้รับปฏิบัติ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="n_perform"><?= (isset($result['n_perform']) and $result['n_perform']) ? $result['n_perform'] : ''; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ผู้รับทราบ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" name="n_aware"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type type-2">
                                        <div class="col-lg-2">
                                            <label class="control-label right"> ส่วนราชการ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_government" <?= (isset($result['n_government']) and $result['n_government']) ? 'value="'.$result['n_government'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type type-2">
                                        <div class="col-lg-2">
                                            <label class="control-label right"> ที่ : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_place" <?= (isset($result['n_place']) and $result['n_place']) ? 'value="'.$result['n_place'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type type-2">
                                        <div class="col-lg-2">
                                            <label class="control-label right"> เรียน : </label>
                                        </div>
                                        <div class="col-lg-5">
                                            <input class="form-control" name="n_to" <?= (isset($result['n_to']) and $result['n_to']) ? 'value="'.$result['n_to'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type type-2">
                                        <div class="col-lg-2">
                                            <label class="control-label right"> สิ่งที่แนบมาด้วย : </label>
                                        </div>
                                        <div class="col-lg-5">
                                            <textarea class="form-control" name="n_attachdetail"><?= (isset($result['n_attachdetail']) and $result['n_attachdetail']) ? $result['n_attachdetail'] : ''; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group type">
                                        <div class="col-lg-2">
                                            <label class="control-label right">หัวเรื่อง :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input maxlength="200" class="form-control required" name="n_subject" required <?= (isset($result['n_subject']) and $result['n_subject']) ? 'value="'.$result['n_subject'].'"' : ''; ?>>
                                        </div>
                                    </div>

                                    <div class="form-group type">
                                        <div class="col-lg-2">
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
                                        <div class="col-lg-2">
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

                                    <div class="form-group type type-1">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ชื่อผู้เขียนข่าว :  *</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control required" name="n_writer" required <?= (isset($result['n_writer']) and $result['n_writer']) ? 'value="'.$result['n_writer'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ชื่อผู้อนุมัติข่าว :  </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_approver" id="n_approver" <?= (isset($result['n_approver']) and $result['n_approver']) ? 'value="'.$result['n_approver'].'"' : ''; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type">
                                        <div class="col-lg-2">
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
                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">เพิ่มบุคคล : </label>
                                        </div>

                                        <div class="col-lg-6">
                                            <a style="cursor: pointer;"><i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModal01"> เพิ่มบุคคล</i></a>
                                            <br>
                                            <span class="selected-person"></span>
                                        </div>

                                        <div id="myModal01" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class=" col-lg-8">
                                                                <div class="row">
                                                                    <div class=" col-lg-6">
                                                                        <input type="text" class="form-control" id="person_fname" placeholder="ชื่อ"> 
                                                                    </div>
                                                                    <div class=" col-lg-6">
                                                                        <input type="text" class="form-control" id="person_lname" placeholder="นามสกุล">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class=" col-lg-4">
                                                                <button type="button" class="btn btn-primary add-person">เพิ่ม <i class="fa fa-plus-circle"></i></button>
                                                                <button type="button" class="btn btn-success close-modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                        <select multiple="multiple" size="10" id="person" name="person[]">
                                                            <?php if(isset($person) and $person) {?>
                                                                <?php foreach ($person as $v_person) { ?>
                                                                    <?php if(isset($personed) and $personed) {?>
                                                                        <option value="<?= $v_person['p_personid']; ?>" <?= (array_search($v_person['p_personid'], $personed) !== false) ? 'selected' : ''; ?>><?= $v_person['p_firstname'].' '.$v_person['p_lastname']; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $v_person['p_personid']; ?>" ><?= $v_person['p_firstname'].' '.$v_person['p_lastname']; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">เพิ่มองค์กร : </label>
                                        </div>

                                        <div class="col-lg-6">
                                            <a style="cursor: pointer;"><i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModal02"> เพิ่มองค์กร</i></a>
                                            <br>
                                            <span class="selected-organization"></span>
                                        </div>

                                        <div id="myModal02" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class=" col-lg-8">
                                                                <div class="row">
                                                                    <div class=" col-lg-12">
                                                                        <input type="text" class="form-control" id="organization_name" placeholder="ชื่อองค์กร"> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class=" col-lg-4">
                                                                <button type="button" class="btn btn-primary add-organization">เพิ่ม <i class="fa fa-plus-circle"></i></button>
                                                                <button type="button" class="btn btn-success close-modal">ปิด</button>
                                                            </div>
                                                        </div>
                                                        <select multiple="multiple" size="10" id="organization" name="organization[]">
                                                            <?php if(isset($organization) and $organization) {?>
                                                                <?php foreach ($organization as $v_organization) { ?>
                                                                    <?php if(isset($organizationed) and $organizationed) {?>
                                                                        <option value="<?= $v_organization['o_organizationid']; ?>" <?= (array_search($v_organization['o_organizationid'], $organizationed) !== false) ? 'selected' : ''; ?>><?= $v_organization['o_fullnameth']; ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $v_organization['o_organizationid']; ?>" ><?= $v_organization['o_fullnameth']; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group type mb-5">
                                        <label class="col-lg-2"></label>
                                        <div class="form-group mb-0">
                                            <div class="col-lg-5">
                                                <?= (isset($result_paragraph['np_mainimage']) and $result_paragraph['np_mainimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->paragraph_images_path . $result_paragraph['np_paragraph_id'] . '/' . $result_paragraph['np_mainimage']) . '" /><a class="btn btn-danger" title="ลบ" id="del_img"><i class="fa fa-trash-o"></i> Delete</a></div><input id="del" type="hidden" name="del" value="0" />' : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right"> รูปภาพเพื่อแสดงเป็น ภาพ Preview : </label>
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
                                        <label class="col-lg-2"></label>
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
                                        <div class="col-lg-2">
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
                                        <div class="col-lg-2">
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
                                        <div class="col-lg-2">
                                            <label class="control-label right">คีย์เวิร์ด : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" name="n_keyword" id="n_keyword" placeholder="คีย์เวิร์ด" <?= (isset($result['n_keyword']) and $result['n_keyword']) ? 'value="'.$result['n_keyword'].'"' : ''; ?>>
                                            <textarea name="n_keyword" id="n_keyword" placeholder="คีย์เวิร์ด"><?= (isset($result['n_keyword']) and $result['n_keyword']) ? $result['n_keyword'] : ''; ?></textarea>
                                        </div>
                                    </div>-->

                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">แผนกด้าน : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="nd_newsdepartmentid">
                                                <option value="0">กรุณาเลือกแผนกด้าน</option>
                                                <?php foreach ($news_department as $v_nd) { ?>
                                                    <option value="<?= $v_nd['nd_newsdepartmentid']; ?>" <?= (isset($result_paragraph['nd_newsdepartmentid']) and $result_paragraph['nd_newsdepartmentid'] == $v_nd['nd_newsdepartmentid']) ? 'selected' : ''; ?>><?= $v_nd['nd_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ประเภทข่าวกรอง : </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="nt_newstypeid">
                                                <option value="0">กรุณาเลือกประเภทข่าวกรอง</option>
                                                <?php foreach ($news_type as $v_nt) { ?>
                                                    <option value="<?= $v_nt['nt_newstypeid']; ?>" <?= (isset($result_paragraph['nt_newstypeid']) and $result_paragraph['nt_newstypeid'] == $v_nt['nt_newstypeid']) ? 'selected' : ''; ?>><?= $v_nt['nt_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php /*
                                        <div class="col-lg-4 float_left">
                                            <select class="form-control" name="nc_newscountryid">
                                                <option value="0">กรุณาเลือกการเมืองในประเทศหรือต่างประเทศ</option>
                                                <?php foreach ($news_country as $v_nc) { ?>
                                                    <option value="<?= $v_nc['nc_newscountryid']; ?>" <?= (isset($result_paragraph['nc_newscountryid']) and $result_paragraph['nc_newscountryid'] == $v_nc['nc_newscountryid']) ? 'selected' : ''; ?>><?= $v_nc['nc_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        */ ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-2">
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
                                    
                                    <?php /*<div class="form-group type">
                                        <div class="col-lg-2">
                                            <label class="control-label right">แสดงผล : </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="np_active">
                                                <option value="N" <?= (isset($result_paragraph['np_active']) and $result_paragraph['np_active'] == 'N') ? 'selected' : ''; ?>>ไม่แสดง</option>
                                                <option value="Y" <?= (isset($result_paragraph['np_active']) and $result_paragraph['np_active'] == 'Y') ? 'selected' : ''; ?>>แสดง</option>
                                            </select>
                                        </div>
                                    </div>*/ ?>

                                    <div class="col-lg-10 col-lg-offset-2">
                                        <?php if(isset($result_paragraph) and $result_paragraph) {?>
                                            <input type="hidden" name="paragraph_id" value="<?= $result_paragraph['np_paragraph_id']; ?>">
                                            <button type="button" class="btn btn-primary paragraph-edit">แก้ไข</button>
                                            <a href="<?= site_url('news/update/'.$result['n_newsid'].'?tab=2'); ?>" class="btn btn-default">ยกเลิก</a>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-primary paragraph-save">บันทึก</button>
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
                                                            <!--<button type="button" class="btn btn-success float_right close-modal">ปิด <i class="fa fa-plus-circle"></i></button>
                                                            <div class="clear"></div>-->
                                                            <iframe id="paragraph-preview" src=""  width="100%" height="90%" frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>

                                    <h2><a href="<?= site_url('news/detail/'.$result['n_newsid']); ?>"><?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : ''; ?></a></h2>
                                    <div class="border_box">
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
                                        <div class="float_left padding_left_10px">
                                            <span>ที่มาของผู้ให้ข่าว :
                                            </span>
                                            <span class="blue"><?= (isset($result['n_source']) and $result['n_source']) ? $result['n_source'] : '-'; ?>
                                            </span>
                                        </div>

                                        <div class="clear"></div>

                                        <div class="float_left padding_left_10px">
                                            <span>จาก :
                                            </span>
                                            <span class="blue"><?= (isset($result['n_from']) and $result['n_from']) ? $result['n_from'] : '-'; ?>
                                            </span>
                                        </div>
                                        <?php /*<div class="float_left padding_left_10px">
                                            <span>ระบบรายงาน :
                                            </span>
                                            <span class="blue"><?= (isset($result['ru_name']) and $result['ru_name']) ? $result['ru_name'] : '-'; ?>
                                            </span>
                                        </div>*/ ?>

                                        <div class="clear"></div>

                                        <div class="padding_left_10px">
                                            <span>ผู้รับทราบ :
                                            </span>
                                            <span class="blue"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : '-'; ?>
                                            </span>
                                        </div>
                                        <div class="padding_left_10px">
                                            <span>ผู้รับปฏิบัติ:
                                            </span>
                                            <span class="blue"><?= (isset($result['n_perform']) and $result['n_perform']) ? $result['n_perform'] : '-'; ?>
                                            </span>
                                        </div> 

                                        <div class="clear"></div>

                                        <div class="padding_left_10px">
                                            <span>ชื่อผู้เขียนข่าว :
                                            </span>
                                            <span class="blue"><?= (isset($result['n_writer']) and $result['n_writer']) ? $result['n_writer'] : '-'; ?>
                                            </span>
                                        </div>
                                        <div class="padding_left_10px">
                                            <span>ชื่อผู้อนุมัติข่าว :
                                            </span>
                                            <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                                            </span>
                                        </div> 

                                        <div class="padding_left_10px">
                                            <span><i class="fa fa-calendar"></i>
                                            </span>
                                            <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? dateTHFormat($result['n_date']) : '-'; ?> <?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'].' น.' : '-'; ?> 
                                            </span>
                                        </div>
                                    </div>

                                    <br>

                                    <?php foreach ($paragraph as $v_p) { ?>
                                        <div class="span13 blog-article float_left">
                                            <?//= stripHTMLTags($v_p['np_paragraph']); ?>
                                            <div><?= $v_p['np_paragraph']; ?></div>
                                        </div>
                                        <div class="span2 blog-article float_right">
                                            <a class="blue" href="<?= site_url('news/update/'.$result['n_newsid'].'/'.$v_p['np_paragraph_id'].'?tab=2'); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="blue del-paragraph del" href="<?= site_url('news/deleteParagraph/'.$result['n_newsid'].'/'.$v_p['np_paragraph_id']); ?>"><i class="fa fa-trash"></i></a>
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
        $('#paragraph').submit(function() {
            editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getText();
            console.log(editor_val);
            if($.trim(editor_val) == '') {
                alert('กรุณาใส่รายละเอียดข่าว');
                return false;
            }
        });
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
        
        /*$('.nav-tabs li a').click(function(){
            $('.tab-pane.active form.section').append('<input type="hidden" name="tab" value="' + $(this).data('tabid') + '" />');
            $('.tab-pane.active form.section').submit();
        });*/
        
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
            var image_file = $('#image_file').val();
            if(image_file != '') {
                var image_file_ext = image_file.split('.').pop();
                if(!(image_file_ext == 'jpg' || image_file_ext == 'png' || image_file_ext == 'gif')) {
                    alert('นามสกุลไฟล์ "รูปภาพ" ไม่ถูกต้อง');
                    return false;
                }
            }
            
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
            
            $('form#paragraph').attr('action', '<?= site_url('news/insertParagraph'); ?>');
            $('form#paragraph').submit();
        });
        <?php if(isset($result) and $result and isset($result_paragraph) and $result_paragraph){ ?>
            $('button.paragraph-edit').click(function(){
                var image_file = $('#image_file').val();
                if(image_file != '') {
                    var image_file_ext = image_file.split('.').pop();
                    if(!(image_file_ext == 'jpg' || image_file_ext == 'png' || image_file_ext == 'gif')) {
                        alert('นามสกุลไฟล์ "รูปภาพ" ไม่ถูกต้อง');
                        return false;
                    }
                }

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
                
                $('form#paragraph').attr('action', '<?= site_url('news/updateParagraph'); ?>');
                $('form#paragraph').submit();
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
        var dualListbox = $('select[name="person[]"], select[name="organization[]"], select[name="movement[]"]').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา', selectorMinimalHeight: 300});
        $('.refresh').click(function(){
            dualListbox.bootstrapDualListbox('refresh');
        });
        $('.add-person').click(function(){
            if($('#person_fname').val() == '' || $('#person_lname').val() == '') {
                alert('กรุณากรอก "ชื่อ-นามสกุล" ให้ครบถ้วน');
            } else {
                $.post('<?= site_url('news/ajaxInsert').'?type=person'; ?>', { p_firstname : $('#person_fname').val(), p_lastname : $('#person_lname').val() }, function(data){
                    if(data.succress == 'true') {
                        $('#person').append('<option value="'+data.value+'">'+data.text+'</option>');
                        dualListbox.bootstrapDualListbox('refresh');
                    }
                    $('#person_fname').val('');
                    $('#person_lname').val('');
                },'json');
            }
        });
        $('.add-organization').click(function(){
            if($('#organization_name').val() == '') {
                alert('กรุณากรอก "ชื่อองค์กร" ให้ครบถ้วน');
            } else {
                $.post('<?= site_url('news/ajaxInsert').'?type=organization'; ?>', { o_fullnameth : $('#organization_name').val() }, function(data){
                    if(data.succress == 'true') {
                        $('#organization').append('<option value="'+data.value+'">'+data.text+'</option>');
                        dualListbox.bootstrapDualListbox('refresh');
                    }
                    $('#organization_name').val('');
                },'json');
            }
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
    });
    function chkReporttype() {
        if ($('select#rt_reporttypeid option:selected').val() >= 4) {
            $('.type').show();
            $('.type-1').hide();
            $('.type-1 .required').removeAttr('required');
            $('.type-2').show();
            $('.type-2 .required').attr('required', 'required');
        } else if ($('select#rt_reporttypeid option:selected').val() >= 1 && $('select#rt_reporttypeid option:selected').val() <= 3) {
            $('.type').show();
            $('.type-2').hide();
            $('.type-2 .required').removeAttr('required');
            $('.type-1').show();
            $('.type-1 .required').attr('required', 'required');
        } else {
            $('.type').hide();
        }
    }
    function getSelected() {
        var arr_id = ["person", "organization", "movement"];
        var arr_url = ["person/look_person/", "organization/look_organize/", "news_movement/update/"];
        $.each( arr_id, function( key, value ) {
            var str = '';
            $('.selected-'+value).html('');
            $( "select#"+value+" option:selected" ).each(function() {
                str += "<a href='<?= base_url(); ?>" + arr_url[key] + $( this ).val() + "' target='_blank'>" + $( this ).text() + "</a>, ";
            });
            $('.selected-'+value).html(str.substring(0, str.length - 2));
        });
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