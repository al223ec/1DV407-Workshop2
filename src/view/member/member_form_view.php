<?php

namespace view\member; 

class MemberFormView extends \core\View {
   
   	private $namePost = 'MemberView::NamePost'; 
    private $ssnPost = 'MemberView::ssnPost'; 
    private $memberIdPost = 'MemberView::MemberId'; 
    private $flashMessages; 

    private $flashKey = "MemberFormView::FlashKey"; 

    private $memberModel;

    public function __construct($memberModel) {
        $this->memberModel = $memberModel;
        $this->flashMessages = new \view\FlashMessages($this->flashKey);
    }
    
    public function getName(){
        $name = $this->getCleanInput($this->namePost);

        if(strlen($name) < \model\Member::$nameMinLength){
            $this->flashMessages->addFlash("För kort namn!", \view\FlashMessages::FlashClassError); 
            return ""; 
        } 
        return $name; 
    }

    public function getSsnPost(){
        $ssn = $this->getCleanInput($this->ssnPost); 
        $ssn = preg_replace(\model\Member::$validChars, '', $ssn);
         
        if(strlen($ssn) < \model\Member::$ssnMinLength){
            $this->flashMessages->addFlash("För kort ssn!", \view\FlashMessages::FlashClassError); 
            return ""; 
        } else if (strlen($ssn) > \model\Member::$ssnMaxLength ) {
            $this->flashMessages->addFlash("För lång ssn! Ange ssn i 881078-XXXX format", \view\FlashMessages::FlashClassError); 
            return ""; 
        } else if($ssn !== $this->getCleanInput($this->ssnPost)){
            $this->flashMessages->addFlash("Ssn innehåller ogiltiga tecken endast siffror tillåtet!", \view\FlashMessages::FlashClassError); 
            return ""; 
        }
        return $ssn; 
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