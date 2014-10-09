<?php

namespace view;

class BoatView extends \core\View{
	
	private $boatModel;
	private $flashMessages;
	private $flashKey = 'BoatView::flashKey';
	
	private $postVarId = 'BoatView::id';
	private $postVarMemberId = 'BoatView::memberId';
	private $postVarType = 'BoatView::type';
	private $postVarLength = 'BoatView::length';
	
	public function __construct($boatModel){
		$this->flashMessages = new \view\FlashMessages($this->flashKey);
		$this->boatModel = $boatModel;
	}
	
	public function getBoatFromPost(){
		$boat = new \model\Boat($this->getId());
		$boat->setMemberId($this->getMemberId());
		$boat->setType($this->getType());
		$boat->setLength($this->setLength());
		if($boat->valid()){
			return boat;
		}
		else{
			foreach($boat->getErrors() as $error){
				$this->flashMessages->addFlash($error, \view\FlashMessages::FlashClassError); 
			}
			return null;
		}
	}

	private function getId(){
		return intval($this->getCleanInput($this->postVarId));
	}
	private function getMemberId(){
		return intval($this->getCleanInput($this->postVarMemberId));
	}
	private function getType(){
		return $this->getCleanInput($this->postVarType);
	}
	private function getLength(){
		return intval($this->getCleanInput($this->postVarLength));
	}
	
	public function add($memberId){
		return '
			<h1>Lägg till båt</h1>
			<form method="post" action="' . \Routes::getRoute('boat', 'create') . '">
				<input type="hidden" id="' . $this->postVarId . '" name="' . $this->postVarId . '" value="0" />
				<input type="hidden" id="' . $this->postVarMemberId . '" name="' . $this->postVarMemberId . '" value="' . $memberId . '" />
				<div>
					<label for="' . $this->postVarType . '">Båt-typ<label>
					<input type="text" id="' . $this->postVarType . '" name="' . $this->postVarType . '" />
				</div>
				<div>
					<label for="' . $this->postVarLength . '">Längd(meter eller något heltal)<label>
					<input type="text" id="' . $this->postVarLength . '" name="' . $this->postVarLength . '" />
				</div>
				<div>
					<input type="submit" value="Add boat" />
				</div>
			</form>
		';
	}
	
	public function edit($id){
		$boat = $this->boatModel->getBoatById($id);
		$member = $this->boatModel->getOwner($boat->getMemberId());
		
		return '
			<div>
				<h2>Redigera Båt</h2>
				<p>Ägare: ' . $member . '</p>
			</div>
			<div>
				<form method="post" action="' . \Routes::getRoute('boat', 'save') . '">
					<input type="hidden" id="' . $this->postVarId . '" name="' . $this->postVarId . '" value="' . $id . '" />
					<input type="hidden" id="' . $this->postVarMemberId . '" name="' . $this->postVarMemberId . '" value="' . $member->getId() . '" />
					<div>
						<label for="' . $this->postVarType . '">Båt-typ<label>
						<input type="text" id="' . $this->postVarType . '" name="' . $this->postVarType . '" value="' . $boat->getType() . '" />
					</div>
					<div>
						<label for="' . $this->postVarLength . '">Längd(meter eller något heltal)<label>
						<input type="text" id="' . $this->postVarLength . '" name="' . $this->postVarLength . '" value="' . $boat->getLength() . '" />
					</div>
					<div>
						<input type="submit" value="Save boat" />
					</div>
				</form>
			</div>
		';
	}
} 