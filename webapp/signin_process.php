<?php
include('connect.php');

$username = $_POST['username'];
$providedPassword = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM USERS WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $providedPassword === $user['password']) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];


    header('Location: index.php');
    exit();
} else {

    header('Location: signin.php?error=1');
    exit();
}
