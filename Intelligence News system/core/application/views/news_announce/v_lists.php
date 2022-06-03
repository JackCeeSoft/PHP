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
                        <strong>Error !</strong> <p>เกิดข้อผิด ข่าวสารนี้ยังมีข่าวที่เกี่ยวพันกันอยู่</p>
                    </div>';
                        }
            ?>
            <div class="col-lg-12">
                <form class="form-horizontal" action="news_announce/lists">
                    <fieldset>
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ค้นหา หัวข้อข่าว : </label>
                            </div>
                            <div class="col-lg-3 margin-top10px">
                                <input type="text" name="d_search" value="<?php if(isset($d_search) and $d_search) echo $d_search; ?>">
                            </div>
                            
<!--                            <div class="col-lg-2">
                                <label class="control-label right">เลือกระบบงาน : </label>
                            </div>-->
<!--                            <div class="col-lg-4">
                                <select class="form-control" name="d_unit">
                                    <?php if(isset($base_unitid)){
                                        echo '<option value="0">เลือกทุกระบบงาน</option>';
                                    } ?>
                                    <?php 
                                    foreach ($unit as $values){
                                        if($values['u_unitid'] == 3 OR $values['u_unitid'] == 5){
                                            //echo $values['u_unitid'];
                                        }else{
                                        ?>
                                        <option value="<?= $values['u_unitid']; ?>" <?= (isset($d_unit) and $d_unit == $values['u_unitid']) ? 'selected' : ''; ?>><?= $values['u_name']; ?></option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                            </div>-->
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="news_announce/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
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
                            <a href="<?= site_url('news_announce/insert'); ?>" class="btn btn-primary">เพิ่มข่าวสาร <i class="fa fa-plus-circle"></i></a>
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
                            <th>หัวข้อข่าว</th>
                            <th>บันทึกโดยระบบงาน</th>
                            <th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($d_search)){
                                
                            }else{
                                $d_search = "";
                            }
                        ?>
                        <?php if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= substr($v_lists['d_createddate'], 0,16); ?></td>
                                    <td>
                                        <a title="ดูรายละเอียด" href="<?= site_url('news_announce/look_dashbord/' . $v_lists['d_announceid']); ?>"><?= highlightWords($v_lists['d_fullnameth'],$d_search); ?></a>
                                    </td>
                                    <td>
                                    <?php 
                                        foreach ($unit as $values){
                                            if(($v_lists['d_unit']+0) == $values['u_unitid']){
                                                echo "".$values['u_name']."";
                                            }
                                        }
                                    ?>
                                    </td>
                                    <?php 
//                                        $count_news = 0;
//                                        foreach ($count_news_user as $values){
//                                            if(($v_lists['d_announceid']) == $values['d_announceid']){
//                                                //echo "".$values['count']."";
//                                                $count_news = $values['count'];
//                                            }
//                                        }
                                    ?>
<!--                                    <td>
                                       <center>-->
                                    <?php
                                            //echo $count_news;
                                    ?>
<!--                                        </center>
                                    </td>-->
                                    
                                    
                                    <td>
                                    <center>

                                        <span><a title="ดูรายละเอียด" href="<?= site_url('news_announce/look_dashbord/' . $v_lists['d_announceid']); ?>"><i class="fa fa-search"></i></a> </span>

                                       <?php 
                                        //echo $unit_edit."=".$v_lists['p_unit'];
                                        if(isset($unit_edit) && $unit_edit == $v_lists['d_unit']+0) {
                                        ?>
                                        <span><a title="แก้ไขกลุ่ม" href="<?= site_url('news_announce/updateTap1/' . $v_lists['d_announceid']); ?>">&nbsp;<i class="fa fa-pencil"></i></a> </span>
                                        <span><a title="ลบกลุ่ม" class="del-paragraph" href="<?= site_url('news_announce/delete/' . $v_lists['d_announceid']); ?>">&nbsp;<i class="fa fa-trash-o"></i></a> </span>
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