
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">All registered Programs Offered</h1>
    <p class="text-center lato-regular text-size-18"> Manage Programs You Offer At Your School</p>
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
<th width="3%">End
</th>
<th width="10%">Certificate
</th>  
<th width="15%">Description
</th> 
<th width="15%">Remarks
</th> 
<th width="3%">Years
</th>
<th width="15%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($programs as $program) { ?>
<tr>
<td>
<?php echo htmlentities($program->name);?>

</td>
  <td><?php echo htmlentities($program->end_level);?></td>
  <td><?php echo htmlentities($program->certificate);?></td>
  <td><?php echo htmlentities($program->description);?></td>
  <td><?php echo htmlentities($program->remarks);?></td>
  <td><?php echo htmlentities($program->years);?></td>


  <td>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>programs/deleteprogram/<?php echo htmlentities($program->id);?>">
  <i class="icon-trash icon-2x "  data-title="Delete Article" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>programs/editProgram/<?php echo htmlentities($program->id);?>">
  <i class="icon-pencil icon-2x black"  data-title="Edit Article" data-placement="bottom" data-toggle="tooltip"></i></a>
    <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>programs/allCourses/<?php echo htmlentities($program->id);?>">
  <i class="icon-list icon-2x black"  data-title="All Courses In Program" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>courses/registeredTermCourses/<?php echo htmlentities($program->id);?>">
  <i class="icon-info-sign icon-2x black"  data-title="All Courses This Term" data-placement="bottom" data-toggle="tooltip"></i></a>
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
