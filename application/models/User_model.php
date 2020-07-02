<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
    private $table = 'tbl_admin';

    public function create($data = []) {
        return $this->db->insert($this->table, $data);
    }
    
    public function companyList() {
        $this->db->select("user_id,a_companyname");
        $this->db->from('user');
        $this->db->where('status', 1);
  
        return $this->db->get()->result();
    }

    public function read() {        
        $this->load->model('common_model');
        $all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);              
        $user_id = $this->session->user_id;
        $user_role = $this->session->user_role;
        $region_id = $this->session->region_id;
        $assign_country = $this->session->country_id;
        $assign_region = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state = $this->session->state_id;
        $assign_city = $this->session->city_id;
        $this->db->select("*");
        $this->db->from($this->table);
        //$this->db->join('user', 'user.user_id = tbl_admin.companey_id');
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_permissions', 'left');
		
        //$this->db->where('tbl_admin.companey_id',$this->session->companey_id); 
        // $this->db->where('tbl_admin.user_roles!=', 9);
        $where = "  tbl_admin.pk_i_admin_id IN (".implode(',', $all_reporting_ids).')';                
        $where .= "  AND tbl_admin.b_status=1";                                
        $this->db->where($where);

        /*if ($user_id >=3) {
          //$this->db->where('tbl_admin.companey_id',$this->session->companey_id);  
        }*/

        return $this->db->get()->result();
    }


    public function companey_users() {                
        $user_id = $this->session->user_id;
        $this->db->select("*");
        $this->db->from($this->table);        
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_permissions', 'left');        
        $this->db->where('tbl_admin.companey_id',$this->session->companey_id); 
        $this->db->where('tbl_admin.b_status',1);                                                
        return $this->db->get()->result();
    }
	
	public function user_read() {

        $user_id = $this->session->user_id;
        $user_role = $this->session->user_role;
        $region_id = $this->session->region_id;
        $assign_country = $this->session->country_id;
        $assign_region = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state = $this->session->state_id;
        $assign_city = $this->session->city_id;
        $this->db->select("*");
        $this->db->from($this->table);
        //$this->db->join('user', 'user.user_id = tbl_admin.companey_id');
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_permissions', 'left');
		$this->db->where('tbl_admin.companey_id',$this->session->companey_id); 
        $this->db->where('tbl_admin.b_status=', 1);
        return $this->db->get()->result();
    }


    public function read2() {

        $user_id = $this->session->user_id;
        $user_role = $this->session->user_role;
        $region_id = $this->session->region_id;
        $assign_country = $this->session->country_id;
        $assign_region = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state = $this->session->state_id;
        $assign_city = $this->session->city_id;
        $this->db->select("*");
        $this->db->from($this->table);        
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_type', 'left');
        $this->db->where('tbl_admin.user_type!=', 1);
        $this->db->where('tbl_admin.companey_id',$this->session->companey_id);  
        return $this->db->get()->result();
    }

    public function reads() {
        $user_id = $this->session->user_id;
        $user_role = $this->session->user_role;
        $region_id = $this->session->region_id;
        $assign_country = $this->session->country_id;
        $assign_region = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state = $this->session->state_id;
        $assign_city = $this->session->city_id;
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('user', 'user.user_id = tbl_admin.companey_id');
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_permissions', 'left');
        $this->db->where('tbl_admin.user_roles!=', 9);
        //	$this->db->where('tbl_admin.b_status',1);
        if ($user_role == 3) {
            $this->db->where('tbl_admin.user_roles>=', 3);
        } else if ($user_role == 4) {
            $this->db->where('tbl_admin.user_roles>=', 4);
        } else if ($user_role == 5) {
            $this->db->where('tbl_admin.user_roles>=', 5);
        } else if ($user_role == 6) {
            $this->db->where('tbl_admin.user_roles>=', 6);
        } else if ($user_role == 7) {
            $this->db->where('tbl_admin.user_roles>=', 7);
        } elseif ($user_role == 8 || $user_role == 9) {
            $this->db->where('tbl_admin.user_roles>=', 8);
        }
        return $this->db->get()->result();
    }

    public function display_company_details() {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=users.user_permissions', 'left');
        return $this->db->get()->result();
    }

    public function partner() {
        $user_id = $this->session->user_id;
        $user_role = $this->session->user_role;
        $region_id = $this->session->region_id;
        $assign_country = $this->session->country_id;
        $assign_region = $this->session->region_id;
        $assign_territory = $this->session->territory_id;
        $assign_state = $this->session->state_id;
        $assign_city = $this->session->city_id;


        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('user', 'user.user_id = tbl_admin.companey_id');
        $this->db->join('tbl_channel_partner', 'tbl_admin.partner_type = tbl_channel_partner.ch_id', 'left');
        $this->db->join('tbl_user_role', 'tbl_user_role.use_id=tbl_admin.user_permissions', 'left');
        $this->db->where('tbl_admin.user_roles', 9);
        //	$this->db->where('tbl_admin.b_status',1);
        return $this->db->get()->result();
    }

    public function all_user() {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    public function read_by_id($id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('pk_i_admin_id', $id)
                        ->get()
                        ->row();
    }

    public function all_lists() {
        $this->db->select("*");
        $this->db->from('tbl_admin');
        $this->db->where('b_status', 1);
        return $this->db->get()->result();
    }

    public function update($data = []) {
        return $this->db->where('pk_i_admin_id', $data['pk_i_admin_id'])
                        ->update($this->table, $data);
    }

    public function delete($dprt_id = null) {
        $this->db->where('pk_i_admin_id', $dprt_id)
                ->delete($this->table);

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function department_list() {
        $result = $this->db->select("*")
                ->from($this->table)
                ->where('status', 1)
                ->get()
                ->result();

        $list[''] = display('select_department');
        if (!empty($result)) {
            foreach ($result as $value) {
                $list[$value->dprt_id] = $value->name;
            }
            return $list;
        } else {
            return false;
        }
    }

    public function delete_userrole($user_role = null) {
        if(empty($this->session->userdata('isLogIn')))
        redirect('login');
        $this->db->where('use_id', $user_role)
                ->delete('tbl_user_role');

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    //Select user to update..
    public function get_user_role($role_id) {

        return $this->db->select('*')
                        ->from('tbl_user_role')
                        ->where('use_id', $role_id)
                        ->get()
                        ->row();
    }
	
	public function get_user_role_cid() {
$company=$this->session->userdata('companey_id');
        return $this->db->select('*')
                        ->from('tbl_user_role')
                        ->where('comp_id', $company)
                        ->get()
                        ->result();
    }

    //Update User Role..
    public function update_user_role($id, $data) {

        return $this->db->where('use_id', $id)
                        ->update('tbl_user_role', $data);
    }

    //Display country list in user create form
    public function display_country() {

        return $this->db->select('*')
                        ->from('tbl_country')
                        ->where('comp_id',$this->session->userdata('companey_id'))
                        ->get()
                        ->result();
    }

    public function get_empid() {

        return ($this->db->select('pk_i_admin_id')->order_by('pk_i_admin_id', "desc")->limit(1)->get('tbl_admin')->row()->pk_i_admin_id) + 1;
    }

    //get user list
    public function user_list() {
        return $this->db->select('*')
                        ->from('tbl_admin')
                        ->where('companey_id',$this->session->companey_id)
                        ->get()
                        ->result();
    }

    public function types_list() {
        return $this->db->select('*')
                        ->from('tbl_partner_type')
                        ->get()
                        ->result();
    }

    public function update_inputfileds($arr,$id,$user_id){
    
       return $this->db->where('input_id', $id)
                        ->where('company_id',$user_id)
                        ->update('tbl_input', $arr);
    }


    public function get_input_basic_fields($comp_id){
      return $this->db->select('basic_fields.id,basic_fields.type,basic_fields.title,enquiry_fileds_basic.status,enquiry_fileds_basic.process_id,input_types.title as type_title')
                        ->from('basic_fields')
                        ->join('enquiry_fileds_basic','enquiry_fileds_basic.field_id=basic_fields.id','left')
                        ->join('input_types','input_types.id=basic_fields.type','inner')
                        ->group_by('basic_fields.id')
                        ->where('enquiry_fileds_basic.comp_id',$comp_id)
                        ->order_by('enquiry_fileds_basic.fld_order','ASC')
                        ->get()                        
                        ->result_array();
    }

    

}
