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
                    <form name="frm_order_list" id="frm_order_list" action="<?php echo base_url(); ?>backend/logistics/TNT" method="post">
                        <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
                        <div class="box-body table-responsive">
                            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">									
                                <table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Username">Purchase ID</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name">Quantity</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Total price</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status" style=" width: 90px;">Shipped?</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status" style=" width: 90px;">Delivered?</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Status</th>
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Order date</th>                                                                     
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Shipping date</th>     
                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending" aria-label="Created on">Delivered date</th>                                                                     
                                            <th  role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Action">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($arr_order as $order) {
                                            $id = $order['order_uniq_id'] . '-' . $order['product_sku'] . '-' . $order['product_order_id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $order['qty']; ?></td>
                                                <td><?php echo number_format($order['total_price'], 2); ?></td>
                                                <td>
                                                    <?php if (($order['product_order_status'] == '2')) { ?>
                                                        <input type="checkbox" onClick="changeStatus('<?php echo $order['product_order_id']; ?>', 3);" data-on-text="No" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php } else if ($order['product_order_status'] == '3' || $order['product_order_status'] == '4') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php } else if ($order['product_order_status'] == '5') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                    <?php } else if ($order['product_order_status'] == '6') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php } else { ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="ship_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($order['product_order_status'] == '3') { ?>
                                                        <input type="checkbox" onClick="changeStatus('<?php echo $order['product_order_id']; ?>', 4);" data-on-text="No" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php } else if ($order['product_order_status'] == '2' || $order['product_order_status'] == '4') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php } else if ($order['product_order_status'] == '1' || $order['product_order_status'] == '2' || $order['product_order_status'] == '0') { ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                    <?php } else if ($order['product_order_status'] == '5') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status">
                                                    <?php } else if ($order['product_order_status'] == '6') {
                                                        ?>
                                                        <input type="checkbox" disabled="" data-on-text="Yes" data-off-text="Yes" id="delivered_status_<?php echo $order['product_order_id']; ?>" name="status" checked>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if ($order['product_order_status'] == '0') { ?>
                                                        <a class="label label-warning" title="Please view details" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Pending</a>
                                                    <?php } else if ($order['product_order_status'] == '1') { ?>
                                                        <a class="label label-warning" title="Please view details" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Waiting</a>
                                                    <?php } else if ($order['product_order_status'] == '2') { ?>
                                                        <a class="label label-success"  href="javascript:void(0);" id="status_<?php echo $order['order_id']; ?>">Ready For Pick Up</a>
                                                    <?php } else if ($order['product_order_status'] == '3') { ?>
                                                        <a class="label label-success" title="Click to Change Status" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Shipped</a>
                                                    <?php } else if ($order['product_order_status'] == '4') { ?>
                                                        <a class="label label-success" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Delivered</a>
                                                        <?php
                                                    } else if ($order['product_order_status'] == '5') {
                                                        if ($order['return_cancel_details']['cancel_return_status'] == '0') {
                                                            ?>
                                                            <a class="label label-warning" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Cancellation request</a>
                                                        <?php } else if ($order['return_cancel_details']['cancel_return_status'] == '1') { ?>
                                                            <a class="label label-primary" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Canceled</a>
                                                        <?php } ?>
                                                        <?php
                                                    } else if ($order['product_order_status'] == '6') {
                                                        if ($order['return_cancel_details']['cancel_return_status'] == '2') {
                                                            ?>
                                                            <a class="label label-warning" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Return Request</a>
                                                        <?php } else if ($order['return_cancel_details']['cancel_return_status'] == '3') { ?>
                                                            <a class="label label-primary" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Return Initiated</a>
                                                        <?php } else if ($order['return_cancel_details']['cancel_return_status'] == '4') { ?>
                                                            <a class="label label-success" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Return Accepted</a>
                                                        <?php } else if ($order['return_cancel_details']['cancel_return_status'] == '5') { ?>
                                                            <a class="label label-danger" title="Delivered" href="javascript:void(0);" id="status_<?php echo $order['product_order_id']; ?>">Return Rejected</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo date($global['date_format'], strtotime($order['order_date'])); ?></td>
                                                <td>
                                                    <?php
                                                    if ($order['order_dispatch_date'] != '0000-00-00 00:00:00') {
                                                        echo date($global['date_format'], strtotime($order['order_dispatch_date']));
                                                    } else {
                                                        echo "---";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($order['order_delivery_date'] != '0000-00-00 00:00:00') {
                                                        echo date($global['date_format'], strtotime($order['order_delivery_date']));
                                                    } else {
                                                        echo "---";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="worktd" colspan="1">
                                                    <a class="btn btn-primary" title="View Order Details" href="<?php echo base_url(); ?>backend/view-oreder-tnt/<?php echo base64_encode($order['product_order_id']); ?>"> <i class="icon-edit icon-white"></i>View</a>
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
        <link href="<?php echo base_url(); ?>media/backend/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/bootstrap-toggle.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/bootstrap-switch.js"></script>
        <script type="text/javascript">
                                                    $(document).ready(function() {
<?php
foreach ($arr_order as $order) {
    ?>
                                                            $("#ship_status_" +<?php echo $order['product_order_id']; ?>).bootstrapSwitch('state', false);
                                                            $("#delivered_status_" +<?php echo $order['product_order_id']; ?>).bootstrapSwitch('state', false);
                                                            $("#ship_status_" +<?php echo $order['product_order_id']; ?>).on('switchChange.bootstrapSwitch', function() {
                                                                $("#ship_status_" + <?php echo $order['product_order_id']; ?>).bootstrapSwitch('toggleDisabled', true, true);
                                                                changeStatus('<?php echo $order['product_order_id']; ?>', 3);
                                                            });
                                                            $("#delivered_status_" +<?php echo $order['product_order_id']; ?>).on('switchChange.bootstrapSwitch', function() {
                                                                $("#delivered_status_" + <?php echo $order['product_order_id']; ?>).bootstrapSwitch('toggleDisabled', true, true);
                                                                changeStatus('<?php echo $order['product_order_id']; ?>', 4);
                                                            });
<?php } ?>
                                                    });
                                                    function changeStatus(order_id, order_status)
                                                    {
                                                        /* changing the user status*/
                                                        var obj_params = new Object();
                                                        obj_params.order_id = order_id;
                                                        obj_params.order_status = order_status;
                                                        jQuery.post("<?php echo base_url(); ?>backend/logistics/change-status", obj_params, function(msg) {
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