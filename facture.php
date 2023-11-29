<?php
// session_start();
// if(!isset($_SESSION['mail'])){
//     header("Location: ./connexion.php");
// }
include "./includes/connexionbdd.php";
//demmarrage de ob
ob_start();
//ob va garder tout les contenu du fichier en memoire
require_once "./contenuefacture.php";
// il va affecter le contenu à notre variable
$html = ob_get_contents();
//on libere la laoué
ob_end_clean();
//chargement de domPDF
require_once "./includes/dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;
//on set les options avant d'instancier dompdf
$option = new Options();
//pour la changer la typographie
$option -> set("defaultFont","Courier");
//pour charger une image
$option -> set("chroot",realpath(''));
// on crée une instance de dompdf
$dompdf = new Dompdf();
//chargement du html
$dompdf -> loadHtml($html);
//Reglage du papier 
$dompdf -> setPaper("A4","portrait");
//Rendu du dompdf
$dompdf -> render();
//On genere le fichier pdf
$nomfichier = "Facture de_"." ".$_SESSION['idclient']." ". $_SESSION['prenom']." ".
 $_SESSION['nom']." ". $_SESSION['tel']." ". $_SESSION['adresse']
." ". $_SESSION['ville']." ". $_SESSION['cp']." ". $_SESSION['pays'];
$dompdf -> stream("nomdufichier" ,['Attachment' => 0]);
?>