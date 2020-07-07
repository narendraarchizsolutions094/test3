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
    $company_id  = $this->input->post('company_id');
    $this->form_validation->set_rules('company_id','Company','trim|required');
    if($this->form_validation->run() == true)
    {
      $this->load->model('Ticket_Model');
      $getList  = $this->Ticket_Model->getTicketListByCompnyID($company_id);
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
        'msg'         => "ticket created successfully"
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


}
