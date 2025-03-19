<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    header("Location: menu.html");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<form action="" method="post">
    <label>Email:</label>
    <input type="text" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
</body>
</html>