
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>


<?php if(!empty($student)){?>

    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Editing Students</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right line-top bg-white line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Edit Profile</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>students/saveProfile/<?php echo htmlentities($student->id ."/" .$id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="level" value="<?php echo htmlentities($student->level)?>" type="text" class="bg-focus form-control" data-required="true"/>
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Age
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="age" value="<?php echo htmlentities($student->age)?>" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div> 

<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Student's ID
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="student_id" value="<?php echo htmlentities($student->student_id)?>" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div>

<div class="form-group "> 

<label class="col-sm-12 control-label text-capi text-left text-size-24 lato-light gray">Academic Year Entered School
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="academic_year" value="<?php echo htmlentities($student->academic_year)?>" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div>

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Program
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Program This Student Belongs To
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($programs as $program){?>
<li <?php if($student->program == $program->id){?> class="active" <?php }?> ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="program"  <?php if($student->program == $program->id){?> checked="checked" <?php }?> value="<?php echo htmlentities($program->id)?>"> <?php echo htmlentities($program->name)?></a></li> 
<?php } ?>
</ul> 
</div>
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


    <h1 class="text-capi lato-light text-center super3">Create A Profile For This Student</h1>
    <p class="text-center lato-regular text-size-18"><?php echo htmlentities($user->first_name ." " .$user->last_name);?></p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn line-right line-top line-bottom bg-white line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Edit Profile</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>students/newProfile/<?php echo htmlentities($id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="level" placeholder="Students Level Currently" type="text" class="bg-focus form-control" data-required="true"/>
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Age
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="age" placeholder="Student's Age" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div> 

<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Student ID
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="student_id" placeholder="Student's ID" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div>

<div class="form-group "> 

<label class="col-sm-12 control-label text-capi text-left text-size-24 lato-light gray">Academic Year Entering School
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="academic_year" placeholder="eg 2013-2014" type="text" class="bg-focus form-control" data-required="true"/>

            </div>
</div>

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Program
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Program This Student Belongs To
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($programs as $program){?>
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="program"  value="<?php echo htmlentities($program->id)?>"> <?php echo htmlentities($program->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div> 
<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Profile</button> 
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

<h2 class="white lato-light  text-capi">Click Users Image To Change It</h2>
    

<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
