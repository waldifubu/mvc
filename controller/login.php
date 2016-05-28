<?php
namespace Controller;

use Core\Controller;
use Core\View;

class Login extends Controller
{
    public $haveModel = true;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index()
    {
        $this->view->title = 'Login';
        $this->view->js = array('login/js/default.js');
        $this->view->render('login/index');
    }

    public function checkLogin()
    {
        // prevent direct access
        //echo $_SERVER['HTTP_X_REQUESTED_WITH'];
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if (!$isAjax) {
            $user_error = 'Access denied - not an AJAX request...';
            trigger_error($user_error, E_USER_ERROR);
        }
        $this->model->check();
    }
}
