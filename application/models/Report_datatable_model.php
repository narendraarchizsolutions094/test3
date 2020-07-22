<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_datatable_model extends CI_Model {    
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');		
    }
    var $table = 'enquiry';
    public function _get_datatables_query(){
    	$all_reporting_ids    =    $this->common_model->get_categories($this->session->user_id);      
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
        $productlst = $this->session->userdata('productlst');
        $all = $this->session->userdata('all1');        
        if($all){
                $select = 'enquiry.enquiry_id,enquiry.name_prefix,enquiry.name,enquiry.lastname,enquiry.phone,enquiry.update_date,enquiry.email,enquiry.gender,enquiry.drop_status,enquiry.status,lead_source.lead_name,tbl_subsource.subsource_name,lead_description.description,enquiry.status as inq_status,enquiry.created_date as inq_created_date, CONCAT(tbl_admin.s_display_name,tbl_admin.last_name) as created_by_name,CONCAT(admin2.s_display_name,admin2.last_name) as assign_to_name,tbl_product.product_name,lead_stage2.lead_stage_name as followup_name';
            }else{
                $select = 'enquiry.enquiry_id,enquiry.name_prefix,enquiry.name,enquiry.lastname,enquiry.phone,enquiry.update_date,enquiry.email,enquiry.gender,enquiry.drop_status,enquiry.status,lead_source.lead_name,tbl_subsource.subsource_name,lead_description.description,lead_stage.lead_stage_name as followup_name,enquiry.status,enquiry.created_date, CONCAT(tbl_admin.s_display_name,tbl_admin.last_name) as created_by_name,CONCAT(admin2.s_display_name,admin2.last_name) as assign_to_name,tbl_product.product_name';
            }
            $select .= ',enquiry.company';
            $this->db->select($select);        
            //$this->db->from('enquiry');
            $where = "enquiry.enquiry_id > 0";      
            if ($from && $to) {
                $to = str_replace('/', '-', $to);
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d', strtotime($from));
                $to = date('Y-m-d', strtotime($to));            
                $where .= " AND Date(enquiry.created_date) >= '$from' AND Date(enquiry.created_date) <= '$to'";
                } else if ($from && !$to) {
                $from = str_replace('/', '-', $from);            
                $from = date('Y-m-d H:i:s', strtotime($from));
                $where .= " AND enquiry.created_date LIKE '%$from%'";
                } else if (!$from && $to) {            
                $to = str_replace('/', '-', $to);            $to = date('Y-m-d H:i:s', strtotime($to));
               
                $where .= " AND enquiry.created_date LIKE '%$to%'";
            }
           if($employe!=''){			
    			$where .= " AND ( enquiry.created_by IN (".implode(',', $employe).')';
    			$where .= " OR enquiry.aasign_to IN (".implode(',', $employe).'))';  		  
            }else{
    			$where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
    			$where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';  
    		}    
            if($source!=''){
               $where .= " AND enquiry.enquiry_source IN (".implode(',', $source).')';  
            }
            if($subsource!=''){
               $where .= " AND enquiry.sub_source IN (".implode(',', $subsource).')';
            }
            if($datasource!=''){
               $where .= " AND enquiry.datasource_id IN (".implode(',', $datasource).')';  
            }
            if($state!=''){
               $where .= " AND enquiry.status IN (".implode(',', $state).')';  
            }
            if ($lead_source != '') {                
                $where .= " AND enquiry.lead_stage IN (".implode(',', $lead_source).')';                                           
            }
            if($productlst!=''){
               $where .= " AND enquiry.enquiry_subsource IN (".implode(',', $productlst).')';  
            }
            if($enq_product!=''){
               $where .= " AND enquiry.product_id IN (".implode(',', $enq_product).')';  
            }

            if($all!=''){
                $where.= "AND comment_msg='Stage Updated'";
                $this->db->join('tbl_comment','tbl_comment.lead_id=enquiry.Enquery_id','inner');              
                $this->db->join('lead_stage as lead_stage2','lead_stage2.stg_id=tbl_comment.stage_id','left'); 
            }
           
           if($drop_status!=''){            
                if(!empty($drop_status[0])){
                    if($drop_status[0]=='dropped'){
                        $where .= " AND enquiry.drop_status>0 ";
                    }
                }
                if(!empty($drop_status[1])){
                    if($drop_status[1]=='active'){
                        $where .= " AND enquiry.status=1";
                    }
                }
                if(!empty($drop_status[0])=='dropped' && !empty($drop_status[1])=='active'){
                    $where .= " AND enquiry.drop_status>0 AND enquiry.status=1";
                }
            }
            $comp_id = $this->session->companey_id;            
            $this->db->join('lead_source','lead_source.lsid=enquiry.enquiry_source','left');
            $this->db->join('tbl_product','tbl_product.sb_id=enquiry.product_id','left');        

            $this->db->join("(select * from tbl_subsource where comp_id=$comp_id) as tbl_subsource",'tbl_subsource.subsource_id=enquiry.enquiry_subsource','left');        
            
            $this->db->join('tbl_datasource','tbl_datasource.datasource_id=enquiry.datasource_id','left');
            $this->db->join('tbl_admin','tbl_admin.pk_i_admin_id=enquiry.created_by','left');
            $this->db->join('tbl_admin as admin2','admin2.pk_i_admin_id=enquiry.aasign_to','left');      
            $this->db->join('lead_stage','lead_stage.stg_id=enquiry.lead_stage','left');        
            $this->db->join('lead_description','lead_description.id=enquiry.lead_discription','left');
            $this->db->where($where);        
            if(!$all){
                $this->db->group_by('enquiry.enquiry_id');        
            }else{
                $this->db->order_by('enquiry.enquiry_id,tbl_comment.created_date','DESC');                    
            }        
    }
    function get_datatables(){   	        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    function count_filtered(){
        $this->_get_datatables_query();
        $where = "";
        $user_id   = $this->session->user_id;
        $user_role = $this->session->user_role;
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all(){
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $this->db->from($this->table);        
        $where = "";                        
        $where .= " (enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';          
        $this->db->where($where);
        return $this->db->count_all_results();
    }
} 