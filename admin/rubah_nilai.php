<?php
include '../connection.php';

if(!empty($_POST)){
    if(!isset($_POST['nilai_siswa']) && !isset($_POST['catatan']) && !isset($_POST['nilai_siswa_id']) ){
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }
    $nilai_siswa = mysqli_real_escape_string($connect,$_POST['nilai_siswa']);
    $catatan = mysqli_real_escape_string($connect,$_POST['catatan']);
    $nilai_siswa_id = mysqli_real_escape_string($connect,$_POST['nilai_siswa_id']);

    $update_nilai_siswa = "UPDATE nilai_siswa SET nilai = '$nilai_siswa', catatan = '$catatan' WHERE id = '$nilai_siswa_id'";
    $update_nilai_siswa_result = mysqli_query($connect, $update_nilai_siswa);
    if ($update_nilai_siswa_result) {
        http_response_code(200);
        $response = ['success' => 'Berhasil rubah nilai siswa'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Update Nilai Siswa'];
        echo json_encode($response);
        exit;
    }
}else{
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}