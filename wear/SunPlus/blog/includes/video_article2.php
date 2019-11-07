

 <?php $videoatEs = get_video_articles(); ?> 
<!-- Modal -->
  <div class="modal fade" id="addExToArticle-<?php echo htmlentities($videoE->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add To Article</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($videoatEs)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addvideoItem/<?php echo htmlentities($videoE->id);?>/external" method="POST" enctype="multipart/form-data" class="form-horizontal"> 




<div class="form-group"> 
<label class="col-sm-3 control-label">Select video Article
</label> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />

<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Item Type
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($videoatEs as $videoatE){?>
<li ><a href="#">
<input type="radio" name="article" checked="" value="<?php echo htmlentities($videoatE->id)?>"><?php echo htmlentities($videoatE->title)?></a></li> 
<?php } ?>

</ul> 
</div>
</div> 
</div>



<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Article</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One video Article To Add video</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>