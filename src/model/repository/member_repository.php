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
		$boats = array(); 

		$sql = "SELECT * FROM boat WHERE member_id = :memberId";   
		//Exempel på query användning med en array
		$params = array(":memberId" => $memberId); 

		if($response = $this->query($sql, $params)){
			foreach ($response as $boat) {
				$newBoat = new \model\Boat($boat["id"]);
				$newBoat->setMemberId($boat["member_id"]);
				$newBoat->setType($boat["type"]);
				$newBoat->setLength($boat["length"]);

				$boats[] = $newBoat;
			}
		} 
		return $boats; 
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

	public function deleteMember($id){
		$sql = "DELETE FROM " . $this->table . " WHERE id = :id"; 
		$params = array(":id" => $id); 
		
		return $this->query($sql, $params, true);
	}

	public function saveMember(\model\Member $member){
		$name = $member->getName();
		$ssn = $member->getSsn();  

		$sql = "INSERT INTO " . $this->table . "(name, ssn) VALUES( :name, :ssn);"; 
		$params = array(":name" => $name, ":ssn" => $ssn); 

		return $this->query($sql, $params, true);

	}
	
	public function updateMember(\model\Member $member){
		$id = $member->getId(); 
		$name = $member->getName(); 
		$sns = $member->getSsn(); 

 		$sql = "UPDATE " . $this->table . " SET name = :name, ssn = :ssn WHERE id = :id"; 
		$params = array(":name" => $name, ":ssn" => $ssn, ":id" => $id); 

		return $this->query($sql, $params, true);
	}
	/**
	* Skulle vara ganska praktiskt att få till detta
	*/
	protected function bindObject($object, $dboObject = null){
		throw new \Exception("Inte implementerad alls", 1);
		
		$object = new $object("type", 1, 22, 2);

		$objectVars = get_object_vars($object);
		var_dump($objectVars); 
		foreach ($objectVars as $name => $value) {
 		   	var_dump("$name : $value");
		}

		die(); 

	}
}
