<?php
namespace model;

class AuthModel{
	private $sessionAuthKey = 'auth';
	private $sessionErrorKey = 'authError';

	public function auth($username, $password){
		if($username === 'admin' && $password === 'password'){
			$this->setAuthSession();
			return true;
		}
		$_SESSION[$this->sessionErrorKey] = 'Could not log in, try again.';
		return false;
	}
	
	public function getError(){
		if(isset($_SESSION[$this->sessionErrorKey])){
			$ret = $_SESSION[$this->sessionErrorKey];
			unset($_SESSION[$this->sessionErrorKey]);
			return $ret;
		}
		return null;
		
	}

	private function setAuthSession(){
		$_SESSION[$this->sessionAuthKey] = true;
	}
	
	public function signOut(){
		unset($_SESSION[$this->sessionAuthKey]);
	}

	public function checkAuth(){
		return (isset($_SESSION[$this->sessionAuthKey]) && $_SESSION[$this->sessionAuthKey]);
	}
}