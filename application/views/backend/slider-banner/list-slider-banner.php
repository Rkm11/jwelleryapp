<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Slider Banner Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"> <i class="fa fa-fw fa-rotate-right"></i>Manage Slider  Banners</li>

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
        <script>
            //this is to change the status of slider
            function changeStatus(slider_id, status, lang_id, lang_name)
            {

                // Create javascript object
                var activestatuscount = '';

                if (lang_id == '17')
                {
                    activestatuscount = $("#activestatuscountenglish").val();

                } else {
                    activestatuscount = $("#activestatuscountother").val();
                }


                if (status == 'Inactive' && activestatuscount == '1')
                {
                    alert('Sorry you should have atleast one slider active for ' + lang_name + '.')
                    return false;
                }


                var obj_params = new Object();
                obj_params.slider_id = slider_id;
                obj_params.status = status;
                obj_params.lang_id = lang_id;
                jQuery.post("<?php echo base_url(); ?>backend/slider-banner/change-slider-banner-status", obj_params, function (msg) {


                    if (!msg)
                    {
                        alert("You should have atleast two active objects added, to active this slider banner");
                    }
                    else
                    {

                        if (status == "Inactive")
                        {
                            $("#inActiveDiv" + slider_id).css('display', 'inline-block');
                            $("#activeDiv" + slider_id).css('display', 'none');
                        }
                        else
                        {
                            $("#activeDiv" + slider_id).css('display', 'inline-block');
                            $("#inActiveDiv" + slider_id).css('display', 'none');
                        }
                        //alert("Your request has been completed successfully!");
                        location.href = location.href;
                    }
                }, "json");
            }
        </script> <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <form name="frm_slider" id="frm_slider" action="<?php echo base_url(); ?>backend/slider-banner/delete-sliders-banners" method="post">				
                            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                        <!--<th> <center>
                                          Select <br>
                                            <?php
                                            if (count($arr_sliders) > 1) {
                                                ?>
                                                      <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
<?php } ?>
                                                </center></th>-->
                                            <th>ID</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Slider Title">Slider Title</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Slider Status">Slider Status</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Slider Status">Language</th>

                                            <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Action">Banner Objects</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $update_status_english = '0';
                                        $update_status_other = '0';
                                        /** checking for already 1 active status ** */
                                        foreach ($arr_sliders as $slider_banner) {
                                            if ($slider_banner['slider_status'] == 'Active' && $slider_banner['lang_id'] == '17') {
                                                $update_status_english++;
                                            } else if ($slider_banner['slider_status'] == 'Active' && $slider_banner['lang_id'] != '17') {
                                                $update_status_other++;
                                            }
                                        }
                                        ?>
                                        <?php
                                        $cnt = 0;
                                        foreach ($arr_sliders as $slider_banner) {
                                            $cnt++;
                                            ?>
                                            <tr>
                                                <td>
                                                    #<?php echo $cnt; ?>
                                                </td>

    <!--                    <td ><center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $slider_banner['slider_id']; ?>" /></center></td>-->
                                                <td ><?php echo $slider_banner['slider_title']; ?></td>
                                                <!--                    <td ><?php echo $slider_banner['slider_rotation_speed']; ?></td>-->
                                                <td ><?php
                                                    switch ($slider_banner['slider_status']) {
                                                        case '1':
                                                            $class = 'label-success';
                                                            $status = $slider_banner['slider_status'];
                                                            $status_to_change = 'Inactive';
                                                            break;
                                                        case '0':
                                                            $class = 'label-warning';
                                                            $status = $slider_banner['slider_status'];
                                                            $status_to_change = 'Active';
                                                            break;
                                                    }
                                                    ?>
                                                    <div id="activeDiv<?php echo $slider_banner['slider_id']; ?>" <?php if ($slider_banner['slider_status'] == "Active") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                                        <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $slider_banner['slider_id']; ?>', 'Inactive', '<?php echo $slider_banner['lang_id']; ?>', '<?php echo $slider_banner['lang_name']; ?>');" href="javascript:void(0);" id="status_<?php echo $slider_banner['slider_id']; ?>">Active</a>
                                                    </div>

                                                    <div id="inActiveDiv<?php echo $slider_banner['slider_id']; ?>" <?php if ($slider_banner['slider_status'] == "Inactive") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>

                                                        <a class="label label-warning" title="Click to Change Status" onClick="changeStatus('<?php echo $slider_banner['slider_id']; ?>', 'Active', '<?php echo $slider_banner['lang_id']; ?>', '<?php echo $slider_banner['lang_name']; ?>');" href="javascript:void(0);" id="status_<?php echo $slider_banner['slider_id']; ?>">Inactive</a>
                                                    </div>

                                                </td>


                                                <td ><?php echo $slider_banner['lang_name']; ?></td>

                                                <td><a class="btn btn-info" href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banner-objects/<?php echo $slider_banner['slider_id']; ?>" title="View Banner Objects"> <i class="icon-inbox icon-white"></i>Banner Objects</a></td>

                                            </tr>
<?php } ?>
                                    </tbody>

                                    <tfoot>
                                    <input type="hidden" name="activestatuscountenglish" id="activestatuscountenglish" value="<?php echo $update_status_english; ?>">
                                    <input type="hidden" name="activestatuscountother" id="activestatuscountother" value="<?php echo $update_status_other; ?>">

                                    </tfoot>
                                </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('backend/sections/footer.php'); ?>