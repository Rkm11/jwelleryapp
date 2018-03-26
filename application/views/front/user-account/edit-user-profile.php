<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons"><?php echo ucfirst($arr_user_data['user_name']); ?>'s Profile</h1>
                </div>
            </div>
        </div>
    </div> 
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <form id="frm_edit_profile" name="frm_edit_profile" method="post" action="<?php echo base_url(); ?>profile/edit" enctype="multipart/form-data" class="bs-example form-horizontal">                            
                        <fieldset>
                            <legend>Edit Profile <a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default pull-right">Back</a></legend>                                            
                            <div class="form-group">
                                <label for="first_name" class="col-lg-2 control-label">First name:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $arr_user_data['first_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-lg-2 control-label">Last name:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $arr_user_data['last_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-lg-2 control-label">Email:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $arr_user_data['user_email']; ?>">
                                    <input type="hidden" class="form-control" name="user_email_old" id="user_email_old" value="<?php echo $arr_user_data['user_email']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Username:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $arr_user_data['user_name']; ?>">
                                    <input type="hidden" class="form-control" name="user_name_old" id="user_name_old" value="<?php echo $arr_user_data['user_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Gender:</label>
                                <div class="col-lg-10">
                                    <input type="radio" name="gender" id="gender" <?php
                                    if ($arr_user_data['gender'] == 1) {
                                        echo 'checked=""';
                                    }
                                    ?> value="1">Male
                                    <input type="radio" name="gender" id="gender" <?php
                                    if ($arr_user_data['gender'] == 2) {
                                        echo 'checked=""';
                                    }
                                    ?> value="2">Female
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="btn_edit_profile" id="btn_edit_profile" class="btn btn-success">Edit Changes</button> 
                                    <button type="button" name="btn_edit_profile_cancel" id="btn_edit_profile_cancel" onclick="javascript:document.location.href = '<?php echo base_url(); ?>profile'" class="btn btn-success">Cancel</button> 
                                    <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <br>
</div>