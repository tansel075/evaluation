<?php
session_start();
if(!isset($_SESSION["mail"])){
    header("Location: .connexion.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contenue facture</title>
</head>
<body>
    <div style="text-align:left">
    <h2>SHOP'OISE</h2>
    <p>Magasin Alimentaire Hard Discount<br>
    <b>Tel:</b> 06 42 54 14 00 <br>
    <b>Mail:</b> contact@sohp-oise.com <br>
    <b>Adresse:</b>5 avenue de la republique,  <br>
    <b>CP et Ville:</b>60100 CREIL.    <br>

    </p>
    </div>
    <div style="text-align:right">
    <b>idClient:</b> <?php echo $_SESSION['idclient'] ?> <br>
    <b>Prenom:</b> <?php echo $_SESSION['prenom'] ?> <br>
    <b>Nom:</b> <?php echo $_SESSION['nom'] ?> <br>
    <b>Tel:</b> <?php echo $_SESSION['tel'] ?> <br>
    <b>Mail:</b> <?php echo $_SESSION['mail'] ?> <br>
    <b>Adresse:</b><?php echo $_SESSION['adresse']. " ". $_SESSION['cp']. " ". $_SESSION['ville'] ?>
    </div>
    <center>
        <h2 style='color:black'>
            <u>facture</u>
        </h2>
        <?php
        $id = $_SESSION["idclient"];
        $sql = "SELECT idproduit, quantite, prixHt, tva, prixTtc FROM commandes WHERE idclient = '$id'";
        echo "<table border = '1' style='margin: left 60px;'><tr><th style= 'width : 100px'>DESIGNATION</th>
        <th style= 'width : 100px'>QUANTITE</th>
        <th style= 'width : 100px'>PRIX HT</th>
        <th style= 'width : 100px'>TVA 20%</th>
        <th style= 'width : 100px'>PRIX TTC</th>
        </tr>";
        foreach($connexion -> query($sql) as $commandes){
            echo "<tr>";
            foreach($commandes as $cle => $valeur){
                echo "<td style='text-align: center'>". $valeur . "</td>";
            }
            echo "</tr>";
        }
        // $sql1 = "SELECT AVG(note) FROM notes WHERE idstagiaire = '$id'";
        // foreach($connexion -> query($sql1)as $moyenne){
        // }
        //echo "<tr><th colspan = 2>Moyenne </th><td>". number_format($moyenne['AVG(note)'])."/20</td></tr>";
        echo "</table>";
    
        
        ?>
        <br><br><br><br>
        <p style= 'text-align: right'> Fait à Paris le <?php echo date('d/m/Y') ?></p>
        <img src="./assets/images/img2.jpg" alt=""
        style="width:100px">
    </center>
</body>
</html>