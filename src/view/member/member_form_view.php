<?php

namespace view\member; 

class MemberFormView extends \core\View {
   
   	private $namePost = 'MemberView::NamePost'; 
    private $ssnPost = 'MemberView::ssnPost'; 
    private $memberIdPost = 'MemberView::MemberId'; 
    private $flashMessages; 

    private $flashKey = "MemberFormView::FlashKey"; 

    public function __construct() {
        $this->flashMessages = new \view\FlashMessages($this->flashKey);
    }
    
    public function getMember(){
        $member = new \model\Member($this->getMemberId());
        $member->setName($this->getName());
        $member->setSsn($this->getSsn());
        
        if($member->valid()){
            return $member; 
        }

        foreach ($member->getErrors() as $error) {
            $this->flashMessages->addFlash($error, \view\FlashMessages::FlashClassError);
        }
        return null;  
    }

    private function getName(){
        return $this->getCleanInput($this->namePost);
    }

    private function getSsn(){
        return $this->getCleanInput($this->ssnPost); 
    }

    public function getMemberId(){
        return intval($this->getCleanInput($this->memberIdPost)); 
    }
  

    public function getAddEditForm($member = null){
        $name = ""; 
        $ssn = ""; 
        $id = 0; 
        $prompt = "Lägg till member"; 

        if($member !== null){
            $name = $member->getName(); 
            $ssn = $member->getSsn(); 
            $id = $member->getId(); 
            $prompt = "Redigera member"; 
        }

        return $this->flashMessages->renderFlash() .
        '
            <form method="post" action="' . \Routes::getRoute('member', 'save') . '">
                <fieldset>
                    <legend>'. $prompt . '</legend>
                        <label for="' . $this->namePost . '">Name:</label>
                            <input type="text" size="20" name="' . $this->namePost . '" id="' . $this->namePost . '" value="'. $name .'">
                        <label for="' . $this->ssnPost . '">SSN:</label>
                            <input type="text" size="13" name="' . $this->ssnPost . '" id="' . $this->ssnPost . '" value="'. $ssn .'">
                    
                        <input type="hidden" name="'. $this->memberIdPost . '" id="'. $this->memberIdPost . '" value="'. $id . '">

                </fieldset>

                <input type="submit" name="save" value="Spara">

                <a href="' . \Routes::getRoute('member', 'main')  . '"> Avbryt</a>
            </form>
        ';
    }
}