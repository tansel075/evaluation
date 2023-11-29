<?php
$servername = 'localhost';
$username = 'root';
$password = '';
try {
    //On établit la connexion
    $connexion = new PDO("mysql:host=$servername;", $username, $password);
    //Définir les modes d'erreurs et d'exceptions
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //on va affecter notre requete sql à une variable
    $sql = "CREATE DATABASE shopoisebdd CHARACTER SET utf8 COLLATE utf8_bin";
    //on execute la requete sql
    $connexion->exec($sql);
}
//On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci
catch(PDOException $e) {
    date_default_timezone_set("Europe/Paris");
    setlocale(LC_TIME,"fr_FR");
    $fichier = fopen("error.log","a+");
    fwrite($fichier, date("d/m/Y H:i:s : ").$e->getMessage(). "\n");
    fclose($fichier);
}

//les variables de connexion
$servername = 'localhost';
$dbname = 'shopoisebdd';
$username = 'root';
$password = '';
try {
    //On établit la connexion
    $connexion = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    //Définir les modes d'erreurs et d'exceptions
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //on va affecter notre requete sql à une variable
    $sql = "CREATE TABLE users (
        idclient INT(5) AUTO_INCREMENT PRIMARY KEY,
        civilite VARCHAR(50) NOT NULL,
        prenom	VARCHAR(70) NOT NULL,
        nom	VARCHAR(70) NOT NULL,
        mail VARCHAR(100) NOT NULL,
        mdp	VARCHAR(200) NOT NULL,
        naissance DATE,
        telephone	INT(10),
        adresse	VARCHAR(170),
        codePostal	INT(5),
        ville	VARCHAR(50),
        pays    VARCHAR(50),
        dateinscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )CHARACTER SET utf8 COLLATE utf8_bin";
    //on execute la requete sql
    $connexion->exec($sql);
    //creation de la table formation
    $sql1 = "CREATE TABLE produits (
        idproduit INT(5) AUTO_INCREMENT PRIMARY KEY,
        designation VARCHAR(50) NOT NULL,
        quantiteStock  INT(5),
        prix  INT(5)
        
    )CHARACTER SET utf8 COLLATE utf8_bin";
    //on execute la requete sql
    $connexion->exec($sql1);
        //creation de la table note
        $sql2 = "CREATE TABLE commandes (
            idcommande INT(5) AUTO_INCREMENT PRIMARY KEY,
            idproduit INT(5) NOT NULL,
            idclient  INT(5) NOT NULL,
            FOREIGN KEY (idproduit) REFERENCES produits (idproduit),
            FOREIGN KEY (idclient) REFERENCES clients (idclient),
            quantite INT(10) NOT NULL,
            prixHt FLOAT(10),
            tva FLOAT(5),
            prixTtc FLOAT(5)
        )CHARACTER SET utf8 COLLATE utf8_bin";
        //on execute la requete sql
        $connexion->exec($sql2);
}
//On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci
catch(PDOException $e) {
    $fichier = fopen("error.log","a+");
    fwrite($fichier, date("d/m/Y H:i:s : ").$e->getMessage(). "\n");
    fclose($fichier);
}

?>