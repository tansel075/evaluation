<?php
session_start();
// if(!isset($_SESSION["mail"])){
//     header("Location: ./connexion.php");
// }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SHOP'OISE - ACCUEIL</title>
</head>

<body>
    <?php 
        include "./includes/header.php"
    ?>
    <main>
        <div class="banniere">
            <img src="./assets/images/img2.jpg" alt="">
            <div class="enfant">
                <h1>bienvenue sur Shop'Oise</h1>
                <p> Notre magasin vous accueil du lundi au vendredi de 08h à 18h <br>
                    Notre adresse est 5 avenue de la paix 60100 CREIL situé juste en face de NORAUTO <br>
                    Vous pouvez pas le raté <br></p>
                <a href="./contact.php"><button class='btn'> <i class="fa-solid fa-address-book"></i>
                        Contactez-nous</button></a>
            </div>
        </div>
    </main>
    <?php 
        include "./includes/footer2.php";
        include "./includes/footer.php";
    ?>
</body>

</html>