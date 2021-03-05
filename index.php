<?php
session_start();
    // On  inclut la connexion à la base de donnees
    require_once('connexion.php');

    $sql = 'SELECT * FROM `articles`';

    // on prepare  la requete($sql);
    $query = $db->prepare($sql);

    // On execute la requete
    $query->execute();

    // On stoque le resultat dans un tableau associatif
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('fermeture.php')
    ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Articles</title>
</head>

<body>
    <main>
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

        <div class="enetete">
            <h1>Liste des articles</h1> <button><a href="formulaire.php">Ecrire un article</a></button>
        </div>

        <table>

            <thead>
                <th>Id</th>
                <th>Auteur</th>
                <th>Titre</th>
                <th>Article</th>
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                            foreach ($resultat as $mesarticles) {
                            ?>
                <tr>
                    <td>
                        <?=$mesarticles['id']?>
                    </td>
                    <td><?=$mesarticles['auteur']?></td>
                    <td><?=$mesarticles['titre']?></td>
                    <td><?=$mesarticles['article']?></td>
                    <td><?=$mesarticles['date']?></td>

                    <td> <a href="detail.php?id=<?=$mesarticles['id']?>">Detail</a>
                        <a href="modifier.php?id=<?=$mesarticles['id']?>">Modifier</a>
                        <a href="supprimer.php?id=<?=$mesarticles['id']?>"
                            onclick="return confirm('Etes vous sure de vouloir supprimer l\'article')">Supprimer</a>
                    </td>
                </tr>
                <?php
                     }
                    ?>
            </tbody>

        </table>




    </main>
    <script src="js/app.js"></script>
</body>

</html>