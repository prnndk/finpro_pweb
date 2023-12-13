<?php
include '../connection.php';

if(!empty($_POST)){
    if(!isset($_POST['nilai_siswa']) && !isset($_POST['kelas_id']) && !isset($_POST['siswa_id']) && !isset($_POST['pengajar_id']) ){
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $nilai_siswa = mysqli_real_escape_string($connect,$_POST['nilai_siswa']);
    $catatan = mysqli_real_escape_string($connect,$_POST['catatan']);
    $siswa_id = mysqli_real_escape_string($connect,$_POST['siswa_id']);
    $pengajar_id = mysqli_real_escape_string($connect,$_POST['pengajar_id']);
    $kelas_id = mysqli_real_escape_string($connect,$_POST['kelas_id']);

    $update_nilai_siswa = "INSERT INTO nilai_siswa (nilai, catatan, siswa_id, pengajar_id, kelas_id) VALUES ('$nilai_siswa', '$catatan', '$siswa_id', '$pengajar_id', '$kelas_id')";
    $update_nilai_siswa_result = mysqli_query($connect, $update_nilai_siswa);
    if ($update_nilai_siswa_result) {
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