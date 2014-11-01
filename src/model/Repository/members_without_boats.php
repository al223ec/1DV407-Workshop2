<?php
namespace model\repository;

class MembersWithoutBoats extends \core\Repository implements IMemberFilterRepository{

	public function getFilterdMembers(){
		$sql = "
		   SELECT member.*
		   FROM member
		   LEFT JOIN boat
		   ON member.id = boat.member_id
		   WHERE boat.member_id IS NULL
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