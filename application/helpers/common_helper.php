<?php
defined('BASEPATH') OR exit('No direct script access allowed');    
    function is_active_field($id,$process=0){
    	$ci =& get_instance();
    	$comp_id	=	$ci->session->companey_id;
    	$where = "field_id=$id ";    	
    	if ($process) {
    		$where .= " AND (FIND_IN_SET('".$process."',process_id) OR process_id='')";
    	}
    	$where .= " AND comp_id=$comp_id AND status=1";
	    $ci->db->where($where);	    
	    $row  = $ci->db->get('enquiry_fileds_basic')->row_array();	    
	    if(!empty($row)){
	    	return true;
	    }else{
	    	if(!empty($row['status']) && $row['status']){
				return true;
	    	}else{
	    		return false;
	    	}
	    }
    }
    function is_active_field_api($id,$process=0,$comp_id){       
        $ci =& get_instance();
        $comp_id    =   $comp_id;
        $where = "field_id=$id ";       
        if ($process) {
            $where .= " AND (FIND_IN_SET('".$process."',process_id) OR process_id='')";
        }
        $where .= " AND comp_id=$comp_id AND status=1";
        $ci->db->where($where);     
        $row  = $ci->db->get('enquiry_fileds_basic')->row_array();      
        if(!empty($row)){
            return true;
        }else{
            if($row['status']){
                return true;
            }else{
                return false;
            }
        }
    }
    function get_stage_name($id) {
        $ci = & get_instance();
        $ci->load->database();
        return $ci->db->get_where('lead_stage', array('stg_id'    => $id))->row_array() ['lead_stage_name'];
    }
    function get_drop_status_name($id) {
        $ci = & get_instance();
        $ci->load->database();
        return $ci->db->get_where('tbl_drop', array('d_id'=> $id))->row_array() ['drop_reason'];
    }

    function get_enquery_code($id_prefix='ENQ') {
        $code = genret_code();
        $code2 = $id_prefix.$code;
        // Get a reference to the controller object
        $CI = get_instance();
        // You may need to load the model if it hasn't been pre-loaded
        $CI->load->model('enquiry_model');
        $response = $CI->enquiry_model->check_existance($code2);    
        if ($response) {        
            $this->get_enquery_code();
        } else {        
            return $code2;
        }
    }
    
    function genret_code() {
        $pass  = "";
        $chars = array("0","1","2","3","4","5","6","7","8","9");
        for ($i=0;$i<12;$i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }