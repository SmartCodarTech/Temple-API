
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


<?php $students = get_lecturers_students($id); ?>

 <h1 class="text-capi lato-light text-center super3">Welcome <?php echo htmlentities($user->first_name . " ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">what do you want to do today</p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 bg-white animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Students Registerd For This Course - <?php echo  htmlentities(get_course_name_by_id($course));?></h2>

<div class="line-top"></div>
    
    <?php if(!empty($students)){?>
    <?php foreach($students as $student){ $stud = get_user($student)?>
    <div class="space1"></div>
<h2 class="lato-light text-capi"><?php echo htmlentities($stud->first_name ." " . $stud->last_name);?><br/>
 <a class="btn btn-md btn-info lato-light" 
 href="<?php echo htmlentities(BASE_URL);?>students/performance/<?php echo htmlentities($stud->id);?>"> View Performance Data </a>  
 <a class="btn btn-md btn-primary lato-light"
 href="<?php echo htmlentities(BASE_URL);?>lecturers/gradeStudent/<?php echo htmlentities($stud->id);?>/<?php echo htmlentities($course);?>/<?php echo htmlentities(get_course_level_by_id($course));?>/<?php echo htmlentities(get_course_program_by_id($course) ."/".$id);?>">Grade Student </a>
<a href="<?php echo htmlentities(BASE_URL);?>lecturers/addRemark/<?php echo htmlentities($stud->id);?>/<?php echo htmlentities($course);?>" 
class="btn btn-md btn-danger lato-light">Add Remarks</a>
 </h2>
 <div class="space1"></div>
 <div class="line-top"></div>
 <?php } }else{?>

<div class="space2"></div>
<h1 class="lato-light text-center text-capi"> No Students Have Registered For This Course Yet</h1>

 <?php } ?>

</div>

<div class="arrow-up-info"></div>

</div>





</div>

<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
