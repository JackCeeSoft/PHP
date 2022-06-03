<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        
            <div class="col-lg-12">
                <form class="form-horizontal" action="unit/lists">
                
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ค้นหารายการกลุ่ม : </label>
                            </div>
                            <div class="col-lg-6 margin-top10px">
                                <input type="text" name="g_search" value="<?php if(isset($g_search) and $g_search) echo $g_search; ?>">
                            </div>
                            <p></p>
                            <br>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="unit/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                            
                            <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">จำนวนรายการ : </label>
                            </div>
                            <div class="col-lg-5">
                                <label class="control-label"><?php echo $total_rows; ?> รายการ</label>
                            </div>
                            
                            </div>
                </form>
            </div>
        <div class="col-lg-12 text-right">
            <a href="unit/add">
            <button class="btn btn-primary">เพิ่ม</button>
            <p></p>
            </a>
                
        </div>
        <br>
        <div class="col-lg-12 center">
            <?php if(isset($username_already_exsit)){
                    echo '<div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Error !</strong> <p>มี "Unit" นี้ในระบบแล้ว</p>
                    </div>';
            } ?>
            
            
            
            <div class="table-responsive">
                    <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                        <thead> 
                            <tr>
                                <th width="50">ลำดับ</th>
                                
                                <th width="200">รายการกลุ่ม</th>
                                <th width="150">รหัสยืนยันบันทึกข่าว</th>
                                <th width="300">เวลา</th>
                                <th width="100">การกระทำ</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php if(isset($lists) and $lists) { ?>
                                        <tbody>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                                <tr>
                                                    <th><?= ($k_lists + $offset); ?></th>
                                                    
                                                    <td><?= highlightWords($v_lists['u_name'],$g_search); ?></td>
                                                    
                                                    <td><?= $v_lists['u_approvecode']; ?></td>
                                                    <td><?= substr($v_lists['u_updateddate'], 0,19); ?></td>
                                                    <td>
                                                        <center>
                                                            <!--<span><a href="<?= site_url('unit/detail/' . $v_lists['u_unitid']); ?>"><img src="assets/img/icon/view.png" width="16" height="16" alt="" title="ดู"></a></span>-->
                                                            <span><a href="<?= site_url('unit/edit/' . $v_lists['u_unitid']); ?>">&nbsp;<img src="assets/img/icon/edit.png" width="16" height="16" alt="" title="แก้ไข"></a></span>
                                                            <span><a class="del-paragraph" href="<?= site_url('unit/delete/' . $v_lists['u_unitid']); ?>">&nbsp;<img src="assets/img/icon/delete.png" width="16" height="16" alt="" title="ลบ"></a></span>
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
               return true;
            }
            return false;
        });
</script>