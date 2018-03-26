$(document).ready(function() {
    var baseUrl = $('#baseurl').val();
    $('#frm_add_storefront').validate({
        debug: true,
        errorClass: 'text-danger',
        errorElement: 'div',
        rules: {
            store_name: {
                required: true,
//                minlength: 3,
//                maxlength: 20,
                chk_store_name: true
            },
            store_img: {
                accept: 'jpeg|png|PNG|JPEG|GIF|gif|jpg'
            }
        },
        messages: {
            store_name: {
                required: "Please enter the storefront name.",
                chk_store_name: "Please enter proper name."
            },
            store_img: {
                accept: 'Please select jpeg,png,gif,jpg files only.'
            }
        }, submitHandler: function(form) {
            jQuery("#btn_add_storefront").attr('disabled', true);
            jQuery("#btn_cancel").attr('disabled', true);
            form.submit();
        }
    });


    $('#frm_edit_storefront').validate({
        debug: true,
        errorClass: 'text-danger',
        errorElement: 'div',
        rules: {
            store_name: {
                required: true,
                chk_store_name: true,
                remote: {
                    url: baseUrl + 'chk-store-name',
                    method: 'post',
                    data: {
                        'user_id': $('#user_id').val(),
                        'old_store_name': $('#old_store_name').val()
                    }
                }

            },
            store_img: {
                accept: 'jpeg|png|PNG|JPEG|GIF|gif|jpg'
            }
        },
        messages: {
            store_name: {
                required: "Please enter the storefront name.",
                chk_store_name: "Store name within 3-20 character allowed only a-z,A-z,0-9 and @ characters.",
                remote: "This store name is already exist."
            },
            store_img: {
                accept: 'Please enter only jpeg,png,gif,jpg files only'
            }
        }, submitHandler: function(form) {
            jQuery("#btn_edit_storefront").attr('disabled', true);
            jQuery("#btn_cancel").attr('disabled', true);
            form.submit();
        }
    });
    jQuery.validator.addMethod('chk_store_name', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9._@ ]{3,20}$')) {
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