<?php
  define('FIRST_NAME',1);
  define('LAST_NAME',2);
  define('GENDER',3);
  define('MOBILE',4);
  define('EMAIL',5);
  define('COMPANY',6);
  define('LEAD_SOURCE',7);
  define('PRODUCT_FIELD',8);
  define('STATE_FIELD',9);
  define('CITY_FIELD',10);
  define('ADDRESS_FIELD',11);  
  define('REMARK_FIELD',12);  
  define('PREFERRED_COUNTRY_FIELD',13);  
  define('PIN_CODE',14); 
  define('SUB_SOURCE',15);  

                    if(!empty($company_list)){
                      foreach($company_list as $companylist){
                      if($companylist['field_id']==FIRST_NAME){?>
                    
                     <div class="form-group col-sm-4 col-md-4">
                        <label> <?php echo display("first_name"); ?> <i class="text-danger"></i> </label>
                        <div class = "input-group" >
                           <span class="input-group-addon" style="padding:0px!important;border:0px!important;width:30%;">
                              <select class="form-control" name="name_prefix">
                                 <?php foreach($name_prefix as $n_prefix){?>
                                 <option value="<?= $n_prefix->prefix ?>"><?= $n_prefix->prefix ?></option>
                                 <?php } ?>
                              </select>
                           </span>
                           <input class="form-control" name="enquirername" type="text" value="<?php  echo set_value('enquirername');?>" placeholder="Enter First Name" style="width:100%;"/>
                        </div>
                     </div>
                     <?php
                   }
                   ?>
                    <?php
                    if($companylist['field_id']==LAST_NAME){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display("last_name"); ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('lastname');?>" name="lastname" type="text" placeholder="Last Name">  
                     </div>
                     <?php
                   }
                   ?>
                   <?php
                    if($companylist['field_id']==GENDER){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display("gender"); ?><i class="text-danger"></i></label>
                         <select name="gender" class="form-control">
                           <option value="">---Select---</option>
                           <option value="1"><?php echo display("male"); ?></option>
                           <option value="2"><?php echo display("female"); ?></option>
                           <option value="3"><?php echo display("other"); ?></option>
                         </select>                           
                     </div>
                   
                  <?php
                   } 
                   ?>
                   <?php
                    if($companylist['field_id']==MOBILE){
                    ?>
                    
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                        <input class="form-control" value="<?php if(!empty($_GET['phone'])){echo $_GET['phone']; }else{ echo set_value('mobileno')?set_value('mobileno'):($this->input->get('phone')?$this->input->get('phone'):'');}?>" name="mobileno" type="text" maxlength='10' oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Mobile Number" required="">
                        <i class="fa fa-plus" onclick="add_more_phone('add_more_phone')" style="float:right;margin-top:-25px;margin-right:10px;color:red"></i>
                     </div>
                     <div id="add_more_phone">
                          <div class="form-group col-sm-4 col-md-4">
                             <label>Other No </label>
                             <input class="form-control"  name="other_no[]" type="text" placeholder="Other Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                          </div>                          
                       </div>
                     <?php
                   }
                   ?>
                     <?php
                    if($companylist['field_id']==EMAIL){
                    ?>
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?php echo display('email') ?> <i class="text-danger"></i> </label>
                        <input class="form-control" value="<?php  echo set_value('email');?> " name="email" type="email"  placeholder="Enter Email">  
                     </div>                     
                     <?php
                   }
                   ?>
                   <?php
                    if($companylist['field_id']==COMPANY){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('company_name') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('company');?> " name="company" type="text"  placeholder="Enter Company"> 
                     </div>
                   
                     <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==LEAD_SOURCE){
                    ?>      
                              
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('lead_source') ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="lead_source" id="lead_source" onchange="find_sub()">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach ($leadsource as $post){ ?>
                           <option value="<?= $post->lsid?>"><?= $post->lead_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                    <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==SUB_SOURCE){
                    ?>      
                              
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('sub_source') ?> <i class="text-danger"></i></label>
                        <select class="form-control" name="subsource" id="subsource">
                         
                        </select>
                     </div>
                    <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==PRODUCT_FIELD){
                    ?>                
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display("product"); ?></label>
                        <select class="form-control" name="sub_source" id="sub_source">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach ($product_contry as $subsource){ ?>
                           <option value="<?= $subsource->id?>"><?= $subsource->country_name?></option>
                           <?php } ?>
                        </select>
                     </div>
                      <?php
                   }                   
                    if($companylist['field_id']==ADDRESS_FIELD){
                    ?>                                     
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('address') ?> <i class="text-danger"></i></label>
                        <textarea class="form-control" name="address" placeholder="Enter Address"><?php  echo set_value('address');?></textarea> 
                     </div>
                   
                     <?php 
                   }                    
                    if($companylist['field_id']==STATE_FIELD){
                    ?>                
                     <div class="form-group col-sm-4 col-md-4">
                        <label> <?php echo display("state"); ?> <i class="text-danger"></i></label>
                        <select name="state_id" class="" id="fstate">
                           <option value="" style="display:none;">---Select---</option>
                           <?php foreach($state_list as $state){?>
                           <option value="<?php echo $state->id ?>"><?php echo $state->state; ?></option>
                           <?php } ?>
                        </select>
                     </div>                   
                       <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==CITY_FIELD){
                    ?>             
                                             
                      <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display("city"); ?> <i class="text-danger"></i></label>
                        <select name="city_id" class="" id="fcity">
                           <option value="" style="display:none;">---Select---</option>
                            <?php foreach ($city_list as $city){ ?>
                           <option value="<?= $city->id?>"><?= $city->city?></option>
                        <?php } ?>
                        </select>
                     </div>
                       <?php
                   }
                  if($companylist['field_id']==PIN_CODE){
                    ?>
                     <div class="form-group col-sm-4 col-md-4">
                        <label><?php echo display('pin_code') ?> <i class="text-danger"></i></label>
                        <input class="form-control" value="<?php  echo set_value('pin_code');?> " name="pin_code" type="text"  placeholder="Pin Code"> 
                     </div>
                   
                     <?php
                   }
                   
                   if($companylist['field_id']==REMARK_FIELD){
                    ?>                                     
                     <div class="form-group col-sm-4 col-md-4"> 
                        <label><?=display('remark')?></label>
                        <textarea class="form-control" name="enquiry"></textarea>
                     </div>
                     <?php 
                   }
                  }}
                   ?> 



<?php
  if ($this->session->companey_id==51) {
  ?>

<script type="text/javascript">
    function hide_all_dependent_field(){
      $(".service_related_issue_type").hide();                       
      $(".service_related_issue_sub_type").hide();                       
      $(".detail_of_issue").hide();                       
      $(".error_coming").hide();                       
      $(".dnd_sender_id").hide();                       
      $(".issue_date").hide();                       
      $(".promotional_sms_call_date_for_dnd").hide(); 

      $(".balace_deduction_issue_type").hide();            
      $(".balance_deduction_issue_sub_type").hide();            
      $(".amount_deducted").hide();            
      $(".date_of_deduction").hide();            
      $(".waiver_required").hide();            
      $(".blacklist_consent").hide(); 

      $(".recharge_issue_type").hide();
      $(".recharge_issue_sub_type").hide();
      $(".recharge_denomination").hide();
      $(".mode_of_recharge").hide();
      $(".date_of_recharge").hide(); 


      $(".network_issue_type").hide();
      $(".network_issue_sub_type").hide();
      $(".technology").hide();     

      $(".alt_number").hide();            
      $(".sim_service_issue_type").hide();            
      $(".sim_service_issue_sub_type").hide();            
      $(".date_of_simex").hide();            
      $(".vms_name").hide();     

      
      $(".self_help_issue_type").hide();            
      $(".self_help_issue_sub_type").hide();            
      $(".date_of_problem").hide();

      $(".other-issue-type").hide();
      $(".voc").hide();
    }

    function show_dependent_field(service){
      
      hide_all_dependent_field();

      if (service==103) {
        $(".network_issue_type").show();
        $(".network_issue_sub_type").show();
        $(".technology").show();


      }else if (service==104) {
        $(".recharge_issue_type").show();
        $(".recharge_issue_sub_type").show();
        $(".recharge_denomination").show();
        $(".mode_of_recharge").show();
        $(".date_of_recharge").show(); 

       
      }else if (service==105) {
        $(".balace_deduction_issue_type").show();            
        $(".balance_deduction_issue_sub_type").show();            
        $(".amount_deducted").show();            
        $(".date_of_deduction").show();            
        $(".waiver_required").show();            
        $(".blacklist_consent").show(); 
        
      }else if (service==106) {
        $(".alt_number").show();            
        $(".sim_service_issue_type").show();            
        $(".sim_service_issue_sub_type").show();            
        $(".date_of_simex").show();            
        $(".vms_name").show();   


      }else if (service==107) {
        $(".self_help_issue_type").show();            
        $(".self_help_issue_sub_type").show();            
        $(".date_of_problem").show(); 

      }else if (service==108) {
        $(".service_related_issue_type").show();                       
        $(".service_related_issue_sub_type").show();                       
        $(".detail_of_issue").show();                       
        $(".error_coming").show();                       
        $(".dnd_sender_id").show();                       
        $(".issue_date").show();                       
        $(".promotional_sms_call_date_for_dnd").show(); 
      }
      else if (service==110) {
        $(".other-issue-type").show();
        $(".voc").show();
      }

    }
      
  $("#sub_source").on('change',function(){
    var service  = $("#sub_source").val();
    show_dependent_field(service);
  });

</script>
<?php
}else if($this->session->companey_id == 29){ ?>
  <script type="text/javascript">
      function hide_all_dependent_field(){
        $(".desired-loan-amount").hide();
        $(".net-monthly-income").hide();
        $(".bank-name").hide();
        $(".personal-details").hide();
        

        $(".gross-annual-turnover").hide();
        $(".net-profit-after-tax").hide();
        
        $(".company-name").hide();
        $(".company-type").hide();
        $(".occupation-type").hide();
        $(".credit-card-name").hide();
        

        $(".profession").hide();
        $(".years-in-occupation").hide();
        $(".years-in-occupation").hide();
        $(".annual-income").hide();

      }

      function show_dependent_field(service){        
        hide_all_dependent_field();
        if (service == 83) {
          $(".desired-loan-amount").show();
          $(".net-monthly-income").show();
          $(".bank-name").show();
          $(".personal-details").show();
        
        }else if (service == 84) {
          $(".desired-loan-amount").show();          
          $(".gross-annual-turnover").show();
          $(".net-profit-after-tax").show();
          $(".company-name").show();
          $(".company-type").show();
          $(".bank-name").show();

        }else if (service == 111) {
          $(".occupation-type").show();
          $(".net-monthly-income").show();          
          $(".bank-name").show();
          $(".credit-card-name").show();

        }else if (service == 112) {
          $(".desired-loan-amount").show();          
          $(".profession").show();
          $(".years-in-occupation").show();
          $(".bank-name").show();   
          $(".annual-income").show();
        }        
      }
        
    $("#sub_source").on('change',function(){
      var service  = $("#sub_source").val();
      show_dependent_field(service);
    });  
  </script>
<?php
}
?>

<script>
  
  function find_sub(){

    // alert('dadad');

    var src_id = $('#lead_source').val();

    // alert(src_id);


        $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>lead/get_subsource_by_source',
        data: {src_id:src_id},

        success:function(data){
        
          $("#subsource").html(data);
        }    
    });
  }
</script>