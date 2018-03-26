jQuery(document).ready(function() {
//    refreshCaptha();
    var baseUrl = jQuery("#base_url").val();
    /*Contact Us Form Validation Start */

    jQuery.validator.addMethod('chk_username_field', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9-_.]{5,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");

    jQuery.validator.addMethod('chk_name', function(value, element, param) {
        if (value.match('^[a-zA-Z]{1,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please enter valid name");

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Please enter valid characters");


    jQuery.validator.addMethod('chk_full_name', function(value, element, param) {
        if (value.match("^[a-zA-Z]([-']?[a-zA-Z]+)*( [a-zA-Z]([-']?[a-zA-Z]+)*)+$")) {
            return true;
        } else {
            return false;
        }

    }, "");

    jQuery.validator.addMethod("password_strenth", function(value, element) {
        return isPasswordStrong(value, element);
    }, "Password must be combination of at least 1 number, 1 special character, 1 lower case letter and 1 upper case letter with minimum 6 characters");


    /* landing Form Validation Start */
    jQuery("#frm_user_registration").validate({
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
                password_strenth: true
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
            user_name: {
                required: "Please enter the username.",
                chk_username_field: "Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
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

    /* User Registration Form Validation End */

    /**contact us form validation**/
    jQuery("#form_contact_us").validate({
        errorElement: 'div',
		errorClass:'text-danger',
        rules: {
            first_name: {
                required: true,
                chk_full_name:true
            },
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true
            },
            message: {
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
                required: 'Please enter your name.',
                chk_full_name:'Please enter your full name.'
            },
            email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },
            subject: {
                required: "Please enter a subject"
            },
            message: {
                required: "Please enter message"
            },
            input_captcha_value: {
                required: "Please enter the security code.",
                remote: "Please enter valid security code."
            }
        }

    });


    /**Login form validation*/
    jQuery("#user_login_form").validate({
        errorElement: 'div',
        rules: {
            login_email: {
                required: true,
                email: true
            },
            login_password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            login_email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },
            login_password: {
                required: "Please enter a password.",
                minlength: "Please enter atleast 8 character."
            }
        }

    });

    /**Login Static form validation*/
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

    /**End here*/
    
    /* change email Form Validation Start */
    jQuery("#frm_change_user_email").validate({
        errorElement: 'div',
        rules: {
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: baseUrl + "chk-edit-email-duplicate",
                    type: "post",
                    data: {
                        action: "check_email"
                    }
                }
            }

        },
        messages: {
            user_email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.',
                remote: 'Email already exists.'
            }
        }
    });

    /* User Registration Form Validation End */



    /* Testimonial page validation start */
    jQuery("#frmTestimonials").validate({
        errorElement: 'div',
		errorClass:'text-danger',
        rules: {
            inputTestimonial: {
                required: true,
                minlength: 20
            },
            inputName: {
                required: true
            }
        },
        messages: {
            inputTestimonial: {
                required: "Please enter testimonial.",
                minlength: "Please enter at least 20 characters."
            },
            inputName: {
                required: "Please enter your name."
            }
        },
        // set this class to error-labels to indicate valid fields
        success: function(label) {
            label.hide();
        }
    });
    /* Testimonial page validation end */


    /* Edit user profile page validation start */

    jQuery("#frm_edit_profile").validate({
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

                    url: baseUrl + "chk-edit-email-duplicate",

                    method: 'post',
                    data: {user_email_old: jQuery('#user_email_old').val()}
                }
            },
            user_name: {
                required: true,
                chk_username_field: true,
                remote: {

                    url: baseUrl + 'chk-edit-username-duplicate',
                    method: 'post',
                    data: {action: 'edit_user_name_chk', user_name_old: jQuery('#user_name_old').val()}
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
                required: "Please enter a email address.",
                email: "Please enter an valid email address.",
                remote: "This email address is already registered with site."
            },
            user_name: {
                required: "Please enter username.",
                chk_username_field: "Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "This username is already registered with site."
            }
        }, submitHandler: function(form) {
            jQuery("#btn_edit_profile").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    /* Edit user profile page validation end */
    /* Account setting page validation start */
    jQuery("#frm_edit_account_setting").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            old_user_password: {
                required: true,
                minlength: 8,
                remote: {

                    url: baseUrl + 'edit-user-password-chk',

                    method: 'post',
                    cache: false,
                    sync: false,
                    data: {action: 'edit_user_password_chk'}
                }
            },
            new_user_password: {
                required: true,
                minlength: 8,
                password_strenth: true
            },
            cnf_user_password: {
                required: true,
                minlength: 8,
                equalTo: "#new_user_password"
            }
        },
        messages: {
            old_user_password: {
                required: "Please enter old password.",
                minlength: jQuery.format("Please enter at least {0} characters."),
                remote: "Incorrect old password."
            },
            new_user_password: {
                required: "Please enter new password.",
                minlength: jQuery.format("Please enter at least {0} characters.")
            },
            cnf_user_password: {
                required: "Please confirm password.",
                minlength: jQuery.format("Please enter at least {0} characters."),
                equalTo: "These passwords don't match. Try again."
            }
        }, submitHandler: function(form) {
            jQuery("#btn_account_setting").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    /* Account setting page validation end */
    
    /* Create dispute page validation start */
    jQuery('#frmCreateDispute').validate({
        errorElement: 'div',
        rules: {
            product_id_fk: {
                required: true
            },
            disputer_id:{
                required: true
            },
            dispute_description: {
                required: true
            },
            dispute_amount: {
                required: true,
                number:true,
                remote: {
                    url: baseUrl+'check-dispute-amount',
                    method: 'post',
                    type:'post',
                    data: {
                        product_id_fk: function() {
                            return $("#product_id_fk").val();
                        }
                    }
                }
            },
            'upload_files[]': {
                required: true
            }
        },
        messages: {
            product_id_fk: {
                required: 'Please select a product'
            },
            disputer_id: {
                required: 'Please select user'
            },
            dispute_description: {
                required: "Please enter description for dispute"
            },
            dispute_amount: {
                required: "Please enter dispute amount",
                number: "Please enter only numbers",
                remote: "Dispute amount cannot exceed the total amount."
            },
            'upload_files[]': {
                required: 'Please upload files'
            }
        },
        submitHandler: function(form) {
            jQuery("#btnSubmit").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
    
    /* Create dispute page validation start */
    
});