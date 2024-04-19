session_start();
<?php

function validate_game_level($level, $answers, $correctAnswers)
{
    // Check if all answers are different from the correct ones
    if (count(array_diff($answers, $correctAnswers)) == count($correctAnswers)) {
        return ['success' => false, 'message' => 'Incorrect – All your numbers are different from ours.'];
    }
    // Check if some answers are different
    if (count(array_diff_assoc($answers, $correctAnswers))) {
        return ['success' => false, 'message' => 'Incorrect – Some of your numbers are different from ours.'];
    }
    // Check if the order is incorrect
    if ($answers !== $correctAnswers) {
        return ['success' => false, 'message' => 'Incorrect – Your numbers were not correctly arranged.'];
    }
    // If all correct
    return ['success' => true, 'message' => 'Correct – Your numbers have been correctly ordered.'];
}

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = [
        'level' => 1,
        'lives' => 6,
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $level = $_SESSION['game']['level'];
    $answers = json_decode($_POST['answers']);
    $correctAnswers = $_SESSION['correctAnswers'];

    // Validate the user's answers
    $validation_result = validate_game_level($level, $answers, $correctAnswers);

    // Update the game state based on the result
    if (!$validation_result['success']) {
        $_SESSION['game']['lives']--;

        // Check for game over conditions
        if ($_SESSION['game']['lives'] <= 0) {
            $validation_result['message'] = 'Game Over – You have exhausted all your lives.';
            // Reset the game state 
        } else if ($level == 6) {
            $validation_result['message'] = 'Congratulations – You won the game!';
            // Handle winning the last level
        }
    } else {
        // The user answered correctly, move them to the next level if not at the last level
        if ($level < 6) {
            $_SESSION['game']['level']++;
            // Prepare for the next level
        }
    }

    echo json_encode($validation_result);
    exit();
}
