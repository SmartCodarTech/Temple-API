
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">Results For Level/Term <?php echo htmlentities(get_course_name_by_id($course) ."/ " . get_course_code_by_id($course));?></h1>
    <p class="text-center lato-regular text-size-18">Records Of Students</p>
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
<th width="20%">Name / Level
</th> 
<th width="20%">Grade 
</th> 
<th width="20%">Score
</th> 

<th width="20%">Rewrite
</th> 

<th width="20%">Academic Year
</th> 
</tr> </thead> <tbody> 



<?php foreach ($results as $result) { ?>
<tr>

  <td><?php echo htmlentities($result->name ." / Level ". $result->level);?></td>
  <td><?php echo htmlentities($result->grade);?></td>
  <td><?php echo htmlentities($result->score);?></td>
  <td><?php echo htmlentities($result->rewrite);?></td>
  <td><?php echo htmlentities($result->academic_year);?></td>
</tr>

<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
