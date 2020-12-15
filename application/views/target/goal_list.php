<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
var Ignore = new Array();
</script>


<div style="padding: 15px; text-align:right;">
	<button class="btn btn-primary" data-toggle="modal" data-target="#add_goal" >Add Goal</button>
</div>

<div class="panel">
	<div class="panel-body">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th rowspan="2">#</th>
						<th rowspan="2">GOAL PERIOD</th>
						<th rowspan="2">METRIC</th>
						<th rowspan="2">For</th>
						<th colspan="3">ATTAINMENT</th>
					</tr>
					<tr><th>T</th><th>F</th><th>A</th></tr>
				</thead>
				<tbody>
				<?php
				if(!empty($all_goals))
				{
					foreach ($all_goals as $goal)
					{

						$target = $goal->target_value;
						if($goal->goal_type=='user')
							$target *=count(explode(',', $goal->goal_for));

						$ci = &get_instance();
						$ci->load->model('Target_Model');
						$Forecast = $ci->Target_Model->getForecast($goal->goal_id)->row();
						$Achieved = $ci->Target_Model->getAchieved($goal->goal_id)->row();
						//print_r($achieved);
						echo'<tr>
							<td>'.$goal->goal_id.'</td>
							<td>'.ucwords($goal->goal_period).' <br>
							<b>'.date('d/m/Y',strtotime($goal->date_from)).' - '.date('d/m/Y',strtotime($goal->date_to)).'</b></td>
							<td>'.($goal->metric_type=='deal'?'Deal value':'Won deals').'</td>
							<td>'.($goal->goal_type=='team'?'Team':'User').'</td>
							<td>'.$target.'</td>
							<td>'.(int)($goal->metric_type=='deal'?$Forecast->p_amnt:$Forecast->e_amnt).'</td>
							<td>'.(int)($goal->metric_type=='deal'?$Achieved->p_amnt:$Achieved->e_amnt).'</td>
							</tr>';
					}
					
				}	
				?>
			</tbody>
		</table>
	</div>
</div>





<!-- ================================== Modal -=-================================= -->
<div id="add_goal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <form onsubmit="return validate_form()" action="<?=base_url('target/save_goal')?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD GOAL</h4>
      </div>
      <div class="modal-body">  
      	<div class="row">      
            <div class="form-group col-sm-4" style="padding: 4px;">  
	            <label>Goal Period <font color="red">*</font></label>       
	            <select class="form-control"  name="goal_period" onchange="load_range(this.value)">
	            	<option value="weekly">Weekly</option>
	            	<option value="monthly">Monthly</option>
	            	<option value="quarterly">Quarterly</option>
	            	<option value="yearly">Yearly</option>
	            </select>         
		    </div>  
		</div>
		<div class="row">
            <div class="form-group">
  				<div class="col-sm-4" style="padding: 4px;">
  					<label>Time Range <font color="red">*</font></label>      
					<select class="form-control"  name="time_range" required>
		        	</select>
		        </div>
		        <div class="col-sm-4" style="padding: 4px;">
					<label>From <font color="red">*</font></label>
					<input type="date" name="period_from" class="form-control" required>
				</div>
				 <div class="col-sm-4" style="padding: 4px;">
					<label>To <font color="red">*</font></label>
					<input type="date" name="period_to" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4" style="padding: 4px;">
				<label>Goal Type <font color="red">*</font></label>
				<select class="form-control"  name="goal_type" onchange="load_values(this.value)" required>
	            	<option value="user">User Goal</option>
	            	<option value="team">Team Goal</option>
	        	</select>
			</div>
			<div class="col-sm-8" style="padding: 4px;">
				<label><span id="goal_type_title"></span> <font color="red">*</font></label>
				<select name="target_list[]" class="form-control" onchange="Ignore = [],viewTeamTable();" required>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4" style="padding: 4px;">
				<label>Metric <font color="red">*</font></label>
				<select name="metric_type" class="form-control" required>
					<option value="deal">Deal Value</option>
					<option value="won">Won Deals</option>
				</select>
			</div>
			<div class="col-sm-8" style="padding: 4px;">
				<label>Target <font color="red">*</font></label>

					<input type="number" name="target_value" class="form-control" onchange="viewTeamTable()" required>
			</div>
		</div>
		<div class="row TeamTableBox" style="display: none; padding:15px 0px;">
			<div class="form-group">
				<label>TARGETS BY TEAM MEMBERS</label>
			</div>
			<div class="TeamTable">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" >Add Goal</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </form>
    </div>
  </div>
