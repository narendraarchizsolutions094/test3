<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ticket extends REST_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->library('form_validation');
	   $this->load->model(array('location_model','Ticket_Model'));
  }

  //api for providing ticket source Company Wise
  public function getTicketSource_post()
  {      
    $company_id  = $this->input->post('company_id');
    $this->load->model('Ticket_Model');
    $getList  = $this->Ticket_Model->getSource($company_id);
    if(!empty($getList))
    {
      $this->set_response([
      'status' => TRUE,            
      'ticketSourceList' => $getList
      ], REST_Controller::HTTP_OK);   
    }
    else
    {
      $this->set_response([
      'status'  => false,           
      'msg'     => "No ticket source found for company id you had provided"
      ], REST_Controller::HTTP_OK); 
    }
    
  }


  // api for ticket problem list Company Wise
  public function getProblemList_post()
  {      
    $company_id  = $this->input->post('company_id');
    $this->load->model('Ticket_Model');
    $getList  = $this->Ticket_Model->getIssuesByCompnyID($company_id);
    if(!empty($getList))
    {
      $this->set_response([
      'status' => TRUE,            
      'ticketProblemList' => $getList
      ], REST_Controller::HTTP_OK);   
    }
    else
    {
      $this->set_response([
      'status'  => false,           
      'msg'     => "No ticket Problem list found for company id you had provided"
      ], REST_Controller::HTTP_OK); 
    }
  }

  // api for ticket list Company Wise 
  public function getTicketList_post()
  {      
    $company_id   = $this->input->post('company_id');
    $user_id      = $this->input->post('user_id');
    $this->form_validation->set_rules('company_id','Company ID','trim|required',array('required'=>'You have note provided %s'));
    $this->form_validation->set_rules('user_id','User ID','trim|required',array('required'=>'You have note provided %s'));
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $getList  = $this->Ticket_Model->getTicketListByCompnyID($company_id,$user_id);
      if(!empty($getList))
      {
        $this->set_response([
        'status'      => TRUE,
        'count'       => count($getList),            
        'ticketList'  => $getList,
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "No ticket list found for company id you had provided"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $msg = strip_tags(validation_errors());
      $this->set_response([
        'status'  => false,
        'msg'     => $msg,//"Please provide a company id"
      ],REST_Controller::HTTP_OK);
    } 
  }
//api for view of create ticket form
  public function createTicketForm_post()
  {
    $this->load->model(array('Enquiry_model','Leads_Model'));

    $company_id   = $this->input->post('company_id');
    $process_id   = $this->input->post('process_id');
// $user_id      = $this->input->post('user_id');

    $this->session->companey_id = $company_id;

    $this->form_validation->set_rules('company_id','Company ID','trim|required',array('required'=>'You have note provided %s'));
    $this->form_validation->set_rules('process_id','Process ID','trim|required',array('required'=>'You have note provided %s'));


    if($this->form_validation->run() == true)
    {

      $primary_tab= $this->Ticket_Model->getPrimaryTab()->id;
     

      $basic= $this->location_model->get_company_list1_ticket($process_id);

      foreach ($basic as $key => $input)
      {
          switch($input['field_id'])
          { 
            case 15:
            $basic[$key]['input_values'] = array(1=>'Is Complaint',2=>'Is Query');
            break;

            case 16:
            $referred_by = $this->Ticket_Model->refferedBy();
            $values = array();
            foreach ($referred_by as $res)
            {
              $values[$res->id] = $res->name;
            }
            $basic[$key]['input_values'] = $values;
            break;

            case 17:
            $clients = $this->Enquiry_model->getEnquiry()->result();
            $values = array();
            foreach ($clients as $res)
            {
              $values[$res->enquiry_id] = $res->name." ".$res->lastname;
            }
            $basic[$key]['input_values'] = $values;
            break;

            case 21:
            $products = $this->Ticket_Model->getproduct();
            $values = array();
            foreach ($products as $res)
            {
              $values[$res->id] = $res->country_name;
            }
            $basic[$key]['input_values'] = $values;
            break;

            case 22:
            $problems = $this->Ticket_Model->get_sub_list();
            $values = array();
            foreach ($problems as $res)
            {
              $values[$res->id] = $res->subject_title;
            }
            $basic[$key]['input_values'] = $values;
            break;

            case 23:
            $natures = $this->Ticket_Model->get_issue_list();
            $values = array();
            foreach ($natures as $res)
            {
              $values[$res->id] = $res->title;
            }
            $basic[$key]['input_values'] = $values;
            break;

            case 24:
            $values = array(1=>'Low',2=>'Medium',3=>'High');
            $basic[$key]['input_values'] = $values;
            break;

            case 25:
            $source = $this->Leads_Model->get_leadsource_list();
            $values = array();
            foreach ($source as $res)
            {
              $values[$res->lsid] = $res->lead_name;
            }
            $basic[$key]['input_values'] = $values;
            break;

          }

      }

      $dynamic = $this->location_model->get_company_list($process_id,$primary_tab);

      $data = array_merge($basic,$dynamic);      

      session_destroy();

      if(!empty($data))
      {
        $this->set_response([
        'status'      => TRUE,          
        'data'  => $data, 
        
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "No Data Found"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $msg = strip_tags(validation_errors());
      $this->set_response([
        'status'  => false,
        'msg'     => $msg,//"Please provide a company id"
      ],REST_Controller::HTTP_OK);
    } 
  }


//api for creating new ticket
  public function createTicket_post()
  {      
    $company_id   = $this->input->post('company_id'); // mandatory to pass
    $user_id      = $this->input->post('user_id'); // mandatory to pass
    $this->form_validation->set_rules('company_id','Company','trim|required');
    $this->form_validation->set_rules('user_id','User','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $inserted  = $this->Ticket_Model->save($company_id,$user_id);
      //echo "string".$inserted;die;
      if(!empty($inserted))
      {
        $this->set_response([
        'status'   => TRUE,            
        'insertId' => $inserted,
        'msg'      => "ticket created successfully"
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "ticket not inserted something went wrong"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $this->set_response([
        'status'  => false,
        'msg'     => "Please Fill All Mandatory Fields"
      ],REST_Controller::HTTP_OK);
    } 
  }


/// api for updating an existing ticket
  public function updateTicket_post()
  {      
    //echo "string;";die;
    $company_id   = $this->input->post('company_id'); //mandatory to passs
    $user_id      = $this->input->post('user_id'); //mandatory to passs
    $ticketno     = $this->input->post('ticketno'); //mandatory to passs
    $this->form_validation->set_rules('company_id','Company','trim|required');
    $this->form_validation->set_rules('user_id','User','trim|required');
    $this->form_validation->set_rules('ticketno','Ticket','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $inserted  = $this->Ticket_Model->save($company_id,$user_id);
      if(!empty($inserted))
      {
        $this->set_response([
        'status'      => TRUE,            
        'insertId'    => $inserted,
        'msg'         => "ticket Updated successfully"
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "ticket not inserted something went wrong"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $this->set_response([
        'status'  => false,
        'msg'     => "Please Fill All Mandatory Fields"
      ],REST_Controller::HTTP_OK);
    } 
  }

//api to create ticket subject
  public function addSubject_post()
  {      
    //echo "string;";die;
    $company_id   = $this->input->post('company_id'); //mandatory to passs
    $user_id      = $this->input->post('user_id'); //mandatory to passs
    $subject      = $this->input->post('subject'); //mandatory to passs
    $this->form_validation->set_rules('company_id','Company','trim|required');
    //$this->form_validation->set_rules('user_id','User','trim|required');
    $this->form_validation->set_rules('subject','Subject','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $data = array(
          'subject_title' => $subject,
          'comp_id'       => $company_id
      );
      $inserted  = $this->Ticket_Model->add_tsub($data);
      if(!empty($inserted))
      {
        $this->set_response([
        'status'      => TRUE,            
        'insertId'    => $inserted,
        'msg'         => "Subject Added successfully"
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "Subject not inserted something went wrong"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $this->set_response([
        'status'  => false,
        'msg'     => "Please Fill All Mandatory Fields"
      ],REST_Controller::HTTP_OK);
    } 
  }

//subject list api
  public function subjectList_post()
  {      
    $company_id  = $this->input->post('company_id');
    $this->form_validation->set_rules('company_id','Company','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $getList  = $this->Ticket_Model->get_sub_list($company_id);
      if(!empty($getList))
      {
        $this->set_response([
        'status'      => TRUE,            
        'ticketList'  => $getList
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "No ticket list found for company id you had provided"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $this->set_response([
        'status'  => false,
        'msg'     => "Please provide a company id"
      ],REST_Controller::HTTP_OK);
    } 
  }

//delete subject api
  public function deleteSubject_post()
  {      
    $subjectid  = $this->input->post('subjectid');
    $this->form_validation->set_rules('subjectid','Subject ID','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $deletestatus  = $this->Ticket_Model->delete_subject($subjectid);
      if(!empty($getList))
      {
        $this->set_response([
        'status'      => TRUE,            
        'ticketList'  => $deletestatus
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "Subject not deleted"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $this->set_response([
        'status'  => false,
        'msg'     => "Please provide a valid id"
      ],REST_Controller::HTTP_OK);
    } 
  }


 public function getTicketTabs_post()
  {      
    $company_id   = $this->input->post('company_id');
    $ticketno      = $this->input->post('ticketno');

    $this->form_validation->set_rules('company_id','company_id','trim|required',array('required'=>'You have note provided %s'));
    $this->form_validation->set_rules('ticketno','ticketno','trim|required',array('required'=>'You have note provided %s'));

    if($this->form_validation->run() == true)
    {

      $data  = $this->Ticket_Model->ticket_all_tab_api($company_id,$ticketno);

      if(1)
      {
        $this->set_response([
        'status'      => TRUE,           
        'data'  => $data,
        ], REST_Controller::HTTP_OK);   
      }
      else
      {
        $this->set_response([
        'status'  => false,           
        'msg'     => "No Data found"
        ], REST_Controller::HTTP_OK); 
      }
    }
    else
    {
      $msg = strip_tags(validation_errors());
      $this->set_response([
        'status'  => false,
        'msg'     => $msg,//"Please provide a company id"
      ],REST_Controller::HTTP_OK);
    } 
  }


}
