<?php
# Database
namespace Core;

use PDO;

class Database extends PDO
{
	public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
	{
		parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}
    
    public function select($sql, $array = array(), $fetchmode = PDO::FETCH_ASSOC)
    {        
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}
		
		$sth->execute();
        return $sth->fetchAll($fetchmode);
    }
	
	public function insert($table, $data)
	{			
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}
	
    public function insertTypes($table, $data, $types)
	{			
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));	
        
		$sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		
        $anzahl = 0;                
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value, $types[$anzahl++]);            
		}
		
		$sth->execute();        
	}	    
	
	public function update($table, $data, $where)
	{
		$fieldDetails = null;
		foreach($data as $key=> $value) {
			$fieldDetails .= "`$key`=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');		
		$sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		
		$sth->execute();
	}
	
	/**
    *     
    * @param string $table
    * @param string $where
    * @param integer $limit
    * 
    * @return integer Affected rows
    */
	public function delete($table, $where, $limit = 1)
	{
		$sql = "delete from $table where $where LIMIT $limit";				
		return $this->exec($sql);		
	}		
	
}
