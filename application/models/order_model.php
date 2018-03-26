<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_Model extends CI_Model {

//    public function getOrdersByProduct($user_id, $offset = '', $limit = '') {
//        $this->db->select('to1.*,mo.order_uniq_id,mo.buyer_id,mo.shipping_id,mo.coupon_applied,mo.order_status,mo.total_qty,mo.total_amount,mo.order_date,mo.dispatch_date,mo.delivery_date,mp.product_sku,mu1.first_name as seller_first_name,mu1.last_name as seller_last_name,mu2.first_name as buyer_first_name,mu2.last_name as buyer_last_name');
//        $this->db->from('trans_product_order as to1');
//        $this->db->join('mst_order as mo', 'mo.order_id=to1.order_id', 'left');
//        $this->db->join('mst_users as mu1', 'mu1.user_id=to1.seller_id', 'left');
//        $this->db->join('mst_users as mu2', 'mu2.user_id=mo.buyer_id', 'left');
//        $this->db->join('mst_product as mp', 'mp.product_id=to1.product_id', 'left');
//        $this->db->where('to1.seller_id', $user_id);
//        if ($offset != '' || $limit != '') {
//            $this->db->limit($offset, $limit);
//        }
//        $this->db->order_by('product_order_id desc');
//        $query = $this->db->get();
//        return $query->result_array();
//    }

    public function getOrdersByBuyer($user_id, $offset = '', $limit = '') {
        $this->db->select('to1.*,mo.order_uniq_id,mo.buyer_id,mo.shipping_id,mo.coupon_applied,mo.order_status,mo.total_qty,mo.total_amount,mo.order_date,mo.dispatch_date,mo.delivery_date,mp.product_sku,mu1.first_name as seller_first_name,mu1.last_name as seller_last_name,mu2.first_name as buyer_first_name,mu2.last_name as buyer_last_name');
        $this->db->from('trans_product_order as to1');
        $this->db->join('mst_order as mo', 'mo.order_id=to1.order_id', 'left');
        $this->db->join('mst_users as mu1', 'mu1.user_id=to1.seller_id', 'left');
        $this->db->join('mst_users as mu2', 'mu2.user_id=mo.buyer_id', 'left');
        $this->db->join('mst_product as mp', 'mp.product_id=to1.product_id', 'left');
        $this->db->where('mo.buyer_id', $user_id);
        if ($offset != '' || $limit != '') {
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_order_id desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOrdersProductDetails($product_order_id, $offset = '', $limit = '') {
        $this->db->select('to1.*,mo.order_uniq_id,mo.buyer_id,mo.shipping_id,mo.coupon_applied,mo.order_status,mo.total_qty,mo.total_amount,mo.order_date,mo.dispatch_date,mo.delivery_date,mp.product_sku,mu1.first_name as seller_first_name,mu1.last_name as seller_last_name,mu1.user_email as seller_email,mu2.first_name as buyer_first_name,mu2.last_name as buyer_last_name,mu2.user_email as buyer_email,ms.folder_name');
        $this->db->from('trans_product_order as to1');
        $this->db->join('mst_order as mo', 'mo.order_id=to1.order_id', 'left');
        $this->db->join('mst_users as mu1', 'mu1.user_id=to1.seller_id', 'left');
        $this->db->join('mst_users as mu2', 'mu2.user_id=mo.buyer_id', 'left');
        $this->db->join('mst_product as mp', 'mp.product_id=to1.product_id', 'left');
        $this->db->join('mst_storefront as ms', 'mp.storefront_fk_id=ms.store_id', 'left');
        $this->db->where('to1.product_order_id', $product_order_id);
        if ($offset != '' || $limit != '') {
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_order_id desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOrdersByProduct($user_id) {
        $this->db->select('mp.*,tpo.*,th.*,ms.store_id,ms.store_name,store_name,mc1.category_name,mc2.category_name as sub_category_name');
        $this->db->from('mst_order as mp');
        $this->db->join('trans_product_order as tpo', 'tpo.order_id=mp.order_uniq_id', 'left');
        $this->db->join('mst_store as ms', 'tpo.store_id=ms.store_id', 'left');
        $this->db->join('trans_category_details as mc1', 'mc1.category_detail_id=tpo.category_id', 'left');
        $this->db->join('trans_category_details as mc2', 'mc2.category_detail_id=tpo.sub_category_id', 'left');
        $this->db->join('mst_transc_history as th', 'th.order_id_fk=mp.order_uniq_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllOrdersByStatus($status) {
        $this->db->select('to1.*,mo.order_uniq_id,mo.buyer_id,mo.shipping_id,mo.coupon_applied,mo.order_status,mo.total_qty,mo.total_amount,mo.order_date,mo.dispatch_date,mo.delivery_date,mp.product_sku,mu1.first_name as seller_first_name,mu1.last_name as seller_last_name,mu2.first_name as buyer_first_name,mu2.last_name as buyer_last_name');
        $this->db->from('trans_product_order as to1');
        $this->db->join('mst_order as mo', 'mo.order_id=to1.order_id', 'left');
        $this->db->join('mst_users as mu1', 'mu1.user_id=to1.seller_id', 'left');
        $this->db->join('mst_users as mu2', 'mu2.user_id=mo.buyer_id', 'left');
        $this->db->join('mst_product as mp', 'mp.product_id=to1.product_id', 'left');
        if ($status != '') {
            $this->db->where('mo.ship_mode', strtolower($status));
        }
        if ($offset != '' || $limit != '') {
            $this->db->limit($offset, $limit);
        }
        $this->db->order_by('product_order_id desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllOrdersCancelReturn($status = '', $cancel_return_id = '') {
        $this->db->select('tcr.*,to1.*,mo.order_uniq_id,mo.buyer_id,mo.shipping_id,mo.coupon_applied,mo.order_status,mo.total_qty,mo.total_amount,mo.order_date,mo.dispatch_date,mo.delivery_date,mp.product_sku,mu1.first_name as seller_first_name,mu1.last_name as seller_last_name,mu1.user_email as seller_email,mu2.first_name as buyer_first_name,mu2.last_name as buyer_last_name,mu2.user_email as buyer_email,ms.folder_name');
        $this->db->from('trans_product_cancel_return as tcr');
        $this->db->join('trans_product_order as to1', 'tcr.product_ordet_id_fk=to1.product_order_id', 'left');
        $this->db->join('mst_order as mo', 'mo.order_id=to1.order_id', 'left');
        $this->db->join('mst_users as mu1', 'mu1.user_id=to1.seller_id', 'left');
        $this->db->join('mst_users as mu2', 'mu2.user_id=mo.buyer_id', 'left');
        $this->db->join('mst_product as mp', 'mp.product_id=to1.product_id', 'left');
        $this->db->join('mst_storefront as ms', 'mp.storefront_fk_id=ms.store_id', 'left');
        if ($status != '') {
            if ($status == 5) {
                $this->db->where('to1.product_order_status', '5');
            } else if ($status == 6) {
                $this->db->where('to1.product_order_status', '6');
            }
        }
        if ($cancel_return_id != '') {
            $this->db->where('tcr.cancel_return_id', $cancel_return_id);
        }
        $this->db->order_by('to1.product_order_id desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    #function to get user list from the database
}

?>