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

    public function check()
    {
        if(!$_POST['login'] || !$_POST['password']) header('Location: ../login');
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
            Session::set('timeout', time() + 300);
        }

        $logged = (Session::get('loggedIn') == true) ? true : false;
        $result = ["result" => $logged];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}
