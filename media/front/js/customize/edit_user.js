$(document).ready(function() {
    var baseUrl = $('#base_url').val();
    $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-m-d",
        maxDate: '-1 Year',
        onSelect: function(selected) {
            var user_dob = $("#dob").datepicker("getDate");
            if (user_dob == '') {
                alert("please select your birthdate.");
                return false;
            } else {
                var age = calculateAge(user_dob);
                $("#user_age").val(age);
            }
        }
    }).click(function() {
        $('.ui-datepicker-calendar').css('display', 'table');
    });

    $("#dob").keypress(function(event) {
        event.preventDefault();
        var keyCode = (event.keyCode ? event.keyCode : event.which);
        if (keyCode > 47 && keyCode < 58) {
            event.preventDefault();
        }
    });
    $("#user_address").change(function() {
        if ($(this).val() == '') {
            $("#user_area").val('');
            $("#user_state").val('');
            $("#user_town").val('');
            //$("#postal_code").val('');
            $("#latitude").val('');
            $("#longitude").val('');
        }
    });
    $("#user_address").addresspicker({
        elements: {
            lat: "#latitude",
            lng: "#longitude",
            administrative_area_level_1: '#user_state',
            administrative_area_level_2: '#user_town,#user_area',
            //country: '#user_area',
            //postal_code: '#postal_code'
        }
    });

    jQuery("#frm_edit_profile").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            first_name: {
                required: true,
//                chk_name: true
            },
            last_name: {
                required: true,
//                chk_name: true
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
                    data: {action: 'edit_user_name_chk',
                        user_name_old: jQuery('#user_name_old').val(),
                        user_id: jQuery('#user_id').val()
                    }
                }
            },
            dob: {
                required: true
            },
            user_address: {
                required: true
            },
            user_phone_no: {
                required: true,
                chk_phoneno: true
            }
        },
        messages: {
            first_name: {
                required: "Please enter the first name.",
                chk_name: "Please enter valid first name."
            },
            last_name: {
                required: "Please enter the last name.",
                chk_name: "Please enter valid last name."
            },
            user_email: {
                required: "Please enter a email address.",
                email: "Please enter a valid email address.",
                remote: "This email address is already registered with site."
            },
            user_name: {
                required: "Please enter username.",
                chk_username_field: "Please enter a valid username. It must contain 3-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "This username is already registered with site."
            },
            dob: {
                required: "Please select birth date."
            },
            user_address: {
                required: "Please enter the address."
            },
            user_phone_no: {
                required: "Please enter phone number.",
            }
        }, submitHandler: function(form) {
            jQuery("#btn_edit_profile").attr('disabled', true);
            form.submit();
        }
    });


    jQuery.validator.addMethod('chk_name', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9-_.]{1,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
    jQuery.validator.addMethod('chk_username_field', function(value, element, param) {
        if (value.match('^[a-zA-Z0-9-_.]{3,20}$')) {
            return true;
        } else {
            return false;
        }

    }, "");
    jQuery.validator.addMethod('chk_phoneno', function(value, element) {
        return this.optional(element) || /^\+?([0-9]{0,4})\)?[-. ]?([0-9-]{5})[-. ]?([0-9]{5})$/i.test(value);
    }, "Phone Number should be in this format (+countrycode) (10 digits phone number)");
});

function calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}