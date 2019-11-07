<div class="clearfix"></div>
<h3 class=" division-text lato-light">All Article Images</h3>

<div class="space2"></div>
<div class="clearfix"></div>
<?php $sermon_pics= get_sermon_photos(); if(!empty($sermon_pics)){ ?>
<?php foreach ($sermon_pics as $sermon_pic) {?>
<div class="col-lg-4">
<section class="panel"> 
<img   class="img-responsive" data-name="<?php echo htmlentities($sermon_pic->image);?>" src="<?php echo htmlentities(BASE_URL);?>assets/articles/<?php echo htmlentities($sermon_pic->image)?>">

 
<h3 class="lato-light text-left panel-text"><?php echo htmlentities($sermon_pic->caption);?></h3>
<div class=" absolute-options"> 


<div class="nav-avatar pos-rlt"> 
<a href="#" class="btn btn-info" data-toggle="dropdown"><img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" /></a> 

<ul class="dropdown-menu m-t-sm animated fadeInLeft"> 
<span class="arrow top"></span> 
<li ><a href="<?php echo htmlentities(BASE_URL);?>media/deletePhoto/<?php echo htmlentities($sermon_pic->id);?>/Article">
<i class="icon-trash"></i> Delete</a> 
</li>
<li class="divider"> </li> 
<li> <a data-toggle="modal" href="#addToText-<?php echo htmlentities($sermon_pic->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Set As Text Article Image</a></li> 
 <li> <a data-toggle="modal" href="#addToVideo-<?php echo htmlentities($sermon_pic->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Set As Video Article Image</a></li> 
 <li><a data-toggle="modal" href="#addToAudio-<?php echo htmlentities($sermon_pic->id);?>" class="btn  btn-xs">
 <i class="icon-picture"></i> Set As Audio Article Image</a></li> 
</ul> 
</div>

</div>


</section>

<?php $audios = get_audio_articles(); ?>
<?php $videos = get_video_articles(); ?>
<?php $texts  = get_text_articles(); ?>
<!-- Modal -->
  <div class="modal fade" id="addToAudio-<?php echo htmlentities($sermon_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set As Audio Article Image</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($audios)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addAudioImage/<?php echo htmlentities($sermon_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Audio Articles
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Audio Article
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($audios as $audio){?>
<li ><a href="#">
<input type="radio" name="sermon" checked="" value="<?php echo htmlentities($audio->id)?>"><?php echo htmlentities($audio->title)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Set As Sermon Image</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Audio Article To Set Images As Article Images</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


  <!-- Modal -->
  <div class="modal fade" id="addToVideo-<?php echo htmlentities($sermon_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set As Video Article Image</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($videos)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addVideoImage/<?php echo htmlentities($sermon_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Video Articles
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Video Aritcle
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($videos as $video){?>
<li ><a href="#">
<input type="radio" name="sermon" checked="" value="<?php echo htmlentities($video->id)?>"><?php echo htmlentities($video->title)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Set As Video Article Image</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Video Article To Set Images As Article Images</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addToText-<?php echo htmlentities($sermon_pic->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set As Text Article Image</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($texts)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addArticleImage/<?php echo htmlentities($sermon_pic->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Text Articles
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Article
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($texts as $text){?>
<li ><a href="#">
<input type="radio" name="sermon" checked="" value="<?php echo htmlentities($text->id)?>"><?php echo htmlentities($text->title)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Set As Article Image</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Text Article To Set Images As Article Images</h4>
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
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Images Uploaded For Sermons.</h3> </section></div>
<?php }?>

<div class="clearfix"></div>