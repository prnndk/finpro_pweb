<?php
include '../connection.php';

if(!empty($_POST)){
    if(!isset($_POST['nama']) && !isset($_POST['pengajar_id']) && !isset($_POST['cabang_id'])){
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $nama = mysqli_real_escape_string($connect,$_POST['nama']);
    $cabang_id = mysqli_real_escape_string($connect,$_POST['cabang_id']);
    $pengajar_id = mysqli_real_escape_string($connect,$_POST['pengajar_id']);
    $kode_kelas = strtoupper(substr($nama, 0, 3)).rand(10, 99);
    var_dump($kode_kelas);

    $insert_kelas = "INSERT INTO kelas (nama, kode_kelas, pengajar_id, cabang_id) VALUES ('$nama', '$kode_kelas', '$pengajar_id', '$cabang_id')";
    $insert_kelas_result = mysqli_query($connect, $insert_kelas);
    if ($insert_kelas_result) {
        http_response_code(200);
        $response = ['success' => 'Berhasil Input nilai siswa'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Input Nilai Siswa'];
        echo json_encode($response);
        exit;
    }
}else{
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}