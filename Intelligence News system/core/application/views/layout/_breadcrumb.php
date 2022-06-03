<div class="col-lg-12">
    <?php if(empty($hide_btnhome)) { ?>
        <?php if(isset($_GET['popup']) and $_GET['popup']) { ?>
            <a class="btn home" onclick="window.parent.$('.modal-backdrop').click();">ปิด</a>
        <?php } else { ?>
            <!--<a class="btn home" href="<?= base_url(); ?>">กลับหน้าแรก</a>-->
        <?php } ?>
    <?php } ?>
    <h3 class page-header><?= $title_section; ?></h3>
    <ul class="breadcrumb">
        <?php if(isset($breadcrumb) and $breadcrumb) { ?>
            <?php $c_breadcrumb = count($breadcrumb); ?>
            <?php foreach ($breadcrumb as $k_breadcrumb => $v_breadcrumb) { ?>
                <?php if(($k_breadcrumb+1) == $c_breadcrumb) { ?>
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