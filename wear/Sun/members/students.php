
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">All Students</h1>
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
<th width="10%">Image
</th> 
<th width="20%">Name
</th> 
<th width="15%">Email
</th> 
<th width="15%">Gender
</th> 

<th width="40%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($students as $student) { if(get_user_level($student->id) !="Developer"){?>
<tr>
  
  <td>
  <a href="<?php echo htmlentities(BASE_URL ."users/uploadImage/" .$student->id);?>">
  <?php if($student->user_pic == "profile_pics.jpg"){ ?>
            <img  width="80px" height="80px" src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive profile-pic" >
            <?php }else{?>
            <img  width="80px" height="80px" src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($student->id."/".$student->user_pic);?>" class="img-responsive profile-pic" >
          <?php }?>
          </a>
  </td>
  <td><?php echo htmlentities($student->first_name. " " . $student->last_name);?></td>
  <td><?php echo htmlentities($student->email);?></td>
  <td><?php  if($student->gender == 1){ echo htmlentities("Female");}else{echo htmlentities("Male");}?></td>
  <td>

  <?php if($student->is_active == 5){?> 
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>users/deleteUser/<?php echo htmlentities($student->id);?>"><i class="icon-trash icon-2x" data-title="Delete User" data-placement="bottom" data-toggle="tooltip"></i></a>
  <?php }?>

  <?php if($student->is_active == 1 && (get_user_level($student->id) !="Developer" || get_user_level($student->id) !="Top Manage" )){?>

 <a class="btn  btn-sm btn-success" href="<?php echo htmlentities(BASE_URL);?>users/activateUser/<?php echo htmlentities($student->id);?>">Activate</a>

  <?php } ?>
  <a class="btn  btn-sm "href="<?php echo htmlentities(BASE_URL);?>users/editUser/<?php echo htmlentities($student->id);?>"><i class="icon-pencil icon-2x" 
   data-title="Edit User " data-placement="bottom" data-toggle="tooltip"></i></a>
  <a data-toggle="modal" href="<?php echo htmlentities(BASE_URL);?>students/profile/<?php echo htmlentities($student->id);?>" class="btn  btn-sm ">
  <i class="icon-plus icon-2x"   data-title="Edit Profile For This Student" data-placement="bottom" data-toggle="tooltip"></i></a>
    <a data-toggle="modal" href="<?php echo htmlentities(BASE_URL);?>messages/newMEssage/<?php echo htmlentities($student->id);?>" class="btn  btn-sm ">
  <i class="icon-comment icon-2x"   data-title="Send Message" data-placement="bottom" data-toggle="tooltip"></i></a>
   <a class="btn btn-sm lato-light" 
 href="<?php echo htmlentities(BASE_URL);?>students/checkResults/<?php echo htmlentities($student->id);?>">
  <i class="icon-ok icon-2x"   data-title="Check Student Results" data-placement="bottom" data-toggle="tooltip"></i></a>  
     <a class="btn btn-sm lato-light" 
 href="<?php echo htmlentities(BASE_URL);?>students/performance/<?php echo htmlentities($student->id);?>">
  <i class="icon-bar-chart icon-2x"   data-title="View Performance Data" data-placement="bottom" data-toggle="tooltip"></i></a> 

<?php if(get_data_entry() == "YES"){?>
     <a class="btn btn-sm lato-light" 
 href="<?php echo htmlentities(BASE_URL);?>students/recordsEntry/<?php echo htmlentities($student->id ."/" . get_program_id_by_user($student->id));?>">
  <i class="icon-briefcase icon-2x"   data-title="Students Records Entry" data-placement="bottom" data-toggle="tooltip"></i></a>
<?php }?>

<?php if(student_completed($student->id)){?>
     <a class="btn btn-sm lato-light" 
 href="<?php echo htmlentities(BASE_URL);?>students/completed/<?php echo htmlentities($student->id);?>">
  <i class="icon-flag red icon-2x"   data-title="Completed Student" data-placement="bottom" data-toggle="tooltip"></i></a>
<?php }?>
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
