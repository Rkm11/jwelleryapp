<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
//        error_reporting(E_ALL);
//        ini_set('dispaly_errors', 'on');
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("user_model");
//        $this->load->model("storefront_model");
        $this->load->model("product_model");
        $this->load->model("order_model");
        $this->load->model('category_model');
    }

    /* Storefront front end start here */

    public function userOrdersList($pg = '') {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg_error', 'Please login to proceed further.');
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $user_id = $data['user_account']['user_id'];
        $order_list = $this->order_model->getOrdersByProduct($user_id);
        $data['count'] = count($order_list);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'payment/list-order-history/';
        $config['total_rows'] = count($order_list);
        $config['per_page'] = $data['global']['per_page_record'];
        $config['cur_page'] = $pg;
        $config['num_links'] = 4;
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $config['uri_segment'] = 2;
        $this->pagination->initialize($config);
        $data['create_links'] = $this->pagination->create_links();
        $order_list = $this->order_model->getOrdersByProduct($user_id, $config['per_page'], $pg);

        foreach ($order_list as $key => $order) {
            if ($order['order_read'] == '0') {
                $update_data = array('order_read' => '1');
                $this->common_model->updateRow('trans_product_order', $update_data, array('product_order_id' => $order['product_order_id']));
            }
            if (($order['product_order_status'] == 5) || $order['product_order_status'] == 6) {
                $return_cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order['product_order_id']));
                $order_list[$key]['return_cancel_details'] = $return_cancel_details[0];
            }
        }
        $data['order_list'] = $order_list;
        $condition_to_pass = array("user_id" => $data['user_account']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($condition_to_pass);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['site_title'] = "Order Management";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/includes/left-menu', $data);
        $this->load->view('front/order/list-orders', $data);
        $this->load->view('front/includes/footer');
    }

    public function ordersProductDetails($product_order_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg_error', 'Please login to proceed further.');
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $user_id = $data['user_account']['user_id'];
        $product_order_id = base64_decode($product_order_id);
        if ($product_order_id != '') {
            $order_details = $this->order_model->getOrdersProductDetails($product_order_id);
            foreach ($order_details as $key => $order) {
                $order_details[$key]['images'] = $this->common_model->getRecords('trans_product_img', 'img_id,img_name', array('product_id' => $order['product_id']));
            }
        } else {
            $this->session->set_userdata('msg_error', 'This orders details are not available.');
            redirect(base_url() . 'payment/list-order-history');
        }
        if (($order_details[0]['product_order_status'] == 5) || ($order_details[0]['product_order_status'] == 6)) {
            $cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order_details[0]['product_order_id']));
            $data['return_cancel_details'] = $cancel_details;
        }
        $data['order_details'] = $order_details[0];
        $condition_to_pass = array("user_id" => $data['user_account']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($condition_to_pass);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['site_title'] = "Order Product Details";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/order/order-details', $data);
        $this->load->view('front/includes/footer');
    }

    public function changeStatus() {
        $flag = 0;
        $product_order_id = $this->input->post('product_order_id');
        $order_id = $this->input->post('order_id');
        $seller_id = $this->input->post('seller_id');
        $order_details = $this->common_model->getRecords('trans_product_order', '', array('product_order_id' => $product_order_id));
        if (isset($order_details) && count($order_details) > 0) {
            $arr_to_update = array(
                'product_order_status' => '2'
            );
            $this->common_model->updateRow('trans_product_order', $arr_to_update, array('product_order_id' => $order_details[0]['product_order_id']));
        } else {
            echo "false";
        }
        $all_order_details = $this->common_model->getRecords('trans_product_order', '', array('order_id' => $order_id, 'product_order_status' => '0'));
        if (isset($all_order_details) && count($all_order_details) > 0) {
            foreach ($all_order_details as $all_order) {
                if ($all_order['product_order_status'] == '1') {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
        } else {
            $arr_update_order = array(
                'order_status' => '2'
            );
            $this->common_model->updateRow('mst_order', $arr_update_order, array('order_id' => $order_id));
        }

        echo "true";
    }

    public function cancelOrder() {
        $data = $this->common_model->commonFunction();
        $product_order_id = $this->input->post('product_order_id');
        if ($product_order_id != '') {
            $arr_admin_data = $this->user_model->getUserInformation(array("role_id" => 1, 'user_type' => '2'));
            $product_order_details = $this->order_model->getOrdersProductDetails($product_order_id);
            $arr_to_insert = array(
                'product_ordet_id_fk' => $product_order_id,
                'cancel_return_status' => '0',
                'canceled_date' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->common_model->insertRow($arr_to_insert, 'trans_product_cancel_return');
            $arr_update_order = array(
                'product_order_status' => '5'
            );
            $this->common_model->updateRow('trans_product_order', $arr_update_order, array('product_order_id' => $product_order_id));
            $lang_id = '17';
            $product_link = '<a href="' . base_url() . 'product/product-details/' . base64_encode($product_order_details[0]['product_id']) . '">' . ucfirst($product_order_details[0]['product_name']) . '</a>';
            $reserved_words = array(
                "||USER_NAME||" => ucfirst($arr_admin_data[0]['user_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content1 = $this->common_model->getEmailTemplateInfo('buyer-order-cancelation-request-admin', $lang_id, $reserved_words);
            $mail1 = $this->common_model->sendEmail($arr_admin_data[0]['user_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);

            $reserved_words2 = array(
                "||USER_NAME||" => ucfirst($arr_admin_data[0]['user_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content2 = $this->common_model->getEmailTemplateInfo('buyer-order-cancelation-request-admin', $lang_id, $reserved_words2);
            $mail2 = $this->common_model->sendEmail($data['global']['customer_care_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);

            $reserved_words3 = array(
                "||USER_NAME||" => ucfirst($product_order_details[0]['seller_first_name'] . ' ' . $product_order_details[0]['seller_last_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content3 = $this->common_model->getEmailTemplateInfo('buyer-order-cancelation-request', $lang_id, $reserved_words3);
            $mail3 = $this->common_model->sendEmail($product_order_details[0]['seller_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content3['subject'], $email_content3['content']);
            $this->session->set_userdata('msg_success', 'Admin will be get back to you for your request.');
            echo "Done";
        } else {
            $this->session->set_userdate('msg_error', 'Order not availabel.');
            echo "Error";
        }
    }

    public function returnOrder($product_order_id) {
        $data = $this->common_model->commonFunction();
        $product_order_id = base64_decode($product_order_id);
        if ($product_order_id != '') {
            $arr_admin_data = $this->user_model->getUserInformation(array("role_id" => 1, 'user_type' => '2'));
            $product_order_details = $this->order_model->getOrdersProductDetails($product_order_id);
            if ($this->input->post('reason_text') != '') {
                $reason_text = $this->input->post('reason_text');
            } else {
                $reason_text = '';
            }
            $arr_to_insert = array(
                'product_ordet_id_fk' => $product_order_id,
                'cancel_return_status' => '2',
                'return_reason' => $this->input->post('reson'),
                'return_text' => $reason_text,
                'returned_date' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->common_model->insertRow($arr_to_insert, 'trans_product_cancel_return');
            $arr_update_order = array(
                'product_order_status' => '6'
            );
            $this->common_model->updateRow('trans_product_order', $arr_update_order, array('product_order_id' => $product_order_id));
            $lang_id = '17';
            $product_link = '<a href="' . base_url() . 'product/product-details/' . base64_encode($product_order_details[0]['product_id']) . '">' . ucfirst($product_order_details[0]['product_name']) . '</a>';
            $reserved_words = array(
                "||USER_NAME||" => ucfirst($arr_admin_data[0]['user_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content1 = $this->common_model->getEmailTemplateInfo('buyer-order-return-request-admin', $lang_id, $reserved_words);
            $mail1 = $this->common_model->sendEmail($arr_admin_data[0]['user_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);

            $reserved_words2 = array(
                "||USER_NAME||" => ucfirst($arr_admin_data[0]['user_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content2 = $this->common_model->getEmailTemplateInfo('buyer-order-return-request-admin', $lang_id, $reserved_words2);
            $mail2 = $this->common_model->sendEmail($data['global']['customer_care_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);

            $reserved_words3 = array(
                "||USER_NAME||" => ucfirst($product_order_details[0]['seller_first_name'] . ' ' . $product_order_details[0]['seller_last_name']),
                "||BUYER_NAME||" => ucfirst($product_order_details[0]['buyer_first_name'] . ' ' . $product_order_details[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($product_order_details[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content3 = $this->common_model->getEmailTemplateInfo('buyer-order-return-request', $lang_id, $reserved_words3);
            $mail3 = $this->common_model->sendEmail($product_order_details[0]['seller_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content3['subject'], $email_content3['content']);
            $this->session->set_userdata('msg_success', 'Admin will be get back to you for your request.');
            redirect(base_url() . 'order-details/' . base64_encode($product_order_details[0]['order_id']));
        } else {
            $this->session->set_userdate('msg_error', 'Order not availabel.');
            redirect(base_url() . 'order-details/' . base64_encode($product_order_details[0]['order_id']));
        }
    }

    public function ListOrderBackend() {
//        error_reporting(E_ALL);
//        ini_set('display_errors','on');
//        echo "<pre>";print_r();die('s');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
            $data['arr_order'] = $this->product_model->getOrdersByProduct();
//        echo "<pre>";print_r($data['arr_order']);die;
//        $data['arr_order'] = $this->order_model->getAllOrdersByStatus("TNT");
//
//        foreach ($data['arr_order'] as $key => $order) {
//            if (($order['product_order_status'] == 5) || ($order['product_order_status'] == 6)) {
//                $return_cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order['product_order_id']));
//                $data['arr_order'][$key]['return_cancel_details'] = $return_cancel_details[0];
//            }
//        }
        $data['type'] = $status;
        $data['title'] = "Manage Order";
        $this->load->view('backend/order/order-list', $data);
    }
    public function ListOrderProductBackend($order_id) {
        $order_id=  base64_decode($order_id);
//        error_reporting(E_ALL);
//        ini_set('display_errors','on');
//        echo "<pre>";print_r();die('s');
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
            $data['arr_order'] = $this->product_model->getOrdersByOrderId($order_id);
//        echo "<pre>";print_r($data['arr_order']);die;
//        $data['arr_order'] = $this->order_model->getAllOrdersByStatus("TNT");
//
//        foreach ($data['arr_order'] as $key => $order) {
//            if (($order['product_order_status'] == 5) || ($order['product_order_status'] == 6)) {
//                $return_cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order['product_order_id']));
//                $data['arr_order'][$key]['return_cancel_details'] = $return_cancel_details[0];
//            }
//        }
        $data['type'] = $status;
        $data['title'] = "Manage Order";
        $this->load->view('backend/order/product-list', $data);
    }

    public function viewOrder($product_order_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        $data = $this->common_model->commonFunction();
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('26', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic of TNT!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $product_order_id = base64_decode($product_order_id);
        $data['product_detail'] = $this->product_model->getOrderDetailByProduct($product_order_id);
        $data['product_img']=  $this->common_model->getRecords('trans_product_images','',array('product_id_fk'=>$product_order_id));
//        echo"<pre>";print_r($data['product_detail']);die;
        $data['title'] = 'Order Product Detail';
        $this->load->view('backend/order/view-product', $data);
    }

    public function ListOrderBackendEMS() {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('27', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic of EMS!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }

        $data['arr_order'] = $this->order_model->getAllOrdersByStatus("EMS");
        foreach ($data['arr_order'] as $key => $order) {
            if (($order['product_order_status'] == 5) || ($order['product_order_status'] == 6)) {
                $return_cancel_details = $this->common_model->getRecords('trans_product_cancel_return', '', array('product_ordet_id_fk' => $order['product_order_id']));
                $data['arr_order'][$key]['return_cancel_details'] = $return_cancel_details[0];
            }
        }
        $data['type'] = $status;
        $data['title'] = "Manage EMS Order";
        $this->load->view('backend/order/order-list-ems', $data);
    }

    public function changeStatusBackend() {
        if ($this->input->post('order_id') != "") {
            $status = $this->input->post('order_status');
            if ($status == 1) {
                $arr_to_update = array(
                    "order_status" => $status,
                    "dispatched_date" => date('Y-m-d H:i:s')
                );
            } 
            else if ($status == 2) {
                $arr_to_update = array(
                    "order_status" => $status,
                    "delivered_date" => date('Y-m-d H:i:s')
                );
            }else if($status==0){
                $arr_to_update = array(
                    "order_status" => $status,
                    "delivered_date" => date('Y-m-d H:i:s')
                );
            }
//             else if ($status == 1) {
//                $arr_to_update = array(
//                    "product_order_status" => $status,
//                );
//            }
//            echo "<pre>";
//                        print_r($arr_to_update);die;
            $condition_array = array('order_id' => $this->input->post('order_id'));
//            $this->common_model->updateRow('mst_order', $arr_to_update, $condition_array);
            $this->common_model->updateRow('mst_order', $arr_to_update, $condition_array);
            $order_details=end($this->common_model->getRecords('mst_order','',array('order_id'=>$this->input->post('order_id'))));
            if($status=='0'){
                $ord_status='Placed';
            }else if($status=='1'){
                $ord_status='Dispatched';
            }else if($status=='2'){
                $ord_status='Delivered';
            }else if($status=='3'){
                $ord_status='Canceled';
            }
            $subject="Your order has been $ord_status sucessfully. ";
            $message="Your order has been $ord_status sucessfully. ";
                    $arr_insert=array(
                'notification_to'=>$order_details['buyer_id'],
                'subject'=>  $subject,
                'message'=>  $message,
                'product_ids'=>$this->input->post('order_id'),
                'redirect-url'=>'ws-user-order-details',
                 'type'=>'order'
            );
//                    echo '<pre>';print_r($arr_insert);die;
//                    $insert_id = $this->common_model->insertRow($arr_to_insert, 'trans_product_cancel_return');
            $this->common_model->insertRow($arr_insert, 'mst_notifications');
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later."));
        }
    }
    
    public function viewOrderBackendEMS($product_order_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        $data = $this->common_model->commonFunction();
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('27', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage logistic EMS!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $product_order_id = base64_decode($product_order_id);
        $data['order_detail'] = $this->product_model->getOrderDetailByProduct($product_order_id);
        $data['title'] = 'Order Detail EMS';
        $this->load->view('backend/order/order-detail-ems', $data);
    }

    public function changeProductStatus() {
        $flag = 0;
        $product_order_id = $this->input->post('product_order_id');
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');
        $order_details = $this->common_model->getRecords('trans_product_order', '', array('product_order_id' => $product_order_id));
        if (isset($order_details) && count($order_details) > 0) {
            $arr_to_update = array(
                'product_order_status' => $status
            );
            $this->common_model->updateRow('trans_product_order', $arr_to_update, array('product_order_id' => $order_details[0]['product_order_id']));
            echo "true";
        } else {
            echo "false";
        }
        $all_order_details = $this->common_model->getRecords('trans_product_order', '', array('order_id' => $order_id, 'product_order_status' => '0'));
        if (isset($all_order_details) && count($all_order_details) > 0) {
            foreach ($all_order_details as $all_order) {
                if ($all_order['product_order_status'] == '1') {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
        } else {
            $arr_update_order = array(
                'order_status' => '2'
            );
            $this->common_model->updateRow('mst_order', $arr_update_order, array('order_id' => $order_id));
            echo "done";
        }
    }

    /*     * ******************************* Cancel Return start here ****************************************** */

    public function cancelReturnListBackend($status) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('24', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage order!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($status == 'cancellation') {
            $data['arr_cancel_return'] = $this->order_model->getAllOrdersCancelReturn(5);
        } else if ($status == 'return') {
            $data['arr_cancel_return'] = $this->order_model->getAllOrdersCancelReturn(6);
        } else {
            $this->session->set_userdata("msg", "<span class='error'>Invalid URL!</span>");
            redirect(base_url() . "backend/home");
        }
        $data['type'] = $status;
        $data['title'] = "Manage " . ucfirst($status) . " Order";
        $this->load->view('backend/cancel-return/cancel-retun-list', $data);
    }

    public function cancelViewBackend($cancel_return_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        $data = $this->common_model->commonFunction();
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('24', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage order!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $cancel_return_id = base64_decode($cancel_return_id);
        $cancel_return_detail = $this->order_model->getAllOrdersCancelReturn('', $cancel_return_id);
        $cancel_return_detail[0]['images'] = $this->common_model->getRecords('trans_product_img', 'img_id,img_name', array('product_id' => $cancel_return_detail[0]['product_id']));
        $data['cancel_return_detail'] = $cancel_return_detail[0];
        $data['title'] = 'Cancel Order Detail';
        $this->load->view('backend/cancel-return/cancel-order-view', $data);
    }

    public function approveCancelOrder() {
        $data = $this->common_model->commonFunction();
        $cancel_return_id = $this->input->post('cancel_return_id');
        $status = $this->input->post('status');
        if ($cancel_return_id != '') {
            $cancel_return_detail = $this->order_model->getAllOrdersCancelReturn('', $cancel_return_id);
            $arr_to_update = array(
                'cancel_return_status' => $status,
            );
            $this->common_model->updateRow('trans_product_cancel_return', $arr_to_update, array('cancel_return_id' => $cancel_return_id));
            $lang_id = '17';
            $product_link = '<a href="' . base_url() . 'product/product-details/' . base64_encode($cancel_return_detail[0]['product_id']) . '">' . ucfirst($cancel_return_detail[0]['product_name']) . '</a>';
            $reserved_words = array(
                "||USER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content1 = $this->common_model->getEmailTemplateInfo('buyer-order-cancelation-approved', $lang_id, $reserved_words);
            $mail1 = $this->common_model->sendEmail($cancel_return_detail[0]['buyer_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);
            $reserved_words3 = array(
                "||USER_NAME||" => ucfirst($cancel_return_detail[0]['seller_first_name'] . ' ' . $cancel_return_detail[0]['seller_last_name']),
                "||BUYER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                "||ADDED_DATE||" => date("d-m-Y"),
                "||PRODUCT_NAME||" => $product_link,
                "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
            );
            $email_content3 = $this->common_model->getEmailTemplateInfo('buyer-order-cancelation-approved-seller', $lang_id, $reserved_words3);
            $mail3 = $this->common_model->sendEmail($cancel_return_detail[0]['seller_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content3['subject'], $email_content3['content']);
            $this->session->set_userdata("msg", "<span class='success'>Order Cancellation Approved successfully!</span>");
            echo "Done";
        } else {
            $this->session->set_userdate('msg_error', 'Order not availabel.');
            echo "Error";
        }
    }

    public function returnViewBackend($cancel_return_id) {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('msg', "<span class='error'>Please login to proceed further.");
            redirect('backend/login');
        }
        $data = $this->common_model->commonFunction();
        if ($data['user_account']['role_id'] != 1) {
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $data['user_account']['role_id']));
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            }
            $arr_login_admin_privileges = $user_privileges;
            if (in_array('24', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage order!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $cancel_return_id = base64_decode($cancel_return_id);
        $cancel_return_detail = $this->order_model->getAllOrdersCancelReturn('', $cancel_return_id);
        $cancel_return_detail[0]['images'] = $this->common_model->getRecords('trans_product_img', 'img_id,img_name', array('product_id' => $cancel_return_detail[0]['product_id']));
        $data['cancel_return_detail'] = $cancel_return_detail[0];
        $data['title'] = 'Return Order Detail';
        $this->load->view('backend/cancel-return/return-order-view', $data);
    }

    public function approveRejectedOrder() {
        $data = $this->common_model->commonFunction();
        $cancel_return_id = $this->input->post('cancel_return_id');
        $status = $this->input->post('status');
        if ($cancel_return_id != '') {
            $cancel_return_detail = $this->order_model->getAllOrdersCancelReturn('', $cancel_return_id);
            if ($status == 3) {
                $arr_to_update = array(
                    'cancel_return_status' => $status,
                );
                $this->common_model->updateRow('trans_product_cancel_return', $arr_to_update, array('cancel_return_id' => $cancel_return_id));
                $lang_id = '17';
                $product_link = '<a href="' . base_url() . 'product/product-details/' . base64_encode($cancel_return_detail[0]['product_id']) . '">' . ucfirst($cancel_return_detail[0]['product_name']) . '</a>';
                $reserved_words = array(
                    "||USER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                    "||ADDED_DATE||" => date("d-m-Y"),
                    "||PRODUCT_NAME||" => $product_link,
                    "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                    "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                    "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
                );
                $email_content1 = $this->common_model->getEmailTemplateInfo('buyer-order-return-approved', $lang_id, $reserved_words);
                $mail1 = $this->common_model->sendEmail($cancel_return_detail[0]['buyer_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);
                $reserved_words3 = array(
                    "||USER_NAME||" => ucfirst($cancel_return_detail[0]['seller_first_name'] . ' ' . $cancel_return_detail[0]['seller_last_name']),
                    "||BUYER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                    "||ADDED_DATE||" => date("d-m-Y"),
                    "||PRODUCT_NAME||" => $product_link,
                    "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                    "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                    "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
                );
                $email_content3 = $this->common_model->getEmailTemplateInfo('buyer-order-return-approved-seller', $lang_id, $reserved_words3);
                $mail3 = $this->common_model->sendEmail($cancel_return_detail[0]['seller_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content3['subject'], $email_content3['content']);
                $this->session->set_userdata("msg", "<span class='success'>Order Return Approved successfully!</span>");
                echo "Done";
            } else if (($status == 4) || ($status == 5)) {
                if ($status == 4) {
                    $message = "accepted";
                } else if ($status == 5) {
                    $message = "rejected";
                }
                $arr_to_update = array(
                    'cancel_return_status' => $status,
                );
                $this->common_model->updateRow('trans_product_cancel_return', $arr_to_update, array('cancel_return_id' => $cancel_return_id));
                $lang_id = '17';
                $product_link = '<a href="' . base_url() . 'product/product-details/' . base64_encode($cancel_return_detail[0]['product_id']) . '">' . ucfirst($cancel_return_detail[0]['product_name']) . '</a>';
                $reserved_words = array(
                    "||USER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                    "||ADDED_DATE||" => date("d-m-Y"),
                    "||PRODUCT_NAME||" => $product_link,
                    "||MESSAGE||" => $message,
                    "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                    "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                    "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
                );
                $email_content1 = $this->common_model->getEmailTemplateInfo('buyer-order-return-status', $lang_id, $reserved_words);
                $mail1 = $this->common_model->sendEmail($cancel_return_detail[0]['buyer_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content1['subject'], $email_content1['content']);
                $reserved_words3 = array(
                    "||USER_NAME||" => ucfirst($cancel_return_detail[0]['seller_first_name'] . ' ' . $cancel_return_detail[0]['seller_last_name']),
                    "||BUYER_NAME||" => ucfirst($cancel_return_detail[0]['buyer_first_name'] . ' ' . $cancel_return_detail[0]['buyer_last_name']),
                    "||ADDED_DATE||" => date("d-m-Y"),
                    "||PRODUCT_NAME||" => $product_link,
                    "||MESSAGE||" => $message,
                    "||PRICE||" => number_format($cancel_return_detail[0]['total_amount'], 2),
                    "||SITE_TITLE||" => stripslashes($data['global']['site_title']),
                    "||SITE_PATH||" => '<a href="' . base_url() . '">' . base_url() . '</a>'
                );
                $email_content3 = $this->common_model->getEmailTemplateInfo('buyer-order-return-status-seller', $lang_id, $reserved_words3);
                $mail3 = $this->common_model->sendEmail($cancel_return_detail[0]['seller_email'], array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title'])), $email_content3['subject'], $email_content3['content']);
                $this->session->set_userdata("msg", "<span class='success'>Order status changed successfully!</span>");
                echo "Done";
            }
        } else {
            $this->session->set_userdate('msg_error', 'Order not availabel.');
            echo "Error";
        }
    }

}

?>
