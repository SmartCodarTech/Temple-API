
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>



    <h1 class="text-capi lato-light text-center super3">Log Of Records Added For Students</h1>
    <div class="space4"></div>


<div class="space2"></div>



 <h3 class="text-capi lato-light text-center super3">Data Entry Log</h3>
 <div class="space3"></div>
<div class="col-lg-12 col-md-12 col-sm-12 bg-yellow animated fadeIn">
<div class="">

<h2 class=" lato-regular text-capi"></h2>
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="65%">Log
</th> 
<th width="20%">Course Name
</th> 

<th width="15%">Created At
</th> 

</tr> </thead> <tbody> 



<?php foreach ($logs as $log) {?>
<tr>

  <td><?php echo htmlentities(get_user_name_by_id($log->added_by).  " Added A Record For  " . get_user_name_by_id($log->student_id) );?></td>
  <td><?php echo htmlentities(get_course_name_by_id($log->course_id));?></td>
  <td><?php echo htmlentities(convert_time($log->created_at,2));?></td>
</tr>

<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>

<div class="space4"></div>

 


</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
