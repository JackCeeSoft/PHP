<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="col-lg-12 center">
            <p>
            <div class="col-lg-12">
                <div align="center">
                    <img src="assets/img/logo/Logo.png" border="3">
                    <br>
                    <h3>ค้นหารายงานระบบฐานข้อมูลข่าว จังหวัดชายแดนภาคใต้</h3>
                </div>
            </div>
            </p>

            <p>
            <div class="col-lg-12">
                <br>
                <form>
<!--                    <div class="form-group">
                            <p></p>
                            <div class="col-lg-3">
                                <label class="control-label right">ประเภทรายงาน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="rt_reporttypeid" name="rt_reporttypeid">
                                    <option value="">เลือกประเภทรายงานทั้งหมด</option>
                                    <?php foreach ($report_type as $v_rt) { ?>
                                        <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($result['rt_reporttypeid']) and $result['rt_reporttypeid'] == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>-->
<!--                    <div class="form-group">
                            <p></p>
                            <div class="col-lg-3">
                                <label class="control-label right">แผนกด้าน : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="rt_reporttypeid" name="nd_newsdepartmentid">
                                    <option value="">เลือกประเภทรายงานทั้งหมด</option>
                                    <?php foreach ($news_department as $v_nd) { ?>
                                        <option value="<?= $v_nd['nd_newsdepartmentid']; ?>" <?= (isset($result['nd_newsdepartmentid']) and $result['nd_newsdepartmentid'] == $v_nd['nd_newsdepartmentid']) ? 'selected' : ''; ?>><?= $v_nd['nd_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <p></p>
                            <div class="col-lg-3">
                                <label class="control-label right">ประเภทข่าวกรอง  : </label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" id="rt_reporttypeid" name="nt_newstypeid">
                                    <option value="">เลือกประเภทรายงานทั้งหมด</option>
                                    <?php foreach ($news_type as $v_nt) { ?>
                                        <option value="<?= $v_nt['nt_newstypeid']; ?>" <?= (isset($result['nt_newstypeid']) and $result['nt_newstypeid'] == $v_nt['nt_newstypeid']) ? 'selected' : ''; ?>><?= $v_nt['nt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>-->
<!--                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label right">คำที่ค้นหาบ่อย  : </label>
                        </div>
                        <?php
                            $type_search = "OR";
                            if(isset($keyword_search) && $keyword_search){
                                //print_r($keyword_search);
                                foreach ($keyword_search as $k_ks => $v_ks){ ?>
                                <a href="search/news?rt_reporttypeid=&nd_newsdepartmentid=&nt_newstypeid=&type_search=<?=$type_search;?>&keyword=<?=$v_ks['ks_word'];?>" style="padding:2px 3px; background-color: #35aa47; color: white;" class="btn"><?= $v_ks['ks_word'];?></a>
                        <?php   }
                            }
                        ?>
                    </div>-->
                    <div class="form-group">
                        <div class="col-lg-12"></div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label right">ประเภทการค้นหา  : </label>
                        </div>
                        <div class="col-lg-3">
                            <input type="radio" name="type_search" value="OR" >
                            <label class="control-label"> OR </label>
                        </div>
                        <div class="col-lg-1">
                            
                            
                        </div>
                        <div class="col-lg-3">
                                <input type="radio" name="type_search" value="AND" checked> 
                                <label class="control-label"> AND  </label>
                        </div>
                        <div class="col-lg-1">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="คำที่ต้องการค้นหา">
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label right">ประเภทการค้นหา <b style="color: red;">คำที่ไม่ต้องการ</b>  : </label>
                        </div>
                        <div class="col-lg-9">
                                <!--<input type="radio" name="dont_type_search" value="AND" checked> <label class="control-label right"> AND  </label>-->
                                <!--<input type="radio" name="dont_type_search" value="OR" > <label class="control-label right"> OR </label>-->
                                
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <input type="text" name="dont_keyword" class="form-control" placeholder="คำที่ ไม่ ต้องการค้นหา">
                    </div>
                    
                    <div class="form-group">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search 
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                        </span>
                    </div>
                </form>
                <br>
                <div class="pull-right">
                    <a href="<?= site_url('search/newsAdvance'); ?>" align="right">ค้นหาแบบละเอียด</a> 
                    <i class="fa fa-search"></i>
                </div>
                <br><br><br><br><br><br><br><br>
            </div>
            </p>
        </div>
    </div>
</div>