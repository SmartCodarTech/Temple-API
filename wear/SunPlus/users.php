
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"><div class="space4"></div>
<div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>



 <section class="wrapper padding4"> 
 

<?php if(!empty($users)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="20%">Name
</th> 
<th width="25%">Email
</th> 
<th width="15%">User Level
</th> 
<th width="15%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($users as $user) { if(get_user_level($user->id) !="Developer"){?>
<tr>

  <td><?php echo htmlentities($user->first_name. " " . $user->last_name);?></td>
  <td><?php echo htmlentities($user->email);?></td>
  <td><?php echo htmlentities(get_user_level($user->id));?></td>
  <td><a href="<?php echo htmlentities(BASE_URL);?>users/deleteUser/<?php echo htmlentities($user->id);?>"><i class="icon-trash icon-2x"></i></a>
  <a href="<?php echo htmlentities(BASE_URL);?>users/editProfile/<?php echo htmlentities($user->id);?>"><i class="icon-pencil icon-2x"></i></a></td>

</tr>

<?php }} ?>


</tbody> 
</table> 
</div> </section> 
</div> 

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No Messages</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
