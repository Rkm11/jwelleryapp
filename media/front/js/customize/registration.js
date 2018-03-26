jQuery(document).ready(function() {
//    refreshCaptha();
    var baseUrl = jQuery("#base_url").val();
    jQuery("#frm_traveller_registration").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: baseUrl + 'chk-email-duplicate',
                    method: 'post'
                }
            },
            cnf_user_email: {
                required: true,
                email: true,
                equalTo: "#user_email"
            },
            user_name: {
                required: true,
                chk_username_field: true,
                remote: {
                    url: baseUrl + 'chk-username-duplicate',
                    method: 'post'
                }
            },
            user_password: {
                required: true,
                minlength: 8,
            },
            cnf_user_password: {
                required: true,
                equalTo: "#user_password"
            },
            terms: {
                required: true
            },
            input_captcha_value: {
                required: true,
                remote: {
                    url: baseUrl + 'check-captcha',
                    method: 'post'
                }
            }
        },
        messages: {
            first_name: {
                required: "Please enter the first name."
            },
            last_name: {
                required: "Please enter the last name."
            },
            user_email: {
                required: "Please enter an email address.",
                email: "Please enter a valid email address.",
                remote: "This email address is already registered with site."
            },
            cnf_user_email: {
                required: "Please enter confirm email address.",
                email: "Please enter a valid email address.",
                equalTo: "Email and confirm email doesn't match. Try again"
            },
            user_name: {
                required: "Please enter the username.",
                chk_username_field: "Please enter a valid username. It must contain 3-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "This username is already registered with site."
            },
            user_password: {
                required: "Please enter a password.",
                minlength: jQuery.format("Please enter at least {0} characters.")
            },
            cnf_user_password: {
                required: "Please confirm above password.",
                equalTo: "These passwords don't match. Try again"
            },
            terms: {
                required: "Please read and agree to terms and conditions."
            },
            input_captcha_value: {
                required: "Please enter the security code.",
                remote: "Please enter valid security code."
            }
        }, submitHandler: function(form) {
            jQuery("#btn_register").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    jQuery("#frm_owner_registration").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: baseUrl + 'chk-email-duplicate',
                    method: 'post'
                }
            },
            cnf_user_email: {
                required: true,
                email: true,
                equalTo: "#user_email"
            },
            user_name: {
                required: true,
                chk_username_field: true,
                remote: {
                    url: baseUrl + 'chk-username-duplicate',
                    method: 'post'
                }
            },
            user_password: {
                required: true,
                minlength: 8,
            },
            cnf_user_password: {
                required: true,
                equalTo: "#user_password"
            },
            terms: {
                required: true
            },
            input_captcha_value: {
                required: true,
                remote: {
                    url: baseUrl + 'check-captcha',
                    method: 'post'
                }
            }
        },
        messages: {
            first_name: {
                required: "Please enter the first name."
            },
            last_name: {
                required: "Please enter the last name."
            },
            user_email: {
                required: "Please enter an email address.",
                email: "Please enter a valid email address.",
                remote: "This email address is already registered with site."
            },
            cnf_user_email: {
                required: "Please enter confirm email address.",
                email: "Please enter a valid email address.",
                equalTo: "Email and confirm email doesn't match. Try again"
            },
            user_name: {
                required: "Please enter the username.",
                chk_username_field: "Please enter a valid username. It must contain 3-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "This username is already registered with site."
            },
            user_password: {
                required: "Please enter a password.",
                minlength: jQuery.format("Please enter at least {0} characters.")
            },
            cnf_user_password: {
                required: "Please confirm above password.",
                equalTo: "These passwords don't match. Try again"
            },
            terms: {
                required: "Please read and agree to terms and conditions."
            },
            input_captcha_value: {
                required: "Please enter the security code.",
                remote: "Please enter valid security code."
            }
        }, submitHandler: function(form) {
            jQuery("#btn_register").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    jQuery("#frm_traveller_registration_step_two").validate({
        errorElement: 'div',
        errorClass: 'text-danger',
        rules: {
            gender: {
//                required: true
            },
            birth_date: {
//                required: true
            },
            sit_house: {
//                required: true
            },
            smoke: {
//                required: true
            },
            sit_house_children: {
//                required: true
            },
            location: {
//                required: true
            },
            phone_no: {
                number: true
            },
            "user_images[]": {
                accept: "jpg|jpeg|png|gif",
                maxNumberOfFiles: true
            },
            id_proof: {
                accept: "jpg|jpeg|png|gif"
            },
            partner_first_name: {
                required: true
            },
            partner_last_name: {
                required: true
            },
            partner_gender: {
                required: true
            },
            partner_birth_date: {
                required: true
            },
            member_count: {
                required: true
            },
        },
        messages: {
            gender: {
                required: "Please select gender."
            },
            birth_date: {
                required: "Please enter your date of birth."
            },
            sit_house: {
                required: "Please select how you are going to sit the house."
            },
            smoke: {
                required: "Please select whether you smoke or not."
            },
            sit_house_children: {
                required: "Please select whether you are going to sit house with children or not."
            },
            location: {
                required: "Please select your location."
            },
            phone: {
                number: "Please enter number only."
            },
            "user_images[]": {
                accept: "Upload only jpg|jpeg|png|gif type of images.",
                maxNumberOfFiles: 'You can upload only 4 images.'
            },
            id_proof: {
                accept: "Upload only jpg|jpeg|png|gif type of image.",
            },
            partner_first_name: {
                required: "Please enter partner's first name."
            },
            partner_last_name: {
                required: "Please enter partner's last name."
            },
            partner_gender: {
                required: "Please specify partner's gender."
            },
            partner_birth_date: {
                required: "Please enter partner's date of birth."
            },
            member_count: {
                required: "Please enter family member count."
            },
        },
        submitHandler: function(form) {
            jQuery("#btn_register").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    jQuery("#frm_owner_registration_step_two").validate({
        errorElement: 'div',
        errorClass: 'text-danger',
        rules: {
            location: {
//                required: true
            },
            phone_no: {
                number: true,
                minlength: 10,
                maxlength: 10
            },
            "user_images[]": {
                accept: "jpg|jpeg|png|gif",
                maxNoOfFiles: true
            },
            id_proof: {
                accept: "jpg|jpeg|png|gif"
            },
        },
        messages: {
            location: {
//                required: "Please select your location."
            },
            phone: {
                number: "Please enter number only.",
                minlength: "Please enter minimum 10 digits.",
                maxlength: "Please enter maximum 10 digits."
            },
            "user_images[]": {
                accept: "Upload only jpg|jpeg|png|gif type of images.",
                maxNoOfFiles: 'You can upload only 10 images.'
            },
            id_proof: {
                accept: "Upload only jpg|jpeg|png|gif type of image.",
            },
        },
        submitHandler: function(form) {
            jQuery("#btn_register").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    jQuery.validator.addMethod("maxNumberOfFiles", function(value, element) {
        var inp = document.getElementById('user_images');
        if (inp.files.length > 4) {
            return false;
        } else {
            return true;
        }
    }, jQuery.validator.format("Upload maximum 4 images"));

    jQuery.validator.addMethod("maxNoOfFiles", function(value, element) {
        var inp = document.getElementById('user_images');
        if (inp.files.length > 10) {
            return false;
        } else {
            return true;
        }
    }, jQuery.validator.format("Upload maximum 10 images"));

    jQuery("#frm_user_login").validate({
        errorElement: 'div',
        rules: {
            user_name: {
                required: true,
            },
            user_password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            user_name: {
                required: "Please enter email/username."
            },
            user_password: {
                required: "Please enter a password.",
                minlength: "Please enter atleast 8 character."
            }
        }

    });
    /**End here */
    /*forgot password validation form*/
    jQuery("#forgot_password_form").validate({
        errorElement: 'div',
        rules: {
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: baseUrl + 'chk-forgot-password-exists',
                    method: 'post'
                }
            }
        },
        messages: {
            user_email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.',
                remote: 'This email is not registered with this site.'
            }
        }
    });
    /**End here*/

    /*reset password form validation */
    jQuery("#reset_password_form").validate({
        errorElement: 'div',
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: 'Please enter password.',
                minlength: 'please enter atleast 8 character'

            },
            confirm_password: {
                required: 'Please enter password.',
                minlength: 'please enter atleast 8 character',
                equalTo: 'Please enter the confirm password same as above.'
            }
        }

    });



    jQuery.validator.addMethod('chk_username_field', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9-_.]{3,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
});
$(function() {
    $("#birth_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        maxDate: '-1',
        yearRange: "-100:+1"
    }).click(function() {
        $(".ui-datepicker-calendar").css("display", "table");
    });
});
$(function() {
    $("#partner_birth_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        maxDate: '-1',
        yearRange: "-100:+1"
    }).click(function() {
        $(".ui-datepicker-calendar").css("display", "table");
    });
});