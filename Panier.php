<?php 

require_once "BDD";

?>

<?php

function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['nVet'] = array();
      $_SESSION['panier']['qtteAchat'] = array();
      $_SESSION['panier']['Facturation'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

function ajouterArticle($nVet,$qtteAchat,$Facturation){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($nVet,  $_SESSION['panier']['']);
      if ($positionProduit !== false)
      {
         $_SESSION['panier']['qtteAchat'][$positionProduit] += $qtteAchat;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['nVet'],$nVet);
         array_push( $_SESSION['panier']['qtteAchat'],$qtteAchat);
         array_push( $_SESSION['panier']['Facturation'],$Facturation);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function supprimerArticle($nVet){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['nVet'] = array();
      $tmp['qtteAchat'] = array();
      $tmp['Facturation'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];


      for($i = 0; $i < count($_SESSION['panier']['nVet']); $i++)
      {
         if ($_SESSION['panier']['nVet'][$i] !== $nVet)
         {
            array_push( $tmp['nVet'],$_SESSION['panier']['nVet'][$i]);
            array_push( $tmp['qtteAchat'],$_SESSION['panier']['qtteAchat'][$i]);
            array_push( $tmp['pFacturation'],$_SESSION['panier']['Facturation'][$i]);
         }
      
      }

      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($nVet,$qtteAchat){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qtteAchat > 0)
      {
         //Recherche du produit dans le panier
         $positionProduit = array_search($nVet,  $_SESSION['panier']['nVet']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qtteAchat'][$positionProduit] = $qtteAchat ;
         }
      }
      else
      supprimerArticle($nVet);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['nVet']); $i++)
   {
      $total += $_SESSION['panier']['qtteAchat'][$i] * $_SESSION['panier']['Facturation'][$i];
   }
   return $total;
}

function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['nVet']);
   else
   return 0;

}

function supprimePanier(){
   unset($_SESSION['panier']);
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="StyleConnexion.css"/>
    <header><div id= "ClothesShop-section-header" class= "ClothesShop-section">
    <nav class="slide-nav_wrapper">
    <ul id="SlideNav" class="slide-nav">
    <li class="slide-nav_item border-bottom">
    <a> Acceuil </a>
    </li>
    <button type="button" value="Connexion" >
    Se connecter 
    </a>
    <button type="button" value="Inscription">
    S'inscrire
    </div>
    </header>
    <body>

   <div class = "empty-bag-contents-holder">
   <h2 class="empty-bag-title" data-bind="localeText: {key: 'lang_bag_empty_heading'}">Votre panier est actuellement vide.</h2>

   



    </body>


    </html>
