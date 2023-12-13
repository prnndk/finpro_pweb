<?php
include_once '../connection.php';

function tambahDataGuru($nama_guru, $mapel, $kode, $cabang_id)
{
    global $connect;

    $nama_guru = mysqli_real_escape_string($connect, $nama_guru);
    $mapel = mysqli_real_escape_string($connect, $mapel);
    $kode = mysqli_real_escape_string($connect, $kode);
    $cabang_id = mysqli_real_escape_string($connect, $cabang_id);

    $insert_guru_query = "INSERT INTO pengajar (nama, mapel, kode, cabang_id) VALUES ('$nama_guru', '$mapel', '$kode', '$cabang_id')";
    $insert_guru_result = mysqli_query($connect, $insert_guru_query);

    if ($insert_guru_result) {
        return true;
    } else {
        return false;
    }
}
?>
