
<div class="row p-5">
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
											<td style="width:50px;">
											<div class="btn-group">
				                                <button class="btn btn-warning btn-xs" data-cc-id="'.$row['cc_id'].'" onclick="edit_contact(this)">
				                                  <i class="fa fa-edit"></i>
				                                </button>
				                                <button class="btn btn-danger btn-xs"  data-cc-id="'.$row['cc_id'].'" onclick="deleteContact(this)">
				                                  <i class="fa fa-trash"></i>
				                                </button>
				                              </div>
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
        data:{cc_id:contact_id,task:'view'},
        success:function(res)
        {
          Swal.fire({
                title:'Edit Contact',
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

<?php
function getValue($val)
{ 	
	if(!empty($val) && trim($val)!='')
		return $val;
	else 
		return 'NA';
}
?>
