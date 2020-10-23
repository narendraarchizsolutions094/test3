<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <?php if(user_access(130)){ ?>
                    <div class="btn-group"> 

                        <a class="btn btn-success" href="<?php echo base_url("user/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_user') ?> </a>  

                    </div>
                <?php } ?>
                <div class="col-md-4 col-sm-8 col-xs-8 pull-right">  
          <div style="float: right;">     
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Actions">
                <i class="fa fa-sliders"></i>
              </a>  
            <div class="dropdown-menu dropdown_css" style="max-height: 400px;overflow: auto; margin-left: -131px;">
                <a  class="btn" id="saveButton" style="color:#000;cursor:pointer;border-radius: 2px;border-bottom :1px solid #fff;">Inactive Selected</a>
            </div>                                         
          </div>  
        </div>       
      </div>
            </div>

            <div class="panel-body">
                 <form id="inactive_all" method="POST" action="<?= base_url('user/inactive-all') ?>">   
                   
                <table class="datatable1 table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th><input type='checkbox' id="checkAll" value="check all" > <?php echo display('serial') ?></th>

                            <th>Emp Id</th>

                            <th><?php echo display('disolay_name') ?></th>

                            <th><?php echo display('user_function') ?></th>


                            <th>Email</th>

                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display("proccess"); ?></th>
                            <th>Start Billing Date</th> 
                            <th>Valid upto</th> 
                            <th>Last Login</th> 
                            <th><?php echo display("created_date"); ?></th>

                            <th><?php echo display('status') ?></th>

                           

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($departments)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($departments as $department) { 
                                if ($sl==1) {   echo' <input name="com_id" hidden value="'.$department->companey_id.'"> ';  }
                                ?>
                            

                              <tr  class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?><?php if($department->b_status==0){echo 'color:red';} ?>" style="cursor: pointer;">

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><input type="checkbox" value="<?= $department->pk_i_admin_id  ?>" id="checkitem" name="user_ids[]"> <?php echo $sl; ?></td>

                                     <td><a  href="<?php echo base_url("user/edit/$department->pk_i_admin_id") ?>"><?php echo $department->employee_id; ?></a></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_display_name;echo '&nbsp;';echo $department->last_name; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->user_role;   ?></td>

                                  

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_user_email; ?></td>

                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->s_phoneno; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>">
                                        <?php 
                                        $process_arr = explode(',', $department->process);
                                        $this->db->select('product_name');
                                        $this->db->where_in('sb_id',$process_arr);
                                        $p_res    =   $this->db->get('tbl_product')->result_array();                                        
                                        if (!empty($p_res)) {
                                            foreach ($p_res as $key => $value) {
                                                echo $value['product_name'].', '; 
                                            }   } ?>
                                        </td>
                                        <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo !empty($department->start_billing_date)?$department->start_billing_date:'NA'; ?></td>
                                        <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo $department->valid_upto ?></td>
                                        <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo !empty($department->last_log)?$department->last_log:'NA'; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo !empty($department->dt_create_date)?$department->dt_create_date:'NA'; ?></td>
                                    <td style="<?php if($department->b_status==0){echo 'color:red';} ?>"><?php echo (($department->b_status==1)?display('active'):display('inactive')); ?></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                 </form>
            </div>
        </div>
    </div>
</div>


<script> 
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$(document).ready(function(){
  $('#saveButton').click(function(){
    $("#inactive_all").submit(); //if requestNew is the id of your form
  });
});

</script>