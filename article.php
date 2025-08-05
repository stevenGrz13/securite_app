<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "secur_app");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $conn->real_escape_string($_POST['comment']);
    $article_id = (int)$_GET['id'];
    $query = "INSERT INTO comments (article_id, content) VALUES ('$article_id', '$comment')";
    if ($conn->query($query)) {
        echo "<p>Commentaire ajouté avec succès !</p>";
    } else {
        echo "<p>Erreur : " . $conn->error . "</p>";
    }
}

$result = $conn->query("SELECT content FROM comments WHERE article_id='{$_GET['id']}'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'article</title>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'">
</head>
<body>
    <h2>Article : T-shirt</h2>
    <p>Prix : 15€</p>
    <p><a href="index.php">Retour à l'accueil</a></p>
    <h3>Commentaires</h3>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>
    <h4>Ajouter un commentaire</h4>
    <form method="POST" action="">
        <textarea name="comment"></textarea><br>
        <input type="submit" value="Poster">
    </form>
</body>
</html>

<!-- ito le apidirina amle input comments hibrouillena azy -->
<!-- <script>document.body.innerHTML += '<iframe src="http://localhost/pub.html" width="300" height="200"></iframe>';</script> -->