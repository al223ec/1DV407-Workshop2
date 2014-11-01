<?php
namespace model\repository;

class MembersWithoutBoats extends \core\Repository implements IMemberFilterRepository{

	public function getFilterdMembers(){
		$sql = "
			SELECT member.*, boat.id as boat_id
			FROM member
			LEFT JOIN boat
			ON member.id = boat.member_id
			GROUP BY member.id
		";  
		$ret = array(); 

		if($response = $this->query($sql)){
			foreach ($response as $memberdbo) {
				if($memberdbo['boat_id'] == null){
					$member = new \model\Member($memberdbo['id']); 
					$member->setName($memberdbo['name']); 
					$member->setSsn($memberdbo['ssn']); 
					$ret[] = $member; 
				}
			}
		} 
		return $ret; 
	}
}