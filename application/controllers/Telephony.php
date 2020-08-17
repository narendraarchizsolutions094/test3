<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telephony extends CI_Controller {
    public function __construct() {
        parent::__construct();      
      
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }
    
    public function save_log(){
        $log    =   $this->input->post('log');
        $log_arr = explode('|', $log);
        $insert_arr = array(
                        'comp_id'=>$this->session->companey_id,
                        'mobile_no'=>$log_arr[1],
                        'agent_id'=>$this->session->telephony_agent_id,
                        'session_id'=>$log_arr[2],
                        'call_by'=>$this->session->user_id
                    );
        $this->db->insert('telephony_log',$insert_arr);
    }

    public function forword_to($phone){
        
        $this->db->select('enq.enquiry_id,enq.status');
        $this->db->where(array('enq.phone' => $phone,"usr.companey_id" => $this->session->companey_id ) );
		$this->db->from('enquiry enq');
		$this->db->join('tbl_admin usr', 'usr.pk_i_admin_id = enq.created_by', 'left');
        $row_array    =   $this->db->get()->row_array();        
      
        if(empty($row_array)){
            $url = 'enquiry/create?phone='.$phone;            
        }else{
            if($row_array['status'] == 1){
                $url= 'enquiry/view/'.$row_array['enquiry_id'];
            }else if($row_array['status'] == 2){
                $url= 'lead/lead_details/'.$row_array['enquiry_id'];             
            }else if($row_array['status'] == 3){
                $url= 'client/view/'.$row_array['enquiry_id'];
            }
        }
		
		
        redirect($url,'refresh');
        
    }
	
	public function mark_abilibality(){
        
        $atID   =   !empty($_POST['callbreakstatus'])?$_POST['callbreakstatus']:'';
        
        $user_id    =   $this->session->user_id;        
        
            $url = "https://developers.myoperator.co/user";
            $data = array(
            'token'=>$this->session->telephony_token,
            'receive_calls '=>$atID,
            'uuid'=>$this->session->telephony_agent_id
            );
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));   
            $response = curl_exec($ch);
            $user_id    =   $this->session->user_id;
            $this->db->set('availability',$atID);
            $this->db->where('pk_i_admin_id',$user_id);
            $this->db->update('tbl_admin');         
        
            unset($this->session->availability);
            $_SESSION['availability'] =  $atID;
            redirect('enq/index'); 
            // if($atID == 0){     
        //     echo json_encode(array('id'=>0,'status'=>$atID));
        // }else{
        //     echo json_encode(array('id'=>0,'status'=>$atID));           
        // }
    }

   public function get_call_status($uid=''){
		$newdata = array( 
        'uid_call'  =>str_replace('_','.',base64_decode($uid)), 
        );
		$where=' uid="'.str_replace('_','.',base64_decode($uid)).'" AND users!="" AND status=0 AND (cll_state=5 OR cll_state=3)';
		$this->db->select('users');
		$this->db->from('tbl_col_log');
		$this->db->where($where);
        $this->db->order_by('id','DESC');
        $res=$this->db->get()->row();
        if(!empty($res)){
         $array_users= json_decode($res->users);
		 $user_id='91'.$this->session->phone;
        if(in_array($user_id,$array_users)){
        echo '1';
        $this->session->set_userdata($newdata);   
        $this->db->set('status',1);
		$this->db->set('enq_id',$this->session->enq_id);
        $this->db->where('uid',str_replace('_','.',base64_decode($uid)));
        $this->db->update('tbl_col_log');
        }else{echo '2';  
        $this->session->unset_userdata($newdata);
	   }
        }else{  
        $this->session->unset_userdata($newdata);
            echo '2';
        }
    }
	
	public function get_in_status($uid=''){
		$newdata = array( 
        'uid_call'  =>str_replace('_','.',base64_decode($uid)), 
        );
		$where=' uid="'.str_replace('_','.',base64_decode($uid)).'" AND users!="" AND status=0 AND (cll_state=5 OR cll_state=3)';
		$this->db->select('users');
		$this->db->from('tbl_col_log');
		$this->db->where($where);
        $this->db->order_by('id','DESC');
        $res=$this->db->get()->row();
        if(!empty($res)){
         $array_users= json_decode($res->users);
		 $user_id='91'.$this->session->phone;
        if(in_array($user_id,$array_users)){
         echo '1';
        $this->session->set_userdata($newdata);   
        $this->db->set('status',1);
		//$this->db->set('enq_id',$this->session->enq_id);
        $this->db->where('uid',str_replace('_','.',base64_decode($uid)));
        $this->db->update('tbl_col_log');
        }else{echo '2';  
        $this->session->unset_userdata($newdata);
	   }
        }else{  
        $this->session->unset_userdata($newdata);
            echo '2';
        }
    }
	
	
	
	
    public function click_to_dial($phone='')
    {
    $phone           = '+91'.$phone;
    $token           = $this->input->post("token");
    $support_user_id = $this->session->telephony_agent_id;
    $curl = curl_init();
	curl_setopt_array($curl, array(  CURLOPT_URL => "https://obd-api.myoperator.co/obd-api-v1",
	CURLOPT_RETURNTRANSFER => true,  CURLOPT_CUSTOMREQUEST => "POST", 
	CURLOPT_POSTFIELDS =>'{  "company_id": "5f1545a391ac6734", 
	"secret_token": "ff0bda40cbdb92a4f1eb7851817de3510a175345a16c59a9d98618a559019f73", 
	"type": "1", 
    "user_id": "'.$support_user_id.'",
    "number": "'.$phone.'",   
    "public_ivr_id":"5f16e49954ad3197", 
    "reference_id": "",  
    "region": "",
    "caller_id": "",  
    "group": ""   }', 
    CURLOPT_HTTPHEADER => array(    "x-api-key:oomfKA3I2K6TCJYistHyb7sDf0l0F6c8AZro5DJh", 
    "Content-Type: application/json"  ),));
    $response = curl_exec($curl);
	print_r($response);
    }
	
	public function one_way_dial($phone='',$enq=''){
		$url = "http://developers.myoperator.co/call/one-way";
        $data = array(
        'token'=>$this->session->telephony_token,
        'customer_number'=>$phone,
        'customer_cc'=>91,
		'uuid'=>$this->session->telephony_agent_id
        );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
        print_r($response);
		if(!empty($enq)){
		 $res=$this->enquiry_model->getenq_by_id($enq);
		 if(!empty($res)){
			 $newdata = array('enq_id'=>$enq);
			 $this->session->set_userdata($newdata); 
			 $this->db->set('call_count',($res->call_count+1));
			 $this->db->where('enquiry_id',$enq);
			 $this->db->update('enquiry');
			 
		 }
		}
		
    }
	
	 public function hangup($uid='',$uri){
		$uid1=str_replace('_','.',$this->session->uid_call);
		//$this->load->library('user_agent');
		$url = "https://developers.myoperator.co/call/action";
        $data = array(
        'token'=>$this->session->telephony_token,
        'uid'=>$uid1,
        'action'=>'hangup',
         );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
		$this->session->unset_userdata('uid_call');
		$this->session->unset_userdata('enq_id');
        
        /*$agent = $this->request->getUserAgent();                
        if ($agent->isBrowser()){
            redirect($this->agent->referrer());
        }elseif ($agent->isMobile()){
            redirect('','refresh')
        }else{
        }*/
        $uri = base64_decode($uri);
        
        redirect($uri);
    }
	
	public function add_user($phone=''){
		$url = "http://developers.myoperator.co/call/one-way";
        $data = array(
        'token'=>$this->session->telephony_token,
        'customer_number'=>$phone,
        'customer_cc'=>91,
		'uuid'=>$this->session->telephony_agent_id
        );
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close( $curl );
        print_r($response);
    }
	
	
	public function user_list(){
		$all_user=array();
		$a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=23d43096026d5982b7ec873f920abe8a&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        } 
         $a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=74107b67bb340dbc8c6a566c4a717f6d&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        }
        $a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=a8974b7b3c644333c022e8e2211a8745&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        }
		
        $a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=2305577d659cbbde8331c3231f94fb35&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        }
        $a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=0bfe070ff5847ce58b4fc0567859dc7d&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        } 
         		
		$data['all_user']=$all_user;
        $data['content'] = $this->load->view('telephony/myoprater_user_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);		
    }
	public function inbound_list(){
		$all_user=array();
		$a=array('1','2','3','4','5');
		foreach($a as $v){
		$url = "https://developers.myoperator.co/user?token=f69449b6baf515f7312b0e489d67397c&&page-size=100&&page=".$v;
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $curl );
        curl_close($curl);
		array_push($all_user,array('user_data'=>json_decode($response)->data));
        }   		
		$data['all_user']=$all_user;
        $data['content'] = $this->load->view('telephony/myoprater_user_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);		
    }
	
	
	public function test(){
	$FIREBASE = "https://advance-crm-441ee.firebaseio.com/users.json";
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
      //  curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
		print_r($response);
		
		$FIREBASE = "https://advance-crm-441ee.firebaseio.com/reminders.json";
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
      //  curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
		print_r($response);
		
		$FIREBASE = "https://advance-crm-441ee.firebaseio.com/us.json";
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, $FIREBASE );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
      //  curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($curl);
        curl_close( $curl );
		print_r($response);
	}

    public function ameyo_api(){
        $ameyo_url    =   $this->input->post('ameyo_url');
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $ameyo_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Cookie: JSESSIONID=451E64BF7E8FFC80ACA818B68F8BE2DF; __METADATA__=772eb950-8910-456b-b35d-eee95f57dc1d"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

}
