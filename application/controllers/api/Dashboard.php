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
}