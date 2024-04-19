<?php
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['cpass']) && isset($_POST['fanme']) && isset($_POST['lname'])) {


    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

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
    $errorMessage('Password and Confirm Password do not match.');
}
