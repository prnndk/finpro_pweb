<?php
include '../connection.php';

if (!empty($_POST)) {
    if (!isset($_POST['nama_materi']) || !isset($_POST['link']) || !isset($_POST['is_latihan']) || !isset($_POST['kelas_id'])) {
        http_response_code(400);
        $response = ['error' => 'Value Not Set'];
        echo json_encode($response);
        exit;
    }

    $nama_materi = mysqli_real_escape_string($connect, $_POST['nama_materi']);
    $link = mysqli_real_escape_string($connect, $_POST['link']);
    $is_latihan = mysqli_real_escape_string($connect, $_POST['is_latihan']);
    $kelas_id = mysqli_real_escape_string($connect, $_POST['kelas_id']);

    $tambah_materi_query = "INSERT INTO materi_kelas (nama_materi, link, is_latihan, kelas_id) VALUES ('$nama_materi', '$link', '$is_latihan', '$kelas_id')";
    $tambah_materi_result = mysqli_query($connect, $tambah_materi_query);

    if ($tambah_materi_result) {
        http_response_code(200);
        $response = ['success' => 'Berhasil Menambah Materi'];
        echo json_encode($response);
        exit;
    } else {
        http_response_code(400);
        $response = ['error' => 'Gagal Menambah Materi'];
        echo json_encode($response);
        exit;
    }
} else {
    http_response_code(400);
    $response = ['error' => 'Value Not Set'];
    echo json_encode($response);
    exit;
}
?>
