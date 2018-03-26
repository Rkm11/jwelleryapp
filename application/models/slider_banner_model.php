<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_Banner_Model extends CI_Model {
    /*
     * Function to get all slider banners
     * 
     */

    public function getAllSliders() {
        $this->db->select('*');
        $this->db->from('mst_sliders as slider ');
        $this->db->join('mst_languages as lang', 'lang.lang_id= slider.lang_id', 'inner');
        $this->db->order_by('slider_id', 'desc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
     *  getting all active languages details 
     */

    public function getAllActiveLanguages() {

        $this->db->select('*');
        $this->db->from('mst_languages');
        $this->db->where('status', 'A');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     *  getting all slider effects
     */

    public function getAllSliderEffects() {

        $this->db->select('*');
        $this->db->from('trans_slider_banner_effects');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     *  getting all slider widths and heights
     */

    public function getAllSliderWidthsHeights() {

        $this->db->select('*');
        $this->db->from('trans_slider_widths_heights');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     *  getting aslider banner objects
     */

    public function getAllSliderBanners($slider_id) {

        $this->db->select('*');
        $this->db->from('trans_slider_banner_objects');
        $this->db->where('slider_id_fk', $slider_id);
        $this->db->where('banner_object_status', $slider_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     *  getting all slider info by id
     */

    public function getSliderAllInfo($slider_id) {

        $this->db->select('*');
        $this->db->from('mst_sliders as slider');
        $this->db->join('trans_slider_banner_effects  as effect', 'effect.slider_banner_effects_id=slider.slider_effect_id_fk', 'inner');
        $this->db->join('trans_slider_widths_heights  as width_height', 'width_height.slider_widths_heights_id=slider.slider_width_height_fk', 'inner');
        $this->db->join('mst_languages as lang', 'lang.lang_id=slider.lang_id', 'inner');
        $this->db->where('slider.slider_id', $slider_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getSliderAllInfos($condition_to_pass) {
        $this->db->select('*');
        $this->db->from('mst_sliders as slider');
        $this->db->join('trans_slider_banner_effects  as effect', 'effect.slider_banner_effects_id=slider.slider_effect_id_fk', 'inner');
        $this->db->join('trans_slider_widths_heights  as width_height', 'width_height.slider_widths_heights_id=slider.slider_width_height_fk', 'inner');
        $this->db->join('trans_slider_banner_objects as slider_banner_object', 'slider.slider_id=slider_banner_object.slider_id_fk', 'inner');
        $this->db->join('mst_languages as lang', 'lang.lang_id=slider.lang_id', 'inner');
        $this->db->where($condition_to_pass);

        $result = $this->db->get();
        return $result->result_array();
    }

    /*
     *  getting all slider banner objects
     */

    public function getAllSliderBannersObjects($slider_id) {

        $this->db->select('*');
        $this->db->from('trans_slider_banner_objects');
        $this->db->where('slider_id_fk', $slider_id);
        $this->db->order_by('banner_object_id', 'desc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
     *  getting all slider banner objects info by object id
     */

    public function getSliderObjectAllInfoById($slider_object_id) {

        $this->db->select('*');
        $this->db->from('trans_slider_banner_objects as slider_banner_object');
        $this->db->join('mst_sliders as slider', 'slider.slider_id=slider_banner_object.slider_id_fk', 'inner');
        $this->db->join('trans_slider_widths_heights  as width_height', 'width_height.slider_widths_heights_id=slider.slider_width_height_fk', 'inner');
        $this->db->where('banner_object_id', $slider_object_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
     *  updating slider info
     */

    public function updateSliderAllInfo($data, $slider_id) {

        $this->db->where('slider_id', $slider_id);
        $this->db->update('mst_sliders', $data);
    }

    /*
     *  updating slider info all to inactive
     */

    public function updateSliderAllInfoToInactive($data, $slider_id) {

        $this->db->where('slider_id', $slider_id);
        $this->db->update('mst_sliders', $data);
    }

    /*
     *  updating slider info all to inactive
     */

    public function updateSliderBannerObjectInfo($data, $banner_object_id) {

        $this->db->where('banner_object_id', $banner_object_id);
        $this->db->update('trans_slider_banner_objects', $data);
    }

    /*
     *  adding slider info all to inactive
     */

    public function addSliderInfo($data) {

        $this->db->insert('mst_sliders', $data);
    }

    /*
     *  adding slider info all to inactive
     */

    public function deleteSliderBannerInfo($slider_id) {

        $this->db->where('slider_id', $slider_id);
        $this->db->delete('mst_sliders');
    }

    /*
     *  adding slider info all to inactive
     */

    public function deleteSliderBannerObjectInfo($slider_object_id) {

        $this->db->where('banner_object_id', $slider_object_id);
        $this->db->delete('trans_slider_banner_objects');
    }

    /*
     *  adding slider object info info all to inactive
     */

    public function addSliderBannerObjectInfo($data) {

        $this->db->insert('trans_slider_banner_objects', $data);
    }

    public function getOrderOfSlider() {
        $this->db->select_max('sorting_order');
        $this->db->from('trans_slider_banner_objects as slider ');
        $this->db->order_by('sorting_order', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

}
