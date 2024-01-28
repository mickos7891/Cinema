<?php
include('connect.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];


if ($password !== $confirmPassword) {
    header('Location: register.php?error=password_mismatch');
    exit();
}


$checkUsernameStmt = $pdo->prepare("SELECT * FROM USERS WHERE username = :username");
$checkUsernameStmt->bindParam(':username', $username);
$checkUsernameStmt->execute();

if ($checkUsernameStmt->rowCount() > 0) {

    header('Location: register.php?error=username_exists');
    exit();
}





$insertStmt = $pdo->prepare("INSERT INTO USERS (username, password, admin) VALUES (:username, :password, 0)");
$insertStmt->bindParam(':username', $username);

$insertStmt->bindParam(':password', $password);
$insertStmt->execute();


header('Location: index.php');
exit();
