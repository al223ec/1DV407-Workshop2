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
				$member = new \model\Member($memberdbo['id']); 
				$member->setName($memberdbo['name']); 
				$member->setSsn($memberdbo['ssn']); 
				$member->setBoats($this->getBoatsByMemberId($memberdbo['id'])); 
				$ret[] = $member; 
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
				$ret[] = new \model\Boat($boat["id"], $boat["member_id"], $boat["type"], $boat["length"]); 
			}
		} 
		return $ret; 
	}

	public function getMemberById($id){
		$result = $this->findBy('id', $id);
		if($result !== null){
			$member = new \model\Member($result['id']); 
			$member->setName($result['name']); 
			$member->setSsn($result['ssn']); 
			$member->setBoats($this->getBoatsByMemberId($result['id'])); 
			
			return $member; 
		}
		return null;
	}

	public function deleteMemeber($id){

	}

	public function saveMember($name, $ssn){
		$sql = "INSERT INTO " . $this->table . "(name, ssn) VALUES( :name, :ssn);"; 
		$params = array(":name" => $name, ":ssn" => $ssn); 

		return $this->query($sql, $params, true);

	}
	
	public function updateMember($id, $name, $ssn){
 		$sql = "UPDATE " . $this->table . " SET name = :name, ssn = :ssn WHERE id = :id"; 
		$params = array(":name" => $name, ":ssn" => $ssn, ":id" => $id); 

		return $this->query($sql, $params, true);
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
