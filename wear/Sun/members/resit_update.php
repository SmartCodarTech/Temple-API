
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>



    <h1 class="text-capi lato-light text-center super3">Update Exam Records</h1>
    <p class="text-center lato-regular text-size-18"></p>
    <div class="space4"></div>
  <h2 class="lato-regular text-capi"></h2>
 
<div class="space2"></div>

<div class="col-lg-8 col-md-8 col-sm-8 animated fadeIn line-right line-top line-bottom line-left">
<div class="padding3">

<h2 class="lato-regular text-capi">Enter The New Values Below</h2>
<div class="line-top"></div>
<div class="space2"></div>


<div class="col-sm-12 control-label text-capi text-left text-size-24 lato-light gray">

</div> 


    <form action="<?php echo htmlentities(BASE_URL);?>students/saveResit/<?php echo htmlentities($id)?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Score
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="score" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Grade
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="grade" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 


<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Update Records</button> 
</div> 
</div> 
</form>

</div>



</div>

<div class="col-lg-4 col-md-4 col-sm-4 bg-light-blue animated fadeIn">
<div class="space2"></div>

<div class="padding3 ">

<h2 class="white lato-light  text-capi">Notes</h2>
    
<h2 class="white lato-regular text-capi">Please make sure you enter the score and grades in the order
of the courses arranged above. Seperated With A Comma</h2>
<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
