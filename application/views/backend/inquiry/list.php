<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Inquiry Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Manage  Inquiry</li>

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
                        <form name="frm_city" id="frm_city" action="<?php echo base_url(); ?>backend/inquiries/list" method="post">
                            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th> <center>
                                        Select <br>
                                        <?php
                                        if (count($arr_inquiry) > 1) {
                                            ?>
                                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
                                        <?php } ?>
                                    </center>
                                    </th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Country Name">Name</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="State Name">Email_id</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="State Name">Product_name</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="State Name">Quantity</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="State Name">Inquiry Date</th>
                                    <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Action">Action</th>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $cnt = 0;
                                        if (!empty($arr_inquiry)) {
                                            foreach ($arr_inquiry as $key => $value) {
                                                $cnt++;
                                                $inquiry_id = $value['enquiry_id'];
                                                $name = $value['name'];
                                                $email_id = $value['email_id'];
                                                $mobile_no = $value['mobile_no'];
                                                $product_name = $value['product_name'];
                                                $quantity = $value['quantity'];
                                                $comment = $value['comment'];
                                                $enquiry_date = $value['enquiry_date'];
                                                ?>

                                                <tr>
                                                    <td >
                                            <center>
                                                <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $inquiry_id; ?>" />
                                            </center>

                                            </center></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $email_id; ?></td>
                                            <td><?php echo $product_name; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td><?php echo $enquiry_date; ?></td>
                                            <td><a href="<?php echo base_url() ?>backend/inquiry/view/<?php echo $inquiry_id; ?>" class="btn btn-info" >view</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                    
                                    <tfoot>

                                    <th colspan="6"><input type="submit" onclick="return deleteConfirm();" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" value="Delete Selected">
                                    </th>

                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php $this->load->view('backend/sections/footer.php'); ?>