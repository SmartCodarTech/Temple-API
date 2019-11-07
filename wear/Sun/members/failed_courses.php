<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>
<?php $failed = get_all_failed_courses($session->user_id);?>

 <h1 class="text-capi lato-light text-center super3"> Failed Courses</h1>
    <p class="text-center lato-regular text-size-18"><?php echo htmlentities($user->first_name . " ". $user->last_name);?></p>
    <br/>
    <p class="text-center"> <span class="bg-yellow white padding1"><?php echo htmlentities(get_program_name_by_id(get_program_by_user_id($user->id)));?></span></p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 animated fadeIn line-right line-top line-bottom bg-white line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Courses You Have Failed / Cleared </h2>

<div class="line-top"></div>
    
    <?php if(!empty($failed)){?>
    <?php foreach($failed as $fail){?>
    <div class="space2"></div>
<h2 class="lato-light text-capi"><?php echo htmlentities($fail->course);?>  &nbsp; - <?php echo htmlentities($fail->course_code);?> &nbsp; - 
 <?php echo htmlentities($fail->score)?> &nbsp; -  <?php echo htmlentities($fail->grade);?> &nbsp; - &nbsp;
 <span class="bg-yellow white padding1"><?php echo htmlentities($fail->lecturer);?></span>  &nbsp; <br/> 
 </h2>
 <div class="space1"></div>
 <div class="line-top"></div>
 <?php } }else{?>

<div class="space4"></div>

<h1 class="lato-light text-center tect-capi"> You Have Not Failed Any Courses Yet </h1>

 <?php } ?>

</div>



</div>





</div>
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
                <!--=======intro=======-->
