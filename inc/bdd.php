<?php

function connexionBdd(){
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $dbName = "myseriescompanion";
    try {
        $connexion = new PDO(
            "mysql:host=$host;dbname=$dbName;charset=utf8",
            $user,
            $pass
        );
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        die();
    }
    return $connexion;
}
?>