<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">

        <h1>
            View Details    
        </h1>            
        <ol class="breadcrumb">

            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/inquiry/list"><i class="fa fa-fw fa-home"></i> Manage Inquiry</a></li>
            <li>View Details</li>

        </ol>
    </section>
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
            $product_code= $value['p_code'];
        }
    }
            ?>
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Name:</th>
                                        <td><?php echo $name; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Email Id:</th>
                                        <td><?php echo $email_id; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Mobile No:</th>
                                        <td><?php echo $mobile_no; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Product Name:</th>
                                        <td><?php echo $product_name; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Product Code:</th>
                                        <td><?php echo $product_code; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Quantity:</th>
                                        <td><?php echo $quantity; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Enquiry/Comment:</th>
                                        <td><?php echo $comment; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Enquiry Date:</th>
                                        <td><?php echo $enquiry_date; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                </div>
                </div>
                </div>
                <?php $this->load->view('backend/sections/footer.php'); ?>