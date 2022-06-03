<link rel="stylesheet" type="text/css" media="screen" href="assets/fileupload/bootstrap-image-gallery.min.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="assets/fileupload/jquery.fileupload-ui.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/custom.css"/>
<div id="page-wrapper" class="bg-fff">
    <?php //print_r($result); ?>
    <div class="container word">
            <div class="tab-content">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 46%">
                                                        <div class="col-lg-3 blog-tag-data-inner center">
                                                             <?= (isset($result['p_faceimage']) and $result['p_faceimage']) ? '<div class="field" id="thumb"><label></label><img width="250" height="170" class="form-thumb" src="' . getImagePath($this->images_path . $result['p_personid'] . '/' . $result['p_faceimage']) . '" /></div>' :'<img src="assets/img/mockup/no-image.gif" alt="">'; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b><?php if(isset($result['p_title']) and $result['p_title']) echo $result['p_title']; ?> <?php if(isset($result['p_firstname']) and $result['p_firstname']) echo $result['p_firstname']; ?> <?php if(isset($result['p_lastname']) and $result['p_lastname']) echo $result['p_lastname']; ?> (<?php if(isset($result['p_gender']) and $result['p_gender']) echo $result['p_gender']; ?>)</b></h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>อายุ : </b> <?php if(isset($result['p_age']) and $result['p_age']) echo $result['p_age']; ?> <b>ปี</b></h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>เชื้อชาติ :</b> <?php if(isset($result['p_nationality']) and $result['p_nationality']) echo $result['p_nationality']; ?>   <b>สัญชาติ :</b> <?php if(isset($result['p_race']) and $result['p_race']) echo $result['p_race']; ?></h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>เลขบัตรประจำตัวประชาชน : </b> <?php if(isset($result['p_idcard']) and $result['p_idcard']) echo $result['p_idcard']; ?></h4> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>ตำแหน่งปัจจุบัน : </b> <?php if(isset($result['p_position']) and $result['p_position']) echo $result['p_position']; ?></h4> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>การศึกษา : </b> <?php if(isset($result['p_education']) and $result['p_education']) echo $result['p_education']; ?></h4> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 32px;"><h4><b>ที่อยู่ที่ทำงาน : </b> <?php if(isset($result['p_workaddress']) and $result['p_workaddress']) echo $result['p_workaddress']; ?></h4> </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 50%">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ปี - เดือน - วัน : </b></td>
                                                                <td> <?php if(isset($result['p_birthdate']) and $result['p_birthdate']) echo $result['p_birthdate']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ชื่อเล่น : </b></td>
                                                                <td> <?php if(isset($result['p_nickname']) and $result['p_nickname']) echo $result['p_nickname']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 50%">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> อาชีพ : </b></td>
                                                                <td> <?php if(isset($result['p_occupation']) and $result['p_occupation']) echo $result['p_occupation']; ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> สถานะภาพ : </b></td>
                                                                <td> <?php if(isset($result['p_status']) and $result['p_status']) echo $result['p_status']; ?> </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                          
                                           <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> ภูมิลำเนาเดิม : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_domicile']) and $result['p_domicile']) echo $result['p_domicile']; ?> </td>
                                                </tr>
                                           </table>
                                           <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้) : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_address']) and $result['p_address']) echo $result['p_address']; ?> </td>
                                                </tr>
                                           </table>
                                            <hr>
                                           <table style="width: 100%;">
                                                <tr>
                                                    <td style="height:25px; width: 50%;">
                                                        <table>
                                                            <tr>
                                                                <td><b> ชื่อสามี/ภารรยา : </b></td>
                                                                <td> <?php if(isset($result['p_spousefirstname']) and $result['p_spousefirstname']) echo $result['p_spousefirstname']; ?> <?php if(isset($result['p_spouselastname']) and $result['p_spouselastname']) echo $result['p_spouselastname']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td><b> ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้) : </b></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if(isset($result['p_spouseaddress']) and $result['p_spouseaddress']) echo $result['p_spouseaddress']; ?> </td>
                                                </tr>
                                           </table>
                                            <table style="width: 100%;">
                                                <tr style="height:25px; width: 40%;">
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> จำนวนบุตร : </b></td>
                                                                <td> <?php if(isset($result['p_child']) and $result['p_child']) echo $result['p_child']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="width: 40%">
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ชาย : </b></td>
                                                                <td> <?php if(isset($result['p_boy']) and $result['p_boy']) echo $result['p_boy']; ?> <b> คน </b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> หญิง : </b></td>
                                                                <td> <?php if(isset($result['p_daughter']) and $result['p_daughter']) echo $result['p_daughter']; ?> <b> คน </b></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_childdetail']) and $result['p_childdetail']) echo $result['p_childdetail']; ?> </td>
                                                </tr>
                                           </table>
                                            <hr>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ชื่อบิดา : </b></td>
                                                                <td> <?php if(isset($result['p_fatherfirstname']) and $result['p_fatherfirstname']) echo $result['p_fatherfirstname']; ?>  <?php if(isset($result['p_fatherlastname']) and $result['p_fatherlastname']) echo $result['p_fatherlastname']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> อาชีพ : </b></td>
                                                                <td> <?php if(isset($result['p_fatheroccupation']) and $result['p_fatheroccupation']) echo $result['p_fatheroccupation']; ?></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="height: 25px;"><b> ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้) : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_fatheraddress']) and $result['p_fatheraddress']) echo $result['p_fatheraddress']; ?> </td>
                                                </tr>
                                           </table>
                                            <hr>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ชื่อมารดา : </b></td>
                                                                <td> <?php if(isset($result['p_motherfirstname']) and $result['p_motherfirstname']) echo $result['p_motherfirstname']; ?>  <?php if(isset($result['p_motherlastname']) and $result['p_motherlastname']) echo $result['p_motherlastname']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> อาชีพ : </b></td>
                                                                <td> <?php if(isset($result['p_motheroccupation']) and $result['p_motheroccupation']) echo $result['p_motheroccupation']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> ที่อยู่ปัจจุบัน (ที่สามารถติดต่อได้) : </b></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if(isset($result['p_motheroccupation']) and $result['p_motheroccupation']) echo $result['p_motheroccupation']; ?> </td>
                                                </tr>
                                           </table>
                                            
                                           <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 50%">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> พี่น้อง ร่วมบิดา/มารดา : </b></td>
                                                                <td> <?php if(isset($result['p_sibling']) and $result['p_sibling']) echo $result['p_sibling']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50%">
                                                        <table>
                                                            <tr>
                                                                <td style="height: 25px;"><b> ชาย : </b></td>
                                                                <td> <?php if(isset($result['p_male']) and $result['p_male']) echo $result['p_male']; ?> <b> คน </b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 25px;"><b> หญิง : </b></td>
                                                                <td> <?php if(isset($result['p_female']) and $result['p_female']) echo $result['p_female']; ?> <b> คน </b></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> ระบุชื่อ, นามสกุล, วันเกิด, ปีเกิด : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_siblingdesc']) and $result['p_siblingdesc']) echo $result['p_siblingdesc']; ?> </td>
                                                </tr>
                                           </table>
                                            <hr>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 25px;"><b> รายละเอียดพฤติกรรม : </b></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 25px;"> <?php if(isset($result['p_behavior']) and $result['p_behavior']) echo $result['p_behavior']; ?> </td>
                                                </tr>
                                           </table>
                           </div>
            </div>
</div>