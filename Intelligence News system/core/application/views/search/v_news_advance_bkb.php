<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>
                    <div class="col-lg-8">
                        <div class="form-group type">
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
                        
                        <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">ที่ : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_place" <?= (isset($result['n_place']) and $result['n_place']) ? 'value="'.$result['n_place'].'"' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">วันเวลา : *</label>
                            </div>
                           <div class="col-lg-9">
                                <div class="input-append date" id="datetimepicker1">
                                    <input data-format="yyyy-MM-dd" type="text" name="n_datetime_s" value="<?= (isset($result['n_datetime_start']) and $result['n_datetime_start']) ? 'value="'.$result['n_datetime_start'].'"' : ''; ?>">
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                                    </span>
                                </div>
                                
                                <span class="date-range">ถึง</span>
                                
                                <div class="input-append date" id="datetimepicker2">
                                    <input data-format="yyyy-MM-dd" type="text" name="n_datetime_e" value="<?= (isset($result['n_datetime_end']) and $result['n_datetime_end']) ? 'value="'.$result['n_datetime_end'].'"' : ''; ?>">
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
            $('.type').show();
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