<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rule_model extends CI_Model {
	
	public function get_rule($id){
		$this->db->where('id',$id);
		$this->db->where('comp_id',$this->session->companey_id);
		return $this->db->get('leadrules')->row_array();
	}

}
