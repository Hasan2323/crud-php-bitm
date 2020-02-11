<?php
require_once ("../vendor/autoload.php");
use App\Utility\Utility;


$path = $_SERVER['HTTP_REFERER'];

$obj = new \App\Form\Form();

$IDsArray = $_POST['multiple'];

foreach ($IDsArray as $id){
    $_GET['id'] = $id;
    $obj->setData($_GET);
    $obj->recover();
}

Utility::redirect($path);
