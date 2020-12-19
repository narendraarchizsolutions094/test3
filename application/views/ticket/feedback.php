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
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                            <th>G C Number</th>
                            <th>Current Status</th>
                            <th>Delivery Branch</th>
                            <th>Vehicle Number</th>
                            <th>Customer Feedback</th>
                            <th>Created Date</th> 
                            <th>Consignor</th>
                            <th><?php echo display('action') ?></th> 
                            
                          
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($feedbacks)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($feedbacks as $feedback) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td style="width:20px;"><?php echo $sl; ?></td>
                                    <td><img src="<?php echo base_url($doctor->pictures); ?>" alt="" width="65" height="50"/></td>
                                    <td><?php echo $doctor->firstname; ?></td>
                                    <td><?php echo $doctor->lastname; ?></td>
                                    <td><?php echo $doctor->email; ?></td>
                                    <td><?php echo $doctor->mobile; ?></td>
                                    <td>
                                        <?php 
                                            $this->db->where('companey_id',$doctor->user_id);                                            
                                            echo $this->db->get('tbl_admin')->num_rows(); 
                                        ?>                                                
                                    </td>
                                    <td><?php 
                                    if ($doctor->status) {
                                        echo "Active";
                                    }else{
                                        echo "Inactive";                                        
                                    } ?>
                                    </td>
                                    <td><?= $doctor->create_date ?></td>
                                    <td><?= date('Y-m-d',strtotime($doctor->valid_upto)) ?></td>
                                   
                                   
                                    <td>
                                        <div class="action-btn">
                                        <a href="<?php echo base_url("feetback/edit/$feedback->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("customer/logged-in-as-user/$feedback->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-sign-in"></i></a> 
                                       <a href="<?php echo base_url("customer/delete/$feedback->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?> ')"><i class="fa fa-trash"></i></a>
                                        </div> 
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
