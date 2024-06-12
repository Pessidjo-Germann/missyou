<?php
try {
    $pdo=new PDO("mysql:host=sql104.infinityfree.com;dbname=if0_36691861_missyou_db","if0_36691861","KA32DrGvnI5");
} catch (PDOException $th) {
    echo "le message erreur est" . $th->getmessage();
    
}
?>