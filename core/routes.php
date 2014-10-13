<?php

class Routes{
	public static $routes = array(
		'member' => array(
			'main' => 'member/', 
			'view' => 'member/view/', 
			'edit' => 'member/edit/',
			'delete' => 'member/delete/',
			'save' => 'member/save/',
			'add' => 'member/add/',
			'setcompact' => 'member/setCompactList/',
			'setfull' => 'member/setFullList/',
			'confirmDelete' => 'member/confirmDelete/'
		),
		'boat' => array(
			'add' => 'boat/add/',
			'create' => 'boat/create/',
			'edit' => 'boat/edit/',
			'save' => 'boat/save/',
			'delete' => 'boat/delete/',
			'confirmDelete' => 'boat/confirmDelete/'
		)
	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}