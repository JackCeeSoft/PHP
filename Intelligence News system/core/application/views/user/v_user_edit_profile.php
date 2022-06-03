<div id="page-wrapper">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="panel panel-default col-lg-12 center">
            <div class="col-lg-12">
                <form class="form-horizontal" enctype="multipart/form-data" action="user/Edit_profile/<?php echo $detail['ua_userid'];?>" method="POST">
                
                <p>
                </p>
                <div class="form-group">
                                            <div class="col-lg-12 blog-tag-data-inner">
                                                <?= (isset($detail['ua_mainimage']) and $detail['ua_mainimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->images_path . $detail['ua_userid'] . '/' . $detail['ua_mainimage']) . '" /></div>' :'<img src="assets/img/mockup/no-image.gif" alt="">'; ?>
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
                        <label class="control-label right"> รหัสผู้ใช้งาน * : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="hidden" class="form-control"id="dp" name="ua_userid" value="<?php echo $detail['ua_userid']; ?>" />
                        <input type="hidden" class="form-control"id="dp" name="ua_username" value="<?php echo $detail['ua_username']; ?>" />
                        <input type="text" disabled required class="form-control"id="dp" name="ua_username" value="<?php echo $detail['ua_username']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> รหัสผ่าน * : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="password" class="form-control"id="ua_password" name="ua_password" value="<?php echo $detail['ua_password']; ?>" required autofocus/>
                    </div>
                    <div class="col-lg-4">
                        <input type='button' id='gen_password' class="btn btn-primary" value='สร้างรหัสผ่านอัติโนมัติ'>
                         <div id='ua_password_result'></div> 
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ชื่อ * : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" required class="form-control"id="dp" name="ua_firstname" value="<?php echo $detail['ua_firstname']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> นามสกุล * : </label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" required class="form-control"id="dp" name="ua_lastname" value="<?php echo $detail['ua_lastname']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> อีเมล์ (E-mail) :
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_email" value="<?php echo $detail['ua_email']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> รหัสบัตรประจำตัวราชการ (10 หลัก)
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"id="dp" name="ua_description" value="<?php echo $detail['ua_description']; ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> กลุ่มผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" disabled name="ug_groupid">
                            <?php 
                            foreach ($user_group as $values){
                                if($values['ug_groupid'] == $detail['ug_groupid']){
                                    $select_group_t = "selected";
                                }else{
                                    $select_group_t = "";
                                }
                                ?>
                            <option value="<?php echo $values['ug_groupid'];?>" <?php echo $select_group_t; ?> ><?php echo $values['ug_groupname'];?></option>
                            <?php
                            }
                            ?>
                      
                        </select>
                    </div>
                </div>
                <div id="showunitformrtbS">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right"> ระบบผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" disabled name="u_unitid">
                            <?php 
                            foreach ($unit as $values){
                                if($values['u_unitid'] == $detail['u_unitid']){
                                    $select_unit_t = "selected";
                                }else{
                                    $select_unit_t = "";
                                }
                             ?>
                            <option value="<?php echo $values['u_unitid'];?>"<?php echo $select_unit_t; ?> ><?php echo $values['u_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                </div>
                <?php 
                $array_unt = array();
                if($detail['u_unitid'] > 15){
                    $array_unt = explode("9",$detail['u_unitid']);
                    //print_r($array_unt);
                } ?>
                <div id="showunitformrtbM">
                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label right">หน่วยงาน : </label>
                            </div>
                            <div class="col-lg-6">
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("1",$array_unt)) echo "checked";?> disabled value="1"><span>การรวบรวมและรายงานข่าว</span><br/>
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("2",$array_unt)) echo "checked";?> disabled value="2"><span>งานแหล่งข่าวเปิด (Open Source)</span><br/>
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("3",$array_unt)) echo "checked";?> disabled value="3"><span>รายงานข่าวจากแหล่งข่าวประชาชน</span><br/>
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("4",$array_unt)) echo "checked";?> disabled value="4"><span>รายงานข่าวข้อมูลบุคคลและความเคลื่อนไหวที่สำคัญ</span><br/>
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("5",$array_unt)) echo "checked";?> disabled value="5"><span>งานฐานข้อมูลข่าว จังหวัดชายแดนภาคใต้</span><br/>
                                <input type="checkbox" name="ckunit[]"<?php if(in_array("6",$array_unt)) echo "checked";?> disabled value="6"><span>สำนักงานผู้ช่วยทูตฝ่ายทหารบก/ต่างประเทศ</span><br/>
                            </div>
                        </div>
                </div>
