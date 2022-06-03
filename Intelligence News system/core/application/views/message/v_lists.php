<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
<!--        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
            
                <fieldset>
                <p></p>
                <div class="form-group">
        <div class="col-lg-12 center">

            <div class="col-lg-12">
                <form class="form-horizontal" action="message">
                    <fieldset>
                        <p></p>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label "> ค้นหา keyword : </label>
                            </div>
                            <div class="col-lg-3 margin-top10px">
                                <input type="text" name="o_search" value="<?php if(isset($o_search) and $o_search) echo $o_search; ?>">
                            </div>
                            
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                                <a href="message" class="btn btn-default">เริ่มค้นหาใหม่</a>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-lg-2">
                                    <label class="control-label ">จำนวนรายการ : </label>
                                </div>
                                <div class="col-lg-5">
                                    <label class="control-label ">0 รายการ</label>
                                </div>
                            </div>
                       <div>
                            <a href="<?= site_url('message/insert'); ?>" class="btn btn-primary">เพิ่มหัวเรื่องสนทนา <i class="fa fa-plus-circle"></i></a>
                        </div>
                        <br>
                    </fieldset>
                </form>
            </div>
        </div>
              
		    </fieldset></form></div>
        </div>-->
        <div class="col-lg-12 center">
            <div class="table-responsive">
                <table id="tdcenter" width="auto;" height="auto;" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>ลำดับ</th>
                            <th>เวลาล่าสุด</th>
                            <th>ผู้สนทนาด้วย</th>
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
                        <?php $offset = 1; 
                            if(isset($lists) and $lists) { ?>
                            <?php foreach ($lists as $k_lists => $v_lists) { ?>
                                <tr>
                                    <th><?= ($offset + $k_lists); ?></th>
                                    <td><?= substr($v_lists['c_updateddate'], 0,16); ?></td>
                                    <td>
                                        <?php 
                                        if(isset($v_lists['count_message']) && $v_lists['count_message']){
                                            if($v_lists['c_noti'] == 'N' && $user_id != $v_lists['c_updatedby']) {
                                            echo '('.$v_lists['count_message'].') <i style="color: red;" class="fa fa-wechat"></i> ';
                                        }
                                            if($v_lists['c_noti'] == 'N' && $user_id == $v_lists['c_updatedby']){
                                                    echo '('.$v_lists['count_message'].') <i style="color: green;" class="fa fa-wechat"></i> ';
                                            }
                                        }
                                    ?>
                                    <?php 
                                    
                                        ?> 
                                    
                                    <?= highlightWords($v_lists[0],$o_search); ?>
                                    </td>
                     
                                    <td>
                                    <center>

                                        <span><a title="ตอบกลับ" href="<?= site_url('message/chat/' . $v_lists['ua_userid_ans']); ?>"><i class="fa fa-mail-reply"></i></a> </span>

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