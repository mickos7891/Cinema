<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>

    <?php include 'header.php' ?>

    <section>
        <div class="signin-container">
            <h2>Sign In</h2>

            <?php

            if (isset($_GET['success']) && $_GET['success'] == 'true') {
                echo '<p class="success-message">Sign in successful! Welcome back, ' . $_SESSION['username'] . '!</p>';
            } elseif (isset($_GET['error']) && $_GET['error'] == '1') {
                echo '<p class="error-message">Sign in failed. Please check your username and password.</p>';
            }
            ?>

            <form action="signin_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit" class="custom-button">Sign In</button>
            </form>
        </div>
    </section>

    <?php include 'footer.php' ?>

</body>

</html>