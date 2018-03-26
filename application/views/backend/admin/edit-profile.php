<?php $this->load->view('backend/sections/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Update Admin User Details

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/role/list"><i class="fa fa-gear"></i> Manage Admin Users</a></li>
            <li class="active">	Update Admin User Details </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form name="frm_admin_details" id="frm_admin_details" role="form" action="<?php echo base_url(); ?>backend/admin/edit-profile" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="User Name">User Name <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['user_name'])); ?>" id="user_name" name="user_name" class="form-control">
                                        <input type="hidden" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['user_name'])); ?>" id="old_username" name="old_username">

                                    </div>
                                    <div class="form-group">
                                        <label for="First Name">First Name <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['first_name'])); ?>" name="first_name" id="first_name"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Last Name">Last Name <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['last_name'])); ?>" name="last_name" id="last_name"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email Id">Email Id <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo stripslashes($arr_admin_detail['user_email']); ?>" name="user_email" id="user_email" class="form-control">
                                        <input type="hidden" value="<?php echo stripslashes($arr_admin_detail['user_email']); ?>" name="old_email" id="old_email" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email Id">Change Password</label>
                                        <input type="checkbox" class="form-control hide-show-pass-div" name="change_password" id="change_password">
                                    </div>
                                    <div id="change_password_div" style="display:none;">
                                        <div class="form-group">
                                            <label for="Password">Password <sup class="mandatory">*</sup></label>
                                            <input type="password" id="user_password" name="user_password" class="form-control">
                                            <div class="password-meter" style="display:none">
                                                <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                                <div class="password-meter-bg">
                                                    <div class="password-meter-bar password-meter-too-short"></div>
                                                </div>
                                            </div>
                                            <span> (Password must be combination of atleast 1 number, 1 special character and 1 upper case letter with minimum 8 characters) </span> </div>

                                        <div class="form-group">
                                            <label for="Confirm Password">Confirm Password<sup class="mandatory">*</sup></label>
                                            <input type="password" value="" name="confirm_password" id="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender">Gender<sup class="mandatory">*</sup></label>
                                        <input  class="form-control" id="gender" type="radio" value="1"  name="gender" <?php if ($arr_admin_detail['gender'] == 1) { ?> checked="checked"<?php } ?> >
                                        Male
                                        <input id="gender" type="radio" value="2" name="gender" <?php if ($arr_admin_detail['gender'] == 2) { ?> checked="checked"<?php } ?>>
                                        Female
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" name="btn_submit" class="btn btn-primary" value="Save" id="btnSubmit">Save Changes</button>
                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo intval(base64_decode($edit_id)); ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
<?php $this->load->view('backend/sections/footer'); ?>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/admin-manage/edit-admin.js"></script>
        <script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>