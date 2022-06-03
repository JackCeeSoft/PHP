<?php
            $this->CI =& get_instance();
            $this->load->model('m_notification');
            $data_session  = $this->session->all_userdata();
            if(isset($data_session['ua_userid']) && $data_session['ua_userid']){
                $where = array();
                $where['news.n_createdby'] = $data_session['ua_userid'];
                $where['news_comment.nc_read'] = 'N';
                $noti_data = $this->CI->m_notification->get_news_noti($where,null,'news_comment.o_createddate desc');
                //var_dump($noti_data);
                 $where_get_new_announce['news_announce.d_isactive'] = 'Y';
                $where_get_new_announce['news_announce.d_startdate <='] = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
                $where_get_new_announce['news_announce.d_enddate >=']   = date('Y-m-d H:i:00', mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
                //$where_get_new_announce['news_link_usernoti.ua_userid !='] = $data_session['ua_userid'];
                $new_announce_data = $this->CI->m_notification->get_new_announce($where_get_new_announce);
                
                //var_dump($new_announce_data);
                $new_announce_count = count($new_announce_data); 
                $noti_count = count($noti_data); 
            }
            if(!$noti_data){
                //echo 'Jack';
                $noti_count = 0;
                $noti_data = array();
            }
            if(!$new_announce_data){
                //echo 'Jack';
                $new_announce_count = 0;
                $new_announce_data = array();
            }
?>
<style>
/* Nav - show 760 */
@media (min-width:990px) {
    .navbar-nav-show {
        display:none;
    }
    .collapse.in {
            background-color: #fff;

    }
    
}  
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
        border-color: #000000;
    }
.navbar-collapse.in {
    background-color: #4b4d50;
}

/* custom dropdown */
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    padding: 0px 0;
    margin: 2px 0 0;
    list-style: none;
    text-shadow: none;
    background-color: #fcfcfc;
    border: 1px solid rgba(0, 2, 1, 0.2);
    -webkit-box-shadow: 0 0px 0px rgba(0, 2, 1, 0.4);
    -moz-box-shadow: 0 0px 0px rgba(0, 2, 1, 0.4);
    box-shadow: 0 0px 0px rgba(0, 2, 1, 0.4);
    -webkit-background-clip: padding-box;
    -moz-background-clipp: padding;
    background-clip: padding-box;
    padding: 0px 0;
    margin:0px;
    list-style: none;
    text-shadow: none;
}

.dropdown-menu.opens-left {
    margin-top: 2px;
    margin-left: -88px;
}

.ie8 .dropdown-menu.opens-left {
    margin-left: -82px;
}

.dropdown-menu.extended {
    top:40px;
    min-width: 160px !important;
    max-width: 300px !important;
    width: 235px !important;
}

.dropdown-menu.logout {
    width: 150px !important;
    min-width: 120px !important;
    max-width: 260px !important;
}

.dropdown-menu.extended li a{
    display: block;
    padding: 5px 10px !important;
    clear: both;
    font-weight: normal;
    line-height: 20px;
    white-space: normal !important;
}

.dropdown-menu.extended .arrow{
    top:-14px;
    left: 10px;
    position: absolute;
    margin-top: 6px;
    margin-right: 12px;
    width: 0;
    height: 0;
    border-bottom: 8px solid #f3f3f3;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
}

.dropdown-menu.extended li i{
    margin-right: 3px;
}

.dropdown-menu.extended li a{
    /*padding: 10px !important;*/
    background-color: #fff !important;
}

.dropdown-menu.extended li a:hover {
    background-color: #f3f3f3 !important;
}

.dropdown-menu.extended li p{
    padding: 10px;
    background-color: #eee;
    margin: 0px;
    color: #666;
}

.dropdown-menu.extended li a{
    padding: 7px 0 5px 0px;
    list-style: none;
    border-bottom: 1px solid #EBEBEB !important;
    font-size: 12px;
}
.dropdown-menu.extended li:first-child a {
    border-top: none;
    border-bottom: 1px solid #EBEBEB !important;
}
.dropdown-menu.extended li:last-child a {
    border-top: 1px solid white !important;
    border-bottom: 1px solid #EBEBEB !important;
}

.dropdown-menu.inbox li a .photo img {
    float: left;
    height: 40px;
    width: 40px;
    margin-right: 4px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}

.dropdown-menu.inbox li a .subject {
    display: block;
}

.dropdown-menu.inbox li a .subject .from {
    font-size: 12px;
    font-weight: bold;
}

