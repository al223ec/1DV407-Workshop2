<?php

namespace model;

class MemberModel {
	private $memberRepository;
	private $memberFilters;

	public function __construct(){
		$this->memberRepository = new \model\repository\MemberRepository();
		$this->setMemberFilters();
	}

	private function setMemberFilters(){
		$this->memberFilters[] = new \model\repository\MembersAll();
		$this->memberFilters[] = new \model\repository\MembersWithBoats();
		$this->memberFilters[] = new \model\repository\MembersWithoutBoats();
	}

	public function getMemberFilters(){
		return $this->memberFilters;
	}

	public function getMembers($filterKey){
		return $this->memberFilters[$filterKey]->getFilterdMembers();
	}

	public function getArrayOfMembers(){
		 return $this->memberRepository->getArrayOfMembers();
	}

	public function getMemberById($id){
		if($id === 0 || !is_int($id)){
			return null; 
		}
		return $this->memberRepository->getMemberById($id); ;
	}
	public function deleteMember($id){
		return $this->memberRepository->deleteMember($id); 
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
