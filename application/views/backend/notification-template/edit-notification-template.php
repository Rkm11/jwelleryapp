<?php
$arr_notification_template_details = end($arr_notification_template_details);
//$arr_products=  explode(',', $arr_notification_template_details['product_ids']);
//$id='10';
//if(in_array($id,$arr_products)){
//    echo "ss";
//}
//print_r($arr_products);die;
/* * making sure that array having only one record.** */
?>
<?php $this->load->view('backend/sections/header'); ?>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script>
<aside class="right-side">
    <section class="content-header">

        <h1> Edit Email Template	</h1>            
        <ol class="breadcrumb">

            <li> <a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>  </li>
            <li> <a href="<?php echo base_url(); ?>backend/notification-template/list"><i class="fa fa-fw fa-envelope"></i> Manage Notification Templates</a></li>
            <li>Edit Notification Template</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <form name="frm_notification_template"  id="frm_notification_template" action="<?php echo base_url(); ?>backend/edit-notification-template/<?php echo(isset($notification_template_id)) ? $notification_template_id : ''; ?>" method="POST" >
                        <input type="hidden" name="notification_template_hidden_id" id="notification_template_hidden_id" value="<?php echo (isset($notification_template_id)) ? $notification_template_id : ''; ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="parametername">Notification Template Title<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr" disabled="disabled"  class="form-control" name="inputTitle" id="inputTitle"  value="<?php echo strip_slashes(ucwords(str_replace("-", " ", $arr_notification_template_details['notification_template_title']))); ?>"/>

                            </div>
                            <div class="form-group">
                                <label for="parametername">Notification Template Subject<sup class="mandatory">*</sup></label>
                                <input type="text" dir="ltr"   class="form-control" name="input_subject" id="input_subject"  value="<?php echo str_replace("\n", "", $arr_notification_template_details['notification_template_subject']); ?>"/>

                            </div>
                            <div class="form-group">
                                <label for="parametername">Notification Template Content<sup class="mandatory">*</sup></label>
                                <textarea class="form-control" class="ckeditor" name="text_content" id="text_content"> <?php echo stripcslashes($arr_notification_template_details['notification_template_content']); ?></textarea>
                                <div class="error hidden" id="labelProductError">Please enter the notification template content.</div>
                            </div>
                            <div class="form-group">
                                <label for="parametername">Related Products</label>
                                <select  class="combobox form-control chzn-select"  multiple style="width:350px;" name="related_products[]" id="related_products" >
                                    <?php
                                    $arr_products=  explode(',', $arr_notification_template_details['product_ids']);
                                    foreach ($products as $val) {
                                        ?>
                                    <option  value="<?php echo $val['product_id']; ?>" <?php if (in_array($val['product_id'],$arr_products )) {  ?> selected="selected" <?php } ?>><?php echo $val['product_name']; ?> </option>
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