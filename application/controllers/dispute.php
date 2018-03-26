<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dispute extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("user_model");
        $this->load->model("dispute_model");
    }

    public function products() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserDetails($fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];


        $data['products'] = $this->common_model->getRecords("mst_products", '*', array('user_id_fk' => $user_id));

        $data['site_title'] = "Products";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/dispute/products', $data);
        $this->load->view('front/includes/footer', $data);
    }

    public function createDispute($product_id = "") {

        $product_id = base64_decode($product_id);
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['arr_product_details'] = array();
        $data['arr_disputer_details'] = array();
        $data['disputer_id'] = array();

        $data['arr_user_data'] = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id', array("user_id" => $data['user_account']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        if ($product_id != "") {
            $data['arr_product_details'] = $this->dispute_model->getDisputerDetailsById("product_id,product_name,product_status,borrower_id_fk,bid_status,user_id_fk", array("product_id_fk" => $product_id, "bid_status" => "Accepted"), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        } else {
            $arr_product_details = $this->dispute_model->getDisputerDetailsOnCreate($data['user_account']['user_id']);

            foreach ($arr_product_details as $product) {
                if ($data['user_account']['user_id'] == $product['user_id_fk']) {
                    if ($product['deposite_amount'] != '' && $product['deposite_amount'] != '0') {
                        $data['arr_product_details'][] = $product;
                    }
                } else {
                    $data['arr_product_details'][] = $product;
                }
            }
        }
        if (count($data['arr_product_details']) > 0) {
            if ($data['user_account']['user_id'] == $data['arr_product_details'][0]['user_id_fk']) {
                $data['disputer_id'] = $data['arr_product_details'][0]['borrower_id_fk'];
            } else {
                $data['disputer_id'] = $data['arr_product_details'][0]['user_id_fk'];
            }
            $data['arr_disputer_details'] = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id', array("user_id" => $data['disputer_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        }
        if ($this->input->post('product_id_fk') != "") {
            $arr_to_insert = array(
                'product_id_fk' => $this->input->post('product_id_fk'),
                'originator_id' => $data['user_account']['user_id'],
                'disputer_id' => $this->input->post('disputer_id'),
                'dispute_amount' => $this->input->post('dispute_amount'),
                'dispute_description' => $this->input->post('dispute_description'),
                'dispute_date' => date('Y-m-d H:i:s'),
                'dispute_status' => 'active'
            );
            $dispute_id = $this->common_model->insertRow($arr_to_insert, 'mst_dispute');


            $file_name = '';

            if (count($_FILES['upload_files']['name']) > 0) {
                $file_count = count($_FILES['upload_files']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $config['upload_path'] = './media/front/img/dispute-files/';
                    $config['allowed_types'] = '*';
                    $config['file_name'] = time();
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $_FILES['upload_file']['name'] = $_FILES['upload_files']['name'][$i];
                    $_FILES['upload_file']['type'] = $_FILES['upload_files']['type'][$i];
                    $_FILES['upload_file']['tmp_name'] = $_FILES['upload_files']['tmp_name'][$i];
                    $_FILES['upload_file']['size'] = $_FILES['upload_files']['size'][$i];

                    if (!$this->upload->do_upload('upload_file')) {
                        $this->session->set_userdata('invalid_images', "Please select valid image.");
                        redirect(base_url() . 'create-dispute');
                    } else {
                        $this->load->library('image_lib');
                        $data['upload_data'] = $this->upload->data();
                        $image_data = $this->upload->data();
                        $file_name = $image_data['file_name'];

                        $table_name = 'trans_dispute_attachments';
                        $arr_post_image = array('attachment_path' => $file_name, 'dispute_id_fk' => $dispute_id, 'message_id' => '0', 'user_id_fk' => $data['user_account']['user_id']);
                        $this->common_model->insertRow($arr_post_image, $table_name);
                    }
                }
            }

            //notify disputer
            $arr_disputer_details = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id,dispute_raise,user_email', array("user_id" => $this->input->post('disputer_id')), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            $product_details = $this->dispute_model->getRecords('mst_products as u', 'product_name', array("product_id" => $this->input->post('product_id_fk')), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            $reserved_words = array
                (
                "||USER_NAME||" => $arr_disputer_details[0]['user_name'],
                "||ORIGINATOR_NAME||" => $data['arr_user_data'][0]['user_name'],
                "||PRODUCT_NAME||" => $product_details[0]['product_name'],
                "||SITE_TITLE||" => $data['global']['site_title']
            );
            $template_title = 'new-dispute-created';
            $lang_id = 17; // Default is 17(English)
            $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);

            $recipeinets = $arr_disputer_details[0]['user_email'];
            $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
            $subject = $arr_emailtemplate_data['subject'];
            $message = $arr_emailtemplate_data['content'];
            $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);

            $arr_to_insert = array(
                'from' => $user_id,
                'notification_to' => $arr_disputer_details[0]['user_id'],
                'subject' => $subject,
                'message' => $message,
                'notification_status' => 'send',
                'user_type' => 1,
                'notification_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_to_insert, 'mst_notifications');
            header("Location: " . base_url() . "my-disputes");
            exit;
        }

        $data['site_title'] = "Create Dispute";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/dispute/create-dispute', $data);
        $this->load->view('front/includes/footer', $data);
    }

    public function myDisputes() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserDetails($fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];


        $data['arr_dispute'] = $this->dispute_model->getDisputes("d.*,u.first_name,u.last_name,u.user_name,p.product_name", array("originator_id" => $data['user_account']['user_id']), 'dispute_id DESC', $limit_to_pass = '', $debug_to_pass = 0);

        $data['site_title'] = "My Disputes";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/dispute/my-disputes', $data);
        $this->load->view('front/includes/footer', $data);
    }

    public function othersDisputes() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserDetails($fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['arr_dispute'] = $this->dispute_model->getDisputeDetails("d.*,u.first_name,u.last_name,u.user_name,p.product_name", array("disputer_id" => $data['user_account']['user_id']), 'dispute_id DESC', $limit_to_pass = '', $debug_to_pass = 0);

        $data['site_title'] = "Others Disputes";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/dispute/my-disputes', $data);
        $this->load->view('front/includes/footer', $data);
    }

    public function selectDisputeUser() {
        $data = $this->common_model->commonFunction();
        $string = "";
        $arr_disputer_details = array();
        $product_id = $this->input->post("product_id");
        $arr_product_details = $this->dispute_model->getDisputerDetailsById("product_id,product_name,product_status,borrower_id_fk,bid_status,user_id_fk", array("product_id_fk" => $product_id, "bid_status" => "Accepted"), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        foreach ($arr_product_details as $product) {
            if ($data['user_account']['user_id'] == $product['user_id_fk']) {
                $disputer_id = $product['borrower_id_fk'];
            } else {
                $disputer_id = $product['user_id_fk'];
            }
            $arr_disputer_details[] = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id', array("user_id" => $disputer_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        }

        $string = '<select class="form-control" name="disputer_id" id="disputer_id">';
        if (count($arr_disputer_details) > 0) {
            foreach ($arr_disputer_details[0] as $user) {
                if ($user['first_name'] != "") {
                    $string.="<option value='" . $user['user_id'] . "'>" . $user['first_name'] . " " . $user['last_name'] . "</option>";
                } else {
                    $string.="<option value='" . $user['user_id'] . "'>" . $user['user_name'] . "</option>";
                }
            }
        } else {
            $string.="<option value=''>--Select User--</option>";
        }
        $string.="</select>";
        echo $string;
    }

    public function viewDispute($dispute_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $dispute_id = base64_decode($dispute_id);

        $data = $this->common_model->commonFunction();

        $data['arr_user_data'] = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id', array("user_id" => $data['user_account']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        $data['arr_get_data'] = $this->dispute_model->getSenderDetailsById($dispute_id);
        $data['arr_dispute'] = $this->dispute_model->getDisputes("d.*,u.first_name,u.last_name,u.user_name,p.product_name", array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_originator'] = $this->dispute_model->getRecords('mst_users as u', 'first_name,last_name,user_name,user_id,profile_picture', array("user_id" => $data['arr_dispute'][0]['originator_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        $reciever_id = 0;
        if (isset($data['arr_dispute'][0]['originator_id']) && $data['arr_dispute'][0]['originator_id'] == $data['user_account']['user_id']) {
            $reciever_id = $data['arr_dispute'][0]['disputer_id'];
        } else {
            $reciever_id = $data['arr_dispute'][0]['originator_id'];
        }
        if (count($data['arr_dispute']) > 0) {
            $data['arr_dispute'] = $data['arr_dispute'][0];
        }

        if ($this->input->post() != '') {

            $dispute_id_fk = $this->input->post('dispute_id');

            if ($_FILES['project_attachment']['name'] != '') {
                $_FILES['project_attachment']['name'] = $_FILES['project_attachment']['name'];
                $_FILES['project_attachment']['type'] = $_FILES['project_attachment']['type'];
                $_FILES['project_attachment']['tmp_name'] = $_FILES['project_attachment']['tmp_name'];
                $config['file_name'] = time();
                $_FILES['project_attachment']['error'] = $_FILES['project_attachment']['error'];
                $_FILES['project_attachment']['size'] = $_FILES['project_attachment']['size'];
                $config['upload_path'] = 'media/front/img/dispute-files/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '5000000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('project_attachment')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('images_file_format_error', $error['error']);
                    redirect(base_url() . 'view-dispute/' . base64_encode($dispute_id));
                } else {
                    $uplod_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];
                }
            }

            $arr_to_insert_in_message = array(
                'dispute_id_fk' => $dispute_id_fk,
                'sender_id_fk' => $data['user_account']['user_id'],
                'receiver_id_fk' => $reciever_id,
                'dispute_message' => $this->input->post('message'),
                'message_status' => "1",
                'message_date' => date('y:m:d H:i:s')
            );
            $last_id = $this->common_model->insertRow($arr_to_insert_in_message, 'trans_dispute_messages');

            if ($_FILES['project_attachment']['name'] != '') {
                $arr_to_insert_in_attachments = array(
                    'dispute_id_fk' => $dispute_id_fk,
                    'message_id' => $last_id,
                    'user_id_fk' => $data['user_account']['user_id'],
                    'attachment_path' => $file_name
                );
                $dispute_id = $this->common_model->insertRow($arr_to_insert_in_attachments, 'trans_dispute_attachments');
            }

            $this->session->set_userdata('msg', 'Message sent successfully.');
            redirect(base_url() . 'view-dispute/' . base64_encode($dispute_id_fk));
        }


        $data['site_title'] = "Dispute Details";
        $data['dispute_id'] = $dispute_id;
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/dispute/view-dispute', $data);
        $this->load->view('front/includes/footer', $data);
    }

    public function downloadFiles($image_name) {
        $data = $this->common_model->commonFunction();
        $this->load->helper('download');
        if ($image_name != '') {
            $path = base_url() . 'download-files/' . $image_name;
            if (file_exists($data['absolute_path'] . 'media/front/img/dispute-files/' . $image_name)) {
                $download_file = file_get_contents(base_url() . 'media/front/img/dispute-files/' . $image_name);
                force_download($image_name, $download_file);
            } else {
                $this->session->set_userdata('attachment_not_found', 'Attached files not found.');
                redirect(base_url() . 'my-disputes');
            }
        }
    }

    public function reviseAmount() {
        $data = $this->common_model->commonFunction();
        $dispute_id = $this->input->post("dispute_id");
        $dispute_amount = $this->input->post("dispute_amount");

        if ($dispute_id != "" && $dispute_amount != "") {
            $arr_post_data = array(
                "dispute_amount" => $dispute_amount,
            );
            $arr_update_condition = array("dispute_id" => $dispute_id);
            $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

            $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'disputer_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            $table_name = 'trans_dispute_messages';
            $arr_insert = array(
                'dispute_message' => "Dispute Amount Revised",
                'dispute_id_fk' => $dispute_id,
                'receiver_id_fk' => $arr_dispute_data[0]['disputer_id'],
                'sender_id_fk' => $data['user_account']['user_id'],
                'message_status' => '1',
                'message_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_insert, $table_name);
        }
        redirect(base_url() . "view-dispute/" . base64_encode($dispute_id));
    }

    public function cancleDispute() {
        $data = $this->common_model->commonFunction();
        $dispute_id = $this->input->post("dispute_id");

        if ($dispute_id != "") {
            $arr_post_data = array(
                "dispute_status" => "closed",
            );
            $arr_update_condition = array("dispute_id" => $dispute_id);
            $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

            $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'disputer_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            $table_name = 'trans_dispute_messages';
            $arr_insert = array(
                'dispute_message' => "Dispute Cancelled",
                'dispute_id_fk' => $dispute_id,
                'receiver_id_fk' => $arr_dispute_data[0]['disputer_id'],
                'sender_id_fk' => $data['user_account']['user_id'],
                'message_status' => '1',
                'message_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_insert, $table_name);
        }
        redirect(base_url() . "view-dispute/" . base64_encode($dispute_id));
    }

    public function escalateDispute() {

        $data = $this->common_model->commonFunction();
        $dispute_id = $this->input->post("dispute_id");

        if ($dispute_id != "") {
            $arr_post_data = array(
                "dispute_status" => "escalated",
                "is_escalated" => "1",
            );
            $arr_update_condition = array("dispute_id" => $dispute_id);
            $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

            $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'disputer_id,originator_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if ($data['user_account']['user_id'] == $arr_dispute_data[0]['disputer_id']) {
                $receiver_id = $arr_dispute_data[0]['originator_id'];
            } elseif ($data['user_account']['user_id'] == $arr_dispute_data[0]['originator_id']) {
                $receiver_id = $arr_dispute_data[0]['disputer_id'];
            }

            $table_name = 'trans_dispute_messages';
            $arr_insert = array(
                'dispute_message' => "Dispute Added For Arbitration",
                'dispute_id_fk' => $dispute_id,
                'receiver_id_fk' => $receiver_id,
                'sender_id_fk' => $data['user_account']['user_id'],
                'message_status' => '1',
                'message_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_insert, $table_name);
        }
        redirect(base_url() . "view-dispute/" . base64_encode($dispute_id));
    }

    public function acceptDispute() {
        $data = $this->common_model->commonFunction();
        $dispute_id = $this->input->post("dispute_id");
        if ($dispute_id != "") {
            $arr_post_data = array(
                "dispute_status" => "accepted",
                "decision_in_favor_of" => "originator"
            );
            $arr_update_condition = array("dispute_id" => $dispute_id);
            $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

            $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'originator_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            $table_name = 'trans_dispute_messages';
            $arr_insert = array(
                'dispute_message' => "Dispute Accepted",
                'dispute_id_fk' => $dispute_id,
                'receiver_id_fk' => $arr_dispute_data[0]['originator_id'],
                'sender_id_fk' => $data['user_account']['user_id'],
                'message_status' => '1',
                'message_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_insert, $table_name);
        }
        redirect(base_url() . "view-dispute/" . base64_encode($dispute_id));
    }

    public function listDispute() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        if ($this->input->post() != '') {
            if (count($this->input->post('checkbox')) > 0) {
                /* getting all ides selected */
                $arr_dispute_ids = $this->input->post('checkbox');
                if (count($arr_dispute_ids) > 0) {
                    /* deleting the desputes from the backend */
                    $this->common_model->deleteRows($arr_dispute_ids, "mst_dispute", "dispute_id");
                    $this->session->set_userdata("msg", "<span class='success'>dispute deleted successfully!</span>");
                }
            }
        }
        $data['title'] = "Manage Disputes";
        $data['arr_get_data'] = $this->dispute_model->getAllRecords();
        $this->load->view('backend/dispute/list', $data);
    }

    public function downloadAttachments($dispute_id) {
        $dispute_id = base64_decode($dispute_id);
        $data = $this->common_model->commonFunction();

        $zip = new ZipArchive();
        $tmp_file = tempnam('zip files', '');
        $zip->open($tmp_file, ZipArchive::CREATE);

        $dispute_attachments = $this->dispute_model->getRecords("trans_dispute_attachments", "*", array('dispute_id_fk' => $dispute_id));
        $files1 = array();
        $arr_files_check1 = array();
        if (count($dispute_attachments) > 0) {

            foreach ($dispute_attachments as $attachments) {
                if ($attachments['attachment_path'] != "") {
                    $files1[] = base_url() . "media/front/img/dispute-files/" . $attachments["attachment_path"];
                    $arr_files_check1[] = $attachments ["attachment_path"];
                }
            }
            if (!empty($files1)) {
                $zip->addEmptyDir("dispute-attachments-files");
                foreach ($files1 as $file) {
                    $download_file = file_get_contents($file);
                    $zip->addFromString("dispute-attachments-files/" . basename($file), $download_file);
                }
            }
        } else {
            $this->session->set_userdata("msg", "<span class='error'>No files found!!</span>");
            redirect(base_url() . "backend/dispute/list");
        }
        if ((!empty($arr_files_check1))) {
            $zip->close();
            header('Content-disposition: attachment; filename=download.zip');
            header('Content-type: application/zip');
            readfile($tmp_file);
            $this->load->view('backend/dispute/list', $data);
        }
    }

    public function disputeDetails($dispute_id) {
        $dispute_id = base64_decode($dispute_id);
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();

        //for admin decision
        if ($this->input->post("escalated_action") != '') {
            $arr_post_data = array(
                "dispute_status" => "closed",
                "decision_in_favor_of" => $this->input->post("escalated_action")
            );
            $arr_update_condition = array("dispute_id" => $dispute_id);
            $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

            $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'originator_id,disputer_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if ($this->input->post("escalated_action") == "disputer") {

                $admin_action = "Admin Decision in favour of Dispute Responder";
                $sender_id = $arr_dispute_data[0]['disputer_id'];
                $receiver_id = $arr_dispute_data[0]['originator_id'];
            } elseif ($this->input->post("escalated_action") == "originator") {

                $admin_action = "Admin Decision in favour of Dispute Originator";
                $sender_id = $arr_dispute_data[0]['originator_id'];
                $receiver_id = $arr_dispute_data[0]['disputer_id'];
            }
            $table_name = 'trans_dispute_messages';
            $arr_insert = array(
                'dispute_message' => $admin_action,
                'dispute_id_fk' => $dispute_id,
                'receiver_id_fk' => $receiver_id,
                'sender_id_fk' => $sender_id,
                'message_status' => '1',
                'message_date' => date('Y-m-d H:i:s')
            );
            $this->common_model->insertRow($arr_insert, $table_name);

            $this->session->set_userdata("msg", "<span class='success'>Decision Given On Escalated Dispute Successfully!</span>");
            redirect(base_url() . "backend/dispute/list");
        }
        //admin decision end

        $data['title'] = "Disputes Details";
        $data['arr_get_data'] = $this->dispute_model->getAllRecordsById($dispute_id);
        $data['arr_get_data'] = $data['arr_get_data'][0];
        $this->load->view('backend/dispute/view', $data);
    }

    public function viewMessages($dispute_id) {
        $dispute_id = base64_decode($dispute_id);
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        if ($this->input->post() != '') {
            if (count($this->input->post('checkbox')) > 0) {
                /* getting all ides selected */

                $arr_dispute_ids = $this->input->post('checkbox');
                if (count($arr_dispute_ids) > 0) {
                    /* deleting the message from the backend */
                    $data['arr_delete_rows'] = $this->common_model->deleteRows($arr_dispute_ids, "trans_dispute_messages", "dispute_id_fk");

                    $this->session->set_userdata("msg", "<span class='success'>message deleted successfully!</span>");
                }
            }
        }
        $data['title'] = "Dispute Messages";
        $table = 'trans_dispute_messages';
        $condition = array('dispute_id_fk' => $dispute_id);

        $data['arr_get_data'] = $this->common_model->getRecords($table, $fields = "*", $condition, 'dispute_message_id DESC', $limit = '', $debug = 0);
        $data['dispute_id'] = $dispute_id;
        $this->load->view('backend/dispute/view-messages', $data);
    }

    public function changeStatus() {
        if ($this->input->post('dispute_message_id') != "" && $this->input->post('message_status') != '') {
            #updating the user status.
            $arr_to_update = array(
                "message_status" => $this->input->post('message_status')
            );
            #condition to update record	for the user status
            $condition_array = array('dispute_message_id' => intval($this->input->post('dispute_message_id')));
            $this->common_model->updateRow('trans_dispute_messages', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function checkDisputeAmount() {
        $product_id = $this->input->post("product_id_fk");
        $dispute_amount = $this->input->post("dispute_amount");

        $rent_amount = '0';
        if ($product_id != "") {

            $get_total_amount = $this->dispute_model->getRentDetails($product_id);

            $check_array = array();
            if (count($get_total_amount) > 0) {
                foreach ($get_total_amount as $key => $value) {
                    if (!in_array($value['product_id_fk'], $check_array)) {
                        $check_array[] = $value['product_id_fk'];
                        $rent_amount = $value['total_amount'];
                    }
                }
            }

            if ($rent_amount >= $dispute_amount) {
                echo "true";
                exit;
            } else {
                echo "false";
                exit;
            }
        } else {
            echo "true";
            exit;
        }
    }

    public function addMessageAdmin($dispute_id) {
        $dispute_id = base64_decode($dispute_id);
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        if ($this->input->post() != '') {
            $data['arr_dispute'] = $this->dispute_model->getDisputes("d.*,u.first_name,u.last_name,u.user_name,p.product_name", array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            $reciever_id = $data['arr_dispute'][0]['originator_id'];

            if ($_FILES['project_attachment']['name'] != '') {
                $_FILES['project_attachment']['name'] = $_FILES['project_attachment']['name'];
                $_FILES['project_attachment']['type'] = $_FILES['project_attachment']['type'];
                $_FILES['project_attachment']['tmp_name'] = $_FILES['project_attachment']['tmp_name'];
                $config['file_name'] = time();
                $_FILES['project_attachment']['error'] = $_FILES['project_attachment']['error'];
                $_FILES['project_attachment']['size'] = $_FILES['project_attachment']['size'];
                $config['upload_path'] = 'media/front/img/dispute-files/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '5000000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('project_attachment')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('images_file_format_error', $error['error']);
                    redirect(base_url() . 'view-dispute/' . base64_encode($dispute_id));
                } else {
                    $uplod_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];
                }
            }
            $arr_to_insert_in_message = array(
                'dispute_id_fk' => $dispute_id,
                'sender_id_fk' => $data['user_account']['user_id'],
                'receiver_id_fk' => $reciever_id,
                'dispute_message' => $this->input->post('message'),
                'message_status' => "1",
                'message_date' => date('y:m:d H:i:s')
            );
            $last_id = $this->common_model->insertRow($arr_to_insert_in_message, 'trans_dispute_messages');

            if ($_FILES['project_attachment']['name'] != '') {
                $arr_to_insert_in_attachments = array(
                    'dispute_id_fk' => $dispute_id,
                    'message_id' => $last_id,
                    'user_id_fk' => $data['user_account']['user_id'],
                    'attachment_path' => $file_name
                );
                $dispute_id = $this->common_model->insertRow($arr_to_insert_in_attachments, 'trans_dispute_attachments');
            }

            $this->session->set_userdata('msg', 'message added successfully.');
            redirect(base_url() . 'backend/dispute/view-messages/' . base64_encode($dispute_id));
        }

        $data['title'] = "Add Message";
        $data['dispute_id'] = $dispute_id;
        $this->load->view('backend/dispute/add-message', $data);
    }

    public function checkClosedDisputes() {
        $data = $this->common_model->commonFunction();

        $arr_dispute = $this->dispute_model->getDisputeDetails("d.*,u.first_name,u.last_name,u.user_name,p.product_name", "dispute_status = 'active' OR dispute_status='escalated'", 'dispute_id DESC', $limit_to_pass = '', $debug_to_pass = 0);
        foreach ($arr_dispute as $dispute) {
            $date = strtotime($dispute['dispute_date']);
            $date = strtotime("+ 7 days", $date);
            $end_date = date('Y-m-d H:i:s', $date);

            $future_datetime = $end_date;
            $future = strtotime($future_datetime); //future datetime in seconds
            $now_datetime = date('Y-m-d H:i:s');
            $now = date('U'); //now datetime in seconds
            //calculating the difference
            $difference = $future - $now;

            $arr_messages = $this->dispute_model->getRecords('trans_dispute_messages as u', 'dispute_id_fk', array("dispute_id_fk" => $dispute['dispute_id'], 'sender_id_fk' => $dispute['disputer_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if ($difference < 0 && count($arr_messages) < 1) {
                $dispute_id = $dispute['dispute_id'];
                $arr_post_data = array(
                    "dispute_status" => "closed",
                    "decision_in_favor_of" => "originator"
                );
                $arr_update_condition = array("dispute_id" => $dispute_id);
                $this->common_model->updateRow("mst_dispute", $arr_post_data, $arr_update_condition);

                $arr_dispute_data = $this->dispute_model->getRecords('mst_dispute', 'originator_id,disputer_id', array("dispute_id" => $dispute_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

                $admin_action = "Syaytem Decision in favour of Dispute Originator";
                $sender_id = $arr_dispute_data[0]['originator_id'];
                $receiver_id = $arr_dispute_data[0]['disputer_id'];

                $table_name = 'trans_dispute_messages';
                $arr_insert = array(
                    'dispute_message' => $admin_action,
                    'dispute_id_fk' => $dispute_id,
                    'receiver_id_fk' => $receiver_id,
                    'sender_id_fk' => $sender_id,
                    'message_status' => '1',
                    'message_date' => date('Y-m-d H:i:s')
                );
                $this->common_model->insertRow($arr_insert, $table_name);
            }
        }
        $this->session->set_userdata("msg", "<span class='success'>Decision Given On Escalated Dispute Successfully!</span>");
        redirect(base_url() . "backend/dashboard");
    }

    public function viewTermsAndConditions($product_id) {
        $data = $this->common_model->commonFunction();

        $product_id = base64_decode($product_id);
        $condition = "product_id_fk = '" . $product_id . "'";
        $data['arr_terms_conditions'] = $this->common_model->getRecords('trans_assigning_payment_requests', "*", $condition, $order_by = '', $limit = '', $debug = 0);

        $data['title'] = "Terms and Conditions";
        $this->load->view('backend/dispute/terms-and-condtion', $data);
    }

}

?>