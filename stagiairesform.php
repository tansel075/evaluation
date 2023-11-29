<?php
session_start();
if(!isset($_SESSION["mail"])){
    header("Location: ./connexion.php");
}
if(isset($_SESSION["userrole"]) && ($_SESSION["userrole"] != 'formateur')){
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
    <title>Profil formateur</title>
</head>

<body>
    <?php 
    include "./includes/header.php";
    ?>
    <div class="profil">
        <div class="pgauche">
            <ul>
                <li><a href="./stagiairesform.php">Stagiaires</a></li>
                <li><a href="">Mes infos</a></li>
            </ul>
        </div>
        <div class="pdroite">
        <h2>Liste des stagiaires :</h2>
            <?php
                include "./includes/connexionbdd.php";
                $sql = "SELECT * FROM users, notes WHERE userrole = 'stagiaire' AND users.id = notes.idstagiaire";
                echo "<table border= '1'><tr><th>ID</th><th>PRENOM</th><th>NOM</th><th>MAIL</th><th>FORMATION</th><th>MATIERE</th><th>NOTE</th></tr>";
                echo "<tr>";
                foreach($connexion->query($sql) as $stagiaires){
                        echo "<td>".$stagiaires['id']."</td>";
                        echo "<td>".$stagiaires['prenom']."</td>";
                        echo "<td>".$stagiaires['nom']."</td>";
                        echo "<td>".$stagiaires['mail']."</td>";
                        echo "<td>".$stagiaires['formation']."</td>";
                        echo "<td>".$stagiaires['matiere']."</td>";
                        echo "<td>".$stagiaires['note']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
            ?><br><br><br>
            <h2>Ajouter une nouvelle note :</h2>
                <form action="" method="POST">
                    <select name="nomstagiaire">
                        <?php
                        $idstagiaire;
                            $sql = "SELECT id, prenom, nom FROM users WHERE userrole = 'stagiaire'";
                            foreach($connexion->query($sql) as $stagiaires){
                                echo "<option>".$stagiaires["id"]." ".$stagiaires["prenom"]." ".$stagiaires["nom"]."</option>";
                                $idstagiaire = $stagiaires["id"];
                            }
                        ?>
                    </select> <br>
                    <input type="text" name = "matiere" placeholder="Matiere">
                    <input type="date" name = "dateeval">
                    <input type="number" name = "note" placeholder="Note/20">
                    <input type="submit" Value="Ajouter" name="ajout">
                </form>
                <?php
                    if(!empty($_POST["ajout"])){
                        include "./includes/fonctions.php";
                        $matiere = secu($_POST["matiere"]);
                        $date = secu($_POST["dateeval"]);
                        $note = secu($_POST["note"]);
                        $idformateur = secu($_SESSION["id"]);
                        $sql = "INSERT INTO notes(matiere, dateeval, note, idformateur, idstagiaire) VALUES (:matiere,:dateeval,:note,:idformateur,:idstagiaire)";
                        $insertion = $connexion->prepare($sql);
                        $insertion->bindParam(":matiere", $matiere, PDO::PARAM_STR);
                        $insertion->bindParam(":dateeval", $dateeval);
                        $insertion->bindParam(":note", $note, PDO::PARAM_INT);
                        $insertion->bindParam(":idformateur", $idformateur, PDO::PARAM_INT);
                        $insertion->bindParam(":idstagiaire", $idstagiaire, PDO::PARAM_INT);
                        $insertion->execute();
                        header("Location: ./stagiairesform.php");
                    }
                ?>
            <br><br><br>
            <h2>Supprimer note :</h2>
            <form action="" method="POST">
                Entrez l'identifiant du formateur à supprimer <br>
                <input type="number" name="idformateur" required><br>
                <input type="submit" name='supp' value="Supprimer">
            </form>
            <?php
                if(!empty($_POST["supp"])){
                    include "./includes/fonctions.php";
                    $idformateur = secu($_POST["idformateur"]);
                    $sql = "DELETE FROM users WHERE id = :idformateur";
                    $insertion = $connexion->prepare($sql);
                    $insertion->bindParam(":idformateur", $idformateur, PDO::PARAM_INT);
                    $insertion->execute();
                    header("Location: ./formateuradmin.php");
                }
            ?>
        </div>
    </div>
    <?php 
    include "./includes/footer.php";
    ?>
</body>

</html>
