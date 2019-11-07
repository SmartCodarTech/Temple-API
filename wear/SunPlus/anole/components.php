
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
<?php $settings = get_settings(); ?>

<div class="col-lg-4">
<div class="col-lg-12 panel-bg-move padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>back/appInfo"><img width="36px" src="<?php echo htmlentities($wear->get_image());?>img/512/params.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Gears</h3>

</div>

<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix m-b"> 

 <div class="clear text-center"> 
 <h3>Application Gears</h3>
 <li class=" line divider"></li>
 <p class="padding3 lead">Gears extend the basic functionalities of your appliccation hence allowing the application to give more to you. You can order for your own custom Gear however each custom Gear you request will require a monthly fee for update to keep it running with the versions of the aplication that will be built</p>
 <li class=" line divider"></li>

</div>
</div>

</div>
</div>

<div class="col-lg-4">
<div class="col-lg-12 panel-bg-blue-lighter padding4 text-center animated fadeInUp ">

<a href="#/appinfo"><img width="36px" src="<?php echo htmlentities($wear->get_image());?>img/512/params.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Gears Installed</h3>

</div>
<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix m-b"> 
 <div class="clear text-center">

 <p class="padding3 lead">
 	<strong>Editing Gear</strong> : Edit All The Pages Created For Your Website With Ease<br/> <br/><strong>Sun Gallery 1.8 : </strong> A category Based Bubust gallery to display your works protfolio or any images of external videos you want <br/> <br/><strong>Messages 1.0.9</strong>:  Recieve messages in Your Application and reply to the senders right from your application without the need to enter your email <br/><br/><strong>Users 1.0</strong> : Get other users to help manage the website and keep information up to date<br/><br/>
 </p>
 <li class=" line divider"></li>




</div>
</div>
</div>

</div>

<div class="col-lg-4">
<div class="col-lg-12 panel-bg-ash padding4 text-center animated fadeInUp ">

<a href="#/appinfo"><img width="36px" src="<?php echo htmlentities($wear->get_image());?>img/512/params.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Other Gears</h3>

</div>

<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix m-b"> 
 <div class="clear text-center">
 <h3>Gears You Can Have For This Version</h3>
 <li class=" line divider"></li>
 <p class="padding3 lead"><?php echo Parser::getParam("Gears","others",CONF_DIR."app/Gears.ini");?></p>
 <li class=" line divider"></li>



</div>
</div>
</div>


</div>
<div class="clearfix"></div>
<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
