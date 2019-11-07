
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 

<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <?php $nonce = create_csrf(); ?>
 <section class=" wrapper padding4"> 
 

<div class="space2"></div>

<div class="col-lg-12">
<?php $gallery_pics= get_gallery_photos(); if(!empty($gallery_pics)){ ?>
<?php foreach ($gallery_pics as $gallery_pic) {?>
<div class="col-lg-3">
<section class="panel"> 
<img   class="img-responsive" data-name="<?php echo htmlentities($gallery_pic->image);?>" src="<?php echo htmlentities(BASE_URL);?>assets/gallery/<?php echo htmlentities($gallery_pic->image)?>">
<h3 class="lato-light text-left panel-text"><?php echo htmlentities($gallery_pic->caption);?></h3>
<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-success" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deletePhoto/<?php echo htmlentities($gallery_pic->id);?>/Gallery">
<i class="icon-trash"></i> Delete</a></li>
<li class="divider"> </li> 
<li><a data-toggle="modal" href="#addToGallery-<?php echo htmlentities($gallery_pic->id);?>">
<i class="icon-picture"></i> Add To gallery</a></li> 
</ul> 
</div>

</div>
</section>
<?php $groupings = get_gallery_groups(); ?>
<!-- Modal -->
  <div class="modal fade" id="addToGallery-<?php echo htmlentities($gallery_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add To Gallery</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groupings)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>gallery/addGalleryItem/<?php echo htmlentities($gallery_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Item Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Item Type Image/Video
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Item Type
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" name="element_type" checked="checked" value="Image">Image</a></li>  
</ul> 
</div>
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

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Images Uploaded For Gallery.</h3> </section></div>
<?php }?>

<div class="clearfix"></div>

<?php
  
$instal_gears = Parser::getParam("gears","extra",CONF_DIR."config/gears.ini");
$extra_gears = explode(",", $instal_gears);

if(!empty($extra_gears) && in_array("blog", $extra_gears)){

 include_once(WEAR_DIR . $wear->back ."/blog/includes/article_images.php");


}

 ?>

<?php
  
$instal_gears = Parser::getParam("gears","extra",CONF_DIR."config/gears.ini");
$extra_gears = explode(",", $instal_gears);

if(!empty($extra_gears) &&  array_key_exists("event", $extra_gears)){

 include(WEAR_DIR . $wear->back ."blog/includes/event_images.php");


}

 ?>

<div class="clearfix"></div>
<h3 class=" division-text lato-light">All Other Images</h3>
<div class="space2"></div>

<?php $other_pics= get_other_photos(); if(!empty($other_pics)){ ?>
<?php foreach ($other_pics as $other_pic) {?>

<div class="col-lg-4">
<section class="panel"> 
<img   class="img-responsive" data-name="<?php echo htmlentities($other_pic->image);?>" src="<?php echo htmlentities(BASE_URL);?>assets/other/<?php echo htmlentities($other_pic->image)?>">

<h3 class="lato-light text-left panel-text"><?php echo htmlentities($other_pic->caption);?></h3>
<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-success" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deletePhoto/<?php echo htmlentities($other_pic->id);?>/Other"><i class="icon-trash"></i> Delete</a>
</li>
<li class="divider"> </li> 
<li><a data-toggle="modal" href="#addToSection-<?php echo htmlentities($other_pic->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Set As Section Image</a></li>
 <li><a data-toggle="modal" href="#addToSeries-<?php echo htmlentities($other_pic->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Set As Series Image</a></li> 
</ul> 
</div>

</div>

</section>

<?php $series = get_all_series(); ?>
<?php $sections = get_article_categories(); ?>
<!-- Modal -->
  <div class="modal fade" id="addToSection-<?php echo htmlentities($other_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set As Section Image</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($sections)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addSectionImage/<?php echo htmlentities($other_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Sections
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Section
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($sections as $section){?>
<li ><a href="#">
<input type="radio" name="section" checked="" value="<?php echo htmlentities($section->id)?>"><?php echo htmlentities($section->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Set As Section Image</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Section To Set Images As Section Images</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<!-- /.end categories -->

<!-- Modal -->
  <div class="modal fade" id="addToSeries-<?php echo htmlentities($other_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set As Series Image</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($series)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addSeriesImage/<?php echo htmlentities($other_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Article Series
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Series
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($series as $serie){?>
<li ><a href="#">
<input type="radio" name="series" checked="" value="<?php echo htmlentities($serie->id)?>"><?php echo htmlentities($serie->title)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Set As Series Image</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Series To Set Images As Series Images</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


<!-- /.end series -->

</div>

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Other Images Uploaded.</h3> </section></div>
<?php }?>


</div>

<div class="clearfix"></div>

</section> 
</section>

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
