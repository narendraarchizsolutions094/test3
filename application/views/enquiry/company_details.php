<div class="row" style="padding:15px;">
  <div class="col-lg-12">
   <ul class="nav nav-tabs" style="border-bottom: 1px solid #ddd;">
    <!--   <li class="nav-item active">
         <a class="nav-link" data-toggle="tab" href="#basic">Basic</a>
      </li> -->
      <li class="nav-item active">
         <a class="nav-link" data-toggle="tab" href="#deals">Deals 
           <!--  <label class="custom_badge">8</label> -->
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#visits">Visits</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#contacts">Contacts</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#accounts">Accounts</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="tab" href="#tickets">Tickets</a>
      </li>
   </ul>

  <!-- Tab panes -->
  <div class="tab-content">

      <!-- <div id="basic" class="container tab-pane"><br>
         
      </div> -->

      <div id="deals" class="container tab-pane active"><br>
        <table id="deals_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">
             <thead class="thead-light">
               <tr>                              
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Branch Type</th>
                  <th>Business Type</th>
                  <th>Booking Type</th>
                  <th>Booking Branch</th>
                  <th>Delivery Branch</th>
                  <th>Rate</th>
                  <th>Discount</th>
                  <th>Insurance</th>
                  <th>Paymode</th>
                  <th>Potential Tonnage</th>
                  <th>Potential Amount</th>
                  <th>Expected  Tonnage</th>
                  <th>Expected  Amount</th>
                  <th>Vehicle Type</th>
                  <th>Vehicle Carrying Capacity</th>
                  <th>Invoice Value</th>
                  <th>Create Date</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
              <tbody>
             </tbody>
          </table>
      </div>

      <div id="visits" class="container tab-pane fade"><br>
        <table id="visit_table" class="table table-bordered table-hover " >
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

      <div id="contacts" class="container tab-pane fade"><br>
        <table id="contactTable" class="datatable1 table table-bordered table-response">
          <thead>
                               
                 <tr>
                            <th>&nbsp; # &nbsp;</th>
                            <th><?=display('enquiry')?></th>
                            <th style="width: 20%;">Company</th>
                            <th style="width: 20%;">Designation</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 20%;">Contact Number</th>
                            <th style="width: 20%;">Email ID</th>
                            <th style="width: 20%;">Other Detail</th>
                            <th style="width: 20%;">Created At</th>
                            <th>Action</th>
                 </tr>
          </thead>
          <tbody>
            <?php
              if(!empty($contact_list))
              {$i=1;
                foreach ($contact_list->result_array() as $row)
                {
                  echo'<tr>
                      <td>'.$i++.'. </td>
                      <td><a href="'.base_url('enquiry/view/').$row['enquiry_id'].'">'.$row['enq_name'].'</a></td>
                      <td>'.$row['company'].'</td>
                      <td>'.$row['designation'].'</td>
                      <td>'.$row['c_name'].'</td>
                      <td>'.$row['contact_number'].'</td>
                      <td>'.$row['emailid'].'</td>
                      <td>'.$row['other_detail'].'</td>
                      <td>'.$row['created_at'].'</td>
                      <td style="width:50px;">
                      <div class="btn-group">';
                      if(user_access('1012'))
                      {
                        echo'<button class="btn btn-warning btn-xs" data-cc-id="'.$row['cc_id'].'" onclick="edit_contact(this)">
                          <i class="fa fa-edit"></i>
                        </button>';
                      }
                      if(user_access('1011'))
                      {
                        echo'<button class="btn btn-danger btn-xs"  data-cc-id="'.$row['cc_id'].'" onclick="deleteContact(this)">
                          <i class="fa fa-trash"></i>
                        </button>';
                      }

                     echo' </div>
                     </td>
                  </tr>';
                }
              }
            ?>
          </tbody>
        </table>
      </div>
      <div id="accounts" class="container tab-pane fade"><br>
          <table id="enq_table" class="table table-bordered table-hover mobile-optimised" style="width:100%;">

          </table>
      </div>

      <div id="tickets" class="container tab-pane fade"><br>
         <h3>Menu 2</h3>
         <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>

  </div>
</div>
</div>
<style type="text/css">
.custom_badge
{
   font-size: 11px;
   background: #ff0101;
   padding: 2px 6px;
   border-radius: 50%;
   color: white;
   top:-2px;
}
.nav-tabs .active a
{
   background: #283593!important;
   color:white!important;
}
.tab-pane{
  max-width: 100%;
}
table th
{
  width: auto!important;
}
</style>


<script type="text/javascript">
$(document).ready(function(){

var specific_list = "<?=!empty($specific_deals)?$specific_deals:''?>";

  $('#deals_table').DataTable({ 

          "processing": true,
          "scrollX": true,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'enquiry/deals_load_data'?>",
              "type": "POST",
              "data":function(d){
                     //  var obj = $(".v_filter:input").serializeArray();

                     d.top_filter = $("input[name=top_filter]:checked").val();
                     d.date_from = $("input[name=d_from_date]").val();
                     d.date_to = $("input[name=d_to_date]").val();
                     d.enq_for = $("select[name=d_enquiry_id]").val();
                     // d.from_date = obj[0]['value'];
                     // d.from_time = '';//obj[1]["value"];
                     // d.enquiry_id =obj[2]["value"];
                     // d.rating = obj[3]["value"];
                     // d.to_date = obj[1]['value'];
                     // d.to_time = '';//obj[5]['value'];
                     d.view_all=true;
                     d.specific_list = specific_list;
                     TempData = d;
                     console.log(JSON.stringify(d));
                    return d;
              }
          },
          "drawCallback":function(settings ){
            //  update_top_filter();
          },
          columnDefs: [
                       { orderable: false, targets: -1 }
                    ]
  });


var specific_list = "<?=!empty($specific_visits)?$specific_visits:''?>";
$('#visit_table').DataTable({ 

          "processing": true,
          "scrollX": true,
          "serverSide": true,          
          "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
          "ajax": {
              "url": "<?=base_url().'enquiry/visit_load_data'?>",
              "type": "POST",
              "data":function(d){
                     //  var obj = $(".v_filter:input").serializeArray();

                     
                     // d.from_date = obj[0]['value'];
                     // d.from_time = '';//obj[1]["value"];
                     // d.enquiry_id =obj[2]["value"];
                     // d.rating = obj[3]["value"];
                     // d.to_date = obj[1]['value'];
                     // d.to_time = '';//obj[5]['value'];
                    d.view_all=true;
                    d.specific_list = specific_list;
                     console.log(JSON.stringify(d));
                    return d;
              }
          },
});

// try{
// $('#enq_table').DataTable(
//         {         
//           "processing": true,
//           "scrollX": true,
//           // "scrollY": 520,
//           // "pagingType": "simple",
//           // "bInfo": false,
//           "serverSide": true,          
//           "lengthMenu": [ [10,30, 50,100,500,1000, -1], [10,30, 50,100,500,1000, "All"] ],
//           "ajax": {
//               "url": "<?=base_url().'Enq/enq_load_data'?>",
//               "type": "POST",
//               "data":function(d){
//                 d.data_type = 1;               
//                 return d;
//               }
//           },
//           "columnDefs": [{ "orderable": false, "targets":0 }],
//            "order": [[ 1, "desc" ]],
//       });
// }catch(e){alert(e);}
});
</script>