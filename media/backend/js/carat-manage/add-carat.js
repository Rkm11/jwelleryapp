// JavaScript Document
$(document).ready(function (e) {
    $("#frm_add_carat").validate({
        errorElement: "div",
        rules: {
            carat_name: {
                required: true,
                remote: {
                    url: jQuery("#base_url").val() + "backend/carat/check-carat-name",
                    type: "post"
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

        },
        submitHandler: function (form) {
            $("#btn_submit").hide();
            $("#loding_image").show();
            form.submit();
        }
    });

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[A-Z]+$/i.test(value);
    }, "");



});