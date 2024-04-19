<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['last_activity'])) {
    // Time since the last activity
    $secondsInactive = time() - $_SESSION['last_activity'];

    // Time in seconds before the session expires (15 minutes)
    $expireAfterSeconds = 15 * 60;

    // Check if the user has been inactive for too long
    if ($secondsInactive >= $expireAfterSeconds) {
        // User has been inactive for too long.
        // Kill the session and redirect to login page
        session_unset();
        session_destroy();
        header("Location: index.php?error=Session timed out");
        exit();
    }

    // Update the last activity time stamp
    $_SESSION['last_activity'] = time();
} else {
    header("Location: index.php?error=Please login to view this page");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="text- center heading6">
        <h1>Team 6</h1>
    </nav>

    <div class="position-fixed" style="width: 100%;">
        <div class="d-grid col-md-10 mx-auto">
            <button type="button" class="btn btn-primary mt-3 ">
                <a href="logout.php">
                    <p class="text-light m-0" style="font-size: 24px">Logout</p>
                </a>
            </button>
        </div>
        <div class="col-lg-4 offset-lg-4 bg-body-secondary rounded mt-5">
            <h1 class="text-center mt-2">Hello, <?php echo $_SESSION['user_name']; ?></h1>
        </div>
        <div class="container-md" style="height: 300px;">
            <div class="d-grid col-md-10 mx-auto mt-5">
                <a href="game.php">
                    <button type="button" class="btn btn-danger align-middle mt-5">
                        <p class="text-light m-0" style="font-size: 24px">Play</p>
                    </button>
                </a>

            </div>
        </div>
    </div>

    <footer>
        <h6 class="text-center">All right reserved</h6>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>