<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
    <div class="container">
        <div class="bs-docs-section">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 id="buttons"><?php echo ucfirst($arr_user_data['user_name']); ?>'s Account</h1>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="row">
                <div class="col-lg-12">
                    <div class="well">
                        <form id="frm_edit_account_setting" name="frm_edit_account_setting" method="post" action="<?php echo base_url(); ?>profile/account-setting" class="bs-example form-horizontal">
                            <fieldset>
                                <legend>Account Setting <a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default pull-right">Back</a></legend>                                            
                                
                                <div class="form-group">
                                    <label for="last_name" class="col-lg-2 control-label">Old password:</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" name="old_user_password" id="old_user_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_email" class="col-lg-2 control-label">New password:</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" name="new_user_password" id="new_user_password"> 
                                        <span id="result"></span>
                                            <!--<div class="password-meter">
                                                <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                                <div class="password-meter-bg">
                                                    <div class="password-meter-bar password-meter-too-short"></div>
                                                </div>
                                            </div>-->
                                            <sub>(Password must be combination of at least 1 number, 1 special character, 1 lower case letter and 1 upper case letter with minimum 8 characters)</sub>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_name" class="col-lg-2 control-label">Confirm password:</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" name="cnf_user_password" id="cnf_user_password">                                                   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" name="btn_account_setting" id="btn_account_setting" class="btn btn-success">Edit Changes</button> 
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