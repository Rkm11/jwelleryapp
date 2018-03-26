<div id="home-slider">
        <div class="md-slide-items md-slider" id="md-slider-1" data-thumb-width="105" data-thumb-height="70">
	<?php foreach ($arr_slider_banner_objects as $banner_objects) { ?>		
                        <div class="md-slide-item slide-0" data-timeout="6000">
				<div class="md-mainimg">
                                    <a href="<?php echo $banner_objects['banner_object_url']; ?>" <?php if($banner_objects['open_url_in_new_page']=="Yes"){ ?> target="_blank" <?php } ?> style="text-decoration: none;">
                                    <img src="<?php echo base_url(); ?>media/front/slider-images/thumbs/<?php echo $banner_objects['banner_object_image']; ?>" alt="">
                                    </a>
                                    </div>
				<div class="md-objects">
					<div class="md-object rs slide-title" data-x="20" data-y="38" data-width="480" data-height="30" data-start="700" data-stop="5500" data-easein="random" data-easeout="keep">
                                            <p><?php echo stripcslashes($banner_objects['banner_object_title']) ? stripcslashes($banner_objects['banner_object_title']) : 'Search Money for Your Creative Ideas?' ?></p>
					</div>
					<div class="md-object rs slide-description" data-x="20" data-y="160" data-width="480" data-height="90" data-start="1400" data-stop="7500" data-easein="random" data-easeout="keep">
					<p><?php echo nl2br(stripcslashes(preg_replace("/[\\n\\r]+/"," ",$banner_objects['banner_object_description_text']))) ? nl2br(stripcslashes(preg_replace("/[\\n\\r]+/"," ",$banner_objects['banner_object_description_text']))) : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' ?></p>
					</div>
					<div class="md-object rs" data-x="20" data-y="260" data-width="120" data-height="23" data-padding-top="9" data-padding-bottom="7" data-padding-left="10" data-padding-right="10" data-start="1800" data-stop="7500" data-easein="random" data-easeout="keep">
				            <a href="javascript:void(0);" class="btn btn-gray">Learn more</a>
					</div>
					<!--<div class="md-object" data-x="495" data-y="0" data-width="612" data-height="365" data-start="1800" data-stop="7500" data-easein="fadeInRight" data-easeout="keep" style=""><img src="<?php echo base_url(); ?>media/front/slider-images/thumbs/<?php echo $banner_objects['banner_object_image']; ?>" alt="Search Money for Your Creative Ideas" width="612" height="365" /></div>-->
				</div>
			</div>
             <?php }?>
		</div>
    </div>