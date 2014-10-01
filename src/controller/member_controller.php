<?php

namespace controller; 

require_once("src/controller/controller.php"); 
require_once("src/view/member_view.php"); 
 
require_once("src/view/member/member_list_view.php"); 
require_once("src/view/member/member_form_view.php"); 
require_once("src/model/member_model.php"); 

class MemberController extends Controller {

	private $memberModel; 
	private $memberView; 

	public function __construct(){
		$this->memberModel = new \model\MemberModel(); 
		$this->memberView = new \view\MemberView($this->memberModel); 
	}

	public function main(){
		$listView = new \view\member\MemberListView($this->memberModel); 
		
		if($this->memberView->shouldDispalyFullList()){
			return $listView->fullList();
		}
		return $listView->compactList(); 
	}

	public function add(){
		$formView = new \view\member\MemberFormView($this->memberModel); 
		return $formView->add(); 
	}	

	public function create(){
		return "create"; 
	}

	public function delete(){
		return "delete"; 
	}

	public function edit(){
		//Samma som create??
		return "edit";  
	}

	public function save(){
		$formView = new \view\member\MemberFormView($this->memberModel); 
		$un = $formView->getUserName(); 
		$ssn = $formView->getSsnPost();

		//Spara sen redirect
		return "Du har tryckt på sparat, $un, $ssn"; 

	}

	public function view(){
		$member = $this->memberModel->getMemberById(intval($this->params[0])); 
		return $this->memberView->view($member);
	}
}
