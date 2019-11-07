
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

<?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }else{ ?>

<header class="animated back-anole fadeInUp slow text-center lead">Sun Gallery  - Groupings</header>

<?php }?>


 <?php $nonce = create_csrf(); ?>
 <section class="scrollable wrapper"> 
 



<h3 class="lead text-left"> <i class="icon-picture"></i>Groupings / Categories</h3>

<div class="col-lg-12"><section class="panel"> </section></div>
<div class="clearfix"></div>

<div class="clearfix"></div>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
