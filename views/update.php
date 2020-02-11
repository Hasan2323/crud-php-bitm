<?php


require_once ("../vendor/autoload.php");
use App\Utility\Utility;

$obj = new \App\Form\Form();

//$fileName= time().$_FILES['image'] ['name'];
//
//$source = $_FILES['image'] ['tmp_name'];
//
//$destination= "UploadedImages/".$fileName;
//
//move_uploaded_file($source,$destination);
//
//$_POST['image']= $fileName;
//
//
//$obj->setData($_POST);
//$obj->setData($_GET);
//$obj->update();



if($_FILES['image']['name'] == ''){

    $obj->setData($_POST);
    $obj->setData($_GET);

    $obj -> update();


}


else{

    $fileName= time().$_FILES['image'] ['name'];

    $source = $_FILES['image'] ['tmp_name'];

    $destination= "UploadedImages/".$fileName;

    move_uploaded_file($source,$destination);

    $_POST['image']= $fileName;

    $obj->setData($_POST);
    $obj->setData($_GET);

    $obj -> update();

}



Utility::redirect("show.php");