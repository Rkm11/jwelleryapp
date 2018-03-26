<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("user_model");
    }

    /*
     * Get user's profile information
     */

    public function profile() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');

        $arr_user_data = array();
        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['site_title'] = "Profile";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/user-profile', $data);
        $this->load->view('front/includes/footer');
    }

    /*
     * Edit user profile information 
     */

    function editProfile() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');

        $user_id = $data['user_session']['user_id'];
        $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
        $arr_user_detail = end($arr_user_detail);
        $data = $this->common_model->commonFunction();

        if ($this->input->post('user_email') != '') {
            $table_name = 'mst_users';
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $user_email = $this->input->post('user_email');
            $user_name = $this->input->post('user_name');

            $gender = $this->input->post('gender');

            $user_password = base64_decode($arr_user_detail['user_password']);
            if ($this->input->post('user_email') == $this->input->post('user_email_old')) {
                $email_verified = '1';
                $activation_code = $arr_user_detail['activation_code'];
                $user_session = $this->session->userdata('user_account');
                $user_session['user_name'] = $user_name;
                $user_session['user_email'] = $user_email;
                $user_session['first_name'] = $first_name;
                $user_session['last_name'] = $last_name;
                $this->session->set_userdata('user_account', $user_session);
            } else {
                $email_verified = '0';
                $activation_code = time();
            }

            $update_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'user_email' => $user_email,
                'user_name' => $user_name,
                'gender' => $gender,
                'email_verified' => $email_verified,
                'activation_code' => $activation_code
            );
            $condition = array("user_id" => $user_id);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if ($this->input->post('user_email') == $this->input->post('user_email_old')) {

                $this->session->set_userdata('edit_profile_success', "Your profile has been updated successfully.");
                redirect(base_url() . 'profile');
            } else {

                /*
                 * sending account verification link mail to user 
                 */
                $lang_id = 17;
                $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Activate Account</a>';
                $reserved_words = array
                    ("||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url(),
                    "||USER_NAME||" => $this->input->post('user_name'),
                    "||ADMIN_NAME||" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $user_password,
                    "||ADMIN_ACTIVATION_LINK||" => $activation_link
                );
                /*
                 * getting mail subect and mail message using email template title and lang_id and reserved works 
                 */
                $email_content = $this->common_model->getEmailTemplateInfo('admin-email-updated', 17, $reserved_words);
                /*
                 * sending the mail to deleting user 
                 */
                /*
                 * 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body 
                 */

                $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);

                if ($mail) {
                    $this->session->set_userdata('edit_profile_success_with_email', "Your account is deactivated now due to changed email address. Please check your email and activate account from <strong>" . $user_email . "</strong>");
                    $this->session->unset_userdata('user_account');
                    redirect(base_url());
                } else {
                    $this->session->set_userdata('edit_profile_success', "Your profile has been updated successfully.");
                    redirect(base_url() . 'profile');
                }
            }
        }
        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $condition_to_pass = array("user_id" => $user_id);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['site_title'] = "Edit Profile";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/edit-user-profile', $data);
        $this->load->view('front/includes/footer');
    }

    /*
     * Check user email for dupliation 
     */

    public function chkEditEmailDuplicate() {

        if ($this->input->post('user_email') == $this->input->post('user_email_old')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $this->input->post('user_email'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Check username for dupliation 
     */

    public function chkEditUsernameDuplicate() {

        if ($this->input->post('user_name') == $this->input->post('user_name_old')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_name');
            $condition_to_pass = array("user_email" => $this->input->post('user_name'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Change user's account setting
     */

    public function accountSetting() {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');

        if ($this->input->post('new_user_password') != '') {
            $table_name = 'mst_users';
            $update_data = array('user_password' => base64_encode($this->input->post('new_user_password')));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $this->common_model->updateRow($table_name, $update_data, $condition);
            $this->session->set_userdata('edit_profile_success', "Your account setting has been updated successfully.");
            redirect(base_url() . 'profile');
        }

        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['site_title'] = "Account Setting";
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/account-setting', $data);
        $this->load->view('front/includes/footer');
    }

    /*
     * Check user password for edit
     */

    public function editUserPasswordChk() {

        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_password');
        $condition_to_pass = array("user_password" => base64_encode($this->input->post('old_user_password')));
        $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Edit user's profile image
     */

    public function changeProfilePicture() {
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];

        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['upload_path'] = './media/front/img/user-profile-pictures/';
        $config['max_size'] = 1024 * 3;
        $config['file_name'] = rand();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($_FILES['uploadprofile']['name'] != '') {

            if (!$this->upload->do_upload('uploadprofile')) {
                $error = $this->upload->display_errors();
                $this->session->set_userdata('image_error', $error);
            } else {
                $thumb_file = explode('.', $this->input->post('old_logo'));
                $absolute_path = $this->common_model->absolutePath();
                $data = $this->upload->data();
                $logo_name = $data['file_name'];

                /* create thumbnail start here */
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './media/front/img/user-profile-pictures/' . $data['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;
                $config['new_image'] = './media/front/img/user-profile-pictures/thumb/' . $data['file_name'];

                /* create thumbnail start here */
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = './media/front/img/user-profile-pictures/' . $data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;

                $config['new_image'] = './media/front/img/user-profile-pictures/thumb/' . $data['file_name'];

                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    $error = $this->image_lib->display_errors();
                    $this->session->set_userdata('image_error', $error);
                }

                $profile_image = array("profile_picture" => $data['file_name']);

                #condition to update record	for the user status
                $condition_array = array('user_id' => $user_id);
                $this->common_model->updateRow('mst_users', $profile_image, $condition_array);
            }
        }

        $profile_image = array("profile_picture" => $data['file_name']);
        #condition to update record	for the user status
        $condition_array = array('user_id' => $user_id);
        $this->common_model->updateRow('mst_users', $profile_image, $condition_array);
    }

    /*
     * Destroy the user session
     */

    function logout() {
        $this->session->unset_userdata('user_account');
        redirect(base_url());
    }

    public function comments() {
        $data = $this->common_model->commonFunction();
        $this->db->select('mc.*,mu.user_name,mu.profile_picture');
        $this->db->from('mst_comments as mc');
        $this->db->join('mst_users as mu', 'mu.user_id=mc.commented_by', 'left');
        $query = $this->db->get();
        $data['arr_comments']=$query->result_array();
//        echo "<pre>";print_r($data['arr_comments']);die;
        $data['arr_comments'] = $this->common_model->getRecords("mst_comments", "");
        $this->load->view('backend/comment/comments', $data);
    }
    
    public function postComment(){
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'on');
        $data = $this->common_model->commonFunction();
        $comment=  $this->input->post('comment');
        $article_id=  $this->input->post('article_id');
        $user_id=  $this->input->post('user_id');
        $commnet_pic=  $this->input->post('commnet_pic');
        $arr_to_insert=array(
            'comment'=>$comment,
            'commented_by'=>$user_id,
            'article_id'=>$article_id,
            'comment_date'=>date('Y-m-d H:i:s'),
            'attachement'=>$commnet_pic,
            
        );
//        echo "<pre>";print_r($arr_to_insert);die;
        
        $id=$this->common_model->insertRow($arr_to_insert, 'mst_comments');
        $this->db->select('mc.*,mu.user_name,mu.profile_picture');
        $this->db->from('mst_comments as mc');
        $this->db->join('mst_users as mu', 'mu.user_id=mc.commented_by', 'left');
        $query = $this->db->get();
        $data['arr_comments']=$query->result_array();        
                    foreach($data['arr_comments'] as $com) { ?>
                    <div class="media">
                            <div class="media-left">
                                <a data-placement="left" title="Visit Page" href="<?php echo base_url(); ?>" class="more">
                                                    <?php $def_profile_img='avtar.png' ?>
                                    <div class="post-ari-img"><img onerror="src='<?php echo base_url(); ?>media/front/img/user-profile-pictures/<?php echo $def_profile_img;?> ?>'" alt="profile" src="<?php echo base_url(); ?>media/front/img/user-profile-pictures/<?php echo $com['profile_picture'] ?>"></div>
                                </a>
                            </div>
                            <div class="media-body">
                                <a data-placement="left" title="Visit Page" href="" class="more">
                                    <h4 class="media-heading"><?php echo $com['user_name']; ?> - <span class="sl-italic"><?php echo $com['comment_date']; ?></span> 
                                        <span class="pull-right"></span></h4>
                                </a>
                                <p><?php echo $com['comment'] ?></p>
                                <div class="replies-count">
                                    <a onclick="postReply('1')" class="show-reply-box" href="javascript:void(0);">Reply</a>
                                    <a href="javascript:void(0);"><i onclick="replies('1')" aria-hidden="true" class="fa fa-comment"></i>
                                    0									</a>
                                </div>
                                
                                   <div style="display: none;" id="rep_d1">
                                </div>
                                                            </div>
                        </div>
                     <?php } 

    }

}

?>
