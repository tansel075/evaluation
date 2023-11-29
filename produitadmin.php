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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style3.css">
    <title>Profil admin formations</title>
</head>

<body>
    <?php 
    include "./includes/header.php";
    ?>
    <div class="profil">
        <div class="pgauche">
            <ul>
                
                <li><a href="./profiladmin.php">admin</a></li>
                <li><a href="./produitadmin.php">Produit</a></li>
            </ul>
        </div>
        <div class="pdroite">
            <h2>Liste des produit :</h2>
            <?php
                include "./includes/connexionbdd.php";
                $sql = "SELECT * FROM produits";
                echo "<table border= '1'><tr><th>ID</th><th>NOM DU PRODUIT</th><th>ARRIVAGE</th><th>NBRSTOCK</th><th>ID PRODUIT</th></tr>";
                foreach($connexion->query($sql) as $produits){
                    echo "<tr>";
                    foreach($produits as $cle => $valeur){
                        echo "<td>".$valeur."</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            ?><br><br><br>
            <h2>Ajouter un nouveau produit :</h2>
            <form action="" method="POST">
                <!-- <input type="number" placeholder="idproduit" name="idproduit" required> <br> -->
                <input type="text" placeholder="designation" name="designation" required><br>
                <input type="number" placeholder="nombre de stock" name="quantiteStock" required><br>
                <input type="number" placeholder="Prix unitaire" name="prix" required><br>
                <input type="submit" name='envoie' value="Ajouter">
            </form>
            <?php
                include "./includes/fonctions.php";
                if(!empty($_POST["envoie"])){
                    $designation = secu($_POST["designation"]);
                    $nbrstock = secu($_POST["quantiteStock"]);
                    $prix = secu($_POST["prix"]);
                    $sql = "INSERT INTO produits ( designation, quantiteStock, prix) VALUES (:designation,:quantiteStock,:prix)";
                    $insertion = $connexion->prepare($sql);
                    $insertion->bindParam(":designation", $designation);
                    $insertion->bindParam(":quantiteStock", $nbrstock);
                    $insertion->bindParam(":prix", $prix);
                    $insertion->execute();
                    header("Location: ./produitadmin.php");
                }
            ?><br><br><br>
            <h2>Supprimer produit :</h2>
            <form action="" method="POST">
                Entrez l'identifiant du produit à supprimer <br>
                <input type="number" name="idproduit" required><br>
                <input type="submit" name='supp' value="Supprimer">
            </form>
            <?php
                if(!empty($_POST["supp"])){
                    $idformation = secu($_POST["idproduit"]);
                    $sql = "DELETE FROM produit WHERE idproduit = :idproduit";
                    $insertion = $connexion->prepare($sql);
                    $insertion->bindParam(":idproduit", $idproduit, PDO::PARAM_INT);
                    $insertion->execute();
                    header("Location: ./produitdmin.php");
                }
            ?>
        </div>
    </div>
    <?php 
    include "./includes/footer2.php";
    include "./includes/footer.php";
    ?>
</body>

</html>