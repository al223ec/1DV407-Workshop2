<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 01/10/14
 * Time: 10:52
 */
namespace view; 

require_once("./src/model/member_model.php");
require_once("./src/view/view.php");

class MemberView extends View{

    private $userNamePost = "MemberView::UserNamePost"; 
    private $ssnPost = "MemberView::ssnPost"; 


    private $memberModel;
    public function shouldDispalyFullList(){
        return false; 
    }
    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }

    public function compactList(){
        $ret = "<ul>"; 
        $members = $this->memberModel->getArrayOfMembers(); 

        foreach ($members as $member) {
            $ret .= "<li>" . $member . " Antal båtar: " . $member->getNumberOfBoats() .
                "<a href='" . \core\router::$route["member"]["view"]  . $member->getId() ."'> Visa</a> | 
                <a href='" . \core\router::$route["member"]["edit"]  . $member->getId() ."'> Edit</a>  | 
                <a href='" . \core\router::$route["member"]["delete"]  . $member->getId() ."'> delete</a>  |
            </li>";
            
        }
        $ret .= "</ul>";

        return $ret . $this->listFooter();
    }


    public function fullList(){

        $ret = "<ul>"; 
        $members = $this->memberModel->getArrayOfMembers(); 
        
        foreach ($members as $member) {
            $ret .= "<li>" . $member . 
                "<a href='" . \core\router::$route["member"]["view"]  . $member->getId() ."'> Visa</a> | 
                <a href='" . \core\router::$route["member"]["edit"]  . $member->getId() ."'> Edit</a>  | 
                <a href='" . \core\router::$route["member"]["delete"]  . $member->getId() ."'> delete</a>  |
            </li>";

            $ret .= $this->getBoatList($member->getBoats()); 
        }
        $ret .= "</ul>";

        return $ret . $this->listFooter();
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



    public function view($member){
        $ret = " <h1> Medlem " . $member . "</h1>
            <p> ". $member->getSsn() ."</p>"; 
        $ret .= $this->getBoatList($member->getBoats()); 
        return $ret; 
    }
    private function getBoatList($boats){
        $ret = "<ul>";

        foreach ($boats as $boat) {
            $ret .= "<li>" . $boat. "</li>";
        }
        $ret .= "</ul>";
        return $ret; 
    }
    private function listFooter(){
        return "<a href='" . \core\router::$route["member"]["add"] . "'> Lägg till</a>";
    }
}