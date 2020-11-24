<style>
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
a:hover, a:focus {
    text-decoration: none;
    outline: none;
    color: #37a000;
	font-weight:900;
}
</style>
<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddBranch" href="javascript:void(0)"> <i class="fa fa-upload"></i> Add Branch</a>  
                    

                </div>

            </div>

            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>S No.</th>
                    <th>Branch</th>
                    <th>Created At.</th>
                </tr>
                </thead>
                <tbody>
                <?php $sl=1; foreach ($branch_list as $branch) {?>
                        <tr >
                            <td><?php echo $sl; ?></td>
							<td width=""><?= $branch->branch_name?></td>
                            <td><?php echo (($branch->branch_status==0)?display('active'):display('inactive')); ?></td>
							<td width=""><?= $branch->created_at?></td>

                        </tr>

                        <?php $sl++; ?>

                    <?php } ?> 

                </tbody>

              </table>
            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->

        </div>

        <!-- /.col -->

      </div>

<!-- Course Upload  -->
<div class="modal fade" id="AddBranch" tabindex="-1" role="dialog" aria-labelledby="course_upload_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?=base_url().'setting/addbranch'?>" enctype="multipart/form-data" method='post'>
          <div class="modal-body">
                <div class="col-md-12">
                <label>Branch Name </label>
                <input type="text" name="branch" class="form-control">  
            </div> 
            <div class="col-md-12">
                <label>Status </label>
                <select class="form-control" name="status">
                    <option value="0">Active</option>
                    <option value="1">InActive</option>
                </select>
            </div>          
          </div>
          <div class="modal-footer" style="text-align: center;  center;border-top: 1px solid white;">                
          <br>
          <button type="submit" class="btn btn-secondary">Save</button>
          </div>
        </form>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
