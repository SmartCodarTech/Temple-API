
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <section class="vbox"> 

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }else{ ?>

<header class="animated back-anole fadeInUp slow text-center lead">Media Library  - Upload Video</header>

<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="scrollable wrapper"> 
 



<h3 class="lead text-left"> <i class="icon-picture"></i> Upload Video</h3>

<div class="col-lg-12"><section class="panel"> </section></div>
<div class="clearfix"></div>


<form action="<?php echo htmlentities(BASE_URL);?>back/addVideo" method="POST" enctype="multipart/form-data" class="form-horizontal"> 

<div class="form-group m-t-lg"> 
<label class="col-sm-3 control-label">Select Your Video File
</label> 

<div class="col-sm-4 media m-t-none">  

<div class="media-body"> 
<input type="file" name="image" title="Select Video File" class="btn btn-sm btn-info m-b-sm">

</div> 
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Video Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Audio" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
</div> 
<div class="form-group"> 
<label class="col-sm-3 control-label">Created by
</label> 

<div class="col-sm-4"> 
<input type="text" name="created_by" placeholder="Name Original Creator" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-white" type="submit">Cancel</button> <button class="btn btn-primary" name="submit" type="submit">Upload Video</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
