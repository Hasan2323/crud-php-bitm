<?php
require_once ('../vendor/autoload.php');


$obj= new \App\Form\Form();
$allData = $obj->show();


$trs="";
$sl=0;

    foreach($allData as $row) {
        $id =  $row->id;
        $name = $row->name;
        $email =$row->email;
        $gender =$row->gender;
        $birthday =$row->birthday;
        $city =$row->city;
        $hobbies =$row->hobbies;
        $picture =$row->picture;
        $summary =$row->summary;
        $sl++;
        $trs .= "<tr>";
        $trs .= "<td width='50'> $sl</td>";
        $trs .= "<td width='50'> $id </td>";
        $trs .= "<td width='250'> $name </td>";
        $trs .= "<td width='250'> $email </td>";
        $trs .= "<td width='250'> $gender </td>";
        $trs .= "<td width='250'> $birthday </td>";
        $trs .= "<td width='250'> $city </td>";
        $trs .= "<td width='250'> $hobbies </td>";
        $trs .= "<td width='250'> <img src='UploadedImages/$row->picture' alt='Profile Picture' style='border: 1px solid black; width: 100px; height: 100px;'> </td>";
        $trs .= "<td width='250'> $summary </td>";

        $trs .= "</tr>";
    }
//heredoc
$html= <<<BITM

<head>
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../resource/bootstrap/css/bootstrap.min.css">
</head>


<div class="table-responsive">
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th align='left' style='color:green'>Serial</th>
                    <th align='left' style='color:green'>ID</th>
                    <th align='left' style='color:green'>Name</th>
                    <th align='left' style='color:green'>E-mail</th>
                    <th align='left' style='color:green'>Gender</th>
                    <th align='left' style='color:green'>Birthday</th>
                    <th align='left' style='color:green'>City</th>
                    <th align='left' style='color:green'>Hobbies</th>
                    <th align='left' style='color:green'>Photo</th>
                    <th align='left' style='color:green'>Summary</th>

              </tr>
                </thead>
                <tbody>

                  $trs

                </tbody>
            </table>


BITM;


// Require composer autoload
require_once ('../vendor/mpdf/mpdf/mpdf.php');
//Create an instance of the class:

$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('StudentsDetails.pdf', 'D');


