<?php

require_once("vendor/autoload.php");

if(!isset($_SESSION)) session_start();

use App\Message\Message;

$msg = Message::message();

echo "<div style='padding-top: 70px; padding-left: 500px;'> <div id='message'> $msg </div> </div>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User info</title>

    <link rel="stylesheet" href="resource/bootstrap/css/bootstrap.min.css">
    <script src="resource/bootstrap/js/bootstrap.min.js"></script>

    <style>

        .container{
            max-width: 500px;
            border: 1px solid gray;
            border-radius: 10px;
            padding: 40px;
            margin-top: 60px;
        }

        .header{
            text-align: center;
            background-color: #007fff;
            color: white;
            padding: 5px;
        }

        /*li{*/
            /*font-family: 'Lobster', cursive;*/
        /*}*/
    </style>

</head>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="font-size: 25px;">User Information</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

<!--                <li class="active"><a href="create.php">Birth Day</a></li>-->

            </ul>
        </div>
    </div>

</nav>




<div style="padding-left: 100px;">
    <a href="views/show.php" class="btn btn-danger">Active List</a>
</div>


<div class="container">
    <div class="header">
        <h4><b>User information!</b></h4>
    </div><br>
    <form action="views/store.php" method="post" enctype="multipart/form-data">

        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your name.." required><br>


        <label for="email">E-mail:</label>
        <input type="email" class="form-control" name="email" placeholder="user@example.com" required><br>


        <label for="Gender">Gender:</label>
        &nbsp;
        <input type="radio" name="gender" value="male" required>Male&nbsp;&nbsp;
        <input type="radio" name="gender" value="female">Female
        <br>


        <label for="birthday">Birthday:</label>
        <input type="date" class="form-control" name="birthday" placeholder="" required><br>


        <label for="city">Select your city</label>
        <select name="city" class="form-control" id="" required>

            <option value="" disabled selected>Select your city..</option>
            <option name="cityName" value="Dhaka">Dhaka</option>
            <option name="cityName" value="Chittagong">Chittagong</option>
            <option name="cityName" value="Khulna">Khulna</option>
            <option name="cityName" value="Rajshahi">Rajshahi</option>
            <option name="cityName" value="Barisal">Barisal</option>
            <option name="cityName" value="Sylhet">Sylhet</option>
            <option name="cityName" value="Comilla">Comilla</option>
            <option name="cityName" value="Rangpur">Rangpur</option>


        </select><br>


        <label for="Hobbies">Hobbies:</label><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Gardening"> Gardening<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Book Reading"> Book Reading<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Photography"> Photography<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Travelling"> Travelling<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Drawing"> Drawing<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Fishing"> Fishing<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Gaming"> Gaming<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Football">  Football<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Contest Coding">  Contest Coding<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Cycling"> Cycling<br/><br/>



        <label for="profilePicture">Profile Picture(max 1MB):</label>
        <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg" required><br>


        <label for="summary">Summary:</label>
        <textarea class="form-control" name="summary" placeholder="Summary of your varsity.." required></textarea><br>

        <input type="submit" class="btn btn-danger">
    </form>
</div>






<script src="resource/bootstrap/js/jquery.js"></script>
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

</script>

</body>
</html>


