
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
<?php if(!empty($audios)){ ?>
<?php foreach ($audios as $audio) {?>
<div class="col-lg-4">
<section class="panel"> 
<img   class="img-responsive" data-name="Audio Cover" src="<?php echo htmlentities($wear->get_imageAdmin());?>audio_cover.jpg">
<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($audio->caption);?>  - <?php echo htmlentities($audio->created_by);?></h3>

<div id="" class="absolute-audio">

  <audio preload="auto" controls>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
  </audio>


</div>
<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-primary" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deleteAudio/<?php echo htmlentities($audio->id);?>"><i class="icon-trash"></i> Delete</a>
</li>
<li class="divider"> </li> 
 <li><a data-toggle="modal" href="#addToArticle-<?php echo htmlentities($audio->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Audio Article</a></li> 
  <li><a data-toggle="modal" href="#addToGallery-<?php echo htmlentities($audio->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Add To Gallery</a></li> 
</ul> 
</div>

</div>





</section>
<?php $groupings = get_gallery_groups(); ?>
<!-- Modal -->
  <div class="modal fade" id="addToGallery-<?php echo htmlentities($audio->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add To Gallery</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groupings)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>gallery/addGalleryItem/<?php echo htmlentities($audio->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Item Caption
</label> 

<div class="col-sm-4"> 
<input type="text" name="caption" placeholder="Name Of Image" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input class="span12" name="element_type" type="hidden" value="Audio" />
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

 include(WEAR_DIR . $wear->back ."/blog/includes/audio_article.php");


}
 ?>


</div>

<?php } ?>
<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Audio Uploaded</h3> </section></div>
<?php }?>

</div>


</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
