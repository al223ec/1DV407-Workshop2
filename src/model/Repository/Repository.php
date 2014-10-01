<?php 

namespace model\repository; 

abstract class Repository{
			/* local /*/ 
	protected static $DB_PASSWORD = ""; 
	protected static $DB_USERNAME = "root"; 
	protected static $TBL_NAME = "member"; 
	protected static $CONNECTIONSTRING = "mysql:host=127.0.0.1;dbname=workshopdb";

	private $dbConnection; 

	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection =  new \PDO(self::$CONNECTIONSTRING, self::$DB_USERNAME, self::$DB_PASSWORD);
			$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} 
		return $this->dbConnection; 

	} 
	/**
	*stulen metod från Emil, inte testat eller använd än, 
	*/
	public function query($sql, $params = NULL) {

		$db = $this -> connection();

		$query = $db -> prepare($sql);
		$result;
		if ($params != NULL) {
			if (!is_array($params)) {
				$params = array($params);
			}

			$result = $query -> execute($params);
		} else {
			$result = $query -> execute();
		}

		if ($result) {
			return $result -> fetchAll();
		}

		return NULL;

	}
}