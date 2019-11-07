
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <section class="wrapper padding4"> 
 

<div class="space2"></div>
<div class="col-lg-12">
<?php $setting = get_wear_name(); if(!empty($setting)){?>
<div class="col-lg-6">

<img   class="img-responsive" src="<?php echo htmlentities(BASE_URL);?>wear/<?php echo htmlentities($setting)?>/poster.png">



<h3 class="lato-light text-left panel-text2"><?php echo htmlentities($setting);?></h3>




</div>

<div class="col-lg-6">

<div class="col-lg-12 panel-bg-blue-lighter padding4 text-center relative animated animated bounceInUp">
<a href=""><img width="46px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/params.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Landing Page Info</h3>
</div>
<section class="panel"> 


<div class="clearfix m-b"> 
 <div class="clear text-center">

 <p class="padding3 lead">One Landing Page</p>
 <li class=" line divider"></li>
 <h4>Wear Created Samuel</h4>
 <h4>Company Anole Studios</h4>
 <li class=" line divider"></li>
  <h4>Supports All Components Of Bright Starters</h4>

 <h3><?php echo Parser::getParam("version","supports",WEAR_DIR.$setting ."/config.ini");?></h3>


</div>
</div>

</section>
</div>

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">You Dress Has Not Been Shown</h3> </section></div>
<?php }?>

<div class="clearfix"></div>

<h3 class="lead text-left"> <i class="icon-cog"></i> Other Dresses You Have</h3>

<?php $others = get_other_wears(); if(!empty($setting)){?>

<?php }?>


</div>


<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
