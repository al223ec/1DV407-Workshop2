<?php
function AutoLoadClasses($class){
	$class = ltrim($class, '\\');
	
	
	$classFile = lcfirst(substr($class, strripos($class, '\\') + 1));
	preg_match_all( '/[A-Z]/', $classFile, $matches, PREG_OFFSET_CAPTURE );
	if(!empty($matches)){
		for($i=0; $i < count($matches[0]); $i++){
			if(!empty($matches[0][$i])){
				$m = $matches[0][$i];
				$classFile = substr_replace($classFile, '_' . strToLower($m[0]), $m[1] + $i, 1);
			}
		}
	}
	
	$fileDir = explode('\\', $class, -1);
	$fileDir = strToLower(implode(DS, $fileDir));
	
	$filePath = SRC_DIR . $fileDir . DS . $classFile . '.php';
	if(!file_exists($filePath)){
		return false;
	}
	require_once($filePath);
}

spl_autoload_register('AutoLoadClasses');