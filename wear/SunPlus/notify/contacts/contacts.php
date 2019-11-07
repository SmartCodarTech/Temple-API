
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
<a href="<?php echo htmlentities(BASE_URL);?>notify/addContacts" name="submit" class="btn btn-primary padding3">Add Contact</a>
<a href="<?php echo htmlentities(BASE_URL);?>notify/groups" name="submit" class="btn btn-primary padding3">View Groups</a>
<div class="clearfix"></div>
<div class="space2"></div>
<?php if(!empty($contacts)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">Name
</th> 
<th width="15%">Number
</th>
<th width="10%">Ghana?
</th>
<th width="40%">Notes/Description
</th>  
<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($contacts as $contact) { ?>

<tr>
<td>
<?php echo htmlentities($contact->fullname);?>
</td>
  <td><?php if($contact->ghana === "YES"){ echo htmlentities("0".$contact->number);}else{echo htmlentities($contact->number);}?></td>
   <td><?php echo htmlentities($contact->ghana);?></td>
      <td><?php echo htmlentities($contact->notes);?></td>
  <td>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>notify/deleteContact/<?php echo htmlentities($contact->id);?>"><i class="icon-trash icon-2x"   data-title="Delete article" data-placement="bottom" data-toggle="tooltip"></i></a>
  
  <a data-toggle="modal" href="#AddToGroup-<?php echo htmlentities($contact->id);?>" class="btn  btn-sm ">
 <i class="icon-plus icon-2x"   data-title="Add Number To Group" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a data-toggle="modal" href="#SendMessage-<?php echo htmlentities($contact->id);?>" class="btn  btn-sm ">
 <i class="icon-comment-alt icon-2x"   data-title="Send Message" data-placement="bottom" data-toggle="tooltip"></i></a>
   <a data-toggle="modal" href="#EditContact-<?php echo htmlentities($contact->id);?>" class="btn  btn-sm ">
 <i class="icon-pencil icon-2x"   data-title="Edit Contact" data-placement="bottom" data-toggle="tooltip"></i></a>
  </td>


</tr>

<?php $settings = get_text_units();?>
<?php $groups = get_notify_contact_groups();?>
<!-- Modal -->

  <div class="modal fade" id="SendMessage-<?php echo htmlentities($contact->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Send Message To This contact</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($settings) && $settings != 0 ){?>
      <form action="<?php echo htmlentities(BASE_URL);?>notify/sendSingle/" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


<div class="form-group"> 


<div class="col-sm-4"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
  </div>
</div> 



<div class="form-group"> 
<label class="col-sm-3 control-label">Type Message Here
</label> 
<div class="col-sm-8"> 
<textarea name="message" class="bg-focus form-control"></textarea>
<input name="number" type="hidden" value="<?php echo htmlentities($contact->number);?>">
<input name="ghana" type="hidden" value="<?php echo htmlentities($contact->ghana);?>">
</div> 
</div>

<div class="space2"></div>
<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Send Message</button> 
</div> 
</div> 
</form>
<?php }else{ ?>

<h4 class="light lead"> You Should Have Texting Credits To Send Credits. You Have 0 Now</h4>
<?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<!-- Modal -->
<div class="modal fade" id="EditContact-<?php echo htmlentities($contact->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Contact</h4>
        </div>
        <div class="modal-body">
      
<form action="<?php echo htmlentities(BASE_URL);?>notify/saveContact/<?php echo htmlentities($contact->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Full Name
</label> 

<div class="col-sm-5"> 
<input name="fullname" value="<?php echo htmlentities($contact->fullname);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
<div class="space1"></div>
<div class="form-group"> 
<label class="col-sm-3 control-label text-capi text-left text-size-24 lato-light gray">Number
</label> 

<div class="col-sm-5"> 
<input name="number" value="<?php echo htmlentities($contact->number);?>" type="text" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 
<div class="space1"></div>

<div class="form-group"> 
<label class="col-sm-3 control-label control-label text-capi text-left text-size-24 lato-light gray">Notes Here
</label> 
<div class="col-sm-8"> 
<input name="notes" value="<?php echo htmlentities($contact->notes);?>" type="text" class="bg-focus form-control" data-required="true"> 

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
<input type="radio" name="ghana"  <?php if($contact->ghana === "NO"){?> checked="checked" <?php }?>  value="NO">NO</a></li> 
<li><a href="#">
<input type="radio" name="ghana" <?php if($contact->ghana === "YES"){?> checked="checked" <?php }?>  value="YES">YES</a></li> 
</ul> 
</div>
</div> 
</div>
<div class="space1"></div>
<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"> <button class="btn btn-primary" name="submit" type="submit">save</button> 
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
  <div class="modal fade" id="AddToGroup-<?php echo htmlentities($contact->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add This Contact To A Group</h4>
        </div>
        <div class="modal-body">
        <?php  if(!empty($groups)){?>
      <form action="<?php echo htmlentities(BASE_URL);?>notify/addToGroup/<?php echo htmlentities($contact->id);?>" method="POST" enctype="multipart/form-data" class="form-horizontal"> 


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
<input type="radio" name="group_id" checked="" value="<?php echo htmlentities($group->id)?>">
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

<h4 class="light lead"> You Have To Create Atleast One groups To Assign contact To</h4>
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
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No contacts</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
