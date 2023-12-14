<?php
require_once '../isLogin.php';
include '../connection.php';
if (!empty($_POST)) {
    if (!isset($_POST['siswa_id']) || !isset($_POST['cabang_id']) || !isset($_POST['total']) || !isset($_FILES['bukti_pembayaran'])) {
        header('Location: pembayaran_create.php?error=empty+post');
        exit;
    }
    var_dump($_POST);
    $siswa_id = $_POST['siswa_id'];
    $cabang_id = $_POST['cabang_id'];
    $total = $_POST['total'];
    $deskripsi = $_POST['deskripsi'];
    $bukti_pembayaran = $_FILES['bukti_pembayaran'];

    $bukti_pembayaran_name = $bukti_pembayaran['name'];
    $bukti_pembayaran_tmp_name = $bukti_pembayaran['tmp_name'];
    $bukti_pembayaran_error = $bukti_pembayaran['error'];
    $bukti_pembayaran_size = $bukti_pembayaran['size'];
    $bukti_pembayaran_ext = explode('.', $bukti_pembayaran_name);
    $bukti_pembayaran_ext = strtolower(end($bukti_pembayaran_ext));
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($bukti_pembayaran_ext, $allowed)) {
        header('Location: pembayaran_create.php?error=image+not+allowed');
        exit;
    }
    if ($bukti_pembayaran_error !== 0) {
        header('Location: pembayaran_create.php?error=file+error');
        exit;
    }
    if ($bukti_pembayaran_size > 1000000) {
        header('Location: pembayaran_create.php?error=file+size+exceeded');
        exit;
    }
    $bukti_pembayaran_new_name = uniqid('', true) . '.' . $bukti_pembayaran_ext;
    $bukti_pembayaran_destination = '../uploads/' . $bukti_pembayaran_new_name;
    if (!move_uploaded_file($bukti_pembayaran_tmp_name, $bukti_pembayaran_destination)) {
        header('Location: pembayaran_create.php?error=moving+file+failed');
        exit;
    }
    $insert_pembayaran_query = "INSERT INTO pembayaran (siswa_id, cabang_id, total, deskripsi, bukti_pembayaran) VALUES ('$siswa_id', '$cabang_id', '$total','$deskripsi', '$bukti_pembayaran_destination')";
    $insert_pembayaran_result = mysqli_query($connect, $insert_pembayaran_query);
    if ($insert_pembayaran_result) {
        header('Location: pembayaran.php');
        exit;
    } else {
        header('Location: pembayaran_create.php?error=insert+failed');
        exit;
    }
} else {
    header('Location: pembayaran_create.php?error=empty+post');
    exit;
}