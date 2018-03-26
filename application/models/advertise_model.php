<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advertise_Model extends CI_Model { 
    
    function getAdvertiseList(){
        
        $sql=  "SELECT A.*,lang.lang_name, (SELECT count(B.id) FROM ".$this->db->dbprefix."trans_advertise_counter as B WHERE B.type='I' AND B.advertise_id=A.advertise_id) impression_cnt,(SELECT count(C.id) FROM ".$this->db->dbprefix."trans_advertise_counter as C WHERE C.type='C' AND C.advertise_id=A.advertise_id) click_cnt FROM ".$this->db->dbprefix."mst_advertises as A inner join ".$this->db->dbprefix."mst_languages lang on lang.lang_id=A.language_id  order by A.advertise_id desc";
        
        $query=$this->db->query($sql);
        
        return $query->result_array();
        
    }
    
        public function getAllAdvertisePagePosition($page_name = '', $position_name = '') {
           
        $sql = 'SELECT A.* FROM ' .$this->db->dbprefix . 'mst_advertises as A INNER JOIN ' .$this->db->dbprefix. 'trans_advertise_page_position as B ON A.advertise_id=B.advertise_id INNER JOIN ' .$this->db->dbprefix . 'mst_advertise_pages as C ON B.page_id=C.page_id INNER JOIN ' . $this->db->dbprefix. 'mst_advertise_position as D ON B.position_id=D.position_id WHERE C.page_name="' . $page_name . '" AND D.position_name="' . $position_name . '" AND A.status="Active"';

        $sql .=' and (A.expired_start_date <= "' . date('Y-m-d H:i:s') . '" and A.expired_end_date >= "' . date('Y-m-d H:i:s') . '")';
       
        $query=$this->db->query($sql);

        return $query->result_array();
    }

}