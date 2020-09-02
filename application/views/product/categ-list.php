<div class="row">

   <!--  table area -->

   <div class="col-sm-12">

      <div  class="panel panel-default thumbnail">

         <div class="panel-heading no-print">

            <div class="btn-group"> 
				<a href = "<?php echo base_url("product/category") ?>" class="btn btn-success"> Category </a>
              

            </div>

         </div>

         <div class="panel-body">

            <div class="row m-t-20"><?php if($this->session->error!=''){ ?>

               <button  class='btn btn-danger text-left'><?php echo $this->session->error; ?></button>

               <?php } ?>

               <?php if($this->session->success!=''){ ?>

               <button  class='btn  btn-success left'><?php echo $this->session->success; ?></button>

               <?php } ?>

            </div>
			<div class = "row">
				<div class = "col-md-12">
					<?php echo form_open() ?>
					<div class = "row">
						<div class = "form-group col-md-1">
							<label>Category</label>
						</div>
						<div class = "form-group col-md-3">
							<input type = "text" class = "form-control col-md-7" name = "category" value ="">
						</div>
						
							<div class = "form-group col-md-3">
							<?php if(!empty($categid)){
								?><input type = "hidden" name = "categid" value = "<?php echo $categid; ?>"><?php
							} ?>
							<button type = "submit" class = "btn btn-info"> Save </button>
						</div>
					</div>
			
					<?php echo form_close(); ?>
				</div>
			</div>
      <form id='product_cat_form'>
            <input type = "hidden" name = "categid" value = "<?php echo $categid; ?>">
            <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">

               <thead>

                  <tr role="row">

                     <th class=" wid-20" tabindex="0" rowspan="1" colspan="1">

                        <input type='checkbox' class="checked_all" value="check all" >&nbsp; 

                     </th>

                     <th class="sorting wid-10" style="border-left:none;">S.N </th>

                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Category Name</th>

                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Status</th>

                     <th class="sorting wid-10" tabindex="0" rowspan="1" colspan="1">Actions</th>

                  </tr>

               </thead>

               <tbody>

                  <?php $i=1; foreach($category as $ctg){?>

                  <tr>

                     <td><input type='checkbox' name='cat[]' class="checkbox" value='<?php echo $ctg->id;?>'>&nbsp; </td>

                     <td><?=$i++ ?></td>

                     <td><?=$ctg->name ?></td>

                     <td><?php echo (($ctg->status==1)?display('active'):display('inactive')); ?></td>

                     <td class="center">

                        <a  class="edit" data-toggle="modal" data-target="#product_list<?php echo $ctg->id;?>"><i class="ti-pencil"></i></a> 
						<a  href = "<?php echo base_url("product/category/".$ctg->id.".html"); ?>"><i class="fa fa-eye"></i></a> 
                     </td>

                  </tr>

                  <?php } ?>

         

               </tbody>

            </table>

            <button class="btn btn-danger" type="button" onclick="delete_product()">

            <i class="ti-trash"></i>

            Delete

            </button>

            </form>

         </div>

      </div>

   </div>

</div>

<!----- Add switch box modal -------->

<!-- Modal -->

<div class="modal fade" id="myModal"  role="dialog">

   <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">

         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Add Product</h4>

         </div>

         <div class="modal-body">

            <form method="POST" action="<?php echo base_url('dash/add_product')?>">

               <div class="row">

                  <div class="form-group col-md-12">

                     <label>Product Name</label>

                     <input type="text" class="form-control" name="product_name" required>

                  </div>

               </div>

               <div class="row">

                  <div class="form-group col-md-6">

                     <button class="btn btn-success" type="submit">Submit</button>

                  </div>

               </div>

            </form>

         </div>

         <div class="modal-footer">

         </div>

      </div>

   </div>

</div>

<!----------------------------------->       

<script type="text/javascript">

   $('.checked_all').on('change', function() {     

           $('.checkbox').prop('checked', $(this).prop("checked"));              

   });

   $('.checkbox').change(function(){ 

       if($('.checkbox:checked').length == $('.checkbox').length){

              $('.checked_all').prop('checked',true);

       }else{

              $('.checked_all').prop('checked',false);

       }

   });

   

</script>

<script>

   function delete_product(){

     var x=  confirm('Are you sure delete this Records ? ');

  if(x==true){   
   $.ajax({
   type: 'POST',
   url: '<?php echo base_url();?>product/delete_product_category',
   data: $('#product_cat_form').serialize()
   })
   .done(function(data){   
      alert( "Delete successfully" );
      window.location.href = '<?php echo base_url()?>product/category';
   })
   .fail(function() {
    alert( "fail!" );
   });
   }else{
      location.reload(); 
   }}
</script>

<script>

   function delete_switches(){       

      var ids = [];      

     $('input[name^="user_status[]"]').each(function() {          

          ids.push($(this).val());

      });

      if(confirm("Are you sure want to delete...")){          

         $.ajax({             

             url : '<?php echo base_url('dash/delete_switch_box')?>',

             type: 'POST',

             data: {ids:ids},

             success:function(data){                 

                 alert("Deleted successfully");

                 location.reload();

             }

         });

      }   

   }

</script>