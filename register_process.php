<?php
// Include the database connection file
include 'connection.php';
global $connect;
// Check if the form is submitted
if (!empty($_POST) && isset($_POST["register"])) {
    // Retrieve form data
//    mysqli_real_escape_string($connect,$_POST['nilai_siswa']) use like that
    $email = mysqli_real_escape_string($connect,$_POST["email"]);
    $name = mysqli_real_escape_string($connect,$_POST["name"]);
    $username = mysqli_real_escape_string($connect,$_POST["username"]);
    $password = mysqli_real_escape_string($connect,$_POST["password"]);

    $tanggal_lahir = mysqli_real_escape_string($connect,$_POST["tanggal_lahir"]);
    $alamat = mysqli_real_escape_string($connect,$_POST["alamat"]);
    $no_hp = mysqli_real_escape_string($connect,$_POST["no_hp"]);
    $riwayat_belajar = mysqli_real_escape_string($connect,$_POST["riwayat_belajar"]);

//    $email = $_POST["email"];
//    $name = $_POST["name"];
//    $username = $_POST["username"];
//    $password = $_POST["password"];
//
//    $tanggal_lahir = $_POST["tanggal_lahir"];
//    $alamat = $_POST["alamat"];
//    $no_hp = $_POST["no_hp"];
//    $riwayat_belajar = $_POST["riwayat_belajar"];


    // Perform basic validation
    if (empty($email) || empty($name) || empty($username) || empty($password) || empty($tanggal_lahir) || empty($alamat) || empty($no_hp) || empty($riwayat_belajar)) {
        echo "All fields are required.";
    } else {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Username sudah digunakan";
            exit;
        }
        // Hash the password (you should use a stronger hashing algorithm)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Set the default role value
        $role = 'user';
//        start transaction
        mysqli_autocommit($connect, false);

        // Prepare and execute the SQL statement to insert the user into the database
        $sql = "INSERT INTO users (email, name, username, password, roles) VALUES ('$email', '$name', '$username', '$hashed_password', '$role')";

        if ($connect->query($sql) === TRUE) {
//            get user id and insert into siswas
            $user_id = $connect->insert_id;
            $sql = "INSERT INTO siswas (user_id, tanggal_lahir, alamat, no_hp, riwayat_belajar,nama) VALUES ('$user_id', '$tanggal_lahir', '$alamat', '$no_hp', '$riwayat_belajar','$name')";
            if ($connect->query($sql) === TRUE) {
                mysqli_commit($connect);
            } else {
                mysqli_rollback($connect);
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
            // Redirect to the login page
           header('Location: login.php');
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
} else {
    // If the form is not submitted, redirect to the registration page
    header("Location: register.php");
    exit();
}

// Close the database connection
$connect->close();
?>
