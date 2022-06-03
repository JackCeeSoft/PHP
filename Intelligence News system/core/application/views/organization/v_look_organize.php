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

<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel col-lg-12 center">
            <div class="panel col-lg-12 center">

            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } ?>
                <div>
                        <a href="organization/search_org_news">
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
                                        $active_in_tap1 = " active in";
                                        $active_in_tap2 = "";
                                    if(isset($check_tap) && $check_tap!=""){
                                        if($check_tap == "submit_tap1"){
                                            $tap1 = ' class="active"';
                                            $active_in_tap1 = " active in";
                                            $tap2 = '';
                                            $active_in_tap2 = "";
                                        }
                                        if($check_tap == "submit_tap2"){
                                                $tap2 = ' class="active"';
                                                $active_in_tap2 = " active in";
                                                $tap1 = '';
                                                $active_in_tap1 = "";
                                            }
                                    }
                                ?>
                                <br>
                                <ul class="nav nav-tabs margin0px">
                                    <li<?= $tap1;?>><a href="#menu1" data-toggle="tab" aria-expanded="false">ข้อมูลองค์กร</a></li>
                                    <li<?= $tap2;?>><a href="#profile3" data-toggle="tab" aria-expanded="false">ลำดับความเคลื่อนไหว</a></li>
                                    <li><a href="#profile1" data-toggle="tab" aria-expanded="false">รูปภาพ</a></li>
<!--                                    <li><a href="#profile2" data-toggle="tab" aria-expanded="false">รายละเอียดเพิ่มเติม</a></li>-->
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade <?= $active_in_tap1;?>" id="menu1">
                                        <br>
                                        <div class="form-group">
                                            <div class="col-lg-12 blog-tag-data-inner">
                                                <?= (isset($result['o_mainimage']) and $result['o_mainimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->images_path . $result['o_organizationid'] . '/' . $result['o_mainimage']) . '" /></div>' :'<img src="assets/img/mockup/no-image.gif" alt="">'; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อองค์กร :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_fullnameth" value="<?= $result['o_fullnameth']?>" disabled>
                                                <input type="hidden" class="form-control" name="o_fullnameth" value="<?= $result['o_fullnameth']?>" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาไทย :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameth" value="<?= $result['o_shortnameth']?>" disabled>
                                                <input type="hidden" class="form-control" name="o_shortnameth" value="<?= $result['o_shortnameth']?>" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_fullnameen" value="<?= $result['o_fullnameen']?>" disabled>
                                                <input type="hidden" class="form-control" name="o_fullnameen" value="<?= $result['o_fullnameen']?>" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameen" value="<?= $result['o_shortnameen']?>" disabled>
                                                 <input  type="hidden" class="form-control" name="o_shortnameen" value="<?= $result['o_shortnameen']?>" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ที่อยู่องค์กร :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <textarea disabled class="form-control" name="o_address"><?= $result['o_address']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดความเคลื่อนไหว  : </label>
                                            </div>
                                            
                                            <div class="col-lg-9">
                                                <textarea disabled class="ckeditor" name="editor1"><?php if(isset($result['o_movement']) and $result['o_movement']) echo $result['o_movement']; ?></textarea>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('organization/pdf_organize/'.$result['o_organizationid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด PDF</a>
                                        <a href="<?= site_url('organization/word_organize/'.$result['o_organizationid']); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i> ดาวน์โหลด Word</a>
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
                                        //print_r($news_all);
                                        //$news_all['link_news_np'] = '';
                                       //print_r($news_all);
                                        if(isset($news_all) && $news_all != ""){                                             
                                            foreach ($news_all as $key => $values){
                                            if($values['n_newsid'] != $news_id){
                                                $news_id = $values['n_newsid'];
                                                if(isset($no_search_test) && $no_search_test!= ""){
                                                    //$words = str_split($no_search_test) ;
                                                    //print_r($words);
                                                    $words = $no_search_test." ".$result['o_fullnameth'];
                                                    $n_subject = highlightWords($values['n_subject'], $words);
                                                    $url_news = site_url('news/detail/'.$news_id.'/'.$words.'?p='.$values['np_paragraph_id']);
                                                }else{
                                                    //$url_encode_text = urlencode($result['o_fullnameth']);
                                                    $n_subject = highlightWords($values['n_subject'],$result['o_fullnameth']);
                                                    $url_news = site_url('news/detail/'.$news_id.'/'.$result['o_fullnameth'].'?p='.$values['np_paragraph_id']);
                                                }
                                                
                                                    echo '<h2><a href="'.$url_news.'">'.$n_subject.'</a></h2>';
                                            }
                                        ?> 
                                            <div class="span13 blog-article float_left">
                                                <p><?php 
                                            if(isset($no_search_test) && $no_search_test!= ""){
                                                //$words = str_split($no_search_test) ;
                                                $words = $no_search_test." ".$result['o_fullnameth'];
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$words);                                        
                                                $n_writer = highlightWords($n_writer_Tags, $words);
                                                
                                            }else{
                                                $n_writer_Tags = cutCaption_Keyword(stripHTMLTags($values['np_paragraph']),800,$result['o_fullnameth']);
                                                $n_writer = highlightWords($n_writer_Tags,$result['o_fullnameth']);
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
                    <div class="tab-pane fade" id="profile1"> 
                        <div class="panel panel-default col-lg-12 center pt-15" id="profile1">
                            <form id="fileupload" action="<?= site_url('jq_upload_organization/upload_img/'.$result['o_organizationid']); ?>" method="POST" enctype="multipart/form-data">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar" style="margin: 0;">
<!--                                    <div>
                                         The fileinput-button span is used to style the file input field as button 
                                        <span class="btn btn-success fileinput-button">
                                            <span><i class="fa fa-plus"></i> เพิ่มไฟล์...</span>
                                            <input type="file" name="userfile" multiple >
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
                                    </div>-->
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
                        <?php //print_r($image); ?>
                            <div class="col-lg-12 blog-tag-data-inner">
                                <div class="col col-3">
                                       <?php 
                                        if(isset($image) && $image){
                                            foreach ($image as $key=>$values){
                                                echo ' <img src="upload/organization_image_gallery/'.$image[$key]['o_organizationid'].'/'.$image[$key]['oi_path'].'" width="250" height="170">';
                                            } 
                                        }
                                       ?>
                                </div>
                            </div>
                    </div>
                                    <!-- profile2 -->
                                    <div class="tab-pane fade" id="profile2">
                                        <br>
                                        <div class="form-group">
                                            
                                            
                                            <div class="col-lg-9" hidden="hidden">
                                                <textarea class="ckeditor" name="editor1"><?php if(isset($result['o_movement']) and $result['o_movement']) echo $result['o_movement']; ?></textarea>
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