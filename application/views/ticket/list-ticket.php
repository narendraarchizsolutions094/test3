    <div class="row">
			<div class="col-md-12"> 
					<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
						<div class="row">
							<div class="btn-group"> 
				                <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        
				                <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" href="<?=base_url().'ticket/add'?>" title="New Ticket"></a>                       
				            </div>
							<div class="col-md-4 col-sm-4 col-xs-4 pull-right" >  
					          <div style="float: right;">   


		<div class="btn-group dropdown-filter">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by <span class="caret"></span>
              </button>              
              <ul class="filter-dropdown-menu dropdown-menu">   
                    <li>
                      <label>
                      <input type="checkbox" value="date" id="datecheckbox" name="filter_checkbox"> Date </label>
                    </li>  
                    
                    <li>
                      <label>
                      <input type="checkbox" value="source" id="sourcecheckbox" name="filter_checkbox"> Source</label>
                    </li>                
                    
                     <li>
                      <label>
                      <input type="checkbox" value="problem" id="problemcheckbox" name="filter_checkbox"> Problem</label>
                    </li>

                     <li>
                      <label>
                      <input type="checkbox" value="priority" id="prioritycheckbox" name="filter_checkbox"> Priority</label>
                    </li>    

                     <li>
                      <label>
                      <input type="checkbox" value="issue" id="issuecheckbox" name="filter_checkbox"> Issue</label>
                    </li>    

                    <li>
                      <label>
                      <input type="checkbox" value="created_by" id="createdbycheckbox" name="filter_checkbox"> Created By</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="assign_to" id="assigncheckbox" name="filter_checkbox"> Assign To</label>
                    </li>
                   
                   <li>
                      <label>
                      <input type="checkbox" value="assign_by" id="assign_bycheckbox" name="filter_checkbox"> Assign By</label>
                    </li>

                    <li>
                      <label>
                      <input type="checkbox" value="product" id="prodcheckbox" name="filter_checkbox"> Product</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="stage" id="stagecheckbox" name="filter_checkbox"> Stage</label>
                    </li> 
                   <li>
                      <label>
                      <input type="checkbox" value="sub_stage" id="sub_stagecheckbox" name="filter_checkbox"> Sub Stage</label>
                    </li> 
                    <li>
                      <label>
                      <input type="checkbox" value="status" id="statuscheckbox" name="filter_checkbox"> Status</label>
                    </li> 
                    <li class="text-center">
                      <a href="javascript:void(0)" class="btn btn-sm btn-primary " id='save_advance_filters' title="Save Filters Settings"><i class="fa fa-save"></i></a>
                    </li>                   
                </ul>                
            </div>
					            <div class="btn-group" role="group" aria-label="Button group">
					              <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Actions">
					                <i class="fa fa-sliders"></i>
					              </a>  
					            <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto; left: unset; right: 0!important;">
                      <?php if(user_access(313)) { ?>
                            <a class="btn" data-toggle="modal" data-target="#AssignSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #ccc; width: 100%; text-align: left"><?php echo display('assign_selected'); ?></a>                                        
                      <?php } 
                      if(user_access(312)){                      
                      ?>
                            <a class="btn" data-toggle="modal" data-target="#DeleteSelected" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #ccc; width: 100%; text-align: left"><?php echo display('delete'); ?></a>
                      <?php
                      }
                      ?>
                            <a class="btn" data-toggle="modal" data-target="#table-col-conf" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #ccc; width: 100%; text-align: left"><?php echo display('table_config'); ?></a>
					            </div>                                         
					          </div>  
					        </div>       
					      </div>
						</div>
					</div>
					<div class="row">
						<div class="">
							<div class="panel-body">
							<!-- Filter Panel Start -->

