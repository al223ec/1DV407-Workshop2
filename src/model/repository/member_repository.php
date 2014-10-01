<?php

namespace model\repository; 

require_once('./src/model/member.php'); 
require_once('./src/model/boat.php'); 
require_once('./src/model/repository/repository.php'); 

class MemberRepository extends Repository {
	private $memberArr; 

	public function __construct(){
		$boats =  array(
 			new \model\Boat("Segelbåt", 666),
 			new \model\Boat("Motorbåt", 666),
 		); 

 	 	$moreboats =  array(
 			new \model\Boat("Segelbåt", 2),
 			new \model\Boat("Yatchy", 2),
 		); 
	
		$this->memberArr = 	 array(
			new \model\Member("Anton", $boats, 666), 
			new \model\Member("Erik", $moreboats, 2),
		); 
	} 


	public function getArrayOfMembers(){
	 	return $this->memberArr; 
	}

	public function getCompactArrayOfMembers(){

	}

	public function getMemberById($id){
		foreach ($this->memberArr as $member) {
			if($member->getId() === $id){
				return $member; 
			}
		}
		return null; 
	}
}
