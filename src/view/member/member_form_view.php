<?php

namespace view\member; 

class MemberFormView extends \core\View {
    //bör ärva detta från ytterligare en vy bas klass
	const FlashClassError = 'error';
    const FlashClassSuccess = 'success';
    const FlashClassWarning = 'warning';

    protected $strFlashKey = 'View::FlashMessages';

    public function addFlash($strMessage, $strType){
        if($strType !== self::FlashClassError && $strType !== self::FlashClassSuccess && $strType !== self::FlashClassWarning ){
            throw new \Exception("View::addFlash wrong key sent!!");
        }
        $_SESSION[$this->strFlashKey][$strType][] = $strMessage;
    }
    
    protected function renderFlash(){
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



	private $namePost = 'MemberView::NamePost'; 
    private $ssnPost = 'MemberView::ssnPost'; 
    private $memberIdPost = 'MemberView::MemberId'; 

    private $memberModel;
    private $errors; 

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }
    
    public function getName(){
        $name = $this->getCleanInput($this->namePost); 
        
        if(strlen($name) < 3){
            $this->addFlash("För kort namn!", self::FlashClassError); 
        }
        return $name; 
    }

    public function getSsnPost(){
        return $this->getCleanInput($this->ssnPost); 
    }

    public function getMemberId(){
        return intval($this->getCleanInput($this->memberIdPost)); 
    }
  
    public function getAddEditForm($member = null){
        $name = ""; 
        $ssn = ""; 
        $id = 0; 


        if($member !== null){
            $name = $member->getName(); 
            $ssn = $member->getSsn(); 
            $id = $member->getId(); 
        }

        return $this->renderFlash() .
        '
            <form method="post" action="' . \Routes::getRoute('member', 'save') . '">
                <fieldset>
                    <legend>Add member</legend>
                        <label for="' . $this->namePost . '">Name:</label>
                            <input type="text" size="20" name="' . $this->namePost . '" id="' . $this->namePost . '" value="'. $name .'">
                        <label for="' . $this->ssnPost . '">SSN:</label>
                            <input type="text" size="20" name="' . $this->ssnPost . '" id="' . $this->ssnPost . '" value="'. $ssn .'">
                    
                        <input type="hidden" name="'. $this->memberIdPost . '" id="'. $this->memberIdPost . '" value="'. $id . '">

                </fieldset>

                <input type="submit" name="save" value="Spara">
            </form>
        ';
    }
}