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
    <title>Détail de l'article</title>
</head>

<body>


    <section>
        <h1>Détail de l'article dont le titre est <?= $monarticle['titre']?></h1>
        <p>Titre: <?= $monarticle['titre'] ?></p>

        <p> N° </p>
        <p class='article'>Article N° <?=  $monarticle['id']?>:<br><?= $monarticle['article']?> <br>
            Auteur: <?= $monarticle['auteur']?> Date:<?= $monarticle['date']?>
        </p>

        <b><a href="index.php">Retour</a></b><b><a href="modifier.php?id=<?=$monarticle['id']?>">Modifier</a></b>
    </section>
</body>


</html>