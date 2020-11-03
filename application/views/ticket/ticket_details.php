<div class="col-md-6" style="border: 1px solid #c8ced3;padding: 15px;border-top: none;">
	<div align="center">
	<div class="btn-group" style="padding: 10px;">
		<button class="btn btn-primary active btn-sm" onclick="tabchange(this,0)">Ticket Details</button>
		<button class="btn btn-primary btn-sm" onclick="tabchange(this,1)">Related Tickets</button>
	</div>
	</div>
	<div class="row" id="ticket_details">
<?php echo form_open_multipart(base_url("ticket/update_ticket/".$ticket->ticketno)); ?>


		<?php if($this->session->companey_id==65){ ?>

					<div class="trackingDetails"></div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Tracking Number <i class="text-danger">*</i></label>
						<input type="text" name="tracking_no" class="form-control" onblur="loadTracking(this)" value="<?php if(!empty($ticket->tracking_no)){ echo $ticket->tracking_no;} ?>">
					</div>
				</div>
				<script type="text/javascript">

					$(document).ready(function(){
						loadTracking($("input[name=tracking_no]").get(0));
					});
				</script>
		<?php } ?>

		<div class="col-md-6">
			<div class="form-group">
				<label>Problem For</label>
				<select class="form-control add-select2 choose-client" name = "client" required readonly>
					<?php 
					if(!empty($problem_for))
					{
						foreach($problem_for as $ind => $clt)
						{
				echo "<option value =".$clt->enquiry_id." selected>".$clt->name."</option>";

						}
					} 
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Name</label> 
				<input type="text" name="name" id="ticket_holder" class="form-control" value="<?php if(!empty($ticket->name)){ echo $ticket->name;} ?>" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" value="<?php if(!empty($ticket->tck_email)){ echo $ticket->tck_email;} ?>" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Phone</label>
				<input type="text" name="phone" class="form-control" value="<?php  if(!empty($ticket->phone)){ echo $ticket->phone; } ?>" readonly>
			</div>
		</div>
		<div class="col-md-6" style="display: none;">
			<div class="form-group">
				<label>Complain Date</label>
				<input type = "text" class="form-control add-date-picker" name = "complaindate" value= "<?php echo date("m/d/Y", strtotime($ticket->coml_date)) ?>">
			</div>
		</div>
		<?php if($this->session->companey_id!=83){ ?>
		<div class="col-md-6">
			<div class="form-group">
				<label>Product</label>
				<select name="product" class="form-control">
				<?php
				foreach ($product as $prd)
				{
					echo'<option value="'.$prd->id.'" '.($prd->id==$ticket->product?'selected':'').'>'.$prd->country_name.'</option>';
				}
				?>
				</select>
				<!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->country_name)){ echo $ticket->country_name;} ?>" > -->
			</div>
		</div>
		<?php } ?>
		
		<?php if($this->session->user_right!=214 && 0){ 
			?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nature of Complaint</label>
						<select class="form-control add-select2" name = "issue">
						<option value = ""> -- Select --</option>
						<?php  if(!empty($issues)) {
								foreach($issues as $ind => $issue){
									?><option value = "<?php echo $issue->id ?>" <?php echo ($issue->id == $ticket->issue) ? "selected" : ""; ?> ><?php echo ucfirst($issue->title) ?> </option><?php
								}	
							} ?>
						</select>
					</div>
				</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Source</label>
				<select name="source" class="form-control">
				<?php
				foreach ($leadsource as $sor)
				{
					echo'<option value="'.$sor->lsid.'" '.($sor->lsid==$ticket->sourse?'selected':'').'>'.$sor->lead_name.'</option>';
				}
				?>
				</select>
				<!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->ticket_source)){ echo ucwords($ticket->ticket_source);} ?>" > -->
			</div>
		</div>
		<?php
		}
		?>
		
		<div class="col-md-6">
					<div class="form-group">
						<label>Priority</label>
						<select class="form-control add-select2" name = "priority">

							<option value = "1" <?php echo (1 == $ticket->priority) ? "selected" : ""; ?>>Low</option>
					
							<option value = "2" <?php echo (2 == $ticket->priority) ? "selected" : ""; ?>>Medium</option>
							<option value = "3" <?php echo (3 == $ticket->priority) ? "selected" : ""; ?>>High</option>
						</select>
					</div>
				</div>

		<div class="col-md-12">
			<label>Remark</label>
			<!-- <div style = "padding: 10px;border: 1px solid #e5e1e1;margin-right:25px;border-radius: 10px;font-size:16px;margin-bottom:10px;"><?php if(!empty($ticket->message)){ echo $ticket->message;} ?></div> -->
			<textarea name="remark" class="form-control"><?=$ticket->message?></textarea>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">			
				<label>Attachment : </label>
				<?php
				if ($ticket->attachment) { ?>
					<span class=''><a target="_blank" href="<?=base_url().'uploads/ticket/'.$ticket->attachment?>"><?=$ticket->attachment?></a></span>
				<?php
				}else{
					echo "<span class='badge badge-danger'>No attachment</span>";
				}
				?>
			</div>
		</div>
		<!-- <div class="col-md-6">
			<div class="form-group">			
				<label>Complaint Type : </label>
					<span class='badge badge-danger'>
					<?php
						if ($ticket->complaint_type==1) {
							echo "Complaint";
						}else if ($ticket->complaint_type==2) {
							echo "Query";
						}
					?>
					</span>
			</div>
		</div> -->
		<!-- <div class="col-md-6">
			<div class="form-group">
				<label>Priority</label>
			<?php
				if($ticket->priority == 1){
					?><span class="badge badge-info">Low</span><?php
				}else if($ticket->priority == 2){
					?><span class="badge badge-warning">Medium</span><?php
				}else if($ticket->priority == 3){
					?><span class="badge badge-danger">High</span><?php
				}
				?>
			</div>
		</div> -->
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12" style ="background: #f7f7f7;border: 1px solid #ccc;padding: 15px;border-radius: 10px;margin-bottom:25px; display: none;">
				
					<div class="row">
					<div class = "col-md-12">
						<div class = "form-group">
							<label>Review</label>
							<textarea class = "form-control" name = "review"><?php echo (!empty($ticket->review)) ? $ticket->review : "";  ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label><?=display('ticket_problem')?> </label>
								<select class="form-control" name = "issue">
									<option value = "">-- Select --</option>
								<?php if(!empty($problem)) {
										foreach($problem as $ind => $prblm){
											?><option value = "<?php echo $prblm->id; ?>" <?php echo ($ticket->category == $prblm->id) ? "selected" : "" ?>><?php echo $prblm->subject_title; ?></option><?php
										}	
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Solution </label>
								<select class="form-control" name = "solution">
									<option value = "">-- Select --</option>
									<option value = "1"  <?php echo ($ticket->solution == 1) ? "selected" : "" ?>>Done</option>
									<option value = "2" <?php echo ($ticket->solution == 2) ? "selected" : "" ?>>Proccess</option>
									<option value = "3"  <?php echo ($ticket->solution == 3) ? "selected" : "" ?>>Defer</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status </label>
								<select class="form-control" name = "status">
									<option value = "">-- Select --</option>
									<option value = "0" <?php echo ($ticket->status == 0) ? "selected" : "" ?>>Unread</option>
									<option value = "1" <?php echo ($ticket->status == 1) ? "selected" : "" ?>>Proccess</option>
									<option value = "2" <?php echo ($ticket->status == 2) ? "selected" : "" ?>>Read</option>
									<option value = "3" <?php echo ($ticket->status == 3) ? "selected" : "" ?>>Dropped</option>
								</select>
							</div>
						</div>
					</div>
					<div class="text-center">					
						<input type ="hidden" name = "ticketno" value = "<?php echo $ticket->id; ?>">
						<input type ="hidden" name = "client" value = "<?php echo $ticket->client; ?>">
						<!-- <button type = "submit" class="btn btn-success">Update</button> -->
					</div>
					
				</div>
				<center><button type = "submit" class="btn btn-success">Update</button></center>
			</div>	
		</div>
		<?=form_close()?>
	</div>
	<div class="row" id="old_tickets" style="display: none;">
		<?php
		if(!empty($related_tickets))
		{
			echo'<table class="table table-bordered">
			<tr>
			<th>Tracking No</th>
			<th>Ticket Number</th>
			<th>Name</th>
			<th>Type</th>
			<th>Action</th>
			</tr>';
				foreach ($related_tickets as $row)
				{ //print_r($row); exit();
				echo'<tr>
					<td>'.$row->tracking_no.'</td>
					<td>'.$row->ticketno.'</td>
					<td>'.$row->name.'</td>
					<td>'.($row->complaint_type?"Enquiry":"Complaint").'</td>
					<th><a href="'.base_url('ticket/view/'.$row->ticketno).'"><button class="btn btn-small btn-primary">View</button></a></th>
					</tr>';
				}	
			echo'</table>';
		}else 
		{
			echo'<div class="alert alert-danger">No Related Ticket found.</div>';
		}
		?>
	</div>
</div>
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		
		$(".add-date-picker").datepicker({
			 format: 'yyyy/mm/dd',
			 startDate: '-7d'
		});	
	});
	$(document).on("change", ".choose-client", function(){	

		$.ajax({
			url     : "<?php echo base_url('ticket/loadinfo'); ?>",
			type    : "post",
			data    : {clientno : $(this).val()},
			success : function (resp){
				var jdata = JSON.parse(resp);
				$("input[name=name]").val(jdata.name);
				$("input[name=email]").val(jdata.email);
			}
		})
	});

<?php
if($this->session->companey_id==65)
{
?>
	function loadTracking(that)
	{	//alert(key);
		//alert(that.value);
		if(that.value=='')
		{

		}else{
			
			$.ajax({
				url:'<?=base_url('ticket/view_tracking')?>',
				type:'post',
				data:{trackingno:that.value},
				beforeSend:function(){

					$(that).parents('form').find('input,select,button').attr('disabled','disabled');
				},
				success:function(q)
				{	$(that).parents('form').find('input,select,button').removeAttr('disabled');
					$(".trackingDetails").html(q);
				},
				error:function(u,v,w)
				{
					alert(w);
				}
			});
		}
	}
<?php
}
?>
function tabchange(t,key)
{
	$(".btn").removeClass("active");
	if(key)
	{
		
		$(t).addClass('active');
		$("#old_tickets").show();
		$("#ticket_details").hide();
	}
	else
	{
		$(t).addClass('active');
		$("#old_tickets").hide();
		$("#ticket_details").show();
	}
}

</script>