
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($session->user_id);?>


    <h1 class="text-capi lato-light text-center super3"><?php echo htmlentities($program->name);?></h1>
    <p class="text-center lato-regular text-size-18"></p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Edit Program</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>programs/saveProgram/<?php echo htmlentities($program->id);?>" method="POST" class="form-horizontal"> 


<div class="form-group "> 

<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Name
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="name" value="<?php echo htmlentities($program->name);?>" type="text" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">End Level
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="end_level" value="<?php echo htmlentities($program->end_level);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Years
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="years" value="<?php echo htmlentities($program->years);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Certificate
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<input name="certificate" value="<?php echo htmlentities($program->certificate);?>" type="text"  class="bg-focus form-control" data-required="true"> 
            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Description
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="description" placeholder="" class="bg-focus form-control" data-required="true"> <?php echo htmlentities($program->description);?></textarea>

            </div>
</div> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Remarks
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<textarea name="remarks" placeholder="" class="bg-focus form-control" data-required="true"><?php echo htmlentities($program->remarks);?> </textarea>

            </div>
</div> 

<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Save Program</button> 
</div> 
</div> 
</form>



<div class="arrow-up-info animated fadeInUp"></div>
 </div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
