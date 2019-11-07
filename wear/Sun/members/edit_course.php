
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($course->name)?></h1>
    <p class="text-center lato-regular text-size-18">Change Course Details </p>
    <div class="space4"></div>


<div class="space2"></div>


<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Edit Course</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>courses/saveCourse/<?php echo htmlentities($course->id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="name" value="<?php echo htmlentities($course->name)?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Credit Hours
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="credit_hours" value="<?php echo htmlentities($course->credit_hours)?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="level" value="<?php echo htmlentities($course->level)?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Program
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Program This Course Belongs To
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($programs as $program){?>
<li <?php if($course->program == $program->id){?> class="active" <?php }?> ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="program"  <?php if($course->program == $program->id){?> checked="checked" <?php }?> value="<?php echo htmlentities($program->id)?>"> <?php echo htmlentities($program->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Course Code
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="course_code" value="<?php echo htmlentities($course->course_code)?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Description
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="description" placeholder="" class="bg-focus form-control" data-required="true"> <?php echo htmlentities($course->description)?></textarea>

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Learning Objective
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="learning_objective" placeholder="" class="bg-focus form-control" data-required="true"> <?php echo htmlentities($course->learning_objective)?></textarea>

            </div>
</div> 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
