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
            <div class="col-lg-12 center">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home"> <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <i class="fa fa-bars"></i>  รายละเอียด</h3>
                        </div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <fieldset>
                                <br>

                                <ul class="nav nav-tabs margin0px">
                                    <li class="active"><a href="#menu1" data-toggle="tab" aria-expanded="true">ข้อมูลบุคคล</a></li>

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
<!--                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_title">
                                                    <option>นาย</option>
                                                    <option>นาง</option>
                                                    <option>นางสาว</option>
                                                </select>
                                            </div>-->
                                            <div class="col-sm-2">
                                                <label>คำนำหน้า </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" id="p_firstname" class="form-control" name="p_title">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชื่อ : *</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="p_firstname" class="form-control" name="p_firstname" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : *</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" id="p_lastname" class="form-control" name="p_lastname" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>วัน/เดือน/ปีเกิด : </label>
                                            </div>
                                            <div class="col-sm-3">
                                        <div class="col-lg-6">
                                            <div class="input-append date" id="datetimepicker1">
                                                <input data-format="yyyy-MM-dd" type="text" name="p_birthdate">
                                                <span class="add-on">
                                                    <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
  
  
                                            </div>
                                            <div class="col-sm-1">
                                                <label>อายุ : </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_age" >
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ปี </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>เพศ : </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_gender" >
                                                    <option>ชาย</option>
                                                    <option>หญิง</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อเล่น :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_nickname" >
                                            </div>
                                            <div class="col-sm-2">
                                                <label>อาชีพ :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_occupation" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>เลขที่บัตรประชาชน :  </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" onkeypress='validate(event)' maxlength="13" name="p_idcard" >
<!--                                                <input type="text" maxlength="1" class="span0" name="p_idcard_1" required>
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_2" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_3" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_4" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_5" required>
                                               
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_6" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_7" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_8" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_9" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_10" required>
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_11" required>
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_12" required>
                                                
                                                <input type="text" maxlength="1" class="span0" name="p_idcard_13" required>-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ตำแหน่งปัจจุบัน :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_position" >
                                            </div>
                                            <div class="col-sm-2">
                                                <label>การศึกษา :  </label>
                                            </div>
                                            <div class="col-sm-2">
                                             <select class="form-control" name="p_education" >
                                                    <option>ม.ต้น</option>
                                                    <option>ม.ปลาย</option>
                                                    <option>ม.ต้น</option>
                                                    <option>ม.ปลาย</option>
                                                    <option>ม.ต้น</option>
                                                    <option>ม.ปลาย</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ที่ทำงาน :  </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_workaddress" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>สัญชาติ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_nationality" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label>เชื้อชาติ :  </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_race" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>สถานะภาพ :  </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="p_status" >
                                                    <option>โสด</option>
                                                    <option>แต่งงาน</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ภูมิลำเนาเดิม :  </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_domicile" ></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน :  </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_address" ></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อสามี/ภารรยา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_spousefirstname" >
                                            </div>
                                            <div class="col-sm-2">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_spouselastname" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_spouseaddress" ></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>จำนวนบุตร</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_child">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชาย </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_boy">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>หญิง </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_daughter">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" placeholder="" name="p_childdetail"> </textarea>
                                            </div>
                                        </div>
                                        
                                        <hr>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อบิดา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatherfirstname">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatherlastname">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>อาชีพ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_fatheroccupation">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_fatheraddress"></textarea>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ชื่อมารดา : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motherfirstname">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>นามสกุล : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motherlastname">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>อาชีพ : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="p_motheroccupation">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ที่อยู่ปัจจุบัน : </label>
                                                <br>
                                                <small>(ที่สามารถติดต่อได้)</small>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="p_motheraddress"></textarea>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>พี่น้อง ร่วมบิดา/มารดา</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_sibling">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>ชาย </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_male">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <label>หญิง </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input onkeypress='validate(event)' maxlength="3" type="text" class="form-control" name="p_female">
                                            </div>
                                            <div class="col-sm-1">
                                                <label>คน </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <label>ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" placeholder="" name="p_siblingdesc"> </textarea>
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
        </div>
    </div>
