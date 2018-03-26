<?php
/* * making sure that array having only one record.** */
$arr_notification_template_details = end($arr_notification_template_details);
?>
<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/backend/css/chosen.css" />
<!--    <style>
		/* RESET */
		html, body, div, span, h1, h2, h3, h4, h5, h6, p, blockquote, a,
		font, img, dl, dt, dd, ol, ul, li, legend, table, tbody, tr, th, td
		{margin:0px;padding:0px;border:0;outline:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;list-style:none;}
		a img {border: none;}
		ol li {list-style: decimal outside;}
		fieldset {border:0;padding:0;}

		body { font-family: sans-serif; font-size: 1em; }

		div#container { width: 780px; margin: 0 auto; padding: 1em 0;  }
		p { margin: 1em 0; max-width: 700px; }
		h1 + p { margin-top: 0; }

		h1, h2 { font-family: Georgia, Times, serif; }
		h1 { font-size: 2em; margin-bottom: .75em; }
		h2 { font-size: 1.5em; margin: 2.5em 0 .5em; border-bottom: 1px solid #999; padding-bottom: 5px; }
		h3 { font-weight: bold; }

		ul li { list-style: disc; margin-left: 1em; }
		ol li { margin-left: 1.25em; }

		div.side-by-side { width: 100%; margin-bottom: 1em; }
		div.side-by-side > div { float: left; width: 50%; }
		div.side-by-side > div > em { margin-bottom: 10px; display: block; }

		a { color: orange; text-decoration: underline; }

		.faqs em { display: block; }

		.clearfix:after {
			content: "\0020";
			display: block;
			height: 0;
			clear: both;
			overflow: hidden;
			visibility: hidden;
		}

		footer {
			margin-top: 2em;
			border-top: 1px solid #666;
			padding-top: 5px;
		}
	</style>-->
<aside class="right-side">
    <section class="content-header">

        <h1> Add Email Template	</h1>            
        <ol class="breadcrumb">

            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/notification-template/list"><i class="fa fa-fw fa-envelope"></i> Manage Notification Templates</a></li>
            <li>Add Notification Template</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="frm_notification_template"  id="frm_notification_template" action="<?php echo base_url(); ?>backend/notification-template/add" method="POST" >
                        <div class="box-body">
                            <div class="form-group">
                                <label for="parametername">Notification Template Title<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr"   class="form-control" name="inputTitle" id="inputTitle"  value=""/>

                            </div>
                            <div class="form-group">
                                <label for="parametername">Notification Template Subject<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr"   class="form-control" name="input_subject" id="input_subject"  />

                            </div>
                            <div class="form-group">
                                <label for="parametername">Notification Template Content<sup class="mandatory">*</sup></label>
                                <textarea class="form-control" class="ckeditor" name="text_content" id="text_content"> </textarea>
                                <div class="error hidden" id="labelProductError">Please enter the notification template content.</div>
                            </div>
                            <div class="form-group">
                                <label for="parametername">Related Products</label>
                                <select  class="combobox form-control chzn-select"  multiple style="width:350px;" name="related_products[]" id="related_products" >
                                    <?php
                                    foreach ($products as $val) {
                                        ?>
                                        <option value="<?php echo $val['product_id']; ?>"><?php echo $val['product_name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="btn_submit" class="btn btn-primary" value="Save Changes" id="btnSubmit">Save Changes</button>

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
                $(".chzn-select").chosen(); 
                $(".chzn-select-deselect").chosen({allow_single_deselect:true});
                jQuery("#frm_notification_template").validate({
                    errorElement: 'label',
                    rules: {
                        input_subject: {
                            required: true
                        },
                        text_content: {
                            required: true
                        }
                    },
                    messages: {
                        input_subject: {
                            required: "Please enter the notification template subject."
                        },
                        text_content: {
                            required: "Please enter the notification template content."
                        }
                    },
                    // set this class to error-labels to indicate valid fields
                    submitHandler: function (form) {

                        if ((jQuery.trim(jQuery("#cke_1_contents iframe").contents().find("body").html())).length < 12)
                        {
                            jQuery("#labelProductError").removeClass("hidden");
                            jQuery("#labelProductError").show();
                        }
                        else {
                            jQuery("#labelProductError").addClass("hidden");
                            $('#btnSubmit').hide();
                            form.submit();
                        }
                    }
                });
                CKEDITOR.replace('text_content',
                        {
                            filebrowserUploadUrl: '<?php echo base_url(); ?>upload-image'
                        });

            });
            function insertText(obj) {
                newtext = obj.value;
                console.log(newtext);
                CKEDITOR.instances['text_content'].insertText(newtext);

            }
        </script>