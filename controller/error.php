<?php
namespace Controller;

use \Core\Controller;

class Error extends Controller
{
    public $haveModel = true;
    public $errorCode; //def. is null

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = 'Error ' . $this->errorCode;
        switch ($this->errorCode) {
            case 1:
                $this->view->msg = "Class doesn't exist";
                break;
            case 2:
                $this->view->msg = "Model doesn't exist";
                break;
            case 404:
                $this->view->msg = $this->notFound();
                break;
            case 999:
                $this->view->msg = "Unbekannter Fehler";
                break;
            case 1404:
                $this->view->msg = "unbekannte Methode";
                break;
            default:
                $this->view->msg = "Nöx";
                break;
        }

        $this->view->render('error/inc/header', false);
        $this->view->render('error/index', false);
        $this->view->render('error/inc/footer', false);
    }

    public function notFound()
    {
        return 'Fehler 404: Seite nicht gefunden / This page doesn\'t exist';
    }
}
