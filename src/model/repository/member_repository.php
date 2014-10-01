<?php

namespace model\repository; 

require_once('./src/model/member.php'); 
require_once('./src/model/boat.php'); 
require_once('./src/model/repository/repository.php'); 

class MemberRepository extends Repository {

	public function getArrayOfMembers(){
		$db = $this -> connection();
		$ret = array(); 
		$sql = "SELECT * FROM " . self::$TBL_NAME;  
		
		$sth = $db->prepare($sql); 
		
		if(!$sth){
			throw new \Exception("SQL Error"); 
		} 

		if(!$sth->execute()){
			throw new \Exception("SQL Execute Error"); 
		} 
		if($response = $sth->fetchAll()){

			foreach ($response as $memberdbo) {
				$ret[] = new \model\Member($memberdbo["id"], $memberdbo["name"], $this->getBoatsByMemberId($memberdbo["id"])); 
			}
		} 
		return $ret; 
	}


	private function getBoatsByMemberId($memberId){
		$db = $this -> connection();
		$ret = array(); 

		$sql = "SELECT * FROM boat WHERE member_id = ?";   
		
		$sth = $db->prepare($sql); 

		if(!$sth){
			throw new \Exception("SQL Error"); 
		} 

		$sth->bindValue(1, $memberId);
		if(!$sth->execute()){
			throw new \Exception("SQL Execute Error"); 
		} 
		if($response = $sth->fetchAll()){

			foreach ($response as $boat) {
				$ret[] = new \model\Boat($boat["type"], $boat["member_id"], $boat["length"], $boat["id"] ); 
			}
		} 
		return $ret; 

	}

	public function getMemberById($id){
		$db = $this -> connection();
		$ret = null; 

		$sql = "SELECT * FROM " . self::$TBL_NAME . " WHERE id = ?";   
		
		$sth = $db->prepare($sql); 
		if(!$sth){
			throw new \Exception("SQL Error"); 
		} 

		$sth->bindValue(1, $id);
		if(!$sth->execute()){
			throw new \Exception("SQL Execute Error"); 
		} 

		if($memberdbo = $sth->fetch()){
			$ret = new \model\Member($memberdbo["id"], $memberdbo["name"], $this->getBoatsByMemberId($memberdbo["id"])); 
		} 
		return $ret; 
	}

	public function deleteMemeber($id){

	}
}
