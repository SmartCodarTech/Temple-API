
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>


<?php if(!empty($lecturer)){?>

    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Editing Lecturers</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right line-top line-bottom bg-white line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Edit Profile</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>lecturers/saveProfile/<?php echo htmlentities($lecturer->id ."/" .$id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Qualifications
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="qualifications" placeholder="" type="text" class="bg-focus form-control" data-required="true"><?php echo htmlentities($lecturer->qualifications)?></textarea> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 




<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Profile</button> 
</div> 
</div> 
</form>

</div>



</div>
<?php }else{ ?>


    <h1 class="text-capi lato-light text-center super3">Create A Profile For This Lecturer</h1>
    <p class="text-center lato-regular text-size-18"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right line-top line-bottom bg-white line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Add Profile</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>lecturers/newProfile/<?php echo htmlentities($id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Qualifications
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="qualifications" placeholder="" type="text" class="bg-focus form-control" data-required="true"></textarea> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 




<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add Profile</button> 
</div> 
</div> 
</form>

</div>



</div>

<?php }?>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="space2"></div>
<div class="col-lg-12 col-md-12 col-sm-12 ">
<div class="">

    <a href="<?php echo htmlentities(BASE_URL ."users/uploadImage/" .$id);?>">
            <?php if(get_member_pics($id) == "profile_pics.jpg"){ ?>
           <img width="150px" data-title="<?php echo htmlentities(get_user_name_by_id($id));?> " data-placement="bottom" data-toggle="tooltip" 
           src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive img-circle center " >
            <?php }else{?>
            <img width="150px" data-title="<?php echo htmlentities(get_user_name_by_id($id));?> " data-placement="bottom" data-toggle="tooltip" 
            src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($id."/profile_pic.jpg");?>" class="img-responsive center img-circle" >
          <?php }?>
    </a>

 </div>

   <div class="space1"></div>

</div>

<div class="padding3 ">

<h2 class="white lato-light  text-capi">Click Lecturers Image To Change It</h2>
    

<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
