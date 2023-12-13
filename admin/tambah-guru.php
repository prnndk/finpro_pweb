<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['nama_guru']) &&
        isset($_POST['mapel']) &&
        isset($_POST['kode']) &&
        isset($_POST['cabang_id'])
    ) {
        $nama_guru = mysqli_real_escape_string($connect, $_POST['nama_guru']);
        $mapel = mysqli_real_escape_string($connect, $_POST['mapel']);
        $kode = mysqli_real_escape_string($connect, $_POST['kode']);
        $cabang_id = mysqli_real_escape_string($connect, $_POST['cabang_id']);

        $insert_guru_query = "INSERT INTO pengajar (nama, mapel, kode, cabang_id) VALUES ('$nama_guru', '$mapel', '$kode', '$cabang_id')";
        $insert_guru_result = mysqli_query($connect, $insert_guru_query);

        if ($insert_guru_result) {
            http_response_code(200);
            $response = ['success' => 'Data guru berhasil ditambahkan'];
            echo json_encode($response);
            exit;
        } else {
            http_response_code(400);
            $response = ['error' => 'Gagal menambahkan data guru'];
            echo json_encode($response);
            exit;
        }
    } else {
        http_response_code(400);
        $response = ['error' => 'Value not set'];
        echo json_encode($response);
        exit;
    }
} else {
    http_response_code(400);
    $response = ['error' => 'Invalid request method'];
    echo json_encode($response);
    exit;
}
?>

