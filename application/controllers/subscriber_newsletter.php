<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscriber_Newsletter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('subscriber_newsletter_model');
        $this->load->model('common_model');
        $this->load->model('user_model');
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
    }

    public function listSubscriberNewsletter() {
        #Getting Common data
        $data = $this->common_model->commonFunction();
        #using the subscribernewsletter model
        #checking user has privilige for the Manage newsletter
        if ($data['user_account']['role_id'] != 1) {
            #an admin which is not super admin not privileges to access Manage Role
            #setting session for displaying notiication message.
            $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage newsletter!</span>");
            redirect(base_url() . "backend/home");
        }

        if (isset($_POST['btn_delete_all'])) {
            #getting all ides selected
            $arr_newsletter_ids = $this->input->post('checkbox');
            if (count($arr_newsletter_ids) > 0) {
                if (count($arr_newsletter_ids) > 0) {
                   
                    $this->common_model->deleteRows($arr_newsletter_ids, "trans_newsletter_subscription", "newsletter_subscription_id");
                }
                $this->session->set_userdata("msg", "<span class='success'>Newsletter Subscriber deleted successfully!</span>");
            }
        }

        $data['title'] = "Manage Subscriber Newsletter";
        $data['arr_newsletter_list'] = $this->subscriber_newsletter_model->getSubscriberNewsletterDetails();
        $this->load->view('backend/subscriber-newsletter/list', $data);
    }

    public function changeStatus() {
        if ($this->input->post('newsletter_subscription_id') != "") {
            /* updating the article status. */
            $arr_to_update = array("subscribe_status" => $this->input->post('subscribe_status'));
            /* condition to update record for the article status */
            $condition_array = array('newsletter_subscription_id' => intval($this->input->post('newsletter_subscription_id')));
            $this->common_model->updateRow('trans_newsletter_subscription', $arr_to_update, $condition_array);
            $arr_newsletter_list = $this->subscriber_newsletter_model->getSubcriberNewsletterDetailsById($this->input->post('newsletter_subscription_id'));

            echo json_encode(array("error" => "0", "error_message" => ""));
        } else {
            /* if something going wrong providing error message.  */
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

}
