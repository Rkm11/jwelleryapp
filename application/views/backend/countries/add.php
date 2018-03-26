<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">

        <h1>
            Add New Country</li>     
        </h1>            
        <ol class="breadcrumb">

            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/countries"> <i class="fa fa-fw fa-home"></i> Manage Countries</a></li>
            <li class="active"> Add Country</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="add_country_form" id="add_country_form" action="<?php echo base_url(); ?>backend/countries/add" method="POST" >
                        <input type="hidden" name="edit_id" value="<?php echo(isset($edit_id)) ? $edit_id : '' ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Country Name">Country Name<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr"  class="form-control" name="country_name" id="country_name" />

                            </div>
                            <div class="form-group">
                                <label for="Country ISO">Country ISO<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr"  class="form-control" name="country_iso_name" id="country_iso_name" />
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="btn_submit" class="btn btn-primary" value="Save" id="btnSubmit">Save</button>
                            <img src="<?php echo base_url(); ?>media/front/img/loader.gif" style="display: none;" id="loding_image">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        <?php $this->load->view('backend/sections/footer.php'); ?>
        <script type="text/javascript" language="javascript">
            jQuery(document).ready(function () {

                jQuery("#add_country_form").validate({
                    errorElement: 'div',
                    rules: {
                        country_iso_name: {
                            required: true,
                            remote: {
                                url: "<?php echo base_url() ?>backend/check-country-iso",
                                type: "post",
                                data: {}
                            }
                        },
                        country_name: {
                            required: true,
                            remote: {
                                url: "<?php echo base_url() ?>backend/check-country-name",
                                type: "post",
                                data: {}
                            }
                        }
                    },
                    messages: {
                        country_iso_name: {
                            required: "Please enter country ISO name.",
                            remote: "This ISO code is already exists. "
                        },
                        country_name: {
                            required: "Please enter country name.",
                            remote: "This country is already exists. "

                        }
                    },
                    submitHandler: function (form) {
                        $("#btnSubmit").hide();
                        $('#loding_image').show();
                        form.submit();
                    }
                });
            });
        </script>