
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">School Settings</h1>
    <p class="text-center lato-regular text-size-18">Settings that determine how your app is run</p>
    <div class="space4"></div>


<div class="space2"></div>


<div class="bg-white col-lg-6 col-md-6 col-sm-6 animated fadeIn ">
<div class="padding2">



    <form action="<?php echo htmlentities(BASE_URL);?>schools/saveSchool/<?php echo htmlentities($school->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group"> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="name" value="<?php echo htmlentities($school->name);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">School Ends
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="school_end" value="<?php echo htmlentities($school->school_end);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Academic Year
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="academic_year" value="<?php echo htmlentities($school->academic_year);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div>

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Term End Date
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="term_end_date" data-date-format="yyyy-mm-dd" value="<?php echo htmlentities($school->term_end_date);?>" type="text"  class="datepicker bg-focus form-control" data-required="true"> 
            </div>
</div>

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Settings</button> 
</div> 
</div> 
</form>

 </div>


</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Notes</h2>

<h3 class="white lato-regular text-capi ">School Ends</h3>
<p class="white text-size-16"> School ends is an integer to reperent the last term or semister number. For example
in the universtiy the last term for most undergraduate courses is 8. Hence after spending eight terms in the
the university you graduate. Your system might be different but it follows the same principle. Indicate the last
term for the longest program that you intended to offer at your educational Institution. If you offer two programs that differ in duration, 
indicate the last term of the longer one.</p>



<div class="arrow-left-info animated fadeInRight"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
