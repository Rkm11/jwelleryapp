<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Slider Banner Object Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banners"><i class="fa fa-fw fa-rotate-right"></i>Manage Slider Banners</a></li>
            <li><a href="<?php echo base_url(); ?>backend/slider-banner/list-sliders-banner-objects/<?php echo($arr_slider_banner_object_info[0]['slider_id_fk']) ? $arr_slider_banner_object_info[0]['slider_id_fk'] : ''; ?>"> Manage Slider Banner Objects</a></li>
            <li class="active"> Slider Banner Object Details</li>

        </ol>
    </section>
    <?php
    $incorrect_url = '';
    if (count($arr_slider_banner_object_info) == '0') {
        $incorrect_url = 'yes';
    }
    ?>
    <?php $msg = $this->session->userdata('msg');
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
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-6">

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Banner Title :</th>
                                <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_title']) ? $arr_slider_banner_object_info[0]['banner_object_title'] : ''; ?> </td>
                            </tr>
                            <?php if ($arr_slider_banner_object_info[0]['banner_object_url'] != "") { ?>
                                <tr>
                                    <th style="width:50%">Banner Url :</th>
                                    <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_url']) ? $arr_slider_banner_object_info[0]['banner_object_url'] : ''; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th style="width:50%">Banner Start Date:</th>
                                <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_start_date']) ? date('Y-m-d', strtotime($arr_slider_banner_object_info[0]['banner_object_start_date'])) : ''; ?> </td>
                            </tr>
                            <tr>
                                <th style="width:50%">Banner End Date:</th>
                                <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_end_date']) ? date('Y-m-d', strtotime($arr_slider_banner_object_info[0]['banner_object_end_date'])) : ''; ?> </td>
                            </tr>
                            <tr>
                                <th style="width:50%">Banner Status:</th>
                                <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_status']) ? $arr_slider_banner_object_info[0]['banner_object_status'] : ''; ?></td>
                            </tr>
                            <?php if ($arr_slider_banner_object_info[0]['banner_object_description_text'] != "") { ?>
                                <tr>
                                    <th style="width:50%">Banner Description Text:</th>
                                    <td><?php echo ($arr_slider_banner_object_info[0]['banner_object_description_text']) ? $arr_slider_banner_object_info[0]['banner_object_description_text'] : ''; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</section>
<?php $this->load->view('backend/sections/footer'); ?>
