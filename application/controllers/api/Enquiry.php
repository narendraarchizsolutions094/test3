<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Enquiry extends REST_Controller {
    function __construct()
    {
        parent::__construct();
           $this->load->database();
           $this->load->library('form_validation');
           	
		$this->load->model(array(
			'enquiry_model','Leads_Model','location_model','Task_Model','User_model','Message_models','common_model'
		));
		$this->load->model('api/sync_model');
		$this->lang->load("activitylogmsg","english");
		
		$this->load->library('email'); 
   // $this->lang->load('notifications_lang', 'english');   
		
           $this->load->helper('url');
           $this->methods['users_get']['limit'] = 500; 
           $this->methods['users_post']['limit'] = 100; 
           $this->methods['users_delete']['limit'] = 50; 
    }
    function phone_check($phone){
        $product_id    =   $this->input->post('process_id');
        if(!$product_id){  
            $this->form_validation->set_message('phone_check', 'The Process field can not be the empty');
            return false;
        }else{
            $query = $this->db->query("select phone from enquiry where product_id=$product_id AND phone=$phone");
            if ($query->num_rows()>0) {
                $this->form_validation->set_message('phone_check', 'The Mobile no field can not be dublicate in current process');
                return false;
            }else{
                return TRUE;
            }
        }    
    }
    public function create_post()
    { 
    	$upd =$this->input->post('update');		
		if(!empty($this->input->post('email') && !empty($this->input->post('mobileno')))){
		  	$comp_id	=	$this->input->post('company_id');		
        	if (!$upd) {
        		$this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|callback_phone_check|required', array('is_unique' => 'Duplicate   Entery for phone'));        		
        	}else{
        		$this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required');        		
        	}	        
	    	$enquiry_date = $this->input->post('enquiry_date');
	        if($enquiry_date !=''){
	          $enquiry_date = date('d/m/Y');
	        }else{
	          $enquiry_date = date('d/m/Y');
	        } 
           $city_id= $this->db->select("*")
			->from("city")
			->where('id',$this->input->post('city'))
			->get();
			
		if ($this->form_validation->run() === true) {
             $name = $this->input->post('fname');
            $name_w_prefix = $name;
            $encode = $this->get_enquery_code();
			$crtdby = $this->input->post('user_id');
			$user =$this->User_model->read_by_id($crtdby);
            $postData = [                
                'user_role' => $user->user_roles,
                'comp_id' => $comp_id,
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('mobileno', true),
                'name_prefix' => $this->input->post('name_prefix', true),
                'name' => $name_w_prefix,
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'reference_type' => $this->input->post('reference_type'),
                'reference_name' => $this->input->post('reference_name'),
                'enquiry' => $this->input->post('enquiry', true),
                'enquiry_source' => $this->input->post('enquiry_source'),
                'enquiry_subsource' => $this->input->post('product_id'),
                'company' => $this->input->post('org_name'),
                'address' => $this->input->post('address'),
                'checked' => 0,                
                'product_id' => $this->input->post('process_id'),
                'institute_id' => $this->input->post('institute_id'),
                'datasource_id' => $this->input->post('datasource_id'),
                'center_id' => $this->input->post('center_id'),
                'ip_address' => $this->input->ip_address(),
                'created_by' => $this->input->post('user_id'),
                'city_id' => !empty($city_id->row())?$city_id->row()->id:'',
				'state_id' => !empty($city_id->row())?$city_id->row()->state_id:'',
				'country_id'  =>!empty($city_id->row())?$city_id->row()->country_id:'',
                'region_id'  =>!empty($city_id->row())?$city_id->row()->region_id:'',
                'territory_id'  =>!empty($city_id->row())?$city_id->row()->territory_id:'',
                //'created_date' =>$enquiry_date, 
                'status' => 1
            ];
            
            
            if(!empty($upd)){																	
            
            	$this->db->where('Enquery_id',$this->input->post('update'));
            	$insert_id = $this->db->update('enquiry',$postData);
            	$this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
			    $this->db->where('Enquery_id',$this->input->post('update'));
			    $e_row	=	$this->db->get('enquiry')->row_array();
			    $msg	=	'Enquiry successfully updated';
			
            }else{
            	$postData['Enquery_id'] = $encode;
            	$this->enquiry_model->create($postData);
			    $insert_id = $this->db->insert_id();
			    $this->db->select('enquiry.Enquery_id,enquiry.enquiry_id');
			    $this->db->where('enquiry_id',$insert_id);
			    $e_row	=	$this->db->get('enquiry')->row_array();
			    $msg	=	'Enquiry successfully created';
            }
			if ($insert_id) {
			    foreach($this->input->post() as $ind => $val){         
			    	if(is_int($ind)){			    	
						$biarr = array( 
									  "enq_no"  => $e_row['Enquery_id'],
						              "input"   => $ind,
						              "parent"  => $e_row['enquiry_id'], 
						              "fvalue"  => $val,
						              "cmp_no"  => $comp_id,
						             );     
						
						$this->db->where('enq_no',$e_row['Enquery_id']);        
						$this->db->where('input',$ind);        
						$this->db->where('parent',$e_row['enquiry_id']);
						
						if($this->db->get('extra_enquery')->num_rows()){					    
						    $this->db->where('enq_no',$e_row['Enquery_id']);        
						    $this->db->where('input',$ind);        
						    $this->db->where('parent',$e_row['enquiry_id']);
						    $this->db->set('fvalue',$val);
						    $this->db->update('extra_enquery');
						}else{
						    $this->db->insert('extra_enquery',$biarr);
						}
					}
				}
				$this->set_response([
                'status' => TRUE,
                'message' => $msg
            ], REST_Controller::HTTP_OK);
			
			} 
		   } else {		     
		     $this->set_response([
                'status' => false,
                'message' =>strip_tags(validation_errors())
             ], REST_Controller::HTTP_OK);
		     }
		}else{
		     $error='Empty field';
		     $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
		
		}
	}
	
  public function send_message_post(){
    
    $Enquery_id = $this->input->post('enquery_code');
    $template_id = $this->input->post('template_id');
    
    $user_id = $this->input->post('user_id');
    $this->form_validation->set_rules('enquery_code','Inquiry Code','required');
    $this->form_validation->set_rules('template_id','Template ID','required');
    $this->form_validation->set_rules('user_id','User ID','required');
    if($this->form_validation->run() == true){
    
    $this->db->where('pk_i_admin_id',$user_id);
    $user_row  = $this->db->get('tbl_admin')->row_array();
    $this->db->where('temp_id',$template_id);
    $template_row = $this->db->get('api_templates')->row();
    $Templat_subject = $template_row->mail_subject;
    $message_name = $template_row->template_content;
      
          $enq = $this->enquiry_model->enquiry_by_code($Enquery_id);
          //echo $enq->email;
          if(!empty($enq->email)){
              $to = $enq->email;
              $name1 = $enq->name_prefix.' '.$enq->name.' '.$enq->lastname;
              $msg = str_replace('@name',$name1,str_replace('@org',$user_row['orgisation_name'],str_replace('@web',$user_row['website'],str_replace('@desg',$user_row['designation'],str_replace('@phone',$user_row['contact_phone'],str_replace('@desg',$user_row['designation'],str_replace('@user',$user_row['s_display_name'].' '.$user_row['last_name'],$message_name)))))));
                     
              if($this->Message_models->send_mail($to,$msg,$Templat_subject,'')){
               $msg= 'Email sent successfully';
               $this->set_response([
                      'status' => true,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
             }else{
               $msg= 'Something went wrong!';
               $this->set_response([
                      'status' => false,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
             }
          }else{
               $msg= 'Email does not exist for this inquiry';
               $this->set_response([
                      'status' => false,
                      'message' =>$msg
                   ], REST_Controller::HTTP_OK);
          }
         
      
    }else{
          $error= strip_tags(validation_errors());
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
    }
  }
  public function get_mail_template_post(){
    
    $this->db->where('temp_for',3);
    $this->db->where('response_type',1);
    $res=$this->db->get('api_templates');
    $q=$res->result_array();
    $template = array();
    foreach($q  as $value){
      array_push($template,array('template_id'=>$value['temp_id'],'template_value' => $value['template_name'] ) );     
    
    }
    if(empty($template)){
      $this->set_response([
          'status' => false,
          'template' => $template,
           ], REST_Controller::HTTP_OK);
    }else{      
      $this->set_response([
          'status' => TRUE,
          'template' => $template,
           ], REST_Controller::HTTP_OK);
    }
  }
	public function addtimeline_post(){	
		$this->form_validation->set_rules("phone", "Phone", "trim|required");
		$this->form_validation->set_rules("campaign", "Campaign", "trim|required");	
		
		if($this->form_validation->run()){
			
			$phone = $this->input->post("phone", true);
			$camp  = $this->input->post("campaign", true);
			//$key   = $this->input->post("key", true);
			
		
			$this->db->select("enq.*");
			$this->db->where(
                      array(
                        "enq.phone" => $phone,
						"prd.product_name"	=> trim($camp),
					      )
					   );                         
			$this->db->from("enquiry enq");					   
			$this->db->join("tbl_product prd", "prd.sb_id = enq.product_id", "inner");
			$res = $this->db->get()->row();			
			
			//echo $this->db->last_query();
			//print_r($resarr);
			if(!empty($res)){
			$ins = false;								
        	$this->load->model("leads_model");				
			
          
	          $Enquery_id  = $res->Enquery_id;
	          $stage_id = '';
	          $stage_desc = '';
	          $stage_remark = json_encode($this->input->post());
	          $user_id = '';
				$ret = $this->leads_model->add_comment_for_events_stage_api("Voice Call",$Enquery_id,$stage_id,$stage_desc,$stage_remark,$user_id,5);					          
					
	        	if($ret){
					$ins = true;
				}
				//echo $this->db->last_query();
			
		
		if($ins){
			$this->set_response(["status"     => TRUE,
				 "message"   => "Successfully Added"], REST_Controller::HTTP_OK);
		}else{
				$this->set_response(["status"     => False,
				 "message"   => "Failed to add "], REST_Controller::HTTP_OK);
		}
	}else{
		$this->set_response(["status"     => false,
				 "message"   => "Mobile No not found"], REST_Controller::HTTP_OK);
	}
	}else{
	$this->set_response(["status"     => False,
				 "message"   => "Failed to add ".strip_tags(validation_errors())], REST_Controller::HTTP_OK);
	}
		
	}
	public function timeline_post(){
		
		$enquiry_id = $this->input->post('enqueryno', true); 
		$this->load->model("Leads_Model");
		
		$cmntarr = $this->Leads_Model->comment_byId($enquiry_id);
		$tmlinearr  = array();
		
		if(!empty($enquiry_id)) {
			foreach($cmntarr as $ind => $tml){
			
				if($tml->status == 1){
					
					$type = "Enquery";
					
				}else if($tml->status == 2){
					
					$type = "Client";
					
				}else if($tml->status == 3){
					
					$type = "Lead";
				}else{
					$type = $tml->status;
				}
				
				array_push($tmlinearr,array("leadno"      => $tml->lead_id,
											"message"      => $tml->comment_msg,
											"updated"      => date("j-M-Y h:i:s a",strtotime($tml->ddate)),
											"addedby"      => $tml->comment_created_by . ' ' .$tml->lastname,
											"stage"       => $tml->lead_stage_name,
											"description"  => $tml->description,
											"remark"       => $tml->remark,
											"type" 			=> $type)
											); 
			}
	
			$this->set_response(["status"     => TRUE,
							 "timeline"   => $tmlinearr], REST_Controller::HTTP_OK);
		}else{
			$this->set_response(["status"     => False,
							 "timeline"   => $tmlinearr], REST_Controller::HTTP_OK);
			
		}				 
	}
	public function addfieldans_post(){		// this is for paisa expo enquiry capturring		
		$this->db->insert('test',array('res'=>json_encode($_POST)));
		$comp_id = 29;		
        $this->form_validation->set_rules('mobileno', display('mobileno'), 'max_length[20]|required', array('is_unique' => 'Duplicate   Entery for phone'));   
        $this->form_validation->set_rules('process_id', 'Process Id', 'trim|required');
		if($this->form_validation->run()){	
			$city_id= $this->db->select("*")
		      ->from("city")
		      ->where('comp_id',$comp_id)
		      ->where('TRIM(city)',trim($this->input->post('city')))
		      ->get();
		      	$product	=	$this->input->post('product');
		      	if (!empty($product)) {
		      		$product_row	=	$this->db->select("*")
							    ->from("tbl_product_country")
			      				->where('comp_id',$comp_id)
						      	->where('TRIM(country_name)',trim($product))
						      	->get()->row_array();
		      	}
				$mob	=	$this->input->post('mobileno');
				$marr	=	explode('_', $mob);				
				//print_r($marr);
				if (!empty($marr[1])) {
					$this->db->where('phone',$marr[0]);					
					$this->db->where('enquiry_subsource',$marr[1]);					
					$enq_arr	=	$this->db->get('enquiry')->row_array();
					$update	=	$enq_arr['Enquery_id'];
					if (empty($enq_arr)) {
						echo "You can not submit application form directly";
				 		die(); 
					}
				}else{
					$update = 0;
				}
				
				if($update){
					$this->db->where('Enquery_id',$update);					
					if($this->db->get('enquiry')->num_rows()){
						$encode = $update;
					}else{
						$this->set_response(["status"     => false,
			 							 "message"   => "Invalid Id"], REST_Controller::HTTP_OK);
				 		die(); 
					}
				}else{
					$encode = $this->get_enquery_code();
				}
				if (isset($_POST["gender"])) {
					if ($this->input->post('gender')=='Male') {
						$gender = 1;
					}elseif ($this->input->post('gender')=='Female') {
						$gender = 2;
					}elseif ($this->input->post('gender')=='Other') {
						$gender = 3;
					}
				}else{
					$gender  = '';
				}
				
			    $insarr = [							
							'comp_id' 	  		=> $comp_id,							
							'name_prefix' 		=> (isset($_POST["name_prefix"])) ? $this->input->post('name_prefix', true) :"",
							'name' 		  		=> (isset($_POST["name"])) ? $this->input->post('name')  : "",
							'lastname'    		=> (isset($_POST["lastname"])) ? $this->input->post('lastname') : "",
							'gender' 	  		=> $gender,
							'phone'       		=> (isset($_POST["mobileno"])) ? $marr[0] :"",
							'email' 	  		=> (isset($_POST["email"])) ? $this->input->post('email', true) : "",
							'product_id' 		=> (isset($_POST["process_id"])) ? $this->input->post('process_id', true) : "",
							'city_id' 			=> (isset($city_id)) ? $city_id->row()->id : "",
							'state_id' 			=> (isset($city_id)) ? $city_id->row()->state_id : "",
							'country_id'  		=> (isset($city_id)) ? $city_id->row()->country_id : "",
							'region_id'  		=> (isset($city_id)) ? $city_id->row()->region_id : "",
							'territory_id'  	=> (isset($city_id)) ? $city_id->row()->territory_id : "",							
							'address' 			=> (isset($_POST["address"])) ? $this->input->post('address') : "",
							'pin_code' 			=> (isset($_POST["pin-code"])) ? $this->input->post('pin-code') : "",
							'enquiry_source' 	=> (isset($_POST["enquiry_source"])) ? $this->input->post('enquiry_source') : "55",
							'sub_source' 		=> (isset($_POST["sub_source"])) ? $this->input->post('sub_source') : "",
							'other_phone' 		=> (isset($_POST["other_phone"])) ? $this->input->post('other_phone', true) :"",
							'reference_type' 	=> (isset($_POST["reference_type"])) ? $this->input->post('reference_type') : "1",
							'reference_name' 	=> (isset($_POST["reference_name"])) ? $this->input->post('reference_name') : "",
							'enquiry'		 	=> (isset($_POST["remark"])) ? $this->input->post('remark', true) : "",
							'enquiry_subsource' => !empty($product_row['id'])?$product_row['id']:'',
							'company' 		 	=> (isset($_POST["company"])) ? $this->input->post('company') : "",
							'checked' 			=> (isset($_POST["checked"])) ? 0 : "",							
							'datasource_id' 	=> (isset($_POST["datasource_id"])) ? $this->input->post('datasource_id') : "",							
							'ip_address' 		=> (isset($_POST["ip_address"])) ? $this->input->ip_address() : "",
							'created_by' 		=> (isset($_POST["user_id"])) ? $this->input->post("user_id", true) : "191",
							'lead_stage'        => (isset($_POST["lead_stage"])) ? $this->input->post("lead_stage", true) : "",
							'status' 			=> 1,
							'partner_id' 		=> (isset($_POST["partner_id"])) ? $this->input->post("partner_id", true) : ""
						];
	
			if ($update) {				
				$this->db->where('Enquery_id',$encode);					
				$enq_row	=	$this->db->get('enquiry')->row_array();	
				$enqno = 	$enq_row['enquiry_id'];	
				$this->db->where('Enquery_id',$encode);
				$insarr['lead_stage'] = 173;
				//$this->db->update('enquiry',array('lead_stage'=>173));			
				$this->db->update('enquiry',$insarr);			
                $this->Leads_Model->add_comment_for_events_stage_api('Stage Updated', $encode,173,'','',191,0);
			}else{
			
				$insarr['Enquery_id'] = $encode;
				$insarr['lead_stage'] = 172; 		//first form submitted;
				$ret = $this->db->insert('enquiry', $insarr);	
				$enqno = $this->db->insert_id();		
				$comment = $this->lang->line("enquery_create");
                $this->Leads_Model->add_comment_for_events_stage_api($comment, $encode,0,'','',191,0);
                $this->Leads_Model->add_comment_for_events_stage_api('Stage Updated', $encode,172,'','',191,0);
				$process_id	=	$this->input->post('process_id', true);				
				if ($process_id == 95 || $process_id == 91) {
					$meta_arr = array(
							'enquiry_code'			=> $encode,							
							'paisaexpo_processid'   => (isset($_POST["paisaexpo_processid"])) ? $this->input->post('paisaexpo_processid', true) : "",	 
							'paisaexpo_customerid' 	=> (isset($_POST["paisaexpo_customerid"])) ? $this->input->post('paisaexpo_customerid', true) : "",
							'paisaexpo_requestid'	=> (isset($_POST["paisaexpo_requestid"])) ? $this->input->post('paisaexpo_requestid', true) : "",							
							'date_updated'			=> (isset($_POST["date_updated"])) ? $this->input->post('date_updated', true) : ""							
					);
					$this->db->insert('paisa_expo_enquiry_meta',$meta_arr);	
				}			
			}
            if ($this->input->post('bankname')) {
	            $res = $this->enquiry_model->get_deal($encode);            
	            $bank = $this->input->post('bankname');
	            $product_loan = $product_row['id'];
	            if($res){             
	            	$array_newdeal = array(
			                	'bank' 		=> $bank,
			                	'product' 	=> $product_loan,
			                	'updated_by'=> 191
			        	    );  
	            	$this->db->where('enq_id',$encode);
	            	$this->db->update('tbl_newdeal',$array_newdeal);
	            }else{
		            $array_newdeal = array(
		                'comp_id' 	=> 29,
		                'enq_id'  	=> $encode,
		                'bank'	  	=> $bank,
		                'product' 	=> $product_loan,
		                'created_by'=> 191
	            	);     
	                $this->db->insert('tbl_newdeal',$array_newdeal);
	            }
        	}
			$labelarr = $_POST;
			if(!empty($labelarr)){			
				$newlbl = array();
				$valarr = array();
				foreach($labelarr as $ind => $val){										
					$clnlbl   	  		= $ind; 
					$newlbl[] 	  		= $clnlbl;
					$valarr[$clnlbl] 	= $val;
				}				
				$this->db->select('*');
				$this->db->where('company_id', $comp_id);
				$this->db->where_in('input_name', $newlbl);				
				$lblarr = $this->db->get('tbl_input')->result();			
				foreach($lblarr as $ind => $val){	
						$input_value = (!empty($valarr[$val->input_name])) ? $valarr[$val->input_name] : "";	
						$biarr = array(
										"enq_no" => $encode,
										"parent" => $enqno,
										"input"  => $val->input_id,
										"fvalue" => $input_value ,
										"cmp_no" => $comp_id,
										"status" => 1
									);
						$this->db->where('enq_no',$encode);        
                        $this->db->where('input',$val->input_id);        
                        $this->db->where('parent',$enqno);
                        if($this->db->get('extra_enquery')->num_rows()){                            
                            $this->db->where('enq_no',$encode);        
                            $this->db->where('input',$val->input_id);        
                            $this->db->where('parent',$enqno);
                            $this->db->set('fvalue',$input_value);
                        	$ret =   $this->db->update('extra_enquery');
                        }else{
                        	$ret  =  $this->db->insert('extra_enquery',$biarr);
                        }									
				}
				if($ret){
						$this->set_response(["status"     => true,
						 "message"   => "Successfully saved",						
					], REST_Controller::HTTP_OK);
				}else{
					$this->set_response(["status"     => false,
					"message"   => "Failed to  saved"], REST_Controller::HTTP_OK);
				}
			}
		}else{
			$this->set_response(["status"     => false,
			 "message"   => "Failed to add ".validation_errors()], REST_Controller::HTTP_OK);
		}		
	}
	public function addfields_post(){
		
	//	$this->form_validation->set_rules("key","Key", "trim|required");
		$this->form_validation->set_rules("label","Label", "trim|required|callback_checklabel");
		$this->form_validation->set_rules("type","Type", "trim|required");
		//$this->form_validation->set_rules("default","Default", "trim|required");
		
		if(!empty($_SERVER['HTTP_KEY'])){
			
			$key = $_SERVER['HTTP_KEY']; 
		}else{
			$this->set_response(["status"     => false,
					 "message"   => "key not matched"], REST_Controller::HTTP_OK);
		}
		
		
		if($this->form_validation->run()) {
		
			$label  = $this->input->post("label", true);
			$type   = $this->input->post("type", true);
			$value  = $this->input->post("default", true);
			$isreq  = $this->input->post("isreq", true);
			$key    = $this->input->post("key", true);
			$insarr = array("input_place"   => "",
							"input_label"   => $label,
							"input_values"  => $value,
							"input_name"    => "",
							"input_type"    =>  $type,
							"function"      => "",
							"label_required" => (!empty($isreq)) ? $isreq : "No",
							"company_id"     => $key ,
							"process_id"    => "",
							"status"		=> "1");
							
			$ret = $this->db->insert("tbl_input", $insarr);
			
			if($ret){
				
				$this->set_response(["status"     => true,
					 "message"   => "Successfully added"], REST_Controller::HTTP_OK);
	
			}else{
				$this->set_response(["status"     => false,
					 "message"   => "Failed to add"], REST_Controller::HTTP_OK);
				
			}
		
		}else{
			$this->set_response(["status"     => false,
					 "message"   => "Failed to add ".validation_errors()], REST_Controller::HTTP_OK);
		}				
						
		
	}
	
	public function checklabel(){
		
		$lblname = $this->input->post("label", true);
		$cmpno   = $this->input->post("key", true);
		$tcol =  $this->db->select("*")
					  -> where("company_id", $cmpno)	
					  ->where("input_label", $lblname)	
					->from("tbl_input")
					->count_all_results();
		if($tcol > 0){
			$this->form_validation->set_message('checklabel','Input label already exist');
			return false;
		}else{
			return true;
		}
	}
  public function update_post()
  {  
    $enquiry_id = $this->input->post('Enquiry_id'); 
    
   /* 
    echo "<pre>";
    print_r($_POST);
    exit();
   */
    $this->form_validation->set_rules('Enquiry_id','Enquiry Id '  ,'required');
    $this->form_validation->set_rules('user_id','User Id '  ,'required');
  //  $this->form_validation->set_rules('enquiry_type','Inquiry type '  ,'required');
    $this->form_validation->set_rules('fname','First Name '  ,'required');
   // $this->form_validation->set_rules('lastname','Last Name '  ,'required');
   // $this->form_validation->set_rules('fcity','City '  ,'required');
    $data['title'] = display('information');
    #-------------------------------#
    if ($this->form_validation->run() == true) {
    if(!empty($_POST)){
    
	  /*********hhhhhhhhhhhhhh*******/
	        $name = $this->input->post('fname');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobileno');
            $lead_source = $this->input->post('lead_source');
            $enquiry = $this->input->post('enquiry');
            $en_comments = $this->input->post('enqCode');
            $company = $this->input->post('org_name');
            $address = $this->input->post('address');
            $name_prefix = $this->input->post('name_prefix');
            $this->db->set('country_id', $this->input->post('product'));
            $this->db->set('product_id', $this->input->post('process'));
           // $this->db->set('institute_id', $this->input->post('institute_id'));
          //  $this->db->set('datasource_id', $this->input->post('lead_source'));
            $this->db->set('phone', $mobile);
			//$this->db->set('enquiry_subsource',$this->input->post('sub_source'));
            $this->db->set('email', $email);
            $this->db->set('company', $company);
            $this->db->set('address', $address);
            $this->db->set('name_prefix', $name_prefix);
            $this->db->set('name', $name);
            $this->db->set('enquiry_source', $lead_source);
            $this->db->set('enquiry', $enquiry);
            $this->db->set('lastname', $this->input->post('lastname'));
            $this->db->where('Enquery_id', $enquiry_id);
            $this->db->update('enquiry');			
            if($this->db->affected_rows()>0){
           // echo $this->db->last_query();
        /*  $ld_updt_by = $this->input->post('user_id');
          $enquiry_row = $this->enquiry_model->enquiry_by_code($enquiry_id);
          $created_by_user_id = $enquiry_row->created_by;
          
          $user_row = $this->User_model->read_by_id($created_by_user_id);
          $phone_no = $user_row->s_phoneno;
          $creator_phone = '91'.$phone_no;      
          $user_row = $this->User_model->read_by_id($ld_updt_by);          
          
          $updated_by_name = $user_row->s_display_name.' '.$user_row->last_name;
          
          $enq_of_name = $enquiry_row->name_prefix.''.$enquiry_row->name.' '.$enquiry_row->lastname;
          $notification_msg = sprintf($this->lang->line('enquiry_update_text'),trim($enq_of_name),trim($updated_by_name));
          $this->Message_models->sendwhatsapp($creator_phone,$notification_msg);
          $this->Leads_Model->add_comment_for_events_api($notification_msg,$enquiry_id,$ld_updt_by);
          /
          /*$adt = date("d-m-Y H:i:s");
          $this->db->set('lead_id',$en_comments);
          $this->db->set('created_date',$adt);
          $this->db->set('comment_msg','Enquiry Updated');
          $this->db->set('created_by',$ld_updt_by);
          $this->db->insert('tbl_comment');*/
        //$this->Leads_Model->add_comment_for_events('Enquiry Updated',$en_comments);
        
        $this->set_response([
              'status' => TRUE,
              'message' => 'Enquiry successfully updated'
          ], REST_Controller::HTTP_OK);      
      }else{
        $error='Something went wrong!';
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
      }
      
    }else{
      $error='Post data does not exit!';
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
    }
  }else{
    $error= strip_tags(validation_errors());
         $this->set_response([
                'status' => false,
                'message' =>$error
             ], REST_Controller::HTTP_OK);
  }
  }
	 public function customer_type_post()
                          {
            if($this->input->post('customer_type')==1){
            $data['customer_types'] = $this->enquiry_model->customers_types();
            
             if(!empty($data['customer_types'])){
                   $array_val=array();
                   foreach($data['customer_types'] as $val){
                     array_push($array_val,array('customer_id'=>$val->cus_id,'customer_type'=>$val->customer_type)); 
                   }
           
                }
        
        
            }elseif($this->input->post('customer_type')==11){
              $data['customer_types'] = $this->enquiry_model->channel_partner_type_list();
               if(!empty($data['customer_types'])){
                   $array_val=array();
                   foreach($data['customer_types'] as $val){
                     array_push($array_val,array('customer_id'=>$val->ch_id,'customer_type'=>$val->channel_partner_type)); 
                   }
           
                }
            }
       
      
       
          $this->set_response([
                'status' => TRUE,
                'Customer' => $array_val
                 ], REST_Controller::HTTP_OK);
        
        }
        
        public function source_post()
        {
         $comp_id	=	$this->input->post('company_id');
         $data['leadsource'] = $this->Leads_Model->get_leadsource_list_api($comp_id);
         $source=array();
         foreach($data['leadsource']  as $value){
           array_push($source,array('lsid'=>$value->lsid,'lead_name'=>$value->lead_name));
             
         }
          $this->set_response([
                'status' => TRUE,
                'source' => $source,
                 ], REST_Controller::HTTP_OK);
        
        }
        
        
         public function state_post()
                          {        
         $data['state_list'] = $this->location_model->state_list_api();
         $state=array();
         foreach($data['state_list']  as $value1){
            array_push($state,array('state_id'=>$value1->id,'state'=>$value1->state));
          }
         
          $this->set_response([
                'status' => TRUE,
                'state' => $state,
                 ], REST_Controller::HTTP_OK);
        
        }
		
		public function product_post(){ 
         $comp=$this->input->post('company_id');		
         $result = $this->enquiry_model->product_api($comp);
         $product=array();
         foreach($result  as $value1){
            array_push($product,array('product_name'=>$value1->country_name,'id'=>$value1->id));
          }
         
          
         if(!empty($product)){
          $this->set_response([
                'status' => TRUE,
                'product' => $product,
                 ], REST_Controller::HTTP_OK);
        
		} else{
	
	   $this->set_response([
                'status' => false,
                'product' =>array(array('error'=>'Not found')) 
                 ], REST_Controller::HTTP_OK);
        }
		
        }
		public function process_post(){ 
             $userid=$this->input->post('user_id');		
         $data['process'] = $this->enquiry_model->product_list_api($userid);
         $process=array();
         foreach($data['process']  as $value1){
            array_push($process,array('process_name'=>$value1->product_name,'id'=>$value1->sb_id));
          }
         if(!empty($process)){
          $this->set_response([
                'status' => TRUE,
                'process' => $process,
                 ], REST_Controller::HTTP_OK);
        
		} else{
	
	   $this->set_response([
                'status' => false,
                  'process' =>array(array('error'=>'Not found'))
                 ], REST_Controller::HTTP_OK);
        }
        }
        
         public function city_post()
                          {
                             $state_id= $this->input->post('state_id');
         $data['city_list'] = $this->location_model->get_city_byid($state_id);
         $city=array();
         foreach($data['city_list']  as $value1){
            array_push($city,array('id'=>$value1->id,'city'=>$value1->city));
         }
         
          $this->set_response([
                'status' => TRUE,
                'city' => $city,
                 ], REST_Controller::HTTP_OK);
        
        }
        
        
		public function active_enquiry_post()
		{
          	$user_id= $this->input->post('user_id');
			$process_id= $this->input->post('process_id');
			$process = implode(',',$process_id);
			//echo $process;die;
			//print_r($process_id);die;
            $res= array();
			if(!empty($user_id))
			{
				$user_role1 = $this->User_model->read_by_id($user_id); 
				if(!empty($user_role1))
				{
              		$user_role=$user_role1->user_roles;
             		$data['active_enquiry'] = $this->enquiry_model->active_enqueries_api($user_id,1,$user_role,$process);
    
			   		if(!empty($data['active_enquiry']->result()))
					{
						$res= array();
						foreach($data['active_enquiry']->result() as $value)
						{
							$customer='';
							array_push($res,array('enquery_id'=>$value->enquiry_id,'enquery_code'=>$value->Enquery_id,'org_name'=>$value->company,'customer_name'=>$value->name_prefix.' '.$value->name.' '.$value->lastname,'email'=>$value->email,'phone'=>$value->phone,'state'=>'','source'=>'test','type'=>$customer));  
						} 
					}
               
					if(empty($res))
					{
						array_push($res,array('error'=>'enquiry not find'));
					}
				}
				else
				{
					array_push($res,array('error'=>'user not exist'));
				}
         
          		$this->set_response([
                'status' => TRUE,
                'enquiry' =>$res
                 ], REST_Controller::HTTP_OK);
        
			}
			else
			{
		
				$this->set_response([
					'status' => false,
					'enquiry' =>'not found'
					], REST_Controller::HTTP_OK);
			}
      	}
	
	
	
	
	 public function get_enquery_code() {
        $code = $this->genret_code();
        $code2 = 'ENQ' . $code;
        $response = $this->enquiry_model->check_existance($code2);
        
        if ($response) {
            
            $this->get_enquery_code();
        } else {
            
            return $code2;
            
            //exit;
        }
        //exit;
    }
    function genret_code() {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        for ($i = 0; $i < 12; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }
      
      
      
  	public function view_post(){      	
		define('FIRST_NAME',1);
		define('LAST_NAME',2);
		define('GENDER',3);
		define('MOBILE',4);
		define('EMAIL',5);
		define('COMPANY',6);
		define('LEAD_SOURCE',7);
		define('PRODUCT_FIELD',8);
		define('STATE_FIELD',9);
		define('CITY_FIELD',10);
		define('ADDRESS_FIELD',11);  
		$this->load->helper('common_helper');
	    $enquiry_code= $this->input->post('enquiry_code');
		$data['title'] = display('information');		
		$data['drops'] = $this->Leads_Model->get_drop_list();
        $data['name_prefix'] = $this->enquiry_model->name_prefix_list();
		$data['leadsource'] = $this->Leads_Model->get_leadsource_list();
		$result = $this->enquiry_model->enquiry_detail_for_api($enquiry_code);
	    $res= array();
	  	if(!empty($result)){
	        $res= array();
	        $customer='';
	        $channe = '';$male='';
	        if($result->gender==1){
	          	$male='Male';
	        }elseif($result->gender==2){
	           	$male='Female';
	        }elseif($result->gender==3){
	           	$male='Other';
	        }else{
	        }
		    $res = array();			
			$proc  = $result->product_id;
			$comp_id  = $result->comp_id;
			if (is_active_field_api(COMPANY,$proc,$comp_id)) {
				$res['org_name']    = array(
									'value' => $result->company,
									'status' => true
									);				
			}else{
				$res['org_name']    = array(
										'value' => $result->company,
										'status' => false
									);
			}
			if (is_active_field_api(FIRST_NAME,$proc,$comp_id)) {
				$res['customer_name']   = array(
												'value' => $result->name_prefix.' '.$result->name.' '.$result->lastname,
												'status' => true
											);				
			}else{
				$res['customer_name']   = array(
												'value' => $result->name_prefix.' '.$result->name.' '.$result->lastname,
												'status' => false
											);				
			}
			if (is_active_field_api(EMAIL,$proc,$comp_id)) {
				$res['email']   =  array(
										'value' => $result->email,
										'status' => true
									);
			}else{
				$res['email']   =  array(
										'value' => $result->email,
										'status' => false
									);
			}
			if (is_active_field_api(MOBILE,$proc,$comp_id)) {
				$res['phone']   = array(
									'value' => $result->phone,
									'status' => true
									);
			}else{
				$res['phone']   = array(
									'value' => $result->phone,
									'status' => false
									);
			}
			
			if (is_active_field_api(LEAD_SOURCE,$proc,$comp_id)) {
				$res['source']    = array(
										'value' => $result->enquiry_source_name,
										'status' => true
									);
			}else{
				$res['source']    = array(
										'value' => $result->enquiry_source_name,
										'status' => false
									);
			}
			if (is_active_field_api(ADDRESS_FIELD,$proc,$comp_id)) {				
				$res['address']     = array(
										'value' => $result->address,
										'status' => true
										);
			}else{
				$res['address']   = array(
										'value' => $result->address,
										'status' => false
									);
			}
			if (is_active_field_api(GENDER,$proc,$comp_id)) {				
				$res['gender']     = array(
										'value' => $male,
										'status' => true
										);
			}else{
				$res['gender']   = array(
										'value' => $male,
										'status' => false
									);
			}
			if (is_active_field_api(STATE_FIELD,$proc,$comp_id)) {				
				$res['state']     = array(
										'value' => $result->state,
										'status' => true
										);
			}else{
				$res['state']   = array(
										'value' => $result->state,
										'status' => false
									);
			}
			if (is_active_field_api(CITY_FIELD,$proc,$comp_id)) {				
				$res['city']     = array(
										'value' => $result->city,
										'status' => true
										);
			}else{
				$res['city']   = array(
										'value' => $result->city,
										'status' => false
									);
			}
			if (is_active_field_api(PRODUCT_FIELD,$proc,$comp_id)) {				
				$res['product']     = array(
										'value' => $result->product_name,
										'status' => true
										);
			}else{
				$res['product']   = array(
										'value' => $result->product_name,
										'status' => false
									);
			}
			$res['process'] = '';/*array(
									'value' => $result->process_name,
									'status' => true
								);*/
			$res['created_by'] = array(
									'value' => $result->s_display_name.' '.$result->last_name,
									'status' => true
								);
			$res['assign_to'] = array(
									'value' => $result->assign_to_name,
									'status' => true
								);
			$res['requirement'] = array(
									'value' => $result->enquiry,
									'status' => true
								);
			$res['created_on'] = array(
									'value' => $result->created_date,
									'status' => true
								);
			
			/*$res['created_by']        = $result->s_display_name.' '.$result->last_name;
			$res['assign_to']         = $result->assign_to_name;
			$res['created_on']        = $result->created_date;
			$res['requirement']       = $result->enquiry;*/
			
		    /*array(
		     	'enquery_id' 	=>  $result->enquiry_id,
		     	'enquery_code'	=>	$result->Enquery_id,
		     	'org_name'		=>	$result->company,
		     	'customer_name'	=>	$result->name_prefix.' '.$result->name.' '.$result->lastname,
		     	'email'			=>	$result->email,
		     	'phone'			=>	$result->phone,
		     	'source'		=>	$result->enquiry_source_name,
		     	'created_by'	=>	$result->s_display_name.' '.$result->last_name,
		     	'Assign_to'		=>	$result->assign_to_name,
		     	'address'		=>	$result->address,
		     	'created_on'	=>	$result->created_date,
		     	'requirement'	=>	$result->enquiry,
		     	'gender'		=>	$male,
		     	'state'			=>	$result->state,
		     	'city'			=>	$result->city,
		     	'process'		=>	$result->product_name,
		     	'product'		=>	$result->pcountry_name
		    );*/
			$dynval = $this->enquiry_model->get_dyn_fld_api($result->enquiry_id);	
			if(!empty($dynval)){					
				foreach($dynval as $dind => $dval){						
					$ind = (!empty($dval['input_label'])) ? $dval['input_label'] : false;
					if(!empty($ind)) {							
						$res["fields"][] = array("label" => $dval['input_label'],
												"value"  => (!empty($dval['fvalue'])) ?  $dval['fvalue'] :"",
												"status" => $dval['status']
												);
					}										
				}					
			}else{
				$res["fields"] = array(); 
			}		
	    }         
	    $this->set_response([
                'status' => true,
                'enquiry' =>$res
                 ], REST_Controller::HTTP_OK);	
	} 
      
  //user list   
    public function user_list_post()
        { 
		$comp=$this->input->post('company_id');		
         $result = $this->enquiry_model->user_list_api($comp);
         $users=array();
         foreach($result  as $user2){
             array_push($users,array('id'=>$user2->pk_i_admin_id,'user_name'=>$user2->s_display_name.' '.$user2->last_name));
          }
         
          
         if(!empty($users)){
          $this->set_response([
                'status' => TRUE,
                'users' => $users,
                 ], REST_Controller::HTTP_OK);
        
		} else{
	
	   $this->set_response([
                'status' => false,
                'users' =>array(array('error'=>'Not found')) 
                 ], REST_Controller::HTTP_OK);
        }
        
        }   
      
      
    public function assign_enquiry_post(){
      
      $this->form_validation->set_rules('login_id','Login ID' ,'required');
      $this->form_validation->set_rules('assign_user_id','Assign ID' ,'required');
      $this->form_validation->set_rules('enquiry_code[]','Enquery Code' ,'required');
        if($this->form_validation->run() == true){
          
          $move_enquiry = $this->input->post('enquiry_code[]');
          
          $assign_employee = $this->input->post('assign_user_id');
          
          $user =$this->User_model->read_by_id($assign_employee);
          
          $assigner_user_id  = $this->input->post('login_id');
          $assigner_user =$this->User_model->read_by_id($assigner_user_id);
          $assignee_phone = '91'.$user->s_phoneno;
          $assign_to_name = $user->s_display_name.' '.$user->last_name;
          $assign_by_name = $assigner_user->s_display_name.' '.$assigner_user->last_name;
          $assigner_phone = '91'.$assigner_user->s_phoneno;
          
          
          if(!empty($move_enquiry)){
          
            foreach($move_enquiry as $key){
             
              $data['enquiry'] = $this->enquiry_model->enquiry_by_code($key);
          
              $enquiry_code = $data['enquiry']->Enquery_id;
              //if(empty($this->Leads_Model->get_leadListDetailsby_code($enquiry_code))){
          
                $this->enquiry_model->assign_enquery_api($key,$assign_employee,$enquiry_code,$assigner_user_id);
               // $customer_name = $data['enquiry']->name_prefix.''.$data['enquiry']->name.' '.$data['enquiry']->lastname.' ';
              //  $notification_msg = sprintf($this->lang->line('enquiry_assigned_to'),trim($customer_name),trim($assign_to_name),trim($assign_by_name));
               // $this->Message_models->sendwhatsapp($assignee_phone,$notification_msg);
              //  $this->Message_models->sendwhatsapp($assigner_phone,$notification_msg);
              //  $this->Leads_Model->add_comment_for_events_api($notification_msg,$enquiry_code,$assigner_user_id);
          
                //$this->Leads_Model->add_comment_for_events('Enquiry Assigned',$enquiry_code);
          
             // }
          
            }            
            $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Assigned successfully to Sales'))  
               ], REST_Controller::HTTP_OK);
          
          }else{
          
             $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No enquiry found to assign.'))  
               ], REST_Controller::HTTP_OK);
          
          }
        
        }else{
          $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);
        }  
     
     }
      ////////////// Transfer Enquiry to Lead API ///////////////////////
  
      public function move_to_lead_post(){
        $this->form_validation->set_rules('expected_date','Expected Date');
        $this->form_validation->set_rules('conversion_probability','Conversion Probability','required');
        $this->form_validation->set_rules('comment','Comment','required');
        $this->form_validation->set_rules('enquiry_code[]','Enquery Code' ,'required');
        $this->form_validation->set_rules('user_id','User Id' ,'required');
        if($this->form_validation->run() == true){
            $move_enquiry=$this->input->post('enquiry_code[]');
            
            $date = date('d-m-Y H:i:s');
                    
            $lead_score=$this->input->post('conversion_probability');
            $lead_stage=$this->input->post('lead_stage');
            $comment=$this->input->post('comment');
//            $assign_to=$this->session->user_id;
            
            if(empty($lead_score)){
               $lead_score='';              
            }
            
             if(empty($lead_stage)){
               $lead_stage=''; 
            }
            if(empty($comment)){
               $comment=''; 
            }
            if(!empty($move_enquiry)){
              $assigner_user_id =  $this->input->post('user_id');
              $assigner_user = $this->User_model->read_by_id($this->input->post('user_id'));          
              $convertor_phone = '91'.$assigner_user->s_phoneno;
              
              foreach($move_enquiry as $key){
                
                $enq = $this->enquiry_model->enquiry_by_code($key);
                
               // if(empty($this->Leads_Model->get_leadListDetailsby_code($enq->Enquery_id))){
              
                  $data = array(
                          'adminid' =>$enq->created_by,
                          'ld_name' => $enq->name,
                          'ld_email' => $enq->email,
                          'ld_mobile' => $enq->phone,
                          'lead_code' => $enq->Enquery_id,
                          'city_id' => $enq->city_id,
                          'state_id' =>  $enq->state_id,
                          'country_id'  => $enq->country_id,
                          'region_id'  => $enq->region_id,
                          'territory_id'  => $enq->territory_id,
                          'ld_created' => $date,
                          'ld_for' => $enq->enquiry,
                          'lead_score' => $lead_score,
                          'lead_stage' => 1,
                          'comment' => $comment,
                          'ld_status' => '1'
                );
                
                $this->db->set('status',2);
                $this->db->where('Enquery_id',$key);
                $this->db->update('enquiry');
                 /*
              $created_by_user_id =   $enq->created_by;
              
              
              $phone_no =$this->User_model->read_by_id($created_by_user_id)->s_phoneno;
              
              $creator_phone = '91'.$phone_no;          
              
              $enq_of_name = $enq->name_prefix.''.$enq->name.' '.$enq->lastname;
              $notification_msg = sprintf($this->lang->line('enquiry_converted_to_lead'),trim($enq_of_name));
        
              $this->Message_models->sendwhatsapp($convertor_phone,$notification_msg);
              
              $this->Message_models->sendwhatsapp($creator_phone,$notification_msg);              
              $this->Leads_Model->add_comment_for_events_api($notification_msg,$enq->Enquery_id,$assigner_user_id);             
              
              $insert_id = $this->Leads_Model->LeadAdd($data);
                
             // }*/
              }
               $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Enquiry moved successfully to lead'))  
               ], REST_Controller::HTTP_OK);
          }
          else{
            $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No enquiry found to move.'))  
               ], REST_Controller::HTTP_OK);
          }
        }else{
          $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
        }
      }
      
      //////// Drop Enquiry API /////////
    public function drop_enquiries_post(){  
     // $this->form_validation->set_rules('reason','Reason','required');
      $this->form_validation->set_rules('drop_status','Drop Status','required');
      $this->form_validation->set_rules('enquiry_code[]','Enquiry Code','required');
      $this->form_validation->set_rules('user_id',':Login ID','required');
      if( $this->form_validation->run() == true){
        $reason = $this->input->post('reason');
        $drop_status = $this->input->post('drop_status');
        $move_enquiry=$this->input->post('enquiry_code[]');
        $login_id=$this->input->post('user_id');
        if(!empty($move_enquiry)){
          foreach($move_enquiry as $key){
              $this->db->set('drop_status',$drop_status);
              $this->db->set('drop_reason',$reason);
              $this->db->set('update_date',date('Y-m-d H:i:s'));
              $this->db->where('Enquery_id',$key);
              $this->db->update('enquiry');
              
            $data['enquiry'] = $this->enquiry_model->enquiry_by_code($key);
            $enquiry_code = $data['enquiry']->Enquery_id;
            $this->Leads_Model->add_comment_for_events_api('Enquiry Dropped',$enquiry_code,$login_id);
          }
          $this->set_response([
              'status' => true,
              'message' => array(array('error'=>'Enquiry droped successfully'))  
               ], REST_Controller::HTTP_OK);
        }else{
          $this->set_response([
              'status' => false,
              'message' => array(array('error'=>'No enquiry found to drop.'))  
               ], REST_Controller::HTTP_OK);
        }
      }else{
        $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
      }
    }
    public function add_comment_post(){ 
      
      $this->form_validation->set_rules('user_id','User Id','required');
      $this->form_validation->set_rules('comment','Comment Message','required');
      $this->form_validation->set_rules('enquiry_code','Enquiry Code','required');  
      //$this->form_validation->set_rules('comment_type','Enquiry Code','required');  
      if($this->form_validation->run() == true){   
        $ld_updt_by = $this->input->post('user_id');
      
        $lead_id = $this->input->post('enquiry_code');
      
        $conversation = trim($this->input->post('comment'));        
      
        $coment_type = trim($this->input->post('comment_type'));
      
        $adt = date("d-m-Y H:i:s");        
      
        $msg = $conversation;        
        $this->db->set('lead_id',$lead_id); 
        $this->db->set('created_date',$adt); 
        $this->db->set('coment_type ',$coment_type); 
        $this->db->set('comment_msg',$conversation); 
        $this->db->set('created_by',$ld_updt_by); 
        $this->db->insert('tbl_comment');
        $this->set_response([
        'status' => true,
        'message' => array(array('error'=>'Comment added successfully'))  
        ], REST_Controller::HTTP_OK);
     }else{
        $this->set_response([
          'status' => false,
          'message' => array(array('error'=>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))))  
           ], REST_Controller::HTTP_OK);          
      }
    }
    public function drop_status_post(){
		$comp=$this->input->post('company_id');	
      	$drops = $this->enquiry_model->get_drop_list_api($comp);
      	$this->set_response([
                    'status' => true,
                    'message' =>$drops
                     ], REST_Controller::HTTP_OK);
    }
    public function get_enquiry_fields_post(){
    	//$process_id = $this->input->post('process_id');
    	$companey_id = $this->input->post('company_id');    	
    	
		define('FIRST_NAME',1);
		define('LAST_NAME',2);
		define('GENDER',3);
		define('MOBILE',4);
		define('EMAIL',5);
		define('COMPANY',6);
		define('LEAD_SOURCE',7);
		define('PRODUCT_FIELD',8);
		define('STATE_FIELD',9);
		define('CITY_FIELD',10);
		define('ADDRESS_FIELD',11);  
		
		$comp_id 	=	$companey_id;
		$process_list	=	$this->sync_model->get_process_list($comp_id);
		$process_list = $process_list->result_array();
		$res = array();
		if (!empty($process_list)) {		
			foreach ($process_list as $key => $value) {
				$process_id = $value['sb_id'];
				$this->db->select("*");
				$this->db->from('enquiry_fileds_basic');
				$where = " FIND_IN_SET($process_id,process_id) AND comp_id = {$comp_id} AND status=1";
				$this->db->where($where);
				$field_list	= $this->db->get()->result_array();
				$arr = array();
				$field_ids = array();
		        if(!empty($field_list)){
		            foreach($field_list as $field_list){
		              	$field_ids[]	=	$field_list['field_id'];
		           	}
		       }
				if(in_array(FIRST_NAME,$field_ids)){$arr['first_name'] = true;}else{$arr['first_name'] = false;}
				if(in_array(LAST_NAME,$field_ids)){$arr['last_name'] = true;}else{$arr['last_name'] = false;}
				if(in_array(GENDER,$field_ids)){$arr['gender'] = true;}else{$arr['gender'] = false;}
				if(in_array(MOBILE,$field_ids)){$arr['mobile'] = true;}else{$arr['mobile'] = false;}
				if(in_array(EMAIL,$field_ids)){$arr['email'] = true;}else{$arr['email'] = false;}
				if(in_array(COMPANY,$field_ids)){$arr['company'] = true;}else{$arr['company'] = false;}
				if(in_array(LEAD_SOURCE,$field_ids)){$arr['lead_source'] = true;}else{$arr['lead_source'] = false;}
				if(in_array(PRODUCT_FIELD,$field_ids)){$arr['product'] = true;}else{$arr['product'] = false;}
				if(in_array(STATE_FIELD,$field_ids)){$arr['state'] = true;}else{$arr['state'] = false;}
				if(in_array(CITY_FIELD,$field_ids)){$arr['city'] = true;}else{$arr['city'] = false;}
				if(in_array(ADDRESS_FIELD,$field_ids)){$arr['address'] = true;}else{$arr['address'] = false;}
				$extra	=	$this->get_enquiry_extra_fields($process_id,$companey_id);
				/*
				$arr1[] = $arr;
				$extra1[] = $extra;*/
				$res[] = array('process_id'=>$process_id,'fields'=>array('basic'=>$arr,'extra'=>$extra));
			}
		}
		$this->set_response([
                    'status' => true,
                    'data'=>$res
                     ], REST_Controller::HTTP_OK);
    }
	public function get_enquiry_fields_by_process_post()
	{
		// live app without local database single process field
    	$process_id = $this->input->post('process_id');
		$companey_id = $this->input->post('company_id');
		
		//$process = implode(',',$process_id);
		$process = $process_id;
    	
    	
		define('FIRST_NAME',1);
		define('LAST_NAME',2);
		define('GENDER',3);
		define('MOBILE',4);
		define('EMAIL',5);
		define('COMPANY',6);
		define('LEAD_SOURCE',7);
		define('PRODUCT_FIELD',8);
		define('STATE_FIELD',9);
		define('CITY_FIELD',10);
		define('ADDRESS_FIELD',11);  
		
		$comp_id 	=	$companey_id;
		$this->db->select("*");
		$this->db->from('enquiry_fileds_basic');
		$where = " FIND_IN_SET('process_id', '$process_id') AND comp_id = {$comp_id} AND status=1";
		$this->db->where($where);
		$field_list	= $this->db->get()->result_array();
		$arr = array();
		$field_ids = array();
		if(!empty($field_list))
		{
			foreach($field_list as $field_list)
			{
              	$field_ids[]	=	$field_list['field_id'];
           	}
       	}
     
		if(in_array(FIRST_NAME,$field_ids)){$arr['first_name'] = true;}else{$arr['first_name'] = false;}
		if(in_array(LAST_NAME,$field_ids)){$arr['last_name'] = true;}else{$arr['last_name'] = false;}
		if(in_array(GENDER,$field_ids)){$arr['gender'] = true;}else{$arr['gender'] = false;}
		if(in_array(MOBILE,$field_ids)){$arr['mobile'] = true;}else{$arr['mobile'] = false;}
		if(in_array(EMAIL,$field_ids)){$arr['email'] = true;}else{$arr['email'] = false;}
		if(in_array(COMPANY,$field_ids)){$arr['company'] = true;}else{$arr['company'] = false;}
		if(in_array(LEAD_SOURCE,$field_ids)){$arr['lead_source'] = true;}else{$arr['lead_source'] = false;}
		if(in_array(PRODUCT_FIELD,$field_ids)){$arr['product'] = true;}else{$arr['product'] = false;}
		if(in_array(STATE_FIELD,$field_ids)){$arr['state'] = true;}else{$arr['state'] = false;}
		if(in_array(CITY_FIELD,$field_ids)){$arr['city'] = true;}else{$arr['city'] = false;}
		if(in_array(ADDRESS_FIELD,$field_ids)){$arr['address'] = true;}else{$arr['address'] = false;}
		$extra	=	$this->get_enquiry_extra_fields($process_id,$companey_id);
		$this->set_response([
                    'status' => true,
                    'basic' =>$arr,
                    'extra' =>$extra
                     ], REST_Controller::HTTP_OK);
    }
    public function get_enquiry_extra_fields($process_id,$companey_id){    		    
	    $where = " FIND_IN_SET('".$process_id."',process_id) AND company_id = {$companey_id} AND status=1";
	    $this->db->select("*");
	    $this->db->from('tbl_input');
	    $this->db->where($where);
	    $this->db->order_by('input_id asc');
	    return $this->db->get()->result_array();   	
   	} 
