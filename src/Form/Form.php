<?php



namespace App\Form;

use PDO;
use App\Message\Message;
use App\Model\Database;

class Form extends Database
{
    public $id;
    public $name;
    public $email;
    public $gender;
    public $birthday;
    public $city;
    public $hobbies;
    public $picture;
    public $summary;

    public function setData($postArray){

        if(array_key_exists("id", $postArray)){
            $this->id = $postArray['id'];
        }

        if(array_key_exists("name", $postArray)){
            $this->name = $postArray['name'];
        }

        if(array_key_exists("email", $postArray)){
            $this->email = $postArray['email'];
        }

        if(array_key_exists("gender", $postArray)){
            $this->gender = $postArray['gender'];
        }

        if(array_key_exists("birthday", $postArray)){
            $this->birthday = $postArray['birthday'];
        }

        if(array_key_exists("city", $postArray)){
            $this->city = $postArray['city'];
        }

        if(array_key_exists("hobbyName", $postArray)){
            $this->hobbies = $postArray['hobbyName'];
        }

        if(array_key_exists("image", $postArray)){
            $this->picture = $postArray['image'];
        }

        if(array_key_exists("summary", $postArray)){
            $this->summary = $postArray['summary'];
        }

    }//end of setData()

    public function store(){

        $hobbyName = implode(",",$this->hobbies);

        $sqlQuery = " INSERT INTO `user` (`name`, `email`, `gender`, `birthday`, `city`, `hobbies`, `picture`, `summary`) VALUES (?,?,?,?,?,?,?,?);  ";

        $dataArray = array($this->name,$this->email,$this->gender,$this->birthday,$this->city,$hobbyName,$this->picture,$this->summary);

        $STH = $this->DBH->prepare($sqlQuery);

        $result = $STH->execute($dataArray);


        if($result){
            Message::message("Success! Data has been inserted successfully!");
        }
        else{
            Message::message("Error! Data hasn't been inserted successfully!");
        }

    }//end of store

    public function show(){

        $sqlQuery = "SELECT * from user WHERE is_trashed='No' ";

        $STH = $this->DBH->query($sqlQuery);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $allData = $STH->fetchAll();

        return $allData;

    }//end of show()

    public function singleRead(){

        $sqlQuery = "SELECT * from user WHERE id=$this->id";

        $STH = $this->DBH->query($sqlQuery);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $singleData = $STH->fetch();

        return $singleData;

    }//end of singleRead()

    public function update(){

        $hobbyName = implode(",",$this->hobbies);


        $sqlQuery = " UPDATE `user` SET name = ?, email = ?, gender = ?, birthday = ?, city = ?, hobbies = ?, picture = ?, summary = ? WHERE id = $this->id ;  ";

        $dataArray = array($this->name,$this->email,$this->gender,$this->birthday,$this->city,$hobbyName,$this->picture,$this->summary);

        $STH = $this->DBH->prepare($sqlQuery);

        $result = $STH->execute($dataArray);


        if($result){
            Message::message("Success! Data has been updated successfully!");
        }
        else{
            Message::message("Error! Data hasn't been updated!");
        }

    }//end of update()


    public function trash(){

        $sqlQuery = " UPDATE `user` SET is_trashed=NOW() WHERE id = $this->id ;  ";

        $result = $this->DBH->exec($sqlQuery);

        if($result){
            Message::message("Success! Data has been soft-Deleted! To recover go to trashed List.");
        }
        else{
            Message::message("Error! Data hasn't been soft-deleted!");
        }

    }//end of trash()

    public function trashedList(){

        $sqlQuery = "SELECT * from user WHERE is_trashed<>'No' ";

        $STH = $this->DBH->query($sqlQuery);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $allData = $STH->fetchAll();

        return $allData;

    }//end of trashedList()


    public function recover(){

        $sqlQuery = " UPDATE `user` SET is_trashed='No' WHERE id = $this->id ;  ";

        $result = $this->DBH->exec($sqlQuery);

        if($result){
            Message::message("Success! Data has been recovered successfully!");
        }
        else{
            Message::message("Error! Data hasn't been recovered!");
        }

    }//end of recover()


    public function delete(){

        $sqlQuery = " DELETE from `user` WHERE id = $this->id ;  ";

        $result = $this->DBH->exec($sqlQuery);

        if($result){
            Message::message("Success! Data has been deleted successfully!");
        }
        else{
            Message::message("Error! Data hasn't been deleted!");
        }

    }//end of delete()


    public function search($requestArray){

        $sql = "";
        if( isset($requestArray['byName']) && isset($requestArray['byID']) )  $sql = "SELECT * FROM `user` WHERE `is_trashed` ='No' AND (`name` LIKE '%".$requestArray['search']."%' OR `id` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byName']) && !isset($requestArray['byID']) ) $sql = "SELECT * FROM `user` WHERE `is_trashed` ='No' AND `name` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byName']) && isset($requestArray['byID']) )  $sql = "SELECT * FROM `user` WHERE `is_trashed` ='No' AND `id` LIKE '%".$requestArray['search']."%'";

        $STH  = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $someData = $STH->fetchAll();

        return $someData;

    }//end of search()



    public function getAllKeywords(){
        $_allKeyWords =array();
        $wordsArr = array();

        $allData = $this->show();

        //for each name block start
        foreach ($allData as $oneData){
            $_allKeyWords[] = trim($oneData->name);
        }

        foreach ($allData as $oneData){
            $eachString = strip_tags($oneData->name);
            $eachString = trim($eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $wordsArr = explode(" ",$eachString);

            foreach ($wordsArr as $eachWord){
                $_allKeyWords[] = trim($eachWord);
            }
        }
        //for each name block end


        //for each ID block start

        foreach ($allData as $oneData){
            $_allKeyWords[] = trim($oneData->id);
        }

        foreach ($allData as $oneData){
            $eachString = strip_tags($oneData->id);
            $eachString = trim($eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $wordsArr = explode(" ",$eachString);

            foreach ($wordsArr as $eachWord){
                $_allKeyWords[] = trim($eachWord);
            }
        }
        //for each ID block end

        return array_unique($_allKeyWords);

    }// end of getAllKeywords()


    public function indexPaginator($page=1,$itemsPerPage=3){


        $start = (($page-1) * $itemsPerPage);

        if($start<0) $start = 0;


        $sql = "SELECT * from user  WHERE is_trashed = 'No' LIMIT $start,$itemsPerPage";


        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;


    }//end of indexPagination


}//end of Form class