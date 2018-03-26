<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(e) {
        jQuery("#frm_forgot_password").validate({
            debug: true,
            errorClass: 'text-danger',
            rules: {
                user_email: {
                    required: true,
                   /* email: true,*/
                    remote: {
                        url: "<?php echo base_url(); ?>chk-email-exist",
                        method: 'post',
                        data: {action: 'forgot_pass_email_chk'}
                    }
                }
            },
            messages: {
                user_email: {
                    required: "Please enter email address.",
                    email: "Please enter valid email address.",
                    remote: "This email address or username is not registered with site."
                }
            },
            submitHandler: function(form) {
                jQuery("#btn_pass").hide();
                jQuery("#btn_loader").show();
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
                        <h1 id="buttons">Forgot Password</h1>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                        <form id="frm_forgot_password" name="frm_forgot_password" method="post" action="<?php echo base_url(); ?>password-recovery" class="bs-example form-horizontal">
                            <fieldset>
                                <legend>Forgot password</legend>
                                <?php if ($this->session->userdata('invalid_password_link') != '') { ?>
                                    <div class="alert alert-error">
                                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                        <?php echo $this->session->userdata('invalid_password_link'); ?>
                                    </div>
                                    <?php
                                    $this->session->unset_userdata('invalid_password_link');
                                }
                                ?>
                                <div class="help-block text-center">Enter your email details below</div>                                    
                                <div class="form-group">
                                    <label for="user_email" class="col-lg-2 control-label">Username/Email address:<sup class="mandatory">*</sup></label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="user_email" name="user_email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_password" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <a class="btn-link" href="<?php echo base_url(); ?>signin">Login</a>
                                    </div> 
                                </div>                  
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" name="btn_pass" id="btn_pass" class="btn btn-success">Send</button> 
                                        <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
        </section>
        <br>
    </div>
