<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<aside class="right-side">
    <section class="content-header">

        <h1>
            <?php echo (isset($edit_id) && $edit_id != "") ? "Update" : "Add New"; ?> Testimonial</li>    
        </h1>            
        <ol class="breadcrumb">

            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/testimonial/list"><i class="fa fa-fw fa-retweet"></i> Manage Testimonials</a></li>
            <li class="active"><?php echo (isset($edit_id) && $edit_id != "") ? "Update" : "Add"; ?> Testimonial</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="frmTestimonials" id="frmTestimonials" action="<?php echo base_url(); ?>backend/testimonial/add" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo(isset($edit_id)) ? $edit_id : '' ?>">					 
                        <div class="box-body">
                            <?php if ($this->config->item('is_multi_language') == 'Yes') {
                                ?>	
                                <div class="form-group">
                                    <label for="parametername">Language<sup class="mandatory">*</sup></label>
                                    <select class="form-control" name="lang_id" id="lang_id">
                                        <option value="">Select Language</option>
                                        <?php foreach ($arr_get_language as $languages) { ?>
                                            <option value="<?php echo $languages['lang_id'] ?>" <?php echo(isset($arr_testimonial['lang_id']) && ($languages['lang_id'] == $arr_testimonial['lang_id'])) ? 'selected' : ''; ?>><?php echo $languages['lang_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('lang_id'); ?>

                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="lang_id" id="lang_id" value="17" />
                            <?php } ?>	
                            <div class="form-group">
                                <label for="parametername">Name<sup class="mandatory">*</sup></label>
                                <input type="text" autofocus  class="form-control" name="inputName" value="<?php echo stripslashes(isset($arr_testimonial['name'])) ? $arr_testimonial['name'] : ''; ?>"   />

                            </div>
                            <div class="form-group">
                                <label for="parametername">Testimonial<sup class="mandatory">*</sup></label>
                                <textarea rows="6"  class="form-control" name="inputTestimonial"><?php echo stripslashes(isset($arr_testimonial['testimonial'])) ? $arr_testimonial['testimonial'] : ''; ?></textarea>

                            </div>

                            <div class="form-actions">
                                <button type="submit" name="btnSubmit" class="btn btn-primary" id="btnSubmit" value="Save Changes">Save <?php echo (isset($edit_id) && $edit_id != "") ? "Changes" : ""; ?> </button>
                                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
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
            $(document).ready(function () {
                jQuery("#frmTestimonials").validate({
                    errorElement: 'label',
                    rules: {
                        lang_id: {
                            required: true
                        },
                        inputTestimonial: {
                            required: true,
                            minlength: 20
                        },
                        inputName: {
                            required: true
                        }
                    },
                    messages: {
                        lang_id: {
                            required: "Please select language."
                        },
                        inputTestimonial: {
                            required: "Please enter testimonial.",
                            minlength: "Please enter at least 20 characters."
                        },
                        inputName: {
                            required: "Please enter name."
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