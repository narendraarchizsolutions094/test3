<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("feedback/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('feedback/create') ?> </a>                      
                </div>
            </div> 

            <div class="panel-body">
                <table id="enq_table2" class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>G C Number</th>
                            <th>Vehicle Number</th>
                            <th>Type</th>
                            <th>cso</th>
                            <th>Name</th>
                            <th>Feedback</th>
                            <th>Feedback On</th>
                            <th>Assigned To</th> 
                            <th><?php echo display('action') ?></th> 
                              </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
<script>
      $(document).ready(function() {
    $('#enq_table2').DataTable( {
        "ajax": "<?=base_url().'dashboard/loadFeedback'?>",
        "columns": [
            { "data": "gc" },
            { "data": "vc" },
            { "data": "type" },
            { "data": "cso" },
            { "data": "name" },
            { "data": "feedback" },
            { "data": "feedback_on" },
            { "data": "username" },
            { "data": "actions" },
        ]
    } );
} );
</script>