<?php

include '../connection.php';

if (!empty($_POST)) {
    if (!isset($_POST['pembayaran_id'])) {
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $id = mysqli_real_escape_string($connect, $_POST['pembayaran_id']);

    $update_pembayaran = "UPDATE pembayaran SET is_verified = true, verified_by = 1 WHERE id = '$id'";
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