<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Rule_model extends CI_Model {
	
	public function get_rule($id,$comp_id=0){
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
		$this->db->where('id',$id);
		$this->db->where('comp_id',$comp_id);
		return $this->db->get('leadrules')->row_array(); 
	}

    public function get_rules($type=array(),$comp_id=0){        
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        $this->db->where('comp_id',$comp_id);
        $this->db->where('status',1);
        if (!empty($type)) {
            $this->db->where_in('type',$type);
        }
        return $this->db->get('leadrules')->result_array();
    }

	public function execute_rule($id,$enquiry_code=0,$comp_id=0,$user_id=0){
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        if ($user_id == 0) {
            $user_id = $this->session->user_id;
        }
		//$this->load->model('rule_model');
		$rule_data    =   $this->get_rule($id,$comp_id);        
        $affected = 0;
        if (!empty($rule_data)) {
            if (!empty($rule_data['rule_sql']) && $rule_data['status'] == 1) {
                if ($rule_data['type'] == 1) {
                    $this->db->where('('.$rule_data['rule_sql'].')');                    
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);                
                    $this->db->set('score',$rule_data['rule_action']);
                    $this->db->update('enquiry');                    
                    $affected = $this->db->affected_rows();
                }else if ($rule_data['type'] == 2) {
                    if (!empty($rule_data['rule_action'])) {
                        $assign_to = explode(',', $rule_data['rule_action']);
                        if (!empty($assign_to[0])) {
                            $this->db->where('('.$rule_data['rule_sql'].')');
                            if ($enquiry_code) {
                                $this->db->where('Enquery_id',$enquiry_code);                
                            }
                            $this->db->where('comp_id',$comp_id);                
                            $this->db->where('aasign_to is null'); 
                            $this->db->set('aasign_to',$assign_to[0]);
                            $this->db->update('enquiry');                            
                            $affected = $this->db->affected_rows();
                            //echo $affected.'<br>'.$assign_to[0].$this->db->last_query();
                            if ($affected) { 
                                //$this->Leads_Model->add_comment_for_events('Converted to client', $enquiry_code);
                                //$this->Leads_Model->add_comment_for_events_stage(, ,'','',$rule_data['title'].' '.'Rule Applied','');

                                $this->Leads_Model->add_comment_for_events_stage_api('Enquiry Assigned', $enquiry_code,'','',$rule_data['title'].' '.'Rule Applied',$user_id);
                                array_push($assign_to, array_shift($assign_to));
                                $assign_to = implode(',', $assign_to);
                                $this->db->where('id',$id);
                                $this->db->update('leadrules',array('rule_action'=>$assign_to));       
                            }                                   
                        }
                    } 
                }else if ($rule_data['type'] == 3) {
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);                                    
                    //$this->db->where('rule_executed!=',$id);                                    
                    $enq_row = $this->db->get('enquiry')->row_array();                    
                    if (!empty($enq_row['email']) && !empty($rule_data['rule_action'])) {
                        
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')
                                    ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) {
                            $this->load->model('Message_models');
                            $subject = $row['mail_subject'];
                            $message = $row['template_content'];
                            if($this->Message_models->send_email($enq_row['email'],$subject,$message,$comp_id)){
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                }else if($rule_data['type'] == 6){
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);
                    //$this->db->where('rule_executed!=',$id);                                    
                    $enq_row = $this->db->get('enquiry')->row_array();                    
                    if (!empty($enq_row['phone']) && !empty($rule_data['rule_action'])) {
                        $phone    =   $enq_row['phone'];
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')                                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) { 
                            $this->load->model('Message_models');                            
                            $message = $row['template_content'];
                            if($this->Message_models->smssend($phone,$message,$comp_id,$user_id)){
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                }else if($rule_data['type'] == 7){
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('Enquery_id',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);
                    //$this->db->where('rule_executed!=',$id);                                    
                    $enq_row = $this->db->get('enquiry')->row_array();                    
                    if (!empty($enq_row['phone']) && !empty($rule_data['rule_action'])) {
                        $phone    =   $enq_row['phone'];
                        $row   =   $this->db->select('*')
                                    ->from('api_templates')                                    
                                    ->where('temp_id',$rule_data['rule_action'])                        
                                    ->get()
                                    ->row_array();
                        
                        if (!empty($row)) { 
                            $this->load->model('Message_models');                            
                            $message = $row['template_content'];
                            if($this->Message_models->sendwhatsapp($phone,$message,$comp_id,$user_id)){
                                //$this->db->where('Enquery_id',$enquiry_code);
                                //$this->db->update('enquiry',array('rule_executed'=>$id));
                            }
                        }

                    }
                }else if($rule_data['type'] == 8){ // ticket auto priority
                    $this->db->where('('.$rule_data['rule_sql'].')');
                    if ($enquiry_code) {
                        $this->db->where('ticketno',$enquiry_code);                
                    }
                    $this->db->where('comp_id',$comp_id);
                    //$this->db->where('rule_executed!=',$id);                                    
                    $enq_row = $this->db->get('tbl_ticket')->row_array();                    
                    if (!empty($rule_data['rule_action'])) {
                        $this->db->where('tbl_ticket.ticketno',$enquiry_code);
                        $this->db->where('tbl_ticket.company',$comp_id);
                        $this->db->update('tbl_ticket.priority',$rule_data['rule_action']);
                    }
                }
            }
        }
        return $affected;
	}
    public function execute_rules($enquiry_code,$type,$comp_id=0,$user_id=0){ // for multiple rule execution
        if ($comp_id == 0) {
            $comp_id    =   $this->session->companey_id;
        }
        if ($user_id == 0) {
            $user_id = $this->session->user_id;
        }
        //echo $comp_id.'<br>'.$user_id;
        $results    =   $this->get_rules($type,$comp_id);
        if (!empty($results)) {
            foreach ($results as $key => $value) {
                $this->execute_rule($value['id'],$enquiry_code,$comp_id,$user_id);                
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
