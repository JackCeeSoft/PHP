<div id="page-wrapper" class="bg-fff">
    <div class="container">
        <div class="col-lg-12 center">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bars"></i> รายละเอียด</h3>
                </div>
                <form action="" class="form-horizontal" method="post">
                    <fieldset>
                        <br>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-2">
                                    <label class="control-label right">รายละเอียดข่าว :  *</label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea class="ckeditor" name="np_paragraph"><?= (isset($result['np_paragraph']) and $result['np_paragraph']) ? $result['np_paragraph'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-success">บันทึก</i></button>
                                <?php if(isset($_GET['popup']) and $_GET['popup'] == 1) { ?>
                                    <a href="#" class="btn btn-default modal-close">ยกเลิก</a>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-default ">ยกเลิก</a>
                                <?php } ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        <?php if(isset($popup) and $popup == 1) { ?>
            window.parent.$('#myModalParagraph').modal('hide'); 
            window.parent.location.reload();
        <?php } ?>
        $('a.modal-close').click(function(){
            window.parent.$('#myModalParagraph').modal('hide'); 
            return false;
        });
    });
</script>