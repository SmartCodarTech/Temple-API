<?php

namespace Engine\Core;
use Engine\Core\View;
 
class Controller {

	public function loadModel($comname , $name)
	{
		require_once(APP_DIR . $comname ."/". "/models/".strtolower($name) .'.php');
		$model = new $name;
		return $model;
	}

	public function loadPlugin($comname , $name)
	{
		require_once(APP_DIR . $comname ."/". "/plugins/".strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadHelper($name)
	{
		require_once(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
    
}

