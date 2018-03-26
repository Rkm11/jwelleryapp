<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('home_model');	
    }


	public function index()
	{
            /*
             * Here you can add the code to load header, slider banner  and footer pages.
             */
            /**loading the home model ***/
            $lang_id=17;/***17 for english ***/
            if($this->session->userdata('language_id')!='')
            {
                $lang_id=$this->session->userdata('language_id');
            }
            
            /*
             * Getting active slider by lang id
             */
            $data['arr_sliders']=$this->home_model->getSliderForFrontPage($lang_id);
            /*
            * Getting all object of active slider.
            */ 
            $slider_id=isset($data['arr_sliders'][0]['slider_id'])?$data['arr_sliders'][0]['slider_id']:'';
            if($slider_id!='')
            {
                $date=date('Y-m-d');
              $data['arr_slider_banner_objects']=$this->home_model->getAllSliderBannerObjects($date,$slider_id);
            }
			
	    $data['header'] = array("title"=>"Home","keywords"=>"","description"=>"");
            $data['site_title']="Home";
            $this->load->view('front/includes/header',$data);
            $this->load->view('front/includes/slider-banner', $data);
            $this->load->view('front/home',$data);
            $this->load->view('front/includes/footer');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */