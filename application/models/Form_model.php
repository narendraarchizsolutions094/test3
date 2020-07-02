<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model {    

    public function get_tabs_list($comp_id,$process_id=0) {
        $this->db->select('forms.*');
    	$where = " FIND_IN_SET($comp_id,forms.comp_id) > 0";
    	if ($process_id) {
    		$this->db->join('form_process','form_process.form_id=forms.id','left');
    		$where .= " AND FIND_IN_SET($process_id,form_process.process_id) > 0 AND form_process.comp_id=$comp_id";

    	}
    	$this->db->where($where);
    	return $this->db->get('forms')->result_array();
	}
	public function get_input_types(){
		return $this->db->get('input_types')->result_array();
	}
    public function get_all_tabs(){        
        return $this->db->get('forms')->result_array();        
    }
}