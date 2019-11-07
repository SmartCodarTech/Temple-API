
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">Results For Level/Term <?php echo htmlentities($level);?></h1>
    <p class="text-center lato-regular text-size-18"> You can Print Your results</p>
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
<th width="20%">Course Name /Course Code
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

  <td><?php echo htmlentities($result->course ." / ". $result->course_code);?></td>
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
