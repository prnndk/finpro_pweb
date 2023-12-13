<?php
require_once '../isAdmin.php';
include '../connection.php';
    // get header for id and status kehadiran
    if(!empty($_POST)){
        if(!isset($_POST['kelas_id']) && !isset($_POST['pengajar_id']) && !isset($_POST['expired_at'])){
            http_response_code(400);
            $response = ['error' => 'Value Not Set'];
            echo json_encode($response);
            exit;
        }
        $kelas_id = mysqli_real_escape_string($connect,$_POST['kelas_id']);
        $pengajar_id = mysqli_real_escape_string($connect,$_POST['pengajar_id']);
        $expired_at = mysqli_real_escape_string($connect,$_POST['expired_at']);
        $kode_absen = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));

        $insert_absen_query = "INSERT INTO absen_kelas (kode_absen,kelas_id,pengajar_id,expired_at) values ('$kode_absen','$kelas_id','$pengajar_id','$expired_at') ";
        $insert_absen_result = mysqli_query($connect, $insert_absen_query);
        //insert all siswa attended to class to absen_siswa and set kehadiran is false
        $absen_id = mysqli_insert_id($connect);
        $insert_absen_siswa_query = "INSERT INTO absen_siswa (absen_id,siswa_id,kehadiran) SELECT '$absen_id',ds.siswa_id,'ALPHA' FROM daftar_siswa ds WHERE kelas_id = '$kelas_id'";
        $insert_absen_siswa_result = mysqli_query($connect, $insert_absen_siswa_query);
        if ($insert_absen_result) {
            http_response_code(200);
        $response = ['success' => 'Absen Berhasil Dibuat'];
        echo json_encode($response);
        exit;
        } else {
            http_response_code(400);
        $response = ['success' => 'Gagal Membuat Presensi'];
        echo json_encode($response);
        exit;
        }
    }else{
            http_response_code(400);
            $response = ['error' => 'Value Not Set'];
            echo json_encode($response);
            exit;
    }