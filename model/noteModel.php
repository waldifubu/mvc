<?php
namespace Model;

use Core\Model;

class NoteModel extends Model
{
	public function __construct()
	{
		parent::__construct();		
	}
	
    
	public function noteList()
	{	
        return $this->db->select('select * from '.NOTES_TAB.' where userid = :userid', 
        array('userid' => $_SESSION['userid']));
	}
    
    
    public function noteSingleList($noteid)
	{        
        return $this->db->select('select * from '.NOTES_TAB.' where userid=:userid and noteid=:noteid',
        array(':noteid'=>$noteid, ':userid'=>$_SESSION['userid']));
	}

	
	public function create($data)    
	{	    	
		$this->db->insert(NOTES_TAB, $data);	
	}
    
	
	public function editSave($data)    
	{
		$this->db->update(NOTES_TAB, $data, "`noteid` = {$data['noteid']} AND userid = {$_SESSION['userid']}");				
	}
		
		
	public function delete($noteid)
	{	        
		$this->db->delete(NOTES_TAB, "`noteid` = $noteid AND userid = {$_SESSION['userid']}");						
	}
}
