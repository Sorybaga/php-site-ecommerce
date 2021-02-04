<?php

require_once "BDD";

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

    $BDD->insert ("INSERT INTO Client(IDCli,pseudo,dateNaiss,villeCLI,Email,motdepasse) 
    VALUES(?, ?, ?, ?, ?");
    array($IDCli,$Pseudo, $dateNaiss, $villeCli, $Email, $motdepasse);

    header("Location: Html.php");
    exit;
}
?>