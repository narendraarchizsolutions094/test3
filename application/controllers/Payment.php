<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function __construct(){		
		parent::__construct();
    $this->load->model('Payment_model');
		$this->load->model('user_model');
    if (empty($this->session->user_id)) {
        redirect('login');
    }
	}  
  public function index(){
    $data = array();
    $this->load->view('payment/payment-pending',$data);        
  }
  public function payment_success(){	       
    $data['res'] = $res = $_POST;
    $ins_arr = array(
                'uid'   => $this->session->user_id,
                'status'=> $res['status'],
                'txnid' => $res['txnid'],
                'amount'=> $res['amount'],
                'response'   => json_encode($res)
              );    
    if ($res['status'] == 'success') {
      $this->user_model->set_user_meta($this->session->user_id,array('payment_status'=>1));
    }
    if(!$this->db->where('txnid',$ins_arr['txnid'])->from('payment_history')->count_all_results()){      
      $this->Payment_model->save_payment_response($ins_arr);          
    }    
		$this->load->view('payment/order-success',$data);    
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
    if(!$this->db->where('txnid',$ins_arr['txnid'])->from('payment_history')->count_all_results()){      
      $this->Payment_model->save_payment_response($ins_arr);          
    }
		$this->load->view('payment/order-fail',$data);    
  }  
  public function payumoney() {
    $data['title'] = 'Payment';
    $data['content'] = $this->load->view('payment/payment-form', $data);
    $this->load->view('layout/main_wrapper', $data);
  }
}
?>