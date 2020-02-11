<?php
require_once ("../vendor/autoload.php");
use App\Utility\Utility;

$obj = new \App\Form\Form();

$IDsArray = $_POST['multiple'];

foreach ($IDsArray as $id){
    $_GET['id'] = $id;
    $obj->setData($_GET);
    $obj->trash();
}

Utility::redirect('show.php');
