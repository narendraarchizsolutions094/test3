<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell_model extends CI_Model {



	function __construct()
    {
        parent::__construct();
		
    }
	
	function getCategory(){
		
		return $this->db->select("*")->where("comp_id", $this->session->companey_id)->get("tbl_category")->result();
		
	}
	
	function subCategory(){
		
		$category =  $this->db->select("tbl_subcategory.*,tbl_category.id as categid,tbl_category.name as category")
									 ->where("tbl_category.comp_id", $this->session->companey_id)
									 ->from("tbl_subcategory")
									 ->join("tbl_category", "tbl_category.id=tbl_subcategory.cat_id", "LEFT")
									->get()->result();
		
		$newcateg  = array();
		
		if(!empty($category)){
			foreach($category as $ind => $categ){
					
				$newcateg[$categ->cat_id][] = $categ;		
			}
		}
		return $newcateg;
	}
	
}	