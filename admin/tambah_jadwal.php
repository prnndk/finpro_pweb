<?php

include '../connection.php';

if(!empty($_POST)){
    if(!isset($_POST['jam']) && !isset($_POST['hari']) && !isset($_POST['kelas_id'])){
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $kelas_id = mysqli_real_escape_string($connect,$_POST['kelas_id']);
    $jam = mysqli_real_escape_string($connect,$_POST['jam']);
    $hari = mysqli_real_escape_string($connect,$_POST['hari']);

    $insert_jadwal = "INSERT INTO jadwal_kelas (kelas_id, hari, jam) VALUES ('$kelas_id', '$hari', '$jam')";
    $insert_jadwal_result = mysqli_query($connect, $insert_jadwal);
    if ($insert_jadwal_result) {
        http_response_code(200);
        $response = ['success' => 'Berhasil Input jadwal kelas'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Input jadwal kelas'];
        echo json_encode($response);
        exit;
    }
}else{
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}