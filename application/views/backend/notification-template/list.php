<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Notification Template Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-fw fa-envelope"></i> Manage  Notification Template</li>

        </ol>
    </section>
    <section class="content">
        <?php
        $msg = $this->session->userdata('msg');
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
                <div class="box">

                    <div class="box-body table-responsive">
                        <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                            <form name="frmstorefront" id="frmstorefront" action="<?php echo base_url(); ?>backend/notification-template/list" method="post">
                            <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th> <center>
                                        Select <br>
                                        <?php
                                        if (count($arr_notification_templates) > 0) {
                                            ?>
                                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
                                        <?php } ?>
                                    </center></th> 
                                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Title">Title</th>

                                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Subject">Subject</th>
                                        <?php if ($this->config->item('is_multi_language') == 'Yes') {
                                            ?>	
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Language">Language</th>
                                        <?php } ?>			
                                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Created on</th>
                                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Updated on">Updated on</th>

                                        <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Action">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $cnt = 0;
                                    $i = 1;
                                    foreach ($arr_notification_templates as $notification_template) {
                                        $cnt++;
                                        ?>
                                        <tr>
                                            <td ><center>
                                            <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $notification_template['notification_template_id']; ?>" />
                                        </center></td>
                                            <td><?php echo ucwords(str_replace("-", " ", $notification_template['notification_template_title'])); ?></td>
                                            <td><?php echo $notification_template['notification_template_subject']; ?></td>
                                            <?php if ($this->config->item('is_multi_language') == 'Yes') {
                                                ?>	
                                                <td ><?php echo $notification_template['lang_name']; ?></td>
                                            <?php } ?>	  
                                            <td><?php echo date($global['date_format'], strtotime($notification_template['date_created'])); ?></td>
                                            <td><?php echo date($global['date_format'], strtotime($notification_template['date_updated'])); ?></td>
                                            <td class="">
                                                <a class="btn btn-info" href="<?php echo base_url(); ?>backend/edit-notification-template/<?php echo $notification_template['notification_template_id']; ?>" title="Edit Notification Template"> <i class="icon-edit icon-white"></i>Edit</a>
                                                <a class="btn btn-info" href="<?php echo base_url(); ?>backend/send-notification/<?php echo $notification_template['notification_template_id']; ?>" title="Send Notification"> <i class="icon-edit icon-white"></i>Send</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <th colspan=12>
                                                <?php if ($cnt > 0) { ?>
                                                <input type="submit" value="Delete Selected" onclick="return deleteConfirm();" class="btn btn-danger" name="btn_delete_all" id="btn_delete_all">
                                                <a href="<?php echo base_url(); ?>backend/notification-template/add"  class="btn btn-warning pull-right" name="btn_add_product" id="btn_add_product">Add Notification</a>
                                                <?php }else{ ?>
                                                <a href="<?php echo base_url(); ?>backend/notification-template/add"  class="btn btn-warning pull-right" name="btn_add_product" id="btn_add_product">Add Notification</a>
                                                <?php } ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php $this->load->view('backend/sections/footer'); ?>