
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>


    <h1 class="text-capi lato-light text-center super3">Enter Records For <?php echo htmlentities($user->first_name . " " . $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Program - <?php echo htmlentities(get_program_name_by_id($program));?></p>
    <div class="space4"></div>
  <h2 class="lato-regular text-capi">Level <?php echo htmlentities($level);?></h2>
 
<div class="space2"></div>

<div class="col-lg-8 col-md-8 col-sm-8 animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Courses Offered For This Level</h2>
<div class="line-top"></div>
<div class="space2"></div>

<?php 
$courses = get_courses_for_level_program($program,$level);
$course_ids ="";
$course_names ="";
        if(!empty($courses)){
          
          foreach ($courses as $course) {
              
              if(empty($course_ids) && empty($course_names)){

              $course_names .= $course->name;
              $course_ids .= $course->id;

              }else{

             $course_names .= "," .$course->name;
              $course_ids .= "," .$course->id ;

              }

          }

        }else{

            $course_names =" No Courses Available For This";

        }
?>


<div class="col-sm-12 control-label text-capi text-left text-size-24 lato-light gray">
<?php echo htmlentities($course_names);?>
</div> 


<div class="space2"></div>
<div class="line-top"></div>

    <form action="<?php echo htmlentities(BASE_URL);?>students/saveRecords/<?php echo htmlentities($level."/".$id."/"."$program")?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Scores
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="scores" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input class="span12" name="course_ids" type="hidden" value="<?php echo htmlentities($course_ids);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Grades
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="grades" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Academic Year For This Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="academic_year" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 



<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add Records</button> 
</div> 
</div> 
</form>

</div>



</div>

<div class="col-lg-4 col-md-4 col-sm-4 bg-light-blue animated fadeIn">
<div class="space2"></div>

<div class="padding3 ">

<h2 class="white lato-light  text-capi">Notes</h2>
    
<h2 class="white lato-regular text-capi">Please make sure you enter the score and grades in the order
of the courses arranged above. Seperated With A Comma</h2>
<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
