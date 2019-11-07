<?php 

use Engine\Helpers\Flintstone;

 global $wear;

$options = array('dir' => WEAR_DIR .$wear->front ."/data/");

$SiteDB = Flintstone::load('site', $options);
