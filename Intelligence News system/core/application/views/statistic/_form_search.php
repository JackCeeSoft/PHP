<div class="panel panel-default col-lg-12 center">
    <div class="col-lg-12">
        <form class="form-horizontal" action="statistic/detail" method="GET">
            <div class="form-group">
                <br/>
                <div class="col-lg-2">
                    <label class="control-label right">ประเภทสถิติ : </label>
                </div>
                <div class="col-lg-9">
                    <?php 
                        $c1 =$c2 =$c3 =$c4 =$c5 =$c6 =$c7 = '';
                        if(isset($stat_type) && $stat_type){
                            switch ($stat_type) {
                                case 1: $c1 = 'selected'; break;
                                case 2: $c2 = 'selected'; break;
                                case 3: $c3 = 'selected'; break;
                                case 4: $c4 = 'selected'; break;
                                case 5: $c5 = 'selected'; break;
                                case 6: $c6 = 'selected'; break;
                                case 7: $c7 = 'selected'; break;
                            }
                        } else {
                            $c1 = 'selected';
                        }
                    ?>
                    <select class="form-control" id="stat_type" name="stat_type">
                        <option value="0">กรุณาเลือกประเภทสถิติ</option>
                        <option value="1" <?= $c1;?>>เหตุการณ์และภาพรวมสถานการณ์ใน จชต.</option>
                        <option value="2" <?= $c2;?>>จำนวนผู้เสียชีวิตและบาดเจ็บ</option>
                        <option value="3" <?= $c3;?>>การปฏิบัติของฝ่ายเรา</option>
                        <option value="4" <?= $c4;?>>การก่อกวนสถานการณ์</option>
                        <option value="5" <?= $c5;?>>อาวุธปืนที่ถูกกลุ่มผู้ก่อเหตุรุนแรงยึดไป</option>
                        <option value="6" <?= $c6;?>>อาวุธปืนที่จนท.ได้กลับคืน</option>
                        <option value="7" <?= $c7;?>>เหตุระเบิดในพื้นที่ จชต.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-2">
                    <label class="control-label right">การแสดงผล : </label>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" id="graph_ui" name="graph_ui">
                        <option value="table" <?= isset( $graph_ui ) && $graph_ui == 'table' ? 'selected' : ''; ?>>ตารางข้อมูล</option>
                        <option value="pie" <?= isset( $graph_ui ) && $graph_ui == 'pie' ? 'selected' : ''; ?>>กราฟประเภทวงกลม</option>
                        <option value="line" <?= isset( $graph_ui ) && $graph_ui == 'line' ? 'selected' : ''; ?>>กราฟประเภทเส้น</option>
                        <option value="bar" <?= isset( $graph_ui ) && $graph_ui == 'bar' ? 'selected' : ''; ?>>กราฟประเภทแท่ง</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group-core-type1" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามเหตุการณ์</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามอำเภอ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type2" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามบุคคล</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type3" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามการปฏิบัติการ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type4" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามสถานการณ์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type5" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามอาวุธปืน</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type6" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามอาวุธปืน</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group-core-type7" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">รูปแบบ : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="core_type" name="core_type">
                            <option value="1" <?= isset( $core_type ) && $core_type == '1' ? 'selected' : ''; ?>>แสดงผลตามกลุ่มลักษณะ</option>
                            <option value="2" <?= isset( $core_type ) && $core_type == '2' ? 'selected' : ''; ?>>แสดงผลตามจังหวัด</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group-type1" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">กลุ่มเหตุการณ์ : </label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control" id="group_event" name="group_event">
                            <option value="0">กรุณาเลือกกลุ่มเหตุการณ์</option>
                            <option value="1" <?= isset( $group_event ) && $group_event == 1 ? 'selected' : ''; ?>>เหตุการณ์ 1</option>
                            <option value="2" <?= isset( $group_event ) && $group_event == 2 ? 'selected' : ''; ?>>เหตุการณ์ 2</option>
                            <option value="3" <?= isset( $group_event ) && $group_event == 3 ? 'selected' : ''; ?>>เหตุการณ์ 3</option>
                        </select>
                        <a style="cursor: pointer;">
                            <i class="fa fa-plus-circle btn-modal-event" data-toggle="modal" data-target="#modalEvent<?= isset( $group_event ) ? $group_event : 1; ?>"> กรุณาเลือกเหตุการณ์</i>
                        </a>
                        <p style="margin: 5px 0 10px;" class="selected-event"></p>
                    </div>
                </div>
                <!-- ---------- Modal Event Cause ---------- -->
                <div id="modalEvent1" class="modal fade event1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="news_cause" name="event1[]">
                                    <?php if(isset($news_cause) and $news_cause) {?>
                                        <?php foreach ($news_cause as $v_news_cause) { ?>
                                            <?php if(isset($event) && $event && isset( $group_event ) && $group_event == 1 ) {?>
                                                <option value="<?= $v_news_cause['nc_newscauseid']; ?>" <?= (array_search($v_news_cause['nc_newscauseid'], $event) !== false) ? 'selected' : ''; ?>><?= $v_news_cause['nc_name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $v_news_cause['nc_newscauseid']; ?>" ><?= $v_news_cause['nc_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- Modal Event Cause ---------- -->
                <!-- ---------- Modal Event Harry ---------- -->
                <div id="modalEvent2" class="modal fade event2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="news_cause" name="event2[]">
                                    <?php if(isset($news_harry) and $news_harry) {?>
                                        <?php foreach ($news_harry as $v_news_harry) { ?>
                                            <?php if(isset($event) && $event && isset( $group_event ) && $group_event == 2 ) {?>
                                                <option value="<?= $v_news_harry['nh_newsharryid']; ?>" <?= (array_search($v_news_harry['nh_newsharryid'], $event) !== false) ? 'selected' : ''; ?>><?= $v_news_harry['nh_name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $v_news_harry['nh_newsharryid']; ?>" ><?= $v_news_harry['nh_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- Modal Event Harry ---------- -->
                <!-- -------- Modal Event Execution -------- -->
                <div id="modalEvent3" class="modal fade event3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="news_cause" name="event3[]">
                                    <?php if(isset($news_execution) and $news_execution) {?>
                                        <?php foreach ($news_execution as $v_news_execution) { ?>
                                            <?php if(isset($event) && $event && isset( $group_event ) && $group_event == 3 ) {?>
                                                <option value="<?= $v_news_execution['ne_newsexecutionid']; ?>" <?= (array_search($v_news_execution['ne_newsexecutionid'], $event) !== false) ? 'selected' : ''; ?>><?= $v_news_execution['ne_name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $v_news_execution['ne_newsexecutionid']; ?>" ><?= $v_news_execution['ne_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------- Modal Event Execution -------- -->
            </div>
            
            <div class="form-group-type2" style="display: none;">
                <div class="form-group core-type-1">
                    <div class="col-lg-2">
                        <label class="control-label right">จังหวัด : </label>
                    </div>
                    <div class="col-lg-3">
                        <?php $provinceArr = array(76 => 'นราธิวาส', 75 => 'ยะลา', 74 => 'ปัตตานี', 70 => 'สงขลา', ); ?>
                        <select class="form-control" id="province" name="province">
                            <?php foreach ($provinceArr as $k_province => $v_province) { ?>
                                <option value="<?= $k_province; ?>" <?= isset( $province ) && $province == $k_province ? 'selected' : ''; ?>><?= $v_province; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group core-type-2" style="display: none;">
                    <div class="col-lg-2">
                        <label class="control-label right">บุคคล : </label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="person" name="person">
                            <?php foreach ($news_person5 as $k_np5 => $v_np5) { ?>
                                <option value="<?= $v_np5['np_newspersonid']; ?>" <?= isset( $person ) && $person == $v_np5['np_newspersonid'] ? 'selected' : ''; ?>><?= $v_np5['np_person']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group-type7" style="display: none;">
                <div class="form-group">
                    <div class="col-lg-2">
                        <label class="control-label right">กลุ่มกลุ่มลักษณะ : </label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control" id="group_bomb" name="group_bomb">
                            <option value="0">กรุณาเลือกกลุ่มลักษณะ</option>
                            <option value="1" <?= isset( $group_bomb ) && $group_bomb == 1 ? 'selected' : ''; ?>>การทำงานของระเบิด</option>
                            <option value="2" <?= isset( $group_bomb ) && $group_bomb == 2 ? 'selected' : ''; ?>>ภาชนะบรรจุระเบิด</option>
                            <option value="3" <?= isset( $group_bomb ) && $group_bomb == 3 ? 'selected' : ''; ?>>วิธีการจุดระเบิด</option>
                        </select>
                        <a style="cursor: pointer;">
                            <i class="fa fa-plus-circle btn-modal-bomb" data-toggle="modal" data-target="#modalBomb<?= isset( $group_bomb ) ? $group_bomb : 1; ?>"> กรุณาเลือกลักษณะ</i>
                        </a>
                        <p style="margin: 5px 0 10px;" class="selected-bomb"></p>
                    </div>
                </div>
                <!-- ---------- Modal Bomb Cause ----------- -->
                <div id="modalBomb1" class="modal fade bomb1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="operate_bomb" name="bomb1[]">
                                    <?php if(isset($operate_bomb) and $operate_bomb) {?>
                                        <?php foreach ($operate_bomb as $k_operate_bomb => $v_operate_bomb) { ?>
                                            <?php if(isset($bomb) && $bomb && isset( $group_bomb ) && $group_bomb == 1 ) {?>
                                                <option value="<?= $k_operate_bomb; ?>" <?= (array_search($k_operate_bomb, $bomb) !== false) ? 'selected' : ''; ?>><?= $v_operate_bomb; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $k_operate_bomb; ?>" ><?= $v_operate_bomb; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- Modal Bomb Cause ----------- -->
                <!-- ---------- Modal Bomb Cause ----------- -->
                <div id="modalBomb2" class="modal fade bomb2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="dynamite_type" name="bomb2[]">
                                    <?php if(isset($dynamite_type) and $dynamite_type) {?>
                                        <?php foreach ($dynamite_type as $v_dynamite_type) { ?>
                                            <?php if(isset($bomb) && $bomb && isset( $group_bomb ) && $group_bomb == 2 ) {?>
                                                <option value="<?= $v_dynamite_type['dt_dynamitetypeid']; ?>" <?= (array_search($v_dynamite_type['dt_dynamitetypeid'], $bomb) !== false) ? 'selected' : ''; ?>><?= $v_dynamite_type['dt_name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $v_dynamite_type['dt_dynamitetypeid']; ?>" ><?= $v_dynamite_type['dt_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- Modal Bomb Cause ----------- -->
                <!-- ---------- Modal Bomb Cause ----------- -->
                <div id="modalBomb3" class="modal fade bomb3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn btn-success float_right close-modal">ปิด</button>
                                <div class="clear"></div>
                                <select class="dualSelect" multiple="multiple" id="ignition_type" name="bomb3[]">
                                    <?php if(isset($ignition_type) and $ignition_type) {?>
                                        <?php foreach ($ignition_type as $v_ignition_type) { ?>
                                            <?php if(isset($bomb) && $bomb && isset( $group_bomb ) && $group_bomb == 3 ) {?>
                                                <option value="<?= $v_ignition_type['it_ignitiontypeid']; ?>" <?= (array_search($v_ignition_type['it_ignitiontypeid'], $bomb) !== false) ? 'selected' : ''; ?>><?= $v_ignition_type['it_name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $v_ignition_type['it_ignitiontypeid']; ?>" ><?= $v_ignition_type['it_name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ---------- Modal Bomb Cause ----------- -->
            </div>
            
            <div class="form-group">
                <div class="col-lg-2">
                    <label class="control-label right">ช่วงเดือน : </label>
                </div>
                <div class="col-lg-3">
                    <div class="input-append date datetimepicker" id="datetimepicker1">
                        <input data-format="yyyy-MM-dd hh:ss:mm" type="text" name="start" <?= (isset($filter['start']) and $filter['start']) ? 'value="'.$filter['start'].'"' : '' ?>>
                        <span class="add-on">
                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                        </span>
                    </div>
                </div>
                <div class="col-lg-1">
                    <label class="control-label right">ถึงเดือน : </label>
                </div>
                <div class="col-lg-3">
                    <div class="input-append date datetimepicker" id="datetimepicker2">
                        <input data-format="yyyy-MM-dd hh:ss:mm" type="text"name="end" <?= (isset($filter['end']) and $filter['end']) ? 'value="'.$filter['end'].'"' : ''; ?>>
                        <span class="add-on">
                            <i data-date-icon="fa fa-calendar" data-time-icon="fa fa-clock-o" class="fa-calendar fa"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div style="text-align:right;">
                <button type="submit" class="btn btn-success">ค้นหา</button>
                <a href="statistic/detail" class="btn btn-default">เริ่มค้นหาใหม่</a>
                <button type="submit" name="export" class="btn btn-info">โหลดเอกสาร Excel</button>
            </div>
            <br>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        init();
        /*------------------------- modal control ------------------------*/
        $('.modal').on('hidden.bs.modal', function (e) {
            getSelectedEvent();
            getSelectedBomb();
        });
        $('.close-modal').click(function(){
            $('.modal').modal('hide');
        });
        /*------------------------- modal control ------------------------*/
        $('select#stat_type, select#graph_ui, select#core_type').change(function(){
            chkShowForm();
        });
        $('select#group_event').change(function(){
            $('.btn-modal-event').attr( 'data-target', '#modalEvent'+$( this ).val() );
            getSelectedEvent();
        });
        $('select#group_bomb').change(function(){
            $('.btn-modal-bomb').attr( 'data-target', '#modalBomb'+$( this ).val() );
            getSelectedBomb();
        });
    });
    function init() {
        getSelectedEvent();
        getSelectedBomb();
        chkShowForm();
        $('.datetimepicker').datetimepicker({
            language: 'th'
        });
        var dualListbox = $('select.dualSelect').bootstrapDualListbox({infoText:'ทั้งหมด{0}', infoTextEmpty:'ว่าง', filterPlaceHolder:'ค้นหา', selectorMinimalHeight: 300});
    }
    function getSelectedEvent() {
        var alias = 'event';
        var str = '';
        $('.selected-'+alias).html('');
        $( '.'+alias+$('select#group_event option:selected').val()+' select option:selected' ).each(function() {
            str += $( this ).text() + ", ";
        });
        $('.selected-'+alias).html(str.substring(0, str.length - 2));
    }
    function getSelectedBomb() {
        var alias = 'bomb';
        var str = '';
        $('.selected-'+alias).html('');
        $( '.'+alias+$('select#group_bomb option:selected').val()+' select option:selected' ).each(function() {
            str += $( this ).text() + ", ";
        });
        $('.selected-'+alias).html(str.substring(0, str.length - 2));
    }
    function chkShowForm() {
        $('.form-group-core-type1,.form-group-core-type2,.form-group-core-type3,.form-group-core-type4,.form-group-core-type5,.form-group-core-type6,.form-group-core-type7, .form-group-type1, .form-group-type2, .form-group-type7').hide();
        
        if( $('select#stat_type option:selected').val() == 1 && $('select#graph_ui option:selected').val() != 'table' ) {
            $('.form-group-core-type1').show();
            $('.form-group-type1').show();
        } else if( $('select#stat_type option:selected').val() == 2 && $('select#graph_ui option:selected').val() != 'table' ) {
            $('.form-group-core-type2').show();
            $('.form-group-type2').show();
            $('.core-type-1, .core-type-2').hide();
            if( $('select#core_type option:selected').val() == 1 ) {
                $('.core-type-1').show();
            }
            if( $('select#core_type option:selected').val() == 2 ) {
                $('.core-type-2').show();
            }
        } else if( ( $('select#stat_type option:selected').val() == 3 || $('select#stat_type option:selected').val() == 4  || $('select#stat_type option:selected').val() == 5  || $('select#stat_type option:selected').val() == 6 ) && $('select#graph_ui option:selected').val() != 'table' ) {
            if ($('select#stat_type option:selected').val() == 3 ){
                $('.form-group-core-type3').show();
            }
            if ($('select#stat_type option:selected').val() == 4 ){
                $('.form-group-core-type4').show();
            }
            if ($('select#stat_type option:selected').val() == 5 ){
                $('.form-group-core-type5').show();
            }
            if ($('select#stat_type option:selected').val() == 6 ){
                $('.form-group-core-type6').show();
            }
        } else if( $('select#stat_type option:selected').val() == 7 && $('select#graph_ui option:selected').val() != 'table' ) {
            $('.form-group-core-type7').show();
            $('.form-group-type7').show();
        }
    }
</script>