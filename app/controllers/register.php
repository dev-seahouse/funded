<?php
include("../data/DbConnection.php");

$pdo = DbConnection::getInstance();
var_dump($pdo);