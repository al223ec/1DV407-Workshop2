<?php

namespace view\member;

class MemberListView extends \core\View{
    
    private $memberModel;
    private $fullListCookieKey = "MemberView::fullListCookieKey"; 

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

    public function getMemeberList($displayFullList){
        $list = "";
        $members = $this->memberModel->getArrayOfMembers(); 

        foreach ($members as $member) {
            $list .= '<li>' . $member;
            $list .= $this->getViewEditDeleteLinks("member", $member); 
            $list .= '</li>';  
            if($displayFullList){
                $list .= '<li>';
                $list .= $member->getNumberOfBoats() > 0 ? $this->getBoatList($member->getBoats()) : " - Medlemmen saknar båt";
            }
        }

        $list = '<ul>' 
                . $list . 
                '</ul>';
        return $this->listHeader() . $list . $this->listFooter();
    }

    private function getBoatList($boats){
        $list = '';
        foreach ($boats as $boat) {
            $list .= '
                <li>
                    '. $boat . ' - 
                    <a href="' . \Routes::getRoute('boat', 'edit')  . $boat->getId() .'"> Edit</a>  | 
                    <a href="' . \Routes::getRoute('boat', 'delete')  . $boat->getId() .'"> delete</a>
                </li>
            ';
        }
        $list = '<ul>' 
                . $list . 
                '</ul>';
        return $list; 
    }

    private function getViewEditDeleteLinks($controller, $obj){
        return "<a href='" . \Routes::getRoute($controller, 'view')  . $obj->getId() ."'> Visa</a> | 
                <a href='" . \Routes::getRoute($controller, 'edit')  . $obj->getId() ."'> Edit</a>  | 
                <a href='" . \Routes::getRoute($controller, 'delete')  . $obj->getId() ."'> delete</a>";
    }
    
    private function listFooter(){
        return "<a href='" . \Routes::getRoute('member', 'add') . "'> Lägg till</a>";
    }
    private function listHeader(){
        return "<a href='" . \Routes::getRoute('member', 'setcompact'). "'> Compact lista </a> |
            <a href='" . \Routes::getRoute('member', 'setfull') . "'> Full lista </a>";  
    }
}
