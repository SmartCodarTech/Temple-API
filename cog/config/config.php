<?php 


defined('ENV') ? null : define("ENV" , "dev");

/*==== Deafualt Controller =====*/
$config['default_controller'] = 'app';



/*==== Error Controller =====*/
$config['error_controller'] = 'error'; 


/*==== Contants =====*/ 

if(ENV === "dev"){

/*==== Base Site Url =====*/

$config['base_url'] = ''; 

defined('SITE_NAME') ? null : define("SITE_NAME" , "Project");
defined('DB_SERVER') ? null : define("DB_SERVER" , "localhost") ;
defined('DB_USER')   ? null : define("DB_USER" , "root");
defined('DB_PASS')   ? null : define("DB_PASS" , "");
defined('DB_NAME')   ? null : define("DB_NAME" , "temple_db");
defined('DB_PORT')   ? null : define("DB_PORT" , "3306");

}else{

$config['base_url'] = ''; 

defined('SITE_NAME') ? null : define("SITE_NAME" , "Perez College");
defined('DB_SERVER') ? null : define("DB_SERVER" , "127.0.0.1") ;
defined('DB_USER')   ? null : define("DB_USER" , "root");
defined('DB_PASS')   ? null : define("DB_PASS" , "");
defined('DB_NAME')   ? null : define("DB_NAME" , "temple_db");
defined('DB_PORT')   ? null : define("DB_PORT" , "3306");


}


date_default_timezone_set('UTC');

/*==== Ini File Settings =====*/
if (!ini_get('display_errors')) {
    ini_set('display_errors', '0');
}

