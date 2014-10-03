<?php
# Controller Help
namespace Controller;

use Core\Controller;

class Help extends Controller
{

	function __construct() 
	{
		parent::__construct();		
	}
	
	public function index() 
	{
        $this->view->title = 'Help';
        $model = new \Model\Help_Model();
        $this->view->msg = $model->index();
		$this->view->render('help/index');
	}
	
	public function other($arg = false)
	{				
		$model = new \Model\Help_Model();
		$this->view->msg = $model->bla($arg);
		$this->view->render('help/index');
	}
	
}
