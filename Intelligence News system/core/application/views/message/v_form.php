<script src="assets/2/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!--<script src="assets/2/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>-->

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
<!--        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/2/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />-->
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/2/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/2/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/2/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/2/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        
         <!--BEGIN THEME LAYOUT STYLES--> 
        <!--<link href="assets/2/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />-->  
        <link href="assets/2/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />  
        <link href="assets/2/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet">
        <!-- END THEME LAYOUT STYLES -->

<div id="page-wrapper" class="bg-fff">
    <?php $this->load->view('layout/_nav', $this->data); ?>
    <?php $this->load->view('layout/_breadcrumb', $this->data); ?>
    <div class="container">

            <div class="col-lg-12">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Warning!</strong> <?= validation_errors(); ?>
                    </div>
                <?php } 
                    if(isset($data_session['room_id']) && $data_session['room_id']){
                ?>        
                    <div class="col-lg-12">
                            <a href="message">
                                <button type="reset" class="btn btn-default">กลับหน้าหลัก</button>
                            </a>
                        </div>
                <?php    }
                ?>
                        
                <div class="clearfix"><br/><br/></div> 
            <div class="row">
               <div class="col-md-12 col-sm-6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered" style="height:530px;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-hide hide"></i>
                                        <span class="caption-subject font-hide bold uppercase"></span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body" id="chats">
                                    <div class="scroller" id="scroller_bot" style="height: 420px;" data-always-visible="1" data-rail-visible="0">
                                        <ul class="chats">
                                            <div id="chat_message">
                                            
                                            </div>
                                        </ul>
                                    </div>
                                </div>   
                            </div>
                            <!-- END PORTLET-->
                        </div>
                <div class="col-md-12 col-sm-6">
                    <form class="sidebar-search  sidebar-search-bordered sidebar-search-solid" action="message/chat" method="POST">

                        <div class="input-group">
                            <input type="text" class="form-control" id='textmessage' name="textmessage" placeholder="ข้อความ" maxlength="80">
                            <span class="input-group-btn">
                                <button type="button" id='send_message' class="btn">
                                    Send
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
             </div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
                
            </div>
        </div>

    </div>


<script>
         $(document).ready(function() {  
        //the min chars for username  
            get_message();
            sleep(1000);
            setInterval(function(){get_message()}, 5000);
            scrollerBOT();
        });
        function scrollerBOT(){
           //get_message();
           //sleep(1000);
           //alert($('#scroller_bot')[0].scrollHeight);
           $("#scroller_bot").animate({ scrollTop: $('#scroller_bot')[0].scrollHeight}, 1500);          
           //var bColl = document.getElementsByClassName('slimScrollBar');
          // alert(bColl[0]);
        }
        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
              if ((new Date().getTime() - start) > milliseconds){
                break;
              }
            }
        }
        $('#textmessage').keypress(function (e){
            //var text = $('#textmessage').val();
            if(e.keyCode == 13){
                event.preventDefault();
                send_message();
            }
        })
        
        $('#send_message').click(function(){  
                send_message();
            });
        function changeColor(coll, color){
            for(var i=0, len=coll.length; i<len; i++)
            {
                coll[i].style["background-color"] = color;
            }
        }    


       function send_message(){
           var text = $('#textmessage').val();
           $.post("message/save_chat", { text: text },  
                function(result){ 
                    //if the result is 1  
                   if(result != ""){
                       //alert(result);
                   }
            });
          //await sleep(2000);
          get_message();
          $('#textmessage').val("");
          sleep(2000);
          scrollerBOT();
       }                           
       function get_message(){
//           $('#chat_message').html('\
//            <li class="out"><div class="message"><span class="arrow"> </span><span id="rq" class="name">โหลดข้อมูล</span></div></li>\n\
//            <li class="in"><div class="message"><span class="arrow"> </span><span id="res" class="name">โหลดข้อมูล</span></div></li>');
           
           <?php if(isset($data_session['room_id']) && $data_session['room_id']){
                    $room_id = $data_session['room_id'];
                }else{
                    $room_id = $sesstion['user_id'];
                }
            ?>
           
           var id_rq = <?php echo $room_id;?>;
           $.post("message/get_chat", { id_rq: id_rq },  
                function(result){ 
                    //if the result is 1  
                   if(result != ""){
                       $('#chat_message').html(result);
                   }
            });
            scrollerBOT();
       }
</script>