
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center lead"><?php echo $sessionmessage;?></header>
<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class=" wrapper padding4"> 
 <div class="space4"></div>

<div class="clearfix"></div>


<form action="<?php echo htmlentities(BASE_URL);?>blog/addSeries" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Title
</label> 

<div class="col-sm-5"> 
<input name="title" placeholder="Title Of Your Article" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Summary
</label> 

<div class="col-sm-5"> 
<textarea id="" name="summary" placeholder="The Description "   class=" bg-focus form-control" data-required="true"></textarea> 
            </div>
</div>

<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"><button class="btn btn-primary" name="submit" type="submit">Add Series</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
