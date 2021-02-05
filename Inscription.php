<?php

require_once "BDD.php";

if (!empty($_POST)){
    extract($_POST);
    $valid = true;
}

if (isset($_POST["Inscription"])){
    $Pseudo = htmlentities(trim($Pseudo));
    $dateNaiss = htmlentities(trim($dateNaiss));
    $villeCli = htmlentities(trim($villeCli));
    $Email = htmlentities(strtolower(trim($Email)));
    $motdepasse = trim($motdepasse);
}

if(empty($Pseudo)){
    $valid = false;
    $er_pseudo = ("veuilliez remplir le champs ");
}

if(empty($dateNaiss)){
    $valid = false;
    $er_dateNaiss = ("veuilliez remplir le champs ");
}

if(empty($villeCli)){
    $valid = false;
    $er_villeCli = ("veuilliez remplir le champs ");
}

if(empty($Email)){
    $valid = false;
    $er_Email = ("veuilliez remplir le champs ");
 }elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i",$Email)){
     $valid = false;
     $er_Email = "L' email est pas bon";
 }


if(empty($motdepasse)){
    $valid = false;
    $er_motdepasse = "veuilliez remplir le champs";

}elseif($motdepasse != $confmotdepasse) {
    $valid = false;
    $er_motdepasse = " la confirmation du mot de passe doit être identique au mot de passe";
}

if($valid){

    $motdepasse = crypt($motdepasse,"$6$rounds=5000$macleapersonnaliseretagardersecret$");
    $date_creation_compte = date ('Y-m-d H:i:d');

    $db->insert ("INSERT INTO Client(IDCli,pseudo,dateNaiss,villeCLI,Email,motdepasse) 
    VALUES(?, ?, ?, ?, ?");
    array($IDCli,$Pseudo, $dateNaiss, $villeCli, $Email, $motdepasse);

    header("Location: Html.php");
    exit;
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="StyleInscription.css"/>
    <title>Clothes Shop</title>
   <header><div id= "ClothesShop-section-header" class= "ClothesShop-section">
    <nav class="slide-nav_wrapper">
    <ul id="SlideNav" class="slide-nav">
    <li class="slide-nav_item border-bottom">
    <a> Acceuil </a>
    </li>
    <li class="slide-nav__item meduim-up--hide">
    <button type="button" value="Achat"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
</svg>
    Mon panier
    </a>
    <button type="button" value="Connexion" >
    Se connecter 
    </a>
    </div>
    </ul>
    </header>
    <body>

    <form action="/ma-page-de-inscription" method="post">
    <div>
        <label for="name">Pseudo :</label>
        <input type="text" id="name" name="user_pseudo">
    </div>
    <div>
        <label for="VilleCli">Ville :</label>
        <textarea id="text" name="user_VilleClient"></textarea>
    </div>   
    <div>
        <label for="DateNaiss">Date de naissance :</label>
        <textarea id="text" name="user_DateNaissance"></textarea>
    </div>
    <div>
        <label for="mail">e-mail :</label>
        <input type="email" id="mail" name="user_mail">
    </div>
    <div>
        <label for="Mdp">Mot de passe :</label>
        <input type="password" id="pwd" name="user_password">
    </div>
    <div>
        <label for="Mdp">Confirmation du mot de passe :</label>
        <input type="password" id="pwd" name="user_ConfirmPassword">
    </div>

    <div class="button">
        <button type="submit"> S'inscrire</button>
    </div>


    </body>

    </html>