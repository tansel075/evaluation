<?php
session_start();
if(!isset($_SESSION["mail"])){
    header("Location: ./connexion.php");
}
if(isset($_SESSION["userrole"]) && ($_SESSION["userrole"] == 'admin')){
    header("Location: ./profiladmin.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mon compte</title>
</head>
<body>
    <?php 
        include "./includes/header.php"
    ?>
    <main>
    <div class="banniere">
        
        <div class="enfant">
            <h1>Mon compte</h1>
            <a href="./contact.php"><button class='btn'> <i class="fa-solid fa-address-book"></i> Contactez-nous</button></a>
        </div>
    </div>
    <?php
    echo "<h2>Bienvenue sur votre profil ". $_SESSION["civilite"] .$_SESSION["prenom"]. " ". $_SESSION["nom"]."</h2>";
    echo "<h2>Mes infos : </h2>";
    echo "<b>Mail : </b>".$_SESSION["mail"] ."<br>";
    echo "<b>date de naissance : </b>".$_SESSION["naissance"] ."<br>";
    echo "<b>Telephone : </b>0".$_SESSION["tel"] ."<br>";
    echo "<b>Adresse : </b>".$_SESSION["adresse"]."<br>";
    echo "<b>Code Postal : </b>".$_SESSION["cp"] ."<br>";
    echo "<b>Ville : </b>".$_SESSION["ville"] ."<br>";
    echo "<b>pays : </b>".$_SESSION["pays"] ."<br>";
    // echo "<b>pays : </b>".$_SESSION["idclient"] ."<br>";

    
    


    ?>
    <div class="profil">
        
        <div class="pdroite">
            <h2>Liste des produits à commander :</h2>
            <select name="designation" type="text" placeholder="Nom du produit" required>
            <?php
                include "./includes/connexionbdd.php";
                
                $sql = "SELECT designation FROM produits";
                foreach($connexion->query($sql) as $produit){
                    echo "<option>".$produit["designation"]."</option>";
                    $idproduit = $produit['idproduit'];
                }
                ?><br><br><br>
                </select>
            
            <h2>Ajouter une commande :</h2>
            <form action="" method="POST">
                <input type="number" placeholder="quantite" name="quantite" required><br>
                <input type="submit" name='envoie' value="Ajouter">
            </form>
            <?php
            
                include "./includes/fonctions.php";
                if(!empty($_POST["envoie"])){
                    $idproduit = secu($_POST["idproduit"]);
                    $quantite = secu($_POST["quantite"]);
                    $prixHt = secu($_POST["prixHt"]);
                    $tva = secu($_POST["tva"]);
                    $prixTtc = secu($_POST["prixTtc"]);
                    $sql = "INSERT INTO commandes(idproduit,idclient, quantite, prixHt, tva, prixTtc) 
                    VALUES (:idproduit,:idclient, :quantite,:prixHt,:tva,:prixTtc)";
                    $insertion = $connexion->prepare($sql);
                    $insertion->bindParam(":idproduit", $idproduit);
                    $insertion->bindParam(":idclient", $idclient);
                    $insertion->bindParam(":quantite", $quantite);
                    $insertion->bindParam(":prixHt", $prixHt);
                    $insertion->bindParam(":tva", $tva);
                    $insertion->bindParam(":prixTtc", $prixTtc);
                    $insertion->execute();
                    header("Location: ./profil.php");
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
                    header("Location: ./profil.php");
                }
            ?>
        </div>
    </div>
    <h2>SUIVI DES COMMANDES :</h2>
    <?php
    include "./includes/connexionbdd.php";
    $idclient = $_SESSION["idclient"];
    $sql = "SELECT idproduit, quantite, prixHt, tva, prixTtc FROM commandes WHERE idclient = '$idclient'";
    echo "<table border = '1'><tr><th style= 'width : 200px'>DESIGNATION</th>
    <th style= 'width : 200px'>QUANTITE</th>
    <th style= 'width : 200px'>PRIX HT</th>
    <th style= 'width : 200px'>TVA</th>
    <th style= 'width : 200px'>PRIX TTC</th>
    </tr>";
    foreach($connexion -> query($sql) as $idproduit){
        echo "<tr>";
        foreach($idproduit as $cle => $valeur){
            echo "<td style='text-align: center'>". $valeur . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";

    ?>
    
    <h2>MES DOCUMENTS</h2>
    <a href="./facture.php"><button>FACTURE</button></a>
    <!-- <a href=""><button>Attestation de réglement</button></a> -->
    </main>

    <?php 
        include "./includes/footer2.php";
        include "./includes/footer.php";
    ?>
</body>
</html>