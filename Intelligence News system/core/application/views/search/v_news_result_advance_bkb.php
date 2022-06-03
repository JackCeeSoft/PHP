<link rel="stylesheet" href="assets/colorbox/theme2/colorbox.css" />
<script src="assets/colorbox/jquery.colorbox.js"></script>
<script>
    $(function() {
        $(".gallery").colorbox({rel: 'gallery'});
    });
</script>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <form class="form-horizontal" action="" method="POST">
                <fieldset>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <p></p>
                            <div class="col-lg-3">
                                <label class="control-label right">ประเภทรายงาน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="rt_reporttypeid" name="rt_reporttypeid">
                                    <option value="">กรุณาเลือกประเภทรายงาน</option>
                                    <?php foreach ($report_type as $v_rt) {;?>
                                        <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($data_back['rt_reporttypeid']) and $data_back['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group type type-2">
                            <div class="col-lg-3">
                                <label class="control-label right">ที่ : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_place" <?= (isset($data_back['n_place']) and $data_back['n_place']) ? 'value="'.$data_back['n_place'].'"' : ''; ?>>
                            </div>
                        </div>
                         <div class="form-group type">
                            <div class="col-lg-3">
                                <label class="control-label right">วันเวลา : *</label>
                            </div>
                           <div class="col-lg-9">
                                <div class="input-append date" id="datetimepicker1">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="n_datetime_s" <?= (isset($data_back['n_datetime_s']) and $data_back['n_datetime_s']) ? 'value="'.$data_back['n_datetime_s'].'"' : ''; ?>>
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                                    </span>
                                </div>
                                
                                <span class="date-range">ถึง</span>
                                
                                <div class="input-append date" id="datetimepicker2">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="n_datetime_e"  <?= (isset($data_back['n_datetime_e']) and $data_back['n_datetime_e']) ? 'value="'.$data_back['n_datetime_e'].'"' : ''; ?>>
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                                    </span>
                                </div>
                            </div>
                       </div>
                        <div class="form-group type type-1">
                            <div class="col-lg-3">
                                <label class="control-label right">เรื่อง : </label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" name="n_subject" <?= (isset($data_back['n_subject']) and $data_back['n_subject']) ? 'value="'.$data_back['n_subject'].'"' : ''; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <p><button type="submit" class="btn btn-success btn-lg btn-block">ค้นหา <i class="fa fa-search"></i></button></p>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-lg-12 center">
            <div class="pull-right">
                <a href="<?= site_url('search/news'); ?>" align="right">ค้นหาแบบธรรมดา</a> 
                <i class="fa fa-search"></i>
            </div>
            <div class="col-lg-12">
                    <div class="input-group">
                        <span>
                            <h4 class page-header> รายการทั้งหมด <?= $total_rows; ?> </h4>
                        </span>
                    </div>
            </div>
                                    
            <div class="col-lg-12">
                <?php if(!isset($keyword) || isset($advance_search)) { ?>

                <?php }else{?>
                                    <div class="pull-right">
                                        <a href="<?= site_url('search/newsAdvance'); ?>" align="right">ค้นหาละเอียด</a> 
                                        <i class="fa fa-search"></i>
                                    </div>
                <?php } ?>
            </div>

            </p>
            <ul class="nav nav-tabs">
                <br>
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">ข่าวสาร</a></li>
                <li><a href="#profile" data-toggle="tab" aria-expanded="true">รูปภาพ</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <?php 
                    $check_news = 0;
                    if(!isset($keyword)){
                        $keyword = "";
                    }
                    if(isset($result) and $result) { ?>
                    <blockquote>
                        <?php foreach ($result as $v_result) { ?>
                                <?php 
                                if($v_result['n_newsid'] != $check_news) {?>
                                    <div class="clear">___________________________________________________________________________________________________________</div>
                                    <a href="
                                        <?php 
                                        if(isset($keyword) && $keyword != ""){
                                            echo site_url('news/detail/'.$v_result['n_newsid'].'/'.$keyword.'?p='.$v_result['np_hl']);
                                        }else{
                                            echo site_url('news/detail/'.$v_result['n_newsid'].'?p='.$v_result['np_hl']); 
                                        }  
                                    ?>">
                                        <h3 class page-header>
                                            <?php 
                                                if(isset($v_result['n_subject']) and $v_result['n_subject']){
                                                    if(isset($check_speword)) 
                                                    {
                                                        $n_subject = cutCaption($v_result['n_subject']);
                                                        $n_subject = highlightWords_spec($n_subject, $keyword);
                                                    }else
                                                    {
                                                        $n_subject = cutCaption($v_result['n_subject']);
                                                        $n_subject = highlightWords($n_subject, $keyword);
                                                    }
                                                    echo $n_subject; 
                                                }
                                            ?>
                                </h3></a>
                                <?php 
                                    $check_news = $v_result['n_newsid'];    
                                }?>
                                <h5>
                                    <?php 
                                    
                                        if(isset($v_result['np_paragraph']) and $v_result['np_paragraph']){
                                            if(isset($check_speword)) 
                                                {
                                                    $np_paragraph = cutCaption_spea_Keyword(stripHTMLTags($v_result['np_paragraph']),800,$keyword);
                                                    $np_paragraph = highlightWords_spec($np_paragraph, $keyword);
                                                }else
                                                 {
                                                    $np_paragraph = cutCaption_Keyword(stripHTMLTags($v_result['np_paragraph']),800,$keyword);
                                                    //$np_paragraph = $v_result['np_paragraph'];
                                                    $np_paragraph = highlightWords($np_paragraph, $keyword);
                                                 }
                                            echo $np_paragraph;
                                        }else{
                                            print_r($v_result['np_paragraph']);
                                        }
                                    ?>
                                </h5>
                      <?php } ?>
                    </blockquote>
                    <?php } ?>
                </div>
                <div class="tab-pane fade" id="profile" style="padding-top: 15px;">
                    <?php if(isset($result) and $result) { ?>
                        <?php foreach ($result as $v_result) { ?>
                                <?php if (is_file($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage'])) { ?>
                                    <div class="col col-lg-3" style="margin-bottom: 15px;">
                                        <!--<a class="gallery" href="<?= getImagePath($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage']); ?>">-->
                                        <a href="<?= site_url('news/detail/'.$v_result['n_newsid']); ?>">    
                                            <img src="<?= getImagePath($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage']); ?>" width="250" height="170">
                                        </a>
                                        <!--</a>-->
                                    </div>
                                <?php } ?>
                                
                                <?php 			  
					if(isset($v_result['image_ga'][0])){
                                        foreach($v_result['image_ga'][0] as $key_img => $values_img ){?>
                                        <a href="<?= site_url('news/detail/'.$v_result['n_newsid']); ?>">    
                                            <img src="<?= getImagePath($this->news_image . $values_img['n_newsid'] . '/' . $values_img['ni_path']); ?>" width="250" height="170">
                                        </a>
				<?php }}?>
                    
                    
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
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