<div class="sign-mem-box"> 
    <?php
    if (count($arr_advertise_middle) > 0) {
        foreach ($arr_advertise_middle as $val) {
            ?>
            <?php
            if ($val['advertise_type'] == 'Script') {
                echo stripslashes($val['script']);
            } else {
                ?>
                <a href="<?php echo urldecode($val['redirect_url']); ?>" target="_blank" >
                    <img src="<?php echo base_url(); ?>media/front/img/advertise/thumbs/<?php echo $val['image_name']; ?>" class="img-responsive">
                </a>
                <?php
            }
        }
    } else {
        ?>
        <img src="<?php echo base_url(); ?>media/front/img/add-banner-big.png" class="img-responsive"> 
    <?php } ?>
</div>
<div class="sign-mem-box"> 
    <?php
    if (count($arr_advertise_right) > 0) {
        foreach ($arr_advertise_right as $val) {
            ?>
            <?php
            if ($val['advertise_type'] == 'Script') {
                echo stripslashes($val['script']);
            } else {
                ?>
                <a href="<?php echo urldecode($val['redirect_url']); ?>" target="_blank" >
                    <img src="<?php echo base_url(); ?>media/front/img/advertise/thumbs/<?php echo $val['image_name']; ?>" class="img-responsive">
                </a>
                <?php
            }
        }
    } else {
        ?>
        <img src="<?php echo base_url(); ?>media/front/img/add-banner-big.png" class="img-responsive"> 
    <?php } ?>
</div>