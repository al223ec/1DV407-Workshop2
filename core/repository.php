<?php 

namespace core; 

abstract class Repository{
	private $dbConnection; 
	protected $table;
	/**
	* @return PDO object, 
	*/
	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection = new \PDO(\Config::DB_CONNECTION_STRING, \Config::DB_USERNAME, \Config::DB_PASSWORD);
			if(\Config::DEBUG){
				$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		} 
		return $this->dbConnection; 

	}
	
	protected function findBy($column, $value){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
			WHERE ". $this->table ."." . $column . " = :value
		";
		$params = array(":value" => $value);
		$result = $this->query($sql, $params);
		return ($result !== null) ? $result[0] : null;
	}
	 
	protected function query($sql, $params = null, $insert = false){
		$db = $this->connection();
		$query = $db->prepare($sql); 

		if ($params !== null) {
			if (!is_array($params)) {
				$params = array($params);
			}
			$query->execute($params);
		} else {
			$query->execute(); 
		}

		if($insert){
			return true; 
		}
		
		if($response = $query->fetchAll()){
			return $response; 
		} 

		return null;
	}

}