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
    
    private $memberModel;
    
    public function view($member){
        $ret = " <h1> Medlem </h1><h2>" . $member . "</h2>
            <p> ". $member->getSsn() ."</p>"; 
        $ret .= $this->getBoatList($member->getBoats()); 
        $ret .= "<a href='" . \core\router::$route["member"]["main"]  . "'> Tillbaka</a>"; 
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
}