</div>


<script>
    $(function() {
        chkReporttype();
        $('#rt_reporttypeid').change(function() {
            chkReporttype();
        });
        $('a#del_img').click(function() {
            var c = confirm('ลบรูปภาพ!?');
            if (c) {
                $('div#thumb').hide();
                $('input#del').val(1);
            } else
                return false;
        });
        $('#add_more_file').click(function() {
            $('.group-attach-file').append('<input class="form-control" type="file" name="attach_file[]">');
            return false;
        });
        $("#checkAll01").click(function() {
            $(".check01").prop('checked', $(this).prop('checked'));
        });
        $("#checkAll02").click(function() {
            $(".check02").prop('checked', $(this).prop('checked'));
        });
        $("#checkAll03").click(function() {
            $(".check03").prop('checked', $(this).prop('checked'));
        });
        $('#datetimepicker1').datetimepicker({
            language: 'th'
        });
        $('#datetimepicker2').datetimepicker({
            pickDate: false,
            pickSeconds: false,
        });
        $('.nav-tabs li a').click(function(){
            $('.tab-pane.active form.section').append('<input type="hidden" name="tab" value="' + $(this).data('tabid') + '" />');
            $('.tab-pane.active form.section').submit();
        });
                    $("ul.nav-tabs li:nth-child(1) a").tab('show');
                $('a.m-paragraph').click(function(){
            $('#myModalParagraph iframe').attr('src', $(this).attr('href'));
            $('#myModalParagraph').modal('show');
            return false;
        });
        $('a.del-paragraph').click(function(){
            if(confirm('ยืนยันการลบข้อมูล')) {
                $.post($(this).attr('href'), function(data){
                    if(data == 'true') {
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด');
                    }
                });
            }
            return false;
        });
        $('select[name="person[]"], select[name="organization[]"], select[name="movement[]"]').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา'});
    });
    function chkReporttype() {
        if ($('select#rt_reporttypeid option:selected').val() >= 4) {
            $('.type').show();
            $('.type-1').hide();
            $('.type-2').show();
        } else if ($('select#rt_reporttypeid option:selected').val() >= 1 && $('select#rt_reporttypeid option:selected').val() <= 3) {
            $('.type').show();
            $('.type-2').hide();
            $('.type-1').show();
        } else {
            $('.type').hide();
        }
    }
    function deleteImg(name) {
        var c = confirm('ลบรูปภาพ!?');
        if (c) {
            $('div#thumb_' + name).hide();
            $('input#del_' + name).val(1);
        } else
            return false;
    }
    function validate(evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode( key );
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
</script>
<script>
$('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล * </a>');
$('#p_firstname').change(function(){  
    //alert('hi');
    check_availability();
});
$('#p_lastname').change(function(){ 
    //alert('hi');
    check_availability();
});
function check_availability(){  
            //get the username  
            var p_firstname = $('#p_firstname').val();
            var p_lastname = $('#p_lastname').val(); 
            //use ajax to run the check  
            $.post("person/check_name", { p_firstname: p_firstname , p_lastname:p_lastname },  
                function(result){ 
                    //if the result is 1 
                    //alert(result);
                    if(result == 1){   
                        ckUsername = true;
                    }else{
                        ckUsername = false;
                    }
                    btn_add(ckUsername);
                    if(result == 3){
                            $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">ชื่อ-นามสกุล (ซ้ำ)</a>');
                    }
            });
}
function btn_add(ckUser){
       //alert(ckUser);
       //alert(ckPass);
            if(ckUser === true){
                $('#btn_add').html('<button type="submit" class="btn btn-success">ถัดไป <i class="fa fa-arrow-right"></i></button>');
            }else{
                $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
            }
}
</script>
