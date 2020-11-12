<div class="col-md-6 col-sm-12 card card-body col-height details-column" style="border: 1px solid #c8ced3;padding: 15px;border-top: none;">
<div class="exTab3">
	<ul  class="nav nav-tabs" role="tablist"> 

		<span class="scrollTab" style="position: absolute; left: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-left" onclick="tabScroll('left')"></i></span>    

		<li class="active"><a  href="#basic" data-toggle="tab" style="padding: 10px 10px; ">Basic</a></li> 
		<li class=""><a  href="#related_tickets" data-toggle="tab" style="padding: 10px 10px; ">Related Tickets</a></li>   

		 <?php
		 //print_r($tab_list);
            if(!empty($tab_list)){
                //print_r($tab_list);die;
                foreach ($tab_list as $key => $value) 
                { 
                  if ($value['id'] != 1) 
                  	{ ?>
                    <li><a href="#<?=str_replace(' ', '_', $value['title'])?>" data-toggle="tab" style="padding: 10px 10px;"><?=$value['title']?></a></li>
                   <?php
               		}
               	}
            }

          ?>

           <span class="scrollTab" style="position: absolute; right: 0; font-size: 22px; line-height: 40px; z-index: 999"><i class="fa fa-caret-right"  onclick="tabScroll('right')"></i></span>

	</ul>
	<div class="tab-content clearfix">
        <div class="tab-pane active" id="basic">
			<div class="row">
