
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> 

<section id="content"> 
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <?php $nonce = create_csrf(); ?>
 <section class=" wrapper padding4"> 

<div class="space2"></div>
<div class="col-lg-12">
<div class="col-lg-6">
<div class="col-lg-12 panel-bg-blue-dark padding4 text-center relative animated bounceInUp">

<a href=""><img width="87px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/photo.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Upload An Image</h3>
</div>

<div class="col-lg-12 bg-white padding4 text-center relative animated bounceInUp">
<form action="<?php echo htmlentities(BASE_URL);?>media/addPhoto" method="POST" enctype="multipart/form-data" class="form-horizontal"> 

<div class="form-group"> 
<div class="col-sm-3 "> </div>
<div class="col-sm-6 ">  

<div class=""> 
<input type="file" name="image" title="Select Image To Upload" class="btn btn-sm btn-info m-b-sm">

</div> 
</div> 


</div> 

<div class="form-group"> 
<div class="col-sm-3 "> </div>
<div class="col-sm-6"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>

</div> 



<div class="form-group"> 
<div class="col-sm-3"> 
</div>
<div class="col-sm-6"> 
<div class="btn-group ">
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Image Purpose
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" name="purpose" checked="" value="Gallery">Gallery</a></li> 
<li><a href="#">
<input type="radio" name="purpose" value="Article">Article</a></li> 
<li><a href="#">
<input type="radio" name="purpose" value="Event">Event</a></li> 
<li><a href="#">
<input type="radio" name="purpose" value="Other">Other</a></li> 
</ul> 
</div>


</div> 
</div>

<div class="line"> </div> 
<div class="space1"></div>
<div class="col-sm-3"></div>
<div class="col-sm-6"> <button class="btn btn-primary" name="submit" type="submit">Upload Image - Submit</button> 
</div> 

<div class="space2"></div>
</form>
</div>
</div>
<div class="col-lg-6">
<div class="col-lg-12 panel-bg-blue-lighter padding4 text-center relative animated bounceInUp">

<a href=""><img width="87px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/photo.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Upload Audio</h3>
</div>
<div class="col-lg-12 bg-white padding4 text-center relative animated animated fadeIn">
<form action="<?php echo htmlentities(BASE_URL);?>media/addAudio" method="POST" enctype="multipart/form-data" class="form-horizontal"> 

<div class="form-group"> 
<label class="col-sm-3  control-label">
</label> 

<div class="col-sm-6 ">  

<div class=""> 
<input type="file" name="image" title="Select Your Audio File" class="btn btn-sm btn-info m-b-sm">

</div> 
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3  control-label">
</label> 

<div class="col-sm-6"> 
<input type="text" name="caption" placeholder="Name Of Audio" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3  control-label">
</label> 

<div class="col-sm-6"> 
<input type="text" name="created_by" placeholder="Name Original Creator" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="line"> </div> 
<div class="space1"></div>
<div class="form-group"> 

<div class="col-sm-6 col-sm-offset-3"><button class="btn btn-primary" name="submit" type="submit">Upload Audio</button> 
</div> 
</div> 
</form>


</div>
</div>
<div class="clearfix"></div>
<div class="col-lg-6">
<div class="col-lg-12 panel-bg-sun padding4 text-center relative animated bounceInUp">

<a href=""><img width="87px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/video.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Add External Video</h3>
</div>
<div class="col-lg-12 bg-white padding4 text-center relative animated animated fadeIn">
<div class="space2"></div>
<form action="<?php echo htmlentities(BASE_URL);?>media/addEmbebbededVideo" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-2 control-label">
</label> 

<div class="col-sm-8"> 
<input type="text" name="caption" placeholder="Video Caption" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 


<div class="form-group"> 
<label class="col-sm-2 control-label">
</label> 
<div class="col-sm-8"> 
<input type="text" name="description" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"> 

            </div>

</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">
</label> 
<div class="col-sm-8"> 
<textarea name="link" placeholder="A Short Description Of Video" class="bg-focus form-control" data-required="true"> </textarea>

            </div>

</div>


<div class="form-group"> 

<div class="col-sm-8 col-sm-offset-2">  <button class="btn btn-primary" name="submit" type="submit">Add Video Link</button> 
</div> 
</div> 
</form>
</div>


</div>

<div class="col-lg-6">
<div class="col-lg-12 panel-bg-ash padding4 text-center relative animated bounceInUp">

<a href=""><img width="87px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/video.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Add Internal Video</h3>
</div>
<div class="col-lg-12 bg-white padding4 text-center relative animated animated fadeIn">
<div class="space2"></div>
<form action="<?php echo htmlentities(BASE_URL);?>media/addVideo" method="POST" enctype="multipart/form-data" class="form-horizontal"> 

<div class="form-group "> 
<label class="col-sm-3 control-label">
</label> 

<div class="col-sm-6 ">  

<div class=""> 
<input type="file" name="image" title="Select Video File To Upload" class="btn btn-sm btn-info m-b-sm">

</div> 
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">
</label> 

<div class="col-sm-6"> 
<input type="text" name="caption" placeholder="Name Of Audio" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-3 control-label">
</label> 

<div class="col-sm-6"> 
<input type="text" name="created_by" placeholder="Name Original Creator" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="line"></div>
<div class="space1"></div>
<div class="form-group"> 

<div class="col-sm-6 col-sm-offset-3"><button class="btn btn-primary" name="submit" type="submit">Upload Video</button> 
</div> 
</div> 
</form>
</div>


</div>

</div>
</div>

<div class="clearfix"></div>

</section> 
</section>

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
