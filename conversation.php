<?php
session_start();
include "config.php";

$id_user=$_SESSION['id_user'];
$id_rec=$_GET['id'];
if (isset($_POST['submit'])){
$contenu=$_POST['contenu'];
$trmt2=$pdo->prepare("INSERT into message(contenu,id_rec,id_env) values(?,?,?)");
$trmt2->execute([$contenu,$id_rec,$id_user]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ecrivez lui</h1>
    <form action="" method="post">
    <textarea name="contenu" id="" cols="60" rows="20"></textarea><br>
    
    <button name="submit">Envoyer</button>
    </form>
    <h2>Message recu</h2>
    <?php
    $trmt3=$pdo->prepare("SELECT contenu,id_env from message where id_rec=? AND id_env=?");
    $trmt3->execute([$id_user,$id_rec]);
    $messageRec=$trmt3->fetchAll();

    if(sizeof($messageRec)<0){
        echo 'Pas de message recu pour le moment';
    }else {
        for ($i=0; $i < sizeof($messageRec); $i++) { 
            # code...
            echo $messageRec[$i]['contenu'] . '</br>';
        }
    }
    ?>


<h2>Message Envoyez</h2>
    <?php
    $trmt3=$pdo->prepare("SELECT contenu,id_env from message where id_env=? AND id_rec=?");
    $trmt3->execute([$id_user,$id_rec]);
    $messageRec=$trmt3->fetchAll();

    if(sizeof($messageRec)<0){
        echo 'Pas de message recu pour le moment';
    }else {
        for ($i=0; $i < sizeof($messageRec); $i++) { 
            # code...
            echo $messageRec[$i]['contenu'] . '</br>';
        }
    }
    ?>
    
</body>
</html>