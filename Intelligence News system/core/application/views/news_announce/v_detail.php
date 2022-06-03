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
                                <a href="<?= site_url('news_announce/updateTap1/' . $result['d_announceid']); ?>" class="tripbox" data-toggle="tooltip" data-placement="top" title="แก้ไขประกาศข่าวสาร"><i class="fa fa fa-pencil"></i></a>
                                <a href="<?= site_url('news_announce/delete/' . $result['d_announceid']); ?>" class="tripbox del" data-toggle="tooltip" data-placement="top" title="ลบ"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        
                        <!--<a href="#"><i class="fa fa-print"></i></a>-->
<!--                        <a href="<?= site_url('news_announce/detail_pdf/'.$result['d_announceid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว PDF"><i class="fa fa-download"></i></a>
                        <a href="<?= site_url('news_announce/detail_word/'.$result['d_announceid']); ?>" target="_blank" class="tripbox" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดข่าว Word"><i class="fa fa-download"></i></a>-->
                        <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
                            <a href="#" onclick="del(<?= $result['d_announceid']; ?>); return false;" class="tripbox" data-toggle="tooltip" data-placement="top" title="ลบข่าว><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>

            <div class="clear"></div>
            <h1><?= (isset($result['d_fullnameth']) and $result['d_fullnameth']) ? $result['d_fullnameth'] : ''; ?></h1>

            <div class="border_box">
                <div class="float_left padding_left_10px">
                    <span>วันเวลามีผล :
                    </span>
                    <span class="blue"><?= (isset($result['d_startdate']) and $result['d_startdate']) ? $result['d_startdate'] : '-'; ?>
                    </span>
                    <span class="black"> ถึง 
                    </span>
                    <span class="blue"><?= (isset($result['d_enddate']) and $result['d_enddate']) ? $result['d_enddate'] : '-'; ?>
                    </span>
                </div>

                <div class="clear"></div>
                    <div class="padding_left_10px">
                        <span>ไฟล์แนบประกาศ :</span>
                        <span class="blue">  
                            <?php if(isset($attach) and $attach) { ?>
                            <?php foreach ($attach as $k_attach => $v_attach) { ?>
                                <i class="fa fa fa-file-archive-o"> </i><a href="<?= $this->announce_file_path.$v_attach['d_announceid'].'/'.$v_attach['df_path']; ?>" target="_blank"><?= " ".$v_attach['df_path']." "; ?></a>
                            <?php }}else{
                                echo "#ไม่มีเอกสารแนบ<br/>";
                            } ?>
                        </span>

                    </div>
                    <br/><br/>
                    <div class="padding_left_10px">
                        <?php echo $result['d_movement']; ?>
                    </div>
                <br/><br/><br/>
            </div>
        </div>
    </div>
</div>
