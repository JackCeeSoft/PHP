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
    <div class="container">

            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } ?>
                        <div>
                        <a href="news_announce/search_org_news">
                            <button type="reset" class="btn btn-default">กลับหน้าหลัก</button>
                            </a>
                        </div>
                
                <br>
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i> กรอกข้อมูลองค์กร</h3>
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
                                        }
                                        if($check_tap == "submit_tap4"){
                                                $tap4 = ' class="active"';
                                                $active_in_tap4 = " active in";
                                                $tap1 = '';
                                                $active_in_tap1 = "";
                                                $tap2 = '';
                                                $active_in_tap2 = "";
                                        }
                                    }
                                ?>
                                <br>
                                <ul class="nav nav-tabs margin0px">
                                    <li<?= $tap1;?>><a href="#menu1" data-toggle="tab" aria-expanded="false">ข้อมูลองค์กร</a></li>

                                    <!--<li<?= $tap4;?>><a href="#profile2" data-toggle="tab" aria-expanded="false">รายละเอียดเพิ่มเติม</a></li>-->
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade <?= $active_in_tap1;?>" id="menu1">
                                        <br>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">หัวข้อข่าวสาร :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" id="d_fullnameth" name="d_fullnameth" value="<?= $result['d_fullnameth']?>" required>
                                            </div>
                                            <div class="col-lg-4">
                                                 
                                                 <div id='username_availability_result'>
                                                 </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="col-lg-2">
                                                    <label class="control-label right">วันเวลา : *</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-append date" id="datetimepicker1">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_startdate" required <?= (isset($result['d_startdate']) and $result['d_startdate']) ? 'value="'.$result['d_startdate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
                                                        <span class="add-on">
                                                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <span class="date-range"> ถึง </span>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-append date" id="datetimepicker2">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_enddate" required <?= (isset($result['d_enddate']) and $result['d_enddate']) ? 'value="'.$result['d_enddate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
                                                        <span class="add-on">
                                                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="form-group type mb-5">-->
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
                                                            <?php 
                                                            foreach ($attach as $k_attach => $v_attach) { ?>
                                                                <tr>
                                                                    <th scope="row"><?= ($k_attach + 1); ?>.</th>
                                                                    <td><a href="<?= $this->announce_file_path.$v_attach['d_announceid'].'/'.$v_attach['df_path']; ?>" target="_blank"><?= $v_attach['df_path']; ?></a></td>
                                                                    <td class="text-center">
                                                                        <input type="checkbox" name="del_attach[]" value="<?= $v_attach['df_fileattachid_id']; ?>">
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <!--</div>-->
                                        <div class="form-group">
                                             <div class="col-lg-2">
                                                <label class="control-label right">เอกสารแนบ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-10 group-attach-file">
                                                        <input class="form-control attach_file" type="file" name="attach_file[]">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button class="btn btn-success mt--25" id="add_more_file">เพิ่มไฟล์ </button>
                                                    </div>
                                                </div>
                                                <span class="form-comment">นามสกุลไฟล์ doc/docx/dot/dotx/xls/xlsx/pdf/ppt/rar/zip</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดความเคลื่อนไหว  : </label>
                                            </div>
                                            
                                            <div class="col-lg-7">
                                            <textarea class="ckeditor" name="editor1"><?php if(isset($result['d_movement']) and $result['d_movement']) echo $result['d_movement']; ?></textarea>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="col-lg-2">
                                            <label class="control-label right">ใช้งาน : </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <?php 
                                                $select_Y = '';
                                                $select_N = '';
                                                if(isset($result['d_isactive']) && $result['d_isactive'] == 'Y'){
                                                    $select_Y = 'selected';
                                                }else{
                                                    $select_N = 'selected';
                                                }
                                            ?>
                                            <select class="form-control" name="d_isactive">
                                                <option value="Y" <?= $select_Y;?>>ใช้งาน</option>
                                                <option value="N" <?= $select_N;?>>ไม่ใช้งาน</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit"  class="btn btn-success">บันทึก</button>
<!--                                            <a href="<?= site_url('news_announce/pdf_newsdashbord/'.$result['d_announceid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด PDF</a>
                                            <a href="<?= site_url('news_announce/word_newsdashbord/'.$result['d_announceid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด Word</a>-->
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
                                                        <input type="text" class="form-control" name="no_search_text" value="<?php if (isset($no_search_test)) echo $no_search_test; ?>" placeholder="ค้นหาลำดับความเคลื่อนไหว">
                                                        <span class="input-group-btn">
                                                        <br>
                                                        <button type="submit" name="submit_tap" value="submit_tap2" class="btn btn-default" type="button">ค้นหา</button>
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
                                                        $words = $no_search_test." ".$result['d_fullnameth'];
                                                        $n_subject = highlightWords($values['n_subject'], $words);
                                                        $url_news = site_url('news/detail/'.$news_id.'/'.$words.'?p='.$values['np_paragraph_id']);
                                                    }else{
                                                        $n_subject = highlightWords($values['n_subject'],$result['d_fullnameth']);
                                                        $url_news = site_url('news/detail/'.$news_id.'/'.$result['d_fullnameth'].'?p='.$values['np_paragraph_id']);
                                                    }
                                                    
                                                    echo '<h2><a href="'.$url_news.'">'.$n_subject.'</a></h2>';
                                                }
                                        ?> 
                                            <div class="span13 blog-article float_left">
                                                <p><?php 
                                            if(isset($no_search_test) && $no_search_test!= ""){
                                                //$words = str_split($no_search_test) ;
                                                $words = $no_search_test." ".$result['d_fullnameth'];
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$words);                                        
                                                $n_writer = highlightWords($n_writer_Tags, $words);
                                            }else{
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$result['d_fullnameth']);
                                                $n_writer = highlightWords($n_writer_Tags,$result['d_fullnameth']);
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


                                      
                                </div>
                            </fieldset>
                        
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
    $('#datetimepicker1').datetimepicker({

    });
    
    $('#datetimepicker2').datetimepicker({

    });
    $(document).ready(function() {  
        //the min chars for username  
         
        //result texts  
         $('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
      }); 

/*-----------------------start manage paragraph -----------------------*/   

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
            });
        <?php } ?>
        <?php if(isset($result) and $result) { ?>
            $('button.paragraph-preview').click(function(){
                editor_val = CKEDITOR.instances.np_paragraph.document.getBody().getChild(0).getHtml();
                //console.log(editor_val);
                //$.post('<?= site_url('news/detail/'); ?>?popup=1', { paragraph_preview: editor_val }, function(data) {
                    //var theHtmlString = escapeHtml($(data).result('#page-wrapper').html());
                    //console.log(theHtmlString);
                   // $('iframe#paragraph-preview').contents().find('html').html(data);
                //});
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
        /*-----------------------end manage paragraph -----------------------*/
$('#add_more_file').click(function() {
    $('.group-attach-file').append('<input class="form-control attach_file" type="file" name="attach_file[]">');
    return false;
});
$('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
$('#check_username_availability').click(function(){  
            //run the character number check
            var min_chars = 6;
            var characters_error = '<div class="alert alert-danger">รหัสผู้ใช้งานต้องมีความยาวมากกว่าเท่ากับ 6 ตัวอักษร </div>';  
            var checking_html = 'กำลังตรวจสอบ...';
            
            if($('#d_fullnameth').val().length < min_chars){  
                //if it's bellow the minimum show characters_error text '  
                $('#username_availability_result').html(characters_error);
                ckUsername = false;
            }else{  
                //else show the cheking_text and run the function to check  
                $('#username_availability_result').html(checking_html);  
                check_availability();
                
            }
            btn_add(ckUsername);
        }); 

function check_availability(){  
            //get the username  
            var username = $('#d_fullnameth').val();  

            //use ajax to run the check  
            $.post("news_announce/check_name", { username: username },  
                function(result){ 
                    //if the result is 1  
                    if(result == 1){  
                        //show that the username is available  
                        //$('#username_availability_result').html(username + ' is Available');  
                        $('#username_availability_result').html('<div class="alert alert-success"><strong>'+username+' </strong> สามารถใช้งานได้ </div>');  
                        ckUsername = true;
                        //alert(ckUsername);
                    }else{  
                        //show that the username is NOT available  
                        $('#username_availability_result').html('<div class="alert alert-danger"><strong>'+username+' </strong> ไม่สามารถใช้ได้เนื่องจากซ้ำซ้อน </div>');
                        ckUsername = false;
                    }
                    btn_add(ckUsername);
            });  
}
function btn_add(ckUser){
       //alert(ckUser);
       //alert(ckPass);
            if(ckUser === true){
                $('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
            }else{
                $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
            }
}
function delImage(path,id) {
        if(confirm("ยืนยันการลบรูปภาพ!!!") == true) {
            //alert(path+id);
             $.post("news_announce/del_pic", { path: path , id:id },  
                function(result){ 
                    //alert(result);
                    if(result == 1){
                        url = '/news_announce/updateTap1/'+id+'/0?del_pic='+path;
                        window.location = url;
                        //location.reload();
                    }else{
                        alert('ลบรูปภาพของไม่สำเร็จ');
                    }
            });
        }
    }

</script>