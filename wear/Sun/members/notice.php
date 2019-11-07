
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>


    <h1 class="text-capi lato-light text-center super3"> Send A Message To <?php echo htmlentities($user->first_name ." ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">A Notice Or Reply To Support</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-3 col-md-3 col-sm-3 animated fadeIn">




</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Send A Message</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>messages/sendNotice/<?php echo htmlentities($id);?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Subject
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="subject" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Message
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="message" placeholder="" type="text" class="bg-focus form-control" data-required="true"></textarea> 

            </div>
</div> 

 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Send</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
