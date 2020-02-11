<?php


require_once ("../vendor/autoload.php");

use App\Message\Message;
use App\Utility\Utility;

$msg= Message::message();
echo " <div style='padding-top: 40px; padding-left: 500px;'> <div id='message'> $msg </div> </div> ";

$obj = new \App\Form\Form();
$allData = $obj -> show();


################## search  block 1 of 5 start ##################

if(isset($_REQUEST['search'])){
    $someData = $obj->search($_REQUEST);
}

$availableKeywords = $obj->getAllKeywords();
$comma_separated_keywords = '"'.implode('","',$availableKeywords).'"';

################## search  block 1 of 5 end ##################



######################## pagination code block#1 of 2 start ######################################
$recordCount= count($allData);


if(isset($_REQUEST['Page']))   $page = $_REQUEST['Page'];
else if(isset($_SESSION['Page']))   $page = $_SESSION['Page'];
else   $page = 1;
$_SESSION['Page']= $page;


if(isset($_REQUEST['ItemsPerPage']))   $itemsPerPage = $_REQUEST['ItemsPerPage'];
else if(isset($_SESSION['ItemsPerPage']))   $itemsPerPage = $_SESSION['ItemsPerPage'];
else   $itemsPerPage = 3;
$_SESSION['ItemsPerPage']= $itemsPerPage;



$pages = ceil($recordCount/$itemsPerPage);

$someData = $obj->indexPaginator($page,$itemsPerPage);
$allData= $someData;


$serial = (  ($page-1) * $itemsPerPage ) +1;



if($serial<1) $serial=1;
####################### pagination code block#1 of 2 end #########################################




################## search  block 2 of 5 start ##################
if(isset($_REQUEST['search']) ){
    $someData =  $obj->search($_REQUEST);
    $serial = 1;
    $allData=$someData;
}

//if(isset($_REQUEST['search']) ) {
//    $serial = 1;
//    $allData=$someData;
//
//}
################## search  block 2 of 5 end ################


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multiple info</title>

    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>


    <!-- required for search, block3 of 5 start -->

    <link rel="stylesheet" href="../resource/bootstrap/css/jquery-ui.css">
    <script src="../resource/bootstrap/js/jquery.js"></script>
    <script src="../resource/bootstrap/js/jquery-ui.js"></script>

    <!-- required for search, block3 of 5 end -->


<!--    confirm box-->
<!--    <script src="../resource/bootstrap/js/sweetalert.min.js"></script>-->
<!--    <link rel="stylesheet" type="text/css" href="../resource/bootstrap/css/sweetalert.css">-->



</head>
<body>


<!-- required for search, block 4 of 5 start -->

<div style="margin-left: 70%">
    <form id="searchForm" action="show.php"  method="get" style="margin-top: 5px; margin-bottom: 10px ">
        <input type="text" value="" id="searchID" name="search" placeholder="Search" width="60" >
        <input type="checkbox"  name="byName"  checked >By Name
        <input type="checkbox"  name="byID"   checked  >By ID
        <input hidden type="submit" class="btn-primary" value="search">
    </form>
</div>

<!-- required for search, block 4 of 5 end -->






<form id="selectionForm" action="multiple_trash.php" method="post">

    <div style="padding-left: 30px; padding-top: 10px;">
        <a href="../index.php" class="btn btn-danger glyphicon glyphicon-chevron-left"> Back to Input</a>&nbsp;&nbsp;&nbsp;
        <a href="trashedList.php" class="btn btn-info glyphicon glyphicon-list-alt"> Trashed List</a>&nbsp;&nbsp;&nbsp;
        <input  id="trashMultiple" type="submit" class='btn btn-warning' value="Trash Multiple">&nbsp;&nbsp;&nbsp;
        <input id="deleteMultiple" type="button" class="btn btn-danger" value="Delete Multiple">&nbsp;&nbsp;&nbsp;

        <a href="pdf.php" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-down"></span> Download as PDF</a>
        <a href="xl.php" class="btn btn-success"><span class="glyphicon glyphicon-circle-arrow-down"></span> Download as excel</a>
        <a href="email.php?list=1" class="btn btn-info"><span class="glyphicon glyphicon-envelope"></span> Email this list</a>
    </div>

    <h2 align="center">User Info List()</h2><br>









    <select style="margin-left: 45%; max-width: 110px;" class="form-control"  name="ItemsPerPage" id="ItemsPerPage" onchange="javascript:location.href = this.value;" >
        <?php
        if($itemsPerPage==3 ) echo '<option value="?ItemsPerPage=3" selected >Show 3</option>';
        else echo '<option  value="?ItemsPerPage=3">Show 3</option>';

        if($itemsPerPage==5 )  echo '<option  value="?ItemsPerPage=5" selected >Show 5</option>';
        else echo '<option  value="?ItemsPerPage=5">Show 5</option>';


        if($itemsPerPage==10 )   echo '<option  value="?ItemsPerPage=10"selected >Show 10</option>';
        else echo '<option  value="?ItemsPerPage=10">Show 10</option>';

        if($itemsPerPage==15 )  echo '<option  value="?ItemsPerPage=15"selected >Show 15</option>';
        else    echo '<option  value="?ItemsPerPage=15">Show 15</option>';
        ?>
    </select><br>





















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

    //$serial = 1;

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
                <a href='view.php?id=$record->id' class='glyphicon glyphicon-eye-open btn btn-primary'> View </a>
                <a href='edit.php?id=$record->id' class='glyphicon glyphicon-pencil btn btn-success'> Edit </a>
                <a href='trash.php?id=$record->id' class='glyphicon glyphicon-trash btn btn-warning'> Trash </a>
                <a href='delete.php?id=$record->id' class='glyphicon glyphicon-remove btn btn-danger' onclick='return confirm_delete()' > Delete </a>
                <a href='email.php?id=$record->id' class='glyphicon glyphicon-envelope btn btn-info'> E-mail </a>
            </td>
            
            
        </tr>
        
        
        ";

        $serial++;

    }//end of foreach



    ?>

