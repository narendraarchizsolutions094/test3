<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Webhook extends REST_Controller {

    function __construct()
    {
        parent::__construct();
           $this->load->database();
           $this->load->library('form_validation');
           	
		$this->load->model(array(
			'enquiry_model','Leads_Model','location_model','Task_Model','User_model','Message_models','Client_Model'
		));
		
		$this->load->library('email'); 

   // $this->lang->load('notifications_lang', 'english');   

		
           $this->load->helper('url');
           $this->methods['users_get']['limit'] = 500; 
           $this->methods['users_post']['limit'] = 100; 
           $this->methods['users_delete']['limit'] = 50; 
        /*   header('Content-type: application/json');
        header('Access-Control-Allow-Origin', '*');
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Access-Control-Allow-Headers', 'Content-Type');*/
    }
    public function call_post(){
        $users='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data);
        $FIREBASE = "https://new-crm-f6355.firebaseio.com/";
        $uid=str_replace('.','_',$call_data_array->uid);
        $call_state=$call_data_array->call_state;
        if(!empty($call_data_array->users)){
        $users=$call_data_array->users;
        $this->db->set('users',$users);
        }
		
        $phone=$call_data_array->clid;
        $uid1=str_replace('.','_',$uid);
      //  $this->db->set('json_data',$call_data_array);
        $this->db->set('uid',$call_data_array->uid);
        $this->db->set('cll_state',$call_state);
        $this->db->set('phone_number',$phone);
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
      //  if($call_state=3 || $call_state=5){
		$NODE_PUT ="users/".$insert_id.".json";
        $data = array(
        'user_phone'=>$phone,
        'uid'=>$uid,
        'users'=>$users
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
		///
    }
    
	public function in_call_post(){
        $users='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data);
        $FIREBASE = "https://new-crm-f6355.firebaseio.com/";
        $uid=str_replace('.','_',$call_data_array->uid);
        $call_state=$call_data_array->call_state;
        if(!empty($call_data_array->users)){
        $users=$call_data_array->users;
        $this->db->set('users',$users);
        }
		
        $phone=$call_data_array->clid;
        $uid1=str_replace('.','_',$uid);
      //  $this->db->set('json_data',$call_data_array);
        $this->db->set('uid',$call_data_array->uid);
        $this->db->set('cll_state',$call_state);
        $this->db->set('phone_number',$phone);
        $this->db->insert('tbl_col_log');
        $insert_id = $this->db->insert_id();
        if($call_state=3 || $call_state=5){
		$NODE_PUT ="us/".$insert_id.".json";
        $data = array(
        'user_phone'=>$phone,
        'uid'=>$uid,
        'users'=>$users
        );
        $json = json_encode($data );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
		///
		}
    }
    
     public function after_call_post(){
        $agent_id='';
        $call_data = $_POST['myoperator'];
        $call_data_array = json_decode($call_data, true);
		        $agentname=$agenphone='';
				if(!empty($call_data_array['_ld']['_rr']['_na'])){ $agentname=$call_data_array['_ld']['_rr']['_na'];}
				if(!empty($call_data_array['_ld']['_rr']['_ct'])){ $agenphone=$call_data_array['_ld']['_rr']['_na'];}
			    //$agentname=$call_data_array['_ld']['_rr']['_na'];
				$this->db->set('recived_by',$agenphone);
				$this->db->set('recived_name',$agentname);
				$this->db->set('customer_phone',$call_data_array['_cr']);
				$this->db->set('call_status',$call_data_array['_su']);
				$this->db->set('event_type',$call_data_array['_ev']);
				$this->db->set('json_data',$call_data); 
				$this->db->insert('tbl_col_log2'); 
		
    }

}