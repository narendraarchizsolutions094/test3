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

                    <a class="btn btn-success" href="<?php echo base_url("lead/add_course") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_course') ?> </a>  

                </div>

            </div>

            <div class="panel-body">

                <table id="example" class="table table-striped table-bordered" style="width:100%">

                <thead>

                <tr>

                    <th><?php echo display('serial') ?></th>

                    <th><?php echo display('course_name') ?></th>
					
					<th><?php echo display('course_image') ?></th>
					
					<th><?php echo display('course_rating') ?></th>
					
					<th><?php echo display('course_ielts') ?></th>
					
					<th><?php echo display('course_discription') ?></th>
					
					<th><?php echo display('program_level') ?></th>
					
					<th><?php echo display('program_length') ?></th>
					
					<th><?php echo display('program_discipline') ?></th>

                    <th><?php echo display('institute_name') ?></th>                          

                    <th><?php echo display('status') ?></th>

                    <th><?php echo display('action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if (!empty($course_list)) { 

                    $sl = 1;foreach ($course_list as $course) {?>

                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                            <td><?php echo $sl; ?></td>

                            <td width=""><?php foreach($courses as $cr){if($cr->id==$course->course_name){echo $cr->course_name;}}?></td>
							
							<td width=""><img src="<?php echo base_url($course->course_image); ?>" alt="<?php echo display('course_image') ?>" width="50" height="50"></td>
							
							<td width=""><?php echo $course->course_rating; ?></td>
							
							<td width=""><?php echo $course->course_ielts; ?></td>
							
							<td width="" class="more"><?php echo $course->course_discription; ?></td>
							
							<td><?php foreach($level as $lvl){if($lvl->id==$course->level_id){echo $lvl->level;}}?></td>
                            <td><?php foreach($length as $lg){if($lg->id==$course->length_id){echo $lg->length;}}?></td>
                            <td><?php foreach($discipline as $dc){if($dc->id==$course->discipline_id){echo $dc->discipline;}}?></td>

                            <td><?php echo $course->institute_name; ?></td>                               

                            <td><?php echo (($course->status==1)?display('active'):display('inactive')); ?></td>

                            <td class="center">

                                <a href="<?php echo base_url("lead/edit_course/$course->crs_id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 

                                <a href="<?php echo base_url("lead/delete_course/$course->crs_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 

                            </td>

                        </tr>

                        <?php $sl++; ?>

                    <?php } ?> 

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
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more...";
    var lesstext = "...Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>