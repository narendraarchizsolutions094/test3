<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leadscorerule extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->helper('date');
        $this->load->model(
                array('Leads_Model','common_model','enquiry_model', 'dashboard_model', 'Task_Model', 'User_model', 'location_model', 'Message_models','Institute_model','Datasource_model','Taskstatus_model','dash_model','Center_model','SubSource_model','Kyc_model','Education_model','SocialProfile_model','Closefemily_model','Doctor_model','form_model','warehouse_model')
                );
        if (empty($this->session->user_id)) {
            redirect('login');
        }
    }



    public function index() {
        $aid = $this->session->userdata('user_id');
        $data['fields'] = array();
        $data['leaddata'] = $this->db->select('*')->from("leadrules")->where("comp_id",$this->session->companey_id)->get()->result_array();
        $table = '<table width="100%" class="datatable table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                  <th>Field</th>
                  <th>Condition</th>
                  <th>Value</th>
                  <th>Lead Score</th>
                </tr>
            </thead>

            <tbody>';
              foreach ($data['leaddata'] as $k) 
              { 
                $fieldary = explode(" ", $k['rule']);
                $table.='<tr>
                            <td>'.$fieldary[0].'</td>
                            <td>'.$this->getOperator($fieldary[1]).'</td>
                            <td>'.$fieldary[2].'</td>
                            <td>'.$k['lead_score'].'</td>
                        </tr>  ';
              }

              
            $table.='</tbody>
            
          </table>';
          $data['table'] = $table;
        $data['content'] = $this->load->view('leadscorerule', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function getOperator($condition)
    {
        if($condition == "LIKE %")
        {   
            $name = "Start With";
            return $name;
        }
        else if($condition == "=")
        {   
            $name = "Is";
            return $name;
        }
        else if($condition == ">")
        {   
            $name = "Is Greater Than";
            return $name;
        }
        else if($condition == "<")
        {   
            $name = "Is Less Than";
            return $name;
        }

    }


    public function saveRule()
    {
        //print_r($_POST);die;
        if(isset($_POST['fname']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "name ".$this->input->post('namecondition').' '.$this->input->post('fname'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("nameaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['subs']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "subsrc ".$this->input->post('subscondition').' '.$this->input->post('lname'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("subsaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['process']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "process ".$this->input->post('procondition').' '.$this->input->post('process'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("processaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['gender']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "gender ".$this->input->post('gendercondition').' '.$this->input->post('gender'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("genderaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['product']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "product ".$this->input->post('productcondition').' '.$this->input->post('product'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("productaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['enqs']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "enquiry_source ".$this->input->post('sourcecondition').' '.$this->input->post('enqs'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("enqsaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['state']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "state_id ".$this->input->post('statecondition').' '.$this->input->post('state'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("stateaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['city']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "city_id ".$this->input->post('citycondition').' '.$this->input->post('city'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("cityaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }
        if(isset($_POST['country']))
        {
            $data = array(
                "comp_id"   => $this->session->companey_id,
                "rule"      =>  "country_id ".$this->input->post('countrycondition').' '.$this->input->post('country'),
                "created_by"=> $this->session->user_id,
                "lead_score" => $this->input->post("countryaction"),
                "created_date"=> date("y-m-d H:i:s")
            );
            $this->db->insert('leadrules',$data);
        }


        redirect('Leadscorerule');

    }


    
	
	
}