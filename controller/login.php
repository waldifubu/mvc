<?php
namespace Controller;

use Core\Controller;

class Login extends Controller
{
	function __construct() 
	{
		parent::__construct();	
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
