<?php

namespace controller; 

require_once("src/controller/controller.php"); 
require_once("src/view/member_view.php"); 
require_once("src/model/member_model.php"); 

class MemberController extends Controller{
	private $memberModel; 

	private $view; 

	public function __construct(){
		$this->view;
		$this->memberModel = new \model\MemberModel(); 

	}

	public function main(){
		return "<a href='" . \core\router::$route["member"]["view"]  . "'> alla medlemmar</a>"; 
	}

	public function add(){
		$ret = ""; 
		foreach ($this->params  as $key => $value) {
			$ret .= $value; 
		}
		return "add" . $ret; 
	}	

	public function create(){
		return "create"; 
	}

	public function delete(){

	}

	public function edit(){
		//Samma som create?? 
	}

	public function save(){

	}

	public function view(){

		$ret = ""; 
		$members = $this->memberModel->getArrayOfMembers(); 
		foreach ($members as $key => $value) {
			$ret .= $value . "\n"; 
			$ret .= "\t" . $value->getBoatString();
		}
		return $ret; 
	}
}
