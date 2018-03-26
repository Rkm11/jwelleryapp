<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Model extends CI_Model {

    // common function for absolute path
    public function absolutePath($path = '') {

        $abs_path = str_replace('system/', $path, BASEPATH);
        //Add a trailing slash if it doesn't exist.
        $abs_path = preg_replace("#([^/])/*$#", "\\1/", $abs_path);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'absolutePath',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $abs_path;
    }

    public function getAllCategories($condition_to_pass) {
        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('trans_category_details') . " cd ";
        $fields.="where cd.category_id_fk = c.parent_id limit 1),'-') as parent_category,cd.category_name,cd.category_description,c.category_id as category_detail_id,cd.category_id_fk";
        $this->db->select($fields, FALSE);
        $this->db->from('trans_category_details as cd');
        $this->db->join('mst_category as c','c.category_id=cd.category_id_fk','inner');
        if ($condition_to_pass != '') {
            $this->db->where($condition_to_pass);
        }
        $this->db->order_by('category_detail_id DESC');
        $query = $this->db->get();
        // $query = $this->db->get_where('mst_category', $arr);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'get_all_category',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }
    public function getAllCategoriesC($condition_to_pass) {
        $this->db->select('cd.category_id_fk,cd.category_name,cd.category_img');
        $this->db->from('trans_category_details as cd');
        $this->db->join('mst_category as c','c.category_id=cd.category_id_fk','inner');
        if ($condition_to_pass != '') {
            $this->db->where($condition_to_pass);
        }
        $this->db->order_by('category_detail_id DESC');
        $query = $this->db->get();
        // $query = $this->db->get_where('mst_category', $arr);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'get_all_category',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }
    public function getAllCategoriesForSelect($condition_to_pass) {

        $fields = "cd.category_name,c.category_id";
        $this->db->select($fields);
        $this->db->from('trans_category_details as cd');
        $this->db->join('mst_category as c','c.category_id=cd.category_id_fk','inner');
        if ($condition_to_pass != '') {
            $this->db->where($condition_to_pass);
        }
        $this->db->order_by('category_detail_id DESC');
        $query = $this->db->get();
        // $query = $this->db->get_where('mst_category', $arr);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'get_all_category',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }

    public function getCategoryInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0) {
        $this->db->select('*');
        $this->db->from('trans_category_details');

        if ($condition_to_pass != '') {
            $this->db->where($condition_to_pass);
        }
        $query = $this->db->get();
        // $query = $this->db->get_where('mst_category', $arr);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'getCategoryInformation',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }

    public function getAllLanguages() {

        $this->db->select('*');
        $this->db->from('mst_languages');
        $this->db->where('lang_id <>', '17');
        $this->db->where('status', 'A');

        $query = $this->db->get();
        // $query = $this->db->get_where('mst_category', $arr);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'getAllLanguages',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }

    public function insertCategoryId($arr_fields) {

        $this->db->insert("mst_category", $arr_fields);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'insertCategoryId',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $this->db->insert_id();
    }

    public function getAllCategoryInfoById($category_detail_id,$lang_id) {
        $arr = array("category_detail_id" => $category_detail_id);
        $this->db->select('cd.category_id_fk as category_detail_id,cd.category_img,c.category_id as category_id,cd.category_name,cd.category_description,parent_id');
        $this->db->from('trans_category_details as cd');
        $this->db->join('mst_category as c','cd.category_id_fk=c.category_id','left');
        $query = $this->db->where('c.category_id',$category_detail_id);
        $query = $this->db->where('cd.lang_id',$lang_id);
        $query = $this->db->get();
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'get_all_category_by',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $query->result_array();
    }
    
    public function update_category($update_data,$lang_id, $category_detail_id) {

        $this->db->where("category_id_fk", $category_detail_id);
        $this->db->where("lang_id", $lang_id);
        $this->db->update("trans_category_details", $update_data);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'update_category',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
    }
 public function updateParentCategory($update_data, $category_detail_id) {

        $this->db->where("category_id", $category_detail_id);
        $this->db->update("mst_category", $update_data);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'update_category',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
    }
    public function insertCategory($arr_fields) {

        $this->db->insert("trans_category_details", $arr_fields);
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'insertCategory',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $this->db->insert_id();
    }
    public function deleteCategory($category_id) {

        $this->db->where('category_id',$category_id);
        $this->db->delete("mst_category");
        /*         * * this is to print error message ** */
        $error = $this->db->_error_message();

        /*         * * this is to print number ** */
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'category_model',
                'method_name' => 'insertCategory',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'error-redirect');
        }
        return $this->db->insert_id();
    }

}
