<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
    <form method='post'>
        <div>
<h1>login</h1>

<input type="text" name="pseudo" placeholder="entrer votre pseudo" class="pseudo"><br>
<input type="email" name="email" placeholder="entrer votre email" class="email"><br>
<input type="password" name="password" placeholder="entrer votre mot de pass" class="password"><br>
<p>Have forgotting password<a href="#">forgot</a></p><br>
<button type="submit" name="submit">LOGIN</button><br>
<p>Do not have an account <a href="index.php">SIGNIN</a></p><br>
<div>
</form>
</body>
</html>
<?php
include "config.php";//acces a la base de donner
session_start();
if (isset($_POST['submit'])){//methode d'envoie
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    $pseudo= $_POST["pseudo"];
    //on verifie tous les infos
    if(isset($email) && isset($password) && isset($pseudo)&& !empty($pseudo))
    { 
        
        //on execute
        //on verify que l'email existe dans la base de donnee
        $trmt= $pdo->prepare("SELECT* from utilisateur where email= ?"); //? veut dire que la valeur de l'email va changer
        $trmt->execute([$email]);
        $getutilisateur=$trmt->fetchAll();// pour recuperer tt les donners
        
        if (sizeof($getutilisateur)>0) {
            # code...//il existe un utilisateur
           
            //on verifie les mots de passe
            $trmt= $pdo->prepare("SELECT password,id_users from utilisateur where email= ?"); //? veut dire que la valeur de l'email va changer
        $trmt->execute([$email]);
        $getpassword=$trmt->fetch();
         
        //on verify les deux password
        if ($getpassword['password']==$password) {
            echo "connexion reussi";
            $_SESSION['id_user']=$getpassword['id_users'];
            $_SESSION['email']=$email;
            $_SESSION['pseudo']=$pseudo;
            header('location: interface.php');
            # code...
        }else {
            var_dump($password);
            echo "le mot de pass ou l'email ne correspond pas";
        }

        }else {
            echo "aucun utilisateur n'existe ";
        }
    }else{
        echo 'veuillez  remplir toutes les informations svp';
    }
    }    
?>
