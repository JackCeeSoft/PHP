<link rel="stylesheet" type="text/css" media="screen" href="assets/fileupload/bootstrap-image-gallery.min.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="assets/fileupload/jquery.fileupload-ui.css"/>
<script  type="text/javascript" src="assets/fileupload/vendor/jquery.ui.widget.js" ></script>
<script  type="text/javascript" src="assets/fileupload/tmpl.js" ></script>
<script  type="text/javascript" src="assets/fileupload/load-image.js" ></script>
<script  type="text/javascript" src="assets/fileupload/canvas-to-blob.js" ></script>
<script  type="text/javascript" src="assets/fileupload/bootstrap-image-gallery.min.js" ></script>
<script  type="text/javascript" src="assets/fileupload/jquery.iframe-transport.js" ></script>
<script  type="text/javascript" src="assets/fileupload/jquery.fileupload.js" ></script>
<script  type="text/javascript" src="assets/fileupload/jquery.fileupload-ip.js" ></script>
<script  type="text/javascript" src="assets/fileupload/jquery.fileupload-ui.js" ></script>
<script  type="text/javascript" src="assets/fileupload/locale.js" ></script>
<script  type="text/javascript" src="assets/fileupload/main.js" ></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/colorbox/theme2/colorbox.css" />
<script  type="text/javascript" src="assets/colorbox/jquery.colorbox.js"></script>
<script>
//       $('#fileupload')
//        .bind('fileuploadadd', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadsubmit', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadsend', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploaddone', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadfail', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadalways', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadprogress', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadprogressall', function (e, data) {console.log('fileuploadadd'); })
//        .bind('fileuploadstart', function (e) { console.log('fileuploadadd'); })
//        .bind('fileuploadstop', function (e) { console.log('fileuploadadd'); })
//        .bind('fileuploadchange', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadpaste', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploaddrop', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploaddragover', function (e) { console.log('fileuploadadd'); })
//        .bind('fileuploadchunksend', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadchunkdone', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadchunkfail', function (e, data) { console.log('fileuploadadd'); })
//        .bind('fileuploadchunkalways', function (e, data) { console.log('fileuploadadd'); });
    $(function () {
        'use strict';
        // Initialize the jQuery File Upload widget:
        $('#fileupload').fileupload();
        //$('#fileupload').bind('fileuploaddone', function (e, data) { console.log('fileuploaddone'); });
        $('#fileupload').bind('fileuploaddone', function (e, data) { 
            console.log('fileuploaddone'); 
            setTimeout(function(){ ajaxImageList(); }, 500);
        });
        $(document).on( "click", "button.btn-danger.delete, button.btn-danger.btn-sm", 
        function() {
            console.log('fileuploaddrop');  // jQuery 1.7+
            
            setTimeout(function(){ ajaxImageList(); }, 500);
        });
        $(".gallery").colorbox({rel: 'gallery', height : '80%'});
    });
    
    function ajaxImageList() {
        //alert('Upload PIC');
        //url = '/e_army/person/updateTap1/'+id+'/0?del_pic='+path;
        //window.location = url;
        location.reload();
    }
    
    