<?php echo form_open_multipart(base_url("ticket/update_ticket/".$ticket->ticketno)); ?>
	
			<input type="hidden" name="complaint_type" value="<?=$ticket->complaint_type?>">

		<?php if($this->session->companey_id==65){ ?>

					<div class="trackingDetails"></div>
					
				<div class="col-md-6">
					<div class="form-group">
						<label>Tracking Number <i class="text-danger opt" style="display: none;">*</i></label>
						<input type="text" name="tracking_no" class="form-control" onblur="loadTracking(this)" value="<?php if(!empty($ticket->tracking_no)){ echo $ticket->tracking_no;} ?>">
					</div>
				</div>
				<script type="text/javascript">

					$(document).ready(function(){
						loadTracking($("input[name=tracking_no]").get(0));
					});
				</script>

				<?php if($ticket->complaint_type=='1'){
						echo'<script type="text/javascript">
						$(".opt").show();
						$("input[name=tracking_no]").attr("required","required");
						</script>';
					}?>
					

		<?php } ?>

		<div class="col-md-6">
			<div class="form-group">
				<label>Referred By</label>
				<select class="form-control add-select2 choose-client" name = "referred_by" required>
					<?php 
					if(!empty($referred_type))
					{
						foreach($referred_type as $ref)
						{
				echo "<option value =".$ref->id." ".($ref->id==$ticket->referred_by?'selected':'').">".$ref->name."</option>";

						}
					} 
					?>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label>Problem For</label>
				<select class="form-control add-select2 choose-client" name = "client" required readonly>
					<?php 
					if(!empty($problem_for))
					{
						foreach($problem_for as $ind => $clt)
						{
				echo "<option value =".$clt->enquiry_id." selected>".$clt->name."</option>";

						}
					} 
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Name<span class="text-danger">*</span></label> 
				<input type="text" name="name" id="ticket_holder" class="form-control" value="<?php if(!empty($ticket->name)){ echo $ticket->name;} ?>" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Email<span class="text-danger">*</span></label>
				<input type="email" class="form-control" name="email" value="<?php if(!empty($ticket->tck_email)){ echo $ticket->tck_email;} ?>" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Phone<span class="text-danger">*</span></label>
				<input type="text" name="phone" class="form-control" value="<?php  if(!empty($ticket->phone)){ echo $ticket->phone; } ?>" required>
			</div>
		</div>
		<div class="col-md-6" style="display: none;">
			<div class="form-group">
				<label>Complain Date</label>
				<input type = "text" class="form-control add-date-picker" name = "complaindate" value= "<?php echo date("m/d/Y", strtotime($ticket->coml_date)) ?>">
			</div>
		</div>
		<?php if($this->session->companey_id!=83){ ?>
		<div class="col-md-6">
			<div class="form-group">
				<label>Product</label>
				<select name="product" class="form-control">
				<?php
				foreach ($product as $prd)
				{
					echo'<option value="'.$prd->id.'" '.($prd->id==$ticket->product?'selected':'').'>'.$prd->country_name.'</option>';
				}
				?>
				</select>
				<!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->country_name)){ echo $ticket->country_name;} ?>" > -->
			</div>
		</div>
		<?php } ?>
		
		<?php if($this->session->user_right!=214 && 0){ 
			?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nature of Complaint</label>
						<select class="form-control add-select2" name = "issue">
						<option value = ""> -- Select --</option>
						<?php  if(!empty($issues)) {
								foreach($issues as $ind => $issue){
									?><option value = "<?php echo $issue->id ?>" <?php echo ($issue->id == $ticket->issue) ? "selected" : ""; ?> ><?php echo ucfirst($issue->title) ?> </option><?php
								}	
							} ?>
						</select>
					</div>
				</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Source</label>
				<select name="source" class="form-control">
				<?php
				foreach ($leadsource as $sor)
				{
					echo'<option value="'.$sor->lsid.'" '.($sor->lsid==$ticket->sourse?'selected':'').'>'.$sor->lead_name.'</option>';
				}
				?>
				</select>
				<!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->ticket_source)){ echo ucwords($ticket->ticket_source);} ?>" > -->
			</div>
		</div>
		<?php
		}
		?>
		
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

		<div class="col-md-12">
			<label>Remark</label>
			<!-- <div style = "padding: 10px;border: 1px solid #e5e1e1;margin-right:25px;border-radius: 10px;font-size:16px;margin-bottom:10px;"><?php if(!empty($ticket->message)){ echo $ticket->message;} ?></div> -->
			<textarea name="remark" class="form-control"><?=$ticket->message?></textarea>
		</div>
		
		<div class="col-md-12">
			
			<div class="form-group" >			
				<label>Attachment <small> ( Only Image/PDF ) </small>:</label>
				<?php
				//$error="This file is not availible";
				if($error =$this->session->flashdata('error'))
				{
					echo'<div class="alert alert-danger">'.$error.'</div>';
				}
				?>
				<?php
				if($ticket->attachment)
				{
					$attachment  = json_decode($ticket->attachment);
					echo'<ul class="list-group">';
					$i=0;
					if(!empty($attachment)){
						foreach ($attachment as $at)
						{
							echo '<li class="list-group-item">'.$at.'
							<div class="btn-group pull-right">
							<a href="'.base_url('uploads/ticket/'.$at).'" target="_blank"><span class="btn btn-primary  btn-xs">View</span></a>
							<a href="'.base_url('ticket/remove_attachment/'.$ticket->ticketno.'/'.$i).'"><span class="btn btn-danger  btn-xs">Delete</span></a>
							</div>
							</li>';
							$i++;
						}
					}
					echo'</ul><br>';
				}
				?>
				<input type="file" name="attachment[]" class="attachFiles" accept=".jpg,.jpeg,.png,.pdf" multiple>
			</div>
			<div class="form-group">
				<label>Ticket Type : </label> 
				<span class='badge badge-info'><?=$ticket->complaint_type=='1'?'Compaint':($ticket->complaint_type=='2'?'Query':'NA')?></span>
			</div>
		</div>
		<!-- <div class="col-md-6">
			<div class="form-group">			
				<label>Complaint Type : </label>
					<span class='badge badge-danger'>
					<?php
						if ($ticket->complaint_type==1) {
							echo "Complaint";
						}else if ($ticket->complaint_type==2) {
							echo "Query";
						}
					?>
					</span>
			</div>
		</div> -->
		<!-- <div class="col-md-6">
			<div class="form-group">
				<label>Priority</label>
			<?php
				if($ticket->priority == 1){
					?><span class="badge badge-info">Low</span><?php
				}else if($ticket->priority == 2){
					?><span class="badge badge-warning">Medium</span><?php
				}else if($ticket->priority == 3){
					?><span class="badge badge-danger">High</span><?php
				}
				?>
			</div>
		</div> -->
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12" style ="background: #f7f7f7;border: 1px solid #ccc;padding: 15px;border-radius: 10px;margin-bottom:25px; display: none;">
				
					<div class="row">
					<div class = "col-md-12">
						<div class = "form-group">
							<label>Review</label>
							<textarea class = "form-control" name = "review"><?php echo (!empty($ticket->review)) ? $ticket->review : "";  ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label><?=display('ticket_problem')?> </label>
								<select class="form-control" name = "issue">
									<option value = "">-- Select --</option>
								<?php if(!empty($problem)) {
										foreach($problem as $ind => $prblm){
											?><option value = "<?php echo $prblm->id; ?>" <?php echo ($ticket->category == $prblm->id) ? "selected" : "" ?>><?php echo $prblm->subject_title; ?></option><?php
										}	
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Solution </label>
								<select class="form-control" name = "solution">
									<option value = "">-- Select --</option>
									<option value = "1"  <?php echo ($ticket->solution == 1) ? "selected" : "" ?>>Done</option>
									<option value = "2" <?php echo ($ticket->solution == 2) ? "selected" : "" ?>>Proccess</option>
									<option value = "3"  <?php echo ($ticket->solution == 3) ? "selected" : "" ?>>Defer</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status </label>
								<select class="form-control" name = "status">
									<option value = "">-- Select --</option>
									<option value = "0" <?php echo ($ticket->status == 0) ? "selected" : "" ?>>Unread</option>
									<option value = "1" <?php echo ($ticket->status == 1) ? "selected" : "" ?>>Proccess</option>
									<option value = "2" <?php echo ($ticket->status == 2) ? "selected" : "" ?>>Read</option>
									<option value = "3" <?php echo ($ticket->status == 3) ? "selected" : "" ?>>Dropped</option>
								</select>
							</div>
						</div>
					</div>
					<div class="text-center">					
						<input type ="hidden" name = "ticketno" value = "<?php echo $ticket->id; ?>">
						<input type ="hidden" name = "client" value = "<?php echo $ticket->client; ?>">
						<!-- <button type = "submit" class="btn btn-success">Update</button> -->
					</div>
					
				</div>
				<center><button type = "submit" class="btn btn-success">Update</button></center>
			</div>	
		</div>
		<?=form_close()?>
	  </div>
	</div>
	<div class="tab-pane" id="related_tickets">
		<div class="row">
		<?php
		if(!empty($related_tickets))
		{
			echo'<table class="table table-bordered">
			<tr>
			'.($this->session->companey_id==65?'<th>Tracking No</th>':'').'
			<th>Ticket Number</th>
			<th>Name</th>
			<th>Type</th>
			<th>Action</th>
			</tr>';
				foreach ($related_tickets as $row)
				{ //print_r($row); exit();
				echo'<tr>

					'.($this->session->companey_id==65?('<td>'.($row->tracking_no==''?'NA':$row->tracking_no).'</td>'):'').'
					<td>'.$row->ticketno.'</td>
					<td>'.$row->name.'</td>
					<td>'.($ticket->complaint_type=='1'?'Compaint':($ticket->complaint_type=='2'?'Query':'NA')).'</td>
					<th><a href="'.base_url('ticket/view/'.$row->ticketno).'"><button class="btn btn-small btn-primary">View</button></a></th>
					</tr>';
				}	
			echo'</table>';
		}else 
		{
			echo'<div class="alert alert-danger">No Related Ticket found.</div>';
		}
		?>
		</div>
	</div>

	 <?php
	   if(!empty($tab_list))
	   {
	    
	   	 foreach ($tab_list as $key => $value) { ?>
	      <div class="tab-pane" id="<?=str_replace(' ', '_', $value['title'])?>">
	      <?php
	      if ($value['id'] != 1) {
	        echo tab_content($value['id'],$this->session->companey_id,$ticket->ticketno,str_replace(' ', '_', $value['title']),2); 
	      }
	      ?>
	      </div>
	      <?php
	    }
	    ?>
	    <script type="text/javascript">
      		function edit_dynamic_query(t)
      		{
      			var tab_id = $(t).data('tab-id');
      			var cmnt_id = $(t).data('cmnt');
      			var ticket = $(t).data('ticket');
      			var comp_id = $(t).data('comp-id');
      			var tabname = $(t).data('tab-name')
      			if(cmnt_id!='')
      			{
      				$.ajax({
      					url:'<?=base_url('ticket/edit_query_data')?>',
      					data:{cmnt_id:cmnt_id,tab_id:tab_id,ticket:ticket,comp_id:comp_id,tabname:tabname,task:'view'},
      					type:'post',
      					success:function(res)
      					{
      						Swal.fire({
      							title:'Edit '+tabname,
      							html:res,
      							with:'100%',
      							showConfirmButton:false,
      							showCancelButton:true,
      							cancelButtonText:'Close',
      							cancelButtonColor:'#E5343D'
      						});
      					},
      					error:function(u,v,w)
      					{
      						alert(w);
      					}
      				});
      			}
      			
      		}
      	</script>


	    <?php
	  }
	  ?>
	
  </div>
</div>
</div>
 <style>
 	 .col-height{
    min-height: 700px;
    max-height: 700px;
    overflow-y: auto;
    border-bottom: solid #c8ced3 1px;
  }
		.nav-tabs
        {
         overflow-x: hidden;
         overflow-y:hidden;
         white-space: nowrap;
         height: 50px;
        }
        .nav-tabs > li
        {
           white-space: nowrap;
           float: none;
           display: inline-block;
           font-size: 11px;
           background-color: #283593;
        }

		.nav-tabs > li.active > a {
		    color: #555 !important;
		    background-color: #fff;
		}
        .nav-tabs > li > a {
         border-radius: 4px 4px 0 0 ;
         color: #fff!important;
         }
         #exTab3 .tab-content {
         /*color : white;*/
         background-color: #fff;
         padding : 5px 15px;
         }
      .nav-tabs > li.active > a:hover {
	    color: #555;
	    cursor: default;
	    background-color: #fff;
	    border: none!important;
	   }
	   .nav-tabs > li.active > a {
	    color: #555;
	    cursor: default;
	    background-color: #fff;
	    border: none!important;
	   }

         .card {
         position: relative;
         display: -ms-flexbox;
         display: flex;
         -ms-flex-direction: column;
         flex-direction: column;
         min-width: 0;
         word-wrap: break-word;
         /*background-color: #fff;*/
         background-clip: border-box;
         border: 1px solid #c8ced3;
         border-radius: 0.25rem;
         }
         .card-body {
         -ms-flex: 1 1 auto;
         flex: 1 1 auto;
         padding: 1.25rem;
         }
         .list-group {
         display: -ms-flexbox;
         display: flex;
         -ms-flex-direction: column;
         flex-direction: column;
         padding-left: 0;
         margin-bottom: 0;
         }
         .list-group-item {
         position: relative;
         display: block;
         padding: 0.75rem 1.25rem;
         margin-bottom: -1px;
         background-color: #fff;
         border: 1px solid rgba(0, 0, 0, 0.125);
         }
         .list-group-item-action {
         width: 100%;
         color: #5c6873;
         text-align: inherit;
         }
         .active .badge{color: white!important;}
      </style>
