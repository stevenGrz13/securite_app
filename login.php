<?php
session_start();
$conn = new mysqli("localhost", "root", "", "secur_app");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
    } else {
        echo "<p style='color:red'>Connexion échouée.</p>";
    }
}
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