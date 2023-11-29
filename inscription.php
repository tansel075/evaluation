<?php
session_start();
if(isset($_SESSION["mail"])){
    header("Location: ./profil.php");
}
if(!empty($_POST["envoie"])){
    include_once "./includes/fonctions.php";
    $mail = $_POST["mail"];
    $exist = rechercheMail($mail);
    $valideprenom = verifyname($_POST["prenom"]);
    $validenom = verifyname($_POST["nom"]);
    $validemail = verifymail($_POST["mail"]);
    $validemdp = verifymdp($_POST["mdp1"]);
    $validetel = verifytelephone($_POST["tel"]);
    $valideadress = verifytext($_POST["adresse"]);
    $validecp = verifycp($_POST["cp"]);
    $valideville = verifytext($_POST["ville"]);
    if(($exist == 0)&& ($_POST["mdp1"]==$_POST["mdp2"])&&($valideprenom == 1)&&($validenom == 1)&&($validemail == 1)&&($validemdp == 1)&&($validetel == 1)&&($valideadress == 1)&&($validecp == 1)&&($valideville == 1)){
        include_once "./includes/connexionbdd.php";
        $prenom = secu($_POST["prenom"]);
        $nom = secu($_POST["nom"]);
        $mdp = password_hash($_POST["mdp1"], PASSWORD_DEFAULT);
        $tel = secu($_POST["tel"]);
        $adress = secu($_POST["adresse"]);
        $cp = secu($_POST["cp"]);
        $ville = secu($_POST["ville"]);
        $civilite = secu($_POST["civilite"]);
        $naissance = $_POST["naissance"];
        $idproduit = secu($_POST["idproduit"]);
        $userrole = 'admin';
        
        $sql = "INSERT INTO users(civilite, prenom, nom, mail, mdp, naissance, telephone, adresse, codePostal, ville, pays) VALUES (:civilite, :prenom,:nom, :mail, :mdp, :naissance, :telephone, :adresse,:cp, :ville, :pays)";
        $insertion = $connexion->prepare($sql);
        $insertion->bindParam(":civilite", $civilite, PDO::PARAM_STR);
        $insertion->bindParam(":prenom", $prenom, PDO::PARAM_STR);
        $insertion->bindParam(":nom", $nom, PDO::PARAM_STR);
        $insertion->bindParam(":mail", $mail, PDO::PARAM_STR);
        $insertion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
        $insertion->bindParam(":naissance", $naissance);
        $insertion->bindParam(":telephone", $tel, PDO::PARAM_INT);
        $insertion->bindParam(":adresse", $adress, PDO::PARAM_STR);
        $insertion->bindParam(":cp", $cp, PDO::PARAM_INT);
        $insertion->bindParam(":ville", $ville, PDO::PARAM_STR);
        $insertion->bindParam(":pays", $pays, PDO::PARAM_STR);
        $insertion->execute();
        header("Location: ./connexion.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inscription</title>
</head>
<body>
    <?php
        include "./includes/header.php";
    ?>
    <main>
    <h1>Inscription</h1>
    <!-- pour joindre des fichier on met l'attribut enctype="multipart/form-data" -->
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
                echo "<span style= 'color: red'> l'adresse mail saisie est incorrecte.</span><br>";
            }
            if(!empty($_POST["envoie"]) && ($exist != 0) ){
                echo "<span style= 'color: red'> l'adresse mail saisie est déjà utilisée par un autre utilisateur.</span><br>";
            }
        ?>
        <input type="password" placeholder="************" name="mdp1" required><br>
        <input type="password" placeholder="confirmez mot de passe" name="mdp2" required><br>
        <?php
            if(!empty($_POST["envoie"]) && ($validemdp != 1) ){
                echo "<span style= 'color: red'> le mot de passe doit : <br>
                - comporter au moins de 12 caractères. <br>
                - Avoir au moins une lettre majuscule. <br>
                - Avoir au moins une lettre minuscule. <br>
                - Avoir au moins un chiffre.<br>
                - Avoir au moins un caractère spécial.<br></span>";
            }
            if(!empty($_POST["envoie"]) && ($_POST["mdp1"] != $_POST["mdp2"]) ){
                echo "<span style= 'color: red'> les mots de passes saisis sont différents</span> <br>";
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
        
        
        <input type="submit" value="Je m'inscris" name="envoie" class="btn"><br>

        <p>Vous etes déjà inscrit, connectez-vous par <a href="./connexion.php">ici</a> </p>
    </form>
    </main>
    <?php
        include "./includes/footer2.php";
        include "./includes/footer.php";
    ?>
</body>
</html>