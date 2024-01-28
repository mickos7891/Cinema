<?php
include('connect.php');


$userId = $_SESSION['user_id'];


$seanceId = isset($_GET['seance_id']) ? $_GET['seance_id'] : null;
$selectedSeats = isset($_GET['seats']) ? explode(',', $_GET['seats']) : array();

if (!$seanceId || empty($selectedSeats)) {

    header('Location: error.php');
    exit();
}


$stmt = $pdo->prepare("INSERT INTO RESERVATIONS (user_id, seance_id, seat_id) VALUES (:userId, :seanceId, :seatId)");

foreach ($selectedSeats as $seat) {
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':seanceId', $seanceId);
    $stmt->bindParam(':seatId', $seat);

    $stmt->execute();
}


header('Location: index.php');
exit();
