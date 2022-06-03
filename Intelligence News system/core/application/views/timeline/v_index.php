<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="" method="POST">
                <br>   
                <!--<button type="submit" class="btn btn-primary float_right">เพิ่มปฎิทินความเคลื่อนไหว <i class="fa fa-plus-circle"></i></button>-->
                <div class="clear"></div>
                <p>
                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label right">ประเภทรายงาน : </label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control required" id="rt_reporttypeid" name="rt_reporttypeid" required>
                                <?php foreach ($report_type as $v_rt) { ?>
                                    <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($filter['rt_reporttypeid']) and $filter['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </p>
                
                <?php /*<div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ระบบรายงาน : </label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control required" name="ru_reportunitid">
                            <option value="">กรุณาเลือกระบบรายงาน</option>
                            <?php foreach ($report_unit as $v_ru) { ?>
                                <option value="<?= $v_ru['ru_reportunitid']; ?>" <?= (isset($filter['ru_reportunitid']) and $filter['ru_reportunitid'] == $v_ru['ru_reportunitid']) ? 'selected' : ''; ?>><?= $v_ru['ru_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>*/ ?>
                 
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">วันเวลา : *</label>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-append date" id="datetimepicker1">
                            <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="start" required <?= (isset($filter['start']) and $filter['start']) ? 'value="'.$filter['start'].'"' : 'value="'.date('Y-m-d').' 00.00.01"'; ?>>
                            <span class="add-on">
                                <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <span class="date-range"> ถึง </span>
                        <div class="input-append date" id="datetimepicker2">
                            <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="end" required <?= (isset($filter['end']) and $filter['end']) ? 'value="'.$filter['end'].'"' : 'value="'.date('Y-m-d').' 23.59.59"'; ?>>
                            <span class="add-on">
                                <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>  
                
                <?php /*<div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">แผนกด้าน : </label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="nd_newsdepartmentid">
                            <option value="0">กรุณาเลือกแผนกด้าน</option>
                            <?php foreach ($news_department as $v_nd) { ?>
                                <option value="<?= $v_nd['nd_newsdepartmentid']; ?>" <?= (isset($filter['nd_newsdepartmentid']) and $filter['nd_newsdepartmentid'] == $v_nd['nd_newsdepartmentid']) ? 'selected' : ''; ?>><?= $v_nd['nd_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>*/ ?>

                <?php /*<div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ประเภทข่าวกรอง : </label>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="nt_newstypeid">
                            <option value="0">กรุณาเลือกประเภทข่าวกรอง</option>
                            <?php foreach ($news_type as $v_nt) { ?>
                                <option value="<?= $v_nt['nt_newstypeid']; ?>" <?= (isset($filter['nt_newstypeid']) and $filter['nt_newstypeid'] == $v_nt['nt_newstypeid']) ? 'selected' : ''; ?>><?= $v_nt['nt_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>*/ ?>
                
                <?php /*<div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ความเคลื่อนไหวข่าว : </label>
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
                                    <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                    <div class="clear"></div>
                                    <br>
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
                </div>*/ ?>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบการแสดงผล : </label>
                    </div>

                    <div class="col-lg-6">
                        <label class="radio-inline" style="width: 80px;">
                            <input type="radio" name="view" value="subject" <?= (isset($filter['view']) and $filter['view'] == 'subject') ? 'checked' : ''; ?> > หัวข้อข่าว
                        </label>
                        <label class="radio-inline" style="width: 115px;">
                            <input type="radio" name="view" value="description" <?= (isset($filter['view']) and $filter['view'] == 'description') ? 'checked' : ''; ?> > รายละเอียดข่าว
                        </label>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-block btn-lg btn-success">ค้นหา 
                        <span class="fa fa-search"></span>
                    </button>
                </div>
                <br>
            </div>
        </div>
    </div>
    <?php if(isset($result) and $result) { ?>
        <div class="col-lg-12">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>
                    <div class="container">
                        <div class="span12">
                            <?php $arr_color = array('yellow', 'blue', 'green', 'purple', 'red', 'grey'); ?>
                            <ul class="timeline">
                                <?php $flag = array(); ?>
                                <?php $k = 0; ?>
                                <?php foreach ($result as $key => $value) { ?>
                                    <?php if(isset($filter['view']) and $filter['view'] == 'subject') { ?>
                                        <?php if(empty($flag[$value['n_newsid']])) { ?>
                                            <?php $flag[$value['n_newsid']] = $value['n_newsid']; ?>
                                            <li class="timeline-<?= $arr_color[$k%6]; ?>">
                                                <div class="timeline-time">
                                                    <?php list($dd, $tt) = explode(' ', $value['np_createddate']); ?>
                                                    <?php list($y, $m, $d) = explode('-', $dd); ?>
                                                    <span class="date"><?= $d.'/'.$m.'/'.$y; ?></span>
                                                    <span class="time"><?= substr($tt, 0, 8); ?></span>
                                                </div>
                                                <div class="timeline-icon"><i class="fa fa-newspaper-o"></i></div>
                                                <div class="timeline-body">
                                                    <?= (isset($value['n_subject']) and $value['n_subject']) ? '<h2>'.$value['n_subject'].'</h2>' : ''; ?>
                                                    <div class="timeline-content">
                                                        <?php if(isset($value['np_mainimage']) and $value['np_mainimage']) { ?>
                                                            <img class="timeline-img pull-left" alt="" src="<?= getImagePath($this->paragraph_images_path . $value['np_paragraph_id'] . '/' . $value['np_mainimage']); ?>" width="75" height="75">
                                                        <?php } ?>
                                                        <?= (isset($value['np_paragraph']) and $value['np_paragraph']) ? cutCaption(stripHTMLTags($value['np_paragraph']), 650) : ''; ?>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="<?= site_url('news/detail/'.$value['n_newsid']); ?>" class="nav-link pull-right">
                                                            อ่านต่อ <i class="fa fa-arrow-circle-o-right"></i>                              
                                                        </a>  
                                                    </div>
                                                </div>
                                            </li>
                                            <?php $k++; ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li class="timeline-<?= $arr_color[$k%6]; ?>">
                                            <div class="timeline-time">
                                                <?php list($dd, $tt) = explode(' ', $value['np_createddate']); ?>
                                                <?php list($y, $m, $d) = explode('-', $dd); ?>
                                                <span class="date"><?= $d.'/'.$m.'/'.$y; ?></span>
                                                <span class="time"><?= substr($tt, 0, 8); ?></span>
                                            </div>
                                            <div class="timeline-icon"><i class="fa fa-newspaper-o"></i></div>
                                            <div class="timeline-body">
                                                <?= (isset($value['n_subject']) and $value['n_subject']) ? '<h2>'.$value['n_subject'].'</h2>' : ''; ?>
                                                <div class="timeline-content">
                                                    <?php if(isset($value['np_mainimage']) and $value['np_mainimage']) { ?>
                                                        <img class="timeline-img pull-left" alt="" src="<?= getImagePath($this->paragraph_images_path . $value['np_paragraph_id'] . '/' . $value['np_mainimage']); ?>" width="75" height="75">
                                                    <?php } ?>
                                                    <?= (isset($value['np_paragraph']) and $value['np_paragraph']) ? cutCaption(stripHTMLTags($value['np_paragraph']), 650) : ''; ?>
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="<?= site_url('news/detail/'.$value['n_newsid'].'?p='.$value['np_paragraph_id']); ?>" class="nav-link pull-right">
                                                        อ่านต่อ <i class="fa fa-arrow-circle-o-right"></i>                              
                                                    </a>  
                                                </div>
                                            </div>
                                        </li>
                                        <?php $k++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
$(function() {
    <?php if(isset($movemented) and $movemented) { ?>
        getSelected();
    <?php } ?>
    /*------------------------ datetimepicker ------------------------*/
    $('#datetimepicker1').datetimepicker({
        language: 'en ',
        pickTime: true, 
        endDate: new Date('<?= date('Y-m-d'); ?>')
    });
    
    $('#datetimepicker2').datetimepicker({
        language: 'en ',
        pickTime: true, 
        endDate: new Date('<?= date('Y-m-d'); ?>')
    });
    
    /*$("#datetimepicker1").on("dp.change", function (e) {
        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker2").on("dp.change", function (e) {
        $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
    });*/
    /*------------------------ datetimepicker ------------------------*/
    
    /*------------------------- modal control ------------------------*/
    $('.close-modal').click(function(){
        $('.modal').modal('hide');
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        getSelected();
    });
    /*------------------------- modal control ------------------------*/
    
    var dualListbox = $('select[name="movement[]"]').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา', selectorMinimalHeight: 300});
});

function getSelected() {
    var arr_id = ["movement"];
    $.each( arr_id, function( key, value ) {
        var str = '';
        $('.selected-'+value).html('');
        $( "select#"+value+" option:selected" ).each(function() {
            str += $( this ).text() + ", ";
        });
        $('.selected-'+value).html(str.substring(0, str.length - 2));
    });
}
</script>
<style>
.timeline-icon .fa.fa-newspaper-o {
    margin-top: 10px;
}
.bootstrap-duallistbox-container.row {
    margin-right: -15px;
    margin-left: -15px;
}
.input-append.date {
    display: inline-block;
}
.date-range {
    position: relative;
    top: 21px;
    margin: 0 10px;
}
</style>