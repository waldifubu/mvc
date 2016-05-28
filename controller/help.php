<?php
# Controller Help
namespace Controller;

use Core\Controller;

class Help extends Controller
{
    public $haveModel = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = 'Help';
        $this->view->msg = $this->model->index();
        $this->view->render('help/index');
    }

    public function other($arg = false)
    {
        $this->view->msg = $this->model->bla($arg);
        $this->view->render('help/index');
    }

}
