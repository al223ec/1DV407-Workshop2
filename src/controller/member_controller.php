<?php

namespace controller; 

class MemberController extends \core\Controller {

	private $memberModel; 
	private $memberView; 
	private $formView; 
	private $listView; 

	public function __construct(){
		$this->memberModel = new \model\MemberModel(); 
		$this->memberView = new \view\MemberView($this->memberModel); 
		$this->formView = new \view\member\MemberFormView($this->memberModel); 
		$this->listView = new \view\member\MemberListView($this->memberModel); 
	}

	public function main(){
		$listView = new \view\member\MemberListView($this->memberModel); 
		return $this->listView->getMemeberList($this->listView->shouldDispalyFullList());
	}

	public function add(){
		return $this->formView->getAddEditForm(); 
	}	

	public function delete(){
		$member = $this->memberModel->getMemberById(intval($this->params[0]));
		if($member !== null){
			return $this->memberView->confirmDelete($member); 
		}
		return $this->main(); 
	}

	public function confirmDelete(){
		$member = $this->memberModel->getMemberById(intval($this->params[0]));
		if($member === null){
			return $this->main(); 
		}
		//TODO: Vyn ska sköta detta!
		if($this->memberModel->deleteMember(intval($this->params[0]))){
			return "medlemmen " . $member->getName() . " togs bort!!"; 
		}else{
			//Något gick fel
			return "Något oväntat gick fel!!"; 
		}

	}

	public function edit(){
		return $this->formView->getAddEditForm($this->memberModel->getMemberById(intval($this->params[0])));
	}

	public function save(){
		//Kanske separera på create och update
		$member = $this->formView->getMember(); 
		$successfull = $member !== null && $this->memberModel->saveMember($member);
	
		if($successfull){
			$this->redirectTo('member');
		}else{
			return $this->formView->getAddEditForm($this->memberModel->getMemberById($this->formView->getMemberId()));
		}
	}

	public function view(){
		$member = $this->memberModel->getMemberById(intval($this->params[0])); 
		if($member !== null){
			return $this->memberView->view($member);
		}
		$this->redirectTo('member');
	}

	public function setCompactList(){
		$this->listView->setDisplayCompactList(); 
		$this->redirectTo('member');

	}
	public function setFullList(){
		$this->listView->setDisplayFullList();
		$this->redirectTo('member');
	}
}
