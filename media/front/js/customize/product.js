$(document).ready(function() {
    $('#frm_add_product').validate({
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
});
function loadProfielPic(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#selected_file').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}