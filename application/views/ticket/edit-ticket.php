
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
	
       	<div class="row">
				 <div class="panel panel-default"> 
				<div class="panel-heading no-print">
							<div class="row">
					<div class="col-md-12">
						<h4>Edit Ticket <small><?php echo $ticket->ticketno; ?></small> 
						
						<div style="float:right">
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onclick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div>
         <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="https://thecrm360.com/new_crm/ticket/add" title="Add New Ticket"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>
            
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php echo base_url("ticket"); ?>" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div>
         </div>
						</h4>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="col-md-2"></div>
				<div class="col-md-8 panel-default panel-body" style ="border:1px solid #f7f7f7">
		
				
				<?php echo form_open(); ?>
			<div class="row ">
				<div class="col-md-6">
					<div class="form-group">
						<label>Client</label>
						<span class="form-control"><?php echo $ticket->clientname; ?></span>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type = "text" class="form-control" value = "<?php echo $ticket->name; ?>" name = "name">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type = "text" class="form-control" value = "<?php echo $ticket->email; ?>" name = "email">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Complain Date</label>
						<input type = "text" class="form-control add-date-picker" name = "complaindate" value= "<?php echo date("m/d/Y", strtotime($ticket->coml_date)) ?>">
					</div>
				</div>
		<?php if($this->session->companey_id!=83){ ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Product</label>
					<select class="form-control add-select2 chg-product" name = "product">
							<?php if(!empty($product)) {
								foreach($product as $ind => $prd){
									
									?><option value ="<?php echo $prd->id ?>" <?php echo ($ticket->product == $prd->id) ? "selected" : ""; ?>><?php echo $prd->country_name; ?> </option><?php
								}
								
							} ?>
						
							
						</select>
					</div>
				</div>
				<div class="col-md-6">
						<div class="form-group">
						<label>Problem</label>
						<select class="form-control add-select2" name = "relatedto">
					<?php  if(!empty($problem)) {
								foreach($problem as $ind => $prblm){
									
									?><option value = "<?php echo $prblm->title; ?>" <?php echo ($prblm->title == $ticket->issue) ? "selected" : ""; ?>><?php echo $prblm->title ?> </option><?php
								}	
								
							} ?>
				
						</select>
					</div>
				</div>
		<?php } ?>
				<div class = "col-md-6" id = "waranty-start">
					
				</div>
				<div class = "col-md-6" id = "waranty-end">
					
				</div>
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
				<?php if($this->session->companey_id!=83){ ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Source</label>
						<select class="form-control add-select2" name = "source">
							<?php  if(!empty($source)) {
								foreach($source as $ind => $prblm){
									
									?><option value = "<?php echo $prblm->s_id ?>" <?php echo ($ticket->sourse == $prblm->s_id) ? "selected" : ""; ?> ><?php echo $prblm->source_name ?> </option><?php
								}	
								
							} ?>
						</select>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Attachment</label>
						<input type = "file" name = "attachment" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Remark</label>
						<textarea name = "remark" class="form-control"><?php echo $ticket->message; ?></textarea>
					</div>
				</div>
				<input type = "hidden" name = "ticketno" value = "<?php echo $ticket->ticketno; ?>">
				<div class = "col-md-12 text-center">
					<button class="btn btn-success" type="submit">Save</button>
				</div>
				</div>
				<?php echo form_close(); ?>
			</div>
			</div>
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
</script>