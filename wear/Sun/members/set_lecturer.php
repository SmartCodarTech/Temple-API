
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">Add Lecturer To Term Course</h1>
    <p class="text-center lato-regular text-size-18">Course Name - <?php echo htmlentities(get_course_name_by_id($course_id));?> </p>
    <div class="space4"></div>


<div class="space2"></div>


<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 bg-light-blue animated fadeIn">
<div class="padding3">

    <form action="<?php echo htmlentities(BASE_URL);?>courses/addLecturer/<?php echo htmlentities($course_id)?>" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light white">Select A Lecturer
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Lecturer For This Course
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($lecturers as $lecturer){?>
<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="lecturer" value="<?php echo htmlentities($lecturer->id)?>"> <?php echo htmlentities($lecturer->first_name . " " . $lecturer->last_name);?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit"> Set Lecturer</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
