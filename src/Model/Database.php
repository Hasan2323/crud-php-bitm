<?php


namespace App\Model;

use PDO, PDOException;



class Database
{
    public $DBH;

    public function __construct()
    {
        try{
            $this->DBH = new PDO("mysql:dbname=full_form;host=localhost", "root", "");

            //echo "Database connection successful!<br>";

        }catch (PDOException $error){

            echo $error->getMessage();
        }


    }//end of __construct


}//end of Database class