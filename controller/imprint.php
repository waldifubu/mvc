<?php
namespace Controller;

use Core\Controller;

class Imprint extends Controller
{
    public $noModel = true;

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = 'Impressum';
        $this->view->render('imprint/index');
    }
}