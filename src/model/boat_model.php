<?php

namespace model;

class BoatModel{
	
	private $boatRepository;
	private $memberModel;
	
	public function __construct(){
		$this->boatRepository = new \model\repository\BoatRepository();
		$this->memberModel = new \model\memberModel();
	}
	
	public function getBoatById($id){
		return $this->boatRepository->getBoatById($id);
	}
	
	public function getOwner($id){
		return $this->memberModel->getMemberById($id);
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
}