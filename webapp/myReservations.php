<?php
session_start();


if (!isset($_SESSION['user_id'])) {
          $_SESSION['error_message'] = 'Please sign in to view reservations.';
          header('Location: signin.php');
          exit();
}

include('connect.php');
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT R.*, M.title, S.date, S.start_time FROM RESERVATIONS R
                      INNER JOIN SEANCES S ON R.seance_id = S.id
                      INNER JOIN MOVIES M ON S.movie_id = M.id
                      WHERE R.user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>

          <?php include 'header.php' ?>

          <section>
                    <h2>Your Reservations</h2>
                    <table>
                              <thead>
                                        <tr>
                                                  <th>Movie Title</th>
                                                  <th>Date</th>
                                                  <th>Time</th>
                                                  <th>Seat</th>
                                                  <th>Action</th>
                                        </tr>
                              </thead>
                              <tbody>
                                        <?php foreach ($reservations as $reservation) : ?>
                                                  <tr>
                                                            <td><?= $reservation['title'] ?></td>
                                                            <td><?= $reservation['date'] ?></td>
                                                            <td><?= $reservation['start_time'] ?></td>
                                                            <td><?= $reservation['seat_id'] ?></td>
                                                            <td>
                                                                      <a href="delete_reservation.php?id=<?= $reservation['id'] ?>">Delete</a>
                                                            </td>
                                                  </tr>
                                        <?php endforeach; ?>
                              </tbody>
                    </table>
          </section>

          <?php include 'footer.php' ?>

</body>

</html>