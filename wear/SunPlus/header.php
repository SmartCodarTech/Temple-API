
<?php global $wear; global $session; global $sessionmessage;?>

<!DOCTYPE html>
<html lang="en">

<head> 
<meta charset="utf-8"> 
<title><?php echo htmlentities($page);?></title> 
<meta name="description" content="Central Proccessing. Anole Sun"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 

<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>sun-app.css"> 

<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>font.css" cache="false"> 
<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>editor.css" cache="false"> 
<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>bootstrap-wysihtml5-0.0.2.css" cache="false"> 
<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>video-js.min.css" cache="false"> 
<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>wysiwyg-color.css" >

<link rel="stylesheet" href="<?php echo htmlentities($wear->get_cssAdmin());?>lato.css" cache="false"> 
<!--[if lt IE 9]> 
<script src="<?php echo htmlentities($wear->get_jsAdmin());?>ie/respond.min.js" cache="false">
</script> 
<script src="<?php echo htmlentities($wear->get_jsAdmin());?>ie/html5.js" cache="false">
</script> 
<script src="<?php echo htmlentities($wear->get_jsAdmin());?>ie/fix.js" cache="false">
</script> <![endif]-->

<script src="<?php echo htmlentities($wear->get_jsAdmin());?>videojs/video.js" type="text/javascript"></script>
</head>

<body> 
<div class="padding2 user-top lato-light sun ">
<a class="sun" href="<?php echo htmlentities(BASE_URL);?>manage">Bright Starters</a> 
<a class="" href="<?php echo htmlentities(BASE_URL);?>manage"><?php echo htmlentities(get_user_name_by_id($session->user_id));?></a>
<div  class="pull-left top-profile-pic" style="">
 <?php if(get_member_pics($session->user_id) == "profile_pics.jpg"){ ?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg"  class="img-responsive img-circle  profile-pic" >
            <?php }else{?>
            <img src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($session->user_id."/".get_member_pics($session->user_id));?>"  class="img-responsive img-circle profile-pic" >
 <?php }?> 
</div> 

<a class="pull-right" href="<?php echo htmlentities(BASE_URL);?>"><img src="<?php echo htmlentities($wear->get_imageAdmin());?>welcome.fw.png"></a>
</div>

<section class="hbox stretch"> 

<!-- /.aside --> 
  