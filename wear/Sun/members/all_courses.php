
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">All registered Courses Offered</h1>
    <p class="text-center lato-regular text-size-18"> Manage courses You Offer At Your School</p>
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
<th width="15%">Course Code / Credit Hours
</th>  
<th width="15%">Description
</th> 
<th width="15%">Leraning Objective
</th> 
<th width="15%">Program
</th>
<th width="10%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($courses as $course) { ?>
<tr>
<td>
<?php echo htmlentities($course->name);?>

</td>
  <td><?php echo htmlentities($course->level);?></td>
  <td><?php echo htmlentities($course->course_code ." / " . "$course->credit_hours");?></td>
  <td><?php echo htmlentities($course->description);?></td>
  <td><?php echo htmlentities($course->learning_objective);?></td>
  <td><?php echo htmlentities(get_program_name_by_id($course->program));?></td>


  <td>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>courses/deleteCourse/<?php echo htmlentities($course->id);?>">
  <i class="icon-trash icon-2x "  data-title="Delete Article" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>courses/editCourse/<?php echo htmlentities($course->id);?>">
  <i class="icon-pencil icon-2x black"  data-title="Edit Article" data-placement="bottom" data-toggle="tooltip"></i></a>
  </td>


</tr>

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
