<?php
   if (!defined('BASEPATH'))
    exit('No direct script access allowed');

   class Slider_Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('slider_banner_model');
    }

    /*
     * 
     * function to display all the sliders 
     */

    public function index() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        /*         * getting all sliders from slider table. ** */
        $data['arr_sliders'] = $this->slider_banner_model->getAllSliders();
        $data['title'] = "Manage Slider Banners";

        $this->load->view('backend/slider-banner/list-slider-banner', $data);
    }

    /*
     * function to display all the details of slider
     */

    public function sliderBannerMoreDetails($slider_id) {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        /** getting slider info by slider id. ** */
        $data['arr_slider_info'] = $this->slider_banner_model->getSliderAllInfo($slider_id);
        $data['title'] = "Slider Banner Details";
        $data['slider_id'] = $slider_id;
        $this->load->view('backend/slider-banner/slider-banner-details', $data);
    }

    /*
     * function to add new slider banner
     */

    public function addNewSliderBanner() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($this->input->post('slider_title') != '') {
            /*             * *creating array to add the fields  ** */
            $arr_to_add = array("slider_title" => mysql_real_escape_string($this->input->post('slider_title')), "slider_rotation_speed" => mysql_real_escape_string($this->input->post('slider_rotation_speed')), "pause_on_mouse_over" => mysql_real_escape_string($this->input->post('pause_on_mouse_over')), "enable_pause_button" => mysql_real_escape_string($this->input->post('enable_pause_button')), "enable_next_previous_button" => mysql_real_escape_string($this->input->post('enable_next_previous_button')), "control_nav" => mysql_real_escape_string($this->input->post('control_nav')), "slider_type" => mysql_real_escape_string($this->input->post('slider_type')), "enable_auto_slide" => mysql_real_escape_string($this->input->post('enable_auto_slide')), "lang_id" => mysql_real_escape_string($this->input->post('lang_id')), "show_description_text_over_image" => mysql_real_escape_string($this->input->post('show_description_text_over_image')), "image_over_description_position" => mysql_real_escape_string($this->input->post('image_over_description_position')), "slider_effect_id_fk" => mysql_real_escape_string($this->input->post('slider_effect_id_fk')), "slider_width_height_fk" => mysql_real_escape_string($this->input->post('slider_widths_heights_id')), "is_autoslide_loop" => mysql_real_escape_string($this->input->post('is_autoslide_loop')), "slider_direction" => mysql_real_escape_string($this->input->post('slider_direction')), "slider_animation_speed" => mysql_real_escape_string($this->input->post('slider_animation_speed')));
            $this->slider_banner_model->addSliderInfo($arr_to_add);
            $this->session->set_userdata('msg', 'Slider Banner info has been added successfully');
            redirect(base_url() . "backend/slider-banner/list-sliders-banners");
        }
        /*         * * getting all active languages ** */
        $data['languages'] = $this->slider_banner_model->getAllActiveLanguages();
        /*         * * getting all slider effects ** */
        $data['arr_effects'] = $this->slider_banner_model->getAllSliderEffects();
        /*         * * getting all slider widths and heights ** */
        $data['arr_slider_widths_heights'] = $this->slider_banner_model->getAllSliderWidthsHeights();
        $data['title'] = "Add New Slider Banner";
        $this->load->view('backend/slider-banner/add-slider-banner', $data);
    }

    /*
     * function to edit slider banner
     */

    public function editSliderBanner($slider_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($this->input->post('slider_title') != '') {
            /*             * *creating array to update the fields  ** */
            $arr_to_update = array("slider_title" => mysql_real_escape_string($this->input->post('slider_title')), "slider_rotation_speed" => mysql_real_escape_string($this->input->post('slider_rotation_speed')), "pause_on_mouse_over" => mysql_real_escape_string($this->input->post('pause_on_mouse_over')), "enable_pause_button" => mysql_real_escape_string($this->input->post('enable_pause_button')), "enable_next_previous_button" => mysql_real_escape_string($this->input->post('enable_next_previous_button')), "control_nav" => mysql_real_escape_string($this->input->post('control_nav')), "slider_type" => mysql_real_escape_string($this->input->post('slider_type')), "enable_auto_slide" => mysql_real_escape_string($this->input->post('enable_auto_slide')), "lang_id" => mysql_real_escape_string($this->input->post('lang_id')), "show_description_text_over_image" => mysql_real_escape_string($this->input->post('show_description_text_over_image')), "image_over_description_position" => mysql_real_escape_string($this->input->post('image_over_description_position')), "slider_effect_id_fk" => mysql_real_escape_string($this->input->post('slider_effect_id_fk')), "slider_width_height_fk" => mysql_real_escape_string($this->input->post('slider_widths_heights_id')), "is_autoslide_loop" => mysql_real_escape_string($this->input->post('is_autoslide_loop')), "slider_direction" => mysql_real_escape_string($this->input->post('slider_direction')), "slider_animation_speed" => mysql_real_escape_string($this->input->post('slider_animation_speed')));
            $slider_id_to_update = $this->input->post('slider_id');
            $this->slider_banner_model->updateSliderAllInfo($arr_to_update, $slider_id_to_update);
            $this->session->set_userdata('msg', 'Slider Banner info has been updated successfully');
            redirect(base_url() . "backend/slider-banner/list-sliders-banners");
        }
        /**         * getting all active languages ** */
        $data['languages'] = $this->slider_banner_model->getAllActiveLanguages();
        /*         * * getting all slider effects ** */
        $data['arr_effects'] = $this->slider_banner_model->getAllSliderEffects();
        /*         * * getting all slider widths and heights ** */
        $data['arr_slider_widths_heights'] = $this->slider_banner_model->getAllSliderWidthsHeights();

        $data['arr_slider_info'] = $this->slider_banner_model->getSliderAllInfo($slider_id);
        $data['title'] = "Edit Slider Banner Info";
        $data['slider_id'] = $slider_id;
        $this->load->view('backend/slider-banner/edit-slider-banner', $data);
    }

    /*
     * function to update slider status
     */

    public function updateSliderStatus() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $slider_id = $this->input->post('slider_id');
        $status = $this->input->post('status');
        $lang_id = $this->input->post('lang_id');
        $data['slide_banner_object_info'] = $this->slider_banner_model->getAllSliderBanners($slider_id);
        if (count($data['slide_banner_object_info']) >= 2 || $status == 'Inactive') {
            $arr_to_update_first = array("slider_status" => 'Inactive');
            $this->slider_banner_model->updateSliderAllInfoToInactive($arr_to_update_first, $slider_id);

            $arr_to_update_main = array("slider_status" => $status);
            $this->slider_banner_model->updateSliderAllInfo($arr_to_update_main, $slider_id);
            $this->session->set_userdata('msg', 'Slider Banner status has been updated successfully');
            echo "true";
        } else {
            echo "false";
        }
    }

    /*
     * function to update slider status
     */

    public function updateSliderBannerObjectStatus() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $banner_object_id = $this->input->post('banner_object_id');
        $status = $this->input->post('status');
        $arr_to_update = array("banner_object_status" => $status);
        $this->slider_banner_model->updateSliderBannerObjectInfo($arr_to_update, $banner_object_id);
        $this->session->set_userdata('msg', 'Slider banner object status has been updated successfully');
        echo "true";
        exit;
    }

    /*
     * function to delete slider banner
     */

    public function deleteSlidersBanners() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $arr_slider_ids = $this->input->post('checkbox');
        for ($i = 0; $i < count($arr_slider_ids); $i++) {
            $slider_id = $arr_slider_ids[$i];
            /*             * ** deleting the slider banner by id ***** */
            $this->slider_banner_model->deleteSliderBannerInfo($slider_id);
            /*             * ** deleting the slider banner by id end***** */
        }
        $this->session->set_userdata('msg', 'Slider Banner info has been deleted successfully');
        redirect(base_url() . "backend/slider-banner/list-sliders-banners");
    }

    /*
     * function to delete slider banner objects
     */

    public function deleteSlidersBannersObjects() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $arr_slider_object_ids = $this->input->post('checkbox');

        for ($i = 0; $i < count($arr_slider_object_ids); $i++) {
            $slider_object_id = $arr_slider_object_ids[$i];
            /*             * ** deleting the slider banner object by id ***** */
            $this->slider_banner_model->deleteSliderBannerObjectInfo($slider_object_id);
            /*             * ** deleting the slider banner object by id end***** */
        }
        $slider_id = $this->input->post('slider_id');
        $this->session->set_userdata('msg', 'Slider Banner Object(s) info has been deleted successfully');
        redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $slider_id);
        exit;
    }

    /*
     * function to display all the sliders objects
     */

    public function sliderBannerObject($slider_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        /** getting all sliders from slider table. ** */
        $data['arr_slider_banners_objects'] = $this->slider_banner_model->getAllSliderBannersObjects($slider_id);
        $data['title'] = "Manage Slider Banners Objects";
        $data['slider_id'] = $slider_id;
        $this->load->view('backend/slider-banner/list-slider-banner-objects', $data);
    }

    /*
     * function to display add slider banner object
     */

    public function addsliderBannerObject($slider_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($this->input->post('banner_object_title') != '') {
            $max_order_number = $this->slider_banner_model->getOrderOfSlider();
            $max = $max_order_number[0]['sorting_order'] + 1;
            $arr_to_add = array("sorting_order" => $max, "banner_object_title" => mysql_real_escape_string($this->input->post('banner_object_title')), "banner_object_url" => mysql_real_escape_string($this->input->post('banner_object_url')), "open_url_in_new_page" => mysql_real_escape_string($this->input->post('open_url_in_new_page')), "banner_object_start_date" => mysql_real_escape_string($this->input->post('banner_object_start_date')), "banner_object_end_date" => mysql_real_escape_string($this->input->post('banner_object_end_date')), "banner_object_alt_text" => mysql_real_escape_string($this->input->post('banner_object_alt_text')), "banner_object_rel_value" => mysql_real_escape_string($this->input->post('banner_object_rel_value')), "banner_object_description_text" => mysql_real_escape_string($this->input->post('banner_object_description_text')), "enable_border" => mysql_real_escape_string($this->input->post('enable_border')), "banner_object_click_count" => mysql_real_escape_string($this->input->post('banner_object_click_count')), "banner_object_size" => mysql_real_escape_string($this->input->post('banner_object_size')), "banner_object_type" => mysql_real_escape_string($this->input->post('banner_object_type')), "youtube_path" => mysql_real_escape_string($this->input->post('youtube_path')), "video_type" => mysql_real_escape_string($this->input->post('video_type')), "slider_id_fk" => mysql_real_escape_string($this->input->post('slider_id')));
            $slider_width = ($this->input->post('slider_width') / 2);
            $slider_height = ($this->input->post('slider_height') / 2);
            $slider_thumb_width = $slider_width;
            $slider_thumb_height = $slider_height;
            /*
             * Uploading images if get attached
             */

            if ($_FILES['banner_object_image']['name'] != '') {

                //config initialise for uploading image 
                $config['upload_path'] = './media/front/slider-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '100000000000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                //loading uploda library
                if (!$this->upload->do_upload('banner_object_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die;
                    $this->session->set_userdata('msg', 'There is a problem in uploading. Please check and try again.');
                    redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    for ($i = 0; $i < 3; $i++) {
                        if ($i == 0) {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/thumbs', 'maintain_ration' => true, 'width' => $slider_thumb_width, 'height' => $slider_thumb_height);
                        } else if ($i == 1) {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/thumbs-admin', 'maintain_ration' => true, 'width' => 300, 'height' => 150);
                        } else {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/slider-small-thumbs', 'maintain_ration' => true, 'width' => 70, 'height' => 50);
                        }
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            if ($_FILES['banner_object_image']['name'] != '') {

                $image_data = $this->upload->data();
                $arr_to_add['banner_object_image'] = $image_data['file_name'];
            }
            /*
             * Uploading the video here 
             */

            $image_data1 = array();
            if ($_FILES['banner_object_video']['name'] != '') {

                //config initialise for uploading image 
                $config['upload_path'] = './media/front/slider-videos';
                $config['allowed_types'] = '*';
                $config['max_size'] = '9000000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();

                //loading uploda library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner_object_video')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('msg', 'There is a problem in uploading. Please check and try again.');
                    redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data1 = $this->upload->data();
                }
            }
            if ($_FILES['banner_object_video']['name'] != '') {
                $image_data = $this->upload->data();
                $arr_to_add['banner_object_video'] = $image_data1['file_name'];
            }

            /*
             * Adding a slider banner object
             */
            $this->slider_banner_model->addSliderBannerObjectInfo($arr_to_add);
            $this->session->set_userdata('msg', 'Slider Banner object has been added successfully');
            redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
        }
        /*         * getting all sliders from slider table. ** */
        $data['title'] = "Add Slider Banners Object";
        $data['slider_id'] = $slider_id;
        $data['arr_slider_info'] = $this->slider_banner_model->getSliderAllInfo($slider_id);
        $this->load->view('backend/slider-banner/add-slider-banner-object', $data);
    }

    public function editSliderBannerObject($slider_object_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        if ($this->input->post('banner_object_title') != '') {

            $arr_to_update = array("banner_object_title" => mysql_real_escape_string($this->input->post('banner_object_title')), "banner_object_url" => mysql_real_escape_string($this->input->post('banner_object_url')), "open_url_in_new_page" => mysql_real_escape_string($this->input->post('open_url_in_new_page')), "banner_object_start_date" => mysql_real_escape_string($this->input->post('banner_object_start_date')), "banner_object_end_date" => mysql_real_escape_string($this->input->post('banner_object_end_date')), "banner_object_alt_text" => mysql_real_escape_string($this->input->post('banner_object_alt_text')), "banner_object_rel_value" => mysql_real_escape_string($this->input->post('banner_object_rel_value')), "banner_object_description_text" => mysql_real_escape_string($this->input->post('banner_object_description_text')), "enable_border" => mysql_real_escape_string($this->input->post('enable_border')), "banner_object_click_count" => mysql_real_escape_string($this->input->post('banner_object_click_count')), "banner_object_size" => mysql_real_escape_string($this->input->post('banner_object_size')), "sorting_order" => mysql_real_escape_string($this->input->post('sorting_order')), "banner_object_type" => mysql_real_escape_string($this->input->post('banner_object_type')), "youtube_path" => mysql_real_escape_string($this->input->post('youtube_path')), "video_type" => mysql_real_escape_string($this->input->post('video_type')), "slider_id_fk" => mysql_real_escape_string($this->input->post('slider_id')));
            $slider_width = ($this->input->post('slider_width') / 2);
            $slider_height = ($this->input->post('slider_height') / 2);
            $slider_thumb_width = $slider_width;
            $slider_thumb_height = $slider_height;
            /*
             * Uploading images if get attached
             */

            if ($_FILES['banner_object_image']['name'] != '') {
                //config initialise for uploading image 
                $config['upload_path'] = './media/front/slider-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();

                //loading uploda library
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('banner_object_image')) {
                    $error = array('error' => $this->upload->display_errors());

                    //$this->slider_banner_model->addSliderBannerObjectInfo($arr_to_add);
                    $this->session->set_userdata('msg', 'There is a problem in uploading. Please check and try again.');
                    redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    for ($i = 0; $i < 3; $i++) {
                        if ($i == 0) {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/thumbs', 'maintain_ration' => true, 'width' => $slider_thumb_width, 'height' => $slider_thumb_height);
                        } else if ($i == 1) {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/thumbs-admin', 'maintain_ration' => true, 'width' => 300, 'height' => 150);
                        } else {
                            $config = array('source_image' => $image_data['full_path'], 'new_image' => 'media/front/slider-images/slider-small-thumbs', 'maintain_ration' => true, 'width' => 70, 'height' => 50);
                        }
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            if ($_FILES['banner_object_image']['name'] != '') {
                $image_data = $this->upload->data();
                $arr_to_update['banner_object_image'] = $image_data['file_name'];
            }

            $image_data1 = array();
            if ($_FILES['banner_object_video']['name'] != '') {

                //config initialise for uploading image 
                $config['upload_path'] = './media/front/slider-videos';
                $config['allowed_types'] = '*';
                $config['max_size'] = '9000000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '12024';
                $config['file_name'] = rand();

                //loading uploda library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner_object_video')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('msg', 'There is a problem in uploading. Please check and try again.');
                    redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data1 = $this->upload->data();
                }
            }
            if ($_FILES['banner_object_video']['name'] != '') {
                $image_data = $this->upload->data();
                $arr_to_update['banner_object_video'] = $image_data1['file_name'];
            }

            /*
             * Adding a slider banner object
             */
            $slider_id = $this->input->post('slider_id');
            $slider_object_id_to_update = $this->input->post('banner_object_id');
            $this->slider_banner_model->updateSliderBannerObjectInfo($arr_to_update, $slider_object_id_to_update);
            $this->session->set_userdata('msg', 'Slider Banner object info has been updated successfully');
            redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $this->input->post('slider_id'));
        }
        $data['title'] = "Edit Slider Banners Object";
        $data['slider_object_id'] = $slider_object_id;
        $data['arr_slider_banner_object_info'] = $this->slider_banner_model->getSliderObjectAllInfoById($slider_object_id);
        $this->load->view('backend/slider-banner/edit-slider-banner-object', $data);
    }

    /*
     * duplicating a slider banner object 
     */

    public function duplicateSliderBannerObject($slider_object_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $data['arr_slider_banner_object_info'] = $this->slider_banner_model->getSliderObjectAllInfoById($slider_object_id);
        $arr_to_add = array("banner_object_title" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_title']), "banner_object_url" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_url']), "open_url_in_new_page" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['open_url_in_new_page']), "banner_object_start_date" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_start_date']), "banner_object_end_date" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_end_date']), "banner_object_alt_text" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_alt_text']), "banner_object_rel_value" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_rel_value']), "banner_object_description_text" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_description_text']), "enable_border" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['enable_border']), "banner_object_click_count" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_click_count']), "banner_object_size" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_size']), "banner_object_type" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_type']), "youtube_path" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['youtube_path']), "video_type" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['video_type']), "slider_id_fk" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['slider_id']), "banner_object_video" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_video']), "banner_object_image" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_image']), "banner_object_status" => mysql_real_escape_string($data['arr_slider_banner_object_info'][0]['banner_object_status']));
        $this->slider_banner_model->addSliderBannerObjectInfo($arr_to_add);
        $this->session->set_userdata('msg', 'Slider Banner object info has been duplicated successfully');
        redirect(base_url() . "backend/slider-banner/list-sliders-banner-objects/" . $data['arr_slider_banner_object_info'][0]['slider_id']);
    }

    /*
     * displaying all details for slider banner object 
     */

    public function sliderBannerObjectMoreDetails($slider_object_id = '') {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the slider banner model ** */
        $arr_privileges = array();
        /*         * getting all privileges ** */
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
            if (in_array('16', $arr_login_admin_privileges) == FALSE) {
                /* an admin which is not super admin not privileges to access Manage Role
                 * setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
                redirect(base_url() . "backend/home");
                exit();
            }
        }
        $data['title'] = "Slider Banners Object Details";
        $data['slider_object_id'] = $slider_object_id;
        $data['arr_slider_banner_object_info'] = $this->slider_banner_model->getSliderObjectAllInfoById($slider_object_id);
        $this->load->view('backend/slider-banner/slider-banner-object-details', $data);
    }

}
