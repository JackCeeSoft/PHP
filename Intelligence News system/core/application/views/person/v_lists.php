<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <fieldset>
                <p></p>
                
                
        <div class="col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="person/lists">
                    <fieldset>
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ค้นหาด้วย ชื่อสกุล : </label>
                            </div>
                            <div class="col-lg-4 margin-top10px">
                                <input type="text" name="p_search" value="<?php if(isset($p_search) and $p_search) echo $p_search; ?>">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label right">เลือกระบบงาน : </label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" name="p_unit">
                                    <option value="0">เลือกทุกระบบงาน</option>
                                    <?php 
                                    foreach ($unit as $values){
                                        if($values['u_unitid'] == 3 OR $values['u_unitid'] == 5){
                                            //echo $values['u_unitid'];
                                        }else{
                                        ?>
                                        <option value="<?= $values['u_unitid']; ?>" <?= (isset($p_unit) and $p_unit == $values['u_unitid']) ? 'selected' : ''; ?>><?= $values['u_name']; ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <p></p>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="person/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                               <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">จำนวนรายการ : </label>
                            </div>
                            <div class="col-lg-10">
                                <label class="control-label right"><?= $total_report_type_rows; ?> รายการ</label>
                            </div>
                        </div>
                       <div>
                            <a href="<?= site_url('person/insert'); ?>" class="btn btn-primary">เพิ่มบุคคล <i class="fa fa-plus-circle"></i></a>
                        </div>
                        <br>
                    </fieldset>
                </form>
            </div>
        </div>
                
        </div>
        </div>
        <div class="col-lg-12 center">
            <div class="table-responsive">
                <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>ลำดับ</th>
                            <th>เวลาสร้าง</th>
                            <th>รายการบุคคล</th>
                            <th>บันทึกโดยระบบงาน</th>
                            <th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($p_search)){
                                
                            }else{
                                $p_search = "";
                            }
                        ?>
                        <?php if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= substr($v_lists['p_createddate'], 0,16); ?></td>
                                    <td><?= $v_lists['p_title']." ".highlightWords($v_lists['p_firstname'],$p_search)." ".highlightWords($v_lists['p_lastname'],$p_search); ?></td>
                                    
                                    <?php 
                                        foreach ($unit as $values){
                                            if(($v_lists['p_unit']+0) == $values['u_unitid']){
                                                echo "<td>".$values['u_name']."</td>";
                                            }
                                        }
                                    ?>
                                    <td>
                                    <center>
<!--                                    <span><a href="<?= site_url('person/lists/'); ?>"><i class="fa fa-camera"></i></a></span>-->
                                        <span><a title="ดูรายละเอียด" href="<?= site_url('person/look_person/'. $v_lists['p_personid']); ?>">&nbsp;<i class="fa fa-search"></i></a></span>
                                        <span><a title="ลำดับพฤติกรรม" href="<?= site_url('person/look_person/'. $v_lists['p_personid'] .'/0'); ?>">&nbsp;<i class="fa fa-adjust"></i></a></span>
                                    <?php 
                                        //echo $unit_edit."=".$v_lists['p_unit'];
                                        if(isset($unit_edit) && $unit_edit == $v_lists['p_unit']+0) {
                                    ?>
                                        <span><a title="แก้ไขข้อมูลบุคคล" href="<?= site_url('person/updateTap1/' . $v_lists['p_personid']); ?>">&nbsp;<i class="fa fa-pencil"></i></a></span>
                                        <span><a title="ลบบุคคล" class="del-paragraph" href="<?= site_url('person/delete/' . $v_lists['p_personid']); ?>">&nbsp;<i class="fa fa-trash-o"></i></a></span>
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
            }
            return false;
        });
</script>



