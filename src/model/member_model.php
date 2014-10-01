<?php

namespace model; 

class MemberModel {
	
	private $memberRepository; 

	public function __construct(){
		$this->memberRepository = new MemberRepository(); 
	}

	public function getListOfMembers(){

	}

	public function getCompactListOfMembers(){

	}

}
