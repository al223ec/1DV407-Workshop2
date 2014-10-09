<?php

namespace model\repository;

class BoatRepository extends \core\Repository{
	
	private $columns;
	
	public function __construct(){
		$this->table = 'boat';
		$this->columns = array(
			'id',
			'member_id',
			'type',
			'length'
		);
	}
	
	public function getBoatById($id){
		$result = $this->findBy($this->columns[0], $id);
		if($result !== null){
			$boat = new \model\Boat($result[$this->columns[0]]);
			$boat->setMemberId($result[$this->columns[1]]);
			$boat->setType($result[$this->columns[2]]);
			$boat->setLength($result[$this->columns[3]]);
			return $boat;
		}
		return null;
	}

	private function getBoatsByMemberId($memberId){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
			WHERE " . $this->table . "." . $this->columns[1] . " = :memberId
		";
		$params = array(":memberId" => $memberId); 

		$boats = array();
		if($response = $this->query($sql, $params)){
			foreach ($response as $row) {
				$boat = new \model\Boat($row[$this->columns[0]]);
				$boat->setMemberId($row[$this->columns[1]]);
				$boat->setType($row[$this->columns[2]]);
				$boat->setLength($row[$this->columns[3]]);
				$boats[] = $boat;
			}
		} 
		return $boats;
	}
	
	public function create($boat){
		$sql = "
			INSERT INTO " . $this->table . "(" . $this->columns[1] . ", " . $this->columns[2] . ", " . $this->columns[3] . ")
			VALUES (:memberId, :type, :length)
		";
		$params = array(':memberId' => $boat->getmemberId(), ':type' => $boat->getType(), ':length' => $boat->getLength());
		return $this->query($sql, $params, true);
	}
	
	public function save($boat){
		$sql = "
			UPDATE " . $this->table . "
			SET " . $this->columns[2] . " = :type, " . $this->columns[3] . " = :length
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':type' => $boat->getType(), ':length' => $boat->getLength(), ':id' => $boat->getId());
		return $this->query($sql, $params, true);
	}
	
	public function delete($boat){
		$sql = "
			DELETE FROM " . $this->table . "
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':id' => $boat->getId());
		return $this->query($sql, $params, true);
	}
}