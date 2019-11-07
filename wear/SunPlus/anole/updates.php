
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }else{ ?>

<header class="animated back-anole fadeInUp slow text-center lead">App Updates </header>

<?php }?>


<?php $nonce = create_csrf(); ?>
 <section class="scrollable wrapper"> 
 



<h3 class="lead text-left"> <i class="icon-cog"></i>Update Service</h3>

<div class="col-lg-12"><section class="panel"> </section></div>
<div class="clearfix"></div>
<?php $settings = get_settings(); ?>

<div class="col-lg-4">
<section class="panel "> 


<div class="clearfix m-b"> 

 <div class="clear text-center"> 
 <h3>Application Updates</h3>
 <li class=" line divider"></li>
 <p class="padding3 lead"><?php echo htmlentities(Parser::getParam("version","about",APP_DIR."config/anole/updates.ini"));?></p>
 <li class=" line divider"></li>

</div>
</div>

</section>
</div>

<div class="col-lg-4">
<section class="panel"> 


<div class="clearfix m-b"> 
 <div class="clear text-center">
 <h3>Service</h3>
 <li class=" line divider"></li>
 <p class="padding3 lead"><?php echo htmlentities(Parser::getParam("service","status",APP_DIR."config/anole/updates.ini"));?></p>
 <li class=" line divider"></li>
<h4 class="padding3 lato-bold"><?php echo htmlentities(Parser::getParam("service","about",APP_DIR."config/anole/updates.ini"));?></h4>

 <li class=" line divider"></li>
<h1 class="padding3 lato-bold"> <?php echo htmlentities(Parser::getParam("service","amount",APP_DIR."config/anole/updates.ini"));?></h1>



</div>
</div>

</section>
</div>

<div class="clearfix"></div>
<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
