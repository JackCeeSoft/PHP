<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel col-lg-12 center">
            <div class="col-lg-12 text-right mb-20">
                <a href="user_group/add">
                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                </a>
        </div>
            
        <div class="col-lg-12 center">
            <?php if(isset($username_already_exsit)){
                    echo '<div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Error !</strong> <p>มี "User Group" นี้ในระบบแล้ว</p>
                    </div>';
            } ?>
            <div class="table-responsive">
                    <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                        <thead> 
                            <tr>
                                <th width="50">ลำดับ</th>
                                <th width="300">รายการกลุ่ม</th>
                                <th width="100">เวลา</th>
                                <th width="100">การกระทำ</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php if(isset($lists) and $lists) { ?>
                                        <tbody>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                                <tr>
                                                    <th><?= ($k_lists + $offset); ?></th>
                                                    <td><?= $v_lists['ug_groupname']; ?></td>
                                                    <td><?= $v_lists['ug_updateddate']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!--<span><a href="<?= site_url('user_group/detail/' . $v_lists['ug_groupid']); ?>"><img src="assets/img/icon/view.png" width="16" height="16" alt="" title="ดู"></a></span>-->
                                                            <?php 
                                                                echo '<span><a href="user_group/edit/'.$v_lists['ug_groupid'].'">&nbsp;<img src="assets/img/icon/edit.png" width="16" height="16" alt="" title="แก้ไข"></a></span>'; 
                                                                echo '<span><a class="del-paragraph" href="user_group/delete/'.$v_lists['ug_groupid'].'">&nbsp;<img src="assets/img/icon/delete.png" width="16" height="16" alt="" title="ลบ"></a></span>'; 
                                                            ?>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
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
</div>

<script>
$('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
                return true
            }
            return false;
        });
</script>