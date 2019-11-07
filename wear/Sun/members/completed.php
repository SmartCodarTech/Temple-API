
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>
<?php $profile = get_student_by_user_id($id);?>

    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Completed Year - <?php echo htmlentities($profile->completed_academic_year);?> </p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right bg-white line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Summary Of Info</h2>
<div class="line-top"></div>
<div class="space2"></div>
<h2 class="lato-light text-capi">Completing Year - <?php echo htmlentities($profile->completed_academic_year);?></h2>  
<div class="line-top"></div>
<div class="space2"></div>
<h2 class="lato-light text-capi">Program Offered - <?php echo htmlentities(get_program_name_by_id($profile->program));?></h2>  

</div>



</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 ">
<div class="">

    <a href="<?php echo htmlentities(BASE_URL ."users/uploadImage/" .$user->id);?>">
            <?php if(get_member_pics($user->id) == "profile_pics.jpg"){ ?>
           <img width="150px" data-title="<?php echo htmlentities(get_user_name_by_id($user->id));?> " data-placement="bottom" data-toggle="tooltip" 
           src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive img-circle center " >
            <?php }else{?>
            <img width="150px" data-title="<?php echo htmlentities(get_user_name_by_id($user->id));?> " data-placement="bottom" data-toggle="tooltip" 
            src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($user->id."/profile_pic.jpg");?>" class="img-responsive center img-circle" >
          <?php }?>
    </a>

 </div>

   <div class="space1"></div>

</div>

<div class="padding3 ">

<h2 class="white lato-light  text-capi">Click Users Image To Change It</h2>
    

<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
