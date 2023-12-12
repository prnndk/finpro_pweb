<?php

// login proses
session_start();
include 'connection.php';

// get data from form

$email = $_POST['email'];
$password = $_POST['password'];
if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

// cek if empty
if (empty($email) || empty($password)) {
    header('Location: login.php?error=true');
    exit;
}
$query = "SELECT * FROM users WHERE email = '$email'";

// get data from query
$result = mysqli_query($connect, $query);

// check data from query
if (mysqli_num_rows($result) === 1) {
    // check password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['isAdmin'] = $row['roles'] == 'admin';
        header('Location: index.php');
        exit;
    } else {
        $message = 'Invalid email or password.';
        header("Location: login.php?error='$message'");
        // error message
    }
} else {
    $message = 'Invalid email or password.';
    header("Location: login.php?error='$message'");
    // error message
}