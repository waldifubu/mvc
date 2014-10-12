<?php
# Main Controller
namespace Core;

use Util\Auth;

class Controller
{
    protected $view;
    protected $model;
    protected $needLogin;

	function __construct()
	{	        
		$this->view = new View();
        if($this->needLogin)
            Auth::handleLogin();
    }
	
	public function loadModel($name, $modelPath)
	{	
        $class = '\Model\\'. $name . '_Model';
        $this->model = new $class();
	}	
	
}
