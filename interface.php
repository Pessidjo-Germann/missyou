<?php
session_start();//on lance la SESSION DE L'UTILISATEUR AINSI ON RECUPERE TOUTES LES INFORMATIONS QU ON A PRIS LORS DE SA CONNECTION
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Document</title>
</head>
<body >
   
        <nav class="navbar">
            <a href="#" class="missyou">MISSYOU</a>
            <div class="ba">
                <ul>
                <li><a href="#">Accuiel</a></li>
                <li><a href="#"><?= $_SESSION['pseudo']?></a></li>
                <!--
                    ?= : raccourci pour afficher directement une valeur a l'ecran
                    $_SESSION : super variable qui donne acces aux valeur gardez
                -->
                                <li><a href="#"><?= $_SESSION['email']?></a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Apropos</a></li>
                </div>
        </nav>
      <h1>Liste de vos utilisateur</h1>
    <?php
    $trmt= $pdo->prepare("SELECT* from utilisateur "); //? veut dire que la valeur de l'email va changer
    $trmt->execute();
    $listUsers=$trmt->fetchAll();// pour recuperer tt les donners
     if (sizeof($listUsers)<0){
         echo '<h2>Aucun utilisateur</h2>';
         # code...
     }else{
        for ($i=0; $i<sizeof($listUsers) ; $i++) { 
            # code...
           ?>
           <a href=<?= 'conversation.php?id=' . $listUsers[$i]['id_users']?> ><?=$listUsers[$i]['pseudo'] . '<br>';?></a>
            <?php
        }
     }
    ?>
    
</body>
</html>