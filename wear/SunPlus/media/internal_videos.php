
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <?php $nonce = create_csrf(); ?>
 <section class="wrapper padding4"> 
 

<div class="space2"></div>
<div class="col-lg-12">

<?php if(!empty($videos)){ ?>
<?php foreach ($videos as $video) {?>
<div class="col-lg-4">
<section class="panel"> 

<div>
<video id="example_video_1" class="video-js vjs-default-skin"
  controls preload="auto" width="100%" height="350"
  poster="<?php echo htmlentities($wear->get_imageAdmin());?>video_cover.jpg"
  data-setup='{"example_option":true}'>
 <source src="<?php echo htmlentities(BASE_URL);?>assets/videos/<?php echo htmlentities($video->video);?>" type='video/mp4' />

</video>
</div>

<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($video->caption);?>  - <?php echo htmlentities($video->created_by);?></h3>
 

<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-info " data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deletevideo/<?php echo htmlentities($video->id);?>"><i class="icon-trash"></i> Delete</a>
</li>
<li class="divider"> </li> 
 <li><a data-toggle="modal" href="#addToArticle-<?php echo htmlentities($video->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Video Article</a></li> 
  <li><a data-toggle="modal" href="#addToGallery-<?php echo htmlentities($video->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Gallery</a></li> 
</ul> 
</div>

</div>





</section>
<?php $groupings = get_gallery_groups(); ?>
<!-- Modal -->
  <div class="modal fade" id="addToGallery-<?php echo htmlentities($video->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add To Gallery</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groupings)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>gallery/addGalleryItem/<?php echo htmlentities($video->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Item Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input class="span12" name="element_type" type="hidden" value="Video" />
  </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Gallery Groupings
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Group For Item
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($groupings as $grouping){?>
<li ><a href="#">
<input type="radio" name="gallery_group" checked="" value="<?php echo htmlentities($grouping->id)?>"><?php echo htmlentities($grouping->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Gallery</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Gallery Group To Add Items To The Gallery</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


<?php
  
$instal_gears = Parser::getParam("gears","extra",CONF_DIR."config/gears.ini");
$extra_gears = explode(",", $instal_gears);

if(!empty($extra_gears) &&  in_array("blog", $extra_gears)){

 include(WEAR_DIR . $wear->back ."/blog/includes/video_article.php");


}
 ?>
</div>

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Video Uploaded</h3> </section></div>
<?php }?>




<div class="clearfix"></div>
<h3 class=" division-text lato-light">All External Videos</h3>
<div class="space2"></div>

<?php if(!empty($videoEs)){ ?>
<?php foreach ($videoEs as $videoE) {?>
<div class="col-lg-4" id="fitVids">
<section class="panel"> 

<iframe id="fitVids" src="<?php echo htmlentities($videoE->link);?>" width="560" height="315" frameborder="0" allowfullscreen></iframe>

<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($videoE->caption);?></h3>

<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-info" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deleteEmbebbededVideo/<?php echo htmlentities($videoE->id);?>"><i class="icon-trash"></i> Delete</a>
</li>

<li class="divider"> </li> 
<li class="divider"> </li> 
 <li><a data-toggle="modal" href="#addExToArticle-<?php echo htmlentities($videoE->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Video Article</a></li> 
  <li><a data-toggle="modal" href="#addExToGallery-<?php echo htmlentities($videoE->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Gallery</a></li> 
 <li> <a href="<?php echo htmlentities(BASE_URL);?>media/mediaEditVideoLink/<?php echo htmlentities($videoE->id);?>"><i class="icon-pencil"> Edit</i></a></li> 
</ul> 
</div>

</div>



</section>

<!-- Modal -->
  <div class="modal fade" id="addExToGallery-<?php echo htmlentities($videoE->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add To Gallery</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groupings)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>gallery/addGalleryItem/<?php echo htmlentities($videoE->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Item Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input class="span12" name="element_type" type="hidden" value="Video" />
  </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Gallery Groupings
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Group For Item
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($groupings as $grouping){?>
<li ><a href="#">
<input type="radio" name="gallery_group" checked="" value="<?php echo htmlentities($grouping->id)?>"><?php echo htmlentities($grouping->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Gallery</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Gallery Group To Add Items To The Gallery</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
</div>


<?php
  
$instal_gears = Parser::getParam("gears","extra",CONF_DIR."config/gears.ini");
$extra_gears = explode(",", $instal_gears);

if(!empty($extra_gears) &&  in_array("blog", $extra_gears)){

 include(WEAR_DIR . $wear->back ."/blog/includes/video_article2.php");


}
 ?>

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h2 class="padding3 lato-light">No Embeded Videos Added.</h2> </section></div>
<?php }?>

</div>


<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
