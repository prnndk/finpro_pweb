<?php
require_once '../isLogin.php';
include '../connection.php';
if (!empty($_POST)) {
    $output = '';
    $kode_presensi = mysqli_real_escape_string($connect, $_POST['kode_absen']);
    $kelas_id = mysqli_real_escape_string($connect, $_POST['kelas_id']);
    $siswa_id = mysqli_real_escape_string($connect, $_POST['siswa_id']);
    $query_cek_kode = "SELECT * FROM absen_kelas where kelas_id = '$kelas_id' and kode_absen = '$kode_presensi' and expired_at > NOW()";
    $result_cek_kode = mysqli_query($connect, $query_cek_kode);
    $cek_kode = mysqli_fetch_assoc($result_cek_kode);
    if (!$cek_kode) {
        // return error json
        http_response_code(404);
        $response = ['error' => 'Kode Presensi Salah'];
        echo json_encode($response);
        exit;
    }
    $cek_kode_id = $cek_kode['id'];
    $cek_is_already_absen_query = "SELECT * FROM absen_siswa where absen_id = '$cek_kode_id'and siswa_id = '$siswa_id' and kehadiran = 'HADIR'";
    $cek_is_already_absen_result = mysqli_query($connect, $cek_is_already_absen_query);
    $cek_is_already_absen = mysqli_fetch_assoc($cek_is_already_absen_result);
    if ($cek_is_already_absen) {
        // return error json
        http_response_code(400);
        $response = ['error' => 'Anda Sudah Absen'];
        echo json_encode($response);
        exit;
    }
    $insert_absen_query = "UPDATE absen_siswa SET kehadiran = 'HADIR' WHERE absen_id = '$cek_kode_id' and siswa_id = '$siswa_id'";
    $insert_absen_result = mysqli_query($connect, $insert_absen_query);
    if ($insert_absen_result) {
        // return error json
        http_response_code(200);
        $response = ['success' => 'Absen Berhasil'];
        echo json_encode($response);
        exit;
    } else {
        // return error json
        http_response_code(400);
        $response = ['error' => 'Absen Gagal'];
        echo json_encode($response);
        exit;
    }
}else{
    // get header for id and status kehadiran
    $absen_id = $_GET['id'];
    $kehadiran = $_GET['kehadiran'];
    $kehadiran = strtoupper($kehadiran);
    include_once '../connection.php';
    
    $update_absen_query = "UPDATE absen_siswa SET kehadiran = '$kehadiran' WHERE id = '$absen_id'";
    $update_absen_result = mysqli_query($connect, $update_absen_query);
    if ($update_absen_result) {
        // redirect
        header('Location:list_presensi_siswa.php?id='.$absen_id);
    } else {
        //redirect and error msg
        header('Location:list_presensi_siswa.php?id='.$absen_id.'&error=true');
    }
}