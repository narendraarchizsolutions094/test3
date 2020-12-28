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

			$prod = $this->input->post('products')??array();
			$data = array('goal_period'=>$this->input->post('goal_period'),
							'time_range' =>$this->input->post('time_range'),
							'date_from' =>$this->input->post('period_from'),
							'date_to' =>$this->input->post('period_to'),
							'goal_type' =>$this->input->post('goal_type'),
							'goal_for' =>$target_list,
							'metric_type' =>$this->input->post('metric_type'),
							'target_value' =>$this->input->post('target_value'),
							'products' => implode(',',$prod),
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

	public function load_goal_table()
	{
		$date_from = $this->input->post('date_from')??0;
		$date_to = $this->input->post('date_to')??0;
		$role  = $this->input->post('role_for')??0;
		$user = $this->input->post('user_for')??0;
		$metric_type = $this->input->post('metric_type')??0;
		$where =array();
		if($date_from)
		{
			$where[] = " (goals.date_from >= '".$date_from."')";
 		}

 		if($date_to)
 		{
 			$where[] = " goals.date_to <= '".$date_to."'";
 		}

 		if($role)
 		{
 			$where[] = " goals.team_id = '".$role."'";
 		}
 		if($user)
 		{
 			$where[] = "( FIND_IN_SET(".$user.",goals.goal_for) > 0 )";
 		}
 		if($metric_type)
 		{
 			$where[] = " goals.metric_type = '".$metric_type."'";
 		}
 		//print_r($where); 
		$all_goals = $this->Target_Model->getGoals(implode(' AND ',$where));
		// echo count($all_goals);
		// echo $this->db->last_query(); exit();
			echo'<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th rowspan="2">#</th>
						<th rowspan="2">GOAL PERIOD</th>
						<th rowspan="2">METRIC</th>
						<th rowspan="2">For</th>
						<th colspan="3">ATTAINMENT</th>
						<th rowspan="2" align="center">Status</th>
						<th rowspan="2">Created By</th>
						<th rowspan="2">Created At</th>
					</tr>
					<tr><th>T</th><th>F</th><th>A</th></tr>
				</thead>
				<tbody>';

				if(!empty($all_goals))
				{
					foreach ($all_goals as $goal)
					{
						$target = $goal->target_value;

						if($goal->goal_type=='team'){

							$goal_for_list = '<center>'.$goal->user_role.'</center>';
						}
						else
						{
							$goal_for_list = 'Custom Users';
						}

						if($goal->goal_type=='user')
							$target *=count(explode(',', $goal->goal_for));
						$ci = &get_instance();
						$ci->load->model('Target_Model');
						$Forecast = $ci->Target_Model->getForecast($goal->goal_id,$goal->goal_for);
						$Achieved = $ci->Target_Model->getAchieved($goal->goal_id,$goal->goal_for);
						$forecast_value =(int)($goal->metric_type=='deal'?$Forecast->p_amnt:$Forecast->num_value);
						$achieved_value =(int)($goal->metric_type=='deal'?$Achieved->p_amnt:$Achieved->num_value);
						$percent=0;
						if($target)
								$percent = round(($achieved_value/$target)*100,2);
						if($percent<30)
								$barcolor='danger';
							else if($percent>=30 && $percent<60)
								$barcolor='warning';
							else
								$barcolor='success';

						echo'<tr>
							<td>'.$goal->goal_id.'</td>
							<td>'.ucwords($goal->goal_period).' <br>
							<a href="'.base_url('target/goal_details/'.$goal->goal_id).'"><b>'.date('d/m/Y',strtotime($goal->date_from)).' - '.date('d/m/Y',strtotime($goal->date_to)).'</b></a></td>
							<td>'.($goal->metric_type=='deal'?'Deal value':'Won deals').'</td>
							<td>'.$goal_for_list.'</td>
							<td>'.$target.'</td>
							<td>'.$forecast_value.'</td>
							<td>'.$achieved_value.'</td>
							<td style="text-align:center">
								'.$achieved_value.'/'.$target.'<br>
								<div class="progress" style="border:1px solid #cccccc;">
									  <div class="progress-bar progress-bar-'.$barcolor.' progress-bar-striped" role="progressbar"
									  aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percent.'%; max-width:100%;">
									  </div>
								</div>

								</td>
							<td>'.$goal->added_by.'</td>
							<td>'.(date('d-M-Y',strtotime($goal->created_at)).'<br>'.date('H:i A',strtotime($goal->created_at))).'</td>
							</tr>';
					}
					
				}	
		echo'</tbody>
		</table>';
	}

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