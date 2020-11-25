<?php  foreach ($info as $key => $value) {?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div  class="panel panel-default thumbnail">

<div class="panel-body panel-form">

                  <div class="row ">

                       <div class="col-md-12">  <a class="btn btn-success" href="<?php echo base_url('enquiry/view/'.$value->enquiry_id.'') ?>"> <i class="fa fa-list"></i> Back</a> </div>
                      

                       <div class="col-lg-10 ">
                      <form class="form-inner" action="<?=  base_url('enquiry/insertCommercialInfo/') ?>" method="POST">
                  <input type="hidden" name="infoid" value="<?= $value->id ?>">
                  <input type="hidden" name="enquiry_id" value="<?= $value->enquiry_id ?>">
                    <!--------------------------------------------------start----------------------------->
                    <br>
                      <br>   
                    <div class="row">
                        <div class="col-sm-6">
                    <div class="form-group "> 
                       
                        <label>Info Type</label>
                        <select class="form-control" name="type" id="infotype">
                            <option value="1" <?php if($value->branch_type==1){echo'selected';} ?>>Branch</option>
                            <option value="2" <?php if($value->branch_type==2){echo'selected';} ?>>Zone</option>
                            <option value="3" <?php if($value->branch_type==3){echo'selected';} ?>>Areawise</option>
                        </select>
                     </div>
                     </div>
                    </div>
                     <center><h3>DISPTACH LOCATION</h3></center>
                     <br>
                     <div class="form-group col-sm-6"> 
                        <label>Booking Type</label>
                        <select class="form-control" name="booking_type" id="booking_type">
                            <option value="0" <?php if($value->booking_type==0){echo'selected';} ?>>Sundry</option>
                            <option value="1" <?php if($value->booking_type==1){echo'selected';} ?>>FTL</option>
                        </select>
                     </div>
                     <div class="form-group col-sm-6"> 
                        <label>Business Type</label>
                        <select class="form-control" name="business_type" id="business_type">
                            <option value="">-Select-</option>
                            <option value="0" <?php if($value->business_type==0){echo'selected';} ?>>Inward</option>
                            <option value="1" <?php if($value->business_type==1){echo'selected';} ?>>outward</option>
                        </select>
                     </div>
                        <div class="form-group col-sm-6"> 
                           <label id="textdisplay">Booking Branch</label>
                           <select class="form-control" name="booking_branch" id="booking_branch">
                              <option value="">-Select-</option>
                            <?php 
                            foreach($branch as $dbranch){ ?>
                                  <option value="<?= $dbranch->branch_id ?>" <?php if($value->booking_branch==$dbranch->branch_id){echo'selected';} ?>><?= $dbranch->branch_name ?></option>
                                 <?php }  ?>
                           </select>
                        </div>
                        <div class="form-group col-sm-6"> 
                           <label id="textdisplay2">Delivery Branch</label>
                           <select class="form-control" name="delivery_branch" id="delivery_branch" >
                              <?php  
                              foreach($branch as $dbranch){ ?>
                                  <option value="<?= $dbranch->branch_id ?>" <?php if($value->delivery_branch==$dbranch->branch_id){echo'selected';} ?>><?= $dbranch->branch_name ?></option>
                                 <?php }  ?>
                           </select>
                        </div>
                              <div class="form-group col-sm-6"> 
                                 <label>Insurance</label>
                                 <select class="form-control" name="insurance" id="insurance">
                                    <option value="0" <?php if($value->insurance==0){echo'selected';}?>>Carrier</option>
                                    <option value="1" <?php if($value->insurance==1){echo'selected';}?>>Owner risk</option>
                                 </select>
                              </div>
                              <div class="sundry" id="sundry"   <?php if($value->booking_type==1){ echo'style="display:none"'; }?>>
                              <div class="form-group col-sm-6"> 
                                 <label>Rate</label>
                                 <input class="form-control rate" name="rate" id="rate" type="text" value="<?= $value->rate ?>"  >  
                              </div>
                              <div class="form-group col-sm-6"> 
                                 <label>Discount</label>
                                 <input class="form-control" name="discount" id="discount" type="text" value="<?= $value->discount ?>" >  
                              </div>
                              <div class="form-group col-sm-6"> 
                              <label>Pay Mode</label>
                              <select class="form-control" name="paymode" id="paymode">
                                 <option value="1" <?php if($value->paymode==1){echo'selected';}?>>paid</option>
                                 <option value="2" <?php if($value->paymode==2){echo'selected';}?>>To-Pay</option>
                                 <option value="3" <?php if($value->paymode==3){echo'selected';}?>>Tbb</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-6"> 
                                 <label>Potential Tonnage</label>
                                 <input class="form-control" name="potential_tonnage" id="potential_tonnage" type="text"   value="<?= $value->potential_tonnage ?>">  
                              </div>
                              <div class="form-group col-sm-6"> 
                                 <label>Potential Amount</label>
                                 <input class="form-control" name="potential_amount" id="potential_amount" type="text"  value="<?= $value->potential_amount ?>">  
                              </div>
                              <div class="form-group col-sm-6"> 
                                 <label>Expected Tonnage</label>
                                 <input class="form-control" name="expected_tonnage" id="expected_tonnage" type="text" value="<?= $value->expected_tonnage ?>" >  
                              </div>
                              <div class="form-group col-sm-6"> 
                                 <label>Expected Amount</label>
                                 <input class="form-control" name="expected_amount" id="expected_amount" type="text" value="<?= $value->expected_amount ?>" >  
                              </div>


                              </div>
                              
                              <div class="ftl" id="ftl" <?php if($value->booking_type==0){ echo'style="display:none"'; } ?>>
                                 <div class="form-group col-sm-6"> 
                                    <label>Vehicle type</label>
                                    <input class="form-control" name="vehicle_type" id="Vehicle_type" type="text" value="<?= $value->rate ?>" >  
                                 </div>
                                 <div class="form-group col-sm-6"> 
                                    <label>Vehicle Carrying Capacity</label>
                                    <input class="form-control" name="capacity" id="capacity" type="text" value="<?= $value->rate ?>" >  
                                 </div>
                              
                                 <div class="form-group col-sm-6"> 
                                    <label>Invoice Value</label>
                                    <input class="form-control" name="invoice_value" id="invoice_value" type="text" value="<?= $value->rate ?>" >  
                                 </div>
                                 <div class="form-group col-sm-6"> 
                                    <label>Pay Mode</label>
                                    <select class="form-control" name="ftlpaymode" id="ftlpaymode">
                                       <option value="1" <?php if($value->paymode==1){echo'selected';}?>>paid</option>
                                       <option value="2" <?php if($value->paymode==1){echo'selected';}?>>To-Pay</option>
                                       <option value="3" <?php if($value->paymode==1){echo'selected';}?>>Tbb</option>
                                    </select>
                                </div>
                                 <div class="form-group col-sm-6"> 
                                    <label>Potential Amount</label>
                                    <input class="form-control" name="ftlpotential_amount" id="ftlpotential_amount" type="text" value="<?= $value->expected_tonnage ?>" >  
                                 </div>
                                 <div class="form-group col-sm-6"> 
                                    <label>Expected Amount</label>
                                    <input class="form-control" name="ftlexpected_amount" id="ftlexpected_amount" type="text" value="<?= $value->expected_amount ?>" >  
                                 </div>

                              </div>
        <div class="form-group row">
                              <div class="col-sm-offset-3 col-sm-6">
                                  <div class="ui buttons">
                                      <button type="reset" class="ui button">Reset</button>
                                      <div class="or"></div>
                                      <button class="ui positive button">Save</button>
                                  </div>
                              </div>
                          </div>

      </form>

              <?php } ?>         

              <script>

