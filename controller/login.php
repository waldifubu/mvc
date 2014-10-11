<?php
namespace Controller;

use Core\Controller;
use Core\View;

class Login extends Controller
{
    public $haveModel = true;

	function __construct() 
	{
        parent::$this->view = new View();
	}
	
	public function index() 
	{				
        $this->view->title = 'Login';
		$this->view->render('login/index');
	}
	
	public function run() 		
	{	
		$this->model->run();
	}
}
