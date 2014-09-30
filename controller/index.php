<?php
# Controller Index
namespace Controller;

use \Core\Controller;

class Index extends Controller
{
    public $noModel = true;

	function __construct() 
	{
		parent::__construct();					
	}	
	
	public function index() 
	{	    
        $this->view->title = 'Home';
		$this->view->render('index/index');
	}	
	
    //index/details
	public function details() 
	{	    
        $this->view->title = 'Details';
		$this->view->render('index/details');
	}	
}
