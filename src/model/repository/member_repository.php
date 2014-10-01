<?php

namespace model\repository; 

require_once('./src/model/member.php'); 
require_once('./src/model/boat.php'); 
require_once('./src/model/repository/repository.php'); 

class MemberRepository extends Repository {

	public function getArrayOfMembers(){
		$ret = array(); 
		$sql = "SELECT * FROM " . self::$TBL_NAME;  
		
		$sth = $this->pdo->prepare($sql); 
		
		if(!$sth){
			throw new \Exception("SQL Error"); 
		} 

		if(!$sth->execute()){
			throw new \Exception("SQL Execute Error"); 
		} 
		if($response = $sth->fetchAll()){

			foreach ($response as $memberdbo) {
				$ret[] = new \model\Member($memberdbo["id"], $memberdbo["name"]); 

			}

		} 
		return $ret; 
	}

	private function getBoatByMemberId($memberId){


	}

	public function getCompactArrayOfMembers(){

	}

	public function getMemberById($id){
		/*
		foreach ($this->memberArr as $member) {
			if($member->getId() === $id){
				return $member; 
			}
			}*/
		return null; 
	}

	public function deleteMemeber($id){

	}
}
