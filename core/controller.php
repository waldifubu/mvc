<?php
/**
 * Main Controller
 */
namespace Core;

use Util\Auth;
use Core\Model;

class Controller
{
    /* @var $view View */
    protected $view;

    /* @var Model */
    protected $model;

    /* @var bool */
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
