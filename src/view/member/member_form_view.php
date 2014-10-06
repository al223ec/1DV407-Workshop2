<?php

namespace view\member; 

class MemberFormView extends \core\View {
	
	private $namePost = 'MemberView::NamePost'; 
    private $ssnPost = 'MemberView::ssnPost'; 
    private $memberModel;
    private $errors; 

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }
    
    public function getName(){
        $name = $this->getCleanInput($this->namePost); 

        if(strlen($name) < 3){

        }
        return $this->getCleanInput($this->namePost); 
    }

    public function getSsnPost(){
        return $this->getCleanInput($this->ssnPost); 
    }
  
    public function getAddEditForm($member = null){
        $name = ""; 
        $ssn = ""; 
        $id = ""; 

        if($member !== null){
            $name = $member->getName(); 
            $ssn = $member->getSsn(); 
            $id = $member->getId(); 
        }

        return '
            <form method="post" action="' . \Routes::getRoute('member', 'save') . $id . '">
                <fieldset>
                    <legend>Add member</legend>
                        <label for="' . $this->namePost . '">Name:</label>
                            <input type="text" size="20" name="' . $this->namePost . '" id="' . $this->namePost . '" value="'. $name .'">
                        <label for="' . $this->ssnPost . '">SSN:</label>
                            <input type="text" size="20" name="' . $this->ssnPost . '" id="' . $this->ssnPost . '" value="'. $ssn .'">
                </fieldset>

                <input type="submit" name="save" value="Spara">
            </form>
        ';
    }
}