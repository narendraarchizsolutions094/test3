<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/css/query-builder.default.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
					   			<option value="3" <?=(!empty($rule_data['type']) && $rule_data['type']==3)?'selected':''?>>Mail Send</option>
					   			<option value="4" <?=(!empty($rule_data['type']) && $rule_data['type']==4)?'selected':''?>>Auto Followup</option>
					   			<option value="5" <?=(!empty($rule_data['type']) && $rule_data['type']==5)?'selected':''?>>Support Ticket Escalation Rule</option>
					   			<option value="6" <?=(!empty($rule_data['type']) && $rule_data['type']==6)?'selected':''?>>Send SMS </option>
					   			<option value="7" <?=(!empty($rule_data['type']) && $rule_data['type']==7)?'selected':''?>>Send WhatsApp</option>
					   			<option value="8" <?=(!empty($rule_data['type']) && $rule_data['type']==8)?'selected':''?>>Auto Ticket Priority</option>
					   			<option value="9" <?=(!empty($rule_data['type']) && $rule_data['type']==9)?'selected':''?>>Default Ticket Disposition</option>
					   		</select>
					   	</div>
					   	<div class="col-sm-3">
					   		<label>Rule Title <i style="color: red;">*</i></label>
					   		<input type="text" name="title" id="ruletitle" class="form-control" required value="<?=!empty($rule_data['title'])?$rule_data['title']:''?>">
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
			        			<input type="text" name="action" class="form-control text-center" value="<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>">
		        			</div>
		        		</div>
		        		<div class="row text-center action-section" id="assignment_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Assign To<i style="color: red;">*</i></label>
			        			<select class="form-control text-center multiple-select" name="assignment_action" multiple>			    
			        				<?php
			        				$assignment_action_data = array();
			        				if(!empty($rule_data['rule_action']))
			        					$assignment_action_data = explode(',', $rule_data['rule_action']);

			        				if (!empty($user_list)) {
			        					foreach ($user_list as $key => $value) {
			        						?>
			        						<option value="<?=$value->pk_i_admin_id?>" <?=(	!empty($rule_data['rule_action']) && in_array($value->pk_i_admin_id, $assignment_action_data) )?'selected':''?>>
			        							<?=$value->s_user_email?>
			        						</option>
			        						<?php
			        					}
			        				}
			        				?>    			
			        			</select>
		        			</div>
		        		</div>
		        		<div class="row text-center action-section" id="email_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Select Template<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="action" id="email_template">			    
			        			</select>
		        			</div>
		        		</div>
						<div class="row text-center action-section" id="priority_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Select Priority<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="action" id="default_priority">
			        			<option value="1" <?=@$rule_data['rule_action']=='1'?'selected':''?>>Low</option>
			        			<option value="2"  <?=@$rule_data['rule_action']=='2'?'selected':''?>>Medium</option>
			        			<option value="3"  <?=@$rule_data['rule_action']=='3'?'selected':''?>>High</option>			    
			        			</select>
		        			</div>
		        		</div>
						
		        		<div class="row text-center action-section" id="sms_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Select Template<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="action" id="sms_template">			    
			        			</select>
		        			</div>
		        		</div>
		        		<div class="row text-center action-section" id="whatsapp_action" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Select Template<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="action" id="whatsapp_template">			    
			        			</select>
		        			</div>
		        		</div>
		        		
		        		<div class="row text-center action-section" id="auto_followup_section" style="display: none;">   
		        			<h3>Action</h3>
		        			<div class="col-md-4"></div>
		        			<div class="col-md-4">		        				
			        			<label>Auto Followup after<i style="color: red;">*</i></label>
			        			<input class="form-control text-center" name="action" id="auto_followup" type="number" min="1" max="8760" value="<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>">
		        			</div>
		        		</div>
		        		<?php
		        		$esc_within = '';
		        		$assign_to = '';
		        		if (!empty($rule_data['rule_action']) && $rule_data['type'] == 5) {
		        			$act = json_decode($rule_data['rule_action'],true);		        			
		        			$esc_within = $act['esc_hr'];
		        			$assign_to  = $act['assign_to'];
		        		}
		        		?>
		        		<div id="ticket_esc_action" class="action-section text-center row">
		        				<h3>Action</h3>
		        				<div class="col-md-2"></div>
		        			<div class="col-md-4">
			        			<label>Escalate Within (Hours)<i style="color: red;">*</i></label>		        		
		        				<input type="number" name="esc_within" class="form-control text-center" value="<?=!empty($rule_data['rule_action'])?$esc_within:''?>">
		        			</div>
		        			<div class="col-md-4">		        				
			        			<label>Escalate To<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="esc_to">			    
			        				<?php
			        				if (!empty($user_list)) {
			        					foreach ($user_list as $key => $value) {
			        						?>
			        						<option value="<?=$value->pk_i_admin_id?>" <?=(	!empty($rule_data['rule_action']) && $assign_to==$value->pk_i_admin_id)?'selected':''?>>
			        							<?=$value->s_user_email?>
			        						</option>
			        						<?php
			        					}
			        				}
			        				?>    			
			        			</select>
		        			</div>
		        		</div>		 
		        		<div id="disposition_action" class="action-section text-center row">
		        				<h3>Action</h3>
		        				<div class="col-md-2"></div>
		        			<div class="col-md-4">
			        			<label>Stage<i style="color: red;">*</i></label>		        		
		        				<select class="form-control" name="stage"></select>

		        			</div>
		        			<div class="col-md-4">		        				
			        			<label>Sub Stage<i style="color: red;">*</i></label>
			        			<select class="form-control text-center" name="sub_stage"></select>
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
		    id: 'sub_source',
		    label: 'Lead Sub Source',
		    type: 'integer',
		    input: 'select',
		    values: <?=$sub_source?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'enquiry_subsource',
		    label: 'Product',
		    type: 'integer',
		    input: 'select',
		    values: <?=$products?>,
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
		  },{
		    id: 'lead_stage',
		    label: 'Disposition',
		    type: 'integer',
		    input: 'select',
		    values: <?=$lead_stages?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'lead_discription',
		    label: 'Sub Disposition',
		    type: 'integer',
		    input: 'select',
		    values: <?=$lead_description?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'product_id',
		    label: 'Process',
		    type: 'integer',
		    input: 'select',
		    values: <?=$rule_process?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'status',
		    label: 'Enquiry Stage',
		    type: 'integer',
		    input: 'select',
		    values: <?=$rule_enquiry_status?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'tbl_ticket.status',
		    label: 'Ticket Status',
		    type: 'integer',
		    input: 'select',
		    values: <?=$rule_ticket_status?>,
		    operators: ['equal', 'not_equal','is_null', 'is_not_null']
		  },{
		    id: 'tbl_ticket.complaint_type',
		    label: 'Ticket Type',
		    type: 'integer',
		    input: 'select',
		    values: {"0":"Complaint","1":"Query"},
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
		  	var title		=	$("#ruletitle").val();
		  	var rule_status	=	$("input[name='rule_status']:checked").val();
		  	if (rule_type==1) {
		  		var action_value	=	$("input[name='action']").val();
		  	}else if (rule_type==2){
		  		var action_value	=	$("select[name='assignment_action']").val();
		  		action_value	=	action_value.toString();
		  	}else if (rule_type==3){
		  		var action_value	=	$("#email_template").val();
		  	}else if (rule_type==4){
		  		var action_value	=	$("#auto_followup").val();
		  	}else if (rule_type==5){
		  		var esc_hr		=	$("input[name='esc_within']").val();
		  		var assign_to	=	$("select[name='esc_to']").val();
		  		action_value =	JSON.stringify({'esc_hr':esc_hr,'assign_to':assign_to});		  	
		  	}else if (rule_type==6){
		  		var action_value	=	$("#sms_template").val();
		  	}else if (rule_type==7){
		  		var action_value	=	$("#whatsapp_template").val();
		  	}else if (rule_type==8){
		  		var action_value	=	$("#default_priority").val();
		  	}else if (rule_type==9){
		  		var stage		=	$("select[name='stage']").val();
		  		var sub_stage	=	$("select[name='sub_stage']").val();
		  	var	action_value =	JSON.stringify({'stage':stage,'sub_stage':sub_stage});
		  	}
		  	console.info(action_value);
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
							window.location = "<?=base_url().'leadRules'?>";
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
			}else if (rule == 3) {				
				$("#email_action").show(1000);
			}else if (rule == 4) {				
				$("#auto_followup_section").show(1000);
			}else if (rule == 5) {				
				$("#ticket_esc_action").show(1000);
			}else if (rule == 6) {				
				$("#sms_action").show(1000);
			}else if (rule == 7) {				
				$("#whatsapp_action").show(1000);
			}else if (rule == 8) {				
				$("#priority_action").show(1000);
			}else if (rule == 9) {				
				$("#disposition_action").show(1000);
				<?php
				if(empty($rule_data['rule_action']))
				{
					echo'$("select[name=stage]").load("'.base_url().'message/all_stages/4");';
				}
				?>
			}
		}
		$("#email_template").load("<?=base_url().'message/get_templates/3'?>");
		$("#sms_template").load("<?=base_url().'message/get_templates/2'?>");
		$("#whatsapp_template").load("<?=base_url().'message/get_templates/1'?>");
	});
	$(document).ajaxComplete(function() {
		if ("<?=!empty($rule_data['type'])?>") {
	  		$("#email_template").val(<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>);
	  		$("#sms_template").val(<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>);
	  		$("#whatsapp_template").val(<?=!empty($rule_data['rule_action'])?$rule_data['rule_action']:''?>);
		}
	});
	$(".multiple-select").select2();

	$("select[name=stage]").change(function(){ 
		$("select[name=sub_stage]").load("<?=base_url('message/find_substage/')?>"+this.value);
	});

	<?php
	if( !empty($rule_data['rule_action']) && $rule_data['type']==9)
	{
		$res = json_decode($rule_data['rule_action']);
		echo'$("select[name=stage]").load("'.base_url('message/all_stages/4/').$res->stage.'");
		';
		echo'$("select[name=sub_stage]").load("'.base_url('message/find_substage/').$res->stage.'/'.$res->sub_stage.'");';
	}
	?>

</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.query-builder/2.3.3/js/query-builder.standalone.min.js"></script>