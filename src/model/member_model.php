<?php

namespace model; 

require_once("./src/model/repository/member_repository.php");

class MemberModel {
	
	private $memberRepository; 

	public function __construct(){
		$this->memberRepository = new repository\MemberRepository(); 
	}

	public function getArrayOfMembers(){
		return $this->memberRepository->getArrayOfMembers(); 
	}

	public function getCompactArrayOfMembers(){

	}

}
