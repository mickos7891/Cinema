<?php
session_start();

$host = 'mysql';
$port = '3306';
$database = 'CINEMA';
$user = 'root';
$password = 'rootpassword';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $movieId = isset($_GET['movie_id']) ? $_GET['movie_id'] : null;

    if (!$movieId) {

        header('Location: error.php');
        exit();
    }


    $stmtMovie = $pdo->prepare("SELECT * FROM MOVIES WHERE id = :movieId");
    $stmtMovie->bindParam(':movieId', $movieId);
    $stmtMovie->execute();
    $movie = $stmtMovie->fetch(PDO::FETCH_ASSOC);

    if (!$movie) {

        header('Location: error.php');
        exit();
    }


    $stmtSeances = $pdo->prepare("SELECT SEANCES.*, CINEMA_HALLS.name AS hall_name FROM SEANCES
                                  JOIN CINEMA_HALLS ON SEANCES.hall_id = CINEMA_HALLS.id
                                  WHERE SEANCES.movie_id = :movieId");
    $stmtSeances->bindParam(':movieId', $movieId);
    $stmtSeances->execute();
    $seances = $stmtSeances->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    header('Location: error.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>

    <?php include 'header.php' ?>

    <section>
        <div class="reservation-details">
            <h2><?php echo $movie['title']; ?></h2>
            <img src="<?php echo $movie['image_url']; ?>" alt="<?php echo $movie['title']; ?> Image">

            <h3>Cinema Hall Details and Seances:</h3>
            <?php
            foreach ($seances as $seance) {
                echo '<div class="seance-details">';
                echo '<p><strong>Hall Name:</strong> ' . $seance['hall_name'] . '</p>';
                echo '<p><strong>Date:</strong> ' . $seance['date'] . '</p>';
                echo '<p><strong>Start Time:</strong> ' . $seance['start_time'] . '</p>';
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="reserve.php?seance_id=' . $seance['id'] . '" class="custom-button">Reserve Tickets</a>';
                } else {
                    echo '<a href="signin.php" class="custom-button">Please Sign in!</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php' ?>

</body>

</html>