<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



<div class="row" style="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
  <div class="col-md-4 col-sm-4 col-xs-4"> 
          <a class="pull-left fa fa-arrow-left btn btn-circle btn-default btn-sm" onclick="history.back(-1)" title="Back"></a> 
          <?php
          if(user_access('1020'))
          {
          ?>
          <a class="dropdown-toggle btn btn-danger btn-circle btn-sm fa fa-plus" data-toggle="modal" data-target="#Save_Visit" title="Add Visit"></a> 
          <?php
          }
          ?>      

        </div>
</div>


<div class="row" style=" margin: 15px 0px; padding: 15px 0px;">
	<div class="col-lg-3">
        <div class="form-group">
          <label>From</label>
          <input type="date" class="v_filter form-control" name="v_from_date">
        <!--   <div class="pull-left">
            <div style="top: 0px;
                          margin-top: 0px;
                          float: left;
                          height: 51px;
                          line-height: 50px;
                          padding-right: 5px;" >
            <label>From</label>
            </div>
            <div style="height: 51px;
                        float: left;">
              <input type="date" class="v_filter" name="v_from_date" style="width: 145px"><br>
              <input type="time" class="v_filter" name="v_from_time" style="width: 145px;">
            </div>
          </div> -->
        </div>
    </div>

      <div class="col-lg-3">
        <div class="form-group">
          <label>To</label>
           <input type="date" class="v_filter form-control" name="v_to_date">
        </div>
      </div>

    <div class="col-lg-3">
        <div class="form-group">
        	<label>For</label>
        	<select class="v_filter form-control" name="enquiry_id">
        		<option value="">Select</option>
        		<?php
        		if(!empty($all_enquiry))
        		{
        			foreach ($all_enquiry as $row) 
        			{  
                $row  = (array)$row;
        				echo'<option value="'.$row['enquiry_id'].'">'.$row['name_prefix'].' '.$row['name'].' '.$row['lastname'].'</option>';
        			}
        		}
        		?>
        	</select>
        </div>
    </div>
     <div class="col-lg-3">
        <div class="form-group">
        	<label>Rating</label>
       	<select class="form-control v_filter" name="rating">
              <option value="">Select</option>
              <option value="1 star">1 star</option>
              <option value="2 star"> 2 star</option>
              <option value="3 star"> 3 star</option>
              <option value="4 star"> 4 star</option>
              <option value="5 star"> 5 star</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
          <!-- <div class="pull-right">
            <div style="top: 0px;
                          margin-top: 0px;
                          float: left;
                          height: 51px;
                          line-height: 50px;
                          padding-right: 5px;" >
            <label>To</label>
            </div>
            <div style="height: 51px;
                        float: left;">
              <input type="date" class="v_filter" name="v_to_date" style="width: 145px"><br>
              <input type="time" class="v_filter" name="v_to_time" style="width: 145px; display: none;">
            </div>
          </div> -->
        </div>
	</div>
	<div class="col-lg-12" >

				<table id="visit_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>Visit Date</th>
				          <th>Visit Time</th>
				          <th>Name</th>
				          <th>Distance Travelled</th>
				          <th>Travelled Type</th>
				          <th>Rating</th>
				          <th>Next Visit Date</th>
				          <th>Next Visit Location</th>
                  <th>Action</th>
				        </tr>
				      </thead>
				      <tbody>
		     		 </tbody>
    			</table>
	</div>
</div>

<script type="text/javascript">
var Data = {"from_data":"","to_date":"","from_time":"","to_time":""};

$(".v_filter").change(function(){
  // var obj = $(".v_filter:input").serializeArray();

  // Data["from_date"]= obj[0]["value"];
  // Data["to_date"] = obj[1]["value"];
  // Data["from_time"] = obj[2]["value"];
  // Data["to_time"] = obj[3]["value"];
 $("#visit_table").DataTable().ajax.reload(); 

});

$(document).ready(function(){

  $('#visit_table').DataTable({ 

          "processing": true,
          "scrollX": true,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'enquiry/visit_load_data'?>",
              "type": "POST",
              "data":function(d){
                      var obj = $(".v_filter:input").serializeArray();

                     
                     d.from_date = obj[0]['value'];
                     d.from_time = '';//obj[1]["value"];
                     d.enquiry_id =obj[2]["value"];
                     d.rating = obj[3]["value"];
                     d.to_date = obj[1]['value'];
                     d.to_time = '';//obj[5]['value'];
                     d.view_all=true;
                     console.log(JSON.stringify(d));
                    return d;
              }
          },
  });

});

