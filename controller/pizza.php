<?php
namespace Controller;

use Core\Controller;
use PDO;

class Pizza extends Controller
{
    public $haveModel = true;
    public $needLogin = true;

    /**
     * Constructor for Pizza Module
     */
    public function __construct()
	{
		parent::__construct();
        $this->view->js = array('pizza/js/default.js',
            'pizza/js/jquery.jeditable.min.js',
            '../public/js/jquery.goup.min.js', '../public/js/jquery.growl.js');

        $this->view->css = array('pizza/css/default.css', '../public/css/jquery.growl.css');
	}
    
    public function index()
	{
        $this->view->title = 'Meine Pizzen';
		$this->view->pizzaList = $this->model->pizzaList();
		$this->view->render('pizza/index');
	}

    public function changePic()
    {
        $filteredId = substr($_POST['id'], 3);
        if (isset($_FILES['file'])) {
            $tempFile = @fopen($_FILES['file']['tmp_name'], 'rb');
        }

        $data = [
            'id' => $filteredId,
            'picture' => $tempFile
        ];

        $types = [
            PDO::PARAM_STR, PDO::PARAM_LOB
        ];

        $this->model->changeBLOB($data, $types);
    }
    
    public function picUpload()
    {        
        echo $path = getcwd() . "/uploads/";        
        $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $ext = strtolower(pathinfo($_FILES['image']['file'], PATHINFO_EXTENSION));
        $max_size = 2000 * 2024; // max file size        
        
        // looking for format and size validity
		if (in_array($ext, $valid_exts) && $_FILES['image']['size'] < $max_size) {
			$path = $path . uniqid(). '.' .$ext;
			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
				//TODO: logging
			}
		} 
        else 
        {
			echo 'Invalid file!';            
		}           
    }
    
    public function create()
	{             
        if (isset($_FILES['image'])) {
            $fp = @fopen($_FILES['image']['tmp_name'], 'rb');    
        }
        
		$data = [
            'name' => $_POST['name'],
            'picture' => $fp,            
            'amount' => $_POST['amount'],
            'price' => $_POST['price']
            
        ];

        /**
         * Because of use from LOB, in other cases you don't need it
         */
        $types = [
            PDO::PARAM_STR, PDO::PARAM_LOB, PDO::PARAM_INT, PDO::PARAM_STR
        ];
        
		$this->model->create($data, $types);
        if (isset($_FILES['image'])) fclose($fp);
		header('location: ' . URL . 'pizza');       
	}

    public function changeValues()
    {
        $errors = false;
        $refresh = $_POST['value'];
        $data = [
            'id' => $_POST['id'],
            $_POST['column'] => $_POST['value']
        ];

        // Amount shall be an integer
        if($_POST['column'] == 'amount')
        {
            if (!ctype_digit(strval($data['amount']))) $errors = true;
            else
            $refresh = $data['amount'];
        }

        // For currency numbers
        if ($_POST['column'] == 'price') {
            if (!is_numeric($data['price'])) {
                $errors = true;
            } else {
                $number = str_replace(',', '.', $data['price']);
                $data['price'] = number_format($number, 2, '.', '');
                $refresh = round($number, 2);
            }
        }

        if($errors) {
            $firstArray = $this->model->selectOne($_POST['column'], $_POST['id'])[0];
            echo $firstArray[$_POST['column']];
        } else {
            echo $refresh;
            $this->model->change($data);
        }
    }
    
    public function delete($pizza)
	{
		$this->model->delete($pizza);
		header('location: ' . URL . 'pizza');
	}

}