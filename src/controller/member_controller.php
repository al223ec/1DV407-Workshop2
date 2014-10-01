<?php

namespace controller; 

require_once("src/controller/controller.php"); 
require_once("src/view/member_view.php"); 

class MemberController extends Controller{
	private $view; 

	public function __construct(){
		$this->view; 

	}

	public function main(){
		return "member Controller"; 
	}

	public function add(){
		return "add"; 
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
		
	}
}
