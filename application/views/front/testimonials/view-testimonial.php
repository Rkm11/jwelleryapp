<div class="middle_content inner-page-middle">
    <div class="container">
           <?php if ($this->session->userdata('testimonial-add') != '') { ?>
                <div class="msg_close alert alert-success">
                    <button class="close" id="msg_close" name="msg_close" data-dismiss="alert" type="button">x</button>
                    <?php echo $this->session->userdata('testimonial-add'); ?>
                </div>
                <?php
                $this->session->unset_userdata('testimonial-add');
            }
            ?>
        <div class="row  testimonials-page">
           
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <div class="page-header"><h1>Testimonials<a href="<?php echo base_url(); ?>add-testimonial" class="pull-right btn btn-danger ">Add Testimonial</a></h1></div>
                <div class="row testimonials testimonials-v2 testimonials-bg-default">
                    <?php
                    if (count($arr_testimonials) > 0) {
                        $i = -1;
                        foreach ($arr_testimonials as $testimonial) {
                            ?>
                            <div class="col-xs-12">
                                <div class="item">
                                    <p class="rounded-3x"><?php echo nl2br(stripcslashes($testimonial['testimonial'])); ?></p>
                                    <div class="testimonial-info">
                                        <span class="testimonial-author">
                                            <?php echo $testimonial['name']; ?>
                                            <hr>      
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No testimonial added yet.";
                    }
                    ?>
                </div>
                <?php if($create_links!=''){
                    echo '<strong>'.$create_links.'<strong>';
                } ?>
            </div>
        </div>
    </div>
</div>




