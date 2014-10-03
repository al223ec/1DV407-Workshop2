<?php

namespace model\repository; 

require_once('./src/model/member.php'); 
require_once('./src/model/boat.php'); 
require_once('./src/model/repository/repository.php'); 

class MemberRepository extends Repository {

	public function __construct(){
			$this->TBL_NAME = "member"; 
	}

	public function getArrayOfMembers(){
		$sql = "SELECT * FROM " .$this->TBL_NAME;  
		$ret = array(); 

		if($response = $this->query($sql)){
			foreach ($response as $memberdbo) {
				$ret[] = new \model\Member($memberdbo["id"], $memberdbo["name"], $memberdbo["ssn"], $this->getBoatsByMemberId($memberdbo["id"])); 
			}
		} 
		return $ret; 
	}

	private function getBoatsByMemberId($memberId){
		$ret = array(); 

		$sql = "SELECT * FROM boat WHERE member_id = :memberId";   
		//Exempel på query användning med en array
		$params = array(":memberId" => $memberId); 

		if($response = $this->query($sql, $params)){
			foreach ($response as $boat) {
				$ret[] = new \model\Boat($boat["type"], $boat["member_id"], $boat["length"], $boat["id"] ); 
			}
		} 
		return $ret; 
	}

	public function getMemberById($id){
		$ret = null; 
		$sql = "SELECT * FROM " . $this->TBL_NAME . " WHERE id = ?";

		//Exempel på query användning med ett enda argument
		if($memberdbo = $this->query($sql, $id)[0]){
			$ret = new \model\Member($memberdbo["id"], $memberdbo["name"], $memberdbo["ssn"], $this->getBoatsByMemberId($memberdbo["id"])); 
		} 
		return $ret; 
	}

	public function deleteMemeber($id){

	}

	public function saveMember($name, $ssn){
		$sql = "INSERT INTO " . $this->TBL_NAME . "(name, ssn) VALUES( :name, :ssn);"; 
		$params = array(":name" => $name, ":ssn" => $ssn); 

		$ret = $this->query($sql, $params, true);
		var_dump($ret); 
	}

	/**
	* Skulle vara ganska praktiskt att få till detta
	*/
	protected function bindObject($object, $dboObject = null){
		$object = new $object("type", 1, 22, 2);

		$objectVars = get_object_vars($object);
		var_dump($objectVars); 
		foreach ($objectVars as $name => $value) {
 		   	var_dump("$name : $value");
		}

		die(); 

	}
}
