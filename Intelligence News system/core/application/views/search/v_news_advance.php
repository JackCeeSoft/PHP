<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>
                    <div class="col-lg-8">
                        
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label right">Keyword : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="keyword">
                            </div>
                        </div>
                        <div class="form-group">
                            <p></p>
                            <div class="col-lg-3">
                                <label class="control-label right">ประเภทรายงาน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="rt_reporttypeid" name="rt_reporttypeid">
                                    <option value="">กรุณาเลือกประเภทรายงาน</option>
                                    <?php foreach ($report_type as $v_rt) { ?>
                                        <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group type type-4">
                            <div class="col-lg-3">
                                <label class="control-label right">ความเร่งด่วน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" name="hl_hastelevelid">
                                    <option value="">กรุณาเลือกความเร่งด่วน</option>
                                    <?php foreach ($haste_level as $v_hl) { ?>
                                        <option value="<?= $v_hl['hl_hastelevelid']; ?>" <?= (isset($result['hl_hastelevelid']) and $result['hl_hastelevelid'] == $v_hl['hl_hastelevelid']) ? 'selected' : ''; ?>><?= $v_hl['hl_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group type type-3">
                            <div class="col-lg-3">
                                <label class="control-label right">ส่วนราชการ : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_government" <?= (isset($result['n_government']) and $result['n_government']) ? 'value="'.$result['n_government'].'"' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">ชั้นความลับ : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" name="sl_secretid">
                                    <option value="">กรุณาเลือกชั้นความลับ</option>
                                    <?php foreach ($secret_level as $v_sl) { ?>
                                        <option value="<?= $v_sl['sl_secretid']; ?>" <?= (isset($result['sl_secretid']) and $result['sl_secretid'] == $v_sl['sl_secretid']) ? 'selected' : ''; ?>><?= $v_sl['sl_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">แผนกด้าน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" name="nd_newsdepartmentid">
                                    <option value="">กรุณาเลือกแผนกด้าน</option>
                                    <?php foreach ($news_department as $v_sl) { ?>
                                        <option value="<?= $v_sl['nd_newsdepartmentid']; ?>" <?= (isset($result['nd_newsdepartmentid']) and $result['nd_newsdepartmentid'] == $v_sl['nd_newsdepartmentid']) ? 'selected' : ''; ?>><?= $v_sl['nd_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>-->

<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ประเภทข่าวกรอง  : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" name="nt_newstypeid">
                                    <option value="">กรุณาเลือกประเภทข่าวกรอง</option>
                                    <?php foreach ($news_type as $v_hl) { ?>
                                        <option value="<?= $v_hl['nt_newstypeid']; ?>" <?= (isset($result['nt_newstypeid']) and $result['nt_newstypeid'] == $v_hl['nt_newstypeid']) ? 'selected' : ''; ?>><?= $v_hl['nt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>-->
                        
<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">จาก : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_from" <?= (isset($result['n_from']) and $result['n_from']) ? 'value="'.$result['n_from'].'"' : ''; ?>>
                            </div>
                        </div>-->

<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ที่ของผู้ให้ข่าว : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_source" <?= (isset($result['n_source']) and $result['n_source']) ? 'value="'.$result['n_source'].'"' : ''; ?>>
                            </div>
                        </div>-->

<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ระบบรายงาน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" name="ru_reportunitid">
                                    <option value="">กรุณาเลือกระบบรายงาน</option>
                                    <?php foreach ($report_unit as $v_ru) { ?>
                                        <option value="<?= $v_ru['ru_reportunitid']; ?>" <?= (isset($result['ru_reportunitid']) and $result['ru_reportunitid'] == $v_ru['ru_reportunitid']) ? 'selected' : ''; ?>><?= $v_ru['ru_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>-->

<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ผู้รับปฏิบัติ : </label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="n_perform"><?= (isset($result['n_perform']) and $result['n_perform']) ? $result['n_perform'] : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ผู้รับทราบ : </label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="n_aware"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : ''; ?></textarea>
                            </div>
                        </div>-->
                        
                        
                        
                        <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">ที่ : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_place" <?= (isset($result['n_place']) and $result['n_place']) ? 'value="'.$result['n_place'].'"' : ''; ?>>
                            </div>
                        </div>
                        
<!--                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">สิ่งที่แนบมาด้วย : </label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="n_attachdetail"><?= (isset($result['n_attachdetail']) and $result['n_attachdetail']) ? $result['n_attachdetail'] : ''; ?></textarea>
                            </div>
                        </div>-->

                        
                        
                       <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">วันเวลา : *</label>
                            </div>
                           <div class="col-lg-9">
                                <div class="input-append date" id="datetimepicker1">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="n_datetime_s" value="<?= (isset($result['n_datetime_start']) and $result['n_datetime_start']) ? 'value="'.$result['n_datetime_start'].'"' : ''; ?>">
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                                    </span>
                                </div>
                                
                                <span class="date-range">ถึง</span>
                                
                                <div class="input-append date" id="datetimepicker2">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="n_datetime_e" value="<?= (isset($result['n_datetime_end']) and $result['n_datetime_end']) ? 'value="'.$result['n_datetime_end'].'"' : ''; ?>">
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                                    </span>
                                </div>
                            </div>
                       </div>
                       
                       <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">เรื่อง : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_subject" <?= (isset($result['n_subject']) and $result['n_subject']) ? 'value="'.$result['n_subject'].'"' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">เรียน : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_to" <?= (isset($result['n_to']) and $result['n_to']) ? 'value="'.$result['n_to'].'"' : ''; ?>>
                            </div>
                        </div>
                        
                        <div class="form-group type type-2">
                            <div class="col-lg-3">
                                <label class="control-label right">ผู้รับทราบ : </label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="n_aware"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ชื่อผู้รวบรวมและรายงานข่าว : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_writer" <?= (isset($result['n_writer']) and $result['n_writer']) ? 'value="'.$result['n_writer'].'"' : ''; ?>>
                            </div>
                        </div>

                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">ชื่อผู้อนุมัติข่าว : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_approver" <?= (isset($result['n_approver']) and $result['n_approver']) ? 'value="'.$result['n_approver'].'"' : ''; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p><button type="submit" class="btn btn-success btn-lg btn-block">ค้นหา <i class="fa fa-search"></i></button></p>
                    </div>
                </fieldset>
                
            </form>
        </div>
        <div class="pull-right">
                <a href="<?= site_url('search/news'); ?>" align="right">ค้นหาแบบธรรมดา</a> 
                <i class="fa fa-search"></i>
            </div>
    </div>
</div>
<script>
    $(function() {
        chkReporttype();
        $('#rt_reporttypeid').change(function() {
            chkReporttype();
        });
        $('#datetimepicker1').datetimepicker({
            language: 'th'
        });
        $('#datetimepicker2').datetimepicker({
//            pickDate: false,
//            pickSeconds: false,
            language: 'th'
        });
    });
    function chkReporttype() {
        if ($('select#rt_reporttypeid option:selected').val() >= 6) { // ด่วน
            $('.type').show();
            $('.type-1').show();
            $('.type-2').show();
            $('.type-3').hide();
            $('.type-4').show();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 5) { // สภิติ
            $('.type').show();
            $('.type-1').show();
            $('.type-2').show();
            $('.type-3').show();
            $('.type-4').hide();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 4) { //กรณี
            $('.type').show();
            $('.type-1').show();
            $('.type-2').show();
            $('.type-3').show();
            $('.type-4').hide();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 3) { //month
            $('.type').show();
            $('.type-1').show();
            $('.type-2').show();
            $('.type-3').show();
            $('.type-4').hide();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 2) { //week
            $('.type').show();
            $('.type-1').show();
            $('.type-2').show();
            $('.type-3').show();
            $('.type-4').hide();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 1) { //วัน
            $('.type').show();
            $('.type-1').hide();
            $('.type-2').hide();
            $('.type-3').hide();
            $('.type-4').hide();
        } else {
            $('.type').hide();
        }
    }
</script>
<script type="text/javascript">
$(function() {
    <?php if(isset($movemented) and $movemented) { ?>
        getSelected();
    <?php } ?>
    /*------------------------ datetimepicker ------------------------*/
    $('#datetimepicker1').datetimepicker({
        language: 'en ',
        pickTime: true, 
    });
    
    $('#datetimepicker2').datetimepicker({
        language: 'en ',
        pickTime: true, 
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