<?php
require_once ("../vendor/autoload.php");
use App\Utility\Utility;

$obj = new \App\Form\Form();

$obj->setData($_GET);

$obj->recover();

Utility::redirect('show.php');