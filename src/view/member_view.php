<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 01/10/14
 * Time: 10:52
 */
namespace view; 

class MemberView extends \core\View{
    public function view($member){
        return '
            <h1> Medlem </h1>
            <h2>' . $member . '</h2>
            <p> <a href="' . \Routes::getRoute('member', 'edit')  .  $member->getId() . '"> 
                edit </a> |<a href="' . \Routes::getRoute('member', 'delete')  . $member->getId() .'"> delete </a> </p>'
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


    private function getBoatList($member){
        $boatsHTML = '';
        $boats = $member->getBoats();
        if(!empty($boats)){
            foreach($boats as $boat){
                $boatsHTML .= '
                    <li>
                        ' . $boat. ' - 
                        <a href="' . \Routes::getRoute('boat', 'edit') . $boat->getId() . '">edit</a> : 
                        <a href="' . \Routes::getRoute('boat', 'delete') . $boat->getId() . '">delete</a>
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