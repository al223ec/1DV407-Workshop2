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
		),
		'boat' => array(
			'main' => 'boat/', 
			'view' => 'boat/view/', 
			'edit' => 'boat/edit/',
			'delete' => 'boat/delete/',
			'save' => 'boat/save/',
			'add' => 'boat/add/',
		)
	);
	
	public static function getRoute($controller, $action){
		return ROOT_PATH . self::$routes[$controller][$action];
	}
}