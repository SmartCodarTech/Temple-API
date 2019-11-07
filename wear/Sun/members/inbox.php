
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>


    <h1 class="text-capi lato-light text-center super3">Your Messages</h1>
    <p class="text-center lato-regular text-size-18">From Admins</p>
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
<th width="20%">Subject
</th> 
<th width="40%">Message
<th width="20%">Date
</th> 

<th width="20%">Actions
</th> 
</tr> </thead> <tbody> 



<?php foreach ($messages as $message) { ?>
<tr>

  <td><?php echo htmlentities($message->subject);?></td>
  <td><?php echo htmlentities($message->message);?></td>
  <td><?php echo htmlentities(convert_time($message->created_at,2));?></td>
  <td><a class="btn btn-sm" href="<?php echo htmlentities(BASE_URL ."messages/deleteInbox/" .$message->id)?>"><span class="icon icon-trash icon-2x"></span></a></td>

</tr>

<?php } ?>


</tbody> 
</table> 
</div> </section> 
</div>


<div class="arrow-up-yellow animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
