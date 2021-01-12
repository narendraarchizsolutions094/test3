<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cron extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model(array(
        //     'appointment_model',
        //     'department_model'
        // ));
        if ($this->session->userdata('isLogIn') == false) 
        redirect('login'); 
    }
 
    public function index()
    { 
        $data['title'] = 'Cron Jobs';
        /* ------------------------------- */
        // $data['cron'] = $this->appointment_model->read();
        $data['content'] = $this->load->view('cron/cron-list',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    } 


    public function add()
    { 
        $data['title'] = 'Add New Cron';
        /* ------------------------------- */
        // $data['cron'] = $this->appointment_model->read();
        $data['content'] = $this->load->view('cron/add-cron',$data,true);
        $this->load->view('layout/main_wrapper',$data);
    } 

    
}