<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_datatable_model extends CI_Model{
    
    function __construct() {
  
        $this->table = 'tbl_client_contacts';
        // Set orderable column fields
        $this->column_order = array('','enquiry.name','enquiry.company','contacts.designation','contacts.c_name','contacts.contact_number','contacts.emailid','contacts.decision_maker','contacts.other_details','contacts.created_at');

        // Set searchable column fields

        $this->column_search = array('enquiry.name','enquiry.company','contacts.designation','contacts.c_name','contacts.contact_number','contacts.emailid','contacts.other_details');

        // $this->column_search = array('tck.ticketno','tck.id','tck.category','tck.name','tck.email','tck.product','tck.message','tck.issue','tck.solution','tck.sourse','tck.ticket_stage','tck.review','tck.status','tck.priority','tck.complaint_type','tck.coml_date','tck.last_update','tck.send_date','tck.client','tck.assign_to','tck.company','tck.added_by','enq.phone','enq.gender','prd.country_name');
        
        // Set default order
        $this->order = array('sr_no' => 'desc');
        $this->load->model('common_model');
    }
    
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){

        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
     
    /*
     * Count all records
     */
    public function countAll(){

        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

        $this->db->from($this->table);
        $this->db->join('enquiry','enquiry.enquiry_id=tbl_client_contacts.client_id','left');
        $this->db->where("enquiry.comp_id",$this->session->companey_id);
        $where="";
        $where .= "( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';
        // if(!empty($_POST['specific_list']))
        // {
        //     $where.="AND tbl_visit.id IN (".$_POST['specific_list'].") ";   
        // }
        $this->db->where($where);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    public function _get_datatables_query($postData){

        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

        // $this->db->select($this->table.'.*,enquiry.name,enquiry.status as enq_type,enquiry.Enquery_id');
        // $this->db->from($this->table);
        // $this->db->join('enquiry','enquiry.enquiry_id=tbl_visit.enquiry_id','left');
        // $this->db->where("tbl_visit.comp_id",$this->session->companey_id);

        // $where="";
        // $where .= "( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        // $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';  



        $where = 'enquiry.comp_id='.$this->session->companey_id;
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $where .= " AND ( enquiry.created_by IN (".implode(',', $all_reporting_ids).')';
        $where .= " OR enquiry.aasign_to IN (".implode(',', $all_reporting_ids).'))';          
        // if($where)
        //     $this->db->where($where);

        $this->db->select('contacts.*,enquiry.company,enquiry.enquiry_id,concat_ws(" ",name_prefix,name,lastname) as enq_name,enquiry.status');
        $this->db->from('tbl_client_contacts contacts');
        $this->db->join('enquiry','enquiry.enquiry_id=contacts.client_id','inner');
        // $this->db->order_by('contacts.cc_id desc');
        // return $this->db->get();


        $and =1;
        // if(!empty($_POST['from_date']))
        // {
        //     $where.="and visit_date >= '".$_POST['from_date']."'";
        //     $and =1;
        // }

        // if(!empty($_POST['to_date']))
        // {   
        //     if($and)
        //         $where.=" and ";

        //     $where.=" visit_date <= '".$_POST['to_date']."'";
        //     $and =1;
        // }

        // if(!empty($_POST['from_time']))
        // {   
        //     if($and)
        //         $where.=" and ";

        //     $where.=" visit_time >= '".$_POST['from_time']."'";
        //     $and =1;
        // }

        // if(!empty($_POST['to_time']))
        // {   
        //     if($and)
        //         $where.=" and ";

        //     $where.=" visit_time <= '".$_POST['to_time']."'";
        //     $and =1;
        // }


        // if(!empty($_POST['enquiry_id']))
        // {   
        //     if($and)
        //         $where.=" and ";

        //     $where.=" tbl_visit.enquiry_id = '".$_POST['enquiry_id']."'";
        //     $and =1;
        // }

        // if(!empty($_POST['rating']))
        // {   
        //     if($and)
        //         $where.=" and ";

        //     $where.=" tbl_visit.rating LIKE '%".$_POST['rating']."%'";
        //     $and =1;
        // }

        if(!empty($_POST['specific_list']))
        {
            if($and)
                $where.=" and ";

            $where.=" ( contact.cc_id IN (".$_POST['specific_list'].") ) ";
            $and =1;
        }

        if($where!='')
        $this->db->where($where);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}