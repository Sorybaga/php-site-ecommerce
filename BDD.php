<?php

try{
    $db = new PDO('mysql:host=localhost;port=8889;dbname=Clothes_Shop;charset=utf8', "root", "");
}
catch(Exception $e) 
{
    die('Erreur SQL');
}

?>