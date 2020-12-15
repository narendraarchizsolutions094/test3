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
		if($where)
			$this->db->where($where);
		$this->db->where('comp_id',$this->session->companey_id);
		return $this->db->get('tbl_goals');
	}


	public function getForecast($goal_id)
	{	
		$this->db->select('goals.*,sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt')
				->from('tbl_goals goals')
				->join('commercial_info info','info.createdby IN (goals.goal_for)','left')
				->join('enquiry','enquiry.enquiry_id=info.enquiry_id','left');
		$this->db->where('enquiry.lead_expected_date BETWEEN goals.date_from and goals.date_to');
		$this->db->where('goals.goal_id',$goal_id);
		$this->db->where('goals.comp_id',$this->session->companey_id);
		return $this->db->get();
			//echo $this->db->last_query(); exit();
	}
	
	public function getAchieved($goal_id)
	{
		$this->db->select('goals.*,sum(info.expected_amount) as e_amnt,sum(info.potential_amount) as p_amnt')
				->from('tbl_goals goals')
				->join('commercial_info info','info.createdby IN (goals.goal_for) and info.status=1','left')
				->join('enquiry','enquiry.enquiry_id=info.enquiry_id','left');
		$this->db->where('info.updation_date BETWEEN goals.date_from and goals.date_to');
		$this->db->where('goals.goal_id',$goal_id);
		$this->db->where('goals.comp_id',$this->session->companey_id);
		return $this->db->get();
	}

}