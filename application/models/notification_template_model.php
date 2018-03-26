<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_Template_Model extends CI_Model {
    /*
     * Function to get all notification templates from notification template table 
     * 
     */

    public function getNotificationTemplateDetails() {
        $this->db->select('notification.*,lang.lang_name');
        $this->db->from('mst_notification_templates as notification');
        $this->db->join('mst_languages as lang', 'lang.lang_id= notification.lang_id', 'inner');
        $result = $this->db->get();

        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        return $result->result_array();
    }

    /*
     *  function to get  notification templates from notification template table by using id 
     */

    public function getNotificationTemplateDetailsById($notification_template_id = '') {
        $this->db->select('notification.*,lang.lang_name');
        $this->db->from('mst_notification_templates as notification');
        $this->db->join('mst_languages as lang', 'lang.lang_id= notification.lang_id', 'inner');
        $this->db->where('notification.notification_template_id', $notification_template_id);
        $result = $this->db->get();
        
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        return $result->result_array();
    }

    /*
     * function to update  notification templates  by using id 
     */

    public function updateNotificationTemplateDetailsById($notification_template_id = '', $data) {
        $this->db->where('notification_template_id', $notification_template_id);
        $this->db->update('mst_notification_templates as notification', $data);
        
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
    }

}
