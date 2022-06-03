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
        <h3>หัวข้อข่าว : <?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : ''; ?></h3>
        <div class="panel panel-default col-lg-12 center pt-15">
            <form id="fileupload" action="<?= site_url('jq_upload/upload_img/'.$id); ?>" method="POST" enctype="multipart/form-data">
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