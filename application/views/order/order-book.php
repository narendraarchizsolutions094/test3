		
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("order") ?>"> <i class="fa fa-list"></i> Order List </a>  
                </div>
            </div>
            <div class="panel-body panel-form">

		
		<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="d-flex">
									<!--		<a class="header-brand" href="index.html">
											<?php $image = (!empty($ord->image)) ? base_url("assets/images/profile/".$ord->image)  : base_url("assets/images/profile/33.png");  ?>
															<img class="" alt="img" src="<?php echo $image; ?>" style = "height:90px;">
															
																
											</a> -->
											<?php if(!empty($getUserDetails)){ ?>
											<address>
												<h4>
													<i class = "fa fa-user-o"></i> <?php echo $getUserDetails->employee_id; ?></h4>
													<i class = "fa fa-map-signs"></i> <?php echo $getUserDetails->s_user_email; ?><br>
													<i class = "fa fa-globe"></i> <?php echo $getUserDetails->add_ress; ?><br>
													<br>
																									
											</address>
											<?php } ?>
											<div class="text-right ml-auto">
												<h2 class="mb-1"> <?php echo $ord->ord_no; ?></h2>
												<p class="mb-1"><span class="font-weight-semibold">Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?> </p>
												
											</div>
										</div>
										<?php $mord = $ord; ?>
										<hr>
										<div class = "row">
											<div class = "col-md-12">
										<?php	$totprice = 0;
												$pendingodr = 0; 
												
												if(!empty($orders)) { 
													foreach($orders as $ind => $ord){ 
														
														$totprice = $totprice + $ord->total_price;
													?>
													
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="card-title"><?php echo $ord->product_name.' #'.$ord->prdid; ?> <small class="pull-right">Seller - <?=$ord->seller_name?></small></h4>
															<div class="card-options">
																<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up "></i></a>
															<!--	<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x "></i></a> -->
															</div> 
														</div>
														<div class="panel-body">
															<div class = "row">
																	<div class = "col-md-3 text-center">
																	<?php $image = (!empty($ord->image)) ? base_url("assets/images/products/".$ord->image)  : base_url("assets/images/profile/33.png");  ?>
																			<p class="font-w600 mb-1"><img class="avatar avatar-xxl brround" src="<?php  echo $image; ?>" style = "width:80px;height:80px;"> </p>
																		<h5><label>Order : </label> <?php echo $ord->quantity; ?> Pics</h5>
																		<?php  if($this->session->mrole == 1) { ?>
																		<h4>Stock : <?php echo $ord->stock; ?></h4>
																		<?php  } ?>
																		<h6><label>Scheme : </label> <?php echo $ord->scheme; ?> </h6>
																<label>Price : </label> <i class ="fa fa-rupee"></i> <?php echo $ord->price; ?>
																<?php if(!empty($ord->offer)){
																?><br><label>Discount : </label> <?php echo $ord->offer; ?><?php	
																} ?>
																<?php if(!empty($ord->tax)){ ?>
																<label>TAX : </label> <?php echo (!empty($ord->tax)) ? $ord->tax."%" : "0%"; ?>
																<?php } ?>
																<br><label>Total : </label> <i class ="fa fa-rupee"></i> <?php echo $ord->quantity*$ord->price + $ord->other_price; ?>
																	</div>
																	<div class = "col-md-9">
																	<?php echo form_open(); ?>
									
																		<div class = "row">
																   <?php 
																	$ispending = false;
																	$totdlvr   = 0;
																   if(!empty($delivery[$ord->id])) {
																	   
																	   $dlvr = $delivery[$ord->id];
																	 
																	   
																	   ?>
																	   <table class = "table table-bordered table-hover mb-0">
																			<thead>
																				<tr>
																					<th>Date</th>
																					<th>Confirm Delivery</th>
																					<th>Remaining</th>
																					<th>Remaining Delivery</th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody>
																	<?php 		foreach($dlvr as $ind => $dlv){ 
																					if($ind == 0)
																					 $ispending = ($dlv->pending_qty > 0) ?  true : false;
																	  
																					 $totdlvr   =  $totdlvr	+ $dlv->delv_qty;		
																	?>
																				<tr>
																					<th><?php echo date("d, F, Y", strtotime($dlv->delivery_date)); ?></th>
																					<th><?php echo $dlv->delv_qty; ?></th>
																					<th><?php echo $dlv->pending_qty; ?></th>
																					<th><?php echo date("d, F, Y", strtotime($dlv->pending_deliver)); ?></th>
																					<th>
																					<?php if($this->session->mrole == 1) { ?>
																					<a href="<?php echo base_url("order/bookingupdate/".urlencode(base64_encode(base64_encode($dlv->id)))); ?>" class="btn btn-info" data-type = "delivery">
					<i class="fe fe-edit" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
					<a href="<?php echo base64_encode(base64_encode($dlv->id)); ?>" class="btn btn-danger delete-delivery">
					<i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
																					<?php } ?>			
					</th>
																											
																				</tr>	
																					
																	<?php		}
																				$totpending = $ord->quantity - $totdlvr;
																				$pendingodr = $pendingodr + $totpending;
																	?>
																			</tbody>
																	   </table>
																	   
																	   <?php $savebtn = false;
																	   	} else { 
																		
																		$pendingodr =  $ord->quantity;
																		?>
																		
																		<div class = "col-12">
																			
																				<div class = "panel panel-default">
										
																					<div class="panel-body">
																							<div class = "col-md-12 text-center">
																								
																										<div class = "form-group pt-2">
																									<label>Order Quantity :</label>
																									<?php echo $ord->quantity; ?>
																								</div>
																									<h4> There is no confirm order
																									<?php if($this->session->mrole == 1) { ?>
																									 <a class = "btn btn-warning btn-pill" href = "<?php echo base_url("order/booking/".$ord->ord_no); ?>"> Confirm Order </a> 
																									<?php } ?>
																									</h4>
																									
																								</div>
																							</div>
																					</div>	
																		</div>
														
																		<?php 
																			$savebtn = true;
																		} ?>
																
																		</div>
																
																		<?php echo form_close(); ?>
																	</div>
															</div>
														</div>
													</div>
										
										<?php   	}
												} ?>			
											</div>
											<div class = "panel panel-default">
												<div class="table-responsive">
														<table class="table card-table table-vcenter text-nowrap table-nowrap">
															<thead class="bg-blue ">
																<tr>
																	<td>Delivery Date</td>
																	<td>Pending Delivery Date</td>
																	<td>Status</td>
																	
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><?php echo $mord->conf_delv; ?></td>
																	<td><?php echo $mord->pend_delv; ?></td>
																	<td><?php 		if($mord->status == 1){
																							echo "Waiting";
																						}else if($mord->status == 2){
																							echo "Verify";
																						}	else if($mord->status == 2){
																							echo "Dispatch";
																						}	else if($mord->status == 2){
																							echo "Deliver";
																						}else{
																							echo "Return";
																						} ?>
																	</td>					
																</tr>							
															</tbody>
														</table>		
												</div>
											</div>		
											</div>	
											
											
										<?php if(!empty($payments)){ 
												$showbtn = false;
												$data["payments"] = $payments;	
												$data["totprice"] = $totprice;
												$data["orderno"]  = $ord->ord_no;
												$data["pendingodr"] = $pendingodr;
												$this->load->view("payment/pages/payment-list", $data);
													$showbtn = false;
												}else{
													$showbtn = true;
												}
												
								?>
						
										</div>
											<div class="card-footer">
			<?php	$confrmodr = true;
												
												if($showbtn == true or $confrmodr == true){ ?>
													
													<div class = "panel panel-default">
										
															<div class="panel-body">
																<div class = "col-md-12 text-center">
																
																	<h4><?php if($showbtn == true) { ?>	Balance :  <i class = "fa fa-rupee"></i> <?php echo $totprice; ?> <a class = "btn btn-info btn-pill" href = "<?php echo base_url("payment/add/".$ord->ord_no); ?>"> Add Payment </a> 
																	<?php } ?>
																	<?php if($pendingodr > 0 and $showbtn == true and $this->session->mrole == 1)  { ?>
																	 <a class = "btn btn-warning btn-pill" href = "<?php echo base_url("order/booking/".$ord->ord_no); ?>"> Confirm Order </a> 
																	<?php } ?>
																	</h4>
																</div>
																	</div>
													</div>	
													
										<?php	} ?>									</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		


						<!-- end row -->
							<?php echo form_open(base_url("ajax/deletesingle/payment"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "content-no">
	
		<?php echo form_close(); ?>
		
								<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
		<script>

		    $(document).ready(function(){
		        
		        $(".fc-datepicker").datepicker();
		    });
		</script>
		<script>
			$(document).on("click", ".delete-delivery", function(e){
				
							e.preventDefault();
				
				$("#contentno").val($(this).attr("href"));
				var url = $("#hide-ajx-form").attr("action");
				
				$("#hide-ajx-form").attr("action", url.replace("payment", "delivery"));
				
				alert(url.replace("payment", "delivery"));
				
				var type = $(this).data("type");
			
					
					swal({
					  title: "Are you sure?",
					  text: "Once deleted, you will not be able to recover this imaginary file!",
					  type: "warning",
					  showCancelButton: true,
					  buttons: true,
					  dangerMode: true,
					  confirmButtonText: 'Delete',
					  confirmButtonColor: '#f52b3e',
					  cancelButtonText: 'Close'
					});	
			});
		</script>
		<script>
			$(document).on("click", ".delete-content", function(e){
				
				e.preventDefault();
				
				$("#content-no").val($(this).attr("href"));
				
				var type = $(this).data("type");
			
					
					swal({
					  title: "Are you sure?",
					  text: "Once deleted, you will not be able to recover this imaginary file!",
					  type: "warning",
					  showCancelButton: true,
					  buttons: true,
					  dangerMode: true,
					  confirmButtonText: 'Delete',
					  confirmButtonColor: '#f52b3e',
					  cancelButtonText: 'Close'
					});	
			});
		</script>
		<script>
			$(document).on("click", "button.confirm", function(e){
				
				e.preventDefault();
				$.ajax({
					url     : $("#hide-ajx-form").attr("action"),
					type    : "post",
					data    : $("#hide-ajx-form").serialize(),
					success : function(resp){
						
						var jresp = JSON.parse(resp);
						
						if(jresp.status == "success"){
							
							location.reload();
						}
						
					}
				});
			});
		</script>
		
		