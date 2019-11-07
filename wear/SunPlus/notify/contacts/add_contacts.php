
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div> 

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center lead"><?php echo $sessionmessage;?></header>
<?php  }?>

     <?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
 

<div class="space4"></div>

<div class="clearfix"></div>


<form action="<?php echo htmlentities(BASE_URL);?>notify/createContact" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Full Name
</label> 

<div class="col-sm-5"> 
<input name="fullname" placeholder="Name Of You Group" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Number
</label> 

<div class="col-sm-5"> 
<input name="number" placeholder="Name Of You Group" type="text" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label control-label text-capi text-left text-size-24 lato-light gray">Notes Here
</label> 
<div class="col-sm-8"> 
<textarea name="notes" class="bg-focus form-control"></textarea>

</div> 
</div>

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Is Number In Ghana ?
</label> 
<div class="col-sm-5"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select If This is Local (Ghana)
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" name="ghana"  value="NO">NO</a></li> 
<li><a href="#">
<input type="radio" name="ghana" value="YES">YES</a></li> 
</ul> 
</div>
</div> 
</div>

<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Add Contact</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
