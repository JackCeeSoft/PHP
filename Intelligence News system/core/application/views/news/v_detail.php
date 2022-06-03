<link rel="stylesheet" href="assets/colorbox/theme2/colorbox.css" />
<script src="assets/colorbox/jquery.colorbox.js"></script>
<script>
    $(function() {
        $(".gallery").colorbox({rel: 'gallery', height : '80%'});
        $('.tripbox').tooltip();
    });
</script>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="span9 article-block">
            <div class="blog-tag-data-inner float_right">
                <ul class="unstyled inline">
                    <li>
                        <?php 
                            $data_session  = $this->session->all_userdata();
                            //print_r($data_session);
                            if((isset($data_session['ug_canedit']) && $data_session['ug_canedit'] == 'Y') || $data_session['ug_isadmin'] == 'Y'){
                                ?>
                                <a href="<?= site_url('news/update/' . $result['n_newsid']); ?>" class="tripbox" data-toggle="tooltip" data-placement="top" title="แก้ไขข่าว"><i class="fa fa fa-pencil"></i></a>
                            <?php } ?>
                        
                        <!--<a href="#"><i class="fa fa-print"></i></a>-->
                        <a href="<?= site_url('news/detail_pdf/'.$result['n_newsid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว PDF"><i class="fa fa-download"></i></a>
                        <a href="<?= site_url('news/detail_word/'.$result['n_newsid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว Word"><i class="fa fa-download"></i></a>
                        <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
                            <a href="#" onclick="del(<?= $result['n_newsid']; ?>); return false;" class="tripbox" data-toggle="tooltip" data-placement="top" title="ลบข่าว"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>

            <div class="clear"></div>
            <h1><?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : ''; ?></h1>

            <div class="border_box">
                <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] == 1 or $result['rt_reporttypeid'] == 5)) { ?>
                    <div class="float_left padding_left_10px">
                        <span>ประเภทรายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="float_left padding_left_10px">
                        <span>ชั้นความลับ :
                        </span>
                        <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>ระบบ :
                        </span>
                        <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ที่ :
                        </span>
                        <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ชื่อผู้อนุมัติข่าว :
                        </span>
                        <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>เรียน :
                        </span>
                        <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>วันที่รายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>เวลารายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                        </span>
                    </div>
                <?php } ?>
                    
                <?php if(isset($result['rt_reporttypeid']) and ($result['rt_reporttypeid'] >= 2 and $result['rt_reporttypeid'] <= 4)) { ?>
                    <div class="float_left padding_left_10px">
                        <span>ประเภทรายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="float_left padding_left_10px">
                        <span>ชั้นความลับ :
                        </span>
                        <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>ระบบ :
                        </span>
                        <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ที่ :
                        </span>
                        <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ชื่อผู้อนุมัติข่าว :
                        </span>
                        <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ผู้รวบรวมและรายงานข่าว :
                        </span>
                        <span class="blue"><?= (isset($result['n_writer']) and $result['n_writer']) ? $result['n_writer'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>สิ่งที่แนบมาด้วย :
                        </span>
                        <span class="blue"><?= (isset($result['n_attachdetail']) and $result['n_attachdetail']) ? $result['n_attachdetail'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>เรียน :
                        </span>
                        <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>วันที่รายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>เวลารายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                        </span>
                    </div>
                <?php } ?>
                    
                <?php if(isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == 6) { ?>
                    <div class="float_left padding_left_10px">
                        <span>ประเภทรายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="float_left padding_left_10px">
                        <span>ชั้นความลับ :
                        </span>
                        <span class="blue"><?= (isset($result['sl_name']) and $result['sl_name']) ? $result['sl_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="float_left padding_left_10px">
                        <span>ความเร่งด่วน :
                        </span>
                        <span class="blue"><?= (isset($result['hl_name']) and $result['hl_name']) ? $result['hl_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>ระบบ :
                        </span>
                        <span class="blue"><?= (isset($result['u_name']) and $result['u_name']) ? $result['u_name'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>เรื่อง :
                        </span>
                        <span class="blue"><?= (isset($result['n_subject']) and $result['n_subject']) ? $result['n_subject'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="float_left padding_left_10px">
                        <span>เรียน :
                        </span>
                        <span class="blue"><?= (isset($result['n_to']) and $result['n_to']) ? $result['n_to'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ที่ :
                        </span>
                        <span class="blue"><?= (isset($result['n_place']) and $result['n_place']) ? $result['n_place'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ผู้รับทราบ :
                        </span>
                        <span class="blue"><?= (isset($result['n_aware']) and $result['n_aware']) ? $result['n_aware'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ชื่อผู้อนุมัติข่าว :
                        </span>
                        <span class="blue"><?= (isset($result['n_approver']) and $result['n_approver']) ? $result['n_approver'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ผู้รวบรวมและรายงานข่าว :
                        </span>
                        <span class="blue"><?= (isset($result['n_writer']) and $result['n_writer']) ? $result['n_writer'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>วันที่รายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_date']) and $result['n_date']) ? $result['n_date'] : '-'; ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>เวลารายงาน :
                        </span>
                        <span class="blue"><?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'] : '-'; ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <?php if(isset($paragraph) and is_array($paragraph) and $paragraph) { ?>
                <?php $all_tag = array(); ?>
                <?php foreach ($paragraph as $k_p => $v_p) { ?>
                    <?php if(isset($v_p['tag']) and $v_p['tag']) { ?>
                        <?php foreach ($v_p['tag'] as $v_tag) { ?>
                            <?php $all_tag[$v_tag['nt_tagid']] = $v_tag['nt_word']; ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <div class="ml-20 mt-10">
                <?php $text_tag = '-'; ?>
                <?php if(isset($all_tag) and $all_tag) { ?>
                    <?php $text_tag = '<ul class="unstyled inline blog-tags" style="display: inline;"><li>'; ?>
                    <?php foreach ($all_tag as $k_all_tag => $v_all_tag) { ?>
                        <?php $text_tag .= '<a href="'.site_url('news/dashboard?tag='.$k_all_tag).'" target="_blank">'.$v_all_tag.'</a>'; ?>
                    <?php } ?>
                    <?php $text_tag .= '</li></ul>'; ?>
                <?php } ?>
                <span><i class="fa fa-tags blue"></i> : </span>
                <span class="blue all_tag"><?= $text_tag; ?></span>
            </div>
            <br>
            <div class="blog-tag-data">
                <div class="row-fluid">
                    <div class="span6">
                        <ul class="unstyled inline">
                            <li>
                                <i class="fa fa-calendar blue"></i>
                                <a class="black_gray padding_left_5px">
                                    <?= (isset($result['n_date']) and $result['n_date']) ? dateTHFormat($result['n_date']) : '-'; ?> 
                                    <?= (isset($result['n_time']) and $result['n_time']) ? $result['n_time'].' น.' : '-'; ?> 
                                </a>
                            </li>
                            
                            <li><i class="fa fa-comments blue"></i><a class="black_gray padding_left_5px"><?= $result['total_comment']; ?> ความคิดเห็น</a></li>
                            <li class="blue"><?= (isset($result['rt_name']) and $result['rt_name']) ? $result['rt_name'] : '-'; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end news-tag-data-->

            <br>
            <div>
                <?php if(isset($_POST['paragraph_preview']) and $_POST['paragraph_preview']) { ?>
                    <p><?= $_POST['paragraph_preview']; ?></p>
                    <hr>
                    <br>
                <?php } ?>
                <?php if(isset($paragraph) and is_array($paragraph) and $paragraph) { ?>
                    <?php $highlight_paragrahp = (isset($_GET['p']) and $_GET['p']) ? explode('_', $_GET['p']) : array(); ?>
                    <?php foreach ($paragraph as $v_p) { ?>
                        <?php if((isset($v_p['np_mainimage']) and $v_p['np_mainimage']) or (isset($v_p['np_paragraph']) and $v_p['np_paragraph']) or (isset($v_p['fileattach']) and $v_p['fileattach'])) { ?>
                    
                            <?php if( isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == 5) { ?>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        ลักษณะการก่อเหตุ : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['nc_name']; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        ก่อกวน : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['nh_name']; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        การปฏิบัติของฝ่ายเรา : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['ne_name']; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        จังหวัด : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['province_name']; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        อำเภอ : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['amphur_name']; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-lg-3">
                                        ตำบล : 
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $v_p['district_name']; ?>
                                    </div>
                                </div>

                                <div class="col-xs-12 group-paragrahp <?= (array_search($v_p['np_paragraph_id'], $highlight_paragrahp) === false) ? '' : 'highlight_paragrahp'; ?>">
                                <?php // (isset($v_p['np_mainimage']) and $v_p['np_mainimage']) ? '<img width="870" border="3" src="' . getImagePath($this->paragraph_images_path . $v_p['np_paragraph_id'] . '/' . $v_p['np_mainimage']) . '" />' : ''; ?>
                                <?php
                                    if(isset($v_p['np_paragraph']) && $v_p['np_paragraph']){
                                        $np_paragraph = highlightWords($v_p['np_paragraph'], rawurldecode($keyword));
                                        echo $np_paragraph;
                                    }
                                ?>
                                <?php if(isset($v_p['fileattach']) and $v_p['fileattach']) { ?>
                                    <table class="table table-attach mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ชื่อไฟล์</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($v_p['fileattach'] as $k_attach => $v_attach) { ?>
                                                <tr>
                                                    <th scope="row"><?= ($k_attach + 1); ?>.</th>
                                                    <td><a href="<?= $this->paragraph_file_path.$v_p['np_paragraph_id'].'/'.$v_attach['nf_path']; ?>" target="_blank"><?= $v_attach['nf_path']; ?></a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <!----------------- tag each paragraph ----------------->
                                <?php /*if(isset($v_p['tag']) and $v_p['tag']) { ?>
                                    <div>
                                        <ul class="unstyled inline blog-tags">
                                            <li>
                                                <i class="fa fa-tags blue"></i>
                                                <?php foreach ($v_p['tag'] as $k_tag => $v_tag) { ?>
                                                    <a href="<?= site_url('news/dashboard?tag='.$v_tag['nt_tagid']); ?>"><?= $v_tag['nt_word']; ?></a> 
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }*/ ?>
                                <!----------------- tag each paragraph ----------------->
                            </div>
                                <!------------------------- news person5 ------------------------->
                                <?php if(isset($news_person) && $news_person) { ?>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <h3 class="blue">บุคคล </h3>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td class="col-lg-2 blue">ลำดับ</td>
                                                <td class="col-lg-4 blue">บุคคล</td>
                                                <td class="col-lg-1 blue">สูญเสีย</td>
                                                <td class="col-lg-1 blue">บาดเจ็บ</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($relate_person) && $relate_person) { ?>
                                                <?php foreach ($relate_person as $k_rp => $v_rp) { ?>
                                                    <?php $new_relate_person[$v_rp['np_newspersonid']] = $v_rp; ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php foreach ($news_person as $k_ps => $v_ps) { ?>
                                                <tr>
                                                    <td><?= $k_ps + 1; ?></td>
                                                    <td><?= $v_ps['np_person']; ?></td>
                                                    <?php $nr_injuries = (isset($new_relate_person[$v_ps['np_newspersonid']]['nr_injuries']) && $new_relate_person[$v_ps['np_newspersonid']]['nr_injuries']) ? '' . $new_relate_person[$v_ps['np_newspersonid']]['nr_injuries'] . '' : '0'; ?>
                                                    <td> <?= $nr_injuries; ?></td>
                                                    <?php $nr_lose = (isset($new_relate_person[$v_ps['np_newspersonid']]['nr_lose']) && $new_relate_person[$v_ps['np_newspersonid']]['nr_lose']) ? '' . $new_relate_person[$v_ps['np_newspersonid']]['nr_lose'] . '' : '0'; ?>
                                                    <td><?= $nr_lose; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <!------------------------- news person5 ------------------------->
                                
                                <!------------------------ news practice5 ------------------------>
                                <?php if(isset($news_practice) && $news_practice) { ?>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <h3 class="blue">ปฏิบัติ </h3>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td class="col-lg-2 blue">ลำดับ</td>
                                                <td class="col-lg-5 blue">การปฏิบัติ</td>
                                                <td class="col-lg-1 blue">จำนวน</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($relate_practice) && $relate_practice) { ?>
                                                <?php foreach ($relate_practice as $k_rpa => $v_rpa) { ?>
                                                    <?php $new_relate_practice[$v_rpa['np_newspracticeid']] = $v_rpa; ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php foreach ($news_practice as $k_pt => $v_pt) { ?>
                                                <tr>
                                                    <td><?= $k_pt + 1; ?></td>
                                                    <td><?= $v_pt['np_practice']; ?></td>
                                                    <?php $nr_amount = (isset($new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount']) && $new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount']) ? '' . $new_relate_practice[$v_pt['np_newspracticeid']]['nr_amount'] . '' : '0'; ?>
                                                    <td><?= $nr_amount; ?> </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <!------------------------ news practice5 ------------------------>
                                
                                <!-------------------------- news gun5 --------------------------->
                                <?php if(isset($news_gun) && $news_gun) { ?>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <h3 class="blue">ปืน </h3>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td class="col-lg-2 blue">ลำดับ</td>
                                                <td class="col-lg-4 blue">ปืน</td>
                                                <td class="col-lg-1 blue">ยึดคืน</td>
                                                <td class="col-lg-1 blue">ยึดไป</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($relate_gun) && $relate_gun) { ?>
                                                <?php foreach ($relate_gun as $k_rg => $v_rg) { ?>
                                                    <?php $new_relate_gun[$v_rg['ng_newsgunid']] = $v_rg; ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php foreach ($news_gun as $k_g => $v_g) { ?>
                                                <tr>
                                                    <td><?= $k_g + 1; ?></td>
                                                    <td><?= $v_g['ng_gun']; ?></td>
                                                    <?php $nr_holdreturn = (isset($new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn']) && $new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn']) ? '' . $new_relate_gun[$v_g['ng_newsgunid']]['nr_holdreturn'] . '"' : '0'; ?>
                                                    <td><?= $nr_holdreturn; ?></td>
                                                    <?php $nr_hold = (isset($new_relate_gun[$v_g['ng_newsgunid']]['nr_hold']) && $new_relate_gun[$v_g['ng_newsgunid']]['nr_hold']) ? '' . $new_relate_gun[$v_g['ng_newsgunid']]['nr_hold'] . '' : '0'; ?>
                                                    <td><?= $nr_hold; ?> </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <!-------------------------- news gun5 --------------------------->
                                
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <label class="control-label right">ระเบิดที่ทำงานสมบูรณ์ :</label>
                                    </div>
                                    <div class="col-lg-4">
                                         <?= (isset($result['n_dynamitecomplete']) and $result['n_dynamitecomplete']) ? ''.$result['n_dynamitecomplete'].'' : ''; ?>
                                    </div>
                                    <div class="col-lg-4">ลูกแท่ง</div>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <label class="control-label right">ระเบิดที่เจ้าหน้าที่สามารถเก็บกู้ได้ :</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <?= (isset($result['n_dynamitestop']) and $result['n_dynamitestop']) ? ''.$result['n_dynamitestop'].'' : ''; ?>
                                    </div>
                                    <div class="col-lg-4">ลูกแท่ง</div>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <label class="control-label right">หน่วย :</label>
                                    </div>
                                    <div class="col-lg-6">
                                         <?= (isset($result['n_unit']) and $result['n_unit']) ? ''.$result['n_unit'].'' : ''; ?>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <label class="control-label right">ผบ.หน่วย :</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <?= (isset($result['n_headunit']) and $result['n_headunit']) ? ''.$result['n_headunit'].'' : ''; ?>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <label class="control-label right">หมายเหตุ :</label>
                                    </div>
                                    <div class="col-lg-6">
                                         <?= (isset($result['n_remark']) and $result['n_remark']) ? ''.$result['n_remark'].'' : ''; ?>
                                    </div>
                                </div>
                                
                                <br><br><br>
                                <?php $new_dynamite_type = array(); ?>
                                <?php if(isset($dynamite_type) && $dynamite_type) { ?>
                                    <?php foreach ($dynamite_type as $v_dt) { ?>
                                        <?php $new_dynamite_type[$v_dt['dt_dynamitetypeid']] = $v_dt; ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php $new_ignition_type = array(); ?>
                                <?php if(isset($ignition_type) && $ignition_type) { ?>
                                    <?php foreach ($ignition_type as $v_it) { ?>
                                        <?php $new_ignition_type[$v_it['it_ignitiontypeid']] = $v_it; ?>
                                    <?php } ?>
                                <?php } ?>
                                <div class="col-xs-12">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ประเภทระเบิด</th>
                                                    <th>การจุดระเบิด</th>
                                                </tr>
                                            </thead>
                                            <tbody class="dynamitetable">
                                                <?php if(isset($dynamitetable) && $dynamitetable) { ?>
                                                    <?php foreach ($dynamitetable as $k_dynamitetable => $v_dynamitetable) { ?>
                                                        <tr>
                                                            <td><?= $new_dynamite_type[$v_dynamitetable['dt_dynamitetypeid']]['dt_name']; ?></td>
                                                            <td><?= $new_ignition_type[$v_dynamitetable['it_ignitiontypeid']]['it_name']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                    
                            
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
               <?php    
                    if(isset($cancomment) &&  $cancomment != "Y"){
                        $check_comment = "hidden";
                    }else{
                        $check_comment = "";
                    }
               ?>
            
            <div class="comment-section">
                <h3>ความคิดเห็น</h3>
                <?php if(isset($comment) and $comment) { ?>
                    <?php foreach ($comment as $k_comment => $v_comment) { ?>
                        <div class="media">
                            <!--<a href="#" class="pull-left">
                                <img alt="" src="assets/img/mockup/15.jpg" class="media-object">
                            </a>-->
                            <div class="media-body">
                                <div class="comment-no"><i class="fa fa-user blue"></i> <?= 'ความคิดเห็นที่ '.($k_comment + 1); ?></div>
                                <?php list($d, $t) = explode(' ', $v_comment['o_createddate']); ?>
                                <h4 class="media-heading">
                                    <?= $v_comment['user_account']['ua_username']; ?> 
                                    <small>
                                        <span class="float_right">
                                            <?= (isset($d) and $d) ? dateTHFormat($d) : '-'; ?> <?= (isset($t) and $t) ? substr($t, 0, 8).' น.' : '-'; ?> / 
                                            <?php if((isset($sesstion) and $sesstion['user_id'] == $v_comment['o_createdby']) or (isset($sesstion) and $sesstion['isadmin'] == 'Y')) { ?>
                                                <a class="del-comment" onclick="delComment(<?= $v_comment['nc_commentid']; ?>, $( this ));">ลบ</a> / 
                                                <a class="edit-comment" onclick="editComment(<?= ($k_comment + 1); ?>, <?= $v_comment['nc_commentid']; ?>, $(this));">แก้ไข</a> / 
                                            <?php } ?>
                                            <a class="reply" onclick="quote(<?= ($k_comment + 1); ?>, <?= $v_comment['nc_commentid']; ?>);">ตอบกลับ</a>
                                        </span>
                                    </small>
                                    <div class="clear"></div>
                                </h4>
                                <p><?= $v_comment['nc_comment']; ?></p>
                                <hr>
                                <?php if(isset($v_comment['children']) and $v_comment['children']) { ?>
                                    <?php foreach ($v_comment['children'] as $k_children => $v_children) { ?>
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="comment-no"><i class="fa fa-user blue"></i> <?= 'ความคิดเห็นที่ '.($k_comment + 1).'-'.($k_children+1); ?></div>
                                                <?php list($d, $t) = explode(' ', $v_children['o_createddate']); ?>
                                                <h4 class="media-heading">
                                                    <?= $v_children['user_account']['ua_username']; ?> 
                                                    <small>
                                                        <span class="float_right">
                                                            <?= (isset($d) and $d) ? dateTHFormat($d) : '-'; ?> <?= (isset($t) and $t) ? substr($t, 0, 8).' น.' : '-'; ?> / 
                                                            <?php if((isset($sesstion) and $sesstion['user_id'] == $v_children['o_createdby']) or (isset($sesstion) and $sesstion['isadmin'] == 'Y')) { ?>
                                                                <a class="del-comment" onclick="delComment(<?= $v_children['nc_commentid']; ?>, $( this ));">ลบ</a> / 
                                                                <a class="edit-comment" onclick="editComment('<?= ($k_comment + 1); ?> - <?= ($k_children + 1); ?>', <?= $v_children['nc_commentid']; ?>, $(this));">แก้ไข</a> / 
                                                            <?php } ?>
                                                            <a class="reply" onclick="quote('<?= ($k_comment + 1); ?> - <?= ($k_children + 1); ?>', <?= $v_children['nc_commentid']; ?>);">ตอบกลับ</a>
                                                        </span>
                                                    </small>
                                                    <div class="clear"></div>
                                                </h4>
                                                <p><?= $v_children['nc_comment']; ?></p>
                                                <hr>
                                                <?php if(isset($v_children['children']) and $v_children['children']) { ?>
                                                    <?php foreach ($v_children['children'] as $k_c_children => $v_c_children) { ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <div class="comment-no"><i class="fa fa-user blue"></i> <?= 'ความคิดเห็นที่ '.($k_comment + 1).'-'.($k_children+1).'-'.($k_c_children+1); ?></div>
                                                                <?php list($d, $t) = explode(' ', $v_c_children['o_createddate']); ?>
                                                                <h4 class="media-heading">
                                                                    <?= $v_c_children['user_account']['ua_username']; ?> 
                                                                    <small>
                                                                        <span class="float_right">
                                                                            <?= (isset($d) and $d) ? dateTHFormat($d) : '-'; ?> <?= (isset($t) and $t) ? substr($t, 0, 8).' น.' : '-'; ?>
                                                                            <?php if((isset($sesstion) and $sesstion['user_id'] == $v_c_children['o_createdby']) or (isset($sesstion) and $sesstion['isadmin'] == 'Y')) { ?>
                                                                                <a class="del-comment" onclick="delComment(<?= $v_c_children['nc_commentid']; ?>, $( this ));">ลบ</a> / 
                                                                                <a class="edit-comment" onclick="editComment('<?= ($k_comment + 1); ?> - <?= ($k_children + 1); ?> - <?= ($k_c_children + 1); ?>', <?= $v_c_children['nc_commentid']; ?>, $(this));">แก้ไข</a>
                                                                            <?php } ?>
                                                                        </span>
                                                                    </small>
                                                                    <div class="clear"></div>
                                                                </h4>
                                                                <p><?= $v_c_children['nc_comment']; ?></p>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="post-comment" <?= $check_comment;?>>
                    <form action="" method="post">
                        <h3>แสดงความคิดเห็น 
                            <span class="edit-form">#แก้ไขความคิดเห็นที่ 
                                <span class="edit-form-id">2</span> 
                                <i class="fa fa-remove" title="ยกเลิก"></i>
                            </span>
                            <span class="quote-form">#อ้างอิงจากความคิดเห็นที่ 
                                <span class="quote-form-id">2</span> 
                                <i class="fa fa-remove" title="ยกเลิก"></i>
                            </span>
                        </h3>
                        <input type="hidden" name="del_commentid" id="del_commentid" >
                        <input type="hidden" name="nc_commentid" id="nc_commentid" >
                        <input type="hidden" name="nc_parentid" id="nc_parentid" >
                        <textarea class="span10 m-wrap" rows="8" id="comment" name="comment"></textarea>
                        
                        <p><button class="btn blue" type="submit">แสดงความคิดเห็น <i class="fa fa-comments"></i></button></p>
                    </form>
                </div>
            </div>
        </div>
        <!--end span9-->
        <div class="span3 blog-sidebar">
            <?php if(isset($relate) and $relate) { ?>
                <h3>ข่าวที่เกี่ยวข้อง</h3>
                <?php $arr_color = array('red', 'green', 'blue', 'yellow', 'purple'); ?>
                <div class="top-news">
                    <?php foreach ($relate as $k_relate => $v_relate) { ?>
                        <a href="<?= site_url('news/detail/'.$v_relate['n_newsid']); ?>" class="btn <?= $arr_color[($k_relate%5)]; ?>">
                            <span><?= cutCaption($v_relate['n_subject'], 50); ?></span>
                            <?php list($y, $m, $d) = explode('-', $v_relate['n_date']); ?>
                            <em>ลงเมื่อวันที่ <?= $d; ?> - <?= $m; ?> - <?= $y + 543; ?></em>
                            <?php /*<em class="float_left">ระบบรายงาน :</em>*/ ?>
                            <em>
                                <div class="clear"></div>
                                <em class="float_left">จาก : <?= $v_relate['n_from']; ?></em>
                                <?php if(isset($v_relate['tag']) and $v_relate['tag']) { ?>
                                    <em>
                                        <div class="clear"></div>
                                        <i class="fa fa-tags"></i>
                                        <?php $count_tag = count($v_relate['tag']); ?>
                                        <?php foreach ($v_relate['tag'] as $k_tag => $v_tag) { ?>
                                            <?= $v_tag['nt_word']; ?>
                                            <?= ($count_tag != $k_tag + 1) ? ', ' : ''; ?>
                                        <?php } ?>
                                    </em>
                                <?php } ?>
                            </em>
                            <i class="fa fa-newspaper-o top-news-icon"></i>
                        </a>
                    <?php } ?>
                </div>
                <div class="space20"></div>
            <?php } ?>
            <?php if(isset($gallery) and $gallery) { ?>
                <h3>รูปที่เกี่ยวข้องกับข่าว</h3>
                <ul class="unstyled blog-images">
                <?php $c_gallery = count($gallery); ?>
                <?php foreach ($gallery as $k_gallery => $v_gallery) { ?>
                    <li>
                        <a class="gallery" href="<?= getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>">
                            <img alt="" src="<?= getImagePath($this->news_images_path . $result['n_newsid'] . '/' . $v_gallery['ni_path']); ?>" width="50" height="50">
                        </a>
                    </li>
                <?php } ?>
                </ul>
                <div class="space20"></div>
            <?php } ?>
        </div>
        <!--end span3-->
    </div>
</div>
<form class="del" action="<?= site_url('news/delete?page=lists'); ?>" method="post">
    <input type="hidden" id="del_id" name="del_id">
</form>
<script>
    $(function(){
        $('.edit-form .fa-remove').click(function(){
            $('.edit-form').hide();
            $('.edit-form-id').html('');
            $('#nc_commentid').val('');
            $('#comment').val('');
            return false;
        });
        $('.quote-form .fa-remove').click(function(){
            $('.quote-form').hide();
            $('.quote-form-id').html('');
            $('#nc_parentid').val('');
            $('#comment').val('');
            return false;
        });
    });
    <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
        function del(id) {
            $('#del_id').val('');
            if(confirm('ยืนยันการลบข้อมูล!!!') === true) {
                $('#del_id').val(id);
                $('form.del').submit();
            }
            $('#del_id').val('');
        }
    <?php } ?>
    function delComment(id, obj) {
        if(confirm('ยืนยันการลบความคิดเห็น!!!') === true) {
            console.log(obj.html());
            $.post('<?= site_url('news/deleteComment'); ?>', { id : id }, function(data) {
                if(data == 'true') {
                    obj.parent().parent().parent().parent().parent().remove();
                }
            });
        }
        return false;
    }
    function editComment(no, id, obj) {
        $('.edit-form-id').html(no);
        $('#nc_commentid').val(id);
        
        $('.quote-form').hide();
        $('.quote-form-id').html('');
        $('#nc_parentid').val('');
        $('#comment').val(obj.parent().parent().parent().parent().children('p').html());
        
        $('.edit-form').show();
        return false;
    }
    function quote(no, id) {
        $('.quote-form-id').html(no);
        $('#nc_parentid').val(id);
        
        $('.edit-form').hide();
        $('.edit-form-id').html('');
        $('#nc_commentid').val('');
        $('#comment').val('');
        
        $('.quote-form').show();
        return false;
    }
</script>
<style>
<?php if(isset($_GET['popup']) and $_GET['popup']) { ?>
    .comment-section, .navbar.navbar-inverse {
        display: none;
    }
<?php } ?>
    .edit-form, .quote-form {
        display: none;
    }
    .edit-form .fa-remove, .quote-form .fa-remove {
        font-size: 15px;
        vertical-align: top;
        color: #d43f3a;
        cursor: pointer;
    }
    .edit-comment, .del-comment, .reply {
        cursor: pointer;
    }
    .media .media {
        padding-left: 60px;
    }
</style>