<form id="ticket_filter">
	<div class="row" id="filter_pannel">
        <div class="col-lg-12">
            <div class="panel panel-default">
               
                      <div class="form-row">
                       
                        <div class="form-group col-md-3" id="fromdatefilter">
                          <label for="from-date"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" name="from_created" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3" id="todatefilter">
                          <label for="to-date"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="to-date" name="to_created" style="padding-top:0px;">
                        </div> 
                         <div class="form-group col-md-3" id="sourcefilter">
                          <label for="source"><?php echo display("source"); ?></label>
                          <select class="form-control" name="source" id="source">
                              <option value="" style="display:">---Select Source---</option>
                               <?php foreach ($sourse as $row) {?>
                                
                                 <option value="<?=$row->lsid?>" <?php if(!empty(set_value('source'))){if (in_array($row->lsid,set_value('source'))) {echo 'selected';}}?>><?=$row->lead_name?></option>
                              <?php }?>

                          </select>
                        </div>


                        <!-- ======= Problem filter======== -->

                        <div class="form-group col-md-3" id="problemfilter">
                          <label for="problem"><?php echo display("problem"); ?></label>
                          <select class="form-control" name="problem" id="problem">
                              <option value="" style="display:">---Select Problem---</option>
                               <?php foreach ($problem as $row) {?>
                                
                                 <option value="<?=$row->id?>"><?=$row->subject_title?></option>
                              <?php 
	                          }
	                          ?>

                          </select>
                        </div>

                        <div class="form-group col-md-3" id="priorityfilter">
                          <label for="priority">Priority</label>
                          <select class="form-control" name="priority" id="priority">
              <option value="" style="display:">---Select Priority---</option>
              <option value="1">Low</option>
							<option value="2">Medium</option>
							<option value="3">High</option>n>
                           </select>
                        </div>

						<div class="form-group col-md-3" id="issuefilter">
                          <label for="issue">Issue</label>
                         <select class="form-control" name="issue" id="issue">
                              <option value="" style="display:">---Select Issue---</option>
                               <?php  if(!empty($issues)) {
								foreach($issues as $ind => $issue){
									?><option value = "<?php echo $issue->id ?>"><?php echo ucfirst($issue->title) ?> </option>
								<?php
								}	
							} ?>

                          </select>
                        </div>
                        <!-- ======================= -->
                     </div>
                    <div class="form-row">                      
                        
                         <div class="form-group col-md-3" id="createdbyfilter">
                          <label for="">Created By</label>
                         <select name="createdby" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                          if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if(!empty(set_value('createdby'))){if (in_array($product->sb_id,set_value('createdby'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?>                               
                              </option>
                              <?php }}?>    
                         </select>                       
                        </div>
                         <div class="form-group col-md-3" id="assignfilter">
                          <label for="">Assign To</label>  
                         <select name="assign" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if(!empty(set_value('assign'))){if (in_array($product->sb_id,set_value('assign'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?></option>
                              <?php }}?>    
                         </select>                          
                        </div>

                         <div class="form-group col-md-3" id="assign_byfilter">
                          <label for="">Assign By</label>  
                         <select name="assign_by" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($created_bylist)) {
                              foreach ($created_bylist as $createdbylist) {?>
                              <option value="<?=$createdbylist->pk_i_admin_id;?>" <?php if(!empty(set_value('assign'))){if (in_array($product->sb_id,set_value('assign'))) {echo 'selected';}}?>><?=$createdbylist->s_display_name.' '.$createdbylist->last_name;?> -  <?=$createdbylist->s_user_email?$createdbylist->s_user_email:$createdbylist->s_phoneno;?></option>
                              <?php }}?>    
                         </select>                          
                        </div>
                        
                    </div>

                    <div class="row">
                    <div class="form-group col-md-3" id="prodfilter">
                    <label for="">Products</label>  
                    <select name="prodcntry" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($prodcntry_list)) {
                              foreach ($prodcntry_list as $prodcntrylist) {?>
                              <option value="<?=$prodcntrylist->id;?>" <?php if(!empty(set_value('prodcntry'))){if (in_array($prodcntrylist->id,set_value('prodcntry'))) {echo 'selected';}}?>><?= $prodcntrylist->country_name ?></option>
                              <?php }}?>    
                    </select> 
                    </div> 
                    
                     <div class="form-group col-md-3" id="stagefilter">
                    <label for="">Stage</label>  
                    <select name="stage" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($stage)) {
                              foreach ($stage as $stage_list) {?>
                              <option value="<?=$stage_list->stg_id?>"><?=$stage_list->lead_stage_name?> </option>
                              <?php 
                              }
                            }
                        ?>    
                    </select> 
                    </div> 

                     <div class="form-group col-md-3" id="sub_stagefilter">
                    <label for="">Sub Stage</label>  
                    <select name="sub_stage" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($sub_stage)) {
                              foreach ($sub_stage as $sub_stage_list) {?>
                              <option value="<?=$sub_stage_list->id?>"><?=$sub_stage_list->description?> </option>
                              <?php 
                              }
                            }
                        ?>     
                    </select> 
                    </div> 
                   
                   <div class="form-group col-md-3" id="statusfilter">
                    <label for="">Ticket Status</label>  
                    <select name="ticket_status" class="form-control"> 
                          <option value="">Select</option>
                         <?php 
                              if (!empty($ticket_status)) {
                              foreach ($ticket_status as $sub_stage_list) {?>
                              <option value="<?=$sub_stage_list->id?>"><?=$sub_stage_list->status_name?> </option>
                              <?php 
                              }
                            }
                        ?>     
                    </select> 
                    </div> 

                    </div>
          
            </div>
        </div>
    </div> 
