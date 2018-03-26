<div class="" style="padding: 5%; margin-top: -5%">
     <div class="gray-box-head">
     <div class="page-header">
            <h1>Notifications</h1>
        </div>
    </div>
    <div class="gray_bx">
       <label class="btn btn-danger select-all" value="Select all"> <input type="checkbox" name="chk_all" id="chk_all" onChange="check_all();" autocomplete="off"> Select all</label>
        <input type="button" id="btn_delete_all" class="btn btn-danger" value="Delete Selected">
        <a href="javascript:void(0);" onclick="history.go(-1);" class="btn btn-default pull-right">Back</a>
        <div class="row">
            <div class="col-xs-12">
                <?php
                if (count($notificationInfo) > 0) {
                    $flagToday = 0;
                    $flagYesterday = 0;
                    $flagother = 0;
                    $dateArray = array();
                    foreach ($notificationInfo as $notification) {
                        if (date("d-m-Y", strtotime($notification['notification_date'])) == date('d-m-Y')) {
                            ?>
                            <div class="notification-panel">
                                <?php if ($flagToday == 0) {
                                    ?>
                                    <div class="notification-panel-head">
                                        Today
                                    </div>
                                <?php } ?>
                                <div class="notification">
                                    <div class="media">
                                        <span class="delete_notification pull-right"><a onclick="return confirm('Do you really want to delete this notification?');" href="<?php echo base_url(); ?>delete-notification/<?php echo $notification['notification_id']; ?>">X</a></span>
                                        <span class="pull-left">
                                            <strong class="delete_notification-chkbx"><input name="select_box" value="<?php echo $notification['notification_id']; ?>" class="chkselect_one" type="checkbox" autocomplete="off"></strong>
                                            <a href="<?php echo base_url(); ?>notification-details/<?php echo $notification['notification_id']; ?>"></a>
                                        </span>
                                        <div class="media-body">
                                            
                                            <a class="notification-head" href="<?php echo base_url(); ?>notification-details/<?php echo $notification['notification_id']; ?>"><?php echo $notification['subject']; ?></a>
                                            <p class="fade-txt"><?php echo (isset($notification['message'])) ? substr(stripcslashes($notification['message']), 0, 30).".." : ''; ?></p>
                                            <i class="notification-time">at <?php echo date('h:i A', strtotime($notification['notification_date'])); ?></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $flagToday++;
                            } else if (date("d-m-Y", strtotime($notification['notification_date'])) == date("d-m-Y", strtotime(date("d-m-Y", strtotime(date('d-m-Y'))) . "-1 days"))) {

                                if ($flagYesterday < 1) { 
                                    ?>
                                    <div class="notification-panel-head">
                                        Yesterday
                                    </div>
                                <?php } ?>
                                <div class="notification">
                                    <div class="media">
                                        <span class="delete_notification pull-right"><a onclick="return confirm('Do you really want to delete this notification?');" href="<?php echo base_url(); ?>delete-notification/<?php echo $notification['notification_id']; ?>">X</a></span>
                                        <span class="pull-left">
                                            <strong class="delete_notification-chkbx"><input name="select_box" value="<?php echo $notification['notification_id']; ?>" class="chkselect_two" type="checkbox" autocomplete="off"></strong>
                                            <a href="<?php echo base_url(); ?>notification-details/<?php echo $notification['notification_id']; ?>"></a>
                                        </span>
                                        <div class="media-body">                                            
                                            <a class="notification-head" href="<?php echo base_url(); ?>notification-details/<?php echo $notification['notification_id']; ?>"><?php echo $notification['subject']; ?></a>
                                            <p class="fade-txt"><?php echo (isset($notification['message'])) ? substr(stripcslashes($notification['message']), 0, 30).".." : ''; ?></p>
                                            <i class="notification-time">at <?php echo date('h:i A', strtotime($notification['notification_date'])); ?></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $flagYesterday++;
                            } else {
                                if (!(in_array(date("d-m-Y", strtotime($notification['notification_date'])), $dateArray))) {
                                    ?>
                                    <div class="notification-panel-head">
                                        <?php echo date("d-m-Y", strtotime($notification['notification_date'])); ?>
                                    </div>
                                <?php }
                                ?>
                                <div class="notification">
                                    <div class="media">
                                        
                                        <span class="delete_notification pull-right"><a onclick="return confirm('Do you really want to delete this notification?');" href="<?php echo base_url(); ?>delete-notification/<?php echo $notification['notification_id']; ?>">X</a></span>
                                        <span class="pull-left">
                                            <strong class="delete_notification-chkbx"><input name="select_box" value="<?php echo $notification['notification_id']; ?>" class="chkselect_three" type="checkbox" autocomplete="off"></strong>
                                       
                                        </span>
                                        <div class="media-body">
                                          
                                             <a href="<?php echo base_url(); ?>notification-details/<?php echo base64_encode($notification['notification_id']); ?>"><?php echo $notification['subject']; ?></a>
                                            <p class="fade-txt"><?php echo (isset($notification['message'])) ? substr(stripcslashes($notification['message']), 0, 30).".." : ''; ?></p>
                                            <i class="notification-time">at <?php echo date('h:i A', strtotime($notification['notification_date'])); ?></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $dateArray[] = date("d-m-Y", strtotime($notification['notification_date']));
                            }
                        }
                        if($create_links!=""){
                            echo $create_links;
                        }
                        ?>
                        <?php
                    } else {
                        echo 'No notification found';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script>
    function check_all() {
        var checked = $("[name='chk_all']").is(":checked");
        if (checked)
        {
            $("[name='select_box']").prop('checked', true);
        }
        else
        {
            $("[name='select_box']").prop('checked', false);

        }
    }

    jQuery(".chkselect_one").bind("click", function() {
        updateSelectAllOne();
    });
    jQuery(".chkselect_two").bind("click", function() {
        updateSelectAllTwo();
    });
    jQuery(".chkselect_three").bind("click", function() {
        updateSelectAllThree();
    });

    function updateSelectAllOne()
    {

        var totChecked = jQuery(".chkselect_one:checked").length;
        var totCheckboxes = jQuery(".chkselect_one").length;

        if (totChecked < totCheckboxes)
        {
            jQuery("#chk_all").prop('checked', false);
        }
        else
        {
            jQuery("#chk_all").prop('checked', true);

        }
    }
    function updateSelectAllTwo()
    {

        var totChecked = jQuery(".chkselect_two:checked").length;
        var totCheckboxes = jQuery(".chkselect_two").length;

        if (totChecked < totCheckboxes)
        {
            jQuery("#chk_all").prop('checked', false);

        }
        else
        {
            jQuery("#chk_all").prop('checked', true);
        }
    }
    function updateSelectAllThree()
    {

        var totChecked = jQuery(".chkselect_three:checked").length;
        var totCheckboxes = jQuery(".chkselect_three").length;
        
        if (totChecked < totCheckboxes)
        {
         
            jQuery("#chk_all").prop('checked', false);
        }
        else
        {
            jQuery("#chk_all").prop('checked', true);
        }
    }
    jQuery("#btn_delete_all").bind("click", function() {
        var var_bool = false;
        jQuery(".chkselect_one").each(function(index, element) {
            if (jQuery(element).is(":checked"))
                var_bool = true;
        });
        jQuery(".chkselect_two").each(function(index, element) {
            if (jQuery(element).is(":checked"))
                var_bool = true;
        });
        jQuery(".chkselect_three").each(function(index, element) {
            if (jQuery(element).is(":checked"))
                var_bool = true;
        });

        if (var_bool == true) {
            if (confirm("Are you sure to delete these notifications?"))
            {
                var arr_noti_ids = [];

                jQuery(".chkselect_one").each(function(index, element) {

                    if (jQuery(element).is(":checked"))
                        arr_noti_ids.push(jQuery(element).val());

                });

                jQuery(".chkselect_two").each(function(index, element) {

                    if (jQuery(element).is(":checked"))
                        arr_noti_ids.push(jQuery(element).val());

                });
                jQuery(".chkselect_three").each(function(index, element) {

                    if (jQuery(element).is(":checked"))
                        arr_noti_ids.push(jQuery(element).val());

                });

                var obj_params = new Object();
                obj_params.noti_id = arr_noti_ids;
                
                jQuery.post("<?php echo base_url(); ?>delete-all-notofication", obj_params, function(msg) {
                    if (msg.error == "1")
                    {
                        alert(msg.error_message);
                    }
                    else
                    {
                        location.href = location.href;
                    }
                }, "json");
            }
        } else {
            alert('Please select atleast one record to delete');
        }
    });
</script>
