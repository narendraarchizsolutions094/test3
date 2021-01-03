

<div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
	<div class="col-md-4 col-sm-4 col-xs-4"> 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>   
          <?php
          if(user_access('1010'))
          {
          ?>     
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" data-toggle="modal" data-target="#Save_Contact" title="Add Contact"></a> 
          <?php
          }
          ?>        
        </div>
</div>

<div class="row p-5" style="margin-top: 20px;">
	<div class="col-lg-12">
		<div class="panel panel-success">
			<div class="panel-body">
				<table id="contactTable" class="datatable1 table table-bordered table-response">
					<thead>
	                             
				         <tr>
			                      <th>&nbsp; # &nbsp;</th>
			                      <th><?=display('enquiry')?></th>
			                      <th style="width: 20%;">Company</th>
			                      <th style="width: 20%;">Designation</th>
			                      <th style="width: 20%;">Name</th>
			                      <th style="width: 20%;">Contact Number</th>
			                      <th style="width: 20%;">Email ID</th>
			                      <th style="width: 20%;">Other Detail</th>
			                      <th style="width: 20%;">Created At</th>
			                      <th>Action</th>
				         </tr>
					</thead>
					<tbody>
						<?php
							if(!empty($contact_list))
							{$i=1;
								foreach ($contact_list->result_array() as $row)
								{
									echo'<tr>
											<td>'.$i++.'. </td>
											<td><a href="'.base_url('enquiry/view/').$row['enquiry_id'].'">'.$row['enq_name'].'</a></td>
											<td>'.$row['company'].'</td>
											<td>'.$row['designation'].'</td>
											<td>'.$row['c_name'].'</td>
											<td>'.$row['contact_number'].'</td>
											<td>'.$row['emailid'].'</td>
											<td>'.$row['other_detail'].'</td>
											<td>'.$row['created_at'].'</td>
											<td style="width:50px;">
											<div class="btn-group">';
                      if(user_access('1012'))
                      {
                        echo'<button class="btn btn-warning btn-xs" data-cc-id="'.$row['cc_id'].'" onclick="edit_contact(this)">
                          <i class="fa fa-edit"></i>
                        </button>';
                      }
                      if(user_access('1011'))
                      {
                        echo'<button class="btn btn-danger btn-xs"  data-cc-id="'.$row['cc_id'].'" onclick="deleteContact(this)">
                          <i class="fa fa-trash"></i>
                        </button>';
                      }

                     echo' </div>
                     </td>
									</tr>';
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
function edit_contact(t)
{
  var contact_id = $(t).data('cc-id');
  //alert(contact_id);
  $.ajax({
        url:"<?=base_url('client/edit_contact/')?>",
        type:"post",
        data:{cc_id:contact_id,task:'view',direct_create:1},
        success:function(res)
        {
          Swal.fire({
                title:'Edit Contact',
                html:res,
                with:'100%',
                showConfirmButton:false,
                showCancelButton:true,
                cancelButtonText:'Close',
                cancelButtonColor:'#E5343D',
                onOpen: () => {
				   $('.select2').select2();
				   //alert("Dk");
				},
              });
        },
        error:function(u,v,w)
        {
          alert(w);
        }
  });
}

function deleteContact(t)
{
    var contact_id = $(t).data('cc-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
       // alert(JSON.stringify(result));
        if (result.value) {
            $.ajax({
                        url:"<?=base_url('client/delete_contact/')?>",
                        type:"post",
                        data:{cc_id:contact_id},
                        success:function(res)
                        { 
                          Swal.fire('Done!', '', 'success');
                          $(t).closest('tr').remove();
                        },
                        error:function(u,v,w)
                        {
                          alert(w);
                        }
                });
        }
      });         
}
</script>

<div id="Save_Contact" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Contacts</h4>
         </div>
         <div class="modal-body">
            <div class="row" >
               <?php echo form_open_multipart('client/create_newcontact/','class="form-inner"') ?> 
                <div class="form-group col-md-6">
                    <label>Company</label>
                    <select class="form-control" name="company" onchange="filter_related_to(this.value)">
                      <option value="-1">Select</option>
                      <?php
                      if(!empty($company_list))
                      {
                        foreach ($company_list as $key =>  $row)
                        {
                          echo '<option value="'.$key.'">'.$row->company.'</option>';
                        }
                      }
                      ?>
                    </select>
                </div>

               <div class="form-group col-md-6">
                  <label>Related To</label>
                  <select class="form-control" name="enquiry_id">
                  	<?php
                 	if(!empty($enquiry_list))
                 	{
                 		foreach ($enquiry_list as $row)
                 		{
                 			echo'<option value="'.$row->enquiry_id.'">'.$row->name.'</option>';
                 		}
                 	}
                  	?>
                  </select>
                  
               </div>

               <div class="form-group col-md-6">
                  <label>Designation</label>
                  <input class="form-control" name="designation" placeholder="Designation"  type="text" required>
               </div>
               <div class="form-group col-md-6">
                  <label>Name</label>
                  <input class="form-control" name="name" placeholder="Contact Name"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Contact No.</label>
                  <input class="form-control" name="mobileno" placeholder="Mobile No." maxlength="10"  type="text"  required>
               </div>
               <div class="form-group col-md-6">
                  <label>Email</label>
                  <input class="form-control" name="email" placeholder="Email"  type="email"  required>
               </div>
               <div class="form-group col-md-12">
                  <label>Other Details</label>
                  <textarea class="form-control" name="otherdetails" rows="8"></textarea>
               </div>
               <div class="sgnbtnmn form-group col-md-12">
                  <div class="sgnbtn">
                     <input id="signupbtn" type="submit" value="Add Contact" class="btn btn-primary"  name="Add Contact">
                  </div>
               </div>
               <?php echo form_close()?>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>   
<script type="text/javascript">
  var LIST = <?php echo !empty($company_list)? json_encode($company_list): '{}'?>;
  var OLD_LIST  = <?=!empty($enquiry_list) ? json_encode($enquiry_list):'{}'?>;
  function filter_related_to(v)
  {
      if(Object.keys(LIST).length>0 && v!='-1')
      { 
        var l = '';
        var y = LIST[v];
        var ids = y.enq_ids.split(',');
        var names = y.enq_names.split(',');
        $(ids).each(function(k,id){
            l+="<option value='"+id+"'>"+names[k]+"</option>";
        });
        //alert(l);
        $("select[name=enquiry_id]").html(l);
      }
      else
      { var l = '';
          $(OLD_LIST).each(function(k,v){
            l+="<option value='"+v.enquiry_id+"'>"+v.name_prefix+" "+v.name+" "+v.lastname+"</option>";
          });
          $("select[name=enquiry_id]").html(l);
      }
  }
</script>