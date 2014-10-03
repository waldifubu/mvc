<?php
# Main Controller
namespace Core;

use Core\View;
use Core\Model;

class Controller
{
    public $view;
    public $model;

	function __construct()
	{	        
		$this->view = new View();
	}
	
	public function loadModel($name, $modelPath)
	{	
        $class = '\Model\\'. $name . '_Model';
        $this->model = new $class();
	}	
	
}
