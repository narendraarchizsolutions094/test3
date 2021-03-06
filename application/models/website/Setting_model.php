<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "ws_setting";

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)           ->where('comp_id',$this->session->userdata('companey_id'))
			->limit(1)
			->get()
			->row();
	} 
	
  	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
}
