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
<link rel="stylesheet" type="text/css" media="screen" href="assets/colorbox/theme2/colorbox.css" />
<script  type="text/javascript" src="assets/colorbox/jquery.colorbox.js"></script>
<script  type="text/javascript">
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
        $(document).on( "click", "button.btn-danger.delete, button.btn-danger.btn-sm", function() {
            console.log('fileuploaddrop');  // jQuery 1.7+
            setTimeout(function(){ ajaxImageList(); }, 500);
        });
        
        $(document).on( "click", ".add", function(){
            var img = '<img width="400" src="'+$(this).data('path')+'" />'
            window.parent.CKEDITOR.instances.np_paragraph.insertHtml(img); 
            window.parent.$('.close-modal').click();
            //alert('ใส่รูปเรียบร้อย');
        });
        
        $(".gallery").colorbox({rel: 'gallery', height : '80%'});
        
    });
    
    function ajaxImageList() {
        var action = '<?= (empty($_GET['popup'])) ? 'del' : 'add'; ?>';
        $.post('<?= base_url(); ?>news/ajaxImageList', { id : <?= $id; ?>, action : action }, function(data){
            $('ul.image-list').parent().show();
            $('ul.image-list').html(data.gallery);
            $('ul.image-unit-list').html(data.gallery_unit);
        }, 'json');
    }
    
    function delImage(obj, id, type) {
        if(confirm("ยืนยันการลบรูปภาพ!!!") == true) {
            $.post('<?= base_url(); ?>jq_upload/deleteImage/' + id, { type : type }, function(data){
                $.each(data, function( index, value ) {
                    if(value.sucess == true) {
                        obj.parent().parent().remove();
                    }
                });
            }, 'json');
        }
    }
</script>
<div id="page-wrapper" class="bg-fff">
    <?php if(empty($_GET['popup'])) { ?>
        <?php $this->load->view('layout/_nav', $this->data); ?>
        <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <?php } ?>
    <div class="container">
        <h3>หัวข้อข่าว : <?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : ''; ?></h3>
        <div class="panel panel-default col-lg-12 center pt-15" style="<?= (isset($gallery) and $gallery) or (isset($gallery_unit) and $gallery_unit) ? 'display: block;' : 'display: none;'; ?>">
            <ul class="image-list">
                <?php if(isset($gallery) and $gallery) { ?>
                    <?php foreach ($gallery as $k_gallery => $v_gallery) { ?>
                        <li>
                            <div>
                                <a class="gallery" href="<?= getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>">
                                    <img alt="" src="<?= getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>" width="100" height="100">
                                </a>
                            </div>
                            <div>
                                <?php if(empty($_GET['popup'])) { ?>
                                    <button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), <?= $v_gallery['ni_imageattachid']; ?>, 'news');">ลบ</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), <?= $v_gallery['ni_imageattachid']; ?>, 'news');">ลบ</button>
                                    <button type="button" class="btn btn-primary btn-xs add" data-path="<?= base_url().getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>">ใส่รูป</button>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <h3>รูปภาพของระบบ</h3>
            <ul class="image-unit-list">
                <?php if(isset($gallery_unit) and $gallery_unit) { ?>
                    <?php foreach ($gallery_unit as $k_gallery_unit => $v_gallery_unit) { ?>
                        <li>
                            <div>
                                <a class="gallery" href="<?= getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']); ?>">
                                    <img alt="" src="<?= getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']); ?>" width="100" height="100">
                                </a>
                            </div>
                            <div>
                                <?php if(empty($_GET['popup'])) { ?>
                                    <button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), <?= $v_gallery_unit['ui_imageattachid']; ?>, 'unit');">ลบ</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger btn-xs del" onclick="delImage($(this), <?= $v_gallery_unit['ui_imageattachid']; ?>, 'unit');">ลบ</button>
                                    <button type="button" class="btn btn-primary btn-xs add" data-path="<?= base_url().getImagePath($this->unit_images_path . $v_gallery_unit['u_code'] . '/' . $v_gallery_unit['ui_path']); ?>">ใส่รูป</button>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <p>ไม่พบรูปภาพในระบบ..</p>
                <?php } ?>
            </ul>
        </div>
        <div class="panel panel-default col-lg-12 center pt-15">
            <form id="fileupload" action="<?= site_url('jq_upload/upload_img/'.$id); ?>" method="POST" enctype="multipart/form-data">
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <div class="row fileupload-buttonbar" style="margin: 0;">
                    <div>
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <span><i class="fa fa-plus"></i> เพิ่มไฟล์...</span>
                            <input type="file" name="userfile" id="imageFile" multiple>
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
                        
                        <div class="form-group" style="  width: 262px; float: right;">
                            <label for="type" style="display: inline-block;">ประเภท :</label>
                            <select class="form-control" id="type" name="type" style="width: 200px; display: inline-block;">
                                <option value="news">รูปภาพของข่าว (Private)</option>
                                <option value="unit">รูปภาพของระบบ (Public)</option>
                            </select>
                        </div>
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