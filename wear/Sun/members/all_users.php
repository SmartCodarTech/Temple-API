
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>



    <h1 class="text-capi lato-light text-center super3">Managers / Editors And Top Mangers</h1>
    <p class="text-center lato-regular text-size-18"> Manage Access</p>
    <div class="space4"></div>


<div class="space2"></div>



 <h3 class="text-capi lato-light text-center super3">Editors</h3>
 <div class="space3"></div>
<div class="col-lg-12 col-md-12 col-sm-12 bg-yellow animated fadeIn">
<div class="">

<h2 class=" lato-regular text-capi"></h2>
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="20%">Name
</th> 
<th width="25%">Email
</th> 
<th width="15%">Gender
</th> 
<th width="15%">Type Of User
</th> 
<th width="25%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($users as $user) { if(get_user_level($user->id) !="Developer"){?>
<tr>

  <td><?php echo htmlentities($user->first_name. " " . $user->last_name);?></td>
  <td><?php echo htmlentities($user->email);?></td>
  <td><?php  if($user->gender == 1){ echo htmlentities("Female");}else{echo htmlentities("Male");}?></td>
  <td><?php echo htmlentities(get_user_level($user->id));?></td>

  <td>
<?php if($user->is_active == 5){?>

  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>users/deleteUser/<?php echo htmlentities($user->id);?>"><i class="icon-trash icon-2x"></i></a>

<?php }else{?>

 <a class="btn  btn-sm btn-success" href="<?php echo htmlentities(BASE_URL);?>users/activateUser/<?php echo htmlentities($user->id);?>">Activate</a>

<?php } ?>

  <a class="btn  btn-sm "  href="<?php echo htmlentities(BASE_URL);?>users/editUser/<?php echo htmlentities($user->id);?>"><i class="icon-pencil icon-2x"></i></a></td>

</tr>

<?php }} ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>

<div class="space4"></div>

 <h3 class="text-capi lato-light text-center super3"> Top Mangers</h3>
<div class="space3"></div>



<div class="col-lg-12 col-md-12 col-sm-12 bg-yellow animated fadeIn">
<div class="">

<h2 class=" lato-regular text-capi"></h2>
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="20%">Name
</th> 
<th width="25%">Email
</th> 
<th width="15%">Gender
</th> 
<th width="15%">Type Of User
</th> 
<th width="25%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($tops as $top) { if(get_user_level($top->id) !="Developer"){?>
<tr>

  <td><?php echo htmlentities($top->first_name. " " . $top->last_name);?></td>
  <td><?php echo htmlentities($top->email);?></td>
  <td><?php  if($top->gender == 1){ echo htmlentities("Female");}else{echo htmlentities("Male");}?></td>
  <td><?php echo htmlentities(get_user_level($top->id));?></td>
  <td><a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>users/deleteUser/<?php echo htmlentities($top->id);?>"><i class="icon-trash icon-2x"></i></a>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>users/editUser/<?php echo htmlentities($top->id);?>"><i class="icon-pencil icon-2x"></i></a></td>

</tr>

<?php }} ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>


</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
