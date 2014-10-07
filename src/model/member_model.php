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
		$member = new \model\Member($id); 
		$member->setName($name); 
		$member->setSsn($ssn); 
		if(!$member->isValid()){
			return false; 
		}
		//Skicka member objektet vidare?? 
		if($id === 0){
			return $this->memberRepository->saveMember($name, $ssn); 
		}else{
			//Här kan man hämta den existerande medlemmen 
			return $this->memberRepository->updateMember($id, $name, $ssn); 
		}
	}
}
