<?php


require_once ("../vendor/autoload.php");


$obj = new \App\Form\Form();
$obj->setData($_GET);
$singleData = $obj -> singleRead();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single info</title>

    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div style="padding-left: 30px; padding-top: 30px;">
    <a href="show.php" class="btn btn-danger">Back to List</a>
</div>

<h2 align="center"><?= $singleData->name ?>'s Info</h2><br>

<table align="center" border="1" class="table table-bordered table-striped">
    <tr style="background-color: #007FFF; color: white">

        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Gender</th>
        <th>Birthday</th>
        <th>City</th>
        <th>Hobbies</th>
        <th>Picture</th>
        <th>Summary</th>

    </tr>

    <?php





        echo "
        
        
        <tr>
            
            <td>$singleData->id</td>
            <td>$singleData->name</td>
            <td>$singleData->email</td>
            <td>$singleData->gender</td>
            <td>$singleData->birthday</td>
            <td>$singleData->city</td>
            <td>$singleData->hobbies</td>
            <td> <img src='UploadedImages/$singleData->picture' alt='Profile Picture' style='border: 1px solid black; width: 200px; height: 200px;'> </td>
            <td>$singleData->summary</td>
            
            
            
        </tr>
        
        
        ";





    ?>

</table>



</body>
</html>


