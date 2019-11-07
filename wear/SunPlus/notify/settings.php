
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     

<section id="content"> <section> 
 <div class="space4"></div>
<div class="clearfix"></div>
 <div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>


<?php $nonce = create_csrf(); ?>
 <section class=" wrapper padding4"> 
 


<div class="space2"></div>

<div class="col-lg-12">
<div class="col-lg-6 ">
<div class="col-lg-12 panel-bg-blue-dark padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>notify/sendMessage"><img width="56px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/cloud.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Configurable Settings</h3>

</div>
<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">

<form action="<?php echo htmlentities(BASE_URL);?>notify/saveSetting" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Sender ID
</label> 

<div class="col-sm-5"> 
<input name="value" value="<?php echo htmlentities(get_notify_setting("Sender ID"));?>" type="text" class="bg-focus form-control" data-required="true">
<input name="name" value="Sender ID" type="hidden" class="bg-focus form-control" data-required="true">  
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />

            </div>
</div> 
<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Save</button> 
</div> 
</div> 
</form>



</div>
</div>

<div class="col-lg-6">

<div class="col-lg-12 panel-bg-move padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>notify/"><img width="36px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/data.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Credit Settings</h3>

</div>

<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<form> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Text Messages Left
</label> 

<div class="col-sm-5"> 

<h1 class="super lato-light"><?php echo htmlentities(get_text_units());?></h1>
            
</div>
</div> 

<div class="space2"></div>
<div class="line"></div> 
</form>

</div>
</div>

<div class="clearfix"></div>
<div class="space2"></div>



<div class="space2"></div>
<div class="clearfix"></div>
</div>


<div class="clearfix"></div>
<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
