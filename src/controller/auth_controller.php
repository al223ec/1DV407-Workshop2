<?php
namespace controller;

class AuthController extends \core\Controller{
	private $view;
	private $model;
	
	public function __construct(){
		$this->model = new \model\AuthModel();
		$this->view = new \view\AuthView($this->model);
	}
	
	public function loginForm(){
		return $this->view->loginForm();
	}
	
	public function auth(){
		$username = $this->view->getUsernamePost();
		$password = $this->view->getPasswordPost();
		$this->model->auth($username, $password);
	}
}