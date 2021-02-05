<?php
// Inclusion de l'API reCaptcha
require 'recaptchalib.php';
 
// Définition des 2 clés
$cle_publique = "LoremIpsum";
$cle_privee   = "DolorSitAmet";
 
// Affichage du bloc reCaptcha dans le formulaire
echo recaptcha_get_html($cle_publique);





// Interrogation du serveur reCaptcha
// La réponse de reCaptcha est stockée dans la variable $reponse
$reponse = recaptcha_check_answer(
    $cle_privee,                        // Votre clé privée
    $_SERVER['REMOTE_ADDR'],            // L'adresse IP de l'utilisateur
    $_POST['recaptcha_challenge_field'],// Un identifiant (jeton) permettant à reCaptcha de vérifier la réponse
    $_POST['recaptcha_response_field']  // Ce que l'utlisateur a saisi dans le champ texte du captcha
);
 
if( !$reponse->is_valid ){
    echo "Vous avez échoué au test captcha, impossible de traiter votre formulaire";
    die();
}
?>