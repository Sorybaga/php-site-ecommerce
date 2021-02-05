<?php

$ServeurName = "2eurhost.com";
$dbName = "eurh_groupe4";
$UserName = "groupe4";
$password ="G0xi7u7?";

try{
    $db = new PDO("mysql:host=$ServeurName;dbname=$dbName;charset=utf8", $UserName, $password);
}
catch(Exception $e) 
{
    die('Erreur SQL');
}

?>