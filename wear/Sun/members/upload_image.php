

<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>

    <h1 class="text-capi lato-light text-center super3">Change Your Image</h1>
    <p class="text-center lato-regular text-size-18">Upload Your Image</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 bg-white line animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Upload Your Image Here</h2>

<form action="<?php echo htmlentities(BASE_URL)?>users/saveImage/<?php echo htmlentities($user->id)?>" method="post" enctype="multipart/form-data" class="form-horizontal"> 

<div class="form-group m-t-lg"> 


<div class="col-sm-12 media m-t-none"> 

<div class="pull-left text-center media-lg thumb-lg padder-v"><?php if($user->user_pic == "profile_pics.jpg"){ ?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive profile-pic" >
            <?php }else{?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($user->id."/".$user->user_pic);?>" class="img-responsive profile-pic" >
          <?php }?>
</div> 
<br/>
<div class="space2"></div>
 <div class="media-body"> 
<input type="file" name="image" title="Change" class="btn btn-sm btn-info m-b-sm">
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
</div>
</div> 
</div> 

<div class="form-group"> 

<div class="col-sm-12 "><button class="btn btn-primary" name="submit" type="submit">Upload Image</button> 
</div> 
</div> 
</form>



<div class="arrow-up-white animated fadeInUp"></div>
 </div>

</div>




</div>




<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>