</div>
<script type="text/javascript">

load_range('weekly');
function load_range(v)
{

	var range_list = '';
		if(v=='weekly')
		{
			range_list+="<option value='1'>This Week </option><option value='2'>Next Week</option><option value='3'>All weeks this month </option><option value='4'>All weeks this quarter</option><option value='custom'>Custom period</option>";
		}
		else if(v=='monthly')
		{
			range_list+="<option value='1'>This Month </option><option value='2'>Next Month</option><option value='3'>All month this quarter </option><option value='4'>All months this year</option><option value='custom'>Custom period</option>";

		}
		else if(v=='quarterly')
		{
			range_list+="<option value='1'>This Quarter </option><option value='2'>Next Quarter</option><option value='3'>All quarter this year </option><option value='4'>All weeks this quarter</option><option value='custom'>Custom period</option>";
		}
		else if(v=='yearly')
		{
			range_list+="<option value='1'>This Year </option><option value='2'>Next Year</option><option value='custom'>Custom period</option>";
		}

	$("select[name=time_range]").html(range_list);
}

var users = <?=$users?>;
var teams = <?=$roles?>;
function load_values(v)
{
	if(v=='user')
	{
		var sel = $("select[name='target_list[]']");
		$(sel).html('');
		$("#goal_type_title").html('Users');
		
		$(sel).attr('multiple','multiple');

		$(users).each(function(k,v){
			$(sel).append('<option value="'+v.id+'" '+(k==0?'selected':'')+'>'+v.user_name+'</option>');
		});
		$(sel).select2("destroy").select2();
	}
	else if(v=='team')
	{
		var sel = $("select[name='target_list[]']");
		$(sel).html('');
		$("#goal_type_title").html('Team');
		
		$(sel).removeAttr('multiple');

		$(teams).each(function(k,v){
			$(sel).append('<option value="'+v.id+'">'+v.role_name+'</option>');
		});
		$(sel).select2("destroy").select2();

		
	}

	viewTeamTable();
}

var temp='user';
load_values(temp);

function viewTeamTable()
{ 
	if($("select[name=goal_type]").val()=='team')
	{
		var target_for = $("select[name='target_list[]']").val();
		var target_value = $("input[name=target_value]").val();

		$.ajax({
			url:'<?=base_url('Target/divide_target')?>',
			type:'post',
			data:{'role_id':target_for,'target_value':target_value,'ignore':Ignore.toString()},
			success:function(q)
			{
				$(".TeamTableBox").show();
				$(".TeamTable").html(q);
				$('input[type=checkbox]').bootstrapToggle();
				$('input[type=checkbox]').on('change',function(){
					
				
					
					if(this.checked)
					{
						if(Ignore.indexOf(this.value) > -1)
							Ignore.splice(Ignore.indexOf(this.value),1);
					}
					else
					{
						if(Ignore.indexOf(this.value) == -1)
							Ignore.push(this.value);
					}
					viewTeamTable();
					//alert(Ignore.toString());
				});
			},
		});
	}
	else
	{
		$(".TeamTableBox").hide();
		$(".TeamTable").html('');
	}
}

function validate_form()
{
	if($("select[name=goal_type]").val()=='team')
	{
		var list = $(".target_value_input");
		var sum = 0;
		$(list).each(function(k,v){
			sum += parseInt($(v).val());
		});

		var tvalue = $("input[name=target_value]").val();
		//alert(tvalue+' '+sum);
		if(tvalue!=sum)
		{
			alert("Target Value not matched with sum of Team Members Target.")
			return false;
		}
	}
	//return false;
}
</script>