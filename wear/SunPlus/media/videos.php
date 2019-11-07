
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <section class="wrapper padding4"> 
 


<h1 class="lato-light text-left sun super2"> Video</h1>
<div class="space2"></div>

<?php if(!empty($videos)){ ?>
<?php foreach ($videos as $video) {?>
<div class="col-lg-3">
<section class="panel"> 
<div><?php echo htmlentities($video->link);?></div>


<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($audio->caption);?>  - <?php echo htmlentities($audio->created_by);?></h3>

<div class="clearfix m-b"> 

<div class="clear text-center"> <h4><?php echo htmlentities($video->caption);?>
</h4><p><?php echo htmlentities($video->description);?>
</p>
<a href="<?php echo htmlentities(BASE_URL);?>back/deleteEmbebbededVideo/<?php echo htmlentities($video->id);?>"><i class="icon-trash"></i> Delete</a> <a href="<?php echo htmlentities(BASE_URL);?>back/mediaEditVideoLink/<?php echo htmlentities($video->id);?>"><i class="icon-pencil"> Edit</i></a>
</div> 
</div>

</section>
</div>

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Embeded Videos Added.</h3> </section></div>
<?php }?>

<div class="clearfix"></div>




</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
