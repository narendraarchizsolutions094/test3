<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
             <div class="panel-heading no-print">
                 <?php
                 if (user_access(300)) { ?>
                   
                <div class="btn-group"> 
                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#uploadbulk"> <i class="fa fa-plus"></i> Upload CSV </a>  
                </div>
                 <div class="btn-group"> 
                  
                     <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addinventory"> <i class="fa fa-plus"></i> Add Inventory </a>  
                </div>
                 <?php
                 }
                 ?>
            </div>
            <div class="panel-body">

                 <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>SKU ID</th>
                            <th>Batch No.</th>
                            <th>Serial No.</th>
                            <th>Product Name</th>
                            <th>Warehouse</th>
                            <th>Quantity</th>
                            <th>Brand</th>
                   <!--     <th><?php echo display('action') ?></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inventory_list)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($inventory_list as $inventorylist) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo ucwords($inventorylist->skuid); ?></td> 
                                    <td><?php echo $inventorylist->batchno; ?></td> 
                                    <td><?php echo $inventorylist->serialno; ?></td> 
                                    <td><?php echo ucwords($inventorylist->proname); ?></td>        
                                    <td><?php echo ucwords($inventorylist->wrname); ?></td>     
                                    <td><?php echo $inventorylist->qty; ?></td>
                                    <td><?php echo ucwords($inventorylist->brandname); ?></td>                        
                                    <!-- <td class="center">
                                        <a href="<?php echo base_url("lead/editproductcountry1/$inventorylist->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("lead/deleteproductcountry/$inventorylist->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td> -->
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->

              
            </div>
        </div>
    </div>
</div>

<div id="uploadbulk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
      <?php echo form_open_multipart('warehouse/upload_inventory','class="form-inner"  ') ?> 
    <div class="modal-content card">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title"></h4>
      </div>
      <div>
               <div class="form-group col-sm-12"> 
                <label>Upload Enquiry</label>
                <input type="file" name="imgfile" class="from-control" accept=".csv"> 
                </div>              
      </div>
      <div>
          <a href="<?php echo base_url('uploads/csv/') ?>Inventory.csv" type="submit" class="" style="width: 150px;height: 26px;font-size: 12px;">Download Sample</a>
      </div>
      <br>

      <div class="modal-footer">
          <button class="btn btn-success" type="submit" ><?php echo display('save'); ?></button>     
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close'); ?></button>
      </div>
    </div>
</form>
  </div>
</div> 

<div id="addinventory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
      <?php echo form_open_multipart('warehouse/add_inventory','class="form-inner"  ') ?> 
    <div class="modal-content card">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Add product in inventory</h4>
      </div>
      <div class="row">
               <div class="form-group col-sm-6"> 
                <label>Product Name</label>
                <select name="proname" class="form-control" required="" id="proname"> 
                  <option>Select</option>
                  <?php if(!empty($country)){ foreach($country as $cntry) { ?>
                    <option value="<?= $cntry->id?>"><?= ucwords($cntry->country_name); ?></option>
                  <?php }}?>
                  
                </select>
                </div>  
                <div class="form-group col-sm-6"> 
                <label>SKU ID</label>
                <select name="skuid" class="form-control" required="" id="skuid"> 
                </select>
                </div>           
      </div>
       <div class="row">
               <div class="form-group col-sm-6"> 
                <label>Serial No</label>
                <input type="text" name="serialno" class="form-control" required=""> 
                </div>  
                <div class="form-group col-sm-6"> 
                <label>Warehouse</label>
                <select name="warehouse" class="form-control" required=""> 
                  <option value="">Select</option>
                   <?php if(!empty($warehouse_list)){ foreach($warehouse_list as $warehouselist) { ?>
                    <option value="<?= $warehouselist->id?>"><?= ucwords($warehouselist->name); ?></option>
                  <?php }}?>
                  
                </select>
                </div>           
      </div>
      <div class="row">
               <div class="form-group col-sm-6"> 
                <label>Brand</label>
                <select name="brand" class="form-control" required="" id="brand"> 
                  <option value="">Select</option>
                   <?php if(!empty($brand_list)){ foreach($brand_list as $brandlist) { ?>
                    <option value="<?= $brandlist->id?>"><?= ucwords($brandlist->name); ?></option>
                  <?php }}?>
                </select>
                </div>  
                <div class="form-group col-sm-6"> 
                <label>Quantity</label>
                <input type="number" name="qty" class="form-control" required=""> 
                </div>           
      </div>
    
      <br>
      <div class="modal-footer">
         <button class="btn btn-success" type="submit" ><?php echo display('save'); ?></button> 
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close'); ?></button>
      </div>
    </div>
</form>
  </div>
</div>


<script>
  $('#proname').on('change',function(){

   var id = $(this).val();
    // select_brand(id);

    
    // alert(id)
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>warehouse/select_skuid',
      data: {id:id},      
      success:function(data){         
          var html='';
          var obj = JSON.parse(data);          
          html +='<option value="" style="display:none">---Select---</option>';
          for(var i=0; i <(obj.length); i++){              
              html +='<option value="'+(obj[i].skuid)+'">'+(obj[i].skuid)+'</option>';
          }          
          $("#skuid").html(html);
      }
      });
    



  });

  //  function select_brand(id){
  //   // alert(id)
  //   $.ajax({
  //     type: 'POST',
  //     url: '<?php echo base_url();?>warehouse/select_brand',
  //     data: {id:id},      
  //     success:function(data){         
  //         var html='';
  //         var obj = JSON.parse(data);          
  //         html +='<option value="" style="display:none">---Select---</option>';
  //         for(var i=0; i <(obj.length); i++){              
  //             html +='<option value="'+(obj[i].brand)+'">'+(obj[i].skuid)+'</option>';
  //         }          
  //         $("#skuid").html(html);
  //     }
  //     });
    



  // });
</script>