<?php
include_once '../connection.php';

function tambahDataCabang($nama_cabang, $kota, $alamat, $kontak)
{
    global $connect;

    $nama_cabang = mysqli_real_escape_string($connect, $nama_cabang);
    $kota = mysqli_real_escape_string($connect, $kota);
    $alamat = mysqli_real_escape_string($connect, $alamat);
    $kontak = mysqli_real_escape_string($connect, $kontak);

    $insert_cabang_query = "INSERT INTO cabang (nama, kota, alamat, kontak) VALUES ('$nama_cabang', '$kota', '$alamat', '$kontak')";
    $insert_cabang_result = mysqli_query($connect, $insert_cabang_query);

    if ($insert_cabang_result) {
        return true;
    } else {
        return false;
    }
}

?>

