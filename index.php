<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Boutique</title>
</head>
<body>
    <h2>Bienvenue, <?php echo $_SESSION['user']; ?> !</h2>
    <p><a href="logout.php">Se déconnecter</a></p>
    <h3>Articles en vente</h3>
    <p>
        <strong>Article : T-shirt</strong><br>
        Prix : 15€<br>
        <a href="article.php?id=1">Voir les détails</a>
    </p>
</body>
</html>