
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3">Programs</h1>
    <p class="text-center lato-regular text-size-18">Create And Manage Programs You Offer At Your School</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 animated fadeIn">
<div class="col-lg-12 col-md-12 col-sm-12 ">
<div class="round-tab round-tab-white ">

    <a href="<?php echo htmlentities(BASE_URL);?>programs/programList">
    <img class="center img-responsive"  width="80px" height="80px"  src="<?php echo htmlentities($wear->get_image());?>task.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Check All Programs</h3>
</div>



<div class="space4"></div>
<div class="line-top"></div>
<div class="space4"></div>
 <h3 class="text-center text-capi lato-light text-size-22 ">Program Count</h3>
  <div class="space1"></div>
 <h1 class="text-center text-capi lato-light  "><?php echo htmlentities(count(get_programs()));?></h1>

</div>

<div class="col-lg-6 col-md-6 col-sm-6 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Add A New Program</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>programs/addProgram/" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="name" placeholder="" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">End Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="end_level" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Years
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="years" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Certificate
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="certificate" placeholder="" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Description
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="description" placeholder="" class="bg-focus form-control" data-required="true"> </textarea>

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Remarks
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="remarks" placeholder="" class="bg-focus form-control" data-required="true"> </textarea>

            </div>
</div> 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add Program</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