.dropdown-menu.inbox li a .subject .time {
    font-size: 11px;
    font-weight: bold;
    font-style: italic;
    position: absolute;
    right: 5px;
}

.dropdown-menu.inbox li a .message {
    display: block !important;
    font-size: 11px;
}

/*fontawesome*/
ul,ol {
    padding:0;
    /*margin:0 0 10px 0px*/
}
select,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],.uneditable-input {
    display:inline-block;
    height:34px;
    padding:4px 6px;
    margin-bottom:10px;
    font-size:14px;
    line-height:20px;
    color:#555;
    vertical-align:middle;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px
}
textarea {
    height:auto
}
textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],.uneditable-input {
    background-color:#fff;
    border:1px solid #ccc;
    -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);
    -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition:border linear .2s,box-shadow linear .2s;
    -moz-transition:border linear .2s,box-shadow linear .2s;
    -o-transition:border linear .2s,box-shadow linear .2s;
    transition:border linear .2s,box-shadow linear .2s
}

textarea:focus,input[type="text"]:focus,input[type="password"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="time"]:focus,input[type="week"]:focus,input[type="number"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="color"]:focus,.uneditable-input:focus {
    border-color:rgba(82,168,236,0.8);
    outline:0;
    outline:thin dotted \9;
    -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
    -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
    box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6)
}


.input-prepend .add-on,.input-prepend .btn {
    margin-right:-1px
}

.input-prepend .add-on:first-child,.input-prepend .btn:first-child {
    -webkit-border-radius:4px 0 0 4px;
    -moz-border-radius:4px 0 0 4px;
    border-radius:4px 0 0 4px
}


[class^="icon-"],[class*=" icon-"] {
    display:inline-block;
    width:14px;
    height:14px;
    margin-top:1px;
    *margin-right:.3em;
    line-height:14px;
    vertical-align:text-top;
    background-image:url(../img/icon/glyphicons-halflings.png);
    background-position:14px 14px;
    background-repeat:no-repeat
}
.icon-chevron-up {
    background-position:-288px -120px;
}

.icon-chevron-down {
    background-position:-313px -119px
}

.dropdown-menu li>a {
    display:block;
    padding:3px 20px;
    clear:both;
    font-weight:400;
    line-height:20px;
    color:#333;
    white-space:nowrap
}

