<?php

namespace view;

class BoatView extends \core\View{
	
	private $boatModel;
	
	private $postVarId = 'BoatView::id';
	private $postVarMemberId = 'BoatView::memberId';
	private $postVarType = 'BoatView::type';
	private $postVarLength = 'BoatView::length';
	
	public function __construct($boatModel){
		$this->boatModel = $boatModel;
	}
	
	public function getId(){
		return intval($this->getCleanInput($this->postVarId));
	}
	public function getMemberId(){
		return intval($this->getCleanInput($this->postVarMemberId));
	}
	public function getType(){
		return $this->getCleanInput($this->postVarType);
	}
	public function getLength(){
		return intval($this->getCleanInput($this->postVarLength));
	}
	
	public function add($memberId){
		return '
			<h1>Lägg till båt</h1>
			<form method="post" action="' . \Routes::getRoute('boat', 'create') . '">
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