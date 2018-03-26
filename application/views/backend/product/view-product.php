<?php // echo"<pre>";print_r($product_detail[0]);die;?>
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
            <li><a href="<?php echo base_url(); ?>backend/products"><i class="fa fa-fw fa-user"></i> Manage Product</a></li>
            <li class="active">View Product</li>
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
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
<!--                                <tr>
                                    <th style="width:50%">Product Sku :</th>
                                    <td><?php echo $product_detail[0]['product_sku']; ?> </td>
                                </tr>-->
                                <tr>
                                    <th style="width:50%">Product Name :</th>
                                    <td><?php echo ucfirst($product_detail[0]['product_name']); ?> </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Store Name :</th>
                                    <td><?php echo (ucfirst($product_detail[0]['store_name']))?ucfirst($product_detail[0]['store_name']):'No store'; ?> </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Category Name :</th>
                                    <td><?php echo $product_detail[0]['category_name']; ?> </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Product Description :</th>
                                    <td><?php echo $product_detail[0]['product_description']; ?> </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Product Size :</th>
                                    <td><?php echo ($product_detail[0]['size'] != '')?$product_detail[0]['size']:"---"; ?> </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Is Best Selling Product :</th>
                                    <td>
                                        <?php echo ($product_detail[0]['best_selling'] == '0') ? 'No' : 'Yes'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Product Quantity :</th>
                                    <td><?php echo $product_detail[0]['quantity']; ?> </td>
                                </tr>
<!--                                <tr>
                                    <th style="width:50%">1 Carat Price For Customer:</th>
                                    <td><?php echo stripslashes(isset($product_detail[0]['orignal_amount'])) ? $product_detail[0]['orignal_amount'] : ''; ?></td>
                                </tr>     
                                <tr>
                                    <th style="width:50%">1 Carat Price For whole seller:</th>
                                    <td><?php echo stripslashes(isset($product_detail[0]['orignal_amount_w'])) ? $product_detail[0]['orignal_amount_w'] : ''; ?></td>
                                </tr>     -->
                                <tr>
                                    <th style="width:50%">Width(in mm):</th>
                                    <td><?php echo stripslashes(isset($product_detail[0]['p_width'])) ? $product_detail[0]['p_width'] : ''; ?></td>
                                </tr>     
                                <tr>
                                    <th style="width:50%">Height(in mm):</th>
                                    <td><?php echo stripslashes(isset($product_detail[0]['p_height'])) ? $product_detail[0]['p_height'] : ''; ?></td>
                                </tr>     
                                 
                                <tr>
                                    <th style="width:50%">Product Images :</th>
                                    <td>
                                        <div class="row col-md-12 col-sm-12 col-xs-12 "> 
                                            <?php
                                            if (isset($product_img) && count($product_img)) {
                                                foreach ($product_img as $image) {
                                                    ?>
                                                    <div class="col-md-4 col-sm-4 colxs-12 prd_img">
                                                        <img src="<?php echo base_url(); ?>media/front/img/product-img/<?php echo $image['image_name']; ?>" height="200%" width="200%" />
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "---";
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php $this->load->view('backend/sections/footer'); ?>
    <link href="<?php echo base_url(); ?>media/front/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>media/front/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>media/front/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/js/docs.js"></script>
    <script src="<?php echo base_url(); ?>media/front/js/colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>media/front/js/colorpicker-color.js"></script>
    <script src="<?php echo base_url(); ?>media/backend/js/custome/edit-product.js"></script>
    <script type="text/javascript">
<?php
if ($product_detail[0]['product_color'] != '') {
    if (isset($arr_clr) && count($arr_clr) > 0) {
        foreach ($arr_clr as $key => $color) {
            ?>
                    $('.demo-with-options_<?php echo $key; ?>').colorpicker({
                        color: '<?php echo $color; ?>',
                        format: 'hex'
                    });
            <?php
        }
    }
}
?>
    </script>