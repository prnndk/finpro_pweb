<?php
require_once '../isLogin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$absen_kelas_siswa_query = 'SELECT k.id, k.nama,k.kode_kelas FROM kelas k join daftar_siswa d on k.id = d.kelas_id WHERE d.siswa_id = ' . $siswa_id ;
$absen_kelas_siswa_result = mysqli_query($connect, $absen_kelas_siswa_query);
$absen_kelas_siswa = mysqli_fetch_all($absen_kelas_siswa_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content">
    <div class="container-header">Presensi Kelas Bimbel</div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Kode Kelas</th>
                <th scope="col">Aksi Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($absen_kelas_siswa as $presensi) {?>
            <tr>
                <td>
                    <?php echo $presensi['nama']; ?>
                </td>
                <td><?php echo $presensi['kode_kelas']; ?></td>
                <td>
                    <a href="list_presensi.php?kelas_id=<?php echo $presensi['id']; ?>"
                        class="btn btn-success btn-sm">Lihat
                        Presensi</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include_once '../template/footer.php';