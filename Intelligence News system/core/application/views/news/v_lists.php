<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" action="<?= site_url('news/lists'); ?>">
                    <fieldset>
                        <p></p>
                        <div class="form-group">
                            <!--<div class="col-lg-2">
                                <label class="control-label right"> ข่าวประจำวันที่ : </label>
                            </div>-->
                            <div class="col-lg-5">
                                <select class="form-control" id="u_unitid" name="u_unitid">
                                    <?php if((isset($this->isadmin) and $this->isadmin == 'Y') or $this->u_unitid === 0) { ?>
                                        <option value="0">ทุกระบบงาน</option>
                                        <?php foreach ($unit as $v_u) { ?>
                                            <option value="<?= $v_u['u_unitid']; ?>" <?= (isset($filter['u_unitid']) and $filter['u_unitid'] == $v_u['u_unitid']) ? 'selected' : ''; ?>><?= $v_u['u_name']; ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php foreach ($unit as $v_u) { ?>
                                            <?php if(isset($filter['u_unitid']) and $filter['u_unitid'] == $v_u['u_unitid']) { ?>
                                                <option value="<?= $v_u['u_unitid']; ?>" selected ><?= $v_u['u_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                                           
<!--                            <div class="col-lg-5">
                                <select class="form-control" id="s_unitsub_id"  name="s_unitsub_id"></select>
                            </div>-->
         
                            <!-- <div class="col-lg-2">
                                <select class="form-control" name="s_unitsub_id">
                                    <?php if((isset($this->isadmin) and $this->isadmin == 'Y') or $this->s_unitsubid === 0) { ?>
                                        <option value="0">ทุกหน่วยงาน</option>
                                        <?php foreach ($unit_sub as $v_us) { ?>
                                            <option value="<?= $v_us['s_unitsub_id']; ?>" <?= (isset($filter['s_unitsub_id']) and $filter['s_unitsub_id'] == $v_us['s_unitsub_id']) ? 'selected' : ''; ?>><?= $v_us['s_name']; ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php foreach ($unit_sub as $v_us) { ?>
                                            <?php if(isset($filter['s_unitsub_id']) and $filter['s_unitsub_id'] == $v_us['s_unitsub_id']) { ?>
                                                <option value="<?= $v_us['s_unitsub_id']; ?>" selected ><?= $v_us['s_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div> -->
                            <div class="col-lg-2 hasDatepicker">
                                <div class="input-append date" id="datetimepicker1">
                                    <input data-format="yyyy-MM-dd" type="text" name="n_date" style="width: 121px;" <?= (isset($filter['n_date']) and $filter['n_date']) ? 'value="'.$filter['n_date'].'"' : ''; ?> placeholder="วันที่">
                                    <span class="add-on">
                                        <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
<!--                            <div class="col-lg-3">
                                <select class="form-control" name="hl_hastelevelid">
                                    <option value="">กรุณาเลือกความเร่งด่วน</option>
                                    <?php foreach ($haste_level as $v_hl) { ?>
                                        <option value="<?= $v_hl['hl_hastelevelid']; ?>" <?= (isset($filter['hl_hastelevelid']) and $filter['hl_hastelevelid'] == $v_hl['hl_hastelevelid']) ? 'selected' : ''; ?>><?= $v_hl['hl_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control" name="sl_secretid">
                                    <option value="">กรุณาเลือกชั้นความลับ</option>
                                    <?php foreach ($secret_level as $v_sl) { ?>
                                        <option value="<?= $v_sl['sl_secretid']; ?>" <?= (isset($filter['sl_secretid']) and $filter['sl_secretid'] == $v_sl['sl_secretid']) ? 'selected' : ''; ?>><?= $v_sl['sl_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>-->
                            <div class="col-lg-4">
                                <input class="form-control" name="keyword" <?= (isset($filter['keyword']) and $filter['keyword']) ? 'value="'.$filter['keyword'].'"' : ''; ?> placeholder="คีย์เวิร์ด">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <!--<div class="col-lg-9"></div>-->
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="<?= site_url('news/lists'); ?>" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                        <?php if(isset($filter['n_date']) and $filter['n_date']) { ?>
                            <div class="form-group mb-0">
                                <div class="col-lg-2">
                                    <label class="control-label right">รายการข่าวประจำวันที่ : </label>
                                </div>
                                <div class="col-lg-10">
                                    <label class="control-label right"><?= chngFormatDateFromDB($filter['n_date']); ?> <?= $total_rows; ?> รายการ</label>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">รายการทั้งหมด : </label>
                            </div>
                            <div class="col-lg-10">
                                <label class="control-label right"><?= number_format($total_news_rows,0); ?> รายการ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">รายการที่ค้นหาพบ : </label>
                            </div>
                            <div class="col-lg-10">
                                <label class="control-label right"><?= number_format($total_rows,0); ?> รายการ</label>
                            </div>
                        </div>
                        <p>
                        <div>
                            <a href="<?= site_url('news/insert'); ?>" class="btn btn-primary">เพิ่มข่าว</a>
                        </div>
                        </p>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-lg-12 center">
            <div class="table-responsive">
                <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="100">วันที่</th>
                            <th width="300">รายการข่าว</th>
                            <th width="100">การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= chngFormatDateFromDB($v_lists['n_date']); ?></td>
                                    <td><a href="<?= site_url('news/detail/' . $v_lists['n_newsid']); ?>"><?= $v_lists['n_subject']; ?></a></td>
                                    <td>
                                        <center>
                                            <a href="#" onclick="changeStatus(<?= $v_lists['n_newsid']; ?>, $(this)); return false;"><?= ($v_lists['n_active'] == 'Y') ? '<img src="assets/img/icon/enable.png" width="30" height="16" title="ปิดการแสดงผล">' : '<img src="assets/img/icon/disable.png" width="30" height="16" title="เปิดการแสดงผล">'; ?></a>
                                            <span><a href="<?= site_url('news/detail/' . $v_lists['n_newsid']); ?>"><img src="assets/img/icon/view.png" width="16" height="16" title="ดู"></a></span>
                                            <?php if((isset($this->user_id) and $this->user_id == $v_lists['n_createdby']) or (isset($this->isadmin) and $this->isadmin == 'Y')){ ?>
                                                <span><a href="<?= site_url('news/update/' . $v_lists['n_newsid']); ?>"><img src="assets/img/icon/edit.png" width="16" height="16" title="แก้ไข"></a></span>
                                            <?php } ?>
                                            <a href="<?= site_url('news/manageGallery/' . $v_lists['n_newsid']); ?>" title="จัดการรูปภาพ"><span class="fa fa-camera v-align-m"></span></a>
                                            <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
                                                <span><a href="#" onclick="del(<?= $v_lists['n_newsid']; ?>); return false;"><img src="assets/img/icon/delete.png" width="16" height="16" title="ลบ"></a></span>
                                            <?php } ?>
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
            <form class="del" action="<?= site_url('news/delete?page=lists'); ?>" method="post">
                <input type="hidden" id="del_id" name="del_id">
            </form>
        </div>
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
        </div>
    </div>
</div>
<script>
    $(function(){
        <?php if(isset($filter['s_unitsub_id'])) { ?>
            first_unit(<?= $filter['s_unitsub_id'].",".$filter['u_unitid']; ?>);
        <?php }else{ ?>
            first_unit_all(<?= $filter['u_unitid']; ?>);
       <?php } ?>
            
        $('#datetimepicker1').datetimepicker({
            language: 'th'
        });
        //$('#s_unitsub_id').html('<option value="0">เลือกระบบย่อยทั้งหมด</option>');
        
        $('#u_unitid').change(function(){  
                //alert( "Handler for .change() called." );
                check_unit(); 
        }); 
    });
    <?php if(isset($this->candelete) and $this->candelete == 'Y'){ ?>
        function del(id) {
            $('#del_id').val('');
            if(confirm('ยืนยันการลบข้อมูล!!!') === true) {
                $('#del_id').val(id);
                $('form.del').submit();
            }
            $('#del_id').val('');
        }
    <?php } ?>
    function changeStatus(id, obj) {
        if(confirm('เปลี่ยนแปลงสถานะ!!!') === true) {
            $.post('<?= site_url('news/changeStatus'); ?>', { id : id }, function(data){
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
    function first_unit_all(u_unitid){
            //alert( "Handler for .change() called." );
           //var s_unitsub_id = $('#s_unitsub_id').val();
           $.post("user/first_unitid_all",{ u_unitid: u_unitid },
           function(result){ 
               //alert(result);
               $('#s_unitsub_id').html(result);
            }); 
    }
    function first_unit(s_unitsub_id,u_unitid){
            //alert( "Handler for .change() called." );
           //var s_unitsub_id = $('#s_unitsub_id').val();
           $.post("user/first_unitid", { s_unitsub_id: s_unitsub_id , u_unitid: u_unitid },
           function(result){ 
               //alert(result);
               $('#s_unitsub_id').html(result);
            }); 
    }
    function check_unit(){
           var u_unitid = $('#u_unitid').val();
           $.post("user/check_unitid", { u_unitid: u_unitid },
            function(result){ 
                //if the result is 1 
                if(result != ""){  
                    //show that the username is available    
                    //alert(result);
                    $('#s_unitsub_id').html(result);
                }else{  
                    //show that the username is NOT available  
                    //alert("No result");
                    $('#s_unitsub_id').html('<option value="0">เลือกระบบย่อยทั้งหมด</option>');
                }
            });  
       }
</script>