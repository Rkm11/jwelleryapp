<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo (isset($title)) ? $title : $global['site_title']; ?></title>
        <?php $this->load->view('backend/sections/header.php'); ?>
        <script src="<?php echo base_url(); ?>media/backend/js/jquery.validate.min.js"></script>
        <script type="text/javascript" language="javascript">

            $(document).ready(function () {


                jQuery("#frmaddsliderInfo").validate({
                    errorElement: 'label',
                    rules: {
                        slider_title: {
                            required: true
                        },
                        slider_rotation_speed: {
                            required: true,
                            number: true
                        },
                        slider_animation_speed: {
                            required: true,
                            number: true
                        }
                    },
                    messages: {
                        slider_title: {
                            required: "Please enter a slider title."
                        },
                        slider_rotation_speed: {
                            required: "Please enter the slider rotation speed.",
                            number: "Please enter a valid slider rotation speed as a whole number."

                        },
                        slider_animation_speed: {
                            required: "Please enter the slider animation speed.",
                            number: "Please enter a valid slider animation speed as a whole number."

                        }
                    },
                    // set this class to error-labels to indicate valid fields
                    success: function (label) {
                        // set &nbsp; as text for IE
                        label.hide();
                    }
                });

            });

        </script>
    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>
        <div id="content" class="span10"> 
            <!--[breadcrumb]-->
            <div>
                <ul class="breadcrumb">
                    <li> <a href="javascript:void(0)">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners">Manage Slider Banners</a><span class="divider">/</span></li>
                    <li>Add Slider Banner</li>
                </ul>
            </div>
            <div class="row-fluid sortable"> 
                <!--[sortable header start]-->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class="icon-plus"></i>Add New Slider Banner</h2>
                        <div class="box-icon"> <a title="Manage Slider Info" class="btn btn-plus btn-round" href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners"><i class="icon-arrow-left"></i></a> </div>
                    </div>
                    <br >
                    <!--[sortable body]-->
                    <div class="box-content">
                        <form name="frmaddsliderInfo" class="form-horizontal" id="frmaddsliderInfo" action="<?php echo base_url(); ?>backend/slider-banner/add-sliders-banner" method="POST" >
                            <div class="control-group">
                                <label class="control-label" for="title">Slider Title <sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <input type="text" dir="ltr" class="FETextInput" name="slider_title" value="" id="slider_title" size="100"   />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Slider Rotation Speed">Slider Rotation Speed (ms)<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <input type="text" dir="ltr" class="FETextInput" name="slider_rotation_speed" value="" id="slider_rotation_speed" size="100"   />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Slider Animation Speed">Slider Animation Speed (ms) <sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <input type="text" dir="ltr" class="FETextInput" name="slider_animation_speed" value="" id="slider_animation_speed" size="100"   />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Pause On Mouse Over">Pause On Mouse Over <sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="pause_on_mouse_over" id="pause_on_mouse_over">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Pause On Mouse Over">Animation Loop<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="is_autoslide_loop" id="is_autoslide_loop">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Enable  Pause Button On Slider">Enable  Pause Button On Slider<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="enable_pause_button" id="enable_pause_button">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Enable  Next Previous Buttons On Slider">Enable  Next Previous Buttons <sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="enable_next_previous_button" id="enable_next_previous_button">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Enable  Contraol Nav On Slider">Control Nav<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="control_nav" id="control_nav">
                                        <option  value="Yes" >Yes </option>
                                        <option  value="thumbnails">Thumbnails </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Slider Type">Slider Type<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="slider_type" id="slider_type">
                                        <option  value="Full Width">Full Width </option>
                                        <option  value="Responsive">Responsive </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="Slider widths heights id">Slider Width Height<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="slider_widths_heights_id" id="slider_widths_heights_id">
                                        <?php foreach ($arr_slider_widths_heights as $width_height) {
                                            ?>
                                            <option  value="<?php echo $width_height['slider_widths_heights_id']; ?>"><?php echo $width_height['slider_width'] . "X" . $width_height['slider_height']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="enable_auto_slide">Enable  Auto Slide<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="enable_auto_slide" id="enable_auto_slide">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="enable_auto_slide">Show Description Over Image<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="show_description_text_over_image" id="show_description_text_over_image">
                                        <option  value="Yes">Yes </option>
                                        <option  value="No">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="slider direction">Slider Direction<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="slider_direction" id="small_thumbs_position">
                                        <option  value="horizontal" >Horizontal </option>
                                        <option  value="vertical">Vertical </option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="slider banner effects id">Slider Effect<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="slider_effect_id_fk" id="slider_effect_id_fk">
                                        <?php foreach ($arr_effects as $effect) {
                                            ?>
                                            <option  value="<?php echo $effect['slider_banner_effects_id']; ?>"><?php echo $effect['slider_banner_effects_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="enable_auto_slide">Select Language<sup style="color: red;">*</sup></label>
                                <div class="controls">
                                    <select name="lang_id" id="lang_id">
                                        <?php foreach ($languages as $lang) {
                                            ?>
                                            <option  value="<?php echo $lang['lang_id']; ?>"><?php echo $lang['lang_name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="btnSubmit" class="btn btn-primary" value="Save changes">Save</button>
                            </div>
                        </form>
                    </div>
                    <!--[sortable body]--> 
                </div>
            </div>
            <!--[sortable table end]--> 

            <!--[include footer]--> 
        </div>
        <!--/#content.span10-->
    </div>
    <!--/fluid-row-->

</div>
</body>
</html>

