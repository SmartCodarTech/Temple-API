
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>


<?php $nonce = create_csrf(); ?>
 <section class="wrapper padding4"> 
 

<div class="space2"></div>
<div class="col-lg-12">
<?php $settings = get_settings(); if(!empty($settings)){?>
<?php foreach($settings as $setting){ 
	if($setting->name == "Editing Mode"){?>
<div class="col-lg-4 panel-bg-blue-lighter padding4 text-center animated fadeInDown">


<div class="space1"></div>


<h3 class="lato-light text-left panel-text"><?php echo htmlentities($setting->name);?></h3>


 <?php if($setting->value == "Active"){?>
<a class="btn btn-danger" href="<?php echo htmlentities(BASE_URL);?>manage/setEditingMode/1">Stop Editing</a>
<?php }else{?>
<a class="btn btn-success" href="<?php echo htmlentities(BASE_URL);?>manage/setEditingMode/2">Activate Editing</a>

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

<div class="clearfix"></div>
<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
