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

	public function getGoals($where=0)
	{	
		$this->load->model('common_model');
		
		$all_reporting_ids    =   $this->common_model->get_categories($this->session->user_id);

		//print_r($all_reporting_ids); exit();

		$this->db->select('goals.*,role.user_role');
		$this->db->from('tbl_goals goals');
		$this->db->join('tbl_user_role role','role.use_id=goals.team_id','left');
		if($where)
			$this->db->where($where);
		$this->db->where('goals.comp_id',$this->session->companey_id);
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


	public function getForecast($goal_id)
	{	
		$goal  = $this->getGoals(array('goal_id'=>$goal_id))[0];
		if(!empty($goal))
		{
			$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt')
				->from('enquiry')
				->join('commercial_info info','info.enquiry_id = enquiry.enquiry_id and info.createdby IN ('.$goal->goal_for.') and info.status IN (0,1)','inner');
			$this->db->where('enquiry.lead_expected_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'"');
			//$this->db->where('enquiry.status=2');
			return $this->db->get()->row();
			//echo $this->db->last_query(); exit();
		}
		else
			return false;
	
	}

	public function getAchieved($goal_id)
	{
		$goal  = $this->getGoals(array('goal_id'=>$goal_id))[0];
		if(!empty($goal))
		{
			$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt')
				->from('enquiry')
				->join('commercial_info info','info.enquiry_id=enquiry.enquiry_id and info.createdby IN ('.$goal->goal_for.') and info.status=1	','inner');
			$this->db->where('enquiry.client_created_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'" ');
			//$this->db->where('enquiry.status=3');
			return $this->db->get()->row();
				//echo $this->db->last_query(); exit();
		}
		else
			return false;
	}

	public function getUserWiseForecast($goal_id,$user_id)
	{
		$goal  = $this->getGoals(array('goal_id'=>$goal_id))[0];

		$res =$this->db->select('*, sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt ')
					->from('tbl_admin admin')
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
			$this->db->select('sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt')
				->from('enquiry')
				->join('commercial_info info','info.enquiry_id=enquiry.enquiry_id and info.createdby = '.$user_id.' and info.status =1 ','inner');
			$this->db->where('enquiry.client_created_date BETWEEN "'.$goal->date_from.'" and "'.$goal->date_to.'"');
			//$this->db->where('enquiry.status=3');
			return $this->db->get()->row();
				//echo $this->db->last_query(); exit();
		}
		else
			return false;
	}

}