<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//error_reporting(E_ALL);
class Notification_model extends CI_Model {


    public function getAllNotification($userId) {
        
        $this->db->select('*');
        $this->db->from('mst_notifications as n');
        $this->db->join('users as u', 'u.user_id=n.from', 'left');
        $this->db->where('n.to', $userId);
        $this->db->group_by('n.date');
        $this->db->order_by('n.id', 'desc');
        $query = $this->db->get();
     /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'getAllNotification',   
                    'controller_name'=> $controller,
                'controller_method_name'=>$method
                    
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        return $query->result_array();
    }
    
    public function deleteNotification($notificationId) {
       
        $this->db->where('notification_id', $notificationId);
        $this->db->delete('mst_notifications');
    /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'deleteNotification',
             'controller_name'=> $controller,
                'controller_method_name'=>$method
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        
    }

    public function getNotificationDetails($notificationId) {
        
        $this->db->select('*');
        $this->db->from('mst_notifications as n');
        $this->db->join('mst_users as u', 'u.user_id = n.notification_id','left');
        $this->db->where('n.notification_id', $notificationId);
        $query = $this->db->get();
    /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'getNotificationDetails',
                    'controller_name'=> $controller,
                'controller_method_name'=>$method
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        return $query->result_array();
    }

    public function getAllNotificationByPost($userId,$user_type, $limit = 0, $offset = 0) {
        
        $this->db->select('u.user_name,u.user_id,u.first_name,u.last_name,n.contact_id,n.notification_to,n.subject,n.message,n.read_status,n.user_type,n.notification_date,n.notification_id');
        $this->db->from('mst_notifications as n');
        $this->db->join('mst_users as u', 'u.user_id = n.notification_to','left');
        $this->db->where('n.notification_to', $userId);
//        $this->db->where('n.user_type', $user_type);
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        $this->db->group_by('n.notification_id');
        $this->db->order_by('n.notification_date','desc');
        $query = $this->db->get();
    /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'getAllNotificationByPost',
                    'controller_name'=> $controller,
                'controller_method_name'=>$method
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        return $query->result_array();
    }

    public function updatedNotificationStatus($notification_id){
        
        $arrData = array('read_status' => '1');
        $this->db->where('notification_id', $notification_id);
        $query = $this->db->update('mst_notifications', $arrData);
     /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'updatedNotificationStatus',
                    'controller_name'=> $controller,
                'controller_method_name'=>$method
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        return $query;  
    } 


    public function getAllNotificationDetails($userID, $user_type){
        
        $this->db->select('n.notification_to,n.subject,n.message,n.read_status,n.user_type,n.notification_date,n.notification_id');
        $this->db->from('mst_notifications as n');
        $this->db->where('notification_to', $userID);
        $this->db->where('user_type', $user_type);
        $this->db->where('read_status','0');
        $query = $this->db->get();
    /*** this is to print error message ***/
             $error=$this->db->_error_message(); 

            /*** this is to print number ***/
           $error_number=$this->db->_error_number(); 
            if($error)
            {
                $controller = $this->router->fetch_class();
              $method = $this->router->fetch_method();
                $error_details=array(
                'error_name'=>$error,
                'error_number'=>$error_number,
                'model_name'=>'notification_model',
                'method_name'=>'getAllNotificationDetails',
                    'controller_name'=> $controller,
                'controller_method_name'=>$method
                    );
              $this->common_model->errorSendEmail($error_details);
                redirect(base_url().'error-redirect');
            }
        return $query->result_array();
    }
}
?>
