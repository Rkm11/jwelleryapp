<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_Template extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('product_model');
        $this->load->model('notification_template_model');
    }

    /*
     * function to display all the notification templates pages 
     */

    public function index() {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the notification template model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('1', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if (count($_POST)) {
            if (isset($_POST['btn_delete_all'])) {
                $arr_product_ids = $this->input->post('checkbox');
                if (count($arr_product_ids) > 0) {
#deleting the user selected
                    $this->common_model->deleteRows($arr_product_ids, "mst_notification_templates", "notification_template_id");
                    $this->session->set_userdata("msg", "<span class='success'>Notification template deleted successfully!</span>");
                    redirect(base_url() . 'backend/notification-template/list');
                }
            }
        }
        /*         * getting all notification templates from notification template table. ** */
        $data['arr_notification_templates'] = $this->notification_template_model->getNotificationTemplateDetails();
        $data['title'] = "Manage Notification Templates";
        $this->load->view('backend/notification-template/list', $data);
    }

    /*
     * function for edi tnotification template 
     */

    public function editNotificationTemplate($notification_template_id = '') {
        /*         * * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the notification template model ** */
        $data = $this->common_model->commonFunction();
        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('1', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $arr_privileges = array();

        if ($this->input->post('input_subject') != '') {
            $related_products = implode(',', $this->input->post('related_products'));
            $arr_to_update = array(
                "notification_template_subject" => $this->input->post('input_subject'),
                "notification_template_content" => $this->input->post('text_content'),
                "date_updated" => date("Y-m-d H:i:s"),
                "product_ids" => $related_products,
                "lang_id" => '17'
            );
            $notification_template_id_to_update = $this->input->post('notification_template_hidden_id');
            $this->notification_template_model->updateNotificationTemplateDetailsById($notification_template_id_to_update, $arr_to_update);
            $this->session->set_userdata('msg', 'Notification Template details has been updated successfully.');
            redirect(base_url() . "backend/notification-template/list");
        }
        /*         * getting all notification templates from notification template table ** */
        $data['arr_notification_template_details'] = $this->notification_template_model->getNotificationTemplateDetailsById($notification_template_id);
        $data['products'] = $this->product_model->getAllProducts();
        $data['title'] = "Edit Notification Templates";
        $data['notification_template_id'] = $notification_template_id;
        $this->load->view('backend/notification-template/edit-notification-template', $data);
    }

    public function add() {
        /*         * * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the notification template model ** */
        $data = $this->common_model->commonFunction();
        //checking for admin privilages
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('1', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $arr_privileges = array();

        if ($this->input->post('input_subject') != '') {
            $related_products = implode(',', $this->input->post('related_products'));

            $arr_to_insert = array(
                "notification_template_title" => str_replace(" ", "-", $this->input->post('inputTitle')),
                "notification_template_subject" => $this->input->post('input_subject'),
                "notification_template_content" => $this->input->post('text_content'),
                "date_created" => date("Y-m-d H:i:s"),
                "product_ids" => $related_products,
                "lang_id" => '17',
                "type"=>'normal'
            );
//                   echo "<pre>";print_r($related_products);die;
            $this->common_model->insertRow($arr_to_insert, 'mst_notification_templates');
            $this->session->set_userdata('msg', 'Notification Template details has been added successfully.');
            redirect(base_url() . "backend/notification-template/list");
        }
        $data['products'] = $this->product_model->getAllProducts();
        $data['title'] = "Add Notification Templates";
        $this->load->view('backend/notification-template/add-notification-template', $data);
    }

}
