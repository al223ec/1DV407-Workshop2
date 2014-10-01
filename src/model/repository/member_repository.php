<?php

namespace model\repository; 

require_once('./src/model/member.php'); 
require_once('./src/model/boat.php'); 
require_once('./src/model/repository/repository.php'); 

class MemberRepository extends Repository {


	public function getArrayOfMembers(){
	 	$boats =  array(
	 		new \model\Boat("Segelbåt", 1),
	 		new \model\Boat("Motorbåt", 1),
	 		); 

		return array(
			new \model\Member(1, "Anton", $boats), 
			); 
	}

	public function getCompactArrayOfMembers(){

	}
}
