<?php
namespace Controller;

use \Core\Controller;
use \Util\Auth;
use \Core\Session;

class Dashboard extends Controller
{
	public function __construct() 
	{
		parent::__construct();
        Auth::handleLogin();        
		$this->view->js = array('dashboard/js/default.js');
	}
	
	public function index()
	{
        $this->view->title = 'Dashboard';
		$this->view->render('dashboard/index');
	}	
	
	public function xhrInsert()
	{
		$this->model->xhrInsert();		
	}
	
	public function xhrGetListings()
	{
		$this->model->xhrGetListings();
	}
	
	public function xhrDeleteListing()
	{
		$this->model->xhrDeleteListing();
	}
	
    public function logout()
    {
        Session::destroy();
        header('Location: ../login');
    }
}
