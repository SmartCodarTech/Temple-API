
<?php global $wear; global $session; global $sessionmessage; global $SiteDB;?>

<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
  <title><?php echo htmlentities($page);?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="yes" name="apple-mobile-web-app-capable" />
    
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo htmlentities($wear->get_js());?>html5shiv.js"></script>
  <script src="<?php echo htmlentities($wear->get_js());?>respond.min.js"></script>
  <![endif]-->


  <!-- Favicon And Apple Touch Icons -->

  <link href="<?php echo htmlentities($wear->get_image());?>favicon.ico" rel="shortcut icon" />
  <link href="<?php echo htmlentities($wear->get_css());?>apple-touch-icon-144-precomposed.html" rel="apple-touch-icon-precomposed" sizes="144x144" />
  <link href="<?php echo htmlentities($wear->get_css());?>apple-touch-icon-114-precomposed.html" rel="apple-touch-icon-precomposed" sizes="114x114" />
  <link href="<?php echo htmlentities($wear->get_css());?>apple-touch-icon-72-precomposed.html"  rel="apple-touch-icon-precomposed" sizes="72x72" />
  <link href="<?php echo htmlentities($wear->get_css());?>apple-touch-icon-57-precomposed.html"  rel="apple-touch-icon-precomposed" /> 


  <!-- Bootstrap -->

  <link href="<?php echo htmlentities($wear->get_css());?>bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>bootstrap.min.css" media="print" rel="stylesheet" type="text/css" />

  <!-- Sun App Base CSS And Main Css -->

  <link href="<?php echo htmlentities($wear->get_css());?>sun-app.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>base.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>animations.css" media="screen" rel="stylesheet" type="text/css" />

  <!-- Fonts -->

  <link href="<?php echo htmlentities($wear->get_css());?>font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>lato.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>dosis.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>flat-ui.css" media="screen" rel="stylesheet" type="text/css" />

  <!-- Others -->
  <link href="<?php echo htmlentities($wear->get_css());?>.css" media="screen" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo htmlentities($wear->get_css());?>supersized.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo htmlentities($wear->get_css());?>supersized.shutter.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo htmlentities($wear->get_js());?>fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
 

</head>
<body>

<div class="padding2">

<div class="wrapper">

<img class="pull-left img-responsive" src="<?php echo htmlentities($wear->get_image());?>logo1.fw.png">

</div>
</div>
