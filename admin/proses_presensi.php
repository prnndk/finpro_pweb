<?php

include '../connection.php';
    // get header for id and status kehadiran
    if(!empty($_POST)){
        if(!isset($_POST['kehadiran']) && !isset($_POST['absen_id'])){
            http_response_code(400);
            $response = ['error' => 'Value Not Set'];
            echo json_encode($response);
            exit;
        }
        $absen_id = mysqli_real_escape_string($connect,$_POST['absensi_id']);
        $kehadiran = mysqli_real_escape_string($connect,$_POST['kehadiran']);
        $kehadiran = strtoupper($kehadiran);
        
        $update_absen_query = "UPDATE absen_siswa SET kehadiran = '$kehadiran' WHERE id = '$absen_id'";
        $update_absen_result = mysqli_query($connect, $update_absen_query);
        if ($update_absen_result) {
            http_response_code(200);
        $response = ['success' => 'Absen Berhasil Dirubah'];
        echo json_encode($response);
        exit;
        } else {
            http_response_code(400);
        $response = ['success' => 'Gagal Melakukan Absen'];
        echo json_encode($response);
        exit;
        }
    }else{
            http_response_code(400);
            $response = ['error' => 'Value Not Set'];
            echo json_encode($response);
            exit;
    }