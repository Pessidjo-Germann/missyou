<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <div>
    <h1>login</h1>
    <input type="text" name="nom" placeholder="entrer votre nom" class="nom"><br>
    <input type="text" name="prenom" placeholder="entrer votre prenom" class="prenom"><br>
    <input type="text" name="pseudo" placeholder="entrer votre pseudo" class="pseudo"><br>
    <input type="email" name="email" placeholder="entrer votre email" class="email"><br>
    <input type="text" name="numero" placeholder="entrer votre numero de telephone" class="numero"><br>
    <input type="password" name="password" placeholder="entrer votre mot de pass" class="password"><br>
    <input type="password" name="cpassword" placeholder="confirmer votre mot de pass" class="cpassword"><br>
    <input type="text" name="age" placeholder="entrer votre age" class="age"><br>
    <input type="text" name="sex" placeholder="entrer votre sex" class="sex"><br>
    <input type="file" name="" id="" accept="image/*">
<button type="submit" name="submit"> SIGNIN</button><br>
<p>Already have an account <a href="login.php">LOGIN</a></p><br>
</div>
</form>
</body>
</html>
<?php
include "config.php";//connexion a la base de donnee
if(isset($_POST["submit"])) // on connecte le button a la base
{
    
    //on recupere les donnes
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $age= $_POST['age'];
    $sexe= $_POST['sex'];
    $numero = $_POST['numero'];
    $pseudo= $_POST['pseudo'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $cpassword= $_POST['cpassword'];
    if ($password=$cpassword) { // on verify si le mot de pass correspond ou mm mot de passe entrer
        $trmt=$pdo->prepare("select* from utilisateur where email=?");
        $trmt->execute([$email]);
        $getuser=$trmt->fetchAll();
        if (sizeof ($getuser)>0) {//c'est pur faire a ce que deux compte ne doit pas etre cree avc le mm email
            echo  "desoler un compte existe deja avec cette email";
        } else{
            $trmt2=$pdo->prepare("INSERT into utilisateur(nom,prenom,pseudo,email,password,cpassword,numero,age,sexe) values(?,?,?,?,?,?,?,?,?)");
            $trmt2->execute([$nom,$prenom,$pseudo,$email,$password,$cpassword,$numero,$age,$sexe]);
        }
    } else{
        echo "impossible le mor de pass ne correspond pas";
    }
    
}
?>