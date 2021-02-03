<?php

try{
    $db = new PDO('mysql:host=localhost;port=8889;dbname=Clothes_Shop;charset=utf8', "root", "");
}
catch(Exception $e) 
{
    die('Erreur SQL');
}

if (isset($_POST["connecter"]) && $_POST["connecter"] == "connecter"){
    $pseudo=htmlspecialchars($_POST["pseudo"]);
    $motdepasse=md5(htmlspecialchars($_POST["motdepasse"]));
    $connecter=$_POST["connecter"];
    if ((isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) && preg_match ('/^(-zA-Z0-9" \'_]+)$/', $_POST ["pseudo"]))
        && (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]) && preg_match ('/^([a-zA-Z0-9 \'!@]+)$/', $_POST["motdepasse"]))){

        }
    $conn = new PDO($dsn,$user,$password);
    $conn->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $request = $conn->prepare ("SELECT COUNT (*) AS IDCli FROM client WHERE pseudo = :pseudo AND motdepasse = :motdepasse");
    $request->execute(array("pseudo"=>$pseudo,"motdepasse"=>$motdepasse));
    $data=$request->fetch();
    $request->closeCursor();
}

?>

