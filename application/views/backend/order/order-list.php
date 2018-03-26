<?php // echo "<pre>";
//print_r($arr_order);die; ?>
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
            <li class="active"><i class="fa fa-fw fa-legal"></i> <?php echo (isset($title) ? ucfirst($title) : ''); ?></li>
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
                    <form name="frm_order_list" id="frm_order_list" action="<?php echo base_url(); ?>backend/orders/list" method="post">
                        <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
                        <div class="box-body table-responsive">
                            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Username">Order ID</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name">Quantity</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Total price</th>
<!--                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status" style=" width: 90px;">Shipped?</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status" style=" width: 90px;">Delivered?</th>-->
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Status</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Order date</th>                                                                     
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Dispatched date</th>     
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Delivered date</th>                                                                     
                                            <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Action">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($arr_order as $order) {
                                            $id = $order['order_uniq_id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $order['total_qty']; ?></td>
                                                <td><?php echo number_format($order['total_amount'], 2); ?></td>
    <!--                                                <td>
                                                <?php if (($order['product_order_status'] == '2')) { ?>
                                                            <input type="checkbox" onClick="changeStatus('<?php echo $order['product_Order_id']; ?>', 3);" data-on-text="No" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                <?php } else if ($order['product_order_status'] == '3' || $order['product_order_status'] == '4') {
                                                    ?>
                                                            <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                <?php }
                                                ?>
                                                </td>-->
    <!--                                                <td>
                                                <?php if ($order['order_status'] == '0') { ?>
                                                            <input type="checkbox" onClick="changeStatus('<?php echo $order['Order_id']; ?>', 1);" data-on-text="No" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                <?php } else if ($order['order_status'] == '2' || $order['product_order_status'] == '4') {
                                                    ?>
                                                            <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                <?php } else if ($order['order_status'] == '1' || $order['product_order_status'] == '2' || $order['product_order_status'] == '0') { ?>
                                                            <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                <?php } else if ($order['order_status'] == '5') {
                                                    ?>
                                                            <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                <?php } else if ($order['order_status'] == '6') {
                                                    ?>
                                                            <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                <?php }
                                                ?>
                                                </td>-->
                                                <td>
                                                    <?php if ($order['order_status'] != '3') { ?>
                                                    <select id="order_status<?php echo $order['Order_id']; ?>" onchange="changeStatus(this.value,'<?php echo $order['Order_id']; ?>')">
                                                            <option value="0" <?php if ($order['order_status'] == '0') { ?> <?php echo "selected";
                                                } ?>>Placed</option>
                                                            <option value="1"<?php if ($order['order_status'] == '1') { ?> <?php echo "selected";
                                                } ?>>Dispatched</option>
                                                            <option value="2" <?php if ($order['order_status'] == '2') { ?> <?php echo "selected";
                                            } ?>>Delivered</option>
                                                        </select>
    <?php } else { ?>
                                                        <label class="label-danger" >Canceled</label>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo date($global['date_format'], strtotime($order['order_date'])); ?></td>
                                                <td>
                                                    <?php
                                                    if ($order['dispatched_date'] != '0000-00-00 00:00:00') {
                                                        echo date($global['date_format'], strtotime($order['dispatched_date']));
                                                    } else {
                                                        echo "---";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($order['delivered_date'] != '0000-00-00 00:00:00') {
                                                        echo date($global['date_format'], strtotime($order['delivered_date']));
                                                    } else {
                                                        echo "---";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="worktd" colspan="1">
                                                    <a class="btn btn-primary" title="View Order Details" href="<?php echo base_url(); ?>backend/orders/view-oreder-products/<?php echo base64_encode($order['Order_id']); ?>"> <i class="icon-edit icon-white"></i>View</a>
                                                </td>
    <?php
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
<?php $this->load->view('backend/sections/footer'); ?>
        <script type="text/javascript">

            function changeStatus(order_status,order_id )
            {
//                alert(order_status+order_id);
                /* changing the user status*/
                var obj_params = new Object();
                obj_params.order_id = order_id;
                obj_params.order_status = order_status;
                jQuery.post("<?php echo base_url(); ?>backend/orders/change-status", obj_params, function (msg) {
                    if (msg.error == "1")
                    {
                        alert(msg.error_message);
                    }
                    else
                    {
                        location.href = location.href;
                    }
                }, "json");

            }
        </script>		