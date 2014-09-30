<?php
namespace Model;

use Core\Model;
use Core\Session;
use Util\Hash;

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function run()
	{		        
		$sql = 'select userid, role from users where login = :login and password = :pass';
		$sth = $this->db->prepare($sql);
		$sth->execute(array(
		':login' => $_POST['login'],
		':pass' => Hash::create('sha256', $_POST['password'], HASH_PASS_KEY)
		));
		
		$data = $sth->fetch();		
		
		$count = $sth->rowCount();
		
		if ($count > 0)
		{
			Session::init();
			Session::set('role', $data['role']);
			Session::set('loggedIn', true);
            Session::set('userid', $data['userid']);
            Session::set('username', $_POST['login']);
			header('Location: ../dashboard');
		} else {
			header('Location: ../login');
		}
	}
	
}