</table>

</form>






<!--  ######################## pagination code block#2 of 2 start ###################################### -->
<div align="center" class="container">
    <ul class="pagination">

        <?php

        $pageMinusOne  = $page-1;
        $pagePlusOne  = $page+1;


        if($page>$pages) Utility::redirect("show.php?Page=$pages");

        if($page>1)  echo "<li><a href='show.php?Page=$pageMinusOne'>" . "&laquo;" . "</a></li>";


        for($i=1;$i<=$pages;$i++)
        {
            if($i==$page) echo '<li class="active"><a href="">'. $i . '</a></li>';
            else  echo "<li><a href='?Page=$i'>". $i . '</a></li>';

        }
        if($page<$pages) echo "<li><a href='show.php?Page=$pagePlusOne'>" . "&raquo;" . "</a></li>";

        ?>

<!--        <select  class="form-control"  name="ItemsPerPage" id="ItemsPerPage" onchange="javascript:location.href = this.value;" >-->
<!--            --><?php
//            if($itemsPerPage==3 ) echo '<option value="?ItemsPerPage=3" selected >Show 3 Items Per Page</option>';
//            else echo '<option  value="?ItemsPerPage=3">Show 3 Items Per Page</option>';
//
//            if($itemsPerPage==4 )  echo '<option  value="?ItemsPerPage=4" selected >Show 4 Items Per Page</option>';
//            else  echo '<option  value="?ItemsPerPage=4">Show 4 Items Per Page</option>';
//
//            if($itemsPerPage==5 )  echo '<option  value="?ItemsPerPage=5" selected >Show 5 Items Per Page</option>';
//            else echo '<option  value="?ItemsPerPage=5">Show 5 Items Per Page</option>';
//
//            if($itemsPerPage==6 )  echo '<option  value="?ItemsPerPage=6"selected >Show 6 Items Per Page</option>';
//            else echo '<option  value="?ItemsPerPage=6">Show 6 Items Per Page</option>';
//
//            if($itemsPerPage==10 )   echo '<option  value="?ItemsPerPage=10"selected >Show 10 Items Per Page</option>';
//            else echo '<option  value="?ItemsPerPage=10">Show 10 Items Per Page</option>';
//
//            if($itemsPerPage==15 )  echo '<option  value="?ItemsPerPage=15"selected >Show 15 Items Per Page</option>';
//            else    echo '<option  value="?ItemsPerPage=15">Show 15 Items Per Page</option>';
//            ?>
<!--        </select>-->
    </ul>
</div>
<!--  ######################## pagination code block#2 of 2 end ###################################### -->









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
    )
    //end of jQuery



    function confirm_delete(){
        return confirm("Are you sure you want to permanently delete this data?");
    }
    //end of delete operation



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
            alert("Empty selection! please select some record(s).");
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




    $('#trashMultiple').click(function () {

        if(checkEmptySelection()){
            alert("Empty selection! please select some record(s) first.");
        }

    });
    //end of trashMultiple


    function checkEmptySelection() {
        var emptySelection = true;

        $('.checkbox').each(function () {
            if(this.checked) emptySelection = false;
        });

        return emptySelection;
    }
    //end of emptySelection







    <!-- required for search, block 5 of 5 start -->

    $(function() {
        var availableTags = [

            <?php
            echo $comma_separated_keywords;
            ?>
        ];
        // Filter function to search only from the beginning of the string
        $( "#searchID" ).autocomplete({
            source: function(request, response) {

                var results = $.ui.autocomplete.filter(availableTags, request.term);

                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });

                response(results.slice(0, 15));

            }
        });


        $( "#searchID" ).autocomplete({
            select: function(event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });


    });

<!-- required for search, block 5 of 5 end -->

</script>


</body>
</html>


