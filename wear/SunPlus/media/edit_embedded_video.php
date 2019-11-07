
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
 


<div class="col-lg-8">

<div class="col-lg-12 panel-bg-blue-dark padding4 text-center relative animated bounceInUp">

<a href=""><img width="87px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/photo.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Edit External Video <?php echo htmlentities($video->caption);?></h3>
</div>
<div class="col-lg-12 bg-white padding4 text-center relative animated bounceInUp">
<form action="<?php echo htmlentities(BASE_URL);?>media/saveEmbebbededVideo/<?php echo htmlentities($video->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Video Caption
</label> 

<div class="col-sm-6"> 
<input type="text" name="caption" value="<?php echo htmlentities($video->caption);?>" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Short Description
</label> 
<div class="col-sm-6"> 
<input type="text" name="description" value="<?php echo htmlentities($video->description);?>" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"> 

            </div>

</div>
<div class="form-group"> 
<label class="col-sm-3 control-label">Video Embed Link
</label> 
<div class="col-sm-6"> 
<textarea name="link" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"><?php echo htmlentities($video->link);?></textarea>

            </div>

</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-white" type="submit">Cancel</button> <button class="btn btn-primary" name="submit" type="submit">Save Embedded Video</button> 
</div> 
</div> 
</form>
</div>
</div>


<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
