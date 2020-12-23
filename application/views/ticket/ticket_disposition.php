<script src="<?=base_url()?>/assets/summernote/summernote-bs4.min.js"></script>
<link href="<?=base_url()?>/assets/summernote/summernote-bs4.css" rel="stylesheet" />


<div class="row">   
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a>        
                <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" href="<?=base_url().'ticket/add'?>" title="New Ticket"></a>                       
            </div>
         </div>
         <div class="panel-body">
            <div class="col-md-3 col-height">          
              <h5 style="text-align:center"> 
                <br>
                <?php
                echo 'Ticket No - '.$ticket->ticketno;
                ?>
              <br>
            <?php
             if(!empty($ticket->client)){ ?>
               <a href="<?php if(!empty($enquiry->enquiry_id)){ echo base_url().'client/view/'.$enquiry->enquiry_id;}?>"><?php  (!empty($enquiry->name)) ? '<br>'.ucwords($enquiry->name_prefix." ".$enquiry->name." ".$enquiry->lastname).'<br>' : ""; ?></a>
              <?php 
              if(!empty($enquiry->gender))
              {
                if($enquiry->gender == 1) {
                 echo 'Male<br>'; 
                }else if($enquiry->gender == 2){
                  echo 'Female<br>';
                }else if($enquiry->gender == 3){
                  echo 'Other<br>';
                } 
              }
             } 
             
            
              $p = (!empty($ticket->phone)) ? $ticket->phone : '';
              if (user_access(450)) {
                $p = '##########';
              }
            ?>
            <a href='javascript:void(0)' onclick='send_parameters("<?php if(!empty($ticket->phone)) {echo $ticket->phone;} ?>")'><?php echo $p ?></a>
            <br><?php if(!empty($ticket->email)) { echo $ticket->email; }             
            ?>            
         </h5>
         <div class="row text-center">
              <a class="btn btn-primary btn-sm"  data-toggle="modal" type="button" title="Send SMS" data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('2','Send SMS')">
                <i class="fa fa-paper-plane-o"></i>
              </a>
              <a class="btn btn-info btn-sm"  data-toggle="modal" type="button" title="Send Email" data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('3','Send Email')">
                <i class="fa fa-envelope"></i>
              </a>
              <a class="btn btn-primary btn-sm"  data-toggle="modal" type="button" title="Send Whatsapp" data-target="#sendsms" data-toggle="modal"  onclick="getTemplates('1','Send Whatsapp')">
                <i class="fa fa-whatsapp"></i>
              </a>
         </div>
              <button class="btn btn-basic" type="button" style="width: 100%; margin-top: 5px;margin-bottom: 5px;">Disposition</button>
            
              <div id="disposition-section" class="mobile-hide">
                <div class="row" > 
                   <?php echo form_open_multipart('ticket/ticket_disposition/'.$ticket->id,array('id'=>'ticket_disposition_form','class'=>'form-inner')) ?>                     
                   <input type="hidden" name="client" value="<?php if(!empty($enquiry->enquiry_id)) { echo $enquiry->enquiry_id;}?>">
                   <input type="hidden" name="ticketno" value="<?=$ticket->ticketno?>">                   

                    <div class="form-group">                 
                      <select class="form-control" id="lead_stage_change" name="lead_stage" onchange="find_description()">
                        <option>---Select Stage---</option>
                        <?php
                          if(!empty($ticket_stages))
                          {
                            foreach($ticket_stages as $single)
                            {  
                              ?>                              
                              <option value="<?=$single->stg_id?>" <?=($single->stg_id==$ticket->ticket_stage?'selected':'')?>><?php echo $single->lead_stage_name; ?></option>
                              <?php 
                            }
                          }
                           ?>
                       </select>
                    </div>
                    <div class="form-group">                           
                       <select class="form-control" id="lead_description" name="lead_description">
                           <option value=''>---Select Description---</option>
                          <?php// foreach($all_description_lists as $discription){ ?>                                   
                               <!-- <option value="<?php// echo $discription->id; ?>"><?php //echo $discription->description; ?></option> -->
                               <?php //} ?>
                       </select>
                    </div>     

                    <div class="form-group">                           
                       <select class="form-control" id="" name="ticket_status">
                           <option>---Select Status---</option>
                          <?php
                           if(!empty($ticket_status))
                          {
                            foreach($ticket_status as $status)
                            {  
                              ?>                              
                              <option value="<?=$status->id?>" <?=($status->id==$ticket->ticket_status?'selected':'')?>><?php echo $status->status_name; ?></option>
                              <?php 
                            }
                          }?>
                       </select>
                    </div>     

                    <div class="form-group">
                       <input type="date" name="c_date" id='disposition_c_date' class="form-control" placeholder=""  >
                    </div>
                    <div class="form-group">
                        <input type="time" name="c_time" id='disposition_c_time' class="form-control" placeholder=""  >
                        <input type="hidden" name="dis_notification_id" >
                    </div>          
                    <div class="form-group">
                      <textarea class="form-control" name="conversation"></textarea>
                    </div>

                   <div class="sgnbtnmn form-group text-center">
                      <div class="sgnbtn">
                         <input id="ticket_disposition_save" type="button" value="Submit" class="btn btn-primary"  name="Submit">
                      </div>
                   </div>       
                   <?php echo form_close()?>
                </div>         
              </div>
            </div>
         

