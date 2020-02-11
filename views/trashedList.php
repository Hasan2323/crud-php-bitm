<?php


require_once ("../vendor/autoload.php");

use App\Message\Message;

$msg= Message::message();
echo " <div style='padding-top: 70px; padding-left: 500px;'> <div id='message'> $msg </div> </div> ";

$obj = new \App\Form\Form();
$allData = $obj -> trashedList();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiple trashed info</title>

    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<form id="selectionForm" action="multiple_recover.php" method="post">

<div style="padding-left: 30px;">
    <a href="../index.php" class="btn btn-info">Back to Input</a>&nbsp;&nbsp;&nbsp;
    <a href="show.php" class="btn btn-danger">Back to Index</a>&nbsp;&nbsp;&nbsp;
    <input id="recoverMultiple" type="submit" class='btn btn-warning' value="Recover Multiple">&nbsp;&nbsp;&nbsp;
    <input id="deleteMultiple" type="button" class="btn btn-danger" value="Delete Multiple">&nbsp;&nbsp;&nbsp;
</div>

<h2 align="center">Trashed List()</h2><br>

<table align="center" border="1" class="table table-bordered table-striped">
    <tr style="background-color: #007FFF; color: white">
        <th>Check All <input type="checkbox" name="select_all" id="select_all"> </th>
        <th>Serial</th>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Gender</th>
        <th>Birthday</th>
        <th>City</th>
        <th>Hobbies</th>
        <th>Picture</th>
        <th>Summary</th>
        <th>Actions</th>
    </tr>

    <?php

    $serial = 1;

    foreach ($allData as $record){

        if($serial%2) $bgColor = "#cccccc";
        else $bgColor = "#ffffff";


        echo "
        
        
        <tr style='background-color: $bgColor'>
            <td> <input type='checkbox' class='checkbox' name='multiple[]' value='$record->id' > </td>
            <td>$serial</td>
            <td>$record->id</td>
            <td>$record->name</td>
            <td>$record->email</td>
            <td>$record->gender</td>
            <td>$record->birthday</td>
            <td>$record->city</td>
            <td>$record->hobbies</td>
            <td> <img src='UploadedImages/$record->picture' alt='Profile Picture' style='border: 1px solid black; width: 100px; height: 100px;'> </td>
            <td>$record->summary</td>
            <td>
                
                <a href='recover.php?id=$record->id' class='btn btn-success'>Recover</a>
                <a href='delete.php?id=$record->id' class='btn btn-danger' onclick='return confirm_delete()' >Delete</a>
                
            </td>
            
            
        </tr>
        
        
        ";

        $serial++;

    }//end of foreach



    ?>

</table>

</form>




<script src="../resource/bootstrap/js/jquery.js"></script>
<script>

    jQuery(
        function ($) {

            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
        }
    ); //end of jQuery



    function confirm_delete() {

        return confirm("Are you sure you want to permanently delete this data?");

    }//end of delete operation



    //select all checkboxes
    $("#select_all").change(function(){  //"select all" change
        var status = this.checked; // "select all" checked status
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function(){ //".checkbox" change
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }

        //check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });
    //end of checkbox operation




    $("#deleteMultiple").click(function () {

        if(checkEmptySelection()){
            alert("Empty selection! please select some record(s) first.");
        }
        else{
            var r = confirm("Are you sure you want to permanently delete selected data(s)?");

            if(r)//r==true
            {
                //multiple selector
                var selectionForm= $("#selectionForm");
                selectionForm.attr('action','multiple_delete.php');
                selectionForm.submit();
            }
        }



        // equivalent code
//        jquery code(in the way of one selector)
//        $("#selectionForm").attr('action','multiple_delete.php').submit();

//        javascript code
//        document.getElementById('selectionForm').action='multiple_delete.php';
//        document.getElementById('selectionForm').submit();
    });
    //end of delete Multiple



    $('#recoverMultiple').click(function () {

        if(checkEmptySelection()){
            alert("Empty selection! please select some record(s) first.");
        }

    });
    //end of recoverMultiple
    
    
    function checkEmptySelection() {
        emptySelection = true;

        $('.checkbox').each(function () {
            if(this.checked) emptySelection = false;
        });

        return emptySelection;
    }
    //end of emptySelection


</script>


</body>
</html>


