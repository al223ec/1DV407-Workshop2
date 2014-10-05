<?php

namespace model\repository;

class MemberRepository extends \core\Repository {

	public function __construct(){
			$this->table = "member"; 
	}

	public function getArrayOfMembers(){
		$sql = "SELECT * FROM " .$this->table;  
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
		/*
		$ret = null; 
		$sql = "SELECT * FROM " . $this->table . " WHERE id = ?";

		//Exempel på query användning med ett enda argument
		if($memberdbo = $this->query($sql, $id)[0]){
			$ret = new \model\Member($memberdbo["id"], $memberdbo["name"], $memberdbo["ssn"], $this->getBoatsByMemberId($memberdbo["id"])); 
		} 
		return $ret; 
		*/
		$result = $this->findBy('id', $id);
		if($result !== null){
			return new \model\Member($result['id'], $result['name'], $result['ssn'], $this->getBoatsByMemberId($result['id']));
		}
		return null;
	}

	public function deleteMemeber($id){

	}

	public function saveMember($name, $ssn){
		$sql = "INSERT INTO " . $this->table . "(name, ssn) VALUES( :name, :ssn);"; 
		$params = array(":name" => $name, ":ssn" => $ssn); 

		$ret = $this->query($sql, $params, true);
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
