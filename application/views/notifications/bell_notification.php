    <ul class="nav nav-tabs nav-pills nav-justified">
      <li class="active"><a href="#bell_all" data-toggle="tab">All</a></li>
      <li><a href="#bell_read" data-toggle="tab">Read</a></li>
      <li><a href="#bell_unread" data-toggle="tab">Unread</a></li>
    </ul>    
    <!-- Tab panes -->
    <div class="tab-content bell-tab-content">
      <div class="tab-pane active" id="bell_all">        
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) { 
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              }
              if ($value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_unread(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Unread</a>";
              }else{
                $flag = "<a href='javascript:void(0)' onclick='noti_make_read(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Read</a>";                
              }
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                    <?=ucfirst($value['subject']).' '.$flag?>  <br><small><?=$value['task_remark']?></small><br><a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
            }
          }
        ?>
        <hr>        
      </div>
      <div class="tab-pane" id="bell_read">
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) {
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              } 
              if ($value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_unread(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Unread</a>";
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                    <?=ucfirst($value['subject']).' '.$flag?>  <br><small><?=$value['task_remark']?></small><br><a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
              }
            }
          }
        ?>
        <hr>      
      </div>
      <div class="tab-pane" id="bell_unread">
        <?php
          if (!empty($res)) {
            foreach ($res as $key => $value) { 
              if ($value['enq_status'] == 1) {
                $url  = base_url().'enquiry/view/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 2) {
                $url  = base_url().'lead/lead_details/'.$value['enquiry_id'];
              }else if($value['enq_status'] == 3) {
                $url  = base_url().'client/view/'.$value['enquiry_id'];
              }else{
                $url  = 'javascript:void(0)';
              }
              if (!$value['noti_read']) {
                $flag = "<a href='javascript:void(0)' onclick='noti_make_read(".$value["resp_id"].")' class='btn btn-default btn-sm pull-right'>Read</a>";
              ?>
              <li class="media">
                  <div style="float: left;margin-right:12px;">
                    <a href="#" class="btn btn-default"><i class="fa fa-bell"></i></a>
                  </div>
                  <div class="media-body" style="text-align: justify;">
                    <?=ucfirst($value['subject']).' '.$flag?>  <br><small><?=$value['task_remark']?></small><br><a href="<?=$url?>"><?=ucfirst($value['user_name'])?></a>
                    <div class="text-muted font-size-sm" style="float: right;"><?=$value['task_date'].' '.$value['task_time']?></div>
                </div>
              </li>
              <hr>
              <li>
              <?php
              }
            }
          }
        ?>
        <hr>
      </div>
    </div>
    <script type="text/javascript">
      function noti_make_unread(id){
         $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>notification/web/mark_as_unread", 
           data:{
            id:id
           },
           success: function(data){              
            count_bell_notification();            
            }
          });
      }

      function noti_make_read(id){
        $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>notification/web/mark_as_read", 
           data:{
            id:id
           },
           success: function(data){ 
              count_bell_notification();             
            }
          });
      }
    </script>