/* Syncing apis start */
public function sync_enquiry_data_post(){		
	$p = file_get_contents('php://input');			
	$sync	=	$this->input->post('sync');		
	$i = 0;
	$j = 0;
	$k = 0;
	$l = 0;
	if (!empty($p)) {		
		$p = json_decode($p,true);
		$basic	=	$p['basic'];	
		$extra	=	$p['extra'];
		if (!empty($basic)) {
			foreach ($basic as $key => $value) {
				$this->db->where('Enquery_id',$value['Enquery_id']);
				if($this->db->get('enquiry')->num_rows()){
					$this->db->where('Enquery_id',$value['Enquery_id']);
					$this->db->update('enquiry',$value);					
					$j++;
				}else{
					$this->db->insert('enquiry',$value);
					$i++;
				}				
			}
		}
		if (!empty($extra)) {
			foreach ($extra as $key => $value) {
				$this->db->where('enq_no',$value['enq_no']);
				$this->db->where('input',$value['input']);
				if($this->db->get('extra_enquery')->num_rows()){
					$this->db->where('enq_no',$value['enq_no']);
					$this->db->where('input',$value['input']);
					$this->db->update('extra_enquery',$value);					
					$k++;
				}else{
					$this->db->insert('extra_enquery',$value);
					$l++;
				}				
			}
		}
		if ($i || $j) {
			$this->set_response([
				'status' => true,
				'enquiry' =>'Created: '.$i.' Updated: '.$j
				], REST_Controller::HTTP_OK);			
		}else{
			$this->set_response([
				'status' => False,
				'enquiry' =>'No enquiry synced'
				], REST_Controller::HTTP_OK);			
		}
	}
}
	public function enquiry_data_list_post(){
	    $res= array();
	    $user_id= $this->input->post('user_id');
		if(!empty($user_id)){
			$user = $this->User_model->read_by_id($user_id); 
			if(!empty($user)){
				$result	=	$this->sync_model->all_enquiry($user_id);
				$res['basic'] = $result->result_array();
				$extra_result	=	$this->sync_model->all_enquiry_extra($user_id);
				$res['extra'] = $extra_result->result_array();
				
				$this->set_response([
					'status' => TRUE,
					'enquiry' =>$res
					], REST_Controller::HTTP_OK);
			}else{		
				array_push($res,array('error'=>'user not exist'));
				$this->set_response([
				'status' => False,
				'enquiry' =>$res
				], REST_Controller::HTTP_OK);
			}
		}else{
			$this->set_response([
		        'status' => false,
		        'enquiry' =>'not found'
		         ], REST_Controller::HTTP_OK);
		}
	
	}
