<?php
namespace model\repository;

class MembersAll extends \core\Repository implements IMemberFilterRepository{

	public function getFilterdMembers(){
		$sql = "
			SELECT member.*
			FROM member
		";  
		$ret = array(); 

		if($response = $this->query($sql)){
			foreach ($response as $memberdbo) {
				$member = new \model\Member($memberdbo['id']); 
				$member->setName($memberdbo['name']); 
				$member->setSsn($memberdbo['ssn']); 
				$ret[] = $member; 
			}
		} 
		return $ret; 
	}
}