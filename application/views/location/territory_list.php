<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                <?php if (user_access(111)==true) {   ?>
                    <a class="btn btn-success" href="<?php echo base_url("location/add_territory") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_teretory') ?> </a>  
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body">
                <table class="add-data-table table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                             <th><?php echo display('territory_name') ?></th>
                              <th><?php echo display('region_name') ?></th>
                            <th><?php echo display('country_name') ?></th>
                            
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($country)) { ?>
                            <?php $sl = 1; ?>
                            <?php
                            foreach ($country as $department) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $department->territory_name; ?></td>
                                      <td><?php echo $department->region_name; ?></td>
                                    <td><?php echo $department->country_name; ?></td>
                                 
                                    <td><?php echo (($department->tstatus==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                    <?php if (user_access(112)==true) {  ?>
                                        <a href="<?php echo base_url("location/edit_territory/$department->territory_id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                    <?php } if (user_access(114)==true) {  ?>
                                        <a href="<?php echo base_url("location/delete_territory/$department->territory_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
