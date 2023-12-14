<?php

include '../connection.php';
global $connect;

if (!empty($_POST)) {
    if (!isset($_POST['pembayaran_id'])&& !isset($_POST['verified_by'])) {
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $id = mysqli_real_escape_string($connect, $_POST['pembayaran_id']);
    $admin_id = mysqli_real_escape_string($connect, $_POST['verified_by']);

    $update_pembayaran = "UPDATE pembayaran SET is_verified = true, verified_by = '$admin_id' WHERE id = '$id'";
    $update_result = mysqli_query($connect, $update_pembayaran);
    if ($update_result) {
        http_response_code(200);
        $response = ['success' => 'Berhasil Verifikasi Pembayaran'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Verifikasi'];
        echo json_encode($response);
        exit;
    }
} else {
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}