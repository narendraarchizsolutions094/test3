 <style> 
   table td,table th{text-align:center;font-size:10px;}
table th{background:#283593;color:#fff;}
 .Pending{
   background-color: #337ab7 !important;
   border-color: #337ab7 !important;
   }
   .Processing{
   background-color: #f2711c !important;
   border-color: #f2711c !important;
   }
   .Completed{
   background-color: #37a000 !important;
   border-color: #318d01 !important;
   }
   .Closed{
   background-color: #db2828 !important;
   border-color: #db2828 !important;
   }
   .enq_form_filters {
    width: 0px;
}
input[name=top_filter] {
    visibility: hidden;
}
.border_bottom {
    border-bottom: 2px solid #E4E5E6;
    min-height: 7vh;
    margin-bottom: 1vh;
    cursor: pointer;
}
.badge-warning{
	    background-color: #e59440;
}
.border_bottom_active {
    border-bottom: 2px solid #20A8D8;
    min-height: 7vh;
    margin-bottom: 1vh;
    cursor: pointer;
}
.border_bottom p{
	cursor: pointer;
}
.add-data-table td{
	    max-width: 110px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>

       	<div class="row">
			
				<div class="col-md-12">
			 <div class="panel panel-default pt-2"> 
				<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
							<div class="row">
					<div class="col-md-12">
						<!-- <h4> Tickets <small><?php echo count($tickets); ?></small> --> 
												<div >
            <!-- <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onclick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div> -->
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle btn btn-success" href="<?php echo base_url("ticket/add"); ?>" title="Add New Ticket"> <i class="fa fa-plus" ></i>Add Ticket</a>&nbsp;&nbsp;&nbsp;
            </div>
         </div></h4>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<?php echo form_open(base_url("ticket/filter") , array("id" => "filter-ticket")); ?>
			
			<div class="row" id="active_class">
            <?php 
				$tdy_create = $tdy_update = $dropped = $unread = $total = 0;
			if(!empty($tickets)){
				foreach($tickets as $ind => $tck){
					
					if(date("y-m-d", strtotime($tck->send_date)) == date("y-m-d")){
						
						$tdy_create++; 
					}
					if(date("y-m-d", strtotime($tck->last_update)) == date("y-m-d")){
						
						$tdy_update++; 
					}
					
					if($tck->status == 3){
						
						$dropped++;
					}
					if($tck->status == 0){
						
						$unread++;
					}
					$total++;
				}
				
				
			} ?>       
            <div class="col-md-2" style="">
            <div class="col-12 border_bottom">
                <p style="margin-top: 2vh;font-weight:bold;">
                  <input id="created_today_radio" value="created_today" type="radio" name="top_filter" class="enq_form_filters"><i class="fa fa-edit"></i><label for="created_today_radio">&nbsp;&nbsp;Created Today</label>
                  <span style="float:right;" class="badge badge-pill badge-primary " id="today_created"><?php echo $tdy_create; ?></span>
                </p>
            </div>
            </div>
            <div class="col-md-2">
              <div class="col-12 border_bottom">
                  <p style="margin-top: 2vh;font-weight:bold;">
                    <input type="radio" name="top_filter" value="updated_today" class="enq_form_filters" id="updated_today_radio"><i class="fa fa-pencil"></i><label for="updated_today_radio">&nbsp;&nbsp;Updated Today</label><span style="float:right;background:#ffc107" class="badge badge-pill badge-warning badge badge-dark " id="today_updated"><?php echo  $tdy_update; ?></span>
                  </p>
              </div>
            </div>
            
            <div class="col-md-2">
            <div class="col-12 border_bottom">
                  <p style="margin-top: 2vh;font-weight:bold;" title="Active" class=""> 
                    <input type="radio" name="top_filter" value="unread" checked="checked" class="enq_form_filters" id="active_radio"><i class="fa fa-file"></i><label for="active_radio">&nbsp;&nbsp;Unread</label><span style="float:right;" class="badge badge-pill badge-primary " id="active_all"><?php echo  $unread; ?></span>
                  </p>
              </div>
            </div>
                
				
            <div class="col-md-2">
              <div class="col-12 border_bottom">
                  <p style="margin-top: 2vh;font-weight:bold;" title="Dropped" class="">
                      <input type="radio" name="top_filter" value="droped" class="enq_form_filters" id="droped_radio">
                      <i class="fa fa-thumbs-down"></i><label for="droped_radio">&nbsp;&nbsp;Dropped</label><span style="float:right;background:#E5343D" class="badge badge-danger" id="active_drop"><?php echo $dropped; ?></span>                    
                  </p>
              </div>
            </div>
            <div class="col-md-2">
              <div class="col-12 border_bottom">

                  <p style="margin-top: 2vh;font-weight:bold;" title="Total" class="">
                    <input type="radio" name="top_filter" value="all" class="enq_form_filters" id="total_active_radio">
                    <i class="fa fa-list"></i><label for="total_active_radio">&nbsp;&nbsp;Total</label><span style="float:right;background:#000" class="badge badge-pill badge-dark " id="total_active"><?php echo $total; ?></span>
                  </p>
              </div>
          </div>
   
    </div>
			<?php echo form_close(); ?>
			<?php echo form_open(base_url("ticket/add")); ?>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-12">
			
				
					<table class="add-data-table table table-striped table-bordered">
						<thead>
							<th>S.No.</th>
							<th>Ticket</th>
							<th>Client</th>
							<th>Email </th>
							<th>Phone </th>
							
							<th>Product</th>
							<th>Related To</th>
							<th>Priority</th>
							<th>Remark</th>
							<th>Date</th>
							<th>Action</th>
						</thead>
						<tbody id = "table-body">
					<?php if(!empty($tickets)){
						        $sl=1;
								foreach($tickets as $ind => $tck){
									?>
									<tr><td><?= $sl;?></td>
										<td><?php echo $tck->ticketno; ?></td>
										<td><?php echo $tck->clientname; ?></td>
										<td><?php echo $tck->email ; ?></td>
										<td><?php echo $tck->phone	; ?></td>
										<td><?=$tck->country_name ; ?></td>
										
										<td><?php echo ucwords($tck->category) ; ?></td>
										<td><?php 
											if($tck->priority == 1){
											?><span class="badge badge-info">Low</span><?php	
											}else if($tck->priority == 2){
											?><span class="badge badge-warning">Medium</span><?php		
											}else if($tck->priority == 2){
												?><span class="badge badge-danger">High</span><?php	
											}
										
										?></td>
										<td><?php echo $tck-> message; ?></td>
										<td><?php echo date("d, M, Y", strtotime($tck->	send_date)); ?></td>
										<td style ="min-width:125px;"><a class="btn  btn-success" href="<?php echo base_url("ticket/view/".$tck->ticketno) ?>"><i class="fa fa-eye" aria-hidden="true"></i>
										<a class="btn  btn-default" href="<?php echo base_url("ticket/edit/".$tck->ticketno) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<a class="btn  btn-danger delete-ticket"  data-ticket = "<?php echo $tck->id; ?>" href="<?php echo base_url("ticket/tdelete") ?>"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr>
									
									<?php

									$sl++;
									
								}	
							} ?>
						</tbody>
					</table>
				</div>
			
			
				
				</div>
				<?php echo form_close(); ?>
			</div>
			</div>
			</div>
        </div>            
          
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!--
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>-->
<script>
	$(document).on("click", ".delete-ticket", function(e){
		
		e.preventDefault();
		
		var r = confirm("Are you sure to delete");
		if (r == true) {
		  
		  } else {
		  return false;
		}
		
		$.ajax({
			url  	: $(this).attr("href"),
			type 	: "post",
			data 	: {content : $(this).data("ticket")},
			success : function(resp){
					var jresp = JSON.parse(resp);
					
					if(jresp.status == "success"){
						
						location.reload();
					}else{
						
						
					}
					
			}
		});
		
	});
</script>
<script>
	

</script>


<script>
	$(document).on("click", "#active_class p", function(){
		
	    $('.border_bottom_active').removeClass('border_bottom_active');
		$(this).closest("p").addClass("border_bottom_active");
		
		$.ajax({
			url  	: $("#filter-ticket").attr("action"),
			type 	: "post",
			data 	: {top_filter : $(".enq_form_filters:checked").val()}, //  $("#filter-ticket").serialize(),
			success	: function (resp){
				
				if ( $.fn.DataTable.isDataTable('.add-data-table') ) {
					  $('.add-data-table').DataTable().destroy();
					}

					$('.add-data-table tbody').empty();
				
				//$('.add-data-table').dataTable().fnClearTable();
				$("#table-body").html(resp);
				$('.add-data-table').DataTable();
			}
		})
	});
	

</script>
