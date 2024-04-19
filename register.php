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
mysqli_close($conn);
