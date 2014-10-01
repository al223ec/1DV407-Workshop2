<?php

namespace view\member; 

class MemberFormView extends \view\View {
	
	private $userNamePost = "MemberView::UserNamePost"; 
    private $ssnPost = "MemberView::ssnPost"; 
    

     private $memberModel;

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }
  
    public function add($member = null){
        if($member !== null){
            //JAg editerar en member
        }
        return $ret = "
            <form method=post enctype=multipart/form-data action=".\core\router::$route["member"]["save"] .  ">
                <fieldset>
                    <legend>Add member</legend>
                        <label for=UserName>Name:</label>
                            <input type=text size=20 name=" . $this->userNamePost . " id=userNameID value=>
                        <label for=SSN>SSN:</label>
                            <input type=text size=20 name=" . $this->ssnPost . " id=SSNID value=>
                </fieldset>

                <input type='submit' name='save' value='Spara'>
            </form>
        ";
    }

    public function getUserName(){
        return $this->getCleanInput($this->userNamePost); 
    }

    public function getSsnPost(){
        return $this->getCleanInput($this->ssnPost); 
    }


    public function edit($member){
        return $ret = "
            <form method=post enctype=multipart/form-data action=Edit>
                <fieldset>
                    <legend>Edit member</legend>
                         <label for=UserName>Name: :</label>
                            <input type=text size=20 name=userName id=userNameID value=>
                        <label for=SSN>SSN:  :</label>
                            <input type=text size=20  name=SSN id=SSNID value=>
                </fieldset>
            </form>
        ";
    }
}