<?php
include "db_conn.php";  // Ensures the database connection is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);

    // Basic validations
    if (empty($username) || empty($password) || empty($confirm_password) || empty($first_name) || empty($last_name)) {
        echo "All fields are required.";
    } elseif (!preg_match("/^[a-zA-Z]/", $first_name) || !preg_match("/^[a-zA-Z]/", $last_name) || !preg_match("/^[a-zA-Z]/", $username)) {
        echo "First Name, Last Name, and Username must start with a letter.";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } elseif (strlen($username) < 8 || strlen($password) < 8) {
        echo "Username and Password must contain at least 8 characters.";
    } else {
        // Check if username exists
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "Username already exists.";
        } else {
            // Insert new user
            $sql = "INSERT INTO users (username, password, first_name, last_name) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'ssss', $username, $hashed_password, $first_name, $last_name);
            mysqli_stmt_execute($stmt);
            echo "Registration successful!";
        }
    }
    mysqli_stmt_close($stmt);
}
<<<<<<< HEAD

// Collecting input data
$uname = validate($_POST['uname']);
$pass = validate($_POST['pass']);
$cpass = validate($_POST['cpass']);
$fname = validate($_POST['fname']);
$lname = validate($_POST['lname']);

// Validation for empty fields
if (empty($uname)) {
    header("Location: index.php?error=Username field cannot be empty");
    exit();
} else if (empty($pass)) {
    header("Location: index.php?error=Password field cannot be empty");
    exit();
} else if (empty($cpass)) {
    header("Location: index.php?error=Confirmation Password field cannot be empty");
    exit();
} else if (empty($fname)) {
    header("Location: index.php?error=First Name field cannot be empty");
    exit();
} else if (empty($lname)) {
    header("Location: index.php?error=Last Name field cannot be empty");
    exit();
}

// Validation for names and username starting with a letter
if (!ctype_alpha($uname[0]) || !ctype_alpha($fname[0]) || !ctype_alpha($lname[0])) {
    echo "The first character should be a letter";
}

// Validation for length of username and password
if (!strlen($pass) < 8 || !strlen($uname) < 8) {
    echo "Must contain 8 characters minimum";
}

// Password and Confirm Password should match
if ($pass !== $cpass) {
    $errorMessage('Sorry, you entered 2 different passwords.');
}
=======
mysqli_close($conn);
>>>>>>> phpLogic
