<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

<body>

    <?php include 'header.php' ?>

    <section>
        <div class="registration-container">
            <h2>Register</h2>

            <?php

            if (isset($_GET['error'])) {
                $error = $_GET['error'];

                if ($error === 'password_mismatch') {
                    echo '<p class="error-message">Passwords do not match. Please try again.</p>';
                } elseif ($error === 'username_exists') {
                    echo '<p class="error-message">Username already exists. Please choose a different username.</p>';
                } elseif ($error === 'registration_failed') {
                    echo '<p class="error-message">Registration failed. Please try again later.</p>';
                }
            }
            ?>

            <form action="register_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="custom-button">Register</button>
            </form>
        </div>
    </section>

    <?php include 'footer.php' ?>

</body>

</html>