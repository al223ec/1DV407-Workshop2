<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 01/10/14
 * Time: 10:52
 */
namespace view; 

class MemberView extends \core\View{
    
    private $memberModel;
    
    public function view($member){
        return '
            <h1> Medlem </h1>
            <h2>' . $member . '</h2>
            <p> '. $member->getSsn() .'</p>'
             . $this->getBoatList($member) .
             '<a href="' . \Routes::getRoute('member', 'main')  . '"> Tillbaka</a>
        '; 
    }

    private function getBoatList($member){
        $boatsHTML = '';
        $boats = $member->getBoats();
        if(!empty($boats)){
            foreach($boats as $boat){
                $boatsHTML .= '<li>' . $boat. '</li>';
            }
            
            $boatsHTML = '
                <ul>
                    ' . $boatsHTML . '
                </ul>
            ';
        }
        return $boatsHTML;
    }
}