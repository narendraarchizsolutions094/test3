       	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default pt-2"> 
					<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
						<div class="row">
							<div class="col-md-12">
								<div class="btn-group" role="group" aria-label="Button group">
									<a class="dropdown-toggle btn btn-success" href="<?php echo base_url("ticket/add"); ?>" title="Add New Ticket"> <i class="fa fa-plus" ></i> Add Ticket</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel-body">
							<?php echo form_open(base_url("ticket/add")); ?>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-12">
									<table class="datatable1 table table-striped table-bordered">
										<thead>
											<th>S.No.</th>
											<th>Ticket</th>
											<th>Client</th>
											<th>Email </th>
											<th>Phone </th>
											<th>Product</th>
											<th>Related To</th>
											<th>Priority</th>
											<th>Date</th>
											<th>Action</th>
										</thead>
										<tbody id = "table-body">
									<?php if(!empty($tickets)){
										        $sl=1;
												foreach($tickets as $ind => $tck){
													?>
													<tr>
														<td><?= $sl;?></td>
														<td><?php echo $tck->ticketno; ?></td>
														<td><?php echo $tck->clientname; ?></td>
														<td><?php echo $tck->email ; ?></td>
														<td><?php echo $tck->phone	; ?></td>
														<td><?=$tck->country_name ; ?></td>
														
														<td><?php echo ucwords($tck->category) ; ?></td>
														<td><?php 
															if($tck->priority == 1){
															?><span class="badge badge-info">Low</span><?php	
															}else if($tck->priority == 2){
															?><span class="badge badge-warning">Medium</span><?php		
															}else if($tck->priority == 2){
																?><span class="badge badge-danger">High</span><?php	
															}
														
														?></td>
														<td><?php echo date("d, M, Y", strtotime($tck->	send_date)); ?></td>
														<td style ="min-width:125px;"><a class="btn  btn-success btn-sm" href="<?php echo base_url("ticket/view/".$tck->ticketno) ?>"><i class="fa fa-eye" aria-hidden="true"></i>
														<a class="btn  btn-default btn-sm" href="<?php echo base_url("ticket/edit/".$tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"> </i> </a>
														
														<a class="btn  btn-danger delete-ticket btn-sm"  data-ticket = "<?php echo $tck->id; ?>" href="<?php echo base_url("ticket/tdelete") ?>"><i class="fa fa-trash-o"></i></a>
														</td>
													</tr>
													<?php
													$sl++;
												}	
											} ?>
										</tbody>
									</table>
								</div>
							</div>
								<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>



<script>
	$(document).on("click", ".delete-ticket", function(e){
		e.preventDefault();
		var r = confirm("Are you sure to delete");
		if (r == true) {
		} else {
		  return false;
		}
		$.ajax({
			url  	: $(this).attr("href"),
			type 	: "post",
			data 	: {content : $(this).data("ticket")},
			success : function(resp){
					var jresp = JSON.parse(resp);
					if(jresp.status == "success"){
						location.reload();
					}else{						
					}
			}
		});
	});
</script>
