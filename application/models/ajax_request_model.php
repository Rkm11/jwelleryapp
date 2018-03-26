<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_Request_Model extends CI_Model {
  
    
     public function getRecords($table_to_pass, $fields_to_pass="", $condition_to_pass="", $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0) {

        $this->db->select($fields_to_pass, FALSE);
        $this->db->from($table_to_pass);
        if ($condition_to_pass != '')
            $this->db->where($condition_to_pass);


        if ($order_by_to_pass != '')
            $this->db->order_by($order_by_to_pass);


        if ($limit_to_pass != '')
            $this->db->limit($limit_to_pass);

        $query = $this->db->get();

        if ($debug_to_pass)
            echo $this->db->last_query();
        
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'ajax_request_model',
                'model_method_name' => 'getRecords',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        
        return $query->result_array();
    }
   
    
}
?>
