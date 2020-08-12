<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buy extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'Product_model'
        ));
		$this->load->model("sell_model");
    }
	
	public function index(){
		
		$data['title'] = 'Product List';
		
		$data['product_list'] = $this->Product_model->productdetlist();
		$data['category'] = $this->sell_model->getCategory();
	
		$data['content'] = $this->load->view('sell/product-list', $data, true);
        $this->load->view('layout/buy_wrapper', $data);
		
	}
	
	
}