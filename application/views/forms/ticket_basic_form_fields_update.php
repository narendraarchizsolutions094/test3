<?php
  define('COMPLAINT_TYPE',15);
  define('REFERRED_BY',16);
  define('PROBLEM_FOR',17);
  define('NAME',18);
  define('PHONE',19);
  define('EMAIL',20);
  define('PRODUCT',21);
  define('PROBLEM',22);
  define('NATURE_OF_COMPLAINT',23);
  define('PRIORITY',24);
  define('SOURCE',25);  
  define('ATTACHMENT',26);  
  define('DESCRIPTION',27);
  define('TRACKING_NUMBER',28);
  // define('PIN_CODE',14); 
  // define('SUB_SOURCE',15);  
echo'
 <div class="trackingDetails"></div>
<div class="col-md-6" style="display: none;">
      <div class="form-group">
        <label>Complain Date</label>
        <input type = "text" class="form-control add-date-picker" name = "complaindate" value= "<?php echo date("m/d/Y", strtotime($ticket->coml_date)) ?>">
      </div>
    </div>';


        if(!empty($company_list)){
          foreach($company_list as $companylist)
          {

                if($companylist['field_id']==COMPLAINT_TYPE){?>
                    
                  <input type="hidden" name="complaint_type" value="<?=$ticket->complaint_type?>">
                  <div class="form-group">
                  <label>Ticket Type : </label> 
                  <span class='badge badge-info'><?=$ticket->complaint_type=='1'?'Compaint':($ticket->complaint_type=='2'?'Query':'NA')?></span>
                </div>
                      
                     <?php
                   }
                   ?>
                    <?php
                    if($companylist['field_id']==REFERRED_BY){
                    ?>
                   

                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Referred By</label>
                      <select class="form-control add-select2 choose-client" name = "referred_by" required>
                        <?php 
                        if(!empty($referred_type))
                        {
                          foreach($referred_type as $ref)
                          {
                      echo "<option value =".$ref->id." ".($ref->id==$ticket->referred_by?'selected':'').">".$ref->name."</option>";

                          }
                        } 
                        ?>
                      </select>
                    </div>
                  </div>

                   <?php
                   }
                   ?>
                    <?php
                    if($companylist['field_id']==TRACKING_NUMBER){
                    ?>
                   
                   <script type="text/javascript">
                                        
                    function loadTracking(that)
                      { //alert(key);
                        if(that.value=='')
                        {

                        }else{
                          
                          $.ajax({
                            url:'<?=base_url('ticket/view_tracking')?>',
                            type:'post',
                            data:{trackingno:that.value},
                            beforeSend:function(){

                              $(that).parents('form').find('input,select,button').attr('disabled','disabled');
                            },
                            success:function(q)
                            { $(that).parents('form').find('input,select,button').removeAttr('disabled');
                              if(q!='0')
                                $(".trackingDetails").html(q);
                              else
                              {
                                Swal.fire({
                                            title: 'GC. No. Not Found!',
                                            cancelButtonText: 'Ok!'
                                            });
                              }
                            },
                            error:function(u,v,w)
                            {
                              console.info(w);
                            }
                          });
                        }
                      }

                      function match_previous(tracking_no)
                      { 
                        if(tracking_no=='')
                        {

                        }else{
                          
                          $.ajax({
                            url:'<?=base_url('ticket/view_previous_ticket')?>',
                            type:'post',
                            data:{tracking_no:tracking_no},
                            beforeSend:function(){

                              
                            },
                            success:function(q)
                            { 
                              if(q!='0')
                              {
                                $("#old_ticket").show(500);
                                $(".old_ticket_data").html(q);
                              }
                              
                              //  $(that).parents('form').find('input,select,button').removeAttr('disabled');
                              //$(".trackingDetails").html(q);
                            },
                            error:function(u,v,w)
                            {
                              console.info(w);
                            }
                          });
                        }
                      }


                  </script>
          
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tracking Number <i class="text-danger opt" style="display: none;">*</i></label>
                  <input type="text" name="tracking_no" class="form-control" onblur="loadTracking(this)" value="<?php if(!empty($ticket->tracking_no)){ echo $ticket->tracking_no;} ?>">
                </div>
              </div>
              <script type="text/javascript">

                $(document).ready(function(){
                  loadTracking($("input[name=tracking_no]").get(0));
                });
              </script>

              <?php if($ticket->complaint_type=='1'){
                  echo'<script type="text/javascript">
                  $(".opt").show();
                  $("input[name=tracking_no]").attr("required","required");
                  </script>';
                          }?>

                   <?php
                   }
                   ?>

                   <?php
                    if($companylist['field_id']==PROBLEM_FOR){
                    ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Problem For</label>
                        <select class="form-control add-select2 choose-client" name = "client" required readonly>
                          <?php 
                          if(!empty($problem_for))
                          {
                            foreach($problem_for as $ind => $clt)
                            {
                        echo "<option value =".$clt->enquiry_id." selected>".$clt->name."</option>";

                            }
                          } 
                          ?>
                        </select>
                      </div>
                    </div>
                   
                  <?php
                   } 
                   ?>
                   <?php
                    if($companylist['field_id']==NAME){
                    ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name<span class="text-danger">*</span></label> 
                        <input type="text" name="name" id="ticket_holder" class="form-control" value="<?php if(!empty($ticket->name)){ echo $ticket->name;} ?>" required>
                      </div>
                    </div>
                   
                     <?php
                   }
                   ?>
                     <?php
                    if($companylist['field_id']==PHONE){
                    ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone<span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" value="<?php  if(!empty($ticket->phone)){ echo $ticket->phone; } ?>" required>
                      </div>
                    </div>


                     <?php
                   }
                   ?>
                   <?php
                    if($companylist['field_id']==EMAIL){
                    ?>
                    
                   <div class="col-md-6">
                    <div class="form-group">
                      <label>Email<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" value="<?php if(!empty($ticket->tck_email)){ echo $ticket->tck_email;} ?>" required>
                    </div>
                  </div>
                   
                     <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==PRODUCT){
                    ?>      
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product</label>
                        <select name="product" class="form-control">
                        <?php
                        foreach ($product as $prd)
                        {
                          echo'<option value="'.$prd->id.'" '.($prd->id==$ticket->product?'selected':'').'>'.$prd->country_name.'</option>';
                        }
                        ?>
                        </select>
                        <!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->country_name)){ echo $ticket->country_name;} ?>" > -->
                      </div>
                    </div>

                    <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==PROBLEM){
                    ?>      
                   
                    <div class="col-md-6">
                        <div class="form-group">
                          <label><?=display('ticket_problem')?></label>
                          <select class="form-control add-select2" name = "relatedto">
                          <option value = "">Select Subject</option>
                        <?php  if(!empty($problem)) {
                              foreach($problem as $ind => $prblm){
                                ?><option value = "<?php echo $prblm->id ?>" <?=$prblm->id==$ticket->category? 'selected':''?>><?php echo ucfirst($prblm->subject_title) ?> </option><?php
                              } 
                            } ?>
                          </select>
                        </div>
                      </div>
                         
                   
                    <?php
                   }
                   ?>  
                    <?php
                    if($companylist['field_id']==NATURE_OF_COMPLAINT){
                    ?>                
                   
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Nature of Complaint</label>
                        <select class="form-control add-select2" name = "issue">
                        <option value = ""> -- Select --</option>
                        <?php  if(!empty($issues)) {
                            foreach($issues as $ind => $issue){
                              ?><option value = "<?php echo $issue->id ?>" <?php echo ($issue->id == $ticket->issue) ? "selected" : ""; ?> ><?php echo ucfirst($issue->title) ?> </option><?php
                            } 
                          } ?>
                        </select>
                      </div>
                    </div>
                     
                  <?php
                   }                   
                  if($companylist['field_id']==PRIORITY){
                    ?>                                     
                    
                    <?php if($this->session->user_right!=214){ ?>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Priority</label>
                      <select class="form-control add-select2" name = "priority">

                        <option value = "1" <?php echo (1 == $ticket->priority) ? "selected" : ""; ?>>Low</option>
                    
                        <option value = "2" <?php echo (2 == $ticket->priority) ? "selected" : ""; ?>>Medium</option>
                        <option value = "3" <?php echo (3 == $ticket->priority) ? "selected" : ""; ?>>High</option>
                      </select>
                    </div>
                  </div>
                   
                     <?php 
                      }
                   }                    
                    if($companylist['field_id']==SOURCE)
                    {

                      if($this->session->user_right!=214)
                      {
                    ?>                
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Source</label>
                        <select name="source" class="form-control">
                        <?php
                        foreach ($source as $sor)
                        {
                          echo'<option value="'.$sor->lsid.'" '.($sor->lsid==$ticket->sourse?'selected':'').'>'.$sor->lead_name.'</option>';
                        }
                        ?>
                        </select>
                        <!-- <input type="text" class="form-control" value="<?php if(!empty($ticket->ticket_source)){ echo ucwords($ticket->ticket_source);} ?>" > -->
                      </div>
                    </div>

                    <?php
                      }
                    }
                  if($companylist['field_id']==ATTACHMENT)
                  {
                   ?>

                   <div class="col-md-12">
      
                    <div class="form-group" >     
                      <label>Attachment <small> ( Only Image/PDF ) </small>:</label>
                      <?php
                      //$error="This file is not availible";
                      if($error =$this->session->flashdata('error'))
                      {
                        echo'<div class="alert alert-danger">'.$error.'</div>';
                      }
                      ?>
                      <?php
                      if($ticket->attachment)
                      {
                        $attachment  = json_decode($ticket->attachment);
                        echo'<ul class="list-group">';
                        $i=0;
                        if(!empty($attachment)){
                          foreach ($attachment as $at)
                          {
                            echo '<li class="list-group-item">'.$at.'
                            <div class="btn-group pull-right">
                            <a href="'.base_url('uploads/ticket/'.$at).'" target="_blank"><span class="btn btn-primary  btn-xs">View</span></a>
                            <a href="'.base_url('ticket/remove_attachment/'.$ticket->ticketno.'/'.$i).'"><span class="btn btn-danger  btn-xs">Delete</span></a>
                            </div>
                            </li>';
                            $i++;
                          }
                        }
                        echo'</ul><br>';
                      }
                      ?>
                      <input type="file" name="attachment[]" class="attachFiles" accept=".jpg,.jpeg,.png,.pdf" multiple>
                    </div>

                  </div>
                  <?php
                  }
                  if($companylist['field_id']==DESCRIPTION)
                  {
                  ?>

                  
              <div class="col-md-12">
                <label>Remark</label>
                <!-- <div style = "padding: 10px;border: 1px solid #e5e1e1;margin-right:25px;border-radius: 10px;font-size:16px;margin-bottom:10px;"><?php if(!empty($ticket->message)){ echo $ticket->message;} ?></div> -->
                <textarea name="remark" class="form-control"><?=$ticket->message?></textarea>
              </div>

                  <?php
                  }
           }
          }
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