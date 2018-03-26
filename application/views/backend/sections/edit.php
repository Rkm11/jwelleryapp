<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>

<aside class="right-side">
    <section class="content-header">
        <h1>
            Edit User Details 

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>backend/user/list"><i class="fa fa-user"></i> Manage Users</a></li>
            <li class="active">	Edit User Details  </li>

        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form name="frm_user_details" role="form" id="frm_user_details" action="<?php echo base_url(); ?>backend/user/edit/<?php echo $edit_id; ?>" method="post">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="User Name">First Name <sup class="mandatory">*</sup></label>
                                        <input type="text" value="<?php echo $arr_admin_detail['first_name']; ?>" id="first_name" name="first_name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="Last Name">Last Name <sup class="mandatory">*</sup></label>

                                        <input type="text" name="last_name" id="last_name" value="<?php echo $arr_admin_detail['last_name']; ?>"  class="form-control">
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="User Name">User Name<sup class="mandatory">*</sup></label>

                                        <input type="text" name="user_name" id="customer_name" value="<?php echo $arr_admin_detail['user_name']; ?>" class="form-control">
                                        <input type="hidden" name="old_username" id="old_username" value="<?php echo $arr_admin_detail['user_name']; ?>" class="form-control">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="Email Id">Email Id<sup class="mandatory">*</sup></label>

                                        <input type="text" value=<?php echo stripslashes($arr_admin_detail['user_email']); ?> name="user_email" id="user_email" class="form-control">
                                        <input type="hidden" value=<?php echo stripslashes($arr_admin_detail['user_email']); ?> name="old_email" id="old_email" class="form-control">		
                                    </div>
                                    <div class="form-group">
                                        <label for="Change Password">Change Status<sup class="mandatory">*</sup></label>
                                        <select id="user_status" name="user_status"  class="form-control">
                                            <?php
                                            if ($arr_admin_detail['user_status'] == 0) {
                                                ?>
                                                <option value="">Select Status</option>
                                                <?php
                                            }
                                            ?>
                                            <option value="1" <?php if ($arr_admin_detail['user_status'] == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                            <option value="2" <?php if ($arr_admin_detail['user_status'] == 2) { ?> selected="selected" <?php } ?>>Blocked</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="Change Password">Change User Type<sup class="mandatory">*</sup></label>
                                        <select id="user_type" name="user_type"  class="form-control">
                                            <option value="1" <?php if ($arr_admin_detail['user_type'] == 1) { ?> selected="selected" <?php } ?>>Customer</option>
                                            <option value="3" <?php if ($arr_admin_detail['user_type'] == 3) { ?> selected="selected" <?php } ?>>Whole Seller</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Change Password">Change Password<sup class="mandatory">*</sup></label>

                                        <input type="checkbox" name="change_password" onChange="displayPassword();" id="change_password" class="hide-show-pass-div">	
                                    </div>

                                    <div id="change_password_div" style="display:none;">
                                        <div class="form-group">
                                            <label for="New Password">New Password<sup class="mandatory">*</sup></label>

                                            <input type="password" id="user_password" name="user_password" class="form-control">
                                            <div class="password-meter" style="display:none">
                                                <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                                <div class="password-meter-bg">
                                                    <div class="password-meter-bar password-meter-too-short"></div>
                                                </div>
                                            </div>
                                            <span> (Password must be combination of atleast 1 number, 1 special character and 1 upper case letter with minimum 8 characters) </span> 
                                        </div>

                                        <div class="form-group">
                                            <label for="New Password">Confirm Password<sup class="mandatory">*</sup></label>                               
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="New Password">About Me</label>                               
                                        <textarea class="form-control" name="about_me" id="about_me"><?php echo $arr_admin_detail['about_me']; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="btn_submit" class="btn btn-primary" value="Save changes">Save Changes</button>
                                <input type="hidden" name="edit_id" id="edit_id" value="<?php echo intval(base64_decode($edit_id)); ?>" />
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        <?php $this->load->view('backend/sections/footer.php'); ?>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/edit-user.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/admin-manage/edit-admin.js"></script>
        <script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
