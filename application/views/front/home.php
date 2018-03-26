<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons">Home</h1>
                </div>
            </div>
        </div>
    </div>  
    <?php if ($this->session->userdata('logout_message') != '') { ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->userdata('logout_message'); ?>
        </div>
        <?php
        $this->session->unset_userdata('logout_message');
    }
    ?>
    <?php if ($this->session->userdata('edit_profile_success_with_email') != '') { ?>
        <div class="alert alert-success">
            <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
            <strong></strong> <?php echo $this->session->userdata('edit_profile_success_with_email'); ?>
        </div>
        <?php
        $this->session->unset_userdata('edit_profile_success_with_email');
    }
    ?>
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content 
                    Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content Welcome page content 
                </div>
            </div>
    </section>
    <br>
</div>

