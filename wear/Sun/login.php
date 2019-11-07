<?php include("header.php");?>

    <!-- Wrapper - centered -->
    <?php $nonce = create_csrf(); ?>


<div class="space4"></div>


<div class="space2"></div>



<div class="relative-wrap">
  
<div class="col-lg-4">


</div>
<div class="col-lg-4 padding6">
<div class="padding2 bg-white trans-7">
<img class="center img-responsive" src="<?php echo htmlentities($wear->get_image());?>logo.fw.png">
<div class="space2"></div>

   <div id="body">
      <div id="head">
        <h2 class="amble text-capi text-center">Enter Credentials</h2>
        <br class="clear">
      </div>
      <form id="alt-lg-form" method="post" action="<?php echo htmlentities(BASE_URL)?>users/login">
        <div id="middle">
        <div class="form-group"> 
                <input type="text" name="email"  class="bg-focus form-control" placeholder="Email" value="">
                <input class="col-lg-12" name="csrf_token" type="hidden" value="<?php echo htmlentities($nonce);?>" />

        </div>
        <div class="form-group"> 
                <input type="password" name="password"  class="bg-focus form-control" placeholder="Password">
  
                
        </div>
        </div>
        <div id="bottom">
      
          <button type="submit" id="lg-submit" name="submit" class="button inset submit padding1">LOGIN</button>
          <br class="clear">
        </div>
      </form>
    </div>
</div>

</div>

<div class="col-lg-1"></div>
</div>

<div class="space4"></div>
<div class="space5"></div>
<div class="space4"></div>





<?php include("footer.php")?>
