<?php

namespace view\member; 

class MemberFormView extends \core\View {
	
	private $userNamePost = 'MemberView::UserNamePost'; 
    private $ssnPost = 'MemberView::ssnPost'; 
    private $memberModel;

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }
    
    public function getUserName(){
        return $this->getCleanInput($this->userNamePost); 
    }

    public function getSsnPost(){
        return $this->getCleanInput($this->ssnPost); 
    }
  
    public function add($member = null){
        if($member !== null){
            //JAg editerar en member
        }
        return $ret = '
            <form method="post" action="' . \Routes::getRoute('member', 'save') . '">
                <fieldset>
                    <legend>Add member</legend>
                        <label for="' . $this->userNamePost . '">Name:</label>
                            <input type="text" size="20" name="' . $this->userNamePost . '" id="' . $this->userNamePost . '">
                        <label for="' . $this->ssnPost . '">SSN:</label>
                            <input type="text" size="20" name="' . $this->ssnPost . '" id="' . $this->ssnPost . '">
                </fieldset>

                <input type="submit" name="save" value="Spara">
            </form>
        ';
    }

    public function edit($member){
        return $ret = '
            <form method="post" action="' . \Routes::getRoute('member', 'edit') . '">
                <fieldset>
                    <legend>Edit member</legend>
                         <label for="' . $this->userNamePost . '">Name:</label>
                            <input type="text" size="20" name="' . $this->userNamePost . '" id="' . $this->userNamePost . '">
                        <label for="' . $this->ssnPost . '">SSN:</label>
                            <input type="text" size="20"  name="' . $this->ssnPost . '" id="' . $this->ssnPost . '">
                </fieldset>
            </form>
        ';
    }
}