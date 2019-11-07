
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3"> Courses</h1>
    <p class="text-center lato-regular text-size-18">Create And Manage Courses You Offer At Your School</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn">
<div class="col-lg-6 col-md-6 col-sm-12 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>courses/courseList">
    <img class="center img-responsive"  width="80px" src="<?php echo htmlentities($wear->get_image());?>books.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Check All Courses</h3>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>courses/registerTerm">
    <img class="center img-responsive"  width="80px" src="<?php echo htmlentities($wear->get_image());?>task.png"/>
    </a>

 </div>

  <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 "> Register Term Courses</h3>

</div>


<div class="space4"></div>
<div class="line-top"></div>
<div class="space4"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Course Count</h3>
  <div class="space1"></div>
 <h1 class="text-center text-capi lato-light  "><?php echo htmlentities(count(get_courses()));?></h1>
 <div class="space2"></div>
<div class="line-top"></div>
<div class="space4"></div>

</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Add A New Course</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>courses/addCourse/" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="name" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Credit Hours
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="credit_hours" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="level" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
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
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="program"  value="<?php echo htmlentities($program->id)?>"> <?php echo htmlentities($program->name)?></a></li> 
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
<input name="course_code" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Description
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="description" placeholder="" class="bg-focus form-control" data-required="true"> </textarea>

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Learning Objective
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="learning_objective" placeholder="" class="bg-focus form-control" data-required="true"> </textarea>

            </div>
</div> 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add Course</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInRight"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
