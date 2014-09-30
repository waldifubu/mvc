<?php
# Dashboard Model
namespace Model;

use Core\Model;

class Dashboard_Model extends Model
{
	public function __construct()
	{
		parent::__construct();        
	}	
	
	public function xhrInsert()
	{		
        $sth = $this->db->insert('data', array('text'=>$_POST['text']));
        /*
		$sql = 'insert into data (text) values (:text)';
		$sth = $this->db->prepare($sql);
		$sth->execute(array(':text' => $_POST['text']));		
		*/
		$data = array('text' => $_POST['text'], 'id' => $this->db->lastInsertId());
		echo json_encode($data);
	}
	
	public function xhrGetListings()
	{		        
        /*
        $sql = 'select * from data';		
        $sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();*/        
		echo json_encode($this->db->select('select * from data'));
	}
	
	public function xhrDeleteListing()
	{	
        $id = (int) $_POST['id'];		
        $this->db->delete('data', "dataid = '$id'");
		
        /*
		$sql = 'delete from data where id='.$id;
		$sth = $this->db->prepare($sql);
		$sth->execute();		
        */
	}
}
