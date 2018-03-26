$(document).ready(function() {
    var max = $('#max_product_qnt').val();
    $('#frm_add_to_cart').validate({
        debug: true,
        errorClass: 'text-danger',
        errorElement: 'div',
        rules: {
            product_qnt: {
                required: true,
                number: true,
                min: 1,
                minlength: 1
                        //maxlength: max
            },
            chk_color: {
                required: true
            },
            product_size: {
                required: true
            },
            product_weight: {
                required: true
            }
        },
        messages: {
            product_qnt: {
                required: "Please enter quantity.",
                min: "Please enter value greather than 1.",
                //  maxlength: "Please enter at least {0} characters."
            },
            chk_color: {
                required: "Please select product color."
            },
            product_size: {
                required: "Please select product size."
            },
            product_weight: {
                required: "Please select product weight."
            }

        }, submitHandler: function(form) {
            jQuery("#btn_add_cart").attr('disabled', true);
            jQuery("#btn_cancel").attr('disabled', true);
            form.submit();
        }
    });
});
