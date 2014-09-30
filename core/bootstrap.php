<?php
namespace Core;

class Bootstrap
{
    //<editor-fold desc="Attribute">
    private $_url;
    private $_controller;
    private $_controllerPath = 'controller/';
    private $_modelPath = 'model/';
    private $_viewPath = 'view/';
    //</editor-fold>

    /**
    * Construct Bootstrap
    *
    * @return boolean|string
    */
    public function __construct()
    {

    }


    public function init()
    {
        $this->_getUrl();

        //Bleibt für debugging zwecke
        //var_dump($this->_url);

        if (empty($this->_url[0])) //loads index page
        {
            $this->_loadDefaultController();
        }
        else
        if ($this->_loadExistingController()) $this->_callControllerMethod();
    }

    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/').'/';
    }


    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/').'/';
    }

    public function setViewPath($path)
    {
        $this->_viewPath = trim($path, '/').'/';
    }

    private function _getUrl()
    {
        $url = @filter_var($_GET['url'], FILTER_SANITIZE_URL);
        $this->_url = @explode('/', rtrim($url,'/'));
    }

    // /mvc/index
    private function _loadDefaultController()
    {        
        $this->_controller = new \Controller\Index();
        $this->_controller->index();
    }

    // /mvc/XXX
    private function _loadExistingController()
    {
        $nameClass = 'Controller\\' . $this->_url[0];

        $pfad = str_replace('\\', DIRECTORY_SEPARATOR , strtolower($nameClass)) . '.php';
        if (file_exists($pfad))
        {
            //Prüfen ob Klasse enthalten ist, dann wird Autoloader aufgerufen
            if(class_exists($nameClass))
            $this->_controller = new $nameClass();
            else
            {
                $this->_error(1);
                return false;
            }

            if(isset($this->_controller->noModel) && $this->_controller->noModel == true)
            {
                return true;
            }
            $this->_controller->loadModel($this->_url[0], $this->_modelPath);
            return true;
        }
        else
        {
            $this->_error(404);
        }
    }

    /**
    * Already checked, if controller is given, check for existence and loading
    * 
    * @return mixed
    */
    private function _callControllerMethod()
    {
        /*
        http://localhost/Controller/Method/ (Parameter) /(Parameter) /(Parameter)
        url[0] = Controller
        url[1] = Method
        url[2] = Parameter
        url[3] = Parameter
        url[4] = Parameter
        ...
        */
        $length = count($this->_url);

        if ($length == 1) {
            $this->_controller->index();
        }
        elseif ($length == 2) {
            if (!method_exists($this->_controller, $this->_url[1])) $this->_error(1404);
            else
            $this->_controller->{$this->_url[1]}();
        }
        else {
            if (method_exists($this->_controller, $this->_url[1]) === false) $this->_error(1404);
            $params = "";
            for ($i = 2; $i < $length; $i++) {
                $params .= $this->_url[$i].',';
            }
            $params = rtrim($params, ',');
            @$this->_controller->{$this->_url[1]}($params);
        }
    }

    private function _error($arg = 0)
    {
        $this->_controller = new \Controller\Error();
        $this->_controller->errorCode = $arg;
        $this->_controller->index();
    }
}
