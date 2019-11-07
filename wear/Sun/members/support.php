
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3"> Send A Support Ticket</h1>
    <p class="text-center lato-regular text-size-18">Send Us Your Suggestions And Your Problems</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn">
<div class="col-lg-6 col-md-6 col-sm-12 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>messages/inbox/<?php echo htmlentities($session->user_id);?>">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>ok.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Check Your Inbox</h3>
</div>



<div class="space4"></div>




</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Send A Message</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>messages/sendSupport/" method="POST" class="form-horizontal"> 


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
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Select Category
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select The Type Of Message
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 

<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="type"  value="Problem With Account"> Problem With Account</a></li> 
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="type"  value="Suggestion"> Suggestion</a></li> 
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="type"  value="Other"> Other</a></li> 

</ul> 
</div>
</div> 
</div>
 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Send</button> 
</div> 
</div> 
</form>



<div class="arrow-left-info animated fadeInRight"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
