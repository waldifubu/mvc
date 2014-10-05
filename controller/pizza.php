<?php
namespace Controller;

use \Core\Controller;
use \Util\Auth;
use PDO;

class Pizza extends Controller
{
    public $haveModel = true;

    public function __construct() 
	{
		parent::__construct();
		Auth::handleLogin();
        $this->view->js = array('pizza/js/default.js','pizza/js/jquery.jeditable.min.js');
	}
    
    public function index()
	{
        $this->view->title = 'Meine Pizzen';
		$this->view->pizzaList = $this->model->pizzaList();
		$this->view->render('pizza/index');
	}
    
    public function picUpload()
    {        
        echo $path = getcwd() . "/uploads/";        
        $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $max_size = 2000 * 2024; // max file size        
        
        // looking for format and size validity
		if (in_array($ext, $valid_exts) && $_FILES['image']['size'] < $max_size) {
			$path = $path . uniqid(). '.' .$ext;
			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
				echo "<img src='$path' />";
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
        
        $types = [
            PDO::PARAM_STR, PDO::PARAM_LOB, PDO::PARAM_INT, PDO::PARAM_STR
        ];
        
		$this->model->create($data, $types);
        if (isset($_FILES['image'])) fclose($fp);
		header('location: ' . URL . 'pizza');       
	}

    public function changeValues()
    {
        $data = [
            'id' => $_POST['id'],
            $_POST['column'] => $_POST['value']
        ];

        if($_POST['column'] == 'price')
        {
            $number = str_replace(',','.',$data['price']);
            $data['price'] = number_format($number, 2, '.', '');
        }

        echo $_POST['value'];
        $this->model->change($data);
    }
    
    public function delete($pizza)
	{
		$this->model->delete($pizza);
		header('location: ' . URL . 'pizza');
	}
      
}