<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Captcha extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
    }
    
    public function simpleCaptcha($activation_code) {
        $data = $this->common_model->commonFunction();
        $this->load->view('front/includes/header');
        $this->load->view('front/simple-captcha', $data);
        $this->load->view('front/includes/footer');
    }

}

/* End of file register.php */
    /* Location: ./application/controllers/register.php */ 