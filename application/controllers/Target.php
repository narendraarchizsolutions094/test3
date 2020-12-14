<?php
class Target extends CI_controller
{

	public function index()
	{

	}
	public function set_target()
	{
		$this->load->model('User_model');
		
		$data['title'] = 'Set Goal';
		$data['roles'] = $this->db->where('comp_id',$this->session->companey_id)->get('tbl_user_role')->result();
		$data['users'] = $this->db->where('companey_id',$this->session->companey_id)->get('tbl_admin')->result();
		$data['content'] = $this->load->view('target/set_target',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	public function divide_target()
	{

		if($this->input->post())
		{
			$this->load->model('User_model');

			$all_users = $this->User_model->get_users_by_role($this->input->post('for'));

			echo'<table class="table table-bordered table-striped">
			<tr>
			<th>Name</th>
			';
			$target_value = $this->input->post('value');
			$period = $this->input->post('period');

			$months  = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$quarter = array('Quarter 1', 'Quarter 2','Quarter 3');
			$per_period = $target_value;

			if($period=='year')
			{
				foreach ($months as $value)
				{
					echo'<th>'.$value.'</th>';
				}
				$per_period = (int)($target_value/12);
			}
			else if($period=='quarterly')
			{
				foreach ($quarter as $value)
				{
					echo'<th>'.$value.'</th>';
				}
				$per_period = (int)($target_value/3);
			}

			echo'</tr>';
			if(count($all_users))
			{

				$per_user = (int) ($per_period / count($all_users));

				foreach ($all_users as $user)
				{
					echo'<tr>
						<td>'.$user->s_display_name.'</td>';

						if($period=='year')
						{
							foreach ($months as $value)
							{
								echo'<th><input type="number" value="'.$per_user.'" style="width:90px;"></th>';
							}
						}
						else if($period=='quarterly') 
						{
							foreach ($quarter as $value)
							{
								echo'<th><input type="number" value="'.$per_user.'" style="width:90px;"></th>';
							}
						}

					echo'</tr>';
				}

			}else{

			}
			echo'</table>';
		}	
	}

}
?>