</form>

 <?php 
        $acolarr = array();
        $dacolarr = array();
        if(isset($_COOKIE["ticket_allowcols"])) {
          $showall = false;
          $acolarr  = explode(",", trim($_COOKIE["ticket_allowcols"], ","));       
        }else{          
          $showall = true;
        }         
        if(isset($_COOKIE["ticket_dallowcols"])) {
          $dshowall = false;
          $dacolarr  = explode(",", trim($_COOKIE["ticket_dallowcols"], ","));       
        }else{
          $dshowall = false;
        }       
 ?>

							<!-- Filter Panel End -->
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-12">
									<table id="ticket_table" class=" table table-striped table-bordered" style="width:100%;">
										<thead>
										<th class="noExport sorting_disabled">
                    <input type='checkbox' class="checked_all1" value="check all" >
                     </th>
											<th>S.No.</th>
                      <?=($showall or in_array(1,$acolarr))?'<th>Ticket</th>':''?>

                      <?php
                      if($this->session->companey_id==65)
                      {
                      ?>
                        <?=($showall or in_array(15,$acolarr))?'<th>'.display('tracking_no').'</th>':''?>
                      <?php
                      }
                      ?>
                      <?=($showall or in_array(7,$acolarr))?'<th>Created By</th>':''?>
                      <?=($showall or in_array(9,$acolarr))?'<th>Date</th>':''?>

											<?=($showall or in_array(2,$acolarr))?'<th>Client</th>':''?>
										  <?=($showall or in_array(3,$acolarr))?'<th>Email</th>':''?>
											<?=($showall or in_array(4,$acolarr))?'<th>Phone</th>':''?>
											<?=($showall or in_array(5,$acolarr))?'<th>Product</th>':''?>
											<?=($showall or in_array(6,$acolarr))?'<th>Assign To</th>':''?>
                      <?=($showall or in_array(17,$acolarr))?'<th>Assign By</th>':''?>
                      <?=($showall or in_array(8,$acolarr))?'<th>Priority</th>':''?>
										  <?=($showall or in_array(10,$acolarr))?'<th>Referred By</th>':''?>
                      <?=($showall or in_array(11,$acolarr))?'<th>'.display('data_source').'</th>':''?>
                      <?=($showall or in_array(12,$acolarr))?'<th>'.display('stage').'</th>':''?>
                      <?=($showall or in_array(13,$acolarr))?'<th>Sub Stage</th>':''?>
                      <?=($showall or in_array(14,$acolarr))?'<th>'.display('ticket_remark').'</th>':''?>
                      <?=($showall or in_array(16,$acolarr))?'<th>Status</th>':''?>


                      <?php 
                      if(!empty($dacolarr) and !empty($dfields))
                      {
                        foreach($dfields as $ind => $flds)
                        {                
                          if(!empty(in_array($flds->input_id, $dacolarr )))
                          {            
                          ?><th><?php echo $flds->input_label; ?></th><?php 
                          }
                        }
                       } ?>

										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							</form>
								<!--<?php echo form_close(); ?>-->
						</div>
					</div>
				</div>
			</div>
		</div>


 <div id="AssignSelected" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ticket Assignment</h4>
      </div>
      <div class="modal-body">
      
                <div class="row">
                  
            
            <div class="form-group col-md-12">  
            <label>Select Employee</label> 
            <div id="imgBack"></div>
            <select class="form-control"  name="assign_employee" id="emply">                    
            <?php foreach ($user_list as $user) { 
                            
                          if (!empty($user->user_permissions)) {
                            $module=explode(',',$user->user_permissions);
                          }                           
                            
                            ?>
                            <option value="<?php echo $user->pk_i_admin_id; ?>">
                              <?=$user->s_display_name ?>&nbsp;<?=$user->last_name; ?>                                
                            </option>
                            <?php 
                          //}
                        } ?>                                                      
            </select> 
            </div>
            
          <input type="hidden" value="" class="enquiry_id_input" >
          
            <div class="form-group col-sm-12">        
            <button class="btn btn-success" type="button" onclick="assign_tickets();">Assign</button>        
            </div>
    
                </div>          
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="DeleteSelected" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ticket Assignment</h4>
      </div>
      <div class="modal-body">
          <i class="fa fa-question-circle" style="font-size:100px;"></i><br><h1>Are you sure, you want to permanently delete selected record?</h1>
        </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="delete_recorde()">Ok</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </div>

  </div>
