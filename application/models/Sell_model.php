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
	
}	