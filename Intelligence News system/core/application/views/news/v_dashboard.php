<style>
@media (min-width: 1200px) {
  .container {
    margin-left: 4%;
    width: 68%;
    padding-left:0px;
    padding-right:0px;
  }
}
</style>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <div class="col-lg-12">
        <div class="float_left">
            <h3 style="margin-top: 5px;"><?= $title_section; ?></h3>
            <a href="<?= site_url('news/insert'); ?>" class="btn green" style="margin: 5px 4px 0 4px; vertical-align: top;">เพิ่มข่าว <i class="fa fa-plus-circle"></i> </a>
        </div>
        <div>
            <form id="search" action="<?= site_url('news/dashboard'); ?>" method="get" style="float: left; margin-left: 10px; margin-bottom: 15px; background-color: #f5f5f5; padding: 5px 10px 5px 5px;">
                <span>
                    <select class="form-control2" id="u_unitid" name="u_unitid">
                        <?php if ((isset($this->isadmin) and $this->isadmin == 'Y') or $this->u_unitid == 0) { ?>
                            <option value="0">ทุกระบบงาน</option>
                            <?php foreach ($unit as $v_u) { ?>
                                <option value="<?= $v_u['u_unitid']; ?>" <?= (isset($u_unitid) and $u_unitid == $v_u['u_unitid']) ? 'selected' : ''; ?>><?= $v_u['u_name']; ?></option>
                            <?php } ?>
                        <?php } else { ?>
                            <?php foreach ($unit as $v_u) { ?>
                                <?php if (isset($u_unitid) and $u_unitid == $v_u['u_unitid']) { ?>
                                    <option value="<?= $v_u['u_unitid']; ?>" selected ><?= $v_u['u_name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </span>
                <?php /* <span>
                    <select class="form-control2" id="s_unitsub_id"  name="s_unitsub_id"></select>
                </span> */ ?>
                
                <br>
                <span> 
                    <div class="input-append date" id="datetimepicker1">
                        <input class="form-control2" data-format="yyyy-MM-dd" type="text" name="n_date_start" style="margin-right: 0; padding-right: 0;" <?= (isset($n_date_start) and $n_date_start) ? 'value="' . $n_date_start . '"' : ''; ?> placeholder="วันที่">
                        <span class="add-on" style="height: 34px; padding: 9px 9px; position: relative; left: -5px;">
                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                        </span>
                    </div>
                </span>
                <span> ถึง </span>
                <span> 
                    <div class="input-append date" id="datetimepicker2">
                        <input class="form-control2" data-format="yyyy-MM-dd" type="text" name="n_date_end" style="margin-right: 0; padding-right: 0;" <?= (isset($n_date_end) and $n_date_end) ? 'value="' . $n_date_end . '"' : ''; ?> placeholder="วันที่">
                        <span class="add-on" style="height: 34px; padding: 9px 9px; position: relative; left: -5px;">
                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                        </span>
                    </div>
                </span>
                <?php /* <span>
                    <select class="form-control2" name="hl_hastelevelid">
                        <option value="">กรุณาเลือกความเร่งด่วน</option>
                        <?php foreach ($haste_level as $v_hl) { ?>
                            <option value="<?= $v_hl['hl_hastelevelid']; ?>" <?= (isset($hl_hastelevelid) and $hl_hastelevelid == $v_hl['hl_hastelevelid']) ? 'selected' : ''; ?>><?= $v_hl['hl_name']; ?></option>
                        <?php } ?>
                    </select>
                </span>
                <span>
                    <select class="form-control2" name="sl_secretid">
                        <option value="">กรุณาเลือกชั้นความลับ</option>
                        <?php foreach ($secret_level as $v_sl) { ?>
                            <option value="<?= $v_sl['sl_secretid']; ?>" <?= (isset($sl_secretid) and $sl_secretid == $v_sl['sl_secretid']) ? 'selected' : ''; ?>><?= $v_sl['sl_name']; ?></option>
                        <?php } ?>
                    </select>
                </span> */ ?>
                <span>
                    <input type="text" name="keyword" class="form-control2" placeholder="คีย์เวิร์ด" <?= (isset($keyword) and $keyword) ? 'value="' . $keyword . '"' : ''; ?>>
                </span> 
                <span>
                    <a onclick="$('form#search').submit();" class="btn blue" style="margin-top: -3px;" ><i class="fa fa-search"></i> ค้นหา</a>
                </span>
                <!--<span><a class="btn blue" href="<?= site_url('search/newsAdvance'); ?>" style="margin-top: -3px;">ค้นหาแบบละเอียด</a></span>-->
            </form>
        </div>
        <div class="clear"></div>
        <ul class="breadcrumb">
            <?php if (isset($breadcrumb) and $breadcrumb) { ?>
                <?php $c_breadcrumb = count($breadcrumb); ?>
                <?php foreach ($breadcrumb as $k_breadcrumb => $v_breadcrumb) { ?>
                    <?php if (($k_breadcrumb + 1) == $c_breadcrumb) { ?>
                        <li class="active"><?= $v_breadcrumb['name']; ?></li>
                    <?php } else { ?>
                        <li><a href="<?= $v_breadcrumb['link']; ?>"><?= $v_breadcrumb['name']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
              <div class="float_right"><a title="กลับหน้าหลัก" class="blue font_size18px margin10px" href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></div>
              <div class="float_right blue font_size19px margin10px"> | </div>
              <div class="float_right"><a title="หน้ารายการข่าว" class="blue font_size18px margin10px" href="<?= site_url('news/lists'); ?>"><i class="fa fa-th-list"></i></a></div>
              <div class="float_right"><a title="หน้าสรุปข่าว" class="blue font_size18px margin10px" href="<?= site_url('news/dashboard'); ?>"><i class="fa fa-th-large"></i></a></div>
        </ul>
    </div>
    <div class="container">
        <div class="span12">
            <?php if (isset($result) and $result) { ?>
                <div class="pagination pagination-right mt-0 mb-0">
                    <?= $this->pagination->create_custom_links_front(); ?>
                    <div class="pagination-text">
                        แสดง (<?= $offset; ?> - <?= $offset + count($result) - 1; ?>) จากทั้งหมด <?= number_format($total_rows,0); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="span12 article-block">
            <h1>ข่าวล่าสุด</h1>
            <?php if (isset($result) and $result) { ?>
                <?php foreach ($result as $k_result => $v_result) { ?>
                    <div class="row-fluid">
                        <div class="span4 blog-img blog-tag-data">
                            <?= (isset($v_result['paragraph'][0]['np_mainimage']) and $v_result['paragraph'][0]['np_mainimage']) ? '<img width="370" border="3" src="' . getImagePath($this->paragraph_images_path . $v_result['paragraph'][0]['np_paragraph_id'] . '/' . $v_result['paragraph'][0]['np_mainimage']) . '" />' : ''; ?>
                            <ul class="unstyled inline">
                                <li><i class="fa fa-calendar blue"></i><a class="black_gray padding_left_5px" href="#"><?= (isset($v_result['n_date']) and $v_result['n_date']) ? dateTHFormat($v_result['n_date']) : '-'; ?> <?= (isset($v_result['n_time']) and $v_result['n_time']) ? $v_result['n_time'] . ' น.' : '-'; ?></a></li>
                                <li><a class="black_gray" href="#">ประเภทรายงาน : <?= (isset($v_result['rt_name']) and $v_result['rt_name']) ? $v_result['rt_name'] : '-'; ?></a></li>
                                <?php if(isset($v_result['rt_reporttypeid']) and ($v_result['rt_reporttypeid'] == 1 or $v_result['rt_reporttypeid'] == 5)) { ?>
                                    <li><a class="black_gray" href="#">ที่ : <?= (isset($v_result['n_place']) and $v_result['n_place']) ? $v_result['n_place'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ชั้นความลับ : <?= (isset($v_result['sl_name']) and $v_result['sl_name']) ? $v_result['sl_name'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรื่อง : <?= (isset($v_result['n_subject']) and $v_result['n_subject']) ? $v_result['n_subject'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรียน : <?= (isset($v_result['n_to']) and $v_result['n_to']) ? $v_result['n_to'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ผู้รวบรวมและรายงานข่าว : <?= (isset($v_result['n_writer']) and $v_result['n_writer']) ? $v_result['n_writer'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">วันที่รายงาน : <?= (isset($v_result['n_date']) and $v_result['n_date']) ? dateTHFormat($v_result['n_date']) : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เวลารายงาน : <?= (isset($v_result['n_time']) and $v_result['n_time']) ? $v_result['n_time'] : '-'; ?></a></li>
                                <?php } ?>
                                <?php if(isset($v_result['rt_reporttypeid']) and ($v_result['rt_reporttypeid'] >= 2 and $v_result['rt_reporttypeid'] <= 4)) { ?>
                                    <li><a class="black_gray" href="#">ชั้นความลับ : <?= (isset($v_result['sl_name']) and $v_result['sl_name']) ? $v_result['sl_name'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ส่วนราชการ : <?= (isset($v_result['n_government']) and $v_result['n_government']) ? $v_result['n_government'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ที่ : <?= (isset($v_result['n_place']) and $v_result['n_place']) ? $v_result['n_place'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรื่อง : <?= (isset($v_result['n_subject']) and $v_result['n_subject']) ? $v_result['n_subject'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรียน : <?= (isset($v_result['n_to']) and $v_result['n_to']) ? $v_result['n_to'] : '-'; ?></a></li>  
                                    <li><a class="black_gray" href="#">อ้างถึง : <?= (isset($v_result['n_reference']) and $v_result['n_reference']) ? $v_result['n_reference'] : '-'; ?></a></li> 
                                    <li><a class="black_gray" href="#">ผู้รวบรวมและรายงานข่าว : <?= (isset($v_result['n_writer']) and $v_result['n_writer']) ? $v_result['n_writer'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">วันที่รายงาน : <?= (isset($v_result['n_date']) and $v_result['n_date']) ? dateTHFormat($v_result['n_date']) : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เวลารายงาน : <?= (isset($v_result['n_time']) and $v_result['n_time']) ? $v_result['n_time'] : '-'; ?></a></li>
                                    <!--<li><a class="black_gray" href="#">ชื่อผู้อนุมัติข่าว : <?= (isset($v_result['n_approver']) and $v_result['n_approver']) ? $v_result['n_approver'] : '-'; ?></a></li>-->
                                <?php } ?>
                                <?php if(isset($v_result['rt_reporttypeid']) and $v_result['rt_reporttypeid'] == 6) { ?>
                                    <li><a class="black_gray" href="#">ชั้นความลับ : <?= (isset($v_result['sl_name']) and $v_result['sl_name']) ? $v_result['sl_name'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ส่วนราชการ : <?= (isset($v_result['n_government']) and $v_result['n_government']) ? $v_result['n_government'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ความเร่งด่วน : <?= (isset($v_result['hl_name']) and $v_result['hl_name']) ? $v_result['hl_name'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">ที่ : <?= (isset($v_result['n_place']) and $v_result['n_place']) ? $v_result['n_place'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรื่อง : <?= (isset($v_result['n_subject']) and $v_result['n_subject']) ? $v_result['n_subject'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เรียน : <?= (isset($v_result['n_to']) and $v_result['n_to']) ? $v_result['n_to'] : '-'; ?></a></li>  
                                    <li><a class="black_gray" href="#">อ้างถึง : <?= (isset($v_result['n_reference']) and $v_result['n_reference']) ? $v_result['n_reference'] : '-'; ?></a></li> 
                                    <li><a class="black_gray" href="#">ผู้รวบรวมและรายงานข่าว : <?= (isset($v_result['n_writer']) and $v_result['n_writer']) ? $v_result['n_writer'] : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">วันที่รายงาน : <?= (isset($v_result['n_date']) and $v_result['n_date']) ? dateTHFormat($v_result['n_date']) : '-'; ?></a></li>
                                    <li><a class="black_gray" href="#">เวลารายงาน : <?= (isset($v_result['n_time']) and $v_result['n_time']) ? $v_result['n_time'] : '-'; ?></a></li>
                                    <!--<li><a class="black_gray" href="#">ชื่อผู้อนุมัติข่าว : <?= (isset($v_result['n_approver']) and $v_result['n_approver']) ? $v_result['n_approver'] : '-'; ?></a></li>-->
                                <?php } ?>
                            </ul>
                            <ul class="unstyled inline blog-tags">
                                <?php if (isset($v_result['tag']) and $v_result['tag']) { ?>
                                    <li>
                                        <i class="fa fa-tags blue"></i>
                                        <?php $arr_tag = array(); ?>
                                        <?php foreach ($v_result['tag'] as $k_tag => $v_tag) { ?>
                                            <?php if(empty($arr_tag[$v_tag['nt_tagid']])) { ?>
                                                <?php $arr_tag[$v_tag['nt_tagid']] = $v_tag['nt_word']; ?>
                                                <a href="<?= site_url('news/dashboard?tag=' . $v_tag['nt_tagid']); ?>"><?= $v_tag['nt_word']; ?></a>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                                <li>
                                    <i class="fa fa-comments blue"></i>
                                    <a class="padding_left_5px" href="<?= site_url('news/detail/' . $v_result['n_newsid']); ?>"><?= $v_result['total_comment']; ?> ความคิดเห็น</a>
                                </li>
                            </ul>
                            <ul class="unstyled inline">
                                <li>
                                    <a href="<?= site_url('news/detail/' . $v_result['n_newsid']); ?>" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด"><i class="fa fa-search"></i></a>
                                    <a href="<?= site_url('news/update/' . $v_result['n_newsid']); ?>" class="tripbox" data-toggle="tooltip" data-placement="top" title="แก้ไขข่าว"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= site_url('news/manageGallery/' . $v_result['n_newsid']); ?>" class="tripbox" data-toggle="tooltip" data-placement="top" title="รูปภาพข่าว"><i class="fa fa-camera"></i></a>
                                    <!--<a href="#"><i class="fa fa-print"></i></a>-->
                                    <a href="<?= site_url('news/detail_pdf/'.$v_result['n_newsid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว PDF"><i class="fa fa-download"></i></a>
                                    <a href="<?= site_url('news/detail_word/'.$v_result['n_newsid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว Word"><i class="fa fa-download"></i></a>
                                    <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
                                        <a href="#" onclick="del(<?= $v_result['n_newsid']; ?>); return false;" class="tripbox" data-toggle="tooltip" data-placement="top" title="ลบข่าว"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                        <div class="span8 blog-article">
                            <?php if( isset($keyword) && $keyword ) { ?>
                                <h3>
                                    <a href="<?= site_url('news/detail/' . $v_result['n_newsid'] . '/' . $keyword); ?>">
                                        <?= (isset($v_result['n_subject']) and $v_result['n_subject']) ? highlightWords($v_result['n_subject'], $keyword) : '-'; ?>
                                    </a>
                                </h3>
                                <?= (isset($v_result['paragraph'][0]['np_paragraph']) and $v_result['paragraph'][0]['np_paragraph']) ? '<p>' . highlightWords(cutCaption(stripHTMLTags($v_result['paragraph'][0]['np_paragraph']), 1250), $keyword) . '</p>' : ''; ?>
                                <a class="btn blue" href="<?= site_url('news/detail/' . $v_result['n_newsid'] . '/' . $keyword); ?>">
                                    อ่านต่อ <i class="fa fa-arrow-circle-o-right"></i>
                                </a>
                            <?php } else { ?>
                                <h3>
                                    <a href="<?= site_url('news/detail/' . $v_result['n_newsid']); ?>">
                                        <?= (isset($v_result['n_subject']) and $v_result['n_subject']) ? $v_result['n_subject'] : '-'; ?>
                                    </a>
                                    <?php 
                                        if(isset($favorite) && $favorite){
                                            
                                        }else{
                                            $favorite = array();
                                        }
                                    ?>
                                    <?php 
                                    $checkprint = '';
                                    foreach($favorite as $f_k => $v_k){
                                        if($v_k['n_newsid'] == $v_result['n_newsid']){
                                        $checkprint = 'printed';
                                    ?>        
                                        <a href="<?= site_url('news/favorite_delete/' . $v_result['n_newsid']); ?>">
                                            <i class="fa fa-star" style="color: gold"></i>
                                        </a>
                                     <?php   }
                                    } ?>
                                    <?php if(isset($checkprint) && $checkprint == 'printed'){
                                        
                                    }else{ ?>
                                        <a href="<?= site_url('news/favorite_insert/' . $v_result['n_newsid']); ?>">
                                            <i class="fa fa-star-o" style="color: gold"></i>
                                        </a>
                                   <?php  } ?>
                                </h3>
                                <?= (isset($v_result['paragraph'][0]['np_paragraph']) and $v_result['paragraph'][0]['np_paragraph']) ? '<p>' . cutCaption(stripHTMLTags($v_result['paragraph'][0]['np_paragraph']), 1250) . '</p>' : ''; ?>
                                <a class="btn blue" href="<?= site_url('news/detail/' . $v_result['n_newsid']); ?>">
                                    อ่านต่อ <i class="fa fa-arrow-circle-o-right"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            <?php } else { ?>
                <p>ไม่พบข้อมูล</p>
            <?php } ?>
            <form class="del" action="<?= site_url('news/delete?page=dashboard'); ?>" method="post">
                <input type="hidden" id="del_id" name="del_id">
            </form>
            <?php if (isset($result) and $result) { ?>
                <div class="pagination pagination-right">
                    <?= $this->pagination->create_custom_links_front(); ?>
                    <div class="pagination-text">
                        แสดง (<?= $offset; ?> - <?= $offset + count($result) - 1; ?>) จากทั้งหมด <?= number_format($total_rows,0); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        <?php if (isset($s_unitsub_id)) { ?>
            first_unit(<?= $s_unitsub_id . "," . $u_unitid; ?>);
        <?php } else { ?>
            first_unit_all(<?= $u_unitid; ?>);
        <?php } ?>

        $('.tripbox').tooltip();

        $('#datetimepicker1').datetimepicker({
            language: 'th',
            endDate: new Date('<?= date('Y-m-d'); ?>')
        });
        $('#datetimepicker2').datetimepicker({
            language: 'th',
            endDate: new Date('<?= date('Y-m-d'); ?>')
        });
        $('#s_unitsub_id').html('<option value="0">เลือกระบบย่อยทั้งหมด</option>');

        $('#u_unitid').change(function() {
            check_unit();
        });
    });
    <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
        function del(id) {
            $('#del_id').val('');
            if (confirm('ยืนยันการลบข้อมูล!!!') === true) {
                $('#del_id').val(id);
                $('form.del').submit();
            }
            $('#del_id').val('');
        }
    <?php } ?>
    function first_unit_all(u_unitid) {
        $.post("news/check_unitid", {u_unitid: u_unitid},
        function(result) {
            $('#s_unitsub_id').html(result);
        });
    }
    function first_unit(s_unitsub_id, u_unitid) {
        $.post("news/check_unitid", {s_unitsub_id: s_unitsub_id, u_unitid: u_unitid},
        function(result) {
            $('#s_unitsub_id').html(result);
        });
    }

    function check_unit() {
        var u_unitid = $('#u_unitid').val();
        $.post("news/check_unitid", {u_unitid: u_unitid},
        function(result) {
            if (result != "") {
                $('#s_unitsub_id').html(result);
            } else {
                $('#s_unitsub_id').html('<option value="0">เลือกระบบย่อยทั้งหมด</option>');
            }
        });
    }
</script>