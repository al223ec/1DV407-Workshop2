<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 01/10/14
 * Time: 10:52
 */
namespace view; 

class MemberView extends \core\View{
    private $isLoggedIn;

    public function __construct($isLoggedIn){
        $this->isLoggedIn = $isLoggedIn;
    } 

    public function view($member){
        $memberOptions = '';
        if($this->isLoggedIn){
            $memberOptions = '
                <a href="' . \Routes::getRoute('member', 'edit')  .  $member->getId() . '"> Redigera </a> |
                <a href="' . \Routes::getRoute('member', 'delete')  . $member->getId() .'"> Ta bort </a>
            ';
        }
        return '
            <h1> Medlem </h1>
            <h2>' . $member . '</h2>
            <p> '. $memberOptions . '</p>'
            . $this->getBoatList($member) .
            '<a href="' . \Routes::getRoute('member', 'main')  . '"> Tillbaka</a>
        '; 
    }

    public function confirmDelete($member){
        return '
            <h1> Medlem </h1>
            <h2>' . $member . '</h2>
            <p> OBS! Detta kommer att ta bort medlemmen och medlemmens båtar!!!</p>
            '
             . $this->getBoatList($member) .
             '<a href="' . \Routes::getRoute('member', 'main')  . '"> Avbryt</a> |

              <a href="' . \Routes::getRoute('member', 'confirmDelete') . $member->getId() . '"> Bekfräfta borttagning</a>
        '; 
    }

    public function memberDeletedSuccessfully($member){
        return '
            <h1> Medlem </h1>
            <h2>' . $member . '</h2>
            <p> Medlem ' . $member->getName() . ' togs bort ur systemet</p>
            <a href="' . \Routes::getRoute('member', 'main')  . '"> Tillbaka</a>
        '; 
    }

    public function unknownError($message = "Något oväntat gick fel vg försök igen"){
        return '<h1> ERROR!</h1>
                <p>'. $message .'</p>
                <a href="' . \Routes::getRoute('member', 'main')  . '"> Tillbaka</a>
        '; 
    }


    private function getBoatList($member){
        $boatsHTML = '';
        $boats = $member->getBoats();
        if(!empty($boats)){
            foreach($boats as $boat){
                $boatOptions = '';
                if($this->isLoggedIn){
                    $boatOptions = ' - 
                        <a href="' . \Routes::getRoute('boat', 'edit') . $boat->getId() . '">Redigera</a> : 
                        <a href="' . \Routes::getRoute('boat', 'delete') . $boat->getId() . '">Ta bort</a>
                    ';
                }
                $boatsHTML .= '
                    <li>
                        ' . $boat . $boatOptions . '
                    </li>
                ';
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