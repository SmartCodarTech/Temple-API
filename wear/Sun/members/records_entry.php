
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>


    <h1 class="text-capi lato-light text-center super3"> Enter Records For <?php echo htmlentities($user->first_name . " " . $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Program - <?php echo htmlentities(get_program_name_by_id($program));?></p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-12 col-md-12 col-sm-12 animated fadeIn">
<?php $level = get_student_level_by_user_id($id); if(!empty($level)){ ?>
<?php for($i= 1; $i< $level; $i++){?>
<div class="col-lg-3 col-md-3 col-sm-3 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>students/enterRecords/<?php echo htmlentities($i); ?>/<?php echo htmlentities($id ."/". $program); ?>">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>ok.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Level <?php echo htmlentities($i); ?></h3>
</div>
<?php }?>
<?php }else{ ?>

 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue"> No Results Are Available For YOu</h3>
<?php }?>
<div class="space4"></div>



</div>









<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
