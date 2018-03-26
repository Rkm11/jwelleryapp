
var i = $('#cnt').val();
$(document).ready(function() {
    var j = $('#clr_cnt').val();
    $('#frm_edir_product').validate({
        debug: true,
        errorClass: 'text-danger',
        errorElement: 'div',
        rules: {
            product_name: {
                required: true
            },
            storefront: {
                required: true
            },
            parent_cat: {
                required: true
            },
            sub_cat: {
                required: true
            },
            sub_sub_cat: {
                required: true
            },
            product_price: {
                required: true,
                number: true,
                min: 1
            },
            product_desc: {
                required: true,
                maxlength: 300
            },
            product_qnt: {
                required: true,
                number: true,
                min: 0
            },
            product_summary: {
                required: true,
                maxlength: 300
            },
            return_policy: {
                required: true,
                url: true
            },
            payment_mode: {
                required: true
            },
            production_specification: {
                required: true,
                maxlength: 300
            },
//            ass_storefront: {
//                required: true
//            },
            "product_img[]": {
                accept: "jpeg|png|PNG|JPEG|GIF|gif|jpg"
            },
            size: {
                chk_size: true
            },
            weight: {
                required: true,
                chk_weight: true
            },
            shipping_type: {
                required: true
            },
            ship_mode: {
                required: true
            },
            brand: {
                required: true
            }
        },
        messages: {
            product_name: {
                required: "Please enter product name."
            },
            storefront: {
                required: "Please select storefront."
            },
            parent_cat: {
                required: "Please select product category."
            },
            sub_cat: {
                required: "Please select sub category."
            },
            sub_sub_cat: {
                required: "Please select the sub sub-category."
            },
            product_price: {
                required: "Please enter product price.",
            },
            product_desc: {
                required: "Please enter product description."
            },
            product_qnt: {
                required: "Please enter product quantity."
            },
            product_summary: {
                required: "Please enter product summary"
            },
            return_policy: {
                required: "Please enter fine print."
            },
            payment_mode: {
                required: "Please select your payment mode."
            },
            production_specification: {
                required: "Please enter product specification."
            },
//            ass_storefront: {
//                required: "Please tell that you storefront is assigned or not."
//            },
            "product_img[]": {
                accept: 'Please select jpeg,png,gif,jpg files only.'
            },
//            'shipping_location[]': {
//                required: "Please enter available shipping location."
//            }
            size: {
                chk_size: "Please enter valid values with , seprated."
            },
            weight: {
                required: "Please enter weight if not apllicable then enter up to 0.5kg.",
                chk_weight: "Please enter valid values with , seprated."
            },
            shipping_type: {
                required: "Please choose delivery method."
            },
            ship_mode: {
                required: "Please choose shipping mode."
            },
            brand: {
                required: "Please enter brand name."
            }
        }, submitHandler: function(form) {
            if ((jQuery.trim(jQuery("#cke_1_contents iframe").contents().find("body").html())).length < 12)
            {
                jQuery("#labelProductError").removeClass("hidden");
                jQuery("#labelProductError").show();
            } else if ((jQuery.trim(jQuery("#cke_2_contents iframe").contents().find("body").html())).length < 12)
            {
                jQuery("#labelFinePrintError").removeClass("hidden");
                jQuery("#labelFinePrintError").show();
            } else {
                if (test())
                {
                    jQuery("#labelProductError").addClass("hidden");
                    jQuery("#labelFinePrintError").addClass("hidden");
                    jQuery("#btn_add_storefront").attr('disabled', true);
                    jQuery("#btn_cancel").attr('disabled', true);
                    form.submit();
                }
            }
        }
    });
    jQuery.validator.addMethod('chk_name', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9._@#$]{1,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
    jQuery.validator.addMethod('chk_size', function(value, element, param) {
        if (value.match('^[0-9a-zA-Z,.]{0,50}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
    jQuery.validator.addMethod('chk_weight', function(value, element, param) {
        if (value.match('^[0-9,.]{0,50}$')) {
            return true;
        } else {
            return false;
        }

    }, "");

    $('#add_new_location').click(function() {
        var main_outr_div = document.createElement('div');
        main_outr_div.setAttribute("class", "form-group");
        var label1 = document.createElement('label');
        label1.setAttribute("class", "col-md-4 col-sm-4 col-xs-12 control-label");
        label1.setAttribute("for", "shipping_location");
        var main_div = document.createElement('div');
        main_div.setAttribute("class", "col-md-6 col-sm-6 col-xs-12 space");
        var delete_div = document.createElement('div');
        delete_div.setAttribute("class", "col-md-2 col-sm-2 col-xs-12 media-right2");

        //  label1.innerHTML = "Available Shipping location";

        var shipping_location = document.createElement('input');
        shipping_location.setAttribute("type", "text");
        shipping_location.setAttribute("name", "shipping_location[" + i + "]");
        shipping_location.setAttribute("id", "shipping_location_" + i);
        shipping_location.setAttribute("class", "form-control location_dynamic");
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
        removeElement.onclick = function() {
            if (confirm("Are you sure to delete this record ?")) {
                document.getElementById("more_location").removeChild(main_outr_div);
                $("#add_new_license").show();
                var cntr = 0;
                $("input[id*='shipping_location_'").each(function() {
                    var arr_eleIds = $(this).attr('id').split('_');
                    var thisId = arr_eleIds[arr_eleIds.length - 1];
                    $(this).attr({"id": "shipping_location_" + cntr, 'name': "shipping_location[" + cntr + "]"})
                    $("#latitude_" + thisId).attr({"id": "latitude_" + cntr, 'name': "latitude[" + cntr + "]"})
                    $("#longitude_").attr({"id": "longitude_" + cntr, 'name': "longitude[" + cntr + "]"})
                    cntr++;
                });
                i--;
            }
        };
        if (i == 49) {
            $("#add_new_location").hide();
        }
        initializeShipLocation(i);
        validateShipLocation("shipping_location_" + i);
        i++;
    });
    $('#add_new_color').click(function() {
        j++;
        var main_outr_div = document.createElement('div');
        main_outr_div.setAttribute("class", "form-group");
        var label1 = document.createElement('label');
        label1.setAttribute("class", "col-md-4 col-sm-4 col-xs-12 control-label");
        label1.setAttribute("for", "shipping_location");
        var main_div = document.createElement('div');
        main_div.setAttribute("class", "col-md-6 col-sm-6 col-xs-12 space");
        var delete_div = document.createElement('div');
        delete_div.setAttribute("class", "col-md-2 col-sm-2 col-xs-12 media-right2");
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
        removeElement.title = "Remove Color";
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

        removeElement.onclick = function() {
            if (confirm("Are you sure to delete this record ?")) {
                document.getElementById("more_color").removeChild(main_outr_div);
                $("#add_new_color").show();
                var cntr = 0;
                $("input[id*='color_'").each(function() {
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

    jQuery.validator.addMethod('chk_name', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9._@#$]{1,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
});


function initializeShipLocation(id) {
    $('#shipping_location_' + id).bind('cut copy paste', function(event) {
        event.preventDefault();
    });

    $("#shipping_location_" + id).addresspicker({
        elements: {
            lat: "#latitude_" + id,
            lng: "#longitude_" + id,
            country: '#location_country_' + id,
            administrative_area_level_2: '#location_city_' + id,
            administrative_area_level_1: '#location_state_' + id,
        }
    });
    $("#shipping_location_" + id).change(function() {
        if ($(this).val() == '') {
            $("#latitude_" + id).val('');
            $("#longitude_" + id).val('');
            $("#location_country_" + id).val('');
            $("#location_city_" + id).val('');
            $("#location_state_" + id).val('');
        }
    });
}
function validateShipLocation(id) {
    var idArr = id.split('_');
    var id_no = idArr[idArr.length - 1];
    $("#" + id).rules('add', {
        required: true,
        messages: {
            required: "Please enter available shipping location."
        }
    });
}
function assignColor(color_name) {
    $('.' + color_name).colorpicker({
    });
}

function loadProfielPic(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#selected_file').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}