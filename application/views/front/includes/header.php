<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo isset($meta_description)?$meta_description:'Panacea';?>">
		<meta name="keyword" content="<?php echo isset($meta_keywords)?$meta_keywords:'Panacea';?>">
        <meta name="author" content="Anuj">        
        <title><?php
            if ($site_title != '') {
                echo $site_title;
            } else if ($header['title'] != "") {
                echo $header['title'];
            } elseif ($global['site_title'] != "") {
                echo $global['site_title'];
            } else {
                echo base_url();
            }
            ?></title> 
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/bootstrap.css" media="screen">
        <script src="<?php echo base_url(); ?>media/front/js/jquery-v2.1.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/validation.js"></script>       
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
   <script type="text/javascript">
        var javascript_site_path = "<?php echo base_url(); ?>";
        $(document).ready(function(e) {
            jQuery('.close').click(function() {
                $(this).parent('div').slideUp('slow');
            });
        });
    </script>
</head>
<body>
    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <div class="navbar-brand"><a href="<?php echo base_url(); ?>" style="color: #ffffff;">Page Header</a></div>
            </div>

            <?php $user_session = $this->session->userdata("user_account"); ?>

            <div class="navbar-header" style="float: right;">
                <?php if ($user_session['user_id'] != '') { ?>
                    <div class="navbar-brand"><a href="<?php echo base_url(); ?>profile" style="color: #ffffff;">Welcome <?php echo ucfirst($user_session['user_name']); ?>!</a></div>
                    <div class="navbar-brand"><a href="<?php echo base_url(); ?>logout" style="color: #ffffff;">Logout</a></div>
                <?php } else { ?>
                    <div class="navbar-brand"><a href="<?php echo base_url(); ?>signup" style="color: #ffffff;">Sign up</a></div>
                    <div class="navbar-brand"><a href="<?php echo base_url(); ?>signin" style="color: #ffffff;">Sign in</a></div>            
                <?php } ?>
            </div>
        </div>    
    </div>

    <?php
    if ($this->session->userdata('msg') != "") {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php
            echo $this->session->userdata('msg');
            $this->session->unset_userdata('msg');
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if ($this->session->userdata('msg_account_updated') != "") {
        ?>
        <div class="alert alert-info">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php
            echo $this->session->userdata('msg_account_updated');
            $this->session->unset_userdata('msg_account_updated');
            ?>
        </div>
        <?php
    }
    ?>

    <?php if ($this->session->userdata('invalid_password_link') != '') { ?>
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('invalid_password_link'); ?>
        </div>
        <?php
        $this->session->unset_userdata('invalid_password_link');
    }
    ?>

    <?php if ($this->session->userdata('register_success') != '') { ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('register_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('register_success');
    }
    ?>
    <?php if ($this->session->userdata('login_error') != '') { ?>
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->userdata('login_error'); ?>
        </div>
        <?php
        $this->session->unset_userdata('login_error');
    }
    ?>
    <?php if ($this->session->userdata('activation_error') != '') { ?>
        <div class="alert alert-warning">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->userdata('activation_error'); ?>
        </div>
        <?php
        $this->session->unset_userdata('activation_error');
    }
    ?>
    <?php if ($this->session->userdata('password_recover') != '') { ?>  
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->userdata('password_recover'); ?>
        </div>
        <?php
        $this->session->unset_userdata('password_recover');
    }
    ?>

    <?php if ($this->session->userdata('edit_profile_success') != '') { ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('edit_profile_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('edit_profile_success');
    }
    if ($this->session->userdata('edit_profile_success_with_email') != '') {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('edit_profile_success_with_email'); ?>
        </div>
        <?php
        $this->session->unset_userdata('edit_profile_success_with_email');
    }
    if ($this->session->userdata('edit_profile_picture_success') != '') {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('edit_profile_picture_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('edit_profile_picture_success');
    }
    if ($this->session->userdata('testimonial_success') != '') {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('testimonial_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('testimonial_success');
    }
    if ($this->session->userdata('testimonial_success') != '') {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('testimonial_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('testimonial_success');
    }
    if ($this->session->userdata('contact_success') != '') {
        ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('contact_success'); ?>
        </div>
        <?php
        $this->session->unset_userdata('contact_success');
    }
    if ($this->session->userdata('contact_fail') != '') {
        ?>
        <div class="alert alert-danger">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->userdata('contact_fail'); ?>
        </div>
        <?php
        $this->session->unset_userdata('contact_fail');
    }
    ?>