<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model {

	public function save_payment_response($data){
		$this->db->insert('payment_history',$data);
		return $this->db->insert_id();
	}
} 
