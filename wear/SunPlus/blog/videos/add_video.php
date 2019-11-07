
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center lead"><?php echo $sessionmessage;?></header>
<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
 

<div class="space4"></div>


<div class="clearfix"></div>


<form action="<?php echo htmlentities(BASE_URL);?>blog/addVideo" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Title
</label> 

<div class="col-sm-5"> 
<input name="title" placeholder="Title Of Your Article" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
</div> 
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Author
</label> 

<div class="col-sm-5"> 
<input name="author" placeholder="Original Author" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Release Date
</label> 

<div class="col-sm-5"> 
<input size="16"  data-date-format="yyyy-mm-dd" name="release_date" placeholder="Date This Devetion Should Be published" type="text"  class="datepicker bg-focus form-control" data-required="true"> 
            </div>
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Disable Frown Feature
</label> 
<div class="col-sm-5"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Disable ? Choose
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" name="disable_frown" checked="Checked" value="1">NO</a></li> 
<li><a href="#">
<input type="radio" name="disable_frown" value="2">YES</a></li> 
</ul> 
</div>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Summary
</label> 

<div class="col-sm-5"> 
<textarea  name="summary" placeholder="The Summary "   class=" bg-focus form-control" data-required="true"></textarea> 
            </div>
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Article
</label> 

<div class="col-sm-5"> 
<textarea id="editor" name="article" placeholder="The Article "   class=" bg-focus form-control" data-required="true"></textarea> 
            </div>
</div>

<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"><button class="btn btn-primary" name="submit" type="submit">Add Audio</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
