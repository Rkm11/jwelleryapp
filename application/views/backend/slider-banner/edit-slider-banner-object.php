<?php
ini_set('post_max_size', '100M');
ini_set('max_file_uploads', '10000');
ini_set('max_input_time', '6000');
?><?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Update Slider Banner Object Info

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners"><i class="fa fa-fw fa-rotate-right"></i> Manage Slider Banners</a></li>
            <li><a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banner-objects/<?php echo($arr_slider_banner_object_info[0]['slider_id_fk']) ? $arr_slider_banner_object_info[0]['slider_id_fk'] : ''; ?>"> Manage Slider Banner Objects</a></li>
            <li class="active">	 Update Slider Banner Object Info</li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form name="frm_edit_slider_banner_info"  enctype="multipart/form-data" id="frm_edit_slider_banner_info" action="<?php echo base_url(); ?>backend/slider-banner/edit-sliders-banner-object" method="POST" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Title">Title <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo stripslashes($arr_slider_banner_object_info[0]['banner_object_title']); ?>" id="banner_object_title" name="banner_object_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="URL">URL</label>
                                        <input type="text" value="<?php echo $arr_slider_banner_object_info[0]['banner_object_url']; ?>" id="banner_object_url" name="banner_object_url" class="form-control">
                                        For Example:- http:// |your domain|.com
                                    </div>
                                    <div class="form-group">
                                        <label for="Open URL In New Tab">Open URL In New Tab</label>
                                        <select name="open_url_in_new_page" id="open_url_in_new_page" class="form-control">
                                            <option  value="Yes" <?php echo ($arr_slider_banner_object_info[0]['open_url_in_new_page'] == 'Yes') ? 'selected' : ''; ?>>Yes </option>
                                            <option  value="No" <?php echo ($arr_slider_banner_object_info[0]['open_url_in_new_page'] == 'No') ? 'selected' : ''; ?>>No </option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="Start Date ">Start Date <sup class="mandatory">*</sup></label>
                                        <input type="text" readonly="" value="<?php echo date("Y-m-d", strtotime($arr_slider_banner_object_info[0]['banner_object_start_date'])); ?>" id="banner_object_start_date" name="banner_object_start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for=" End Date "> End Date  <sup class="mandatory">*</sup></label>
                                        <input type="text" readonly="" value="<?php echo date("Y-m-d", strtotime($arr_slider_banner_object_info[0]['banner_object_end_date'])); ?>" id="banner_object_end_date" name="banner_object_end_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for=" End Date "> Description Text</label>
                                        <textarea  dir="ltr" class="form-control" id="banner_object_description_text" name="banner_object_description_text"><?php echo (stripcslashes(preg_replace("/[\\n\\r]+/", " ", $arr_slider_banner_object_info[0]['banner_object_description_text']))); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=" End Date "> Type</label>
                                        <input type="hidden" name="banner_object_type_hidden" id="banner_object_type_hidden" value="<?php echo $arr_slider_banner_object_info[0]['banner_object_type']; ?>">
                                        <select name="banner_object_type"class="form-control"   id="banner_object_type" onchange='showBannerVideoDiv(this.value);'>
                                            <option  value="Image" <?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] == 'Image') ? 'selected' : ''; ?>>Image </option>
                                            <!--<option  value="Video">Video</option>--> 
                                            <!--<option  value="Image_video">Image And Video</option>-->
                                        </select>
                                    </div>
                                    <div class="form-group" style="display:none" id="video_type">
                                        <label for=" End Date "> Video Type</label>
                                        <select name="video_type" id="video_type" class="form-control" onchange='showVideoType(this.value);'>
                                            <option  value="Upload" <?php echo ($arr_slider_banner_object_info[0]['video_type'] == 'Upload') ? 'selected' : ''; ?>>Upload </option>
                                            <option  value="Youtube" <?php echo ($arr_slider_banner_object_info[0]['video_type'] == 'Youtube') ? 'selected' : ''; ?>>You Tube</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="<?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] == 'Image' || $arr_slider_banner_object_info[0]['banner_object_type'] == 'Image_video') ? 'display:block' : 'display:none'; ?>"  id="banner_object_image_div">
                                        <label for=" End Date "> Image</label>
                                        <input  dir="ltr" id="banner_object_image" name="banner_object_image" type="file">
                                    </div>
                                    <div class="form-group" style="<?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] != 'Image' && $arr_slider_banner_object_info[0]['video_type'] != 'Youtube' ) ? 'display:block' : 'display:none;'; ?>" id='banner_object_video_div'>
                                        <label for=" End Date "> Video</label>
                                        <input  dir="ltr" id="banner_object_video" name="banner_object_video" type="file">
                                    </div>
                                    <div class="form-group"  style="<?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] != 'Image' && $arr_slider_banner_object_info[0]['video_type'] == 'Youtube') ? 'display:block' : 'display:none;'; ?>" id="youtube_path_div">
                                        <label for=" End Date "> Youtube</label>
                                        <input  dir="ltr" value="<?php echo $arr_slider_banner_object_info[0]['youtube_path']; ?>" id="youtube_path" name="youtube_path" type="file">
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" name="btnSubmit" class="btn btn-primary" value="Save changes">Save changes</button>
                                        <input type="hidden" name="slider_id" value="<?php echo($arr_slider_banner_object_info[0]['slider_id_fk']) ? $arr_slider_banner_object_info[0]['slider_id_fk'] : ''; ?>">
                                        <input type="hidden" name="banner_object_id" value="<?php echo($arr_slider_banner_object_info[0]['banner_object_id']) ? $arr_slider_banner_object_info[0]['banner_object_id'] : ''; ?>">
                                        <input type="hidden" name="slider_width" value="<?php echo($arr_slider_banner_object_info[0]['slider_width']) ? $arr_slider_banner_object_info[0]['slider_width'] : ''; ?>">
                                        <input type="hidden" name="slider_height" value="<?php echo($arr_slider_banner_object_info[0]['slider_height']) ? $arr_slider_banner_object_info[0]['slider_height'] : ''; ?>">
                                    </div>
                                    </form>
                                    <div class="form-group" style="<?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] != 'Video') ? 'display:block' : 'display:none;'; ?>" id="">
                                        <label class="control-label" for="you tube ">Image Preview</label>
                                        <img src="<?php echo base_url(); ?>media/front/slider-images/thumbs-admin/<?php echo $arr_slider_banner_object_info[0]['banner_object_image']; ?>" title="banner slider image" alt="Banner slider image">
                                    </div>
                                    <div class="form-group" style="<?php echo ($arr_slider_banner_object_info[0]['banner_object_type'] != 'Image') ? 'display:block' : 'display:none;'; ?>" id="">
                                        <label class="control-label" for="you tube ">Video Preview</label>

                                        <?php if ($arr_slider_banner_object_info[0]['video_type'] == 'Upload') {
                                            ?>
                                            <object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>media/front/video-plyr.swf?u=<?php echo base_url(); ?>media/front/slider-videos/<?php echo $arr_slider_banner_object_info[0]['banner_object_video']; ?>" style="margin-top: 10px;" width="300" height="170">
                                                <param name="movie" value="<?php echo base_url(); ?>media/front/video-plyr.swf?u=<?php echo base_url(); ?>media/front/slider-videos/<?php echo $arr_slider_banner_object_info[0]['banner_object_video']; ?>" />
                                                <param name="quality" value="high" />
                                                <param name="bgcolor" value="#ffff00" />
                                                <param name="play" value="true" />
                                                <param name="loop" value="true" />
                                                <param name="wmode" value="transparent" />
                                                <param name="scale" value="showall" />
                                                <param name="menu" value="true" />
                                                <param name="devicefont" value="false" />
                                                <param name="salign" value="" />
                                                <param name="allowScriptAccess" value="sameDomain" />
                                                <!--<![endif]--> 
                                                <a href="http://www.adobe.com/go/getflash"> <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /> </a> 
                                                <!--[if !IE]>-->
                                            </object>
                                        <?php } else { ?>
                                            <iframe width="330" height="170" style="margin-top: 10px;" src="<?php echo str_replace("watch?v=", "embed/", $arr_slider_banner_object_info[0]['youtube_path']); ?>" frameborder="0" allowfullscreen></iframe>
                                        <?php } ?>
                                    </div>

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
            <?php $this->load->view('backend/sections/footer'); ?>
            <link href="<?php echo base_url(); ?>media/backend/css/jquery-ui.min.css" rel="stylesheet">
            <script src="<?php echo base_url(); ?>media/backend/js/jquery-ui.js" type="text/javascript"></script>
            <script type="text/javascript" language="javascript">
                                            //alert(asdfa);
                                            $(document).ready(function () {

                                                jQuery("#frm_edit_slider_banner_info").validate({
                                                    errorElement: 'label',
                                                    rules: {
                                                        banner_object_title: {
                                                            required: true
                                                        },
                                                        banner_object_start_date: {
                                                            required: true
                                                        },
                                                        banner_object_end_date: {
                                                            required: true
                                                        },
                                                        banner_object_image: {
                                                            required: {
                                                                depends: function () {
                                                                    return (($('#banner_object_type').val() == "Image" || $('#banner_object_type').val() == "Image_video") && ($('#banner_object_type_hidden').val() != $('#banner_object_type').val()));
                                                                }
                                                            }
                                                        },
                                                        youtube_path: {
                                                            required: {
                                                                depends: function () {
                                                                    return ($('#banner_object_type').val() == "Video" || $('#banner_object_type').val() == "Image_video");
                                                                }
                                                            }
                                                        },
                                                        banner_object_video: {
                                                            required: {
                                                                depends: function () {
                                                                    return (($('#banner_object_type').val() == "Video" || $('#banner_object_type').val() == "Image_video") && ($('#banner_object_type_hidden').val() != $('#banner_object_type').val()));
                                                                }
                                                            }
                                                        },
                                                        banner_object_url: {
                                                            url: true
                                                        },
                                                        banner_object_click_count: {
                                                            required: true,
                                                            number: true
                                                        },
                                                        banner_object_alt_text: {
                                                            required: true
                                                        }
                                                    },
                                                    messages: {
                                                        banner_object_title: {
                                                            required: "Please enter a banner title."
                                                        },
                                                        banner_object_start_date: {
                                                            required: "Please select a start date."
                                                        },
                                                        banner_object_end_date: {
                                                            required: "Please select an end date."
                                                        },
                                                        banner_object_image: {
                                                            required: "Please select an image."
                                                        },
                                                        banner_object_video: {
                                                            required: "Please upload a vidoe."
                                                        },
                                                        youtube_path: {
                                                            required: "Please enter  a youtube url or src code of youtube embeded."
                                                        },
                                                        banner_object_alt_text: {
                                                            required: "Please enter a banner alternate text."
                                                        },
                                                        banner_object_click_count: {
                                                            required: "Please enter a banner click counts. keep it zero to make it empty.",
                                                            number: "Please enter a valid banner click count."
                                                        },
                                                        banner_object_url: {
                                                            url: "Please enter a valid banner url"
                                                        }
                                                    },
                                                    // set this class to error-labels to indicate valid fields
                                                    success: function (label) {
                                                        // set &nbsp; as text for IE
                                                        label.hide();
                                                    }
                                                });
                                                $('#banner_object_image').change(function () {
                                                    var ext = this.value.match(/\.(.+)$/)[1];
                                                    switch (ext) {
                                                        case 'jpg':
                                                        case 'jpeg':
                                                        case 'png':
                                                        case 'gif':
                                                        case 'JPG':
                                                        case 'JPEG':
                                                        case 'PNG':
                                                        case 'GIF':
                                                            break;
                                                        default:
                                                            alert('Please upload a file only of type jpg,png,gif,jpeg.');
                                                            this.value = '';
                                                    }
                                                });
                                                $('#banner_object_video').change(function () {
                                                    var ext = this.value.match(/\.(.+)$/)[1];
                                                    switch (ext) {
                                                        case 'flv':

                                                            break;
                                                        default:
                                                            alert('Please upload a file only of type flv.');
                                                            this.value = '';
                                                    }
                                                });


                                            });

            </script>
            <script type='text/javascript'>
                //this is use to show image and video divs according to what type of object a admin select
                function showBannerVideoDiv(value)
                {
                    if (value == 'Video')
                    {
                        $("#banner_object_video_div").css("display", "block");
                        $("#banner_object_image_div").css("display", "none");
                        $("#video_type").css("display", "block");
                    } else if (value == 'Image')
                    {
                        $("#banner_object_video_div").css("display", "none");
                        $("#banner_object_image_div").css("display", "block");
                        $("#video_type").css("display", "none");
                    }
                    else
                    {
                        $("#banner_object_video_div").css("display", "block");
                        $("#video_type").css("display", "block");
                        $("#banner_object_image_div").css("display", "block");
                    }
                }
                //this is use to show image and video divs according to what type of object a admin select
                function showVideoType(value)
                {
                    if (value == 'Upload')
                    {
                        $("#banner_object_video_div").css("display", "block");
                        $("#youtube_path_div").css("display", "none");

                    }
                    else
                    {
                        $("#banner_object_video_div").css("display", "none");
                        $("#youtube_path_div").css("display", "block");

                    }
                }
            </script> 
            <script>
                $(function () {
                    $("#banner_object_start_date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        dateFormat: 'yy-m-d',
                        yearRange: '2014:2070',
                        minDate:0,
                                onClose: function (selected_date) {
                                    $("#banner_object_end_date").datepicker("option", "minDate", selected_date);
                                    this.focus();
                                }
                    });
                });
            </script> 
            <script>
                $(function () {
                    $("#banner_object_end_date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        minDate: 0,
                        dateFormat: 'yy-m-d',
                        yearRange: '2014:2070',
                        onClose: function (selected_date) {
                            $("#banner_object_start_date").datepicker("option", "maxDate", selected_date);
                        }
                    });
                });
            </script>

