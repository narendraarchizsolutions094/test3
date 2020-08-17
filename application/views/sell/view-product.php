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
		.panel .pad {
  padding: 0 15px; 
}
.panel.flip .action {
  display: none;
}

.item-card .product-info {
    padding: 0;
    margin: 0;
    opacity: 0;
    left: 28%;
    text-align: center;
    position: absolute;
    bottom: -30px;
    z-index: 1;
    transition: all .5s ease 0s;
}
.box20{position:relative;overflow:hidden;}
.box20:after,.box20:before{position:absolute;content:""}
.box20:before{width:80%;height:220%;background:#ff402a;top:-50%;left:-100%;z-index:1;transform:rotate(25deg);transform-origin:center top 0;transition:all .5s ease 0s}
.box20:hover:before{left:10%}
.box20:after{width:55%;height:175%;background-color:rgba(0,0,0,.8);bottom:-1000%;left:53%;transform:rotate(-33deg);transform-origin:center bottom 0;transition:all .8s ease 0s}
.box20 .box-content,.box20 .icon{width:100%;padding:0 20px;position:absolute;left:0;z-index:2;transition:all 1.1s ease 0s}
.box20:hover:after{bottom:-70%}
.box20 img{width:100%;height:190px;}
.box20 .box-content{top:-100%;color:#fff}
.box20:hover .box-content{top:30px}
.box20 .title{font-size:24px;margin:0}
.box20 .icon li a,.box20 .post{display:inline-block;font-size:14px}
.box20 .post{margin-top:5px}
.box20 .icon{list-style:none;margin:0;bottom:-100%}
.box20:hover .icon{bottom:25px}
.box20 .icon li{display:inline-block}
.box20 .icon li a{width:35px;height:35px;line-height:35px;background:#444;border-radius:50%;margin:0 3px;color:#fff;text-align:center;transition:all .5s ease 0s}
.box20 .icon li a:hover{background:#fff;color:#ff402a}
@media only screen and (max-width:990px){.box20{margin-bottom:30px}
}
@media only screen and (max-width:479px){.box20 .title{font-size:20px}
}
.add-to-cart{
	position:relative;
}
.cart-quantity{
	    position: absolute !important;
    top: -5px;
    background-color: #272727 !important;
    line-height: 8px;
    width: 18px;
    border-radius: 10px;
    font-size: 10px;
	right:10px;
	
	
}
.minus-quantity{
	left:3px;
}
.
	</style>
   <div class="col-sm-12">

      <div  class="panel panel-default thumbnail">

         <div class="panel-heading no-print">

            <div class="btn-group"> 

               <a class="btn btn-success" href = "<?php echo base_url("buy"); ?>" ><i class="fa fa-plus"></i> Buy </a> 

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
				<div class = "col-md-9">
					<div class = "row">
						<div class = "col-md-12">
					<h2><?php echo $product->country_name; ?>
					<?php
						
					if(!empty($incart[$product->sb_id])) { 
						
						?><a href = "<?php echo base_url("buy/checkout"); ?>" class = "btn btn-success pull-right">Cart <span class = "badge badge-info cart-quantity"><?php echo $incart[$product->sb_id];  ?></span></a><?php
					}else{
						?><a href = "<?php echo base_url("buy/checkout"); ?>" class = "btn btn-danger pull-right"><i class = "fa fa-shopping-cart"></i>Add in cart</a><?php
					} ?>
					
					<a href = "<?php echo base_url("buy/checkout"); ?>" class = "btn btn-danger pull-right">Checkout</a></h2>
					<hr />
					<p>Price : <i class = "fa fa-rupee"></i> <?php echo $product->price; ?></p>
					<p><?php echo $product->details; ?></p>
					</div>
					</div>
					<div class = "row">
					
					
						<?php
						if(!empty($product->color)) { 
							?><div class = "col-md-6"><b>Color :</b><?php echo  $product->color; ?></div><?php
						}
						if(!empty($product->size)) { 
							?><div class = "col-md-6"><b>Size :</b><?php echo $product->size; ?></div><?php
						}
						if(!empty($product->weight)) { 
							?><div class = "col-md-6"><b>Size :</b><?php echo $product->weight; ?></div><?php
						}

						?>
						
					</div>
				</div>
				<div class = "col-md-3">
					<img src = "<?php echo base_url("assets/images/products/".$product->image) ?>" class = "img-responsive">
					
					
				</div>
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
	$(document).on("keyup", ".prod-quantity", function(){
		
		if($(this).val() > 0) {
			cartchange($(this), $(this).val());
		}
	});

	$(document).on("click", ".minus-quantity", function(){
		
		 cartchange($(this), -1);
		
	});
	
	function cartchange(currobj, qty){
		
		var crtobj = currobj.closest("li").find(".add-to-cart");
			$.ajax({
				url  	: "<?php echo base_url('buy/addtocart'); ?>",
				type 	: "post",
				data 	: {product:currobj.data("prodid"),qty : qty},
				success	: function(resp){
					var jresp = JSON.parse(resp);
					
					if(jresp.status == 1){
						
						currobj.closest("td").find(".form-control.prod-quantity").val(jresp.qty);
						currobj.closest("tr").find("td.subtotal").text(jresp.price);
						var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
						var htmcnt = '<li id = "cart-li-'+jresp.prodid+'"><div class="cart-items"><h4><a href="">'+jresp.product+' </a></h4>'+
										'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+jresp.qty+' = <i class="fa fa-rupee"></i> '+tprice+' </a>'+ 
										'</p></div></li>';
											$("#cart-nav-menu").prepend(htmcnt);
											$("#nav-cart-count").text(jresp.total);					
					}else if(jresp.status == 2){
						
						if(parseInt(jresp.qty)  > 0){
						currobj.closest("td").find(".form-control.prod-quantity").val(jresp.qty);
						currobj.closest("tr").find("td.subtotal").text(jresp.price);
						var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
						$("#cart-li-"+jresp.prodid).html('<div class="cart-items"><h4><a href="">'+jresp.product+' </a></h4>'+
										'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+jresp.qty+' = <i class="fa fa-rupee"></i> '+tprice+' </a>'+ 
										'</p></div>');
										
						}else{
						
							currobj.closest("tr").remove();
							$("#cart-li-"+jresp.prodid).remove();
							$("#nav-cart-count").text(jresp.total);
							currobj.remove();
						}
						
					
					}
						
							$(".total-price").text(jresp.subtotal);
					
				}
			});	
		
	}
	
	$(document).on("click", ".add-to-cart", function(){
		
		var currobj = $(this);
		var oldqty  = currobj.closest("td").find(".form-control.prod-quantity").val();
		oldqty      = parseInt(oldqty);
		
		$.ajax({
			url  	: "<?php echo base_url('buy/addtocart'); ?>",
			type 	: "post",
			data 	: {product:$(this).data("prodid"),qty:"1"},
			success	: function(resp){
				var jresp = JSON.parse(resp);
				
				if(jresp.status == 1){
					
					currobj.closest("td").find(".form-control.prod-quantity").val(jresp.qty);
					currobj.closest("tr").find("td.subtotal").text(jresp.price);
					//<span class="minus-quantity"> - </span>
				
					var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
					var htmcnt = '<li id = "cart-li-'+jresp.prodid+'"><div class="cart-items"><h4><a href="">'+jresp.product+' </a></h4>'+
									'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+jresp.qty+' = <i class="fa fa-rupee"></i> '+tprice+' </a>'+ 
									'</p></div></li>';
										$("#cart-nav-menu").prepend(htmcnt);
										$("#nav-cart-count").text(jresp.total);					
				}else if(jresp.status == 2){
				
					var tprice = parseInt(jresp.price) * parseInt(jresp.qty);
					currobj.closest("td").find(".form-control.prod-quantity").val(jresp.qty);
					currobj.closest("tr").find("td.subtotal").text(jresp.price);
					
					$("#cart-li-"+jresp.prodid).html('<div class="cart-items"><h4><a href="">'+jresp.product+' </a></h4>'+
									'<p><a href=""> Price : <i class="fa fa-rupee"></i> '+jresp.price+' X '+jresp.qty+' = <i class="fa fa-rupee"></i> '+tprice+' </a>'+ 
									'</p></div>');
					
				}
				var tprice = 0;
				console.log($("td.subtotal"));
				$("td.subtotal").each(function(){
					
					var tprice = tprice + parseInt($(this).text());	
					
				});	
				$(".total-price").text(jresp.subtotal);
			}
		});	
		
	});
</script>
<script>
	$(document).on("click",".remove-cart", function(){
		
		cartchange($(this), 0);
	});
</script>