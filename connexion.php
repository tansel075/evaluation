<?php
session_start();
if(isset($_SESSION["mail"])){
    header("Location: ./profil.php");
}

 
    
if(!empty($_POST["envoie"])){
    include_once "./includes/fonctions.php";
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp1"];
    $validemdp = 1;
    $validemail = verifymail($mail);
    $exist = rechercheMail($mail);
    if(($exist != 0) && ($validemail == 1)){
        include_once "./includes/connexionbdd.php";
        $sql = "SELECT * FROM users WHERE mail = '$mail'";
        $requete = $connexion->query($sql);
        $user = $requete->fetch();
        if(password_verify($mdp, $user["mdp"])){
            $_SESSION["idclient"] = $user["idclient"];
            $_SESSION["civilite"] = $user["civilite"];
            $_SESSION["prenom"] = $user["prenom"];
            $_SESSION["nom"] = $user["nom"];
            $_SESSION["mail"] = $user["mail"];
            $_SESSION["naissance"] = $user["naissance"];
            $_SESSION["tel"] = $user["telephone"];
            $_SESSION["adresse"] = $user["adresse"];
            $_SESSION["cp"] = $user["codePostal"];
            $_SESSION["ville"] = $user["ville"];
            $_SESSION["pays"] = $user["pays"];
            $_SESSION["dateinscription"] = $user["dateinscription"];
            if($user["userrole"]== 'admin'){
                header("Location: ./profiladmin.php");
            // }elseif($user["userrole"]== 'formateur'){
            //     header("Location: ./profilformateur.php");
            }else{
                
                if ($_SESSION["mail"] == 'administrateur@gmail.com') {
                    header("Location: ./profiladmin.php");
                 }
                else {
                header("Location: ./profil.php");
            }  
            }  
        }else{
            $validemdp = 0;
            $e = "<span style= 'color: red'> Identifiant ou mot de passe incorrect </span><br>";
        }
    }else{
        $e = "<span style= 'color: red'> Identifiant ou mot de passe incorrect </span><br>";
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
    <title>Connexion</title>
</head>
<body>
    <?php
        include "./includes/header.php";
    ?>
    <main>
    <h1>Connexion</h1>
    <form action="" method="POST">
        <input type="email" placeholder="jean@gmail.com" name="mail" required><br>
        <?php
        if(!empty($_POST["envoie"]) && ($validemail != 1)){
            echo $e;
        }
        if(!empty($_POST["envoie"]) && ($exist == 0)){
            echo $e;
        }
        if((!empty($_POST["envoie"])) && ($validemdp == 0)){
            echo $e;    
        }
        ?>
        <input type="password" placeholder="************" name="mdp1" required><br>
        <input type="submit" value="se connecter" name="envoie" class="btn"><br>

        <p>Vous n'etes pas encore inscrit, inscrivez-vous par <a href="./inscription.php">ici</a> </p>
    </form>
    </div>
    </main>
    <?php
        include "./includes/footer2.php";
        include "./includes/footer.php";
    ?>
</body>
</html>