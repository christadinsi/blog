<?php
 // On démarre une session
 session_start();
 
 
if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['auteur']) && !empty($_POST['auteur'])
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['article']) && !empty($_POST['article'])){
         
        // On inclut la connexion à la base de données
        require_once('connexion.php');
        //on nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $auteur = strip_tags($_POST['auteur']);
        $titre= strip_tags($_POST['titre']);
        $article = strip_tags($_POST['article']);
        
        $sql ='UPDATE `articles` SET `auteur`=:auteur,`titre`=:titre,`article`=:article WHERE
        `id`=:id;'; 
        
        $query = $db->prepare($sql);
        
        $query->bindValue(':id', $id, PDO::PARAM_INT); 
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR); 
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':article', $article, PDO::PARAM_STR);

        $query->execute();
        
        $_SESSION['message']= "Article modifier";
        require_once('fermeture.php');

        header('Location: index.php');
    }else{
$_SESSION['erreur']= "Le formulaire est incomplet";
header('Location: formulaire.php');  
    }
}
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
     $_SESSION['erreur'] = "Cet id n existe pas";
     header('Location: index.php');
 }
 }else{
     $_SESSION['erreur'] = "Url invalide";
     header('Location: index.php');
 }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Modifier un produit</title>
</head>

<body>

    <?php
    if (!empty($_SESSION['erreur'])) {
        echo $_SESSION['erreur'];
        $_SESSION['erreur'] = "";
    }
    ?>
    <?php

    if (!empty($_SESSION['message'])) {
        echo $_SESSION['message'];
        $_SESSION['message'] = "";
    }
    ?>

    <form method="post">

        <div class="bloc">
            <h1>Le Formulaire</h1>
            <div class="div1">
                <input type="text" name="auteur" id="auteur" placeholder="Auteur" value="<?=$monarticle['auteur']?>">
                <input type=" text" name="titre" id="titre" placeholder="Titre" value="<?=$monarticle['titre']?>">
            </div>

            <div>
                <textarea name="article" id="article" cols="10" rows="10"
                    placeholder="Article"><?= $monarticle['article']?></textarea>
            </div>
            <input type="hidden" name="id" value="<?=$monarticle['id']?>">
        </div>
        <button>Envoyer</button> <button><a href="index.php">Accueil</a></button>
    </form>




</body>

</html>