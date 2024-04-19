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
                <button type="button" id="play-button" class="btn btn-danger align-middle mt-5">
                    <p class="text-light m-0" style="font-size: 24px">Play</p>
                </button>

                <div id="game-container" style="display: none;">
                    <form id="game-form" method="post" class="p-3">
                    </form>
                    <div id="game-messages" class="alert" role="alert" style="display: none;"></div>
                    <button id="next-level" class="btn btn-success mt-3" style="display:none;">Go to Next Level</button>
                    <button id="try-again" class="btn btn-warning mt-3" style="display:none;">Try Again</button>
                    <button id="play-again" class="btn btn-info mt-3" style="display:none;">Play Again</button>

                </div>

                <script>
                    document.getElementById('play-button').addEventListener('click', function() {
                        var gameContainer = document.getElementById('game-container');
                        if (gameContainer.style.display === 'none') {
                            gameContainer.style.display = 'block';
                            initializeGame();
                        } else {
                            gameContainer.style.display = 'none';
                        }
                    });

                    function initializeGame() {}
                </script>

                <script>
                    function initializeGame() {

                        createGameFormForLevel(1);
                    }

                    function createGameFormForLevel(level) {
                        const gameForm = document.getElementById('game-form');
                        gameForm.innerHTML = '';

                        for (let i = 0; i < 6; i++) {
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.name = `answer_${i + 1}`;
                            input.required = true;
                            gameForm.appendChild(input);
                        }

                        const submitButton = document.createElement('button');
                        submitButton.type = 'submit';
                        submitButton.className = 'btn btn-primary mt-3';
                        submitButton.textContent = 'Submit Answers';
                        gameForm.appendChild(submitButton);
                    }

                    document.getElementById('game-form').addEventListener('submit', function(e) {
                        e.preventDefault();


                        const answers = [...this.querySelectorAll('[name^="answer_"]')].map(input => input.value);

                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'game_process.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (this.status == 200) {
                                const result = JSON.parse(this.responseText);
                                handleGameResponse(result);
                            }
                        };
                        xhr.send(`answers=${JSON.stringify(answers)}&level=${currentLevel}`);
                    });

                    function handleGameResponse(result) {
                        var gameMessages = document.getElementById('game-messages');
                        gameMessages.textContent = result.message;

                        gameMessages.style.display = 'block';
                        gameMessages.className = result.success ? 'alert alert-success' : 'alert alert-danger';
                        gameMessages.textContent = result.message;

                        // Showing and hiding buttons based on the game state
                        document.getElementById('next-level').style.display = result.success && result.levelUp ? 'block' : 'none';
                        document.getElementById('try-again').style.display = !result.success ? 'block' : 'none';
                        document.getElementById('play-again').style.display = result.gameOver ? 'block' : 'none';

                        var nextLevelButton = document.getElementById('next-level');
                        var tryAgainButton = document.getElementById('try-again');
                        var playAgainButton = document.getElementById('play-again');

                        if (!result.success) {
                            if (result.message.startsWith('Game Over')) {
                                playAgainButton.style.display = 'block';
                            } else {
                                tryAgainButton.style.display = 'block';
                            }
                        } else {
                            if (result.message.startsWith('Congratulations')) {
                                playAgainButton.style.display = 'block';
                            } else {
                                nextLevelButton.style.display = 'block';
                            }
                        }
                    }
                    document.getElementById('next-level').addEventListener('click', function() {

                        var currentLevel = parseInt(sessionStorage.getItem('currentLevel'), 10);
                        sessionStorage.setItem('currentLevel', currentLevel + 1);

                        // Hide the next level button and display the form for the next level
                        this.style.display = 'none';
                        initializeGame(); // Reset the form for the next level
                    });

                    document.getElementById('try-again').addEventListener('click', function() {
                        // Do not change the level, but reinitialize the form
                        this.style.display = 'none';
                        initializeGame(); // Reset the form to try again
                    });

                    document.getElementById('play-again').addEventListener('click', function() {
                        // Reset the game state to the beginning
                        sessionStorage.setItem('currentLevel', 1);
                        sessionStorage.setItem('lives', 6); // Reset the lives

                        // Hide the play again button and display the form for the first level
                        this.style.display = 'none';
                        initializeGame(); // Reset the form to start over
                    });

                    function initializeGame() {
                        var currentLevel = sessionStorage.getItem('currentLevel') || 1;
                        var lives = sessionStorage.getItem('lives') || 6;

                        // Reset the game messages
                        document.getElementById('game-messages').textContent = '';

                        // Reset the visibility of the control buttons
                        document.getElementById('next-level').style.display = 'none';
                        document.getElementById('try-again').style.display = 'none';
                        document.getElementById('play-again').style.display = 'none';

                        createGameFormForLevel(currentLevel);

                        updateGameDisplay(currentLevel, lives);
                    }

                    function createGameFormForLevel(level) {
                        var form = document.getElementById('game-form');
                        form.innerHTML = ''; // Clear any existing form elements

                        // Generate input fields based on the level
                        var inputFields = '';
                        if (level === 1 || level === 2) {
                            // For letter ordering levels
                            for (var i = 0; i < 6; i++) {
                                inputFields += '<input type="text" name="answer[]" maxlength="1" required>';
                            }
                        } else {
                            // For number ordering levels
                            for (var i = 0; i < 6; i++) {
                                inputFields += '<input type="number" name="answer[]" min="0" max="100" required>';
                            }
                        }

                        form.innerHTML = inputFields; // Add the input fields to the form
                    }

                    function updateGameDisplay(level, lives) {
                        var gameMessages = document.getElementById('game-messages');
                        var levelDisplay = 'Level ' + level;
                        var livesDisplay = 'Lives: ' + lives;

                        gameMessages.textContent = levelDisplay + ' | ' + livesDisplay;
                    }
                </script>



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