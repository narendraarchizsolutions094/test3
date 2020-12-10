<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<div class="row" style=" margin: 15px 0px; padding: 15px 0px;">
	<div class="col-lg-3">
        <div class="form-group">
          <div class="pull-left">
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
              <input type="time" class="v_filter" name="v_from_time" style="width: 145px">
            </div>
          </div>
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
          <div class="pull-right">
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
              <input type="time" class="v_filter" name="v_to_time" style="width: 145px">
            </div>
          </div>
        </div>
	</div>
	<div class="col-lg-12">

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
                     d.from_time = obj[1]["value"];
                     d.enquiry_id =obj[2]["value"];
                     d.rating = obj[3]["value"];
                     d.to_date = obj[4]['value'];
                     d.to_time = obj[5]['value'];
                     d.view_all=true;
                     console.log(JSON.stringify(d));
                    return d;
              }
          },
  });

});

$("select").select2();
</script>  