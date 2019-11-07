
<?php global $wear; global $session; global $sessionmessage; ; global $SiteDB;?>

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

  <link href="<?php echo htmlentities($wear->get_css());?>members.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>base.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>animations.css" media="screen" rel="stylesheet" type="text/css" />

  <!-- Fonts -->

  <link href="<?php echo htmlentities($wear->get_css());?>font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>lato.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>dosis.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo htmlentities($wear->get_css());?>flat-ui.css" media="screen" rel="stylesheet" type="text/css" />

  <!-- Others -->
  <link href="<?php echo htmlentities($wear->get_css());?>jquery.sidr.dark.css" media="screen" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo htmlentities($wear->get_css());?>c3.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo htmlentities($wear->get_css());?>jquery.circliful.css"/>
 

</head>
<body>

    <!-- Wrapper - centered -->
<div class="space5"></div>
<div class="space2"></div>
<div class="relative-position wrapper padding4">

 
<h3 class="lato-bold padding-left3 text-size-38 text-capi block"><img class="" width="60px" src="<?php echo htmlentities($wear->get_image());?>logo.fw.png"/>  &nbsp; 
 <?php echo htmlentities(get_school_name_by_id($session->user_id));?></h3>
   
</div>


<div id="sidr">
  <!-- Your content -->
  <ul>
    <li class="active"><a href="<?php echo htmlentities(BASE_URL)?>users/dashboard">Dashboard</a></li>

    <?php if(get_user_level($session->user_id) == "Top Manager" || get_user_level($session->user_id) == "Developer"){?>

    <li ><a href="<?php echo htmlentities(BASE_URL)?>schools/settings/<?php echo htmlentities(get_school_id_user($session->user_id));?>">Settings</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>programs/">Programs </a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL)?>courses/">Courses</a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL)?>users/manage/">Manage Access</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>lecturers/">Lecturers</a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL)?>students/">Students</a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL);?>messages/externalMessages/">Messages</a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL);?>messages/userSupport/">Support</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>students/failed">Courses Failed</a></li>

    <?php }elseif(get_user_level($session->user_id) =="Editor"){?>
    


    <?php }elseif(get_user_level($session->user_id) =="Lecturer"){?>

     <li><a href="<?php echo htmlentities(BASE_URL)?>messages/support">Make Report</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>messages/inbox/<?php echo htmlentities($session->user_id);?>">Inbox</a></li>


    <?php }elseif(get_user_level($session->user_id) =="Student"){?>

    <li ><a href="<?php echo htmlentities(BASE_URL)?>students/performance/<?php echo htmlentities($session->user_id);?>">Perfomance Data</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>students/checkResults/<?php echo htmlentities($session->user_id);?>">Check Results </a></li>    
    <li><a href="<?php echo htmlentities(BASE_URL)?>messages/support">Make Report</a></li>
    <li><a href="<?php echo htmlentities(BASE_URL)?>messages/inbox/<?php echo htmlentities($session->user_id);?>">Inbox</a></li>


    <?php }else{ ?>


    <?php }?>
    


    <li><a href="<?php echo htmlentities(BASE_URL)?>users/editPassword/<?php echo htmlentities($session->user_id);?>">Change Password</a></li>
    <li ><a href="<?php echo htmlentities(BASE_URL)?>users/uploadImage/<?php echo htmlentities($session->user_id);?>">Upload Image</a></li>
    <li><a class="menu-slide2" href="<?php echo htmlentities(BASE_URL)?>app/logout">Logout</a></li>
    <li><a id="menu2" href="#sidr" class="menu-slide2">Close Menu</a></li>

  </ul>

</div>

<div class="bottom-notice animated fadeIn">
    
    <a id="menu" href="#sidr" class="menu-slide"></a>
    <a class=" pull-right animated fadeInRight note-top">

       <span class="pull-right"> <?php if(get_member_pics($session->user_id) == "profile_pics.jpg"){ ?>
           <img width="60px" data-title="<?php echo htmlentities(get_user_name_by_id($session->user_id));?> " data-placement="bottom" data-toggle="tooltip" src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive img-circle pull-left " >
            <?php }else{?>
            <img width="60px" data-title="<?php echo htmlentities(get_user_name_by_id($session->user_id));?> " data-placement="bottom" data-toggle="tooltip" src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($session->user_id."/profile_pic.jpg");?>" class="img-responsive" >
          <?php }?></span>

   </a>
       <?php if(get_user_level($session->user_id) == "Editor" || get_user_level($session->user_id) == "Top Manager" || get_user_level($session->user_id) == "Developer"){?>
   <a class="pull-right animated fadeInRight" href="<?php echo htmlentities(BASE_URL);?>messages/userSupport">
             

            
           <span class="white bg-yellow text-center padding2 note-top" data-title="All Support Tickets " data-placement="bottom" data-toggle="tooltip">
           <?php echo htmlentities(get_support_count());?></span>
          

   </a>
   <a class="pull-right animated fadeInRight " href="<?php echo htmlentities(BASE_URL);?>students">
     <span class="text-center padding2 white bg-primary  note-top" data-title="All Students" data-placement="bottom" data-toggle="tooltip">
     <?php echo htmlentities(get_students_count());?></span>
   </a>


           <?php }?>

