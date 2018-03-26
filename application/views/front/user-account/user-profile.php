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
                    <div style="float: left; width: 30%;" id="profile-pic">
                        <?php
                        if (is_null($arr_user_data['profile_picture']) || $arr_user_data['profile_picture'] == '') {
                            if ($arr_user_data['gender'] == 1) {
                                $profile_img_path = base_url() . 'media/front/img/male.png';
                            } else {
                                $profile_img_path = base_url() . 'media/front/img/female.png';
                            }
                        } else {
                            $profile_img_path = base_url() . 'media/front/img/user-profile-pictures/thumb/' . $arr_user_data['profile_picture'];
                        }
                        ?>                                                              
                        <img src="<?php echo $profile_img_path; ?>" border="0" width="150"><br>
                        <!--<a href="<?php echo base_url(); ?>profile/change-profile-picture">Change profile picture</a>-->
                        <form name="imageform" id="imageform" method="POST" enctype="multipart/form-data" action=''> 
                            <input type="file" size="9" class="infi" title="Logo" data-rel="tooltip" name="profile_image" id="profile_image" value="">
                            <input type="hidden" name="old_logo" id="old_logo" value="239316926">
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">

                        </form>
                    </div>
                    <fieldset>
                        <legend>Profile detail</legend> 
                        <div class="help-block text-right"><a href="<?php echo base_url(); ?>profile/account-setting">Account setting</a></div>
                         <div class="help-block text-right"><a href="<?php echo base_url(); ?>my-notification">My Notifications</a></div>
                        <div class="component">
                            <div class="control-group">
                                <label for="textinput" class="control-label">First name: <?php echo $arr_user_data['first_name']; ?></label>
                            </div>
                        </div>
                        <div class="component">
                            <div class="control-group">
                                <label for="textinput" class="control-label">Last name: <?php echo $arr_user_data['last_name']; ?></label>
                            </div>
                        </div>
                        <div class="component">
                            <div class="control-group">
                                <label for="textinput" class="control-label">Email address: <?php echo $arr_user_data['user_email']; ?></label>
                            </div>
                        </div>
                        <div class="component">
                            <div class="control-group">
                                <label for="textinput" class="control-label">Username: <?php echo $arr_user_data['user_name']; ?></label>
                            </div>
                        </div>
                        <div class="component">
                            <div class="control-group">
                                <label for="textinput" class="control-label">Gender: <?php if ($arr_user_data['gender'] == 1) {
                            echo "Male";
                        } else {
                            echo "Female";
                        } ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">                                        
                                <a href="<?php echo base_url(); ?>profile/edit">Edit Profile</a>
                                <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
    </section>
    <br>
</div>

<script src="<?php echo base_url(); ?>media/front/js/ajaxupload.3.5.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        var base_url = jQuery("#base_url").val();
        var btnUpload = jQuery('#profile_image');
        var old_logo = jQuery("#old_logo").val();

        new AjaxUpload(btnUpload, {
            action: base_url + 'profile/change-profile-picture',
            name: 'uploadprofile',
            data: {old_logo: old_logo},
            onSubmit: function(file, ext) {

                $('#loadingimg').show();

                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    // extension is not allowed 
                    alert('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
            },
            onComplete: function(file, response) {
                $('#loadingimg').hide();
                var str = '<img src="' + base_url + 'media/front/img/user-profile-pictures/thumb/' + response + '"/>';


                jQuery("#old_logo").val(response);
                jQuery("#profile-pic").html(str).show();
                window.location.reload();
            }

        });

    });
</script>        