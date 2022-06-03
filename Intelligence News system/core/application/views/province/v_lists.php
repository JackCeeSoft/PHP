<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel  col-lg-12 center">
      <div class="col-lg-12">
          <?php 
                if(isset($keyword) and $keyword){
                    
                }else{
                    $keyword = "";
                }
          ?>
                <form class="form-horizontal" action="province/lists">
                
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำค้นหา (Keyword) : </label>
                            </div>
                            <div class="col-lg-4 margin-top10prx">
                                <input class="form-control" type="text" name="g_search" value="<?php if(isset($keyword) and $keyword) echo $keyword; ?>">
                            </div>
                            <br>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> ภูมิภาค : </label>
                            </div>
                            <div class="col-lg-4 margin-top10prx">
                                <select class="form-control" name="geo_id">
                                    <option value="0">เลือกภูมิภาคทั้งหมด</option>
                                    <?php 
                                    foreach ($geo_data as $v_geo){
                                        ?>
                                    <option value="<?= $v_geo['geo_id']; ?>" <?= (isset($geo_id) and $geo_id == $v_geo['geo_id']) ? 'selected' : ''; ?>><?= $v_geo['geo_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> สถานะแสดงผล : </label>
                            </div>
                            <div class="col-lg-4 margin-top10prx">
                                <select class="form-control" name="province_show">
                                <option value="0">เลือกสถานะทั้งหมด</option>
                                <?php 
                                    if(isset($province_show) && $province_show == 'Y'){
                                        echo '<option selected value="Y" style="color:#21C12E;">แสดงผลใช้งาน</option>
                                              <option value="N" style="color:red;">ไม่แสดงผลใช้งาน</option>';
                                    }else{
                                        if($province_show == 'N'){
                                            echo '<option  value="Y" style="color:#21C12E;">แสดงผลใช้งาน</option>
                                              <option selected value="N" style="color:red;">ไม่แสดงผลใช้งาน</option>';
                                        }else{
                                            echo '<option value="Y" style="color:#21C12E;">แสดงผลใช้งาน</option>
                                              <option value="N" style="color:red;">ไม่แสดงผลใช้งาน</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="province/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                            
                            <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">จำนวนรายการ : </label>
                            </div>
                            <div class="col-lg-5">
                                <label class="control-label left"><?php echo $total_rows;?> รายการ</label>
                            </div>
                            </div>
                </form>
            </div>
<!--            <div class="col-lg-12 text-right mb-20">
                <a href="province/add">
                <button type="submit" class="btn btn-primary"></button>
                </a>
            </div>-->
        <div class="col-lg-12 center">
            
            <?php if(isset($username_already_exsit)){
                    echo '<div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Error !</strong> <p>มี "UserName" นี้ในระบบแล้ว</p>
                    </div>';
            } ?>
           
            <div class="table-responsive">
                    <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                        <thead> 
                            <tr>
                                <th width="15">ลำดับ</th>
                                <th width="30">ชื่อจังหวัด</th>
                                <th width="120">ภูมิภาค</th>
                                <!--<th width="120">สถานะแสดงผล</th>-->
                                <th width="30">สถานะแสดงผล</th>
                                <?php if(isset($lists) and $lists) { ?>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                                <tr>
                                                    <th><?= ($k_lists + 1 + $offest); ?></th>
                                                    <td><?= highlightWords($v_lists['province_name'],$keyword); ?></td>
                                                    <td><?php
                                                        foreach ($geo_data as $values){
                                                            if($values['geo_id'] == $v_lists['geo_id']){
                                                                echo $values['geo_name'];
                                                            }
                                                        }
                                                    ?>
                                                    </td>
<!--                                                    <td><?php
                                                        if(isset($v_lists['province_show']) && $v_lists['province_show'] == 'Y'){
                                                            echo '<span style="color: #21C12E;">แสดงผลใช้งาน</span>';
                                                        }else{
                                                            echo '<span style="color: red;">ไม่แสดงผลใช้งาน</span>';
                                                        }
                                                    ?></td>-->
                                    <td>
                                        <center>
                                            <a href="#" onclick="changeStatus(<?= $v_lists['province_id']; ?>, $(this)); return false;"><?= ($v_lists['province_show'] == 'Y') ? '<img src="assets/img/icon/enable.png" width="30" height="16" title="ปิดการแสดงผล">' : '<img src="assets/img/icon/disable.png" width="30" height="16" title="เปิดการแสดงผล">'; ?></a>
                                        </center>
                                    </td>
                                                </tr>
                                            <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="6">ไม่พบข้อมูล</td></tr>
                                <?php } ?>
                                        </tbody>
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
function changeStatus(id, obj) {
        if(confirm('เปลี่ยนแปลงสถานะ!!!') === true) {
            $.post('<?= site_url('province/changeStatus'); ?>', { id : id }, function(data){
                if(data == 'Y') {
                    obj.html('<img src="assets/img/icon/enable.png" width="30" height="16" title="ปิดการแสดงผล">');
                } else if(data == 'N') {
                    obj.html('<img src="assets/img/icon/disable.png" width="30" height="16" title="เปิดการแสดงผล">');
                } else {
                    alert('เกิดข้อผิดพลาดในการแก้ไขสถานะ!!!');
                }
            });
        }
}
</script>