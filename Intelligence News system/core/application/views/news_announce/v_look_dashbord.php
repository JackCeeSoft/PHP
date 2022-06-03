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
                        <a href="news_announce/lists">
                            <button type="reset" class="btn btn-default">กลับหน้าหลัก</button>
                        </a>
                </div>
                <br>
                <div class="panel panel-primary">
                    
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i> กรอกข้อมูลข่าวสาร</h3>
                        </div>

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
                                    <li<?= $tap1;?>><a href="#menu1" data-toggle="tab" aria-expanded="false">ข้อมูลข่าวสาร</a></li>

                                    <!--<li><a href="#profile2" data-toggle="tab" aria-expanded="false">รายละเอียดเพิ่มเติม</a></li>-->
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade <?= $active_in_tap1;?>" id="menu1">
                                        <br>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">หัวข้อข่าวสาร :  *</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input class="form-control" name="d_fullnameth" value="<?= $result['d_fullnameth']?>" disabled>
                                                <input type="hidden" class="form-control" name="d_fullnameth" value="<?= $result['d_fullnameth']?>" >
                                            </div>
                                        </div>
                                        <br/><br/>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="col-lg-2">
                                                    <label class="control-label right">วันเวลามีผล : *</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-append date" id="datetimepicker1">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_startdate" readonly <?= (isset($filter['d_startdate']) and $filter['d_startdate']) ? 'value="'.$filter['d_startdate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
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
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_enddate" readonly <?= (isset($filter['d_enddate']) and $filter['d_enddate']) ? 'value="'.$filter['d_enddate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
                                                        <span class="add-on">
                                                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/><br/>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ไฟล์แนบข่าวสาร :  *</label>
                                            </div>
                                            
                                            <div class="col-lg-10">
                                                    <?php if(isset($attach) and $attach) { ?>
                                                        <table class="table table-attach mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>ชื่อไฟล์</th>
                                                                    <!--<th class="text-center">ลบ</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                foreach ($attach as $k_attach => $v_attach) { ?>
                                                                    <tr>
                                                                        <th scope="row"><?= ($k_attach + 1); ?>.</th>
                                                                        <td><a href="<?= $this->announce_file_path.$v_attach['d_announceid'].'/'.$v_attach['df_path']; ?>" target="_blank"><?= $v_attach['df_path']; ?></a></td>
                                                                        <!--<td class="text-center">-->
                                                                            <!--<input type="checkbox" name="del_attach[]" value="<?= $v_attach['df_fileattachid_id']; ?>">-->
                                                                        <!--</td>-->
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php }else{
                                                   echo "#ไม่มีเอกสารแนบ<br/><br/><br/>";
                                                    } ?>
                                                </div>
                                         
                                        </div>
                                  
                                        <div class="form-group">
                                        <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดความเคลื่อนไหว  : </label>
                                            </div>
                                            
                                            <div class="col-lg-9">
                                                <textarea disabled class="ckeditor" name="editor1"><?php if(isset($result['d_movement']) and $result['d_movement']) echo $result['d_movement']; ?></textarea>
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