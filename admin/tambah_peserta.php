<?php

include '../connection.php';
require_once '../isAdmin.php';
global $connect;
if(!empty($_POST)){
    if(!isset($_POST['siswa_id']) && !isset($_POST['kelas_id'])){
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $kelas_id = mysqli_real_escape_string($connect,$_POST['kelas_id']);
    $siswa_id = mysqli_real_escape_string($connect,$_POST['siswa_id']);

    $insert_peserta_query = "INSERT INTO daftar_siswa (kelas_id, siswa_id) VALUES ('$kelas_id', '$siswa_id')";

    $insert_peserta = mysqli_query($connect, $insert_peserta_query);

    if ($insert_peserta) {
        http_response_code(200);
        $response = ['success' => 'Berhasil Input Peserta Kelas'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Input peserta kelas'];
        echo json_encode($response);
        exit;
    }
}else{
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}