
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">All Lecturers</h1>
    <p class="text-center lato-regular text-size-18"> Manage Access</p>
    <div class="space4"></div>


<div class="space2"></div>



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
<th width="25%">Gender
</th> 

<th width="30%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($lecturers as $lecturer) { if(get_user_level($lecturer->id) !="Developer"){?>
<tr>

  <td><?php echo htmlentities($lecturer->first_name. " " . $lecturer->last_name);?></td>
  <td><?php echo htmlentities($lecturer->email);?></td>
  <td><?php  if($lecturer->gender == 1){ echo htmlentities("Female");}else{echo htmlentities("Male");}?></td>
  <td><a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>users/deleteUser/<?php echo htmlentities($lecturer->id);?>"><i class="icon-trash icon-2x" data-title="Delete User" data-placement="bottom" data-toggle="tooltip"></i></a>
  <a class="btn  btn-sm "href="<?php echo htmlentities(BASE_URL);?>users/editUser/<?php echo htmlentities($lecturer->id);?>"><i class="icon-pencil icon-2x" 
   data-title="Edit User " data-placement="bottom" data-toggle="tooltip"></i></a>
  <a data-toggle="modal" href="<?php echo htmlentities(BASE_URL);?>lecturers/profile/<?php echo htmlentities($lecturer->id);?>" class="btn  btn-sm ">
  <i class="icon-plus icon-2x"   data-title="Edit Profile For This Lecturer" data-placement="bottom" data-toggle="tooltip"></i></a>
    <a data-toggle="modal" href="<?php echo htmlentities(BASE_URL);?>messages/newMessage/<?php echo htmlentities($lecturer->id);?>" class="btn  btn-sm ">
  <i class="icon-comment icon-2x"   data-title="Send Message / Notice" data-placement="bottom" data-toggle="tooltip"></i></a>


  </td>

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
