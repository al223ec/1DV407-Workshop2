<?php 

namespace model\repository; 

abstract class Repository{
			/* local /*/ 
	protected static $DB_PASSWORD = ""; 
	protected static $DB_USERNAME = "root"; 
	protected $TBL_NAME = "member"; 
	protected static $CONNECTIONSTRING = "mysql:host=127.0.0.1;dbname=workshopdb";

	private $dbConnection; 
	/**
	* @return PDO object, 
	*/
	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection = new \PDO(self::$CONNECTIONSTRING, self::$DB_USERNAME, self::$DB_PASSWORD);
			$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} 
		return $this->dbConnection; 

	} 
	protected function query($sql, $params = null){
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

		if($response = $query->fetchAll()){
			return $response; 
		} 
		return null;
	}

}