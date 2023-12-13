<?php
include_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['nama_cabang']) &&
        isset($_POST['kota']) &&
        isset($_POST['alamat'])
    ) {
        $nama_cabang = mysqli_real_escape_string($connect, $_POST['nama_cabang']);
        $kota = mysqli_real_escape_string($connect, $_POST['kota']);
        $alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
        $kontak = isset($_POST['kontak']) ? mysqli_real_escape_string($connect, $_POST['kontak']) : '';

        $insert_cabang_query = "INSERT INTO cabang (nama, kota, alamat, kontak) VALUES ('$nama_cabang', '$kota', '$alamat', '$kontak')";
        $insert_cabang_result = mysqli_query($connect, $insert_cabang_query);

        if ($insert_cabang_result) {
            http_response_code(200);
            $response = ['success' => 'Data cabang berhasil ditambahkan'];
            echo json_encode($response);
            exit;
        } else {
            http_response_code(400);
            $response = ['error' => 'Gagal menambahkan data cabang'];
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
