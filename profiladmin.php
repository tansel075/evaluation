<?php
session_start();
if(!isset($_SESSION["mail"])){
    header("Location: ./connexion.php");
}
if ($_SESSION["mail"] != 'administrateur@gmail.com') {
    header("Location: ./index.php");
 }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style3.css">
    <title>Profil Administrateur</title>
</head>

<body>
    <?php 
    include "./includes/header.php";
    ?>
    <div class="profil">
        <div class="pgauche">
            <ul>
                <li><a href="./clientsadmin.php">Clients</a></li>
                <li><a href="./produitadmin.php">Produits</a></li>
            </ul>
        </div>
        <div class="pdroite">
            <h1>PROFIL ADMINISTRATEUR</h1>
        </div>
    </div>
    <?php 
    include "./includes/footer.php";
    ?>
</body>

</html>