<script>
	 manageScroll();
function manageScroll()
{
  if($(".nav-tabs")[0].scrollWidth > $(".nav-tabs")[0].clientWidth)
            {
              $(".scrollTab").show();
            }
            else
            {
               $(".scrollTab").hide();
            }
}

$(window).resize(function(){
  manageScroll();
});

  function tabScroll(side)
  {
    if(side=='left')
    {
      var leftPos = $('.nav-tabs').scrollLeft();
     
        $(".nav-tabs").animate({
            scrollLeft: leftPos - 200
        }, 100);
    }
    else if (side=='right')
    {   
        var leftPos = $('.nav-tabs').scrollLeft();
      
        $(".nav-tabs").animate({
            scrollLeft: leftPos + 200
        }, 100);
    }
  }
</script>

<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
<script>


	// $(".attachFiles").on('change',function(e){
			
	// 	 var myform = new FormData();

	// 	myform.append('attachment[]',this.files);

	// 		$.ajax({
	// 				url:"<?php //base_url('ticket/add_attachment')?>",
	// 				type:"post",
	// 				data:myform,
	// 				contentType: false,
 //    				processData: false,

	// 				success:function (res)
	// 				{
	// 					document.write(res);
	// 				},
	// 				error:function(u,v,w)
	// 				{
	// 					alert(w);
	// 				}
	// 		});
	// });

	$(document).ready(function(){
		
		$(".add-date-picker").datepicker({
			 format: 'yyyy/mm/dd',
			 startDate: '-7d'
		});	
	});
	$(document).on("change", ".choose-client", function(){	

		$.ajax({
			url     : "<?php echo base_url('ticket/loadinfo'); ?>",
			type    : "post",
			data    : {clientno : $(this).val()},
			success : function (resp){
				var jdata = JSON.parse(resp);
				$("input[name=name]").val(jdata.name);
				$("input[name=email]").val(jdata.email);
			}
		})
	});

<?php
if($this->session->companey_id==65)
{
?>
	function loadTracking(that)
	{	//alert(key);
		//alert(that.value);
		if(that.value=='')
		{

		}else{
			
			$.ajax({
				url:'<?=base_url('ticket/view_tracking')?>',
				type:'post',
				data:{trackingno:that.value},
				beforeSend:function(){

					$(that).parents('form').find('input,select,button').attr('disabled','disabled');
				},
				success:function(q)
				{	$(that).parents('form').find('input,select,button').removeAttr('disabled');
					$(".trackingDetails").html(q);
				},
				error:function(u,v,w)
				{
					alert(w);
				}
			});
		}
	}
<?php
}
?>
function tabchange(t,key)
{
	$(".btn").removeClass("active");
	if(key)
	{
		
		$(t).addClass('active');
		$("#old_tickets").show();
		$("#ticket_details").hide();
	}
	else
	{
		$(t).addClass('active');
		$("#old_tickets").hide();
		$("#ticket_details").show();
	}
}

</script>