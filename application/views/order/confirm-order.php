<style>
	.datepicker{
		min-width:200px;
	}
</style>	
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
            <div class="panel-body panel-form">

			
		<?php echo form_open(); ?>
		<div class="row">
				
											<div class = "col-md-12">
												<div class="card">
													
													<?php 	
														 $scmarr = array(); 
													/*	if(!empty($schemes)){
															
															
															foreach($schemes as $ind => $sch){
																
																echo "<pre>";
																	print_r($sch);
																echo "</pre>";
																
																if($sch->scheme_type == 1) {	
																	$scmarr["product"][$sch->product][] = $sch;
																	
																}else if($sch->scheme_type == 2) {	
																	$scmarr["region"][$sch->region][] = $sch;
															
																} else if($sch->scheme_type == 3) {	
																	$scmarr["paymode"][$sch->mop][] = $sch;
															
																}
																
																if(!empty($schemearr["prodscheme"])){
					
																	$prdofr = $schemearr["prodscheme"];
																	$isprorofr = false;
																	if(!empty($prdofr["CTG".$prd->category])){
																		
																		$schmobj = $prdofr["CTG".$prd->category];
																		$isprorofr = true;
																		$ofrapply  = "Category";
																	}
																	if(!empty($prdofr["SBCTG".$prd->subcat_id])){
																		
																		$schmobj = $prdofr["SBCTG".$prd->subcat_id];
																		$isprorofr = true;
																		$ofrapply  = "Subcategory";
																	}
																	if(!empty($prdofr["PRD".$prd->id])){
																		
																		$schmobj = $prdofr["PRD".$prd->id];
																		$ofrapply  = "Product";
																		$isprorofr = true;
																	}
																	if($isprorofr == true){
																		
																		$offer = $schmobj->discount;
																		$ofrmeth   = $schmobj->calc_mth;
																		
																	}
																}
																
																
															}
															
															
														} */	
														  
														  
													?>
													<div class="table-responsive">
														<table class="table card-table table-vcenter text-nowrap table-nowrap">
															<thead>
																<tr>
																	<th>Srno</th>
																	<th>Product</th>
																	<th>Stock</th>
																	<th>Price</th>
																	<th>GST</th>
																	
																	<th>Total Price</th>
																	<th>Scheme</th>
																	<th>Discount</th>
																	
																	<th>Order</th>
																	<th>Booking</th>
																	<th>Confirm</th>
																	<th>Remain</th>
																	<th>Total Price</th>
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
																			
																			<td><i class = "fa fa-rupee"></i> <?php echo $totprice = ($ord->price - $ord->offer) + floor($ord->tax/100); ?>
																						<input type = "hidden" class = "product-price" value = "<?php echo $totprice; ?>">
																		
																			</td>
																			<td><?php // echo  $ord->scheme; ?> 
																		<?php
																		$totper = 0;
																		if(!empty($scmarr["product"][$ord->product])){
																				
																			foreach($scmarr["product"][$ord->product] as $ind => $scm) {
																				
																				if( $ord-> quantity >= $scm->from_qty  and $ord-> quantity <= $scm->to_qty) {
																					?><span class = "badge badge-info">Product : <?php echo $scm->discount; ?> % </span><br/><?php
																				$totper = $scm->discount;
																					break;
																				}
																			}
																		}
																	
																		 ?>
																				<br />Total : <?php echo $totper."%"; 
																			
																							   ?>
																			</td>
																			<td><i class = "fa fa-rupee"></i><?php echo $totdisc =  $ord->price*$totper/100;  ?></td>
																				<input type = "hidden" class = "tot-discount" name = "totaldiscount[]" value = "<?php echo $totdisc; ?>">			   
																			
																			<td> <?php echo $ord->quantity; ?> 
																					<input type = "hidden" class = "product-qty" value = "<?php echo $ord->quantity; ?>">
																			</td>
																			<td>
																		<?php  
																			$pngqty =  $ord->quantity;
																			$totcnf = 0;
																				$allbook = false;
																			if(!empty($delivery[$ord->id])) {
																	   
																					$dlvr = $delivery[$ord->id];
																					foreach($dlvr as $ind => $dlv){ 
																					
																						$totcnf = $totcnf + $dlv->delv_qty;
																					}
																					echo $totcnf;
																					?><input type = "hidden" class  = "conf-qty" value = "<?php echo $totcnf; ?>"><?php
																					$pngqty = $pngqty - $totcnf;
																			}else{
																				?><input type = "hidden" class  = "conf-qty" value = "0"><?php
																					echo "0";
																				} ?>
																			</td>
																			<td>
																			<?php if($pngqty > 0) { ?>
																			<input type = "number" class = "form-control product-conf" name = "productconf[]" value = "<?php echo $pngqty ?>">
																			<?php }else {
																					$allbook = true;
																				echo " - ";
																			} ?>
																			</td>
																			<td>
																			<?php if($allbook == false) { ?>
																			<input type = "number" class = "form-control product-remain"  name = "productrem[]" value = "0" readonly>
																			<?php }else{
																				echo "-";
																			} ?>
																			</td>
																			<td>
																			<?php if($allbook == false) { ?>
																			<input type = "number"  class = "form-control total-price" name = "totalprice[]" value ="<?php echo $totprice*$ord->quantity; ?>" readonly>
																				<input type = "hidden" name = "products[]" value = "<?php echo $ord->product; ?>">
																		
																				<input type = "hidden" name = "productord[]" value = "<?php echo $ord->id; ?>">
																			<?php }else{
																				
																				?><i class = "fa fa-rupee"></i> <?php echo  $totprice*$ord->quantity;
																			} ?>	
																			</td>
																		</tr>
																		
															<?php	}
																}
