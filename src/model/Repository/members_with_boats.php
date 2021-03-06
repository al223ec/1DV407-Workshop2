<?php
namespace model\repository;

class MembersWithBoats extends \core\Repository implements IMemberFilterRepository{

	public function getFilterdMembers(){
		$sql = "
			SELECT member.*
			FROM member
			RIGHT JOIN boat
			ON member.id = boat.member_id
			GROUP BY member.id
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