
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>

    <h1 class="text-capi lato-light text-center super3">Change Your Password</h1>
    <p class="text-center lato-regular text-size-18">Let It Contatin At least One Capital & One Sign </p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 bg-white line animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Edit Program</h2>
<form action="<?php echo htmlentities(BASE_URL)?>users/savePassword/<?php echo htmlentities($user->id)?>" method="POST" class="form-horizontal"> 

 
<div class="form-group"> 
<label class="col-sm-3 control-label">Old Password
</label> 

<div class="col-sm-8"> 
<input type="password" name="old_password" placeholder="Type Old Password Here" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">New Password
</label> 
<div class="col-sm-8"> 
<input type="password" name="new_password" placeholder="Choose A Strong Password" class="bg-focus form-control" data-required="true"> 

            </div>

</div>


<div class="form-group"> 
<label class="col-sm-3 control-label">Confirm Passowrd
</label> 

<div class="col-sm-8"> 
<input type="password" name="confirm_password" placehoder="Type Passowrd Again" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 



<div class="form-group"> 

<div class="col-sm-8 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Change Password</button> 
</div> 
</div> 
</form>>



<div class="arrow-up-info animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>















