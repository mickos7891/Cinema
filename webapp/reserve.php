<?php
include('connect.php');


$seanceId = isset($_GET['seance_id']) ? $_GET['seance_id'] : null;

if (!$seanceId) {

    header('Location: error.php');
    exit();
}


$stmtSeance = $pdo->prepare("SELECT SEANCES.*, CINEMA_HALLS.name AS hall_name, MOVIES.title AS movie_title
                                          FROM SEANCES
                                          JOIN CINEMA_HALLS ON SEANCES.hall_id = CINEMA_HALLS.id
                                          JOIN MOVIES ON SEANCES.movie_id = MOVIES.id
                                          WHERE SEANCES.id = :seanceId");
$stmtSeance->bindParam(':seanceId', $seanceId);
$stmtSeance->execute();
$seance = $stmtSeance->fetch(PDO::FETCH_ASSOC);

if (!$seance) {

    header('Location: error.php');
    exit();
}




$stmtHall = $pdo->prepare("SELECT * FROM CINEMA_HALLS WHERE id = :hallId");
$stmtHall->bindParam(':hallId', $seance['hall_id']);
$stmtHall->execute();
$hall = $stmtHall->fetch(PDO::FETCH_ASSOC);

if (!$hall) {

    header('Location: error.php');
    exit();
}


$stmtReservations = $pdo->prepare("SELECT seat_id FROM RESERVATIONS WHERE seance_id = :seanceId");
$stmtReservations->bindParam(':seanceId', $seanceId);
$stmtReservations->execute();
$reservedSeats = $stmtReservations->fetchAll(PDO::FETCH_COLUMN);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reserve Tickets</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .hall-visualization {
            display: grid;
            grid-template-columns: repeat(<?php echo $hall['seats_in_row']; ?>, 1fr);
            gap: 5px;
            margin-top: 20px;
        }

        .hall-seat.selected {
            background-color: #4CAF50;
            color: #fff;
            border: 2px solid #4CAF50;
            border-radius: 5px;
        }


        .hall-seat {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            cursor: pointer;
            text-align: center;
            line-height: 30px;
            background-color: #fff;
        }

        .hall-seat.reserved {
            background-color: #ff5252;
        }
    </style>
</head>

<body>

    <?php include 'header.php' ?>

    <section>
        <div class="reserve-details">

            <h3>Select Your Seat:</h3>
            <div class="hall-visualization">
                <?php

                for ($row = 1; $row <= $hall['rows']; $row++) {
                    for ($seat = 1; $seat <= $hall['seats_in_row']; $seat++) {
                        $seatNumber = ($row - 1) * $hall['seats_in_row'] + $seat;
                        $isReserved = in_array($seatNumber, $reservedSeats);

                        $class = $isReserved ? 'reserved' : '';
                        echo '<div class="hall-seat ' . $class . '" data-seat="' . $seatNumber . '">' . $seatNumber . '</div>';
                    }
                }
                ?>
            </div>

            <div id="selected-seat-info"></div>

            <form id="reservation-form" action="process_reservation.php" method="GET">
                <input type="hidden" name="seance_id" value="<?php echo $seanceId; ?>">
                <input type="hidden" name="seats" id="selected-seats-input" value="">

                <button type="custom-button" id="reserve-button" class="custom-button" disabled>Reserve Seat</button>
            </form>
        </div>
    </section>

    <?php include 'footer.php' ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var seatElements = document.querySelectorAll('.hall-seat:not(.reserved)');
            var selectedSeats = [];

            seatElements.forEach(function(seatElement) {
                seatElement.addEventListener('click', function() {
                    var seatNumber = seatElement.dataset.seat;


                    var isSelected = selectedSeats.includes(seatNumber);


                    if (!isSelected) {
                        seatElement.classList.add('selected');
                        selectedSeats.push(seatNumber);
                    } else {
                        seatElement.classList.remove('selected');
                        selectedSeats = selectedSeats.filter(function(s) {
                            return s !== seatNumber;
                        });
                    }


                    updateSelectedSeatInfo(selectedSeats);
                });
            });

            function updateSelectedSeatInfo(seats) {
                var infoElement = document.getElementById('selected-seat-info');
                infoElement.innerHTML = 'Selected Seats: ' + seats.join(', ');


                var reserveButton = document.getElementById('reserve-button');
                reserveButton.disabled = seats.length === 0;
            }


            var reserveButton = document.getElementById('reserve-button');
            reserveButton.addEventListener('click', function() {

                var selectedSeatsInput = document.getElementById('selected-seats-input');
                selectedSeatsInput.value = selectedSeats.join(',');


                var reservationForm = document.getElementById('reservation-form');
                reservationForm.submit();
            });
        });
    </script>

</body>

</html>