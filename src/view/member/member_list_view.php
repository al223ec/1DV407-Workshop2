<?php

namespace view\member;

class MemberListView extends \core\View{
    
    private $memberModel;
    private $fullListCookieKey = "MemberView::fullListCookieKey";
    private $memberFilter = 'MemberView::MemberFilter';

    private $isLoggedIn;

    public function __construct($memberModel, $isLoggedIn) {
        $this->memberModel = $memberModel; 
        $this->isLoggedIn = $isLoggedIn;
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

    public function getMemberFilter(){
        return isset($_POST[$this->memberFilter]) ? intval($_POST[$this->memberFilter]) : 0;
    }

    public function getMemeberList($members){
        $displayFullList = $this->shouldDispalyFullList();
        $list = "";
        
        foreach ($members as $member) {
            $list .= '<li>' . $member;
            $list .= $this->getViewEditDeleteLinks("member", $member); 
            
            if($displayFullList){
                $list .= '<li>';
                $list .= $member->getNumberOfBoats() > 0 ? $this->getBoatList($member->getBoats()) : " - Medlemmen saknar båt";
                if($this->isLoggedIn){
                    $list .= "<a href='" . \Routes::getRoute('boat', 'add')  . $member->getId() ."'>  Lägg till båt</a>"; 
                }
                $list .= '</li>'; 
            }else{
                $list .= " Antal båtar: " . $member->getNumberOfBoats();  
            }

            $list .= '</li>';  
        }

        $list = '
            ' . $this->getMemberFilterDropDown() . '
            <ul id="members">' 
                . $list . 
            '</ul>
        ';
        return $this->listHeader() . $list . $this->listFooter();
    }

    private function getBoatList($boats){
        $list = '';
        foreach ($boats as $boat) {
            $boatOption = '';
            if($this->isLoggedIn){
                $boatOption = '
                    <a href="' . \Routes::getRoute('boat', 'edit')  . $boat->getId() .'"> Redigera </a>  | 
                    <a href="' . \Routes::getRoute('boat', 'delete')  . $boat->getId() .'"> Ta bort</a>
                ';
            }
            $list .= '
                <li>
                    '. $boat . ' - ' . $boatOption . '
                </li>
            ';
        }
        $list = '<ul>' 
                . $list . 
                '</ul>';
        return $list; 
    }

    private function getViewEditDeleteLinks($controller, $obj){
        if($this->isLoggedIn){
            return "<a href='" . \Routes::getRoute($controller, 'view')  . $obj->getId() ."'> Visa</a> | 
                    <a href='" . \Routes::getRoute($controller, 'edit')  . $obj->getId() ."'> Redigera</a>  | 
                    <a href='" . \Routes::getRoute($controller, 'delete')  . $obj->getId() ."'> Ta bort</a>";
        }
        return '<a href="' . \Routes::getRoute($controller, 'view')  . $obj->getId() .'"> Visa</a>';
    }
    
    private function listFooter(){
        if($this->isLoggedIn){
            return "<a href='" . \Routes::getRoute('member', 'add') . "'> Lägg till</a>";
        }
        return '';
    }
    private function listHeader(){
        $login = ($this->isLoggedIn) ? '<a href="' . \Routes::getRoute('auth', 'signout') . '">Logga ut</a>' : '<a href="' . \Routes::getRoute('auth', 'login') . '">Logga in</a>';
        return '
            <a href="' . \Routes::getRoute('member', 'setcompact'). '"> Kompakt  lista </a> |
            <a href="' . \Routes::getRoute('member', 'setfull') . '"> Fullständig  lista </a> | 
            ' . $login . '
        ';
    }

    private function getMemberFilterDropDown(){
        return '
            <div>
                <form method="post" action="' . \Routes::getRoute('member', 'main') . '">
                    <label for="' . $this->memberFilter . '">Filtrera medlemmar</label>
                    <select name="' . $this->memberFilter . '" id="' . $this->memberFilter . '"> 
                        <option value="0">Alla</option>
                        <option value="1">Med båtar</option>
                        <option value="2">Utan båtar</option>
                    </select>
                    <input type="submit" />
                </form>
            </div>
        ';
    }
}
