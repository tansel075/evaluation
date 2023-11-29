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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Contact</title>
</head>
<body>
    <?php 
        include "./includes/header.php"
    ?>
    <main>
    <div class="banniere">
        <img src="./assets/images/image3.jpg" alt="">
        <div class="enfant">
            <h1>Contact</h1>
            <form action="" method="POST" enctype="multipart/form-data">
        <select name="civilite" required>
            <option>Mr</option>
            <option>Mme</option>
        </select><br>
        <input type="text" placeholder="Jean" name="prenom" required> <br>
        <?php
            if(!empty($_POST["envoie"]) && ($valideprenom != 1) ){
                echo "<span style= 'color: red'> le prénom e doit contenir que des lettres</span><br>";
            }
        ?>
        <input type="text" placeholder="Dupont" name="nom" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($validenom != 1) ){
                echo "<span style= 'color: red'> le nom e doit contenir que des lettres</span><br>";
            }
        ?>
        <input type="email" placeholder="jean@gmail.com" name="mail" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($validemail != 1) ){
                echo "<span style= 'color: red'> l'adresse mail saisie n'est pas valide.</span><br>";
            }
            
        ?>
        
        
        <input type="date" placeholder='01/01/1999' name="naissance"> <br>
        <input type="tel" placeholder="0605010203" name="tel" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($validetel != 1) ){
                echo "<span style= 'color: red'> le telephone doit etre composé de 10 chiffres.</span><br>";
            }
        ?>
        <input type="text" placeholder="5 rue de la paix" name="adresse" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($valideadress != 1) ){
                echo "<span style= 'color: red'> l'adresse saisie est incorrecte.</span><br>";
            }
        ?>
        <input type="number" placeholder="75000" name="cp" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($validecp != 1) ){
                echo "<span style= 'color: red'> le Code postal est incorrect.</span><br>";
            }
        ?>
        <input type="text" placeholder="Paris" name="ville" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($valideville != 1) ){
                echo "<span style= 'color: red'> la ville e doit contenir que des lettres</span><br>";
            }
        ?>
        <input type="text" placeholder="France" name="pays" required>   <br>
        <?php
        if(!empty($_POST["envoie"]) && ($validepays !=1)){
            echo "span style= 'color:red'> le pays doit contenir que des lettres </span>";
        }
        ?>
        <textarea name="message" id="" cols="30" rows="10">message</textarea>
        
        <input type="submit" value="J'envoie" name="envoie" class="btn"><br>
        </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.3664023208826!2d2.4563787764217184!3d49.23154207138516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e649bb98f3c0cd%3A0x5578bfc5241480f6!2s5%20Av.%20de%20la%20Paix%2C%2060740%20Saint-Maximin!5e0!3m2!1sfr!2sfr!4v1700812769353!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </main>
    <?php 
        include "./includes/footer2.php";
        include "./includes/footer.php";
    ?>
</body>
</html>