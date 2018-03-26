<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_Model extends CI_Model {  

	/*
         * Function to get all slider banner which is set by actve by an admin by language id
         */
	public function getSliderForFrontPage($lang_id='17')
	{	
		$this->db->select('*');
		$this->db->from('mst_sliders as slider');
		$this->db->join('mst_languages as lang','lang.lang_id= slider.lang_id','inner');
		$this->db->join('trans_slider_banner_effects  as effect','effect.slider_banner_effects_id=slider.slider_effect_id_fk','inner');
		$this->db->where('slider.slider_status','Active');
		$this->db->where('slider.lang_id',$lang_id);
                $result = $this->db->get();
		return $result->result_array();
	}	
	/*
         * Function to get all slider banner onject by slider id
         */
	public function getAllSliderBannerObjects($date,$slider_id)
	{	
		$this->db->select('*');
		$this->db->from('trans_slider_banner_objects as slider_banner');
		$this->db->join('mst_sliders as slider','slider.slider_id=slider_banner.slider_id_fk','inner');
		$this->db->join('trans_slider_widths_heights  as width_height','width_height.slider_widths_heights_id=slider.slider_width_height_fk','inner');
		$this->db->where('slider_id_fk',$slider_id);
		$this->db->where("(str_to_date(banner_object_start_date,'%Y-%m-%d')<='".$date."' and str_to_date(banner_object_end_date,'%Y-%m-%d')>='".$date."')");
                $result = $this->db->get();
		return $result->result_array();
	}	
}