<script type="text/javascript">
  $("#lead_stage_change").on('change',function(){
    var v  = $(this).val();
    if(v == 2 && "<?=$this->session->companey_id?>" == 65){
      $("#lead_description").prop('required',true);
    }else{
      $("#lead_description").prop('required',false);
    }    
  });

  $("#ticket_disposition_save").on('click',function(e){
    e.preventDefault();
    var disposition = getSelectedText('lead_stage_change');
    var name = $("#ticket_holder").val();
    var time  =   $("#disposition_c_time").val();      
    var task_date =   $("#disposition_c_date").val();            
    var uid = "<?=$this->session->user_id?>"; 
    var msg = disposition+" : "+name;
    var ticketno = $("input[name=ticketno]").val();
    var response_id = writeUserData(uid,msg,ticketno,task_date,time);
    $("input[name=dis_notification_id]").val(response_id);
    //alert(name);
    if("<?=$this->session->companey_id?>" == 82 && "<?=!empty($this->session->call_parameters['phone'])?>"){
      var phone             =   "<?=$this->session->call_parameters['phone']?>";
      var campaignId        =   "<?=$this->session->call_parameters['campaignId']?>";
      var crtObjectId       =   "<?=$this->session->call_parameters['crtObjectId']?>";
      var userCrtObjectId   =   "<?=$this->session->call_parameters['userCrtObjectId']?>";
      var userId            =   "<?=$this->session->call_parameters['userId']?>";
      var customerId        =   "<?=$this->session->call_parameters['customerId']?>";
      var sessionId         =   "<?=$this->session->call_parameters['sessionId']?>";
      var disposition       =   $("#lead_stage_change option:selected").text();

      $.ajax({
        url:'https://emergems.ameyo.net:8443/dacx/dispose?phone='+phone+'&campaignId='+campaignId+'&crtObjectId='+crtObjectId+'&userCrtObjectId='+userCrtObjectId+'customerId='+customerId+'&dispositionCode='+disposition+'&sessionId='+sessionId,
        type:'get',
        success:function(q){                               
          console.log(q);
        }
      });
      
    }else{
      $("#ticket_disposition_form").submit();
    }
  });

  <?php
if(!empty($ticket->ticket_stage) && !empty($ticket->ticket_substage))
echo'$("select[name=lead_description]").load("'.base_url('message/find_substage/').$ticket->ticket_stage.'/'.$ticket->ticket_substage.'");';
?>
</script>
<?php
if($this->session->companey_id == 65){ ?>
  <script>
  if(<?=$ticket->complaint_type?>==2){
    $("#lead_stage_change").val('1');
    $("select[name='ticket_status']").val('3');
  }  
  </script>
<?php
}
?>