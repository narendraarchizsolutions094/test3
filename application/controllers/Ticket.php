<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ticket extends CI_Controller { 


    public function __construct()

	{

		parent::__construct();
 

		$this->load->model(array(

			'Ticket_Model','Client_Model','User_model','Leads_Model','Message_models'

		));	

	

	}

	public function natureOfComplaintList(){
		
		$data['title'] = "Nature Of Complaint List";
		$data["tickets"] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('comp_id',$this->session->companey_id)->get()->result();
		$data['content'] = $this->load->view('ticket/natureofcomplain-list', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}

	public function addNatureOfComplaint(){
		
		$data['title'] = "Add Nature Of Complaint";
		if(!empty($_POST))
        {
            if(empty($this->input->post('complainid')))
            {
                //$added = $this->db->select('id')->from('modulewise_right')->where('module_id',$this->input->post('module'))->get()->num_rows();
                $data = array(
                    'title'         => $this->input->post('title'),
                    'status'     	=> $this->input->post('status'),
                    'comp_id'		=> $this->session->companey_id,
                    'created_by'	=> $this->session->user_id,
                    'created_at'    => date("Y-m-d H:i:s"),
                    'updated_at'    => date("Y-m-d H:i:s"),
                );
                $this->db->insert('tbl_nature_of_complaint',$data);
                $this->session->set_flashdata('message','Data Added successfully');
                redirect('ticket/natureOfComplaintList');
            }
            else
            {
            	$data = array(
                    'title'          => $this->input->post('title'),
                    'status'     => $this->input->post('status'),
                    'comp_id'		=> $this->session->companey_id,
                    'created_by'	=> $this->session->user_id,
                    'created_at'    => date("Y-m-d H:i:s"),
                    'updated_at'    => date("Y-m-d H:i:s"),
                );
                $this->db->where('id',$this->input->post('complainid'));
                $this->db->update('tbl_nature_of_complaint',$data);
                $this->session->set_flashdata('message','Updated successfully');
                redirect('ticket/natureOfComplaintList');
            }
        }
        else
        {
        	$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
			$this->load->view('layout/main_wrapper', $data);
        }
	}

	public function editNatureOfComplaint($id)
	{
		$data['title'] 	= "Edit Nature Of Complaint";
		$data['detail'] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('id',$id)->get()->row();
		$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function deleteNatureOfComplaint($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tbl_nature_of_complaint');
		$this->session->set_flashdata('message','Deleted successfully');
        redirect('ticket/natureOfComplaintList');

	}	
	
	public function index(){
	
		$this->load->model('Datasource_model'); 
        $this->load->model('dash_model'); 
        $this->load->model('enquiry_model'); 
        $this->load->model('report_model'); 

        if(isset($_SESSION['ticket_filters_sess']))
      		 unset($_SESSION['ticket_filters_sess']);

        $data['sourse'] = $this->report_model->all_source();
        $data['title'] = "All Ticket";
        $data["tickets"] = $this->Ticket_Model->getall();
        //print_r($data['tickets']); exit();
        $data['created_bylist'] = $this->User_model->read();
        $data['products'] = $this->dash_model->get_user_product_list();
        $data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
        $data['problem'] = $this->Ticket_Model->get_sub_list();
		//print_r($data["tickets"]);die;
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		$data['user_list'] = $this->User_model->companey_users();
		$data['content'] = $this->load->view('ticket/list-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}



    public function ticket_set_filters_session(){
         $this->session->set_userdata('ticket_filters_sess',$_POST);
         //print_r($_SESSION);
     }
      public function chk()
      {
      	//$data['problem'] = $this->Ticket_Model->get_sub_list();
      	//print_r($data['problem']); exit();
      	//print_r($this->session->ticket_filters_sess); exit();

      	$data['issues'] = $this->Ticket_Model->get_issue_list();
      	//print_r($data['issues']); exit();

      	$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
      	// print_r($all_reporting_ids); exit();
      	print_r($this->session->ticket_filters_sess).'<br><Br>';
          $post = array('search'=>array('value'=>''),'length'=>10,'start'=>0);
         $this->load->model('Ticket_datatable_model');
         $this->Ticket_datatable_model->_get_datatables_query($post);
         $query = $this->db->get();
        print_r($query->result());
         // //$data  = array();
         // // foreach ($res as $point)
         // // {
         // //     $sub = array_values((array)$point);
         // //     $data[] = array_slice($sub, 0,11);
         // // }

         // print_r($res);
      }
     public function ticket_load_data()
     {
        // $_POST = array('search'=>array('value'=>''),'length'=>10,'start'=>0);
         $this->load->model('Ticket_datatable_model');
         
         $res = $this->Ticket_datatable_model->getRows($_POST);
         //print_r($res); exit();
         $data  = array();
         foreach ($res as $point)
         {
             $sub = array();
             $sub[] = '<input type="checkbox" class="checkbox1" onclick="event.stopPropagation();" value="'.$point->id.'">';
             $sub[] = $point->id;
             $sub[] = '<a href="'.base_url('ticket/view/'.$point->ticketno).'">'.$point->ticketno.'</a>';
             $sub[] = $point->clientname??"NA";
             $sub[] = $point->email??"NA";
             $sub[] = $point->phone??"NA";
             $sub[] = $point->country_name??"NA";
             $sub[] = $point->assign_to_name??"NA";
             $sub[] = $point->created_by_name??"NA";
             $sub[] = '<span class="label label-'.($point->priority==1? 'success">Low' : ($point->priority==2?'warning">Medium':'danger">High')).'</span>';
             $sub[] = $point->coml_date;
             $data[] = $sub;
           }

         //print_r($res);
         $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Ticket_datatable_model->countAll(),
            "recordsFiltered" => $this->Ticket_datatable_model->countFiltered($_POST),
            "data" => $data,
        );
          echo json_encode($output);
     }


     public function view_tracking()
     {
     	if($post = $this->input->post())
     	{
     		if($post['trackingno'])
     		{
     			 $ch = curl_init();

		        curl_setopt($ch, CURLOPT_URL, "https://thecrm360.com/new_crm/ticket/gc_vtrans_api/".$post['trackingno']);

		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		        $output = curl_exec($ch);

		        curl_close($ch);  

		        if($output=='')
		        {
		        	echo '<center>No Record Found.</center>';
		        	exit();
		        }

		        $a = json_decode($output);
		        $table  = empty($a->Table)?'':$a->Table;
		        $table1 = empty($a->Table1)?'':$a->Table1;
		        $table2 = empty($a->Table2)?'':$a->Table2;
		        $table3 = empty($a->Table3)?'':$a->Table3;
		        
	        if(isset($a->Table))
	        {
		        echo'<table class="table table-bordered">
		        <tr><th colspan="4" style="text-align:center;">Tracking Number: '.(empty($table->GCNO)?'':$table->GCNO).'</td></tr>
		        <tr><th>Date:</th><td>'.(empty($table->GC_Date)?'':$table->GC_Date).'</td><th>Status:</th><td>'.(empty($table->status)?'':$table->status).'</td></tr>
		         <tr><th>Delivery Location:</th><td  colspan="3">'.(empty($table->DeliveryLocation)?'':$table->DeliveryLocation).'</td></tr>
		         <tr><th>Delivery Branch:</th><td>'.(empty($table->DeliveryBranch)?'':$table->DeliveryBranch).'</td><th>Booking Branch:</th><td>'.(empty($table->BookingBranch)?'':$table->BookingBranch).'</td></tr>';
		        if(sizeof((array)$table->EDD))
		        	echo' <tr><th>EDD</th><td colspan="3">'.print_r($table->EDD).'</td></tr>';

		         echo'<tr><th>Delivery Date:</th><td>'.(empty($table->DeliveryDate)?'':$table->DeliveryDate).'</td><th>Arrival Date:</th><td>'.(empty($table->ArrivalDate)?'':$table->ArrivalDate).'</td></tr>
		         <tr><th>Delivery Type:</th><td>'.(empty($table->DeliveryType)?'':$table->DeliveryType).'</td><th>CRNO:</th><td>'.(empty($table->CRNO)?'':$table->CRNO).'</td></tr>
		        </table>';
		    }

		    if(isset($a->Table1))
		    {
		        echo'<center style="color:red; padding:0px 0px 0px 10px; cursor:pointer;" onclick="$(this).hide(),$(\'.hiddenTrackingDetails\').show();">View More</center>
		        <div class="hiddenTrackingDetails" style="display:none;">
	        	<table class="table table-bordered">
		        	<tr><th colspan="4" style="text-align:center;">Branch Details</th></tr>
		        	<tr><th>Branch Name:</th><td>'.(empty($table1->Branch_Name)?'':$table1->Branch_Name).'</td><th>Contact Person:</th><td>'.(empty($table1->Contact_Person)?'':$table1->Contact_Person).'</td></tr>	
		        	<tr><th>Branch Address:</th><td colspan="3">'.(empty($table1->Address)?'':$table1->Address).'</td></tr>
		        	<tr><th>City Name:</th><td>'.(empty($table1->City_name)?'':$table1->City_name).'</td><th>Pincode:</th><td>'.(empty($table1->Pin_Code)?'':$table1->Pin_Code).'</td></tr>
		        	<tr><th>STD Code:</th><td>'.(empty($table1->Std_Code)?'':$table1->Std_Code).'</td><th>Mobile:</th><td>'.(empty($table1->mobileno)?'':$table1->mobileno).'</td></tr>
		        	<tr><th>Phone No:</th><td>'.(empty($table1->phoneno)?'':$table1->phoneno).'</td><th>Email:</th><td>'.(empty($table1->EMail_Id)?'':$table1->EMail_Id).'</td></tr>
		        	<tr><th>Latitude:</th><td>'.(empty($table1->Latitude)?'':$table1->Latitude).'</td><th>Longitude:</th><td>'.(empty($table1->Longitude)?'':$table1->Longitude).'</td></tr>
	        	</table>';
	        }

	        if(isset($a->Table2))
	        {
	        	echo'<table class="table table-bordered">
		        	<tr><th colspan="4" style="text-align:center;">Delivery Details</th></tr>
		        	<tr><th>Branch Name:</th><td>'.(empty($table2->Branch_Name)?'':$table2->Branch_Name).'</td><th>Contact Person:</th><td>'.(empty($table2->Contact_Person)?'':$table2->Contact_Person).'</td></tr>	
		        	<tr><th>Branch Address:</th><td colspan="3">'.(empty($table2->Address)?'':$table2->Address).'</td></tr>
		        	<tr><th>City Name:</th><td>'.(empty($table2->City_name)?'':$table2->City_name).'</td><th>Pincode:</th><td>'.(empty($table2->Pin_Code)?'':$table2->Pin_Code).'</td></tr>
		        	<tr><th>STD Code:</th><td>'.(empty($table2->Std_Code)?'':$table2->Std_Code).'</td><th>Mobile:</th><td>'.(empty($table2->mobileno)?'':$table2->mobileno).'</td></tr>
		        	<tr><th>Phone No:</th><td>'.(empty($table2->phoneno)?'':$table2->phoneno).'</td><th>Email:</th><td>'.(empty($table2->EMail_Id)?'':$table2->EMail_Id).'</td></tr>
		        	<tr><th>Latitude:</th><td>'.(empty($table2->Latitude)?'':$table2->Latitude).'</td><th>Longitude:</th><td>'.(empty($table2->Longitude)?'':$table2->Longitude).'</td></tr>
	        	</table>';
	        }

        	if(isset($a->Table3) && sizeof($table3)>0)
        	{
        		echo'<table class="table table-bordered">
	        	<tr><th colspan="5" style="text-align:center;">Timeline</th></tr>
	        	<tr><th>From</th><th>To</th><th>Dep. Date</th><th>Arr. Date</th><th>Status</th></tr>
	        	';
	        	
	        	foreach($table3 as $res)
	        	{
	        		echo'<tr>
	        				<td>'.(empty($res->From_Station)?'':$res->From_Station).'</td>
	        				<td>'.(empty($res->To_Station?'':$res->To_Station)).'</td>
	        				<td>'.(empty($res->Depature_Date)?'':$res->Depature_Date).'</td>
	        				<td>'.(empty($res->Arrival_Date)?'':$res->Arrival_Date).'</td>
	        				<td>'.(empty($res->Status_Name)?'':$res->Status_Name).'</td>
	        			</tr>';
	        	}
	        	echo'</table>';
	        }
		        echo'</div>
		        ';
	     	}
     	}
     }

	public function view1($tckt = ""){		
		if(isset($_POST["reply"])){
			            $subject = $this->input->post("subjects", true);
						$message = $this->input->post("reply", true);
						$to = $this->input->post("email", true);
					$this->Message_models->send_email($to,$subject,$message);
			$this->Ticket_Model->saveconv();
			redirect(base_url("ticket/view/".$tckt), "refresh");
		}
		if(isset($_POST["issue"])){			
			$this->Ticket_Model->updatestatus();
			redirect(base_url("ticket/view/".$tckt), "refresh");
		}		
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		if(empty($data["ticket"])){
			show_404();
		}		 
		$data['title'] = "View ";
		//$data["problem"] = $this->Ticket_Model->getissues();
		$datexpressiona['problem'] = $this->Ticket_Model->get_sub_list();
		$data['content'] = $this->load->view('ticket/view-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);		
	}
	function view($tckt = ""){ 
		
		$this->load->model('enquiry_model');
		
		$data = array();
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		if(empty($data['ticket']))
		{
			show_404();
		}	
		//print_r($data['ticket']);exit();	
		$match = array(	
						'ticket_no' =>$data['ticket']->ticketno,
						'tck.client'=>$data['ticket']->client,
						'tck.tracking_no'=>$data['ticket']->tracking_no,
						'enq.phone'=>$data['ticket']->phone,
					);
		$data['related_tickets'] = $this->Ticket_Model->all_related_tickets($match);
		//print_r($data['related_tickets']); exit();
		$data["referred_type"] =$this->Leads_Model->get_referred_by();
		$data['all_description_lists']    =   $this->Leads_Model->find_description();	

		$data["clients"] = $this->Ticket_Model->getallclient();

 		$data["problem_for"] = $this->Ticket_Model->getclient($data['ticket']->client);
 		//print_r($data['problem_for']); exit();
		
		$data["product"] = $this->Ticket_Model->getproduct();
		//print_r($data['product']); exit();
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		$data['problem'] = $this->Ticket_Model->get_sub_list();
 
 		$data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
        $data['issues'] = $this->Ticket_Model->get_issue_list();
		//$data['data'] = $data;
		//echo $data["ticket"]->client;
		if(!$data["ticket"]->client)
			show_404();
		$this->load->model('enquiry_model');
        $data['enquiry'] = $this->enquiry_model->enquiry_by_id($data["ticket"]->client);
		
		$data['ticket_stages'] = $this->Leads_Model->find_estage($data['enquiry']->product_id,4);
		$data['leadsource'] = $this->Leads_Model->get_leadsource_list();
		//print_r($data['leadsource']);	
		//print_r($data['ticket_stages']); exit();
		$this->load->model(array('form_model','dash_model','location_model'));
        $this->load->helper('custom_form_helper');

        $data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id,0,2);

		$content	 =	$this->load->view('ticket/ticket_disposition',$data,true);
		$content    .=  $this->load->view('ticket/ticket_details',$data,true);
		$content    .=  $this->load->view('ticket/timeline',$data,true);

		$data['content'] = $content;        
        $this->load->view('layout/main_wrapper', $data);
	}


	public function get_enquery_code()
    {

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

    function genret_code()
    {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < 12; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }

	public function ticket_disposition($ticketno){
		//print_r($_POST); exit();
		$lead_stage	=	$this->input->post('lead_stage');
		$stage_desc	=	$this->input->post('lead_description');
		$stage_remark	=	$this->input->post('conversation');
		$client	=	$this->input->post('client');

		$stage_date = date("d-m-Y",strtotime($this->input->post('c_date')));
		$stage_time = date("H:i:s",strtotime($this->input->post('c_time')));

		$user_id = $this->session->user_id;
		$this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
        $this->Ticket_Model->saveconv($ticketno,'Stage Updated',$stage_remark,$client,$user_id,$lead_stage,$stage_desc);

        $contact_person = '';
        $mobileno = '';
        $email = '';
        $designation = '';
        $enq_code = $this->input->post('ticketno');
        $notification_id = $this->input->post('dis_notification_id');
        $dis_subject = '';

        $this->Leads_Model->add_comment_for_events_popup($stage_remark,$stage_date,$contact_person,$mobileno,$email,$designation,$stage_time,$enq_code,$notification_id,$dis_subject,17);
        $ticketno	=	$this->input->post('ticketno');
        redirect('ticket/view/'.$ticketno);
	}
	
public function assign_tickets() {

        if (!empty($_POST)) {
            $move_enquiry = $this->input->post('enquiry_id[]');
           // echo json_encode($move_enquiry);
            $assign_employee = $this->input->post('epid');
            $notification_data=array();$assign_data=array();
            if (!empty($move_enquiry)) {
                foreach ($move_enquiry as $key) {
					$this->db->set('assign_to', $assign_employee);
					$this->db->where('id', $key);
					$this->db->update('tbl_ticket');    
                }
                echo display('save_successfully');
            } else {
                echo display('please_try_again');
            }
        }
    }	
	
	public function update_ticket($tckt = "")
	{	
		//print_r($_POST); exit();
		if(isset($_POST["ticketno"]))
		{
			$_POST['relatedto'] = $_POST['issue'];
			$this->Ticket_Model->updatestatus();
			//echo $this->session->flashdata('message'); exit();
				//redirect(base_url("ticket/view/".$tckt), "refresh");

			$res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			
			if($res)
			{
				$this->session->set_flashdata('message', 'Successfully Updated ticket');
            	redirect(base_url('ticket/view/'.$tckt), "refresh");
				//echo'in';
			}
		
		}
		echo 'out';
	}
	public function edit($tckt=""){
		
		if(isset($_POST["ticketno"]))
		{
			
			$res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			if($res)
			{
				$this->session->set_flashdata('message', 'Successfully Updated ticket');
            	redirect(base_url('ticket/edit/'.$tckt), "refresh");
			}
		}
		
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		
		if(empty($data["ticket"])){
			show_404();
		}
		
		
		
		$data['title'] = "Edit ";
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		$data["clients"] = $this->Ticket_Model->getallclient();
		$data["product"] = $this->Ticket_Model->getproduct();
		//$data["problem"] = $this->Ticket_Model->getissues();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();

		$data['source'] = $this->Leads_Model->get_leadsource_list();
		//$data["source"] = $this->Ticket_Model->getSource($this->session->companey_id);//getting ticket source list
		$data['content'] = $this->load->view('ticket/edit-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function delete_ticket()
	{
		foreach ($this->input->post('ticket_list') as $key => $value) 
		{
			$this -> db -> where('id', $value);
			$this -> db -> delete('tbl_ticket');
			$ret = $this->db->affected_rows();
			$this -> db -> where('tck_id', $value);
			$this -> db -> delete('tbl_ticket_conv');	
		}
	}

	function tdelete(){
		
		$cnt = $this->input->post("content", true);
		
		$this -> db -> where('id', $cnt);
		$this -> db -> delete('tbl_ticket');
		$ret = $this->db->affected_rows();
		$this -> db -> where('tck_id', $cnt);
		$this -> db -> delete('tbl_ticket_conv');
		
		if($ret){
			
			$stsarr = array("status" => "success",
							"message" => "Successfully deleted");
			
		}else{
			$stsarr = array("status" => "failed",
							"message" => "Failed to delete");
			
			
		}
		die(json_encode($stsarr));
	}
	
	public function filter(){
		
		$pst = $this->input->post("top_filter", true);
		
		if($pst == "created_today"){
			
			$where =  " tck.send_date = cast((now()) as date)";
			
		}else if($pst == "updated_today"){
			
			$where =  " tck.last_update	 = cast((now()) as date)";
			
		}else if($pst == "droped"){
			
			$where = array(" tck.status" => 3);	
			
		}else if($pst == "unread"){
			
			$where  =  "tck.status = 0";
			
		} else if($pst == "all"){
			$where = false;
		}else{
			$where = false;
		}
		
		$tickets =  $this->Ticket_Model->filterticket($where);

		
		 if(!empty($tickets)){
			foreach($tickets as $ind => $tck){
				?>
				<tr>
					<td><?php echo $ind + 1; ?></td>
					<td><?php echo $tck->ticketno; ?></td>
					<td><?php echo $tck-> clientname; ?></td>
					<td><?php echo $tck->email ; ?></td>
					<td><?php echo $tck->phone	; ?></td>
					<td><?php echo $tck->	product_name ; ?></td>
					
					<td><?php echo $tck->category ; ?></td>
					<td><?php 
						if($tck->priority == 1){
						?><span class="badge badge-info">Low</span><?php	
						}else if($tck->priority == 2){
						?><span class="badge badge-warning">Medium</span><?php		
						}else if($tck->priority == 2){
							?><span class="badge badge-danger">High</span><?php	
						}
					
					?></td>
					<td><?php echo $tck-> message; ?></td>
					<td><?php echo date("d, M, Y", strtotime($tck->	send_date)); ?></td>
					<td style ="min-width:125px;"><a class="btn  btn-success" href="<?php echo base_url("ticket/view/".$tck->ticketno) ?>"><i class="fa fa-eye" aria-hidden="true"></i>
					<a class="btn  btn-default" href="<?php echo base_url("ticket/edit/".$tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					<a class="btn  btn-danger delete-ticket"  data-ticket = "<?php echo $tck->id; ?>" href="<?php echo base_url("ticket/tdelete") ?>"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				
				<?php
				
			}	
		}
		
		
	}
	
	
	public function getmail(){
		
		
	//		'smtp_host' => 'ssl://smtp.googlemail.com',
	//					'smtp_port' => 465,
	//					'smtp_user' => 'admin@digitalanthub.com',
	//					'smtp_pass' => 'Digital@123',
		
		/* connect to gmail */
		
	//	pop.gmail.com

//Requires SSL: Yes

//Port: 995
		
		
		$hostname =  '{imappro.zoho.com:993/imap/ssl}INBOX';
		$username = 'shahnawazbx@gmail.com';
		$password = 'BuX@76543210';
		$username = 'shahnawaz@archizsolutions.com';
		$password = 'Archiz321';
		
	//	$hostname =  '{imap.googlemail.com:993/imap/ssl}INBOX';
	//	$username = 'admin@digitalanthub.com';
	//	$password = 'Digital@123';

		echo "Hello 1";
		
		/* try to connect */
		$inbox = imap_open($hostname,$username ,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
		
		echo "<pre>";
			print_r(imap_errors());
		echo "</pre>";
		echo imap_last_error();
		echo "Hello 2";
		/* grab emails */
		$emails = imap_search($inbox,'ALL');

		/* if emails are returned, cycle through each... */
		if($emails) {

			/* begin output var */
			$output = '';

			/* put the newest emails on top */
			rsort($emails);

			/* for every email... */
			foreach($emails as $ind => $email_number) {

				if($ind > 10) break;

				/* get information specific to this email */
				$overview = imap_fetch_overview($inbox,$email_number,0);
				$message  = imap_fetchbody($inbox, $email_number, 1);
				echo "<pre>";
					print_r($message);
				echo "</pre>";
				
				$output.= 'Name:  '.$overview[0]->from.'</br>';
					$output.= 'Email:  '.$overview[0]->message_id.'</br>';



			}

			echo $output;
		} 

		/* close the connection */
		imap_close($inbox);
		
	}
	
	public function add(){
		
		//print_r($_SESSION); exit();

		if(isset($_POST["client"])){


			$res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			// echo'ruk';
			// exit();
			// $res = $this->Ticket_Model->save($this->session->companey_id,$this->session->user_id);
			if($res)
			{
				$this->session->set_flashdata('message', 'Successfully added ticket');
				//redirect(base_url("ticket/add") , "refresh");
            	redirect(base_url('ticket/view/'.$res));
			}
		}
		
		$data['title'] = "Add Ticket";
		$data['source'] = $this->Leads_Model->get_leadsource_list();
		$data["clients"] = $this->Ticket_Model->getallclient();
		$data["product"] = $this->Ticket_Model->getproduct();
		$data["referred_type"] =$this->Leads_Model->get_referred_by();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		//$data["source"] = $this->Ticket_Model->getSource($this->session->companey_id);//getting ticket source list
		$data['content'] = $this->load->view('ticket/add-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
		
	}
	

	public function view_previous_ticket()
	{
		if($post = $this->input->post())
		{
			$no = $post['tracking_no'];
			$res = $this->Ticket_Model->filterticket(array('tracking_no'=>$no));
			//print_r($res); exit();
			if($res)
			{
				echo'<table class="table table-bordered">
				<tr>
				<th>Tracking No</th>
				<th>Ticket Number</th>
				<th>Name</th>
				<th>Type</th>
				<th>Action</th>
				</tr>';
				foreach ($res as $row)
				{
				echo'<tr>
					<td>'.$row->tracking_no.'</td>
					<td>'.$row->ticketno.'</td>
					<td>'.$row->name.'</td>
					<td>'.($row->complaint_type?"Enquiry":"Complaint").'</td>
					<th><a href="'.base_url('ticket/view/'.$row->ticketno).'"><button class="btn btn-small btn-primary">View</button></a></th>
					</tr>';
				}	
				echo'</table>';
			}
			else
			{
				echo'0';
			}
		}
	}

	public function loadinfo(){
		
		$usr = $this->input->post("clientno", true);
		
		$user = $this->db->select("*")->where("enquiry_id", $usr)->get("enquiry")->row();
		
		if(!empty($user))
		{
			
			$jarr = array("name"   => $user->name_prefix." ".$user->name." ".$user->lastname, 
						  "email"  => $user->email,
						  "phone"  => $user->phone);
			
			die(json_encode($jarr));
		}
	
	}


    public function referred_by($id=0)
    {   

        $data['nav1'] = 'nav2';
        $data['title']    =display('Lead Details');
        $data['header']= ($id?' Edit ':' Add ').'Referred By';
        $data['table'] = $this->Leads_Model->get_referred_by();
            if($id)
            {
                $data['data']= $this->Leads_Model->get_referred_by(array('id'=>$id));
            }

            if($_POST)
            {   
                $_POST['company_id'] = $this->session->companey_id;
                $_POST['created_by'] = $this->session->userdata('user_id');
                $this->Leads_Model->save_referred_by($_POST,$id);
                redirect(base_url('ticket/referred_by/'.$id));
            }

          $data['content']  = $this->load->view('add_referred_by',$data,true);
          $this->load->view('layout/main_wrapper',$data);
    }

    public function delete_referred_by($id)
    {
        $this->Leads_Model->delete_referred_by($id);
        redirect(base_url('ticket/referred_by'));
    }

	
	public function loadamc(){
		
		$prodno = $this->input->post("product", true);
		
		$enqno  = $this->input->post("client", true);
		
		$amcarr = $this->db->select("*")->where(array("product_name" => $prodno, "enq_id" => $enqno))->get("tbl_amc")->row();
		
		$amc = array();
		if(!empty($amcarr)){
			
			$amcarr = array("status" 	  => "found",
							"from_date"   => date("d, M Y ", strtotime($amcarr->amc_fromdate)),
							"to_date"     => date("d, M Y ", strtotime($amcarr->amc_todate))
							);
		}else{
			$amcarr = array("status" => "Not Found");
		}
		die(json_encode($amcarr));
	}
	
	public function loadoldticket($prd = ""){
		
		$data['oldticket'] = $this->db->select("tck.*,sour.lead_name as source_name,subj.subject_title as issue_name")
					->from("tbl_ticket as tck")
					->join("lead_source as sour","tck.sourse=sour.lsid","left")
					->join("tbl_ticket_subject as subj","tck.issue=subj.id","left")
					->where("tck.product", $prd)
					->where("tck.company", $this->session->companey_id)
					->get()->result();
		$this->load->view("ticket/page/tck-table",$data);
	}

	public function addproblems($prblm = ""){
		
		$this->saveticket();
		
		if(empty($prblm)) {
			
			$data['title'] = "Add Problems";
			$data["problem"] = $this->Ticket_Model->getissues();
			
			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
		}else{
			
			$data["eproblem"] = $this->db->select("*")->where("cmp", $this->session->companey_id)->where("id", $prblm)->get("tck_mstr")->row();
			
			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
			
		}
		
		$this->load->view('layout/main_wrapper', $data);
		
	}
	
	public function saveticket(){
		
		if(isset($_POST["problem"])){
			
		
			
			if(isset($_POST["problemno"])){
				
				$updarr = array("title" 	=> $this->input->post("problem"),
									);
				$prblm  = $this->input->post("problemno", true);					
									
				$this->db->where("id", $prblm);
				$this->db->update("tck_mstr", $updarr);	
				$this->session->set_flashdata('message', 'Successfully Updated Problem');
				redirect(base_url("ticket/addproblems.html/"), "refresh");
				
			}else{
				$insarr = array("title" 	=> $this->input->post("problem"),
						"cmp"   	=> $this->session->companey_id,
						"added_by"	=> $this->session->user_id
						);
				$this->db->insert("tck_mstr", $insarr);
				redirect(base_url("ticket/addproblems.html"), "refresh");
				$this->session->set_flashdata('message', 'Successfully added Problem');
			}
			
			
		}
		
	}
public function add_subject() {
        $data['title'] = display('ticket_problem_master');
        $data['nav1'] = 'nav2';
        #------------------------------# 
        $leadid = $this->uri->segment(3);

        //////////////////////////////////////////////////////
        if (!empty($_POST)) {

            $reason = $this->input->post('subject');

            $data = array(
                'subject_title' => $reason,
				'comp_id' => $this->session->userdata('companey_id')
            );

            $insert_id = $this->Ticket_Model->add_tsub($data);

            redirect('ticket/add_subject');
        }
        //////////////////////////////////////////////////////


        $data['subject'] = $this->Ticket_Model->get_sub_list();

        $data['content'] = $this->load->view('ticket_subject', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
	
	public function update_subject() {

        if (!empty($_POST)) {
            $drop_id = $this->input->post('drop_id');

            $reason = $this->input->post('subject');

            $this->db->set('subject_title', $reason);
            $this->db->where('id', $drop_id);
            $this->db->update('tbl_ticket_subject');
            $this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
            redirect('Ticket/add_subject');
        }
    }
	public function delete_subject($drop = null) {
        if ($this->Ticket_Model->delete_subject($drop)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('Ticket/add_subject');
	}
	public function gc_vtrans_api($gc_no){
        $url = "http://203.112.143.175/VTWS/Service.asmx?wsdl";
        $soapclient = new SoapClient($url,array('UserName' => 'vtransweb','Password'=>'vt@2016'));
        $response = $soapclient->__soapCall('GetTrackNTraceData', array('parameters'=>array('UserName' => 'vtransweb','Password'=>'vt@2016','Gc_No'=>$gc_no)));
        $xml = $response->GetTrackNTraceDataResult->any;
        $response = simplexml_load_string($xml);
        $ns = $response->getNamespaces(true);
        $res = '';
        if(!empty($response->NewDataSet)){
            $res = json_encode($response->NewDataSet);
        }
        echo $res;
    }
}

