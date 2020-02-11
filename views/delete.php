<?php

$path = $_SERVER['HTTP_REFERER'];

require_once ("../vendor/autoload.php");
use App\Utility\Utility;

$obj = new \App\Form\Form();

$obj->setData($_GET);

$obj->delete();

Utility::redirect($path);