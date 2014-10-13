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
				$ret[] = $member; 
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
		$ssn = $member->getSsn(); 

 		$sql = "UPDATE " . $this->table . " SET name = :name, ssn = :ssn WHERE id = :id"; 
		$params = array(":name" => $name, ":ssn" => $ssn, ":id" => $id); 

		return $this->query($sql, $params, true);
	}
}
