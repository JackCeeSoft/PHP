<div class="container word">
            <div class="tab-content">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 100%;" align="center">
                                                        <h3>กลุ่มองค์กร</h3>
                                                        <br>
                                                        <div class="col-lg-3 blog-tag-data-inner center">
                                                            <?= (isset($result['o_mainimage']) and $result['o_mainimage']) ? '<div class="field" id="thumb"><label></label><img class="form-thumb" src="' . getImagePath($this->images_path . $result['o_organizationid'] . '/' . $result['o_mainimage']) . '" /></div>' :'<img src="assets/img/mockup/no-image.gif" alt="">'; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            </table>
                <hr>
<!--                                            <table align="center" style="margin: 0px auto;">-->
                                            <table>
                                                <tr>
                                                    <td style="height: 32px; width: 150px;"> <b>ชื่อองค์กร : </b></td>
                                                    <td><?= $result['o_fullnameth']?></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 32px; width: 150px;"><b> ชื่อย่อภาษาไทย : </b></td>
                                                    <td><?= $result['o_shortnameth']?></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 32px; width: 150px;"><b> ชื่อภาษาอังกฤษ : </b></td>
                                                    <td><?= $result['o_fullnameen']?></td>
                                                </tr>
                                                <tr>
                                                    <td style="height: 32px; width: 150px;"><b> ชื่อย่อภาษาอังกฤษ : </b></td>
                                                    <td><?= $result['o_shortnameen']?></td>
                                                </tr>
                                            </table>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="height: 32px; width: 40%;"><b> รายละเอียดความเคลื่อนไหว : </b></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $result['o_movement']?></td>
                                                </tr>
                                            </table>
                                    
                    </div>
            </div>

