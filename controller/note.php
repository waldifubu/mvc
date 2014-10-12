<?php
namespace Controller;

use Core\Controller;

class Note extends Controller
{
    public $haveModel = true;
    public $needLogin = true;

	public function __construct() 
	{
		parent::__construct();
	}
    
	
    public function index()
	{
        $this->view->title = 'Notes';
		$this->view->noteList = $this->model->noteList();
		$this->view->render('note/index');
	}
    
    
    public function create()
	{        
		$data = [
            'userid' => $_SESSION['userid'],
            'title' => $_POST['title'],            
            'content' => $_POST['content'],
            'date_added' => date('Y-m-d H:i:s')
        ];		
		$this->model->create($data);
		header('location: ' . URL . 'note');
	}
	
    
    public function edit($noteid)
	{
        $this->view->title = 'Edit Note';
        $result = $this->model->noteSingleList($noteid);		
        if (empty($result[0])) {
            die('No note found');
        }
        $this->view->note = $result[0];        
        $this->view->render('note/edit');
	}
    
    
    public function editSave($noteid)
	{
		$data = [
            'noteid' => $noteid,
            'title' => $_POST['title'],            
            'content' => $_POST['content']            
        ];		
		$this->model->editSave($data);
		
		header('location: ' . URL . 'note');		
	}
	
    public function delete($noteid)
	{
		$this->model->delete($noteid);
		header('location: ' . URL . 'note');
	}
}
