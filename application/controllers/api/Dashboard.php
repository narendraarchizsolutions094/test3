<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Dashboard extends REST_Controller {
    function __construct(){
        parent::__construct();
    }
    public function dashboard_post()
    {
        $user_id = $this->input->post('user_id');
        $company_id = $this->input->post('company_id');
        $process_id =  $this->input->post('process_id');//can be multiple
        if(!empty($process_id))
        {
            $process = implode(',',$process_id);
        }

        $this->load->model('enquiry_model');
        $funneldata = $this->enquiry_model->all_enqueries_api($user_id,$company_id,$process);
        $this->set_response([
            'status' => TRUE,            
            'funneldata' => $funneldata
        ], REST_Controller::HTTP_OK);        
    }
    public function ticket_dashboard_post()
    {


        $user_id = $this->input->post('user_id');
        $company_id = $this->input->post('company_id');
        $process =  $this->input->post('process');//can be multiple

        $this->form_validation->set_rules('user_id','user_id', 'trim|required');
        $this->form_validation->set_rules('company_id','company_id', 'trim|required');
        $this->form_validation->set_rules('process','process', 'trim|required');
        if($this->form_validation->run()==true)
        {
            $this->load->model('Ticket_Model');

           $res =  $this->Ticket_Model->TicketDashboard($user_id,$company_id,$process);

           if(!empty($res))
           {
             $this->set_response([
                'status' => TRUE,            
                'data' => $res
            ], REST_Controller::HTTP_OK); 
           }
           else
           {
             $this->set_response([
                'status' => FALSE,            
                'message' => 'Unable to Find'
            ], REST_Controller::HTTP_OK); 
           }

        }
        else
        {
                $this->set_response([
                'status' => FALSE,            
                'message' => strip_tags(validation_errors()),
            ], REST_Controller::HTTP_OK); 
        }
    }
}