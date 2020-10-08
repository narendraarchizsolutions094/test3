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
							<a class="pull-right fa fa-arrow-left btn btn-circle  btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>
							<div class="col">
									<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item">Payment</li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
							</ol><!-- End breadcrumb -->

							</div>
							<!-- <div class="col col-auto">
								<a href="<?php echo base_url("Payment"); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-arrow-left"></i> Payment List </a>
							</div> -->
						</div>
					</div>
				</div><!--End Header submenu -->

                <!-- app-content-->
				<div class="container content-area">
					<div class="side-app">

					<div class="row">
						<div class = "col-md-12">
						<?php echo form_open('payment/update'); ?>
							<div class = "row">
							<?php if(!empty($payments)){ ?>
								
							<?php }else{
								//$totalval = $totprice;
							} ?>	
							<input type="hidden" name = "paymentid" value="<?php echo $paydata->id; ?>">
							<input type="hidden" name = "orderid" value="<?php echo getOrderNumber($paydata->ord_id); ?>">
								<div class = "form-group col-md-4">
									<label>Previous Balance</label>
									<input type = "text" class = "form-control" name = "prevbalance" value = "<?php echo $paydata->prev_balance; ?>" readonly>
								</div>
								<div class = "form-group col-md-4">
									<label>Payment</label><span class ="mand">*</span>
									<input type = "hidden" name="paymentidss" id = "total-remain" value = "<?php echo $paydata->prev_balance; ?>">
									<input type = "number" class = "form-control" id ="total-paybox"  name = "payment" value = "<?php echo $paydata->pay; ?>">
								</div>
								
								<div class = "form-group col-md-4">
									<label>Balance</label><span class ="mand">*</span>
									<input type = "number" class = "form-control" id = "remain-balance" value = "<?php echo $paydata->balance; ?>" name = "balance" readonly>
								</div>
								<div class = "form-group col-md-4">
									<label>Payment Mode</label><span class ="mand">*</span>
									<select class = "form-control" name = "paymode">
										<option></option>
										<option value = "1"  <?php if($paydata->pay_mode == 1){ echo "selected"; } ?> >Cash</option>
										<option value = "2" <?php if($paydata->pay_mode == 2){ echo "selected"; } ?> >Online</option>	
									</select>
								</div>
								<div class = "form-group col-md-4">
									<label>Transaction No</label>
									<input type = "text" class = "form-control" name = "transactiono" value = "<?php echo $paydata->transaction_no; ?>">
								</div>
								<div class = "form-group col-md-4">
									<label>Pay Date</label><span class ="mand">*</span>
									<input type = "date" class = "form-control" name = "paydate"  value = "<?php echo $paydata->pay_date; ?>">
								</div>
								<div class = "form-group col-md-4">
									<label>Next Date</label>
									<input type = "date" class = "form-control" name = "nextpay"  value = "<?php echo $paydata->next_pay; ?>" >
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
									<textarea class = "form-control" name = "remarks"><?php echo $paydata->remark; ?></textarea>
								</div>
								<div class = "form-group col-md-4">
									<button class="btn btn-primary" type="submit">Save</button>
								</div>
								
						<?php echo form_close(); ?>	
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
		//echo datatable("#add-datatable" , $urlarr); ?>
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