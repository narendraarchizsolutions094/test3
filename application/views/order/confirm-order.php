	
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("order") ?>"> <i class="fa fa-list"></i> Order List </a> <br><br>
                    <?php if(!empty($getUserDetails)){ ?>
					<address>
						<h4>
							<i class = "fa fa-user-o"></i> <?php echo"ID : ".$getUserDetails->employee_id; ?></h4>
							<i class = "fa fa-map-signs"></i> <?php echo "Email : ".$getUserDetails->s_user_email; ?><br>
							<i class = "fa fa-globe"></i> <?php echo "Address : ".$getUserDetails->add_ress; ?><br>
							<br>
																			
					</address>
					<?php } ?> 
                </div>
            </div>
            <div class="panel-body">
					<div class="row">
						<div class = "col-md-12">
							<div class="card">
								<?php 	
									 $scmarr = array(); 
								?>
								<div class="">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Srno</th>
												<th>Product</th>
												<th>Stock</th>
												<th>Price</th>
												<th>GST</th>
												<th>Scheme</th>
												<th>Discount</th>
												<th>Quantity</th>
												<th>Total Price</th>
												<th>Delivery By</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php	$totprice = 0;
											if(!empty($orders)) { 
												foreach($orders as $ind => $ord){ 
													$totprice = $totprice + $ord->total_price;
													?>
													<tr>
														<th scope="row"><?php echo $ind+1; ?></th>
														<td><?php echo $ord->product_name; ?></td>
														<td><?php echo $ord->stock; ?></td>
														<td><i class ="fa fa-rupee"></i> <?php echo $ord->price; ?></td>
														<td><?php echo (!empty($ord->tax)) ? $ord->tax."%" : "0%"; ?></td>
														<!-- <td><i class = "fa fa-rupee"></i> <?php echo $totprice = ($ord->price - $ord->offer) + floor($ord->tax/100); ?>
														</td> -->
														<td>
															<?php
															$totper = 0;
															if(!empty($scmarr["product"][$ord->product])){			
																foreach($scmarr["product"][$ord->product] as $ind => $scm) {
																	if( $ord->quantity >= $scm->from_qty  and $ord->quantity <= $scm->to_qty) {
																		?><span class = "badge badge-info">Product : <?php echo $scm->discount; ?> % </span><br/><?php
																	$totper = $scm->discount;
																		break;
																	}
																}
															}
														 ?>
														<?php echo $totper."%"; ?>
													</td>
													<td><i class = "fa fa-rupee"></i><?php echo $totdisc =  $ord->price*$totper/100;  ?></td>
													<td> <?php echo $ord->quantity; ?></td>
													<td>
													<i class = "fa fa-rupee"></i> 
													<?php 
														$total = $totprice*$ord->quantity; 
														if (!empty($ord->tax)) {
															$total += $total*($ord->tax/100); 
														}
														echo $total;
													?>
													</td>
													<td>
														<select class="form-control" name="deliverby" onchange='update_delivery_by("<?=$ord->ord_no?>","<?=$ord->product?>",this)'>
															<option value="Seller" <?=(!empty($ord->deliver_by) && $ord->deliver_by=='Seller')?'selected':""?>>Seller</option>
															<option value="Lalantop" <?=(!empty($ord->deliver_by) && $ord->deliver_by=='Lalantop')?'selected':""?>>Lalantop</option>
														</select>
													</td>
													<td>
														<select class="form-control" name="deliverstatus" onchange='update_delivery_status("<?=$ord->ord_no?>","<?=$ord->product?>",this)'>
															<option value="1">Request</option>
															<option value="2">Waiting</option>
															<option value="3">Dispatch</option>
															<option value="4">Delivery Confirm</option>
															<option value="5">Reject</option>
														</select>
													</td>
												</tr>
													
										<?php	}
											}
										?>																
										</tbody>
									</table>
								</div> 
																	
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>	


	<!-- <div id="update_product_odr" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		   <form action="<?php echo base_url(); ?>order/update_ordered_product" method="post" >
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Update Status</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="row">

			      		<div class="col-md-2">
			      		</div>

			      		<div class="col-md-4">
							<div class="form-group">
								<label>Delivery By</label>
								<select class="form-control" name="deliverby">
									<option value="Seller">Seller</option>
									<option value="Lalantop">Lalantop</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Order Status</label>
								<select class="form-control" name="deliverstatus">
									<option value="1">Request</option>
									<option value="2">Waiting</option>
									<option value="3">Dispatch</option>
									<option value="4">Delivery Confirm</option>
									<option value="5">Reject</option>
								</select>
							</div>
						</div>
			      	</div>
			      	<br>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-success btn-sm">Update</button>							
					</div>
			      </div>
			  </div>
			</form>
		</div>
	</div> -->
        
       
<script type="text/javascript">
	function update_delivery_status(order_id,product_id,curr){
		var url = "<?=base_url().'order/updateorder_product_status'?>";
		status = curr.value;
		$.ajax({
		    type: 'POST',
		    url: url,
		    data: {
		    	order_id:order_id,
		    	product_id:product_id,
		    	status:status
		    },
		    success:function(data){
		      Swal.fire(
	            'success',
	            'Updated Successfully',
	            'success'
	            );
		    }
		});			
	}
	function update_delivery_by(order_id,product_id,curr){
		var url = "<?=base_url().'order/updateorder_product_deliveredBy'?>";
		deliver_by = curr.value;
		$.ajax({
		    type: 'POST',
		    url: url,
		    data: {
		    	order_id:order_id,
		    	product_id:product_id,
		    	deliver_by:deliver_by
		    },
		    success:function(data){
		      Swal.fire(
	            'success',
	            'Delivery By Updated Successfully',
	            'success'
	            );
		    }
		});			
	}
</script>