</div>


<div class="relative-position wrapper padding4 line bg-white">


<section class="">

<div class=""> 
                <!--=======intro=======-->
<?php $nonce = create_csrf(); ?>
<?php $user = get_user($id);?>

     <span class="text-center"> <?php if(get_member_pics($session->user_id) == "profile_pics.jpg"){ ?>
           <img width="140px" src="<?php echo htmlentities(BASE_URL);?>assets/images/default/profile_pics.jpg" class="img-responsive img-circle center" >
            <?php }else{?>
            <img width="140px" src="<?php echo htmlentities(BASE_URL);?>assets/images/users/<?php echo 
            htmlentities($session->user_id."/profile_pic.jpg");?>" class="img-responsive img-circle center" >
          <?php }?></span><br/>

    <h1 class="text-capi lato-light text-center super3">Performance - <?php echo htmlentities($user->first_name . " " .$user->last_name);?></h1>
    <p class="text-center lato-regular text-size-18">Select A Level To View Performance And Remarks </p>

    <div class="space4"></div>
    
    <div class="space3"></div>

<div id="chart" class="col-lg-12 col-md-12 col-sm-12 padding2" style="height:400px"></div>
<div class="space3"></div>
    <h3 class="padding1 lato-light text-capi text-center">Level Perfomance Graph : Shows Students Performance From Level To Level</h3>


<div class="space2"></div>
<div class="line-top"></div>
<div class="space3"></div>

<div class="space3"></div>

<div class="col-lg-12 col-md-12 col-sm-12 animated fadeIn">
<?php $names="";$score="";?>
<?php $level = get_student_level_by_user_id($id); if(!empty($level)){ ?>
<?php for($i= 1; $i<=$level; $i++){?>
<div class="col-lg-3 col-md-3 col-sm-3 ">
<div class="round-tab round-tab-white ">
<?php  $names .= "'" ."Level ". $i ."'," ;  $score .= get_over_term_perf($id,$i) .","; ?>
    <a href="<?php echo htmlentities(BASE_URL);?>students/performanceData/<?php echo htmlentities($i); ?>/<?php echo htmlentities($id); ?>">
    <img class="center img-responsive"  src="<?php echo htmlentities($wear->get_image());?>ok.png"/>
    </a>

 </div>
 <div class="space1"></div>
 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue">Level <?php echo htmlentities($i); ?></h3>
</div>
<?php }?>
<?php }else{ ?>

 <h3 class="text-center text-capi lato-light text-size-22 color-dark-blue"> No Performance Data</h3>
 
<?php }?>
<div class="space4"></div>



</div>





<!-- BASE URl -->

<input type="hidden" id="BaseUrl" value="<?php echo htmlentities(BASE_URL);?>" />
<div class="space4"></div>
<div class="space4"></div>

</div>
</section>
</div>
<!-- Session Messages -->
<div class="space4"></div>
<?php if(!empty($sessionmessage)){ ?>

<div class="space2"></div>
<h3 class="animated back-anole fadeInUp slow text-center text-capi lato-light"><?php echo $sessionmessage;?></h3>

<?php }?>


<!-- JS -->

<script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>sun.js" ></script>
<script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.sidr.min.js" ></script>
<script  type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>d3.min.js"></script> 
<script  type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>c3.min.js"></script> 
<script  type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>members.js"></script> 
<script  type="text/javascript" src="<?php echo htmlentities($wear->get_js());?>jquery.circliful.min.js"></script>


 <script type="text/javascript">

$('#over').circliful();
var chart = c3.generate({
    data: {
        x : 'x',
        columns: [
            ['x', <?php echo $names;?>],
            ['Levels',<?php echo $score;?>]
        ],
        groups: [
            ['download', 'loading']
        ],
        type: 'spline'
    },
    axis: {
        x: {
            type: 'categorized' // this needed to load string x value
        }
    }
});

    </script>

 <!-- Important Files Loaded  -->

 
 


</body>
</html>