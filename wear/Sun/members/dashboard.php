
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>

<?php if(get_user_level($session->user_id) == "Top Manager" || get_user_level($session->user_id) == "Developer"){?>
    <h1 class="text-capi lato-light text-center super3">Welcome To The Dashboard</h1>
    <p class="text-center lato-regular text-size-18">what do you want to do today</p>
    <div class="space4"></div>


<div class="space2"></div>



<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>lecturers">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>students.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Lecturers</h3>
</div>


<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>users/allUsers">
    <img class="center img-responsive"  width="80px" height="80px" src="<?php echo htmlentities($wear->get_image());?>task.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Editors / Mangers</h3>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>messages/externalMessages">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>messages.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Messages</h3>
</div>



<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>messages/userSupport">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>chat.png"/>
    </a>

 </div>
   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Support</h3>
</div>

<div class="space4"></div>

<div class="space2"></div>

<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>students">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>contacts.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Student Details</h3>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."users/manage/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>access.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Manage Access</h3>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL ."programs/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>explorer.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Programs</h3>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."schools/settings/" .$user->school_id);?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>settings.png"/>
    </a>

 </div>
   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">settings</h3>

</div>

<div class="space4"></div>

<div class="space2"></div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."courses/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>books.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Courses</h3>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."students/recordLogs");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>computer.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Data Entry Records</h3>
</div>

<div class="space4"></div>




</div>

<?php }elseif(get_user_level($session->user_id) =="Editor"){?>


<div class="space2"></div>



<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>lecturers">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>students.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Lecturers</h3>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>messages/externalMessages">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>messages.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Messages</h3>
</div>



<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>messages/userSupport">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>chat.png"/>
    </a>

 </div>
   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Support</h3>
</div>



<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL);?>students">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>contacts.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Student Details</h3>
</div>

<div class="space4"></div>

<div class="space2"></div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL ."programs/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>explorer.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Programs</h3>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab  round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."courses/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>books.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Courses</h3>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."users/manage/");?>">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>access.png"/>
    </a>

 </div>

   <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Add Sudents</h3>
</div>

<div class="space4"></div>




</div>


<?php }elseif(get_user_level($session->user_id) =="Lecturer"){?>
<?php $lecs_courses = get_lecturers_courses($session->user_id); ?>

 <h1 class="text-capi lato-light text-center super3">Welcome <?php echo htmlentities($user->first_name . " ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">what do you want to do today</p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 bg-white animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Courses Teaching This Term / Semister</h2>

<div class="line-top"></div>
    
    <?php if(!empty($lecs_courses)){?>
    <?php foreach($lecs_courses as $les){ $lec_c = get_course_by_id($les->course_id)?>
    <div class="space2"></div>
<h3 class="lato-light text-capi"><?php echo htmlentities($lec_c->name);?>  &nbsp; - <?php echo htmlentities($lec_c->course_code);?> &nbsp; - 
<?php echo htmlentities($lec_c->credit_hours)?> Credit Hours &nbsp; - Level <?php echo htmlentities($lec_c->level);?> &nbsp; - &nbsp;
 <span class="padding05 line"><?php echo htmlentities(get_program_name_by_id($lec_c->program));?></span>  &nbsp; <br/> 
 <br/> 
 <a class="btn btn-md btn-info lato-light" href="<?php echo htmlentities(BASE_URL);?>lecturers/studentsInCourse/<?php echo htmlentities($les->id."/" .$les->course_id);?>">View Students</a>
<a href="<?php echo htmlentities(BASE_URL);?>lecturers/viewCourseResults/<?php echo htmlentities($les->course_id);?>" 
class="btn btn-md btn-danger lato-light">View Results For Course</a
 <br/>

 </h3>
 <div class="space1"></div>
 <div class="line-top"></div>
 <?php } }else{?>


<h1 class="lato-light text-center tect-capi"> No Courses Assigned To You Yet</h1>

 <?php } ?>

</div>


</div>





</div>



<?php }elseif(get_user_level($session->user_id) =="Student"){?>
<?php $lecs_courses = get_students_courses($session->user_id); ?>


 <h1 class="text-capi lato-light text-center super3">Welcome <?php echo htmlentities($user->first_name . " ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Use The Learning Tool To Learn How To Use THe Site</p>
    <br/>
    <p class="text-center"> <span class="bg-yellow white padding1"><?php echo htmlentities(get_program_name_by_id(get_program_by_user_id($user->id)));?></span></p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 bg-white animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Courses For This Term / Semister - Register For Courses If You haven't </h2>

 <?php if(get_registration_mode() == "Allow") {?>
 

<h3 class="lato-light text-left text-capi"> Registration Is Opened</h3>

   <?php }else{?>

<h3 class="lato-light text-left text-capi"> Registration Is Closed</h3>
   <?php }?>
<div class="space2"></div>
<div class="line-top"></div>

    
    <?php if(!empty($lecs_courses)){?>
    <?php foreach($lecs_courses as $les){ $lec_c = get_course_by_id($les->course_id);?>
    <div class="space2"></div>
<h3 class="lato-light text-capi"><?php echo htmlentities($lec_c->name);?>  &nbsp; - <?php echo htmlentities($lec_c->course_code);?> &nbsp; - 
<?php echo htmlentities($lec_c->credit_hours)?> Credit Hours &nbsp; - Level <?php echo htmlentities($lec_c->level);?> &nbsp; - &nbsp;
 <span class="lato-black line padding05"><?php echo htmlentities(get_lecturers_for_course($les->id));?></span>  &nbsp; <br/> 
 <?php if(get_registration_mode() == "Allow") {?>
 <?php if(!course_registered($session->user_id,$les->id)){?>
 <br/>
 <a class="btn btn-md btn-primary white  line" href="<?php echo htmlentities(BASE_URL);?>students/registerCourse/<?php echo htmlentities($les->id."/" .$les->course_id);?>">Register For Course</a><br/>
 <?php }?>

  <?php }?>
 </h3>
 <div class="space1"></div>
 <div class="line-top"></div>
 <?php } }else{?>


<h1 class="lato-light text-center text-capi"> No Courses Assigned To You Yet</h1>

 <?php } ?>

</div>


</div>





</div>



<?php }else{ ?>


<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
