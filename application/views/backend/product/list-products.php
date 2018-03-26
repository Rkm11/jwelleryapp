<?php // echo "<pre>";print_r($arr_product_open);die;  ?>
<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Product Management
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-fw fa-retweet"></i> Manage  Product</li>

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
            <?php
        }
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive" style=" width: 100%;">
                        <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                            <form name="frmstorefront" id="frmstorefront" action="<?php echo base_url(); ?>backend/products" method="post">								
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th> <center>
                                        Select <br>
                                        <?php
                                        if (count($arr_product_open) > 1) {
                                            ?>
                                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
                                        <?php } ?>
                                    </center></th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Store">Product Name</th>                                    
                                    <!--<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">StoreName</th>-->
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Category</th>
                                    <!--<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Sub-Category</th>-->
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Status</th>
<!--                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Customer Price</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Whole seller Price</th>-->
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User name">Quantity</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Image">Added date</th>
                                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Image">Updated date</th>
                                    <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Action">Action</th>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $cnt = 0;
                                        foreach ($arr_product_open as $product) {
                                            if ($product['quantity'] <= 0) {
                                                $product_status = 2;
                                            } else {
                                                $product_status = 0;
                                            }
                                            $cnt++;
                                            ?>
                                            <tr>
                                                <td ><center>
                                            <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $product['product_id']; ?>" />
                                        </center></td>
                                        <td ><?php echo stripslashes($product['product_name']); ?></td>                                         
                                        <!--<td><?php echo stripslashes($product['store_name']); ?></td>-->
                                        <td><?php echo stripslashes($product['category_name']); ?></td>
                                        <!--<td><?php echo stripslashes($product['sub_category_name']); ?></td>-->
                                        <td>
                                            <?php if ($product_status == "2") { ?>
                                                <div id="lock_div<?php echo $product['product_id']; ?>" style="display:inline-block" >
                                                    <a class="label label-warning" href="javascript:void(0);" id="status_<?php echo $product['product_id']; ?>">Out Of Stock</a>
                                                </div>
                                            <?php } else { ?>
                                                <div id="active_div<?php echo $product['product_id']; ?>"  <?php if ($product['product_status'] == '0') { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                                    <a class="label label-danger" title="Click to Change Status" onClick="changeStatus('<?php echo $product['product_id']; ?>', '1');" href="javascript:void(0);" id="status_<?php echo $product['product_id']; ?>">Unavailable</a>
                                                </div>
                                                <div id="blocked_div<?php echo $product['product_id']; ?>" <?php if ($product['product_status'] == '1') { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                                    <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $product['product_id']; ?>', '<?php echo '0'; ?>');" href="javascript:void(0);" id="status_<?php echo $product['product_id']; ?>">Available</a>
                                                </div>
                                            <?php } ?>

                                        </td>
<!--                                        <td><?php echo number_format($product['orignal_amount'], 2); ?></td>
                                        <td><?php echo number_format($product['orignal_amount_w'], 2); ?></td>-->
                                        <td><?php echo $product['quantity']; ?></td>

                                        <td><?php echo date($global['date_format'], strtotime($product['created_at'])); ?></td>
                                        <td><?php
                                            if ($product['updated_at'] == '0000-00-00 00:00:00') {
                                                echo "---";
                                            } else {
                                                echo date($global['date_format'], strtotime($product['updated_at']));
                                            }
                                            ?></td>
                                        <td class=""><a class="btn btn-info" href="<?php echo base_url(); ?>backend/edit-product/<?php echo base64_encode($product['product_id']); ?>"> <i class="icon-edit icon-white"></i>Edit</a>
                                            <!--<a class="btn btn-info" href="<?php echo base_url(); ?>backend/view-product/<?php echo base64_encode($product['product_id']); ?>"> <i class="icon-edit icon-white"></i>View</a></td>-->
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan=12>
                                                <?php if ($cnt > 0) { ?>
                                                <input type="submit" value="Delete Selected" onclick="return deleteConfirm();" class="btn btn-danger" name="btn_delete_all" id="btn_delete_all">
                                                <a href="<?php echo base_url(); ?>backend/product/add-product"  class="btn btn-warning pull-right" name="btn_add_product" id="btn_add_product">Add Product</a>
                                                <?php }else{ ?>
                                                <a href="<?php echo base_url(); ?>backend/product/add-product"  class="btn btn-warning pull-right" name="btn_add_product" id="btn_add_product">Add Product</a>
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
        <?php $this->load->view('backend/sections/footer.php'); ?>
        </div>
        <style>
            table.dataTable {
                width: 1077px;
            }
        </style>
        <script>
            function changeStatus(product_id, product_status)
            {
                var obj_params = new Object();
                obj_params.product_id = product_id;
                obj_params.product_status = product_status;
                jQuery.post("<?php echo base_url(); ?>backend/change-status-product", obj_params, function (msg) {
                    if (msg.error == "1")
                    {
                        alert(msg.error_message);
                    }
                    else
                    {
                        if (product_status == '2')
                        {
                            $("#blocked_div" + product_id).css('display', 'inline-block');
                            $("#active_div" + product_id).css('display', 'none');
                        }
                        else
                        {
                            $("#active_div" + product_id).css('display', 'inline-block');
                            $("#blocked_div" + product_id).css('display', 'none');
                        }

                    }
                    location.href = location.href;
                }, "json");

            }
        </script>
        </body>
        </html>