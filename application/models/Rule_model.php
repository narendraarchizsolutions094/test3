<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rule_model extends CI_Model {
	
	public function get_rule($id){
		$this->db->where('id',$id);
		$this->db->where('comp_id',$this->session->companey_id);
		return $this->db->get('leadrules')->row_array();
	}

    public function get_rules(){        
        $this->db->where('comp_id',$this->session->companey_id);
        $this->db->where('status',1);
        return $this->db->get('leadrules')->result_array();
    }

	public function execute_rule($id,$enquiry_code=0){
		$this->load->model('rule_model');
		$rule_data    =   $this->rule_model->get_rule($id);        
        $affected = 0;
        if (!empty($rule_data)) {
            if (!empty($rule_data['rule_sql']) && $rule_data['status'] == 1) {
                if ($rule_data['type'] == 1) {
                    $this->db->where('('.$rule_data['rule_sql'].')');                    
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$this->session->companey_id);                
                    $this->db->set('score',$rule_data['rule_action']);
                    $this->db->update('enquiry');                    
                    $affected = $this->db->affected_rows();
                }else if ($rule_data['type'] == 2) {
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$this->session->companey_id);                
                    $this->db->set('aasign_to',$rule_data['rule_action']);
                    $this->db->update('enquiry');
                    $affected = $this->db->affected_rows();                    
                }
            }
        }
        return $affected;
	}
    public function execute_rules($enquiry_code){ // for multiple rule execution
        $results    =   $this->get_rules();
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $this->execute_rule($value['id'],$enquiry_code);                
            }
        }
    }
}
