jQuery(document).ready(function() {
    jQuery("#frm_edit_carat").validate({
        errorElement: 'div',
        rules: {
            carat_name: {
                required: true,
                remote: {
                    url: jQuery("#base_url").val() + "backend/carat/check-carat-name",
                    type: "post",
                    data: {
                        type: "edit",
                        old_category_name: jQuery('#old_carat_name').val()
                    }
                }
            },
            wholeseller_price: {
                required: true,
                digits: true
            },
            customer_price: {
                required: true,
                digits: true
            }

        },
        messages: {
            carat_name: {
                required: "Please enter carat name.",
                remote: "Carat with the same name already exists."
            },
            customer_price: {
                required: "Please enter price.",
                digits: "Please enter valid price."
            },
            wholeseller_price: {
                required: "Please enter price.",
                digits: "Please enter valid price."
            }
        }
    });
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[A-Z]+$/i.test(value);
    }, "");


});