.dropdown-menu li>a:hover,.dropdown-menu li>a:focus,.dropdown-submenu:hover>a {
    color:#fff;
    text-decoration:none;
    background-color:#0081c2;
    background-image:-moz-linear-gradient(top,#08c,#0077b3);
    background-image:-webkit-gradient(linear,0 0,0 100%,from(#08c),to(#0077b3));
    background-image:-webkit-linear-gradient(top,#08c,#0077b3);
    background-image:-o-linear-gradient(top,#08c,#0077b3);
    background-image:linear-gradient(to bottom,#08c,#0077b3);
    background-repeat:repeat-x;
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc',endColorstr='#ff0077b3',GradientType=0)
}

.dropdown-menu .active>a,.dropdown-menu .active>a:hover {
    color:#fff;
    text-decoration:none;
    background-color:#0081c2;
    background-image:-moz-linear-gradient(top,#08c,#0077b3);
    background-image:-webkit-gradient(linear,0 0,0 100%,from(#08c),to(#0077b3));
    background-image:-webkit-linear-gradient(top,#08c,#0077b3);
    background-image:-o-linear-gradient(top,#08c,#0077b3);
    background-image:linear-gradient(to bottom,#08c,#0077b3);
    background-repeat:repeat-x;
    outline:0;
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc',endColorstr='#ff0077b3',GradientType=0)
}

.dropdown-menu .disabled>a,.dropdown-menu .disabled>a:hover {
    color:#999
}

.dropdown-menu .disabled>a:hover {
    text-decoration:none;
    cursor:default;
    background-color:transparent;
    background-image:none;
    filter:progid:DXImageTransform.Microsoft.gradient(enabled=false)
}
</style>

<nav class="navbar navbar-inverse" style="z-index:5;">
    <div class="container-fluid">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            	<a class="navbar-brand" href=""><img src="assets/img/logo/banner.png" alt=""></a>
            </div>
        <?php 
             $data_session  = $this->session->all_userdata();
             //print_r($data_session);
             if (isset($data_session['u_unitid']) && isset($data_session['ua_firstname'])){
                 $ua_firstname = $data_session['ua_firstname']; 
                 $u_unitid = $data_session['u_unitid'];
                 $user_id = $data_session['ua_userid'];
                 $ua_lastname =  $data_session['ua_lastname'];
                 $ua_isadmin = $data_session['ug_isadmin'];
                 if(isset($data_session['base_u_unitid'])){
                     $base_u_unit = $data_session['base_u_unitid'];
                 }
             }
        ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">

            <ul class="nav navbar-nav">
                <li style="width: 160px;" class="dropdown">
                    <a href="#" class="dropdown-toggle" style="text-align: -webkit-left;" data-toggle="dropdown" role="button" aria-expanded="false"><?php if(isset($ua_firstname) && isset ($ua_lastname)) { echo "$ua_firstname"." "."$ua_lastname"; } ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="user/Edit_profile/<?=$user_id;?>">ข้อมูลส่วนบุคคล</a></li>
                       
                        <li class="divider"></li>
                        <li><a href="check_login/log_out">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>

            <?php 
            if(isset($u_unitid) &&  ($ua_isadmin == "Y")){
            echo'
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="news_announce/lists">ข่าวสารหน่วยงาน</a></li>
                        <li><a href="user/lists">ผู้ใช้งาน</a></li>
                        <li><a href="user_group/lists">กลุ่มผู้ใช้งาน</a></li>
                        <li><a href="unit/lists">ระบบงาน</a></li>
                        <li><a href="action_log/lists">Logs การทำงาน</a></li>
                        <li class="divider"></li>					
                        <li><a href="report_type/lists">ประเภทรายงาน</a></li>
                        <li><a href="news_execution/lists">การปฏิบัติของฝ่ายเรา</a></li>
                        <li><a href="news_harry/lists">ก่อกวน</a></li>
                        <li><a href="news_cause/lists">ลักษณะการก่อเหตุ</a></li>
                        <li><a href="news_person5/lists">บุคคล</a></li>
                        <li><a href="news_practice5/lists">ปฏิบัติ</a></li>
                        <li><a href="news_gun5/lists">ปืน</a></li>
                        <li class="divider"></li>
                        <li><a href="province/lists">จังหวัด</a></li>
                    </ul>
                </li>
            </ul>';
            }
            ?>
            <?php if(isset($base_u_unit) && $base_u_unit == 0) {?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                        <li><a href="<?= URL_BASE_UNIT."login/mainpage/back_main"; ?>">หน้าเมนูหลัก</a></li>
                </li>
            </ul>
            <?php }?>
            <?php 
                if(isset($u_unitid) &&  ($ua_isadmin == "Y")){
                    echo'
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">คู่มือการใช้งานระบบ<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" href="../manual/RTA001-DINT-OM-A-Unit05_User-V3-0.pdf">สำหรับผู้ใช้งานระบบ</a></li>
                                <li><a target="_blank" href="../manual/RTA001-DINT-OM-A-Unit05_Admin-V3-0.pdf">สำหรับผู้ดูแลระบบ</a></li>
                            </ul>
                        </li>
                    </ul>';
                }else{
                    echo'
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">คู่มือการใช้งานระบบ<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" href="../manual/RTA001-DINT-OM-A-Unit05_User-V3-0.pdf">สำหรับผู้ใช้งานระบบ</a></li>
                            </ul>
                        </li>
                    </ul>';
                }
            ?>
            <?php 
                if(isset($data_session['array_unit']) && $data_session['array_unit']){
            ?>
                <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">เปลี่ยนระบบงาน<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php if(in_array("1", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit01"; ?>">การรวบรวมและรายงานข่าว</a></li> <?php }?>
                                    <?php if(in_array("2", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit02"; ?>">งานแหล่งข่าวเปิด (Open Source)</a></li> <?php }?>
                                    <?php if(in_array("3", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit03"; ?>">รายงานข่าวจากแหล่งข่าวประชาชน</a></li> <?php }?>
                                    <?php if(in_array("4", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit04"; ?>">รายงานข่าวข้อมูลบุคคลและความเคลื่อนไหวที่สำคัญ</a></li> <?php }?>
                                    <?php if(in_array("5", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit05"; ?>">งานฐานข้อมูลข่าว จังหวัดชายแดนภาคใต้</a></li> <?php }?>
                                    <?php if(in_array("6", $data_session['array_unit'])){?><li><a target="" href="<?= "/login/mainpage/unit06"; ?>">สำนักงานผู้ช่วยทูตฝ่ายทหารบก/ต่างประเทศ</a></li> <?php }?>
                                </ul>
                            </li>
                </ul>
            <?php
                }
            ?>
            <ul class="nav navbar-nav" >
				<!-- BEGIN TODO DROPDOWN -->
				<li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar" >
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="height: 50px;">
                                    <!--<span class="badge badge-default"> 9999 </span>-->
                                    <span class="badge">
                                        <?php
                                        $noti_count = $new_announce_count+$noti_count;
                                            if(isset($noti_count) && $noti_count > 99){
                                                echo '99+';
                                            }else{
                                                echo $noti_count;
                                            }
                                            
                                        ?>
                                    </span>
                                </a>
				<ul class="dropdown-menu extended tasks">
						<li>
                                                        <p style="width: 280px">
                                                            แจ้งเตือนความสนใจข่าว <?= $noti_count;?> รายการ
							</p>
						</li>
				<li>
				<div class="" style="position: relative; overflow: hidden; width: 280px; height: auto;"><ul class="" style="overflow: hidden; width: 280px; height: auto;" data-initialized="1">
					<?php 
                                         foreach ($new_announce_data as $k_nad => $v_nad){
                                          ?>
                                            <li>
                                                <a href="news_announce/look_dashbord/<?=$v_nad['d_announceid_main'];?>">
                                                    <span><i class="fa fa-newspaper-o"></i></span>
                                                    <span class="">
                                                         <?php echo $v_nad['d_fullnameth']; ?>
                                                    </span>
                                                </a>
                                            </li>
                                                    <!--echo $dtF->diff($dtT)->format('%a วัน, %h ชั่วโมง, %i นาที %s วินาที');-->
                                                    
                                                   
                                         <?php } ?>
                                    <?php 
                                        $i=0;
                                        global $SuffixTime, $DateThai;
                                        $Language = 'th';
                                        //print_r($noti_data);
                                        foreach ($noti_data as $k_nd => $v_nd){
                                    ?>
                                        <li>
                                            <a href="mainpage/notification/<?=$v_nd['n_newsid'];?>">
						<span class="">
                                                    <span><i class="fa fa-comments"></i></span>
                                                    <span class="tasks"> คุณ <b><?= $v_nd['ua_firstname'];?></b> ให้ความสนใจข่าวของคุณ <br></span>
                                                    <span class=""> <?php 
                                                    $date_now = date("Y-m-d H:i:s");
                                                    //echo substr($v_nd['o_createddate'], 0,-4);
                                                    $date_post = substr($v_nd['o_createddate'], 0,19);
                                                    //echo $date_now. '-' .$v_nd['o_createddate'] . '<br><br>';
//                                                    $TimeStampAgo =  strtotime($date_post) - strtotime($date_now);
                                                    $TimeStampAgo = strtotime($date_now) - strtotime($date_post);
                                                    $dtF = new DateTime("@0");
                                                    $dtT = new DateTime("@$TimeStampAgo");
                                                    //echo strtotime($date_post) . '-' .strtotime($date_now);
//                                                    echo $dtF->diff($dtT)->format('%a วัน, %h ชั่วโมง, %i นาที %s วินาที');
                                                    echo $dtF->diff($dtT)->format('%a วัน, %h ชั่วโมง, %i นาที %s วินาที');
                                                    ?>
                                                        
                                                     </span>
						</span>
						
                                            </a>
					</li>
                                    <?php
                                        $i++;
                                        if($i >= 10)break;
                                        } // End Forech
                                    ?>
                                        
                                        
				</ul><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
				</li>
                                    <li class="external">
                                        <a href="#" style="width: 280px;">
                                            See all tasks <i class="fa fa-comments-o"></i>
                                            </a>
                                    </li>
				</ul>
				</li>
				<!-- END TODO DROPDOWN -->
			</ul>
            
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">หน้าหลัก</span>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05/news/dashboard" class="nav-link nav-toggle">
                                <i class="icon-feed"></i>
                                <span class="title">สรุปรายงานข่าว</span>
                                
                            </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05/news/insert" class="nav-link nav-toggle">
                                <i class="fa fa-plus-circle"></i>
                                <span class="title">เพิ่มข่าว</span>
                                
                            </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05/statistic/detail" class="nav-link nav-toggle">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">สถิติ</span>
                                
                            </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05/timeline" class="nav-link nav-toggle">
                                <i class="fa fa-calendar"></i>
                                <span class="title">ปฏิทินความเคลื่อนไหว</span>
                                
                            </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item start">
                            <a href="/unit05/search/news" class="nav-link nav-toggle">
                                <i class="fa fa-search"></i>
                                <span class="title">ค้นหา</span>
                            </a>
                            </li>
                        </ul>
            <?php $data_session  = $this->session->all_userdata();
                                    if(isset($data_session['ug_isadmin']) && $data_session['ug_isadmin'] == "Y"){
                            ?>            
                                <ul class="nav navbar-nav navbar-nav-show">
                                        <li class="nav-item start">
                                                    <a href="/unit05/message" class="nav-link nav-toggle">
                                                                <i class="fa fa-heart"></i>
                                                                <span class="title">ตอบกลับข้อความ</span>
                                                            </a>
                                                </li>
                                    </ul>    
                            <?php        }else{
                            ?>   
                                    <ul class="nav navbar-nav navbar-nav-show">
                                        <li class="nav-item start">
                                                    <a href="/unit05/message/chat" class="nav-link nav-toggle">
                                                                <i class="fa fa-heart"></i>
                                                                <span class="title">ส่งข้อความถึงผู้ดูแลระบบ</span>
                                                            </a>
                                                </li>
                                    </ul>
                            <?php        }
                            ?>
            <?php 
                       
                            if($_SERVER['REQUEST_URI'] != "/unit05/"){
                        ?>    
            <ul class="nav navbar-nav navbar-nav-show">
                            <li class="nav-item">
                                <button id="decreasable22" type="" class="btn" style="margin-left: 4%;">
                                    <span><i class="fa fa-search-minus"></i></span>
                               </button>
                                <button id="increasable22" type="" class="btn">
                                    <span><i class="fa fa-search-plus"></i></span>
                               </button>
                                <button id="increasable33" type="" class="btn">
                                    <span><i class="fa fa-search-plus"></i><i class="fa fa-search-plus"></i></span>
                                </button>
                            </li> <br/>
                            <li class="nav-item">
                                
                                <button id="day" type="" class="btn" style="margin-left: 4%;">
                                    <span><i class="fa fa-sun-o"></i></span>
                               </button>
                                <button id="night" type="" class="btn">
                                    <span><i class="fa fa-moon-o"></i></span>
                               </button>
                            </li>
            </ul>
                        <?php    }
                        ?>
        </div>
        <div class="float_right padding20px white"><h5>โดย กรมข่าวทหารบก</h5></div>
        <?php $this->load->view('layout/_right_nav'); ?>
    </div>
</nav>

<div class="backgroud_right_nav">
</div>

<script>
            
            var fontSize = parseInt($('body').css('font-size'),10);
            var PfontSize = parseInt($('p').css('font-size'),10);
            var H1fontSize = parseInt($('h1').css('font-size'),10);
            $('#increasable22').click(function() {
                //alert('increasable2');
                fontSize=22.0;
                PfontSize=22.0;
                H1fontSize=22.0;
                $('body').css('font-size',fontSize+'px');
                $('p').css('font-size',PfontSize+'px');
                $('h1').css('font-size',H1fontSize+'px');
            });
            $('#increasable33').click(function() {
                //alert('increasable2');
                fontSize=29.0;
                PfontSize=29.0;
                H1fontSize=29.0;
                $('body').css('font-size',fontSize+'px');
                $('p').css('font-size',PfontSize+'px');
                $('h1').css('font-size',H1fontSize+'px');
            });
            $('#decreasable22').click(function() {
                //alert('decreasable');
                fontSize=14.0;
                PfontSize=14.0;
                H1fontSize=14.0;
                $('body').css('font-size',fontSize+'px');
                $('p').css('font-size',PfontSize+'px');
                $('h1').css('font-size',H1fontSize+'px');
            });
            function sleep(milliseconds) {
                var start = new Date().getTime();
                for (var i = 0; i < 1e7; i++) {
                  if ((new Date().getTime() - start) > milliseconds){
                    break;
                  }
                }
              } //finish doing things after the pause
               
            
            $('#day').click(function(){
                $.post("check_login/day_night", { d_n: "day" },
                    function(result){ 
                       //alert(result);
                    });
                sleep(500);
                location.reload();
            });
            $('#night').click(function(){
                //alert('Jack_night');
                btn_night();
                $.post("check_login/day_night", { d_n: "night" },
                    function(result){ 
                       //alert(result);
                    });
            });
             
        </script>