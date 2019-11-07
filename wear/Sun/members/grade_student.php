
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>
<?php $students = get_lecturers_students($id); ?>

 <h1 class="text-capi lato-light text-center super3">Grade <?php echo htmlentities($user->first_name . " ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18"><?php echo  htmlentities(get_course_name_by_id($course));?></p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-8 col-md-8 col-sm-8 animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Enter Student's Grade For This Term / Semister - <?php echo  htmlentities(get_course_name_by_id($course));?></h2>

<div class="line-top"></div>
    
<form action="<?php echo htmlentities(BASE_URL);?>lecturers/saveGrade/<?php echo htmlentities($id ."/".$term_course);?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Score
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="score" placeholder="Enter The Score Here eg. 65" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Grade
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="grade" placeholder="Enter The Letter For That Grade Here. eg. B" type="text"  class="bg-focus form-control" data-required="true"> 
<input name="course" value="<?php echo htmlentities($course);?>" type="hidden"  class="bg-focus form-control" data-required="true">
<input name="level" value="<?php echo htmlentities($level);?>" type="hidden"  class="bg-focus form-control" data-required="true">
            </div>
</div>  

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Grade</button> 
</div> 
</div> 
</form>

</div>

<div class="arrow-left-info"></div>

</div>

<div class="col-lg-4 col-md-4 col-sm-4 animated fadeIn">

<div class="col-lg-12 col-md-12 col-sm-12 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>lecturers/createRemark">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>ok.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Create Student Remark</h3>
</div>

<div class="space4"></div>


</div>




</div>

<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
