<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ticket extends CI_Controller
{


	public function __construct()

	{

		parent::__construct();


		$this->load->model(array(

			'Ticket_Model', 'Client_Model', 'User_model', 'Leads_Model', 'Message_models'

		));
	}

	public function natureOfComplaintList()
	{

		$data['title'] = "Nature Of Complaint List";
		$data["tickets"] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('comp_id', $this->session->companey_id)->get()->result();
		$data['content'] = $this->load->view('ticket/natureofcomplain-list', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function addNatureOfComplaint()
	{

		$data['title'] = "Add Nature Of Complaint";
		if (!empty($_POST)) {
			if (empty($this->input->post('complainid'))) {
				//$added = $this->db->select('id')->from('modulewise_right')->where('module_id',$this->input->post('module'))->get()->num_rows();
				$data = array(
					'title'         => $this->input->post('title'),
					'status'     	=> $this->input->post('status'),
					'comp_id'		=> $this->session->companey_id,
					'created_by'	=> $this->session->user_id,
					'created_at'    => date("Y-m-d H:i:s"),
					'updated_at'    => date("Y-m-d H:i:s"),
				);
				$this->db->insert('tbl_nature_of_complaint', $data);
				$this->session->set_flashdata('message', 'Data Added successfully');
				redirect('ticket/natureOfComplaintList');
			} else {
				$data = array(
					'title'          => $this->input->post('title'),
					'status'     => $this->input->post('status'),
					'comp_id'		=> $this->session->companey_id,
					'created_by'	=> $this->session->user_id,
					'created_at'    => date("Y-m-d H:i:s"),
					'updated_at'    => date("Y-m-d H:i:s"),
				);
				$this->db->where('id', $this->input->post('complainid'));
				$this->db->update('tbl_nature_of_complaint', $data);
				$this->session->set_flashdata('message', 'Updated successfully');
				redirect('ticket/natureOfComplaintList');
			}
		} else {
			$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}

	public function editNatureOfComplaint($id)
	{
		$data['title'] 	= "Edit Nature Of Complaint";
		$data['detail'] = $this->db->select('*')->from('tbl_nature_of_complaint')->where('id', $id)->get()->row();
		$data['content'] = $this->load->view('ticket/addNatureof_complaint', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function deleteNatureOfComplaint($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_nature_of_complaint');
		$this->session->set_flashdata('message', 'Deleted successfully');
		redirect('ticket/natureOfComplaintList');
	}

	public function index()
	{
		$this->load->model('Datasource_model');
		$this->load->model('dash_model');
		$this->load->model('enquiry_model');
		$this->load->model('report_model');
		$this->load->model('Leads_Model');

		if (isset($_SESSION['ticket_filters_sess']))
			unset($_SESSION['ticket_filters_sess']);

		$data['sourse'] = $this->report_model->all_source();
		$data['title'] = "All Ticket";

		$data["tickets"] = $this->Ticket_Model->getall();
		//print_r($data['tickets']); exit();
		$data['created_bylist'] = $this->User_model->read();
		$data['products'] = $this->dash_model->get_user_product_list();
		$data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
		$data['problem'] = $this->Ticket_Model->get_sub_list();

		if(count($this->session->process)==1)
			$data['stage'] =  $this->Leads_Model->find_estage($this->session->process[0],4);
		$data['sub_stage'] = $this->Leads_Model->find_description();

		$data['ticket_status'] = $this->Ticket_Model->ticket_status()->result();
		
		
		//print_r($data["tickets"]);die;
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		$data['user_list'] = $this->User_model->companey_users();
		$data['content'] = $this->load->view('ticket/list-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function ticket_set_filters_session()
	{
		$this->session->set_userdata('ticket_filters_sess', $_POST);
		//print_r($_SESSION);
	}
	public function autofill()
	{
		if($post = $this->input->post())
		{
			$this->load->model('Enquiry_model');


			$res = $this->Ticket_Model->filterticket(array('tck.'.$post['find_by'] => $post['key']));

			$html = "";

			if($res)
			{

				$enq = $this->Enquiry_model->getEnquiry(array('enquiry_id'=>$res[0]->client))->row();
				
				if($enq)
				{
					$html .= '<table class="table table-bordered">
					<tr>
					' . ($this->session->companey_id == 65 ? '<th>Tracking No</th>' : '') . '
					<th>Ticket Number</th>
					<th>Name</th>
					<th>Ticket Stage</th>
					<th>Created At</th>
					<th>Action</th>
					</tr>';
					foreach ($res as $row) {
						$html .= '<tr>
						' . ($this->session->companey_id == 65 ? '<td>' . $row->tracking_no . '</td>' : '') . '
						<td>' . $row->ticketno . '</td>
						<td>' . $row->name . '</td>
						<td>' . (!empty($row->lead_stage_name) ? $row->lead_stage_name : 'NA') . ' <small>' . (!empty($row->description) ? '<br>' . $row->description : '') . '</small></td>
						<td>' . date('d-m-Y <br> h:i A', strtotime($row->coml_date)) . '</td>
						<th><a href="' . base_url('ticket/view/' . $row->ticketno) . '"><button class="btn btn-small btn-primary">View</button></a></th>
						</tr>';
					}
					$html .= '</table>';

					$data = array(
					'status' => '1',
					'problem_for' => $enq->enquiry_id,
					'name' => $res[0]->name,
					'email' => $res[0]->email,
					'phone' => $res[0]->phone,
					'html' => $html,
					);

					echo json_encode($data);

				}
				else
				{
					echo json_encode(array('status' => '0', 'html' => '0'));
				}
			} 
			else
			{
				echo json_encode(array('status' => '0', 'html' => '0'));
			}
		}
		else
		{
			echo json_encode(array('status' => '0', 'html' => '0'));
		}
	}
	public function ticket_load_data()
	{
		// $_POST = array('search'=>array('value'=>''),'length'=>10,'start'=>0);
		$this->load->model('Ticket_datatable_model');

		$res = $this->Ticket_datatable_model->getRows($_POST);
		//print_r($res); exit();
		$data  = array();

		$acolarr = array();
		$dacolarr = array();
		if (isset($_COOKIE["ticket_allowcols"])) {
			$showall = false;
			$acolarr  = explode(",", trim($_COOKIE["ticket_allowcols"], ","));
		} else {
			$showall = true;
		}
		if (isset($_COOKIE["ticket_dallowcols"])) {
			$dshowall = false;
			$dacolarr  = explode(",", trim($_COOKIE["ticket_dallowcols"], ","));
		} else {
			$dshowall = false;
		}

		foreach ($res as $point) {
			$sub = array();
			$sub[] = '<input type="checkbox" class="checkbox1" onclick="event.stopPropagation();" value="' . $point->id . '">';
			$sub[] = $point->id;
			if ($showall or in_array(1, $acolarr)) {
				$sub[] = '<a href="' . base_url('ticket/view/' . $point->ticketno) . '">' . $point->ticketno . '</a>';
			}

			if ($showall or in_array(2, $acolarr)) {
				$sub[] = $point->clientname ?? "NA";
			}

			if ($showall or in_array(3, $acolarr)) {
				$sub[] = $point->email ?? "NA";
			}

			if ($showall or in_array(4, $acolarr)) {
				if (user_access(220) && !empty($point->phone)) {
					$sub[] = "<a href='javascript:void(0)' onclick='send_parameters(" . $point->phone . ")'>" . $point->phone . "</a>";
				} else {
					$sub[] = $point->phone ?? "NA";
				}
			}

			//$sub[] = $point->phone??"NA";
			if ($showall or in_array(5, $acolarr)) {
				$sub[] = $point->country_name ?? "NA";
			}

			if ($showall or in_array(6, $acolarr)) {
				$sub[] = ($point->assign_to_name ?? "NA").$point->last_esc?'<small style="color:red;">'.$point->last_esc.'</small>':'';
			}

			if ($showall or in_array(17, $acolarr)) {
				$sub[] = $point->assigned_by_name ?? "NA";
			}

			if ($showall or in_array(7, $acolarr)) {
				$sub[] = $point->created_by_name ?? "NA";
			}
			if ($showall or in_array(8, $acolarr)) {
				$sub[] = '<span class="label label-' . ($point->priority == 1 ? 'success">Low' : ($point->priority == 2 ? 'warning">Medium' : 'danger">High')) . '</span>';
			}
			if ($showall or in_array(9, $acolarr)) {
				$sub[] = $point->coml_date ?? 'NA';
			}
			if ($showall or in_array(10, $acolarr)) {
				$sub[] = $point->referred_name ?? 'NA';
			}
			if ($showall or in_array(11, $acolarr)) {
				$sub[] = $point->source_name ?? 'NA';
			}
			if ($showall or in_array(12, $acolarr)) {
				$sub[] = $point->lead_stage_name ?? 'NA';
			}
			if ($showall or in_array(13, $acolarr)) {
				$sub[] = $point->description ?? 'NA';
			}

			if ($showall or in_array(14, $acolarr)) {
				$sub[] = $point->message == '' ? 'NA' : $point->message;
			}

			if ($this->session->companey_id == 65 && ($showall or in_array(15, $acolarr))) {
				$sub[] = $point->tracking_no == '' ? 'NA' : $point->tracking_no;
			}

			if ($showall or in_array(16, $acolarr)) {
				$sub[] = $point->status_name == '' ? 'NA' : $point->status_name;
			}

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
		if ($post = $this->input->post()) {
			if ($post['trackingno']) {
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, "https://thecrm360.com/new_crm/ticket/gc_vtrans_api/" . $post['trackingno']);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				$output = curl_exec($ch);

				curl_close($ch);

				if ($output == '') {
					echo '0';
					exit();
				}

				$a = json_decode($output);
				$table  = empty($a->Table) ? '' : $a->Table;
				$table1 = empty($a->Table1) ? '' : $a->Table1;
				$table2 = empty($a->Table2) ? '' : $a->Table2;
				$table3 = empty($a->Table3) ? '' : $a->Table3;

				if (isset($a->Table)) {
					echo '<table class="table table-bordered">
		        <tr><th colspan="4" style="text-align:center;">Tracking Number: ' . (empty($table->GCNO) ? '' : $table->GCNO) . '</td></tr>
		        <tr><th>Date:</th><td>' . (empty($table->GC_Date) ? '' : $table->GC_Date) . '</td><th>Status:</th><td>' . (empty($table->status) ? '' : $table->status) . '</td></tr>
		         <tr><th>Delivery Location:</th><td  colspan="3">' . (empty($table->DeliveryLocation) ? '' : $table->DeliveryLocation) . '</td></tr>
		         <tr><th>Delivery Branch:</th><td>' . (empty($table->DeliveryBranch) ? '' : $table->DeliveryBranch) . '</td><th>Booking Branch:</th><td>' . (empty($table->BookingBranch) ? '' : $table->BookingBranch) . '</td></tr>';
					if (sizeof((array)$table->EDD))
						echo ' <tr><th>EDD</th><td colspan="3">' . print_r($table->EDD) . '</td></tr>';

					echo '<tr><th>Delivery Date:</th><td>' . (empty($table->DeliveryDate) ? '' : $table->DeliveryDate) . '</td><th>Arrival Date:</th><td>' . (empty($table->ArrivalDate) ? '' : $table->ArrivalDate) . '</td></tr>
		         <tr><th>Delivery Type:</th><td>' . (empty($table->DeliveryType) ? '' : $table->DeliveryType) . '</td><th>CRNO:</th><td>' . (empty($table->CRNO) ? '' : $table->CRNO) . '</td></tr>
		        </table>';
				}

				if (isset($a->Table1)) {
					echo '<center style="color:red; padding:0px 0px 0px 10px; cursor:pointer;" onclick="$(this).hide(),$(\'.hiddenTrackingDetails\').show();">View More</center>
		        <div class="hiddenTrackingDetails" style="display:none;">
	        	<table class="table table-bordered">
		        	<tr><th colspan="4" style="text-align:center;">Branch Details</th></tr>
		        	<tr><th>Branch Name:</th><td>' . (empty($table1->Branch_Name) ? '' : $table1->Branch_Name) . '</td><th>Contact Person:</th><td>' . (empty($table1->Contact_Person) ? '' : $table1->Contact_Person) . '</td></tr>	
		        	<tr><th>Branch Address:</th><td colspan="3">' . (empty($table1->Address) ? '' : $table1->Address) . '</td></tr>
		        	<tr><th>City Name:</th><td>' . (empty($table1->City_name) ? '' : $table1->City_name) . '</td><th>Pincode:</th><td>' . (empty($table1->Pin_Code) ? '' : $table1->Pin_Code) . '</td></tr>
		        	<tr><th>STD Code:</th><td>' . (empty($table1->Std_Code) ? '' : $table1->Std_Code) . '</td><th>Mobile:</th><td>' . (empty($table1->mobileno) ? '' : $table1->mobileno) . '</td></tr>
		        	<tr><th>Phone No:</th><td>' . (empty($table1->phoneno) ? '' : $table1->phoneno) . '</td><th>Email:</th><td>' . (empty($table1->EMail_Id) ? '' : $table1->EMail_Id) . '</td></tr>
		        	<tr><th>Latitude:</th><td>' . (empty($table1->Latitude) ? '' : $table1->Latitude) . '</td><th>Longitude:</th><td>' . (empty($table1->Longitude) ? '' : $table1->Longitude) . '</td></tr>
	        	</table>';
				}

				if (isset($a->Table2)) {
					echo '<table class="table table-bordered">
		        	<tr><th colspan="4" style="text-align:center;">Delivery Details</th></tr>
		        	<tr><th>Branch Name:</th><td>' . (empty($table2->Branch_Name) ? '' : $table2->Branch_Name) . '</td><th>Contact Person:</th><td>' . (empty($table2->Contact_Person) ? '' : $table2->Contact_Person) . '</td></tr>	
		        	<tr><th>Branch Address:</th><td colspan="3">' . (empty($table2->Address) ? '' : $table2->Address) . '</td></tr>
		        	<tr><th>City Name:</th><td>' . (empty($table2->City_name) ? '' : $table2->City_name) . '</td><th>Pincode:</th><td>' . (empty($table2->Pin_Code) ? '' : $table2->Pin_Code) . '</td></tr>
		        	<tr><th>STD Code:</th><td>' . (empty($table2->Std_Code) ? '' : $table2->Std_Code) . '</td><th>Mobile:</th><td>' . (empty($table2->mobileno) ? '' : $table2->mobileno) . '</td></tr>
		        	<tr><th>Phone No:</th><td>' . (empty($table2->phoneno) ? '' : $table2->phoneno) . '</td><th>Email:</th><td>' . (empty($table2->EMail_Id) ? '' : $table2->EMail_Id) . '</td></tr>
		        	<tr><th>Latitude:</th><td>' . (empty($table2->Latitude) ? '' : $table2->Latitude) . '</td><th>Longitude:</th><td>' . (empty($table2->Longitude) ? '' : $table2->Longitude) . '</td></tr>
	        	</table>';
				}

				if (isset($a->Table3) && sizeof($table3) > 0) {
					echo '<table class="table table-bordered">
	        	<tr><th colspan="5" style="text-align:center;">Timeline</th></tr>
	        	<tr><th>From</th><th>To</th><th>Dep. Date</th><th>Arr. Date</th><th>Status</th></tr>
	        	';

					foreach ($table3 as $res) {
						echo '<tr>
	        				<td>' . (empty($res->From_Station) ? '' : $res->From_Station) . '</td>
	        				<td>' . (empty($res->To_Station ? '' : $res->To_Station)) . '</td>
	        				<td>' . (empty($res->Depature_Date) ? '' : $res->Depature_Date) . '</td>
	        				<td>' . (empty($res->Arrival_Date) ? '' : $res->Arrival_Date) . '</td>
	        				<td>' . (empty($res->Status_Name) ? '' : $res->Status_Name) . '</td>
	        			</tr>';
					}
					echo '</table>';
				}
				echo '</div>
		        ';
			}
		}
	}

	public function view1($tckt = "")
	{
		if (isset($_POST["reply"])) {
			$subject = $this->input->post("subjects", true);
			$message = $this->input->post("reply", true);
			$to = $this->input->post("email", true);
			$this->Message_models->send_email($to, $subject, $message);
			$this->Ticket_Model->saveconv();
			redirect(base_url("ticket/view/" . $tckt), "refresh");
		}
		if (isset($_POST["issue"])) {
			$this->Ticket_Model->updatestatus();
			redirect(base_url("ticket/view/" . $tckt), "refresh");
		}
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		if (empty($data["ticket"])) {
			show_404();
		}
		$data['title'] = "View ";
		//$data["problem"] = $this->Ticket_Model->getissues();
		$datexpressiona['problem'] = $this->Ticket_Model->get_sub_list();
		$data['content'] = $this->load->view('ticket/view-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
	function view($tckt = "")
	{

		$this->load->model('enquiry_model');

		$data = array();
		$data["ticket"] = $this->Ticket_Model->get($tckt);
		//print_r($data['ticket']); exit();
		if (empty($data['ticket'])) {
			show_404();
		}
		//print_r($data['ticket']);exit();	
		$match = array(
			'ticket_no' => $data['ticket']->ticketno,
			'tck.client' => $data['ticket']->client,
			'tck.tracking_no' => $data['ticket']->tracking_no,
			'tck.phone' => $data['ticket']->phone,
		);
		$data['related_tickets'] = $this->Ticket_Model->all_related_tickets($match);
		//print_r($data['related_tickets']); exit();
		$data["referred_type"] = $this->Leads_Model->get_referred_by();
		$data['all_description_lists']    =   $this->Leads_Model->find_description();

		$data["clients"] = $this->Ticket_Model->getallclient();

		$data["problem_for"] = $this->Ticket_Model->getclient($data['ticket']->client);
		//print_r($data['problem_for']); exit();

		$data['ticket_status'] = $this->Ticket_Model->ticket_status()->result();

		$data["product"] = $this->Ticket_Model->getproduct();
		//print_r($data['product']); exit();
		$data["conversion"] = $this->Ticket_Model->getconv($data["ticket"]->id);
		//print_r($data['conversion']); exit(); 
		$data['problem'] = $this->Ticket_Model->get_sub_list();

		$data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		//$data['data'] = $data;
		//echo $data["ticket"]->client;
		if (!$data["ticket"]->client)
			show_404();
		$this->load->model('enquiry_model');
		$data['enquiry'] = $this->enquiry_model->enquiry_by_id($data["ticket"]->client);

		$data['ticket_stages'] = $this->Leads_Model->find_estage($data['enquiry']->product_id, 4);
		$data['leadsource'] = $this->Leads_Model->get_leadsource_list();
		//print_r($data['leadsource']);	
		//print_r($data['ticket_stages']); exit();
		$this->load->model(array('form_model', 'dash_model', 'location_model'));
		$this->load->helper('custom_form_helper');

		$data['tab_list'] = $this->form_model->get_tabs_list($this->session->companey_id, 0, 2);

		$content	 =	$this->load->view('ticket/ticket_disposition', $data, true);
		$content    .=  $this->load->view('ticket/ticket_details', $data, true);
		$content    .=  $this->load->view('ticket/timeline', $data, true);

		$data['content'] = $content;
		$this->load->view('layout/main_wrapper', $data);
	}

	public function ticket_status($rule_ticket_status=0){
		$ticket_status = $this->Ticket_Model->ticket_status()->result();
		if(!empty($ticket_status)){
			foreach($ticket_status as $status)
			{ ?>
				<option value="<?=$status->id?>" <?=($status->id==$rule_ticket_status)?'selected':''?>><?php echo $status->status_name; ?></option>
			<?php
			}
		}
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

	public function ticket_disposition($ticketno)
	{
		//print_r($_POST); exit();
		$lead_stage	=	$this->input->post('lead_stage');
		$stage_desc	=	$this->input->post('lead_description');
		$stage_remark	=	$this->input->post('conversation');
		$client	=	$this->input->post('client');
		
		$stage_date = date("d-m-Y", strtotime($this->input->post('c_date')));
		$stage_time = date("H:i:s", strtotime($this->input->post('c_time')));

		$user_id = $this->session->user_id;
		$this->session->set_flashdata('SUCCESSMSG', 'Update Successfully');
		$this->Ticket_Model->saveconv($ticketno, 'Stage Updated', $stage_remark, $client, $user_id, $lead_stage, $stage_desc);




		$contact_person = '';
		$mobileno = '';
		$email = '';
		$designation = '';
		$enq_code = $this->input->post('ticketno');
		$notification_id = $this->input->post('dis_notification_id');
		$dis_subject = '';

		$this->Leads_Model->add_comment_for_events_popup($stage_remark, $stage_date, $contact_person, $mobileno, $email, $designation, $stage_time, $enq_code, $notification_id, $dis_subject, 17);
		$ticketno	=	$this->input->post('ticketno');
		$this->load->model('rule_model');
		$this->rule_model->execute_rules($ticketno, array(8));
		redirect('ticket/view/' . $ticketno);
	}

	public function assign_tickets()
	{

		if (!empty($_POST))
		{
			$move_enquiry = $this->input->post('tickets');
			//print_r($move_enquiry); exit();
			// echo json_encode($move_enquiry);
			$assign_employee = $this->input->post('epid');
			$notification_data = array();
			$assign_data = array();
			if (!empty($move_enquiry)) {
				foreach ($move_enquiry as $key)
				{
					$this->db->set('assign_to', $assign_employee);
					$this->db->set('assigned_by', $this->session->user_id);
					$this->db->where('id', $key);
					$this->db->update('tbl_ticket');
				}
				echo display('save_successfully');
			} 
			else 
			{
				echo display('please_try_again');
			}
		}
	}

	public function update_ticket($tckt = "")
	{
		//print_r($_POST); exit();
		if (isset($_POST["ticketno"])) {
			$_POST['relatedto'] = $_POST['issue'];
			$this->Ticket_Model->updatestatus();
			//echo $this->session->flashdata('message'); exit();
			//redirect(base_url("ticket/view/".$tckt), "refresh");

			$res = $this->Ticket_Model->save($this->session->companey_id, $this->session->user_id);

			if ($res) {
				$this->session->set_flashdata('message', 'Successfully Updated ticket');
				redirect(base_url('ticket/view/' . $tckt), "refresh");
				//echo'in';
			}
		}
		echo 'out';
	}
	public function edit($tckt = "")
	{

		if (isset($_POST["ticketno"])) {

			$res = $this->Ticket_Model->save($this->session->companey_id, $this->session->user_id);
			if ($res) {
				$this->session->set_flashdata('message', 'Successfully Updated ticket');
				redirect(base_url('ticket/edit/' . $tckt), "refresh");
			}
		}

		$data["ticket"] = $this->Ticket_Model->get($tckt);

		if (empty($data["ticket"])) {
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
		foreach ($this->input->post('ticket_list') as $key => $value) {
			$this->db->where('id', $value);
			$this->db->delete('tbl_ticket');
			$ret = $this->db->affected_rows();
			$this->db->where('tck_id', $value);
			$this->db->delete('tbl_ticket_conv');
		}
	}

	function tdelete()
	{

		$cnt = $this->input->post("content", true);

		$this->db->where('id', $cnt);
		$this->db->delete('tbl_ticket');
		$ret = $this->db->affected_rows();
		$this->db->where('tck_id', $cnt);
		$this->db->delete('tbl_ticket_conv');

		if ($ret) {

			$stsarr = array(
				"status" => "success",
				"message" => "Successfully deleted"
			);
		} else {
			$stsarr = array(
				"status" => "failed",
				"message" => "Failed to delete"
			);
		}
		die(json_encode($stsarr));
	}

	public function filter()
	{

		$pst = $this->input->post("top_filter", true);

		if ($pst == "created_today") {

			$where =  " tck.send_date = cast((now()) as date)";
		} else if ($pst == "updated_today") {

			$where =  " tck.last_update	 = cast((now()) as date)";
		} else if ($pst == "droped") {

			$where = array(" tck.status" => 3);
		} else if ($pst == "unread") {

			$where  =  "tck.status = 0";
		} else if ($pst == "all") {
			$where = false;
		} else {
			$where = false;
		}

		$tickets =  $this->Ticket_Model->filterticket($where);


		if (!empty($tickets)) {
			foreach ($tickets as $ind => $tck) {
?>
				<tr>
					<td><?php echo $ind + 1; ?></td>
					<td><?php echo $tck->ticketno; ?></td>
					<td><?php echo $tck->clientname; ?></td>
					<td><?php echo $tck->email; ?></td>
					<td><?php echo $tck->phone; ?></td>
					<td><?php echo $tck->product_name; ?></td>

					<td><?php echo $tck->category; ?></td>
					<td><?php
						if ($tck->priority == 1) {
						?><span class="badge badge-info">Low</span><?php
																} else if ($tck->priority == 2) {
																	?><span class="badge badge-warning">Medium</span><?php
																													} else if ($tck->priority == 2) {
																														?><span class="badge badge-danger">High</span><?php
																																									}

																																										?></td>
					<td><?php echo $tck->message; ?></td>
					<td><?php echo date("d, M, Y", strtotime($tck->send_date)); ?></td>
					<td style="min-width:125px;"><a class="btn  btn-success" href="<?php echo base_url("ticket/view/" . $tck->ticketno) ?>"><i class="fa fa-eye" aria-hidden="true"></i>
							<a class="btn  btn-default" href="<?php echo base_url("ticket/edit/" . $tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a class="btn  btn-danger delete-ticket" data-ticket="<?php echo $tck->id; ?>" href="<?php echo base_url("ticket/tdelete") ?>"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>

<?php

			}
		}
	}


	public function getmail()
	{

		$hostname =  '{imappro.zoho.com:993/imap/ssl}INBOX';
		$username = 'shahnawazbx@gmail.com';
		$password = 'BuX@76543210';
		$username = 'shahnawaz@archizsolutions.com';
		$password = 'Archiz321';
		echo "Hello 1";

		/* try to connect */
		$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

		echo "<pre>";
		print_r(imap_errors());
		echo "</pre>";
		echo imap_last_error();
		echo "Hello 2";
		/* grab emails */
		$emails = imap_search($inbox, 'ALL');

		/* if emails are returned, cycle through each... */
		if ($emails) {

			/* begin output var */
			$output = '';

			/* put the newest emails on top */
			rsort($emails);

			/* for every email... */
			foreach ($emails as $ind => $email_number) {

				if ($ind > 10) break;

				/* get information specific to this email */
				$overview = imap_fetch_overview($inbox, $email_number, 0);
				$message  = imap_fetchbody($inbox, $email_number, 1);
				echo "<pre>";
				print_r($message);
				echo "</pre>";

				$output .= 'Name:  ' . $overview[0]->from . '</br>';
				$output .= 'Email:  ' . $overview[0]->message_id . '</br>';
			}

			echo $output;
		}
		imap_close($inbox);
	}

	public function add()
	{
		$this->load->model('Enquiry_model');
		if (isset($_POST["client"])) {
			$res = $this->Ticket_Model->save($this->session->companey_id, $this->session->user_id);
			if ($res) {
				$this->load->model('rule_model');
				$this->rule_model->execute_rules($res, array(9));
				$this->session->set_flashdata('message', 'Successfully added ticket');
				redirect(base_url('ticket/view/' . $res));
			}
		}

		$data['title'] = "Add Ticket";
		$data['source'] = $this->Leads_Model->get_leadsource_list();
		$data["clients"] = $this->Enquiry_model->getEnquiry()->result();
		$data["product"] = $this->Ticket_Model->getproduct();
		$data["referred_type"] = $this->Leads_Model->get_referred_by();
		$data['problem'] = $this->Ticket_Model->get_sub_list();
		$data['issues'] = $this->Ticket_Model->get_issue_list();
		//$data["source"] = $this->Ticket_Model->getSource($this->session->companey_id);//getting ticket source list
		$data['content'] = $this->load->view('ticket/add-ticket', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}


	public function view_previous_ticket()
	{
		if ($post = $this->input->post()) {
			$no = $post['tracking_no'];
			$res = $this->Ticket_Model->filterticket(array('tracking_no' => $no));

			if ($res) {
				echo '<table class="table table-bordered">
				<tr>
				' . ($this->session->companey_id == 65 ? '<th>Tracking No</th>' : '') . '
				<th>Ticket Number</th>
				<th>Name</th>
				<th>Ticket Stage</th>
				<th>Created At</th>
				<th>Action</th>
				</tr>';
				foreach ($res as $row)
				{
				echo'<tr>
					'.($this->session->companey_id==65?'<td>'.(empty($row->tracking_no)?'NA':$row->tracking_no).'</td>':'').'
					<td>'.$row->ticketno.'</td>
					<td>'.$row->name.'</td>
					<td>'.(!empty($row->lead_stage_name)?$row->lead_stage_name:'NA').' <small>'.(!empty($row->description)?'<br>'.$row->description:'').'</small></td>
					<td>'.date('d-m-Y <br> h:i A',strtotime($row->coml_date)).'</td>
					<th><a href="'.base_url('ticket/view/'.$row->ticketno).'"><button class="btn btn-small btn-primary">View</button></a></th>
					</tr>';
				}
				echo '</table>';
			} else {
				echo '0';
			}
		}
	}

	public function loadinfo()
	{

		$usr = $this->input->post("clientno", true);

		$user = $this->db->select("*")->where("enquiry_id", $usr)->get("enquiry")->row();

		if (!empty($user)) {

			$jarr = array(
				"name"   => $user->name_prefix . " " . $user->name . " " . $user->lastname,
				"email"  => $user->email,
				"phone"  => $user->phone
			);

			die(json_encode($jarr));
		}
	}


	public function referred_by($id = 0)
	{

		$data['nav1'] = 'nav2';
		$data['title']    = display('Lead Details');
		$data['header'] = ($id ? ' Edit ' : ' Add ') . 'Referred By';
		$data['table'] = $this->Leads_Model->get_referred_by();
		if ($id) {
			$data['data'] = $this->Leads_Model->get_referred_by(array('id' => $id));
		}

		if ($_POST) {
			$_POST['company_id'] = $this->session->companey_id;
			$_POST['created_by'] = $this->session->userdata('user_id');
			$this->Leads_Model->save_referred_by($_POST, $id);
			redirect(base_url('ticket/referred_by/' . $id));
		}

		$data['content']  = $this->load->view('add_referred_by', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function delete_referred_by($id)
	{
		$this->Leads_Model->delete_referred_by($id);
		redirect(base_url('ticket/referred_by'));
	}

	public function remove_attachment($ticketno,$delete_key)
	{
		$res = $this->Ticket_Model->get($ticketno);
		if(!empty($res->attachment))
		{
			$att = json_decode($res->attachment);
			
			$del = $att[$delete_key];

			unset($att[$delete_key]);

			$att = json_encode(array_values($att));
			//json_encode($att); exit();
 			//print_r($att); exit();
 			if($del!='' && unlink(('uploads/ticket/'.$del)))
 			{
 				$this->db->set('attachment',$att);
 				$this->db->where('ticketno',$res->ticketno)->update('tbl_ticket');
 				redirect(site_url('ticket/view/'.$res->ticketno));
 			}
 			else
 			{
 				$this->session->set_flashdata('error','Unable to delete File');
 			}
		}
		

	}

	public function loadamc()
	{

		$prodno = $this->input->post("product", true);

		$enqno  = $this->input->post("client", true);

		$amcarr = $this->db->select("*")->where(array("product_name" => $prodno, "enq_id" => $enqno))->get("tbl_amc")->row();

		$amc = array();
		if (!empty($amcarr)) {

			$amcarr = array(
				"status" 	  => "found",
				"from_date"   => date("d, M Y ", strtotime($amcarr->amc_fromdate)),
				"to_date"     => date("d, M Y ", strtotime($amcarr->amc_todate))
			);
		} else {
			$amcarr = array("status" => "Not Found");
		}
		die(json_encode($amcarr));
	}

	public function loadoldticket($prd = "")
	{

		$data['oldticket'] = $this->db->select("tck.*,sour.lead_name as source_name,subj.subject_title as issue_name")
			->from("tbl_ticket as tck")
			->join("lead_source as sour", "tck.sourse=sour.lsid", "left")
			->join("tbl_ticket_subject as subj", "tck.issue=subj.id", "left")
			->where("tck.product", $prd)
			->where("tck.company", $this->session->companey_id)
			->get()->result();
		$this->load->view("ticket/page/tck-table", $data);
	}

	public function addproblems($prblm = "")
	{

		$this->saveticket();

		if (empty($prblm)) {

			$data['title'] = "Add Problems";
			$data["problem"] = $this->Ticket_Model->getissues();

			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
		} else {

			$data["eproblem"] = $this->db->select("*")->where("cmp", $this->session->companey_id)->where("id", $prblm)->get("tck_mstr")->row();

			$data['content'] = $this->load->view("ticket/page/problem-list", $data, true);
		}

		$this->load->view('layout/main_wrapper', $data);
	}

	public function saveticket()
	{

		if (isset($_POST["problem"])) {



			if (isset($_POST["problemno"])) {

				$updarr = array("title" 	=> $this->input->post("problem"),);
				$prblm  = $this->input->post("problemno", true);

				$this->db->where("id", $prblm);
				$this->db->update("tck_mstr", $updarr);
				$this->session->set_flashdata('message', 'Successfully Updated Problem');
				redirect(base_url("ticket/addproblems.html/"), "refresh");
			} else {
				$insarr = array(
					"title" 	=> $this->input->post("problem"),
					"cmp"   	=> $this->session->companey_id,
					"added_by"	=> $this->session->user_id
				);
				$this->db->insert("tck_mstr", $insarr);
				redirect(base_url("ticket/addproblems.html"), "refresh");
				$this->session->set_flashdata('message', 'Successfully added Problem');
			}
		}
	}
	public function add_subject()
	{
		$data['title'] = display('ticket_problem_master');
		$data['nav1'] = 'nav2';
		#------------------------------# 
		$leadid = $this->uri->segment(3);
		if (!empty($_POST)) {

			$reason = $this->input->post('subject');

			$data = array(
				'subject_title' => $reason,
				'comp_id' => $this->session->userdata('companey_id')
			);

			$insert_id = $this->Ticket_Model->add_tsub($data);

			redirect('ticket/add_subject');
		}

		$data['subject'] = $this->Ticket_Model->get_sub_list();

		$data['content'] = $this->load->view('ticket_subject', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}

	public function update_subject()
	{

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
	public function delete_subject($drop = null)
	{
		if ($this->Ticket_Model->delete_subject($drop)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('Ticket/add_subject');
	}
	public function gc_vtrans_api($gc_no)
	{
		$url = "http://203.112.143.175/VTWS/Service.asmx?wsdl";
		$soapclient = new SoapClient($url, array('UserName' => 'vtransweb', 'Password' => 'vt@2016'));
		$response = $soapclient->__soapCall('GetTrackNTraceData', array('parameters' => array('UserName' => 'vtransweb', 'Password' => 'vt@2016', 'Gc_No' => $gc_no)));
		$xml = $response->GetTrackNTraceDataResult->any;
		$response = simplexml_load_string($xml);
		$ns = $response->getNamespaces(true);
		$res = '';
		if (!empty($response->NewDataSet)) {
			$res = json_encode($response->NewDataSet);
		}
		echo $res;
	}

	public function Dashboard()
	{
		if (user_access(310)) {
			$data['title'] = 'Ticket Dashboard';
			$data['subject'] = $this->Ticket_Model->get_sub_list();

			$data['content'] = $this->load->view('ticket/dashboard', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		} else {
			redirect('dashboard');
		}
	}
	public function createddatewise()
	{

		$get = $this->Ticket_Model->getfistDate();
		$data = [];
		if (!empty($get)) {
			$date = date('Y-m-d', strtotime($get));
			$date2 = date('Y-m-d');
			$begin = new DateTime($date);
			$end   = new DateTime($date2);
			for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
				$idate = $i->format("Y-m-d");
				$isdate = strtotime($i->format("Y-m-d")) . '000';
				$count = $this->Ticket_Model->createddatewise($idate);
				$data[] = [(int)$isdate, $count];
			}
		}
		// print_r($data);
		echo json_encode($data);
	}
	public function referred_byJson()
	{
		$data = [];
		$refData = $this->Ticket_Model->refferedBy();
		foreach ($refData as $key => $value) {
			$count = $this->Ticket_Model->countrefferedBy($value->id);
			$data[] = ['name' => $value->name, 'value' => $count];
		}
		echo json_encode($data);
	}
	public function priority_wiseJson()
	{
		$low = $this->Ticket_Model->countPriority(1);
		$medium = $this->Ticket_Model->countPriority(2);
		$high = $this->Ticket_Model->countPriority(3);
		$data[] = ['name' => 'High', 'value' => $high];
		$data[] = ['name' => 'Medium', 'value' => $medium];
		$data[] = ['name' => 'Low', 'value' => $low];
		echo json_encode($data);
	}
	public function complaint_typeJson()
	{
		$complaint = $this->Ticket_Model->complaint_type(1);
		$query = $this->Ticket_Model->complaint_type(2);
		$data[] = ['name' => 'complaint', 'value' => $complaint];
		$data[] = ['name' => 'query', 'value' => $query];
		echo json_encode($data);
	}

	public function source_typeJson()
	{

		$getSourse = $this->Ticket_Model->getSourse(1);

		foreach ($getSourse as $key => $value) {
			$count = $this->Ticket_Model->countTSourse($value->lsid);

			$data[] = ['name' => $value->lead_name, 'value' => $count];
		}
		echo json_encode($data);
	}
	public function stage_typeJson()
	{
		$getSourse = $this->Ticket_Model->getSourse(4);
		foreach ($getSourse as $key => $value) {
			$count = $this->Ticket_Model->countTstage($value->stg_id);
			$data[] = ['name' => $value->lead_stage_name, 'value' => $count];
		}
		echo json_encode($data);
	}
	public function subsource_typeJson()
	{
		$subsource = $this->Ticket_Model->Subsource();
		foreach ($subsource as $key => $value) {
			$count = $this->Ticket_Model->countSubsource($value->id);
			$data[] = ['name' => $value->description, 'value' => $count];
		}
		echo json_encode($data);
	}

	public function autoticketAssign()
	{
		$fetchrules = $this->db->where(array('comp_id' => $this->session->companey_id, 'type' => 5))->order_by("id", "ASC")->get('leadrules')->result();
		foreach ($fetchrules as $key => $value) {
			$data = json_decode($value->rule_json);
			$stageId = $data->rules[0]->value;
			$substageId = $data->rules[1]->value;
			$rule_action = json_decode($value->rule_action);
			$esc_hr = $rule_action->esc_hr;
			$assign_to = $rule_action->assign_to;
			$leadtitle = $value->title;
			$lid = $value->id;
			$fetchTicket = $this->db->where(array('company' => $this->session->companey_id, 'ticket_stage' => $stageId))->get('tbl_ticket')->result();
			foreach ($fetchTicket as $key => $value2) {
				if ($value2->ticket_substage != NULL) {
					$subsource = $this->db->where(array('comp_id' => $this->session->companey_id, 'id' => $value2->ticket_substage))->get('lead_description')->row();
					if ($subsource->id != $substageId) {
						$coml_date = $value2->coml_date;
						$currentDate = date('Y-m-d H:i:s');
						$currentD = date('Y-m-d H:i');
						$time1 = strtotime($coml_date);
						$time2 = strtotime($currentDate);
						$hourTime = round(($time2 - $time1) / 60, 1);
						$tid = $value2->id;
						$nextAssignTimeF=$value2->nextAssignTime;
						if ($hourTime >= $esc_hr) {
							// user check
							// check office time
							
							$inTime='10:00';
							$outTime='18:00';
							$currentTime = date('H:i');
							$todayIntime=date('Y-m-d '.$inTime);

							$nextAssignment = date('Y-m-d H:i',strtotime($todayIntime . "+1 days"));
							if ($nextAssignTimeF <= $currentD OR $nextAssignTimeF!=NULL) {
								if ($currentTime >= $outTime ) {
									//if out is grater then check the holiday exist or not.
									//FETCH STATE AND CITY  from user table
									$userData=$this->db->get('tbl_admin')->row();
									$state_id=$userData->state_id;
									$city_id =$userData->city_id;
									if($state_id!=0 OR $city_id!=0){
										$gettholiday=$this->db->where(array('state'=>$state_id,'city'=>$city_id))
															  ->where('t_deadline >=',$nextAssignment)
															  ->where('t_deadline <=',$nextAssignment)
															  ->get('holidays');
										if ($gettholiday->num_rows()==1) {
												$getHoliday=$gettholiday->row();
												$dateFrom=$getHoliday->datefrom;
												$dateTo=$getHoliday->dateto;
												$days=$dateTo-$dateFrom;
												if($days==0){ $days=1; }
										        echo'Added next assignmnet time ';

												$nextAssignment = date('Y-m-d H:i',strtotime($todayIntime . "+".$days." days"));
												$this->Ticket_Model->insertNextAssignTime($assign_to,$nextAssignment,$tid);
										}else{
										//change next assign time and exit
										echo'Added next assignmnet time ';
										$this->Ticket_Model->insertNextAssignTime($assign_to,$nextAssignment,$tid);
										}
									}else{
										$todayIntime=date('Y-m-d '.$inTime);
										$nextAssignment = date('Y-m-d H:i',strtotime($todayIntime . "+1 days"));
										echo'Add next assignmnet time ';
										$this->Ticket_Model->insertNextAssignTime($assign_to,$nextAssignment,$tid);
									}
								 	}else{
										echo'Assign ticket to user';
										$this->Ticket_Model->insertData($assign_to, $tid, $lid);
									}
									}
							}
						}
					}
				}
			}
			//subsatge
		}
		// tat rule code start
		public function tat_run($comp_id){			
			$fetchrules = $this->db->where(array('comp_id' => $comp_id, 'type' => 5))->order_by("id", "ASC")->get('leadrules')->result();
			if(!empty($fetchrules)){
				foreach ($fetchrules as $key => $value) {
					$rule_action = json_decode($value->rule_action);
					$esc_hr = $rule_action->esc_hr;
					$assign_to = $rule_action->assign_to;
					$rule_title = $value->title;
					$lid = $value->id;					
					$this->db->where($value->rule_sql);					
					$tickets	=	$this->db->get('tbl_ticket')->result_array();					
					if(!empty($tickets)){
						foreach($tickets as $tck){
							if(!$this->Ticket_Model->is_tat_rule_executed($tck['id'],$lid)){
								$d = $tck['coml_date'];
								$currentDate = date('Y-m-d H:i:s');
								$bh	=	$this->isBusinessHr(new DateTime($currentDate));	
								if($bh){
									$created_date	=	$this->currect_created_date($d,$assign_to);								
									$working_hrs	=	$this->get_working_hours($created_date,$currentDate,$assign_to);
									if($working_hrs >= $esc_hr){
										$this->Ticket_Model->insertData($assign_to,$tck['id'],$lid,$rule_title,$comp_id,286);
										// 286 is bhavan user id
									}
								}
							}
						}
					}

				}
			}
		}
		public function currect_created_date($d,$uid){
			$is_bus_hr	=	$this->isBusinessHr(new DateTime($d));			
			if($is_bus_hr){
				$timeObject = new DateTime($d);
				$timestamp = $timeObject->getTimeStamp();
				$date1 = date('Y-m-d', $timestamp);					
				$time1 = date('H:i:s', $timestamp);								
				$is_working_day	=	$this->is_working_day($date1,$uid);				
				if($is_working_day){
					return $d;
				}else{
					$next_date = date('Y-m-d', strtotime($date1 .' +1 day'));					
					$next_date = $next_date.' 10:00:00';
					return $this->currect_created_date($next_date,$uid);					
				}
			}else{
				$wdate =	$this->get_working_date($d);			
				return $this->currect_created_date($wdate,$uid);				
			}
		}
		function is_working_day($d,$user){
			$hlist	=	$this->Ticket_Model->get_user_holidays($user);
			if(in_array($d,$hlist)){
				return false;
			}else{
				return true;
			}
		}
		

		function get_working_date($d){
						
			$timeObject = new DateTime($d);
			$timestamp = $timeObject->getTimeStamp();
			$act_time = date('H:i', $timestamp);			
			$act_date = date('Y-m-d', $timestamp);			
			if($act_time < '10:00'){
				$next_time = $act_date.' 10:00:00';
				
			}else if($act_time > '06:00') {
				$next_time = '';
				$next_date = date('Y-m-d', strtotime($act_date .' +1 day'));
				$next_time .= $next_date.' 10:00:00';
			}
			
			return $next_time;

		}

		function isBusinessHr($timeObject=0) {		

			$status = FALSE;
			$storeSchedule = [
				'Mon' => ['10:00 AM' => '09:00 PM'],				
				'Tue' => ['10:00 AM' => '09:00 PM'],
				'Wed' => ['10:00 AM' => '06:00 PM'],
				'Thu' => ['10:00 AM' => '06:00 PM'],
				'Fri' => ['10:00 AM' => '06:00 PM']
			];
		
			if(empty($timeObject)){
				$timeObject = new DateTime();
				$timestamp = $timeObject->getTimeStamp();
				$currentTime = $timeObject->setTimestamp($timestamp)->format('H:i A');
			}else{
				$timestamp = $timeObject->getTimeStamp();
				$currentTime = $timeObject->setTimestamp($timestamp)->format('H:i A');
			}
			
			// echo $currentTime.'<br>';
			 //echo date('D', $timestamp);
			// loop through time ranges for current day
			if(!empty($storeSchedule[date('D', $timestamp)])){				
				foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {		
					// create time objects from start/end times and format as string (24hr AM/PM)
					$startTime = DateTime::createFromFormat('h:i A', $startTime)->format('H:i A');
					$endTime = DateTime::createFromFormat('h:i A', $endTime)->format('H:i A');		
					// check if current time is within the range
					if (($startTime <= $currentTime) && ($currentTime <= $endTime)) {
						$status = TRUE;
						break;
					}
				}
			}
			return $status;
		}


		function get_working_hours($from,$to,$uid)
		{
			// timestamps
			$from_timestamp = strtotime($from);
			$to_timestamp = strtotime($to);

			// work day seconds
			$workday_start_hour = 10;
			$workday_end_hour = 21;
			$workday_seconds = ($workday_end_hour - $workday_start_hour)*3600;

			// work days beetwen dates, minus 1 day
			$from_date = date('Y-m-d',$from_timestamp);
			$to_date = date('Y-m-d',$to_timestamp);
			$workdays_number = count($this->get_workdays($from_date,$to_date,$uid))-1;
			$workdays_number = $workdays_number<0 ? 0 : $workdays_number;
			
			// echo $workdays_number.'<br>';

			// start and end time
			$start_time_in_seconds = date("H",$from_timestamp)*3600+date("i",$from_timestamp)*60;
			$end_time_in_seconds = date("H",$to_timestamp)*3600+date("i",$to_timestamp)*60;

			// final calculations
			$working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) / 86400 * 24;

			return $working_hours;
		}

		function get_workdays($from,$to,$uid) 
		{
			// arrays
			$days_array = array();
			$skipdays = array("Saturday", "Sunday");
			$skipdates = $this->get_holidays($uid);

			// other variables
			$i = 0;
			$current = $from;

			if($current == $to) // same dates
			{
				$timestamp = strtotime($from);
				if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
					$days_array[] = date("Y-m-d",$timestamp);
				}
			}
			elseif($current < $to) // different dates
			{
				while ($current < $to) {
					$timestamp = strtotime($from." +".$i." day");
					if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
						$days_array[] = date("Y-m-d",$timestamp);
					}
					$current = date("Y-m-d",$timestamp);
					$i++;
				}
			}

			return $days_array;
		}

		function get_holidays($uid) 
		{
			// arrays			
			$days_array = $this->Ticket_Model->get_user_holidays($uid);;

			// You have to put there your source of holidays and make them as array...
			// For example, database in Codeigniter:
			// $days_array = $this->my_model->get_holidays_array();

			return $days_array;
		}
		// tat code end
}
