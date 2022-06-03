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
                <form class="form-horizontal" action="user/lists">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">ระบบงาน : </label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" id="u_unitid" name="u_unitid">
                                     <?php if(isset($base_unitid)){
                                                echo '<option value="0">เลือกทุกระบบงาน</option>';
                                            } ?>
                                    <?php 
                                    foreach ($unit as $v_u){
                                        ?>
                                        <option value="<?= $v_u['u_unitid']; ?>" <?= (isset($u_unitid) and $u_unitid == $v_u['u_unitid']) ? 'selected' : ''; ?>><?= $v_u['u_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    
                        <?php 
                        $sesstion = $this->session->all_userdata();
                        //print_r($sesstion);
                            if($sesstion['base_u_unitid'] == 0){ ?>
                              <div class="form-group">
                                <div class="col-lg-2">
                                    <label class="control-label right">หน่วยงาน : </label>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control" id="s_unitsub_id"  name="s_unitsub_id"></select>
                                </div>
                            </div>
                            <?php }else{ ?>
                                 <div class="form-group">
                                    <div class="col-lg-2">
                                        <label class="control-label right">หน่วยงาน : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="s_unitsub_id">
                                            <option value="0">หน่วยงาน</option>
                                            <?php 
                                            foreach ($unit_sub as $values){
                                                ?>
                                            <option value="<?php echo $values['s_unitsub_id'];?>"><?php echo $values['s_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                    <?php } ?>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right"> คำค้นหา (Keyword) : </label>
                            </div>
                            <div class="col-lg-6 margin-top10px">
                                <input type="text" class="form-control" name="g_search" value="<?php if(isset($keyword) and $keyword) echo $keyword; ?>">
                            </div>
                            <p></p>
                            <br>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="user/lists" class="btn btn-default">เริ่มค้นหาใหม่</a>
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
            <div class="col-lg-12 text-right mb-20">
                <a href="user/add">
                <button type="submit" class="btn btn-primary">เพิ่ม</button>
                </a>
            </div>
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
                                <th width="30">ลำดับ</th>
                                <th width="100">ชื่อกลุ่มผู้ใช้งาน</th>
                                <th width="100">ผู้ใช้งาน</th>
                                <th width="100">กลุ่มผู้ใช้งาน</th>
                                <th width="100">ระบบงาน</th>
                                <th width="100">หน่วยงาน</th>
                                <th width="100">เวลา</th>
                                <th width="80">การกระทำ</th>
                            </tr>
                        </thead>
                    <tbody>
                                    <?php if(isset($lists) and $lists) { ?>
                                        <tbody>
                                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                                <tr>
                                                    <th><?= ($k_lists + 1 + $offest); ?></th>
                                                    <td><?= highlightWords($v_lists['ua_firstname'],$keyword)." ".highlightWords($v_lists['ua_lastname'],$keyword); ?></td>
                                                    <td><?= $v_lists['ua_username']; ?></td>
                                                    <td>
                                                    <?php
                                                    
                                                    foreach ($user_group as $values){
                                                            if($values['ug_groupid'] == $v_lists['ug_groupid']){
                                                                echo $values['ug_groupname'];
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    </td>
                                                    <td><?php
                                                    if($v_lists['u_unitid'] == 0){
                                                            echo 'ทุกระบบงาน';
                                                    }if($v_lists['u_unitid'] > 15){
                                                                    echo "อยู่ระบบงานมากกว่า 1";
                                                        }else{
                                                            foreach ($unit as $values){
                                                                if($values['u_unitid'] == $v_lists['u_unitid']){
                                                                    echo $values['u_name'];
                                                                }
                                                            }
                                                    }
                                                    ?></td>
                                                    <td><?php
                                                    //print_r($unit_sub);
                                                    if($v_lists['s_unitsub_id'] == 0){
                                                            echo 'ทุกหน่วยงาน';
                                                    }else{
                                                        foreach ($unit_sub as $values){
                                                            if($values['s_unitsub_id'] == $v_lists['s_unitsub_id']){
                                                                    echo $values['s_name'];
                                                            }
                                                        }
                                                    }
                                                        
                                                        
                                                    ?></td>
                                                    <td><?= $v_lists['ua_updateddate']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!--<span><a href="<?= site_url('user/detail/' . $v_lists['ua_userid']); ?>"><img src="assets/img/icon/view.png" width="16" height="16" alt="" title="ดู"></a></span>-->
                                                            <?php 
                                                                echo '<a style="color:black;" href="message/chat/'.$v_lists['ua_userid'].'"><i class="fa fa-wechat"></i><span></span></a>';
                                                                echo '<span><a href="user/edit/'.$v_lists['ua_userid'].'">&nbsp;<img src="assets/img/icon/edit.png" width="16" height="16" alt="" title="แก้ไข"></a></span>'; 
                                                                echo '<span><a class="del-paragraph" href="user/delete/'.$v_lists['ua_userid'].'">&nbsp;<img src="assets/img/icon/delete.png" width="16" height="16" alt="" title="ลบ"></a></span>'; 
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

<script>
    $(document).ready(function() {
        s_unitsub_id = "";
        <?php
            if(isset($s_unitsub_id) && $s_unitsub_id){
         ?>     s_unitsub_id = <?php echo $s_unitsub_id; ?>  
        <?php    }
        ?>
            check_unit(s_unitsub_id);

    });
$('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
               return true;
            }
            return false;
        });
        
$('#s_unitsub_id').html('<option value="0">ทุกหน่วยงาน</option>');
$('#u_unitid').change(function(){  
                //alert( "Handler for .change() called." );
                check_unit(); 
        });
function check_unit(s_unitsub_id){
   //alert(s_unitsub_id);
   if(s_unitsub_id == ""){
       s_unitsub_id = 0;
   }
   var u_unitid = $('#u_unitid').val();
   $.post("user/check_unitid", { u_unitid: u_unitid , s_unitsub_id:s_unitsub_id},
    function(result){ 
        //if the result is 1 
        if(result != ""){  
            //show that the username is available    
           // alert(result);
            $('#s_unitsub_id').html(result);
        }else{  
            //show that the username is NOT available  
            //alert("No result");
            $('#s_unitsub_id').html('<option value="0">ทุกหน่วยงาน</option>');
        } 

    });  
}
</script>