<?php

include('connect.php');


$stmt = $pdo->query("SELECT * FROM MOVIES");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($movies as $movie) {
    echo '<div class="movie-card">';
    echo '<h2 class="movie-title">' . $movie['title'] . '</h2>';
    echo '<img src="' . $movie['image_url'] . '" alt="Movie Image" class="movie-image">';
    echo '<p class="movie-description">' . $movie['description'] . '</p>';
    echo '<div class="button-container"><a href="reservations.php?movie_id=' . $movie['id'] . '" class="custom-button">Reservations</a></div>';
    echo '</div>';
}


echo '<pre>';
print_r($result);
echo '</pre>';
