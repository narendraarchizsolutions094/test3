<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
var Ignore = new Array();
</script>

<div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
	<div class="col-md-4 col-sm-4 col-xs-4"> 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a> 
          <?php
          if(!empty($this->session->process) && (is_array($this->session->process)?(count($this->session->process)==1?true:false):true))
			{
				?>
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" data-toggle="modal" data-target="#add_goal" title="Add Goal"></a>    

          <?php
          }
          ?>  
        </div>
</div>
<div class="row" style="margin: 15px;">
<form id="filter_form">
	<div class="col-sm-4">
		<div class="form-group">
			<label>From - To</label>
			<div class="input-group">
				<input type="date" name="date_from" class="form-control" style="width: 50%">
				<input type="date" name="date_to" class="form-control" style="width:50%">
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<label>For Role</label>
			<select class="form-control" name="role_for">
				<option value="">Select</option>
				<?php
				if(!empty($roles))
				{
					$rol = json_decode($roles);
					foreach ($rol as $row)
					{
						echo'<option value="'.$row->id.'">'.$row->role_name.'</option>';
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			<label>For User</label>
			<select class="form-control" name="user_for">
				<option value="">Select</option>
				<?php
				if(!empty($users))
				{
					$rol = json_decode($users);
					foreach ($rol as $row)
					{
						echo'<option value="'.$row->id.'">'.$row->user_name.'</option>';
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<label>Metric</label>
			<select class="form-control" name="metric_type">
				<option value="">Select</option>
				<option value="won">Won Deals</option>
				<option value="deal">Deal Value</option>
			</select>
		</div>
	</div>
</form>
</div>

<div class="panel">
	<div class="panel-body" id="goal_table">

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		load_table();
	});
$("#filter_form").change(function(){
			load_table();
		});
	function load_table()
	{
		var custom_filter = $("#filter_form").serialize();
		//alert(custom_filter);
		$.ajax({
			url:"<?=base_url('Target/load_goal_table')?>",
			type:'post',
			data:custom_filter,
			beforeSend:function(){
				$("#goal_table").html('<center><i class="fa fa-spinner fa-spin" style="font-size:77px;"></i><center>');
			},
			success:function(res){
				$("#goal_table").html(res);
			},
			error:function(u,v,w)
			{
				alert(w);
			}
		});
	}
</script>



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
		    <div class="col-sm-8" style="padding: 4px">
				<label>Products</label>
				<select name="products[]" class="select2" multiple>
					<?php
					if(!empty($product_list))
					{
						foreach ($product_list as $row)
						{
							echo'<option value="'.$row->id.'">'.$row->country_name.'</option>';
						}
					}	
					?>
				</select>
			</div>
		</div>
		<div class="row">
            <div class="form-group">
  				<div class="col-sm-4" style="padding: 4px;">
  					<label>Time Range <font color="red">*</font></label>      
					<select class="form-control"  name="time_range" onchange="setTimeRange()" required>
		        	</select>
		        </div>
		        <div class="col-sm-4" style="padding: 4px;">
					<label>From <font color="red">*</font></label>
					<input type="date" name="period_from" class="form-control" readonly required>
				</div>
				 <div class="col-sm-4" style="padding: 4px;">
					<label>To <font color="red">*</font></label>
					<input type="date" name="period_to" class="form-control" readonly required>
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
$(document).ready(function(){
	$(".select2").select2();
});	


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
	setTimeRange();
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

function setTimeRange()
{
	var time_range = $('select[name=time_range]').val();
	var period = $('select[name=goal_period]').val();
	
	var date_from;
	var date_to;

	var month,day,year;

	var d = new Date();

	if(time_range=='custom')
	{
		$("input[name=period_from]").val('').removeAttr('readonly');
		$("input[name=period_to]").val('').removeAttr('readonly');
		return;
	}

	if(period=='weekly')
	{
		if(time_range=='1')
		{	
			var from = manageDate(d,0,0,0);
			var to = manageDate(d,7,0,0);
		}
		else if(time_range=='2')
		{	
			d.setDate(d.getDate()+7);

			var from = manageDate(d,0,0,0);
			var to = manageDate(d,7,0,0);
		}
	}
	else if(period=='monthly')
	{
		if(time_range=='1')
		{	d.setDate(1);
			var from = manageDate(d,0,0,0);
			d.setDate(0);
			var to = manageDate(d,0,1,0);
		}
		else if(time_range=='2')
		{	
			d.setMonth(d.getMonth()+1);
			d.setDate(1);
			var from = manageDate(d,0,0,0);
			d.setDate(0)
			var to = manageDate(d,0,1,0);
		}
	}
	else if(period=='quarterly')
	{
		if(time_range=='1')
		{	d.setDate(1);
			var from = manageDate(d,0,0,0);
			d.setDate(0);
			var to = manageDate(d,0,4,0);
		}
		else if(time_range=='2')
		{	
			d.setMonth(d.getMonth()+4);
			d.setDate(1);
			var from = manageDate(d,0,0,0);
			d.setDate(0)
			var to = manageDate(d,0,4,0);
		}
	}
	else if(period=='yearly')
	{
		if(time_range=='1')
		{	d.setDate(1);
			d.setMonth(0);
			var from = manageDate(d,0,0,0);
			d.setDate(0);
			var to = manageDate(d,0,0,1);
		}
		else if(time_range=='2')
		{	
			d.setDate(1);
			d.setMonth(0);
			d.setFullYear(d.getFullYear()+1);
			var from = manageDate(d,0,0,0);
			d.setDate(0);
			var to = manageDate(d,0,0,1);
		}
	}

		$("input[name=period_from]").val(from).attr('readonly','readonly');
		$("input[name=period_to]").val(to).attr('readonly','readonly');
}

function manageDate(cur_date,day,month,year)
{
	var d = new Date(cur_date);
		d.setDate(d.getDate()+day);
		d.setMonth(d.getMonth()+month);
		d.setFullYear(d.getFullYear()+year);

		month = '' + (d.getMonth() + 1);
        day = '' + d.getDate();
        year = d.getFullYear();

        if (month.length < 2) 
	        month = '0' + month;
	    if (day.length < 2) 
	        day = '0' + day;

		return [year,month,day].join('-');
}
</script>