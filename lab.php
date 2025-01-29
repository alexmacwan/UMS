            <html>
                <head>
                <title> LAB Manual</title>
                </head>
                <link rel="stylesheet" href="side.css">
                
            <div class="sidebar">
                <button> <a href="http://localhost/php/register/dash.php"> My Profile </button> </a>
                <button> <a href="http://localhost/php/register/feeed.php"> My Feedback</button>  </a>
                <button> <a href="http://localhost/php/register/logout.php"> Logout</button>  </a> </div>
            <div class="content">
                <h1 style="align=center">Lab Manual</h1>
                <p> /* WRITE DOWN YOUR CONTENT */</p>
                </div>
            </html>
                <?php
                // Start the session
            session_start();

            // Check if the user is already logged in
            if (isset($_SESSION['username'])) {
                header('Location: dash.php');
                exit;
            }
        ?>

