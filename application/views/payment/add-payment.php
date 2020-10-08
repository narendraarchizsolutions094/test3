<div class="row">
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
						<div class="card">
							<div class="card-body">								
								<div class = "card">
									<div class="card-body">
										<div class = "row">
											<div class = "col-md-12">
																<!--		<div class="d-flex">
									
								
													
										<?php $totprice = $totalval = $tpay = 0;
										
										
														foreach($orders as $ind => $pord){
															$totprice = $totprice + $pord->total_price;
														}
												if(!empty($payments)) {		
													foreach($payments as $ind => $pay){ 
										
													if($pay->ord_id == $ord->id) {
														
														$remain_balance =  $pay->pay;
														 $totalval = $pay->balance;
														  $tpay =  $tpay + $pay->pay;
														}
													}
												}		
														
													$balance = $totprice - $tpay;	
														?>
											<div class="text-right ml-auto">
												<h2 class="mb-1"> <?php echo $ord->ord_no; ?></h2>
												<p class="mb-1"><span class="font-weight-semibold">Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?> </p>
												<p>Total   : <b><i class = "fa fa-rupee"></i>  <?php echo $totprice; ?></b> </p>
												<p>Pay : <b><i class = "fa fa-rupee"></i></b> <?php echo $tpay; ?></p>
												<p>Balance : <b><i class = "fa fa-rupee"></i></b> <?php echo $balance; ?></p>
											</div>
										</div>
										<hr> -->

												<?php 
												if(!empty($payments)){ 										
													$totalval = $totprice;
													$remain_balance = $totprice;
													?>
												<table class="table table-bordered text-center table-hover mb-0">
													<thead>
														<tr>
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
													<?php	
													$prev_balance = 0;												
													foreach($payments as $ind => $pay){ 
													if($pay->ord_id == $ord->id) {
														$remain_balance = $pay->balance;
														 $totalval = $pay->balance;
														?>
														<tr <?php echo ($pay->approve == 0) ? "class='bg-border-dash'" : ""; ?>>
															<td><?php echo (!empty($pay->prev_balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->prev_balance : " - "; ?></td>
															<td><?php echo (!empty($pay->advance_pay)) ? "<i class = 'fa fa-rupee'></i> ".$pay->advance_pay : " - "; ?></td>
															<td><i class = 'fa fa-rupee'></i> <?php echo  $pay->pay; ?></td>
															<td><?php echo (!empty($pay->balance)) ? "<i class = 'fa fa-rupee'></i> ".$pay->balance : " - "; ?></td>
															<td>
																<?php 
																if($pay->pay_mode == 1){
																	echo "Online";
																}else if ($pay->pay_mode == 2) {
																	echo "Cash";
																}else if ($pay->pay_mode == 3) {
																	echo "Check/DD";
																}else{
																	echo "N/A";
																}	
																?>
															</td>
															<td><?php echo $pay->transaction_no ; ?></td>
															<td><?php echo date("d-M-Y", strtotime($pay->pay_date)); ?></td>
															<td><?php echo date("d-M-Y", strtotime($pay->next_pay)); ?></td>
															<td><?php echo $pay->status; ?></td>
															<td><?php echo substr($pay->remark, 0, 40); ?></td>
															<td>
																	
																	<a href="<?php echo base_url("payment/update/".base64_encode($pay->id)); ?>">
																	<i class="fe fe-edit" data-toggle="tooltip" title="" data-original-title="Edit"></i> Edit</a>
																	<!-- <a href="<?php echo base64_encode(base64_encode($pay->id)); ?>" class="delete-stocks">
																	<i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Delete"></i> Delete</a> -->		
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
									<?php if($totalval > 0) { ?>		
											<div class = "col-md-12">
												<br />
												<h4>New Payment</h4>
												<hr />
											</div>
											<div class = "col-md-12">
											<?php echo form_open(); ?>
												<div class = "row">
												<?php if(!empty($payments)){ ?>
													<div class = "form-group col-md-4">
														<label>Previous Balance</label>
														<input type = "text" class = "form-control" name = "prevbalance"value = "<?php echo $remain_balance; ?>" readonly>
													</div>
												<?php }else{
													$totalval = $totprice;
												} ?>	
													<div class = "form-group col-md-4">
														<label>Payment</label><span class ="mand">*</span>
														<input type = "hidden" id = "total-remain" value = "<?php echo $totalval; ?>">
														<input type = "number" class = "form-control" id ="total-paybox"  name = "payment"value = "<?php echo $totalval; ?>">
													</div>
													
													<div class = "form-group col-md-4">
														<label>Balance</label><span class ="mand">*</span>
														<input type = "number" class = "form-control" id = "remain-balance" value = "0" name = "balance" readonly>
													</div>
													<div class = "form-group col-md-4">
														<label>Payment Mode</label><span class ="mand">*</span>
														<select class = "form-control" name = "paymode">
															<option></option>
															<option value = "1">Cash</option>
															<option value = "2">Online</option>	
														</select>
													</div>
													<div class = "form-group col-md-4">
														<label>Transaction No</label>
														<input type = "text" class = "form-control" name = "transactiono">
													</div>
													<div class = "form-group col-md-4">
														<label>Pay Date</label><span class ="mand">*</span>
														<input type = "date" class = "form-control" name = "paydate" autocomplete = "off">
													</div>
													<div class = "form-group col-md-4">
														<label>Next Date</label>
														<input type = "date" class = "form-control" name = "nextpay" autocomplete = "off">
													</div>
													<?php if($this->session->mrole == 1) { ?>
													<div class = "form-group col-md-4">
														<label>Status</label>
														<select class = "form-control" name="status">
															<option value = ""></option>
															<?php   if(!empty($masters)) { 
																foreach($masters as $key => $mstr) { 
																if($mstr->type == 2) {
																?>
																<option value = "<?php echo $mstr->id; ?>"><?php echo $mstr->title; ?></option>
															<?php }
																}
															}
															?>
														</select>
													</div>
													<?php }else{
														?><input type = "hidden" name = "status" value = "2"><?php
													} ?>
													<div class = "form-group col-md-12">
														<label>Remark</label>
														<textarea class = "form-control" name = "remarks"></textarea>
													</div>
													<div class = "col-md-12 text-center">
														<input type = "hidden" name = "customer" value = "<?php echo $ord->cus_id; ?>">
														<input type = "hidden" name = "orderid" value = "<?php echo $ord->id; ?>">
														<input type = "hidden" name = "totalpay" value = "<?php echo $totalval; ?>">
														<button class="btn btn-app btn-pill btn-gray mr-2 mt-1 mb-1">
															<i class="fa fa-save"></i> Save
														</button>
													</div>
												</div>
											<?php echo form_close(); ?>	
											</div>
									<?php } ?>		
										</div>											
									</div>
								</div>	
								<!-- <div class = "card">
									<div class="card-header">
										Order Products
									</div>
								<div class="card-body">
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
																<?php $image = (!empty($pord->image)) ? base_url("assets/images/products/".$pord->image)  : base_url("assets/images/profile/33.png");  ?>
																<p class="font-w600 mb-1"><img width="150px" height="150px" class="avatar brround" src="<?php  echo  $image; ?>"> </p>
																
																</td>
																<td><h4><?php echo $pord->product_name; ?></h4></td>
																<td><?php echo $pord->quantity; ?></td>
																<td><?php echo $pord->conf_delv; ?></td>
																<td><?php echo $pord->pend_delv; ?></td>
																<td><i class = "fa fa-rupee"></i> <?php echo $pord->price; ?></td>
																<td><?php echo $pord->tax."%"; ?></td>
																<td><?php echo $pord->other_price; ?></td>
																<td> <i class ="fa fa-rupee"></i> <?php echo $pord->total_price; ?></td>
															</tr>	
														
											<?php 	         	$totprice = $totprice + $pord->total_price;
											
														} ?>	
														     <tr>
																<td class = "text-right" colspan = "8">Total</td>
																<td><i class ="fa fa-rupee"></i> <?php echo $totprice;  ?> </td>		
															 </tr>		
													</tbody>
											   </table>
													
										<?php   } ?>	
										
											</div>
										</div> -->									
									</div>
								</div>										
							</div>								
						</div>
					</div>
				</div>		
		</div>
	</div>				
		<script>
			$(document).on("keyup", "#total-paybox", function(){				
				var tot     = parseInt($("#total-remain").val());				
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
		<script>
			$(document).on("click", ".approve-pay", function(e){				
				e.preventDefault();				
				var r = confirm("Are you sure to confirm payment");
					if (r == true) {					 
					} else {
					  txt = "You pressed Cancel!";
					}				
				$.ajax({
					url  	: "<?php echo base_url('ajax/approve/payment'); ?>",
					type 	: "post",
					data 	: {"contentno" : $(this).attr("href"), "status" : 1},
					success	: function (resp){						
						resp = JSON.parse(resp);						
						if(resp.status == "success"){							
							location.reload();
						}
					}
				});
			});
		</script>