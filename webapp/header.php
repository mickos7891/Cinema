<header>
          <div class="header-container">
                    <h1><a href="index.php">B&R Cinema</a></h1>
                    <div class="auth-buttons">
                              <?php

                              if (isset($_SESSION['user_id'])) {

                                        echo '<a href="myReservations.php"  class="custom-button">My Reservations</a>';
                                        echo '<a href="logout.php" class="custom-button">Logout</a>';
                              } else {

                                        echo '<a href="signin.php" class="custom-button">Sign In</a>';
                                        echo '<a href="register.php" class="custom-button">Register</a>';
                              }
                              ?>
                    </div>
                    <?php if (isset($_SESSION['user_id'])) echo '<div class="greeting">Hello, ' . $_SESSION['username'] . '!</div>'; ?>
          </div>
</header>