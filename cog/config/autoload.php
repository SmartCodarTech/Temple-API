<?php

//autoload some classes that are essential

/*==== Core Files =====*/
require_once(CORE_DIR . "csrf.php");


/*==== Helper Files =====*/
require_once(HELP_DIR .  "resize.php");
require_once(HELP_DIR .  "arrays.php");
require_once(HELP_DIR .  "strings.php");
require_once(HELP_DIR .  "parser.php");
require_once(HELP_DIR .  "inputValidator.php");
require_once(HELP_DIR .  "email.php");
require_once(HELP_DIR .  'FlintstoneDB.php');
require_once(HELP_DIR .  'Flintstone.php');
require_once(HELP_DIR .  'FlintstoneException.php');
require_once(HELP_DIR .  "wearDB.php");


/*==== Plugs Includes ========*/
require_once (PLUG_DIR ."htmlpurifier/HTMLPurifier.auto.php");

/*==== Gears Includes Required=====*/

$gears = Parser::getParam("gears","required",CONF_DIR."config/gears.ini");
if(!empty($gears)){
$required_gears = explode(",", $gears);

 if(!empty($required_gears)){

 	foreach ($required_gears as $gear) {

        get_gear_autoload($gear);
 		
 	}


 }

}
 /*==== Load Dynamic Gear Files =====*/

 $instal_gears = Parser::getParam("gears","extra",CONF_DIR."config/gears.ini");

if(!empty($instal_gears)){
$extra_gears = explode(",", $instal_gears);

 if(!empty($extra_gears)){

 	foreach ($extra_gears as $gear) {

        get_gear_autoload($gear);
 		
 	}


 }
}