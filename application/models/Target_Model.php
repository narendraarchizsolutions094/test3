<?php
/**
 * 
 */
class Target_Model extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save_goal($data,$id=0)
	{
		if($id)
		{
			$this->db->where('goal_id',$id)->update('tbl_goals',$data);
			return $this->db->affected_rows();
		}
		else 
		{
			$this->db->insert('tbl_goals',$data);
			return $this->db->insert_id();
		}
	}
	public function getGoals($where=0,$fetch_type=0,$user=0)
	{	
		$this->load->model('common_model');
		
		//$this->common_model->list = array();

		$allowed_user = $this->common_model->get_categories($user);
		// if($graph){
		// 	//echo $user;
		// 	print_r($allowed_user); exit();
		// }
		//$this->common_model->list = array();
		$chk = $this->common_model->get_categories($this->session->user_id);
		
		if($user)
		{
			if(!in_array($user, $chk))
			{
				return false;
			}
		}
		// ==================

		if($fetch_type=='1' && $user)
		{
			$all_reporting_ids = array($user);
		}
		else if($fetch_type=='2' && $user)
		{ //echo $user; //exit();
			$all_reporting_ids    = $allowed_user;  
			//print_r($all_reporting_ids); exit();
		}
		else if($fetch_type=='2')
		{	//$this->common_model->list = array();
			$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
		}
		else if($fetch_type=='1')
		{	//$this->common_model->list = array();
			$all_reporting_ids = array($this->session->user_id);
		}
		else
		{	//$this->common_model->list = array();
			$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);
		}
		
		$process = $this->session->process;

		$this->db->select('goals.*,role.user_role,added.s_display_name as added_by');
		$this->db->from('tbl_goals goals');
		$this->db->join('tbl_user_role role','role.use_id=goals.team_id','left');
		$this->db->join('tbl_admin added','added.pk_i_admin_id=goals.created_by','left');
		if($where)
			$this->db->where($where);
		$this->db->where('goals.comp_id',$this->session->companey_id);
		$this->db->where('goals.process_id IN ('.implode(',',$process).')');
		$res =  $this->db->get();
		$data = array();
		foreach ($res->result() as $row)
		{
			$a = explode(',', $row->goal_for);
			$inter = array_intersect($all_reporting_ids, $a);
			if(count($inter))
			{
				$row->goal_for = implode(',', $inter);
				$sum=0;
				if($row->goal_type=='team')
				{
					$tar = json_decode($row->custom_target);
					foreach ($tar as $key => $value) {
						if(in_array($key,$inter))
							$sum+=$value;
					}
					$row->target_value = $sum;
				}
				$data[] = $row;
			}
		}
		//print_r($data); exit();
		return $data;
	}

	public function getForecast($goal_id,$fetch_type,$user)
	{	
		$goal  = @$this->getGoals(array('goal_id'=>$goal_id),$fetch_type,$user)[0];
		// echo print_r($goal).'fore';	
		//  exit();
		if(!empty($goal))
		{	
			if($goal->metric_type=='deal')
				$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,COUNT(DISTINCT(info.id)) as info_count,GROUP_CONCAT(info.id) as info_ids,COUNT(DISTINCT(enquiry.enquiry_id)) as enq_count,GROUP_CONCAT(DISTINCT(enquiry.enquiry_id)) as enq_ids');
			else
				$this->db->select('count(id) as num_value,COUNT(DISTINCT(info.id)) as info_count,GROUP_CONCAT(info.id) as info_ids,COUNT(DISTINCT(enquiry.enquiry_id)) as enq_count,GROUP_CONCAT(DISTINCT(enquiry.enquiry_id)) as enq_ids');

			if(!empty($goal->products))
				$this->db->where('enquiry.enquiry_source IN ('.$goal->products.')');

			$this->db->from('enquiry')
				->join('commercial_info info','info.enquiry_id = enquiry.enquiry_id and info.createdby IN ('.$goal->goal_for.') and info.status IN (0,1)','inner');
			$this->db->where('enquiry.lead_expected_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'"');	
			//$this->db->where('enquiry.status=2');

			 $res =$this->db->get()->row();
			//if($goal_id!=38)
			 return $res;
			echo $this->db->last_query(); exit();
		}
		else
			return false;
	
	}
	public function getAchieved($goal_id,$fetch_type,$user)
	{
		$goal  = @$this->getGoals(array('goal_id'=>$goal_id),$fetch_type,$user)[0];
		if(!empty($goal))
		{
			if($goal->metric_type=='deal')
				$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,COUNT(DISTINCT(info.id)) as info_count,GROUP_CONCAT(info.id) as info_ids,COUNT(DISTINCT(enquiry.enquiry_id)) as enq_count,GROUP_CONCAT(DISTINCT(enquiry.enquiry_id)) as enq_ids');
			else
				$this->db->select('count(id) as num_value,sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,COUNT(DISTINCT(info.id)) as info_count,GROUP_CONCAT(info.id) as info_ids,COUNT(DISTINCT(enquiry.enquiry_id)) as enq_count,GROUP_CONCAT(DISTINCT(enquiry.enquiry_id)) as enq_ids');

			
			if(!empty($goal->products))
				$this->db->where('enquiry.enquiry_source IN ('.$goal->products.')');

			$this->db->from('enquiry')
				->join('commercial_info info','info.enquiry_id=enquiry.enquiry_id and info.createdby IN ('.$goal->goal_for.') and info.status=1	','inner');
			$this->db->where('enquiry.client_created_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'" ');
			//$this->db->where('enquiry.status=3');
			$res = $this->db->get()->row();
			//if($goal_id!=38)
			return  $res;
				//echo $this->db->last_query(); exit();
		}
		else
			return false;
	}
	public function getUserWiseForecast($goal_id,$user_id)
	{
		$goal  = $this->getGoals(array('goal_id'=>$goal_id))[0];
		if($goal->metric_type=='deal')
		$this->db->select('*, sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,GROUP_CONCAT(info.id) as info_ids, ');
		else
			$this->db->select('*, count(*) as num_value,GROUP_CONCAT(info.id) as info_ids,');

		if(!empty($goal->products))
				$this->db->where('enquiry.enquiry_source IN ('.$goal->products.')');

	$res =	$this->db->from('tbl_admin admin')
					->join('commercial_info info','info.createdby=admin.pk_i_admin_id and info.status IN (0,1)','inner')
					->join('enquiry','enquiry.enquiry_id=info.enquiry_id','inner')
					->where('enquiry.lead_expected_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'"')
					->where('admin.pk_i_admin_id',$user_id)
					->get()->row();
					//echo $this->db->last_query();exit();
		//print_r($res); exit();
		return $res;
	}
	public function getUserWiseAchieved($goal_id,$user_id)
	{
		$goal  = $this->getGoals(array('goal_id'=>$goal_id))[0];
		if(!empty($goal))
		{
			
			if($goal->metric_type=='deal')
				$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,GROUP_CONCAT(info.id) as info_ids,');
			else
				$this->db->select('*, count(*) as num_value,sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt,GROUP_CONCAT(info.id) as info_ids,');

			if(!empty($goal->products))
				$this->db->where('enquiry.enquiry_source IN ('.$goal->products.')');

			$this->db->from('enquiry')
				->join('commercial_info info','info.enquiry_id=enquiry.enquiry_id and info.createdby = '.$user_id.' and info.status =1 ','inner');
			$this->db->where('enquiry.client_created_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'"');
			//$this->db->where('enquiry.status=3');
			return $this->db->get()->row();
				//echo $this->db->last_query(); exit();
		}
		else
			return false;
	}

	public function update_goal($where,$data)
	{
		$this->db->where($where)->update('tbl_goals',$data);
		// echo $this->db->last_query();
		// echo $this->db->affected_rows(); exit();
	}

}