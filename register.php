<?php

$errorMessage = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

    // Collecting input data
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $confirmPassword = $_POST['cpass'];

    // Validation for empty fields
    if (empty($firstName) && empty($lastName) && empty($username) && empty($password) && empty($confirmPassword)) {
        $errorMessage('Please fill all the fields.');
    } else {
        if (empty($firstName)) {
            $errorMessage('First Name field cannot be empty');
        }
        if (empty($lastName)) {
            $errorMessage('Last Name field cannot be empty');
        }
        if (empty($username)) {
            $errorMessage('Username field cannot be empty');
        }
        if (empty($password)) {
            $errorMessage('Password field cannot be empty');
        }
        if (empty($confirmPassword)) {
            $errorMessage('Confirm Password field cannot be empty');
        }
    }

    // Validation for names and username starting with a letter
    if (!preg_match("/^[a-zA-Z]/", $firstName) || !preg_match("/^[a-zA-Z]/", $lastName) || !preg_match("/^[a-zA-Z]/", $username)) {
        $errorMessage('First Name, Last Name, and Username must begin with a letter.');
    }

    // Validation for length of username and password
    if (strlen($username) < 8 || strlen($password) < 8) {
        $errorMessage('Username and Password must contain at least 8 characters.');
    }

    // Password and Confirm Password should match
    if ($password !== $confirmPassword) {
        $errorMessage('Password and Confirm Password do not match.');
    }

    $isUsernameUnique = true; // Replace with a function to check database

    if (!$isUsernameUnique) {
        $errorMessage = 'The username is already taken. Please choose a different one.';
    } else {
        $successMessage = 'Registration successful!';
    }
}
