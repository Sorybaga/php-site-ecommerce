<?php 
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['Produit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}


function ajouterArticle($Produit,$qteProduit,$prixProduit){

//Si le panier existe
if (creationPanier() && !isVerrouille())
{
   //Si le produit existe déjà on ajoute seulement la quantité
   $positionProduit = array_search($Produit,  $_SESSION['panier']['Produit']);

   if ($positionProduit !== false)
   {
      $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
   }
   else
   {
      //Sinon on ajoute le produit
      array_push( $_SESSION['panier']['Produit'],$Produit);
      array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
      array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
   }
}
else
echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function supprimerArticle($Produit){
    //Si le panier existe
    if (creationPanier() && !isVerrouille())
    {
       //Nous allons passer par un panier temporaire
       $tmp=array();
       $tmp['Produit'] = array();
       $tmp['qteProduit'] = array();
       $tmp['prixProduit'] = array();
       $tmp['verrou'] = $_SESSION['panier']['verrou'];
 
       for($i = 0; $i < count($_SESSION['panier']['Produit']); $i++)
       {
          if ($_SESSION['panier']['Produit'][$i] !== $Produit)
          {
             array_push( $tmp['Produit'],$_SESSION['panier']['Produit'][$i]);
             array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
             array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
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
 


 function modifierQTeArticle($Produit,$qteProduit){
    //Si le panier existe
    if (creationPanier() && !isVerrouille())
    {
       //Si la quantité est positive on modifie sinon on supprime l'article
       if ($qteProduit > 0)
       {
          //Recherche du produit dans le panier
          $positionProduit = array_search($Produit,  $_SESSION['panier']['Produit']);
 
          if ($positionProduit !== false)
          {
            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
          }
       }
       else
       supprimerArticle($Produit);
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
 }
 

 function MontantGlobal(){
    $total=0;
    for($i = 0; $i < count($_SESSION['panier']['Produit']); $i++)
    {
        $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        return $total;
    }

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