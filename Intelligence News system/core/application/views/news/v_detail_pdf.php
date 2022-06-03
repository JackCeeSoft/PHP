<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="span12 article-block">
            <br>
            <br>
            <div>
                <?php if(isset($paragraph) and is_array($paragraph) and $paragraph) { ?>
                    <?php foreach ($paragraph as $v_p) { ?>
                        <?php if((isset($v_p['np_mainimage']) and $v_p['np_mainimage']) or (isset($v_p['np_paragraph']) and $v_p['np_paragraph']) or (isset($v_p['fileattach']) and $v_p['fileattach'])) { ?>
                            <div class="col-xs-12 group-paragrahp">
                                <?= (isset($v_p['np_mainimage']) and $v_p['np_mainimage']) ? '<img width="870" border="3" src="' . getImagePath($this->paragraph_images_path . $v_p['np_paragraph_id'] . '/' . $v_p['np_mainimage']) . '" />' : ''; ?>
                                <?= (isset($v_p['np_paragraph']) and $v_p['np_paragraph']) ? '<p>' . $v_p['np_paragraph'] . '</p>' : ''; ?>
                                <?php /*if(isset($v_p['fileattach']) and $v_p['fileattach']) { ?>
                                    <table class="table table-attach mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ชื่อไฟล์</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($v_p['fileattach'] as $k_attach => $v_attach) { ?>
                                                <tr>
                                                    <th scope="row"><?= ($k_attach + 1); ?>.</th>
                                                    <td><?= $v_attach['nf_path']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php }*/ ?>
                                <?php /*if(isset($v_p['tag']) and $v_p['tag']) { ?>
                                    <div>
                                        <ul class="unstyled inline blog-tags">
                                            <li>
                                                <i class="fa fa-tags blue"></i>
                                                <?php foreach ($v_p['tag'] as $k_tag => $v_tag) { ?>
                                                    <a href="#"><?= $v_tag['nt_word']; ?></a> 
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php }*/ ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            
        </div>
        <!--end span12-->
    </div>
</div>
