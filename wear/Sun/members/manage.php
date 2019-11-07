
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">Manage Access</h1>
    <p class="text-center lato-regular text-size-18">Create Lecturers / Students / Editors To Have Access To The Application</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right line-top line-bottom bg-white line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Add A User</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>users/newUser/" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">First Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="first_name" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Last Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="last_name" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Email
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="email" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">User Type
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select The Type Of User
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 

<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="user_type"  value="2"> Student</a></li> 
<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="user_type"  value="3"> Lecturer</a></li> 

<?php if(get_user_level($session->user_id)=="Developer" || get_user_level($session->user_id)=="Top Manager") {?>

<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="user_type"  value="5"> Editor</a></li> 
<li><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="user_type"  value="10">Top Manager</a></li> 

<?php }?>

</ul> 
</div>
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
<div class="round-tab round-tab-white">

    <a href="<?php echo htmlentities(BASE_URL ."users/allUsers/");?>">
    <img class="center img-responsive"  width="80px" src="<?php echo htmlentities($wear->get_image());?>contacts.png"/>
    </a>

 </div>

   <div class="space1"></div>

</div>

<div class="padding3 ">

<h2 class="white lato-light  text-capi">Notes</h2>
    

<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
