<link rel="stylesheet" href="assets/colorbox/theme2/colorbox.css" />
<script src="assets/colorbox/jquery.colorbox.js"></script>
<script>
    $(function() {
        $(".gallery").colorbox({rel: 'gallery'});
    });
</script>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <div class="col-lg-12 center">
            
            <div class="col-lg-12">
                    <div class="input-group">
                        <span>
                            <h4 class page-header> รายการทั้งหมด <?= $total_rows; ?> </h4>
                        </span>
                    </div>
            </div>
            <div class="col-lg-12">
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
                                        <option value="<?= $v_rt['rt_reporttypeid']; ?>" <?= (isset($rt_reporttypeid) and $rt_reporttypeid == $v_rt['rt_reporttypeid']) ? 'selected' : ''; ?>><?= $v_rt['rt_name']; ?></option>
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
                                        <option value="<?= $v_nd['nd_newsdepartmentid']; ?>" <?= (isset($nd_newsdepartmentid) and $nd_newsdepartmentid == $v_nd['nd_newsdepartmentid']) ? 'selected' : ''; ?>><?= $v_nd['nd_name']; ?></option>
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
                                        <option value="<?= $v_nt['nt_newstypeid']; ?>" <?= (isset($nt_newstypeid) and $nt_newstypeid == $v_nt['nt_newstypeid']) ? 'selected' : ''; ?>><?= $v_nt['nt_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>-->
<!--                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label right">คำที่ค้นหาบ่อย  : </label>
                        </div>
                        <?php
                            if(isset($keyword_search) && $keyword_search){
                                //print_r($keyword_search);
                                foreach ($keyword_search as $k_ks => $v_ks){ ?>
                                <a href="search/news?rt_reporttypeid=&nd_newsdepartmentid=&nt_newstypeid=&type_search=<?=$type_search;?>&keyword=<?=$v_ks['ks_word'];?>" style="padding:2px 3px; background-color: #35aa47; color: white;" class="btn"><?= $v_ks['ks_word'];?></a>
                        <?php   }
                            }
                        ?>
                    </div>-->
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label right">ประเภทการค้นหา  : </label>
                        </div>
                        <div class="col-lg-3">
                              <input type="radio" name="type_search" value="OR" <?= (isset($type_search) and $type_search == 'OR') ? 'checked' : '';?>> <label class="control-label"> OR </label>
                              
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                            <input type="radio" name="type_search" value="AND"<?= (isset($type_search) and $type_search == 'AND') ? 'checked' : '';?>> <label class="control-label"> AND  </label>
                        </div>
                        <div class="col-lg-1">
                    </div>
                    </div>
                    <div class="form-group">
                        <?php if(!isset($keyword)) {
                            
                        }else{?>
                            <?php if(isset($check_speword)) {$print_speaword = '"';}else{$print_speaword = '';} ?>
                            <input type="text" name="keyword" class="form-control" placeholder="Search" <?= (isset($keyword) and $keyword) ? 'value="'.htmlspecialchars($print_speaword).$keyword.htmlspecialchars($print_speaword).'"' : ''; ?>>
                        <?php } ?>
                        <span class="input-group-btn">
                            <br>
                         <?php if(!isset($keyword) || isset($advance_search)) { ?>
                            <a href="search/search_advance_news"> <button class="btn btn-success" type="button">Back to Advance Search</button> </a>
                         <?php }else{?>
                            <!--<button class="btn btn-default" type="submit">Search</button>-->
                        <?php } ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label right">ประเภทการค้นหา <b style="color: red;">คำที่ไม่ต้องการ</b>  : </label>
                        </div>
                        <div class="col-lg-9">
                                <!--<input type="radio" name="dont_type_search" value="AND" <?= (isset($dont_type_search) and $dont_type_search == 'AND') ? 'checked' : '';?>> <label class="control-label right"> AND  </label>-->
                                <!--<input type="radio" name="dont_type_search" value="OR"  <?= (isset($dont_type_search) and $dont_type_search == 'OR') ? 'checked' : '';?>> <label class="control-label right"> OR </label>-->
                                
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <input type="text" name="dont_keyword" class="form-control" placeholder="คำที่ ไม่ ต้องการค้นหา" <input type="text" name="keyword" class="form-control" placeholder="คำที่ต้องการค้นหา" <?= (isset($dont_keyword) and $dont_keyword) ? 'value="'.$dont_keyword.'"' : ''; ?>>
                    </div>

                    <div class="form-group">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search 
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                        </span>
                    </div>
                </form>
                <?php if(!isset($keyword) || isset($advance_search)) { ?>

                <?php }else{?>
                                    <br>
                                    <div class="pull-right">
                                        <a href="<?= site_url('search/newsAdvance'); ?>" align="right">ค้นหาแบบละเอียด</a> 
                                        <i class="fa fa-search"></i>
                                    </div>
                <?php } ?>
            </div>
            </p>
            <ul class="nav nav-tabs">
                <br>
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">ข่าวสาร</a></li>
                <li><a href="#profile" data-toggle="tab" aria-expanded="true">รูปภาพ</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <?php 
                    $check_news = 0;
                    if(!isset($keyword)){
                        $keyword = "";
                    }
                    if(isset($result) and $result) { ?>
                    <blockquote>
                        <?php foreach ($result as $v_result) { ?>
                                <?php 
                                if($v_result['n_newsid'] != $check_news) {?>
                                    <div class="clear">___________________________________________________________________________________________________________</div>
                                    <a href="
                                        <?php
                                        if(isset($keyword) && $keyword != ""){
                                            echo site_url('news/detail/'.$v_result['n_newsid'].'/'.$keyword.'?p='.$v_result['np_hl']);
                                        }else{
                                            echo site_url('news/detail/'.$v_result['n_newsid'].'?p='); 
                                        }  
                                    ?>">
                                        <h3 class page-header>
                                            <?php 
                                                if(isset($v_result['n_subject']) and $v_result['n_subject']){
                                                    if(isset($check_speword)) 
                                                {
                                                    $n_subject = cutCaption($v_result['n_subject']);
                                                    $n_subject = highlightWords_spec($n_subject, $keyword);
                                                }else
                                                 {
                                                    $n_subject = cutCaption($v_result['n_subject']);
                                                    $n_subject = highlightWords($n_subject, $keyword);
                                                 }
                                                    echo $n_subject; 
                                                }
                                            ?>
                                </h3></a>
                                <?php 
                                    $check_news = $v_result['n_newsid'];    
                                }?>
                                <h5>
                                    <?php 
                                    
                                        if(isset($v_result['np_paragraph']) and $v_result['np_paragraph']){
                                            if(isset($check_speword)) 
                                                {
                                                    $np_paragraph = cutCaption_spea_Keyword(stripHTMLTags($v_result['np_paragraph']),800,$keyword);
                                                    $np_paragraph = highlightWords_spec($np_paragraph, $keyword);
                                                }else
                                                 {
                                                    $np_paragraph = cutCaption_Keyword(stripHTMLTags($v_result['np_paragraph']),800,$keyword);
                                                    $np_paragraph = highlightWords($np_paragraph, $keyword);
                                                 }
                                                echo $np_paragraph;
                                        }else{
                                            print_r($v_result['np_paragraph']);
                                        }
                                    ?>
                                </h5>
                      <?php } ?>
                    </blockquote>
                    <?php } ?>
                </div>
                
                <div class="tab-pane fade" id="profile" style="padding-top: 15px;">
                    <?php 
                    //echo "<pre>";
                    //print_r($result); 
                    //echo "</pre>";
                    ?>
                    <?php if(isset($result) and $result) { ?>
                        <?php foreach ($result as $key => $v_result) { ?>
                                <?php if (is_file($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage'])) { ?>
                                    <div class="col col-lg-3" style="margin-bottom: 15px;">
                                        <!--<a class="gallery" href="<?= getImagePath($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage']); ?>">-->
                                        <a href="<?= site_url('news/detail/'.$v_result['n_newsid']); ?>">    
                                            <img src="<?= getImagePath($this->paragraph_images_path . $v_result['np_paragraph_id'] . '/' . $v_result['np_mainimage']); ?>" width="250" height="170">
                                        </a>
                                        
                                      

                                        <!--</a>-->
                                    </div>
                                <?php } ?>
                                     <?php 
									  
					if(isset($v_result['image_ga'][0])){
                                        foreach($v_result['image_ga'][0] as $key_img => $values_img ){?>
                                        <a href="<?= site_url('news/detail/'.$v_result['n_newsid']); ?>">    
                                            <img src="<?= getImagePath($this->news_image . $values_img['n_newsid'] . '/' . $values_img['ni_path']); ?>" width="250" height="170">
                                        </a>
					<?php }}?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <?= $this->pagination->create_custom_links_front(); ?>
        </div>
    </div>
</div>