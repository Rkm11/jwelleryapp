<?php
$incorrect_url = '';
if (count($arr_slider_info) == '0') {
    $incorrect_url = 'yes';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo (isset($title)) ? $title : $global['site_title']; ?></title>
        <?php $this->load->view('backend/sections/header.php'); ?>
        <script src="<?php echo base_url(); ?>admin-media/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>admin-media/js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
        <script src="<?php echo base_url(); ?>admin-media/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url(); ?>admin-media/js/charisma.js"></script>
    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>
        <div id="content" class="span10">
            <div>
                <ul class="breadcrumb">
                    <li> <a href="javascript:void(0)">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners">Manage Slider Banners</a><span class="divider">/</span> </li>
                    <li> Slider Banner Details</li>
                </ul>
            </div>
            <div id="content" class="span10"> 
                <!-- content starts -->

                <div class="row-fluid sortable">
                    <div class="box span12">
                        <div class="box-header well" data-original-title>
                            <h2><i class="icon-edit"></i>Slider Information</h2>
                            <div class="box-icon"> <a href="javascript:void(0);" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> </div>
                        </div>
                        <div class="box-content">
                            <fieldset>
                                <?php if ($incorrect_url == 'yes') {
                                    ?>
                                    <div class="control-group">
                                        <div class="controls"> <span style="color: red;font-weight: bold;">Sorry this url does not seem to be valid.</span> </div>
                                    <?php } else {
                                        ?>
                                        <div class="control-group">
                                            <label class="control-label" for="Slider">Slider Details</label>
                                            <br/>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Title : </span> <?php echo ($arr_slider_info[0]['slider_title']) ? $arr_slider_info[0]['slider_title'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Rotation Speed : </span> <?php echo ($arr_slider_info[0]['slider_rotation_speed']) ? $arr_slider_info[0]['slider_rotation_speed'] : ''; ?> (ms)<br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Animation Speed : </span> <?php echo ($arr_slider_info[0]['slider_animation_speed']) ? $arr_slider_info[0]['slider_animation_speed'] : ''; ?> (ms)<br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Pause on Mouse over: </span> <?php echo ($arr_slider_info[0]['pause_on_mouse_over']) ? $arr_slider_info[0]['pause_on_mouse_over'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Enable Pause Button: </span> <?php echo ($arr_slider_info[0]['enable_pause_button']) ? $arr_slider_info[0]['enable_pause_button'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Enable Next Previous Buttons : </span> <?php echo ($arr_slider_info[0]['enable_next_previous_button']) ? $arr_slider_info[0]['enable_next_previous_button'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Control Nav: </span> <?php echo ($arr_slider_info[0]['control_nav']) ? $arr_slider_info[0]['control_nav'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Type : </span> <?php echo ($arr_slider_info[0]['slider_type']) ? $arr_slider_info[0]['slider_type'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Enable Auto Slide  : </span> <?php echo ($arr_slider_info[0]['enable_auto_slide']) ? $arr_slider_info[0]['enable_auto_slide'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Language To Show Slider In : </span> <?php echo ($arr_slider_info[0]['lang_name']) ? $arr_slider_info[0]['lang_name'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Show Description over image : </span> <?php echo ($arr_slider_info[0]['show_description_text_over_image']) ? $arr_slider_info[0]['show_description_text_over_image'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Status: </span> <?php echo ($arr_slider_info[0]['slider_status']) ? $arr_slider_info[0]['slider_status'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Effect : </span> <?php echo ($arr_slider_info[0]['slider_banner_effects_name']) ? $arr_slider_info[0]['slider_banner_effects_name'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Automation loop : </span> <?php echo ($arr_slider_info[0]['is_autoslide_loop']) ? $arr_slider_info[0]['is_autoslide_loop'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Direction : </span> <?php echo ($arr_slider_info[0]['slider_direction']) ? $arr_slider_info[0]['slider_direction'] : ''; ?><br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Width : </span> <?php echo ($arr_slider_info[0]['slider_width']) ? $arr_slider_info[0]['slider_width'] : ''; ?>px<br/>
                                                <br/>
                                            </div>
                                            <div class="controls"> <span style="font-weight: bold;width: 280px;float: left;"> Slider Height : </span> <?php echo ($arr_slider_info[0]['slider_height']) ? $arr_slider_info[0]['slider_height'] : ''; ?>px<br/>
                                                <br/>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </fieldset>
                        </div>
                    </div>
                    <!--/span--> 
                </div>
                <!--/row--> 
                <!-- content ends --> 
            </div>
            <!--/#content.span10--> 

