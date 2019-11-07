
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>
<?php $students = get_lecturers_students($id); ?>

 <h1 class="text-capi lato-light text-center super3">Remarks For <?php echo htmlentities($user->first_name . " ". $user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18"><?php echo  htmlentities(get_course_name_by_id($course));?></p>
    <div class="space4"></div>


<div class="space2"></div>
<div class="col-lg-8 col-md-8 col-sm-8 bg-white animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Enter Student's Performance Data, Observations And Advice</h2>

<div class="line-top"></div>
    
<form action="<?php echo htmlentities(BASE_URL);?>lecturers/saveRemarks/<?php echo htmlentities($id);?>/<?php echo htmlentities($course);?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left  text-size-24 lato-light gray">Rate Student (1 - 10)
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="rate" placeholder="Enter Rate Between 1 And 10" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Reason For That Rating
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="reason_for_rate" placeholder="Enter Reason Why You Gave The Rating Above"  class="bg-focus form-control" data-required="true"> </textarea>
            </div>
</div>  

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Remarks
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="remarks" placeholder="Enter Your Remarks About Student For This Course"  class="bg-focus form-control" data-required="true"> </textarea>
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">How Can Student Improve
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="advice" placeholder="Enter The Letter For That Grade Here. eg. B"  class="bg-focus form-control" data-required="true"> </textarea>
            </div>
</div> 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Data</button> 
</div> 
</div> 
</form>

</div>



</div>

<div class="col-lg-4 col-md-4 col-sm-4 bg-primary white  padding3 animated fadeIn">

<h3 class="text-capi text-center lato-light text-size-20 white"> Please Be Blunt Your Rating as it will help the 
student imporve and help them concentrate. Give advice that will specifically help the student
grow and become better. Dont leave any feild blank. Give Accurate infomation since this data will eventually 
be used by you to help the student improve.</h3>
<div class="space4"></div>
<div class="arrow-left-info"></div>

</div>




</div>

<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
