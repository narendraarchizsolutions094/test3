<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->lang->load("activitylogmsg","english");

	}

	public function signup_content(){
		$this->load->view('signup');		
	}
	public function signup(){
        $this->form_validation->set_rules('name', display('email'), 'required');

        $this->form_validation->set_rules('mobile', display('mobile'), 'required|is_unique[tbl_admin.s_phoneno]', array('is_unique' => 'Mobile no already exist'));
        
        $this->form_validation->set_rules('email', display('email'), 'required|is_unique[tbl_admin.s_user_email]', array('is_unique' => 'Email address already exist'));

        $this->form_validation->set_rules('password',display('password'),"trim|required");

        $this->form_validation->set_rules('confirm_password',display('confirm_password'),"trim|required|matches[password]");

        $name	=	$this->input->post('name');
        $mobile	=	$this->input->post('mobile');
        $email	=	$this->input->post('email');
        $password =	$this->input->post('password');

		$postData = array(
						's_display_name'  =>	$name,
						's_user_email'    =>	$email,
						's_phoneno'       =>	$mobile,
						'companey_id' 	  =>	67,
						'b_status' 	  	  =>	1,
						'user_permissions'=>    151,
						'user_roles'	  =>    151,
						'user_type'	  	  =>    151,
						'process'     	  =>	146,
						's_password'	  =>    md5($password)
					);
		if ($this->form_validation->run()) {
			$this->db->trans_start(); # Starting Transaction			
			$this->load->model('user_model');
			$this->load->model('enquiry_model');
			$user_id	=	$this->user_model->create($postData);
			$enq_code   = 	get_enquery_code();

			$name 		= explode(' ', $name);
			$fname   = $name[0];
			$lname   = $name[1];

			$enq_data 	= 	array(
								'Enquery_id' => $enq_code,
								'name'		 => $fname,
								'lastname'	 => $lname,
								'email'      => $email,
								'phone'      => $mobile,
								'comp_id'    => 67,
								'status'     => 1,
								'product_id' => 146,
								'created_by' => 295								
							);

			$insert_id = $this->enquiry_model->create($enq_data);			
			if ($insert_id) {
				$this->load->model('Leads_Model');                                
				$user_id = 295;                
                $this->Leads_Model->add_comment_for_events_stage_api($this->lang->line("enquery_create"),$enq_code,'','','',$user_id,'');
				$stage_id = 218; // payment done 			
                $this->Leads_Model->add_comment_for_events_stage_api('Stage Updated',$enq_code,$stage_id,'','',$user_id,'');
            }
			$this->user_model->set_user_meta($user_id,array('payment_status'=>0));
			$this->db->trans_complete(); # Completing transaction
			if ($this->db->trans_status() === FALSE) {
			    $this->db->trans_rollback();
				$res = array('status'=>0,'message'=>'Something went wrong!');
			}else{
				if ($user_id) {
					$res = array('status'=>1,'message'=>"Account created successfully please <a href=".base_url('login').">login</a>");
				}else{
					$res = array('status'=>0,'message'=>'Something went wrong!');
				}
			}
		}else{
			$res = array('status'=>0,'message'=>validation_errors());
		}
		echo json_encode($res);
	}
}
