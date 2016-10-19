<?php
require_once dirname(__DIR__)."/_config/autoloader.php";
$sec = new Security();
$sec->sec_session_start();
$login = new Authentication();
$login->logout();
header("Location: ../index.php");
