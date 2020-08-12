<div class="row">

   <!--  table area -->
	<style>
		.card{
			border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
		}
		.card-header{
			padding:0px;
		}
		.card-header img{
			    height: 180px;
    width: 100%;
		}
	</style>
   <div class="col-sm-12">

      <div  class="panel panel-default thumbnail">

         <div class="panel-heading no-print">

            <div class="btn-group"> 

               <a class="btn btn-success" href = "<?php echo base_url("product/addproduct"); ?>" ><i class="fa fa-plus"></i> <?php echo display('Add_More') ?></a> 

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
				<?php
				if(!empty($product_list)) {
					
					
					foreach($product_list as $i => $prd){ 
					
						if(empty($prd->image)){
							$prd->image = "default.png";
						}
					?>
						<div class = "col-md-3">
							<div class = "card">
								<div class = "card-header">
							<img src = "<?php  echo base_url("assets/images/products/".$prd->image); ?>" class = "img-responsive">
								</div>
								<div class = "card-body card-content-member">
							<h4><?php echo  $prd->country_name;  ?></h4>
							<p> <i class = "fa fa-rupee"></i> <strike><?php echo $prd->scheme; ?></strike> <?php echo $prd->price ?></p>
									<div>
									<?php if($prd->stock  == 0){
										?>Out Of Stock<?php
									}else{
										
										?><a href  = "#" class = "btn btn-primare">Buy Now</a><?php
									} ?>
									</div>
								</div>
								<div class = "card-footer">
								
								</div>
							</div>	
						</div>
				<?php }
				}
				?>		
			</div>
     


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

   url: '<?php echo base_url();?>deactive_product',

   data: $('#login').serialize()

   })

   .done(function(data){

   if(data==1){	

       alert( "Delete successfully" );

       window.location.href = '<?php echo base_url()?>dash/product_list';

       

   }else{

   alert( "Delete Unsuccessful" );

   window.location.href = '<?php echo base_url()?>dash/product_list';

   }

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