<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel col-lg-12 center">
            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } ?>
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i> กรอกข้อมูลองค์กร</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <fieldset>
                                <br>
                                <ul class="nav nav-tabs margin0px">
                                    <li class="active"><a href="#menu1" data-toggle="tab" aria-expanded="true">ข้อมูลองค์กร</a></li>
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade active in" id="menu1">
                                        <br>

                                        <div class="form-group">
                                            <div class="col-lg-12 blog-tag-data-inner">
                                                    <img src="assets/img/mockup/no-image.gif" alt="">
                                            </div>
                                            <div class="col-lg-2 margin-top20px">
                                                <label class="control-label right">แนบรูปภาพ : </label>
                                            </div>
                                            <div class="col-lg-6 margin-top20px">
                                                <input class="form-control" type="file" name="image_file">
                                                <small>หมายเหตุ : รูปภาพที่ต้องการแนนต้องมีขนาดไม่เกิน 500 kb</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อองค์กร :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" id="o_fullnameth" name="o_fullnameth" required>
                                            </div>
                                            <div class="col-lg-4">
<!--                                                 <input type='button' id='check_username_availability' class="btn btn-primary" value='ตรวจสอบชื่อองค์กร'>
                                                 <div id='username_availability_result'>
                                                 </div> -->
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาไทย :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameth" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_fullnameen" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="o_shortnameen" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ที่อยู่องค์กร :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="o_address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดความเคลื่อนไหว  : </label>
                                            </div>
                                            
                                            <div class="col-lg-7">
                                            <textarea class="ckeditor" name="editor1"><?php if(isset($result['o_movement']) and $result['o_movement']) echo $result['o_movement']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-10 col-lg-offset-2">
                                            <div id="btn_add" class="col-lg-3"></div>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>

                                    <!-- profile3 -->


                                    <!-- profile1 -->


                                    <!-- profile2 -->

                                      
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {  
        //the min chars for username  
         
        //result texts  
        
      }); 
      
$('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
$('#check_username_availability').click(function(){  
            //run the character number check
            var min_chars = 6;
            var characters_error = '<div class="alert alert-danger">รหัสผู้ใช้งานต้องมีความยาวมากกว่าเท่ากับ 6 ตัวอักษร </div>';  
            var checking_html = 'กำลังตรวจสอบ...';
            
            if($('#o_fullnameth').val().length < min_chars){  
                //if it's bellow the minimum show characters_error text '  
                $('#username_availability_result').html(characters_error);
                ckUsername = false;
            }else{  
                //else show the cheking_text and run the function to check  
                $('#username_availability_result').html(checking_html);  
                check_availability();
                
            }
            btn_add(ckUsername);
        }); 

function check_availability(){  
            //get the username  
            var username = $('#o_fullnameth').val();  

            //use ajax to run the check  
            $.post("organization/check_name", { username: username },  
                function(result){ 
                    //if the result is 1  
                    if(result == 1){  
                        //show that the username is available  
                        //$('#username_availability_result').html(username + ' is Available');  
                        $('#username_availability_result').html('<div class="alert alert-success"><strong>'+username+' </strong> สามารถใช้งานได้ </div>');  
                        ckUsername = true;
                        //alert(ckUsername);
                    }else{  
                        //show that the username is NOT available  
                        $('#username_availability_result').html('<div class="alert alert-danger"><strong>'+username+' </strong> ไม่สามารถใช้ได้เนื่องจากซ้ำซ้อน </div>');
                        ckUsername = false;
                    }
                    btn_add(ckUsername);
            });  
}
function btn_add(ckUser){
       //alert(ckUser);
       //alert(ckPass);
            if(ckUser === true){
                $('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
            }else{
                $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
            }
}


</script>