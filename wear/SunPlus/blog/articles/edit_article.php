

<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center lead"><?php echo $sessionmessage;?></header>
<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4 "> 
 

<div class="clearfix"></div>

<div class=" col-lg-8 col-lg-offset-2 padding3">

<form action="<?php echo htmlentities(BASE_URL);?>blog/saveArticle/<?php echo htmlentities($article->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Title
</label> 

<div class="col-sm-8"> 
<input name="title" value="<?php echo htmlentities($article->title);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Author
</label> 

<div class="col-sm-8"> 
<input name="author" value="<?php echo htmlentities($article->author);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Release Date
</label> 

<div class="col-sm-8"> 
<input size="16"  data-date-format="yyyy-mm-dd" name="release_date" value="<?php echo htmlentities($article->release_date);?>" type="text"  class="datepicker bg-focus form-control" data-required="true"> 
            </div>
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Disable Frown
</label> 
<div class="col-sm-8"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select One
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" class="text-capi text-left text-size-28 lato-light gray" name="disable_frown" <?php if($article->disable_frown == 1){ ?>checked="Checked" <?php }?> value="1">No</a></li> 
<li><a href="#">
<input type="radio" class="text-capi text-left text-size-28 lato-light gray" name="disable_frown" <?php if($article->disable_frown == 2){ ?>checked="Checked" <?php }?>value="2">YES</a></li> 
</ul> 
</div>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Summary
</label> 

<div class="col-sm-8"> 
<textarea  name="summary" value=""   class=" bg-focus form-control" data-required="true"><?php echo htmlentities($article->summary);?> </textarea> 
            </div>
</div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Article
</label> 
<div class="space2"></div>

<div class="col-sm-12"> 
<textarea id="editor" name="article" placeholder="The Devotion "   class=" bg-focus form-control large" data-required="true">
	<?php echo htmlentities($article->article);?>
</textarea> 
            </div>
</div>

<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">Save Edit</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>
</div>
</section> 
<div class="space4"></div>

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
