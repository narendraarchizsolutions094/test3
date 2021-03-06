<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'report_model',
            'doctor_model', 
            'representative_model',
            'user_model',
            'Leads_Model',
            'dash_model',
            'location_model'
        ));
        $this->load->library('pagination');
    }
        public function index(){
          if (user_role('120') == true) {}
            $data['title'] = display('reports_list');
            $data['reports'] = $this->report_model->get_all_reports();
            $data['content'] = $this->load->view('reports/index', $data, true);        
            $this->load->view('layout/main_wrapper', $data);
        }
        public function view($id){ 
          if (user_role('120') == true) {}
            $data['rid'] = $id;
            $this->session->set_userdata('reportid',$id);
            $this->db->where('id',$id);
            $report_row =   $this->db->get('reports')->row_array();             
            $filters = json_decode($report_row['filters'],true); 
            $from = $this->session->set_userdata('fromdt',$this->input->post("from"));
            $to =  $this->session->set_userdata('todt',$this->input->post("to"));                                         
            $data['title'] = 'View Report';
            $data['filters'] = $filters;
            $data['report_columns'] = $filters['report_columns'];
            $data["fieldsval"]        = $this->report_model->getdynfielsval();  
            $data["dfields"] = $this->report_model->get_dynfields("");
            $data['content'] = $this->load->view('reports/report_view', $data, true);        
            $this->load->view('layout/main_wrapper', $data);
        }
         public function report_view_data(){
            if (user_role('120') == true) {}
             $fieldsval  = $this->report_model->getdynfielsval();  
             $dfields    = $this->report_model->get_dynfields("");
            $this->load->model('report_datatable_model');            
            $no = $_POST['start'];
            $this->db->where('id',$this->session->userdata('reportid'));
            $report_row =   $this->db->get('reports')->row_array();             
            $filters = json_decode($report_row['filters'],true);  
            $filters1 = $filters;
            $report_columns = $filters1['report_columns'];      
         
            $data['from'] = '';
            $data['to'] = '';
            
            $from = $this->session->userdata('fromdt');
            $to =  $this->session->userdata('todt');
            
            if($from && $to){
                $from = date("d/m/Y", strtotime($from));
                $to = date("d/m/Y", strtotime($to)); 
            }else{                
                if(empty($filters['from_exp'])){
                    $from ='';  
                }else{
                    $dfrom= $filters['from_exp'];
                    $from = date("d/m/Y", strtotime($dfrom));
                    $from1= $filters['from_exp'];
                    $data['from'] = $from1;
                }
                if(empty($filters['to_exp'])){
                    $to ='';
                }else{
                   $tto= $filters['to_exp'];
                   $to = date("d/m/Y", strtotime($tto)); 
                   $to1= $filters['to_exp'];
                    $data['to'] = $to1;
                }
            }
            $updated_from = $this->session->userdata('updated_from1');
            $updated_to =  $this->session->userdata('updated_to1');
            
            if($updated_from && $updated_to){
                $updated_from = date("d/m/Y", strtotime($updated_from));
                $updated_to = date("d/m/Y", strtotime($updated_to)); 
            }else{                
                if(empty($filters['updated_from_exp'])){
                    $updated_from ='';  
                }else{
                    $updated_dfrom= $filters['updated_from_exp'];
                    $updated_from = date("d/m/Y", strtotime($updated_dfrom));
                    $updated_from1= $filters['updated_from_exp'];
                    $data['updated_from'] = $updated_from1;
                }
                if(empty($filters['updated_to_exp'])){
                    $updated_to ='';
                }else{
                   $updated_tto= $filters['updated_to_exp'];
                   $updated_to = date("d/m/Y", strtotime($updated_tto)); 
                   $updated_to1= $filters['updated_to_exp'];
                    $data['updated_to'] = $updated_to1;
                }
            }
            if(empty($filters['employee'])){
                $employe ='';
            }else{
               $employe= $filters['employee'];
            }
            if(empty($filters['phone'])){
                $phone ='';
            }else{
               $phone= $filters['phone'];
            }
            if(empty($filters['country'])){
                $country ='';
            }else{
               $country= $filters['country'];
            }
            if(empty($filters['institute'])){
                $institute ='';
            }else{
               $institute= $filters['institute'];
            }
            if(empty($filters['center'])){
                $center ='';
            }else{
               $center= $filters['center'];
            }
            if(empty($filters['source'])){
                $source ='';
            }else{
               $source= $filters['source'];
            }
            if(empty($filters['subsource'])){
                $subsource ='';
            }else{
               $subsource= $filters['source'];
            }
            if(empty($filters['datasource'])){
                $datasource ='';
            }else{
               $datasource= $filters['datasource'];
            }
            if(empty($filters['state'])){
                $state ='';
            }else{
               $state= $filters['state'];
            }
            if(empty($filters['lead_source'])){
                $lead_source = '';
            }else{
               $lead_source = $filters['lead_source'];
            }            
            if(empty($filters['lead_subsource'])){
                $lead_subsource = '';
            }else{
               $lead_subsource = $filters['lead_subsource'];
            }
            if(empty($filters['enq_product'])){
                $enq_product = '';
            }else{
               $enq_product = $filters['enq_product'];
            }
            if(empty($filters['drop_status'])){
                $drop_status = '';
            }else{
               $drop_status = $filters['drop_status'];
            }            
            if(empty($filters['all'])){ // follow up report
                $all = '';
            }else{
               $all = $filters['all'];
            }
            $rep_details = $this->report_datatable_model->get_datatables($from,$to,$updated_from,$updated_to,$employe,$phone,$country,$institute,$center,$source,$subsource,$datasource,$state,$lead_source,$lead_subsource,$enq_product,$drop_status,$all);
            $i=1;
            $data = array();
           foreach ($rep_details as  $repdetails) {
              
            $no++;
            $row = array(); 
        
             if (in_array('S.No', $report_columns)){
                $row[] = $i++;
             }
             if (in_array('Name', $report_columns)) { 
              $row[] = $repdetails->name_prefix . " " . $repdetails->name . " " . $repdetails->lastname;
              }
              if (in_array('Phone', $report_columns)) {
                  if (user_access(450)) {
                    $row[] = '##########';                    
                  }else{
                    $row[] = $repdetails->phone;
                  }
              }
              if (in_array('Email', $report_columns)){
                $row[] = $repdetails->email;
              }
              if (in_array('Created By', $report_columns)) {
                $row[] = $repdetails->created_by_name;
              }
              if (in_array('Assign To', $report_columns)){
                $row[] = (!empty($repdetails->assign_to_name))?$repdetails->assign_to_name:'NA'; 
              }
              if (in_array('Gender', $report_columns)) {
                 if ($repdetails->gender == 1) {
                 $gender = 'Male';
                } else if ($repdetails->gender == 2) {
                $gender = 'Female';
                } else {
                $gender = 'Other';
                }
                $row[] = $gender;
              }
              if (in_array('Source', $report_columns)) {
                $row[] = (!empty($repdetails->lead_name))?$repdetails->lead_name:'NA';
              }
              if (in_array('Subsource', $report_columns)){
                $row[] = (!empty($repdetails->subsource_name)) ? $repdetails->subsource_name:'NA'; 
              }
               if (in_array('Disposition', $report_columns)){
                  $row[] = (!empty($repdetails->followup_name)) ? $repdetails->followup_name:'NA';
               }
              if (in_array('Lead Description', $report_columns)){
                $row[] = (!empty($repdetails->description)) ? $repdetails->description :"NA"; 
              }
              if (in_array('Disposition Remark', $report_columns)){
                $row[] = (!empty($repdetails->lead_discription_reamrk)) ? $repdetails->lead_discription_reamrk :"NA"; 
              }
              if (in_array('Drop Reason', $report_columns)){
                $row[] = (!empty($repdetails->drop_status)) ? $repdetails->drop_status :"NA"; 
              }
              if (in_array('Drop Comment', $report_columns)){
                $row[] = (!empty($repdetails->drop_reason)) ? $repdetails->drop_reason :"NA"; 
              }
              if (in_array('Conversion Probability', $report_columns)){
                $row[] = (!empty($repdetails->lead_score)) ? $repdetails->lead_score :"NA"; 
              }
              if (in_array('Remark', $report_columns)){
                $row[] = (!empty($repdetails->enq_remark)) ? $repdetails->enq_remark :"NA"; 
              }              
                          
              if (in_array('Status', $report_columns)) {
                 if ($repdetails->status == 1) {
                 $status = 'Enquiry';
                 } else if ($repdetails->status == 2) {
                 $status = 'Lead';
                 } else {
                 $status = 'Client';
                 }
                 $row[] = $status;
              }
               if (in_array('DOE', $report_columns)) {
                $row[] = $repdetails->inq_created_date;
               }
               if (in_array('Process', $report_columns)) {
               $row[] =  (!empty($repdetails->product_name)) ?$repdetails->product_name:'NA'; 
               }
               if (in_array('Updated Date', $report_columns)){
                $row[] = $repdetails->update_date; 
               }
               if (in_array('State', $report_columns)){
                  $row[] = (!empty($repdetails->state_name)) ? $repdetails->state_name:'NA';
               }
                if (in_array('City', $report_columns)){
                  $row[] = (!empty($repdetails->city_name)) ? $repdetails->city_name:'NA';
               }
               if (in_array('Company Name', $report_columns)){
                  $row[] = (!empty($repdetails->company)) ? $repdetails->company:'NA';
               }
               if (in_array('Product', $report_columns)){
                  $row[] = (!empty($repdetails->enq_product_name)) ? $repdetails->enq_product_name:'NA';
               }
              if (in_array('Enquiry Id', $report_columns)){
                $row[] = (!empty($repdetails->Enquery_id)) ? $repdetails->Enquery_id:'NA';
              }
                 if(!empty($dfields)){
                    foreach($dfields as $ind => $dfld){ 
                      if (in_array(trim($dfld['input_label']), $report_columns)) {                  
                        if (!empty($fieldsval)) {                                              
                          if(!empty($fieldsval[$repdetails->enquiry_id])){
                            if(!empty($fieldsval[$repdetails->enquiry_id][$dfld['input_label']])){
                              $row[] = $fieldsval[$repdetails->enquiry_id][$dfld['input_label']]->fvalue;
                            }else{
                              $row[] = "NA";
                            }
                          }else{
                            $row[] = "NA";                                                
                          }
                        }else{
                          $row[] =  "NA";
                        }                                             
                      }
                  } 
                }
           $data[] = $row;
           }
            $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_datatable_model->count_all(),
            "recordsFiltered" => $this->report_datatable_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
     }
        
        public function delete_report_row(){
            $id = $this->input->post('id');        
            $this->db->where('id',$id);         
            $this->db->delete('reports');
            echo 1;
        }
        public function view_details(){ 
            if($this->input->post('from_exp')==''){
             $from ='';  
            }else{
           $dfrom= $this->input->post('from_exp');
           $from = date("d/m/Y", strtotime($dfrom));
            }
            
            if($this->input->post('to_exp')==''){
                $to ='';
            }else{
               $tto= $this->input->post('to_exp');
               $to = date("d/m/Y", strtotime($tto)); 
            }

            if($this->input->post('updated_from_exp')==''){
              $updated_from ='';  
             }else{
            $updated_dfrom= $this->input->post('updated_from_exp');
            $updated_from = date("d/m/Y", strtotime($updated_dfrom));
             }
             
             if($this->input->post('updated_to_exp')==''){
                 $updated_to ='';
             }else{
                $updated_tto= $this->input->post('updated_to_exp');
                $updated_to = date("d/m/Y", strtotime($updated_tto)); 
             }
            if($this->input->post('employee')==''){
                $employe ='';
            }else{
               $employe= $this->input->post('employee');
            }
             if($this->input->post('phone')==''){
                $phone ='';
            }else{
               $phone= $this->input->post('phone');
            }
              if($this->input->post('country')==''){
                $country ='';
            }else{
               $country= $this->input->post('country');
            }
              if($this->input->post('institute')==''){
                $institute ='';
            }else{
               $institute= $this->input->post('institute');
            }
             if($this->input->post('center')==''){
                $center ='';
            }else{
               $center= $this->input->post('center');
            }
            if($this->input->post('source')==''){
                $source ='';
            }else{
               $source= $this->input->post('source');
            }
            if($this->input->post('subsource')==''){
                $subsource ='';
            }else{
               $subsource= $this->input->post('subsource');
            }
            if($this->input->post('datasource')==''){
                $datasource ='';
            }else{
               $datasource= $this->input->post('datasource');
            }
            if($this->input->post('state')==''){
                $state ='';
            }else{
               $state= $this->input->post('state');
            }
            if($this->input->post('lead_source')==''){ // disposition
              $lead_source = '';
            }else{
               $lead_source = $this->input->post('lead_source');
            }
            
            if($this->input->post('lead_subsource')==''){  
                $lead_subsource = '';
            }else{
               $lead_subsource = $this->input->post('lead_subsource');
            }
            if($this->input->post('sub_disposition')==''){  
                $sub_disposition = '';
            }else{
               $sub_disposition = $this->input->post('sub_disposition');
            }
            
            
            if($this->input->post('enq_product')==''){
                $enq_product = '';
            }else{
               $enq_product = $this->input->post('enq_product');
            }
            if($this->input->post('productlst')==''){
                $productlst = '';
            }else{
               $productlst = $this->input->post('productlst');
            }
            if($this->input->post('drop_status')==''){
                $drop_status = '';
            }else{
               $drop_status = $this->input->post('drop_status');
            }
            if($this->input->post('hier_wise')==''){
                $hier_wise = '';
            }else{
               $hier_wise = $this->input->post('hier_wise');
            }
            if($this->input->post('Enquiry_Id')==''){
              $Enquiry_Id = '';
          }else{
             $Enquiry_Id = $this->input->post('Enquiry_Id');
          }
            $data['post_report_columns'] = $this->input->post('report_columns');
            // print_r($data['post_report_columns']);
            // die();
             $post_report_columns = $this->input->post('report_columns');
            if($this->input->post('all')==''){ // follow up report
                $all = '';
            }else{
               $all = $this->input->post('all');
            }        
            $data_arr = array(
            'from1'           =>  $from,
            'to1'             =>  $to,
            'updated_from1'   =>  $updated_from,
            'updated_to1'     =>  $updated_to,
            'employe1'        =>  $employe,
            'phone1'          =>  $phone,
            'country1'        =>  $country,
            'institute1'      =>  $institute,
            'center1'         =>  $center,
            'source1'         =>  $source,
            'subsource1'      =>  $subsource,
            'datasource1'     =>  $datasource,
            'state1'          =>  $state,
            'lead_source1'    =>  $lead_source,
            'lead_subsource1' =>  $lead_subsource,
            'sub_disposition' =>  $sub_disposition,
            'enq_product1'    =>  $enq_product,
            'drop_status1'    =>  $drop_status,
            'all1'            =>  $all, 
            'post_report_columns'=>$post_report_columns,
            'productlst'=>$productlst,
            'hier_wise' => $hier_wise,
            );
            $this->session->set_userdata($data_arr);
            
        $data['title'] = 'Report';
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['all_sub_stage_lists'] = $this->Leads_Model->find_description();
        $data['sourse'] = $this->report_model->all_source();
        $data['subsourse'] = $this->report_model->all_subsource();
        $data['datasourse'] = $this->report_model->all_datasource();
        
        $data['datasourse'] = $this->report_model->all_datasource();
        $this->load->model('User_model');
        //$data['employee'] =$this->User_model->companey_users();
        $data['employee'] = $this->User_model->read();
        $data['process'] = $this->dash_model->product_list();
        $data["dfields"] = $this->report_model->get_dynfields(); 
      
        $data["fieldsval"]        = $this->report_model->getdynfielsval();  
        $data['products'] = $this->location_model->productcountry();
          // print_r($data["fieldsval"]);
          // die();
        $data['content'] = $this->load->view('all_report', $data, true);        
        $this->load->view('layout/main_wrapper', $data);
       
    }
    public function all_report_filterdata(){
        $dfields    = $this->report_model->get_dynfields();
        $fieldsval  = $this->report_model->getdynfielsval();  
        $this->load->model('report_datatable_model');
        $no = $_POST['start'];
        $from = $this->session->userdata('from1');
        $to= $this->session->userdata('to1');
        $employe = $this->session->userdata('employe1');
        $phone = $this->session->userdata('phone1');
        $country = $this->session->userdata('country1');
        $institute = $this->session->userdata('institute1');
        $center = $this->session->userdata('center1');
        $source = $this->session->userdata('source1');
        $subsource = $this->session->userdata('subsource1');
        $datasource = $this->session->userdata('datasource1');
        $state = $this->session->userdata('state1');
        $lead_source = $this->session->userdata('lead_source1');
        $lead_subsource = $this->session->userdata('lead_subsource1');
        $enq_product = $this->session->userdata('enq_product1');
        $drop_status = $this->session->userdata('drop_status1');
        $all = $this->session->userdata('all1');
        $productlst = $this->session->userdata('productlst');
        $Enquiry_Id = $this->session->userdata('Enquiry_Id');
        $rep_details = $this->report_datatable_model->get_datatables();  
            $i=1;
            $data = array();
        foreach ($rep_details as  $repdetails) {
              
            $no++;
            $row = array(); 
        
             if (in_array('S.No', $this->session->userdata('post_report_columns'))){
                $row[] = $i++;
             }
             if (in_array('Name', $this->session->userdata('post_report_columns'))) { 
              $row[] = $repdetails->name_prefix . " " . $repdetails->name . " " . $repdetails->lastname;
              }
              if (in_array('Phone', $this->session->userdata('post_report_columns'))) {
                  if (user_access(450)) {
                    $row[] = '##########';                    
                  }else{
                    $row[] = $repdetails->phone;
                  }
              }
              if (in_array('Email',$this->session->userdata('post_report_columns'))){
                $row[] = $repdetails->email;
              }
              if (in_array('Created By', $this->session->userdata('post_report_columns'))) {
                $row[] = $repdetails->created_by_name;
              }
              if (in_array('Assign To', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->assign_to_name))?$repdetails->assign_to_name:'NA'; 
              }
              if (in_array('Gender', $this->session->userdata('post_report_columns'))) {
                 if ($repdetails->gender == 1) {
                 $gender = 'Male';
                } else if ($repdetails->gender == 2) {
                $gender = 'Female';
                } else {
                $gender = 'Other';
                }
                $row[] = $gender;
              }
              if (in_array('Source', $this->session->userdata('post_report_columns'))) {
                $row[] = (!empty($repdetails->lead_name))?$repdetails->lead_name:'NA';
              }
              if (in_array('Subsource', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->subsource_name)) ? $repdetails->subsource_name:'NA'; 
              }
               if (in_array('Disposition', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->followup_name)) ? $repdetails->followup_name:'NA';
               }
              if (in_array('Lead Description', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->description)) ? $repdetails->description :"NA"; 
              }

              if (in_array('Disposition Remark', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->lead_discription_reamrk)) ? $repdetails->lead_discription_reamrk :"NA"; 
              }
              if (in_array('Drop Reason', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->drop_status)) ? $repdetails->drop_status :"NA"; 
              }
              if (in_array('Drop Comment', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->drop_reason)) ? $repdetails->drop_reason :"NA"; 
              }
              if (in_array('Conversion Probability', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->lead_score)) ? $repdetails->lead_score :"NA"; 
              }
              if (in_array('Remark', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->enq_remark)) ? $repdetails->enq_remark :"NA"; 
              }              

              if (in_array('Status', $this->session->userdata('post_report_columns'))) {
                 if ($repdetails->status == 1) {
                 $status = 'Enquiry';
                 } else if ($repdetails->status == 2) {
                 $status = 'Lead';
                 } else {
                 $status = 'Client';
                 }
                 $row[] = $status;
              }
               if (in_array('DOE', $this->session->userdata('post_report_columns'))) {
                $row[] = $repdetails->inq_created_date;
               }
               if (in_array('Process', $this->session->userdata('post_report_columns'))) {
               $row[] =  (!empty($repdetails->product_name)) ?$repdetails->product_name:'NA'; 
               }
               if (in_array('Updated Date',$this->session->userdata('post_report_columns'))){
                $row[] = $repdetails->update_date; 
               }
               if (in_array('State', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->state_name)) ? $repdetails->state_name:'NA';
               }
                if (in_array('City', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->city_name)) ? $repdetails->city_name:'NA';
               }
               if (in_array('Company Name', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->company)) ? $repdetails->company:'NA';
               }
               if (in_array('Product', $this->session->userdata('post_report_columns'))){
                  $row[] = (!empty($repdetails->enq_product_name)) ? $repdetails->enq_product_name:'NA';
               }
               if (in_array('Enquiry Id', $this->session->userdata('post_report_columns'))){
                $row[] = (!empty($repdetails->Enquery_id)) ? $repdetails->Enquery_id:'NA';
              }
                 if(!empty($dfields)){
                    foreach($dfields as $ind => $dfld){ 
                    if (in_array(trim($dfld['input_label']), $this->session->userdata('post_report_columns'))) {
                
                    if (!empty($fieldsval)) {                                              
                    if(!empty($fieldsval[$repdetails->enquiry_id])){
                    if(!empty($fieldsval[$repdetails->enquiry_id][$dfld['input_label']])){
                    $row[] = $fieldsval[$repdetails->enquiry_id][$dfld['input_label']]->fvalue;
                    }else{
                    $row[] = "NA";
                    }
                    }else{
                    $row[] = "NA";                                                
                    }
                    }else{
                    $row[] =  "NA";
                     }
                                         
                    }
                  } 
                }
           $data[] = $row;
           }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_datatable_model->count_all(),
            "recordsFiltered" => $this->report_datatable_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function create_report(){
        parse_str($_POST['filters'], $filters);
        $report_name    = $this->input->post('report_name');
        $this->form_validation->set_rules('report_name','Report Name','required|trim');
        if ($this->form_validation->run() == TRUE) {
            $insert_array = array(
                            'name'      =>  $report_name,
                            'comp_id'   =>  $this->session->companey_id,
                            'filters'   =>  json_encode($filters),
                            'created_by'=>  $this->session->user_id
                            );
            if($this->db->insert('reports',$insert_array)){
                echo json_encode(array('status'=>true,'msg'=>'Report Saved Successfully'));
            }else{
                echo json_encode(array('status'=>false,'msg'=>'Something went wrong!'));
            }           
        } else {
            echo json_encode(array('status'=>false,'msg'=>validation_errors()));            
        }
    }
    public function all_reports() {
        $data['title'] = 'Report';
        $data['countries'] = $this->report_model->all_country();
        $data['institute'] = $this->report_model->all_institute();
        $data['center'] = $this->report_model->all_center();
        $data['sourse'] = $this->report_model->all_source();
        $data['subsourse'] = $this->report_model->all_subsource();
        $data['datasourse'] = $this->report_model->all_datasource();
        $data['all_stage_lists'] = $this->Leads_Model->find_stage();
        $data['products'] = $this->dash_model->product_list();        
        $data['employee'] = $this->report_model->all_company_employee($this->session->userdata('companey_id'));        
        $data['content'] = $this->load->view('all_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }
    
    //Dashboard statitics reports for enquiry..
    public function enquiry_statitics_report() {
        echo json_encode($this->report_model->enquiry_statitics_data());
    }
    //Dashboard statitics reports for Leads..
    public function lead_statitics_report() {
        echo json_encode($this->report_model->lead_statitics_data());
    }
    public function lead_opportunity() {
        echo json_encode($this->report_model->lead_opportunities_status());
    }
    public function client_opportunities() {
        echo json_encode($this->report_model->client_opportunity_status());
    }
    public function all_source() {
        echo json_encode($this->report_model->enquiry_source_data());
    }
    public function funnel_reports() {
        echo json_encode($this->report_model->funnel_report());
    }
    public function ticket_report()
    {
      if(user_role(122)){}
        $this->load->model(array('Ticket_Model','Datasource_model','dash_model','enquiry_model','report_model','Leads_Model','User_model'));
    
        if (isset($_SESSION['ticket_filters_sess']) && empty($_POST))
          unset($_SESSION['ticket_filters_sess']);
        $data['sourse'] = $this->report_model->all_source();
        $data['title'] = "Ticket Report";
        $data['created_bylist'] = $this->User_model->read();
        $data['products'] = $this->dash_model->get_user_product_list();
        $data['prodcntry_list'] = $this->enquiry_model->get_user_productcntry_list();
        $data['problem'] = $this->Ticket_Model->get_sub_list();        
        $data['stage'] =  $this->Leads_Model->stage_by_type(4);
        $data['sub_stage'] = $this->Leads_Model->find_description();
        $data['ticket_status'] = $this->Ticket_Model->ticket_status()->result();        
        $data['dfields'] = $this->enquiry_model->getformfield(2);        
        $data['issues'] = $this->Ticket_Model->get_issue_list();     

       $list =  $this->db->select('input_id')->where(array('process_id'=>$this->session->process[0],'company_id'=>$this->session->companey_id,'status'=>'1'))->get('tbl_input')->result();
       $list = array_column($list, 'input_id');
       // $list2 = array();
       // //print_r($list); exit();
       // if(!empty($_COOKIE['ticket_dallowcols']))
       //  $list2 = explode(',', $_COOKIE['ticket_dallowcols']);

       // $common = array_intersect($list,$list2);
       //  p
       // setcookie('ticket_dallowcols',implode(',', $common),86400*30,'/');

       $data['table_config_list'] = $list;
        $data['content'] = $this->load->view('reports/ticket_report', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function report_analitics($for){
      $this->load->model('report_datatable_model');
      $result  = $this->report_datatable_model->report_analitics($for);      
      echo json_encode($result);      
    }
    
    public function report_analitics_pipeline($for){
      $this->load->model('report_datatable_model');
      $result  = $this->report_datatable_model->report_analitics($for);      
      $res = array();

      if(!empty($result)){
        foreach($result as $value){          
          $title = $this->get_sale_pipeline_name_byId($value[0]);          
          array_push($res,array($title,$value[1]));          
        }
        $result = $res;
      }
      echo json_encode($result);      
    }

    function get_sale_pipeline_name_byId($id){      
      if($id == 1){
        $name = display('enquiry');
      }else if($id == 2){
        $name = display('lead');
      }else if($id == 3){
        $name = display('client');
      }else{
        $enquiry_separation  = get_sys_parameter('enquiry_separation', 'COMPANY_SETTING');
        if (!empty($enquiry_separation)) {
          $enquiry_separation = json_decode($enquiry_separation, true);
          $name = $enquiry_separation[$id]['title'];     
        }else{
          $name = 'NA';
        }
      }
      return $name;
    }
}