</div>


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
function reset_input(){
$('input:checkbox').removeAttr('checked');
}

$('.checked_all1').on('change', function() {     
    $('.checkbox1').prop('checked', $(this).prop("checked"));    
}); 
</script>
<script>
function assign_tickets(){
  if($('.checkbox1:checked').size() > 1000){
    alert('You can not assign more that 1000 enquiry at once');
  }else{
      var p_url = '<?php echo base_url();?>ticket/assign_tickets';
      var re_url = '<?php echo base_url();?>ticket'; 
		var epid = $("#emply").val();	  

    var x = $(".checkbox1:checked");
    var Arr = new Array();
    $(x).each(function(k,v){
      Arr.push($(this).val());
    });

  $.ajax({
    type: 'POST',
    url: p_url,
    data: {tickets:Arr,epid:epid},  //+ "&epid="+epid+"",
    beforeSend: function(){
                 $("#imgBack").html('uploading').show();
    },
    success:function(data){
         alert(data);
         //document.getElementById('testdata').innerHTML =data;
          window.location.href=re_url;
    }});
  }
}
</script>



<script>
  
$(document).ready(function(){
   $("#save_advance_filters").on('click',function(e){
    e.preventDefault();
    var arr = Array();  
    $("input[name='filter_checkbox']:checked").each(function(){
      arr.push($(this).val());
    });        
    setCookie('ticket_filter_setting',arr,365);      
    alert('Your custom filters saved successfully.');
  }) 



var enq_filters  = getCookie('ticket_filter_setting');
if (!enq_filters.includes('date')) {
  $('#fromdatefilter').hide();
  $('#todatefilter').hide();
}else{
  $("input[value='date']").prop('checked', true);
}

if (!enq_filters.includes('emp')) {
  $('#empfilter').hide();
}else{
  $("input[value='emp']").prop('checked', true);
}

if (!enq_filters.includes('source')) {
  $('#sourcefilter').hide();
}else{
  $("input[value='source']").prop('checked', true);
}

if (!enq_filters.includes('problem')) {
  $('#problemfilter').hide();
}else{
  $("input[value='problem']").prop('checked', true);
}

if (!enq_filters.includes('priority')) {
  $('#priorityfilter').hide();
}else{
  $("input[value='priority']").prop('checked', true);
}

if (!enq_filters.includes('issue')) {
  $('#issuefilter').hide();
}else{
  $("input[value='issue']").prop('checked', true);
}

if (!enq_filters.includes('product')) {
  $('#prodfilter').hide();
}else{
  $("input[value='product']").prop('checked', true);
}


if (!enq_filters.includes('created_by')) {
  $('#createdbyfilter').hide();
}else{
  $("input[value='created_by']").prop('checked', true);
}

if (!enq_filters.includes('assign_to')) {
  $('#assignfilter').hide();
}else{
  $("input[value='assign_to']").prop('checked', true);
}

if (!enq_filters.includes('assign_by')) {
  $('#assign_byfilter').hide();
}else{
  $("input[value='assign_by']").prop('checked', true);
}

if (!enq_filters.includes('stage')) {
  $('#stagefilter').hide();
}else{
  $("input[value='stage']").prop('checked', true);
}

if (!enq_filters.includes('sub_stage')) {
  $('#sub_stagefilter').hide();
}else{
  $("input[value='sub_stage']").prop('checked', true);
}

if (!enq_filters.includes('status')) {
  $('#statusfilter').hide();
}else{
  $("input[value='status']").prop('checked', true);
}

$('#buttongroup').hide();
 $('input[name="filter_checkbox"]').click(function(){              
        if($('#datecheckbox').is(":checked")){
         $('#fromdatefilter').show();
         $('#todatefilter').show();
         $("#buttongroup").show();
        }
        else{
           $('#fromdatefilter').hide();
           $('#todatefilter').hide();
           $("#buttongroup").hide();
        }
      
        if($('#sourcecheckbox').is(":checked")){
          $('#sourcefilter').show();
          $("#buttongroup").show();
        }
        else{
          $('#sourcefilter').hide();
          $("#buttongroup").hide();
        }

        if($('#problemcheckbox').is(":checked")){
          $('#problemfilter').show();
          $("#buttongroup").show();
        }
        else{
          $('#problemfilter').hide();
          $("#buttongroup").hide();
        }

        if($('#createdbycheckbox').is(":checked")){
          $('#createdbyfilter').show();
        }
        else{
          $('#createdbyfilter').hide();
        }
        if($('#assigncheckbox').is(":checked")){
          $('#assignfilter').show();
        }
        else{
          $('#assignfilter').hide();
        }
        if($('#assign_bycheckbox').is(":checked")){
          $('#assign_byfilter').show();
        }
        else{
          $('#assign_byfilter').hide();
        }

        if($('#issuecheckbox').is(":checked")){
          $('#issuefilter').show();
        }
        else{
          $('#issuefilter').hide();
        }
        if($('#prioritycheckbox').is(":checked")){
          $('#priorityfilter').show();
        }
        else{
          $('#priorityfilter').hide();
        }
       if($('#prodcheckbox').is(":checked")){
         $('#prodfilter').show();
         //alert("check");
       }
       else{
         $('#prodfilter').hide();
       }
      if($('#stagecheckbox').is(":checked")){
          $('#stagefilter').show();
        }
        else{
          $('#stagefilter').hide();
        }
        if($('#sub_stagecheckbox').is(":checked")){
          $('#sub_stagefilter').show();
        }
        else{
          $('#sub_stagefilter').hide();
        }
        if($('#statuscheckbox').is(":checked")){
          $('#statusfilter').show();
        }
        else{
          $('#statusfilter').hide();
        }
    });
})

