<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    private $table = "tbl_product";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }
    
    public function updateRow($data = []) {

        return $this->db->where('product_id', $data['product_id'])
                        ->update($this->table, $data);
    }
    
    public function readRow($product_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('product_id', $product_id)
                        ->get()
                        ->row();
    }

    public function productlist() {
        return $this->db->select("*")
                        ->from($this->table)
                        ->get()
                        ->result();
    }
    
    public function all_block($city_id) {
        return $this->db->select('*')->from('tbl_school')->where('city_id', $city_id)->get()->result();
    }
    
    public function findRows($product_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('product_id', $product_id)
                        ->get()
                        ->result();
    }
    
    public function school_list_by_id($sIdArr){
        return $this->db->select('sch.*,sch.product_id,sch.school_name,sch.address,sch.contact_name,sch.contact_number,sch.dise_code,sch.created_date,sch.updated_date,tbl_block.block,city.city,state.state')
                        ->from('tbl_school as sch')                        
                        ->join('state', 'state.id = sch.state_id')
                        ->join('city', 'city.id = sch.city_id')
                        ->join('tbl_block', 'tbl_block.block_id = sch.block_id')
                        ->where_in('product_id',$sIdArr)
                        ->order_by('dise_code', "asc")
                        ->get()
                        ->result();
    } 
    
    public function school_contact_list_by_id($product_id){        
        return $this->db->select("*")
                        ->from("tbl_school_contact")
                        ->where('product_id',$product_id)
                        ->order_by('product_id', "desc")
                        ->get()
                        ->result();
        
    }
}
