<?php $this->load->view('backend/sections/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/backend/css/jquery-ui.min.css"/>
<link href="<?php echo base_url(); ?>media/front/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <style>
        div.show-image {
    position: relative;
    float:left;
    margin:5px;
}
div.show-image:hover img{
    opacity:0.5;
}
div.show-image:hover input {
    display: block;
}
div.show-image input {
    position:absolute;
    display:none;
}
div.show-image input.update {
    top:0;
    left:0;
}
div.show-image input.delete {
    top:0;
    left:73%;
}
    </style>
    <section class="content-header">
        <h1>
            Update Product </li>    
        </h1>            
        <ol class="breadcrumb">
            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/products"><i class="fa fa-fw fa-retweet"></i> Manage  Product</a></li>
            <li class="active">Update Product</li>
        </ol>
    </section>

    <section class="content">
        <form name="frm_edit_product" id="frm_edit_product" action="<?php echo base_url(); ?>backend/edit-product/<?php echo (base64_encode($product_information[0]['product_id'])); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="parametername">Product Name<sup class="mandatory">*</sup></label>
                                    <input type="text" autofocus  class="form-control" id="product_name" name="product_name" value="<?php echo stripslashes(isset($product_information[0]['product_name'])) ? $product_information[0]['product_name'] : ''; ?>"   />
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Category<sup class="mandatory">*</sup></label>
                                    <select class="form-control" id="parent_cat" name="parent_cat" disabled="">
                                        <option value="">-Select Category-</option>
                                        <?php
                                        if (isset($all_categories) && count($all_categories) > 0) {
                                            foreach ($all_categories as $paret_cat) {
                                                if ($product_information[0]['category_id'] != '' && $product_information[0]['category_id'] == $paret_cat['category_id']) {
                                                    $checked = 'selected="selected"';
                                                } else {
                                                    $checked = "";
                                                }
                                                ?>
                                                <option value="<?php echo $paret_cat['category_id']; ?>" <?php echo $checked; ?>>
                                                    <?php echo $paret_cat['category_name']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" class="form-control" placeholder="Size" id="size" name="size" value="<?php echo stripslashes(isset($product_information[0]['size'])) ? $product_information[0]['size'] : ''; ?>">
                                </div>
                                <div class="form-group" >
                                    <label >Product Code<sup class="mandatory">*</sup></label>
                                    <input type="text" class="form-control" placeholder="Product Code" id="p_code" name="p_code" value="<?php echo stripslashes(isset($product_information[0]['p_code'])) ? $product_information[0]['p_code'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Product Description<sup class="mandatory">*</sup></label>
                                    <textarea type="text" autofocus  class="form-control" id="product_desc" name="product_desc"><?php echo stripslashes(isset($product_information[0]['product_description'])) ? $product_information[0]['product_description'] : ''; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="parametername">Is Best Selling Product</label>
                                    <input type="radio" value="0" class="form-control" id="best_selling" name="best_selling" <?php echo ($product_information[0]['best_selling'] == '0') ? 'checked=""' : ''; ?>    />No
                                    <input type="radio" value="1" class="form-control" id="best_selling" name="best_selling" <?php echo ($product_information[0]['best_selling'] == '1') ? 'checked=""' : ''; ?>    />Yes
                                </div>
                                <div class="form-group">
                                    <label  for="parametername">Instock Quantity & Availability <span class="mandatory">*</span></label>
                                        <input type="text" value="<?php echo $product_information[0]['quantity'] ?>" class="form-control" id="product_qnt" name="product_qnt" autofocus="autofocus" placeholder="Product Quantity">                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">
                                <!--                                <div class="form-group">
                                                                    <label for="parametername">1 Carat Price For Customer<sup class="mandatory">*</sup></label>
                                                                    <input type="text" autofocus  class="form-control" id="product_price" name="product_price" value="<?php echo stripslashes(isset($product_information[0]['orignal_amount'])) ? $product_information[0]['orignal_amount'] : ''; ?>"   />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="parametername">1 Carat Price For Whole seller<sup class="mandatory">*</sup></label>
                                                                    <input type="text" autofocus  class="form-control" id="product_price_w" name="product_price_w" value="<?php echo stripslashes(isset($product_information[0]['orignal_amount_w'])) ? $product_information[0]['orignal_amount_w'] : ''; ?>"   />
                                                                </div>-->
                                <div class="form-group">
                                    <label for="parametername">Product Quantity<sup class="mandatory">*</sup></label>
                                    <input type="text" autofocus  class="form-control" id="quantity" name="quantity" value="<?php echo stripslashes(isset($product_information[0]['quantity'])) ? $product_information[0]['quantity'] : ''; ?>"   />
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Images<span class="mandatory">*</span>
                                    </label>
                                    <input type="file" dir="ltr"  class="FETextInput" name="product_img[]" id="product_img" multiple="multiple" />
                                    <div for="product_img" id="error_file_size" generated="true" class="text-danger" style="display:none">Please upload only 6 images.</div>
                                    <?php
                                        if(count($product_images)) {
                                        foreach($product_images as $val) { ?>
                                            <div class="show-image">
                                    <img src="<?php echo base_url()?>media/front/img/product-img/<?php echo $val['image_name'] ?>" height="200" width="200">
                                    <input class="delete" onclick="deleteFun('<?php echo $val['product_img_id'] ?>')" type="button" value="delete" />
                                </div>
                                        <?php }} ?> 
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Height(in mm)<span class="mandatory">*</span>
                                    </label>
                                    <input type="text" name="p_height" id="p_height" placeholder="Height" class="form-control" value="<?php echo stripslashes(isset($product_information[0]['p_height'])) ? $product_information[0]['p_height'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Width(in mm)<span class="mandatory">*</span>
                                    </label>
                                    <input type="text" name="p_width" value="<?php echo stripslashes(isset($product_information[0]['p_width'])) ? $product_information[0]['p_width'] : ''; ?>" name="d_weight" id="p_width" placeholder="width" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Product Weight(in grams)<span class="mandatory">*</span>
                                    </label>
                                    <input type="text" value="<?php echo stripslashes(isset($product_information[0]['p_weight'])) ? $product_information[0]['p_weight'] : ''; ?>" name="p_weight" id="p_weight" placeholder="Product Weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parametername">Select Status <sup class="mandatory">*</sup></label>
                                    <select name="product_status" id="product_status" class="form-control">
                                        <option value="1"<?php echo ($product_information[0]['product_status'] == '1') ? 'selected=selected' : ''; ?> >Active</option>
                                        <option value="0"<?php echo ($product_information[0]['product_status'] == '0') ? 'selected=selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <center><h3>Diamond Details </h3></center>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="parametername">Total Weight(in Ct)</label>
                                    <input type="text" class="form-control" id="d_weight" value="<?php echo stripslashes(isset($product_information[0]['d_weight'])) ? $product_information[0]['d_weight'] : ''; ?>" name="d_weight" autofocus="autofocus" placeholder="Total weight in Ct">                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="parametername">Total No. of Diamonds</label>
                                    <input type="text" class="form-control" id="tot_diamonds" name="tot_diamonds"  value="<?php echo stripslashes(isset($product_information[0]['tot_diamonds'])) ? $product_information[0]['tot_diamonds'] : ''; ?>" >                                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center><h3>Metal Details </h3></center>
                    <div class="col-md-12">

                        <div class="col-md-6">
                            <div class="box ">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="parametername">Type</label>
                                        <input type="text" class="form-control" id="metal_type" value="<?php echo stripslashes(isset($product_information[0]['metal_type'])) ? $product_information[0]['metal_type'] : ''; ?>" name="metal_type" autofocus="autofocus" placeholder="Metal Type">                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box ">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="parametername">Weight(in grams)</label>
                                        <input type="text" class="form-control" id="metal_weight" value="<?php echo stripslashes(isset($product_information[0]['metal_weight'])) ? $product_information[0]['metal_weight'] : ''; ?>" name="metal_weight" autofocus="autofocus" placeholder="Metal weight">                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body" >
                                <div class="form-group" >
                                    <div class="text-center">
                                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                                        <button type="submit" name="btn_add" id="btn_add" class="btn btn-success">Update Product</button> 
                                        <a href="<?php echo base_url(); ?>backend/products" name="btn_cancel" id="btn_cancel" class="btn btn-success">Cancel</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php $this->load->view('backend/sections/footer.php'); ?>  
        <script type="text/javascript">
<?php
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
?>
    
            function deleteFun(id) {
                if (confirm("Are you sure you want to delete image?"))
                {
                    $.ajax(
                            {
                                type: "POST",
                                url: "<?php echo base_url(); ?>backend-delete-image",
                                data: {
                                    'product_id': id
                                },
                                success: function (data)
                                {
                                    alert('Image Deleted Sucessfully')
                                    location.href = location.href;
                                }
                            });
                }
            }

            $(document).ready(function () {
                $("#frm_edit_product").validate({
                    errorElement: "div",
                    rules: {
                        product_name: {
                            required: true
                        },
                        parent_cat: {
                            required: true
                        },
                        product_price_w: {
                            required: true,
                            number: true
                        },
                        size: {
                            required: true
                        },
                        'p_height': {
                            //                       required: true,
                            //                        number: true
                        },
                        product_desc: {
                            required: true
                        },
                        product_qnt: {
                            required: true,
                            number: true
                        },
                        'product_img': {
                            required: true
                        },
                        p_weight: {
                            required: true,
                            number: true
                        },
                        product_price: {
                            required: true,
                            number: true
                        },
                        p_width: {
                            //                         required: true,
                            //                        number: true
                        },
                        d_weight: {
                            //                    required: true,
                            //                    number: true
                        },
                        tot_diamonds: {
                            //                      required: true,
                            //                     number: true
                        },
                        metal_type: {
                            //                         required: true,
//                            number: true
                        },
                        metal_weight: {
                            //                        required: true,
//                            number: true
                        },
                        p_code: {
                            required: true
                        }
                    },
                    messages: {
                        product_name: {
                            required: "Please enter product name."
                        },
                        parent_cat: {
                            required: "Please select product category."
                        },
                        size: {
                            required: "Please enter product size(s)."
                        },
                        product_desc: {
                            required: "Please enter product Description."
                        },
                        p_height: {
                            required: "Please enter product height."
                        },
                        product_qnt: {
                            required: "Please enter product quantity.",
                            number: "Please enter valid quantity."
                        },
                        product_img: {
                            required: "Please select product image."
                        },
                        product_price: {
                            required: "Please enter product price.",
                            number: "Please enter valid product price."
                        },
                        product_price_w: {
                            required: "Please enter product price.",
                            number: "Please enter valid product price."
                        },
                        p_width: {
                            required: "Please enter product width."
                        },
                        p_weight: {
                            required: "Please enter product weight."
                        },
                        d_weight: {
                            required: "Please enter diamond weight."
                        },
                        tot_diamonds: {
                            required: "Please enter total diamonds."
                        },
                        metal_type: {
                            required: "Please enter metal type."
                        },
                        metal_weight: {
                            required: "Please enter metal weight."
                        },
                        p_code: {
                            required: "Please enter product code."
                        }
                    },
                    submitHandler: function (form) {
                        $("#btn_add").hide();
                        $("#loding_image").show();
                        form.submit();
                    }
                });
            });
        </script>