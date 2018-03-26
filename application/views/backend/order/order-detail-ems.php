<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            <?php echo (isset($title) ? ucfirst($title) : ''); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/logistics/EMS"><i class="fa fa-fw fa-legal"></i> Logistic Management EMS</a></li>
            <li class="active">View Order</li>
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
                <div class="box box-primary">
                    <div class="panel-body">
                        <?php
                        $ship_mode = '';
                        foreach ($order_detail as $detail) {
                            $ship_mode = $detail['ship_mode'];
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="parametername" class="control-label">Product name : </label>
                                    <?php echo $detail['product_name']; ?>                                
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Buyer name : </label>
                                    <?php echo ucfirst($detail['first_name'] . ' ' . $detail['last_name']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Buyer Contact No : </label>
                                    <?php echo $detail['ship_phone_no'] ? $detail['ship_phone_no'] : '---'; ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Seller name : </label>
                                    <?php echo ucfirst($detail['seller_first_name'] . ' ' . $detail['seller_last_name']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Seller Contact No : </label>
                                    <?php echo $detail['phone_no'] ? $detail['phone_no'] : '---'; ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Quantity : </label>
                                    <?php echo $detail['qty']; ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Weight Of Product : </label>
                                    <?php echo $detail['order_weight'] . ' Kg'; ?>
                                </div>
                                <?php if ($detail['order_color'] != '') { ?>    
                                    <label for="parametername">Color: </label>
                                    <i class="fa fa-square" style="color: <?php echo $detail['order_color']; ?>"></i>
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="parametername">Specification : </label>
                                    <?php echo stripslashes($detail['specification']); ?>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="parametername">Price : </label>
                                    &#8358 <?php echo number_format($detail['total_price'], 2); ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Shipping Charges : </label>
                                    <?php if ($detail['shipping_charges'] > 0) { ?>
                                        &#8358 <?php
                                        echo number_format($detail['shipping_charges'], 2);
                                    } else if ($detail['shipping_charges'] == 0) {
                                        echo "Free";
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">status : </label>
                                    <?php
                                    if ($detail['product_order_status'] == 0) {
                                        echo "Waiting";
                                    } else if ($detail['product_order_status'] == 1) {
                                        echo "Checkout";
                                    } else if ($detail['product_order_status'] == 2) {
                                        echo "Ready For Pick Up";
                                    } else if ($detail['product_order_status'] == 3) {
                                        echo "Shipped";
                                    } else if ($detail['product_order_status'] == 4) {
                                        echo "Delivered";
                                    } else if ($detail['product_order_status'] == 5) {
                                        echo "Cancelltaion";
                                    } else if ($detail['product_order_status'] == 6) {
                                        echo "Return";
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Shipping Address : </label>
                                    <?php if ($detail['ship_address_line_1'] != '') { ?>
                                        <?php
                                        echo stripslashes($detail['ship_address_line_2']) . '<br>' . stripslashes($detail['ship_address_line_1']);
                                    } else {
                                        echo "---";
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Product Address : </label>
                                    <?php if ($detail['product_location'] != '') { ?>
                                        <?php
                                        echo stripslashes($detail['location_line_2']) . '<br>' . stripslashes($detail['product_location']);
                                    } else {
                                        echo "---";
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php if ($detail['product_order_status'] == 0) { ?>
                                <div class="form-group">
                                    <div id="shipped_div"  <?php if ($user['order_status'] == '0') { ?> <?php } else { ?> <?php } ?>>
                                        <a class="btn btn-success" title="Click to Change Status" onClick="changeStatus('<?php echo $detail['order_id']; ?>', '<?php echo $detail['product_order_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $detail['product_order_id']; ?>">Checkout</a>
                                    </div>
                                </div>
                            <?php } ?>
                            <hr>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php $this->load->view('backend/sections/footer'); ?>
    <script type="text/javascript">
        function changeStatus(order_id, id, status) {
            $.ajax({
                url: "<?php echo base_url(); ?>backend/change-order-status", //The url where the server req would we made.                 async: false,
                type: "POST", //The type which you want to use: GET/POST
                data: {
                    'order_id': order_id,
                    'product_order_id': id,
                    'status': status
                }, //The variables which are going.
                dataType: "html", //Return data type (what we expect).
                success: function(response) {
                    if (response == "truedone") {
                        window.location.replace("<?php echo base_url(); ?>backend/logistics/EMS");
                    } else if (response == "true") {
                        location.href = location.href;
                    }
                }
            });
        }
    </script>