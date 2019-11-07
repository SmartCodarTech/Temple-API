<?php

//-----------General Url Functions-------------#

function redirect_to($location = NULL) 
{

  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }

}

function check_referer() 
{
  
  if (strpos($_SERVER['HTTP_REFERER'], BASE_URL) !== 0) {
    die("Do not call this script manually or from an external source.");
  }

}

//-----------String Functions-------------#

function get_extension($file_name)
{

  $ext = explode('.', $file_name);
  $ext = array_pop($ext);
  return strtolower($ext);

}

function remove_underscore($limiter, $string) 
{
  
  $name = explode($limiter, $string);
  $title = "";
  foreach ($name as $n) {
    $title.= " " . $n;
  }
  return $title;

}

function concatenate($elements, $delimiter = ', ', $finalDelimiter = ' and ') {

  $lastElement = array_pop($elements);
  return join($delimiter, $elements) . $finalDelimiter . $lastElement;

}

//-----------Desire Head Functions-------------#


//-----------Security Functions-------------#

function create_csrf() 
{

  global $database;
  $csrf = new Engine\Core\Csrf($database);
  $csrf->proccess = "Login";
  $csrf->life = 10;
  return $csrf->csrfkey();

}

function login_protect() 
{
  
  global $session;
  if ($session->is_logged_in()) {
    
    redirect_to(BASE_URL . "users/profile/" . $session->user_id);

  }
}

function generate_salt() 
{
  $rndstring = "";
  $length = 64;
  $a = "";
  $b = "";
  $template = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  settype($length, "integer");
  settype($rndstring, "string");
  settype($a, "integer");
  settype($b, "integer");
  
  for ($a = 0; $a <= $length; $a++) {
    $b = rand(0, strlen($template) - 1);
    $rndstring.= $template[$b];
  }
  
  return $rndstring;
}

function genenrate_password($salt, $pass) 
{
  $password_hash = '';
  
  $mysalt = $salt;
  $password_hash = hash('SHA256', "-" . $mysalt . "-" . $pass . "-");
  
  return $password_hash;
}

//----------- Gear Functions-------------#

function get_gear_autoload($name) 
{
  global $database;
  require_once (APP_DIR . strtolower($name) . "/helpers/loader.php");
}

//------Component Nav----------#

function get_blog_nav() 
{
  
  global $wear;
  $instal_gears = Parser::getParam(
                          "gears", 
                          "extra", 
                          CONF_DIR . 
                          "config/gears.ini"
                          );

  $extra_gears = explode(",", $instal_gears);
  
  if (!empty($extra_gears) && in_array("blog", $extra_gears)) {
    
    include_once (WEAR_DIR . $wear->back . "/blog/nav.php");
  }
}

function get_notify_nav() 
{
  
  global $wear;
  $instal_gears = Parser::getParam(
                          "gears", 
                          "extra", 
                          CONF_DIR . 
                          "config/gears.ini"
                          );

  $extra_gears = explode(",", $instal_gears);
  
  if (!empty($extra_gears) && in_array("notify", $extra_gears)) {
    
    include_once (WEAR_DIR . $wear->back . "/notify/nav.php");
  }
}

//-----------Ulitity Functions-------------#

function convert_time($time, $func) 
{
  
  if ($func == 1) {
    
    return date("d M Y", strtotime($time));
  } elseif ($func == 2) {
    
    return date("d M Y ", strtotime($time));
  }
}

function ago($tm, $rcs = 0) 
{
  $cur_tm = time();
  $dif = $cur_tm - $tm;
  $pds = [
           'second', 
           'minute', 
           'hour', 
           'day', 
           'week', 
           'month', 
           'year', 
           'decade'
           ];

  $lngh = [
            1, 
            60, 
            3600, 
            86400, 
            604800, 
            2630880, 
            31570560, 
            315705600
            ];
  for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--);
  if ($v < 0) $v = 0;
  $_tm = $cur_tm - ($dif % $lngh[$v]);
  
  $no = floor($no);
  if ($no <> 1) $pds[$v].= 's';
  $x = sprintf("%d %s ", $no, $pds[$v]);
  if (($rcs == 1) && ($v >= 1) && (($cur_tm - $_tm) > 0)) $x.= time_ago($_tm);
  return $x;
}

//----------- General User Permissions-------------#

function user_permissions() 
{
  global $session;
  
  if (get_user_level($session->user_id) == "Member") {
    
    redirect_to(BASE_URL);
  }
}

function do_login() 
{
  global $session;
  
  if (!$session->is_logged_in()) {
    
    redirect_to(BASE_URL);
  }
}

//-----------Check User Level-------------#

function get_user_level($id) 
{
  
  global $database;
  
  $level = $database->row(
                      "SELECT * FROM users WHERE id=:id", 
                      array("id" => $id)
                      );

  $status = $level['user_type'];
  
  switch ($status) {
    case 50:
      return "Developer";
    case 10:
      return "Top Manager";
    case 5:
      return "Editor";
    case 4:
      return "Gurdian";
    case 3:
      return "Lecturer";
    case 2:
      return "Student";
    default:
      return "Not A Member";
  }
}

//-----------Admin User Permissions-------------#

function admin_levels($con) {
  
  global $session;
  
  if ($con == "Top Manager") {
    
    if (get_user_level($session->user_id) == "Student" || 
        get_user_level($session->user_id) == "Editor" || 
        get_user_level($session->user_id) == "Lecturer") {
      
      if (get_user_level($session->user_id) == "Lecturer" || 
          get_user_level($session->user_id) == "Editor") {
        
        $session->message("You Are Not Allowed To View This Page");
        redirect_to(BASE_URL . "users/dashboard");

      } else {

        redirect_to(BASE_URL. "users/dashboard");

      }
    }
  } elseif ($con == "Editor") {
    
    if (get_user_level($session->user_id) == "Student" || 
        get_user_level($session->user_id) == "Lecturer") {
      
      if (get_user_level($session->user_id) == "Lecturer") {
        $session->message("You Are Not Allowed To View This Page");
        redirect_to(BASE_URL . "users/dashboard");
      } else {
        
        redirect_to(BASE_URL . "users/dashboard");
      }
    }
  } else {
    
    if (get_user_level($session->user_id) == "Student") {
      
      redirect_to(BASE_URL . "users/dashboard");
    }
  }
}

function is_dev($id) {
  
  global $database;
  $level = $database->row(
                          "SELECT * FROM users WHERE id=:id", 
                          array("id" => $id)
                          );

  $status = $fetch['user_type'];
  
  if ($status == 50) {
    
    return true;
  } else {
    
    return flase;
  }
}

function is_admin($id) {
  global $database;
  $level = $database->row(
                          "SELECT * FROM users WHERE id=:id", 
                          array("id" => $id)
                          );
  $status = $fetch['user_type'];
  
  if ($status == 10) {
    
    return true;
  } else {
    
    return false;
  }
}
