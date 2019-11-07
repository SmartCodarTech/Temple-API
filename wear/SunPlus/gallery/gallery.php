
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
<?php  if(!empty($items)){ ?>
<?php foreach ($items as $item) {?>
<div class="col-lg-3">
<section class="panel"> 
<?php if($item->element_type == "Image"){?>
<?php $image = get_image_media_by_id($item->element_id);?>

<img   class="img-responsive" data-name="<?php echo htmlentities($image->image);?>" src="<?php echo htmlentities(BASE_URL);?>assets/gallery/<?php echo htmlentities($image->image)?>">
<?php }elseif($item->element_type == "Audio"){?>
<?php $audio = get_audio_media_by_id($item->element_id);?>
<div id="" class="absolute-audio">

  <audio preload="auto" controls>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
          <source src="<?php echo htmlentities(BASE_URL)?>assets/audio/<?php echo htmlentities($audio->audio);?>"/>
  </audio>


</div>
<img   class="img-responsive" data-name="Audio Cover" src="<?php echo htmlentities($wear->get_imageAdmin());?>audio_cover.jpg">
<?php }elseif($item->element_type == "Video"){?>

<?php }?>
<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($item->caption);?>  - <?php echo htmlentities(get_group_name_by_id($item->gallery_group));?></h3>

<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-primary" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>gallery/deleteGalleryItem/<?php echo htmlentities($item->id);?>"><i class="icon-trash"></i> Delete</a>
</li>
<li class="divider"> </li> 

</ul> 
</div>

</div>

 



</section>
</div>

<?php }?>
<?php }else{ ?>
              <div class="col-lg-4"><section class="panel"> 
              <h4 class="padding1 text-center">No Images Uploaded For Gallery.</h4> </section></div>
<?php }?>


<div class="clearfix"></div>
<h3 class=" division-text lato-light">Gallery Groupings</h3>
<div class="space2"></div>


<div class="col-lg-6">
<form action="<?php echo htmlentities(BASE_URL);?>gallery/addGroup" method="POST" class="form-horizontal"> 
           <div class="form-group"> 
<button type="submit" name="submit" class="btn btn-primary padding3">Add Gallery Group</button>
<div class="col-sm-6"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />

<input type="text" name="name" placeholder="Type Group Name Here" class="bg-focus form-control"> 

<div class="line line-dashed m-t-lg">
</div> 

</div> 
</div>
</form>
</div>
<div class="clearfix"></div>

<?php if(!empty($groups)){ ?>
<?php foreach ($groups as $group) {?>
<div class="col-lg-3">
<section class="panel"> 

<div class="clearfix m-b"> 
<div class="clear text-center"> <h4><?php echo htmlentities($group->name);?></h4>
<a class="" href="<?php echo htmlentities(BASE_URL);?>gallery/deleteGroup/<?php echo htmlentities($group->id);?>"><i class="icon-trash"></i> Delete </a> 
&nbsp;&nbsp;&nbsp;&nbsp;
<a data-toggle="modal" href="#editGrouping" class="btn  btn-xs"> <i class="icon-pencil"></i> Edit</a>

</div> 
</div>

</section>
</div>
  <!-- Modal -->
  <div class="modal fade" id="editGrouping" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Grouping</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo htmlentities(BASE_URL);?>gallery/saveGroup/<?php echo htmlentities($group->id);?>" method="POST" class="form-horizontal"> 
           <div class="form-group"> 
<button type="submit" name="submit" class="btn btn-primary">Sace Changes</button>
<div class="col-sm-6"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />

<input type="text" name="name" value="<?php echo htmlentities($group->name);?>" class="bg-focus form-control"> 

<div class="line line-dashed m-t-lg">
</div> 

</div> 
</div>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<?php } ?>
<?php }else{ ?>
              <div class="col-lg-3"><section class="panel"> <h2 class="text-center padding1 block lato-light">No Gallery Groups Created.</h2> </section></div>
<?php }?>
</div>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
