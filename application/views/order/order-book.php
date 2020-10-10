<style type="text/css">
.timeline {
  position: relative;
  margin: 1.5rem;
}

.step {
  position: relative;
  padding: 0.5rem;
  padding-left: 1.5rem;
  border-left: 2px solid #d6dce0;
}

.step[data-notes-count]:before {
  content: attr(data-notes-count);
  font-size: 0.8rem;
  line-height: 1.5rem;
  text-align: center;
}

.step:before {
  content: '';
  width: 1.5rem;
  height: 1.5rem;
  border-radius: 1.5rem;
  background-color: #ffffff;
  border: 1px solid #d9d9d9;
  position: absolute;
  left: -0.75rem;
  top: 0.75rem;
  margin-left: -1px;
}

.step .date {
  font-size: 80%;
  color: gray;
}

.step .title {
  font-weight: bolder;
}

.step.completed {
  border-color: #3cd34a;
}

.step.completed:before {
  border: 1px solid #3cd34a;
  background-color: #66dc71;
}

.step.current {
  border-color: #2bb2f0;
}

.step.current:before {
  border: 1px solid #2bb2f0;
  background-color: #5bc3f3;
}

@media screen and (min-width: 40em) {
  .timeline {
    font-size: 0;
    padding-top: 1.5rem;
  }

  .step {
    display: inline-block;
    font-size: 0.8rem;
    width: 8.8rem;
    padding-left: 0;
    margin-bottom: 0;
    border-left: none;
    border-top: 2px solid #d6dce0;
    padding-top: 0.75rem;
    text-align: center;
  }

  .step:before {
    left: 3.65rem;
    top: -0.75rem;
    margin-left: 0;
    margin-top: -1px;
  }
}
@media screen and (min-width: 50em) {
  .step {
    font-size: 1rem;
    width: 11rem;
  }

  .step:before {
    left: 4.75rem;
  }
}

