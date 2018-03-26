<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->load->model('common_model');
        $this->load->model('user_model');
    }
    //function to use company notification display for advertisement.   
    public function my_notification($pg = 0) {
         if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        #This condition to check user login or not then return back the page.
        $data['global'] = $this->common_model->getGlobalSettings();
        $onedaybefore = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . "-1 days"));
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $data['arr_user_data'] = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = end($data['arr_user_data']);
        $data['arr_mst_user_details'] = $data['arr_user_data'];
        $data['notificationInfo1'] = $this->notification_model->getAllNotificationByPost($data['user_session']['user_id'],$data['user_session']['user_type']);
        $this->load->library('pagination');
        $data['count'] = count($data['notificationInfo1']);
        $config['base_url'] = base_url() . 'my-notification/';
        $config['total_rows'] = count($data['notificationInfo1']);
        $config['total_rows'];
        $config['per_page'] = 10;
        $config['cur_page'] = $pg;
        $data['cur_page'] = $pg;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="pagination-div text-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $this->pagination->initialize($config);
        $data['create_links'] = $this->pagination->create_links();
        $data['notificationInfo'] = $this->notification_model->getAllNotificationByPost($data['user_session']['user_id'],$data['user_session']['user_type'], $config['per_page'], $pg);
        $data['page'] = $pg;
         if (count($_POST) > 0) {
            if (isset($_POST['notification_ids'])) {
                #getting all ides selected
                $arr_notification_ids = $this->input->post('notification_ids');
                if (count($arr_notification_ids) > 0) {
                    if (count($arr_notification_ids) > 0) {
                        $this->common_model->deleteRows($arr_notification_ids, "mst_notifications", "notification_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Records deleted successfully!</span>");
                    echo json_encode(array("error" => "0", "error_message" => ""));
                    die;
                } else {
                    echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
                    die;
                }
            }
        }
        $data['site_title'] = 'My Notifications';
        $data['user_session'] = $this->session->userdata('user_account');
        $data['allNotifications'] = $this->notification_model->getAllNotificationDetails($data['user_session']['user_id'],$data['user_session']['user_type']);
        $this->session->set_userdata('allNotifications',count($data['allNotifications']));
        $this->load->view('front/includes/header', $data);
        //$this->load->view('front/includes/profile-left-menu', $data);
        $this->load->view('front/notifications/my-notifications', $data);
       // $this->load->view('front/includes/footer');
    }

   //function to use delete company notification.   

    public function delete_notification($notificationId) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('not_login', 'yes');
            redirect('signin');
        }
        $this->notification_model->deleteNotification($notificationId);
        $this->session->set_userdata("remove_notification", "Notification has been deleted successfully.");
        redirect(base_url() . 'my-notification');
    }

    #function to use delete company notification.   

    public function notification_details($notificationId) {
        #This condition to check user login or not then return back the page.
         $notificationId=  base64_decode($notificationId);
         $data = $this->common_model->commonFunction();
       
        $data['user_session'] = $this->session->userdata('user_account');
        //update notification status read or unread
        $this->notification_model->updatedNotificationStatus($notificationId);
        //get all notification count
        $arr_notification_details = $this->notification_model->getAllNotificationDetails($data['user_session']['user_id'],$data['user_session']['user_type']);
        $notification_count = COUNT($arr_notification_details);
        $this->session->set_userdata('allNotifications',$notification_count);
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $data['arr_user_data'] = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = end($data['arr_user_data']);
        $data['arr_mst_user_details'] = $data['arr_user_data'];
        $data['site_title'] = 'Notifications Details';
        $data['pagevalue'] = "notification_detail_page";

        /*         * ************* getting notifiaction details *********************** */
        $data['notificationInfo'] = $this->notification_model->getNotificationDetails($notificationId);
        if(COUNT($data['notificationInfo'])>0){
            $data['notificationInfo'] = $data['notificationInfo'][0];
        }else{
            redirect(base_url().'my-notification');
        }
        
        /*         * ************* getting notifiaction details end *********************** */

        $this->load->view('front/includes/header', $data);
       // $this->load->view('front/includes/top-nav', $data);
       // $this->load->view('front/includes/profile-left-menu',$data);
        $this->load->view('front/notifications/notifications-details', $data);
       // $this->load->view('front/includes/footer');
    }
    
    public function sendNotification($template_id){
//        echo $template_id;
        $arr_notifications=end($this->common_model->getRecords('mst_notification_templates','',array('notification_template_id'=>$template_id)));
        $arr_users=$this->common_model->getRecords('mst_users','',array('user_type'=>'1','user_status'=>'1'));
        $subject=strip_tags($arr_notifications['notification_template_subject']);
        $subject=  str_replace('\n', '', $subject);
        $subject=  str_replace('\r', '', $subject);
        $subject=  str_replace('\t', '', $subject);
        $message=strip_tags($arr_notifications['notification_template_content']);
        $message=  str_replace('\n', '', $message);
        $message=  str_replace('\r', '', $message);
        $message=  str_replace('\t', '', $message);
        foreach ($arr_users as $users){
            $arr_insert=array(
                'notification_to'=>$users['user_id'],
                'subject'=>  $subject,
                'message'=>  $message,
                'product_ids'=>$arr_notifications['product_ids'],
                'redirect-url'=>'ws-recommended-products',
            );
            $this->common_model->insertRow($arr_insert, 'mst_notifications');
        }
        
      $this->session->set_userdata('msg', 'Notification Sent Successfully.');
            redirect(base_url() . "backend/notification-template/list");  
    }
}