public function sync_lead_stage_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->lead_stage($comp_id);
		$res['lead_stage'] = $result->result_array();			
		$result	=	$this->sync_model->lead_description($comp_id);
		$res['lead_description'] = $result->result_array();			
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_lead_source_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->lead_source($comp_id);
		$res['lead_source'] = $result->result_array();			
		$result	=	$this->sync_model->lead_sub_source($comp_id);
		$res['lead_subsource'] = $result->result_array();			
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_product_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->products($comp_id);
		$res['products'] = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_country_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->country($comp_id);
		$res['country'] = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_state_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->state($comp_id);
		$res = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'state' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'state' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_city_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->city($comp_id);
		$res = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'city' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'city' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_task_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$result	=	$this->sync_model->city($comp_id);
		$res = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'city' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'city' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_comment_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$this->db->where('comp_id',$comp_id);
		$result	=	$this->db->get('tbl_comment');		
		$res = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
public function sync_tbl_input_post(){
	$comp_id = $this->input->post('comp_id');
    $res= array();	
	if(!empty($comp_id)){		
		$this->db->where('company_id',$comp_id);
		$result	=	$this->db->get('tbl_input');		
		$res = $result->result_array();					
		$this->set_response([
			'status' => TRUE,
			'data' =>$res
			], REST_Controller::HTTP_OK);		
	}else{
		$this->set_response([
	        'status' => false,
	        'data' =>'not found'
	         ], REST_Controller::HTTP_OK);
	}
}
/* Syncing apis end */
public function get_enq_list_post(){
	$dfields = $this->sync_model->getformfield();               		
	$dacolarr = array();
	$compid = $this->input->post('comp_id');
	 $fieldval =  $this->sync_model->getfieldvalue($enqnos,$compid);  
	if(!empty($compid)){
	    $arr_basic = $arr_dyn = array();
		$res = $this->sync_model->get_enquiry_list($compid);
	    foreach ($res as $key => $value) {
	        $arr_basic = array('nameprefix'=>$value->name_prefix,'firstname'=>$value->name,'lastname'=>$value->lastname,'phone'=>$value->phone,'address'=>$value->address,'process'=>$value->product_name,'lead_stage'=>$value->lead_stage_name,'lead_description'=>$value->lead_discription,'reference_name'=>$value->reference_name,'created_date'=>$value->created_date,'created_by'=>$value->created_by_name,'assign_to'=>$value->assign_to_name,'datasource_name'=>$value->datasource_name,'country_name'=>$value->country_name,'bank_name'=>$value->bank_name);
	           	$enqid = $value->enquiry_id;			
				if(!empty($dacolarr) and !empty($dfields)){
					foreach($dfields as $ind => $flds){					
						if(in_array($flds->input_id, $dacolarr )){						
							$arr_dyn = $fieldval[$enqid][$flds->input_id]->fvalue;	
						}					
					}				
				}
	    	
	    }
	    $this->set_response([
				'status' => TRUE,
				'basic' =>$arr_basic,
				'dyn'   =>$arr_dyn,
				], REST_Controller::HTTP_OK);	
		}
	}

	/*space international contact form data into crm*/
	public function space_international_contact_form_post(){		
		$curl = curl_init();
		
		$fname = $this->input->post('name');
		$mobile = $this->input->post('mobile_no_1589146856501');
		$email = $this->input->post('email');
		$city = $this->input->post('city_1589147378529');
		$visa_type = $this->input->post('visa_type_1589147351535');
		$country = $this->input->post('country_you_wish_to_apply_for_1589147152924');
		$message = $this->input->post('message');

		$city = $city.' '.$country;

		if ($visa_type == 'study-visa') {
			$process_id = 146;
		}else if ($visa_type == 'tourist-visa') {
			$process_id = 147;
		}else if ($visa_type == 'spouse-visa') {
			$process_id = 148;
		}else if ($visa_type == 'schooling-visa') {
			$process_id = 149;
		}

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://thecrm360.com/new_crm/api/enquiry/create",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => array('fname' => $fname,'email' => $email,'mobileno' => $mobile,'company_id' => '67','enquiry' => $message,'process_id' => $process_id,'user_id' => '295','address'=>$city),
		  CURLOPT_HTTPHEADER => array(
		    "Cookie: ci_session=3ba7d4lq4alv2pgpq3sc8t2ojrh41s04"
		  ),
		));
		$response = curl_exec($curl);		
		curl_close($curl);
	}
}
