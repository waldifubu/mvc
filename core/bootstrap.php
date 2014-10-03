<?php
namespace Core;

/**
 * Class Bootstrap
 * @package Core
 */

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
    */
    public function __construct()
    {

    }

    /**
     * Here starts the magic ^^
     */
    public function init()
    {
        // gets URL
        $this->_getUrl();

        //Keeps for debugging
        //var_dump($this->_url);

        if (empty($this->_url[0])) //no controller was called, loads index page
        {
            $this->_loadDefaultController();
        }
        else
        {
            // First try to load controller and optional load model, if possible (TRUE)
            if($this->_loadExistingController())
            {
                $this->_callControllerMethod();
            }
        } //Controller was given
    }

    /**
     * @param $path Sets controller path
     */
    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/').'/';
    }

    /**
     * @param $path Sets model path, models are optional
     */
    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/').'/';
    }

    /**
     * @param $path Sets path for views
     */
    public function setViewPath($path)
    {
        $this->_viewPath = trim($path, '/').'/';
    }

    /**
     * Seperates URL data in a String
     */
    private function _getUrl()
    {
        $url = @filter_var($_GET['url'], FILTER_SANITIZE_URL);
        $this->_url = @explode('/', rtrim($url,'/'));
    }

    // Call: /mvc/index OR /mvc
    private function _loadDefaultController()
    {        
        $this->_controller = new \Controller\Index();
        $this->_controller->index();
    }

    // Call: /mvc/XXX
    private function _loadExistingController()
    {
        $nameClass = 'Controller\\' . $this->_url[0];

        $pfad = str_replace('\\', DIRECTORY_SEPARATOR , strtolower($nameClass)) . '.php';
        if (file_exists($pfad))
        {
            // Check if class exists in file, then Autoloader is called
            if(class_exists($nameClass))
            {
                $this->_controller = new $nameClass();

                if(isset($this->_controller->haveModel) && $this->_controller->haveModel == true)
                {
                    // Model not found
                    if (!file_exists($this->_modelPath.'\\'. $this->_url[0] . '_model.php'))
                    {
                        $this->_error(2);
                        return false;
                    }

                    $this->_controller->loadModel($this->_url[0], $this->_modelPath);
                }
                return true;
            }
            else
            {
                // Class isn't found
                $this->_error(1);
                return false;
            }
        }
        else // File not found
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

    /**
     * @param int $arg Errorcode
     */
    private function _error($arg = 0)
    {
        $this->_controller = new \Controller\Error();
        $this->_controller->errorCode = $arg;
        $this->_controller->index();
    }
}
