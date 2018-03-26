<script src="<?php echo base_url(); ?>media/front/js/facebook-config.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/facebook-connect.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(e) {
		$("#user_name").focus();
    });
</script>  
    <div class="container">
        <div class="bs-docs-section">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 id="buttons">User Login</h1>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                        <form id="frm_user_login" name="frm_user_login" method="post" action="<?php echo base_url(); ?>signin" class="bs-example form-horizontal">
                            <fieldset>
                                <legend>Sign in</legend>
								
								 
                                <div class="help-block text-center">Enter your login details below</div>
                                <div class="help-block text-right"><a href="<?php echo base_url(); ?>signup">Not registered?</a></div>
                                <div class="form-group">
                                    <label for="user_name" class="col-lg-2 control-label">Email/Username:<sup class="mandatory">*</sup></label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $this->session->userdata('user_name'); ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_password" class="col-lg-2 control-label">Password:<sup class="mandatory">*</sup></label>
                                    <div class="col-lg-10">                                           
                                        <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_password" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <a class="btn-link" href="<?php echo base_url(); ?>password-recovery">Forgot your password?</a>
                                    </div> 
                                </div>                  
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" name="btn_login" id="btn_login" class="btn btn-success">Login</button> 
                                        <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                        <div style="float: right;">
                                            <div id="fb-root"></div>
                                            <a href="javascript:void(0);" id="btn_fb_connect" onclick="connectMe('<?php echo base_url(); ?>')"><img src="<?php echo base_url(); ?>media/front/img/fb_login.png" border="0"></a>
                                        </div>
                                    </div>
                                </div>                                    
                            </fieldset>
                        </form>
                    </div>
                </div>
        </section>
        <br>
    </div>