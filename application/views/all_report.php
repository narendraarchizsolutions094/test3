<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<!------ Filter Div ---------->
    <div class="row" id="filter_pannel">
        <div class="col-lg-12">          
            <div class="panel panel-default">
                <div class="panel-heading no-print">
                  <div class="btn-group"> 
                      <a class="btn btn-primary" href="<?php echo base_url("report/index") ?>"> <i class="fa fa-list"></i>  <?php echo display('reports_list') ?> </a>
                      <?php if(user_access(220)) { if(!empty($this->session->telephony_token)){  ?>
                      <a class="btn btn-success" href="<?php echo base_url("call_report/index") ?>" style="margin-left: 5 px !important ;" > <i class="fa fa-list"></i>  <?php echo display('telephone_call_reports') ?> </a>
                    <?php } }?>
                  </div>
              </div>
                <div class="panel-body">
                    <div class="widget-title">                        
                        <h3><?=$title?></h3>
                    </div><hr>
                    <form method="post" class="lead-form" id="filter_and_save_form" action="<?php echo base_url('Report/view_details') ?>">
                      <div class="form-row col-md-12">
                        <div class="form-group col-md-3">
                          <label for="inputEmail4"><?php echo display("from_date"); ?></label>
                          <input type="date" class="form-control" id="from-date" value="<?php if (!empty(set_value('from_exp'))) {echo set_value('from_exp');}?>" name="from_exp" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("to_date"); ?></label>
                          <input type="date" class="form-control" id="to-date" value="<?php if (!empty(set_value('to_exp'))) {echo set_value('to_exp');}?>" name="to_exp" style="padding-top:0px;">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("employee"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="employee[]" id="employee">
                          

							   <?php foreach ($employee as $user) {?>
                                    <option value="<?=$user->pk_i_admin_id?>" <?php if(!empty(set_value('employee'))){if (in_array($user->pk_i_admin_id,set_value('employee'))) {echo 'selected';}}?>><?=$user->s_display_name . " " . $user->last_name;?> -  <?=$user->s_user_email?$user->s_user_email:$user->s_phoneno;?></option>
                                <?php }?>
                          </select>
                          <input type="checkbox" name="hier_wise" value="1" <?php if (!empty(set_value('hier_wise')) && set_value('hier_wise')==1) {echo 'checked';}?>>
                          Hierarchy wise
                        </div>
						<div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("source"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="source[]" id="source">
                              
                               <?php foreach ($sourse as $row) {?>
                                 <option value="<?=$row->lsid?>" <?php if(!empty(set_value('source'))){if (in_array($row->lsid,set_value('source'))) {echo 'selected';}}?>><?=$row->lead_name?></option>
                              <?php }?>
                          </select>
                        </div>                      
                        
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("subsource"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="subsource[]" id="subsource">
                              
                               <?php foreach ($subsourse as $row) {?>
                                 <option value="<?=$row->subsource_id?>" <?php if(!empty(set_value('subsource'))){ if (in_array($row->subsource_id,set_value('subsource'))) {echo 'selected';}}?>><?=$row->subsource_name?></option>
                              <?php }?>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("datasource"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="datasource[]" id="datasource">
                              
                               <?php foreach ($datasourse as $row) {?>
                                 <option value="<?=$row->datasource_id?>" <?php if(!empty(set_value('datasource'))){if (in_array($row->datasource_id,set_value('datasource'))) {echo 'selected';}}?>><?=$row->datasource_name?></option>
                              <?php }?>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputPassword4"><?php echo display("status"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="state[]" id="state" onchange="lead_fields(this)">
                              
  <option value="1" <?php if(!empty(set_value('state'))){ if (in_array('1',set_value('state'))) {echo 'selected';}}?>>Enquiry</option>
  <option value="2" <?php if(!empty(set_value('state'))){ if (in_array('2',set_value('state'))) {echo 'selected';}}?>>Lead</option>
  <option value="3" <?php if(!empty(set_value('state'))){ if (in_array('3',set_value('state'))) {echo 'selected';}}?>>Client</option>
                          </select>
                        </div>
                        <div class="form-group col-md-3 lead_subsource_class">
                          <label for="lead_source">Disposition</label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="lead_source[]" id="lead_source" >
                              
                              
                              <?php 
                            if (!empty($all_stage_lists)) {
                              foreach ($all_stage_lists as $stage) {?>
                              <option value="<?=$stage->stg_id?>" <?php if(!empty(set_value('lead_source'))){if (in_array($stage->stg_id,set_value('lead_source'))) {echo 'selected';}}?>><?=$stage->lead_stage_name;?></option>
                              <?php }
                            }?>
                          </select>
                        </div>
                        <div class="form-group col-md-3 lead_subsource_class">
                          <label for="lead_source">Lead Description</label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="sub_disposition[]">
                              <?php 
                              if (!empty($all_sub_stage_lists)) {
                                foreach ($all_sub_stage_lists as $stage) { ?>
                                  <option value="<?=$stage->id?>" <?php if(!empty(set_value('sub_disposition'))){if (in_array($stage->id,set_value('sub_disposition'))) {echo 'selected';}}?>><?=$stage->description;?></option>
                                <?php }
                                }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-row col-md-12">
                        
                        <?php
                        $report_columns = 
                                        array(
                                              'S.No',
                                              'Name',
                                              'Phone',
                                              'Email',
                                              'Created By',
                                              'Assign To',
                                              'Gender',
                                              'Source',
                                              'Subsource',
                                              'Lead Description',
                                              'Status',
                                              'DOE',
                                              'Process',
                                              'Updated Date',
                                              'Disposition',
                                              'State',
                                              'City',
                                              'Product'
                                            );
                           // $this->session->set_userdata($report_columns);             
                        ?>
                        <div class="form-group col-md-12">
						
                          <label for="enq_product"><?php echo display("report_columns"); ?><label class="required" style="color:red">*</label></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control" name="report_columns[]" required  id = "selected-col">
                            
                <option <?php if(!empty(set_value('report_columns'))){ if (in_array('S.No',set_value('report_columns'))) {echo 'selected';}}?> selected>S.No</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Name',set_value('report_columns'))) {echo 'selected';}}?> selected>Name</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Phone',set_value('report_columns'))) {echo 'selected';}}?> selected>Phone</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Email',set_value('report_columns'))) {echo 'selected';}}?> selected>Email</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Created By',set_value('report_columns'))) {echo 'selected';}}?>>Created By</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Assign To',set_value('report_columns'))) {echo 'selected';}}?>>Assign To</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Gender',set_value('report_columns'))) {echo 'selected';}}?>>Gender</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Source',set_value('report_columns'))) {echo 'selected';}}?>>Source</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Subsource',set_value('report_columns'))) {echo 'selected';}}?>>Subsource</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Lead Description',set_value('report_columns'))) {echo 'selected';}}?>>Lead Description</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Status',set_value('report_columns'))) {echo 'selected';}}?>>Status</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('DOE',set_value('report_columns'))) {echo 'selected';}}?>>DOE</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Process',set_value('report_columns'))) {echo 'selected';}}?>>Process</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Updated Date',set_value('report_columns'))) {echo 'selected';}}?>>Updated Date</option>
							  <option <?php if(!empty(set_value('report_columns'))){if (in_array('Disposition',set_value('report_columns'))) {echo 'selected';}}?>>Disposition</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('State',set_value('report_columns'))) {echo 'selected';}}?>>State</option>
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('City',set_value('report_columns'))) {echo 'selected';}}?>>City</option>
                
                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Company Name',set_value('report_columns'))) {echo 'selected';}}?>>Company Name</option>

                <option <?php if(!empty(set_value('report_columns'))){if (in_array('Product',set_value('report_columns'))) {echo 'selected';}}?>>Product</option>
								
                <?php if(!empty($dfields)) { 
								foreach($dfields as $dind => $df){									
									?><option <?php if(!empty(set_value('report_columns'))){if (in_array(trim($df['input_label']),set_value('report_columns'))) {echo 'selected';}}?>><?php if(!empty($df['rep_label'])){ echo $df['rep_label'];}else{ echo $df['input_label'];} ?></option><?php
								}	
							  }
							  ?>	
                          </select>                          
                        </div>
                      </div>
                      <div class="row col-md-12">
                       <div class="form-group col-md-3">
                        <label>Dropped</label>
                       <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="drop_status[]" id = "selected-col">
                       
                       <option value="dropped" <?php if(!empty(set_value('drop_status'))){ if (in_array('dropped',set_value('drop_status'))) {echo 'selected';}}?>>Dropped</option>
                       <option value="active" <?php if(!empty(set_value('drop_status'))){ if (in_array('active',set_value('drop_status'))) {echo 'selected';}}?>>Active</option>
                       </select>
                       </div>
                       <div class="form-group col-md-3">
                          <label for="enq_product"><?php echo display("proccess"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="enq_product[]" id="enq_product" >
                                                           
                              <?php 
                              if (!empty($process)) {
                              foreach ($process as $product) {?>
                              <option value="<?=$product->sb_id;?>" <?php if(!empty(set_value('enq_product'))){if (in_array($product->sb_id,set_value('enq_product'))) {echo 'selected';}}?>><?=$product->product_name;?></option>
                              <?php }}?>                              
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="productlst"><?php echo display("product"); ?></label>
                          <select data-placeholder="Begin typing a name to filter..." multiple class="form-control chosen-select" name="productlst[]" id="productlst" >
                                                           
                              <?php 
                              if (!empty($products)) {
                              foreach ($products as $product) {?>
                              <option value="<?=$product->id;?>" <?php if(!empty(set_value('productlst'))){if (in_array($product->id,set_value('productlst'))) {echo 'selected';}}?>><?=$product->country_name;?></option>
                              <?php }}?>                              
                          </select>
                        </div>                         
                     </div>
                     <div class="row col-md-12">
                       <div class="form-group col-md-4">
                         <label for="enq_product">Follow Up Report</label>
                         <input type="checkbox" name="all" value="all" <?php if(!empty(set_value('all'))){?> checked <?php }?> >
                        </div>
                     </div>
                     <br>
                      <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success" id="filter_report"><?php echo display("filter"); ?></button>
                            <button type="submit" class="btn btn-primary" id="filter_and_save"><?php echo display("filter_and_save"); ?></button>
							              <input type=button class="btn btn-warning" onClick="location.href='<?php echo base_url('report/view_details'); ?>'" value='Reset'>                            
                        </div>
                      </div>
                      <br>                      
                    </form>
                        <div class="form-group col-md-12 table-responsive" id="showResult">
                           <table id="example"  class=" table table-striped table-bordered" style="width:100%">
                              <thead>
                              <tr>                                         
                                  <?php
                                  if (!empty($post_report_columns)) {
                                    foreach ($post_report_columns as $value) { ?>
                                      <th><?=ucfirst($value)?></th>
                                    <?php
                                    }
                                  } 
                                ?>
                              </tr>
                              </thead>
                               <tbody>                                       
                              </tbody>
                          </table>
                      </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    
<!---------------------------->
<script type="text/javascript">
 $("#filter_and_save,#filter_report").on('click',function(e){
    if ($("input[name='hier_wise']").is(":checked") && $("#employee").select2('data').length==1) {
      alert("please select one employee for hierarchy wise report");
      e.preventDefault();
    }
 });
	$(document).ready(function(){		
    $("#selected-col").select2();
		$(".chosen-select").select2();
	});

  
  $(document).ready(function(){   
    var d = new Date($.now());
    var report_name = 'Report_'+d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+"_"+d.getMinutes()+"_"+d.getSeconds();
    $('#example').DataTable({         
      "processing": true,
      "scrollX": true,      
      "serverSide": true,          
      "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
      "ajax": {
          "url": "<?=base_url().'report/all_report_filterdata'?>",
          "type": "POST",
      },    
      "columnDefs": [{ "orderable": false, "targets": 0 }],
          "order": [[ 1, "desc" ]],
      dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          title: report_name
        },
        {
          extend: 'csvHtml5',
          title: report_name
        },
        {
          extend: 'excelHtml5',
          title: report_name
        }
      ]
  });




$("#filter_and_save").on("click",function(e){
  e.preventDefault();
  var title = window.prompt("Enter Report Name");  
  if(title){    
    var url = "<?=base_url().'report/create_report'?>";
    $.ajax({
      url:url,
      type:'POST',
      data:{
       'filters':$("#filter_and_save_form").serialize(),
       'report_name':title 
      },
      success:function(result){                
        result = JSON.parse(result);
        if(result.status){
          $("#filter_and_save_form").submit();
        }else{
          alert(result.msg);
        }
      }
    });
  }else{
    alert("Report not saved");
  }
});


  });
</script>
