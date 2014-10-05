<?php

namespace model;

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

	public function getMemberById($id){
		return $this->memberRepository->getMemberById($id); 
	}

	/**
	* @return True om det lyckas
	*/
	public function saveMember($name, $ssn){
		//Kontrollera data, ta emot en member ist??
		//nja ;)
		$this->memberRepository->saveMember($name, $ssn); 

	}

}