<!--                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">ระบบย่อยผู้ใช้งาน : </label>
                    </div>
                    <div class="col-lg-4">
                        <select disabled class="form-control" id="s_unitsub_id"  name="s_unitsub_id"></select>
                    </div>
                </div>-->
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">  </label>
                    </div>
             <?php 
             $data_session  = $this->session->all_userdata();
             if (isset($data_session['u_unitid']) && isset($data_session['ua_firstname'])){
                 $ua_firstname = $data_session['ua_firstname']; 
                 $u_unitid = $data_session['u_unitid'];
                 $ua_lastname =  $data_session['ua_lastname'];
             }
        ?>
                    <div class="col-lg-5">

                        <input type="hidden" class="form-control"id="dp" name="ua_updateddate" value="<?php echo date('Y-m-d H:i:s'); ?>"/>

                        <input type="hidden" class="form-control"id="dp" name="ua_updatedby" value="<?php echo $u_unitid; ?>"/>
                        
                        <div id="btn_add" class="col-lg-4"></div>
                        <a href="<?= site_url('mainpage'); ?>" class="btn btn-default" >ยกเลิก</a>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>
    
<script>
    $(document).ready(function() {
        <?php if(isset($detail['s_unitsub_id']) && $detail['s_unitsub_id'] != 0) { ?>
            first_unit(<?= $detail['s_unitsub_id'].",".$detail['u_unitid']; ?>);
        <?php }else{ ?>
            first_unit_all(<?= $detail['u_unitid'];?>);
       <?php } ?>

        $('#u_unitid').change(function(){  
                //alert( "Handler for .change() called." );
                check_unit(); 
        }); 
         <?php if(isset($detail['u_unitid']) && $detail['u_unitid'] > 15){
        ?>
                $('#showunitformrtbS').hide();
                $('#showunitformrtbM').show();
        <?php
        }else{
        ?>   
                $('#showunitformrtbS').show();
                $('#showunitformrtbM').hide();
        <?php } ?>
  });  
        function first_unit(s_unitsub_id,u_unitid){
            //alert( "Handler for .change() called." );
           //var s_unitsub_id = $('#s_unitsub_id').val();
           $.post("user/first_unitid", { s_unitsub_id: s_unitsub_id , u_unitid: u_unitid },
           function(result){ 
               //alert(result);
               $('#s_unitsub_id').html(result);
            }); 
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
                    $('#s_unitsub_id').html('<option value="0"> ทุกหน่วยงาน </option>');
                } 
                 
            });  
       }
       
       
       
       String.prototype.pick = function(min, max) {
            var n, chars = '';

            if (typeof max === 'undefined') {
                n = min;
            } else {
                n = min + Math.floor(Math.random() * (max - min));
            }

            for (var i = 0; i < n; i++) {
                chars += this.charAt(Math.floor(Math.random() * this.length));
            }

            return chars;
        };
        String.prototype.shuffle = function() {
            var array = this.split('');
            var tmp, current, top = array.length;

            if (top) while (--top) {
                current = Math.floor(Math.random() * (top + 1));
                tmp = array[current];
                array[current] = array[top];
                array[top] = tmp;
            }

            return array.join('');
        };
        
        $('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
  
        $('#gen_password').click(function(){
            var lowercase = 'abcdefghijklmnopqrstuvwxyz';
            var uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var numbers = '0123456789';
            
            var randomstring = Math.random().toString(36).slice(-4);
            randomstring += uppercase.pick(2);
            randomstring += lowercase.pick(2);
            randomstring += numbers.pick(4);
            randomstring = randomstring.shuffle();
            
            document.getElementById("ua_password").value = randomstring;
            //alert(randomstring);
            var password = randomstring; 
            var passed = validatePassword(password, {
                    length:   [8, 16],
                    lower:    1,
                    upper:    0,
                    numeric:  1,
                    special:  0,
                    badWords: ["password", "steven", "levithan","admin"],
                    badSequenceLength: 24
            });
            //alert(passed);
            if(passed === true){
                $('#ua_password_result').html('<div class="alert alert-success"><strong>'+password+' </strong></div>');
                ckPassword = true;
                
            }else{
                $('#ua_password_result').html('<div class="alert alert-danger">ไม่อนุญาติให้ใช้ <strong>'+password+' </strong></div>');
                ckPassword = false;
            }
            //alert('hi'+ckPassword);
            btn_add(ckPassword);
           
        });
        
        $('#ua_password').change(function(){  
            var password = $('#ua_password').val(); 
            var passed = validatePassword(password, {
                    length:   [8, 16],
                    lower:    1,
                    upper:    0,
                    numeric:  1,
                    special:  0,
                    badWords: ["password", "steven", "levithan","admin"],
                    badSequenceLength: 24
            });
            //alert(passed);
            if(passed === true){
                $('#ua_password_result').html('<div class="alert alert-success"><strong>'+password+' </strong></div>');
                ckPassword = true;
            }else{
                $('#ua_password_result').html('<div class="alert alert-danger">ไม่อนุญาติให้ใช้ <strong>'+password+' </strong></div>');
                ckPassword = false;
            }
            btn_add(ckPassword);
        });
       function btn_add(ckPass){
       //alert(ckUser);
       //alert(ckPass);
            if(ckPass === true ){
                $('#btn_add').html('<button type="submit" class="btn btn-primary">บันทึก</button>');
            }else{
                $('#btn_add').html('<a style="background-color:red; color:black;" href="#" class="btn disabled">กรุณาป้อนข้อมูล </a>');
            }
       }
         function validatePassword (pw, options) {
                // default options (allows any password)
                var o = {
                        lower:    0,
                        upper:    0,
                        alpha:    0, /* lower + upper */
                        numeric:  0,
                        special:  0,
                        length:   [0, Infinity],
                        custom:   [ /* regexes and/or functions */ ],
                        badWords: [],
                        badSequenceLength: 0,
                        noQwertySequences: false,
                        noSequential:      false
                };

                for (var property in options)
                        o[property] = options[property];

                var	re = {
                                lower:   /[a-z]/g,
                                upper:   /[A-Z]/g,
                                alpha:   /[A-Z]/gi,
                                numeric: /[0-9]/g,
                                special: /[\W_]/g
                        },
                        rule, i;

                // enforce min/max length
                if (pw.length < o.length[0] || pw.length > o.length[1])
                        return false;

                // enforce lower/upper/alpha/numeric/special rules
                for (rule in re) {
                        if ((pw.match(re[rule]) || []).length < o[rule])
                                return false;
                }

                // enforce word ban (case insensitive)
                for (i = 0; i < o.badWords.length; i++) {
                        if (pw.toLowerCase().indexOf(o.badWords[i].toLowerCase()) > -1)
                                return false;
                }

                // enforce the no sequential, identical characters rule
                if (o.noSequential && /([\S\s])\1/.test(pw))
                        return false;

                // enforce alphanumeric/qwerty sequence ban rules
                if (o.badSequenceLength) {
                        var	lower   = "abcdefghijklmnopqrstuvwxyz",
                                upper   = lower.toUpperCase(),
                                numbers = "0123456789",
                                qwerty  = "qwertyuiopasdfghjklzxcvbnm",
                                start   = o.badSequenceLength - 1,
                                seq     = "_" + pw.slice(0, start);
                        for (i = start; i < pw.length; i++) {
                                seq = seq.slice(1) + pw.charAt(i);
                                if (
                                        lower.indexOf(seq)   > -1 ||
                                        upper.indexOf(seq)   > -1 ||
                                        numbers.indexOf(seq) > -1 ||
                                        (o.noQwertySequences && qwerty.indexOf(seq) > -1)
                                ) {
                                        return false;
                                }
                        }
                }

                // enforce custom regex/function rules
                for (i = 0; i < o.custom.length; i++) {
                        rule = o.custom[i];
                        if (rule instanceof RegExp) {
                                if (!rule.test(pw))
                                        return false;
                        } else if (rule instanceof Function) {
                                if (!rule(pw))
                                        return false;
                        }
                }

                // great success!
                return true;
        }
       
       
</script>