
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content">

 <div class="space4"></div>
<div class="space4"></div>
<?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>


 <?php $nonce = create_csrf(); ?>
 <section class="wrapper padding4"> 


<div class="space2"></div>

<div class="col-lg-12">

 
<?php if(!empty($messages)){ ?>
<?php foreach ($messages as $message) {?>
<div class="col-lg-4 ">
<section class="panel <?php if($message->opened === "0"){?>not-opened<?php }?>"> 
<img   class="img-responsive" data-name="Audio Cover" src="<?php echo htmlentities($wear->get_image());?>message_top.jpg">
<div class="padding3"><?php echo htmlentities($message->message);?></div>

<div class="line"></div>
<br/>

<br/>
<br/>
<h3 class="lato-light text-left  panel-text2"><?php echo htmlentities($message->name);?> - <?php echo htmlentities($message->email);?></h3>
<div class=" absolute-options"> 


<a class="btn btn-icon btn-black"  href="<?php echo htmlentities(BASE_URL);?>messages/deleteMessage/<?php echo htmlentities($message->id);?>">
<img width="15px" src="<?php echo htmlentities($wear->get_image());?>512/trash.png" /></a> 
<a data-toggle="modal" href="#reply-<?php echo htmlentities($message->id);?>" class="btn  btn-xs"><i class="icon-reply"></i> Rely Message</a>

</div>
</div>


<!-- Modal -->
  <div class="modal fade margin-top5" id="reply-<?php echo htmlentities($message->id);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Reply To Message</h4>
        </div>
        <div class="modal-body">
   
      <form action="<?php echo htmlentities(BASE_URL);?>messages/replyMessage/" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Subject
</label> 

<div class="col-sm-8"> 
<input type="text" name="subject" value="Reply To From" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
<input class="span12" name="email" type="hidden" value="<?php echo htmlentities($message->email);?>" />
  </div>
</div> 


<div class="form-group"> 
<label class="col-sm-3 control-label">Messages
</label> 
<div class="col-sm-8"> 
<textarea name="message" class="bg-focus form-control"></textarea>
</div> 
</div>


<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3">  <button class="btn btn-primary" name="submit" type="submit">Reply</button> 
</div> 
</div> 
</form>
</div>
</div>
</div>

</div>

<?php } ?>
</div>

<?php }else{ ?>
              <div class="col-lg-12"><section class="panel"> <h2 class="padding3 lato-light te">No Messages To Read</h2> </section></div>
<?php }?>

<div class="clearfix"></div>

</section>


</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
