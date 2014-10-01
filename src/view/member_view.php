<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 01/10/14
 * Time: 10:52
 */
require_once("./src/model/member_model.php");

class MemberView{

    public function __construct() {
        $this->member_model = new memberModel();
    }

    public function compactList($member_list){
        return $ret = "
            <form method=post enctype=multipart/form-data action=CompactList>
                <fieldset>
                    <legend>Present Compact list</legend>
                     <!--<a> for every memeber in list -->
                        <a>$member_list</a>
                </fieldset>
            </form>
        ";
    }

    public function fullList($member_list){
        return $ret = "
            <form method=post enctype=multipart/form-data action=FullList>
                <fieldset>
                    <legend>Present full list</legend>
                    <!--<a> for every memeber in list -->
                         <a>$member_list</a>
                </fieldset>
            </form>
        ";
    }

    public function add($member){
        return $ret = "
            <form method=post enctype=multipart/form-data action=Add>
                <fieldset>
                    <legend>Add member</legend>
                        <label for=UserName>Name: :</label>
                            <input type=text size=20 name=userName id=userNameID value=>
                        <label for=SSN>SSN:  :</label>
                            <input type=text size=20  name=SSN id=SSNID value=>
                </fieldset>
            </form>
        ";
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
        return $ret = "
            <form method=post enctype=multipart/form-data action=?view>
                <fieldset>
                    <legend>View member</legend>
                        <p>ID: </p>
                        <p>SSN: </p>
                        <p>Name: </p>
                        <p>Boats: </p>
                </fieldset>
            </form>
        ";
    }
}