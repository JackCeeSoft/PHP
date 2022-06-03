<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        
        <div class="col-lg-12">
                <form class="form-horizontal" action="unit_sub/lists">
                
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ค้นหา รายการกลุ่มย่อย : </label>
                            </div>
                            <div class="col-lg-6 margin-top10px">
                                <input type="text" name="us_search" value="<?php if(isset($us_search) and $us_search) echo $us_search; ?>">
                            </div>
                         </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">ค้นหา รายชื่อกลุ่ม : </label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" name="u_unitid">
                                    <option value="0">เลือกค้นหาทุกรายชื่อกลุ่ม</option>
                                    <?php 
                                    if(!isset($u_unitid)){
                                        $u_unitid = 5;
                                    }
                                    foreach ($unit as $values){
                                        ?>
                                    <option value="<?= $values['u_unitid']; ?>" <?= (isset($u_unitid) and $u_unitid == $values['u_unitid']) ? 'selected' : ''; ?>><?= $values['u_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                            <p></p>
                            <br>
                            <div class="form-group">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="unit_sub/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
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
        
        <div class="col-lg-12 text-right mb-20">
                                <a href="unit_sub/add">
                                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                </a>
        </div>
            
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
                                <th style="text-align:center;" width="50">ลำดับ</th>
                                <th style="text-align:center;" width="100">รายการกลุ่มย่อย</th>
                                <th style="text-align:center;" width="80">ลำดับแสดงผล</th>
                                <th style="text-align:center;" width="200">ชื่อกลุ่ม</th>
                                <th style="text-align:center;" width="100">เวลา</th>
                                <th style="text-align:center;" width="80">การกระทำ</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php if(isset($lists) and $lists) { ?>
                                        <tbody>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                            <tr>
                                                    <th style="text-align:center;"><?= ($k_lists + $offset); ?></th>
                                                    
                                                    <td><?= highlightWords($v_lists['s_name'],$us_search); ?></td>
                                                    <td style="text-align: center;"><?= $v_lists['s_seq']; ?></td>
                                                    <td><?php
                                                        foreach ($unit as $values){
                                                            if($values['u_unitid'] == $v_lists['u_unitid']){
                                                                echo $values['u_name'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td style="text-align:center;"><?= $v_lists['s_updateddate']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!--<span><a href="<?= site_url('unit_sub/detail/' . $v_lists['s_unitsub_id']); ?>"><img src="assets/img/icon/view.png" width="16" height="16" alt="" title="ดู"></a></span>-->
                                                            <span><a href="<?= site_url('unit_sub/edit/' . $v_lists['s_unitsub_id']); ?>">&nbsp;<img src="assets/img/icon/edit.png" width="16" height="16" alt="" title="แก้ไข"></a></span>
                                                            <span><a class="del-paragraph" href="<?= site_url('unit_sub/delete/' . $v_lists['s_unitsub_id']); ?>">&nbsp;<img src="assets/img/icon/delete.png" width="16" height="16" alt="" title="ลบ"></a></span>
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

<script>
$('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
               return true;
            }
            return false;
        });
</script>