<?php

namespace model;

class MemberModel {
	
	private $memberRepository; 

	private $nameMinLength = 3; 
	private $validChars = "/\D/"; 

	public function __construct(){
		$this->memberRepository = new repository\MemberRepository(); 
	}

	public function getArrayOfMembers(){
		return $this->memberRepository->getArrayOfMembers(); 
	}
/*
	public function getCompactArrayOfMembers(){

	}
*/
	public function getMemberById($id){
		if($id === 0 || !is_int($id)){
			return null; 
		}
		return $this->memberRepository->getMemberById($id); 
	}

	/**
	* @return True om det lyckas
	*/
	public function saveMember($name, $ssn, $id = 0){
		$ssn = preg_replace($this->validChars, '', $ssn);
		if(!is_int($id) || !$this->nameIsValid($name)){
			return false; 
		}
		//Kontrollera data
		if($id === 0){
			return $this->memberRepository->saveMember($name, $ssn); 
		}else{
			return $this->memberRepository->updateMember($id, $name, $ssn); 
		}
	}

	private function nameIsValid($name){
		return strlen($name) > $this->nameMinLength; 
	}

}
