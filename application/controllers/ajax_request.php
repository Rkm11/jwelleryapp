<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_Request extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ajax_request_model");
        $this->load->model("common_model");
        
    }

    //function to upload profile images for the edit user.

    public function getAllStateByCountryId() {
        if ($this->input->post('country_id') != '') {
            $condition = "country = '".$this->input->post('country_id')."'";
            $order_by = "state_name ASC";
            $state_array = $this->common_model->getRecords('mst_states','*', $condition, $order_by,$limit='',$debug = 0);
            $str = '';
            
            $str.='<select name="state" id="state" class="form-control input-lg" onchange="fn_citys(this.value)">';
            $str.='<option value="">'.lang('Choose_Current_State').'</option>';
            foreach ($state_array as $array_item) {
                $str.='<option value="' . $array_item['id'] . '" >' . $array_item['state_name'] . '</option>';
            }
            $str.='</select>';
            $str.=' <div class="error" for="state" generated="true" ></div>';
            echo $str;
            die;
        } else {
           
            $str = '';
         
            $str.='<select name="state" id="state" class="form-control input-lg">';
            $str.='<option value="">'.lang('Choose_Current_State').'</option>';
            $str.='</select>';
        $str.=' <div class="error" for="state" generated="true" ></div>';
            echo $str;
            die;
        }
    }
    public function getAllCityByStateId() {
        if ($this->input->post('state_id') != '') {
            $city_array = $this->ajax_request_model->getRecords('trans_cities','',array('state_id_fk'=>$this->input->post('state_id')));
            $str = '';
         
            $str.='<select class="form-control input-lg" name="city_name" id="city_name">';
            $str.='<option value="">'.lang('Choose_Current_City').'</option>';
            foreach ($city_array as $array_item) {
                $str.='<option value="' . $array_item['city_id'] . '" >' . $array_item['city_name'] . '</option>';
            }
            $str.='</select>';
          $str.=' <div class="error" for="city_name" generated="true" ></div>';
            echo $str;
            die;
        } else {
            $str = '';
          
            $str.='<select class="form-control input-lg" name="city_name" id="city_name">';
            $str.='<option value="">'.lang('Choose_Current_City').'</option>';
            $str.='</select>';
           $str.=' <div class="error" for="city_name" generated="true" ></div>';
            echo $str;
            die;
        }
    }

    public function getAllSelectStateByCountryId() {
        if ($this->input->post('country_id') != '') {
            $condition = "country = '".$this->input->post('country_id')."'";
            $order_by = "state_name ASC";
            $state_array = $this->common_model->getRecords('mst_states','*', $condition, $order_by,$limit='',$debug = 0);
            $str = '';

            $str.='<div class="frm_row"><select name="state" id="state" class="form-control input-lg" onchange="fn_citys(this.value)">';
//            $str.='<option value="">Select Current State</option>';
            foreach ($state_array as $array_item) {
                if ($array_item['id'] == $this->input->post('state')) {
                    $str.='<option value="' . $array_item['id'] . '" selected="selected">' . $array_item['state_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['id'] . '" >' . $array_item['state_name'] . '</option>';
                }
            }
            foreach ($state_array as $array_item) {
                
            }
            $str.='</select></div>';
            $str.=' <div class="error" for="state" generated="true" ></div>';
            echo $str;
            die;
        } else {
            $str = '';
       
            $str.='<div class="frm_row"><select name="state" id="state" class="form-control input-lg">';
            $str.='<option value="">'.lang('Choose_Current_State').'</option>';
            $str.='</select></div>';
            $str.=' <div class="error" for="state" generated="true" ></div>';
            echo $str;
            die;
        }
    }
    
    public function getAllSelectCityByStateId() {
        if ($this->input->post('state') != '') {
            $city_array = $this->ajax_request_model->getRecords('trans_cities','',array('state_id_fk'=> $this->input->post('state')));
            $str = '';
        
            $str.='<div class="frm_row"><select class="form-control input-lg" name="city_name" id="city_name">';
            $str.='<option value="">'.lang('Choose_Current_City').'</option>';
            foreach ($city_array as $array_item) {
                if ($array_item['city_id'] == $this->input->post('city_name')) {
                    $str.='<option value="' . $array_item['city_id'] . '" selected="selected">' . $array_item['city_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['city_id'] . '" >' . $array_item['city_name'] . '</option>';
                }
            }
            foreach ($city_array as $array_item) {
                
            }
            $str.='</select></div>';
           $str.=' <div class="error" for="city_name" generated="true" ></div>';
            echo $str;
            die;
        } else {
            $str = '';
           
            $str.='<div class="frm_row"><select class="form-control input-lg" name="city_name" id="city_name">';
            $str.='<option value="">'.lang('Choose_Current_City').'</option>';
            $str.='</select></div>';
            $str.=' <div class="error" for="city_name" generated="true" ></div>';
            echo $str;
            die;
        }
    }
    public function getAllStateByCountryIdAdmin() {
        if ($this->input->post('country_id') != '') {
            $condition = "country = '".$this->input->post('country_id')."'";
            $order_by = "state_name ASC";
            $state_array = $this->common_model->getRecords('mst_states','*', $condition, $order_by,$limit='',$debug = 0);
            $str = '';
         
            $str.='<select name="state" id="state" class="FETextInput control-group" onchange="fn_citys(this.value)">';
            $str.='<option value="">Choose Current State</option>';
            foreach ($state_array as $array_item) {
                $str.='<option value="' . $array_item['id'] . '" >' . $array_item['state_name'] . '</option>';
            }
            $str.='</select>';
            echo $str;
            die;
        } else {
           
            $str = '';
         
            $str.='<select name="state" id="state" class="FETextInput control-group">';
            $str.='<option value="">Choose Current State</option>';
            $str.='</select>';
            echo $str;
            die;
        }
    }
    public function getAllCityByStateIdAdmin() {
        if ($this->input->post('state_id') != '') {
            $city_array = $this->ajax_request_model->getRecords('trans_cities','',array('state_id_fk'=>$this->input->post('state_id')));
            $str = '';
         
            $str.='<select class="FETextInput control-group" name="city_name" id="city_name">';
            $str.='<option value="">Choose Current City</option>';
            foreach ($city_array as $array_item) {
                $str.='<option value="' . $array_item['city_id'] . '" >' . $array_item['city_name'] . '</option>';
            }
            $str.='</select>';
            echo $str;
            die;
        } else {
            $str = '';
          
            $str.='<select class="FETextInput control-group" name="city_name" id="city_name">';
            $str.='<option value="">Choose Current City</option>';
            $str.='</select>';
            echo $str;
            die;
        }
    }

    public function getAllSelectStateByCountryIdAdmin() {
        if ($this->input->post('country_id') != '') {
            $condition = "country = '".$this->input->post('country_id')."'";
            $order_by = "state_name ASC";
            $state_array = $this->common_model->getRecords('mst_states','*', $condition, $order_by,$limit='',$debug = 0);
            $str = '';
        
            $str.='<div class="frm_row"><select name="state" id="state" class="FETextInput control-group" onchange="fn_citys(this.value)">';
            foreach ($state_array as $array_item) {
                if ($array_item['id'] == $this->input->post('state')) {
                    $str.='<option value="' . $array_item['id'] . '" selected="selected">' . $array_item['state_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['id'] . '" >' . $array_item['state_name'] . '</option>';
                }
            }
            foreach ($state_array as $array_item) {
                
            }
            $str.='</select></div>';
            echo $str;
            die;
        } else {
            $str = '';
       
            $str.='<div class="frm_row"><select name="state" id="state" class="FETextInput control-group">';
            $str.='<option value="">Choose Current State</option>';
            $str.='</select></div>';
            echo $str;
            die;
        }
    }
    
    public function getAllSelectCityByStateIdAdmin() {
        if ($this->input->post('state') != '') {
            $city_array = $this->ajax_request_model->getRecords('trans_cities','',array('state_id_fk'=> $this->input->post('state')));
            $str = '';
        
            $str.='<div class="frm_row"><select class="FETextInput control-group" name="city_name" id="city_name">';
            $str.='<option value="">Choose Current City</option>';
            foreach ($city_array as $array_item) {
                if ($array_item['city_id'] == $this->input->post('city_name')) {
                    $str.='<option value="' . $array_item['city_id'] . '" selected="selected">' . $array_item['city_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['city_id'] . '" >' . $array_item['city_name'] . '</option>';
                }
            }
            foreach ($city_array as $array_item) {
                
            }
            $str.='</select></div>';
            echo $str;
            die;
        } else {
            $str = '';
           
            $str.='<div class="frm_row"><select class="FETextInput control-group" name="city_name" id="city_name">';
            $str.='<option value="">Choose Current City</option>';
            $str.='</select></div>';
            echo $str;
            die;
        }
    }
    public function getDefaultCountry() {
            $city_array = $this->ajax_request_model->getRecords('mst_countries');
            $str = '';
        
            $str.='<select name="country_name" id="country_name" class="form-control input-lg" onchange="fn_states(this.value)">  ';
            foreach ($city_array as $array_item) {
                if (strtoupper($array_item['country_name']) == "KUWAIT") {
                    $str.='<option value="' . $array_item['iso'] . '" selected="selected">' . $array_item['country_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['iso'] . '" >' . $array_item['country_name'] . '</option>';
                }
            }
            foreach ($city_array as $array_item) {
                
            }
            $str.='</select>';
            echo $str;
            die;
    }
    public function getDefaultCountryAdmin() {
            $city_array = $this->ajax_request_model->getRecords('mst_countries');
            $str = '';
        
            $str.='<select name="country_name" id="country_name" class="FETextInput control-group" onchange="fn_states(this.value)">';
            foreach ($city_array as $array_item) {
                if (strtoupper($array_item['country_name']) == "KUWAIT") {
                    $str.='<option value="' . $array_item['iso'] . '" selected="selected">' . $array_item['country_name'] . '</option>';
                }else{
                    $str.='<option value="' . $array_item['iso'] . '" >' . $array_item['country_name'] . '</option>';
                }
            }
            foreach ($city_array as $array_item) {
                
            }
            $str.='</select>';
            echo $str;
            die;
    }
    
  
}