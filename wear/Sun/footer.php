

<!-- BASE URl -->

<input type="hidden" id="BaseUrl" value="<?php echo htmlentities(BASE_URL);?>" />
<div class="space3"></div>
<div class="bg-footer padding2">
  

      <div class="container wrapper">
                <div class="space4"></div>
          <div class="col-lg-4 col-md-4">
            <h4 class="gray">Location</h4>
            <div class="clearfix"></div>
            <p class="gray">We are Loacted At</p>
          </div>
          <div class="col-lg-4 col-md-4">
                       <h4 class="gray">Links</h4>
            <div class="clearfix"></div>
            <p>Maecenas ipsum dolor sit amet, consectetur adipiscing elit. Nam feugiat, libero non elementum aliquam.</p>
          </div>
          <div class="col-lg-4 col-md-4">
            <h4 class="gray">Credits</h4>
            <div class="clearfix"></div>
            <p>Maecenas ipsum dolor sit amet, consectetur adipiscing elit. Nam feugiat, libero non elementum aliquam.</p>
          </div>

          <div class="space4"></div>


      </div>
   <div class="space4"></div>

</div>
   <div id="border" class="grunge">
    <div id="border-top"></div>
    <div id="border-body"></div>
  </div>

<!-- Session Messages -->

<?php if(!empty($sessionmessage)){ ?>
<div class="space2"></div>
<h3 class="animated back-anole fadeInUp slow text-center text-capi lato-light"><?php echo $sessionmessage;?></h3>

<?php }?>


<!-- JS -->

 <script src="<?php echo htmlentities($wear->get_js());?>jquery-2.0.3.min.js" type="text/javascript"></script>
 <script src="<?php echo htmlentities($wear->get_js());?>jquery.easing.1.3.js" type="text/javascript"></script>
 <script src="<?php echo htmlentities($wear->get_js());?>bootstrap.min.js" type="text/javascript"></script>
 <script src="<?php echo htmlentities($wear->get_js());?>jquery.fitvids.js"></script>
 <script src="<?php echo htmlentities($wear->get_js());?>jquery.flexslider-min.js"></script>

 <script src="<?php echo htmlentities($wear->get_js());?>app.js" type="text/javascript"></script>

 <!-- Important Files Loaded  -->

 <?php echo editing_core(); ?>
 <?php if(get_editing_mode()=="true" && $session->is_logged_in()){ echo get_edit_panel(); echo get_edit_upload_form(); } ?>
 
 


</body>
</html>