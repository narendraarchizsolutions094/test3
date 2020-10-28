<?php
class Holiday_Model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function add_festival($data)
	{
		$this->db->insert('festivals',$data);
		$this->session->set_flashdata('SUCCESSMSG','Festival Added.');
	}

	public function getFestival($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->get('festivals');
	}

	public function add_holiday($data)
	{
		$this->db->insert('holidays',$data);
		$this->session->set_flashdata('SUCCESSMSG','Holiday Added.');
	}

	public function holiday_table()
	{
		return $this->db->select('holi.date,holi.status,fes.festival_name,st.state,ct.city')
					->from('holidays as holi')
					->join('festivals as fes','fes.id=holi.festival','left')
					->join('state as st','st.id=holi.state','left')
					->join('city as ct','ct.id=holi.city','left')
					->get()
					->result_array();
	}
}