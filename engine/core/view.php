<?php

namespace Engine\Core;

class View {

	private $pageVars = [];
	private $template;

	public function __construct($template)
	{
		$this->template = WEAR_DIR. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require_once($this->template);
		echo ob_get_clean();
	}
    
}

?>