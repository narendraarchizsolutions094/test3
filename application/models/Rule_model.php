<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rule_model extends CI_Model {
	
	public function get_rule($id){
		$this->db->where('id',$id);
		$this->db->where('comp_id',$this->session->companey_id);
		return $this->db->get('leadrules')->row_array(); 
	}

    public function get_rules($type=array()){        
        $this->db->where('comp_id',$this->session->companey_id);
        $this->db->where('status',1);
        if (!empty($type)) {
            $this->db->where_in('type',$type);
        }
        return $this->db->get('leadrules')->result_array();
    }

	public function execute_rule($id,$enquiry_code=0){
		//$this->load->model('rule_model');
		$rule_data    =   $this->get_rule($id);        
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
                }else if ($rule_data['type'] == 3) {
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$this->session->companey_id);                                    
                    $enq_row = $this->db->get('enquiry')->row_array();                    
                    if (!empty($enq_row['email']) && !empty($rule_data['rule_action'])) {
                        
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')
                                    ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) {
                            $this->load->model('Message_model');
                            $subject = $row['mail_subject'];
                            $message = $row['template_content'];
                            $this->Message_model->send_email($enq_row['email'],$subject,$message);
                        }

                    }
                }
            }
        }
        return $affected;
	}
    public function execute_rules($enquiry_code,$type){ // for multiple rule execution
        $results    =   $this->get_rules($type);
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $this->execute_rule($value['id'],$enquiry_code);                
            }
        }
    }
    public function get_rule_by_type($type){
        $comp_id = $this->session->companey_id;
        $this->db->where('type',$type);
        $this->db->where('comp_id',$comp_id);
        $this->db->where('status',1);
        return $this->db->get('leadrules')->result_array();
    }
}
