<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mon blog</title>
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

    <form action="ajouter.php" method="post">

        <div class="bloc">
            <h1>Le Formulaire</h1>
            <div class="div1">
                <input type="text" name="auteur" id="auteur" placeholder="Auteur">
                <input type="text" name="titre" id="titre" placeholder="Titre">
            </div>

            <div>
                <textarea name="article" id="article" cols="30" rows="10" placeholder="Article">

                </textarea>

            </div>
            <button>Envoyer</button> <button><a href="index.php">Accueil</a></button>
    </form>

</body>

</html>