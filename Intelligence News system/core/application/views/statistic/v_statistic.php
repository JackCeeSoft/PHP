<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-iwwn{background-color:#bed7ff;text-align:center}
    .tg .tg-a1rn{background-color:#ffffc7}
@media (min-width: 1200px) {
  .container {
    /*margin-left: 4%;*/
    width: 75%;
/*    padding-left:0px;
    padding-right:0px;*/
  }
}
</style>
<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">
        <h3 class="" page-header="">สถิติ</h3>   
        <br>
        <?php $this->load->view('statistic/_form_search'); ?>

        <div class="form-group">
            <div class="col-lg-6">
                <h4 class="blue">กรุณาเลือก ประเภทสถิติ</h4>
            </div>
        </div>
    </div>
</div>