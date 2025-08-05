<?php
ini_set('session.cookie_httponly', 1);
session_start();

$conn = new mysqli("localhost", "root", "", "secur_app");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    if ($stmt === false) {
        echo "<p style='color:red'>Erreur de préparation : " . $conn->error . "</p>";
    } else {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['user'] = $username;
            header("Location: index.php");
        } else {
            echo "<p style='color:red'>Connexion échouée.</p>";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="POST" action="login.php">
        <label>Nom d'utilisateur :</label><br>
        <input type="text" name="username"><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>