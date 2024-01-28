<?php
session_start();

$host = 'mysql'; 
$port = '3306';
$database = 'CINEMA'; 
$user = 'root'; 
$password = 'rootpassword'; 

$pdo;
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
          
          echo "Connection failed: " . $e->getMessage();
          exit(); 
}

?>