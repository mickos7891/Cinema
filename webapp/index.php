<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>


    <?php include 'header.php' ?>

    <section>
        <div class="movie-container">

            <?php include 'fetchFilms.php' ?>
        </div>
    </section>

    <?php include 'footer.php' ?>

</body>

</html>