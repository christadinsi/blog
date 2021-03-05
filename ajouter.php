<?php
 // On démarre une session
 session_start();
 
 
if($_POST){
    if(isset($_POST['auteur']) && !empty($_POST['auteur'])
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['article']) && !empty($_POST['article'])){
         
        // On inclut la connexion à la base de données
        require_once('connexion.php');
        //on nettoie les données envoyées
        $auteur = strip_tags($_POST['auteur']);
        $titre= strip_tags($_POST['titre']);
        $article = strip_tags($_POST['article']);
        
        $sql ='INSERT INTO `articles`(`auteur`,`titre`,`article`) VALUES
        (:auteur, :titre, :article);'; 
        
        $query = $db->prepare($sql);
        
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR); 
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':article', $article, PDO::PARAM_STR);

        $query->execute();
        
        $_SESSION['message']= "Article ajouté";
        require_once('fermeture.php');

        header('Location: index.php');
    }else{
$_SESSION['erreur']= "Le formulaire est incomplet";
header('Location: formulaire.php');  
    }
}
?>