$(document).ready(function(){
 
  var count=0;
  var checkboxes = document.getElementsByName('product_filter[]');
  var id = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {     
     if (checkboxes[i].checked) {
        id.push(checkboxes[i].value);
        count++;
     }
  }
  if(count>1){
   $("#enq-create").hide();
  } 
  else{
    $("#enq-create").show();
  }  
});

// function moveto_client(){
//   if($('.checkbox1:checked').size() > 1000){
//     alert('You can not move more that 1000 enquiry at once');
//   }else{
//   $.ajax({
//   type: 'POST',
//   url: '<?php echo base_url();?>enquiry/move_to_client',
//   data: $('#enquery_assing_from').serialize(),
//   success:function(data){
//       if(data=='1'){
//            alert('Successfully Moved in Clients'); 
//         window.location.href='<?php echo base_url();?>led/index'
//       }else{
//        alert(data);
//       }
//   }});
//   }
// }

$(document).ready(function() {
      $('#ticket_table').DataTable({         
          "processing": true,
          "scrollX": true,
          "scrollY": 520,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "columnDefs": [{ "orderable": false, "targets": 0 }],
           "order": [[ 1, "desc" ]],
          "ajax": {
              "url": "<?=base_url().'Ticket/ticket_load_data'?>",
              "type": "POST",
              //"dataType":"html",
              //success:function(q){ //alert(q); //document.write(q);},
              error:function(u,v,w)
              {
                alert(w);
              }
              },
              <?php if(user_access(317)) { ?>
        // "lengthMenu": [[30, 60, 90, -1], [30, 60, 90, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'csv', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'excel', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn', title: 'exportTitle',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'pdf', title: 'list<?=date("Y-m-d H:i:s")?>', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }}, 
            {extend: 'print', className: 'btn-xs btn',exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }} 
             ] ,  <?php  } ?>  });
    $('#ticket_filter').change(function() {

        var form_data = $("#ticket_filter").serialize();       
       // alert(form_data);
        $.ajax({
        url: '<?=base_url()?>ticket/ticket_set_filters_session',
        type: 'post',
        data: form_data,
        success: function(responseData){
         // document.write(responseData);
          $('#ticket_table').DataTable().ajax.reload();
          //stage_counter();      
           }
        });
    });
});


