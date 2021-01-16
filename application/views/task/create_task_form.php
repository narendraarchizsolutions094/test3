<form action="<?=base_url().'task/save_task'?>" class="form-inner" enctype="multipart/form-data" method="post">
    <input name='task_notification_id' type='hidden'/>
    <div class="">
        <div class="form-group col-sm-6">
            <label>Subject <i class="text-danger ">*</i></label>
            <input type="text" class="form-control" id='task_subject' name="subject" placeholder="Subject">
        </div>
        <div class="form-group col-sm-6">
            <label>Task Type <i class="text-danger ">*</i></label>
            <select class="form-control" name="task_type">
                <?php
                $task_type = array('1'=>'Task','2'=>'Follow Up','3'=>'Appointment');

                if(!empty($task_type)){
                    foreach($task_type as $key=>$value){
                        ?>
                        <option value="<?=$key?>"><?=$value?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label>Task Date <i class="text-danger">*</i></label>
            <input class="form-control form-date" type='text' name="task_date">
        </div>

        <div class="form-group col-sm-6">
            <label>Task Time<i class="text-danger">*</i></label>
            <input type="time" class="form-control" name="task_time">
        </div>
        <div class="form-group col-sm-6">
            <label>Related To<i class="text-danger">*</i></label>
            <select class="form-control" name="related_to" id='task_related_to'>
            <?php
                if(!empty($related_to)){
                    foreach($related_to as $key=>$value){
                        ?>
                        <option value="<?=$value->Enquery_id?>">
                            <?php
                            if($value->name){
                                echo $value->name_prefix.' '.$value->name.' '.$value->lastname;
                            }else{
                                if(empty($value->email)){
                                    echo $value->phone;
                                }else{
                                    echo $value->email;
                                }
                            }
                            ?>
                        </option>
                        <?php
                    }
                }
            ?>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label>Status<i class="text-danger">*</i></label>
            <select class="form-control" name="task_status">
            <?php
            if(!empty($taskstatus_list)){
                foreach($taskstatus_list as $key=>$value){
                    ?>
                    <option value="<?=$value->taskstatus_id?>">
                    <?=$value->taskstatus_name?>
                    </option>
                    <?php
                }
            }
            ?>
            </select>
        </div>
        <div class="form-group col-sm-12">
            <label>Description<i class="text-danger">*</i></label>
            <textarea id='task_description' rows="6" class="form-control" name="task_remark"
                placeholder='Start typing the details about the task...'></textarea>
        </div>
        <div class="form-group text-center">
            <input type="submit" name="create" class="btn btn-primary" value="Create">
        </div>
    </div>
</form>
<script>
    $('.form-date').datepicker({ dateFormat: 'yy-mm-dd' });
</script>