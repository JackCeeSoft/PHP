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
                            <h3 class="panel-title"> <i class="fa fa-bars"></i> กรอกข้อมูลข่าวสาร</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <fieldset>
                                <br>
                                <ul class="nav nav-tabs margin0px">
                                    <li class="active"><a href="#menu1" data-toggle="tab" aria-expanded="true">ข้อมูลข่าวสาร</a></li>
                                </ul>

                                <div id="myTabContent" class="tab-content panel-body">
                                    <!-- menu1 -->
                                    <div class="tab-pane fade active in" id="menu1">
                                        <br>

<!--                                        <div class="form-group">
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
                                        </div>-->

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">หัวข้อข่าวสาร :  *</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" id="d_fullnameth" name="d_fullnameth" required>
                                            </div>
<!--                                            <div class="col-lg-4">
                                                 <input type='button' id='check_username_availability' class="btn btn-primary" value='ตรวจสอบชื่อข่าวสาร'>
                                                 <div id='username_availability_result'>
                                                 </div> 
                                            </div>-->
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="col-lg-2">
                                                    <label class="control-label right">วันเวลา : *</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-append date" id="datetimepicker1">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_startdate" required <?= (isset($filter['d_startdate']) and $filter['d_startdate']) ? 'value="'.$filter['d_startdate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
                                                        <span class="add-on">
                                                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-lg-1">
                                                    <span class="date-range"> ถึง </span>
                                                </div>
                                                
                                                <div class="col-lg-4">
                                                    <div class="input-append date" id="datetimepicker2">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="d_enddate" required <?= (isset($filter['d_enddate']) and $filter['d_enddate']) ? 'value="'.$filter['d_enddate'].'"' : 'value="'.date('Y-m-d H:i:s').'"'; ?>>
                                                        <span class="add-on">
                                                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

<!--                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาไทย :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="d_fullnameth" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="d_fullnameen" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ชื่อย่อภาษาอังกฤษ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" name="d_shortnameen" >
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                             <div class="col-lg-2">
                                                <label class="control-label right">เอกสารแนบ :  </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-10 group-attach-file">
                                                        <input class="form-control attach_file" type="file" name="attach_file[]">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button class="btn btn-success mt--25" id="add_more_file">เพิ่มไฟล์ </button>
                                                    </div>
                                                </div>
                                                <span class="form-comment">นามสกุลไฟล์ doc/docx/dot/dotx/xls/xlsx/pdf/ppt/rar/zip</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">รายละเอียดข่าวสาร  : </label>
                                            </div>
                                            
                                            <div class="col-lg-7">
                                            <textarea class="ckeditor" name="editor1"><?php if(isset($result['d_movement']) and $result['d_movement']) echo $result['d_movement']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2">
                                                <label class="control-label right">ใช้งาน : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control" name="d_isactive">
                                                    <option value="Y">ใช้งาน</option>
                                                    <option value="N">ไม่ใช้งาน</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <div id="btn_add" type="submit" class="col-lg-2"></div>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </div>
                                    </div>
                                      
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
    $('#datetimepicker1').datetimepicker({

    });
    
    $('#datetimepicker2').datetimepicker({

    });
//$('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
$('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');

/*-----------------------start manage paragraph -----------------------*/
        $('button.paragraph-save').click(function(){
            var image_file = $('#image_file').val();
            if(image_file != '') {
                var image_file_ext = image_file.split('.').pop();
                if(!(image_file_ext == 'jpg' || image_file_ext == 'png' || image_file_ext == 'gif')) {
                    alert('นามสกุลไฟล์ "รูปภาพ" ไม่ถูกต้อง');
                    return false;
                }
            }
            
            var flag_attach_file = 0;
            $( ".attach_file" ).each(function( index ) {
                var attach_file = $( this ).val();
                if(attach_file != '') {
                    var attach_file_ext = attach_file.split('.').pop();
                    if(!(attach_file_ext == 'doc' || attach_file_ext == 'docx' || attach_file_ext == 'dot'|| attach_file_ext == 'dotx' || attach_file_ext == 'xls' || attach_file_ext == 'xlsx' || attach_file_ext == 'pdf' || attach_file_ext == 'ppt' || attach_file_ext == 'rar' || attach_file_ext == 'zip')) {
                        flag_attach_file = 1;
                    }
                }
            });
            if(flag_attach_file == 1) {
                alert('นามสกุลไฟล์ "เอกสารแนบ" ไม่ถูกต้อง');
                return false;
            }
        });

/*----------------------- end manage paragraph -----------------------*/
$('#add_more_file').click(function() {
    $('.group-attach-file').append('<input class="form-control attach_file" type="file" name="attach_file[]">');
    return false;
});  
function check_availability(){  
            //get the username  
            var username = $('#d_fullnameth').val();  

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



</script>
