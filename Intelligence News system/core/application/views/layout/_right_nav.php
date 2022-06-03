<?php
            $this->CI =& get_instance();
            $this->load->model('m_notification');
            $data_session  = $this->session->all_userdata();
            if(isset($data_session['ua_userid']) && $data_session['ua_userid']){
                $where = array();
                $where['c_noti'] = 'N';
                
                if(isset($data_session['ug_isadmin']) && $data_session['ug_isadmin']){
                    $where['c_updatedby !='] = $data_session['ua_userid'];   //admin
                }else{
                    $where['c_updatedby !='] = $data_session['ua_userid'];   //admin
                    $where['ua_userid_ans'] = $data_session['ua_userid']; //user
                }
                
                //$where = null;
                //$noti_data = $this->CI->m_notification->get_chat_noti($where,null,'news_comment.o_createddate desc');
                $noti_data = $this->CI->m_notification->get_chat_noti($where,null);
                //var_dump($noti_data);
                
                $noti_count = $noti_data[0]['count']; 
            }
            if(!$noti_data){
                //echo 'Jack';
                $noti_count = 0;
                $noti_data = array();
            }
            //echo "count = ".$noti_count;
?>
    <head>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!--<link href="assets/2/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
        <link href="assets/2/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <!--<link href="assets/2/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
        <!--<link href="assets/2/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />-->
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <!--<link href="assets/2/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />-->
        <!--<link href="assets/2/global/css/plugins.min.css" rel="stylesheet" type="text/css" />-->
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/2/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/2/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

    </head>
    <style>
        .right{
            float: right;
            padding-right: 0px;
            padding-top: 0px;
            
        }
        .right2{
            position: fixed;
            top: 18%;
            right: 0px;
            z-index: 0;
            width: 13%;
        }

    </style>
    <!-- END HEAD -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->

        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <!--<div class="page-container">-->
            <!-- BEGIN SIDEBAR -->
            <div class="right2" >
                
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse" style="background-color: #232629;">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
<!--                        <li class="sidebar-toggler-wrapper ">
                             BEGIN SIDEBAR TOGGLER BUTTON 
                            <div class="sidebar-toggler" style="background-color: #232629;">
                                <span></span>
                            </div>
                             END SIDEBAR TOGGLER BUTTON 
                        </li>-->
                        <?php 
                        
                            if($_SERVER['REQUEST_URI'] != "/unit05/"){
                        ?>              
                            <li class="nav-item">
                                
                                <button id="decreasable2" type="" class="btn" style="margin-left: 14%;">
                                    <span><i class="fa fa-search-minus"></i></span>
                               </button>
                                <button id="increasable2" type="" class="btn">
                                    <span><i class="fa fa-search-plus"></i></span>
                               </button>
                                <button id="increasable3" type="" class="btn">
                                    <span><i class="fa fa-search-plus"></i><i class="fa fa-search-plus"></i></span>
                               </button>
                            </li> <br/>
                            <li class="nav-item">
                                
                                <button id="day2" type="" class="btn" style="margin-left: 30%;">
                                    <span><i class="fa fa-sun-o"></i></span>
                               </button>
                                <button id="night2" type="" class="btn">
                                    <span><i class="fa fa-moon-o"></i></span>
                               </button>
                            </li>
                        <?php    }
                        ?>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search  sidebar-search-bordered sidebar-search-solid" action="/unit05/search/news" method="GET">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search...">
                                    <input hidden type="radio" name="type_search" value="OR" checked=""> 
                                    <input hidden type="radio" name="type_search" value="AND">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn">
                                        <i class="icon-magnifier"></i>
                                    </button>
                                    </span>
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
<!--                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">หน้าหลัก</span>
                                
                            </a>
                        </li>-->
                        <li class="nav-item start">
                            <a href="/unit05" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">หน้าหลัก</span>
                                
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="/unit05/news/dashboard" class="nav-link nav-toggle">
                                <i class="icon-feed"></i>
                                <span class="title">สรุปรายงานข่าว</span>
                                
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/unit05/news/insert" class="nav-link nav-toggle">
                                <i class="fa fa-plus-circle"></i>
                                <span class="title">เพิ่มข่าว</span>
                                
                            </a>
 
                        </li>
                        <li class="nav-item  ">
                            <a href="/unit05/statistic/detail" class="nav-link nav-toggle">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">สถิติ</span>
                                
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/unit05/timeline" class="nav-link nav-toggle">
                                <i class="fa fa-calendar"></i>
                                <span class="title">ปฏิทินความเคลื่อนไหว</span>
                                
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="/unit05/search/news" class="nav-link nav-toggle">
                                <i class="fa fa-search"></i>
                                <span class="title">ค้นหา</span>
                            </a>
                          
                        </li>
                        <li class="nav-item  ">
                            <?php $data_session  = $this->session->all_userdata();
                                    if(isset($data_session['ug_isadmin']) && $data_session['ug_isadmin'] == "Y"){
                            ?>            
                                    <a href="/unit05/message" class="nav-link nav-toggle">
                                        <span class="badge badge-important"> <?= $noti_count;?> </span>
                                        <i class="fa fa-wechat"></i>
                                        <span class="title">ตอบกลับข้อความ</span>
                                    </a>
                            <?php        }else{
                            ?>   
                                    <a href="/unit05/message/chat" class="nav-link nav-toggle">
                                        <span class="badge badge-important"> <?= $noti_count;?> </span>
                                        <i class="fa fa-wechat"></i>
                                        <span class="title">ส่งข้อความถึงผู้ดูแลระบบ</span>
                                    </a>
                            <?php        }
                            ?>
                            
                          
                        </li>
