<?php
require_once '../isLogin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$nilai_siswa_query = 'SELECT k.nama as nama_kelas, n.nilai, n.catatan FROM nilai_siswa n join kelas k on n.kelas_id = k.id join siswas s on n.siswa_id = s.id WHERE n.siswa_id = '.$siswa_id;
$nilai_siswa_result = mysqli_query($connect, $nilai_siswa_query);
$nilai_siswa = mysqli_fetch_all($nilai_siswa_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content">
    <div class="container-header">Daftar Nilai Siswa</div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Nilai Siswa</th>
                <th scope="col">Catatan</th>
                <th scope="col">Aksi Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nilai_siswa as $nilai) {?>
            <tr>
                <td><?php echo $nilai['nama_kelas']; ?></td>
                <td><?php echo $nilai['nilai']; ?></td>
                <td><?php echo $nilai['catatan']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include_once '../template/footer.php';