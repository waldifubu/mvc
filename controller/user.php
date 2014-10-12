<?php
namespace Controller;

use Core\Controller;

class User extends Controller
{
    public $haveModel = true;
    public $needLogin = true;

	public function __construct() 
	{
		parent::__construct();
	}
	
	public function index()
	{
        $this->view->title = 'Users';
		$this->view->userList = $this->model->userList();
		$this->view->render('user/index');
	}
	
	public function create()
	{		       
		$data = [
		    'login' => $_POST['login'],
		    'password' => $_POST['password'],
		    'role' => $_POST['role']
        ];

		$this->model->create($data);
		header('location: ' . URL . 'user');
	}
	
	public function edit($userid)
    {
        $this->view->title = 'Dashboard';
        $result = $this->model->userSingleList($userid);
		$this->view->user = $result[0];
        $this->view->render('user/edit');
	}
	
	public function editSave($userid)
	{
		$data = [
		    'userid' => $userid,
		    'login' => $_POST['login'],
		    'password' => $_POST['password'],
		    'role' => $_POST['role']
        ];
		$this->model->editSave($data);
		
		header('location: ' . URL . 'user');		
	}
	
	public function delete($id)
	{
		$this->model->delete($id);
		header('location: ' . URL . 'user');
	}
}
