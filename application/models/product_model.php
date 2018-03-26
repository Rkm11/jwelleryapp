<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  Class will do all necessary action for blog functionalities
 */

class Product_Model extends CI_Model {
    function getAllProducts($status = '',$product_id) {
        $this->db->select('p.*,s.store_name,s.store_description,s.store_image,mc1.category_name');
        $this->db->from('mst_products as p');
//        $this->db->join('mst_users as u', 'u.user_id=p.seller_id', 'left');
        $this->db->join('mst_store as s', 's.store_id=p.store_id_fk', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_id_fk=p.category_id', 'left');
        if ($status != '') {
            $this->db->where("(p.product_status!='" . $status . "')");
        }
        if ($product_id != '') {
            $this->db->where("(p.product_id!='" . $product_id . "')");
        }
        $this->db->order_by('p.product_id', 'desc');
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getAllFeatureProducts() {
        $this->db->select('p.*,s.store_name,s.store_description,s.store_image,mc1.category_name,mc2.category_name as sub_category_name', FALSE);
        $this->db->from('mst_products as p');
//        $this->db->join('mst_users as u', 'u.user_id=p.seller_id', 'left');
        $this->db->join('mst_store as s', 's.store_id=p.store_id_fk', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_id_fk=p.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=p.sub_category_id', 'left');
            $this->db->where("p.product_status",1);
        $this->db->order_by('p.product_id', 'desc');
        $this->db->group_by('p.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getProductDetail($product_id) {
        $this->db->select('p.*,c.category_name,tc.category_name as sub_cat_name,s.store_name', FALSE);
        $this->db->from('mst_products as p');
        $this->db->join('mst_store as s', 's.store_id=p.store_id_fk', 'left');
        $this->db->join('trans_category_details as c', 'p.category_id=c.category_id_fk');
        $this->db->join('trans_category_details as tc', 'p.sub_category_id=tc.category_id_fk');
        $this->db->where('p.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getProuctDetilsById($product_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mp.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }
//    public function getProuctDetilsById($product_id) {
//        $this->db->select('mp.*,mc1.category_name');
//        $this->db->from('mst_products as mp');
////        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
//        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
////        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
//        $this->db->where('mp.product_id', $product_id);
//        $query = $this->db->get();
//        return $query->result_array();
//    }
    public function getProuctDetilsCon($conditions) {
        $this->db->select('mp.*,mc1.category_name');
        $this->db->from('mst_products as mp');
//        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
//        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where($conditions);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCartProudctDetilsByUserId($user_id) {
        $this->db->select('mp.estimated_arival_days,mp.shipping_charges,mp.orignal_amount,mp.discount,mp.verified,mp.product_name,mp.product_description,mc.cart_product_id,mc.quantity as cart_quantity ,mc.color as cart_color,mc.size as cart_size,mp.product_id,mc.added_date cart_added_date,mc.updated_date cart_updated_date,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('mst_cart as mc', 'mc.product_id_fk=mp.product_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mc.user_id_fk', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCartProudctDetilsByUserIdPid($user_id,$product_id) {
        $this->db->select('mp.*,mc.cart_product_id,mc.quantity as cart_quantity,mc.added_date cart_added_date,mc.updated_date cart_updated_date,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('mst_cart as mc', 'mc.product_id_fk=mp.product_id', 'inner');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mc.user_id_fk', $user_id);
        $this->db->where('mc.product_id_fk', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProuctDetilsByMainCat($cat_id,$color,$size,$sub_cat_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mp.category_id', $cat_id);
        if($color!=""){
            $this->db->like('mp.product_color', $color);
        }
        if($size!=""){
         $this->db->like('mp.size', $size);
        }
        if($sub_cat_id!=""){
            $this->db->where_in('mp.sub_category_id', $sub_cat_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProuctDetilsBySubCat($cat_id,$color,$size,$sub_cat_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mp.sub_category_id', $cat_id);
         if($color!=""){
            $this->db->like('mp.product_color', $color);
        }
        if($size!=""){
         $this->db->like('mp.size', $size);
        }
        if($sub_cat_id!=""){
            $this->db->where_in('mp.sub_category_id', $sub_cat_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProuctDetilsByOrderId($order_id) {
        $this->db->select('mp.*,ms.store_id,tpo.*,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_order as mp');
        $this->db->join('trans_product_order as tpo', 'tpo.order_id=mp.order_id', 'left');
        $this->db->join('mst_store as ms', 'tpo.store_id=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=tpo.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=tpo.sub_category_id', 'left');
        $this->db->where('mp.order_id', "$order_id");
         if($color!=""){
            $this->db->like('mp.product_color', $color);
        }
        if($size!=""){
         $this->db->like('mp.size', $size);
        }
        if($sub_cat_id!=""){
            $this->db->where_in('mp.sub_category_id', $sub_cat_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProuctSearched($search,$color,$size,$sub_cat_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where("mp.product_name LIKE '%$search%'");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getRelatedProducts($product_id,$sub_category_id,$color,$size,$sub_cat_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $this->db->where('mp.product_id !=',$product_id);
        $this->db->where('mp.sub_category_id ',$sub_category_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProuctDetils() {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOrdersByProduct() {
        $this->db->select('mp.order_id as Order_id,mp.order_status,mp.total_qty,mp.total_amount,mp.order_uniq_id,mp.dispatched_date,mp.order_date,mp.delivered_date,tpo.*,th.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_order as mp');
        $this->db->join('trans_product_order as tpo', 'tpo.order_id=mp.order_id', 'left');
        $this->db->join('mst_store as ms', 'tpo.store_id=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=tpo.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=tpo.sub_category_id', 'left');
        $this->db->join('mst_transc_history as th', 'th.order_id_fk=mp.order_uniq_id', 'left');
        $this->db->group_by('mp.order_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOrdersByOrderId($order_id) {
        $this->db->select('mp.*,tpo.*,th.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_order as mp');
        $this->db->join('trans_product_order as tpo', 'tpo.order_id=mp.order_id', 'left');
        $this->db->join('mst_store as ms', 'tpo.store_id=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=tpo.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=tpo.sub_category_id', 'left');
        $this->db->join('mst_transc_history as th', 'th.order_id_fk=mp.order_uniq_id', 'left');
        $this->db->where('mp.order_id',$order_id);
//        $this->db->group_by('mp.order_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOrderDetailByProduct($product_order_id) {
        $this->db->select('mp.*,tpo.*,th.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_order as mp');
        $this->db->join('trans_product_order as tpo', 'tpo.order_id=mp.order_id', 'left');
        $this->db->join('mst_store as ms', 'tpo.store_id=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=tpo.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=tpo.sub_category_id', 'left');
        $this->db->join('mst_transc_history as th', 'th.order_id_fk=mp.order_uniq_id', 'left');
        $this->db->where('tpo.p_order_id',$product_order_id);
//        $this->db->group_by('mp.order_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllOfferedProuctDetils($color,$size,$sub_cat_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
         if($color!=""){
            $this->db->like('mp.product_color', $color);
        }
        if($size!=""){
         $this->db->like('mp.size', $size);
        }
        if($sub_cat_id!=""){
            $this->db->where_in('mp.sub_category_id', $sub_cat_id);
        }
        $this->db->order_by('mp.discount','Desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllRecProducts($product_id) {
        $this->db->select('mp.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_products as mp');
        $this->db->join('mst_store as ms', 'mp.store_id_fk=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=mp.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=mp.sub_category_id', 'left');
         if($product_id!=""){
            $this->db->like('mp.product_id', $product_id);
        }
//        $this->db->order_by('mp.discount','Desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
