
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php if(!empty($user)){?> 
<?php $nonce = create_csrf(); ?>

<section id="content"> 
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>

<?php }?>
<section class="vbox"> 

<header class="header bg-white b-b"> 

<p><?php if($user->id == $session->user_id){ echo htmlentities("Welcome ");} ?>
        <?php  echo htmlentities($user->first_name);?>
        <small class="light"><?php  echo htmlentities($user->last_name);?></small></p> </header> <section class="scrollable"> <section class="hbox stretch"> <aside class="aside-lg bg-light lter b-r"> <section class="vbox"> <section class="scrollable"> 

<div class="wrapper"> 

<div class="clearfix m-b"> 


<?php include("profile_head.php");?> 
<aside class="bg-white"> <section class="vbox"> 

 <section class="scrollable"> 




<div class="tab-content"> 

<div id="activity" class="tab-pane active padding3"> 
<div class="space2"></div>
<h2 class="lato-light ">Your Daily Inspirational Message</h2>

<h3 class="lead lato-light">Your Daily Inspirational Message</h3>

</div> 
 
</div> </section> </section> </aside> <aside class="col-lg-4 b-l"> <section class="vbox"> <section class="scrollable"> 

<div class="wrapper"> <section class="panel"> 

<form id="addStausForm"> 
<input class="span8" name="csrf_token" id="csrf" type="hidden" value="<?php echo htmlentities($nonce);?>" />  
<textarea id="status" name="status"  placeholder="Write A Testimony, Or Your Imperssions On Sermons, And Other Positive Things" rows="5" class="form-control no-border">
</textarea> 
 <footer class="panel-footer bg-light lter"> <button type="submit" name="submit" class="btn btn-info pull-right btn-sm">POST</button> 
</form>
<ul class="nav nav-pills nav-sm"> 

</ul> </footer> </section> <section class="panel"> <h4 class="font-thin padder">Latest Comments</h4> 
<ul class="list-group">
 <?php $comments = get_all_user_comments($user->id); if(!empty($comments)){foreach ($comments as $comment) {?> 
<li class="list-group-item"> 

<p><?php echo htmlentities($comment->comment); ?></p> 
 <small class="block text-muted"><i class="icon-time"></i>2<?php echo htmlentities(convert_time($comment->created_at, 2));?></small> </li> 
<?php }}else{?>
          <h4 class="light lead text-center padding3 lato-light">This User Has Made No Comments</h4>
          <?php }?>
</ul> </section> 
<section class="panel clearfix bg-primary lter"> 

<div class="panel-body">

<h3 class=" text-center lato-light text-capi"><?php echo htmlentities(get_last_impression($user->id));?></h3>
</div> </section> 
</div> </section> </section> </aside> </section> </section> </section> <a data-target="body" data-toggle="class:nav-off-screen" class="hide nav-off-screen-block" href="#"></a> </section>

<?php }else{?>


<?php }?>
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