$('#delivery_branch').on('change', function() {
            var delivery_branch = $("select[name='delivery_branch']").val();
            var booking_branch = $("select[name='booking_branch']").val();
            alert(booking_branch);
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>enquiry/get_rate',
            data: {delivery_branch:delivery_branch,booking_branch:booking_branch},
            success:function(data){
                var obj = JSON.parse(data);
                $("#rate").val(obj.rate);
            }
            });
            });

$('#potential_tonnage').on('change', function() {
                var rate = document.getElementById('rate').value;           
                var potential_tonnage = document.getElementById('potential_tonnage').value;    
                var weightinKg= potential_tonnage*1000;       
               var total_ptAmount=weightinKg*rate;
               // alert(total_ptAmount);
                        $("#potential_amount").val(total_ptAmount);
                    });
                    $('#expected_tonnage').on('change', function() {
                var rate = document.getElementById('rate').value;           
                var expected_tonnage = document.getElementById('expected_tonnage').value;    
                var weightinKg= expected_tonnage*1000;       
               var total_extAmount=weightinKg*rate;
               // alert(total_ptAmount);
                        $("#expected_amount").val(total_extAmount);
                    });

$('#infotype').on('change', function() {
            var infotype = $("select[name='type']").val();
            if(infotype==1){
               $("#textdisplay").html('Booking Branch');
               $("#textdisplay2").html('Delivery Branch');
               alert('Branch')
            }else if(infotype==2){
               $("#textdisplay").html('Booking Zone');
               $("#textdisplay2").html('Delivery Zone');

            }else if(infotype==3){
               $("#textdisplay").html('Booking Area');
               $("#textdisplay2").html('Delivery Area');

            }else{
               $("#textdisplay").html('Booking Branch');
               $("#textdisplay2").html('Delivery Branch');

            }
});

               </script>
<script>
   $(document).ready(function(){
    $('#booking_type').on('change', function() {
      if ( this.value == '1')
      {
        $("#ftl").show();
        $("#sundry").hide();
      }  else {
        $("#sundry").show();
        $("#ftl").hide();
      }
    });
});
</script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>