<?php

$ServeurName = "";

try{
    $db = new PDO('mysql:host=192.168.64.2;port=8889;dbname=Clothes_Shop;charset=utf8', $groupe4, $password);
}
catch(Exception $e) 
{
    die('Erreur SQL');
}

?>