<link href="<?php echo base_url(); ?>assets/plugins/date-picker/spectrum.css" rel="stylesheet" />
    <style>
        .prod-details{
            display:none;
        }
    </style>
				<!--Header submenu -->
				<div class="bg-white p-3 header-secondary header-submenu">
					<div class="container ">
						<div class="row">
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="<?php echo base_url("Payment"); ?>">Payment</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
							</ol><!-- End breadcrumb -->
							</div>
							<div class="col col-auto">
								<a href="<?php echo base_url("Payment"); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-arrow-left"></i> Payment List </a>
							</div>
						</div>
					</div>
				</div><!--End Header submenu -->

                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">

					    <!-- page-header -->
					<!--	<div class="page-header">
							
							<div class="ml-auto">
							
							</div>
						</div> -->
						<div class="row">
					<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="d-flex">
											<a class="header-brand" href="index.html">
											<?php $image = (!empty($ord->main_img)) ? base_url($ord->main_img)  : base_url("assets/images/profile/33.png");  ?>
												
															<img class="" alt="img" src="<?php echo $image ; ?>" style = "height:90px;">
															
																
											</a>
												<address>
												<?php $image = (!empty($ord->image)) ? base_url("assets/images/profile/".$ord->image)  : base_url("assets/images/profile/33.png");  ?>
												<h4><img class ="avatar avatar-sm brround" src = "<?php echo $image; ?>">
													 <?php echo $ord->customer; ?></h4>
													<i class = "fa fa-map-signs"></i> <?php echo $ord->address; ?>
													<i class = "fa fa-globe"></i> <?php echo $ord->state.", ".$ord->city; ?><br>
													<br>
													<i class = "fa fa-envelope-o"></i> <?php echo $ord->email; ?>
													
													<i class = "fa fa-phone"></i><?php echo $ord->phone; ?>													
													</address>
													
									
											<div class="text-right ml-auto">
												<h2 class="mb-1"> <?php echo $ord->ord_no; ?></h2>
												<p class="mb-1"><span class="font-weight-semibold">Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?> </p>
												<p>Advance  Blanace : <b><i class = "fa fa-rupee"></i></b> </p>
												<p>Previous Blanace : <b><i class = "fa fa-rupee"></i></b> </p>
												
											</div>
										</div>
										<hr>
								
										
										
										
										<div class = "card">
											<div class="card-header">
												Update Product
											</div>
											<div class="card-body">
												<div class = "row">
													<div class = "col-7">
														<?php $totalval = 10; ?>
										<?php if($totalval > 0) { ?>
										<div class = "card">
											<div class = "col-12">
												<br />
												<h4>Update Payment</h4>
												<hr />
											</div>
											<div class = "col-12">
											<?php echo form_open(); ?>
												<div class = "row">
												<?php if(!empty($pay)){ ?>
													<div class = "form-group col-6">
														<label>Previous Balance</label>
													
														<input type = "text" class = "form-control" name = "prevbalance"value = "<?php echo $pay->prev_balance; ?>">
													</div>
												
												<!--	<div class = "form-group col-4">
														<label>Advance Balance</label>
														<input type = "text" class = "form-control" name = "advbalance" value = "0">
													</div> -->
												<?php }else{
													
													$totalval = $totprice;
													
												} ?>	
												
													<div class = "form-group col-6">
														<label>Payment</label><span class ="mand">*</span>
														<input type = "hidden" id = "total-remain" value = "<?php echo $pay->prev_balance; ?>">
														<input type = "number" class = "form-control" id ="total-paybox"  name = "payment"value = "<?php echo $pay->pay ?>">
													</div>
													
													<div class = "form-group col-6">
														<label>Balance</label><span class ="mand">*</span>
														<input type = "number" class = "form-control" id = "remain-balance" value = "<?php echo $pay->balance ?>" name = "balance" readonly>
													</div>
													<div class = "form-group col-6">
														<label>Mode</label><span class ="mand">*</span>
														
														<select class = "form-control" name = "paymode">
															<option></option>
													<?php   if(!empty($masters)) { 
																foreach($masters as $key => $mstr) { 
																
																if($mstr->type == 3) {
																?>
															
																<option value = "<?php echo $mstr->id; ?>" <?php echo ($mstr->id == $pay->pay_mode) ? "selected" :""; ?>><?php echo $mstr->title; ?></option>
															<?php }
																}
															}
															?>
															
														</select>
													</div>
													<div class = "form-group col-6">
														<label>Transaction No</label>
														<input type = "text" class = "form-control" name = "transactiono" value = "<?php echo $pay->transaction_no; ?>">
													</div>
													<div class = "form-group col-6">
														<label>Pay Date</label><span class ="mand">*</span>
														<input type = "text" class = "form-control fc-datepicker" value = "<?php echo date("m/d/Y", strtotime($pay->pay_date)); ?>" name = "paydate">
													</div>
													<div class = "form-group col-6">
														<label>Next Date</label>
														<input type = "text" class = "form-control fc-datepicker" name = "nextpay" value = "<?php echo date("m/d/Y", strtotime($pay->next_pay)); ?>">
													</div>
													<div class = "form-group col-6">
														<label>Status</label>
														<select class = "form-control" name="status">
															<option value = ""></option>
																			<?php   if(!empty($masters)) { 
																foreach($masters as $key => $mstr) { 
																
																if($mstr->type == 2) {
																?>
															
																<option value = "<?php echo $mstr->id; ?>"  <?php echo ($mstr->id == $pay->status) ? "selected" :""; ?>><?php echo $mstr->title; ?></option>
															<?php }
																}
															}
															?>
															
														</select>
													</div>
													<div class = "form-group col-12">
														<label>Remark</label>
														<textarea class = "form-control" name = "remarks"> <?php echo $pay->remark; ?></textarea>
													</div>
													
													<div class = "col-12 text-center">
														
														<input type = "hidden" name = "customer" value = "<?php echo $ord->cus_id; ?>">
														<input type = "hidden" name = "orderid" value = "<?php echo $ord->id; ?>">
														<input type = "hidden" name = "totalpay" value = "<?php echo $totalval; ?>">
															<input type = "hidden" name = "paymentid" value = "<?php echo $pay->id; ?>">
													
														<button class="btn btn-app btn-pill btn-gray mr-2 mt-1 mb-1">
																			<i class="fa fa-save"></i> Save
																		</button>
													</div>
												</div>
											<?php echo form_close(); ?>	
											</div>
										</div>	
									<?php } ?>	
												</div>
												<div class = "col-5">
													<div class = "card">
														<div class = "card-header">
														 Payments
														</div>
															<table class="table table-bordered text-center table-hover mb-0">
														<thead>
															<tr>
																<th>Date</th>
																<th>Payment</th>
																<th>Balance</th>
																<th>Payment Mode</th>
																<th>Action</th>
																
															</tr>
														</thead>
														<tbody>
												
										<?php	$prev_balance = 0;
												$pays = $pay;
												foreach($payments as $ind => $pay){ 
										
													if($pay->ord_id == $ord->id) {
														
														$remain_balance = $pay->balance;
														 $totalval = $pay->balance;
										?>
														<tr <?php echo ($pay->id == $pays->id) ? "class = 'bg-blue text-white'" : ""; ?>>
															<td>
														
															<?php echo date("d, m Y", strtotime($pay->pay_date)); ?></td>
															<td><i class = 'fa fa-rupee'></i> <?php echo  $pay->pay; ?></td>
															<td><?php echo (!empty($pay->balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->	balance : " - "; ?></td>
															<td><?php 
									
																	echo $pay->	pay_mode;	
																	 ?></td>
															<td>
															<?php if($pay->approve == 0) { ?>
																	<a href="<?php echo base64_encode(base64_encode($pay->id)); ?>" class="btn btn-danger delete-content">
															<i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
															<?php } ?>
															</td>
														
														</tr>
												<?php } ?>		
										<?php	 }	?>
													</tbody>
											   </table>	
										<?php	//}else{
										//	$totalval = $totprice;
										//} ?>
													</div>		
												</div>
											</div>	
											
											
									<?php 	if(!empty($orders)) {  ?>
										
												<table class="table table-bordered text-center table-hover mb-0">
														<thead>
															<tr>
																<th colspan = "2" class = "text-center">Product</th>
																<th>Quantity</th>
																<th>Confirm</th>
																<th>Pending Delivery</th>
																<th>Price</th>
																<th>GST</th>
																<th>Other Price</th>
																<th>Total Price</th>
															</tr>
														</thead>
														<tbody>
										<?php			$totprice = 0;
														foreach($orders as $ind => $pord){ ?>
														
													
															<tr class = "text-center">
																<td>
																<?php $image = (!empty($pord->main_img)) ? base_url($pord->main_img)  : base_url("assets/images/profile/33.png");  ?>
																<p class="font-w600 mb-1"><img class="avatar brround" src="<?php  echo $image; ?>"> </p>
																
																</td>
																<td><h4><?php echo $pord->pro_name; ?></h4></td>
																<td><?php echo $pord->quantity; ?></td>
																<td><?php echo $pord->confirm_order; ?></td>
																<td><?php echo $pord->pending_order; ?></td>
																<td><i class = "fa fa-rupee"></i> <?php echo $pord->price; ?></td>
																<td><?php echo $pord->gst."%"; ?></td>
																<td><?php echo $pord->other_price; ?></td>
																<td> <i class ="fa fa-rupee"></i> <?php echo $pord->total; ?></td>
															</tr>	
														
											<?php 	         	$totprice = $totprice + $pord->total;
											
														} ?>	
														     <tr>
																<td class = "text-right" colspan = "8">Total</td>
																<td><i class ="fa fa-rupee"></i> <?php echo $totprice;  ?> </td>		
															 </tr>		
													</tbody>
											   </table>
													
										<?php   } ?>	
										
											</div>
										</div>
										<div class = "card" style = "display:none;">
											<div class = "card-header">
													<div class = "col-md-12">
												Payments <small>Total :</small><?php echo $totprice; ?> 
											</div>	
											</div>
											<div class="card-body">
										<div class = "row">
										
											<div class = "col-md-12">
										<?php if(!empty($payments)){ 
										
												
										?>
												
												<table class="table table-bordered text-center table-hover mb-0">
														<thead>
															<tr>
																<th>Total Pay</th>
																<th>Prev Balance</th>
																<th>Advance</th>
																<th>Payment</th>
																<th>Balance</th>
																<th>Payment Mode</th>
																<th>Transaction No</th>
																<th>Payment Date</th>
																<th>Next Payment</th>
																<th>status</th>
																<th>Remark</th>
																<th>Action</th>
																
															</tr>
														</thead>
														<tbody>
												
										<?php	$prev_balance = 0;
												
												foreach($payments as $ind => $pay){ 
										
													if($pay->ord_id == $ord->id) {
														
														$remain_balance = $pay->balance;
														 $totalval = $pay->balance;
										?>
														<tr>
															<td><?php echo $ind+1; ?></td>
															<td><?php echo (!empty($pay->prev_balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->prev_balance : " - "; ?></td>
															<td><?php echo (!empty($pay->advance_pay)) ? "<i class = 'fa fa-rupee'></i> ".$pay->advance_pay : " - "; ?></td>
															<td><i class = 'fa fa-rupee'></i> <?php echo  $pay->pay; ?></td>
															<td><?php echo (!empty($pay->balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->	balance : " - "; ?></td>
															<td><?php 
									
																	echo $pay->	pay_mode;	
																	 ?></td>
															<td><?php echo $pay->transaction_no ; ?></td>
															<td><?php echo date("d, m Y", strtotime($pay->pay_date)); ?></td>
															<td><?php echo date("d, m Y", strtotime($pay->	next_pay)); ?></td>
															<td><?php echo $pay->status; ?></td>
															<td><?php echo substr($pay->remark, 0, 40); ?></td>
															<td>
														<a href="<?php echo base_url("payment/update/".urlencode(base64_encode(base64_encode($pay->id)))); ?>" class="btn btn-info">
															<i class="fe fe-edit" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
																	<a href="<?php echo base64_encode(base64_encode($pay->id)); ?>" class="btn btn-danger delete-stocks">
															<i class="fe fe-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
															</td>
														
														</tr>
												<?php } ?>		
										<?php	 }	?>
													</tbody>
											   </table>	
										<?php	}else{
											$totalval = $totprice;
										} ?>
								
											</div>
										
										</div>
											
											</div>
										</div>	
											
								
									</div>
								</div>	
									
								</div>
								
							</div>
					</div>
				</div>		
		</div>
					</div>
				</div>
		<?php echo form_open(base_url("ajax/deletesingle/payment"), array("id" => "hide-ajx-form")); ?>
			<input type = "hidden" name = "contentno" id = "contentno-no">
		<?php echo form_close(); ?>
		<script src = "<?php echo base_url("assets/plugins/sweet-alert/sweetalert.min.js"); ?>"></script>
				<script src="<?php echo base_url(); ?>assets/plugins/date-picker/jquery-ui.js"></script>
		
		<?php
			
			$urlarr["ajax"]["url"] =  base_url('table/payments');	
		echo datatable("#add-datatable" , $urlarr); ?>
	<script>
			$(document).on("click", ".delete-content", function(e){
				
				e.preventDefault();
				
				$("#contentno-no").val($(this).attr("href"));
				
			
					
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
				
		
		<script>

		    $(document).ready(function(){
		        
		        $(".fc-datepicker").datepicker();
		    });
			
			$(document).on("keyup", "#total-paybox", function(){
				
				var tot     = $("#total-remain").val();
				
				var val     = $(this).val();
				var remain  = tot - val;
				
				if(val > tot){
					
					var tval = $("#total-paybox").val();
					$("#total-paybox").val(val.substr(0, val.length - 1));
					$("#remain-balance").val("");
				}else{
						$("#remain-balance").val(remain);	
				}
				
			
				
			});
			
		</script>