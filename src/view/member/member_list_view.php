<?php

namespace view\member;

require_once('./src/view/view.php'); 

class MemberListView extends \view\View{
    
    private $memberModel;

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }

   	public function compactList(){
        $ret = "<ul>"; 
        $members = $this->memberModel->getArrayOfMembers(); 

        foreach ($members as $member) {
            $ret .= "<li>" . $member;
            $ret .= " Antal båtar: " . $member->getNumberOfBoats();
            $ret .= $this->getViewEditDeleteLinks($member); 
            $ret .= "</li>";            
        }

        $ret .= "</ul>";

        return $ret . $this->listFooter();
    }

    public function fullList(){

        $ret = "<ul>"; 
        $members = $this->memberModel->getArrayOfMembers(); 
        
        foreach ($members as $member) {
            $ret .= "<li>" . $member;
            $ret .= $this->getViewEditDeleteLinks($member); 
            $ret .= "</li>";  
            $ret .= "<li>";
            $ret .= $this->getBoatList($member->getBoats());
            $ret .= "</li>"; 
        }

        $ret .= "</ul>";
        return $ret . $this->listFooter();
    }

    private function getBoatList($boats){
        $ret = "<ul>";

        foreach ($boats as $boat) {
            $ret .= "<li>" . $boat. "</li>";
        }
        $ret .= "</ul>";
        return $ret; 
    }

    private function getViewEditDeleteLinks($member){
        return "<a href='" . \core\router::$route["member"]["view"]  . $member->getId() ."'> Visa</a> | 
                <a href='" . \core\router::$route["member"]["edit"]  . $member->getId() ."'> Edit</a>  | 
                <a href='" . \core\router::$route["member"]["delete"]  . $member->getId() ."'> delete</a>";
    }
    
    private function listFooter(){
        return "<a href='" . \core\router::$route["member"]["add"] . "'> Lägg till</a>";
    }
}
