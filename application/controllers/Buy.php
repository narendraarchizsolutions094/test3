<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Buy extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'Product_model'
        ));
		$this->load->model("sell_model");
		$this->load->library('cart');
    }
	
	public function index(){
		
		$data['title'] = 'Product List';
		
		$data['product_list'] = $this->Product_model->productdetlist();
		$data['category'] = $this->sell_model->getCategory();
		$carts = $this->cart->contents();
		
		$prodcart = array();
		if(!empty($carts)){
			foreach($carts as $ind =>$crd) {
				
				$prodid = $crd['id'];
				$prodcart[$prodid]	= $crd['qty'];
			}
			
		}
		
		$data['incart']  = $prodcart;
		$data['content'] = $this->load->view('sell/product-list', $data, true);
        $this->load->view('layout/buy_wrapper', $data);
		
	}
	public function addtocart(){
		
		$this->form_validation->set_rules("product", "Product", "trim|required");
		
		if($this->form_validation->run()){
			
			$cardcontent = $this->cart->contents();
			
			$prodno  = $this->input->post("product", true); 
			$pqty    = $this->input->post("qty", true);   
			$product = $this->Product_model->productdet($prodno) ;
			
			$data = array('id'      => $prodno,
							'qty'       => 1,
							'price'     => $product->total_price,
							'name'		=> $product->country_name,
							'discount'  => 0
							);
			$newcart = array();	
			$tqty = $qty  = 1;
			if(!empty($cardcontent)){
				
				$isupdate = false;
				foreach($cardcontent as $ind => $crt){
					
					if($crt['id'] == $prodno){
						
						$qty 		=   $crt['qty'];
						$tqty       = $qty;
						$rowid      = $crt['rowid'];
						$isupdate   = true;
						
					}
					
				}
				
		
				
				if($isupdate == true) {
						
						$data = array('rowid' => $rowid,
								  'qty'   => $qty + $pqty
									);
					
					
					
					$status = 2;				
					$this->cart->update($data);			
				}else{
					$status = 1;	
					//$prdarr["total"] = count($cardcontent) + 1;
					$this->cart->insert($data);
				}
				$cardcontent = $this->cart->contents();
				$prdarr = array("status" => $status,"prodid" => $prodno, "product" => $product->country_name, "price" => $product->total_price, "qty" => $qty + $pqty,"total" => count($cardcontent));
				
			}else{
				
		
				$prdarr = array("status" => 1,"prodid" => $prodno, "product" => $product->country_name, "price" => $product->total_price, "qty" => $data['qty'],"total" => count($cardcontent) + 1);
				$this->cart->insert($data);	
			}				
						
			
		}else{
			
				$prdarr = array("status" => 0,"message" => "Failed to add cart");
			
		}
		
	
		die(json_encode($prdarr));	

	}
	
}