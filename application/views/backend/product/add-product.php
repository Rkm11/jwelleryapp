<?php
ini_set('post_max_size', '100M');
ini_set('max_file_uploads', '10000');
ini_set('max_input_time', '6000');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/datepicker/jquery-ui.css">
<link href="<?php echo base_url(); ?>media/front/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<?php
// messages handelling
if (($this->session->userdata('msg')) && $this->session->userdata('msg') != "") {
    $msg = $this->session->userdata('msg');
    $this->session->unset_userdata('msg');
}
$session['post'] = $this->session->userdata('post');
?>
<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Add Product
        </h1> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/products"><i class="fa fa-fw fa-list"></i> Manage Product</a></li>
            <li class="active">Add Product</li>

        </ol>
    </section>
    <section class="content">
        <form id="frm_add_products" name="frm_add_products" method="post" action="<?php echo base_url(); ?>backend/product/add-product" class="bs-example form-horizontal" enctype="multipart/form-data">
            <div class="row" >
                <div class="col-md-12">
                    <div class="col-md-6" >                    
                        <div class="box box-primary">
                            <div class="box-body" >

                                <div class="form-group">
                                    <label for="Title" class="col-md-4 col-sm-4 col-xs-12 control-label"> Product Name<sup class="mandatory">*</sup></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                        <input type="text" placeholder="Product Name" id="product_name" class="form-control" name="product_name"  />
                                    </div>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label for="Title" class="col-md-4 col-sm-4 col-xs-12 control-label"> Select Store<sup class="mandatory">*</sup> </label>
                                                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                                                        <select id="store_id" name="store_id" dir="ltr"  class="form-control"  >
                                                                            <option value="">--Select--</option>
                                                                            <option value="0">No Store </option>
                                <?php
                                foreach ($arr_stores as $key => $value) {
                                    echo '<option value="' . $value['store_id'] . '" ' . $str . '>' . $value['store_name'] . '</option>';
                                }
                                ?>
                                                                        </select>
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label for="Title" class="col-md-4 col-sm-4 col-xs-12 control-label"> Select Category<sup class="mandatory">*</sup> </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                        <select id="parent_cat" name="parent_cat" dir="ltr"  class="form-control"  >
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach ($all_category as $key => $value) {
                                                echo '<option value="' . $value['category_id'] . '" ' . $str . '>' . $value['category_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label for="Title" class="col-md-4 col-sm-4 col-xs-12 control-label"> Select Sub Category <sup class="mandatory">*</sup></label>
                                                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                                                        <select name="sub_cat" id="sub_cat" dir="ltr" class="form-control"  >
                                                                            <option value="">--Select--</option>
                                <?php
                                foreach ($arr_sub_category as $key => $value) {
                                    echo '<option value="' . $value['category_id'] . '" ' . $str . '>' . $value['category_name'] . '</option>';
                                }
                                ?>
                                                                        </select>
                                                                    </div>
                                
                                                                </div>-->
                                <div class="form-group" >
                                    <label class="col-md-4 col-sm-4 col-xs-12 control-label">Size<sup class="mandatory">*</sup>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                        <input type="text" class="form-control" placeholder="Size" id="size" name="size">
                                        (for multiple size entries separate each with commas e.g 32,34/XL,M)
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="col-md-4 col-sm-4 col-xs-12 control-label">Product Code<sup class="mandatory">*</sup>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 space">
                                        <input type="text" class="form-control" placeholder="Product Code" id="p_code" name="p_code">
                                    </div>
                                </div>
                                <!--                                <div class="form-group" >
                                                                    <label class="col-md-4 col-sm-4 col-xs-12 control-label">Color<sup class="mandatory">*</sup></label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                                        <div class="input-group demo-with-options_0">
                                                                            <input type="text" value="" class="form-control" placeholder="Color" id="color_0" name="color[0]" />
                                                                            <span class="input-group-addon"><i title="select color" class="fa fa-hand-o-up color"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2 col-xs-3 media-right2">
                                                                        <a href="javascript:void(0)" title="add more Color" class="btn btn-success" id="add_new_color"><i class="fa fa-plus"></i></a>
                                                                    </div>
                                                                    <div class="" id="more_color">
                                                                    </div>
                                                                </div>-->

                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12 control-label">Product Description <span class="mandatory">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea type="text" class="form-control" id="product_desc" name="product_desc" autofocus="autofocus" placeholder="Product Description"></textarea>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12 control-label">Instock Quantity & Availability <span class="mandatory">*</span></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class="form-control" id="product_qnt" name="product_qnt" autofocus="autofocus" placeholder="Product Quantity">                                            
                                    </div>
                                </div>
                            </div>
                            <!--[sortable body]--> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary" >
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Product Images <span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="file" name="product_img[]" id="product_img" placeholder="Store Image"  multiple="multiple" >
                                    (Press ctrl-button to select multiple images.)
                                    <div for="product_img" id="error_file_size" generated="true" class="text-danger" style="display:none">Please upload only 6 images.</div>                                        
                                </div>
                            </div>
                            <!--                        <div class="form-group">
                                                        <label class="col-md-4 col-sm-4 col-xs-12 control-label">Discount(%)<span class="mandatory">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <input type="text" name="discount" id="discount" placeholder="Discount(%)" class="form-control" >
                                                        </div>
                                                    </div>-->
<!--                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">1 Carat Price For Customer<span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="product_price" id="product_price" placeholder="1 Carat Price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">1 Carat Price For Whole seller<span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="product_price_w" id="product_price_w" placeholder="1 Carat Price" class="form-control">
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Height(in mm)<span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="p_height" id="p_height" placeholder="Height" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Width(in mm)<span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="p_width" id="p_width" placeholder="width" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Product Weight(in grams)<span class="mandatory">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="p_weight" id="p_weight" placeholder="Product Weight" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Select Status <sup class="mandatory">*</sup></label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <select name="select_status" id="select_status" class="form-control">
                                        <option value="0" >Active</option>
                                        <option value="1">Inactive</option>
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
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Total Weight(in Ct)</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="d_weight" name="d_weight" autofocus="autofocus" placeholder="Total weight in Ct">                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Total No. of Diamonds</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="tot_diamonds" name="tot_diamonds" autofocus="autofocus" placeholder="Total diamonds">                                            
                                </div>
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
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Type</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="metal_type" name="metal_type" autofocus="autofocus" placeholder="Metal Type">                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-4 col-sm-4 col-xs-12 control-label">Weight(in grams)</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="metal_weight" name="metal_weight" autofocus="autofocus" placeholder="Metal weight">                                            
                                </div>
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
                                    <button type="submit" name="btn_add" id="btn_add" class="btn btn-success">Post Product</button> 
                                    <a href="<?php echo base_url(); ?>backend/products" name="btn_cancel" id="btn_cancel" class="btn btn-success">Cancel</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--/#content.span10-->
        </div>
        <!--/fluid-row-->
        <?php $this->load->view('backend/sections/footer.php'); ?>
        <script>
            $(document).ready(function () {
                var i = 0;
                var j = 0;
                var value = '';
                var brand = ''
                $('#parent_cat').change(function () {
                    var selCategory = $(this).val();
                    $.ajax({
                        url: "<?php echo base_url() . 'get-sub-category'; ?>", //The url where the server req would we made.                 async: false,
                        type: "POST", //The type which you want to use: GET/POST
                        data: "cat_id=" + selCategory, //The variables which are going.
                        dataType: "html", //Return data type (what we expect).
                        success: function (data) {
                            $('#sub_cat').html(data);
                            if ($('#sub_cat').val() == '') {
                                $('#sub_sub_cat').html('<option value="">-select Sub-sub category-</option>');
                            }
                        }
                    });
                });

                $('#add_new_color').click(function () {
                    j++;
                    var main_outr_div = document.createElement('div');
                    main_outr_div.setAttribute("class", "form-group");
                    var label1 = document.createElement('label');
                    label1.setAttribute("class", "col-md-4 col-sm-4 col-xs-12 control-label");
                    label1.setAttribute("for", "shipping_location");
                    var main_div = document.createElement('div');
                    main_div.setAttribute("class", "col-md-6 col-sm-6 col-xs-9 space");
                    var delete_div = document.createElement('div');
                    delete_div.setAttribute("class", "col-md-2 col-sm-2 col-xs-3 media-right2");
                    var input_group = document.createElement('div');
                    input_group.setAttribute("class", "input-group demo-with-options_" + j);
                    var color_span = document.createElement('span');
                    color_span.setAttribute("class", "input-group-addon");
                    var color_i = document.createElement('i');
                    color_i.setAttribute("class", "fa fa-hand-o-up color");
                    color_i.setAttribute("title", "select color");
                    var color_input = document.createElement('input');
                    color_input.setAttribute("type", "text");
                    color_input.setAttribute("name", "color[" + j + "]");
                    color_input.setAttribute("id", "color_" + j);
                    color_input.setAttribute("class", "form-control ");
                    color_input.setAttribute("placeholder", "color");
                    var addIcon = document.createElement('i');
                    addIcon.setAttribute('class', 'fa fa-remove');
                    var removeElement = document.createElement('a');
                    removeElement.appendChild(addIcon);
                    removeElement.setAttribute('class', 'btn btn-danger');
                    removeElement.title = "Remove Location";
                    removeElement.href = "javascript:void(0);";
                    color_span.appendChild(color_i);
                    input_group.appendChild(color_input);
                    input_group.appendChild(color_span);
                    main_div.appendChild(input_group);
                    delete_div.appendChild(removeElement);
                    main_outr_div.appendChild(label1);
                    main_outr_div.appendChild(main_div);
                    main_outr_div.appendChild(delete_div);
                    document.getElementById("more_color").appendChild(main_outr_div);
                    removeElement.onclick = function () {
                        if (confirm("Are you sure to delete this record ?")) {
                            document.getElementById("more_color").removeChild(main_outr_div);
                            $("#add_new_color").show();
                            var cntr = 0;
                            $("input[id*='color_'").each(function () {
                                var arr_eleIds = $(this).attr('id').split('_');
                                var thisId = arr_eleIds[arr_eleIds.length - 1];
                                $(this).attr({"id": "color_" + cntr, 'name': "color[" + cntr + "]"})
                                cntr++;
                            });
                            j--;
                        }
                    };
                    if (j == 4) {
                        $("#add_new_color").hide();
                    }
                    assignColor("demo-with-options_" + j);
                });
            });
            function validateShipLocation(id) {
                $("#" + id).rules('add', {
                    required: true,
                    messages: {
                        required: "Please enter available shipping location."
                    }
                });
            }
            function assignColor(color_name) {
                $('.' + color_name).colorpicker({
                    onSubmit: function () {
                        $('.color').removeClass('fa fa-hand-o-up');
                    }
                });
            }
            function addNewElement() {
                i++;
                var main_outr_div = document.createElement('div');
                main_outr_div.setAttribute("class", "form-group");
                var label1 = document.createElement('label');
                label1.setAttribute("class", "col-md-4 col-sm-4 col-xs-12 control-label");
                label1.setAttribute("for", "shipping_location");
                var main_div = document.createElement('div');
                main_div.setAttribute("class", "col-md-6 col-sm-6 col-xs-9 space");
                var delete_div = document.createElement('div');
                delete_div.setAttribute("class", "col-md-2 col-sm-2 col-xs-3 media-right2");
                var shipping_location = document.createElement('input');
                shipping_location.setAttribute("type", "text");
                shipping_location.setAttribute("name", "shipping_location[" + i + "]");
                shipping_location.setAttribute("id", "shipping_location_" + i);
                shipping_location.setAttribute("class", "form-control location_dynamic");
                shipping_location.setAttribute("onFocus", "initializeShipLocation(" + i + ")");
                shipping_location.setAttribute("placeholder", "Enter City,state and Country");
                var latitude = document.createElement('input');
                latitude.setAttribute("type", "hidden");
                latitude.setAttribute("name", "latitude[" + i + "]");
                latitude.setAttribute("id", "latitude_" + i);
                latitude.setAttribute("class", "form-control ");
                var longitude = document.createElement('input');
                longitude.setAttribute("type", "hidden");
                longitude.setAttribute("name", "longitude[" + i + "]");
                longitude.setAttribute("id", "longitude_" + i);
                longitude.setAttribute("class", "form-control ");
                var city = document.createElement('input');
                city.setAttribute("type", "hidden");
                city.setAttribute("name", "location_city[" + i + "]");
                city.setAttribute("id", "location_city_" + i);
                city.setAttribute("class", "form-control ");
                var state = document.createElement('input');
                state.setAttribute("type", "hidden");
                state.setAttribute("name", "location_state[" + i + "]");
                state.setAttribute("id", "location_state_" + i);
                state.setAttribute("class", "form-control ");
                var coutry = document.createElement('input');
                coutry.setAttribute("type", "hidden");
                coutry.setAttribute("name", "location_country[" + i + "]");
                coutry.setAttribute("id", "location_country_" + i);
                coutry.setAttribute("class", "form-control ");
                var street_add = document.createElement('input');
                street_add.setAttribute("type", "text");
                street_add.setAttribute("name", "street_address[" + i + "]");
                street_add.setAttribute("id", "street_address_" + i);
                street_add.setAttribute("class", "form-control ");
                street_add.setAttribute("placeholder", "Enter Street Address");
                var addIcon = document.createElement('i');
                addIcon.setAttribute('class', 'fa fa-remove');
                var removeElement = document.createElement('a');
                removeElement.appendChild(addIcon);
                removeElement.setAttribute('class', 'btn btn-danger');
                removeElement.title = "Remove Location";
                removeElement.href = "javascript:void(0);";
                main_div.appendChild(street_add);
                main_div.appendChild(shipping_location);
                main_div.appendChild(latitude);
                main_div.appendChild(longitude);
                main_div.appendChild(city);
                main_div.appendChild(state);
                main_div.appendChild(coutry);
                delete_div.appendChild(removeElement);
                main_outr_div.appendChild(label1);
                main_outr_div.appendChild(main_div);
                main_outr_div.appendChild(delete_div);
                document.getElementById("more_location").appendChild(main_outr_div);
                removeElement.onclick = function () {
                    if (confirm("Are you sure to delete this record ?")) {
                        document.getElementById("more_location").removeChild(main_outr_div);
                        $("#add_new_license").show();
                        var cntr = 0;
                        $("input[id*='shipping_location_'").each(function () {
                            var arr_eleIds = $(this).attr('id').split('_');
                            var thisId = arr_eleIds[arr_eleIds.length - 1];
                            $(this).attr({"id": "shipping_location_" + cntr, 'name': "shipping_location[" + cntr + "]"})
                            $("#latitude_" + thisId).attr({"id": "latitude_" + cntr, 'name': "latitude[" + cntr + "]"})
                            $("#longitude_").attr({"id": "longitude_" + cntr, 'name': "longitude[" + cntr + "]"})
                            $("#location_city_").attr({"id": "location_city_" + cntr, 'name': "location_city[" + cntr + "]"})
                            $("#location_state_").attr({"id": "location_state_" + cntr, 'name': "location_state[" + cntr + "]"})
                            $("#location_country_").attr({"id": "location_country_" + cntr, 'name': "location_country[" + cntr + "]"})
                            $("#street_address_").attr({"id": "street_address_" + cntr, 'name': "street_address[" + cntr + "]"})
                            cntr++;
                        });
                        i--;
                    }
                };
                if (i == 49) {
                    $("#add_new_location").hide();
                }
                setTimeout(function () {
                    initializeShipLocation(i);
                    validateShipLocation("shipping_location_" + i);
                }, 100);
            }

            function test()
            {
                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length) > 6) {
                    $("#error_file_size").show();
                    return false;
                } else
                {
                    $("#error_file_size").hide();
                    return true;
                }
            }
            function getBrand() {
                var str = new Array();
                $.each(brand, function (index, value) {
                    str.push(value.brand_name);
                });
                $.unique(str);
                $("input[id*='brand']").autocomplete({
                    source: str
                });
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#input_image").prop("disabled", true);
            });

            function size_one(dropdown) {

                document.getElementById("input_image").disabled = false;
                $("#input_image").replaceWith($("#input_image").val('').clone());
                var location = dropdown.options[dropdown.selectedIndex].value;
                var split = location.split('-');
                var name = split[0];
                window.height = split[1];
                var split_one = name.split('*');
                window.width = split_one[1];
            }

            var _URL = window.URL || window.webkitURL;
            $("#input_image").change(function (e) {
                var file, img;
                var width = window.width;
                var height = window.height;
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function () {
                        if (this.width <= width && this.height <= height) {
                            $('#input_image').replaceWith($('#input_image').val('').clone(true));
                            alert("Please upload image of " + width + "px width and " + height + "px height or greater.");
                        }

                    };
                    img.src = _URL.createObjectURL(file);
                }
            });
            function showimagepreview(input) {

                var file_name = input.files[0]['name'];
                var arr_file = new Array();
                arr_file = file_name.split('.');
                var file_ext = arr_file[1];
                switch (file_ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    case 'JPG':
                    case 'JPEG':
                    case 'PNG':
                    case 'GIF':
                        break;
                    default:
                        $('#input_image').replaceWith($('#input_image').val('').clone(true));
                        alert('Please upload a file only of type jpg,jpeg,gif,png.');
                        return true;

                }
                var file_size = input.files[0]['size'];
                if (file_size > Math.round(parseInt(5242880))) {
                    $('#input_image').replaceWith($('#input_image').val('').clone(true));
                    alert('Please upload a file less than 5 MB.');

                    return  true;
                }

                if (input.files && input.files[0]) {
                    var filerdr = new FileReader();
                    filerdr.onload = function (e) {
                        $('#imgprvw' + file_number).attr('src', e.target.result);
                    }
                    filerdr.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <link href="<?php echo base_url(); ?>media/backend/css/jquery-ui.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>media/backend/js/jquery-ui.js" type="text/javascript"></script>


        <script type="text/javascript" language="javascript">
            $(document).ready(function () {
                $("#frm_add_products").validate({
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
                        size:{
                            required:true
                        },
                        'p_height':{
        //                    required:true,
        //                    number: true
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
                            number:true
                        },
                        product_price: {
                            required: true,
                            number: true
                        },
                        p_width: {
      //                      required: true,
      //                      number: true
                        },
                        d_weight: {
           //                 required: true,
          //                  number: true
                        },
                        tot_diamonds: {
      //                      required: true,
       //                     number: true
                        },
                        metal_type: {
       //                     required: true
                        },
                        p_code: {
                            required: true
                        },
                        metal_weight: {
            //                required: true,
            //                number: true
                        }
                    },
                    messages: {
                        product_name: {
                            required: "Please enter product name."
                        },
                        p_code: {
                            required: "Please enter product code."
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
        <style>
            .control-label sup {
                color: #BD4247;
            }
            .page-position {
                position: relative;
            }

        </style>
        </html>