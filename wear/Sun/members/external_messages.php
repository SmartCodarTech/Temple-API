
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">External Messages</h1>
    <p class="text-center lato-regular text-size-18">Messages From The Contact Us PAge</p>
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

<th width="10%">Name
</th> 
<th width="10%">Subject
</th> 
<th width="10%">Email
</th> 
<th width="40%">Message
<th width="10%">Date
</th> 

<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($messages as $message) { ?>
<tr>
  
    <td><?php echo htmlentities($message->name);?></td>
  <td><?php echo htmlentities($message->subject);?></td>
    <td><?php echo htmlentities($message->email);?></td>
  <td><?php echo htmlentities($message->message);?></td>
  <td><?php echo htmlentities(convert_time($message->created_at,2));?></td>

  <td><a class="btn btn-sm" href="<?php echo htmlentities(BASE_URL ."messages/deleteMessage/" .$message->id)?>"><span class="icon icon-trash icon-2x"></span></a>
  <a data-toggle="modal" href="#reply-<?php echo htmlentities($message->id);?>" class="btn  btn-xs"><i class="icon-reply"></i> Rely Message</a></td>

</tr>

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


</tbody> 
</table> 
</div> 

</section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
