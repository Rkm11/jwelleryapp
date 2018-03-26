<div class="dashboard-section" style="padding: 5%">
    <div class="media dash-left-otr">
        <div class="media-body dash-right-otr ims-page">
            <div class="dash-right">
                <div class="dash-right-inn">
                    <div class="page-header">
                        <h1>Notification details <span class="pull-right ims-links"><a title="Back"  class="btn btn-danger align-right" href="<?php echo base_url(); ?>my-notification"><i class="fa fa-arrow-circle-left"></i> Back</a></span></h1>
                        
                    </div>
                    <div class="notification-details">
                        <h3> <?php echo(isset($notificationInfo['subject'])) ? $notificationInfo['subject'] : ''; ?></h3>
                        <h5><i class="fa fa-calendar"></i> <?php echo(isset($notificationInfo['notification_date'])) ? date('d M , Y', strtotime($notificationInfo['notification_date'])) : ''; ?></h5>
                        <p><?php echo(isset($notificationInfo['message'])) ? $notificationInfo['message'] : ''; ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
