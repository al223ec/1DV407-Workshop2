<?php
namespace view;

class AuthView extends \core\View{
	private $usernameKey = 'AuthView::username';
	private $passwordKey = 'AuthView::password';

	public function loginForm(){
		return '
			<form>
				<label>username</label>
				<input type="text" name="' . $this->usernameKey . '" id="' . $this->usernameKey . '" />
			</form>
		';
	}
}