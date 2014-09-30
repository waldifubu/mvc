<?php
namespace Model;

use Core\Model;
use Util\Hash;

class User_Model extends Model
{
	public function __construct()
	{
		parent::__construct();		
	}
	
    
	public function userList()
	{	
        return $this->db->select('select userid, login, role from '.USERS_TAB);               		
	}	
	
    
	public function userSingleList($userid)
	{        
        return $this->db->select('select userid, login, role from '.USERS_TAB.' where userid=:userid', 
        array(':userid'=>$userid));
	}
    
    
    public function create($data)
	{		
		$data['password'] = Hash::create('sha256', $data['password'], HASH_PASS_KEY);
		$this->db->insert(USERS_TAB, $data);	
	}
	
	
	public function editSave($data)
	{		
		$data['password'] = Hash::create('sha256', $data['password'], HASH_PASS_KEY);
		$this->db->update(USERS_TAB, $data, "`userid` = {$data['userid']}");				
	}
		
		
	public function delete($userid)
	{	        
        $data = $this->db->select('select role from '.USERS_TAB.' where userid=:userid', array(':userid'=>$userid));
                
        if($data[0]['role'] == 'owner')
		return false;
                
		$this->db->delete(USERS_TAB, "`userid` = $userid");						
	}
}
