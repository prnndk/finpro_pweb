<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic validation
    if (empty($email) || empty($name) || empty($username) || empty($password)) {
        echo "All fields are required.";
    } else {
        // TODO: Perform additional validation and sanitation if needed

        // Hash the password (you should use a stronger hashing algorithm)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Set the default role value
        $role = 'user';

        // Prepare and execute the SQL statement to insert the user into the database
        $sql = "INSERT INTO users (email, name, username, password, roles) VALUES ('$email', '$name', '$username', '$hashed_password', '$role')";

        if ($connect->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
} else {
    // If the form is not submitted, redirect to the registration page
    header("Location: register_page.php");
    exit();
}

// Close the database connection
$connect->close();
?>
