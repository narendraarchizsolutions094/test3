<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Ticket_Model extends CI_Model {

    

        public function TickectAdd($data)

        {

             $this->db->insert('ticket', $data); 

			 

        }

    	public function save($companey_id='',$user_id='')
    	{
		
			$cdate = explode("/", $this->input->post("complaindate", true));
			
			$ndate = (!empty($cdate[2])) ? $cdate[2]."-".$cdate[0]."-".$cdate[1] : date("Y-m-d"); 
			
			$arr = array(
				"message"    => ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
				"category"   => $this->input->post("relatedto", true),
				"other"      => ($_POST["relatedto"] == "Others") ? $this->input->post("otherrel", true ) : "",
				"product"	 => ($this->input->post("product", true)) ? $this->input->post("product", true) : "",
				"sourse"     => ($this->input->post("source", true)) ? $this->input->post("source", true) : "",
				"coml_date"	 => $ndate,
				"last_update"=> date("Y-m-d h:i:s"),
				"priority"	 => ($this->input->post("priority", true)) ? $this->input->post("priority", true) : "", 
			);
			
			if(!empty($_FILES["attachment"]["name"]))
			{
				
				$retdata =  $this->do_upload();
			
				if(!empty($retdata["upload_data"]["file_name"])){
					
					$arr["attachment"] = $retdata["upload_data"]["file_name"];
				}	
			}
			
			if(isset($_POST["ticketno"]))
			{	
				//echo "string;";die;
				
				$this->db->where("ticketno", $this->input->post("ticketno", true));
				$this->db->update("tbl_ticket", $arr);
				
				$ret  = $this->db->affected_rows();
				return $ret;
			}
			else
			{
				
				$arr["name"]   		= ($this->input->post("name", true)) ? $this->input->post("name", true) : "";
				$arr["email"]  		= ($this->input->post("email", true)) ? $this->input->post("email", true) : "";
				$arr["send_date"]  	= date("Y-m-d h:i:s");
				$arr["client"]     	= ($this->input->post("client", true)) ? $this->input->post("client", true) : "";
				$arr["company"]	 	= $companey_id ;
				$arr["added_by"] 	= $user_id ;
				$arr["ticketno"] 	= "";
				$arr["status"]   	= 0;
				$this->db->insert("tbl_ticket", $arr);
				
				$insid = $this->db->insert_id();
				
				$tckno = "TCK".$insid.strtotime(date("y-m-d h:i:s"));
				
				$updarr = array("ticketno" => $tckno);
				
		
				
				$this->db->where("id", $insid);
				$this->db->update("tbl_ticket", $updarr);
				
				if(!empty($insid))
				{
					
					$insarr = array("tck_id" 	=> $insid,
									"parent" 	=> 0,
									"subj"   	=> "Ticked Created",
									"msg"    	=> ($this->input->post("remark", true)) ? $this->input->post("remark", true) : '' ,
									"attacment" => "",
									"status"  	=> 0,
									"send_date" =>	date("Y-m-d h:i:s"),
									"client"   	=> ($this->input->post("client", true)) ? $this->input->post("client", true) : '',
									"added_by" 	=> $user_id,
									
									);
					$ret = $this->db->insert("tbl_ticket_conv", $insarr);
					return $ret;
					
				}
				else
				{
					 $this->session->set_flashdata('message', 'Failed to add ticket');
          
				}	
			}	
		}
		
		public function do_upload()
        {
                $config['upload_path']          = './assets/images/';
                $config['allowed_types']        = '*';
            

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('attachment'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       return $error;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                      return $data;
                }
        }
		
		public function saveconv(){
			
			$insarr = array("tck_id" => $this->input->post("ticketno", true),
							"parent" => 0,
							"subj"   => $this->input->post("subjects", true),
							"msg"    => $this->input->post("reply", true),
							"attacment" => "",
							"status"  => 0,
							"send_date" =>	date("Y-m-d h:i:s"),
							"client"   => $this->input->post("client", true),
							"added_by" => $this->session->user_id,
							
							);
			$ret = $this->db->insert("tbl_ticket_conv", $insarr);
			
			if($ret){
				
					$this->session->set_flashdata('message', 'Successfully added ticket');
			
			}else{
					$this->session->set_flashdata('message', 'Failed to add ticket');
		
			}
			
					
		}
		
		function updatestatus(){
			
			$updarr = array("issue" 	=> $this->input->post("issue", true),
							"solution" => $this->input->post("solution", true),
							"status"    => $this->input->post("status", true),
							"review"    => $this->input->post("review", true)
							);
			$this->db->where("id", $this->input->post("ticketno", true));
			$this->db->update("tbl_ticket", $updarr);
			$ret = $this->db->affected_rows();
			if($ret){
				
					$this->session->set_flashdata('message', 'Successfully added ticket');
			
			}else{
					$this->session->set_flashdata('message', 'Failed to add ticket');
		
			}
		}
		
		function getissues(){
			
			return $this->db->select("*")->where("cmp", $this->session->companey_id)->get("tck_mstr")->result();
			
		}

		// function of getting ticket source
		function getSource($companyid)
		{
			return $this->db->select("s_id,source_name")->where("comp_id",$companyid )->get("tbl_ticket_source")->result();
		}

		function getIssuesByCompnyID($companyid){
			
			return $this->db->select("title")->where("cmp", $companyid)->get("tck_mstr")->result();
			
		}

		
		function getconv($conv){
			
			return $this->db->select("cnv.*")
				 ->where("cnv.tck_id", $conv )
				 ->from("tbl_ticket_conv cnv")
				 ->order_by("cnv.id ASC")
				 ->get()
				 ->result();
			
		}
		public function getall(){

			return $this->db->select("tck.*,enq.phone,enq.gender,prd.country_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg")
				 ->where("tck.company", $this->session->companey_id )
				
				 ->from("tbl_ticket tck")
				 ->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 ->order_by("tck.id DESC")
				 ->group_by("tck.id")
				 ->get()
				 ->result();
		
		}

		public function getTicketListByCompnyID($companyid){

			return $this->db->select("tck.*,enq.phone,enq.gender,prd.country_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg")
				 ->where("tck.company",$companyid )
				
				 ->from("tbl_ticket tck")
				 ->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 ->order_by("tck.id DESC")
				 ->group_by("tck.id")
				 ->get()
				 ->result();
		
		}
		
		public function filterticket($where){

			 $this->db->select("tck.*,enq.phone,enq.gender,prd.product_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg");
				 $this->db->where("tck.company", $this->session->companey_id );
				
				if(!empty($where)){
					
					$this->db->where($where);
					
				}
				
				 $this->db->from("tbl_ticket tck");
				 $this->db->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT");
				 $this->db->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT");
				 $this->db->join("tbl_product prd", "prd.sb_id = tck.product", "LEFT");
				 $this->db->order_by("tck.id DESC");
				 $this->db->group_by("tck.id");
				 
			return	 $this->db->get()
				 ->result();
		
		}
		
		
		public function getproduct()
		{
			
			return $this->db->select("*")->where(array("comp_id" => $this->session->companey_id, "status" => 1))->get("tbl_product_country")->result();
	
			
		}
		
		public function get($tctno){

			return $this->db->select("tck.*,enq.phone,enq.email,enq.gender,prd.country_name, concat(enq.name,' ', enq.lastname) as clientname")
				 ->where("tck.ticketno", $tctno)
				 ->where("tck.company", $this->session->companey_id)
				 ->from("tbl_ticket tck")
				 ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
				 ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
				 
				 ->order_by("tck.id DESC")
				 ->get()
				 ->row();
		
		}
		public function getallclient(){
			
			if(($this->session->userdata('user_right')==212)){
			return $this->db->select("*")->where(array("status" => 3, "phone" => $this->session->phone))->get("enquiry")->result();
			}else{
			return $this->db->select("*")->where(array("status" => 3, "comp_id" => $this->session->companey_id))->get("enquiry")->result();
			}
		}
	

}