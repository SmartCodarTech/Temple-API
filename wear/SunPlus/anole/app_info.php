
<?php global $wear; include(WEAR_DIR . $wear->back ."/header.php");?>
     

<section id="content"> <section> 
 <div class="space4"></div>
<div class="clearfix"></div>
 <div class="space4"></div>
  <?php if(!empty($sessionmessage)){ ?>

<header class="animated back-anole fadeInUp slow text-center"><?php echo $sessionmessage;?></header>
<?php }?>


<?php $nonce = create_csrf(); ?>
 <section class=" wrapper padding4"> 
 


<div class="space2"></div>

<div class="col-lg-12">
<div class="col-lg-6 ">
<div class="col-lg-12 panel-bg-blue-dark padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>back/appInfo"><img width="56px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/cloud.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Application Version Info</h3>

</div>
<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix m-b"> 

 <div class="clear text-center"> 

 <p class="padding3 lead gray">This is perfomance analysis and transcript web application for schools to manage
 and monitor their students</p>
 <li class=" line divider"></li>
<h4 class="padding3 lato-bold">This Version Is 1.3 Beta</h4>

 <li class=" line divider"></li>
<h4 class="padding3 lato-bold">Pre Hosted Version Of THe Application</h4>

</div>
</div>
</div>
</div>

<div class="col-lg-6">

<div class="col-lg-12 panel-bg-move padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>back/appInfo"><img width="36px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/data.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">Updates And Support</h3>

</div>

<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix"> 
 <div class="clear text-center">

 <p class="padding3 lead"> Updates Are Free</p>
 <li class=" line divider"></li>
<h4 class="padding3 lato-bold">Email Support With Four Hours Response Limit . More Support Will require a fee. </h4>

 <li class=" line divider"></li>
<h1 class="padding3 lato-bold">Plus Pro</h1>



</div>
</div>

</div>
</div>

<div class="clearfix"></div>
<div class="space2"></div>

<h3 class=" division-text lato-light">Part Of The End User License Agreement</h3>

<div class="space2"></div>
<div class="clearfix"></div>

<div class="col-lg-12">

<div class="col-lg-12 panel-bg-move padding4 text-center animated fadeInUp ">

<a href="<?php echo htmlentities(BASE_URL);?>back/appInfo"><img width="36px" src="<?php echo htmlentities($wear->get_imageAdmin())?>512/data.png" />
&nbsp;&nbsp;</a>
<div class="space3"></div>
<h3 class="lato-light text-left panel-text text-capi white">License Agreement</h3>

</div>
<div class="col-lg-12 bg-white padding4 text-center animated fadeInUp ">
<div class="clearfix m-b"> 

 <div class="clear text-center"> 

 <p class="padding3 lead">3. License Grant <br/>
Subject to the restrictions this License, Bright Starters grants you a non-exclusive, non-transferable, non-sublicensable, limited license to use a pre hosted  single 
copy of the App for one school, college or educational institution  only. Any attempt to use the App other than as permitted by this License will immediately terminate the license.
Except for the rights explicitly granted in this License, Anole Studios retains all right, title and interest (including all intellectual property rights) in the App,
 including the copies of the App hosted for you to use. 
Bright Starters may use third-party software that is subject to open source and/or third-party license terms. You are subject to those terms.



 
</p>
 <li class=" line divider"></li>
<h4 class="padding3 lato-bold"> License Restrictions<br/>
You may not:
• rent, lease, sublicense, sell, assign, loan, or otherwise transfer the App, your copy of the hosted App or any of your rights and obligations under this License;
• remove or destroy any copyright notices or other proprietary markings on the App;
• reverse engineer, decompile, disassemble, modify or adapt the App, merge the App into another program, or create derivative works of the App;
• copy or distribute the App;
• use the App in any unlawful manner, for any unlawful purpose, or in any manner inconsistent with this License.
You may print copies of any user documentation provided in online or electronic form for your personal use.</h4>

 <li class=" line divider"></li>
<h3 class="padding3 lato-bold bg-danger">Termination<br/>
This License will terminate automatically upon the earlier of: (a) your failure to comply with any term of this License (whether or not we inform you of this termination);
 (b) you uploading harmful files to disrupt the proper functioning of the App hosted for you; and (c) if your are using the App(s) in connection with a paid service,
  the end of the time period specified at time of purchase. In addition, Anole Studios may terminate this License at any time, for any reason or no reason. 
If this License terminates, you must stop using the App(s) and file a request for data retrieval, though we are not entirely obligated to retrieve your data.</h3>


</div>
</div>
</div>

</div>

<div class="clearfix"></div>
<div class="space2"></div>



<div class="space2"></div>
<div class="clearfix"></div>
</div>


<div class="clearfix"></div>
<div class="clearfix"></div>

</section> 

<?php global $wear; include(WEAR_DIR . $wear->back ."/footer.php");?>
