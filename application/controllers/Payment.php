<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function __construct(){		
		parent::__construct();
		$this->load->model('Payment_model');
	}
  public function payment_response(){
  }
  public function payment_webhook(){  
  }
  public function payment_success(){	   
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $data['res'] = $_POST;
		$this->template->render('payment/payment_success',$data);
  }
  public function payment_failed(){	   
    $data['res'] = $res = $_POST;
    $ins_arr = array(
                'uid'   => $this->session->user_id,
                'status'=> $res['status'],
                'txnid' => $res['txnid'],
                'amount'=> $res['amount'],
                'response'   => json_encode($res)
              );
    $this->Payment_model->save_payment_response($ins_arr);
		$this->load->view('payment/order-fail',$data);
  }  
  public function payumoney() {
    $data['title'] = 'Payment';
    $data['content'] = $this->load->view('payment/payment-form', $data);
    $this->load->view('layout/main_wrapper', $data);
  }
}
?>