?>																
														
															</tbody>
														</table>
													</div>
												<div class = "card">	
													<div class = "card-header border-0">
														<h3 class = "card-title">Update Delivery</h3>
														<hr />
													</div>
													<div class = "card-body">
													<div class = "row">
													
																
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Delivery Date</label>
																						<div class="input-group">
																							<div class="input-group-addon">
																								<div class="input-group-text">
																									<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																								</div>
																							</div><input class="form-control fc-datepicker datepicker" name="delvdate" placeholder="MM/DD/YYYY" value="" type="text" autocomplete = "off">
																						</div>
																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Pending Delivery Date</label>
																						<div class="input-group">
																							<div class="input-group-addon">
																								<div class="input-group-text">
																									<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																								</div>
																							</div><input class="form-control fc-datepicker datepicker" name="penddate" placeholder="MM/DD/YYYY" value="" type="text"  autocomplete = "off">
																						</div>
																					
																				</div>
																			</div>
																			<div class="col-md-3">
																					<div class="form-group">
																						<label>Delivery By</label>
																						<select class="form-control" name="deliverby">
																							<option value="Seller">Seller</option>
																							<option value="Lalantop">Lalantop</option>
																						</select>
																					</div>
																				</div>
																				<div class="col-md-3">
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
													</div>
												</div>	
												
												<!-- table-responsive -->
												</div>
											</div>
										</div>	
						
									</div>
									<div class="card-footer text-right">
											<input type="hidden" name="orderid" value="<?php echo $ord->id; ?>">
											<input type="hidden" name="customerno" value="">
												<input type="hidden" name="orderno" value="<?php echo $ord->ord_no; ?>">
											<button type="reset" class="btn btn-info btn-pill btn-xs mt-4 mt-sm-0" name="reset">Reset</button>								
											<button type="submit" class="btn btn-success btn-pill btn-xs mt-4 mt-sm-0" name="saveorder">Confirm</button>
									</div>
								</div>
							</div>
						
						
					<?php echo form_close(); ?>	
				</div>
			
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
			$(document).on("click", ".delete-content", function(e){
				e.preventDefault();
				$("#content-no").val($(this).attr("href"));
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
			$(document).on("keyup", ".product-conf", function(){
				var prntobj = $(this).closest("tr");
				var val 	= $(this).val();
				var tprice  = parseInt(prntobj.find(".product-price").val());
				var tqty    = parseInt(prntobj.find(".product-qty").val());
				var tdisc   = parseInt(prntobj.find(".tot-discount").val());
				var remain  = tqty - val;
				var cnfqty  = parseInt(prntobj.find(".conf-qty").val());
				remain      = remain - cnfqty;
				var fprice  = tprice * (val);
				if(remain >= 0 ){
					prntobj.find(".product-remain").val(remain);
				}else{
					prntobj.find(".product-remain").val("0");
				}
				prntobj.find(".total-price").val(fprice - tdisc);
			});
		</script>