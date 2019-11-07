
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

<?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }else{ ?>

<header class="animated back-anole fadeInUp slow text-center lead">All Requests</header>

<?php }?>

<?php $nonce = create_csrf(); ?>

 <section class="scrollable wrapper"> 
 
<h3 class="lead text-left"> <i class="icon-male"></i> Manage Requests </h3>


<?php if(!empty($requests)){ ?>
<?php foreach ($requests as $request) { ?>

<div class="col-lg-3">
<section class="panel padding2">
<p class=""><?php echo htmlentities($request->about);?></p>

<div class="clearfix m-b"> 

<div class="clear text-center">
          <h3 class="text-center"><?php echo htmlentities($request->name);?></h3>
          <h5 class="text-center text-capi">0<?php echo htmlentities($request->tel_number);?></h5>
          <a class="btn btn-mini" href="<?php echo htmlentities(BASE_URL . "back/deleteRequest/" .$request->id);?>">Delete</a>
</div>
</div>
</section>
</div>

<?php } ?>


<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">You Have No Requests</h3> </section></div>
<?php }?>
</section>
<div class="clear"></div>


</section> 




<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
