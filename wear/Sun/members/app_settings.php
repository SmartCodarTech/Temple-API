
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">Application Settings</h1>
    <p class="text-center lato-regular text-size-18"> Enable Data Entry And Editing Mode</p>
    <div class="space4"></div>


<div class="space2"></div>



<div class="col-lg-12 col-md-12 col-sm-12  animated fadeIn">
<?php $settings = get_settings(); if(!empty($settings)){?>
<?php foreach($settings as $setting){ 
	if($setting->name == "Data Entry"){?>
<div class="col-lg-4 bg-yellow padding4 text-center animated fadeInDown">


<div class="space1"></div>


<h3 class="lato-light text-left panel-text white text-center text-capi"><?php echo htmlentities($setting->name);?></h3>


 <?php if($setting->value == "YES"){?>
<a class="btn btn-white  lato-regular bg-white" href="<?php echo htmlentities(BASE_URL);?>manage/setDataEntryMode/1">Disbale Data Entry</a>
<?php }else{?>
<a class="btn btn-success" href="<?php echo htmlentities(BASE_URL);?>manage/setDataEntryMode/2">Activate Data Entry</a>

 <?php }?>
<div class="space3"></div>

<div class="space3"></div>

</div>
<div class="col-lg-4 bg-white padding4 text-center animated fadeInDown">


<div class="space1"></div>


<h3 class="lato-light text-left panel-text text-center text-capi">Advance Students To Next Level</h3>


<a class="btn btn-danger" href="<?php echo htmlentities(BASE_URL);?>manage/setAdvanceStudents/1">Advance Students</a>

<div class="space3"></div>

<div class="space3"></div>

</div>
<?php }elseif($setting->name == "Student Registration"){?>
<div class="col-lg-4 bg-white padding4 text-center animated fadeInDown">


<div class="space1"></div>


<h3 class="lato-light text-left panel-text text-center text-capi"><?php echo htmlentities($setting->name);?></h3>


 <?php if($setting->value == "Allow"){?>
<a class="btn btn-danger" href="<?php echo htmlentities(BASE_URL);?>manage/setRegistrationMode/1">Disbale Student Registration</a>
<?php }else{?>
<a class="btn btn-success" href="<?php echo htmlentities(BASE_URL);?>manage/setRegistrationMode/2">Activate Student Registration</a>

 <?php }?>
<div class="space3"></div>

<div class="space3"></div>

</div>


<?php }elseif($setting->name == "Site Email"){?>

<div class="col-lg-4 panel-bg-blue-dark padding4 text-center animated fadeInDown">
 

<h3 class="lato-light text-left panel-text"><?php echo htmlentities($setting->name);?></h3>

 <form action="<?php echo htmlentities(BASE_URL)?>back/setSiteEmail/" method="POST" class="form-horizontal"> 



<div class="form-group padding2"> 

<div class="col-sm-12"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input type="email" name="site_email" value="<?php echo htmlentities($setting->value);?>" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 
</div> 


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">
<button class="btn btn-primary" name="submit" type="submit">Update Email</button> 
</div> 
</div> 
</form>
<div class="space3"></div>

<div class="space3"></div>
</div>


<?php }elseif($setting->name == "Maintenance Mode"){?>

<div class="col-lg-4">
<section class="panel"> 


<div class="clearfix m-b"> 
<div class="space1"></div>

<h3 class="lato-light text-left panel-text"><?php echo htmlentities($setting->name);?></h3>

<?php if($setting->value == "Active"){?>
<a class="btn btn-danger" href="<?php echo htmlentities(BASE_URL);?>back/setMaintenanceMode/1">  Leave Maintenance Mode </a>
<?php }else{?>
<a class="btn btn-success" href="<?php echo htmlentities(BASE_URL);?>back/setMaintenanceMode/2"> Enter Maintenance Mode </a>
 <?php }?>

<div class="space3"></div>

<div class="space3"></div>

</section>
</div>


<?php }?>

<?php }}else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">You Have No App Settings</h3> </section></div>
<?php }?>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
