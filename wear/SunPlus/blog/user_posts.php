
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

<?php if(!empty($posts)){ ?>
<div class="col-lg-12">
<div class="tab-pane" id="datatable"> <section class="table-list"> 



<div class="table-responsive"> 
<table class="table table-striped m-b-none" data-ride="datatables"> 
<thead> 
<tr> 
<th width="15%">User 
</th> 
<th width="15%">Date
</th>
<th width="15%">Title
</th>
<th width="30%">post
</th>  
<th width="5%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($posts as $post) { ?>

<tr>
<td>
 <?php if(get_member_pics($post->member_id) == "profile_pics.jpg"){ ?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" width="60px" class="img-responsive img-circle  profile-pic" > <?php echo htmlentities(get_user_name_by_id($post->member_id));?>
            <?php }else{?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($post->member_id."/".get_member_pics($post->member_id));?>" width="60px" class="img-responsive img-circle profile-pic" ><?php echo htmlentities(get_user_name_by_id($post->member_id));?>
          <?php }?>
</td>
  <td><?php echo htmlentities(convert_time($post->created_at,2));?></td>
   <td><?php echo htmlentities($post->title);?></td>
    <td><?php echo htmlentities($post->content);?></td>


  <td>
  <a class="btn  btn-sm " href="<?php echo htmlentities(BASE_URL);?>blog/deleteUserPost/<?php echo htmlentities($post->id);?>"><i class="icon-trash icon-2x"   data-title="Delete article" data-placement="bottom" data-toggle="tooltip"></i></a>
  </td>


</tr>

<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div> 

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h3 class="padding3">No User Posts</h3> </section></div>
<?php }?>



<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