</style>
		
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
								<div class="panel panel-default">
									<div class="panel-body">

									<div class="row">
				            			<div class="col-md-4 col-sm-12 col-xs-12">            				
						            		<?php if(!empty($order_meta)){ ?>						
											<fieldset>
						  						<legend style="width: unset;font-size: 12px;">Billing Details:</legend>
												<label>Name : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['fname'])?$order_meta['BILLING_DETAILS']['fname']:''?>
												<br><label>Email : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['email'])?$order_meta['BILLING_DETAILS']['email']:''?>
												<br><label>Mobile No. : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['phone'])?$order_meta['BILLING_DETAILS']['phone']:''?>
												<br><label>Address : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['address'])?$order_meta['BILLING_DETAILS']['address']:''?>
												<br><label>State : </label>&nbsp;
												<?php
												if(!empty($order_meta['BILLING_DETAILS']['state'])){
													$sid	=	$order_meta['BILLING_DETAILS']['state'];
													$state_row	=	$this->location_model->get_state_name_by_id($sid);
													if (!empty($state_row['state'])) {
														echo $state_row['state'];
													}else{
														echo "NA";
													}
												}else{
													echo "NA";
												}
												?>								
												<br><label>City : </label>&nbsp;
												<?php
												if(!empty($order_meta['BILLING_DETAILS']['city'])){
													$cid	=	$order_meta['BILLING_DETAILS']['city'];
													$city_row	=	$this->location_model->get_city_name_by_id($cid);
													if (!empty($city_row['city'])) {
														echo $city_row['city'];
													}else{
														echo "NA";
													}
												}else{
													echo "NA";
												}
												?>
												<br><label>Pincode : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['pincode'])?$order_meta['BILLING_DETAILS']['pincode']:''?>
												<br><label>GSTIN : </label>&nbsp;<?=!empty($order_meta['BILLING_DETAILS']['gstin'])?$order_meta['BILLING_DETAILS']['gstin']:''?>
											</fieldset>
									<?php } ?> 

				            			</div>
				            			<div class="col-md-4 col-sm-12 col-xs-12" >            				
						            		<?php if(!empty($order_meta)){ ?>
											<fieldset>
						  						<legend style="width: unset;font-size: 12px;">Shipping Details:</legend>
												<label>Name : </label>&nbsp; <?=!empty($order_meta['SHIPPING_DETAILS']['fname'])?$order_meta['SHIPPING_DETAILS']['fname']:''?>
												<br><label>Email : </label> &nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['email'])?$order_meta['SHIPPING_DETAILS']['email']:''?>
												<br><label>Mobile No. : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['phone'])?$order_meta['SHIPPING_DETAILS']['phone']:''?>
												<br><label>Address : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['address'])?$order_meta['SHIPPING_DETAILS']['address']:''?>
												<br><label>State : </label>&nbsp;
												<?php
												if(!empty($order_meta['SHIPPING_DETAILS']['state'])){
													$sid	=	$order_meta['SHIPPING_DETAILS']['state'];
													$state_row	=	$this->location_model->get_state_name_by_id($sid);
													if (!empty($state_row['state'])) {
														echo $state_row['state'];
													}else{
														echo "NA";
													}
												}else{
													echo "NA";
												}
												?>								
												<br><label>City : </label>&nbsp;
												<?php
												if(!empty($order_meta['SHIPPING_DETAILS']['city'])){
													$cid	=	$order_meta['SHIPPING_DETAILS']['city'];
													$city_row	=	$this->location_model->get_city_name_by_id($cid);
													if (!empty($city_row['city'])) {
														echo $city_row['city'];
													}else{
														echo "NA";
													}
												}else{
													echo "NA";
												}
												?>
												<br><label>Pincode : </label>&nbsp;<?=!empty($order_meta['SHIPPING_DETAILS']['pincode'])?$order_meta['SHIPPING_DETAILS']['pincode']:''?>
											</fieldset>
									<?php } ?> 
										</div>
				            			<div class="col-md-4 col-sm-12 col-xs-12" >  
											<fieldset>
						  						<legend style="width: unset;font-size: 12px;">Order Details:</legend>
												<h2> <?php echo $ord->ord_no; ?></h2>
												<p><span>Order Date :</span> <?php echo date("d, F Y", strtotime($ord->order_date)); ?> </p>
											</fieldset>
										</div>
				            		</div>
				            		<br>
										<?php $mord = $ord; ?>
										<br>
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
																	<label>Unit Price : </label> <i class ="fa fa-rupee"></i> <?php echo $ord->unit_price; ?>
																	<?php if(!empty($ord->offer)){
																	?><br><label>Discount : </label> <?php echo $ord->offer; ?><?php	
																	} ?>
																	<?php if(!empty($ord->tax)){ ?>
																	<label>TAX : </label> <?php echo (!empty($ord->tax)) ? $ord->tax."%" : "0%"; ?>
																	<?php } ?>
																	<br><label>Total : </label> <i class ="fa fa-rupee"></i> <?php $total = $ord->quantity*$ord->total_price; 
																		/*if (!empty($ord->tax)) {
																			$total+=$total*($ord->tax/100);
																		}*/
																		echo $total;
																	?>
																</div>
																<div class = "col-md-9">
																<div class = "row">
															   <?php 
																   $this->db->where('comp_id',$this->session->companey_id);
																   $this->db->where('ord_no',$ord->ord_no);
																   $this->db->where('pid',$ord->product);
																   $prod_stage	= $this->db->get('ord_prod_stage')->result_array();
																   array_unshift($prod_stage , array('status' => '1','created_at' => $ord->order_date));
																   ?>
																   <div>
																   	<div class="timeline">
																   		<?php
																   		$stages	=	array('1'=>'Request','2'=>'Waiting','3'=>'Dispatch','4'=>'Delivery Confirm','5'=>'Reject');
																		if(!empty($prod_stage)){
																			$i=1;
																			$len = count($prod_stage);
																			foreach ($prod_stage as $key => $value) {
																				$status	=	$value['status'];
																				$class = '';
																				if ($i==$len) {
																					$class = 'current';
																				}else if (!empty($stages[$status])) {
																					$class = 'completed';
																				}
																				?>
																				<div class="step <?=$class?>" data-notes-count="<?=$i?>">
																			      <div class="title"><?=$stages[$status]?></div>
																			      <div class="date"><?=$value['created_at']?></div>
																			    </div>
	
																				<?php
																				$i++;
																			}
																		}																	   		
																   		?>
													
																	</div>
																   </div>
																	</div>
																</div>
															</div>
														</div>
													</div>
										<?php   	}
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
		
