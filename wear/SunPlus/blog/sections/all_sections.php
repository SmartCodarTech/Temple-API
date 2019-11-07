
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>

<?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 

<?php if(!empty($sections)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 

<th width="30%">Name
</th>  
<th width="50%">Description
</th> 

<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($sections as $section) { ?>
<tr>

  <td><?php echo htmlentities($section->name);?><strong><?php if($section->members_only == 2){ echo htmlentities(" [Members Only]");}?></strong></td>
  <td><?php echo htmlentities($section->description);?></td>


  <td>
  <a class="btn btn-sm " href="<?php echo htmlentities(BASE_URL);?>blog/deleteSection/<?php echo htmlentities($section->id);?>"><i class="icon-trash icon-2x" data-title="Delete Section" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn btn-sm " href="<?php echo htmlentities(BASE_URL);?>blog/editSection/<?php echo htmlentities($section->id);?>"><i class="icon-pencil icon-2x" data-title="Edit Section" data-placement="bottom" data-toggle="tooltip"></i></a>
   


  </td>


</tr>


<!-- Modal -->
  <div class="modal fade" id="addToCategory-<?php echo htmlentities($section->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Set Section For This section</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($categories)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>sectionCom/addsectionCategory/<?php echo htmlentities($section->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


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

<h4 class="light lead"> You Have To Create Atleast One Section To Assign section To</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<!-- Modal -->
  <div class="modal fade" id="addToSeries-<?php echo htmlentities($section->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add This Vsection To Series</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($series)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>sectionCom/addsectionSeries/<?php echo htmlentities($section->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


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

<h4 class="light lead"> You Have To Create Atleast One Series To Assign section To</h4>
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
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No sections</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
