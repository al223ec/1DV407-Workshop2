<?php

namespace view; 

class FlashMessages {

 	//bör ärva detta från ytterligare en vy bas klass
	const FlashClassError = 'error';
    const FlashClassSuccess = 'success';
    const FlashClassWarning = 'warning';

    private $strFlashKey;

    public function __construct($strFlashKey){
    	$this->strFlashKey = $strFlashKey; 
    }
    public function addFlash($strMessage, $strType){
        if($strType !== self::FlashClassError && $strType !== self::FlashClassSuccess && $strType !== self::FlashClassWarning ){
            throw new \Exception("View::addFlash wrong key sent!!");
        }
        $_SESSION[$this->strFlashKey][$strType][] = $strMessage;
    }

    public function errorsExists(){
    	return isset($_SESSION[$this->strFlashKey][self::FlashClassError]);  
    }
    
    public function renderFlash(){
        $arrFlash = (isset($_SESSION[$this->strFlashKey])) ? $_SESSION[$this->strFlashKey] : array();
        $strFlash = '';

        foreach($arrFlash as $type => $arrMessages){
            $strMessages = '';
            foreach($arrMessages as $strMessage){
                $strMessages .= $type . ": " . $strMessage . '</br>';
            }
            $strFlash .='<p class="flash" />' 
                        . $strMessages . 
                        '</p>';
        }

        unset($_SESSION[$this->strFlashKey]);
        return $strFlash;
    }

} 