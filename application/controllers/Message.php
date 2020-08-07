<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		
            $this->load->helper('url');
		
		$this->load->model(array(
			'Client_Model','Apiintegration_Model','Message_models','enquiry_model'
		));
		
		 $this->load->library('email');

	}
    
    	public function get_templates($for,$ins=''){
    	    $this->db->where('temp_for',$for);
    	    $this->db->where('comp_id',$this->session->companey_id);
    	    $res=$this->db->get('api_templates');
    	    $q=$res->result();
    	    if(!empty($q)){
    	        echo ' <option value="0" selected style="display:none">Select Templates</option>';
    	    foreach($q as $value){
    	        echo '<option value="'.$value->temp_id.'">'.$value->template_name.'</option>';
    	       
    	    }
    	    
    	    }
	    }
	
	
		public function getMessage($id){
		if((int)$id){
	    $this->db->where('temp_id',$id);
	    $res=$this->db->get('api_templates');
	    if(!empty($res->result())){
	    echo $q=$res->row()->template_content;}
		}else{
		   
		    
		}
	   
	}
	

   
	public function send_sms(){
	    
	    

	    $signature   = $this->enquiry_model->get_signature();
        if($this->input->post('mesge_type')== 1){
	      	$templates_id	=	$this->input->post('templates');
	      	$this->db->where('temp_id',$templates_id);
	      	$template_row	=	$this->db->get('api_templates')->row_array();
	        $message_name=$this->input->post('message_name');
            $phone= '91'.$this->input->post('mobile');
            $move_enquiry = $this->input->post('enquiry_id');

        	if(!empty($move_enquiry)){
      	      foreach($move_enquiry as $key){
      	        $enq = $this->enquiry_model->enquiry_by_id($key);
      	        $phone='91'.$enq->phone;
      	        $this->Message_models->sendwhatsapp($phone,$message_name);
      	        if($template_row['media']){	      	        	
      	        	$media_url	=	$template_row['media'];
      	        	$this->Message_models->sendwhatsapp($phone,base_url().$media_url);
      	        }
      	      }
      	       echo "Message sent successfully";
            }else{
              	$this->Message_models->sendwhatsapp($phone,$message_name); 
              	if($template_row['media']){	      	   
              		$media_url = $template_row['media'];     	
      	        	$this->Message_models->sendwhatsapp($phone,base_url().$media_url);      	        		      	
      	        }
              echo "Message sent successfully";
           }
        }else if($this->input->post('mesge_type')== 3){
        	$temp_id = $this->input->post('templates');
        	$rows	=	$this->db->select('*')
                        ->from('api_templates')
                        ->join('mail_template_attachments', 'mail_template_attachments.templt_id=api_templates.temp_id', 'left')                    
                        ->where('temp_id',$temp_id)                        
                        ->get()
                        ->row();
            $message = $this->input->post('message_name');
            $email_subject = $this->input->post('email_subject');
	        $to = $this->input->post('mail');
	        $move_enquiry = $this->input->post('enquiry_id');
        	$this->db->where('comp_id',$this->session->companey_id);
        	$this->db->where('status',1);
        	$email_row	=	$this->db->get('email_integration')->row_array();
        	if(empty($email_row)){
  				echo "Email is not configured";
  				exit();
        	}else{


        		/*
        		$config['protocol']     = $email_row['protocol'];
		        $config['smtp_host']    = $email_row['smtp_host'];
		        $config['smtp_port']    = $email_row['smtp_port'];
		        $config['smtp_timeout'] = '7';
		        $config['smtp_user']    = "prokanhaiya@gmail.com";
		        $config['smtp_pass']    = "oallgykmylkthohu";
		        $config['charset']      = 'utf-8';
        		$config['mailtype']     = 'text'; // or html
		        $config['newline']      = "\r\n";        
		        */


		        $config['smtp_auth']    = true;
        		$config['protocol']     = $email_row['protocol'];
		        $config['smtp_host']    = $email_row['smtp_host'];
		        $config['smtp_port']    = $email_row['smtp_port'];
		        $config['smtp_timeout'] = '7';
		        $config['smtp_user']    = $email_row['smtp_user'];
		        $config['smtp_pass']    = $email_row['smtp_pass'];
		        $config['charset']      = 'utf-8';
        		$config['mailtype']     = 'html'; // or html
		        $config['newline']      = "\r\n";        
		        //$config['validation']   = TRUE; // bool whether to validate email or not    
        	}
        	$this->load->library('email');

            if(!empty($move_enquiry)){
	      	    foreach($move_enquiry as $key){
	      	        $enq = $this->enquiry_model->enquiry_by_id($key);
			        $this->email->initialize($config);
			        $this->email->from($email_row['smtp_user']);
	                $to=$enq->email;
	                $this->email->to($to);
	                $this->email->subject($email_subject); 
	                $this->email->message($message); 
	                //$this->email->set_mailtype('html');
	                if($rows->files!=null || !empty($rows->files==null)){
	                    $this->email->attach($rows->files);
	                }
	                if($this->email->send()){
							echo "Mail sent successfully";
	                }else{
							echo "Something went wrong";			                	
	                }
	  			}
        	}else{					
		        $this->email->initialize($config);
		        $this->email->from($email_row['smtp_user']);		                
	            $this->email->to($to);
	            $this->email->subject($email_subject); 
	            $this->email->message($message); 
	            //$this->email->set_mailtype('html');
	            //if($rows->files!=null || !empty($rows->files==null)){
	                //$this->email->attach($rows->files);
	            //}
	            if($this->email->send()){
						echo "Mail sent successfully";
	            }else{
	            	echo $this->email->print_debugger();
						echo "Something went wrong";			                	
	            }                 
    		}	        
    	}else if($this->input->post('mesge_type')== 2){
	        $message = $this->input->post('message_name');
	        $move_enquiry = $this->input->post('enquiry_id');
	           
			if(!empty($this->input->post('mobile'))){	              	
				$phone= '91'.$this->input->post('mobile');
				$this->Message_models->smssend($phone,$message);
				echo "Message sent successfully";
			}else{
				if(!empty($move_enquiry)){
				  foreach($move_enquiry as $key){
				    $enq = $this->enquiry_model->enquiry_by_id($key);
				    $phone=$enq->phone;
				    $this->Message_models->smssend($phone,$message);
				  }
				  echo "Message sent successfully";
				}
			}
    	}
	}
	
public function chat_start(){
   	$message=$this->input->post('message');
   	$phone= '91'.$this->input->post('phone');
   	$this->Message_models->sendwhatsapp($phone,$message);
    echo "Message sent successfully";
   }
}
