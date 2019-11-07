
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }else{ ?>

<header class="animated back-anole fadeInUp slow text-center lead">Media Library  - Add Embedded Video</header>

<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="scrollable wrapper"> 
 



<h3 class="lead text-left"> <i class="icon-picture"></i>Add Embedded Video</h3>

<div class="col-lg-12"><section class="panel"> </section></div>
<div class="clearfix"></div>


<form action="<?php echo htmlentities(BASE_URL);?>back/addEmbebbededVideo" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Video Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Short Description
</label> 
<div class="col-sm-4"> 
<input type="text" name="description" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"> 

            </div>

</div>
<div class="form-group"> 
<label class="col-sm-3 control-label">Video Embed Link
</label> 
<div class="col-sm-4"> 
<textarea name="link" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"> </textarea>

            </div>

</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-white" type="submit">Cancel</button> <button class="btn btn-primary" name="submit" type="submit">Add Link</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
