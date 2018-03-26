<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web_Services extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('cms_model');
        $this->load->model('faq_model');
    }

    public function checkEmail() {
        $email_id = $this->input->post('user_email');
//        $email_id='rkm@gmail.com1';
        if ($email_id != "") {
            $arr_check_user_email = end($this->common_model->getRecords('mst_users', '', array('user_email' => $email_id)));
//        echo count(array_filter($arr_check_user_email));
            if (COUNT(array_filter($arr_check_user_email)) > 0) {
                $response_arr = array('error_code' => 0, 'msg' => 'failed.user exist', 'data' => $arr_check_user_email);
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 1, 'msg' => 'success');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed. Parameter missing.');
            echo json_encode($response_arr);
        }
    }

    public function sendEmails() {
        $to = "dushyant@callidustechno.com";
        $subject = "My subject";
        $txt = "Hello world!";
        $headers = "From:dushyant0250@gmail.com" . "\r\n";
        $recipeinets = "dushyant@callidustechno.com";
                $config = array();
                $config['useragent']           = "CodeIgniter";
                $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
                $config['smtp_host']           = "localhost";
                $config['smtp_port']           = "25";
                $config['mailtype'] = 'html';
                $config['charset']  = 'utf-8';
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;

                $this->load->library('email');

                $this->email->from('dushyant0250@gmail.com', 'admin');
                $this->email->to('dushyant@callidustechno.com');
//                $this->email->cc('xxx@gmail.com'); 
//                $this->email->bcc($this->input->post('email')); 
                $this->email->subject('Registration Verification: Continuous Imapression');
                $msg = "Thanks for signing up!
            Your account has been created, 
            you can login with your credentials after you have activated your account by pressing the url below.
            Please click this link to activate your account:<a href=\"".base_url('user/verify')."/{$verification_code}\">Click Here</a>";

            $this->email->message($msg);   
            //$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
//            echo "<pre>";print_r($this->email->initialize($config));die;
            $this->email->send();
//    $this->email->attach('/path/to/file1.png'); // attach file
//    $this->email->attach('/path/to/file2.pdf');
    if ($this->email->send())
        echo "Mail Sent!";
    else
        echo "There is error in sending mail!";
    }

    public function userRegistration() {

        //User_type=> 1=customer, 3=wholesaler
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $birth_date = $this->input->post('birth_date');
        $password = $this->input->post('user_password');
        $mobile_no = $this->input->post('mobile_no');
        $email_id = $this->input->post('user_email');
        $address = $this->input->post('address');
        $user_type = $this->input->post('user_type');

//        $first_name = "joy";
//        $last_name = "s";
//        $birth_date = 'ss';
//        $password = "Pass@123";
//        $mobile_no = '1111';
//        $email_id = 'ss@ggg.com';
//        $address = 'ssss';
//        $user_type = '1';
        if ($email_id != '' && $password != '' && $mobile_no != '' && $user_type != '') {
//checking email address already exists or not
            $arr_check_user_email = $this->common_model->getRecords('mst_users', 'user_email', array('user_email' => $email_id));
            if (COUNT($arr_check_user_email) == 0) {

                $insert_data = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'user_email' => $email_id,
                    'user_password' => base64_encode($password),
                    'mobile_no' => $mobile_no,
                    'user_type' => $user_type,
                    'user_birth_date' => $birth_date,
                    'address' => $address,
                    'user_status' => '1',
                    'email_verified' => '1',
                    'activation_code' => time(),
                    'register_date' => date('Y-m-d H:i:s')
                );
                $last_insert_id = $this->common_model->insertRow($insert_data, 'mst_users');
                $response_arr = array('error_code' => 1, 'msg' => 'success', 'user_details' => array('user_id' => $last_insert_id, 'last_name' => $last_name, 'first_name' => $first_name, 'email_id' => $email_id, 'password' => $password, 'mobile_number' => $mobile_no,
                        'user_type' => $user_type, 'address' => $address, 'birth_date' => $birth_date));
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'failed. User email is already exists.');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'parameter missing');
            echo json_encode($response_arr);
        }
    }

    public function forgotPassword() {
        $data = $this->common_model->commonFunction();
//        PRINT_R($data['global']);
        $user_email = $this->input->post('email_id');
        if ($user_email != '') {
//check email address exists or not
            $arr_check_user_email = $this->common_model->getRecords('mst_users', 'user_email,first_name', array('user_email' => $user_email));
            if (COUNT($arr_check_user_email) > 0) {
                $activation_code = time();
                $table_name = 'mst_users';
                $update_data = array('reset_password_code' => $activation_code);
                $condition_to_pass = array("user_email" => $arr_check_user_email[0]['user_email']);
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $reset_password_link = '<a href="' . base_url() . 'reset-password/' . base64_encode($activation_code) . '">Click here</a>';
                $lang_id = 17; // Default is 17(English)
                $reserved_words = array(
                    "||USER_NAME||" => $arr_check_user_email[0]['first_name'],
                    "||RESET_PASSWORD_LINK||" => $reset_password_link,
                    "||SITE_TITLE||" => $data['global']['site_title']
                );

                $template_title = 'forgot-password';
                $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);
                $recipeinets = $arr_check_user_email[0]['user_email'];
                $from = array("email" => 'rupeshm173@gmail.com', "name" => 'honeybee');
                $subject = $arr_emailtemplate_data['subject'];
                $message = $arr_emailtemplate_data['content'];
//                echo $recipeinets.$message.$subject;print_r($from);die;
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                $response_arr = array('error_code' => 1, 'msg' => 'success');
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'failed. Email address is not exists');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function userChangePassword() {
        $user_id = $this->input->post('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        if ($user_id != '' && $old_password != '' && $new_password != '') {
            $condition_to_pass = "user_id = '" . $user_id . "' AND user_password = '" . base64_encode($old_password) . "'";
            $arr_user_details = $this->common_model->getRecords('mst_users', 'user_id,user_name,user_email,user_password', $condition_to_pass);
            if (COUNT($arr_user_details) > 0) {
                $update_data = array(
                    'user_password' => base64_encode($new_password)
                );
                $condition = array('user_id' => $user_id);
                $this->common_model->updateRow('mst_users', $update_data, $condition);
                $response_arr = array('error_code' => 1, 'msg' => 'success');
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'wrong old password entered');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function userChangeEmail() {
        $user_id = $this->input->post('user_id');
        $old_emailid = $this->input->post('old_emailid');
        $new_emailid = $this->input->post('new_emailid');

        if ($user_id != '' && $old_emailid != '' && $new_emailid != '') {
            $condition_to_pass = "user_id = '" . $user_id . "' AND user_email = '" . $old_emailid . "'";
            $arr_user_details = $this->common_model->getRecords('mst_users', 'user_id,user_name,user_email', $condition_to_pass);
            if (COUNT($arr_user_details) > 0) {
                $update_data = array(
                    'user_email' => $new_emailid
                );
                $condition = array('user_id' => $user_id);
                $this->common_model->updateRow('mst_users', $update_data, $condition);
                $response_arr = array('error_code' => 1, 'msg' => 'success', 'user_details' => $update_data);
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'failed.wrong old email id entered.');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function getCaratDetails() {
        $arr_carat_details = $this->common_model->getRecords('mst_carat', '', '');
        $response_arr = array('error_code' => 1, 'msg' => 'success', 'cart_details' => $arr_carat_details);
        echo json_encode($response_arr);
    }
    
    public function getInqueryDetails() {
        $user_id = $this->input->post('user_id');
        $arr_inquery_details = $this->common_model->getRecords('jwell_mst_enquiry', '', array('user_id' => $user_id));
        $response_arr = array('error_code' => 1, 'msg' => 'success', 'inquery_details' => $arr_inquery_details);
        echo json_encode($response_arr);
    }

    public function userDetails() {
        $user_id = $this->input->post('user_id');
        if ($user_id != '') {
            $condition_to_pass = array('user_id' => $user_id);
            $arr_user_details = $this->common_model->getRecords('mst_users', 'user_id,first_name,last_name,user_email,address,mobile_no,user_type,profile_picture,user_birth_date', $condition_to_pass);

            $profile_picture = '';
            if (isset($arr_user_details[0]['profile_picture']) && $arr_user_details[0]['profile_picture'] != '' && $arr_user_details[0]['profile_picture'] != '0') {
                $profile_picture = $arr_user_details[0]['profile_picture'];
            }

            $mobile_no = '';
            if (isset($arr_user_details[0]['mobile_no']) && $arr_user_details[0]['mobile_no'] != '') {
                $mobile_no = $arr_user_details[0]['mobile_no'];
            }


            if (COUNT($arr_user_details) > 0) {
                $response_arr = array('error_code' => 1, 'msg' => 'success', 'user_details' => array('user_id' => $arr_user_details[0]['user_id'],
                        'first_name' => $arr_user_details[0]['first_name'], 'last_name' => $arr_user_details[0]['last_name'],
                        'user_email' => $arr_user_details[0]['user_email'], 'mobile_no' => $mobile_no, 'user_type' => $arr_user_details[0]['user_type'],
                        'profile_picture' => $profile_picture, 'birth_date' => $arr_user_details[0]['user_birth_date'], 'address' => $arr_user_details[0]['address']));
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'failed');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function userLogin() {
        $user_email = $this->input->post('email_id');
//        $user_email="rkm@gmail.com";
        $password = $this->input->post('password');
//        $password="Pass@123";
        if ($user_email != '' && $password != '') {
            $condition_to = "(user_email = '" . $user_email . "' OR user_name = '" . $user_email . "')";
            $arr_user_details = $this->common_model->getRecords('mst_users', 'user_id,,first_name,last_name,user_name,user_email,mobile_no,user_type,user_birth_date,address,user_password', $condition_to);
            if (COUNT($arr_user_details) > 0) {
//                $condition_to_pass = "(user_email = '" . $user_email . "' OR user_name = '" . $user_name . "') AND (user_password = '" . base64_encode($password) . "')";
////                echo "<pre>";print_r(end(array($condition_to_pass)));die;
//                $arr_user_details = $this->common_model->getRecords('mst_users', 'user_id,,first_name,last_name,user_name,user_email,mobile_no,user_type,user_birth_date,address', array($condition_to_pass));
//echo "<pre>";print_r($arr_user_details);die;
                if ($password == base64_decode($arr_user_details[0]['user_password'])) {
                    $profile_picture = '';
                    if (isset($arr_user_details[0]['profile_picture']) && $arr_user_details[0]["profile_picture"] != '' && $arr_user_details[0]["profile_picture"] != '0') {
                        $profile_picture = $arr_user_details[0]["profile_picture"];
                    }
                    $mobile_no = '';
                    if (isset($arr_user_details[0]['mobile_no']) && $arr_user_details[0]["mobile_no"] != '') {
                        $mobile_no = $arr_user_details[0]["mobile_no"];
                    }
                    if (COUNT($arr_user_details) > 0) {
                        $response_arr = array('error_code' => 1, 'msg' => 'success', 'user_details' => array('user_id' => $arr_user_details[0]['user_id'], 'user_email' => $arr_user_details[0]['user_email'], 'mobile_no' => $mobile_no, 'user_type' => $arr_user_details[0]['user_type'], "first_name" => $arr_user_details[0]['first_name'], "last_name" => $arr_user_details[0]['last_name'], "birth_date" => $arr_user_details[0]['user_birth_date'], "address" => $arr_user_details[0]['address'], 'profileimage' => $profile_picture));
                        echo json_encode($response_arr);
                    } else {
                        $response_arr = array('error_code' => 0, 'msg' => 'failed.Check your user name, email address or password.');
                        echo json_encode($response_arr);
                    }
                } else {
                    $response_arr = array('error_code' => 0, 'msg' => 'failed.wrong credintials.');
                    echo json_encode($response_arr);
                }
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'user email  dont exist.');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function getCategories() {
        $condition = array('parent_id' => '0');
        $arr = $this->category_model->getAllCategoriesC($condition);
        if (count($arr) > 0) {
            $response_arr = array('error_code' => 1, 'msg' => 'success', 'categories' => $arr);
            echo json_encode($response_arr);
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'no record found');
            echo json_encode($response_arr);
        }
    }

    public function getSubCategories() {
        $condition = array('parent_id' => $this->input->post('category_id'));
        if ($condition['parent_id'] != "") {
            $arr = $this->category_model->getAllCategoriesC($condition);
            if (count($arr) > 0) {
                $response_arr = array('error_code' => 1, 'msg' => 'success', 'categories' => $arr);
                echo json_encode($response_arr);
            } else {
                $response_arr = array('error_code' => 0, 'msg' => 'no record found');
                echo json_encode($response_arr);
            }
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
            echo json_encode($response_arr);
        }
    }

    public function changeProfilePic() {

        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
//        $user_id = 271;
        $base = $this->input->post('profile_image');
        if ($user_id != "") {
//            $base = " ,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";
            if ($base != "") {

                $file_name = time() . '.png';
                // Decode Image
                $binary = base64_decode($base);
                header('Content-Type: bitmap; charset=utf-8');
                // Images will be saved under 'www/imgupload/uplodedimages' folder
                $file = fopen($data['absolute_path'] . 'media/front/img/user-profile-pictures/' . $file_name, 'wb');
//                echo $file_name;die;
                // Create File
                fwrite($file, $binary);
                fclose($file);
                $update_data = array(
                    'profile_picture' => $file_name
                );
                $condition = array('user_id' => $user_id);
                $this->common_model->updateRow('mst_users', $update_data, $condition);
            }
            $response_arr = array('error_code' => 1, 'msg' => 'success');
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed parameter missing');
        }
        echo json_encode($response_arr);
//        if ($_FILES['profileimage']['tmp_name'] != "") {
//            $user_profile_file = time() . ".jpg";
//            move_uploaded_file($_FILES['profileimage']['tmp_name'], "media/front/img/user-profile-pictures/" . $user_profile_file);
//            $update_data = array(
//                'profile_picture' => $user_profile_file
//            );
//            $condition = array('user_id' => $user_id);
//            $this->common_model->updateRow('mst_users', $update_data, $condition);
//        } else {
//            $response_arr = array('error_code' => 0, 'msg' => 'failed parameter missing');
//        }
//            echo json_encode($response_arr);
    }

    public function editUserDetails() {
        $user_id = $this->input->post('user_id');
        $mobile_number = $this->input->post('mobile_number');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $dob = $this->input->post('birth_date');
        $address = $this->input->post('address');
        if ($user_id != '' && $first_name != '' && $mobile_number != '' && $last_name != '') {

            $update_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'mobile_no' => $mobile_number,
                'user_birth_date' => $dob,
                'address' => $address,
            );
            $condition = array('user_id' => $user_id);
            $this->common_model->updateRow('mst_users', $update_data, $condition);
            $response_arr = array('error_code' => 1, 'msg' => 'success.', 'user_details' => array('first_name' => $first_name, 'address' => $address, 'last_name' => $last_name, 'mobile_no' => $mobile_number, 'birth_date' => $dob));
            echo json_encode($response_arr);
        } else {
            $response_arr = array('error_code' => 0, 'msg' => 'failed');
            echo json_encode($response_arr);
        }
    }

    public function sendMail($to, $subject, $body, $headers) {
        $headers = $headers . "\r\n";
        mail($to, $subject, $body, $headers);
    }

    public function sendMailTest() {
        $to = "rupeshm173@gmail.com";
        $subject = "hello";
        $body = "welcome";
        $headers = "rkm@g.com";
        $this->sendMail($to, $subject, $body, $headers);
    }

    public function wsGetProductById() {
        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
//        $product_id = ;
        $is_wishlist_added = 0;
        $products = $this->product_model->getProuctDetilsById($product_id);
//        echo "<pre>";print_r($products);die;
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
//                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }

//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }
//            if ($user_id != "") {
//                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
//                $wish_list = $wish_list[0];
//            }
//            if (in_array($product_id, $wish_list)) {
//                $is_wishlist_added = 1;
//            } else {
//                $is_wishlist_added = 0;
//            }
//            if (isset($products[0]['rating']) && count($products[0]['rating'])) {
//                foreach ($products[0]['rating'] as $rating) {
//                    $rating_cnt = $rating_cnt + 1;
//                    $total_rating = $total_rating + $rating['rating'];
//                    $rating_score = ($total_rating / $rating_cnt);
//                }
//            }
            //Status : 2=>out of stock 1=>available 2=>not available
            if ($products[0]['quantity'] == "" || $products[0]['quantity'] <= 0) {
                $status = '2';
            } else {
                $status = $products[0]['product_status'];
            }
//            if (empty($rating_cnt) || count($rating_cnt) < 0) {
//                $rating_cnt = 0;
//            }
//            if (empty($total_rating) || count($total_rating) < 0) {
//                $total_rating = 0;
//            }
//            $wish_list_name = "";
//            if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                $wish_list_name = "";
//            } else {
//                $wish_list_name = $wish_list['wish_list_name'];
//            }
            $arr_product = array(
                'product_name' => $products[0]['product_name'],
                'product_code' => $products[0]['p_code'],
                'product_id' => $products[0]['product_id'],
                'category_id' => $products[0]['category_id'],
//                    'sub_category_id' => $product['sub_category_id'],
//                'customer_price' => $products[0]['orignal_amount'],
//                'wholesaler_price' => $products[0]['orignal_amount_w'],
//                    'discount' => $product['discount'],
//                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
//                    'arr_color' => $product['product_color'],
                'size' => $products[0]['size'],
                'product_description' => $products[0]['product_description'],
                'instock_qty' => $products[0]['quantity'],
                'product_img' => $products[0]['images'],
                'product_status' => $status,
                'product_height' => $products[0]['p_height'],
                'product_width' => $products[0]['p_width'],
                'product_weight' => $products[0]['p_weight'],
                'diamond_weight' => $products[0]['d_weight'],
                'total_diamonds' => $products[0]['tot_diamonds'],
                'metal_type' => $products[0]['metal_type'],
                'metal_weight' => $products[0]['metal_weight'],
//                    'review_count' => $rating_cnt,
//                    'rating' => $total_rating,
//                    'is_wishlist_added' => $is_wishlist_added,
//                    'wish_list_name' => $wish_list_name,
//                    'product_status' => $status,
//                    'estimated_arival_days' => $product['estimated_arival_days'],
//                    'shipping_charges' => $product['shipping_charges'],
            );
            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function BestProducts() {
//        echo "ss";die;
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        $data = $this->common_model->commonFunction();
//        $user_id = $this->input->post('user_id');
//        $product_id = $this->input->post('product_id');
//        $product_id = ;
//        $is_wishlist_added = 0;
        $conditions = array('best_selling' => '1');
        $products = $this->product_model->getProuctDetilsCon($conditions);

        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
            }
//            echo "<pre>";print_r($products);die;
            $i = 0;
            foreach ($products as $key => $product) {
                //Status : 2=>out of stock 1=>available 2=>not available
                if ($i > 9) {
                    break;
                }
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
//                    'customer_price' => $product['orignal_amount'],
//                    'wholesaler_price' => $product['orignal_amount_w'],
//                    'discount' => $product['discount'],
//                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
//                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
//                    'store_name' => $product['store_name'],
                    'product_status' => $status,
//                    'review_count' => $rating_cnt,
//                    'rating' => $total_rating,
//                    'is_wishlist_added' => $is_wishlist_added,
//                    'wish_list_name' => $wish_list_name,
                    'best_selling' => $product['best_selling'],
//                    'estimated_arival_days' => $product['estimated_arival_days'],
//                    'shipping_charges' => $product['shipping_charges'],
                );
                $i++;
            }
            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function wsGetAllProduct() {
        $data = $this->common_model->commonFunction();

        $products = $this->product_model->getAllProuctDetils();
        $user_id = $this->input->post('user_id');
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'orignal_amount' => $product['orignal_amount'],
                    'discount' => $product['discount'],
                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'store_name' => $product['store_name'],
                    'product_status' => $status,
                    'review_count' => $rating_cnt,
                    'rating' => $total_rating,
                    'is_wishlist_added' => $is_wishlist_added,
                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
                    'estimated_arival_days' => $product['estimated_arival_days'],
                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'arr_product' => $arr_product);
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function wsGetAllProductByMainCategory() {
        $data = $this->common_model->commonFunction();
        $category_id = $this->input->post('category_id');
//        $category_id = 21;
//        $color = $this->input->post('color');
//        $size = $this->input->post('size');
//        $sub_cat_id = $this->input->post('sub_cat_id');

        $products = $this->product_model->getAllProuctDetilsByMainCat($category_id, $color, $size, $sub_cat_id);
        $user_id = $this->input->post('user_id');
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
//                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }
//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }
//            if ($user_id != "") {
//                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
//                $wish_list = $wish_list[0];
//            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                $wish_list_name = "";
//                if (in_array($product['product_id'], $wish_list)) {
//                    $is_wishlist_added = 1;
//                    if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                        $wish_list_name = "";
//                    } else {
//                        $wish_list_name = $wish_list['wish_list_name'];
//                    }
//                } else {
//                    $is_wishlist_added = 0;
//                }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
//                if (isset($product['rating']) && count($product['rating'])) {
//                    foreach ($product['rating'] as $rating) {
//                        $rating_cnt = $rating_cnt + 1;
//                        $total_rating = $total_rating + $rating['rating'];
//                        $rating_score = ($total_rating / $rating_cnt);
//                    }
//                }
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }
//                if (empty($rating_cnt) || count($rating_cnt) < 0) {
//                    $rating_cnt = 0;
//                }
//                if (empty($total_rating) || count($total_rating) < 0) {
//                    $total_rating = 0;
//                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'product_code' => $product['p_code'],
                    'category_id' => $product['category_id'],
//                    'sub_category_id' => $product['sub_category_id'],
//                    'customer_price' => $product['orignal_amount'],
//                    'wholesaler_price' => $product['orignal_amount_w'],
//                    'discount' => $product['discount'],
//                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
//                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'product_height' => $product['p_height'],
                    'product_width' => $product['p_width'],
                    'product_weight' => $product['p_weight'],
                    'diamond_weight' => $product['d_weight'],
                    'total_diamonds' => $product['tot_diamonds'],
                    'metal_type' => $product['metal_type'],
                    'metal_weight' => $product['metal_weight'],
//                    'store_name' => $product['store_name'],
//                    'product_status' => $status,
//                    'review_count' => $rating_cnt,
//                    'rating' => $total_rating,
//                    'is_wishlist_added' => $is_wishlist_added,
//                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
//                    'estimated_arival_days' => $product['estimated_arival_days'],
//                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function wsGetAllProductBySubCategory() {
        $data = $this->common_model->commonFunction();
        $category_id = $this->input->post('category_id');
//        $category_id='13';
        $products = $this->product_model->getAllProuctDetilsBySubCat($category_id);
        $user_id = $this->input->post('user_id');
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }
//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }

            if ($user_id != "") {
                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                $wish_list = $wish_list[0];
            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                $wish_list_name = "";
                if (in_array($product['product_id'], $wish_list)) {
                    $is_wishlist_added = 1;
                    if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                        $wish_list_name = "";
                    } else {
                        $wish_list_name = $wish_list['wish_list_name'];
                    }
                } else {
                    $is_wishlist_added = 0;
                }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                if (isset($product['rating']) && count($product['rating'])) {
                    foreach ($product['rating'] as $rating) {
                        $rating_cnt = $rating_cnt + 1;
                        $total_rating = $total_rating + $rating['rating'];
                        $rating_score = ($total_rating / $rating_cnt);
                    }
                }
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }
                if (empty($rating_cnt) || count($rating_cnt) < 0) {
                    $rating_cnt = 0;
                }
                if (empty($total_rating) || count($total_rating) < 0) {
                    $total_rating = 0;
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'sub_category_id' => $product['sub_category_id'],
                    'orignal_amount' => $product['orignal_amount'],
                    'discount' => $product['discount'],
                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'store_name' => $product['store_name'],
                    'product_status' => $status,
                    'review_count' => $rating_cnt,
                    'rating' => $total_rating,
                    'is_wishlist_added' => $is_wishlist_added,
                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
                    'estimated_arival_days' => $product['estimated_arival_days'],
                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function wsGetAllRecentlyViewedProduct() {
        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
//        $user_id='1';
        $viewed_products = $this->common_model->getRecords('mst_recently_viewed_products', '', array('user_id_fk' => $user_id), 'viewed_id Desc');

        if (count($viewed_products) > 0) {
            foreach ($viewed_products as $view) {
                $products[] = end($this->product_model->getProuctDetilsById($view['product_id_fk']));
            }
        }
//        echo "<pre>";print_r($products);die;

        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }
//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }

            if ($user_id != "") {
                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                $wish_list = $wish_list[0];
            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                $wish_list_name = "";
                if (in_array($product['product_id'], $wish_list)) {
                    $is_wishlist_added = 1;
                    if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                        $wish_list_name = "";
                    } else {
                        $wish_list_name = $wish_list['wish_list_name'];
                    }
                } else {
                    $is_wishlist_added = 0;
                }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                if (isset($product['rating']) && count($product['rating'])) {
                    foreach ($product['rating'] as $rating) {
                        $rating_cnt = $rating_cnt + 1;
                        $total_rating = $total_rating + $rating['rating'];
                        $rating_score = ($total_rating / $rating_cnt);
                    }
                }
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }
                if (empty($rating_cnt) || count($rating_cnt) < 0) {
                    $rating_cnt = 0;
                }
                if (empty($total_rating) || count($total_rating) < 0) {
                    $total_rating = 0;
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'sub_category_id' => $product['sub_category_id'],
                    'orignal_amount' => $product['orignal_amount'],
                    'discount' => $product['discount'],
                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'store_name' => $product['store_name'],
                    'product_status' => $status,
                    'review_count' => $rating_cnt,
                    'rating' => $total_rating,
                    'is_wishlist_added' => $is_wishlist_added,
                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
                    'estimated_arival_days' => $product['estimated_arival_days'],
                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function wsAddRecentlyViewedProduct() {
        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        if ($user_id != "") {
            $viewed_products = $this->common_model->getRecords('mst_recently_viewed_products', 'product_id_fk', array('user_id_fk' => $user_id), 'viewed_id Desc');
            $views = array();
            foreach ($viewed_products as $view) {
                $views[] = $view['product_id_fk'];
            }
//        echo "<pre>";print_r($views);die;
            if (in_array($product_id, $views)) {
                $this->db->where('user_id_fk', $user_id);
                $this->db->where('product_id_fk', $product_id);
                $this->db->delete('mst_recently_viewed_products');
                $arr_insert = array(
                    'product_id_fk' => $product_id,
                    'user_id_fk' => $user_id,
                    'added_date' => date('y-m-d H:i:s')
                );
                $insert_id = $this->common_model->insertRow($arr_insert, 'mst_recently_viewed_products');
                if ($insert_id != "") {
                    $arr_data = $this->common_model->getRecords('mst_recently_viewed_products', '', array('viewed_id' => $insert_id), '', '');
                    $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
                } else {
                    $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
                }
            } else {
                $arr_insert = array(
                    'product_id_fk' => $product_id,
                    'user_id_fk' => $user_id,
                    'added_date' => date('y-m-d H:i:s')
                );
                $insert_id = $this->common_model->insertRow($arr_insert, 'mst_recently_viewed_products');
                if ($insert_id != "") {
                    $arr_data = $this->common_model->getRecords('mst_recently_viewed_products', '', array('viewed_id' => $insert_id), '', '');
                    $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
                } else {
                    $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
                }
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }



        echo json_encode($arr_to_return);
    }

    public function wsAddToCart() {
        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $color = $this->input->post('color');
        $size = $this->input->post('size');
        if ($user_id != "" && $product_id != "" && $quantity != "" && $color != "" && $size != "") {
            $cart_products = $this->common_model->getRecords('mst_cart', 'product_id_fk', array('user_id_fk' => $user_id, 'product_id_fk' => $product_id));
            $views = array();
            foreach ($cart_products as $cart) {
                $carts[] = $cart['product_id_fk'];
            }
//        echo "<pre>";print_r($carts);die;
            if (!in_array($product_id, $carts)) {
                $arr_insert = array(
                    'product_id_fk' => $product_id,
                    'user_id_fk' => $user_id,
                    'quantity' => $quantity,
                    'color' => $color,
                    'size' => $size,
                    'added_date' => date('y-m-d H:i:s')
                );
                $insert_id = $this->common_model->insertRow($arr_insert, 'mst_cart');
                if ($insert_id != "") {
                    $arr_data = end($this->common_model->getRecords('mst_cart', '', array('cart_product_id' => $insert_id), '', ''));
                    $arr_data = $this->product_model->getCartProudctDetilsByUserId($arr_data['user_id_fk']);

                    $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
                } else {
                    $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
                }
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'already added');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }



        echo json_encode($arr_to_return);
    }

    public function wsMyCart() {
        $data = $this->common_model->commonFunction();
        $user_id = $this->input->post('user_id');
//        $user_id=245;
        if ($user_id != "") {
            $products = $this->product_model->getCartProudctDetilsByUserId($user_id);
            if (count($products) > 0 && $products[0]['product_id'] != '') {
                foreach ($products as $key => $user_product) {
                    $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                    $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
                }
//                    echo "<pre>";print_r($products);die;
                foreach ($products as $key => $product) {
                    $wish_list_name = "";
                    if (in_array($product['product_id'], $wish_list)) {
                        $is_wishlist_added = 1;
                        if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                            $wish_list_name = "";
                        } else {
                            $wish_list_name = $wish_list['wish_list_name'];
                        }
                    } else {
                        $is_wishlist_added = 0;
                    }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                    if (isset($product['rating']) && count($product['rating'])) {
                        foreach ($product['rating'] as $rating) {
                            $rating_cnt = $rating_cnt + 1;
                            $total_rating = $total_rating + $rating['rating'];
                            $rating_score = ($total_rating / $rating_cnt);
                        }
                    }
                    //Status : 2=>out of stock 1=>available 2=>not available
                    $status = "";
                    if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                        $status = '2';
                    } else {
                        $status = $product['product_status'];
                    }
                    if (empty($rating_cnt) || count($rating_cnt) < 0) {
                        $rating_cnt = 0;
                    }
                    if (empty($total_rating) || count($total_rating) < 0) {
                        $total_rating = 0;
                    }


                    $arr_product[$key] = array(
                        'product_name' => $product['product_name'],
                        'product_id' => $product['product_id'],
                        'category_id' => $product['category_id'],
                        'sub_category_id' => $product['sub_category_id'],
                        'orignal_amount' => $product['orignal_amount'],
                        'discount' => $product['discount'],
                        'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                        'arr_color' => $product['cart_color'],
                        'size' => $product['cart_size'],
                        'product_description' => $product['product_description'],
                        'instock_qty' => $product['cart_quantity'],
                        'product_img' => $product['images'],
                        'store_name' => $product['store_name'],
                        'product_status' => $status,
                        'review_count' => $rating_cnt,
                        'rating' => $total_rating,
                        'is_wishlist_added' => $is_wishlist_added,
                        'wish_list_name' => $wish_list_name,
                        'product_status' => $status,
                        'estimated_arival_days' => $product['estimated_arival_days'],
                        'shipping_charges' => $product['shipping_charges'],
                    );
                }
//            echo "<pre>";print_r($arr_product);die;
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_product);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function wsUpdateCart() {
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $color = $this->input->post('color');
        $size = $this->input->post('size');
        if ($user_id != "" && $product_id && $quantity != "" && $color != "" && $size != "") {
            $cart_products = $this->common_model->getRecords('mst_cart', 'product_id_fk', array('user_id_fk' => $user_id, 'product_id_fk' => $product_id));
            $views = array();
            foreach ($cart_products as $cart) {
                $carts[] = $cart['product_id_fk'];
            }
            if (in_array($product_id, $carts)) {
                $this->db->where('user_id_fk', $user_id);
                $this->db->where('product_id_fk', $product_id);
                $this->db->delete('mst_recently_viewed_products');
                $arr_update = array(
                    'product_id_fk' => $product_id,
                    'user_id_fk' => $user_id,
                    'quantity' => $quantity,
                    'color' => $color,
                    'size' => $size,
                    'updated_date' => date('y-m-d H:i:s')
                );
                $condition = array('user_id_fk' => $user_id, 'product_id_fk' => $product_id);
                $this->common_model->updateRow('mst_cart', $arr_update, $condition);
                $arr_data = $this->product_model->getCartProudctDetilsByUserIdPid($user_id, $product_id);
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'Product not available in cart');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function wsRemoveFromCart() {
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        if ($user_id != "" && $product_id) {
            $cart_products = $this->common_model->getRecords('mst_cart', 'product_id_fk', array('user_id_fk' => $user_id, 'product_id_fk' => $product_id));
            if (count($cart_products) > 0) {
                $this->db->where('user_id_fk', $user_id);
                $this->db->where('product_id_fk', $product_id);
                $this->db->delete('mst_cart');
                $arr_to_return = array('error_code' => 1, 'msg' => "success");
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'Product not available in cart');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function addShippingAddress() {
        $user_id = $this->input->post('user_id_fk');
        $full_name = $this->input->post('full_name');
        $mobile_no = $this->input->post('mobile_no');
        $pincode = $this->input->post('pincode');
        $appt_no = $this->input->post('appt_no');
        $street = $this->input->post('street');
        $landmark = $this->input->post('landmark');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        if ($user_id != "" && $full_name != "" && $mobile_no != "" && $pincode != "" && $city != "") {
            $arr_insert = array(
                'full_name' => $full_name,
                'user_id_fk' => $user_id,
                'mobile_no' => $mobile_no,
                'pincode' => $pincode,
                'appt_no' => $appt_no,
                'street' => $street,
                'landmark' => $landmark,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'created_date' => date('y-m-d H:i:s')
            );
            $insert_id = $this->common_model->insertRow($arr_insert, 'mst_shipping_address');
            if ($insert_id != "") {
                $arr_data = $this->common_model->getRecords('mst_shipping_address', '', array('shipping_id' => $insert_id), '', '');
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function updateShippingAddress() {
        $user_id = $this->input->post('user_id');
        $shipping_id = $this->input->post('shipping_id');
        $full_name = $this->input->post('full_name');
        $mobile_no = $this->input->post('mobile_no');
        $pincode = $this->input->post('pincode');
        $appt_no = $this->input->post('appt_no');
        $street = $this->input->post('street');
        $landmark = $this->input->post('landmark');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        if ($user_id != "" && $shipping_id != "" && $full_name != "" && $mobile_no != "" && $pincode != "" && $city != "") {
            $shipping_address = $this->common_model->getRecords('mst_shipping_address', '', array('shipping_id' => $shipping_id, 'user_id_fk' => $user_id), '', '');
            $arr_update = array(
                'full_name' => $full_name,
                'user_id_fk' => $user_id,
                'mobile_no' => $mobile_no,
                'pincode' => $pincode,
                'appt_no' => $appt_no,
                'street' => $street,
                'landmark' => $landmark,
                'country' => $country,
                'state' => $state,
                'city' => $city,
            );
            $condition = array('user_id_fk' => $user_id, 'shipping_id' => $shipping_id);
            $this->common_model->updateRow('mst_shipping_address', $arr_update, $condition);
            $arr_data = $this->common_model->getRecords('mst_shipping_address', '', array('shipping_id' => $shipping_id, 'user_id_fk' => $user_id), '', '');
            $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_data' => $arr_data);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function removeShippingAddress() {
        $user_id = $this->input->post('user_id');
        $shipping_id = $this->input->post('shipping_id');
        if ($user_id != "" && $shipping_id) {
            $shipping_address = $this->common_model->getRecords('mst_shipping_address', '', array('shipping_id' => $shipping_id, 'user_id_fk' => $user_id), '', '');
            if (count($shipping_address) > 0) {
                $this->db->where('user_id_fk', $user_id);
                $this->db->where('shipping_id', $shipping_id);
                $this->db->delete('mst_shipping_address');
                $arr_to_return = array('error_code' => 1, 'msg' => "success");
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'Shipping address not found');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function getShippingAddress() {
        $user_id = $this->input->post('user_id');
        if ($user_id != "") {
            $shipping_address = $this->common_model->getRecords('mst_shipping_address', '', array('user_id_fk' => $user_id), '', '');
            if (count($shipping_address) > 0) {
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'shipping_address' => $shipping_address);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'Shipping address not found');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function placeOrder() {

        $user_id = $this->input->post('user_id');
        $shipping_id = $this->input->post('shipping_id');
        $qty = $this->input->post('total_qty');
        $total_amt = $this->input->post('total_amount');
//        $product_id = $this->input->post('product_id');
        $cart = $this->input->post('cart');
        //If payment type is credit card then give payment_id
        $payment_id = $this->input->post('payment_id');
        $order_type = $this->input->post('trans_type');
//        $user_id = '219';
//        $shipping_id = '3';
//        $qty = 5;
//        $total_amt = '2200';
//        $payment_id=  '111';
//        $order_type=  '0';
//        $cart=  json_decode($cart);
//        $cart=array();
//        $cart[0]['product_id']=9;
//        $cart[0]['qty']=3;
//        $cart[0]['store_id']=1;
//        $cart[0]['subtotal']=1200;
//        $cart[0]['product_name']='CAP';
//        $cart[0]['order_color']='Red';
//        $cart[0]['order_size']='Small';
//        $cart[0]['category_id']='7';
//        $cart[0]['sub_category_id']='13';
//        $cart[1]['product_id']=10;
//        $cart[1]['qty']=2;
//        $cart[1]['store_id']='';
//        $cart[1]['subtotal']=1000;
//        $cart[1]['product_name']='CAP1';
//        $cart[1]['order_color']='Black';
//        $cart[1]['order_size']='medium';
//        $cart[1]['category_id']='7';
//        $cart[1]['sub_category_id']='13';
//        $cart=json_encode($cart);
//        echo $cart;die;
        $cart = json_decode($cart);
        $cart = (object) $cart;
        if (count($cart) > 0 && $user_id && $shipping_id) {
            $shipping_details = $this->common_model->getRecords('mst_shipping_address', '', array('user_id_fk' => $user_id));
            $uniq_id = 'OI' . time();
            $arr_to_order = array(
                'order_uniq_id' => $uniq_id,
                'buyer_id' => $user_id,
                'shipping_id' => $shipping_id,
                'order_status' => '0',
                'total_qty' => $qty,
                'total_amount' => round($total_amt, 2),
                'order_date' => date('Y-m-d H:i:s'),
                'ship_address_line_1' => $shipping_details[0]['appt_no'] . ' ' . $shipping_details[0]['appt_no'] . ',' . $shipping_details[0]['street'],
                'ship_address_line_2' => $shipping_details[0]['landmark'] . ' ' . $shipping_details[0]['pincode'],
                'ship_country' => $shipping_details[0]['country'],
                'ship_state' => $shipping_details[0]['state'],
                'ship_city' => $shipping_details[0]['city'],
                'ship_phone_no' => $shipping_details[0]['mobile_no'],
                'full_name' => $shipping_details[0]['full_name']
            );
            $insert_id = $this->common_model->insertRow($arr_to_order, 'mst_order');
            if ($insert_id != '') {
//            echo "<pre>";print_r($cart);die;
                if (isset($cart) && count($cart) > 0) {
                    foreach ($cart as $my_cart) {
                        $product_arr = array(
                            'product_id' => $my_cart->product_id,
                            'qty' => $my_cart->qty,
                            'order_id' => $insert_id,
                            'store_id' => $my_cart->store_id,
                            'total_price' => round($my_cart->subtotal, 3),
                            'order_color' => $my_cart->order_color,
                            'order_size' => $my_cart->order_size,
                            'category_id' => $my_cart->category_id,
                            'sub_category_id' => $my_cart->sub_category_id,
//                            'order_weight' => $order_weigth,
                            'product_name' => $my_cart->product_name,
                        );
//                    echo "<pre>";print_r($product_arr);
                        $insert_order[] = $this->common_model->insertRow($product_arr, 'trans_product_order');
                        $this->db->where('product_id_fk', $my_cart->product_id);
                        $this->db->delete('mst_cart');
                    }
//                die;
                    $arr_tranc = array(
                        'user_id_fk' => $user_id,
                        'order_id_fk' => $insert_id,
                        'trans_type' => $order_type,
                        'trasn_date' => date('d-m-y H:i:s'),
                    );
                    if ($arr_tranc['trans_type'] == '1') {
                        $arr_tranc['trans_unique_id'] = $payment_id;
                    }
                    $insert_id = $this->common_model->insertRow($arr_tranc, 'mst_transc_history');
                    $arr_to_return = array('error_code' => 1, 'msg' => "success");
                }
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function wsUserOrdersList() {
        $user_id = $this->input->post('user_id');
        if ($user_id != "") {
            $arr_user = $this->common_model->getRecords('mst_users', '', array('user_id' => $user_id), '', '');
            if (count($arr_user) > 0) {
                $order_list = $this->common_model->getRecords('mst_order', '', array('buyer_id' => $user_id), '', '');
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'order_list' => $order_list);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed invalid user id');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function wsUserOrdersDetails() {
        $order_id = $this->input->post('order_id');
        if (!empty($this->input->post('product_ids')) && $this->input->post('product_ids') != "") {
            $order_id = $this->input->post('product_ids');
        }
        if ($order_id != "") {
            $products = $this->product_model->getAllProuctDetilsByOrderId($order_id);

            $user_id = $this->input->post('user_id');
            if (count($products) > 0) {
                foreach ($products as $key => $user_product) {
                    $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                }
                $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'order_details' => $products);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed.');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function wsGetAllOfferedProduct() {
        $data = $this->common_model->commonFunction();

        $products = $this->product_model->getAllOfferedProuctDetils();
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }
//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }

            if ($user_id != "") {
                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                $wish_list = $wish_list[0];
            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                $wish_list_name = "";
                if (in_array($product['product_id'], $wish_list)) {
                    $is_wishlist_added = 1;
                    if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                        $wish_list_name = "";
                    } else {
                        $wish_list_name = $wish_list['wish_list_name'];
                    }
                } else {
                    $is_wishlist_added = 0;
                }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                if (isset($product['rating']) && count($product['rating'])) {
                    foreach ($product['rating'] as $rating) {
                        $rating_cnt = $rating_cnt + 1;
                        $total_rating = $total_rating + $rating['rating'];
                        $rating_score = ($total_rating / $rating_cnt);
                    }
                }
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }
                if (empty($rating_cnt) || count($rating_cnt) < 0) {
                    $rating_cnt = 0;
                }
                if (empty($total_rating) || count($total_rating) < 0) {
                    $total_rating = 0;
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'sub_category_id' => $product['sub_category_id'],
                    'orignal_amount' => $product['orignal_amount'],
                    'discount' => $product['discount'],
                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'store_name' => $product['store_name'],
                    'product_status' => $status,
                    'review_count' => $rating_cnt,
                    'rating' => $total_rating,
                    'is_wishlist_added' => $is_wishlist_added,
                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
                    'estimated_arival_days' => $product['estimated_arival_days'],
                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'arr_product' => $arr_product);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function deleteAccount() {
        $user_id = $this->input->post('user_id');
        if ($user_id != "") {
            $user_details = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
            if (count($user_details) > 0) {
                $condition_to_pass = array('user_id' => $user_id);
                $update_data = array('user_status' => '2');
                $this->common_model->updateRow('mst_users', $update_data, $condition_to_pass);
                $arr_to_return = array('error_code' => 1, 'msg' => 'success');
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'no record found');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'parameter missing');
        }

        echo json_encode($arr_to_return);
    }

    public function wsSearchProduct() {
        $search = $this->input->post('search');
        $user_id = $this->input->post('user_id');
        if ($search != "") {

            $products = $this->product_model->getAllProuctSearched($search);
            if (count($products) > 0) {
                if (count($products) > 0 && $products[0]['product_id'] != '') {
                    foreach ($products as $key => $user_product) {
                        $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                        $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
                    }
                    if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
                        foreach ($products[0]['images'] as $key => $img) {
                            $products[0]['images'][$key] = array(
                                'product_image_id' => $img['product_img_id'],
                                'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
                                'product_image_name' => $img['image_name']
                            );
                        }
                    }

                    if ($user_id != "") {
                        $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                        $wish_list = $wish_list[0];
                    }
//            echo "<pre>";print_r($products);die;
                    foreach ($products as $key => $product) {
                        $wish_list_name = "";
                        if (in_array($product['product_id'], $wish_list)) {
                            $is_wishlist_added = 1;
                            if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                                $wish_list_name = "";
                            } else {
                                $wish_list_name = $wish_list['wish_list_name'];
                            }
                        } else {
                            $is_wishlist_added = 0;
                        }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                        if (isset($product['rating']) && count($product['rating'])) {
                            foreach ($product['rating'] as $rating) {
                                $rating_cnt = $rating_cnt + 1;
                                $total_rating = $total_rating + $rating['rating'];
                                $rating_score = ($total_rating / $rating_cnt);
                            }
                        }
                        //Status : 2=>out of stock 1=>available 2=>not available
                        $status = "";
                        if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                            $status = '2';
                        } else {
                            $status = $product['product_status'];
                        }
                        if (empty($rating_cnt) || count($rating_cnt) < 0) {
                            $rating_cnt = 0;
                        }
                        if (empty($total_rating) || count($total_rating) < 0) {
                            $total_rating = 0;
                        }


                        $arr_product[$key] = array(
                            'product_name' => $product['product_name'],
                            'product_id' => $product['product_id'],
                            'category_id' => $product['category_id'],
                            'sub_category_id' => $product['sub_category_id'],
                            'orignal_amount' => $product['orignal_amount'],
                            'discount' => $product['discount'],
                            'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                            'arr_color' => $product['product_color'],
                            'size' => $product['size'],
                            'product_description' => $product['product_description'],
                            'instock_qty' => $product['quantity'],
                            'product_img' => $product['images'],
                            'store_name' => $product['store_name'],
                            'product_status' => $status,
                            'review_count' => $rating_cnt,
                            'rating' => $total_rating,
                            'is_wishlist_added' => $is_wishlist_added,
                            'wish_list_name' => $wish_list_name,
                            'product_status' => $status,
                            'estimated_arival_days' => $product['estimated_arival_days'],
                            'shipping_charges' => $product['shipping_charges'],
                        );
                    }
                }
                $arr_to_return = array('error_code' => 1, 'msg' => "success", 'arr_product' => $arr_product);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'no record found');
            }
        } else {

            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function relatedProducts() {
        $sub_category_id = $this->input->post('sub_category_id');
        $product_id = $this->input->post('product_id');
        if ($sub_category_id != "" && $product_id != "") {
            $products = $this->product_model->getRelatedProducts($product_id, $sub_category_id);
            if (!empty($products) && count($products) > 0) {
                foreach ($products as $key => $user_product) {
                    $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                    $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
                }
                if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
                    foreach ($products[0]['images'] as $key => $img) {
                        $products[0]['images'][$key] = array(
                            'product_image_id' => $img['product_img_id'],
                            'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
                            'product_image_name' => $img['image_name']
                        );
                    }
                }

                if ($user_id != "") {
                    $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                    $wish_list = $wish_list[0];
                }
                foreach ($products as $key => $product) {
                    $wish_list_name = "";
                    if (in_array($product['product_id'], $wish_list)) {
                        $is_wishlist_added = 1;
                        if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                            $wish_list_name = "";
                        } else {
                            $wish_list_name = $wish_list['wish_list_name'];
                        }
                    } else {
                        $is_wishlist_added = 0;
                    }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                    if (isset($product['rating']) && count($product['rating'])) {
                        foreach ($product['rating'] as $rating) {
                            $rating_cnt = $rating_cnt + 1;
                            $total_rating = $total_rating + $rating['rating'];
                            $rating_score = ($total_rating / $rating_cnt);
                        }
                    }
                    //Status : 2=>out of stock 1=>available 2=>not available
                    $status = "";
                    if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                        $status = '2';
                    } else {
                        $status = $product['product_status'];
                    }
                    if (empty($rating_cnt) || count($rating_cnt) < 0) {
                        $rating_cnt = 0;
                    }
                    if (empty($total_rating) || count($total_rating) < 0) {
                        $total_rating = 0;
                    }


                    $arr_product[$key] = array(
                        'product_name' => $product['product_name'],
                        'product_id' => $product['product_id'],
                        'category_id' => $product['category_id'],
                        'sub_category_id' => $product['sub_category_id'],
                        'orignal_amount' => $product['orignal_amount'],
                        'discount' => $product['discount'],
                        'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                        'arr_color' => $product['product_color'],
                        'size' => $product['size'],
                        'product_description' => $product['product_description'],
                        'instock_qty' => $product['quantity'],
                        'product_img' => $product['images'],
                        'store_name' => $product['store_name'],
                        'product_status' => $status,
                        'review_count' => $rating_cnt,
                        'rating' => $total_rating,
                        'is_wishlist_added' => $is_wishlist_added,
                        'wish_list_name' => $wish_list_name,
                        'product_status' => $status,
                        'estimated_arival_days' => $product['estimated_arival_days'],
                        'shipping_charges' => $product['shipping_charges'],
                    );
                }
                $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'arr_product' => $arr_product);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed. No related products available');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function staticContent() {
        $page_name = $this->input->post('page_name');
        if ($page_name != "") {
            $cms = $this->cms_model->getPage($page_name);
            if (count($cms) > 0) {
                $cms = strip_tags($cms[0]['page_content']);
                $cms = str_replace("\n", '', $cms);
                $cms = str_replace("\r", '', $cms);
                $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'page' => $cms);
            } else {
                $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
            }
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed. Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function faq() {

        $condition = array('f.status' => 'Active');
        $faq_question_details = $this->faq_model->getFAQS('question,answer,category_id,faq_id', $condition, 'faq_id Desc');
        if (count($faq_question_details) > 0) {
            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'faq' => $faq_question_details);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }
        echo json_encode($arr_to_return);
    }

    public function trackOrder() {
        $order_id = $this->input->post('order_id');
        if ($order_id != "") {
            $track = $this->common_model->getRecords("mst_order", "", array("order_uniq_id" => $order_id));
            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'track' => $track);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed.Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function getNotification() {

        $user_id = $this->input->post('user_id');
//        $user_id=237;
        if ($user_id != "") {
            $notifications = $this->common_model->getRecords("mst_notifications", "", array("notification_to" => $user_id));
            foreach ($notifications as $key => $value) {
                $arr_productids = explode(',', $value['product_ids']);
                foreach ($arr_productids as $product) {
                    $notifications[$key]['images'] = $this->common_model->getRecords("trans_product_images", "", array("product_id_fk" => $product));
                    $notifications[$key]['image_path'] = base_url() . 'media/front/img/product-img/';
                }
            }
//            echo "<pre>";print_r($notifications);
            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'notification' => $notifications);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed.Parameter missing');
        }
        echo json_encode($arr_to_return);
    }

    public function recommendedProducts() {

        $data = $this->common_model->commonFunction();
        $product_ids = $this->input->post('product_ids');
//        $product_ids='10,11';
        $product_ids = explode(',', $product_ids);
        foreach ($product_ids as $key => $product_id) {
            $products[$key] = end($this->product_model->getAllRecProducts($product_id));
        }
//        echo "<pre>";print_r($products);die;
        if (count($products) > 0 && $products[0]['product_id'] != '') {
            foreach ($products as $key => $user_product) {
                $products[$key]['images'] = $this->common_model->getRecords('trans_product_images', 'product_img_id,image_name', array('product_id_fk' => $user_product['product_id']), '', '');
                $products[$key]['rating'] = $this->common_model->getRecords('mst_ratings', '', array('product_id' => $product_id));
            }
//            if (isset($products[0]['images']) && count($products[0]['images']) > 0) {
//                foreach ($products[0]['images'] as $key => $img) {
//                    $products[0]['images'][$key] = array(
//                        'product_image_id' => $img['product_img_id'],
//                        'product_image_path' => base_url() . 'media/front/img/product-img/' . '/' . $img['image_name'],
//                        'product_image_name' => $img['image_name']
//                    );
//                }
//            }

            if ($user_id != "") {
                $wish_list = $this->common_model->getRecords("mst_wish_list", "wish_list_id,buyer_id,created_date,updated_date,wish_list_name,product_id", array("product_id" => intval($product_id), "buyer_id" => $user_id));
                $wish_list = $wish_list[0];
            }
//            echo "<pre>";print_r($products);die;
            foreach ($products as $key => $product) {
                $wish_list_name = "";
                if (in_array($product['product_id'], $wish_list)) {
                    $is_wishlist_added = 1;
                    if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
                        $wish_list_name = "";
                    } else {
                        $wish_list_name = $wish_list['wish_list_name'];
                    }
                } else {
                    $is_wishlist_added = 0;
                }
//                if (empty($wish_list['wish_list_name']) || $wish_list['wish_list_name'] == "") {
//                    $wish_list_name = "";
//                } else {
//                    $wish_list_name = $wish_list['wish_list_name'];
//                }
                if (isset($product['rating']) && count($product['rating'])) {
                    foreach ($product['rating'] as $rating) {
                        $rating_cnt = $rating_cnt + 1;
                        $total_rating = $total_rating + $rating['rating'];
                        $rating_score = ($total_rating / $rating_cnt);
                    }
                }
                //Status : 2=>out of stock 1=>available 2=>not available
                $status = "";
                if ($product['quantity'] == "" || $product['quantity'] <= 0) {
                    $status = '2';
                } else {
                    $status = $product['product_status'];
                }
                if (empty($rating_cnt) || count($rating_cnt) < 0) {
                    $rating_cnt = 0;
                }
                if (empty($total_rating) || count($total_rating) < 0) {
                    $total_rating = 0;
                }


                $arr_product[$key] = array(
                    'product_name' => $product['product_name'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'sub_category_id' => $product['sub_category_id'],
                    'orignal_amount' => $product['orignal_amount'],
                    'discount' => $product['discount'],
                    'verified' => $product['verified'], //Verifed: 0=>No,1=>yes
                    'arr_color' => $product['product_color'],
                    'size' => $product['size'],
                    'product_description' => $product['product_description'],
                    'instock_qty' => $product['quantity'],
                    'product_img' => $product['images'],
                    'store_name' => $product['store_name'],
                    'product_status' => $status,
                    'review_count' => $rating_cnt,
                    'rating' => $total_rating,
                    'is_wishlist_added' => $is_wishlist_added,
                    'wish_list_name' => $wish_list_name,
                    'product_status' => $status,
                    'estimated_arival_days' => $product['estimated_arival_days'],
                    'shipping_charges' => $product['shipping_charges'],
                );
            }

            $arr_to_return = array('error_code' => 1, 'msg' => 'success', 'arr_product' => $arr_product);
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

    public function sendInquiry() {
        $name = $this->input->post('name');
        $email_id = $this->input->post('email_id');
        $mobile_no = $this->input->post('mobile_no');
        $product_name = $this->input->post('product_name');
        $quantity = $this->input->post('quantity');
        $comment = $this->input->post('comment');
        $product_code = $this->input->post('product_code');
        $user_id = $this->input->post('uid');

//        $name="Rupesh";
//        $email_id="rkm@gmail.com";
//        $mobile_no="12344555";
//        $product_name="Bag";
//        $quantity="2";
//        $comment="Commentssss";
        if ($name != "" && $email_id != "") {
            $arr_insert = array(
                'name' => $name,
                'email_id' => $email_id,
                'p_code' => $product_code,
                'mobile_no' => $mobile_no,
                'product_name' => $product_name,
                'quantity' => $quantity,
                'comment' => $comment,
                'user_id' => $user_id,
            );
            $last_insert_id = $this->common_model->insertRow($arr_insert, 'mst_enquiry');
            $arr_to_return = array('error_code' => 1, 'msg' => 'success');
        } else {
            $arr_to_return = array('error_code' => 0, 'msg' => 'failed');
        }

        echo json_encode($arr_to_return);
    }

}
