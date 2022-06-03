<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
            
                <fieldset>
                <p></p>
                <div class="form-group">
                    
                    
        <div class="col-lg-12 center">
            <?php 
                        if(isset($Error_delete) && $Error_delete != ""){
                          echo '<div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Error !</strong> <p>เกิดข้อผิด องค์กรนี้ยังมีข่าวที่เกี่ยวพันกันอยู่</p>
                    </div>';
                        }
            ?>
            <div class="col-lg-12">
                <form class="form-horizontal" action="organization/lists">
                    <fieldset>
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ค้นหา ชื่อองค์กร : </label>
                            </div>
                            <div class="col-lg-3 margin-top10px">
                                <input type="text" name="o_search" value="<?php if(isset($o_search) and $o_search) echo $o_search; ?>">
                            </div>
                            
                            <div class="col-lg-2">
                                <label class="control-label right">เลือกระบบงาน : </label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" name="o_unit">
                                    <option value="0">เลือกทุกระบบงาน</option>
                                    <?php 
                                    foreach ($unit as $values){
                                        if($values['u_unitid'] == 3 OR $values['u_unitid'] == 5){
                                            //echo $values['u_unitid'];
                                        }else{
                                        ?>
                                        <option value="<?= $values['u_unitid']; ?>" <?= (isset($o_unit) and $o_unit == $values['u_unitid']) ? 'selected' : ''; ?>><?= $values['u_name']; ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="organization/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-lg-2">
                                    <label class="control-label right">จำนวนรายการ : </label>
                                </div>
                                <div class="col-lg-5">
                                    <label class="control-label right"><?= $total_report_type_rows; ?> รายการ</label>
                                </div>
                            </div>
                       <div>
                            <a href="<?= site_url('organization/insert'); ?>" class="btn btn-primary">เพิ่มองค์กร <i class="fa fa-plus-circle"></i></a>
                        </div>
                        <br>
                    </fieldset>
                </form>
            </div>
        </div>
              
		    </fieldset></form></div>
        </div>
        <div class="col-lg-12 center">
            <div class="table-responsive">
                <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>ลำดับ</th>
                            <th>เวลาสร้าง</th>
                            <th>รายการองค์กร</th>
                            <th>บันทึกโดยระบบงาน</th>
                            <th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($o_search)){
                                
                            }else{
                                $o_search = "";
                            }
                        ?>
                        <?php if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= substr($v_lists['o_createddate'], 0,16); ?></td>
                                    <td><?= highlightWords($v_lists['o_fullnameth'],$o_search); ?></td>
                                    <?php 
                                        foreach ($unit as $values){
                                            if(($v_lists['o_unit']+0) == $values['u_unitid']){
                                                echo "<td>".$values['u_name']."</td>";
                                            }
                                        }
                                    ?>
                                    <td>
                                    <center>
<!--                                        <span><a href="<?= site_url('organization/lists/'); ?>"><i class="fa fa-camera"></i></a></span>-->
                                        
<!--                                        <span><a href="<?= site_url('organization/lists/'); ?>">&nbsp;<i class="fa fa-search"></i></a></span>-->
<!--                                        <span><a href="<?= site_url('organization/pdf_organize/' . $v_lists['o_organizationid']); ?>"><i class="fa fa-search"></i></a></span>-->
                                        <span><a title="ดูรายละเอียด" href="<?= site_url('organization/look_organize/' . $v_lists['o_organizationid']); ?>"><i class="fa fa-search"></i></a> </span>
                                        <span><a title="ลำดับพฤติกรรม" href="<?= site_url('organization/look_organize/' . $v_lists['o_organizationid'] .'/0'); ?>"><i class="fa fa-adjust"></i></a> </span>
                                        <?php 
                                        //echo $unit_edit."=".$v_lists['p_unit'];
                                        if(isset($unit_edit) && $unit_edit == $v_lists['o_unit']+0) {
                                        ?>
                                        <span><a title="แก้ไขกลุ่ม" href="<?= site_url('organization/updateTap1/' . $v_lists['o_organizationid']); ?>">&nbsp;<i class="fa fa-pencil"></i></a> </span>
                                        <span><a title="ลบกลุ่ม" class="del-paragraph" href="<?= site_url('organization/delete/' . $v_lists['o_organizationid']); ?>">&nbsp;<i class="fa fa-trash-o"></i></a> </span>
<!--                                        <span><a href="<?= site_url('organization/pdf_organize/'.$v_lists['o_organizationid']); ?>" target="_blank" ><i class="fa fa-download"></i></a> </span>-->
                                        <?php }?>
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
            }else{
                return false;
            }
        });
</script>