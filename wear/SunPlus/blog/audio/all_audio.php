
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>

<?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
 

<?php $categories = get_article_categories(); ?>
<?php $series = get_all_series(); ?>


<div class="clearfix"></div>

<?php if(!empty($audios)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">Article Image
</th> 
<th width="15%">Title
</th>
<th width="15%">Author
</th>  
<th width="15%">Section
</th> 
<th width="15%">Series
</th> 

<th width="25%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($audios as $audio) { ?>

<tr>
<td>
<?php if(!empty($audio->article_image)){?>
<img   class="img-responsive" width="160px" height="140px" src="<?php echo htmlentities(BASE_URL);?>assets/articles/<?php echo htmlentities($audio->article_image)?>"></td>
<div class="space2"></div>
  <?php }else{?>
<img   class="img-responsive" width="160px" height="140px" src="<?php echo htmlentities(BASE_URL);?>assets/default/audio_image.jpg">
  <?php }?>
</td>
  <td><?php echo htmlentities($audio->title);?></td>
    <td><?php echo htmlentities($audio->author);?></td>
    <td><?php if($audio->category_id != 0){
    	echo htmlentities(get_section_name_by_id($audio->category_id));
    	}else{
    	echo htmlentities("You Must Set Category For audio To Show");}?></td>
    	<td><?php if($audio->series_id != 0){
    	echo htmlentities(get_series_name_by_id($audio->series_id));
    	}else{
    	echo htmlentities("audio Is Not Part Of Any Series");}?></td>

  <td>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>blog/deleteaudio/<?php echo htmlentities($audio->id);?>"><i class="icon-trash icon-2x"   data-title="Delete article" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>blog/editaudio/<?php echo htmlentities($audio->id);?>"><i class="icon-pencil icon-2x"   data-title="Edit article" data-placement="bottom" data-toggle="tooltip"></i></a>
<a data-toggle="modal" href="#addToCategory-<?php echo htmlentities($audio->id);?>" class="btn  btn-sm">
 <i class="icon-tasks icon-2x"   data-title="Set Section" data-placement="bottom" data-toggle="tooltip"></i>
</a>

<a data-toggle="modal" href="#addToSeries-<?php echo htmlentities($audio->id);?>" class="btn  btn-sm ">
 <i class="icon-umbrella icon-2x"   data-title="Set Series" data-placement="bottom" data-toggle="tooltip"></i>
</a>

<a class="btn  btn-sm btn-dark" href="<?php echo htmlentities(BASE_URL);?>blog/addAudioArticleFeatured/<?php echo htmlentities($audio->id);?>">
  <i class="icon-thumbs-up icon-2x " data-title="Make Featured" data-placement="bottom" data-toggle="tooltip"></i>
</a>

<a data-toggle="modal" class="btn  btn-sm btn-dark" href="#allAudio-<?php echo htmlentities($audio->id);?>">
  <i class="icon-music icon-2x " data-title="Check Audio Added" data-placement="bottom" data-toggle="tooltip"></i>
</a>
  </td>


</tr>


<!-- Modal -->
  <div class="modal fade" id="addToCategory-<?php echo htmlentities($audio->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set Section For This Audio</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($categories)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addAudioCategory/<?php echo htmlentities($audio->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


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

<span class="dropdown-label">Select Section To Add
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($categories as $category){?>
<li ><a href="#">
<input type="radio" name="section_id" value="<?php echo htmlentities($category->id)?>"><?php echo htmlentities($category->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Section</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Section To Assign audio To</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


<!-- Modal  All Audio -->
  <div class="modal fade" id="allAudio-<?php echo htmlentities($audio->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">All Audio Files Attached To This Audio Post</h4>
        </div>
        <div class="modal-body">
<?php  if(!empty($audio->audio)){?>

<?php 
$files = explode(",",$audio->audio);

foreach ($files as $file) {

   $name = get_audio_media_by_id($file);
   echo "<h4 class=\"light lead\"><a href=\"".BASE_URL."media/audio\">" . $name->caption ."</a>". "&nbsp;&nbsp;".
   "<a class=\"btn  btn-sm\" href=\"".BASE_URL."blog/deleteAudioFromArticle/". $file ."/".$audio->id."\">
   <i class=\"icon-trash icon-2x\"   data-title=\"Remove Audio From Article\" data-placement=\"bottom\" data-toggle=\"tooltip\"></i></a></h4>";


 } 

?>


<?php }else{ ?>



<h4 class="light lead"> No Audio Assigned To Article Yet </h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<!-- Modal -->
  <div class="modal fade" id="addToSeries-<?php echo htmlentities($audio->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add This Audio To A Series</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($series)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>blog/addAudioSeries/<?php echo htmlentities($audio->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">All Series
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Series To Add
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($series as $serie){?>
<li ><a href="#">
<input type="radio" name="series_id" checked="" value="<?php echo htmlentities($serie->id)?>">
<?php echo htmlentities($serie->title)?></a></li> 

<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Series</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One Series To Assign audio To</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div> 

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No audios</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
