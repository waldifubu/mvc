<?php
/**
 * Main Controller
 */
namespace Core;

use Util\Auth;
use Core\Model;

class Controller
{
    /** @var View $view */
    protected $view;

    /* @var Model $view */
    protected $model;

    /* @var bool $needLogin */
    protected $needLogin;

    public function __construct()
    {
        $this->view = new View();
        if ($this->needLogin) {
            Auth::handleLogin();
        }
    }

    public function loadModel($name)
    {
        $class = '\Model\\' . $name . 'Model';
        $this->model = new $class();
    }
}
