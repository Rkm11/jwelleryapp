<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Slider Banner Object Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners"><i class="fa fa-fw fa-rotate-right"></i> Manage Slider Banners</a></li>
            <li class="active">Manage Slider  Banners Objects</li>

        </ol>
    </section>
    <section class="content">
        <?php
        $msg = $this->session->userdata('msg');
        $msg_error = $this->session->userdata('msg_error');
        ?>
<?php if ($msg != '') { ?>
            <div class="msg_box alert alert-success">
                <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">X</button>
                <?php
                echo $msg;
                $this->session->unset_userdata('msg');
                ?>
            </div>
        <?php } ?>
<?php if ($msg_error != '') { ?>
            <div class="msg_box alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">X</button>
                <?php
                echo $msg_error;
                $this->session->unset_userdata('msg_error');
                ?>
            </div>
<?php } ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form name="frm_slider_banner" id="frm_slider_banner" class="form-horizontal" action="<?php echo base_url(); ?>backend/slider-banner/delete-slider-banner-object" method="post">
                            <input type='hidden' name='slider_id' id='slider_id' value='<?php echo $slider_id; ?>'>

                            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th> <center>
                                        Select <br>
                                        <?php
                                        if (count($arr_slider_banners_objects) > 1) {
                                            ?>
                                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
<?php } ?>
                                    </center></th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Banner Object Title">Banner Object Title</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Banner Image/video">Banner Image/video</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Banner Url">Banner Url</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Banner Status">Banner Status</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="View More Info">View More Info</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Banner Url">Duplicate</th>
                                    <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Action">Action</th>
                                    </thead>
                                    <tbody>
                                    <div class="table-responsive">

                                        <?php
                                        $cnt = 0;
                                        foreach ($arr_slider_banners_objects as $slider_banner) {
                                            $cnt++;
                                            ?>
                                            <tr>
                                                <td ><center>
                                                <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $slider_banner['banner_object_id']; ?>" />
                                            </center></td>
                                            <td ><?php echo stripslashes($slider_banner['banner_object_title']); ?></td>
                                            <?php if ($slider_banner['banner_object_type'] == 'Image') {
                                                ?>
                                                <td ><img src="<?php echo base_url(); ?>media/front/slider-images/thumbs-admin/<?php echo $slider_banner['banner_object_image']; ?>" title="banner slider image" ></td>
                                                <?php
                                            }
                                            if ($slider_banner['banner_object_type'] == 'Image_video') {
                                                ?>
                                                <td ><img src="<?php echo base_url(); ?>media/front/slider-images/thumbs-admin/<?php echo $slider_banner['banner_object_image']; ?>" title="banner slider image" alt="Banner slider image" >
                                                    <?php if ($slider_banner['video_type'] == 'Upload') {
                                                        ?>
                                                        <object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>media/front/video-plyr.swf?u=<?php echo base_url(); ?>media/front/slider-videos/<?php echo $slider_banner['banner_object_video']; ?>" style="margin-top: 10px;" width="300" height="170">
                                                            <param name="movie" value="<?php echo base_url(); ?>media/front/video-plyr.swf?u=<?php echo base_url(); ?>media/front/img/slider-videos/<?php echo $slider_banner['banner_object_video']; ?>" />
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
                                                        <iframe width="330" height="170" style="margin-top: 10px;" src="<?php echo str_replace("watch?v=", "embed/", $slider_banner['youtube_path']); ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php } ?></td>
                                                <?php
                                            }
                                            if ($slider_banner['banner_object_type'] == 'Video') {
                                                if ($slider_banner['video_type'] == 'Upload') {
                                                    ?>
                                                    <td ><object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>video-plyr.swf?u=<?php echo base_url(); ?>media/front/slider-videos/<?php echo $slider_banner['banner_object_video']; ?>" width="300" height="270">
                                                            <param name="movie" value="video-plyr.swf?u=<?php echo base_url(); ?>media/front/slider-videos/<?php echo $slider_banner['banner_object_video']; ?>" />
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
                                                        </object></td>
                                                <?php } else { ?>
                                                    <td ><iframe width="330" height="270" src="<?php echo str_replace("watch?v=", "embed/", $slider_banner['youtube_path']); ?>" frameborder="0" allowfullscreen></iframe></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <td ><?php echo $slider_banner['banner_object_url']; ?></td>
                                            <td ><?php
                                                switch ($slider_banner['banner_object_status']) {
                                                    case '1':
                                                        $class = 'label-success';
                                                        $status = $slider_banner['banner_object_status'];
                                                        $status_to_change = 'Inactive';
                                                        break;
                                                    case '0':
                                                        $class = 'label-warning';
                                                        $status = $slider_banner['banner_object_status'];
                                                        $status_to_change = 'Active';
                                                        break;
                                                }
                                                ?>
                                                <div id="activeDiv<?php echo $slider_banner['banner_object_id']; ?>" <?php if ($slider_banner['banner_object_status'] == "Active") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                                    <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $slider_banner['banner_object_id']; ?>', 'Inactive');" href="javascript:void(0);" id="status_<?php echo $slider_banner['banner_object_id']; ?>">Active</a>
                                                </div>

                                                <div id="inActiveDiv<?php echo $slider_banner['banner_object_id']; ?>" <?php if ($slider_banner['banner_object_status'] == "Inactive") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>

                                                    <a class="label label-warning" title="Click to Change Status" onClick="changeStatus('<?php echo $slider_banner['banner_object_id']; ?>', 'Active');" href="javascript:void(0);" id="status_<?php echo $slider_banner['banner_object_id']; ?>">Inactive</a>
                                                </div>

                                            </td>


                                            <td class=""><a class="btn btn-info" href="<?php echo base_url(); ?>backend/slider-banner/slider-banner-object-more-details/<?php echo $slider_banner['banner_object_id']; ?>" title="View Slider Banner Object Details"> <i class="icon-inbox icon-white"></i>More info</a></td>
                                            <td class=""><a class="btn btn-info" onClick="return confirm('Do you really want to duplicate this banner object?')" href="<?php echo base_url(); ?>backend/slider-banner/duplicate-banner-object-details/<?php echo $slider_banner['banner_object_id']; ?>" title="Duplicate banner object"> <i class="icon-inbox icon-white"></i>Duplicate</a></td>
                                            <td class=""><a class="btn btn-info" href="<?php echo base_url(); ?>backend/slider-banner/edit-slider-banner-object/<?php echo $slider_banner['banner_object_id']; ?>" title="Edit Slider Banner object"> <i class="icon-edit icon-white"></i>Edit</a></td>
                                            </tr>
<?php } ?>
                                        </tbody>

                                        <?php if (count($arr_slider_banners_objects) > 0) {
                                            ?>
                                            <tfoot>
                                            <th colspan="9"><input type="submit" id="btnDeleteAll" name="btnDeleteAll" class="btn btn-danger" onClick="return deleteconfirm();"  value="Delete Selected">
                                                <a title="Add New Slider Banner Object" href="<?php echo base_url(); ?>backend/slider-banner/add-slider-banner-object/<?php echo $slider_id; ?>" class="btn btn-info pull-right"> <i class="icon-plus"></i>Add New Slider Banner Object</a>
                                            </th>
                                            </tfoot>
<?php } ?>
                                </table>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('backend/sections/footer.php'); ?>
        <script type="text/javascript">
            /* javascript function to change the user's status start */
            function changeStatus(banner_object_id, status)
            {
                // Create javascript object
                var obj_params = new Object();
                obj_params.banner_object_id = banner_object_id;
                obj_params.status = status;
                jQuery.post("<?php echo base_url(); ?>backend/slider-banner/change-slider-banner-object-status", obj_params, function (msg) {
                    if (msg.error == "false")
                    {
                        alert(msg.errorMessage);
                    }
                    else
                    {
                        if (status == "Inactive")
                        {
                            $("#inActiveDiv" + banner_object_id).css('display', 'inline-block');
                            $("#activeDiv" + banner_object_id).css('display', 'none');
                        }
                        else
                        {
                            $("#activeDiv" + banner_object_id).css('display', 'inline-block');
                            $("#inActiveDiv" + banner_object_id).css('display', 'none');
                        }
                        //alert("Your request has been completed successfully!");
                        location.href = location.href;
                    }
                }, "json");
            }
            /* javascript function to change the user's status end */
        </script>
