<header>
<?php
    if(isset($_SESSION["mail"])){
    echo "
    <ul>
        <li><a href='./index.php'>Accueil</a></li>
        <li><a href='./nosproduits.php'>Nos Produits</a></li>
        <li><a href='./inscription.php'>Inscription</a></li>
        <li><a href='./connexion.php'>connexion</a></li>
        <li><a href='./contact.php'>Contact</a></li>
        <li><a href='./profil.php'><i class='fa-solid fa-user'></i></a></li>
        <li><a href='./deconnexion.php'>Deconnexion</a></li>
    </ul>";
    }else{
        echo "<ul>
        <li><a href='./index.php'>Accueil</a></li>
        <li><a href='./nosproduits.php'>Nos Produits</a></li>
        <li><a href='./connexion.php'>connexion</a></li>
        <li><a href='./inscription.php'>Inscription</a></li>
        <li><a href='./contact.php'>Contact</a></li>
    </ul>";
    }

?>

</header>