<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/css/query-builder.default.min.css">
<div>	
   	<div class="row">
	   	<div class="col-sm-12">
	      	<div  class="panel panel-default thumbnail">
		        <div class="panel-heading no-print">
		            <div class="btn-group"> 
		               <a class="btn btn-primary" href="<?php echo base_url("leadRules") ?>"> <i class="fa fa-list"></i> <?php echo display('leadrules') ?> </a>  
		            </div>
		        </div>
		        <div class="panel-body">
		        	<div class="row">					   		   	
					   	<div class="col-sm-3">					   	
					   		<label>Rule For<i style="color: red;">*</i></label>
					   		<select class="form-control" id="rule">
					   			<option value="">Choose Rule</option>
					   			<option value="1" <?=(!empty($rule_data['type']) && $rule_data['type']==1)?'selected':''?> >Lead Score</option>
					   			<option value="2" <?=(!empty($rule_data['type']) && $rule_data['type']==2)?'selected':''?>>Lead Assignment</option>
					   		</select>
					   	</div>
					   	<div class="col-sm-3">
					   		<label>Rule Title <i style="color: red;">*</i></label>
					   		<input type="text" name="title" id="title" class="form-control" required value="<?=!empty($rule_data['title'])?$rule_data['title']:''?>">
					   	</div>
					   	<div class="col-sm-3">
					   		<label>Rule Status <i style="color: red;">*</i></label><br>
					   		<input type="checkbox" name="rule_status" value='1' class="switch" <?=(!empty($rule_data['status']) && $rule_data['status']==1)?'checked':''?>>
					   	</div>
				   </div>
				   <br>
				   <br>
				   <div class="row">   
					   	<div class="col-sm-12">
			           <div id="builder"></div>
				   		<br>
			           	<div class="row text-center action-section" id="score_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Lead Score<i style="color: red;">*</i></label>
			        			<input type="text" name="action" class="form-control" value="<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>">
		        			</div>
		        		</div>
		        		<div class="row text-center action-section" id="assignment_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Assign To<i style="color: red;">*</i></label>
			        			<select class="form-control" name="action">			    
			        				<?php
			        				if (!empty($user_list)) {
			        					foreach ($user_list as $key => $value) {
			        						?>
			        						<option value="<?=$value->pk_i_admin_id?>" <?=(	!empty($rule_data['rule_action']) && $rule_data['rule_action']==$value->pk_i_admin_id)?'selected':''?>>
			        							<?=$value->s_user_email?>
			        						</option>
			        						<?php
			        					}
			        				}
			        				?>    			
			        			</select>
		        			</div>
		        		</div>
					   <button class="btn btn-success" id="btn-set"><?=!empty($id)?'Update Rule':'Set Rules'?></button>		
					   <button class="btn btn-warning" id="btn-reset">Reset</button>
					</div>
		        </div>
	     	</div>
	 	</div>
 	</div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		var rules_basic = <?=!empty($rule_data['rule_json'])?$rule_data['rule_json']:"{				  
		    condition: 'OR',
		    rules: [{
		      id: 'country_id'		      
		    }]	  
		}"?>;
	    $('#builder').queryBuilder({
		  plugins: ['bt-tooltip-errors'],		  
		  filters: [{
		    id: 'enquiry_source',
		    label: 'Lead Source',
		    type: 'integer',
		    input: 'select',
		    values: <?=$lead_source?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'country_id',
		    label: 'Country',
		    type: 'integer',
		    input: 'select',
		    values: <?=$country?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'state_id',
		    label: 'State',
		    type: 'integer',
		    input: 'select',
		    values: <?=$state?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'city_id',
		    label: 'City',
		    type: 'integer',
		    input: 'select',
		    values: <?=$city?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  }],
		  rules: rules_basic
		});
	    /****************************************************************
	    						Triggers and Changers QueryBuilder
	 *****************************************************************/		

		$('#btn-reset').on('click', function() {
		  $('#builder').queryBuilder('reset');
		});
		$('#btn-set').on('click', function() {		  
		  var result = $('#builder').queryBuilder('getRules');
		  if (!$.isEmptyObject(result)) {
		  	var rules = result;
		  	var rule_type	=	$("#rule").val();
		  	var title		=	$("#title").val();
		  	var rule_status	=	$("input[name='rule_status']:checked").val();
		  	if (rule_type==1) {
		  		var action_value	=	$("input[name='action']").val();
		  	}else{
		  		var action_value	=	$("select[name='action']").val();
		  	}
		  	if (action_value && title) {
		  		$.ajax({
				      type: 'POST',
				      url: "<?=base_url().'leadRules/save_rule/'.$id?>",
				      data: {
				      	type:rule_type,
				      	rule_json:result,
				      	rule_action:action_value,
				      	rule_title:title,
				      	rule_status:rule_status
				      },				      
				      success: function(resultData) { 
				      	resultData	=	JSON.parse(resultData);
				      	if (resultData.status) {
				      		Swal.fire(
							  'Good job!',
							  resultData.msg,
							  'success'
							);
							window.location = "<?=base_url().'leadrRules'?>";
				      	}else{
				      		Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  html: resultData.msg							  
							});
				      	}
				      }
				});
		  	}else{
		  		Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  html: 'Rule Action is required!'							  
				});
		  	}
		  }
		});
		action_show();
		$("#rule").on('change',function(){
			action_show();
		});
		function action_show(){
			var rule	=	$("#rule").val();
			$(".action-section").hide(1000);			
			if (rule == 1) {			
				$("#score_action").show(1000);
			}else if (rule == 2) {				
				$("#assignment_action").show(1000);
			}
		}
	});
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/js/query-builder.standalone.min.js"></script>