<?php

require_once("../vendor/autoload.php");

if(!isset($_SESSION)) session_start();


$obj = new \App\Form\Form();
$obj->setData($_GET);
$singleData = $obj -> singleRead();
$hobbiesArray = explode(",",$singleData->hobbies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit info</title>

    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>

    <style>

        .container{
            max-width: 500px;
            border: 1px solid gray;
            border-radius: 10px;
            padding: 40px;
            margin-top: 20px;
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
            <a class="navbar-brand" href="../index.php" style="font-size: 25px;">User Information</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

<!--                <li class="active"><a href="create.php">Birth Day</a></li>-->

            </ul>
        </div>
    </div>

</nav>




 <div style='padding-top: 70px; padding-left: 100px;'>
     <a href="show.php" class="btn btn-danger">Active List</a>
 </div>



 <div class="container">
    <div class="header">
        <h4><b>User information!</b></h4>
    </div><br>
    <form action="update.php?id=<?= $singleData->id?>" method="post" enctype="multipart/form-data">

        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="<?= $singleData->name?>" required><br>


        <label for="email">E-mail:</label>
        <input type="email" class="form-control" name="email" value="<?= $singleData->email?>" required><br>


        <label for="Gender">Gender:</label>
        &nbsp;
        <input type="radio" name="gender" value="male" <?= ($singleData->gender=='male')?'checked':'' ?> required>Male&nbsp;&nbsp;
        <input type="radio" name="gender" value="female" <?= ($singleData->gender=='female')?'checked':'' ?> >Female
        <br>


        <label for="birthday">Birthday:</label>
        <input type="date" class="form-control" name="birthday" value="<?= $singleData->birthday?>" required><br>


        <label for="city">Select your city</label>
        <select name="city" class="form-control" id="">

            <option value="<?= $singleData->city?>" ><?= $singleData->city?></option>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Gardening" <? if (in_array('Gardening',$hobbiesArray)) echo 'checked'; ?> > Gardening<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Book Reading" <? if (in_array('Book Reading',$hobbiesArray)) echo 'checked'; ?>> Book Reading<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Photography" <? if (in_array('Photography',$hobbiesArray)) echo 'checked'; ?>> Photography<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Travelling" <? if (in_array('Travelling',$hobbiesArray)) echo 'checked'; ?>> Travelling<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Drawing" <? if (in_array('Drawing',$hobbiesArray)) echo 'checked'; ?>> Drawing<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Fishing" <? if (in_array('Fishing',$hobbiesArray)) echo 'checked'; ?>> Fishing<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Gaming" <? if (in_array('Gaming',$hobbiesArray)) echo 'checked'; ?>> Gaming<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Football" <? if (in_array('Football',$hobbiesArray)) echo 'checked'; ?>>  Football<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Contest Coding" <? if (in_array('Contest Coding',$hobbiesArray)) echo 'checked'; ?>>  Contest Coding<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobbyName[]"  value="Cycling" <? if (in_array('Cycling',$hobbiesArray)) echo 'checked'; ?>> Cycling<br/><br/>


        <div>
            <label for="profilePicture">Profile Picture(max 1MB):</label>
            <input type="hidden" name="image" value="<?= $singleData->picture ?>">
            <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg" >
            <?php echo " <img src='UploadedImages/$singleData->picture' width='70px' height='70px'> "; ?>
        </div><br>

        <label for="summary">Summary:</label>
        <textarea class="form-control" name="summary" required> <?= $singleData->summary?> </textarea><br>

        <input type="submit" value="Update" class="btn btn-danger">
    </form>
</div>


</body>
</html>