<!--                        <li class="nav-item  ">
                            <a href="/login/search/news" class="nav-link nav-toggle">
                                <i class="icon-wallet"></i>
                                <span class="title">ค้นหาข่าวทุกระบบงาน</span>
                                
                            </a>

                        </li>-->
<!--                        <li class="nav-item  ">
                            <a href="/login/check_login/log_out" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">ออกจากระบบ</span>
                            </a>
                        </li>-->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
        <!--[if lt IE 9]>
<script src="assets/2/global/plugins/respond.min.js"></script>
<script src="assets/2/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!--<script src="assets/2/global/plugins/jquery.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/js.cookie.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>-->
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/2/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/2/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <!--<script src="assets/2/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>-->
        <!--<script src="assets/2/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>-->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
//            $('#increasable2').click(function() {
//                alert('increasable2');
//            });
            $(document).ready(function() {  
                            //the min chars for username 
                            <?php if(!isset($data_session['d_n'])){
                                $data_session['d_n'] = "day";
                            } ?>
                            //alert("<?=$data_session['d_n']?>");

                            if("<?=$data_session['d_n']?>" == "night"){
                                btn_night();
                              }

                        });
        </script>

        <script>
            
            var fontSize = parseInt($('body').css('font-size'),10);
            var PfontSize = parseInt($('p').css('font-size'),10);
            var H1fontSize = parseInt($('h1').css('font-size'),10);
            $('#increasable2').click(function() {
                //alert('increasable2');
                fontSize=22.0;
                PfontSize=22.0;
                H1fontSize=22.0;
                $('body').css('font-size',fontSize+'px');
                $('p').css('font-size',PfontSize+'px');
                $('h1').css('font-size',H1fontSize+'px');
            });
            $('#increasable3').click(function() {
                //alert('increasable2');
                fontSize=29.0;
                PfontSize=29.0;
                H1fontSize=29.0;
                $('body').css('font-size',fontSize+'px');
                $('p').css('font-size',PfontSize+'px');
                $('h1').css('font-size',H1fontSize+'px');
            });
            $('#decreasable2').click(function() {
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
               
            
            $('#day2').click(function(){
                $.post("check_login/day_night", { d_n: "day" },
                    function(result){ 
                       //alert(result);
                    });
                sleep(500);
                location.reload();
            });
            $('#night2').click(function(){
                //alert('Jack_night');
                btn_night();
                $.post("check_login/day_night", { d_n: "night" },
                    function(result){ 
                       //alert(result);
                    });
            });
             function btn_night(){
                $('html').css('background-color','#222');
                $('table').css('border-color','#ececec');
                $('h1').css('color','#ddca7e');
                $('h3').css('color','#ddca7e');
                $('button').css('background-color','#000000');
                $('form').css('background','#222');
                $('input').css('background','#222');
                $('select').css('background','#222');
                $('ul').css('background','#222');
                $('li').css('color','#ddca7e');
                $('a').css('color','#aaa');
                $('a').css('background-color','#222');
                $('span').css('color','#aaa');
                $('tr').css('color','#aaa');
                $('tr').css('background-color','#222');
                $('th').css('color','#aaa');
                $('label').css('color','#aaa');
                $('p').css('color','#aaa');
                
                $('.navbar-inverse').css('background','#222');
                $('.pagination').css('background','#222');
                $('.input-prepend .add-on').css('background-color','#222');
                $('.input-append .add-on').css('background-color','#222');
                $('.panel').css('background-color','#222');
                $('.btn').css('background-color','#000000');
                $('.bg-fff').css('background','#222');
                $('.pagination-text').css('color','#fff');
                $('.add-on').css('color','#222');
                $('.blue').css('color','#ddca7e');
                $('.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover').css('background-color','#ddca7e');
                $('.pagination-text').css('color','#aaa');
                $('.pagination>li>a, .pagination>li>span').css('background-color','#222');
                $('.page-sidebar .sidebar-search.sidebar-search-solid .input-group, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .sidebar-search.sidebar-search-solid .input-group').css('background','#222');
                $('.icon-magnifier').css('background','#222');
             }
        </script>
        
        <script>     
        document.onkeyup=function(e){
        var e = e || window.event; // for IE to cover IEs window event-object
        //home = 48
        //1 = 49
        //2 = 50
        //3 = 51
        //4 = 52
        //5 = 53
        //6 = 54
        //GIS = 55
        //SEARCH all = 56
        //alert(e.which);
        if(e.altKey && e.which == 48) {
          //alert('Keyboard shortcut working!');
          //window.location = "/unit01/";
          window.location = "";
          return false;
        }
        if(e.altKey && e.which == 49) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/news/dashboard";
          //window.location = "";
          return false;
        }
        if(e.altKey && e.which == 50) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/news/insert";
          //window.location = "";
          return false;
        }

        if(e.altKey && e.which == 51) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/statistic/detail";
          //window.location = "";
          return false;
        }
        if(e.altKey && e.which == 52) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/timeline";
          //window.location = "";
          return false;
        }
        if(e.altKey && e.which == 53) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/search/news";
          //window.location = "";
          return false;
        }
        if(e.altKey && e.which == 54) {
          //alert('Keyboard shortcut working!');
          window.location = "/unit05/message";
          //window.location = "";
          return false;
        }
      }
    </script>