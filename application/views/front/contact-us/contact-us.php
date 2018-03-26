        <script src="<?php echo base_url(); ?>media/front/js/captcha.js"></script>
       <script type="text/javascript">
     		jQuery(document).ready(function(e) {
        // Call captcha function to load the security code
        refreshCaptha();
       
     });
</script>

    <body>
        <div id="container" class="container">
            <div class="h1">Welcome to Contact Us Module! </div>
            <section>                
                <div class="panel-group">  
                    <div class="col-xs-12 col-md-5 panel panel-default">
                        <div class="col-lg-12">
                            <h1 id="buttons">Contact Us</h1>  
                        </div>
                        <p><?php echo stripslashes($message); ?></p>
                        <address>
                            <strong>Contact</strong>
                            <p>City: <?php echo $city ?></p>
                            <p>Street: <?php echo $street ?></p>
                            <p>Zip code: <?php echo $zip_code ?></p>
                            <p>Phone: +<?php echo $phone_no ?></p>
                            <p>Email: <?php echo $contact_email ?></p>
                            <strong>Address</strong>
                            <p>
                                <?php echo $address ?>
                            </p>
                        </address>
                    </div>
                    <div class="panel panel-default">
                        <form name="form_contact_us" class="form-horizontal" id="form_contact_us" action="<?php echo base_url(); ?>contact-us" method="post" style="padding:4%;">
                            <div class="controls">
                                <label>Name<span class="mandatory">*</span></label>
                                <div class="input_holder">
                                    <input type="text" name="first_name" class="form-control" id="first_name">
                                </div>
                            </div>
                            
                            <div class="controls">                                    
                                <label>
                                    Email<span class="mandatory">*</span>
                                </label>                                       
                                <div class="input_holder">
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="controls">                                 
                                <label>
                                    Subject<span class="mandatory">*</span>
                                </label>  
                                <div class="input_holder">
                                    <input type="text" name="subject" id="subject" class="form-control">
                                </div>
                            </div>
                            <div class="controls">
                                <label>
                                    Message<span class="mandatory">*</span>
                                </label>  
                                <div class="input_holder">
                                    <textarea name="message" id="message" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="controls">
                                <label for="captcha" class="col-lg-2 control-label">&nbsp;</label>
                                <div class="input_holder">
                                    <img src="" id="captcha" class="captcha"/>

                                    <a href="javascript:void(0)" onClick="refreshCaptha();" >
                                        <img src="<?php echo base_url(); ?>media/front/img/refresh.png" width="35px"></a>
                                </div>
                            </div>
                            <div class="controls">
                                <label>Enter the security code:<span class="mandatory">*</span></label>
                                <div class="input_holder">
                                    <input type="text" name="input_captcha_value" class="form-control" id="input_captcha_value">
                                </div>
                            </div>
                            <div class="controls">
                                <div class="col-lg-11">
                                    &nbsp;
                                </div>
                                <div class="input_holder">
                                    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Send" class="pull-right">
                                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <br>           
    </div>
</body>
</html>