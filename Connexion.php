<?php

require_once "BDD";

if (isset($_SESSION["IDCli"])){
    header("loation: Html.php");
    exit;
}

if(isset($_POST["connexion"])){
    $pseudo = htmlentities(trim($$pseudo));
    $Email = htmlentities(strtolower(trim($Email)));
    $motdepasse = trim($motdepasse);
}

if(empty($pseudo)){
    $valid = false;
    $err_pseudo = "veuilliez remplir le champs pseudo";
}

if(empty($Email)){
    $valid = false;
    $err_Email = "veuilliez remplir le champs Email";
}

if(empty($motdepasse)){
    $valid = false;
    $err_motdepasse = "veuilliez remplir le champs mot de passe";
}

$req = $BDD->query("SELECT *
            FROM Client
            WHERE Email = ? AND motdepasse = ?",
            array($Email, crypt($motdepasse,"$6$rounds=5000$macleapersonnaliseretagardersecret$")));
$req = $req->fetch();

if (!isset($req["IDCli"])){
    $valid = false;
    $err_Email = "L'Email ou le mot de passe est incorrecte";
}elseif($req["n_motdepasse"] == 1)
    $BDD->dba_insert("UPDATE Client SET n_motdepasse = 0 WHERE IDCli = ?",
    array($req["IDCli"]));

if ($req["IDCli"] == ""){
    $valid = false;
    $err_Email = "L'Email ou le mot de passe est incorrecte";
}    

?>