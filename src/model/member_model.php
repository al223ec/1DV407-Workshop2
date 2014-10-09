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
	public function saveMember(\model\Member $member){
		if(!$member->valid()){
			return false; 
		}

		if($member->getId() === 0){
			return $this->memberRepository->saveMember($member); 
		}else{
			//Här kan man hämta den existerande medlemmen 
			return $this->memberRepository->updateMember($member); 
		}
	}
}
