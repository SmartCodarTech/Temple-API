
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     
 

<!-- .vbox --> <section id="content"> <div class="space4"></div>
<div class="space4"></div>

  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center lead"><?php echo $sessionmessage;?></header>
<div class="space4"></div>
<?php }?>

     <?php $nonce = create_csrf(); ?>

 <section class="wrapper padding4"> 
<div class="space4"></div>
<form action="<?php echo htmlentities(BASE_URL)?>users/newUser/" method="POST" class="form-horizontal"> 


<div class="form-group"> 
<label class="col-sm-3 control-label">First Name
</label> 

<div class="col-sm-4"> 
<input type="text" name="first_name" placeholder="First Name" class="bg-focus form-control" data-required="true"> 
<input class="span12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />
            </div>
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">last Name
</label> 
<div class="col-sm-4"> 
<input type="text" name="last_name" placeholder="Last Name" class="bg-focus form-control" data-required="true"> 

            </div>

</div>


<div class="form-group"> 
<label class="col-sm-3 control-label">Email
</label> 

<div class="col-sm-4"> 
<input type="email" name="email" placeholder="Email" class="bg-focus form-control" data-required="true"> 

            </div>
</div> 
</div> 

<div class="form-group"> 
<label class="col-sm-3 control-label">Mobile Number
</label> 
<div class="col-sm-4"> 
<input type="text" name="tel_number" placeholder="Mobile Number" class="bg-focus form-control" data-required="true"> 

            </div>

</div>
<div class="form-group"> 
<label class="col-sm-3 control-label">User Type
</label> 
<div class="col-sm-4"> 
<div class="btn-group m-r m-b"> <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> 

<span class="dropdown-label">Select User Level
</span> 

<span class="caret">
</span> </button> 
<ul class="dropdown-menu dropdown-select"> 
<li class="active"><a href="#">
<input type="radio" name="user_type" checked="" value="2">Member</a></li> 
<li><a href="#">
<input type="radio" name="user_type" value="3">Asset Manager</a></li> 
<li><a href="#">
<input type="radio" name="user_type" value="5">Editor</a></li> 
<li><a href="#">
<input type="radio" name="user_type" value="10">Top Manager</a></li>
</ul> 
</div>
</div> 
</div>
<div class="form-group"> 

<div class="col-sm-4 col-sm-offset-3"><button class="btn btn-primary" name="submit" type="submit">Add User</button> 
</div> 
</div> 
</form>

<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
