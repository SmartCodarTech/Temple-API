
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
<h3 class="lato-light text-left panel-text text-capi white">Send Message To A group</h3>

</div>
<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">

<form action="<?php echo htmlentities(BASE_URL);?>notify/sendToGroup" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Sender ID
</label> 

<div class="col-sm-5"> 
<input name="sender_id" placeholder="Name Of You Group" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label control-label text-capi text-left text-size-24 lato-light gray">Message
</label> 
<div class="col-sm-8"> 
<textarea name="message" class="bg-focus form-control"></textarea>

</div> 
</div>

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Select The Group
</label> 
<div class="col-sm-5"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select If The Group
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($groups as $group){?>
<li ><a href="#">
<input type="radio" name="group_id" value="<?php echo htmlentities($group->id)?>"><?php echo htmlentities($group->name)?></a></li> 
<?php } ?>

</ul> 
</div>
</div> 
</div>

<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Send</button> 
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
<h3 class="lato-light text-left panel-text text-capi white">Send Message To All Contacts</h3>

</div>

<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<form action="<?php echo htmlentities(BASE_URL);?>notify/send" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Sender ID
</label> 

<div class="col-sm-5"> 
<input name="sender_id" placeholder="Name Of You Group" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label control-label text-capi text-left text-size-24 lato-light gray">Message
</label> 
<div class="col-sm-8"> 
<textarea name="message" class="bg-focus form-control"></textarea>

</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Send</button> 
</div> 
</div> 
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
