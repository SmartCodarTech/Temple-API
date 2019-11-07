

<!-- BASE URl -->

<input type="hidden" id="BaseUrl" value="<?php echo htmlentities(BASE_URL);?>" />
<div class="space4"></div>
<div class="space4"></div>

</div>
</section>
</div>
<!-- Session Messages -->

<?php if(!empty($sessionmessage)){ ?>

<div class="space2"></div>
<h3 class="animated back-anole fadeInUp slow text-center text-capi lato-light"><?php echo $sessionmessage;?></h3>

<?php }?>


<!-- JS -->

 <script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>sun.js" ></script>
 <script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.easing.1.3.js"></script>
 <script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>bootstrap-datepicker.js"></script>
 <script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.sidr.min.js" ></script>

<script type="javascript" type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.peity.min.js"></script> 
<script type="javascript" type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.sparkline.min.js"></script> 
<script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>members.js" ></script>


<?php 
  
 global $wear; include(WEAR_DIR . $wear->front ."/members/plot.php");

 ?>

 <!-- Important Files Loaded  -->

 <?php echo editing_core(); ?>
 <?php if(get_editing_mode()=="true" && $session->is_logged_in()){ echo get_edit_panel(); echo get_edit_upload_form(); } ?>
 
 


</body>
</html>