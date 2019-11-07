
<?php include("header.php");?>
     
 
  <section id="content"> 
<div class="space4"></div>
<div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>


 <section class=" wrapper padding4"> 
<div class="col-lg-12 ">
<div class="space2"></div>
<div class="col-lg-4 panel-bg-blue-dark padding4 text-center animated fadeInUp slow">

<a href="<?php echo htmlentities(BASE_URL);?>manage/appInfo"><img width="117px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/cloud.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Application Information</h3>

</div>

<div class="col-lg-4 panel-bg-blue-lighter padding4 text-center animated fadeInUp slow">

<a href="<?php echo htmlentities(BASE_URL);?>messages"><img width="96px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/bubble.png" />
&nbsp;&nbsp;<span class="white padding05 text-size-28 lato-light"><?php echo htmlentities(get_new_messages());?></span></a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Messages</h3>

</div> 


<div class="col-lg-4 animated fadeInDown slow">

<div class="col-lg-12 panel-bg-green padding4 text-center relative ">

<a href="<?php echo htmlentities(BASE_URL);?>users/dashboard/"><img width="84px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/user.png" />
</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Dashboard</h3>

</div>



</div> 
<div class="clearfix"></div>
<div class="col-lg-4 panel-bg-photo text-center animated fadeInUp slow">

<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div><div class="space3"></div>
<div class="space05"></div>

<a href="<?php echo htmlentities(BASE_URL);?>gallery"><h3 class="lato-light text-left panel-text ">
<img width="24px" src="<?php echo htmlentities($wear->get_imageAdmin())?>original/camera.png" /> Sun Gallery</h3></a>
<span class="panel-blob text-size-18 lato-regular"><?php echo htmlentities(count(get_gallery()));?></span>
</div> 

<div class="col-lg-4 panel-bg-green padding4 text-center relative animated fadeInUp">
<div class="space2"></div>
<a href=""><img width="34px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/pen.png" />
&nbsp;&nbsp;<span class="white padding05 text-size-28 lato-light">Editing Mode Off</span></a>
<div class="space3"></div>

<div class="space2"></div>
</div>

<div class="col-lg-4 animated fadeInUp slow">

<div class="col-lg-6 panel-bg-move padding4 text-center relative ">

<a href="<?php echo htmlentities(BASE_URL);?>manage/generalSettings"><img width="84px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/settings.png" />
</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Settings</h3>

</div>

<div class="col-lg-6 panel-bg-blue-dark padding4 text-center relative">

<a href="<?php echo htmlentities(BASE_URL);?>manage/wearSettings"><img width="84px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/lab.png" />
</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Landing Page & Site</h3>

</div>

</div>

<div class="clearfix"></div>


<div class="col-lg-4 panel-bg-blue-lighter padding4 text-center relative animated animated fadeInUp slow">
<a href="<?php echo htmlentities(BASE_URL);?>manage/components"><img width="86px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/params.png" />
&nbsp;&nbsp;<span class="white padding05 text-size-28 lato-light"></span></a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text">Gears Installed</h3>
</div>

<div class="col-lg-4 panel-bg-photo2 text-center animated animated fadeInUp slow">

<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div><div class="space3"></div>
<div class="space05"></div>

<h3 class="lato-light text-left panel-text ">
Current Wear</h3>
<span class="panel-blob text-size-16 lato-regular">SunPlus</span>
</div> 

<div class="col-lg-4 animated fadeInDown">





</div>
<div class="clearfix"></div>

<div class="space4"></div>
<h1 class="text-center heading-text text-capi lato-regular animated fadeInUp">

    Manage Media 

 </h1>
<div class="header-line"></div>
<div class="space4"></div>
<div class="clearfix"></div>

<div class="col-lg-12 ">

<div class="space2"></div>
<div class="col-lg-4 panel-bg-media-audio  padding2 text-center animated fadeInUp ">
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div><div class="space3"></div>
<div class="space05"></div>

<a href="<?php echo htmlentities(BASE_URL);?>media/audio"><h3 class="lato-light text-left panel-text text-capi white">Media Audio</h3></a>
<span class="panel-blob text-size-18 lato-regular"><?php echo htmlentities(count(get_all_audio()));?></span>
</div>


<div class="col-lg-4 panel-bg-move padding5 text-center animated fadeInUp">

<a href="<?php echo htmlentities(BASE_URL);?>media/uploadMedia"><img width="102px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/note.png" />
&nbsp;&nbsp;</a>
<div class="space4"></div>
<h3 class="lato-light text-left panel-text">Upload Media</h3>

</div>
<div class="col-lg-4 panel-bg-media-video  padding2 text-center animated fadeInUp slow">

<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div><div class="space3"></div>
<div class="space05"></div>
<a href="<?php echo htmlentities(BASE_URL);?>media/videos"><h3 class="lato-light text-left panel-text">Media Video</h3></a>
<span class="panel-blob text-size-18 lato-regular"><?php echo htmlentities(count(get_all_video()));?></span>

</div>




<div class="clearfix"></div>
<div class="col-lg-4 panel-bg-media-image padding2 text-center relative fadeInUp slow">

<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div>
<div class="space4"></div><div class="space3"></div>
<div class="space05"></div>
<a href="<?php echo htmlentities(BASE_URL);?>media"><h3 class="lato-light text-left panel-text">Images </h3></a>
<span class="panel-blob text-size-18 lato-regular"><?php echo htmlentities(count(get_all_photos()));?></span>

</div>


</div>


<div class="clearfix"></div>
<?php  get_blog_nav(); ?> 


<div class="clearfix"></div>
<?php  get_notify_nav(); ?> 


<div class="space4"></div>
</section>





<?php include("footer.php")?>
