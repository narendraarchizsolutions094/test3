<div class="row">
<!--  form area -->
<div class="col-sm-12">
    <div  class="panel panel-default thumbnail"> 
        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="btn btn-primary" href="<?php echo base_url("product") ?>"> <i class="fa fa-list"></i> All Products </a>  
            </div>
        </div>
        <div class="panel-body panel-form">
            <div class="row">
				 <div class="col-md-1 col-sm-12">
				</div>
                <div class="col-md-9 col-sm-12">
		<?php   $isedit = false;	
				if(!empty($product)) {
					$isedit = true;
				}	?>
		<?php  echo form_open_multipart(); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" id="proname" name="proname" value="<?php echo ($isedit == true) ? $product->country_name : set_value("proname"); ?>">
							</div>
							<div class="form-group">
								<label>HSN Code</label>
								<input type="text" class="form-control" id="hsn-code" placeholder="Enter HSN" name="hsn_code" value="<?php echo ($isedit == true) ? $product->hsn : set_value("hsn_code"); ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
								<div class="form-group">
									<label>Main Image</label>
								<input type="file" name="mainimage" class="dropify" data-default-file="">
									<?php if($isedit == true ) { ?>
									<img src = "<?php echo base_url("assets/images/products/".$product->image); ?>" class = "img-responsive">		
									<?php } ?>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class = "col-md-12">
							<div class = "form-group">
								<label>Details</label>
								<textarea class = "form-control" name = "details"><?php echo ($isedit == true) ? $product->details : set_value("details"); ?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Category</label>
						<?php if($isedit == true) {
								$pcateg = $product->category;
								}else{
								$pcateg = 	 set_value("cat"); 
								}			
									?>
								<select class="form-control load-subcateg" id="cat" name="cat">
									<option value="">Select</option>
								<?php if(!empty($category)) { 
										foreach($category as $ind => $categ) {
									?>
											<option value = "<?php echo $categ->id; ?>" <?php echo ($pcateg == $categ->id) ? "selected" : ""; ?>><?php echo $categ->name; ?></option>
									<?php }
									}
									?>
								</select>
							</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>SubCategory</label>
											<?php if($isedit == true) {
								$categ = $product->subcatogory;
								}else{
								$categ = 	 set_value("scat"); 
								}			
									?>
									<select class="form-control" id="scat" name="scat">
										<option value="">Select</option>
								 <?php if(!empty($subcategory)) { 
											foreach($subcategory as $ind => $sbcateg) {
												
												?><option value = "<?php echo $sbcateg->id ?>"><?php echo $sbcateg->subcat_name; ?></option><?php		
											}	
										}
										?>
									</select>
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-6">
								<label>Size</label>
								<input type="text" class="form-control" id="height" name="size" value="<?php echo ($isedit == true) ? $product->size : set_value("size"); ?>">
							</div>
							<div class="col-md-6">
									<label>Weight</label>
									<input type="text" class="form-control" id="width" name="weight" value="<?php echo ($isedit == true) ? $product->weight : set_value("weight"); ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label>Price</label>
										<input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="<?php echo ($isedit == true) ? $product->price : set_value("price"); ?>">
									</div>
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label>Other Price</label>
										<input type="number" class="form-control" id="price" placeholder="Enter price" name="othrprice" value="<?php echo ($isedit == true) ? $product->othr_price : set_value("othr_price"); ?>">
									</div>
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label>Tax</label>
										<input type="number" class="form-control" id="tax" placeholder="Enter tax" name="tax" value="<?php echo ($isedit == true) ? $product->tax : set_value("tax"); ?>">
									</div>
									
									
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label>Color</label>
										<select class="form-control" id="color" name="color">
											<option value="">Select</option>
										</select>
									</div>
							</div>
							<div class = "col-md-6">
								<div class = "form-group">
									<label>Scheme</label>
									<select class = "form-control" name = "scheme">
									<?php 
									if($isedit == true) {
										$schm = set_value("scheme"); 
									}else{
										$schm = $product->scheme;
									}
									if(!empty($scheme)) {
											foreach($scheme as $ind => $scm) {
											$qtytxt = "";
											if($scm->qty > 0){
												$qtytxt = "QTY ";	
											}
											?><option value = "<?php echo $scm->id ?>" <?php echo ($schm == $scm->id) ? "selected" : ""; ?>><?php echo "QTY ".$scm->coupan." - ".$scm->discount; ?></option><?php		
											}	
										} ?>
									
									</select>
								</div>
							</div>
							<div class = "col-md-6">
								<div class = "form-group">
									<label>Process Id</label>
									<select class = "form-control" name = "process">
									<?php if(!empty($process)) {
												if($isedit == true) {
												$prcs = set_value("process"); 
											}else{
												//$prcs = $product->process;
												$prcs =  "";
											}
											foreach($process as $ind => $prc) { 
											
										
											?><option value = "<?php echo $prc->sb_id ?>" <?php echo ($prcs == $prc->sb_id) ? "selected" : ""; ?>><?php echo $prc->product_name; ?></option><?php		
											}	
										} ?>
									
									</select>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<label>Status</label>
								<label class="custom-control custom-radio d-inline">
								<input type="radio" class="custom-control-input" name="status" value="1" checked="">
								<span class="custom-control-label">Active</span>
								</label>
								<label class="custom-control custom-radio d-inline">
								<input type="radio" class="custom-control-input" name="status" value="0">
								<span class="custom-control-label">Inactive</span>
								</label>
							</div>
							<div class = "col-md-12 text-center">
								<?php if($isedit == true) { ?>
								<input type = "hidden" name = "productid" value = "<?php echo $product->sb_id; ?>">
								<input type = "hidden" name = "detailsid" value = "<?php echo $product->id; ?>">
								<?php } ?>
								<button type = "reset" class = "btn btn-info"> Reset </button>
								<button type = "submit" class = "btn btn-primary"> Save </button>
							</div>		
						</div>
			</div>
			<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
	
<script>
	$(document).on("change", ".load-subcateg", function(){
		$("#scat").load("<?php echo base_url('buy/loadsubcateg/') ?>"+$(this).val());
	});
</script>