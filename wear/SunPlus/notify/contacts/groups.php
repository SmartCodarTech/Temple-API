
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>

<?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 

<div class="clearfix"></div>

<a href="<?php echo htmlentities(BASE_URL);?>notify/contactGroups" name="submit" class="btn btn-primary padding3">Add Contact Group</a>
<a href="<?php echo htmlentities(BASE_URL);?>notify/" name="submit" class="btn btn-primary padding3">View Contacts</a>
<div class="clearfix"></div>
<div class="space2"></div>
<?php if(!empty($groups)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">Name
</th> 
<th width="15%">Local (Ghana)
</th>
<th width="50%">Numbers
</th>
  
<th width="15%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($groups as $group) { ?>

<tr>
<td>
<?php echo htmlentities($group->name);?>
</td>
  <td><?php if($group->locality === "YES"){ echo htmlentities("Local");}else{echo htmlentities("Foreign");}?></td>
   <td><?php echo htmlentities($group->numbers);?></td>
  <td>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>notify/deleteGroup/<?php echo htmlentities($group->id);?>"><i class="icon-trash icon-2x"   data-title="Delete Group" data-placement="bottom" data-toggle="tooltip"></i></a>
  
  <a data-toggle="modal" href="#EditGroup-<?php echo htmlentities($group->id);?>" class="btn  btn-sm ">
 <i class="icon-pencil icon-2x"   data-title="Edit Group" data-placement="bottom" data-toggle="tooltip"></i></a>

  </td>


</tr>

<!-- Modal -->

  <div class="modal fade" id="EditGroup-<?php echo htmlentities($group->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit This Group</h4>
        </div>
        <div class="modal-body">
<form action="<?php echo htmlentities(BASE_URL);?>notify/saveGroup/<?php echo htmlentities($group->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 

<div class="col-sm-5"> 
<input name="name" value="<?php echo htmlentities($group->name);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 

<div class="space1"></div>

<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Is Group In Ghana ?
</label> 
<div class="col-sm-5"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select If This is Local (Ghana)
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li ><a href="#">
<input type="radio" name="locality"  value="NO">NO</a></li> 
<li><a href="#">
<input type="radio" name="locality" value="YES">YES</a></li> 
</ul> 
</div>
</div> 
</div>
<div class="space1"></div>
<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit"> Save</button> 
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

<!-- Modal -->
  <div class="modal fade" id="AddToGroup-<?php echo htmlentities($group->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add This group To A Group</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groups)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>notify/addToGroup/<?php echo htmlentities($group->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">All groups
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select Groups To Add
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($groups as $group){?>
<li ><a href="#">
<input type="radio" name="groups_id" checked="" value="<?php echo htmlentities($group->id)?>">
<?php echo htmlentities($group->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Add To Group</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Have To Create Atleast One groups To Assign group To</h4>
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
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No groups</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