$("select").select2();

$(document).delegate('.visit-delete', 'click', function() {    
        var vid =  $(this).data('id'); 
        var ecode =  $(this).data('ecode');    
        //alert(ecode);  
        if(confirm('Are you sure?')){      
           $.ajax({
           url:"<?=base_url('enquiry/delete_visit')?>",
           type:"post",
           data:{
              vid:vid,
              enq_code:ecode,
            },
           success:function(res)
           { 
              $("#visit_table").DataTable().ajax.reload(); 
              Swal.fire('Visit Deleted!', '', 'success');
           }
           });
        }
     });  
</script>  


<div id="Save_Visit" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Visits</h4>
         </div>
         <div class="modal-body">
            <div class="row" >

<form action="<?=base_url('enquiry/add_visit')?>" class="form-inner" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">

                <div class="form-group col-md-6">
                    <label>Company</label>
                    <select class="form-control" name="company" onchange="filter_related_to(this.value)">
                      <option value="-1">Select</option>
                      <?php
                      if(!empty($company_list))
                      {
                        foreach ($company_list as $key =>  $row)
                        {
                          echo '<option value="'.$key.'">'.$row->company.'</option>';
                        }
                      }
                      ?>
                    </select>
                </div>

               <div class="form-group col-md-6">
                  <label>Related To</label>
                  <select class="form-control" name="enquiry_id">
                    <option value="">Select</option>
                    <?php
                  if(!empty($all_enquiry))
                  {
                    foreach ($all_enquiry as $row)
                    {
                      echo'<option value="'.$row->enquiry_id.'">'.$row->name.'</option>';
                    }
                  }
                    ?>
                  </select>
               </div>

                <div class="form-group col-md-6 visit-date col-md-6">     
          <label>Visit Date</label>
          <input type="date" name="visit_date" class="form-control">
        </div>
    
        <div class="form-group col-md-6 visit-time col-md-6">     
         <label>Visit Time</label>
          <input type="time" name="visit_time" class="form-control">
        </div>
    
        <div class="form-group col-md-6 distance-travelled col-md-6">     
        <label>Distance Travelled</label>
           <input type="text" name="travelled" class="form-control">
        </div>
    
        <div class="form-group col-md-6 distance-travelled-type col-md-6">      
        <label>DISTANCE TRAVELLED TYPE</label>
           <input type="text" name="travelled_type" class="form-control">
        </div>
    
        <div class="form-group col-md-6 customer-rating col-md-6">      
        <label>Customer Rating</label>
          <select class="form-control" name="rating">
              <option value="">Select</option>
              <option value="1 star">1 star</option>
              <option value="2 star"> 2 star</option>
              <option value="3 star"> 3 star</option>
              <option value="4 star"> 4 star</option>
              <option value="5 star"> 5 star</option>
            </select>
        </div>
        
         
      <div class="col-md-12">
      <label style="color:#283593;">Next Visit Information<i class="text-danger"></i></label>
       <hr>
      </div>
        
          <div class="form-group col-md-6 next-visit-date col-md-6">      
            <label>Next Visit Date</label>
             <input type="date" name="next_visit_date" class="form-control">
          </div>
      
          <div class="form-group col-md-6 next-visit-location col-md-6">      
           <label>Next Visit Location</label>
             <input type="text" name="next_location" class="form-control">
          </div>

         <div class="row" id="save_button">
            <div class="col-md-12 text-center">
               <input type="submit" name="submit_only" class="btn btn-primary" value="Save">
            </div>
         </div>

</form>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>   
<script type="text/javascript">
  var LIST = <?php echo !empty($company_list)? json_encode($company_list): '{}'?>;
  var OLD_LIST  = <?=!empty($all_enquiry) ? json_encode($all_enquiry):'{}'?>;
  function filter_related_to(v)
  {
      if(Object.keys(LIST).length>0 && v!='-1')
      { 
        var l = '';
        var y = LIST[v];
        var ids = y.enq_ids.split(',');
        var names = y.enq_names.split(',');
        $(ids).each(function(k,id){
            l+="<option value='"+id+"'>"+names[k]+"</option>";
        });
        //alert(l);
        $("select[name=enquiry_id]").html(l);
      }
      else
      { var l = '';
          $(OLD_LIST).each(function(k,v){
            l+="<option value='"+v.enquiry_id+"'>"+v.name_prefix+" "+v.name+" "+v.lastname+"</option>";
          });
          $("select[name=enquiry_id]").html(l);
      }
  }
</script>