<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(e) {
        jQuery("#frm_new_password").validate({
            debug: true,
            errorClass: 'text-danger',
			errorElement: 'div',
            rules: {
                user_password: {
                    required: true,
                },
            },
            messages: {
                user_password: {
                    required: "Please enter password."
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons">New Password</h1>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <form id="frm_new_password" name="frm_new_password" method="post" action="<?php echo base_url(); ?>reset-password" class="bs-example form-horizontal">
                        <input type="hidden" name="activation_code" id="activation_code" value="<?php echo base64_decode($activation_code); ?>">
                        <fieldset>
                            <legend>New Password</legend>

                            <div class="form-group">
                                <label for="user_password" class="col-lg-2 control-label">New password:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="user_password" name="user_password" autocomplete="off">
                                    <span id="result"></span>
                                    <!--<div class="password-meter">
                                        <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                        <div class="password-meter-bg">
                                            <div class="password-meter-bar password-meter-too-short"></div>
                                        </div>
                                    </div>-->
                                    <sub>
                                        (Password must be combination of at least 1 number, 1 special character, 1 lower case letter and 1 upper case letter with minimum 8 characters)
                                    </sub>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cnf_user_password" class="col-lg-2 control-label">Confirm password:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="cnf_user_password" name="cnf_user_password" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="btn_pass" id="btn_pass" class="btn btn-success">Submit</button> 
                                    <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
    </section>
</div>
