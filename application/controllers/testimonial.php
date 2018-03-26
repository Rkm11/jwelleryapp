<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $data = $this->common_model->commonFunction();
    }

    public function listTestimonial() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
            exit;
        }
        $this->load->model('testimonials_model');
        /* Getting Common data */
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
         if(in_array('8',$arr_login_admin_privileges)==FALSE)    
         {
              /*an admin which is not super admin not privileges to access Manage Role
               *setting session for displaying notiication message.*/
              $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
              redirect(base_url() . "backend/home");
              exit();
         }
        }
        if ($this->input->post() != '') {
            if (count($this->input->post('checkbox')) > 0) {
                /* getting all ids selected */
                $arr_tetstimonal_ids = $this->input->post('checkbox');
                if (count($arr_tetstimonal_ids) > 0) {
                    /* deleting the testimonial from the backend */
                    $this->common_model->deleteRows($arr_tetstimonal_ids, "mst_testimonial", "testimonial_id");
                    $this->session->set_userdata("msg", "<span class='success'>Testimonial deleted successfully!</span>");
                }
            }
        }
        $data['title'] = "Manage Testimonials";
        /* getting all testimonail with descending order */
        $data['arr_tetimonials'] = $this->testimonials_model->getTestimonials();

        $this->load->view('backend/testimonial/list', $data);
    }

    public function changeStatus() {
        if (count($this->input->post('testimonial_id')) > 0) {
            /* changing status of testimonial */
            $arr_to_update = array("status" => $this->input->post('status'));
            $this->common_model->updateRow('mst_testimonial', $arr_to_update, array('testimonial_id' => intval($this->input->post('testimonial_id'))));
            echo json_encode(array("error" => "0", "error_message" => ""));
        } else {
            /* if something going wrong providing error message */
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function addTestimonial($edit_id = '') {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
            exit;
        }
        /* Getting Common data */
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
         if(in_array('8',$arr_login_admin_privileges)==FALSE)    
         {
              /*an admin which is not super admin not privileges to access Manage Role
               *setting session for displaying notiication message.*/
              $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
              redirect(base_url() . "backend/home");
              exit();
         }
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="validationError">', '</p>');
        $this->form_validation->set_rules('inputTestimonial', 'testimonial', 'required');
        $this->form_validation->set_rules('inputName', 'name', 'required');
        $this->form_validation->set_rules('lang_id', 'language', 'required');
        if ($this->form_validation->run() == true && $this->input->post('inputTestimonial') != '') {
            if ($this->input->post('edit_id') != '') {
                $arr_to_update = array(
                    "lang_id" => $this->input->post('lang_id'),
                    "testimonial" => mysql_real_escape_string($this->input->post('inputTestimonial')),
                    "name" => mysql_real_escape_string($this->input->post('inputName')),
                    "updated_date" => date("Y-m-d H:i:s")
                );
                $this->common_model->updateRow('mst_testimonial', $arr_to_update, array('testimonial_id' => intval(base64_decode($this->input->post('edit_id')))));
                $this->session->set_userdata('msg', '<span class="success">Testimonial updated successfully!</span>');
            } else {
                $arr_to_insert = array(
                    "lang_id" => $this->input->post('lang_id'),
                    "added_by" => 'Admin',
                    "user_id" => $data['user_account']['user_id'],
                    "status" => 'Active', "testimonial" => mysql_real_escape_string($this->input->post('inputTestimonial')),
                    "name" => mysql_real_escape_string($this->input->post('inputName')),
                    "added_date" => date("Y-m-d H:i:s"), "updated_date" => date("Y-m-d H:i:s")
                );
                $this->common_model->insertRow($arr_to_insert, "mst_testimonial");
                $this->session->set_userdata('msg', '<span class="success">Testimonial added successfully!</span>');
            }
            redirect(base_url() . "backend/testimonial/list");
            exit;
        }

        /* getting all privileges  */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if (($edit_id != '')) {
            $data['title'] = "Update Testimonial";
            $data['edit_id'] = $edit_id;
            $data['arr_testimonial'] = $this->common_model->getRecords("mst_testimonial", "", array("testimonial_id" => intval(base64_decode($edit_id))));
            /* single row fix */
            $data['arr_testimonial'] = end($data['arr_testimonial']);
        } else {
            $data['title'] = "Add Testimonial";
            $data['edit_id'] = '';
        }
        $data['arr_get_language'] = $this->common_model->getLanguages();
        if (($this->input->post('edit_id') != '')) {
            redirect(base_url() . "backend/testimonial/add/" . $this->input->post('edit_id'));
        } else {
            $this->load->view('backend/testimonial/add', $data);
        }
    }

    public function addUserTestimonial() {
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "signin");
            exit;
        }
        $data['arr_user_data'] = array();
        $user_id = $data['user_account']['user_id'];

        if ($user_id != "") {
            $this->load->model("user_model");
            $arr_user_data = $this->common_model->getRecords('mst_users', 'user_id,first_name,last_name', array('user_id' => $user_id));
            $data['arr_user_data'] = $arr_user_data[0];
        }

        if ($this->input->post('inputTestimonial') != '') {

            $arr_to_insert = array(
                "added_by" => 'user',
                "user_id" => $user_id,
                "status" => 'inactive',
                "testimonial" => mysql_real_escape_string($this->input->post('inputTestimonial')),
                "name" => ($this->input->post('inputName')),
                "added_date" => date("Y-m-d H:i:s")
            );

            $this->common_model->insertRow($arr_to_insert, "mst_testimonial");

            $this->session->set_userdata('testimonial_success', 'Testimonial has been added successfully.');
            redirect(base_url() . 'testimonial');
            exit;
        }

        $data['site_title'] = 'Add testimonial';
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/testimonials/add-testimonial');
        $this->load->view('front/includes/footer', $data);
    }

    public function changeHomePageTestimonialStatus() {

        if ($this->input->post('testimonial_id') != "") {
            $arr_to_update = array(
                "is_featured" => '0'
            );
            $this->common_model->updateRow('mst_testimonial', $arr_to_update, $condition = '');
            $arr_to_updates = array(
                "is_featured" => $this->input->post('is_featured')
            );
            /* condition to update record for the featured status */
            $condition_array = array('testimonial_id' => intval($this->input->post('testimonial_id')));
            $this->common_model->updateRow('mst_testimonial', $arr_to_updates, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function viewTestimonial($pg = 0) {

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
         if(in_array('8',$arr_login_admin_privileges)==FALSE)    
         {
              /*an admin which is not super admin not privileges to access Manage Role
               *setting session for displaying notiication message.*/
              $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage user!</span>");
              redirect(base_url() . "backend/home");
              exit();
         }
        }
        /** Pagination start here  * */
        $data['arr_testimonials_one'] = $this->common_model->getTestimonial();
        $this->load->library('pagination');
        $data['count'] = count($data['arr_testimonials_one']);
        $config['base_url'] = base_url() . 'testimonial/';
        $config['total_rows'] = count($data['arr_testimonials_one']);
        $config['per_page'] = 10;
        $config['cur_page'] = $pg;
        $data['cur_page'] = $pg;
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $this->pagination->initialize($config);
        $data['create_links'] = $this->pagination->create_links();
        $data['arr_testimonials'] = $this->common_model->getTestimonial($config['per_page'], $pg);

        $data['page'] = $pg; //$pg is used to pass limit
        /** Pagination end here * */
        $data['site_title'] = "Testimonials";
        $this->load->view('front/includes/header', $data);
//        $this->load->view('front/revision2-at-multi-lang/includes/top-nav', $data);
        $this->load->view('front/testimonials/view-testimonial', $data);
        $this->load->view('front/includes/footer', $data);
    }

}
