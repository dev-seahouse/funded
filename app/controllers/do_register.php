<?php
require_once("../_config/autoloader.php");
$reg = new Register();
$output = $reg->register();
header('Content-type: application/json');
echo $output->toJson();