</script>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <?php //print_r($result); ?>
    <div class="container">
        <div class="panel col-lg-12 center">
                        <div>
                        <a href="person/search_person_news">
                            <button type="reset" class="btn btn-default">กลับหน้าหลัก</button>
                            </a>
                        </div>
          
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home"> <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i>  รายละเอียด</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <fieldset>
                                <?php 
                               // echo $check_tap;
                                        $tap1 = ' class="active"';
                                        $tap2 = "";
                                        $tap3 = "";
                                        $tap4 = "";
                                        $active_in_tap1 = " active in";
                                        $active_in_tap2 = "";
                                        $active_in_tap3 = "";
                                        $active_in_tap4 = "";
                                    if(isset($check_tap) && $check_tap!=""){
                                        if($check_tap == "submit_tap1"){
                                            $tap1 = ' class="active"';
                                            $active_in_tap1 = " active in";
                                            $tap2 = '';
                                            $active_in_tap2 = "";
                                            $tap3 = '';
                                            $active_in_tap3 = "";
                                            $tap4 = '';
                                            $active_in_tap4 = "";
                                        }
                                        if($check_tap == "submit_tap2"){
                                                $tap2 = ' class="active"';
                                                $active_in_tap2 = " active in";
                                                $tap1 = '';
                                                $active_in_tap1 = "";
                                                $tap3 = '';
                                                $active_in_tap3 = "";
                                                $tap4 = '';
                                                $active_in_tap4 = "";
                                        }
                                        if($check_tap == "submit_tap3"){
                                                $tap3 = ' class="active"';
                                                $active_in_tap3 = " active in";
                                                $tap1 = '';
                                                $active_in_tap1 = "";
                                                $tap2 = '';
                                                $active_in_tap2 = "";
                                                $tap4 = '';
                                                $active_in_tap4 = "";
                                                //echo 'Jack';
                                        }
                                        if($check_tap == "submit_tap4"){
                                                $tap4 = ' class="active"';
                                                $active_in_tap4 = " active in";
                                                $tap1 = '';
                                                $active_in_tap1 = "";
                                                $tap2 = '';
                                                $active_in_tap2 = "";
                                                $tap3 = '';
                                                $active_in_tap3 = "";
                                        }
                                    }
                                ?>
                                <br>
                                <ul class="nav nav-tabs margin0px">
                                    <li<?= $tap1;?>><a href="#menu1" data-toggle="tab" aria-expanded="true">ข้อมูลบุคคล</a></li>
                                    <li<?= $tap2;?>><a href="#profile3" data-toggle="tab" aria-expanded="false">ลำดับพฤติกรรม</a></li>
                                    <li<?= $tap3;?>><a href="#profile1" data-toggle="tab" aria-expanded="false">รูปภาพ</a></li>
                                    <li<?= $tap4;?>><a href="#profile2" data-toggle="tab" aria-expanded="false">รายละเอียดเพิ่มเติม</a></li>
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade <?= $active_in_tap1;?>" id="menu1">
                                        <br>

                                        <div class="form-group">
                                            <div class="col-lg-12 blog-tag-data-inner">
                                                   <?= (isset($result['p_faceimage']) and $result['p_faceimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->images_path . $result['p_personid'] . '/' . $result['p_faceimage']) . '" /></div>' :'<img src="assets/img/mockup/no-image.gif" alt="">'; ?>
                                            </div>
                                            <div class="col-lg-2 margin-top20px">
                                                <label class="control-label right">แนบรูปภาพ : </label>
                                            </div>
                                            <div class="col-lg-6 margin-top20px">
                                                <input class="form-control" type="file" name="image_file">
                                                <small>หมายเหตุ : รูปภาพที่ต้องการแนนต้องมีขนาดไม่เกิน 500 kb</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
<!--                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_title">
                                                    <?php if(isset($result['p_title'])){
//                                                        if($result['p_title'] == "นาย") {
//                                                            echo "<option>นาย</option>";
//                                                            echo "<option>นาง</option>";
//                                                            echo "<option>นางสาว</option>";
//                                                        }
//                                                        if($result['p_title'] == "นาง") {
//                                                            echo "<option>นาง</option>";
//                                                            echo "<option>นาย</option>";
//                                                            echo "<option>นางสาว</option>";
//                                                        }
//                                                        if($result['p_title'] == "นางสาว") {
//                                                            echo "<option>นางสาว</option>";
//                                                            echo "<option>นาย</option>";
//                                                            echo "<option>นาง</option>";
//                                                        }
                                                    } ?>
                                                </select>
                                            </div>-->
                                            <div class="col-sm-2">
                                                <label>คำนำหน้า </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" id="p_firstname" class="form-control" name="p_title" value="<?php if(isset($result['p_title']) and $result['p_title']) echo $result['p_title']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชื่อ : *</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="p_firstname" name="p_firstname" required value="<?php if(isset($result['p_firstname']) and $result['p_firstname']) echo $result['p_firstname']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : *</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="p_lastname" name="p_lastname" required value="<?php if(isset($result['p_lastname']) and $result['p_lastname']) echo $result['p_lastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>วัน/เดือน/ปีเกิด : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                        <div class="col-lg-6">
                                            <div class="input-append date" id="datetimepicker1">
                                                <input data-format="yyyy-MM-dd" type="text" name="p_birthdate" value="<?php if(isset($result['p_birthdate']) and $result['p_birthdate']) echo $result['p_birthdate']; ?>">
                                                <span class="add-on">
                                                    <i data-date-icon="fa fa-calendar"  data-time-icon="fa fa-clock-o" class="fa-calendar fa">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
  
  
                                            </div>
                                            <div class="col-sm-1">
                                                <label>อายุ : </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' class="form-control" name="p_age" maxlength="3" value="<?php if(isset($result['p_age']) and $result['p_age']) echo $result['p_age']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ปี </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>เพศ : </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_gender" >
                                                     <?php if(isset($result['p_gender'])){
                                                        if($result['p_gender'] == "ชาย") {
                                                            echo "<option>ชาย</option>";
                                                            echo "<option>หญิง</option>";
                                                        }
                                                        if($result['p_gender'] == "หญิง") {
                                                            echo "<option>หญิง</option>";
                                                            echo "<option>ชาย</option>";
                                                        }

                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อเล่น :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_nickname"  value="<?php if(isset($result['p_nickname']) and $result['p_nickname']) echo $result['p_nickname']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>อาชีพ :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_occupation"  value="<?php if(isset($result['p_occupation']) and $result['p_occupation']) echo $result['p_occupation']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>เลขที่บัตรประชาชน :  </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php 
                                                    $p_idcard_1 = substr($result['p_idcard'],0,1);
                                                    $p_idcard_2 = substr($result['p_idcard'],1,1);
                                                    $p_idcard_3 = substr($result['p_idcard'],2,1);
                                                    $p_idcard_4 = substr($result['p_idcard'],3,1);
                                                    $p_idcard_5 = substr($result['p_idcard'],4,1);
                                                    $p_idcard_6 = substr($result['p_idcard'],5,1);
                                                    $p_idcard_7 = substr($result['p_idcard'],6,1);
                                                    $p_idcard_8 = substr($result['p_idcard'],7,1);
                                                    $p_idcard_9 = substr($result['p_idcard'],8,1);
                                                    $p_idcard_10 = substr($result['p_idcard'],9,1);
                                                    $p_idcard_11 = substr($result['p_idcard'],10,1);
                                                    $p_idcard_12 = substr($result['p_idcard'],11,1);
                                                    $p_idcard_13 = substr($result['p_idcard'],12,1);
                                                    $p_idcard = $result['p_idcard'];
                                                ?>
                                                <input type="text" onkeypress='validate(event)' maxlength="13" name="p_idcard" value="<?php if(isset($p_idcard) and $p_idcard) echo $p_idcard; ?>" >
<!--                                                <input type="text" maxlength="1" class="span0" name="p_idcard_1" required value="<?php if(isset($p_idcard_1) and $p_idcard_1) echo $p_idcard_1; ?>">
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_2" required value="<?php if(isset($p_idcard_2) and $p_idcard_2) echo $p_idcard_2; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_3" required value="<?php if(isset($p_idcard_3) and $p_idcard_3) echo $p_idcard_3; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_4" required value="<?php if(isset($p_idcard_4) and $p_idcard_4) echo $p_idcard_4; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_5" required value="<?php if(isset($p_idcard_5) and $p_idcard_5) echo $p_idcard_5; ?>">
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_6" required value="<?php if(isset($p_idcard_6) and $p_idcard_6) echo $p_idcard_6; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_7" required value="<?php if(isset($p_idcard_7) and $p_idcard_7) echo $p_idcard_7; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_8" required value="<?php if(isset($p_idcard_8) and $p_idcard_8) echo $p_idcard_8; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_9" required value="<?php if(isset($p_idcard_9) and $p_idcard_9) echo $p_idcard_9; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_10" required value="<?php if(isset($p_idcard_10) and $p_idcard_10) echo $p_idcard_10; ?>">
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_11" required value="<?php if(isset($p_idcard_11) and $p_idcard_11) echo $p_idcard_11; ?>">
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_12" required value="<?php if(isset($p_idcard_12) and $p_idcard_12) echo $p_idcard_12; ?>">
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_13" required value="<?php if(isset($p_idcard_13) and $p_idcard_13) echo $p_idcard_13; ?>">-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ตำแหน่งปัจจุบัน :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_position" value="<?php if(isset($result['p_position']) and $result['p_position']) echo $result['p_position']; ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <label>การศึกษา :  </label>
                                            </div>
                                            <div class="col-sm-2">
                                             <select class="form-control" name="p_education" >
                                                    <?php if(isset($result['p_education'])){
                                                        if($result['p_education'] == "ม.ต้น") {
                                                            echo "<option>ม.ต้น</option>";
                                                            echo "<option>ม.ปลาย</option>";
                                                        }
                                                        if($result['p_education'] == "ม.ปลาย") {
                                                            echo "<option>ม.ปลาย</option>";
                                                            echo "<option>ม.ต้น</option>";
                                                        }

                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ที่ทำงาน :  </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_workaddress" ><?php if(isset($result['p_workaddress']) and $result['p_workaddress']) echo $result['p_workaddress']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>สัญชาติ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_nationality"  value="<?php if(isset($result['p_nationality']) and $result['p_nationality']) echo $result['p_nationality']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>เชื้อชาติ :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_race"  value="<?php if(isset($result['p_race']) and $result['p_race']) echo $result['p_race']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>สถานะภาพ :  </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_status">
                                                    <option>โสด</option>
                                                    <option>แต่งงาน</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ภูมิลำเนาเดิม :  </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_domicile"  ><?php if(isset($result['p_domicile']) and $result['p_domicile']) echo $result['p_domicile']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน :  </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_address"  ><?php if(isset($result['p_address']) and $result['p_address']) echo $result['p_address']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อสามี/ภารรยา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_spousefirstname" value="<?php if(isset($result['p_spousefirstname']) and $result['p_spousefirstname']) echo $result['p_spousefirstname']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_spouselastname" value="<?php if(isset($result['p_spouselastname']) and $result['p_spouselastname']) echo $result['p_spouselastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_spouseaddress"><?php if(isset($result['p_spouseaddress']) and $result['p_spouseaddress']) echo $result['p_spouseaddress']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>จำนวนบุตร</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' maxlength="2"  class="form-control" name="p_child" value="<?php if(isset($result['p_child']) and $result['p_child']) echo $result['p_child']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชาย </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' maxlength="2" class="form-control" name="p_boy" value="<?php if(isset($result['p_boy']) and $result['p_boy']) echo $result['p_boy']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>หญิง </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' maxlength="2" class="form-control" name="p_daughter" value="<?php if(isset($result['p_daughter']) and $result['p_daughter']) echo $result['p_daughter']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" placeholder="" name="p_childdetail"><?php if(isset($result['p_childdetail']) and $result['p_childdetail']) echo $result['p_childdetail'];?></textarea>
                                            </div>
                                        </div>
                                        
                                        <hr>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อบิดา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatherfirstname" value="<?php if(isset($result['p_fatherfirstname']) and $result['p_fatherfirstname']) echo $result['p_fatherfirstname']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatherlastname" value="<?php if(isset($result['p_fatherlastname']) and $result['p_fatherlastname']) echo $result['p_fatherlastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>อาชีพ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatheroccupation" value="<?php if(isset($result['p_fatheroccupation']) and $result['p_fatheroccupation']) echo $result['p_fatheroccupation']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_fatheraddress" value=""><?php if(isset($result['p_fatheraddress']) and $result['p_fatheraddress']) echo $result['p_fatheraddress']; ?></textarea>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อมารดา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motherfirstname" value="<?php if(isset($result['p_motherfirstname']) and $result['p_motherfirstname']) echo $result['p_motherfirstname']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motherlastname" value="<?php if(isset($result['p_motherlastname']) and $result['p_motherlastname']) echo $result['p_motherlastname']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>อาชีพ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motheroccupation" value="<?php if(isset($result['p_motheroccupation']) and $result['p_motheroccupation']) echo $result['p_motheroccupation']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_motheraddress" value=""><?php if(isset($result['p_motheraddress']) and $result['p_motheraddress']) echo $result['p_motheraddress']; ?></textarea>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>พี่น้อง ร่วมบิดา/มารดา</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' class="form-control" name="p_sibling" value="<?php if(isset($result['p_sibling']) and $result['p_sibling']) echo $result['p_sibling']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชาย </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' class="form-control" name="p_male" value="<?php if(isset($result['p_male']) and $result['p_male']) echo $result['p_male']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>หญิง </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" onkeypress='validate(event)' class="form-control" name="p_female" value="<?php if(isset($result['p_female']) and $result['p_female']) echo $result['p_female']; ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" placeholder="" name="p_siblingdesc" value=""><?php if(isset($result['p_siblingdesc']) and $result['p_siblingdesc']) echo $result['p_siblingdesc']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-10 col-lg-offset-2">
                                            <a href="<?= site_url('person/pdf_person/'.$result['p_personid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด PDF</a>
                                            <a href="<?= site_url('person/word_person/'.$result['p_personid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด Word</a>
                                            <div id="btn_add" class="col-lg-2"></div>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                      </form>
                                    </div>

                                    <!-- profile3 -->
                                    <div class="tab-pane fade <?= $active_in_tap2;?>" id="profile3"> 
                                        <div class="panel col-lg-12">
                                            <div class="input-group">
                                                <span>
                                                    <h4 class page-header> รายการทั้งหมด <?= $total_rows; ?> </h4>
                                                </span>
                                            </div>
                                            <div class="jumbotron"> 
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="no_search_text" value="<?php if (isset($no_search_test)) echo $no_search_test; ?>" placeholder="ค้นหาลำดับพฤติกรรม">
                                                        <span class="input-group-btn">
                                                        <br>
                                                        <button class="btn btn-default" name="submit_tap" value="submit_tap2" type="submit">ค้นหา</button>
                                                        </span>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                
                                <div>
                                    <fieldset>
                                        <?php
                                        $news_id = 0;
                                        if(isset($news_all) && $news_all != ""){
                                            foreach ($news_all as $key => $values){
                                                if($values['n_newsid'] != $news_id){
                                                    $news_id = $values['n_newsid'];
                                                    if(isset($no_search_test) && $no_search_test!= ""){
                                                        //$words = str_split($no_search_test) ;
                                                        //print_r($words);
                                                        $words = $no_search_test." ".$result['p_firstname']." ".$result['p_lastname'];
                                                        $n_subject = highlightWords($values['n_subject'], $words);
                                                        $url_news = site_url('news/detail/'.$news_id.'/'.$words.'?p='.$values['np_paragraph_id']);
                                                    }else{
                                                        $words = $result['p_firstname']." ".$result['p_lastname'];
                                                        $n_subject = highlightWords($values['n_subject'], $words);
                                                        $url_news = site_url('news/detail/'.$news_id.'/'.$words.'?p='.$values['np_paragraph_id']);
                                                    }
                                                    echo '<h2><a href="'.$url_news.'">'.$n_subject.'</a></h2>';
                                                }
                                        ?> 
                                            <div class="span13 blog-article float_left">
                                                <p><?php 
                                            if(isset($no_search_test) && $no_search_test!= ""){
                                                //$words = str_split($no_search_test) ;
                                                $words = $no_search_test." ".$result['p_firstname']." ".$result['p_lastname'];
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$words);   
                                                $n_writer = highlightWords($n_writer_Tags, $words);
                                            }else{
                                                $words = $result['p_firstname']." ".$result['p_lastname'];
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$words); 
                                                $n_writer = highlightWords($n_writer_Tags, $words);
                                            }
                                                echo $n_writer;
                                                ?></p>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                        <?php  }}?>
                                    </fieldset>
                                </div>
                               <div class="col-lg-12">
                                     <?= $this->pagination->create_custom_links_front(); ?>
                                </div> 
                                       </div>
                                    </div>       
                         <!-- profile1 -->
    <div class="tab-pane fade <?= $active_in_tap3;?>" id="profile1">
        <div class="panel panel-default col-lg-12 center pt-15" style="<?= (isset($image) and $image) ? 'display: block;' : 'display: none;'; ?>">
            <ul class="image-list">
                <?php if(isset($image) and $image) { ?>
                    <?php foreach ($image as $key=>$values) { ?>
                        <li>
                            <div>
                              <?php echo '<a class="gallery" href="upload/person_image_gallery/'.$image[$key]['p_personid'].'/'.$image[$key]['pi_path'].'">';?>
                                <?php  echo ' <img src="upload/person_image_gallery/'.$image[$key]['p_personid'].'/'.$image[$key]['pi_path'].'" width="100" height="70">'; ?>
                                  
                                </a>
                            </div>
                            <div>
                                <?php if(empty($_GET['popup'])) { ?>
                                    <button type="button" class="btn btn-danger btn-xs del" onclick="delImage('<?= $image[$key]['pi_path']; ?>','<?= $image[$key]['p_personid'];?>');">ลบ</button>
                                <?php } else { ?>
                                    <!--<button type="button" class="btn btn-primary btn-xs add" data-path="<?= base_url().getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>">ใส่รูป</button>-->
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
             <div class="panel panel-default col-lg-12 center pt-15">
                            <form id="fileupload" action="<?= site_url('jq_upload_person/upload_img/'.$result['p_personid']); ?>" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar" style="margin: 0;">
                                    <div>
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <span><i class="fa fa-plus"></i> เพิ่มไฟล์...</span>
                                            <input type="file" name="userfile" multiple>
                                        </span>
                                        <button type="submit" class="btn btn-primary start">
                                            <i class="fa fa-upload"></i> เริ่มการอัพโหลด
                                        </button>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="fa fa-remove icon-white"></i> ยกเลิกการอัพโหลด
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="fa fa-trash icon-white"></i> ลบ
                                        </button>
                                        <input type="checkbox" class="toggle">
                                    </div>
                                    <div>
                                        <!-- The global progress bar -->
                                        <div class="progress progress-success progress-striped active fade">
                                            <div class="bar" style="width:0%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- The loading indicator is shown during image processing -->
                                <div class="fileupload-loading"></div>
                                <br>
                                <!-- The table listing the files available for upload/download -->
                                <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
                            </form>
                        </div>
                    </div>

                                    <!-- profile2 -->
                                 
                                    <div class="tab-pane fade <?= $active_in_tap4;?>" id="profile2">
                                          <!--<form action="person_ckeediter/insert/<?=$result['p_personid'];?>" method="POST" enctype="multipart/form-data">-->
                                        <br>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดพฤติกรรม : </label>
                                            </div>
                                            
                                            <div class="col-lg-9">
                                                <textarea class="ckeditor" name="editor1"><?php if(isset($result['p_behavior']) and $result['p_behavior']) echo $result['p_behavior']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" name="last_page_submit" value="click_last"  class="btn btn-primary">บันทึก</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                         
                                    </div>
                                 
                           </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name">{%=file.name%}</td>
        <td class="size">{%=o.formatFileSize(file.size)%}</td>
        {% if (file.error) { %}
        <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
        <td>
            <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
        </td>
        <td class="start">{% if (!o.options.autoUpload) { %}
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-upload icon-white"></i> เริ่ม
            </button>
            {% } %}</td>
        {% } else { %}
        <td colspan="2"></td>
        {% } %}
        <td class="cancel">
            {% if (!i) { %}
            <button class="btn btn-warning btn-sm">
                <i class="fa fa-remove icon-white"></i> ยกเลิก
            </button>
            {% } %}
        </td>
    </tr>
    {% } %}
</script>
    
<div id="download-files">
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, files=o.files, l=files.length, file=files[0]; i< l; file=files[++i]) { %}
        <tr class="template-download fade">
            {% if (file.error) { %}
                <td></td>
                <td class="name">{%=file.name%}</td>
                <td class="size">{%=o.formatFileSize(file.size)%}</td>
                <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
            {% } else { %}
                <td class="preview">
                    {% if (file.url) { %}
                        <a><img src="{%=file.url%}" width="80"></a>
                    {% } %}
                    </td>
                <td class="name">
                    <span>{%=file.name%}</span>
                </td>
                <td class="size">{%=file.size%} KB</td>
                <td colspan="2"></td>
            {% } %}
            <td class="delete">
                <button class="btn btn-danger btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                    <i class="fa fa-trash icon-white"></i> ลบ
                </button>
                <input type="checkbox" name="delete" value="1">
            </td>
        </tr>
        {% } %}
    </script>
</div>

<script>
    $(function() {
        chkReporttype();
        $('#datetimepicker1').datetimepicker({
            language: 'th'
        });
        $('#rt_reporttypeid').change(function() {
            chkReporttype();
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
            $('.group-attach-file').append('<input class="form-control" type="file" name="attach_file[]">');
            return false;
        });
        $("#checkAll01").click(function() {
            $(".check01").prop('checked', $(this).prop('checked'));
        });
        $("#checkAll02").click(function() {
            $(".check02").prop('checked', $(this).prop('checked'));
        });
        $("#checkAll03").click(function() {
            $(".check03").prop('checked', $(this).prop('checked'));
        });
        
        $('#datetimepicker2').datetimepicker({
            pickDate: false,
            pickSeconds: false,
        });
        $('.nav-tabs li a').click(function(){
            $('.tab-pane.active form.section').append('<input type="hidden" name="tab" value="' + $(this).data('tabid') + '" />');
            $('.tab-pane.active form.section').submit();
        });
           // $("ul.nav-tabs li:nth-child(1) a").tab('show');
        $('a.m-paragraph').click(function(){
            $('#myModalParagraph iframe').attr('src', $(this).attr('href'));
            $('#myModalParagraph').modal('show');
            return false;
        });
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
//        $('select[name="person[]"], select[name="organization[]"], select[name="movement[]"]').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา'});
    });
    function chkReporttype() {
        if ($('select#rt_reporttypeid option:selected').val() >= 4) {
            $('.type').show();
            $('.type-1').hide();
            $('.type-2').show();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 1 && $('select#rt_reporttypeid option:selected').val() <= 3) {
            $('.type').show();
            $('.type-2').hide();
            $('.type-1').show();
        } else {
            $('.type').hide();
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
    function validate(evt) {
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
<script>
//$('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">ยังไม่มีการแก้ไข *</a>');
$('#btn_add').html('<button type="submit" class="btn btn-success">แก้ไข</button>');
$('#p_firstname').change(function(){  
    //alert('hi');
    check_availability();
});
$('#p_lastname').change(function(){ 
    //alert('hi');
    check_availability();
});
function check_availability(){  
            //get the username  
            var p_firstname = $('#p_firstname').val();
            var p_lastname = $('#p_lastname').val(); 
            //use ajax to run the check  
            $.post("person/check_name", { p_firstname: p_firstname , p_lastname:p_lastname },  
                function(result){ 
                    //if the result is 1 
                    //alert(result);
                    if(result == 1){   
                        ckUsername = true;
                    }else{
                        ckUsername = false;
                    }
                    btn_add(ckUsername);
                    if(result == 3){
                            $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">ชื่อ-นามสกุล (ซ้ำ)</a>');
                    }
            });
}
    function btn_add(ckUser){
           //alert(ckUser);
           //alert(ckPass);
                if(ckUser === true){
                    $('#btn_add').html('<button type="submit" class="btn btn-success">แก้ไข</button>');
                }else{
                    $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
                }
    }
    function delImage(path,id) {
        if(confirm("ยืนยันการลบรูปภาพ!!!") == true) {
            //alert(path+id);
             $.post("person/del_pic", { path: path , id:id },  
                function(result){ 
                    //alert(result);
                    if(result == 1){
                        url = '/person/updateTap1/'+id+'/0?del_pic='+path;
                        window.location = url;
                        //location.reload();
                    }else{
                        alert('ลบรูปภาพของไม่สำเร็จ');
                    }
            });
        }
    }
</script>