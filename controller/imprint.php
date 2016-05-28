<?php
namespace Controller;

use Core\Controller;

class Imprint extends Controller
{
    /**
     * Imprint constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function index()
    {
        $this->view->title = 'Impressum';
        $this->view->render('imprint/index');
    }
}