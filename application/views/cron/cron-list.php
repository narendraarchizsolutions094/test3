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

                    <a class="btn btn-success btn-sm" href="<?php echo base_url("cron/add") ?>"> <i class="fa fa-plus"></i> Add Cron</a>  
                    

                </div>
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#course_upload" href="javascript:void(0)"> <i class="fa fa-upload"></i> <?php echo display('upload_course') ?></a>  
            

            </div>

            <div class="panel-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">

                <thead>

                <tr>

                </tr>

                </thead>

                <tbody>
<tr>
                        </tr>


                </tbody>

              </table>
             
            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->

        </div>

        <!-- /.col -->

      </div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
