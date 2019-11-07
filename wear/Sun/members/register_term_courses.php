
<?php global $wear; include(WEAR_DIR . $wear->front ."/members/header.php");?>
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php 
      
      $user = get_user($session->user_id);
      $stats = get_student_term_stats();
      $terms = get_school_end_by_id();
      $progs = get_programs();

?>



    <h1 class="text-capi lato-light text-center super3">Register Courses For Term</h1>
    <p class="text-center lato-regular text-size-18">Create List Of Courses For This System</p>
    <div class="space4"></div>


<div class="space2"></div>

<div class="col-lg-8 col-md-8 col-sm-8 bg-white animated fadeIn padding2">
<div class="space2"></div>

<h2 class="lato-regular text-capi">Student Course/ Term Statistics</h2>

<div class="line-top"></div>
<div class="space1"></div>

<div class="padding3 col-lg-12">


<h2 class="lato-regular text-capi">Programs</h2>
<?php if(!empty($progs)){?>
<?php foreach($progs as $prog){?>
<div class="space1"></div>
<h2 class="lato-light text-capi"><?php echo htmlentities($prog->name);?></h2><br/>
<h2 class="lato-light text-capi">
<?php for($i= 1;$i <=$terms;$i++){?>
Level <?php echo htmlentities($i)?> - <?php echo htmlentities(get_students_in_term_prog($i,$prog->id));?> &nbsp;&nbsp;

<?php } ?>
</h2>
 <div class="space1"></div>
 <div class="line-top"></div>
<?php }?>
<?php }?>
</div>

<div class="space4"></div>



</div>

<div class="col-lg-4 col-md-4 col-sm-4 bg-light-blue animated fadeIn">
<div class="padding3">

<h2 class="white lato-regular text-capi">Add List OF Courses</h2>
    <form action="<?php echo htmlentities(BASE_URL);?>courses/addTermCourses/" method="POST" class="form-horizontal"> 

<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Select Term
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select The Term To Add
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 

<?php for($i= 1;$i <=$terms;$i++){?>
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="term"  value="<?php echo htmlentities($i)?>"> Level <?php echo htmlentities($i)?></a></li> 
<?php } ?>

</ul> 
</div>
</div> 
</div> 

<input type="hidden" name="csrf_token"  value="<?php echo htmlentities($nonce);?>">
<div class="form-group"> 
<label class="col-sm-6 control-label text-capi text-left text-size-24 lato-light gray">Program
</label> 
<div class="space1"></div>
<div class="col-sm-12"> 
<div class="btn-group m-r m-b"> 
<button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 


<span class="dropdown-label text-capi text-left text-size-24 lato-light gray">Select Program Add From
</span> 
<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<?php foreach($programs as $program){?>
<li ><a href="#" class="text-capi text-left text-size-24 lato-light gray">
<input type="radio" name="program"  value="<?php echo htmlentities($program->id)?>"> <?php echo htmlentities($program->name)?></a></li> 
<?php } ?>
</ul> 
</div>
</div> 
</div>
<div class="space2"></div>
<div class="form-group"> 

<div class="col-sm-4"><button class="btn btn-primary" name="submit" type="submit">Add Courses To List</button> 
</div> 
</div> 
</form>



<div class="arrow-left-info animated fadeInRight"></div>
</div>

</div>




</div>





<?php global $wear; include(WEAR_DIR . $wear->front ."/members/footer.php");?>
