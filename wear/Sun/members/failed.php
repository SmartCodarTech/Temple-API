
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $failed = get_failed_courses();?>

    <h1 class="text-capi lato-light text-center super3">All Failed Courses</h1>
    <p class="text-center lato-regular text-size-18"> Students Who Have Failed Courses </p>
    <div class="space4"></div>


<div class="space2"></div>



<div class="col-lg-12 col-md-12 col-sm-12 bg-yellow animated fadeIn">
<div class="">

<h2 class=" lato-regular text-capi"></h2>
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr>
<th width="20%">Name
</th> 
<th width=30%">Course /Course Code
</th> 
<th width="10%">Score / Grade 
</th> 
<th width="20%">Lecturer
</th>

<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 


   <?php if(!empty($failed)){?>
<?php foreach ($failed as $fail) { ?>
<tr>

  <td><?php echo htmlentities($fail->name);?></td>
  <td><?php echo htmlentities($fail->course . " / " . $fail->course_code);?></td>
  <td><?php echo htmlentities($fail->score . " / " . $fail->grade);?></td>
    <td><?php echo htmlentities($fail->lecturer);?></td>
  <td>

  <a class="btn  btn-sm "href="<?php echo htmlentities(BASE_URL);?>students/resitUpdate/<?php echo htmlentities($fail->id);?>"><i class="icon-pencil icon-2x" 
   data-title="Enter Resit Score" data-placement="bottom" data-toggle="tooltip"></i></a>


  </td>

</tr>

<?php }} ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
