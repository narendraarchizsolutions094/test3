<?php
class Target extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Target_Model');
	}

	public function index()
	{
		//$this->session->process = array(197);
		$this->load->model('location_model');
		$data['title'] = display('all_goals');

		$roles = $this->db->where('comp_id',$this->session->companey_id)->get('tbl_user_role')->result();
		$r = array();
		foreach ($roles as $role)
		{
			$r[] =array('id'=>$role->use_id,
						'role_name'=>$role->user_role);
		}
		$data['roles'] = json_encode($r);

		$users  = $this->db->where('companey_id',$this->session->companey_id)->get('tbl_admin')->result();
		
		$u = array();
		foreach ($users as $user)
		{
			$u[] =array('id'=>$user->pk_i_admin_id,
						'user_name'=>$user->s_display_name);
		}
		$data['users'] = json_encode($u);

		$data['product_list'] = $this->location_model->productcountry();

		$data['all_goals'] = $this->Target_Model->getGoals();
		
		$data['content'] = $this->load->view('target/goal_list',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	public function save_goal()
	{
		$this->load->model('Target_Model');

		if($this->input->post())
		{
			$process = $this->session->process;
			if(!empty($process))
			{
				if(is_array($process))
				{
					if(count($process)==1)
						$process_id = $process[0];
					else
					{
						$this->session->set_flashdata('message','Selected Only one Process.');
					redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$process_id = $process;
				}
			}
			else 
			{
				$this->session->set_flashdata('message','No process is Selected.');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$target_list = implode(',', $this->input->post('target_list[]'));
			$data = array('goal_period'=>$this->input->post('goal_period'),
							'time_range' =>$this->input->post('time_range'),
							'date_from' =>$this->input->post('period_from'),
							'date_to' =>$this->input->post('period_to'),
							'goal_type' =>$this->input->post('goal_type'),
							'goal_for' =>$target_list,
							'metric_type' =>$this->input->post('metric_type'),
							'target_value' =>$this->input->post('target_value'),
							'products' => implode(',',$this->input->post('products')),
							'comp_id' =>$this->session->companey_id,
							'process_id' =>$process_id,
							'created_by'=>$this->session->user_id,
						);
			
			if($data['goal_type']=='team')
			{	
				$data['custom_target'] = json_encode($this->input->post('user_target_value'));
				$keys = array();
				foreach ($this->input->post('user_target_value') as $key => $value)
				{
					if($value>0)
						$keys[] = $key;
				}
				//exit();
				$data['team_id'] =$target_list;
				$data['goal_for'] = implode(',', $keys);
			}

			$this->Target_Model->save_goal($data);
			redirect(base_url('Target/index'));
		}	
	}

	// public function divide_target()
	// {

	// 	if($this->input->post())
	// 	{
	// 		$this->load->model('User_model');

	// 		$all_users = $this->User_model->get_users_by_role($this->input->post('for'));

	// 		echo'<table class="table table-bordered table-striped">
	// 		<tr>
	// 		<th>Name</th>
	// 		';
	// 		$target_value = $this->input->post('value');
	// 		$period = $this->input->post('period');

	// 		$months  = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	// 		$quarter = array('Quarter 1', 'Quarter 2','Quarter 3');
	// 		$per_period = $target_value;

	// 		if($period=='year')
	// 		{
	// 			foreach ($months as $value)
	// 			{
	// 				echo'<th>'.$value.'</th>';
	// 			}
	// 			$per_period = (int)($target_value/12);
	// 		}
	// 		else if($period=='quarterly')
	// 		{
	// 			foreach ($quarter as $value)
	// 			{
	// 				echo'<th>'.$value.'</th>';
	// 			}
	// 			$per_period = (int)($target_value/3);
	// 		}

	// 		echo'</tr>';
	// 		if(count($all_users))
	// 		{

	// 			$per_user = (int) ($per_period / count($all_users));

	// 			foreach ($all_users as $user)
	// 			{
	// 				echo'<tr>
	// 					<td>'.$user->s_display_name.'</td>';

	// 					if($period=='year')
	// 					{
	// 						foreach ($months as $value)
	// 						{
	// 							echo'<th><input type="number" value="'.$per_user.'" style="width:90px;"></th>';
	// 						}
	// 					}
	// 					else if($period=='quarterly') 
	// 					{
	// 						foreach ($quarter as $value)
	// 						{
	// 							echo'<th><input type="number" value="'.$per_user.'" style="width:90px;"></th>';
	// 						}
	// 					}

	// 				echo'</tr>';
	// 			}

	// 		}else{

	// 		}
	// 		echo'</table>';
	// 	}	
	//}

	public function divide_target()
	{
		$role_id = $this->input->post('role_id');
		$target_value = $this->input->post('target_value');
		$ignore = $this->input->post('ignore')!=''?explode(',',$this->input->post('ignore')):array();
		
		$this->load->model('User_model');

		$all_users = $this->User_model->get_users_by_role($role_id);

		if(!empty($all_users))
		{
			$divisor = count($all_users)-count($ignore);
			if($divisor==0)
			{
				echo'<center> <font color="red">Can not Remove All.</font></center>';
				unset($ignore[count($ignore)-1]);
				$divisor = count($all_users)-count($ignore);
			}

			$per_user = round((int)$target_value / $divisor,2);

			echo'<ul class="list-group">';

				foreach ($all_users as $res)
				{
				echo'<li class="list-group-item">
						<input type="checkbox" data-toggle="toggle" data-size="mini" value="'.$res->pk_i_admin_id.'" '.(in_array($res->pk_i_admin_id,$ignore)?'':'checked').'>
						&nbsp;
					'.$res->s_display_name.'
					<input type="number" class="form-control pull-right target_value_input" style="width:130px; height:25px;" name="user_target_value['.$res->pk_i_admin_id.']" value="'.(in_array($res->pk_i_admin_id,$ignore)?0:$per_user).'">
					</li>';
				}

			echo'</ul>';

		}
		else
		{
			echo'<center>Empty Team</center>';
		}

	}

	public function goal_details($goal_id)
	{
		$this->load->model('Target_Model');

		$data['title'] = 'Goal Details';
		$data['goal'] = $this->Target_Model->getGoals(array('goals.goal_id'=>$goal_id))[0];
		$data['content'] = $this->load->view('target/goal_details',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

}
?>