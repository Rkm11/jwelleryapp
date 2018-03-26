<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("register_model");
    }

    /*
     * Normal user registration process
     */

    public function userRegistration() {
        $data = $this->common_model->commonFunction();
        $data['global'] = $this->common_model->getGlobalSettings();

        if ($this->input->post('first_name') != '' && $this->input->post('last_name') != '' && $this->input->post('user_email') != '' && $this->input->post('user_password') != '' && $this->input->post('gender') != '') {
            $table = 'mst_users';
            $activation_code = time();
            $fields = array('first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'user_email' => $this->input->post('user_email'),
                'user_name' => $this->input->post('user_name'),
                'user_password' => base64_encode($this->input->post('user_password')),
                'gender' => $this->input->post('gender'),
                'user_type' => '1',
                'user_status' => '0',
                'activation_code' => $activation_code,
                'email_verified' => '0',
                'register_date' => date("Y-m-d H:i:s"),
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $login_link = '<a href="' . base_url() . 'signin">Click here.</a>';
            $lang_id = $this->session->userdata('lang_id');
            if (isset($lang_id) && $lang_id != '') {
                $lang_id = $this->session->userdata('lang_id');
            } else {
                $lang_id = 17; // Default is 17(English)
            }
            $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Click here</a>';
            $macros_array_detail = array();
            $macros_array_detail = $this->common_model->getRecords('mst_email_template_macros', 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_detail as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            $reserved_words = array();

            $reserved_arr = array
                (
                "||USER_NAME||" => $this->input->post('user_name'),
                "||FIRST_NAME||" => $this->input->post('first_name'),
                "||LAST_NAME||" => $this->input->post('last_name'),
                "||USER_EMAIL||" => $this->input->post('user_email'),
                "||PASSWORD||" => $this->input->post('user_password'),
                "||ACTIVATION_LINK||" => $activation_link,
                "||SITE_URL||" => base_url(),
                "||SITE_TITLE||" => $data['global']['site_title']
            );

            $reserved_words = array_replace_recursive($macros_array, $reserved_arr);
            $template_title = 'registration-successful';

            $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);
            $recipeinets = $this->input->post('user_email');
            $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
            $subject = $arr_emailtemplate_data['subject'];
            $message = $arr_emailtemplate_data['content'];

            $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
            $condition = '';
            $insert_id = $this->common_model->insertRow($fields, $table);

            $macros_array_detail = array();
            $macros_array_detail = $this->common_model->getRecords('mst_email_template_macros', 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_detail as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            $reserved_words = array();
            $reserved_arr = array
                (
                "||FIRST_NAME||" => $this->input->post('first_name'),
                "||LAST_NAME||" => $this->input->post('last_name'),
                "||USER_EMAIL||" => $this->input->post('user_email'),
                "||SITE_TITLE||" => $data['global']['site_title']
            );
            $reserved_words = array_replace_recursive($macros_array, $reserved_arr);

            $template_title = 'registration-successful-to-admin';
            $lang_id = 17; // Default is 17(English)
            $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);
            $recipeinets = $data['global']['contact_email'];
            $from = array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title']));
            $subject = $arr_emailtemplate_data['subject'];
            $message = $arr_emailtemplate_data['content'];

            $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);

            if ($mail) {
                $this->session->set_userdata('register_success', "<strong>Congratulations!</strong> You have registered successfully. We have sent email to activate your account on <strong>" . $this->input->post('user_email') . "</strong>.");
                redirect(base_url() . "signin");
            }
        }

        $data['header'] = array("title" => "User Registration", "keywords" => "", "description" => "");

        $data['site_title'] = "Sign Up";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/registration/register');
        $this->load->view('front/includes/footer');
    }

    /*
     * Facebook registration process
     */

    public function fbUserRegistration() {
        if ($_REQUEST['user_email'] == 'undefined') {
            $this->session->set_userdata('login_error', "Login failed. Please try again.");
            echo "false";
            echo "undefined";
            exit;
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email', 'user_type', 'first_name', 'last_name', 'role_id');
            $condition_to_pass = array("user_email" => $_REQUEST['user_email']);
            $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if (count($arr_login_data) > 0) {

                if ($arr_login_data[0]['user_status'] == 2) {
                    $this->session->set_userdata('login_error', "Your account has been blocked by administrator.");
                    echo "false";
                } else {
                    $user_data['user_id'] = $arr_login_data[0]['user_id'];
                    $user_data['user_name'] = $arr_login_data[0]['user_name'];
                    $user_data['first_name'] = $arr_login_data[0]['first_name'];
                    $user_data['last_name'] = $arr_login_data[0]['last_name'];
                    $user_data['user_email'] = $arr_login_data[0]['user_email'];
                    $user_data['user_type'] = $arr_login_data[0]['user_type'];
                    $user_data['profile_picture'] = $arr_login_data[0]['profile_picture'];
                    $user_data['role_id'] = $arr_login_data[0]['role_id'];
                    $user_id = $arr_login_data[0]['user_id'];
                    $this->session->set_userdata('user_account', $user_data);
                    echo "true";
                }
            } else {
                $table = 'mst_users';
                $users1 = split("@", $this->input->post('user_email'));
                $username = $users1[0];
                $password = substr(md5(rand(0, 1000000)), 0, 10);
                $fields = array(
                    "user_name" => $username,
                    "user_email" => $this->input->post('user_email'),
                    "user_password" => base64_encode($password),
                    'user_status' => '1',
                    'email_verified' => '1',
                    'gender' => $_REQUEST['gender'],
                    'fb_id' => $this->input->post('fb_id'),
                    "register_date" => date('Y-m-d H:i:s'),
                    "activation_code" => $activation_code,
                    "ip_address" => $_SERVER['REMOTE_ADDR'],
                    "first_name" => $_REQUEST['first_name'],
                    "last_name" => $_REQUEST['last_name'],
                );
                $condition = '';
                $insert_id = $this->common_model->insertRow($fields, $table);
                $user_id = $insert_id;
                if ($insert_id) {
                    //email notification 
                    $data['global'] = $this->common_model->getGlobalSettings();
                    $macros_array_detail = array();
                    $macros_array_detail = $this->common_model->getRecords('mst_email_template_macros', 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                    $macros_array = array();
                    foreach ($macros_array_detail as $row) {
                        $macros_array[$row['macros']] = $row['value'];
                    }
                    $reserved_words = array();

                    $reserved_arr = array
                        (
                        "||USER_NAME||" => $_REQUEST['first_name'] . " " . $_REQUEST['last_name'],
                        "||PASSWORD||" => $password,
                        "||USER_EMAIL||" => $this->input->post('user_email'),
                        "||SITE_TITLE||" => $data['global']['site_title']
                    );
                    $reserved_words = array_replace_recursive($macros_array, $reserved_arr);

                    $template_title = 'facebook-registration-successful';
                    $lang_id = 17; // Default is 17(English)
                    $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);
                    $recipeinets = $this->input->post('user_email');
                    $from = array("email" => $data['global']['site_email'], "name" => stripslashes($data['global']['site_title']));
                    $subject = $arr_emailtemplate_data['subject'];
                    $message = $arr_emailtemplate_data['content'];

                    $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                    $image_url = "http://graph.facebook.com/" . $this->input->post('fb_id') . "/picture?type=large";
                    $img_array = get_headers($image_url);
                    $img_url = str_replace('Location: ', '', $img_array[1]);
                    $img = file_get_contents($img_url);

                    $file_name = time() . '.jpg';
                    $file = 'media/front/img/user-profile-pictures/' . $file_name;
                    file_put_contents($file, $img);
                    chmod($file, 0777);

                    $upload_dir = './media/front/img/user-profile-pictures';
                    $absolute_path = $this->common_model->absolutePath();
                    $image_path = $absolute_path . $upload_dir;
                    $image_main = $image_path . "/" . $file_name;
                    $thumbs_image1 = $image_path . "/large-thumbs/" . $file_name;
                    $thumbs_image3 = $image_path . "/thumb/" . $file_name;
                    $thumbs_image4 = $image_path . "/small-thumbs/" . $file_name;

                    $str_console = "convert " . $image_main . " -resize 206!X230! " . $thumbs_image1;
                    exec($str_console);

                    $str_console = "convert " . $image_main . " -resize 120!X120! " . $thumbs_image3;
                    exec($str_console);

                    $str_console = "convert " . $image_main . " -resize 50!X40! " . $thumbs_image4;
                    exec($str_console);

                    $profile_image = array("profile_picture" => $file_name);
                    //condition to update record	for the user status
                    $condition_array = array('user_id' => $insert_id);
                    $this->common_model->updateRow('mst_users', $profile_image, $condition_array);


                    $table_to_pass = 'mst_users';
                    $fields_to_pass = array('user_id', 'user_email', 'user_type', 'first_name', 'last_name', 'role_id');
                    $condition_to_pass = array("user_id" => $insert_id);
                    $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
                    $user_data['user_id'] = $arr_login_data[0]['user_id'];
                    $user_data['user_name'] = $arr_login_data[0]['user_name'];
                    $user_data['first_name'] = $arr_login_data[0]['first_name'];
                    $user_data['last_name'] = $arr_login_data[0]['last_name'];
                    $user_data['user_email'] = $arr_login_data[0]['user_email'];
                    $user_data['user_type'] = $arr_login_data[0]['user_type'];
                    $user_data['profile_picture'] = $arr_login_data[0]['profile_picture'];
                    $user_data['role_id'] = $arr_login_data[0]['role_id'];
                    $user_data['profile_picture'] = $file_name;
                    $this->session->set_userdata('user_account', $user_data);

                    echo 'true';
                } else {
                    echo 'false';
                }
            }
        }
    }

    /*
     * User's account activation by email
     */

    public function userActivation($activation_code) {
        $this->load->model('register_model');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status');
        $condition_to_pass = array("activation_code" => $activation_code);
        /* get user details to verify the email address */
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            if ($arr_login_data[0]['email_verified'] == 1) {
                $this->session->set_userdata('activation_error', "You have already activated your account. Please login.");
            } else {

                $user_detail = $this->common_model->getRecords("mst_users", "user_id", array("activation_code" => $activation_code));
                $this->load->model('admin_model');
                /* 	Removing the user if he is exists in inactiveated list */
                $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($user_detail[0]['user_id']));
                $table_name = 'mst_users';
                $update_data = array("user_status" => '1', 'email_verified' => '1');
                $condition_to_pass = array("activation_code" => $activation_code);
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $this->session->set_userdata('activation_error', "Your account has been activated successfully. Please login.");
            }
        } else {
            $this->session->set_userdata('activation_error', "Invalid activation link.");
        }
        redirect(base_url() . "signin");
    }

    /*
     * Check email duplication
     */

    public function chkEmailDuplicate() {
        $this->load->model('register_model');
        $user_email = $this->input->post('user_email');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email');
        $condition_to_pass = array("user_email" => $user_email);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /*
     * Check email availability 
     */

    public function chkEmailExist() {
        ob_clean();
        $this->load->model('register_model');
        $user_email = $this->input->post('user_email');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email');
        if ($this->input->post('action') != "") {
            $condition_to_pass = "`user_email` = '" . $user_email . "' or `user_name` = '" . $user_email . "'";
        } else {
            $condition_to_pass = array("user_email" => $user_email);
        }
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Chekck duplicate username
     */

    public function chkUserDuplicate() {
        $this->load->model('register_model');
        $user_name = $this->input->post('user_name');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_name');
        $condition_to_pass = array("user_name" => $user_name);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /*
     * create captcha image
     */

    public function generateCaptcha($rand) {
        ob_clean();
        $data = $this->common_model->commonFunction();
        $arr1 = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $arr2 = array();
        foreach ($arr1 as $val)
            $arr2[] = strtoupper($val);
        $arr3 = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $str = "";
        $arr_all_characters = array_merge($arr1, $arr2, $arr3);
        for ($i = 0; $i < 5; $i++) {
            $str.=$arr_all_characters[array_rand($arr_all_characters)] . "";
        }
        $this->session->set_userdata('security_answer', $str);
        putenv('GDFONTPATH=' . realpath('.'));
        //$font = '/var/www/ci-pipl-code-library/user-module/media/front/captcha/ariblk.ttf';
        $font = $data['absolute_path'] . 'media/front/captcha/ariblk.ttf';
        $IMGVER_IMAGE = imagecreatefromjpeg(base_url() . "media/front/captcha/bg1.jpg");
        $IMGVER_COLOR_WHITE = imagecolorallocate($IMGVER_IMAGE, 0, 0, 0);
        $text = $str;
        $IMGVER_COLOR_BLACK = imagecolorallocate($IMGVER_IMAGE, 255, 255, 255);
        imagefill($IMGVER_IMAGE, 0, 0, $IMGVER_COLOR_BLACK);
        imagettftext($IMGVER_IMAGE, 24, 0, 20, 28, $IMGVER_COLOR_WHITE, $font, $text);
        //header("Content-type: image/jpeg");
        imagejpeg($IMGVER_IMAGE);
    }

    /*
     * Check the captcha validation 
     */

    public function checkCaptcha() {
        if ($this->input->post('input_captcha_value') == $this->session->userdata('security_answer')) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Login into website
     */

    public function signin() {
        if ($this->common_model->isLoggedIn()) {
            redirect('profile');
        }
        $data = $this->common_model->commonFunction();

        if ($this->input->post('user_name') != '') {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status', 'user_password', 'role_id');
            $condition_to_pass = "user_name = '" . $this->input->post('user_name') . "' or user_email = '" . $this->input->post('user_name') . "'";
            $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if (count($arr_login_data)) {
                if ($arr_login_data[0]['user_password'] != base64_encode($this->input->post('user_password'))) {
                    $this->session->set_userdata('login_error', "Please enter correct password.");
                    redirect(base_url() . 'signin');
                } elseif ($arr_login_data[0]['email_verified'] == 1) {
                    if ($arr_login_data[0]['user_status'] == 2) {
                        $this->session->set_userdata('login_error', "Your account has been blocked by administrator.");
                        redirect(base_url() . 'signin');
                    } else {
                        $user_data['user_id'] = $arr_login_data[0]['user_id'];
                        $user_data['user_name'] = $arr_login_data[0]['user_name'];
                        $user_data['user_email'] = $arr_login_data[0]['user_email'];
                        $user_data['first_name'] = $arr_login_data[0]['first_name'];
                        $user_data['last_name'] = $arr_login_data[0]['last_name'];
                        $user_data['user_type'] = $arr_login_data[0]['user_type'];
                        $user_data['role_id'] = $arr_login_data[0]['role_id'];

                        $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_login_data[0]['role_id']));
                        /* serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges */
                        if (count($arr_privileges) > 0) {
                            foreach ($arr_privileges as $privilege) {
                                $user_privileges[] = $privilege['privilege_id'];
                            }
                        } else {
                            $user_privileges = array();
                        }
                        $user_data['user_privileges'] = serialize($user_privileges);
                        /*
                         * Set the user's session
                         */
                        $this->session->set_userdata('user_account', $user_data);
                        redirect(base_url() . 'profile');
                    }
                } else {
                    $this->session->set_userdata('login_error', "Please activate your account.");
                    redirect(base_url() . 'signin');
                }
            } else {
                $this->session->set_userdata('login_error', "Invalid email/username.");
                redirect(base_url() . 'signin');
            }
        }
        $data['header'] = array("title" => "User Login", "keywords" => "", "description" => "");
        $data['site_title'] = "Sign In";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/login/login');
        $this->load->view('front/includes/footer');
    }

    /*
     * Send the reset password link
     */

    public function passwordRecovery() {
        $data = $this->common_model->commonFunction();

        if ($this->input->post('user_email') != '') {
            /* get user information to send password detail */
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_password');
            $condition_to_pass = "`user_email` = '" . $this->input->post('user_email') . "' or `user_name` = '" . $this->input->post('user_email') . "'";

            $arr_password_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_password_data)) {
                $activation_code = time();
                $table_name = 'mst_users';
                $update_data = array('reset_password_code' => $activation_code);
                $condition_to_pass = array("user_email" => $arr_password_data[0]['user_email']);
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $reset_password_link = '<a href="' . base_url() . 'reset-password/' . base64_encode($activation_code) . '">Click here</a>';
                $lang_id = $this->session->userdata('lang_id');
                if (isset($lang_id) && $lang_id != '') {
                    $lang_id = $this->session->userdata('lang_id');
                } else {
                    $lang_id = 17; // Default is 17(English)
                }
                $reserved_words = array
                    (
                    "||USER_NAME||" => $arr_password_data[0]['user_name'],
                    "||FIRST_NAME||" => $arr_password_data[0]['first_name'],
                    "||LAST_NAME||" => $arr_password_data[0]['last_name'],
                    "||USER_EMAIL||" => $arr_password_data[0]['user_email'],
                    "||RESET_PASSWORD_LINK||" => $reset_password_link,
                    "||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url()
                );
                $template_title = 'forgot-password';
                $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved_words);
                $recipeinets = $arr_password_data[0]['user_email'];
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
                $subject = $arr_emailtemplate_data['subject'];
                $message = $arr_emailtemplate_data['content'];
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);

                if ($mail) {
                    $this->session->set_userdata('password_recover', "We have sent reset password link on your email <strong>" . $arr_password_data[0]['user_email'] . "</strong>.");
                    redirect(base_url() . 'signin');
                }
            }
        }
        $data['site_title'] = "Forgot Password";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/forgot-password/forgot-password');
        $this->load->view('front/includes/footer');
    }

    /*
     * Change new user's password
     */

    public function resetPassword($activation_code) {

        $data = $this->common_model->commonFunction();
        if ($activation_code != '') {
            $data['activation_code'] = $activation_code;
        }
        /* cheaking password link expirted or not using reset_password_code; */
        $user_detail = $this->common_model->getRecords("mst_users", "user_id", array("user_id" => $arr_resetcode[0], "reset_password_code" => base64_decode($data['activation_code'])));

        if (count($user_detail) == 0) {
            $this->session->set_userdata('invalid_password_link', "Your reset password link has been expired.");
            redirect(base_url() . 'password-recovery');
        }

        if ($this->input->post('user_password') != '') {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_password');
            $condition_to_pass = array("reset_password_code" => $this->input->post('activation_code'));
            $arr_password_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_password_data) > 0) {
                $table_name = 'mst_users';
                $update_data = array('user_password' => base64_encode($this->input->post('user_password')), "reset_password_code" => "");
                $condition_to_pass = array("reset_password_code" => $this->input->post('activation_code'));
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $this->session->set_userdata('invalid_password_link', "Your password has been reset successfully. Please login.");

                redirect(base_url() . 'signin');
            } else {
                $this->session->set_userdata('invalid_password_link', "Your reset password link has been expired.");
                redirect(base_url() . 'password-recovery');
            }
        }
        $data['header'] = array("title" => "Reset Your Password", "keywords" => "", "description" => "");
        $data['site_title'] = "Reset Password";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/forgot-password/new-password', $data);
        $this->load->view('front/includes/footer');
    }

    /* Random password generating for fb user */

    private function randamPass($num = 8) {
        $alpha_num = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_str = '';
        for ($i = 0; $i < $num; $i++) {
            $generated_str .= substr($alpha_num, mt_rand(0, strlen($alpha_num) - 1), 1);
        }
        return $generated_str;
    }

}

/* End of file register.php */
    /* Location: ./application/controllers/register.php */ 
