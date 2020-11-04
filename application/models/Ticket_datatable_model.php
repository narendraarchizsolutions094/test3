<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_datatable_model extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'tbl_ticket';
        // Set orderable column fields
        $this->column_order = array('', 'tck.id','tck.ticketno','tck.client','tck.email','enq.phone','prd.country_name','tck.assign_to','tck.priority','tck.coml_date');
        // Set searchable column fields
        $this->column_search = array('tck.ticketno','tck.id','tck.category','tck.name','tck.email','tck.product','tck.message','tck.issue','tck.solution','tck.sourse','tck.ticket_stage','tck.review','tck.status','tck.priority','tck.complaint_type','tck.coml_date','tck.last_update','tck.send_date','tck.client','tck.assign_to','tck.company','tck.added_by','enq.phone','enq.gender','prd.country_name','cnv.msg');
        // Set default order
        $this->order = array('tck.id' => 'desc');
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

        $this->db->from($this->table);
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
        $this->load->model('common_model');
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
        $this->db->select("tck.*,enq.phone,enq.gender,prd.country_name, concat(enq.name_prefix,' ' , enq.name,' ', enq.lastname) as clientname , COUNT(cnv.id) as tconv, cnv.msg, concat(for_assign.s_display_name,' ',for_assign.last_name) as assign_to_name , concat(for_created.s_display_name,' ',for_created.last_name) as created_by_name ");
        $this->db->from($this->table." tck")
         ->join("tbl_ticket_conv cnv", "cnv.tck_id = tck.id", "LEFT")
         ->join("enquiry enq", "enq.enquiry_id = tck.client", "LEFT")
         ->join("tbl_admin as for_assign", "for_assign.pk_i_admin_id = tck.assign_to", "LEFT")
         ->join("tbl_admin as for_created", "for_created.pk_i_admin_id = tck.added_by", "LEFT")
         ->join("tbl_product_country prd", "prd.id = tck.product", "LEFT")
         ->where("tck.company",$this->session->companey_id)
         ->group_by("tck.id");


    // if(isset($this->session->ticket_filters_sess))
    // {
        $enquiry_filters_sess   =   $this->session->ticket_filters_sess;
            
        $from_created           =   !empty($enquiry_filters_sess['from_created'])?$enquiry_filters_sess['from_created']:'';       
        $to_created             =   !empty($enquiry_filters_sess['to_created'])?$enquiry_filters_sess['to_created']:'';
        $source                 =   !empty($enquiry_filters_sess['source'])?$enquiry_filters_sess['source']:'';
       
        $createdby              =   !empty($enquiry_filters_sess['createdby'])?$enquiry_filters_sess['createdby']:'';
        $assign                 =   !empty($enquiry_filters_sess['assign'])?$enquiry_filters_sess['assign']:'';
      
        $problem                 =   !empty($enquiry_filters_sess['problem'])?$enquiry_filters_sess['problem']:'';

        $priority                 =   !empty($enquiry_filters_sess['priority'])?$enquiry_filters_sess['priority']:'';

        $issue                 =   !empty($enquiry_filters_sess['issue'])?$enquiry_filters_sess['issue']:'';

         $productcntry          =   !empty($enquiry_filters_sess['prodcntry'])?$enquiry_filters_sess['prodcntry']:'';

        $where='';
$CHK = 0;
         if(!empty($from_created) && !empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " DATE(tck.coml_date) >= '".$from_created."' AND DATE(tck.coml_date) <= '".$to_created."'";
            $CHK = 1;
        }
        if(!empty($from_created) && empty($to_created)){
            $from_created = date("Y-m-d",strtotime($from_created));
            $where .= " DATE(tck.coml_date) >=  '".$from_created."'"; 
            $CHK = 1;                           
        }
        if(empty($from_created) && !empty($to_created)){            
            $to_created = date("Y-m-d",strtotime($to_created));
            $where .= " DATE(tck.coml_date) <=  '".$to_created."'"; 
            $CHK = 1;                                  
        }


        if(!empty($productcntry)){            
           // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.product =  '".$productcntry."'"; 
            $CHK =1;                             
        }

        if(!empty($createdby)){            
           // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.added_by =  '".$createdby."'"; 
            $CHK =1;                             
        }

        if(!empty($assign)){            
                   // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.assign_to =  '".$assign."'"; 
            $CHK =1;                             
        }

        if(!empty($source)){            
                   // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.sourse =  '".$source."'"; 
            $CHK =1;                             
        }

        if(!empty($problem)){            
                   // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.category =  '".$problem."'"; 
            $CHK =1;                             
        }

        if(!empty($priority)){            
                   // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.priority =  '".$priority."'"; 
            $CHK =1;                             
        }

         if(!empty($issue)){            
                   // $to_created = date("Y-m-d",strtotime($to_created));
            if($CHK)
                $where .= 'AND';

            $where .= " tck.category =  '".$issue."'"; 
            $CHK =1;                             
        }


        if($CHK){
            $where .= 'AND';
        }

        $where .= " ( tck.added_by IN (".implode(',', $all_reporting_ids).')';
        $CHK=1;

        if($CHK){
            $where .= ' OR ';
            $CHK =1;
        }
        $where .= " tck.assign_to IN (".implode(',', $all_reporting_ids).'))';




        $this->db->where($where);
    //}

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