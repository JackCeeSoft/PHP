<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="col-lg-12 mb-20 text-right">
            <a href="<?= site_url('news_person5/insert'); ?>" class="btn btn-primary">เพิ่มบุคคล,สูญเสีย,บาดเจ็บ</a>
        </div>
        <div class="col-lg-12 center">
            <div class="table-responsive">
                <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="150">ลำดับจัดเรียง</th>
                            <th>ชื่อบุคคล</th>
                            <th>คำอธิบายเพิ่มเติม</th>
                            <th width="100">การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= $v_lists['np_seq']; ?></td>
                                    <td><?= $v_lists['np_person']; ?></td>
                                    <td><?= $v_lists['np_description']; ?></td>
                                    <td>
                                        <center>
                                            <span><a href="<?= site_url('news_person5/update/' . $v_lists['np_newspersonid']); ?>"><img src="assets/img/icon/edit.png" width="16" height="16" alt="" title="แก้ไข"></a></span>
                                            <span><a class="del-paragraph" href="<?= site_url('news_person5/delete/' . $v_lists['np_newspersonid']); ?>" class="del"><img src="assets/img/icon/delete.png" width="16" height="16" alt="" title="ลบ"></a></span>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr><td colspan="5">ไม่พบข้อมูล</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
        </div>
    </div>
</div>

<script>
$('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
                return true;
            }
            return false;
        });
</script>