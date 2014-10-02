<?php

namespace view\member;

require_once('./src/view/view.php'); 

class MemberListView extends \view\View{
    
    private $memberModel;
    private $fullListCookieKey ="MemberView::fullListCookieKey"; 

    public function __construct($memberModel) {
        $this->memberModel = $memberModel; 
    }

    public function shouldDispalyFullList(){
        return isset($_COOKIE[$this->fullListCookieKey]); 
    }

    public function setDisplayFullList(){
        setcookie ($this->fullListCookieKey, "true", time() + 400000, '/');
    }

    public function setDisplayCompactList(){
        setcookie ($this->fullListCookieKey, "", time() - 400000, '/');
    }

   	public function compactList(){
        $ret = $this->listHeader(); 
        $ret .= "<ul>";  
        $members = $this->memberModel->getArrayOfMembers(); 

        foreach ($members as $member) {
            $ret .= "<li>" . $member;
            $ret .= " Antal båtar: " . $member->getNumberOfBoats();
            $ret .= $this->getViewEditDeleteLinks("member", $member); 
            $ret .= "</li>";            
        }

        $ret .= "</ul>";

        return $ret . $this->listFooter();
    }

    public function fullList(){
        $ret = $this->listHeader(); 
        $ret .= "<ul>"; 
        $members = $this->memberModel->getArrayOfMembers(); 
        
        foreach ($members as $member) {
            $ret .= "<li>" . $member;
            $ret .= $this->getViewEditDeleteLinks("member", $member); 
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
            $ret .= "<li>". $boat . $this->getViewEditDeleteLinks("boat", $boat) . "</li>";
        }
        $ret .= "</ul>";
        return $ret; 
    }

    private function getViewEditDeleteLinks($controller, $obj){
        return "<a href='" . \core\router::$route[$controller]["view"]  . $obj->getId() ."'> Visa</a> | 
                <a href='" . \core\router::$route[$controller]["edit"]  . $obj->getId() ."'> Edit</a>  | 
                <a href='" . \core\router::$route[$controller]["delete"]  . $obj->getId() ."'> delete</a>";
    }
    
    private function listFooter(){
        return "<a href='" . \core\router::$route["member"]["add"] . "'> Lägg till</a>";
    }
    private function listHeader(){
        return "<a href='" . \core\router::$route["member"]["setcompact"] . "'> Compact lista </a> |
            <a href='" . \core\router::$route["member"]["setfull"] . "'> Full lista </a>";  
    }
}
