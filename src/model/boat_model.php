<?php

namespace model;

class BoatModel{
	
	private $boatRepository;
	
	public function __construct(){
		$this->boatRepository = new \model\repository\BoatRepository();
	}
	
	public function getBoatById($id){
		return $this->boatRepository->getBoatById($id);
	}
	
	public function getOwner($id){
		$memberModel = new \model\memberModel();
		return $memberModel->getMemberById($id);
	}
	
	public function getBoatsByMemberId($id){
		return $this->boatRepository->getBoatsByMemberId($id);
	}
	public function create(\model\Boat $boat){
		return $this->boatRepository->create($boat);
	}
	
	public function save(\model\Boat $boat){
		return $this->boatRepository->save($boat);
	}
	
	public function delete($id){
		return $this->boatRepository->delete($id);
	}
	public function deleteBoatsByMemberId($memberId){
		return $this->boatRepository->deleteBoatsByMemberId($memberId);
	}
}