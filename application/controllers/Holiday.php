<?php

class Holiday extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		 $this->load->model(array(
            'location_model','User_model','Holiday_Model'
        ));
	}

	public function index()
	{

		if($_POST)
		{
			$this->Holiday_Model->add_holiday($_POST);
		}

        $data['title'] = "Add Holiday";

		$data['user_list'] = $this->User_model->companey_users();
		$data['festivals']  = $this->Holiday_Model->getFestival();
		$data['country'] = $this->location_model->country();
		$data['holiday_table'] = $this->Holiday_Model->holiday_table();
		
		$data['content'] = $this->load->view('add-holiday', $data, true);
		
		$this->load->view('layout/main_wrapper', $data);
	}
	public function add_festival()
	{
		$this->load->model('User_model');
		$this->load->model('Holiday_Model');
		if($_POST)
		{
			$this->Holiday_Model->add_festival($_POST);
			redirect(base_url('Holiday/add-festival'));
		}


        $data['title'] = "Add Festival";

		$data['user_list'] = $this->User_model->companey_users();
		$data['festivals']  = $this->Holiday_Model->getFestival();
		$data['content'] = $this->load->view('add-festival', $data, true);
		
		$this->load->view('layout/main_wrapper', $data);
	}

}