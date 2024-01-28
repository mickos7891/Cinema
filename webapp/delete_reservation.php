<?php
session_start();


if (!isset($_SESSION['user_id'])) {
          $_SESSION['error_message'] = 'Please sign in to delete reservations.';
          header('Location: signin.php');
          exit();
}

include('connect.php');


if (isset($_GET['id'])) {
          $reservation_id = $_GET['id'];


          $stmt = $pdo->prepare("DELETE FROM RESERVATIONS WHERE id = :reservation_id AND user_id = :user_id");
          $stmt->bindParam(':reservation_id', $reservation_id);
          $stmt->bindParam(':user_id', $_SESSION['user_id']);
          $stmt->execute();


          header('Location: myReservations.php');
          exit();
} else {
}
