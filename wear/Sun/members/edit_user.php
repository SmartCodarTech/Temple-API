
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Editing Users </p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right bg-white line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Editing</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>users/saveUser/<?php echo htmlentities($user->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">First Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="first_name" value="<?php echo htmlentities($user->first_name);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Last Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="last_name" value="<?php echo htmlentities($user->last_name);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Email
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="email" value="<?php echo htmlentities($user->email);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 


<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Gender
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Gender Of This User
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 

<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="gender"  value="2"> Male</a></li> 
<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="gender"  value="1"> Female</a></li> 

</ul> 
</div>
</div> 
</div> 



<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add User</button> 
</div> 
</div> 
</form>

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