function delete_recorde(){
  var x = $(".checkbox1:checked");
  if(x.length > 0)
  {   
      var Arr = new Array();
      $(x).each(function(k,v){
        Arr.push($(this).val());
      });
      $.ajax({
        url:'<?=base_url().'ticket/delete_ticket'?>',
        type:'post',
        data:{ticket_list:Arr},
        success:function(q)
        {
          $("#DeleteSelected").find('button[data-dismiss=modal]').click();
           $('#ticket_table').DataTable().ajax.reload();
        }
      });
  }else{
    alert("0 Record Selected.");
  }
 
}

</script>

<!--------------------TABLE COLOUMN CONFIG----------------------------------------------->
<div id="table-col-conf" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 96%;">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Column Configuration</h4>
      </div>
      <div class="modal-body">         
           <div class="row">
             <div class="col-md-3">
                <label class=""><input type="checkbox" id="selectall" onclick="select_all()">&nbsp;Select All</label>
             </div>
           </div>
        <hr>
          <div class="row">
          <div class = "col-md-4">             
          <label class=""><input type="checkbox" class="choose-col" id="choose-col" value = "1" <?php echo ($showall == true or in_array(1, $acolarr)) ? "checked" : ""; ?>> Ticket</label>
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "2"  <?php echo ($showall == true or in_array(2, $acolarr)) ? "checked" : ""; ?>>  Client</label> 
          </div>
          <div class = "col-md-4">  
          <label  class=""><input type="checkbox" class="choose-col"  value = "3"  <?php echo ($showall == true or in_array(3, $acolarr)) ? "checked" : ""; ?>> Email</label>
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "4"  <?php echo ($showall == true or in_array(4, $acolarr)) ? "checked" : ""; ?>>  Phone </label>
          </div>
          
          
          
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "5"  <?php echo ($showall == true or in_array(5, $acolarr)) ? "checked" : ""; ?>>  Product </label>
              </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "6"  <?php echo ($showall == true or in_array(6, $acolarr)) ? "checked" : ""; ?>>  Assign To </label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "17"  <?php echo ($showall == true or in_array(17, $acolarr)) ? "checked" : ""; ?>>  Assign By </label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "7"  <?php echo ($showall == true or in_array(7, $acolarr)) ? "checked" : ""; ?>> Created By</label>  &nbsp;
          </div>
          <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="choose-col"  value = "8"  <?php echo ($showall == true or in_array(8, $acolarr)) ? "checked" : ""; ?>>  Priority</label>  &nbsp;
          </div>


          <div class = "col-md-4">  
          
              <label class=""><input type="checkbox" class="choose-col"  value = "9"  <?php echo ($showall == true or in_array(9, $acolarr)) ? "checked" : ""; ?>>     <?php echo display("create_date"); ?></label> &nbsp;
          </div>

        <div class = "col-md-4">  
          
           <label  class=""><input type="checkbox" class="choose-col"  value = "10"  <?php echo ($showall == true or in_array(10, $acolarr)) ? "checked" : ""; ?>> <?php echo "<th>Referred By</th>"; ?></label>  &nbsp; 
         </div>

         <div class = "col-md-4">  
          
               <label class=""><input type="checkbox" class="choose-col"  value = "11"  <?php echo ($showall == true or in_array(11, $acolarr)) ? "checked" : ""; ?>>   <?php echo display("data_source"); ?></label>  &nbsp; 
           </div>
          
         <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "12"  <?php echo ($showall == true or in_array(12, $acolarr)) ? "checked" : ""; ?>>  Stage</label>  &nbsp;
          </div>

          <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "13"  <?php echo ($showall == true or in_array(13, $acolarr)) ? "checked" : ""; ?>>  Sub Stage</label>  &nbsp;
          </div>

           <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "14"  <?php echo ($showall == true or in_array(14, $acolarr)) ? "checked" : ""; ?>>  <?=display('ticket_remark')?></label>  &nbsp;
          </div>

          <?php
          if($this->session->companey_id==65)
          {
          ?>
           <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "15"  <?php echo ($showall == true or in_array(15, $acolarr)) ? "checked" : ""; ?>>  <?=display('tracking_no')?></label>  &nbsp;
          </div>

          <?php
        }
        ?>
         <div class = "col-md-4">  
            <label class=""><input type="checkbox" class="choose-col"  value = "16"  <?php echo ($showall == true or in_array(16, $acolarr)) ? "checked" : ""; ?>>Ticket Status</label>  &nbsp;
          </div>
           
        <?php   
        if(!empty($dfields)) {           
            foreach($dfields as $ind => $fld){              
            ?>
            <div class = "col-md-4">  
          <label class=""><input type="checkbox" class="dchoose-col"  value = "<?php echo $fld->input_id; ?>"  <?php echo (in_array($fld->input_id, $dacolarr)) ? "checked" : ""; ?>>   <?php echo ucwords($fld->input_label); ?></label>  &nbsp;
          </div>
            <?php   
              
            }?>
             </div>
          <?php } ?>
                
              <div class="col-12" style="padding: 0px;">
                <div class="row">              
                  <div class="col-12" style="text-align:center;">                                                
                               
                  </div>
                </div>                                   
              </div> 
                  
         
      </div>
      <div class="modal-footer">
        <button class="btn btn-success set-col-table" type="button">Save</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  function select_all(){

var select_all = document.getElementById("selectall"); //select all checkbox
var checkboxes = document.getElementsByClassName("choose-col"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
  for (i = 0; i < checkboxes.length; i++) { 
    checkboxes[i].checked = select_all.checked;
  }
});


for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){
      select_all.checked = false;
    }
    //check "select all" if all checkbox items are checked
    if(document.querySelectorAll('.choose-col:checked').length == checkboxes.length){
      select_all.checked = true;
    }
  });
}

}

</script>

<script type="text/javascript">

  $(document).on("click", ".set-col-table", function(e){
    
    e.preventDefault();
    if($(".choose-col:checked").length == 0 && $(".dchoose-col:checked").length == 0 ){
      
      return false;
    }
    var chkval = "";
    $(".choose-col:checked").each(function(){
      
      chkval += $(this).val()+",";
    });
    var dchkval = "";
    $(".dchoose-col:checked").each(function(){
      
      dchkval += $(this).val()+",";
    });
    
    document.cookie = "ticket_allowcols="+chkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
    document.cookie = "ticket_dallowcols="+dchkval+"; expires=Thu, 18 Dec 2053 12:00:00 UTC; path=/";
   // alert("C");
    location.reload();    
  });
</script>


<!--   Table Config -->

<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>