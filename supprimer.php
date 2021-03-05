<?php
 // On démarre une session
 session_start();
 
// est-ce que l'id existe et n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){
   require_once('connexion.php');
   
   //on netttoie l 'id envoyé
   $id = strip_tags($_GET['id']);
   
   $sql = 'SELECT * FROM `articles` WHERE `id` =:id;';

   //on prepare la requete
   
   $query = $db->prepare($sql);

   //on accroche les parametres (id)
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   
   //on execute la requete 
   $query->execute();
   
   //on recupere l'article
   $monarticle = $query->fetch();

   // on verifie si le produit existe
if(!$monarticle){
    $_SESSION['erreur'] = "Cet id n'existe pas";
    header('Location: index.php');
 
}

   
$sql =' DELETE FROM `articles` WHERE `id` =:id;';

//on prepare la requete
$query = $db->prepare($sql);

//on accroche les parametres (id)
$query->bindValue(':id', $id, PDO::PARAM_INT);

//on execute la requete 
$query->execute();

$_SESSION['erreur'] = "Produit supprimer";
    header('Location: index.php');

}else{
    $_SESSION['erreur'] = "Url invalide";
    header('Location: index.php');
}

?>