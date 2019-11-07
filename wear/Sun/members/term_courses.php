
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities(get_program_name_by_id($id))?></h1>
    <p class="text-center lato-regular text-size-18">All Courses Being Offered In This Level</p>
    <div class="space4"></div>


<div class="space2"></div>



<div class="col-lg-12 col-md-12 col-sm-12 bg-yellow animated fadeIn">
<div class="">

<h2 class=" lato-regular text-capi"></h2>

<div class="tab-pane" id="datatable"> 
<section class="table-list"> 
<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">Name
</th>
<th width="5%">Level
</th>
<th width="15%">Academic Year
</th> 
<th width="10%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($courses as $course) { ?>
<tr>
<td>
<?php echo htmlentities(get_course_name_by_id($course->course_id));?>

</td>
  <td><?php echo htmlentities($course->level);?></td>
  <td><?php echo htmlentities($course->academic_year);?></td>
  <td>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>courses/deleteTermCourse/<?php echo htmlentities($course->id);?>">
  <i class="icon-trash icon-2x "  data-title="Delete Article" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>courses/setLecturer/<?php echo htmlentities($course->course_id);?>">
  <i class="icon-plus icon-2x black"  data-title="Add A Lecturer" data-placement="bottom" data-toggle="tooltip"></i></a>

    <a data-toggle="modal" class="btn  btn-sm "  href="#allLecs-<?php echo htmlentities($course->id);?>">
  <i class="icon-list icon-2x black"  data-title="Add A Lecturer" data-placement="bottom" data-toggle="tooltip"></i></a>
  </td>


</tr>


<!-- Modal  All courses-->
  <div class="modal fade" id="allLecs-<?php echo htmlentities($course->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">All Lecturers</h4>
        <div class="modal-body">
<?php  if(!empty($course->lecturers)){?>

<?php 
$files = explode(",",$course->lecturers);


foreach ($files as $file) {
   
   $name = get_user_name_by_id($file);
   echo "<h4 class=\"light lead\"><a href=\"".BASE_URL."media/courses\">" . $name ."". "&nbsp;&nbsp;".
   "<a class=\"btn  btn-sm\" href=\"".BASE_URL."courses/removeLecturer/". $file ."/".$course->course_id."\">
   <i class=\"icon-trash icon-2x\"   data-title=\"Remove Lecturer From Course\" data-placement=\"bottom\" data-toggle=\"tooltip\"></i></a></h4>";
  

 } 

?>


<?php }else{ ?>



<h4 class="light lead"> No Lecturer Assigned To Course Yet </h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div>
  </div>

<?php } ?>


</tbody> 
</table> 
</div> 
</section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
