<?php

/*==== Contants =====*/
defined('DS')        ? null : define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_DIR')  ? null : define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
defined('APP_DIR')   ? null : define('APP_DIR', ROOT_DIR .'gears/');
defined('CONF_DIR')  ? null : define('CONF_DIR', ROOT_DIR .'cog/');
defined('SYS_DIR')   ? null : define('SYS_DIR', ROOT_DIR .'engine/');
defined('CORE_DIR')  ? null : define('CORE_DIR', ROOT_DIR .'engine/core/');
defined('WEAR_DIR')  ? null : define('WEAR_DIR', ROOT_DIR .'wear/');
defined('PLUG_DIR')   ? null : define('PLUG_DIR', ROOT_DIR .'plugs/');
defined('ASSET_DIR') ? null : define('ASSET_DIR', ROOT_DIR .'assets/');
defined('HELP_DIR')  ? null : define('HELP_DIR', ROOT_DIR .'engine/helpers/');

/*==== Config Files =====*/
require_once(CONF_DIR .'config/config.php');

/*==== Important Functions =====*/
require_once(CORE_DIR .'core.php');

/*==== Model : Database =====*/
require_once(CORE_DIR . 'model.php');

/*==== Session Class =====*/
require_once(CORE_DIR  . 'session.php');

/*==== View =====*/
require_once(CORE_DIR .'view.php');

/*==== Controllers =====*/
require_once(CORE_DIR .'controller.php');

/*==== Router =====*/
require_once(CORE_DIR .'router.php');

/*==== Wear: Template Handling =====*/
require_once(CORE_DIR . "wear.php");

/*==== Other Important Files =====*/
require_once(CONF_DIR . "config/autoload.php");


/*==== Wear Specific Functions =====*/
global $wear;
require_once(WEAR_DIR . $wear->front. "/functions.php");

/*==== Set Base Url =====*/
global $config;
defined('BASE_URL') ? null : define('BASE_URL', $config['base_url']);

/*====Load Router =====*/
sun();

?>
